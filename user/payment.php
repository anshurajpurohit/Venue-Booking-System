<?php
include 'navbar.php';
include '../includes/config.php';
session_start();

// Redirect user to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

$paymentSuccess = false; // Flag to track payment success

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get booking ID and payment amount from form submission
    $booking_id = $_POST['booking_id'];
    $amount = $_POST['amount'];

    // Ensure amount is valid (greater than zero)
    if ($amount <= 0) {
        echo "Invalid amount!";
        exit();
    }

    // Prepare SQL query to insert payment record
    $sql = "INSERT INTO payments (booking_id, amount, payment_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    // Check if prepare() succeeded
    if ($stmt === false) {
        // Output error message for debugging
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    // Bind parameters to the SQL query
    $stmt->bind_param("ii", $booking_id, $amount);

    // Execute the query and handle success/failure
    if ($stmt->execute()) {
        $paymentSuccess = true; // Set success flag to true
    } else {
        // Display error message for debugging
        echo "Payment failed: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Payment</title>
    <script type="text/javascript">
        // Show alert if payment is successful and redirect to venue page
        function showPaymentSuccess() {
            alert("Payment successful!");
            window.location.href = "venue.php"; // Redirect to the venue page
        }
    </script>
</head>
<body>

<header>
    <h1>Payment</h1>
</header>

<!-- Payment Form -->
<form method="POST">
    <label for="amount">Amount:</label>
    <input type="number" name="amount" id="amount" required min="1">
    <input type="hidden" name="booking_id" value="<?php echo $_GET['booking_id']; ?>">
    <button type="submit">Pay Now</button>
</form>

<?php
// If payment was successful, trigger JavaScript alert and redirect
if ($paymentSuccess) {
    echo "<script>showPaymentSuccess();</script>";
}
?>

<script src="../js/script.js"></script>
</body>
</html>
