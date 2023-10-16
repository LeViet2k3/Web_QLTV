<?php
// Start the session
session_start();
?>
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

// Dữ liệu bạn muốn chèn
$email = $_SESSION['email'];
$book_id = $_POST['Book_id'];
$day = date("Y-m-d ");
$return_day = $_POST['time'];

// Câu lệnh SQL để chèn dữ liệu
// $sql = "delete from sinh_vien where id = 3";
$sql = "INSERT INTO library_records (Email, Book_id, Book_borrowed_day, Book_return_day, Expense_id) 
        VALUES ('$email', '$book_id', '$day', '$return_day', 'MP01' )";
// Thực thi câu lệnh SQL
if (mysqli_query($conn, $sql)) {
    echo "Thêm dữ liệu vào bảng thành công ok!";
    echo $day;
} else {
    echo "Lỗi khi thêm dữ liệu vào bảng: " . mysqli_error($conn);
}

// Đóng kết nối
mysqli_close($conn);
