<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="./CSS/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/index.css">
    <link href="./assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="./Image/logo.png" rel="icon">
    <title>Home Page</title>

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">
            <div id="logo">
                <h1><a href="index.php">Open Lib<span>rary</span></a></h1>
            </div>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= hero Section ======= -->
    <section id="hero">

        <div class="hero-content" data-aos="fade-up">
            <div>
                <a href="./PHP/log_in.php" class="btn-get-started scrollto">Log In</a>
                <a href="./PHP/sign_up.php" class="btn-projects scrollto">Sign Up</a>
            </div>
        </div>

        <div class="hero-slider swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background-image: url('./Image/hero-carousel/2.jpg');"></div>
                <div class="swiper-slide" style="background-image: url('./Image/hero-carousel/3.png');"></div>
                <div class="swiper-slide" style="background-image: url('./Image/hero-carousel/4.jpg');"></div>
                <div class="swiper-slide" style="background-image: url('./Image/hero-carousel/5.jpg');"></div>
            </div>
        </div>

    </section><!-- End Hero Section -->

    <main id="main">
        <!-- ======= Portfolio Section ======= -->
        <div class="full_search">
            <div class="form">
                <form action="" method="GET">
                    <div><input type="text" id="book_name" name="book_name" placeholder=" Enter Book Name"></div>
                    <div id="suggestions"></div>
                    <div><button type="submit">Search</button></div>
                </form>
                <?php
                include('./PHP/libs/helper.php');
                Database::db_connect();
                $sql_select_genre_name = "SELECT Genre_name, Genre_id FROM genre";
                if (Database::db_execute($sql_select_genre_name)) {
                    $genre_name = Database::db_get_list($sql_select_genre_name);
                    echo "<h3>Genres</h3>";
                    foreach ($genre_name as $name) {
                        echo '<div class="search_genre_name">';
                        echo '<a href="?Genre_id=' . $name["Genre_id"] . '">' . $name['Genre_name'] . '</a>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
            <div class="search">
                <div>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "GET") {
                        if (!empty($_GET['Genre_id'])) {
                            $genre_id = $_GET['Genre_id'];
                            $sql_select_bookname = "SELECT Images, Book_name, Book_id FROM book 
                                            JOIN genre ON genre.Genre_id = book.Genre_id
                                            WHERE genre.Genre_id = '$genre_id'";
                            if (Database::db_execute($sql_select_bookname)) {
                                $bookname = Database::db_get_list($sql_select_bookname);
                                echo '<div class = display_position>';
                                foreach ($bookname as $name) {
                                    echo '<div class = info_display_position>';
                                    echo '<a href="?book_id=' . $name["Book_id"] . '">';
                                    echo '<div class = "img">' . '<img src="data:image/jpeg;base64,' . $name["Images"] . '" alt="Book Image">' . '</div>';
                                    echo '<div>' . '<p>' . nl2br($name['Book_name']) . '</p>' . '</div>';
                                    echo '</a>';
                                    echo '</div>';
                                }
                                echo '</div>';
                            }
                        } else {
                            if (!empty($_GET['book_name'])) {
                                $book_name = $_GET['book_name'];
                                $sql_select_bookname = "SELECT Images, Book_name, Book_id FROM book 
                                            WHERE Book_name = '$book_name'";
                                if (Database::db_execute($sql_select_bookname)) {
                                    $bookname = Database::db_get_list($sql_select_bookname);
                                    foreach ($bookname as $name) {
                                        echo '<a href="?book_id=' . $name["Book_id"] . '">';
                                        echo '<div class = "img">' . '<img src="data:image/jpeg;base64,' . $name["Images"] . '" alt="Book Image">' . '</div>';
                                        echo '<div>' . '<p>' . nl2br($name['Book_name']) . '</p>' . '</div>';
                                        echo '</a>';
                                    }
                                }
                            } else {
                                if (isset($_GET['book_id'])) {
                                    $id = $_GET['book_id'];
                                    $sql_select_bookname = "SELECT Images, Book_name, Book_id FROM book WHERE Book_id = '$id' ";
                                    if (Database::db_execute($sql_select_bookname)) {
                                        $bookname = Database::db_get_list($sql_select_bookname);
                                        echo '<table>';
                                        foreach ($bookname as $name) {
                                            echo '<tr>';
                                            echo '<a href="?book_id=' . $name["Book_id"] . '">';
                                            echo '<div class = "img">';
                                            echo '<img src="data:image/jpeg;base64,' . $name["Images"] . '" alt="Book Image">';
                                            echo '</div>';
                                            echo '</a>';
                                            echo '</tr>';
                                        }
                                        echo '</table>';
                                    }
                                } else {
                                    $sql_select_bookname = "SELECT Images, Book_name, Book_id FROM book ";
                                    if (Database::db_execute($sql_select_bookname)) {
                                        $bookname = Database::db_get_list($sql_select_bookname);
                                        echo '<div class = display_position>';
                                        foreach ($bookname as $name) {
                                            echo '<div class = info_display_position>';
                                            echo '<a href="?book_id=' . $name["Book_id"] . '">';
                                            echo '<div class = "img">';
                                            echo '<img src="data:image/jpeg;base64,' . $name["Images"] . '" alt="Book Image">';
                                            echo  '<p>' . nl2br($name['Book_name']) . '</p>';
                                            echo '</div>';
                                            echo '</a>';
                                            echo '</div>';
                                        }
                                        echo '</div>';
                                    }
                                }
                            }
                        }
                    ?>
                </div>
                <div>
                    <?php
                        if (isset($_GET['book_id'])) {
                            $id = $_GET['book_id'];
                            $sql_select_info = "SELECT Book_id, File_pdf
                    FROM book
                    WHERE Book_id = '$id'";

                            $info_book = Database::db_get_list($sql_select_info);
                            foreach ($info_book as $name) {
                                $book_id = $name['Book_id'];
                                $name_file =  $name['File_pdf'];
                            }
                            $sql_select_info = "SELECT book.Book_name, genre.Genre_name, author.Author_name,book.Introduce,book.Book_id
                                                FROM book
                                                JOIN book_has_author ON book_has_author.Book_id = book.Book_id
                                                JOIN author ON book_has_author.Author_id = author.Author_id
                                                JOIN genre ON book.Genre_id = genre.Genre_id
                                                WHERE book.Book_id = '$id'";
                            $info_book = Database::db_get_list($sql_select_info);
                            if (!empty($info_book)) {
                                echo '<table>';
                                foreach ($info_book as $book) {
                                    $id_book = $book["Book_id"];
                                    echo '<tr>';
                                    echo '<th>Book</th>';
                                    echo '<td>' . $book["Book_name"] . '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    echo '<th>Genre</th>';
                                    echo '<td>' . $book["Genre_name"] . '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    echo '<th>Author</th>';
                                    echo '<td>' . $book["Author_name"] . '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    echo '<th>Introduce</th>';
                                    echo '<td>' . nl2br($book['Introduce']) . '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    echo '<th>Read</th>';
                                    echo '<td><a href="./PHP/log_in.php" ><button id = "btn">Open PDF</button></a></td>';
                                    echo '</tr>';
                                }

                                echo '</table>';
                            } else {
                                echo "No data in the website table.";
                            }
                        }
                    ?>
                </div>
            </div>
        <?php
                    }
        ?>
        </div>
        <!-- ======= About Section ======= -->
        <section id="about">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-6 about-img">
                        <img src="./Image/lô1.png" alt="">
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
                            <p>+84 702032064</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-email">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p>viet.gm.2k3@gmail.com</p>
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
    <script src="./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>