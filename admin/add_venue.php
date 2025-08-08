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
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $target = "../uploads/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO venues (name, capacity, price, category_id, description, image) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siidss", $name, $capacity, $price, $category_id, $description, $image);
        
        if ($stmt->execute()) {
            echo "Venue added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}

// Fetch categories for the dropdown
$category_sql = "SELECT * FROM categories";
$categories = $conn->query($category_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Add Venue</title>
</head>
<body>

<!-- Header -->
<header>
    <h1>Add Venue</h1>
</header>

<!-- Add Venue Form -->
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Venue Name" required>
    <input type="number" name="capacity" placeholder="Capacity" required>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php while ($row = $categories->fetch_assoc()) { ?>
            <option value="<?php echo $row['category_id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select>
    <textarea name="description" placeholder="Venue Description" required></textarea>
    <input type="file" name="image" required>
    <button type="submit">Add Venue</button>
</form>

<script src="../js/script.js"></script>
</body>
</html>
