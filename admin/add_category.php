
<?php
include 'admin_navbar.php';
include '../includes/config.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    
    $sql = "INSERT INTO categories (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    
    if ($stmt->execute()) {
        echo "Category added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Add Category</title>
</head>
<body>

<!-- Header -->
<header>
    <h1>Add Category</h1>
</header>

<!-- Add Category Form -->
<form method="POST">
    <input type="text" name="name" placeholder="Category Name" required>
    <button type="submit">Add Category</button>
</form>

<script src="../js/script.js"></script>
</body>
</html>
