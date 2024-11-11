<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$recipientEmail = $_POST['email'];
$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
try{
$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->Username = "nrenuka1101@gmail.com";
$mail->Password = "rafludomstcrtgkw";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->isHtml(true);

// Sender's email
$mail->setFrom('nrenuka1101@gmail.com', 'Renuka'); // Sender's email address

// Add recipient
$mail->addAddress($recipientEmail); // Replace with the recipient's email address

// Set email subject
$mail->Subject = 'Test Email from PHPMailer';

// Set email body
$mail->Body = 'This is a <b>test email</b> sent using PHPMailer from Gmail SMTP.';

// Send the email
if($mail->send()) {
    echo 'Message sent successfully.';
} else {
    echo 'Message could not be sent.';
}

} catch (Exception $e) {
// If PHPMailer throws an error, display the message
echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
}