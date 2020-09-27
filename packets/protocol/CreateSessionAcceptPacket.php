<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class CreateSessionAcceptPacket extends DataPacket implements PacketType
{
	private $id;

	public function __construct(int $id = 0)
	{
		$this->id = $id;
	}

	public function getSessionId(): int
	{
		return $this->id;
	}

	public function setSessionId(int $id): void
	{
		$this->id = $id;
	}

	public function getId(): int
	{
		return PacketType::PACKET_CREATE_SESSION_ACCEPT;
	}

	public function getName(): string
	{
		return "CreateSessionAcceptPacket";
	}

	public function getType(): int
	{
		return PacketType::TYPE_DONG;
	}

	public function encode(): void
	{
		parent::encode();
		$this->putInt($this->id);
	}

	public function decode(): void
	{
		parent::decode();
		$this->id = $this->getInt();
	}
}
