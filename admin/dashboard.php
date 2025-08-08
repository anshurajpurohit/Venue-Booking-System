<?php
include 'admin_navbar.php';
include '../includes/config.php'; // Include database connection

// Fetch total venues
$sqlVenues = "SELECT COUNT(*) as total_venues FROM venues";
$resultVenues = $conn->query($sqlVenues);
$rowVenues = $resultVenues->fetch_assoc();
$totalVenues = $rowVenues['total_venues'];

// Fetch total bookings
$sqlBookings = "SELECT COUNT(*) as total_bookings FROM bookings";
$resultBookings = $conn->query($sqlBookings);
$rowBookings = $resultBookings->fetch_assoc();
$totalBookings = $rowBookings['total_bookings'];

// Fetch total users
$sqlUsers = "SELECT COUNT(*) as total_users FROM users";
$resultUsers = $conn->query($sqlUsers);
$rowUsers = $resultUsers->fetch_assoc();
$totalUsers = $rowUsers['total_users'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard - Venue Booking System</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js CDN -->
</head>

<body class="bg-light">

    <div class="container mt-5"> <!-- Center container and add margin on top -->
        <main role="main" class="col-md-8 mx-auto"> <!-- Control width and center content -->
            <h1 class="h3 mb-4 text-center">Admin Dashboard</h1> <!-- Smaller header and center it -->
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4" style="background-color: #007bff; color: white;"> <!-- Custom blue background -->
                        <div class="card-body">
                            <h5 class="card-title">Total Venues</h5>
                            <p class="card-text"><?php echo $totalVenues; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4" style="background-color: #28a745; color: white;"> <!-- Custom green background -->
                        <div class="card-body">
                            <h5 class="card-title">Total Bookings</h5>
                            <p class="card-text"><?php echo $totalBookings; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4" style="background-color: #17a2b8; color: white;"> <!-- Custom light blue background -->
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text"><?php echo $totalUsers; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Chart Here -->
            <canvas id="bookingChart" width="400" height="200"></canvas>
        </main>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script> <!-- Your JavaScript file -->
    
</body>
</html>
