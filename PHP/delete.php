<?php
include('libs/helper.php');
db_connect();
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $sql = "UPDATE users SET Users_status = 'Đã xóa' WHERE Email = '$email'";
    if (mysqli_query($conn, $sql)) {
        header("Location: http://localhost:8282/Web_QLTV/PHP/delete_users.php");
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
// Đóng kết nối
db_disconnect();
