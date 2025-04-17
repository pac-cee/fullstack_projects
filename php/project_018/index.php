<?php

// project_018: Cookie Counter

$visits = isset($_COOKIE['visits']) ? (int)$_COOKIE['visits'] + 1 : 1;
setcookie('visits', $visits, time() + 3600);

echo "You have visited this page $visits times.\n";
