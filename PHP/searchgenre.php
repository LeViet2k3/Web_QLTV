<?php
$server = "localhost"; // Tên máy chủ MySQL (mặc định là localhost)
$username = "root";    // Tên đăng nhập MySQL
$password = "";        // Mật khẩu MySQL (nếu bạn có mật khẩu)
$database = "quan_ly_thu_vien";    // Tên cơ sở dữ liệu MySQL

// Kết nối tới cơ sở dữ liệu
$conn = mysqli_connect($server, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

$search = $_POST['searchgenre'];

$sql = "SELECT book.Book_id, book.Book_name, book.Genre_id, author.Author_name
        FROM book_has_author
        JOIN book ON book_has_author.Book_id = book.Book_id
        JOIN author ON book_has_author.Author_id = author.Author_id
        WHERE book.Genre_id = '$search'";

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
// Đóng kết nối
mysqli_close($conn);
