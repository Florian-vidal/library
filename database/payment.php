<?php
require_once ('panier.php');
$token = $_POST['stripeToken'];
$email = $_POST['email'];
$name = $_POST['username'];
echo $totalPrice = $_GET['totalPrice'];

if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($name) && !empty($token)) {
    require ('Stripe.php');
    $stripe = new Stripe('sk_test_sIEwF2S5Ta64BCU5QSU0YroJ00m68lQX8I');
    $customer = $stripe->api('customers', [
        'source' => $token,
        'description' => $name,
        'email' => $email
    ]);
    $stripe->api('charges', [
        'amount' => $totalPrice * 100,
        'currency' => 'eur',
        'customer' => $customer->id

    ]);

    $newOrder = new Panier();
    $newOrder->createOrder($_GET['panierId']);
}