<?php
session_start();
require_once 'admin/class.php';
$db = new db_class();

$customer_id = $_SESSION['customer_id'] ?? null;
if (!$customer_id) {
    header("Location: customer_login.php");
    exit;
}

// Get customer info
$user_query = $db->conn->prepare("SELECT phone, CONCAT(firstname, ' ', lastname) AS name FROM customer WHERE id = ?");
$user_query->bind_param("i", $customer_id);
$user_query->execute();
$user_result = $user_query->get_result();
if ($user_result->num_rows == 0) {
    echo "<div class='alert alert-danger text-center mt-5'>User not found.</div>";
    exit;
}
$user = $user_result->fetch_assoc();
$phone = $user['phone'];
$name = $user['name'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/ips.png" alt="Logo" width="90" height="90" style="width:90px; height:90px;"></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">Home</a></li>
                                            <li><a href="about.php">About</a></li>
                                            <li><a href="services.php" class="active">Services</a></li>
                                            <li><a href="blog.html">Blog</a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="my_payment.php">my payments</a></li>
                                                    <li><a href="view_loan_requests.php">view Loan</a></li>
                                                    <li><a href="apply.php">Apply Now</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Title -->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center hero-overly">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <div class="hero-cap pt-50">
                            <h2>My Services</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <section class="pt-60 pb-60">
        <div class="container">
            <div class="mb-4">
                <strong>Welcome, <?php echo htmlspecialchars($name); ?> (<?php echo htmlspecialchars($phone); ?>)</strong>
            </div>
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
                            <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="save" class="btn btn-primary">Save Service</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Services List</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered text-center m-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Guarantor Name</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Job</th>
                                <th>Company Name</th>
                                <th>National ID</th>
                                <th>Service Description</th>
                                <th>Documentation</th>
                                <th>Submitted By</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $db->conn->query("SELECT s.*, c.firstname, c.middlename, c.lastname FROM services s LEFT JOIN customer c ON s.customer_id = c.id WHERE s.customer_id = $customer_id ORDER BY s.id DESC");
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $i++ . "</td>";
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
                                echo "<td>" . htmlspecialchars($row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-wrappr">
            <div class="container text-center py-4">
                <p class="text-muted mb-0">&copy; <?= date("Y") ?> Loan Management System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/fontawesome-all.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>