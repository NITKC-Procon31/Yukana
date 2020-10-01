<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class RoomInformationReplyPacket extends DataPacket
{
    private $roomId;
    private $viewerIdList;

    public function __construct(int $roomId = 0, array $idList = [])
    {
        $this->roomId = $roomId;
        $this->viewerIdList = $idList;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function setRoomId(int $id): void
    {
        $this->roomId = $id;
    }

    public function getViewerIdList(): array
    {
        return $this->viewerIdList;
    }

    public function setViewerIdList(array $idList): void
    {
        $this->viewerIdList = $idList;
    }

    public function addViewerId(int $id): void
    {
        $this->viewerIdList[] = $id;
    }

    public function getId(): int
    {
        return PacketType::PACKET_ROOM_INFORMATION_REPLY;
    }

    public function getName(): string
    {
        return "RoomInformationReply";
    }

    public function getType(): int
    {
        return PacketType::TYPE_DONG;
    }

    public function encode(): void
    {
        parent::encode();
        $this->putShort($this->roomId);
        $this->putUnsignedByte(count($this->viewerIdList));
        foreach ($this->viewerIdList as $viewerId) {
            $this->putInt($viewerId);
        }
    }

    public function decode(): void
    {
        parent::decode();
        $this->roomId = $this->getShort();
        $count = $this->getUnsignedByte();
        while ($count--) {
            $this->viewerIdList[] = $this->getInt();
        }
    }
}
