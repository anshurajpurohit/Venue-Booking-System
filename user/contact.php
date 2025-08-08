<?php 
include 'navbar.php'; // Include the user navbar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Contact Us - Venue Booking System</title>
    <style>
        body {
            background-color: #f4f4f4; /* Light background for the entire page */
        }

        header {
            background-color: #007bff; /* Header background color */
            color: white;
            padding: 15px 0;
            text-align: center;
            border-bottom: 2px solid #0056b3; /* Bottom border for visual separation */
        }

        .contact {
            max-width: 600px; /* Center the form */
            margin: 30px auto; /* Center the section horizontally */
            padding: 20px; /* Add some padding */
            background-color: white; /* White background for contrast */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .contact h2 {
            color: #333; /* Darker text for headings */
            margin-bottom: 20px; /* Spacing below heading */
            border-bottom: 2px solid #007bff; /* Bottom border for heading */
            padding-bottom: 10px; /* Spacing below heading */
        }

        .contact label {
            font-weight: bold; /* Bold labels for clarity */
            margin-top: 10px; /* Space above labels */
        }

        .contact input,
        .contact textarea {
            width: 100%; /* Full width inputs */
            padding: 10px; /* Padding for comfort */
            margin: 10px 0; /* Margin for spacing */
            border: 1px solid #ccc; /* Light border */
            border-radius: 4px; /* Rounded corners */
        }

        .contact button {
            background-color: #007bff; /* Button background color */
            color: white; /* Button text color */
            border: none; /* Remove border */
            padding: 10px 15px; /* Button padding */
            border-radius: 4px; /* Rounded corners */
            cursor: pointer; /* Pointer on hover */
            transition: background-color 0.3s; /* Transition for hover effect */
        }

        .contact button:hover {
            background-color: #0056b3; /* Darker blue on hover */
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
    </style>
</head>
<body>

<!-- Header -->
<header>
    <h1>Contact Us</h1>
</header>

<!-- Contact Form -->
<section class="contact">
    <h2>Get in Touch</h2>
    <form action="contact_process.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit" class="btn">Send Message</button>
    </form>
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
