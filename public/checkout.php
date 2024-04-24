<?php

require_once '../vendor/autoload.php';
$stripeSecretKey = 'sk_test_51IOywHAnCQA7c8jcD6EsKXe3TwqDrOHTKbNKqeYe2r0mXCTzP7ZWW6pKNABtDOpJ42cWjt3bbDHahEbrXY1rJp1x00cFgncYMD';

\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://127.0.0.1:8001';

$checkout_session = \Stripe\Checkout\Session::create([
  // 'payment_method_types' => ['card', 'alipay'],
  // 'payment_method_types' => ['eps', 'giropay', 'sofort'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'USD',
      // 'currency' => 'EUR',
      'product_data' => [
        'name' => 'T-shirt',
      ],
      'unit_amount' => 900.20*100,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/public/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/public/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);