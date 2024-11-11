<?php
date_default_timezone_set('Asia/Kolkata');
$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$mysqli = require __DIR__ . "/database.php";

$sql = "UPDATE userdata
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();
if ($mysqli->affected_rows) {

    require __DIR__ . "/mailer.php";

    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END
    <html>
        <body>
            <p>Click <a href="http://localhost:3000/reset_password.php?token=$token">here</a> to reset your password.</p>
        </body>
    </html>
    END;
    try {
        $mail->send();
        echo "Password reset link has been sent to your email.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }
}