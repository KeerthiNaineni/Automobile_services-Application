<?php
include 'bookingconnect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

if (isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];

    // Prepare a statement to delete the booking
    $stmt = $conn->prepare("DELETE FROM bookingdata WHERE id = ? AND name = ?");
    $stmt->bind_param("is", $booking_id, $_SESSION['username']);

    // Execute the deletion
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error cancelling booking']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Booking ID not provided']);
}

$conn->close();
?>
