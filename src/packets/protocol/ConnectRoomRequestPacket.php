<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class ConnectRoomRequestPacket extends DataPacket
{
    private $viewerId;
    private $userId;

    public function __construct(int $viewerId = 0, int $userId = 0)
    {
        $this->viewerId = $viewerId;
        $this->userId = $userId;
    }

    public function getViewerId(): int
    {
        return $this->viewerId;
    }

    public function setViewerId(int $id): void
    {
        $this->viewerId = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $id): void
    {
        $this->userId = $id;
    }

    public function getId(): int
    {
        return PacketType::PACKET_CONNECT_ROOM_REQUEST;
    }

    public function getName(): string
    {
        return "ConnectRoomRequestPacket";
    }

    public function getType(): int
    {
        return PacketType::TYPE_DING;
    }

    public function encode(): void
    {
        parent::encode();
        $this->putInt($this->viewerId);
        $this->putInt($this->userId);
    }

    public function decode(): void
    {
        parent::decode();
        $this->viewerId = $this->getInt();
        $this->userId = $this->getInt();
    }
}
