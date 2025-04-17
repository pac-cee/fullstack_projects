<?php
// Requires: composer require minishlink/web-push
// This project requires JS service worker and browser setup for full demo
require 'vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
// For brevity, display stub UI:
echo '<p>Register for push notifications in your browser (see README for setup).</p>';
// PHP code to send push (real use: load subscription from DB)
// $webPush = new WebPush(['VAPID' => ['subject'=>'mailto:admin@example.com','publicKey'=>'YOUR_PUBLIC_KEY','privateKey'=>'YOUR_PRIVATE_KEY']]);
// $sub = Subscription::create([...]);
// $webPush->sendNotification($sub, "Hello!");
