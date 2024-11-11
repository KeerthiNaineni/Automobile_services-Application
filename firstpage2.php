<?php
session_start(); // Start the session to access session variables
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoMob-Mechanic Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
         <input type="checkbox" id="check">
         <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
         </label>
         <img src="car-icon.png" alt="AutoMob-Mechanic Logo" class="logo-img">
        <label class="logo">CarMate Service</label> 
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="userservices.php">Services</a></li>
            <li><a href="feedbacksystem.php">Feedback</a></li>
            <li><a href="userbookinginfo2.php">Bookings</a></li>
            <li><a href="logout.php">Logout</a></li>
            <!-- Display the username after login -->
            <li><a href="#">Welcome,<?php echo $_SESSION['username']; ?></a></li>
        </ul>
    </nav>
    <div class="homepageimg"></div>
    <section id="aboutus" class="para">
        <p class="aboutus">ABOUT US</p>
        <div class="line"></div>
        <p>At CarMate Service, we aim to make car care effortless, combining expert mechanics with on-demand booking </p>through our user-friendly application.
        <p>From routine maintenance to emergency repairs, we bring the garage to you.</p>

        <p>Trust us to keep your car in top shape,</p>
        so you can drive with confidence.
        <p>We believe in fair pricing, expert craftsmanship, and a hassle-free experience</p>
        <div class="service-container">
        <div class="img-section">
            <img src="assets/home3.png" alt="Service Image" class="service-image">
        </div>
        
        <div class="content-section">
            <p>Enjoy convenient car repair and maintenance at your home or office.</p>
            
            <div class="step">
                <h2>1. CHOOSE A SERVICE</h2>
                <p>Choose the perfect service for your car.</p>
            </div>

            <div class="step">
                <h2>2. BOOK AN APPOINTMENT</h2>
                <p>Book an appointment with us on your convenient date.</p>
            </div>

            <div class="step">
                <h2>3. GET YOUR CAR FIXED</h2>
                <p>No more waiting needed, our representative will take care of everything on their own.</p>
            </div>
            <button class="book-btn">BOOK SERVICE</button>
        </div>
    </div>
</section>
</body>
</html>
