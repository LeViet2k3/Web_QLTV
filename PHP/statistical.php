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
            db_connect();

            $sql = "SELECT * FROM library_records";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Id</th>';
                echo '<th>Email</th>';
                echo '<th>Mã Sách</th>';
                echo '<th>Ngày Mượn</th>';
                echo '<th>Thời Hạn</th>';
                echo '<th>Mã Phí</th>';
                echo '</tr>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row["Id"] . '</td>';
                    echo '<td>' . $row["Email"] . '</td>';
                    echo '<td>' . $row["Book_id"] . '</td>';
                    echo '<td>' . $row["Book_borrowed_day"] . '</td>';
                    echo '<td>' . $row["Book_return_day"] . '</td>';
                    echo '<td>' . $row["Expense_id"] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo "Không có dữ liệu trong bảng website.";
            }
            ?>
        </div>
    </div>
    <!-- SELECT Email,Book_id, COUNT(Book_id) FROM `library_records`
GROUP BY Book_id 

SELECT Expense_id, COUNT(Expense_id) FROM `library_records` 
GROUP BY Expense_id-->
</body>
<!-- SELECT q1.*, q1.tong * expense.Charges FROM `expense`
JOIN
(SELECT Book_id, Expense_id, COUNT(Book_id) AS tong FROM `library_records` 
GROUP BY Book_id) AS q1 ON expense.Expense_id = q1.Expense_id -->

</html>