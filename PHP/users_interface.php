<?php
session_start();
?>
<?php
include('libs/helper.php');
if (!$_SESSION['email']) {
    Helper::redirect(Helper::get_url('../Web_QLTV/PHP/log_in.php'));
}
Database::db_connect();
$email = $_SESSION['email'];
$sql_select_name = "SELECT UserName FROM users 
where Email = '$email'";
$names = Database::db_get_list($sql_select_name);
foreach ($names as $name) {
    $username = $name["UserName"];
}

Database::db_disconnect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="../CSS/style.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/img/logo.png" rel="icon">
    <title>Home Page</title>

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">

            <div id="logo">
                <h1><a href="./users_interface.php">Open Lib<span>rary</span></a></h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="./users_interface.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="./users/read_book.php">Read Book</a></li>
                    <li><a class="nav-link scrollto" href="./users/my_books.php">My Book</a></li>
                    <li><a class="nav-link scrollto" href="./users/update_info.php">Update Information</a></li>
                    <li><a href="./log_out.php">Log Out</a></li>
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= hero Section ======= -->
    <section id="hero">
        <div class="hero-content" data-aos="fade-up">
            <h2>Development Team - <span><a href="#team">Team 2</a></span></h2>
        </div>
        <div class="hero-slider swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background-image: url('../Image/hero-carousel/2.jpg');"></div>
                <div class="swiper-slide" style="background-image: url('../Image/hero-carousel/3.png');"></div>
                <div class="swiper-slide" style="background-image: url('../Image/hero-carousel/4.jpg');"></div>
                <div class="swiper-slide" style="background-image: url('../Image/hero-carousel/5.jpg');"></div>
            </div>
        </div>

    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-6 about-img">
                        <img src="../Image/lô1.png" alt="">
                    </div>

                    <div class="col-lg-6 content">
                        <h2>As an online book platform, we prioritize creating a welcoming and secure environment for
                            our users.</h2>
                        <h3> Please take a moment to familiarize yourself with our guidelines:</h3>

                        <ul>
                            <li><i class="fa-solid fa-check"></i> Respect copyright and intellectual property
                                rights
                                when using and sharing content on our platform</li>
                            <li><i class="fa-solid fa-check"></i> We are committed to safeguarding your privacy. Review
                                our privacy policy to understand how your data is collected, used, and protected.</li>
                            <li><i class="fa-solid fa-check"></i>Protect your account credentials and report any
                                unauthorized access promptly. We prioritize the security of your personal information.
                            </li>
                        </ul>

                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Our Portfolio</h2>
                    <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet
                        veniam enim
                        export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum
                        velit export
                        irure minim illum fore</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">New</li>
                            <li data-filter=".filter-card">View</li>
                            <li data-filter=".filter-web">Favorite </li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <a href="./users/read_book.php?book_id=MB04"><img src="../Image/portfolio/1.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                            <h4>Python Programming</h4>
                            <p>Hans Petter Halvorsen</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <a href="./users/read_book.php?book_id=MB05"><img src="../Image/portfolio/2.jpg" class="img-fluid" alt="">
                        </a>

                        <div class="portfolio-info">
                            <h4>Python For Data Analysis</h4>
                            <p>Wes McKinney</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app filter-card">
                        <a href="./users/read_book.php?book_id=MB06"><img src="../Image/portfolio/3.jpg" class="img-fluid" alt="">
                        </a>
                        <div class="portfolio-info">
                            <h4>Computer Vision Algorithms And Applications</h4>
                            <p>Richard Szeliski</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card filter-web">
                        <a href="./users/read_book.php?book_id=MB02"><img src="../Image/portfolio/4.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                            <h4>Data Analysis Using Sql And Excel</h4>
                            <p>Gordon S.Linoff</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <a href="./users/read_book.php?book_id=MB07"><img src="../Image/portfolio/5.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                            <h4>Atomic Habits</h4>
                            <p>James Clear</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <a href="./users/read_book.php?book_id=MB03"><img src="../Image/portfolio/6.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                            <h4>Excel Power Pirot And Power Query For Dummies</h4>
                            <p>Michael Alexander</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <a href="./users/read_book.php?book_id=MB01"><img src="../Image/portfolio/7.jpg" class="img-fluid" alt=""></a>
                        <div class="portfolio-info">
                            <h4>Why We Sleep</h4>
                            <p>Matthew Walke</p>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Portfolio Section -->
        <!-- ======= Team Section ======= -->
        <section id="team">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Our Team</h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="member">
                            <div class="pic"><img src="../Image/team-1.jpg" alt=""></div>
                            <div class="details">
                                <h4>Lê Văn Việt</h4>
                                <span>Project Manager </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="member">
                            <div class="pic"><img src="../Image/team-2.jpg" alt=""></div>
                            <div class="details">
                                <h4>Huỳnh Quốc Việt</h4>
                                <span>Backend Developer</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="member">
                            <div class="pic"><img src="../Image/team-3.jpg" alt=""></div>
                            <div class="details">
                                <h4>Nguyễn Gia Bảo</h4>
                                <span>Frontend Developer</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="member">
                            <div class="pic"><img src="../Image/team-4.jpg" alt=""></div>
                            <div class="details">
                                <h4>Nguyễn Trọng Hoàng</h4>
                                <span>Frontend Developer</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Team Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Contact Us</h2>
                    <p>If you have any questions, feedback, or simply want to share your thoughts with us, please feel
                        free to get in touch. We are always ready to listen and assist you. You can reach us via email
                        at [your email address] or use the contact form below. We'll respond to you at our earliest
                        convenience</p>
                </div>

                <div class="row contact-info">

                    <div class="col-md-4">
                        <div class="contact-address">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <address>136 Phạm Như Xương, Hòa Khánh Nam, Liên Chiểu, Đà Nẵng</address>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-phone">
                            <i class="bi bi-phone"></i>
                            <h3>Phone Number</h3>
                            <p><a href="tel:+155895548855">+84 702032064</a></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-email">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p><a href="mailto:info@example.com">viet.gm.2k3@gmail.com</a></p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container mb-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.008947147585!2d108.15049700000002!3d16.0650255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219293660fbd5%3A0x8e72ecf102cea468!2zMTM2IMSQLiBQaOG6oW0gTmjGsCBYxrDGoW5nLCBIb8OgIEtow6FuaCBOYW0sIExpw6puIENoaeG7g3UsIMSQw6AgTuG6tW5nIDU1MDAwMA!5e0!3m2!1svi!2s!4v1701074386339!5m2!1svi!2s" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Bản quyền thuộc Hệ Thống Quản Lý Thư Viện - <strong>Team 2</strong>
            </div>
        </div>
    </footer><!-- End Footer -->
    <!-- Vendor JS Files -->
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>

</html>