<?php

$amount = 1234567.8910;
$formatted = '$' . number_format($amount, 2, '.', ',');
echo "Formatted: {$formatted}\n";
