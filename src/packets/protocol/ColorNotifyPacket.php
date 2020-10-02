<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class ColorNotifyPacket extends DataPacket
{
    private $colorId;

    public function __construct(int $id = 0)
    {
        $this->colorId = $id;
    }

    public function getColorId(): int
    {
        return $this->colorId;
    }

    public function setColorId(int $id): void
    {
        $this->colorId = $id;
    }

    public function getId(): int
    {
        return PacketType::PACKET_COLOR_NOTIFY;
    }

    public function getName(): string
    {
        return "ColorNotifyPacket";
    }

    public function getType(): int
    {
        return PacketType::TYPE_DONG;
    }

    public function encode(): void
    {
        parent::encode();
        $this->putUnsignedShort($this->colorId);
    }

    public function decode(): void
    {
        parent::decode();
        $this->colorId = $this->getUnsignedShort();
    }
}
