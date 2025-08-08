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

// Fetch the venue details along with the category name
$sql = "
    SELECT v.*, c.name AS category_name 
    FROM venues v 
    JOIN categories c ON v.category_id = c.category_id 
    WHERE v.venue_id = ?
";
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

// Handle the form submission for updating the venue
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare an array to hold the fields that need to be updated
    $fields = [];
    $params = [];
    $types = '';

    if (!empty($_POST['name'])) {
        $fields[] = "name = ?";
        $params[] = $_POST['name'];
        $types .= 's'; // 's' for string
    }

    if (!empty($_POST['capacity'])) {
        $fields[] = "capacity = ?";
        $params[] = $_POST['capacity'];
        $types .= 'i'; // 'i' for integer
    }

    if (!empty($_POST['price'])) {
        $fields[] = "price = ?";
        $params[] = $_POST['price'];
        $types .= 'd'; // 'd' for double (decimal)
    }

    if (!empty($_POST['category'])) {
        $fields[] = "category_id = (SELECT category_id FROM categories WHERE name = ?)";
        $params[] = $_POST['category'];
        $types .= 's'; // 's' for string
    }

    if (!empty($_POST['description'])) {
        $fields[] = "description = ?";
        $params[] = $_POST['description'];
        $types .= 's'; // 's' for string
    }

    if (!empty($_FILES['image']['name'])) {
        $fields[] = "image = ?";
        $params[] = $_FILES['image']['name'];
        $types .= 's'; // 's' for string
    }

    // If there are fields to update, proceed with the update
    if (!empty($fields)) {
        $sql = "UPDATE venues SET " . implode(", ", $fields) . " WHERE venue_id = ?";
        $stmt = $conn->prepare($sql);
        $params[] = $id; // Make sure $id holds the correct venue_id
        $types .= 'i'; // 'i' for integer

        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            if (!empty($_FILES['image']['name'])) {
                move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $_FILES['image']['name']);
            }
            echo "Venue updated successfully!";
        } else {
            echo "Error executing query: " . $stmt->error; // Output the execution error
        }
    } else {
        echo "No fields to update!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Venue</title>
</head>
<body>

<h1>Edit Venue</h1>

<form method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name" value="<?php echo htmlspecialchars($venue['name']); ?>" required></td>
        </tr>
        <tr>
            <td>Capacity:</td>
            <td><input type="number" name="capacity" value="<?php echo htmlspecialchars($venue['capacity']); ?>" required></td>
        </tr>
        <tr>
            <td>Price:</td>
            <td><input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($venue['price']); ?>" required></td>
        </tr>
        <tr>
            <td>Category:</td>
            <td><input type="text" name="category" value="<?php echo htmlspecialchars($venue['category_name']); ?>" required></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><textarea name="description" required><?php echo htmlspecialchars($venue['description']); ?></textarea></td>
        </tr>
        <tr>
            <td>Image:</td>
            <td><input type="file" name="image"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Update Venue">
            </td>
        </tr>
    </table>
</form>

</body>
</html>
