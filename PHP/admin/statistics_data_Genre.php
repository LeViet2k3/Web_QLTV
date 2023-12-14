<?php
include('../libs/helper.php');
Database::db_connect();

// Truy vấn dữ liệu
$sql = "SELECT DATE(Book_borrowed_day) AS dates, COUNT(*) AS views, Genre_name
FROM library_records as l JOIN book as b on l.Book_id = b.Book_id
join genre on genre.Genre_id = b.Genre_id
GROUP BY DATE(Book_borrowed_day), b.Genre_id";
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
