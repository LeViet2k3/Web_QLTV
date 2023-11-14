<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/update_expense.css">
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
                echo '<table>';
                echo '<tr>';
                echo '<th>Tên Sách</th>';
                echo '<th>Giá</th>';
                echo '<th>Cập Nhật</th>';
                echo '</tr>';
                $expenses = Database::db_get_list($sql_select_expense);
                foreach ($expenses as $expense) {
                    echo "<tr>";
                    echo "<td>" . $expense['Book_name'] . "</td>";
                    echo "<td>" . $expense['Price'] . "</td>";
                    echo "<td>
                        <a href='edit.php?Book_id=" . $expense['Book_id'] . "'><button>Cập Nhật</button></a>
                        </td>";

                    echo '</tr>';
                }
                echo '</table>';
            }
            Database::db_disconnect();
            ?>
        </div>
    </div>
</body>

</html>