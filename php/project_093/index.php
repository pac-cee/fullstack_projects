<?php
// Distributed Locking with Redis
// Requires: composer require predis/predis
require 'vendor/autoload.php';
$redis = new Predis\Client();
$key = 'lock:resource';
$token = uniqid();
$acquired = $redis->set($key, $token, 'NX', 'EX', 10); // 10s lock
if ($acquired) {
    echo 'Lock acquired. Running critical section...';
    sleep(3); // Simulate work
    if ($redis->get($key) === $token) $redis->del($key);
    echo ' Done.';
} else {
    echo 'Could not acquire lock.';
}
