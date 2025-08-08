<?php
include 'navbar.php';
?>
<?php
include '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

// Fetch user's bookings
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM bookings WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>My Bookings</title>
</head>
<body>

<header>
    <h1>My Bookings</h1>
</header>

<table>
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Venue</th>
            <th>Status</th>
           
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['booking_id']; ?></td>
                <td><?php echo $row['venue_id']; ?></td>
                <td><?php echo $row['status']; ?></td>
                
            </tr>
        <?php } ?>
    </tbody>
</table>

<script src="../js/script.js"></script>
</body>
</html>
