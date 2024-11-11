<?php
include 'bookingconnect.php';

// Get the booking ID from the URL
if (isset($_GET['id'])) {
    $bookingId = $_GET['id'];

    // Fetch booking details
    $query = "SELECT * FROM bookingdata WHERE id = $bookingId";
    $result = mysqli_query($conn, $query);
    $booking = mysqli_fetch_assoc($result);

    // Fetch available mechanics
    $mechanic_query = "SELECT mechanicid FROM mechanicinfo WHERE availability_status = 'Available'";
    $mechanic_result = mysqli_query($conn, $mechanic_query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .container {
            margin-top: 30px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 700px;  /* Limit container width */
            margin-left: auto;
            margin-right: auto;
        }
        h2 {
            color: #007bff;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control[readonly] {
            background-color: #f9f9f9;
        }
        .form-label {
            font-weight: bold;
            color: #495057;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
            padding: 10px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .mb-3 {
            margin-bottom: 15px; /* Reduced margin */
        }
        select.form-control {
            height: 40px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
        select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .form-control {
            height: 40px;
            border-radius: 5px;
        }
        .container .form-control {
            font-size: 16px;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .alert {
            font-size: 1.1rem;
            font-weight: bold;
        }
        .card {
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 18px;
        }
        .card-body {
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Booking</h2>
    
    <!-- Check if booking exists -->
    <?php if (isset($booking)) { ?>
        <form action="update_booking.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $booking['name']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $booking['email']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $booking['phone']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $booking['address']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="mechanicid" class="form-label">MechanicId</label>
                <input type="text" class="form-control" id="mechanicid" name="mechanic" value="<?php echo $booking['mechanicid']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Pending" <?php if ($booking['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Accepted" <?php if ($booking['status'] == 'Accepted') echo 'selected'; ?>>Accepted</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="service-status" class="form-label">Service Status</label>
                <select class="form-control" id="service-status" name="service-status">
                    <option value="In-progress" <?php if ($booking['servicestatus'] == 'In-progress') echo 'selected'; ?>>In-progress</option>
                    <option value="Completed" <?php if ($booking['servicestatus'] == 'Completed') echo 'selected'; ?>>Completed</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="mechanic_id" class="form-label">Assign Mechanic</label>
                <select class="form-control" id="mechanic_id" name="mechanic_id">
                    <option value="">-- Select Mechanic --</option>
                    <?php while ($mechanic = mysqli_fetch_assoc($mechanic_result)) { ?>
                        <option value="<?php echo $mechanic['mechanicid']; ?>" <?php if ($mechanic['mechanicid'] == $booking['mechanicid']) echo 'selected'; ?>>
                            <?php echo $mechanic['mechanicid']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Booking</button>
        </form>
    <?php } else { ?>
        <p class="alert alert-warning">Booking not found.</p>
    <?php } ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
