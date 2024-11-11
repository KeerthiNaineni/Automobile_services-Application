
<?php include 'connect.php';
if(isset($_POST['update_service'])){
$update_name=$_POST['update_name'];
$update_image=$_FILES['update_image']['name'];
$update_image_tmp_name=$_FILES
['update_image']['tmp_name'];
$update_image_image_folder='images/'.$update_image;
$update_servicename=$_POST['update_servicename'];
$update_serviceprice=$_POST['update_serviceprice'];
$update_serviceoffer=$_POST['update_serviceoffer'];
$update_services=mysqli_query($conn,"Update `services_data` set image='$update_image',servicename='$update_servicename',
serviceprice='$update_serviceprice',
serviceoffer='$update_serviceoffer' where servicename='$update_name'
");
if($update_services){
    move_uploaded_file($update_image_tmp_name,$update_image_image_folder);
    $display_message="Service Updated successfully";
    header("refresh:2;url=displayservices.php");
   
}else{
  $display_message="There is some error in updating";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/updateservices.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'admin2.php';?>
    <section class="container">
        <?php
if(isset($display_message)){
    echo "<div class='display_message'>
    <span>$display_message</span>
    <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
</div>";
}
?>
    <div class="services_form">
    <h3 class="heading">Update Services</h3>
        <?php
        if(isset($_GET['edit'])){
            $edit_service=$_GET['edit'];
            $edit_query=mysqli_query($conn,"Select * from `services_data` where servicename='$edit_service'");
            if(mysqli_num_rows($edit_query)>0){
                $fetch_data=mysqli_fetch_assoc($edit_query);
                    
                ?>
        <form action="" method="post" enctype="multipart/form-data" class="update-service">
            <img src="images/<?php echo $fetch_data['image']?>" alt="" class="image">
            <input type="hidden" value="<?php echo $fetch_data['servicename']?>" name="update_name">
            <input type="file" class="input_fields" required accept="image/png,image/jpg,image/jpeg" required name="update_image">
            <input type="text" class="input_fields" required value="<?php echo $fetch_data['servicename']?>" name="update_servicename">
            <input type="number" class="input_fields" required value="<?php echo $fetch_data['serviceprice']?>" name="update_serviceprice">
            <input type="number" class="input_fields" required value="<?php echo $fetch_data['serviceoffer']?>" name="update_serviceoffer">
            <div class="btns">
                <input type="submit" class="submit_btn" value="Update" name="update_service">
                <input type="reset" id="cancel_btn" value="Cancel">
            </div>
        </form>
</div>
                <?php

            }
        }
        ?>
    </section>
</body>
</html>