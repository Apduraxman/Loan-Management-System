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

// Get loans
$loan_query = $db->conn->prepare("
    SELECT loan.*, loan_plan.lplan_interest, loan_plan.lplan_month 
    FROM loan 
    INNER JOIN loan_plan ON loan.lplan_id = loan_plan.lplan_id 
    WHERE loan.ref_no = ?
");
$loan_query->bind_param("s", $phone);
$loan_query->execute();
$loans = $loan_query->get_result();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Payments</title>
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
                                        <li><a href="services.html">Services</a></li>
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
                        <h2>My Payment Schedules</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loan Schedules -->
<section class="pt-60 pb-60">
    <div class="container">
        <?php if ($loans->num_rows == 0): ?>
            <div class="alert alert-info text-center">No loans found for your phone number.</div>
        <?php else: ?>
            <?php while ($loan = $loans->fetch_assoc()): ?>
                <?php
                $monthly = ($loan['amount'] + ($loan['amount'] * ($loan['lplan_interest'] / 100))) / $loan['lplan_month'];
                $schedule_query = $db->conn->prepare("SELECT * FROM loan_schedule WHERE loan_id = ?");
                $schedule_query->bind_param("i", $loan['loan_id']);
                $schedule_query->execute();
                $schedules = $schedule_query->get_result();
                ?>
                <div class="card mb-4 shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Loan Reference: <?= htmlspecialchars($loan['ref_no']) ?></h5>
                    </div>
                    <div class="card-body p-0">
                        <?php if ($schedules->num_rows == 0): ?>
                            <div class="alert alert-secondary m-3">No payment schedule found.</div>
                        <?php else: ?>
                            <table class="table table-bordered text-center m-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Due Date</th>
                                        <th>Monthly Payment ($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $schedules->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= date("F d, Y", strtotime($row['due_date'])) ?></td>
                                            <td><?= number_format($monthly, 2) ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

        <a href="index.php" class="btn btn-secondary mt-4">Back to Dashboard</a>
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
<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
