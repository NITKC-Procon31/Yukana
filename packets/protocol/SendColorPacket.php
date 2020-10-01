<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

use yukana\DingDong\utils\Color;

class SendColorPacket extends DataPacket
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
        return PacketType::PACKET_SEND_COLOR;
    }

    public function getName(): string
    {
        return "SendColorPacket";
    }

    public function getType(): int
    {
        return PacketType::TYPE_DING;
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
