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
    
    // Prepare the DELETE query
    $delete_query = "DELETE FROM users WHERE user_id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $id);
    
    // Execute the query
    if ($delete_stmt->execute()) {
        header("Location: manage_user.php?message=User deleted successfully");
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "No user ID provided.";
}
?>
