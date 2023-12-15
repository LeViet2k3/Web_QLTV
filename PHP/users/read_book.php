<?php
// Start the session
session_start();
include('../libs/helper.php');
if (!$_SESSION['email']) {
    Helper::redirect(Helper::get_url('../Web_QLTV/PHP/log_in.php'));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../CSS/read_book.css">
    <link href="../../Image/logo.png" rel="icon">
    <title>Read Book</title>
    <link href="../../Image/logo.png" rel="icon">

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div id="logo">
            <h1><a href="../users_interface.php">Open Lib<span>rary</span></a></h1>
        </div>

        <div id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="../users_interface.php">Home</a></li>
                <li><a class="nav-link scrollto active" href="./read_book.php">Read Book</a></li>
                <li><a class="nav-link scrollto" href="./my_books.php">My Book</a></li>
                <li><a class="nav-link scrollto" href="./update_info.php">Update Information</a></li>
                <li><a href="../log_out.php">Log Out</a></li>
            </ul>
        </div><!-- .navbar -->
    </header><!-- End Header -->
    <div class="full_search">
        <div class="form">
            <form action="" method="GET">
                <div><input type="text" name="book_name" placeholder="  Enter Book Name"></div>
                <div><button type="submit">Search</button></div>
            </form>
        </div>
        <div class="search">
            <?php
            Database::db_connect();
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if (!empty($_GET['book_name'])) {
                    $book_name = $_GET['book_name'];
                    $sql_select_bookname = "SELECT Images, Book_name, Book_id FROM book 
                                        WHERE Book_name = '$book_name'";
                    if (Database::db_execute($sql_select_bookname)) {
                        $bookname = Database::db_get_list($sql_select_bookname);
                        echo "<h2>All Books In The Library:</h2>";
                        // echo '<table>';
                        foreach ($bookname as $name) {
                            // echo '<tr>';
                            echo '<a href="?book_id=' . $name["Book_id"] . '">';
                            echo '<div class = "img">' . '<img src="data:image/jpeg;base64,' . $name["Images"] . '" alt="Book Image">' . '</div>';
                            echo '<div>' . '<p>' . nl2br($name['Book_name']) . '</p>' . '</div>';
                            // echo '<td><a href="?book_id=' . $name["Book_id"] . '">Detail</a><br></td>';
                            echo '</a>';
                            // echo '</tr>';
                        }
                        // echo '</table>';
                    }
                } else {
                    if (isset($_GET['book_id'])) {
                        $id = $_GET['book_id'];
                        $sql_select_bookname = "SELECT Images, Book_name, Book_id FROM book WHERE Book_id = '$id' ";
                        if (Database::db_execute($sql_select_bookname)) {
                            $bookname = Database::db_get_list($sql_select_bookname);
                            echo "<h2>All Books In The Library:</h2>";
                            echo '<table>';
                            foreach ($bookname as $name) {
                                echo '<tr>';
                                echo '<a href="?book_id=' . $name["Book_id"] . '">';
                                echo '<div class = "img">';
                                echo '<img src="data:image/jpeg;base64,' . $name["Images"] . '" alt="Book Image">';
                                echo  '<p>' . nl2br($name['Book_name']) . '</p>';
                                echo '</div>';
                                // echo '<td><a href="?book_id=' . $name["Book_id"] . '">Detail</a><br></td>';
                                echo '</a>';
                                echo '</tr>';
                            }
                            echo '</table>';
                        } else {
                            echo "ok";
                        }
                    } else {

                        $sql_select_bookname = "SELECT Images, Book_name, Book_id FROM book ";
                        if (Database::db_execute($sql_select_bookname)) {
                            $bookname = Database::db_get_list($sql_select_bookname);
                            echo "<h2>All Books In The Library:</h2>";
                            // echo '<table>';
                            echo '<div class = okok>';
                            foreach ($bookname as $name) {
                                // echo '<tr>';
                                echo '<div class = okokok>';
                                echo '<a href="?book_id=' . $name["Book_id"] . '">';
                                echo '<div class = "img">';
                                echo '<img src="data:image/jpeg;base64,' . $name["Images"] . '" alt="Book Image">';
                                echo  '<p>' . nl2br($name['Book_name']) . '</p>';
                                echo '</div>';
                                echo '</a>';
                                // echo '</tr>';
                                echo '</div>';
                            }
                            echo '</div>';
                            // echo '</table>';
                        }
                    }
                }

            ?>
        </div>

        <div class="display">
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
                        echo "<h2> Information:</h2>";
                        echo '<table>';
                        // echo '<tr>';
                        // echo '<th>Book</th>';
                        // echo '<th>Genre</th>';
                        // echo '<th>Author</th>';
                        // echo '<th>Introduce</th>';
                        // echo '<th>Read</th>';
                        // echo '<th>BookMark</th>';
                        // echo '<th>Favourite</th>';
                        // echo '</tr>';
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
                            echo '<td><a><button class="show_modal1" id = "btn">Open PDF</button></a></td>';
                            // echo '<td>' . '<a href="./library_records.php?book_id=' . $book["Book_id"]  . '"><i class="fa-regular fa-star"></i></a>' . '</td>';
                            // echo '<td>' . '<a><i class="fa-regular fa-heart"></i></a>' . '</td>';
                            echo '</tr>';
                        }

                        echo '</table>';
                    } else {
                        echo "No data in the website table.";
                    }
                    // $sql_info_book = "SELECT Images, Introduce FROM book WHERE book.Book_id = '$id'";
                    // $info_book = Database::db_get_list($sql_info_book);
                    // if (!empty($info_book)) {
                    //     echo '<div class = "introduce_book">';
                    //     foreach ($info_book as $book) {
                    //         echo '<div>' . '<img src="data:image/jpeg;base64,' . $book["Images"] . '" alt="Book Image">' . '</div>';
                    //         echo '<div>' . '<p>' . nl2br($book['Introduce']) . '</p>' . '</div>';
                    //     }
                    //     echo '</div>';
                    // }
                }
            }
        ?>
        <div>
            <!-- <img src="" alt=""> -->
            <!-- The Modal -->
            <div class="modal hidden">
                <a href="./library_records.php?book_id=<?php echo $book_id; ?>"><button class="close-modal">&times;</button></a>
                <iframe src="../../Document/<?php echo $name_file; ?>" frameborder="0" width="100%" height="700vh"></iframe>
            </div>

        </div>
        <?php
        Database::db_disconnect();
        ?>
        </div>
    </div>
    <script>
        // "use strict";
        const modal = document.querySelector(".modal");
        const btnCloseModal = document.querySelector(".close-modal");
        const btnsShowModal = document.querySelectorAll(".show_modal1");
        let button = true; // Đặt trạng thái là chưa nhấn

        const closeModal = function() {
            modal.classList.add("hidden");
        };

        const showModal = function() {
            if (button) {
                button = true; // Đặt trạng thái là đã nhấn
                modal.classList.remove("hidden"); // Hiển thị modal
            }
        };

        for (let i = 0; i < btnsShowModal.length; i++) {
            btnsShowModal[i].addEventListener("click", showModal);
        }
        btnCloseModal.addEventListener("click", closeModal);
    </script>
</body>


</html>