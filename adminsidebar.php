<?php
session_start(); // Start the session to access session variables
?>
<?php include 'connect.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap'); */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    /* font-style: Poppins; */
    list-style: none;
    text-decoration: none;
}

body {
    height: 100vh;
    background-color:white;
}

.sidebar {
    position: fixed;  /* Ensure the sidebar is always fixed */
    left:-250px;
    top: 0;           /* Keep it fixed at the top */
    width: 250px;
    height: 100%;
    background: #042331;
    transition: all 0.5s ease;
}

.sidebar header {
    font-size: 22px;
    color: white;
    text-align: center;
    line-height: 70px;
    background: #023e56;
    user-select: none;
}

.sidebar ul a {
    display: block;
    width: 100%;
    line-height: 65px;
    font-size: 20px;
    color: white;
    padding-left: 40px;
    box-sizing: border-box;
    border-top: 1px solid rgba(255,255,255,.1);
    border-bottom: 1px solid black;
}

ul li:hover a {
    background-color: rgb(16, 143, 143);
}

#check {
    display: none;
}

label #btn{
    position:fixed;
    cursor: pointer;
    background: #042331;
    border-radius: 3px;
    top: 25px;
    left: 20px; /* Ensures the buttons stay near the top left */
    font-size: 35px;
    color: white;
    padding: 6px 12px;
    transition: all 0.5s;
    z-index: 1000;
}
label #cancel{
    position:fixed;
    cursor: pointer;
    background: #042331;
    border-radius: 3px;
    top: 15px;
    left: -5px; /* Ensures the buttons stay near the top left */
    font-size: 30px;
    color: white;
    padding: 6px 12px;
    transition: all 0.5s;
    z-index: 1000;
}


label #cancel {
 display:none;
}

#check:checked ~ .sidebar {
    left: 0;
}

#check:checked ~ label #btn {
    display: none;
}
#check:checked ~ label #cancel {
    display: block; /* Show cancel button when sidebar is opened */
}

#check:checked ~ label #cancel {
    /* display: block; */
    left:195px;
}

/* Content area */
/* section {
    flex-grow: 1;
    background-color:#042331;
    margin-left: 250px;  /* Push the content area to the right of the sidebar 
    padding: 20px;
    min-height: 100vh;}
*/

    </style>
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
            <li><a href="#">Payment</a></li>
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
