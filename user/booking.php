<?php
session_start(); // Start session
include 'navbar.php';
include '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$venue_id = $_GET['venue_id'];

// Fetch the venue details (including price) based on the venue_id
$sql = "SELECT * FROM venues WHERE venue_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $venue_id);
$stmt->execute();
$venue = $stmt->get_result()->fetch_assoc();

// Get the venue price for payment (assuming it's stored in the 'price' column)
$calculated_amount = $venue['price']; // Assuming price is in INR

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_date = $_POST['booking_date'];

    // Insert the booking into the database
    $sql = "INSERT INTO bookings (user_id, venue_id, booking_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $user_id, $venue_id, $booking_date);
    
    if ($stmt->execute()) {
        // Redirect to payment page with booking_id, venue_id, and calculated amount
        if (is_numeric($calculated_amount)) {
            header('Location: ../payment/payment.php?booking_id=' . $conn->insert_id . '&venue_id=' . $venue_id . '&amount=' . $calculated_amount);
            exit(); // Make sure to exit after header redirect
        } else {
            echo "Invalid amount!";
            exit();
        }
    } else {
        // Handle error, show message and optionally log the error
        echo "Error: " . $stmt->error;
        error_log("Booking insertion failed: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Book Venue</title>
</head>
<body>

<!-- Header -->
<header>
    <h1>Book <?php echo htmlspecialchars($venue['name']); ?></h1>
</header>

<!-- Booking Form -->
<form method="POST">
    <label for="booking_date">Select Start Date</label>
    <input type="date" name="booking_date" required>
    
    <label for="booking_date">Select End Date</label>
    <input type="date" name="end_booking_date" required>
    <button type="submit">Proceed to Payment</button>
</form>

<script src="../js/script.js"></script>
</body>
</html>
