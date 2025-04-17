<?php

$str1 = "Hello";
$str2 = "World";
$combined = $str1 . ", " . $str2;

echo "Combined: $combined\n";

echo "Uppercase: " . strtoupper($combined) . "\n";
echo "Lowercase: " . strtolower($combined) . "\n";

echo "Substring(0,5): " . substr($combined, 0, 5) . "\n";
