<?php
// Secure File Download
session_start();
$logged_in = $_SESSION['user'] ?? false;
$file = $_GET['file'] ?? '';
if ($file && $logged_in) {
    $path = __DIR__.'/files/'.basename($file);
    if (file_exists($path)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($path).'"');
        readfile($path); exit;
    }
}
if (!$logged_in) echo 'Please log in to download files.';
