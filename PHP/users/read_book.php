<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/read_book.css">
</head>

<body>
    <div class="full_search">
        <div class="search">
            <?php
            include('../libs/helper.php');
            Database::db_connect();
            $email = $_SESSION['email'];
            $sql_select_bookname = "SELECT Book_name FROM book ";
            echo "<h2>All Books In The Library:</h2>";
            if (Database::db_execute($sql_select_bookname)) {
                $bookname = Database::db_get_list($sql_select_bookname);
                foreach ($bookname as $name) {
                    echo '<a href="?bookname=' . $name["Book_name"] . '">' . $name["Book_name"] . '</a><br>';
                }
            }
            ?>
        </div>

        <div class="display">
            <?php
            // Xử lý khi có tham số truyền vào
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['bookname'])) {
                $bookname = $_GET['bookname'];
                $sql_select_info = "SELECT Book_id, File_pdf
                FROM book
                WHERE Book_name = '$bookname'";

                $info_book = Database::db_get_list($sql_select_info);
                foreach ($info_book as $name) {
                    $book_id = $name['Book_id'];
                    $name_file =  $name['File_pdf'];
                }
                // echo '<button class="show_modal" onclick="openPdf()">Open PDF</button>';
                $sql_select_info = "SELECT book.Book_name, genre.Genre_name, author.Author_name,book.Book_id
                FROM book
                JOIN book_has_author ON book_has_author.Book_id = book.Book_id
                JOIN author ON book_has_author.Author_id = author.Author_id
                JOIN genre ON book.Genre_id = genre.Genre_id
                WHERE book.Book_name = '$bookname'";
                $info_book = Database::db_get_list($sql_select_info);
                if (!empty($info_book)) {
                    echo "<h2> Information About The Book You Are Looking For:</h2>";
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Book Name</th>';
                    echo '<th>Genre</th>';
                    echo '<th>Author Name</th>';
                    echo '<th>Register</th>';
                    echo '</tr>';
                    foreach ($info_book as $book) {
                        echo '<tr>';
                        echo '<td>' . $book["Book_name"] . '</td>';
                        echo '<td>' . $book["Genre_name"] . '</td>';
                        echo '<td>' . $book["Author_name"] . '</td>';
                        echo '<td><button class="show_modal" Database::openPdf()>Open PDF</button></td>';

                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo "No data in the website table.";
                }
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["button"])) {
                // $buttonValue = $_POST["button"];
                // echo $buttonValue;
                // Database::db_connect();
                $sql = "INSERT INTO library_records(Email, Book_id)
                        VALUES('$email', '$book_id')";
                // Database::db_execute($sql);
                // Database::db_disconnect();
            }
            ?>
            <div>
                <!-- The Modal -->
                <div class="modal hidden">
                    <button class="close-modal">&times;</button>
                    <iframe src="../../Document/<?php echo $name_file ?>" frameborder="0" width="100%" height="700vh">

                    </iframe>
                </div>
            </div>
            <?php
            Database::db_disconnect();
            ?>
        </div>
    </div>
    <script>
        "use strict";
        const modal = document.querySelector(".modal");
        const btnCloseModal = document.querySelector(".close-modal");
        const btnsShowModal = document.querySelectorAll(".show_modal");
        const closeModal = function() {
            modal.classList.add("hidden");
        };

        const showModal = function() {
            let button = true;
            if (button) {
                button = false; // Đặt trạng thái là đã nhấn
                modal.classList.remove("hidden"); // Hiển thị modal

                // Chỉ gửi giá trị khi button là false
                if (!button) {
                    // Sử dụng Ajax để gửi giá trị button đến server
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "read_book.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                    // Truyền giá trị button qua Ajax
                    xhr.send("button=" + button);
                }
            }
        };

        for (let i = 0; i < btnsShowModal.length; i++) {
            btnsShowModal[i].addEventListener("click", showModal);
        }
        btnCloseModal.addEventListener("click", closeModal);
        // Close the Modal by pressing ESC keydown
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape" && !modal.classList.contains("hidden")) {
                closeModal();
            }
        });
    </script>
</body>


</html>