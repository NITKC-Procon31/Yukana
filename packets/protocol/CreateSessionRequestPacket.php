<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class CreateSessionRequestPacket extends DataPacket implements PacketType
{
	private $ipaddress;
	private $port;
	private $name;

	public function __construct(string $ipaddress = "", int $port = 0, string $name = "")
	{
		$this->ipaddress = $ipaddress;
		$this->port = $port;
		$this->name = $name;
	}

	public function getAddress(): string
	{
		return $this->ipaddress;
	}

	public function setAddress(string $ipaddress): void
	{
		$this->ipaddress = $ipaddress;
	}

	public function getPort(): int
	{
		return $this->port;
	}

	public function setPort(int $port): void
	{
		$this->port = $port;
	}

	public function getClientName(): string
	{
		return $this->name;
	}

	public function setClientName(string $name): void
	{
		$this->name = $name;
	}

	public function getId(): int
	{
		return PacketType::PACKET_CREATE_SESSION_REQUEST;
	}

	public function getName(): string
	{
		return "CreateSessionRequestPacket";
	}

	public function getType(): int
	{
		return PacketType::TYPE_DING;
	}

	public function encode(): void
	{
		parent::encode();
		$this->putString($this->ipaddress);
		$this->putInt($this->port);
		$this->putString($this->name);
	}

	public function decode(): void
	{
		parent::decode();
		$this->ipaddress = $this->getString();
		$this->port = $this->getInt();
		$this->name = $this->getString();
	}
}
