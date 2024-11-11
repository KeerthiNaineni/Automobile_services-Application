<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the layout */
        body {
            background-color: #4e211d; /* Dark background */
            color: #f2ebe9; /* Light text color for contrast */
        }

        .container-fluid {
            height: 100vh; /* Full viewport height */
        }

        .card {
            background-color: #f2ebe9; /* Light background for the card */
            color: #4e211d; /* Dark text color for readability */
            border-radius: 10px;
        }

        .card h3 {
            color: #a64036; /* Accent color for title */
        }

        .btn-primary {
            background-color: #a64036; /* Custom button color */
            border-color: #a64036;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #852f2b; /* Darker shade on hover */
            border-color: #852f2b;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #a64036; /* Accent color border */
        }
        .image-section {
    background-color:  #f2ebe9; /* Sets a background color */
    display: flex;
    justify-content: center;
    align-items: center;
}

.feedback-image {
    width: 80%; /* Adjust percentage or pixel size to make it smaller */
    max-width: 800px; /* Optional: Sets a max width for larger screens */
    height: auto; /* Maintains aspect ratio */
    object-fit: contain; /* Ensures the image doesn’t get distorted */
}

        /* Semi-transparent overlay */
        /* .image-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(253, 204, 195, 0.5); /* Light overlay with some transparency 
            z-index: 1;
        } */

        /* Spacing and padding for form labels */
        .form-group label {
            font-weight: bold;
            color: #4e211d;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row h-100">
            <!-- Left section with the Bootstrap card -->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="card shadow-lg p-4" style="width: 90%; max-width: 500px;">
                    <div class="card-body">
                        <h3 class="card-title text-center">Give Us Your Feedback</h3>
                        <p class="text-center mb-4">We would love to hear about your experience!</p>
                        <form action="submit_feedback.php" method="post">
                            <div class="form-group">
                                <label for="username">Your Name:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="feedback">Feedback:</label>
                                <textarea name="feedback" id="feedback" rows="4" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit Feedback</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right section for the image with overlay text -->
            <div class="col-md-6 image-section d-none d-md-flex justify-content-center align-items-center">
    <img src="assets/feedbackpic2.png" alt="Feedback Image" class="feedback-image">
</div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
