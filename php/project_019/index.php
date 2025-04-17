<?php

// project_019: Session Counter
session_start();

if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 0;
}
$_SESSION['visits']++;

echo "You have visited this page {$_SESSION['visits']} times (session).\n";
