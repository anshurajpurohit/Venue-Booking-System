<?php
include 'admin_navbar.php';
include '../includes/config.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

// Fetch all categories
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>View Categories</title>
</head>
<body>

<!-- Header -->
<header>
    <h1>View Categories</h1>
</header>

<!-- Category List -->
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td>
                <a href="edit_category.php?id=<?php echo $row['category_id']; ?>" class="btn btn-warning">Edit</a>
                <a href="delete_category.php?id=<?php echo $row['category_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script src="../js/script.js"></script>
</body>
</html>
