<?php
// Requires: composer require predis/predis
require 'vendor/autoload.php';
$redis = new Predis\Client();
$job = $_POST['job'] ?? '';
if ($job) {
    $redis->rpush('jobs', $job);
    echo 'Job enqueued!';
}
?><form method="post">
<input name="job" placeholder="Job data"><button>Enqueue</button>
</form>
