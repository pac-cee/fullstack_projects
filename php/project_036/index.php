<?php
// For demo, use firebase/php-jwt (composer require firebase/php-jwt)
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;
$key = 'secret';
$payload = ['user_id' => 1, 'exp' => time()+3600];
$jwt = JWT::encode($payload, $key, 'HS256');
echo "Token: $jwt\n";
// To decode: JWT::decode($jwt, new Key($key, 'HS256'));
