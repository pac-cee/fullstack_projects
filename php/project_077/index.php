<?php
// REST API Rate Limiter Middleware
$ip = $_SERVER['REMOTE_ADDR'] ?? 'cli';
$file = 'api_rate.json';
$limit = 10; $window = 60;
$data = file_exists($file) ? json_decode(file_get_contents($file),true) : [];
$data[$ip] = array_filter($data[$ip] ?? [], function($t){return $t > time()-$window;});
if (count($data[$ip]) >= $limit) {
    http_response_code(429); echo json_encode(['error'=>'Rate limit exceeded']); exit;
}
$data[$ip][] = time();
file_put_contents($file, json_encode($data));
// API logic here:
echo json_encode(['status'=>'ok']);
