<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
            text-align: center;
        }

        .uruku {
            display: flex;
        }

        .uruku1 {
            width: 60%;
        }

        .uruku1_1 {
            display: flex;
            margin-bottom: 10%;
        }

        .ok {
            margin-left: 10px;
        }

        .uruku2 {
            width: 30%;

        }
    </style>
</head>

<body>
    <div class="uruku">
        <div class="uruku1">
            <div>
                <form action="" method="post">
                    <div class="uruku1_1">
                        <div><input type="text" name="searchbook" placeholder="Nhập mã sách"></div>
                        <div class="ok"><input type="submit" value="Tìm"></div>
                    </div>
                </form>
            </div>
            <div>
                <?php
                include('libs/helper.php');
                db_connect();
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $search = $_POST['searchbook'];

                    $sql = "SELECT book.Book_id, book.Book_name, genre.Genre_name, author.Author_name
                FROM book_has_author
                JOIN book ON book_has_author.Book_id = book.Book_id
                JOIN author ON book_has_author.Author_id = author.Author_id
                JOIN genre ON book.Genre_id = genre.Genre_id
                WHERE book_has_author.Book_id = '$search'";

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table>';
                        echo '<tr>';
                        echo '<th>Mã Sách</th>';
                        echo '<th>Tên Sách</th>';
                        echo '<th>Thể Loại</th>';
                        echo '<th>Tên Tác Giả</th>';
                        echo '</tr>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row["Book_id"] . '</td>';
                            echo '<td>' . $row["Book_name"] . '</td>';
                            echo '<td>' . $row["Genre_name"] . '</td>';
                            echo '<td>' . $row["Author_name"] . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo "Không có dữ liệu trong bảng website.";
                    }
                }
                ?>
            </div>
        </div>
        <div class="uruku2">
            <table>
                <tr>
                    <th>Mã Sách</th>
                    <th>Tên Sách</th>

                </tr>
                <?php
                $sql1 = "SELECT book.Book_id, book.Book_name FROM book";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    while ($row = mysqli_fetch_assoc($result1)) {
                        echo "<tr>";
                        echo "<td>" . $row["Book_id"] . "</td>";
                        echo "<td>" . $row["Book_name"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Không có dữ liệu trong bảng website.";
                }
                db_disconnect();
                ?>
            </table>

        </div>
    </div>
</body>

</html>