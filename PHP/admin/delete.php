<?php
include('../libs/helper.php');
Database::db_connect();
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $sql_update_users = "UPDATE users SET Users_status = 'Đã xóa' WHERE Email = '$email'";
    if (Database::db_execute($sql_update_users)) {
        Helper::redirect(Helper::get_url('../Web_QLTV/PHP/admin/delete_users.php'));
    } else {
        echo "Xóa Không Thành Công. ";
    }
}
// Đóng kết nối
Database::db_disconnect();
