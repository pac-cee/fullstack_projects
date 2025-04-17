<?php

$user = [
    'name' => 'Alice',
    'age' => 25,
    'email' => 'alice@example.com'
];

foreach ($user as $key => $value) {
    echo ucfirst($key) . ": $value\n";
}
