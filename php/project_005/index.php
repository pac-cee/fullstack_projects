<?php

$hour = (int)date('H');

if ($hour < 12) {
    $greeting = 'Good morning';
} elseif ($hour < 18) {
    $greeting = 'Good afternoon';
} else {
    $greeting = 'Good evening';
}

echo "$greeting! The time is " . date('H:i') . "\n";
