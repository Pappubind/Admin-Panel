<?php
// Include your database connection file
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_service'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    // File upload handling
    $target_dir = "service/";
    $image1 = $service['image1']; // Initialize with existing image paths
    $image2 = $service['image2'];
    $image3 = $service['image3'];

    // Check if new image files are uploaded
    if (!empty($_FILES['image1']['name'])) {
        $image1 = $target_dir . basename($_FILES["image1"]["name"]);
        move_uploaded_file($_FILES["image1"]["tmp_name"], $image1);
    }
    if (!empty($_FILES['image2']['name'])) {
        $image2 = $target_dir . basename($_FILES["image2"]["name"]);
        move_uploaded_file($_FILES["image2"]["tmp_name"], $image2);
    }
    if (!empty($_FILES['image3']['name'])) {
        $image3 = $target_dir . basename($_FILES["image3"]["name"]);
        move_uploaded_file($_FILES["image3"]["tmp_name"], $image3);
    }

    // Update query
    $query = "UPDATE service SET name = ?, description = ?, image1 = ?, image2 = ?, image3 = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssi', $name, $description, $image1, $image2, $image3, $id);

    if ($stmt->execute()) {
        // Set a session message for success
        session_start();
        $_SESSION['message'] = "Service updated successfully.";
        $_SESSION['message_type'] = "success";
    } else {
        // Set a session message for error
        session_start();
        $_SESSION['message'] = "Failed to update service.";
        $_SESSION['message_type'] = "danger";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to services page or any other appropriate page
    header("Location: services.php");
    exit();
} else {
    // Redirect back to services page if accessed directly
    header("Location: services.php");
    exit();
}
?>
