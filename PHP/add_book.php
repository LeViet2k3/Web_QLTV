<?php
include('libs/helper.php');
db_connect();
// Hiển thị bảng book
$sql1 = "SELECT * FROM book ";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0) {
    echo '<table>';
    echo '<tr>';
    echo '<th>Mã Sách</th>';
    echo '<th>Tên Sách</th>';
    echo '<th>Số Lượng</th>';
    echo '<th>Mã Thể Loại</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result1)) {
        echo '<tr>';
        echo '<td>' . $row["Book_id"] . '</td>';
        echo '<td>' . $row["Book_name"] . '</td>';
        echo '<td>' . $row["quantity"] . '</td>';
        echo '<td>' . $row["Genre_id"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
// Hiển thị bảng genre
$sql2 = "SELECT * FROM genre ";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
    echo '<table>';
    echo '<tr>';
    echo '<th>Mã Thể Loại</th>';
    echo '<th>Tên Thể Loại</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result2)) {
        echo '<tr>';
        echo '<td>' . $row["Genre_id"] . '</td>';
        echo '<td>' . $row["Genre_name"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

// Hiển thị bảng author
$sql15 = "SELECT * FROM author ";
$result15 = mysqli_query($conn, $sql15);
if (mysqli_num_rows($result15) > 0) {
    echo '<table>';
    echo '<tr>';
    echo '<th>Mã Tác Giả</th>';
    echo '<th>Tên Tác Giả</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result15)) {
        echo '<tr>';
        echo '<td>' . $row["Author_id"] . '</td>';
        echo '<td>' . $row["Author_name"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $quantity = $_POST['quantity'];
    $author_id = $_POST['author_id'];
    $author_name = $_POST['author_name'];
    $new_genre_id = $_POST['genre_id'];
    $new_genre_name = $_POST['genre_name'];
    // Kiểm tra Genre_id bảng genre
    $sql4 = "SELECT * FROM genre WHERE Genre_id = '$new_genre_id' AND Genre_name = '$new_genre_name'";
    $result4 = mysqli_query($conn, $sql4);
    if (mysqli_num_rows($result4) > 0) {
        // Thêm dữ liệu vào bảng book
        $sql = "INSERT INTO book(Book_id, Book_name, quantity, Genre_id)
                VALUES ('$book_id', '$book_name', '$quantity', '$new_genre_id') ";
        $result = mysqli_query($conn, $sql);
    } else {
        // Thêm dữ liệu vào bảng genre
        $sql3 = "INSERT INTO genre(Genre_id, Genre_name)
                        VALUES ('$new_genre_id', '$new_genre_name')";
        if (mysqli_query($conn, $sql3)) {
            // Thêm dữ liệu vào bảng book
            $sql5 = "INSERT INTO book(Book_id, Book_name, quantity, Genre_id)
                        VALUES ('$book_id', '$book_name', '$quantity', '$new_genre_id') ";
            $result5 = mysqli_query($conn, $sql5);
        }
    }
    // Kiểm tra Author_id bảng Author
    $sql10 = "SELECT Author_id FROM author WHERE Author_id = '$author_id'";
    $result10 = mysqli_query($conn, $sql10);
    if (mysqli_num_rows($result10) > 0) {
        // Thêm dữ liệu vào bảng book
        $sql11 = "INSERT INTO book_has_author(Book_id, Author_id)
                    VALUES ('$book_id', '$author_id') ";
        $result11 = mysqli_query($conn, $sql11);
    } else {
        // Thêm dữ liệu vào bảng genre
        $sql12 = "INSERT INTO author(Author_id, Author_name)
                VALUES ('$author_id', '$author_name')";
        if (mysqli_query($conn, $sql12)) {
            // Thêm dữ liệu vào bảng book_has_author
            $sql14 = "INSERT INTO book_has_author(Book_id, Author_id)
                        VALUES ('$book_id', '$author_id') ";
            $result14 = mysqli_query($conn, $sql14);
        }
    }
    header("Location: http://localhost:8282/Web_QLTV/PHP/add_book.php");
    exit;
}
db_disconnect();
?>
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
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div>
        <form action="" method="post">
            <input type="text" name="book_id" placeholder="Nhập mã sách" required><br>
            <input type="text" name="book_name" placeholder="Nhập tên sách" required><br>
            <input type="number" name="quantity" placeholder="Số lượng" required><br>
            <input type="text" name="author_id" placeholder="Nhập mã tác giả" required><br>
            <input type="text" name="author_name" placeholder="Nhập tên tác giả" required><br>
            <input type="text" name="genre_id" placeholder="Nhập mã thể loại" required><br>
            <input type="text" name="genre_name" placeholder="Nhập tên thể loại" required><br>
            <input type="submit" value="ADD">
        </form>
    </div>
</body>

</html>