<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/update_price.css">
    <title>Document</title>
</head>

<body>
    <div class="full_update_expense">
        <div class="display_expense">
            <?php
            include('../libs/helper.php');
            Database::db_connect();
            $sql_select_expense = "SELECT Book_name, Price, Book_id FROM book";
            if (Database::db_execute($sql_select_expense)) {
                echo '<h2>Price Table For All Books In The Library</h2>';
                echo '<table>';
                echo '<tr>';
                echo '<th>Book Name</th>';
                echo '<th>Price</th>';
                echo '<th>Update</th>';
                echo '</tr>';
                $expenses = Database::db_get_list($sql_select_expense);
                foreach ($expenses as $expense) {
                    echo "<tr>";
                    echo "<td>" . $expense['Book_name'] . "</td>";
                    echo "<td>" . $expense['Price'] . "</td>";
                    echo "<td>
                        <a href='?Book_id=" . $expense['Book_id'] . "'><button>Update</button></a>
                        </td>";

                    echo '</tr>';
                }
                echo '</table>';
            }
            ?>
        </div>
        <div class="form_update">
            <?php
            if (isset($_GET['Book_id'])) {
                $id = $_GET['Book_id'];

                // Kiểm tra xem biểu mẫu đã được gửi đi chưa
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $price = $_POST['price'];
                    $id = $_GET['Book_id']; // Lấy ID từ URL

                    // Kiểm tra xem giá trị $charges có phải là số hay không
                    if (is_numeric($price)) {
                        // Chuẩn bị câu lệnh SQL
                        $sql = "UPDATE book SET Price = $price WHERE Book_id = '$id'";
                        if (Database::db_execute($sql)) {
                            Helper::redirect(Helper::get_url('../Web_QLTV/PHP/admin/update_price.php'));
                        }
                    } else {
                        echo "The fee must be a valid number.";
                    }
                }
            ?>
                <h3>Update Book Prices</h3>
                <div class="form">
                    <form action="" method="post">
                        <input type="text" placeholder="Enter book price" name="price">
                        <button type="submit">Update</button>
                    </form>
                </div>
            <?php
            }
            Database::db_disconnect();
            ?>
        </div>
    </div>
</body>

</html>