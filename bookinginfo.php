<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
}
        .container {
            margin-top: 20px;
        }
        table {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
            border: 1px solid gray;
        }
        table, th, td {
            border: 1px solid gray;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    
        .bg-success {
        background-color: #28a745; /* Green */
    }
    .bg-light-danger {
    background-color: rgb(244,0,0) !important; /* Lighter red shade */
    color: #721c24; /* Text color for better contrast */
}
    .bg-warning {
        background-color: #ffc107; /* Yellow (for In Progress) */
    }
    .bg-primary {
        background-color: #007bff; /* Blue (for Completed) */
    }
    .btn-custom {
    background-color:#232836; ; /* A warm color (yellow-orange) */
    color: white; /* White text */
}
    </style>
</head>
<body>
<?php include 'adminsidebar.php'; ?>
<!-- Admin Panel -->
<div class="container">
    <h2>Services Booking Info</h2>

    <!-- Table to display bookings -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Scheduled Date</th>
                <th>Service Name</th>
                <th>Offer Price</th>
                <th>Booking Time</th>
                <th>Status</th>
                <th>Mechanic Id</th>
                <th>ServiceStatus</th>
                <th>Update</th> <!-- New column -->
            </tr>
        </thead>
        <tbody>
            <?php
                include 'bookingconnect.php';  // Database connection

                $query = "SELECT * FROM bookingdata";  // Fetch all bookings
                $result = mysqli_query($conn, $query);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['service_name'] . "</td>";
                        echo "<td>" . $row['offer_price'] . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        $statusClass = ($row['status'] == 'Accepted') ? 'bg-success text-white' : (($row['status'] == 'Pending') ? 'bg-light-danger text-white' : '');
                        echo "<td class='$statusClass'>" . $row['status'] . "</td>";
                        echo "<td>" . $row['mechanicid'] . "</td>";
                        // Set background color for the service status (In Progress / Completed)
                        $serviceStatusClass = ($row['servicestatus'] == 'In-progress') ? 'bg-warning text-white' : (($row['servicestatus'] == 'Completed') ? 'bg-primary text-white' : '');
                        echo "<td class='$serviceStatusClass'>" . $row['servicestatus'] . "</td>";
                        echo "<td>"; 
                        echo '<a href="update_serviceform.php?id=' . $row['id'] . '" class="btn btn-custom sm">Update Service</a>';

                        echo "</td>"; 
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).on('change', '.mechanic-select', function() {
        var bookingId = $(this).data('id');
        var mechanicId = $(this).val();
        
        if (mechanicId) {
            // Update booking status and mechanic availability
            $.ajax({
                url: 'update_booking.php', // Separate file for the update logic
                method: 'POST',
                data: {
                    booking_id: bookingId,
                    mechanic_id: mechanicId,
                    action: 'assign_mechanic'
                },
                success: function(response) {
                    if (response == 'success') {
                        alert('Mechanic assigned successfully!');
                        location.reload(); // Refresh page to see changes
                    } else {
                        alert('Error assigning mechanic');
                    }
                }
            });
        }
    });
</script>
</body>
</html>
