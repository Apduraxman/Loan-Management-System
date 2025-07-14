<?php

require_once 'admin/class.php';
$db = new db_class();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Services</title>
    <link href="css/sb-admin-2.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Services</h2>
        <!-- Add Service Button -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="fa fa-plus"></i> Add Service
        </button>

        <!-- Add Service Modal -->
        <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="save_service.php" enctype="multipart/form-data" class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="addServiceModalLabel">Add Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- All form fields here -->
                        <div class="form-group mb-2">
                            <label>Guarantor Full Name</label>
                            <input type="text" name="guarantor_full_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Job</label>
                            <input type="text" name="job" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Company Name</label>
                            <input type="text" name="company_name" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>National ID</label>
                            <input type="text" name="national_id" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Service Description</label>
                            <textarea name="service_description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label>Documentation</label>
                            <input type="file" name="documentation" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="save" class="btn btn-primary">Save Service</button>
                    </div>
                </form>
            </div>
        </div>

        <hr>
        <h2 class="mt-5">Services List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Guarantor Name</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Job</th>
                    <th>Company Name</th>
                    <th>National ID</th>
                    <th>Service Description</th>
                    <th>Documentation</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $db->conn->query("SELECT * FROM services ORDER BY id DESC");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['guarantor_full_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['job']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['national_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['service_description']) . "</td>";
                    echo "<td>";
                    if (!empty($row['documentation'])) {
                        echo "<a href='uploads/" . htmlspecialchars($row['documentation']) . "' target='_blank'>View</a>";
                    } else {
                        echo "No file";
                    }
                    echo "</td>";
                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS if not already included -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>