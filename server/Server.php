<?php

declare(ticks = 1);

namespace yukana\DingDong\server;

use yukana\DingDong\packets\Packet;
use yukana\DingDong\packets\DingPacket;
use yukana\DingDong\packets\DongPacket;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketPool;
use yukana\DingDong\packets\protocol\PacketType;

use yukana\DingDong\utils\Address;
use yukana\DingDong\utils\Log;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use Ratchet\App;

use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;

require_once __DIR__ . "/../vendor/autoload.php";

class Server implements MessageComponentInterface
{
    protected $clients;

    private $socket;
    private $remote;

    public function __construct()
    {
        Log::showLogo();
        Log::info("サーバを起動しています...");
        $this->clients = new \SplObjectStorage;

        PacketPool::registerPackets();

        Log::success("サーバが正常に起動しました！");
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);

		Log::info("{$conn->resourceId} がサーバに接続しました。");
    }

    public function onMessage(ConnectionInterface $from, $context)
    {
        $numRecv = count($this->clients) - 1;

        $packet = new DingPacket();
        $packet->setBuffer(base64_decode($context));
        $packet->decode();
        $this->handlePacket($packet);

        foreach ($this->clients as $client) {
            $client->send("Hello!");
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);

		Log::info("{$conn->resourceId} がサーバから切断しました。");
    }

    public function onError(ConnectionInterface $conn, \Throwable $e)
    {
		Log::error("不明なエラーが発生しました : {$e->getMessage()}");

        $conn->close();
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
        if ($packet->getType() === PacketType::TYPE_DING) {
            switch ($packet->getId()) {
                default:
					Log::warning("不明なパケットを受信 (" . dechex($packet->getId()) . ")");
                    break;
            }
        }
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Server()
            )
        ),
    37564
);

$server->run();
