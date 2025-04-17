<?php
// Requires: composer require predis/predis
require 'vendor/autoload.php';
$redis = new Predis\Client();
echo "Waiting for jobs...\n";
while (true) {
    $job = $redis->blpop('jobs', 0);
    echo "Processing job: ".$job[1]."\n";
    // Simulate job processing
    sleep(1);
}
