<?php

namespace yukana\DingDong\packets\protocol;

use yukana\DingDong\utils\Binary;

abstract class DataPacket extends Binary
{
    private $isEncoded;

    public function __construct()
    {
        parent::__construct();
    }

    public function encode(): void
    {
        $this->reset();
        $this->putInt($this->getId());
        $this->isEncoded = true;
    }

    public function decode(): void
    {
        $id = $this->getInt();
        $this->isEncoded = false;
    }

    abstract public function getId(): int;

    abstract public function getName(): string;

    abstract public function getType(): int;
}
