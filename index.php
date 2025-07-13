<?php
session_start();
require_once 'admin/class.php';
$db = new db_class();

$customer_id = $_SESSION['customer_id'] ?? null;
$new_messages = [];
$unread_count = 0;

if ($customer_id) {
    $stmt = $db->conn->prepare("SELECT * FROM messages WHERE customer_id = ? AND is_read = 0 ORDER BY created_at DESC LIMIT 5");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $new_messages = $result->fetch_all(MYSQLI_ASSOC);
    $unread_count = count($new_messages);
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>IBS BANK</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .fa-bell {
            font-size: 18px !important;
            vertical-align: middle;
        }

        .nav-item .badge.bg-danger {
            font-size: 11px;
            min-width: 16px;
            height: 16px;
            line-height: 16px;
            padding: 0;
            text-align: center;
            border-radius: 50%;
            position: absolute;
            top: 0;
            right: 5px;
        }

        .main-menu .nav-link,
        .main-menu a.btn,
        .main-menu a {
            font-size: 15px !important;
            padding: 4px 10px !important;
        }

        .main-menu .dropdown-menu {
            font-size: 14px;
        }

        /* Custom styles for the navbar */
        .nav-bar {
            background: linear-gradient(90deg, #f8fafc 0%, #e0e7ef 100%) !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        @keyframes fadeInFab {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #fabMenu a.btn-primary {
            background: linear-gradient(90deg, #007bff 60%, #0056b3 100%);
            border: none;
        }

        #fabMenu a.btn-primary:hover {
            background: linear-gradient(90deg, #0056b3 60%, #007bff 100%);
        }
    </style>
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
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

    <!-- Navbar Start - IBS BANK Style Using Code 2 Layout -->
    <div class="container-fluid nav-bar sticky-top px-4 py-2 py-lg-0" style="background: #212529 !important; box-shadow: 0 2px 8px rgba(0,0,0,0.10);">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a href="#" class="navbar-brand p-0">
                <img src="assets/img/logo/ips.png" alt="IBS BANK" width="90" height="90">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="#" class="nav-item nav-link active">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="services.html" class="nav-item nav-link">Services</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Blog</a>
                        <div class="dropdown-menu m-0">
                            <a href="blog.html" class="dropdown-item">Blog</a>
                            <a href="blog_details.html" class="dropdown-item">Blog Details</a>
                            <a href="elements.html" class="dropdown-item">Element</a>
                            <a href="apply.html" class="dropdown-item">Apply Now</a>
                        </div>
                    </div>

                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                    <a href="request_loan.php" class="nav-item nav-link">Request Loan</a>
                    <a href="my_payment.php" class="nav-item nav-link">My Payments</a>
                    <a href="view_loan_requests.php" class="nav-item nav-link">Loan Requests</a>

                    <?php if ($customer_id): ?>
                        <!-- Notification Dropdown -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle position-relative" id="notifDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <?php if ($unread_count > 0): ?>
                                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle"><?= $unread_count ?></span>
                                <?php endif; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="notifDropdown" style="min-width: 300px;">
                                <h6 class="dropdown-header">Notifications</h6>
                                <?php if ($unread_count > 0): ?>
                                    <?php foreach ($new_messages as $msg): ?>
                                        <div class="dropdown-item small text-wrap">
                                            <?= htmlspecialchars($msg['message']) ?>
                                            <div class="text-muted small"><?= date("d M Y, H:i", strtotime($msg['created_at'])) ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="dropdown-item text-muted">No new notifications</div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <a href="customer_logout.php" class="nav-item nav-link">Logout</a>
                    <?php else: ?>
                        <a href="customer_login.php" class="nav-item nav-link">User Login</a>
                    <?php endif; ?>

                    <!-- Admin FAB Menu -->
                    <div class="nav-item dropdown position-relative">
                        <button onclick="toggleFabMenu()" class="btn btn-sm btn-primary nav-link d-flex align-items-center justify-content-center shadow"
                            style="width: 36px; height: 36px; border-radius: 50%; font-size: 22px; background: linear-gradient(135deg, #007bff 60%, #0056b3 100%); border: none; transition: background 0.3s;">
                            <span style="font-size: 22px; line-height: 1;">+</span>
                        </button>
                        <div id="fabMenu"
                            style="
                                display: none;
                                position: absolute;
                                top: 48px;
                                right: 0;
                                min-width: 180px;
                                background: #fff;
                                border-radius: 12px;
                                box-shadow: 0 8px 24px rgba(0,0,0,0.15);
                                padding: 18px 16px 12px 16px;
                                z-index: 999;
                                border: 1px solid #e0e7ef;
                                animation: fadeInFab 0.25s;
                            ">
                            <div class="text-center mb-2">
                                <i class="fas fa-user-shield text-primary" style="font-size: 32px;"></i>
                            </div>
                            <a href="admin/admin_log.php" class="btn btn-primary w-100 mb-2" style="border-radius: 8px; font-weight: 500; font-size: 16px;">
                                <i class="fas fa-sign-in-alt me-1"></i> Admin Login
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Optional Right Side Button -->
                <!-- <a href="#" class="btn btn-primary rounded-pill py-2 px-4 flex-shrink-0">+880.762.009.00</a> -->
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <script>
        function toggleFabMenu() {
            const menu = document.getElementById('fabMenu');
            menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
        }
        document.addEventListener('click', function(event) {
            const fabMenu = document.getElementById("fabMenu");
            const fabButton = document.querySelector("button[onclick='toggleFabMenu()']");
            if (fabMenu && fabButton && !fabMenu.contains(event.target) && !fabButton.contains(event.target)) {
                fabMenu.style.display = 'none';
            }
        });
    </script>
    <main>
        <!-- slider Area Start-->
        <div class="slider-area slider-height" data-background="assets/img/hero/h1_hero.jpg">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider">
                    <div class="slider-cap-wrapper">
                        <div class="hero__caption">
                            <p data-animation="fadeInLeft" data-delay=".2s">Achieve your financial goal</p>
                            <h1 data-animation="fadeInLeft" data-delay=".5s">Small Business Loans For Daily Expenses.</h1>
                            <!-- Hero Btn -->
                            <a href="request_loan.php" class="btn hero-btn" data-animation="fadeInLeft" data-delay=".8s">Apply for Loan</a>
                        </div>
                        <div class="hero__img">
                            <img src="assets/img/hero/hero_img.jpg" alt="">
                        </div>
                    </div>
                </div>
                <!-- Single Slider -->
                <div class="single-slider">
                    <div class="slider-cap-wrapper">
                        <div class="hero__caption">
                            <p data-animation="fadeInLeft" data-delay=".2s">Achieve your financial goal</p>
                            <h1 data-animation="fadeInLeft" data-delay=".5s">Small Business Loans For Daily Expenses.</h1>
                            <!-- Hero Btn -->
                            <a href="request_loan.php" class="btn hero-btn" data-animation="fadeInLeft" data-delay=".8s">Apply for Loan</a>
                        </div>
                        <div class="hero__img">
                            <img src="assets/img/hero/hero_img2.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- slider-footer Start -->
            <div class="slider-footer section-bg d-none d-sm-block">
                <div class="footer-wrapper">
                    <!-- single -->
                    <div class="single-caption">
                        <div class="single-img">
                            <img src="assets/img/hero/hero_footer.png" alt="">
                        </div>
                    </div>
                    <!-- single -->
                    <div class="single-caption">
                        <div class="caption-icon">
                            <span class="flaticon-clock"></span>
                        </div>
                        <div class="caption">
                            <p>Quick & Easy Loan</p>
                            <p>Approvals</p>
                        </div>
                    </div>
                    <!-- single -->
                    <div class="single-caption">
                        <div class="caption-icon">
                            <span class="flaticon-like"></span>
                        </div>
                        <div class="caption">
                            <p>Quick & Easy Loan</p>
                            <p>Approvals</p>
                        </div>
                    </div>
                    <!-- single -->
                    <div class="single-caption">
                        <div class="caption-icon">
                            <span class="flaticon-money"></span>
                        </div>
                        <div class="caption">
                            <p>Quick & Easy Loan</p>
                            <p>Approvals</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- slider-footer End -->
        </div>
        <!-- slider Area End-->
        <!-- About Law Start-->
        <div class="about-low-area section-padding2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="about-caption mb-50">
                            <!-- Section Tittle -->
                            <div class="section-tittle mb-35">
                                <span>About Our Company</span>
                                <h2>Building a Brighter financial Future & Good Support.</h2>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, oeiusmod tempor incididunt ut labore et dolore magna aliqua. Ut eniminixm, quis nostrud exercitation ullamco laboris nisi ut aliquip exeaoauat. Duis aute irure dolor in reprehe.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, oeiusmod tempor incididunt ut labore et dolore magna aliq.</p>
                            <a href="request_loan.php" class="btn">Apply for Loan</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <!-- about-img -->
                        <div class="about-img ">
                            <div class="about-font-img d-none d-lg-block">
                                <img src="assets/img/gallery/about2.png" alt="">
                            </div>
                            <div class="about-back-img ">
                                <img src="assets/img/gallery/about1.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Law End-->
        <!-- Services Area Start -->
        <div class="services-area pt-150 pb-150" data-background="assets/img/gallery/section_bg02.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-80">
                            <span>Services that we are providing</span>
                            <h2>High Performance Services For All Industries.</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-cat text-center mb-50">
                            <div class="cat-icon">
                                <span class="flaticon-work"></span>
                            </div>
                            <div class="cat-cap">
                                <h5><a href="services.html">Business Loan</a></h5>
                                <p>Consectetur adipisicing elit, sed doeiusmod tempor incididunt ut labore et dolore</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-cat text-center mb-50">
                            <div class="cat-icon">
                                <span class="flaticon-loan"></span>
                            </div>
                            <div class="cat-cap">
                                <h5><a href="services.html">Commercial Loans</a></h5>
                                <p>Consectetur adipisicing elit, sed doeiusmod tempor incididunt ut labore et dolore</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-cat text-center mb-50">
                            <div class="cat-icon">
                                <span class="flaticon-loan-1"></span>
                            </div>
                            <div class="cat-cap">
                                <h5><a href="services.html">Construction Loans</a></h5>
                                <p>Consectetur adipisicing elit, sed doeiusmod tempor incididunt ut labore et dolore</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-cat text-center mb-50">
                            <div class="cat-icon">
                                <span class="flaticon-like"></span>
                            </div>
                            <div class="cat-cap">
                                <h5><a href="services.html">Business Loan</a></h5>
                                <p>Consectetur adipisicing elit, sed doeiusmod tempor incididunt ut labore et dolore</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services Area End -->
        <!-- Support Company Start-->
        <div class="support-company-area section-padding3 fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="support-location-img mb-50">
                            <img src="assets/img/gallery/single2.jpg" alt="">
                            <div class="support-img-cap">
                                <span>Since 1992</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="right-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle">
                                <span>Why Choose Our Company</span>
                                <h2>We Promise Sustainable Future For You.</h2>
                            </div>
                            <div class="support-caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
                                <div class="select-suport-items">
                                    <label class="single-items">Aorem ipsum dgolor sitnfd amet dfgbn fbsdg
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="single-items">Consectetur adipisicing bfnelit, sedb dvbnfo
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="single-items">Eiusmod tempor incididunt vmgldupout labore
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="single-items">Admkde mibvnim veniam, quivds cnostrud.
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Support Company End-->
        <!-- Application Area Start -->
        <div class="application-area pt-150 pb-140" data-background="assets/img/gallery/section_bg03.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <!-- Section Tittle -->
                        <div class="section-tittle section-tittle2 text-center mb-45">
                            <span>Apply in Three Easy Steps</span>
                            <h2>Easy Application Process For Any Types of Loan</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-xl-8">
                        <!--Hero form -->
                        <form action="#" class="search-box">
                            <div class="select-form">
                                <div class="select-itms">
                                    <select name="select" id="select1">
                                        <option value="">Select Amount</option>
                                        <option value="">$120</option>
                                        <option value="">$700</option>
                                        <option value="">$750</option>
                                        <option value="">$250</option>
                                    </select>
                                </div>
                            </div>
                            <div class="select-form">
                                <div class="select-itms">
                                    <select name="select" id="select1">
                                        <option value="">Duration Month</option>
                                        <option value="">7 Days</option>
                                        <option value="">10 Days</option>
                                        <option value="">14 Days Days</option>
                                        <option value="">20 Days</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-form">
                                <input type="text" placeholder="Return Amount">
                            </div>
                            <div class="search-form">
                                <a href="request_loan.php">Apply for Loan</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Application Area End -->
        <!--Team Ara Start -->
        <div class="team-area section-padding30">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="cl-xl-7 col-lg-8 col-md-10">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-70">
                            <span>Our Loan Section Team Mambers</span>
                            <h2>Take a look to our professional team members.</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="assets/img/gallery/home_blog1.png" alt="">
                                <!-- Blog Social -->
                                <div class="team-social">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fas fa-globe"></i></a></li>
                                </div>
                            </div>
                            <div class="team-caption">
                                <h3><a href="#">Bruce Roberts</a></h3>
                                <p>Volunteer leader</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="assets/img/gallery/home_blog2.png" alt="">
                                <!-- Blog Social -->
                                <div class="team-social">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fas fa-globe"></i></a></li>
                                </div>
                            </div>
                            <div class="team-caption">
                                <h3><a href="#">Bruce Roberts</a></h3>
                                <p>Volunteer leader</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="assets/img/gallery/home_blog3.png" alt="">
                                <!-- Blog Social -->
                                <div class="team-social">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fas fa-globe"></i></a></li>
                                </div>
                            </div>
                            <div class="team-caption">
                                <h3><a href="#">Bruce Roberts</a></h3>
                                <p>Volunteer leader</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="assets/img/gallery/home_blog4.png" alt="">
                                <!-- Blog Social -->
                                <div class="team-social">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fas fa-globe"></i></a></li>
                                </div>
                            </div>
                            <div class="team-caption">
                                <h3><a href="#">Bruce Roberts</a></h3>
                                <p>Volunteer leader</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team Ara End -->
        <!-- Testimonial Start -->
        <div class="testimonial-area t-bg testimonial-padding">
            <div class="container ">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-11 col-lg-11 col-md-9">
                        <div class="h1-testimonial-active">
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <!-- Testimonial Content -->
                                <div class="testimonial-caption ">
                                    <div class="testimonial-top-cap">
                                        <img src="assets/img/gallery/testimonial.png" alt="">
                                        <p>Logisti Group is a representative logistics operator providing full range of ser
                                            of customs clearance and transportation worl.</p>
                                    </div>
                                    <!-- founder -->
                                    <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                        <div class="founder-img">
                                            <img src="assets/img/testmonial/Homepage_testi.png" alt="">
                                        </div>
                                        <div class="founder-text">
                                            <span>Jessya Inn</span>
                                            <p>Co Founder</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <!-- Testimonial Content -->
                                <div class="testimonial-caption ">
                                    <div class="testimonial-top-cap">
                                        <img src="assets/img/gallery/testimonial.png" alt="">
                                        <p>Logisti Group is a representative logistics operator providing full range of ser
                                            of customs clearance and transportation worl.</p>
                                    </div>
                                    <!-- founder -->
                                    <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                        <div class="founder-img">
                                            <img src="assets/img/testmonial/Homepage_testi.png" alt="">
                                        </div>
                                        <div class="founder-text">
                                            <span>Jessya Inn</span>
                                            <p>Co Founder</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
        <!-- Blog Ara Start -->
        <div class="home-blog-area section-padding30">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-10">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-70">
                            <span>News form our latest blog</span>
                            <h2>News from around the world selected by us.</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <!-- single-david -->
                        <div class="single-blogs mb-30">
                            <div class="blog-images">
                                <img src="assets/img/gallery/blog1.png" alt="">
                            </div>
                            <div class="blog-captions">
                                <span>January 28, 2020</span>
                                <h2><a href="blog_details.html">The advent of pesticides brought
                                        in its benefits and pitfalls.</a></h2>
                                <p>October 6, a2020by Steve</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <!-- single-david -->
                        <div class="single-blogs mb-30">
                            <div class="blog-images">
                                <img src="assets/img/gallery/blog2.png" alt="">
                            </div>
                            <div class="blog-captions">
                                <span>January 28, 2020</span>
                                <h2><a href="blog_details.html">The advent of pesticides brought
                                        in its benefits and pitfalls.</a></h2>
                                <p>October 6, a2020by Steve</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog Ara End -->
    </main>
    <footer>
        <!-- Footer Start-->
        <div class="footer-area">
            <div class="container">
                <div class="footer-top footer-padding">
                    <div class="row justify-content-between">
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    <!-- logo -->
                                    <div class="footer-logo">
                                        <a href="index.php"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                                    </div>
                                    <div class="footer-pera">
                                        <p>Heaven fruitful doesn't over lesser days appear creeping seasons so behold bearing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Quick Link</h4>
                                    <ul>
                                        <li><a href="#">About</a></li>
                                        <li><a href="#">Offers & Discounts</a></li>
                                        <li><a href="#">Get Coupon</a></li>
                                        <li><a href="#"> Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>New Products</h4>
                                    <ul>
                                        <li><a href="#">Woman Cloth</a></li>
                                        <li><a href="#">Fashion Accessories</a></li>
                                        <li><a href="#">Man Accessories</a></li>
                                        <li><a href="#">Rubber made Toys</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Support</h4>
                                    <ul>
                                        <li><a href="#">Frequently Asked Questions</a></li>
                                        <li><a href="#">Terms & Conditions</a></li>
                                        <li><a href="#"> Privacy Policy</a></li>
                                        <li><a href="#">Report a Payment Issue</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-xl-9 col-lg-8">
                            <div class="footer-copy-right">
                                <p>
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i>
                                    by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <!-- Footer Social -->
                            <div class="footer-social f-right">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fas fa-globe"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>
    <!-- JS here -->
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/animated.headline.js"></script>
    <script src="assets/js/jquery.magnific-popup.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/jquery.sticky.js"></script>
    <script src="assets/js/contact.js"></script>
    <script src="assets/js/jquery.form.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/mail-script.js"></script>
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- Bootstrap JS for dropdowns -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>