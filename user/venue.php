<?php
include 'navbar.php';
include '../includes/config.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$capacity = $_GET['capacity'] ?? '';

// Prepare SQL query to fetch venues
$sql = "SELECT venues.*, categories.name AS category_name FROM venues 
        JOIN categories ON venues.category_id = categories.category_id WHERE 1";

if ($search) {
    $sql .= " AND venues.name LIKE '%$search%'";
}
if ($category) {
    $sql .= " AND venues.category_id = '$category'";
}
if ($capacity) {
    $sql .= " AND venues.capacity >= '$capacity'";
}

$result = $conn->query($sql);

// Fetch categories for the filter dropdown
$category_sql = "SELECT * FROM categories";
$categories = $conn->query($category_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Venues - Venue Booking System</title>
</head>
<body>

<!-- Header -->
<header class="text-center py-4">
    <h1>Explore Our Venues</h1>
</header>

<!-- Search and Filter Form -->
<div class="container my-4">
    <form method="GET" class="form-inline justify-content-center">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search by name" value="<?php echo $search; ?>">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
        <div class="btn-group mx-2" role="group">
            <button id="categoryDropdown" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Category
            </button>
            <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                <a class="dropdown-item" href="?category=">All Categories</a>
                <?php while ($row = $categories->fetch_assoc()) { ?>
                    <a class="dropdown-item" href="?category=<?php echo $row['category_id']; ?>"><?php echo $row['name']; ?></a>
                <?php } ?>
            </div>
        </div>
        <div class="btn-group mx-2" role="group">
            <button id="capacityDropdown" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Capacity
            </button>
            <div class="dropdown-menu" aria-labelledby="capacityDropdown">
                <a class="dropdown-item" href="?capacity=50">50+</a>
                <a class="dropdown-item" href="?capacity=100">100+</a>
                <a class="dropdown-item" href="?capacity=200">200+</a>
                <!-- Add more capacity options as needed -->
            </div>
        </div>
    </form>
</div>

<!-- Venues List -->
<section class="container">
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="col-md-4 my-3">
            <div class="card">
                <img src="../uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text">Capacity: <?php echo $row['capacity']; ?></p>
                    <p class="card-text">Price: Rs.<?php echo $row['price']; ?></p>
                    <p class="card-text">Category: <?php echo $row['category_name']; ?></p>
                    <a href="venue_details.php?venue_id=<?php echo $row['venue_id']; ?>" class="btn btn-info">View Details</a>
                    <a href="booking.php?venue_id=<?php echo $row['venue_id']; ?>" class="btn btn-success">Book Now</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
