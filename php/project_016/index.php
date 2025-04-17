<?php

$email = $argv[1] ?? '';
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "$email is a valid email.\n";
} else {
    echo "$email is invalid.\n";
}
