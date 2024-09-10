<?php
include ('includes/header.php');
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>New Service</h4>
                    <a href="services.php" class="btn btn-primary">Back</a>
                </div>
                <div class="card-body">
                    <form id="uploadForm" action="data.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Service Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image1" class="form-label">Image 1</label>
                            <input type="file" id="image1" name="image1" class="form-control" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="image2" class="form-label">Image 2</label>
                            <input type="file" id="image2" name="image2" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="image3" class="form-label">Image 3</label>
                            <input type="file" id="image3" name="image3" class="form-control" accept="image/*">
                        </div>
                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
