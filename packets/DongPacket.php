<?php

namespace yukana\DingDong\packets;

use yukana\DingDong\packets\Packet;

class DongPacket extends Packet
{
    public function getName(): string
    {
        return "DongPacket";
    }
}
