<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($_GET['name']); ?></title>
    <link rel="stylesheet" href="styles/car_wash_service.css?v=1.0">
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
            <p>Say goodbye to unsightly dents! Our expert <?php echo htmlspecialchars($_GET['name']); ?>restores your vehicle's sleek appearance with precision and care, bringing it back to life</p>
            <p style="text-decoration:underline";>This service aims at:</p>
            <div class="service-details">
   <p>Removes unsightly dents and Imperfections
</div>
            <p>Offer Price: <span class="offerprice"><?php echo htmlspecialchars($_GET['offer']); ?></span></p>
            <button class="bookservice" onclick="location.href='booking.php?name=<?php echo urlencode($_GET['name']); ?>&offer=<?php echo urlencode($_GET['offer']); ?>'">Book Service</button>
        </div>
    </div>
    </section>
</body>
</html>
