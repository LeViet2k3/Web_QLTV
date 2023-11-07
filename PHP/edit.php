<?php
include('libs/helper.php');
Database::db_connect();

if (isset($_GET['Expense_id'])) {
    $id = $_GET['Expense_id'];

    // Kiểm tra xem biểu mẫu đã được gửi đi chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $charges = $_POST['charges'];
        $id = $_GET['Expense_id']; // Lấy ID từ URL

        // Kiểm tra xem giá trị $charges có phải là số hay không
        if (is_numeric($charges)) {
            // Chuẩn bị câu lệnh SQL
            $sql = "UPDATE expense SET Charges = $charges WHERE Expense_id = '$id'";
            if (Database::db_execute($sql)) {
                Helper::redirect(Helper::get_url('../Web_QLTV/PHP/update_expense.php'));
            }
        } else {
            echo "Mức phí phải là một số hợp lệ.";
        }
    }
}

// Đóng kết nối
Database::db_disconnect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" placeholder="Nhập mức phí" name="charges">
        <button type="submit">Cập nhật</button>
    </form>
</body>

</html>