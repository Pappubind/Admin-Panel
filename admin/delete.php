<?php
// Include your database connection file
include 'dbconn.php';

// Start the session before any output
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_service'])) {
        $id = $_POST['delete_id'];

        // Prepare the DELETE query
        $query = "DELETE FROM service WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            // Set a session message for success
            $_SESSION['message'] = "Service deleted successfully.";
            $_SESSION['message_type'] = "success";
        } else {
            // Set a session message for error
            $_SESSION['message'] = "Failed to delete service.";
            $_SESSION['message_type'] = "danger";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Set a session message for error
        $_SESSION['message'] = "Invalid service ID.";
        $_SESSION['message_type'] = "danger";
    }

    // Redirect back to services page
    header("Location: services.php");
    exit();
} else {
    // Redirect back to services page if accessed directly
    header("Location: services.php");
    exit();
}
?>
