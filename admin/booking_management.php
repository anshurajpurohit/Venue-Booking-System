<?php 
include 'admin_navbar.php';
include '../includes/config.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

// Fetch only pending bookings sorted from oldest to newest
$sql = "SELECT bookings.*, venues.name AS venue_name, users.name AS user_name 
        FROM bookings 
        JOIN venues ON bookings.venue_id = venues.venue_id 
        JOIN users ON bookings.user_id = users.user_id 
        WHERE bookings.status = 'pending'
        ORDER BY bookings.booking_date ASC"; // Order by booking date (old to new)
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Manage Bookings</title>
    <style>
        .btn {
            padding: 6px 12px;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            margin-right: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-approve { background-color: #28a745; }
        .btn-cancel { background-color: #dc3545; }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>

<header>
    <h1>Manage Pending Bookings</h1>
</header>

<table>
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Venue</th>
            <th>User</th>
            <th>Booking Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['booking_id']; ?></td>
            <td><?php echo $row['venue_name']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['booking_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="update_booking_status.php?booking_id=<?php echo $row['booking_id']; ?>&status=approved" class="btn btn-approve">Approve</a>
                <a href="update_booking_status.php?booking_id=<?php echo $row['booking_id']; ?>&status=canceled" class="btn btn-cancel">Cancel</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script src="../js/script.js"></script>

</body>
</html>
