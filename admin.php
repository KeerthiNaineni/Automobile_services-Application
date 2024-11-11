<?php include 'connect.php';?>
<?php
session_start(); // Start the session to access session variables
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles/admin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <input type="checkbox" id="check">
    <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
        <header><?php echo $_SESSION['adminname']; ?></header>
        <ul>
            <li><a href="adminservices.php">Add Services</a></li>
            <li><a href="displayservices.php">Display Services</a></li>
            <li><a href="adminfeedbackpage.php">Feedback</a></li>
            <li><a href="bookinginfo.php">Booking Info</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="logout.php">Logout</a></li>
            <!-- <i class='bx bx-menu menu-icon'></i> -->
        </ul>
        </div>
        <section id="content-area">
        <!-- Content from other pages will be loaded here -->
         
    </section>
</body>
</html>
