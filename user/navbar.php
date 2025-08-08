<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}
?>

<nav class="navbar">
    <div class="navbar-container">
        <a href="home.php" class="navbar-logo">Venue Booking</a>
        <ul class="navbar-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="venue.php">Venues</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="mybooking.php">My Bookings</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li>
                    <a href="profile.php" class="profile-link">
                        <img src="../images/default-profile.png" alt="Profile" class="profile-image">
                    </a>
                </li>
                <li><a href="user_logout.php" class="logout-link" onclick="return confirm('Are you sure you want to logout?');">Logout</a></li>
            <?php else: ?>
                <li><a href="signin.php" class="auth-link">Sign In</a></li>
                <li><a href="signup.php" class="auth-link">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- Styles for Navbar -->
<style>
    /* Navbar Styles */
    .navbar {
        background-color: #4CAF50;
        padding: 15px 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    /* Logo */
    .navbar-logo {
        color: #fff;
        font-size: 1.8rem;
        font-weight: bold;
        text-decoration: none;
    }

    /* Navbar Links */
    .navbar-links {
        list-style: none;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .navbar-links a {
        color: #fff;
        text-decoration: none;
        font-size: 1rem;
        padding: 15px 15px;
        border-radius: 10px;
        transition: background-color 0.3s, color 0.3s;
    }

    .navbar-links a:hover {
        background-color: #388E3C;
    }

    /* Profile Image */
    .profile-link {
        display: flex;
        align-items: center;
    }

    .profile-image {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid #fff;
        transition: transform 0.3s ease;
    }

    .profile-image:hover {
        transform: scale(1.1);
    }

    /* Logout Link */
    .logout-link {
        background-color: #e74c3c;
        padding: 10px 15px;
        color: #fff;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .logout-link:hover {
        background-color: #c0392b;
    }

    /* Auth Links */
    .auth-link {
        background-color: #1976D2;
        padding: 10px 15px;
        color: #fff;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .auth-link:hover {
        background-color: #1565C0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .navbar-container {
            flex-direction: column;
        }

        .navbar-links {
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .navbar-links a {
            text-align: center;
            width: 100%;
        }
    }
</style>
