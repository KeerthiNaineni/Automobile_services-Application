
<?php
include 'config.php';
try {
    // Fetch feedback entries from the database
    $stmt = $conn->prepare("SELECT username, email, feedback_content, created_at FROM feedback ORDER BY created_at DESC");
    $stmt->execute();
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
// Define an array of background colors
$cardColors = [
    '#f8d7da', // Light red
    '#d4edda', // Light green
    '#cce5ff', // Light blue
    '#fff3cd', // Light yellow
    '#e2e3e5', // Light gray
    '#f3d6ff', // Light purple
    '#ffe6cc', // Light orange
    '#d6f5e9', // Mint green
    '#ffebd6', // Peach
    '#e6f7ff'  // Soft cyan
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedbacks</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        body, .feedback-container, .feedback-card, .card-header, .card-body, .animated-heading {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}
        /* Container for feedback */
        .feedback-container {
            padding: 2rem;
            transition: margin-left 0.4s ease; /* Smooth transition */
            margin-left: 0; /* Default position */
        }

        /* Shift feedback-container when checkbox is checked */
        .shifted {
            margin-left: 250px; /* Adjust based on sidebar width */
        }

        h2.animated-heading {
            text-align: center;
            color: #4e211d;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }
        .feedback-container .row {
    margin-top: 20px; /* Space between rows */
}

.feedback-card {
    margin-bottom: 20px; /* Space between feedback cards */
}

    </style>
</head>
<body>
    <?php include 'adminsidebar.php'; ?>
    
    
    <div class="container-fluid feedback-container" id="feedbackContainer">
        <h2 class="text-center mb-4 animated-heading">Users Feedback</h2>
        <div class="row">
            <?php if ($feedbacks): ?>
                <?php foreach ($feedbacks as $index => $feedback): ?>
                    <div class="col-12">
                        <div class="card feedback-card" 
                             style="background-color: <?php echo $cardColors[$index % count($cardColors)]; ?>;">
                            <div class="card-header">
                                <?php echo htmlspecialchars($feedback['email']); ?>
                                <span class="feedback-meta float-right">
                                    <?php echo date("F j, Y, g:i a", strtotime($feedback['created_at'])); ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($feedback['username']); ?></h5>
                                <p class="card-text"><?php echo nl2br(htmlspecialchars($feedback['feedback_content'])); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center col-12">No feedback available at this time.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript for slide effect -->
    <script>
        // Get the checkbox element
        const checkBox = document.getElementById("check");
        // Get the feedback container element
        const feedbackContainer = document.getElementById("feedbackContainer");

        // Toggle class on feedback container when checkbox is checked/unchecked
        checkBox.addEventListener("change", function() {
            if (checkBox.checked) {
                feedbackContainer.classList.add("shifted"); // Shift left
            } else {
                feedbackContainer.classList.remove("shifted"); // Return to normal
            }
        });
    </script>
</body>
</html>
