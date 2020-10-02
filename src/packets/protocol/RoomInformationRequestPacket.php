<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class RoomInformationRequestPacket extends DataPacket
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
        return PacketType::PACKET_ROOM_INFORMATION_REQUEST;
    }

    public function getName(): string
    {
        return "RoomInformationRequestPacket";
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
