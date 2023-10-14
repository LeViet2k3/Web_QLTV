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
$email = $_POST['email'];
$username = $_POST['username'];
$gender = $_POST['gender'];
$password = $_POST['password'];
$place_of_origin = $_POST['place_of_origin'];
$a_phone_number = $_POST['a_phone_number'];

// Câu lệnh SQL để chèn dữ liệu
// $sql = "delete from sinh_vien where id = 3";
$sql = "INSERT INTO users (Email, UserName, Gender, Passwords, Place_of_origin, A_phone_number) 
        VALUES ('$email', '$username', '$gender', '$password', '$place_of_origin', '$a_phone_number' )";
// Thực thi câu lệnh SQL
if (mysqli_query($conn, $sql)) {
    echo "Thêm dữ liệu vào bảng thành công!";
} else {
    echo "Lỗi khi thêm dữ liệu vào bảng: " . mysqli_error($conn);
}

// Đóng kết nối
mysqli_close($conn);
