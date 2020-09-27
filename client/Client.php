<?php

namespace yukana\DingDong\client;

use yukana\DingDong\packets\Packet;
use yukana\DingDong\packets\DingPacket;
use yukana\DingDong\packets\DongPacket;

use yukana\DingDong\packets\protocol\CreateSessionAcceptPacket;
use yukana\DingDong\packets\protocol\CreateSessionRequestPacket;
use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketPool;
use yukana\DingDong\packets\protocol\PacketType;

use yukana\DingDong\utils\Utils;

use yukana\DingDong\network\SessionBuilder;

class Client
{
	private $ipaddress;
	private $port;

	private $socket;

	public function __construct(string $ipaddress, int $port)
	{
		require_once __DIR__ . "/../vendor/autoload.php";

		$this->ipaddress = $ipaddress;
		$this->port = $port;

		PacketPool::registerPackets();
	}

	public function connect(): void
	{
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if ($this->socket === false) {
			echo "- Error : Failed to create socket" . PHP_EOL;
			exit(1);
		}
		socket_set_option($this->socket, SOL_SOCKET, SO_SNDTIMEO, ["sec" => 10, "usec" => 0]);
		socket_set_option($this->socket, SOL_SOCKET, SO_RCVTIMEO, ["sec" => 10, "usec" => 0]);
		if (@socket_connect($this->socket, $this->ipaddress, $this->port) === false) {
			echo "- Error : Failed to connect to " . $this->ipaddress . ":" . $this->port . PHP_EOL;
			exit(1);
		}
	}

	public function run(): void
	{
		$packet = new DingPacket();
		$packet->addDataPacket(new CreateSessionRequestPacket(Utils::getGlobal(), $this->port, "Test Client"));
		$packet->encode();
		$this->send($packet);
	}

	private function send(DingPacket $packet): void
	{
		$buffer = $packet->getBuffer();
		if (socket_write($this->socket, $buffer, strlen($buffer)) === false) {
			echo " - Failed."  . PHP_EOL;
			exit(1);
		} else {
			echo " - Successful! > " . strlen($buffer) . "bytes" . PHP_EOL;
		}

		if (($buffer = socket_read($this->socket, 1024 ^ 2 * 5)) !== false) {
			$packet = new DongPacket();
			$packet->setBuffer($buffer);
			$packet->decode();
			$this->handlePacket($packet);
		}
	}

	private function handlePacket(Packet $packet): void
	{
		$packets = $packet->getDataPackets();
		foreach ($packets as $dataPacket) {
			$this->handleDataPacket($dataPacket);
		}
	}

	private function handleDataPacket(DataPacket $packet): void
	{
		if ($packet->getType() === PacketType::TYPE_DONG) {
			switch ($packet->getId()) {
				case PacketType::PACKET_CREATE_SESSION_ACCEPT:
					echo " - Connected!" . PHP_EOL;
					break;
				default:
					echo " - Unknown packet received" . PHP_EOL;
					break;
			}
		}
	}
}

$client = new Client("127.0.0.1", 8080);
$client->connect();
$client->run();
