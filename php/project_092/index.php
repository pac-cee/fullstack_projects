<?php
// API Gateway
$routes = [
    '/service1' => 'http://localhost:8001',
    '/service2' => 'http://localhost:8002',
];
$uri = strtok($_SERVER['REQUEST_URI'], '?');
foreach ($routes as $prefix => $backend) {
    if (strpos($uri, $prefix) === 0) {
        $url = $backend . substr($uri, strlen($prefix));
        $opts = ['http'=>['method'=>$_SERVER['REQUEST_METHOD'],'header'=>getallheaders()]];
        $ctx = stream_context_create($opts);
        $resp = file_get_contents($url, false, $ctx);
        echo $resp;
        exit;
    }
}
echo 'No matching backend.';
