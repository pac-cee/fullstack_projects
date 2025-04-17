<?php
// Multi-factor Authentication (TOTP)
// Requires: composer require spomky-labs/otphp endroid/qr-code
require 'vendor/autoload.php';
use OTPHP\TOTP;
use Endroid\QrCode\QrCode;
$secret = $_SESSION['totp_secret'] ?? '';
if (!$secret) {
    $totp = TOTP::create();
    $secret = $totp->getSecret();
    $_SESSION['totp_secret'] = $secret;
    $qr = new QrCode($totp->getProvisioningUri());
    $img = base64_encode($qr->writeString());
    echo '<img src="data:image/png;base64,'.$img.'">';
    echo '<p>Scan with Google Authenticator.</p>';
} else {
    if (isset($_POST['code'])) {
        $totp = TOTP::create($secret);
        if ($totp->verify($_POST['code'])) {
            echo 'MFA success!';
        } else {
            echo 'Invalid code.';
        }
    }
    echo '<form method="post"><input name="code" placeholder="TOTP Code"><button>Verify</button></form>';
}
