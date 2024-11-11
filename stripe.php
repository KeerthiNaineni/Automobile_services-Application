<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Page</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Complete Your Booking Payment</h1>

    <!-- Payment Form -->
    <form id="payment-form" action="process_payment.php" method="POST">
        <!-- Card Element Placeholder -->
        <div id="card-element"></div>

        <!-- Error Message Container -->
        <div id="card-errors" role="alert"></div>

        <!-- Submit Button -->
        <button id="pay-button">Pay Now</button>
    </form>

    <script>
        // Initialize Stripe and Elements
        const stripe = Stripe('pk_test_51QIn3EG0eRElWoCTPMU9Y9QaLxSKwtvMIvmPdFkNCvnjU1zvCjAmVyhDMLYpObtAIWTKzO59cL7MfKEKTxmotG5100oVsXGbRR');  // Replace with your actual Publishable Key
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element
        card.addEventListener('change', function(event) {
            const displayError = document.getElementById('card-errors');
            displayError.textContent = event.error ? event.error.message : '';
        });

        // Handle form submission
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            const { error, token } = await stripe.createToken(card);

            if (error) {
                // Display error in the card-errors div
                document.getElementById('card-errors').textContent = error.message;
            } else {
                // Send the token to your server
                stripeTokenHandler(token);
            }
        });

        // Submit the form with the Stripe token
        function stripeTokenHandler(token) {
            const form = document.getElementById('payment-form');
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
</body>
</html>
