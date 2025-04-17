<?php
// Note: This will only work if your server is configured for mail().
$to = 'test@example.com';
$subject = 'Test Email';
$message = 'Hello, this is a test.';
$headers = 'From: sender@example.com';
if (mail($to, $subject, $message, $headers)) {
    echo "Mail sent!\n";
} else {
    echo "Mail failed.\n";
}
