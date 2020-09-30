<?php

namespace yukana\DingDong\packets;

use yukana\DingDong\packets\Packet;

class DingPacket extends Packet
{
    public function getName(): string
    {
        return "DingPacket";
    }
}
