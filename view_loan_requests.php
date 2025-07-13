<?php
session_start();
require_once 'admin/class.php';
$db = new db_class();

$is_admin = isset($_SESSION['admin_id']);
$customer_id = $_SESSION['customer_id'] ?? null;

if ($is_admin) {
    $requests = $db->conn->query("
        SELECT lr.*, lt.ltype_name, lp.lplan_month, lp.lplan_interest, lp.lplan_penalty,
        CONCAT(c.firstname, ' ', c.middlename, ' ', c.lastname) as customer_name
        FROM loan_requests lr
        JOIN loan_type lt ON lr.loan_type_id = lt.ltype_id
        JOIN loan_plan lp ON lr.loan_plan_id = lp.lplan_id
        JOIN customer c ON lr.customer_id = c.id
        ORDER BY lr.created_at DESC
    ");
} elseif ($customer_id) {
    $requests = $db->conn->query("
        SELECT lr.*, lt.ltype_name, lp.lplan_month, lp.lplan_interest, lp.lplan_penalty,
        CONCAT(c.firstname, ' ', c.middlename, ' ', c.lastname) as customer_name
        FROM loan_requests lr
        JOIN loan_type lt ON lr.loan_type_id = lt.ltype_id
        JOIN loan_plan lp ON lr.loan_plan = lp.lplan_id
        JOIN customer c ON lr.customer_id = c.id
        WHERE lr.customer_id = $customer_id
        ORDER BY lr.date_requested DESC
    ");
} else {
    header("Location: customer_login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Loan Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .loan-table-area {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 16px rgba(0,0,0,0.07);
            max-width: 1100px;
            margin: 40px auto 40px auto;
            padding: 40px 30px 30px 30px;
        }
        .loan-table-area h4 {
            font-weight: 700;
            color: #001F3F;
        }
        .table thead th {
            background: #001F3F;
            color: #fff;
            font-weight: 600;
        }
        .btn-secondary {
            border-radius: 6px;
            font-weight: 600;
        }
        .slider-area {
            background: linear-gradient(90deg, #e0e7ef 0%, #f8fafc 100%);
            padding: 40px 0 0 0;
        }
        .hero-cap h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #001F3F;
            margin-bottom: 0;
        }
    </style>
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

    <!-- Add spacing between header and banner -->
    <div style="height: 90px;"></div>

    <!-- Hero Banner -->
    <div class="slider-area">
        <div class="single-slider slider-height2 d-flex align-items-center hero-overly">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Loan Requests</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <section class="loan-table-area pt-2 pb-2">
        <h4 class="mb-30">Your Loan Requests</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <?php if ($is_admin): ?><th>Customer</th><?php endif; ?>
                        <th>Loan Type</th>
                        <th>Plan (Months)</th>
                        <th>Amount ($)</th>
                        <th>Reason</th>
                        <th>Date Needed</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <?php if ($is_admin): ?><th>Update</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    while ($row = $requests->fetch_assoc()): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <?php if ($is_admin): ?><td><?= htmlspecialchars($row['customer_name']) ?></td><?php endif; ?>
                            <td><?= htmlspecialchars($row['ltype_name']) ?></td>
                            <td><?= htmlspecialchars($row['lplan_month']) ?></td>
                            <td><?= number_format($row['amount'], 2) ?></td>
                            <td><?= htmlspecialchars($row['reason']) ?></td>
                            <td><?= htmlspecialchars($row['date_needed']) ?></td>
                            <td>
                                <span class="badge bg-<?= $row['status'] === 'Approved' ? 'success' : ($row['status'] === 'Rejected' ? 'danger' : 'warning') ?>">
                                    <?= htmlspecialchars($row['status']) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($row['created_at'] ?? $row['date_needed']) ?></td>
                            <?php if ($is_admin): ?>
                                <td>
                                    <form method="POST" action="update_loan_status.php">
                                        <input type="hidden" name="loan_request_id" value="<?= $row['loan_request_id'] ?>">
                                        <select name="status" class="form-select form-select-sm mb-1" required>
                                            <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="Approved" <?= $row['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                                            <option value="Rejected" <?= $row['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <a href="<?= $is_admin ? 'admin_dashboard.php' : 'index.php' ?>" class="btn btn-secondary mt-4">Back to Dashboard</a>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-wrappr">
            <div class="container text-center py-4">
                <p class="text-muted mb-0">&copy; <?= date("Y") ?> Loan Management System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JS -->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>