<?php
include('libs/helper.php');
db_connect();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['searchbook'];

    $sql = "SELECT book.Book_id, book.Book_name, book.Genre_id, author.Author_name
        FROM book_has_author
        JOIN book ON book_has_author.Book_id = book.Book_id
        JOIN author ON book_has_author.Author_id = author.Author_id
        WHERE book_has_author.Book_id = '$search'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Mã Sách: " . $row["Book_id"] . "<br>";
            echo "Tên Sách: " . $row["Book_name"] . "<br>";
            echo "Mã Thể Loại: " . $row["Genre_id"] . "<br>";
            echo "Tên Tác Giả: " . $row["Author_name"] . "<br>";
            echo "<br><br>";
        }
    } else {
        echo "Không có dữ liệu trong bảng website.";
    }
}
// Đóng kết nối
db_disconnect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <form action="" method="post">
            <input type="text" name="searchbook" placeholder="Nhập mã sách"><br><br>
            <input type="submit" value="Tìm">
        </form>
    </div>
</body>

</html>