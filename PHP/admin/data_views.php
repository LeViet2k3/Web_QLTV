<?php
include('../libs/helper.php');
Database::db_connect();

// Truy vấn dữ liệu
$sql = "SELECT DATE(Reading_day) AS dates, COUNT(*) AS views
FROM library_records
GROUP BY DATE(Reading_day)";
Database::db_execute($sql);

// Chuyển đổi kết quả thành mảng JSON
$data = array();
$views = Database::db_get_list($sql);
foreach ($views as $view) {
    $data[] = $view;
}
// Đóng kết nối
Database::db_disconnect();
// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($data);
