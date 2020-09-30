<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;

interface PacketType
{
    public const TYPE_DING   = 0;
    public const TYPE_DONG   = 1;
    public const TYPE_COMMON = 2;

    public const PACKET_CONNECT_ROOM_REQUEST          = 0x01;
    public const PACKET_CONNECT_ROOM_REPLY            = 0x02;
    public const PACKET_LEAVE_ROOM                    = 0x03;
    public const PACKET_LEAVE_ROOM_NOTIFY             = 0x04;
    public const PACKET_ROOM_INFORMATION_REQUEST      = 0x05;
    public const PACKET_ROOM_INFORMATION_REPLY        = 0x06;
    public const PACKET_SET_ROLE                      = 0x07;
    public const PACKET_SEND_COLOR                    = 0x08;
    public const PACKET_COLOR_NOTIFY                  = 0x09;
    public const PACKET_CORRECT_ANSWER                = 0x10;
    public const PACKET_START_GAME                    = 0x0a;
    public const PACKET_TIMEOUT_NOTIFY                = 0x0b;
}
