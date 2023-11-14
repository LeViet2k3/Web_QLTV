<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-image: url(../Image/background/anh7.jpg);
            background-size: cover;
        }

        .full_search {
            display: flex;
        }

        .search {
            width: 35%;

        }

        .search h2 {
            text-align: center;
        }

        .search a {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            text-decoration: none;
            border: 1px solid black;
            text-align: center;
            margin: auto;
            color: black;
            padding: 10px;
            width: 50%;
        }

        .display {
            width: 65%;
        }

        .display table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
            text-align: center;
            margin: auto;
        }

        .display table {
            width: 90%;
        }

        .display h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="full_search">
        <div class="search">
            <?php
            include('../libs/helper.php');
            Database::db_connect();
            $sql_select_bookname = "SELECT Book_name FROM book ";
            echo "<h2>Tất Cả Sách Trong Thư Viện:</h2>";
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
                $sql_select_info = "SELECT book.Book_name, genre.Genre_name, author.Author_name, book.Price, book.quantity, book.Book_id
                FROM book
                JOIN book_has_author ON book_has_author.Book_id = book.Book_id
                JOIN author ON book_has_author.Author_id = author.Author_id
                JOIN genre ON book.Genre_id = genre.Genre_id
                WHERE book.Book_name = '$bookname'";

                $info_book = Database::db_get_list($sql_select_info);
                if (!empty($info_book)) {
                    echo "<h2> Thông Tin Về Sách Bạn Cần Tìm</h2>";
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Tên Sách</th>';
                    echo '<th>Thể Loại</th>';
                    echo '<th>Tên Tác Giả</th>';
                    echo '<th>Giá</th>';
                    echo '<th>Sách Còn</th>';
                    echo '<th>Đăng Ký</th>';
                    echo '</tr>';
                    foreach ($info_book as $book) {
                        echo '<tr>';
                        echo '<td>' . $book["Book_name"] . '</td>';
                        echo '<td>' . $book["Genre_name"] . '</td>';
                        echo '<td>' . $book["Author_name"] . '</td>';
                        echo '<td>' . $book["Price"] . '</td>';
                        echo '<td>' . $book["quantity"] . '</td>';
                        echo '<td><a href="./library_records.php?book_id=' . $book["Book_id"]  . '">Đăng Ký</a></td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo "Không có dữ liệu trong bảng website.";
                }
            }
            Database::db_disconnect();
            ?>
        </div>
    </div>
</body>

</html>