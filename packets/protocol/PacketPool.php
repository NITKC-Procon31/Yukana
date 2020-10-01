<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;
use yukana\DingDong\packets\protocol\ConnectRoomRequestPacket;
use yukana\DingDong\packets\protocol\ConnectRoomReplyPacket;
use yukana\DingDong\packets\protocol\LeaveRoomPacket;
use yukana\DingDong\packets\protocol\LeaveRoomNotifyPacket;
use yukana\DingDong\packets\protocol\RoomInformationRequestPacket;
use yukana\DingDong\packets\protocol\RoomInformationReplyPacket;
use yukana\DingDong\packets\protocol\SetRolePacket;
use yukana\DingDong\packets\protocol\SendColorPacket;
use yukana\DingDong\packets\protocol\ColorNotifyPacket;
use yukana\DingDong\packets\protocol\CorrectAnswerPacket;
use yukana\DingDong\packets\protocol\StartGamePacket;
use yukana\DingDong\packets\protocol\TimeOutNotify;

use yukana\DingDong\utils\Log;

class PacketPool implements PacketType
{
    private static $packets = [];

    public static function registerPacket(string $packet, int $id)
    {
        Log::debug("DataPacket を登録 : {$packet}");
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
        self::registerPacket(ConnectRoomRequestPacket::class, PacketType::PACKET_CONNECT_ROOM_REQUEST);
        self::registerPacket(ConnectRoomReplyPacket::class, PacketType::PACKET_CONNECT_ROOM_REPLY);
        self::registerPacket(LeaveRoomPacket::class, PacketType::PACKET_LEAVE_ROOM);
        self::registerPacket(LeaveRoomNotifyPacket::class, PacketType::PACKET_LEAVE_ROOM_NOTIFY);
        self::registerPacket(RoomInformationRequestPacket::class, PacketType::PACKET_ROOM_INFORMATION_REQUEST);
        self::registerPacket(RoomInformationReplyPacket::class, PacketType::PACKET_ROOM_INFORMATION_REPLY);
        self::registerPacket(SetRolePacket::class, PacketType::PACKET_SET_ROLE);
        self::registerPacket(SendColorPacket::class, PacketType::PACKET_SEND_COLOR);
        self::registerPacket(ColorNotifyPacket::class, PacketType::PACKET_COLOR_NOTIFY);
        self::registerPacket(CorrectAnswerPacket::class, PacketType::PACKET_CORRECT_ANSWER);
        self::registerPacket(StartGamePacket::class, PacketType::PACKET_START_GAME);
        self::registerPacket(TimeOutNotify::class, PacketType::PACKET_TIMEOUT_NOTIFY);
    }
}
