<?php

use yukana\DingDong\Server;

use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;

require_once __DIR__ . "/vendor/autoload.php";

define("DEBUG", true);

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Server()
            )
        ),
    37564
);

$server->run();
