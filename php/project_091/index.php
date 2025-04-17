<?php
// OAuth2 Resource Server
// Requires: composer require firebase/php-jwt
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
$auth = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
if (preg_match('/Bearer (.+)/', $auth, $m)) {
    $token = $m[1];
    try {
        $key = 'secret'; // Use your real secret
        $decoded = JWT::decode($token, $key, ['HS256']);
        echo json_encode(['status'=>'ok','user'=>$decoded->sub]);
    } catch(Exception $e) {
        http_response_code(401); echo json_encode(['error'=>'Invalid token']);
    }
} else {
    http_response_code(401); echo json_encode(['error'=>'Missing Bearer token']);
}
