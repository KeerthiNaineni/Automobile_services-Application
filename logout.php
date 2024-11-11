<?php
session_start();
session_unset();
session_destroy(); // Destroys all session data
header("Location:firstpage.php"); 
exit();// Redirect to login page after logout
?>