<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51QrcwuLUXdwi5EWDPda7e4lkuYJ4fR29nR7maWrolopV2b3bTbOrGXJDfG5JJjZBm5ZHSwFv8AgqhTXHFfnUQWJK00qWgPGZEO');

$paymentIntent = \Stripe\PaymentIntent::create([
    'amount' => 2000,
    'currency' => 'eur',
]);

try {
    echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
