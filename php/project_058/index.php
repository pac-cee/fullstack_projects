<?php
// Simple micro-framework skeleton
$routes = [
    '/' => function() { echo 'Welcome Home!'; },
    '/about' => function() { echo 'About Page'; },
];
$uri = strtok($_SERVER['REQUEST_URI'], '?');
if (isset($routes[$uri])) {
    $routes[$uri]();
} else {
    http_response_code(404); echo 'Not Found';
}
