<?php

namespace yukana\DingDong\utils;

class BinaryUtil
{
    public static function signInt8(int $value): int
    {
        return $value << 56 >> 56;
    }

    public static function unsignInt8(int $value): int
    {
        return $value & 0xff;
    }

    public static function signInt16(int $value): int
    {
        return $value << 48 >> 48;
    }

    public static function unsignInt16(int $value): int
    {
        return $value & 0xffff;
    }

    public static function signInt32(int $value): int
    {
        return $value << 32 >> 32;
    }

    public static function unsignInt32(int $value): int
    {
        return $value & 0xffffff;
    }

    public static function writeUint8(int $value): string
    {
        return chr($value);
    }

    public static function writeUint16(int $value): string
    {
        return pack("n", $value);
    }

    public static function writeUint32(int $value): string
    {
        return pack("N", $value);
    }

    public static function readUint8(string $c): int
    {
        return ord($c[0]);
    }

    public static function readUint16(string $string): int
    {
        return unpack("n", $string)[1];
    }

    public static function readUint32(string $string): int
    {
        return unpack("N", $string)[1];
    }

    public static function writeInt8(int $value): string
    {
        return self::writeUint8($value);
    }

    public static function writeInt16(int $value): string
    {
        return self::writeUint16($value);
    }

    public static function writeInt32(int $value): string
    {
        return self::writeUint32($value);
    }

    public static function readInt8(string $string): int
    {
        return self::signInt8(self::readUint8($string));
    }

    public static function readInt16(string $string): int
    {
        return self::signInt16(self::readUint16($string));
    }

    public static function readInt32(string $string): int
    {
        return self::signInt32(self::readUint32($string));
    }
}
