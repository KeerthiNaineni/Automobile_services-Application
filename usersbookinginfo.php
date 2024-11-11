<?php
include 'bookingconnect.php';
session_start();

// Check if the user is logged in and username exists in the session
if (!isset($_SESSION['username'])) {
    echo "Please log in to view your bookings.";
    exit();
}

$username = $_SESSION['username'];

// Define the card colors
$cardColors = [
    '#f8d7da', // Light red
    '#d4edda', // Light green
    '#cce5ff', // Light blue
    '#fff3cd', // Light yellow
    '#e2e3e5', // Light gray
    '#f3d6ff', // Light purple
    '#ffe6cc', // Light orange
    '#d6f5e9', // Mint green
    '#ffebd6', // Peach
    '#e6f7ff'  // Soft cyan
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bookings</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="usersbookinginfo.css">
</head>
<body>
    <?php include 'navbar.php';?>

  <div class="container mt-5">
    <h2 class="mb-4 text-center">My Bookings</h2>
    <div class="row">

    <?php
    // Prepare the SQL query to fetch bookings for the logged-in user
    $stmt = $conn->prepare("SELECT name, date, service_name, offer_price, created_at, status, servicestatus, mechanicid FROM bookingdata WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user has any bookings
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $date, $service_name, $offer_price, $created_at, $status, $servicestatus, $mechanicid);

        // Fetch each booking and display in a card layout
        while ($stmt->fetch()) {
            // Randomly pick a color from the array
            $cardColor = $cardColors[array_rand($cardColors)];

            echo "
            <div class='col-md-6 col-lg-4 mb-4'>
              <div class='card booking-card shadow-sm' style='background-color: $cardColor;'>
                <div class='card-body'>
                  <h6 class='card-title'>User: $name</h6>
                  <p class='card-text'><strong>Service Scheduled on:</strong> $date</p>
                  <p class='card-text'><strong>Service:</strong> $service_name</p>
                  <p class='card-text'><strong>Price:</strong>&#8377;$offer_price</p>
                  <p class='card-text'><strong>Booked on:</strong> $created_at</p>
                  <p class='card-text'><strong>Status of booking:</strong>$status</p>
                  <p class='card-text'><strong>Service Status:</strong>$servicestatus</p>
                  <p class='card-text'><strong>Assigned Mechanic ID:</strong> $mechanicid</p>
                  <div>
                  <button class='custom-button proceed-button' onclick='openPaymentModal()'>Proceed to Payment</button>
                    <button class='custom-button cancel-button'>Cancel Booking</button>
                    
                  </div>
                </div>
            </div>
            </div>";
        }
    } else {
        // Display message if no bookings are found
        echo "<div class='no-bookings-message text-center text-danger fs-4 fw-bold'>No services are booked</div>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
    ?>
    </div>
  </div>

  <!-- Bootstrap JS (optional, for better responsive behavior) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <div id="payment-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closePaymentModal()">&times;</span>
        <h1>Complete Your Booking Payment</h1>
        <form id="payment-form" action="process_payment.php" method="POST">
            <div id="card-element"></div>
            <div id="card-errors" role="alert"></div>
            <button id="pay-button">Pay Now</button>
        </form>
    </div>
</div>

<!-- Modal Styling (CSS) -->
<style>
    .modal {
        display: none; /* Hidden by default */
        position: fixed; 
        z-index: 1; 
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%;
        overflow: auto; 
        background-color: rgba(0, 0, 0, 0.4); 
    }
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 90%;
        max-width: 400px;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover, .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<script>
    // Function to open the payment modal
    function openPaymentModal() {
        document.getElementById('payment-modal').style.display = 'block';
    }

    // Function to close the payment modal
    function closePaymentModal() {
        document.getElementById('payment-modal').style.display = 'none';
    }

    // Initialize Stripe and Elements
    const stripe = Stripe('pk_test_51QIn3EG0eRElWoCTPMU9Y9QaLxSKwtvMIvmPdFkNCvnjU1zvCjAmVyhDMLYpObtAIWTKzO59cL7MfKEKTxmotG5100oVsXGbRR');
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    card.addEventListener('change', function(event) {
        const displayError = document.getElementById('card-errors');
        displayError.textContent = event.error ? event.error.message : '';
    });

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        const { error, token } = await stripe.createToken(card);

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            stripeTokenHandler(token);
        }
    });

    function stripeTokenHandler(token) {
        const form = document.getElementById('payment-form');
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>

</body>
</html>
