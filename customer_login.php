<?php
session_start();
require_once 'admin/class.php';
$db = new db_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $customer = $db->customer_login($email, $password);

    if ($customer) {
        $_SESSION['customer_id'] = $customer['id'];
        $_SESSION['customer_name'] = $customer['name'];
        $_SESSION['customer_email'] = $customer['email'];

        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Customer Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS Files from loan-master -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="logo">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Header Start -->
    <header>
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/logo.png" alt="Logo"></a>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Hero Area Start -->
    <div class="slider-area">
        <div class="single-slider slider-height2 d-flex align-items-center hero-overly">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Customer Login</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Form Section -->
    <section class="contact-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="form-wrapper mt-5">

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>

                        <form method="POST" class="form-contact contact_form">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control" required placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="Enter password">
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                            <div class="form-group mt-2 text-center">
                                <a href="customer_register.php" class="btn btn-outline-secondary btn-sm">I don't have an account</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Start -->
    <footer>
        <div class="footer-wrappr">
            <div class="container text-center py-4">
                <p class="text-muted mb-0">&copy; <?= date("Y") ?> Loan Management System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JS Files -->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>