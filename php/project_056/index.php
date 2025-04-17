<?php
$ip = $_SERVER['REMOTE_ADDR'] ?? 'cli';
$file = 'rate_limit.json';
$limit = 5; $window = 60; // 5 req/min
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$data[$ip] = array_filter($data[$ip] ?? [], function($t){return $t > time()-$window;});
if (count($data[$ip]) >= $limit) {
    http_response_code(429); echo 'Rate limit exceeded.'; exit;
}
$data[$ip][] = time();
file_put_contents($file, json_encode($data));
echo 'Request allowed.';
