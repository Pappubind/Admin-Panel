<?php
include ('includes/header.php')
    ?>
<?php
// Include your database connection file
include 'dbconn.php';

// Initialize variables
$id = $_GET['id'] ?? null;

// Retrieve service details based on ID
$query = "SELECT * FROM service WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$service = $result->fetch_assoc();

// Close statement and connection
$stmt->close();
$conn->close();
?>

<div class="container">
    <h2>Edit Service</h2>
    <a href="services.php" class="btn btn-primary float-end">Back</a>
    <form action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($service['id']); ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                value="<?php echo htmlspecialchars($service['name']); ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description"
                name="description"><?php echo htmlspecialchars($service['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image1" class="form-label">Image 1</label>
            <input type="file" class="form-control" id="image1" name="image1"<?php echo htmlspecialchars($service['image1']); ?>>
        </div>
        <div class="mb-3">
            <label for="image2" class="form-label">Image 2</label>
            <input type="file" class="form-control" id="image2" name="image2">
        </div>
        <div class="mb-3">
            <label for="image3" class="form-label">Image 3</label>
            <input type="file" class="form-control" id="image3" name="image3">
        </div>
        <button type="submit" name="update_service" class="btn btn-primary">Update Service</button>
    </form>
</div>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>