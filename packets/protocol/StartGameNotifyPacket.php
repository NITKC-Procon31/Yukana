<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class StartGameNotifyPacket extends DataPacket
{
    private $timestamp;

    public function __construct(int $timestamp = 0)
    {
        $this->timestamp = $timestamp;
    }

    public function getTimeStamp(): int
    {
        return $this->timestamp;
    }

    public function setTimeStamp(int $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function getId(): int
    {
        return PacketType::PACKET_START_GAME;
    }

    public function getName(): string
    {
        return "StartGameNotifyPacket";
    }

    public function getType(): int
    {
        return PacketType::TYPE_DONG;
    }

    public function encode(): void
    {
        parent::encode();
        $this->putInt($this->timestamp);
    }

    public function decode(): void
    {
        parent::decode();
        $this->timestamp = $this->getInt();
    }
}
