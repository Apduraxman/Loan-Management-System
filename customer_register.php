<?php
require_once 'admin/class.php';
$db = new db_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $tax_id = $_POST['tax_id'];

    try {
        $db->add_customer($firstname, $middlename, $lastname, $email, $password, $phone, $address, $tax_id);
        echo "<script>alert('Registration successful. Please login.'); window.location='customer_login.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error: Email might already be registered.');</script>";
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Customer Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Loan Master CSS -->
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

    <!-- Header Start -->
    <header>
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="#"><img src="assets/img/logo/ips.png" alt="Logo" width="50" height="50" style="width:90px; height:90px;"></a>
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
    <!-- Header End -->

    <!-- Hero Area Start -->
    <div class="slider-area">
        <div class="single-slider slider-height2 d-flex align-items-center hero-overly">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Customer Registration</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Form -->
    <section class="contact-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="form-wrapper mt-5">

                        <form method="POST" class="form-contact contact_form">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="firstname" class="form-control" required placeholder="Enter your first name">
                            </div>
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" name="middlename" class="form-control" placeholder="Enter your middle name">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lastname" class="form-control" required placeholder="Enter your last name">
                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control" required placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="Enter password">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" placeholder="Enter your address"></textarea>
                            </div>
                            <div class="form-group">
                                <label>National ID</label>
                                <input type="text" name="tax_id" class="form-control" required placeholder="Enter your National ID">
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary w-100">Register</button>
                            </div>
                            <div class="form-group mt-2 text-center">
                                <a href="customer_login.php" class="btn btn-outline-secondary btn-sm">Already have an account?</a>
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