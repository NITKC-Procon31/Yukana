<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class LeaveRoomPacket extends DataPacket
{
    private $roomId;

    public function __construct(int $roomId = 0)
    {
        $this->roomId = $roomId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function setRoomId(int $id): void
    {
        $this->roomId = $id;
    }

    public function getId(): int
    {
        return PacketType::PACKET_LEAVE_ROOM;
    }

    public function getName(): string
    {
        return "LeaveRoomPacket";
    }

    public function getType(): int
    {
        return PacketType::TYPE_DING;
    }

    public function encode(): void
    {
        parent::encode();
        $this->putShort($this->roomId);
    }

    public function decode(): void
    {
        parent::decode();
        $this->roomId = $this->getShort();
    }
}
