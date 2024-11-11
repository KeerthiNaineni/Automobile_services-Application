<?php include 'connect.php';
if(isset($_POST['add_service'])){
    $serviceimage=$_FILES['image']['name'];
    $serviceimage_temp_name=$_FILES['image']['tmp_name'];
    $serviceimage_folder='images/'.$serviceimage;
    $servicename=$_POST['servicename'];
    $serviceprice=$_POST['serviceprice'];
    $serviceoffer=$_POST['serviceoffer'];

    $insert_query=mysqli_query($conn,"insert into services_data (image,servicename,serviceprice,serviceoffer) values('$serviceimage','$servicename','$serviceprice','$serviceoffer')") or die("insert query failed");
    if($insert_query){
        move_uploaded_file($serviceimage_temp_name,$serviceimage_folder);
        $display_message="
        Service inserted successfully";
    }else{
        $display_message="There is some error in inserting";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
<link rel="stylesheet" href="styles/aservices.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
   <?php include 'admin2.php';?>
        <section class="container">
<?php
if(isset($display_message)){
    echo "<div class='display_message'>
    <span>$display_message</span>
    <i class='fas fa-times' onclick='this.parentElement.style.display=\"none\";'></i>
</div>";
}
?>
             <div class="services_form">
            <h3 class="heading">Add Services</h3>
            <form action="" method="post" enctype="multipart/form-data" class="add_service">
            <input type="file" name="image" class="input_fields" accept="image/png,image/jpg,image/jpeg" required>
            <input type="text" name="servicename" placeholder="Service name" class="input_fields" required>
            <input type="number" min="0" placeholder="Service Price" class="input_fields" name="serviceprice" required>
            <input type="number" class="input_fields" placeholder="Offer Price" name="serviceoffer"required>
            <input type="submit" class="submit_btn" name="add_service" required>
            </form>
    </div>
    </section>
</body>
</html>