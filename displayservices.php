<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Available</title>
    <style>
        .products{
            margin:20px;
        }
        .products .box-container{
            display: flex;
            flex-wrap: wrap;
            gap:15px;
            padding:65px;
            justify-content: center;
            width:auto;
        }
        .products .box-container .box{
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
            background-color: #ccc;
            width:350px;

        }
        .products .box-container .box img{
            width:100%;
            height:250px;
            object-fit: cover;
        }
        .products .box-container .box .delete_b{
            color:blue;
            font-size:18px;
            text-decoration:underline;
        }
        .products .box-container .box .update_service{
            color:blue;
            font-size:18px;
            text-decoration:underline;
        }
#m{
    font-size:30px;
    color:whitesmoke;
}

        </style>

</head>
<body>
<?php include 'connect.php';?>
<?php include 'admin2.php';?>
<div class="products">
    <div class="box-container">
        <?php
        $select_service=mysqli_query($conn,"select * from `services_data`") or die('query failed');
        if(mysqli_num_rows($select_service)>0){
           
            while($fetch_service=mysqli_fetch_assoc($select_service)){
        ?>
        <form method="post" class="box" action="">
            <img src="images/<?php echo $fetch_service['image']?>" alt="">
            <div class="name"><?php echo $fetch_service['servicename'];?></div>
            <div class="price"><?php echo $fetch_service['serviceprice'];?></div>
            <div class="price"><?php echo $fetch_service['serviceoffer'];?></div>
            <div><a href="deleteservices.php?delete=<?php echo $fetch_service['servicename']?>" class="delete_b" onclick="return confirm('Are you sure you want to delete this service');">Delete</a></div>
            <div><a href="updateservice.php?edit=<?php echo $fetch_service['servicename']?>" class="update_service"><i class="fas fa-edit"></i></a></div>
        </form>
        <?php

            }
        }else{
            echo "<div class='empty_text'><p id='m'>No Services Available</p></div>";
        }
        ?>
    </div>
</div>
</body>
</html>