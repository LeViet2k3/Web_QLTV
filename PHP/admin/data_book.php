<?php
include('../libs/helper.php');
Database::db_connect();

$sql = "SELECT Book_id , COUNT(Book_id) AS book_views
FROM library_records
GROUP BY  Book_id";
Database::db_execute($sql);

// Chuyển đổi kết quả thành mảng JSON
$data = array();
$book_views = Database::db_get_list($sql);
foreach ($book_views as $view) {
    $data[] = $view;
}
// Đóng kết nối
Database::db_disconnect();
// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($data);
