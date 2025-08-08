<?php
// Start session
session_start();

// Destroy session
session_destroy();

// Redirect to user login page
header("Location: signin.php");
exit();
?>
