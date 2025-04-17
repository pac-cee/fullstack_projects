<?php
$routes = [
    '/' => function() { echo 'Home'; },
    '/about' => function() { echo 'About'; },
];
$uri = strtok($_SERVER['REQUEST_URI'], '?');
if (isset($routes[$uri])) {
    $routes[$uri]();
} else {
    http_response_code(404); echo 'Not Found';
}
