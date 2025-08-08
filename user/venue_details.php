<?php
include 'navbar.php'; // Include your navbar
include '../includes/config.php'; // Include your database connection

// Get the venue ID from the URL
$venue_id = $_GET['venue_id'] ?? '';

if ($venue_id) {
    // Prepare SQL query to fetch venue details
    $sql = "SELECT venues.*, categories.name AS category_name FROM venues 
            JOIN categories ON venues.category_id = categories.category_id 
            WHERE venues.venue_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $venue_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if the venue exists
    if ($result->num_rows > 0) {
        $venue = $result->fetch_assoc();
    } else {
        echo "<h2 class='error-message'>Venue not found!</h2>";
        exit();
    }
} else {
    echo "<h2 class='error-message'>Invalid venue ID!</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php echo htmlspecialchars($venue['name']); ?> - Venue Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }

        .venue-detail {
            display: flex;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .venue-detail .venue-image {
            flex: 1;
            padding-right: 20px;
        }

        .venue-detail .venue-image img {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .venue-detail .venue-info {
            flex: 2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .venue-info h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #333;
        }

        .venue-info p {
            margin: 10px 0;
            font-size: 1.1em;
            color: #555;
        }

        .venue-info p strong {
            color: #007BFF;
        }

        .venue-actions {
            margin-top: 20px;
        }

        .venue-actions .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
        }

        .venue-actions .btn:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #ff0000;
            text-align: center;
            margin: 20px;
        }
    </style>
</head>
<body>

<!-- Venue Detail Section -->
<section class="venue-detail">
    <div class="venue-image">
        <img src="../uploads/<?php echo htmlspecialchars($venue['image']); ?>" alt="<?php echo htmlspecialchars($venue['name']); ?>">
    </div>

    <div class="venue-info">
        <h1><?php echo htmlspecialchars($venue['name']); ?></h1>
        <p><strong>Category:</strong> <?php echo htmlspecialchars($venue['category_name']); ?></p>
        <p><strong>Capacity:</strong> <?php echo htmlspecialchars($venue['capacity']); ?></p>
        <p><strong>Price:</strong> Rs. <?php echo htmlspecialchars($venue['price']); ?></p>
        <p><strong>Description:</strong><br> <?php echo nl2br(htmlspecialchars($venue['description'])); ?></p>

        <!-- Book Now Button -->
        <div class="venue-actions">
            <a href="booking.php?venue_id=<?php echo htmlspecialchars($venue['venue_id']); ?>" class="btn">Book Now</a>
        </div>
    </div>
</section>

<script src="../js/script.js"></script>
</body>
</html>
