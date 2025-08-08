<?php
include 'admin_navbar.php';
include '../includes/db_connect.php'; // Include the database connection

// Check if 'id' is passed via URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "No category ID provided.";
    exit();
}

// Fetch the category details from the database
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

// Update the category if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_category_name = $_POST['category_name'];
    
    // Update the category name in the database
    $update_query = "UPDATE categories SET name = ? WHERE category_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("si", $new_category_name, $id);

    if ($update_stmt->execute()) {
        header("Location: view_category.php?message=Category updated successfully");
        exit();
    } else {
        echo "Error updating category: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Category</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Category</h2>
        <form method="POST">
            <table class="table table-bordered">
                <tr>
                    <td><label for="category_name">Category Name</label></td>
                    <td>
                        <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary mt-3">Update Category</button>
                        <a href="view_category.php" class="btn btn-secondary mt-3">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
