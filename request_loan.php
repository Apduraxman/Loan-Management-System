<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    exit();
}

require_once 'admin/class.php';
$db = new db_class();
$loanTypes = $db->display_ltype();
$loanPlans = $db->display_lplan();
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Request Loan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
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
                                <a href="#"><img src="assets/img/logo/ips.png" alt="Logo" width="90" height="90" style="width:90px; height:90px;"></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">Dashboard</a></li>
                                            <li class="active"><a href="#">Request Loan</a></li>
                                            <li><a href="my_payment.php">My Payments</a></li>
                                            <li><a href="view_loan_requests.php">Loan Requests</a></li>
                                            <li><a href="customer_logout.php">Logout</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <a href="#" class="btn header-btn">Welcome, <?= htmlspecialchars($_SESSION['customer_name']) ?></a>
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

    <!-- Hero Banner -->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center hero-overly">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Apply For Loan</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loan Apply Form -->
    <section class="application-area pt-50 pb-50">
        <div class="container">
            <div class="application-form">
                <h4 class="mb-30">Loan Application Form</h4>

                <form method="POST" action="save_customer_loan.php">

                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label>Loan Type</label>
                            <select name="loan_type" class="form-select" required>
                                <option value="">Select Loan Type</option>
                                <?php while ($lt = $loanTypes->fetch_assoc()): ?>
                                    <option value="<?= $lt['ltype_id'] ?>"><?= htmlspecialchars($lt['ltype_name']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label>Loan Plan</label>
                            <select name="loan_plan" class="form-select" required>
                                <option value="">Select Loan Plan</option>
                                <?php while ($lp = $loanPlans->fetch_assoc()): ?>
                                    <option value="<?= $lp['lplan_id'] ?>">
                                        <?= $lp['lplan_month'] ?> months [<?= $lp['lplan_interest'] ?>% interest, <?= $lp['lplan_penalty'] ?>% penalty]
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label>Loan Amount ($)</label>
                            <input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label>Date Needed</label>
                            <input type="date" name="date_needed" class="form-control" required>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label>Reason for Loan</label>
                            <textarea name="reason" rows="4" class="form-control" placeholder="Reason for loan..." required></textarea>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100">Submit Application</button>
                    </div>

                </form>
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

    <!-- JS -->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>