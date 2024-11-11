<?php
$adminname="Admin01";
$password="564932admin";
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
echo " Hashed Password:".$hashedPassword;
?>