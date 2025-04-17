<?php
// Webhook Listener
$file = 'webhooks.log';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = file_get_contents('php://input');
    file_put_contents($file, date('c')." ".$payload."\n", FILE_APPEND);
    echo 'Webhook received!';
    exit;
}
$log = file_exists($file) ? file($file) : [];
echo '<h2>Recent Webhooks</h2><pre>'.htmlspecialchars(implode('', array_slice($log, -10))).'</pre>';
