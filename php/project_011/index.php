<?php

$filename = 'data.txt';

// Write
$handle = fopen($filename, 'w');
fwrite($handle, "Hello from file I/O\n"); 
fclose($handle);

// Read
if (file_exists($filename)) {
    $handle = fopen($filename, 'r');
    echo fread($handle, filesize($filename));
    fclose($handle);
} else {
    echo "File not found.";
}
