<?php
$host = 'localhost'; // or your host
$user = 'root';
$password = '';
$database = 'services';

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>