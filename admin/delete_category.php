<?php
include 'admin_navbar.php';
include '../includes/db_connect.php'; // Include the database connection

// Check if 'id' is passed via URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the category details to confirm deletion
    $query = "SELECT * FROM categories WHERE category_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Category not found.";
        exit();
    }

    $category = $result->fetch_assoc();

    // Handle deletion on form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Prepare the DELETE query
        $delete_query = "DELETE FROM categories WHERE category_id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $id);

        // Execute the query
        if ($delete_stmt->execute()) {
            header("Location: view_category.php?message=Category deleted successfully");
            exit();
        } else {
            echo "Error deleting category: " . $conn->error;
        }
    }
} else {
    echo "No category ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Delete Category</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Delete Category</h2>
        <form method="POST">
            <table class="table table-bordered">
                <tr>
                    <td><strong>Category ID:</strong></td>
                    <td><?php echo htmlspecialchars($category['category_id']); ?></td>
                </tr>
                <tr>
                    <td><strong>Category Name:</strong></td>
                    <td><?php echo htmlspecialchars($category['name']); ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <p>Are you sure you want to delete this category?</p>
                        <button type="submit" class="btn btn-danger">Delete Category</button>
                        <a href="view_category.php" class="btn btn-secondary">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
