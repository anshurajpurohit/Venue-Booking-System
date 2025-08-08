<?php
include 'admin_navbar.php';
include '../includes/config.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

// Fetch all venues
$sql = "SELECT venues.*, categories.name AS category_name FROM venues 
        JOIN categories ON venues.category_id = categories.category_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>View Venues</title>
</head>
<body>

<!-- Header -->
<header>
    <h1>View Venues</h1>
</header>

<!-- Venue List -->
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Capacity</th>
            <th>Price</th>
            <th>Category</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['capacity']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['category_name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><img src="../uploads/<?php echo $row['image']; ?>" alt="Venue Image" width="100"></td>
            <td>
                <a href="edit_venue.php?id=<?php echo $row['venue_id']; ?>" class="btn btn-warning">Edit</a> |
                <a href="delete_venue.php?id=<?php echo $row['venue_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script src="../js/script.js"></script>
</body>
</html>
