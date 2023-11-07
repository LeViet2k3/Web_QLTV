<?php
include('libs/helper.php');
Database::db_connect();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $expenseID = $_POST['expenseID'];
    $charges = $_POST['charges'];
    if (is_numeric($charges)) {
        $sql_insert_expense = "INSERT INTO expense(Expense_id, Charges) VALUES ('$expenseID', '$charges')";
        if (Database::db_execute($sql_insert_expense)) {
            Helper::redirect(Helper::get_url('../Web_QLTV/PHP/update_expense.php'));
        } else {
            echo "Lỗi: ";
        }
    } else {
        echo "Mức phí phải là một số hợp lệ.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/update_expense.css">
    <title>Document</title>
</head>

<body>
    <div class="full_update_expense">
        <div class="display_expense">
            <?php
            $sql_select_expense = "SELECT * FROM expense";
            if (Database::db_execute($sql_select_expense)) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Mã Phí</th>';
                echo '<th>Mức Phí</th>';
                echo '<th>Cập Nhật</th>';
                echo '</tr>';
                $expenses = Database::db_get_list($sql_select_expense);
                foreach ($expenses as $expense) {
                    echo "<tr>";
                    echo "<td>" . $expense['Expense_id'] . "</td>";
                    echo "<td>" . $expense['Charges'] . "</td>";
                    echo "<td>
                        <a href='edit.php?Expense_id=" . $expense['Expense_id'] . "'><button>Cập Nhật</button></a>
                        </td>";

                    echo '</tr>';
                }
                echo '</table>';
            }
            Database::db_disconnect();
            ?>
        </div>
        <div class="add_expense">
            <h2>Thêm Chi Phí</h2>
            <form action="" method="post">
                <div><input class="input" type="text" placeholder="Nhập mã mức phí" name="expenseID" required /></div>
                <div><input class="input" type="text" placeholder="Nhập mức phí..." name="charges" required /></div>
                <div class="submit"><button type="submit">ADD</button></div>
            </form>
        </div>
    </div>
</body>

</html>