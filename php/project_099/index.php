<?php
// API Versioning
$uri = $_SERVER['REQUEST_URI'];
if (preg_match('#/api/v1/#', $uri)) {
    echo json_encode(['version'=>'v1','msg'=>'Hello from API v1']);
} elseif (preg_match('#/api/v2/#', $uri)) {
    echo json_encode(['version'=>'v2','msg'=>'Hello from API v2']);
} else {
    echo json_encode(['error'=>'Invalid API version']);
}
