<?php
// Token bucket rate limiter
$ip = $_SERVER['REMOTE_ADDR'] ?? 'cli';
$file = 'buckets.json';
$rate = 5; $burst = 10; $window = 60;
$data = file_exists($file) ? json_decode(file_get_contents($file),true) : [];
$bucket = $data[$ip] ?? ['tokens'=>$burst,'time'=>time()];
$now = time();
$elapsed = $now - $bucket['time'];
$bucket['tokens'] = min($burst, $bucket['tokens'] + $rate * $elapsed / $window);
$bucket['time'] = $now;
if ($bucket['tokens'] < 1) { http_response_code(429); echo 'Rate limit exceeded.'; } else {
    $bucket['tokens'] -= 1;
    echo 'Request allowed.';
}
$data[$ip] = $bucket;
file_put_contents($file, json_encode($data));
