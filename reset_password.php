<?php
date_default_timezone_set('Asia/Kolkata');
if (isset($_GET['token'])) {
    // Retrieve token from URL
    $token = $_GET['token'];
    $token_hash = hash("sha256", $token); // Hash token first

    try {
        // Connect to the database
        $conn = new PDO("mysql:host=localhost;dbname=login", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch the user with this token and check if it has expired
        $stmt = $conn->prepare("SELECT * FROM userdata WHERE reset_token_hash = :token_hash AND reset_token_expires_at > NOW()");
        $stmt->bindParam(':token_hash', $token_hash); // Use the variable here
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // If valid token, show the reset password form
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $newPassword = $_POST['password'];
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                // Update the user's password and clear the reset token
                $stmt = $conn->prepare("UPDATE userdata SET password = :password, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = :id");
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':id', $user['id']);
                $stmt->execute();

                echo "Your password has been reset successfully. You may now log in with your new password.";
                exit;
            }
        } else {
            echo "Invalid or expired token.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No token provided.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/loginpage1.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Reset Password</title>
</head>
<body>
<section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Reset Password</header>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="field input-field">
                        <input type="password" placeholder="New Password" class="password" name="password" required>
                    </div>
                    <div class="field button-field">
                        <button>Reset password</button>
                    </div>
                </form>
            </div>
            </div>
    </section>
    </body>
</html>
