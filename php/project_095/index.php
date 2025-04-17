<?php
// Rate-Limited Email Sender
// Requires: mail() setup
$ip = $_SERVER['REMOTE_ADDR'] ?? 'cli';
$file = 'email_limit.json';
$limit = 3; $window = 60*60; // 3 emails/hour
$data = file_exists($file) ? json_decode(file_get_contents($file),true) : [];
$data[$ip] = array_filter($data[$ip] ?? [], function($t){return $t > time()-$window;});
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['to'], $_POST['msg'])) {
    if (count($data[$ip]) >= $limit) {
        $msg = 'Rate limit exceeded.';
    } else {
        mail($_POST['to'], 'Test Email', $_POST['msg']);
        $data[$ip][] = time();
        file_put_contents($file, json_encode($data));
        $msg = 'Email sent!';
    }
}
?>
<form method="post">
<input name="to" placeholder="Recipient email">
<textarea name="msg" placeholder="Message"></textarea>
<button>Send Email</button>
</form>
<?=$msg?>
