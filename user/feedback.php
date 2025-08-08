<?php
include 'navbar.php';// Include the user navbar

include '../includes/config.php'; // Make sure your DB connection is here

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $feedback = $_POST['feedback'];

    // Prepare the SQL statement
    $sql = "INSERT INTO feedback (user_id, feedback) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if prepare() failed
    if (!$stmt) {
        die("SQL preparation failed: " . $conn->error);
    }

    // Bind parameters and execute
    if ($stmt->bind_param("is", $user_id, $feedback) && $stmt->execute()) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error submitting feedback: " . $stmt->error; // Display the error from executing the statement
    }

    $stmt->close(); // Close the statement
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Feedback</title>
</head>
<body>

<header>
    <h1>Submit Your Feedback</h1>
</header>

<form method="POST">
    <label for="feedback">Your Feedback:</label>
    <textarea name="feedback" id="feedback" rows="5" required></textarea>
    <button type="submit">Submit Feedback</button>
</form>

</body>
</html>
