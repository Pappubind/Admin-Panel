<?php
// Include your database connection file
include 'dbconn.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Define the target directory
    $target_dir = "service/";

    // Create the target directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $image1 = $target_dir . basename($_FILES["image1"]["name"]);
    $image2 = $target_dir . basename($_FILES["image2"]["name"]);
    $image3 = $target_dir . basename($_FILES["image3"]["name"]);

    $temp_image1 = $_FILES["image1"]["tmp_name"];
    $temp_image2 = $_FILES["image2"]["tmp_name"];
    $temp_image3 = $_FILES["image3"]["tmp_name"];

    $uploadOk = 1;

    // Check if image files are actual images or fake images
    $check1 = getimagesize($_FILES["image1"]["tmp_name"]);
    $check2 = getimagesize($_FILES["image2"]["tmp_name"]);
    $check3 = getimagesize($_FILES["image3"]["tmp_name"]);
    if ($check1 !== false && $check2 !== false && $check3 !== false) {
        echo "Files are images - " . $check1["mime"] . ", " . $check2["mime"] . ", " . $check3["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "Files are not images.<br>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    $imageFileType1 = strtolower(pathinfo($image1, PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($image2, PATHINFO_EXTENSION));
    $imageFileType3 = strtolower(pathinfo($image3, PATHINFO_EXTENSION));
    if (
        $imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
        && $imageFileType1 != "gif" && $imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg"
        && $imageFileType2 != "gif" && $imageFileType3 != "jpg" && $imageFileType3 != "png" && $imageFileType3 != "jpeg"
        && $imageFileType3 != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your files were not uploaded.<br>";
    } else {
        if (move_uploaded_file($temp_image1, $image1) && move_uploaded_file($temp_image2, $image2) && move_uploaded_file($temp_image3, $image3)) {
            echo "The files " . basename($image1) . ", " . basename($image2) . " and " . basename($image3) . " have been uploaded.<br>";

            // Insert data into database using mysqli_query
            $sql = "INSERT INTO service (id, name, description, image1, image2, image3) VALUES ('$id','$name', '$description', '$image1', '$image2', '$image3')";

            if (mysqli_query($conn, $sql)) {
                // Set a session message for success
                session_start();
                $_SESSION['message'] = "Service added successfully.";
                $_SESSION['message_type'] = "success";

                // Redirect to service.php after successful insertion
                header("Location: services.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn) . "<br>";
            }

            // Close connection
            mysqli_close($conn);
        } else {
            echo "Sorry, there was an error uploading your files.<br>";
        }
    }
} else {
    echo "No form data submitted.<br>";
}


?>
