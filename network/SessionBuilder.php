<?php

namespace yukana\DingDong\network;

use yukana\DingDong\utils\Address;

use yukana\DingDong\network\Session;
use yukana\DingDong\network\SessionCaretaker;

class SessionBuilder
{
	private static $instance;

	public function __construct()
	{
		self::$instance = $this;
	}

	public static function createNewSession(Address $address, string $name): int
	{
		return SessionCaretaker::addNewSession(new Session($address, $name, SessionCaretaker::getNextId()));
	}
}
