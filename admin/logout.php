<?php
// Start session
session_start();

// Destroy session
session_destroy();

// Redirect to admin login page
header("Location: index.php");
exit();
?>
