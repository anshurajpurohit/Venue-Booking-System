<?php
include 'navbar.php';
?>
<?php
include '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name = ?, email = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $email, $user_id);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile!";
    }
}

$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Profile</title>
</head>
<body>

<header>
    <h1>Profile</h1>
</header>

<form method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required>

    <button type="submit">Update Profile</button>
</form>

<script src="../js/script.js"></script>
</body>
</html>
