<?php
include 'navbar.php';
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($_POST['signin'])) {
        // Sign In Logic
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                header('Location: venue.php');
            } else {
                echo "<div class='alert alert-danger'>Incorrect password!</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>User not found!</div>";
        }

    } elseif (isset($_POST['signup'])) {
        // Sign Up Logic
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $hash_password, $phone, $address);

        if ($stmt->execute()) {
            header('Location: signin.php');
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Sign Up</title>
    <style>
        body {
            background-color: #f4f4f4; /* Light background for the entire page */
        }
        .container {
            max-width: 400px; /* Center the form */
            margin: 50px auto; /* Center the section horizontally */
            padding: 20px; /* Add some padding */
            background-color: white; /* White background for contrast */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        h2 {
            text-align: center; /* Center the heading */
            margin-bottom: 20px; /* Space below heading */
            color: #333; /* Dark text color */
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%; /* Full width inputs */
            padding: 10px; /* Padding for comfort */
            margin: 10px 0; /* Margin for spacing */
            border: 1px solid #ccc; /* Light border */
            border-radius: 4px; /* Rounded corners */
        }
        button {
            width: 100%; /* Full width button */
            padding: 10px; /* Padding for button */
            border: none; /* Remove border */
            border-radius: 4px; /* Rounded corners */
            background-color: #007bff; /* Button background color */
            color: white; /* Button text color */
            cursor: pointer; /* Pointer on hover */
            transition: background-color 0.3s; /* Transition for hover effect */
        }
        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .toggle-link {
            text-align: center; /* Center the toggle link */
            margin-top: 15px; /* Space above link */
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Sign Up Form -->
    <h2>Sign Up</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <textarea name="address" placeholder="Address" rows="3" required></textarea>
        <button type="submit" name="signup">Sign Up</button>
    </form>
    
    <div class="toggle-link">
        <p>Already have an account? <a href="signin.php">Sign In</a></p>
    </div>
</div>

<script src="../js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
