<?php

$server = "localhost"; // Tên máy chủ MySQL (mặc định là localhost)
$username = "root";    // Tên đăng nhập MySQL
$password = "";        // Mật khẩu MySQL (nếu bạn có mật khẩu)
$database = "quan_ly_thu_vien";    // Tên cơ sở dữ liệu MySQL

// Kết nối tới cơ sở dữ liệu
$conn = mysqli_connect($server, $username, $password, $database);
//------------Database-------------------
function db_connect()
{
    global $conn;
    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }

    return $conn;
}


function db_disconnect()
{
    global $conn;
    if (!is_null($conn)) {
        $conn = null;
    }
}
