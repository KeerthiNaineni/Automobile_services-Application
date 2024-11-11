<?php include "bookingconnect.php"; 
date_default_timezone_set('Asia/Kolkata');?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $date = $_POST['date'];
    $service_type = $_POST['service_type'];
    $service_name = $_POST['service_name'];
$offer_price = $_POST['offer_price'] ?? null;
$service_description = null;

    // Automatically set booking time to the current timestamp
    $booking_time = date("Y-m-d H:i:s"); // Capture current date and time

    // SQL insert with booking_time
    $sql = "INSERT INTO bookingdata (name, email, phone, address, date, service_type, service_name, offer_price, service_description,created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ssssssssss", $name, $email, $phone, $address, $date, $service_type, $service_name, $offer_price, $service_description, $booking_time);
        
        // Execute statement and check for success
        if ($stmt->execute()) {
            header("Location: bookingsuccess.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Services</title>
    <link rel="stylesheet" href="styles/booking.css">
</head>
<body>
<?php include "connect.php";?>
    <section class="booking">
        <h1 class="heading-title">Book Service</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="book-form">
            <div class="flex">
                <div class="inputbox">
                    <span>Name:</span>
                    <input type="text" placeholder="Enter your name" name="name" required>
                </div>
                <div class="inputbox">
                    <span>Email:</span>
                    <input type="email" placeholder="Enter your email" name="email" required>
                </div>
                <div class="inputbox">
                    <span>Phone:</span>
                    <input type="phone" placeholder="Enter your phone number" name="phone" required minlength="10" maxlength="10">
                </div>
                <div class="inputbox">
                    <span>Address:</span>
                    <input type="text" placeholder="Enter your address" name="address" required>
                </div>
                <div class="inputbox">
                    <span>Date:</span>
                    <input type="date" name="date" required>
                </div>
                
                <!-- Service Selection -->
                <div class="inputbox">
                    <span>Service:</span>
                    <input type="text" name="service_type"value="listed" readonly>
                </div>
                <div class="inputbox">
                        <span>Service Name:</span>
                        <input type="text" name="service_name" value="<?php echo htmlspecialchars($_GET['name']); ?>" readonly>
                </div>
                <div class="inputbox">
                        <span>Offer Price:</span>
                        <input type="text"  name="offer_price" value="<?php echo htmlspecialchars($_GET['offer']); ?>" readonly>
                </div>
</div>
            <button type="submit" class="submit-btn">Confirm Booking</button>
        </form>
    </section>
</body>
</html>
