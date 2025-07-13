<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About - IPS Bank Loan Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .about-section {
            padding: 60px 20px;
            background-color: #ffffff;
            max-width: 900px;
            margin: 60px auto 40px auto;
            box-shadow: 0 0 16px rgba(0,0,0,0.07);
            border-radius: 14px;
        }
        .about-section h2 {
            font-size: 32px;
            color: #001F3F;
            margin-bottom: 24px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .about-section p, .about-section ul {
            font-size: 17px;
            line-height: 1.8;
            color: #333;
            margin-bottom: 18px;
        }
        .about-section ul {
            padding-left: 22px;
        }
        .about-section ul li {
            margin-bottom: 8px;
            list-style: disc;
        }
        .about-section .btn {
            background: linear-gradient(90deg, #007bff 60%, #0056b3 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 28px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 18px;
            transition: background 0.3s;
        }
        .about-section .btn:hover {
            background: linear-gradient(90deg, #0056b3 60%, #007bff 100%);
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Preloader Start -->
    <div id="preloader-active" style="display:none;">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/ips.png" alt="logo">
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
                                <a href="index.php"><img src="assets/img/logo/ips.png" alt="Logo" width="90" height="90" style="width:90px; height:90px;"></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">Home</a></li>
                                            <li class="active"><a href="about.php">About</a></li>
                                            <li><a href="services.html">Services</a></li>
                                             <li><a href="">Blog</a>
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
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <a href="#" class="btn header-btn">
                                        <?php
                                            if (isset($_SESSION['admin_id'])) {
                                                echo "Admin";
                                            } elseif (isset($_SESSION['customer_name'])) {
                                                echo "Welcome, " . htmlspecialchars($_SESSION['customer_name']);
                                            } else {
                                                echo "Login";
                                            }
                                        ?>
                                    </a>
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
    <!-- Header End -->
    <!-- Add spacing between header and banner -->
    <div style="height: 18px;"></div>

    <main>
        <div class="about-section">
            <h2>About IPS Bank Loan Management System</h2>
            <p>
                IPS Bank Loan Management System is a modern and efficient web-based solution designed to simplify and automate the entire loan process for both administrators and customers.
            </p>
            <p>
                The system allows customers to apply for loans online, track their payment schedules, and view their loan statuses in real-time. Administrators, on the other hand, can review loan requests, approve or reject applications, manage customer accounts, and monitor repayments efficiently through a secure dashboard.
            </p>
            <p>
                This platform was built to eliminate manual paperwork, reduce approval delays, and ensure transparency in all financial activities. It enhances the overall customer experience while giving IPS Bank staff full control over operations.
            </p>
            <ul>
                <li>Easy Loan Application Process</li>
                <li>Real-Time Payment Tracking</li>
                <li>Secure Customer Login</li>
                <li>Admin Dashboard & Controls</li>
                <li>Automatic Loan Schedule Generation</li>
                <li>Notifications and Alerts</li>
            </ul>
            <p>
                IPS Bank is committed to providing seamless digital financial services that are secure, accessible, and user-friendly for everyone.
            </p>
            <a href="apply.php" class="btn">Apply for Loan</a>
        </div>
    </main>

    <!-- Footer Start -->
    <footer>
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <a href="index.php"><img src="assets/img/logo/ips.png" alt="Logo" width="90" height="90" style="width:90px; height:90px;"></a>
                            </div>
                            <div class="footer-text">
                                <p>
                                    IPS Bank is dedicated to providing top-notch financial services with a focus on customer satisfaction and technological innovation.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">Quick Links</h4>
                            <ul class="footer-links">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="services.html">Services</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">Contact Us</h4>
                            <ul class="footer-contact-info">
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    123 IPS Bank St, Financial District, NY 10010
                                </li>
                                <li>
                                    <i class="fas fa-phone"></i>
                                    <a href="tel:+1234567890">+1 234 567 890</a>
                                </li>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <a href="mailto:info@ipsbank.com">info@ipsbank.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">Follow Us</h4>
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-copyright">
                            <p>&copy; 2023 IPS Bank. All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                <li><a href="terms-of-service.html">Terms of Service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- JS here -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/jquery.form.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
