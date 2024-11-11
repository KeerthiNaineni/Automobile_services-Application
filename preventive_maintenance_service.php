<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($_GET['name']); ?></title>
    <link rel="stylesheet" href="styles/preventive_maintenance_service.css?v=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php include "navbar.php";?>
<?php include "connect.php";?>
<section class="service-section">
    <div class="servicedetail">
        <div><img id="service-image" src="images/<?php echo htmlspecialchars($_GET['image']); ?>" alt="Service Image"></div>
        <div class="data">
            <h3><?php echo htmlspecialchars($_GET['name']); ?></h3>
            <p>Looking to keep your <?php echo htmlspecialchars($_GET['name']); ?> functioning smoothly? Save money and opt for our periodic maintenance service.</p>
            <p style="text-decoration:underline";>This service aims at:</p>
            <div class="service-details">
    <p>1.Battery Maintenance and Testing</p>
    <p>2.Charging System Check</p>
    <p>3.Cooling System Service</p>
</div>
            <p>Offer Price: <span class="offerprice"><?php echo htmlspecialchars($_GET['offer']); ?></span></p>
            <button class="bookservice" onclick="location.href='booking.php?name=<?php echo urlencode($_GET['name']); ?>&offer=<?php echo urlencode($_GET['offer']); ?>'">Book Service</button>
        </div>
    </div>
    </section>
</body>
</html>
