<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class CorrectAnswerPacket extends DataPacket
{
    private $flag;

    public function __construct(bool $flag)
    {
        $this->flag = $flag;
    }

    public function getFlag(): bool
    {
        return $this->flag;
    }

    public function setFlag(bool $flag): void
    {
        $this->flag = $flag;
    }

    public function getId(): int
    {
        return PacketType::PACKET_CORRECT_ANSWER;
    }

    public function getName(): string
    {
        return "CorrectAnswerPacket";
    }

    public function getType(): int
    {
        return PacketType::TYPE_DING;
    }

    public function encode(): void
    {
        parent::encode();
        $this->putBool($this->flag);
    }

    public function decode(): void
    {
        parent::decode();
        $this->flag = $this->getBool();
    }
}
