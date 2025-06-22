<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Preloader -->
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

    <!-- Header -->
    <header>
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="#"><img src="assets/img/logo/logo.png" alt="Logo"></a>
                            </div>
                        </div>
                        <!-- Menu -->
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li class="active"><a href="#">Dashboard</a></li>
                                            <li><a href="request_loan.php">Request Loan</a></li>
                                            <li><a href="my_payment.php">My Payments</a></li>
                                            <li><a href="view_loan_requests.php">Loan Requests</a></li>

                                            <?php if (isset($_SESSION['customer_id'])): ?>
                                                <li><a href="customer_logout.php">Logout</a></li>
                                            <?php endif; ?>

                                            <li>
                                                <div style="position: relative;">
                                                    <button onclick="toggleFabMenu()" class="btn btn-sm btn-primary" style="margin-left: 10px;">+</button>
                                                    <div id="fabMenu" style="display: none; position: absolute; top: 40px; right: 0; background: #007bff; padding: 10px; border-radius: 8px; box-shadow: 0 4px 10px rgba(190, 11, 11, 0.1); z-index: 999;">
                                                        <a href="admin/admin_log.php" class="btn btn-sm btn-dark text-white d-block mb-2">Admin Login</a>

                                                        <?php if (!isset($_SESSION['customer_id'])): ?>
                                                            <a href="customer_login.php" class="btn btn-sm btn-secondary text-white d-block">User Login</a>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </li>

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

    <!-- JavaScript Function to toggle the FAB menu -->
    <script>
        function toggleFabMenu() {
            var menu = document.getElementById("fabMenu");
            if (menu.style.display === "none" || menu.style.display === "") {
                menu.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        }
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

    <!-- Footer -->
    <footer>
        <div class="footer-wrappr">
            <div class="container text-center py-4">
                <p class="text-muted mb-0">&copy; <?= date("Y") ?> Loan Management System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JS Files -->
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/animated.headline.js"></script>
    <script src="assets/js/jquery.magnific-popup.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- FAB Toggle Script -->
    <script>
        function toggleFabMenu() {
            var menu = document.getElementById("fabMenu");
            menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "block" : "none";
        }
        document.addEventListener('click', function(event) {
            const fabMenu = document.getElementById("fabMenu");
            const fabButton = document.querySelector("button[onclick='toggleFabMenu()']");
            if (!fabMenu.contains(event.target) && !fabButton.contains(event.target)) {
                fabMenu.style.display = 'none';
            }
        });
    </script>

</body>

</html>