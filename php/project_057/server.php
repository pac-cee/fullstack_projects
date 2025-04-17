<?php
// Requires: composer require cboden/ratchet
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
require __DIR__.'/vendor/autoload.php';

class Chat implements MessageComponentInterface {
    protected $clients;
    public function __construct() { $this->clients = new \SplObjectStorage; }
    public function onOpen(ConnectionInterface $conn) { $this->clients->attach($conn); }
    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }
    public function onClose(ConnectionInterface $conn) { $this->clients->detach($conn); }
    public function onError(ConnectionInterface $conn, \Exception $e) { $conn->close(); }
}
$server = IoServer::factory(new WsServer(new Chat()), 8080);
$server->run();
