<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

class PacketPool implements PacketType
{
    private static $packets = [];

    public static function registerPacket(string $packet, int $id)
    {
        self::$packets[$id] = $packet;
    }

    public static function getPacketFromId(int $id): ?string
    {
        if (isset(self::$packets[$id])) {
            return self::$packets[$id];
        }
        return null;
    }

    public static function registerPackets(): void
    {
        // TODO
    }
}
