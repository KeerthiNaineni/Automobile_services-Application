<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);

    $stmt = $conn->prepare("INSERT INTO feedback (username, email, feedback_content) VALUES (:username, :email, :feedback)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':feedback', $feedback);

    try {
        $stmt->execute();
        header("Location: thank_you.php");
        exit();
        
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>