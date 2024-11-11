<?php
include 'bookingconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookingId = $_POST['id'];
    $status = $_POST['status'];
    $serviceStatus = $_POST['service-status'];
    $mechanicId = $_POST['mechanic_id'];

    // Update booking status and mechanic_id in bookingdata table
    $updateBookingQuery = "UPDATE bookingdata SET status = '$status',servicestatus = '$serviceStatus',mechanicid = '$mechanicId' WHERE id = $bookingId";
    $bookingUpdateResult = mysqli_query($conn, $updateBookingQuery);

    // If booking status is accepted, update mechanic availability
    // if ($status == 'Accepted' && !empty($mechanicId)) {
    //     // Mark the mechanic as unavailable in the mechanicinfo table
    //     $updateMechanicQuery = "UPDATE mechanicinfo SET availability_status = 'Unavailable' WHERE mechanicid = '$mechanicId'";
    //     mysqli_query($conn, $updateMechanicQuery);
    // }
    if ($status == 'Accepted' && !empty($mechanicId)) {
        // Check if service status is Completed or not, and update mechanic availability accordingly
        if ($serviceStatus === 'Completed') {
            // Set mechanic availability to "Available"
            $updateMechanicQuery = "UPDATE mechanicinfo SET availability_status = 'Available' WHERE mechanicid = '$mechanicId'";
            mysqli_query($conn, $updateMechanicQuery);
        } else {
            // Set mechanic availability to "Unavailable"
            $updateMechanicQuery = "UPDATE mechanicinfo SET availability_status = 'Unavailable' WHERE mechanicid = '$mechanicId'";
            mysqli_query($conn, $updateMechanicQuery);
        }
    }

    // Confirm success or error
    if ($bookingUpdateResult) {
        header("Location: bookinginfo.php");
        exit();
    } else {
        echo 'error';
    }
}
?>
