<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class ConnectRoomReplyPacket extends DataPacket
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
        return PacketType::PACKET_CONNECT_ROOM_REPLY;
    }

    public function getName(): string
    {
        return "ConnectRoomReplyPacket";
    }

    public function getType(): int
    {
        return PacketType::TYPE_DONG;
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
