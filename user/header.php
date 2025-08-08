<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php echo isset($title) ? $title : 'Venue Booking System'; ?></title>
</head>
<body>

<header>
    <nav>
        <div class="nav-toggle">Menu</div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="venue.php">Venues</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="signin.php">Sign In</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

