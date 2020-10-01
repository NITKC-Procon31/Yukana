<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\packets\protocol\DataPacket;
use yukana\DingDong\packets\protocol\PacketType;

use yukana\DingDong\packets\exception\InvaliedRoleException;

class SetRolePacket extends DataPacket
{
    private $role;

    public function __construct(int $role = 0)
    {
        $this->role = $role;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole(int $role): void
    {
        if (0 <= $role && $role <= 1) {
            $this->role = $role;
        } else {
            throw new InvaliedRoleException("Invalied role {$role}");
        }
    }

    public function getId(): int
    {
        return PacketType::PACKET_SET_ROLE;
    }

    public function getName(): string
    {
        return "SetRolePacket";
    }

    public function getType(): int
    {
        return PacketType::TYPE_DONG;
    }

    public function encode(): void
    {
        parent::encode();
        $this->putShort($this->role);
    }

    public function decode(): void
    {
        parent::decode();
        $this->role = $this->getShort();
    }
}
