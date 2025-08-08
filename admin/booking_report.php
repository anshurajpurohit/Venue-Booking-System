<?php
include 'admin_navbar.php';
include '../includes/config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

// Fetch reports: Bookings, Payments, Feedbacks
$booking_report = "SELECT * FROM bookings";
$payment_report = "SELECT * FROM payments";
$feedback_report = "SELECT * FROM feedback";

// Execute queries and check for errors
$booking_result = $conn->query($booking_report);
if ($booking_result === false) {
    echo "Error in booking report query: " . $conn->error;
    exit();
}

$payment_result = $conn->query($payment_report);
if ($payment_result === false) {
    echo "Error in payment report query: " . $conn->error;
    exit();
}

$feedback_result = $conn->query($feedback_report);
if ($feedback_result === false) {
    echo "Error in feedback report query: " . $conn->error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin Reports</title>
</head>
<body>

<header>
    <h1>Reports</h1>
</header>

<h2>Booking Reports</h2>
<table>
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Venue</th>
            <th>User</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $booking_result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['booking_id']; ?></td>
                <td><?php echo $row['venue_id']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['booking_date']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<script src="../js/script.js"></script>
</body>
</html>
