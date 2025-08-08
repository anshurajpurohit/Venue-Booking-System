<?php  
include 'navbar.php';
?>
<?php
include '../includes/config.php';

// Fetch some venues to display on the home page
$sql = "SELECT * FROM venues ORDER BY RAND() LIMIT 6";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <!-- Include Bootstrap CSS and JS (jQuery is required for Bootstrap carousel) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <title>Home - Venue Booking System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        /* Header Styling */
        header {
            text-align: center;
            padding: 20px 0 20px;
            background-color: #007bff;
            color: #fff;
        }
        header h1 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 1px 1px #0056b3;
        }
        /* Carousel Styling */
        #venueCarousel {
            position: relative;
        }
        #venueCarousel .carousel-item img {
            height: 500px;
            object-fit: cover;
            filter: brightness(70%);
        }
        #venueCarousel .carousel-caption {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            text-align: center;
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
            background: rgba(0, 0, 0, 0.4);
            padding: 15px 30px;
            border-radius: 8px;
        }
        /* Scrolling Ads Styling */
        .scrolling-ads {
            background-color: #ffeb3b;
            padding: 15px 0;
            overflow: hidden;
            white-space: nowrap;
            color: #333;
            font-size: 1.25rem;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .scrolling-ads span {
            margin: 0 50px;
            animation: scrollLeft 10s linear infinite;
        }
        @keyframes scrollLeft {
            from { transform: translateX(100%); }
            to { transform: translateX(-100%); }
        }
        /* Book Now Button Styling */
        .book-now {
            text-align: center;
            margin: 30px 0;
        }
        .book-now a {
            padding: 15px 30px;
            font-size: 1.25rem;
            font-weight: bold;
            color: #fff;
            background: #28a745;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        .book-now a:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <h1>Welcome to the Venue Booking System</h1>
</header>



<!-- Image Slider with Captions -->
<div id="venueCarousel" class="carousel slide mb-5" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../images/slider1.jpg" class="d-block w-100" alt="Venue Image 1">
      
    </div>
    <div class="carousel-item">
      <img src="../images/slider2.jpg" class="d-block w-100" alt="Venue Image 2">
      
    </div>
    <div class="carousel-item">
      <img src="../images/slider3.jpg" class="d-block w-100" alt="Venue Image 3">
      
    </div>
  </div>
  <a class="carousel-control-prev" href="#venueCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#venueCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- Book Now Button -->
<div class="book-now">
    <a href="venue.php" class="btn btn-primary">Book Now</a>
</div>


<!-- Scrolling Ads -->
<div class="scrolling-ads">
    <span>Special Offer: Book now and get 10% off on all venues!</span>
    <span>New Venues Added! Check out our latest listings.</span>
    <span>Exclusive Deal: 15% discount on bookings over Rs.50000!</span>
    <span>Special Offer: Book now and get 10% off on all venues!</span>
    <span>New Venues Added! Check out our latest listings.</span>
    <span>Exclusive Deal: 15% discount on bookings over Rs.50000!</span>
</div>

<!-- Display Random Venues -->
<section class="venues">
    <h2>Featured Venues</h2>
    <div class="venue-list">
        <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="venue-item">
            <img src="../uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="img-thumbnail">
            <div class="p-3">
                <h3><?php echo $row['name']; ?></h3>
                <p>Capacity: <?php echo $row['capacity']; ?></p>
                <p>Price: Rs.<?php echo $row['price']; ?></p>
                <div class="venue-actions">
                    <a href="venue_details.php?venue_id=<?php echo $row['venue_id']; ?>" class="btn btn-info">View Details</a>
                    <a href="booking.php?venue_id=<?php echo $row['venue_id']; ?>" class="btn btn-success">Book Now</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>Developed by Anshuman Rajpurohit</p>
</footer>

<script src="../js/script.js"></script>
</body>
</html>
