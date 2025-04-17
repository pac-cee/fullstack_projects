<?php
require_once __DIR__.'/../app/Http/Controllers/HomeController.php';
require_once __DIR__.'/../routes/web.php';
$uri = $_SERVER['REQUEST_URI'];
if (isset($router[$uri])) {
    [$class, $method] = $router[$uri];
    (new $class)->$method();
} else {
    http_response_code(404); echo 'Not Found';
}
