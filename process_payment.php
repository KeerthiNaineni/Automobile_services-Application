<?php
require('stripe-php-master/init.php'); // Make sure this path is correct
\Stripe\Stripe::setVerifySslCerts(false);

// Set your Stripe secret key
\Stripe\Stripe::setApiKey('sk_test_51QIn3EG0eRElWoCTv7e1d4SCXPG3e2fKqK4cWfNLa13ZjFSWQF4BEq273D1zABwNNtlm3rQexN1y8G28JWrioo6Q009ETfep6N'); 

// Get amount and username from the form
$amount = $_POST['amount']; // Amount in cents
$username = $_POST['username']; 

// Check if the stripe token exists
if (isset($_POST['stripeToken'])) {
    $token = $_POST['stripeToken']; // The token from the form

    try {
        // Create a charge
        $charge = \Stripe\Charge::create([
            'amount' => $amount,  // Amount in cents (e.g., 5000 = $50.00)
            'currency' => 'inr',   // You may want to use INR (Indian Rupees) based on the original currency symbol in your HTML
            'description' => 'Booking Payment for ' . $username,
            'source' => $token,
        ]);

        // Redirect to success page
        header('Location: success.php');
        exit();
    } catch (Exception $e) {
        // Error handling
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "Error: Stripe token was not received.";
}
?>
