<?php

namespace yukana\DingDong\utils;

class Color
{
    public $r, $g, $b;

    public function __construct(int $r = 0, int $g = 0, int $b = 0)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
    }

    public static function fromArray(array $rgb): Color
    {
        return new Color($rgb[0], $rgb[1], $rgb[2]);
    }

    public function toArray(): array
    {
        return [$this->r, $this->g, $this->b];
    }

    public function setRGB(int $r, int $g, int $b): void
    {
        $this->r = $r;
        $this->g = $g;
        $tihs->b = $b;
    }

    public function setRed(int $r): void
    {
        $this->r = $r;
    }

    public function setGreen(int $g): void
    {
        $this->g = $g;
    }

    public function setBlue(int $b): void
    {
        $this->b = $b;
    }

    public function getRed(): int
    {
        return $this->r;
    }

    public function getGreen(): int
    {
        return $this->g;
    }

    public function getBlue(): int
    {
        return $this->b;
    }
}
