<?php
// Payment Webhook Simulator
$url = $_POST['url'] ?? '';
$data = $_POST['payload'] ?? '{"event":"payment_intent.succeeded"}';
$result = '';
if ($url) {
    $opts = ['http'=>['method'=>'POST','header'=>'Content-Type: application/json','content'=>$data]];
    $ctx = stream_context_create($opts);
    $resp = file_get_contents($url, false, $ctx);
    $result = 'Webhook sent! Response: '.htmlspecialchars($resp);
}
?>
<form method="post">
<input name="url" placeholder="Listener URL">
<textarea name="payload">{"event":"payment_intent.succeeded"}</textarea>
<button>Send Webhook</button>
</form>
<?=$result?>
