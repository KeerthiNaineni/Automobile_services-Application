<?php
include 'connect.php';
if(isset($_GET['delete'])){
    $delete_service=$_GET['delete'];
    $delete_query=mysqli_query($conn,"Delete from`services_data` where servicename='$delete_service'") or die("Query failed");
    if($delete_query){
        header('location:displayservices.php');
    }else{
        echo "Service not deleted";
    }
}
?>