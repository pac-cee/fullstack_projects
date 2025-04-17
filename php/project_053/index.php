<?php
// Requires: composer require endroid/qr-code
require_once __DIR__.'/vendor/autoload.php';
use Endroid\QrCode\QrCode;
$text = $_POST['text'] ?? '';
$img = '';
if ($text) {
    $qr = new QrCode($text);
    $img = base64_encode($qr->writeString());
}
?><form method="post">
<input name="text" placeholder="Text"><button>Generate</button>
</form>
<?php if($img): ?>
<img src="data:image/png;base64,<?=$img?>">
<?php endif; ?>
