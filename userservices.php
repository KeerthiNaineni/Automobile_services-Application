<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Services</title>
    <link rel="stylesheet" href="styles/userservices.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include "navbar.php";?>
    <?php include "connect.php";?>
    <section>
        <div class="desc">
            <h3 class="heading-title">Our Services</h3>
            <img src="images/icon1.png" class="tool" alt="">
</div>
<p class="pdesc">
Our representatives are professionaly trained and skilled with latest and futursitic techniques to provide a best quality service.At AutoMob-Mechanic,we provide a high class service to the customers for their happy and comfortable driving experience."
</p>
<div class="services">
    <div class="service-container">
    <?php
        $select_service=mysqli_query($conn,"select * from `services_data`") or die('query failed');
        if(mysqli_num_rows($select_service)>0){
           
            while($fetch_service=mysqli_fetch_assoc($select_service)){
                $serviceFilename = strtolower(str_replace(' ', '_', $fetch_service['servicename']));
        ?>
         <div class="service-box">
<img src="images/<?php echo  $fetch_service['image']; ?>" alt="<?php echo $fetch_service['servicename']; ?>">
<h4 class="service-name"><?php echo $fetch_service['servicename']; ?></h4>
<p class="service-price">Price: <?php echo $fetch_service['serviceprice']; ?></p>
<p class="service-offer">Offer Price: <?php echo $fetch_service['serviceoffer']; ?></p>
<button class="moredetails" onclick="window.location.href='<?php echo $serviceFilename; ?>.php?image=<?php echo urlencode($fetch_service['image']); ?>&name=<?php echo urlencode($fetch_service['servicename']); ?>&offer=<?php echo urlencode($fetch_service['serviceoffer']); ?>';">More Details
</button>
</div>
<?php
}
} else {
echo "<p class='no-services'>No Services Available</p>";
}
                ?>     
    </div>
</div>
    </section>
</body>
</html>