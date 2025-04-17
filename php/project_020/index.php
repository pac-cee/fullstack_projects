<?php

// project_020: Basic JSON
$data = [
    'name' => 'Alice',
    'age' => 25,
    'email' => 'alice@example.com'
];

// Encode to JSON
$json = json_encode($data);
echo "JSON: $json\n";

// Decode back to PHP array
$decoded = json_decode($json, true);
echo "Decoded array:\n";
print_r($decoded);
