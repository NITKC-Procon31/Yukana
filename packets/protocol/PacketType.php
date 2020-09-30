<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;

interface PacketType
{
    /**
     * The constants specify the type of DataPacket.
     * As an example, if you want to use DataPacket only as DingPacket,
     * specify 'TYPE_DING' type.
     */
    public const TYPE_DING = 0;
    public const TYPE_DONG = 1;
    public const TYPE_COMMON = 2;
    
}
