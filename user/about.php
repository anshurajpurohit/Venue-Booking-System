<?php
include 'navbar.php'; // Include the user navbar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="description" content="About Us - Venue Booking System, providing a seamless venue booking experience.">
    <meta name="keywords" content="Venue Booking, Event Planning, Anshuman Rajpurohit, Ayaan Shaikh">
    <title>About Us - Venue Booking System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS for About Us Page */
        body {
            background-color: #f4f4f4; /* Light background for the entire page */
        }
        header {
            background-color: #007bff; /* Header background color */
            color: white;
            padding: 15px 0;
            text-align: center;
            border-bottom: 2px solid #0056b3; /* Border for visual separation */
        }

        .about-us {
            max-width: 800px; /* Center the content */
            margin: 30px auto; /* Center the section horizontally */
            padding: 20px; /* Add some padding */
            background-color: white; /* White background for contrast */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .about-us h2 {
            color: #333; /* Darker text for headings */
            margin-top: 20px; /* Spacing above headings */
            border-bottom: 2px solid #007bff; /* Bottom border for headings */
            padding-bottom: 10px; /* Spacing below headings */
        }

        .about-us p {
            line-height: 1.6; /* Improve readability */
            color: #666; /* Slightly lighter text color */
        }

        .about-us img {
            width: 100%; /* Responsive image */
            height: auto; /* Maintain aspect ratio */
            border-radius: 8px; /* Rounded corners for images */
            margin-top: 15px; /* Spacing above images */
        }

        footer {
            text-align: center;
            padding: 15px 0;
            background-color: #007bff; /* Footer background color */
            color: white;
            position: relative;
            bottom: 0;
            width: 100%; /* Full width footer */
            margin-top: 30px; /* Space between content and footer */
        }

        /* Responsive Media Queries */
        @media (max-width: 768px) {
            .about-us {
                padding: 15px; /* Reduce padding on smaller screens */
            }

            header h1 {
                font-size: 2rem; /* Adjust heading size */
            }
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <h1>About Us</h1>
</header>

<!-- About Us Content -->
<section class="about-us">
    <h2>Our Mission</h2>
    <p>We aim to provide a seamless venue booking experience, connecting users with a variety of venues for all their events.</p>

    <img src="../images/slider3.jpg" alt="Our Team">
    <p>Our team consists of passionate individuals dedicated to making your event memorable.</p>
    
    <h2>Contact Us</h2>
    <p>If you have any questions, feel free to reach out to us through our <a href="contact.php" class="text-primary">contact page</a> or email us at <a href="mailto:anshuman7825@gmail.com" class="text-primary">anshuman7825@gmail.com</a>.</p>
</section>

<!-- Footer -->
<footer>
    <p>Developed by Anshuman Rajpurohit</p>
</footer>

<script src="../js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
