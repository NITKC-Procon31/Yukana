<?php

namespace yukana\DingDong\network;

use yukana\DingDong\network\Session;

use yukana\DingDong\network\exception\SessionException;

class SessionCaretaker
{
	protected static $sessions = [];
	protected static $id = 0;

	public static function addNewSession(Session $session): int
	{
		$id = self::$id++;
		self::$sessions[$id] = $session;
		return $id;
	}

	public static function removeSession(int $id): void
	{
		if(!isset(self::$sessions[$id])){
			throw new SessionException("The id does not exist.");
		}

		unset(self::$sessions[$id]);
	}

	public static function getSession(int $id): Session
	{
		if(!isset(self::$sessions[$id])){
			throw new SessionException("The id does not exist.");
		}

		return self::$sessions[$id];
	}

	public static function getNextId(): int
	{
		$id = self::$id;
		return $id++;
	}
}
