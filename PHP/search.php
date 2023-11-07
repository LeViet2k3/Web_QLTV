<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .full_search {
            display: flex;
        }

        .search {
            width: 30%;

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
            width: 70%;
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

        .display h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="full_search">
        <div class="search">
            <?php
            include('libs/helper.php');
            Database::db_connect();
            $sql_select_authorname = "SELECT Author_name FROM author ";
            echo "<h2>Danh sách Tác Giả:</h2>";
            if (Database::db_execute($sql_select_authorname)) {
                $authorname = Database::db_get_list($sql_select_authorname);
                foreach ($authorname as $author) {
                    echo '<a href="?authorname=' . $author["Author_name"] . '">' . $author["Author_name"] . '</a><br>';
                }
            }
            ?>
        </div>

        <div class="display">
            <?php
            // Xử lý khi có tham số truyền vào
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['authorname'])) {
                $authorname = $_GET['authorname'];
                $sql_select_info = "SELECT book.Book_id, book.Book_name, genre.Genre_name, author.Author_name
                FROM book_has_author
                JOIN book ON book_has_author.Book_id = book.Book_id
                JOIN author ON book_has_author.Author_id = author.Author_id
                JOIN genre ON book.Genre_id = genre.Genre_id
                WHERE author.Author_name LIKE '%$authorname%'";

                if (Database::db_execute($sql_select_info)) {
                    echo "<h2> Thông tin về sách bạn cần tìm</h2>";
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Mã Sách</th>';
                    echo '<th>Tên Sách</th>';
                    echo '<th>Thể Loại</th>';
                    echo '<th>Tên Tác Giả</th>';
                    echo '</tr>';

                    $info_book = Database::db_get_list($sql_select_info);
                    foreach ($info_book as $book) {
                        echo '<tr>';
                        echo '<td>' . $book["Book_id"] . '</td>';
                        echo '<td>' . $book["Book_name"] . '</td>';
                        echo '<td>' . $book["Genre_name"] . '</td>';
                        echo '<td>' . $book["Author_name"] . '</td>';
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