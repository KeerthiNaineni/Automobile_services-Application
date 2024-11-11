<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        /* Centering styles */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2ebe9; /* Optional background color */
        }
        img {
            max-width: 80%; /* Adjusts the image size */
            height: 450px; /* Maintains aspect ratio */
        }
    </style>
</head>
<body>
    <img src="assets/feedbackpic3.png" alt="Thank You">
    <script>
        // Redirect after 60 seconds
        setTimeout(function() {
            window.location.href = 'firstpage2.php'; // Change to your desired redirect page
        }, 2000); // 60 seconds in milliseconds
    </script>
</body>
</html>
