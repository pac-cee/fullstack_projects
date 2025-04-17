<?php
// Requires: composer require stripe/stripe-php
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_yourkey'); // Replace with your Stripe test key
$msg = '';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    try {
        $payment = \Stripe\Charge::create([
            'amount' => 1000,
            'currency' => 'usd',
            'source' => $_POST['stripeToken'],
            'description' => 'Test Charge',
        ]);
        $msg = 'Payment successful!';
    } catch(Exception $e) { $msg = $e->getMessage(); }
}
?>
<form method="post">
<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="pk_test_yourkey" data-amount="1000" data-name="Test Charge" data-currency="usd"></script>
</form>
<?=$msg?>
