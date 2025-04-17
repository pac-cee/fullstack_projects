<?php

// project_017: Simple Login CLI

$username = readline('Username: ');
$password = readline('Password: ');

if ($username === 'admin' && $password === 'secret') {
    echo "Login successful\n";
} else {
    echo "Invalid credentials\n";
}
