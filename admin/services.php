<?php
// Start the session before any output
session_start();

// Include your config or function file here
include ('includes/header.php'); // Adjust the path as per your file structure
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Services
                    <a href="service.php" class="btn btn-primary float-end">Add Services</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive"> <!-- Ensures the table is responsive -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image1</th>
                                <th>Image2</th>
                                <th>Image3</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'dbconn.php';
                            $query = "SELECT * FROM service";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $service) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($service['name']); ?></td>
                                        <td><?php echo htmlspecialchars($service['description']); ?></td>
                                        <td><img src="<?php echo htmlspecialchars($service['image1']); ?>" width="50" height="50" alt="Image1"></td>
                                        <td><img src="<?php echo htmlspecialchars($service['image2']); ?>" width="50" height="50" alt="Image2"></td>
                                        <td><img src="<?php echo htmlspecialchars($service['image3']); ?>" width="50" height="50" alt="Image3"></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo htmlspecialchars($service['id']); ?>" class="btn btn-success btn-sm">Edit</a>
                                            <form action="delete.php" method="POST" class="d-inline">
                                                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($service['id']); ?>">
                                                <button type="submit" name="delete_service" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='7'>No Record Found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

