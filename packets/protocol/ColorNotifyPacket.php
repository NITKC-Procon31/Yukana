<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

use yukana\DingDong\utils\Color;

class ColorNotifyPacket extends DataPacket
{
    private $color;

    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    public function getColor(): Color
    {
        return $this->color;
    }

    public function setColor(Color $color): void
    {
        $this->color = $color;
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
        $this->putUnsignedByte(3);
        foreach ($this->color->toArray() as $color) {
            $this->putUnsignedByte($color);
        }
    }

    public function decode(): void
    {
        parent::decode();
        $count = $this->getUnsignedByte();
        $color = [];
        while ($count--) {
            $color[] = $this->getUnsignedByte();
        }
        $this->color = Color::fromArray($color);
    }
}
