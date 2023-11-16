<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/search.css">
</head>

<body>
    <div class="full_search">
        <div class="search">
            <?php
            include('../libs/helper.php');
            Database::db_connect();
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
                $sql_select_info = "SELECT book.Book_name, genre.Genre_name, author.Author_name, book.Price, book.quantity, book.Book_id
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
                    echo '<th>Price</th>';
                    echo '<th>Remaining Of Books</th>';
                    echo '<th>Register</th>';
                    echo '</tr>';
                    foreach ($info_book as $book) {
                        echo '<tr>';
                        echo '<td>' . $book["Book_name"] . '</td>';
                        echo '<td>' . $book["Genre_name"] . '</td>';
                        echo '<td>' . $book["Author_name"] . '</td>';
                        echo '<td>' . $book["Price"] . '</td>';
                        echo '<td>' . $book["quantity"] . '</td>';
                        echo '<td><a href="./library_records.php?book_id=' . $book["Book_id"]  . '&price=' . $book["Price"] . '">Register</a></td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo "No data in the website table.";
                }
            }
            Database::db_disconnect();
            ?>
        </div>
    </div>
</body>

</html>