<?php

namespace yukana\DingDong\utils;

use yukana\DingDong\utils\BinaryUtil;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketPool;

class Binary
{
    private $buffer;
    private $offset;

    public function __construct(string $buffer = "", int $offset = 0)
    {
        $this->buffer = $buffer;
        $this->offset = 0;
    }

    public function getBuffer(): string
    {
        return $this->buffer;
    }

    public function setBuffer(string $buffer): void
    {
        $this->buffer = $buffer;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function put(string $string): void
    {
        $this->buffer .= $string;
    }

    public function get(int $length): string
    {
        if ($length < 0) {
            $this->offset = strlen($this->buffer) - 1;
            return "";
        } elseif ($length === 0) {
            return "";
        }

        return $length == 1 ? $this->buffer{$this->offset++} : substr($this->buffer, ($this->offset += $length) - $length, $length);
    }

    public function reset(): void
    {
        $this->buffer = "";
        $this->offset = 0;
    }

    public function putByte(int $value): void
    {
        $this->buffer .= BinaryUtil::writeInt8($value);
    }

    public function putShort(int $value): void
    {
        $this->buffer .= BinaryUtil::writeInt16($value);
    }

    public function putInt(int $value): void
    {
        $this->buffer .= BinaryUtil::writeInt32($value);
    }

    public function getByte(): int
    {
        return BinaryUtil::readInt8($this->get(1));
    }

    public function getShort(): int
    {
        return BinaryUtil::readInt16($this->get(2));
    }

    public function getInt(): int
    {
        return BinaryUtil::readInt32($this->get(4));
    }

    public function putUnsignedByte(int $value): void
    {
        $this->buffer .= BinaryUtil::writeUint8($value);
    }

    public function putUnsignedShort(int $value): void
    {
        $this->buffer .= BinaryUtil::writeUint16($value);
    }

    public function putUnsignedInt(int $value): void
    {
        $this->buffer .= BinaryUtil::writeUint32($value);
    }

    public function getUnsignedByte(): int
    {
        return BinaryUtil::readUint8($this->get(1));
    }

    public function getUnsignedShort(): int
    {
        return BinaryUtil::readUint16($this->get(2));
    }

    public function getUnsignedInt(): int
    {
        return BinaryUtil::readUint32($this->get(4));
    }

    public function putString(string $string): void
    {
        $array = unpack("C*", $string);
        $this->putUnsignedShort(count($array));
        foreach ($array as $value) {
            $this->putUnsignedByte($value);
        }
    }

    public function getString(): string
    {
        $count = $this->getUnsignedShort();
        $str = "";

        for ($i = 0; $i < $count; $i++) {
            $str .= pack("C", $this->getUnsignedByte());
        }

        return $str;
    }

    public function putPacket(DataPacket $packet): void
    {
        $length = $packet->getLength();
        $this->putUnsignedShort($length);
        while ($length--) {
            $this->putUnsignedByte($packet->getUnsignedByte());
        }
    }

    public function getPacket(): DataPacket
    {
        $length = $this->getUnsignedShort();
        $binary = new Binary();
        for ($i = 0; $i < $length; $i++) {
            $binary->putUnsignedByte($this->getUnsignedByte());
        }
        $id = $binary->getInt();
        $class = PacketPool::getPacketFromId($id);
        $packet = new $class;
        $packet->setBuffer($binary->getBuffer());

        return $packet;
    }

    public function putBool(bool $bool): void
    {
        $this->putUnsignedByte($bool);
    }

    public function getBool(): bool
    {
        return $this->getUnsignedByte();
    }

    public function getLength(): int
    {
        return strlen($this->buffer);
    }

}
