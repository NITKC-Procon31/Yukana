<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class LeaveRoomNotifyPacket extends DataPacket
{
    private $viewerId;

    public function __construct(int $viewerId = 0)
    {
        $this->viewerId = $viewerId;
    }

    public function getViewerId(): int
    {
        return $this->viewerId;
    }

    public function setViewerId(int $id): void
    {
        $this->viewerId = $id;
    }

    public function getId(): int
    {
        return PacketType::PACKET_LEAVE_ROOM_NOTIFY;
    }

    public function getName(): string
    {
        return "LeaveRoomNotifyPacket";
    }

    public function getType(): int
    {
        return PacketType::TYPE_DONG;
    }

    public function encode(): void
    {
        parent::encode();
        $this->putInt($this->viewerId);
    }

    public function decode(): void
    {
        parent::decode();
        $this->viewerId = $this->getInt();
    }
}
