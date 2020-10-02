<?php

namespace yukana\DingDong\packets;

use yukana\DingDong\utils\Binary;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketPool;

use yukana\DingDong\packets\exception\InvalidPacketException;

abstract class Packet extends Binary
{
    public const NUM_MAGIC = [0x0f, 0x03, 0x0b, 0x08];
    private $isEncoded;

    private $dataPackets = [];

    public function addDataPacket(DataPacket $dataPacket): void
    {
        $dataPacket->encode();
        $this->dataPackets[] = $dataPacket;
    }

    public function getDataPackets(): array
    {
        return $this->dataPackets;
    }

    public function encode(): void
    {
        $this->reset();
        $this->isEncoded = true;
        foreach (self::NUM_MAGIC as $magic) {
            $this->putUnsignedByte($magic);
        }

        $this->putUnsignedByte(count($this->dataPackets));
        foreach ($this->dataPackets as $dataPacket) {
            $dataPacket->encode();
            $this->putString($dataPacket->getBuffer());
        }
    }

    public function decode(): void
    {
        $this->isEncoded = false;
        foreach (self::NUM_MAGIC as $magic) {
            if ($this->getUnsignedByte() !== $magic) {
                throw new InvalidPacketException("Invalied Packet Received");
            }
        }

        $pieces = $this->getUnsignedByte();
        for ($i = $pieces; $i > 0; $i--) {
            $buffer = $this->getString();
            $id = ord($buffer{0});
            $class = PacketPool::getPacketFromId($id);
            $packet = new $class;
            $packet->setBuffer($buffer);
            $packet->decode();
            $this->dataPackets[] = $packet;
        }
    }

    abstract public function getName(): string;
}
