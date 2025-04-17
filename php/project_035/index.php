<?php
header('Content-Type: application/json');
$tasks = [ ['id'=>1,'task'=>'Buy milk'], ['id'=>2,'task'=>'Read book'] ];
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'GET') {
    echo json_encode($tasks);
} elseif ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $tasks[] = ['id'=>count($tasks)+1, 'task'=>$data['task']??''];
    echo json_encode(['status'=>'created','tasks'=>$tasks]);
} else {
    http_response_code(405);
    echo json_encode(['error'=>'Method not allowed']);
}
