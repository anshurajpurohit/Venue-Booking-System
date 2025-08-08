<?php
include 'admin_navbar.php';
include '../includes/config.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

// Check if 'id' is passed via URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "No user ID provided.";
    exit();
}

// Fetch the user details from the database
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "User not found.";
    exit();
}

$user = $result->fetch_assoc();

// Update user details if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update user in the database
    $update_query = "UPDATE users SET name = ?, email = ?, phone = ? WHERE user_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssii", $name, $email, $phone, $id);

    if ($update_stmt->execute()) {
        header("Location: admin/manage_user.php?message=User updated successfully");
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Edit User</title>
</head>
<body>
<div class="container mt-4">
    <h1>Edit User</h1>
    <form method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update User</button>
    </form>
</div>

<script src="../js/script.js"></script>
</body>
</html>
