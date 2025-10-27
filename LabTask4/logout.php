<?php
// Start session and destroy it to log out the user
session_start();
session_destroy();

// Redirect to login page
header('Location: login.php');
exit();
?>
