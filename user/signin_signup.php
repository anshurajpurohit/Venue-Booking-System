<?php
include 'navbar.php';
?>
<?php
include '../includes/config.php';
session_start();

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
                header('Location: venues.php');
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found!";
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
            header('Location: signin_signup.php');
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Sign In / Sign Up</title>
</head>
<body>

<!-- Sign In Form -->
<form method="POST">
    <h2>Sign In</h2>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="signin">Sign In</button>
</form>

<!-- Sign Up Form -->
<form method="POST">
    <h2>Sign Up</h2>
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="phone" placeholder="Phone Number" required>
    <textarea name="address" placeholder="Address" required></textarea>
    <button type="submit" name="signup">Sign Up</button>
</form>

<script src="../js/script.js"></script>
</body>
</html>
