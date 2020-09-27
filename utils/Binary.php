<?php

namespace yukana\DingDong\utils;

use yukana\DingDong\utils\BinaryUtil;

class Binary
{
	private $buffer;
	private $offset;

	public function __construct(string $buffer = "", int $offset = 0)
	{
		$this->buffer = $buffer;
		$this->offset = 0;
	}

	public function getBuffer(): string
	{
		return $this->buffer;
	}

	public function setBuffer(string $buffer): void
	{
		$this->buffer = $buffer;
	}

	public function getOffset(): int
	{
		return $this->offset;
	}

	public function setOffset(int $offset): void
	{
		$this->offset = $offset;
	}

	public function put(string $string): void
	{
		$this->buffer .= $string;
	}

	public function get($length): string
	{
		if ($length === true) {
			$string = substr($this->buffer, $this->offset);
			$this->offset = strlen($this->buffer);
			return $string;
		} elseif ($length < 0) {
			$this->offset = strlen($this->buffer) - 1;
			return "";
		} elseif ($length === 0) {
			return "";
		}

		return $length === 1 ? $this->buffer{$this->offset++} : substr($this->buffer, ($this->offset += $length) - $length, $length);
	}

	public function reset(): void
	{
		$this->buffer = "";
		$this->offset = 0;
	}

	public function putInt(int $value): void
	{
		$this->buffer .= BinaryUtil::writeInt($value);
	}

	public function getInt(): int
	{
		return BinaryUtil::readInt($this->get(4));
	}

	public function putString(string $string): void
	{
		$this->putUnsignedVarInt(strlen($string));
		$this->put($string);
	}

	public function getString(): string
	{
		return $this->get($this->getUnsignedVarInt());
	}

	public function getUnsignedVarInt(): int
	{
		return BinaryUtil::readUnsignedVarInt($this->buffer, $this->offset);
	}

	public function putUnsignedVarInt(int $value): void
	{
		$this->put(BinaryUtil::writeUnsignedVarInt($value));
	}

	public function getLength(): int
	{
		return strlen($this->buffer);
	}
}
