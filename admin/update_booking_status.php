<?php
include '../includes/config.php';
session_start();

// Get booking ID and new status from the URL
if (isset($_GET['booking_id']) && isset($_GET['status'])) {
    $booking_id = $_GET['booking_id'];
    $new_status = $_GET['status'];

    // Validate the new status to ensure it's one of the allowed values
    $valid_statuses = ['pending', 'approved', 'canceled'];

    if (in_array($new_status, $valid_statuses)) {
        // Update booking status in the database
        $sql = "UPDATE bookings SET status = ? WHERE booking_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind the parameters and execute the query
            $stmt->bind_param("si", $new_status, $booking_id);

            if ($stmt->execute()) {
                // Redirect back to the manage bookings page
                header("Location: booking_management.php");
                exit();
            } else {
                echo "Error updating booking: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Invalid status value!";
    }
} else {
    echo "Invalid request!";
}
?>
