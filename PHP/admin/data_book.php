<?php
include('../libs/helper.php');
Database::db_connect();

$sql = "SELECT genre.Genre_name , COUNT(genre.Genre_name) AS genre_views
FROM library_records
JOIN book ON book.Book_id = library_records.Book_id
JOIN genre ON genre.Genre_id = book.Genre_id
GROUP BY  genre.Genre_name";
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
