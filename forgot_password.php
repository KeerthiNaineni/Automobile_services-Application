<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get email/username from form
    $email = $_POST['email'];

    // Check if the email or username exists in the database
    try {
        $conn = new PDO("mysql:host=localhost;dbname=login", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM userdata WHERE email=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Generate a unique token and send an email with the reset link
            $token = bin2hex(random_bytes(50)); // generate a random token

            // Store the token in the database
            $stmt = $conn->prepare("UPDATE userdata SET reset_token=:token WHERE email=:email");
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Send the reset link to the user's email
            $resetLink = "http://yourwebsite.com/reset_password.php?token=" . $token;
            mail($user['email'], "Password Reset Request", "Click on this link to reset your password: " . $resetLink);

            echo "A password reset link has been sent to your email.";
        } else {
            echo "No user found with that email/username.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot-Password Page</title>
    <link rel="stylesheet" href="signupscript1.css">
</head>
<body>
<section class="container forms">
        <div class="form signup">
            <div class="form-content">
                <header>Reset Password</header>
                <form action="send_password_reset.php" method="post">
                    <div class="field input-field">
                        <input type="email" name="email" class="input" placeholder="Email" required>
                    </div>
                    <div class="field button-field">
                        <button type="submit">Send Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>