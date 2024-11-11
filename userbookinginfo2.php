<?php
include 'bookingconnect.php';
session_start();
if (!isset($_SESSION['username'])) {
    echo "Please log in to view your bookings.";
    exit();
}

$username = $_SESSION['username'];

$cardColors = [
    '#f8d7da', '#d4edda', '#cce5ff', '#fff3cd', '#e2e3e5', '#f3d6ff', '#ffe6cc', '#d6f5e9', '#ffebd6', '#e6f7ff'
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
  <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
  <?php include 'navbar.php';?>

  <div class="container mt-5">
    <h2 class="mb-4 text-center">My Bookings</h2>
    <div class="row">

    <?php
    $stmt = $conn->prepare("SELECT id,name, date, service_name, offer_price, created_at, status, servicestatus, mechanicid FROM bookingdata WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id,$name, $date, $service_name, $offer_price, $created_at, $status, $servicestatus, $mechanicid);

        while ($stmt->fetch()) {
            $cardColor = $cardColors[array_rand($cardColors)];
            
            // Debugging line to check the offer price and username
            echo "<!-- Debugging Offer Price for $service_name: $offer_price -->";

            echo "
            <div class='col-md-6 col-lg-4 mb-4'>
              <div class='card booking-card shadow-sm' style='background-color: $cardColor;'>
                <div class='card-body'>
                <h6 class='card-title'>Id: $id</h6>
                  <h6 class='card-title'>User: $name</h6>
                  <p class='card-text'><strong>Service Scheduled on:</strong> $date</p>
                  <p class='card-text'><strong>Service:</strong> $service_name</p>
                  <p class='card-text'><strong>Price:</strong>&#8377;$offer_price</p>
                  <p class='card-text'><strong>Booked on:</strong> $created_at</p>
                  <p class='card-text'><strong>Status of booking:</strong>$status</p>
                  <p class='card-text'><strong>Service Status:</strong>$servicestatus</p>
                  <p class='card-text'><strong>Assigned Mechanic ID:</strong> $mechanicid</p>
                  <div>
                  <button 
    class='custom-button proceed-button' 
    onclick='openPaymentModal(this)' 
    data-amount='$offer_price'
    data-username='$username'>
    Proceed to Payment
</button>
                   <button class='custom-button cancel-button' data-booking-id='$id'>Cancel Booking</button>
                  </div>
                </div>
              </div>
            </div>";
        }
    } else {
        echo "<div class='no-bookings-message text-center text-danger fs-4 fw-bold'>No services are booked</div>";
    }

    $stmt->close();
    $conn->close();
    ?>
    </div>
  </div>

  <!-- Payment Modal -->
  <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paymentModalLabel">Complete Your Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="payment-form" action="process_payment.php" method="POST">
          <input type="text" id="amount-field" name="amount">
    <input type="text" id="username-field" name="username">
    
            <div id="card-element"></div>
            <div id="card-errors" role="alert" class="text-danger mt-2"></div>
            
            <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    const stripe = Stripe('pk_test_51QIn3EG0eRElWoCTPMU9Y9QaLxSKwtvMIvmPdFkNCvnjU1zvCjAmVyhDMLYpObtAIWTKzO59cL7MfKEKTxmotG5100oVsXGbRR'); // Replace with your actual Publishable Key
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    card.on('change', function(event) {
      const errorElement = document.getElementById('card-errors');
      errorElement.textContent = event.error ? event.error.message : '';
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
    function openPaymentModal(button) {
    const amount = button.getAttribute('data-amount');  // This is the price of the service
    const username = button.getAttribute('data-username'); // The username of the user

    // Debugging lines to check the values
    console.log("Amount:", amount);
    console.log("Username:", username);

    // Pass the amount and username to the payment form
    document.getElementById('amount-field').value = amount * 100; // Stripe uses cents, so multiply by 100
    document.getElementById('username-field').value = username;
    const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
    paymentModal.show();
}
    
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Add event listener to each cancel button
    const cancelButtons = document.querySelectorAll('.cancel-button');
    
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const bookingId = this.getAttribute('data-booking-id'); // Get the booking ID
            if (confirm('Are you sure you want to cancel this booking?')) {
                cancelBooking(bookingId);
            }
        });
    });
});

// Function to send AJAX request to cancel the booking
function cancelBooking(bookingId) {
    // Create a new XMLHttpRequest
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'cancel_booking.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Define what happens when the request is successful
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Booking cancelled successfully!');
                location.reload(); // Reload the page to reflect changes
            } else {
                alert('Failed to cancel booking. Please try again.');
            }
        }
    };

    // Send the booking ID to the server
    xhr.send('booking_id=' + bookingId);
}

  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>