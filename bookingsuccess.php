<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking SuccessPage</title>

    <style>
        /* Global body styling */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 80px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .col-md-6 {
            padding: 30px;
        }

        #para {
            padding-top: 40px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        @media screen and (max-width: 1200px) {
            img {
                width: 400px;
                height: auto;
            }
        }

        @media screen and (max-width: 992px) {
            img {
                width: 350px;
                height: auto;
            }
        }

        /* Footer styling */
        .foot {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            background-color: #f8f8f8;
        }

        h5 {
            font-size: 1.5rem;
            font-weight:500;
        }

        p {
            font-size: 1.1rem;
            line-height: 1.5;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-md-6 img {
            max-width: 100%;
            height: auto;
        }

        .col-md-6 {
            flex: 1;
            min-width: 300px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <!-- Include the navbar (it will retain its original styling from navbar.php) -->
    <?php include 'navbar.php';?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="images/thankyou.jpg" alt="Thank you" height="400" width="500">
            </div>
            <div class="col-md-6" id="para">
                <h5>Your Booking is confirmed</h5>
                <p>We will get back to you soon with the details via email/phone.</p>
                <br><br>
                <p>For any reason, want to re-schedule/cancel it?</p>
                <p>Please contact us!</p>
                <br><br>
                <p>The AutoMob-Mechanic Team</p>
            </div>
        </div>
    </div>
</body>
</html>
