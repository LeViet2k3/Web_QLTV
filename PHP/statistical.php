<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
            text-align: center;
        }

        .uruku {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="uruku">
        <div>
            <?php
            include('libs/helper.php');
            Database::db_connect();

            $sql = "SELECT library_records.Email, library_records.Book_id, library_records.Book_borrowed_day, library_records.Book_return_day, expense.Charges FROM library_records
                    JOIN expense ON expense.Expense_id = library_records.Expense_id";
            if (Database::db_execute($sql)) {
                echo '<table>';
                echo '<tr>';
                // echo '<th>Id</th>';
                echo '<th>Email</th>';
                echo '<th>Mã Sách</th>';
                echo '<th>Ngày Mượn</th>';
                echo '<th>Thời Hạn</th>';
                echo '<th>Mã Phí</th>';
                echo '</tr>';

                $library_records = Database::db_get_list($sql);
                foreach ($library_records as $records) {
                    echo '<tr>';
                    // echo '<td>' . $records["Id"] . '</td>';
                    echo '<td>' . $records["Email"] . '</td>';
                    echo '<td>' . $records["Book_id"] . '</td>';
                    echo '<td>' . $records["Book_borrowed_day"] . '</td>';
                    echo '<td>' . $records["Book_return_day"] . '</td>';
                    echo '<td>' . $records["Charges"] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo "Không có dữ liệu trong bảng website.";
            }
            Database::db_disconnect();
            ?>
        </div>
    </div>

</body>
<!-- SELECT q1.Book_id, q1.tong, q1.tong * expense.Charges AS tong_phi FROM `expense`
JOIN
(SELECT Book_id, Expense_id, COUNT(Book_id) AS tong FROM `library_records` 
GROUP BY Book_id) AS q1 ON expense.Expense_id = q1.Expense_id -->

</html>