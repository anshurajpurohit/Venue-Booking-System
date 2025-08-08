<?php
session_start();
include '../includes/config.php';

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    // Optionally, redirect to the sign-in page if needed
}

// Check if the id parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Get the venue ID from the URL
} else {
    echo "No venue ID provided.";
    exit(); // Exit if no ID is provided
}

// Fetch the venue details
$sql = "SELECT * FROM venues WHERE venue_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the venue was found
if ($result->num_rows === 0) {
    echo "No venue found with this ID.";
    exit(); // Exit if no venue is found
}

$venue = $result->fetch_assoc(); // Fetch the venue details

// Handle the deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete_sql = "DELETE FROM venues WHERE venue_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param('i', $id);

    if ($delete_stmt->execute()) {
        echo "Venue deleted successfully!";
        // Optionally, redirect to the view venue page or admin dashboard
        header("Location: view_venue.php?message=Venue deleted successfully");
        exit();
    } else {
        echo "Error deleting venue: " . $delete_stmt->error; // Output the execution error
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Venue</title>
</head>
<body>

<h1>Delete Venue</h1>

<form method="POST">
    <table>
        <tr>
            <td>Venue Name:</td>
            <td><?php echo htmlspecialchars($venue['name']); ?></td>
        </tr>
        <tr>
            <td>Capacity:</td>
            <td><?php echo htmlspecialchars($venue['capacity']); ?></td>
        </tr>
        <tr>
            <td>Price:</td>
            <td><?php echo htmlspecialchars($venue['price']); ?></td>
        </tr>
        <tr>
            <td>Category:</td>
            <td><?php echo htmlspecialchars($venue['category_id']); // Assuming you want to show the category ID ?></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><?php echo htmlspecialchars($venue['description']); ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <p>Are you sure you want to delete this venue?</p>
                <input type="submit" value="Delete Venue">
                <a href="view_venue.php">Cancel</a>
            </td>
        </tr>
    </table>
</form>

</body>
</html>
