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

        .uruku h2 {
            text-align: center;
            margin-bottom: 4%;
        }
    </style>
</head>

<body>
    <div class="uruku">
        <div>
            <h2>Bảng Thống Kê Số Lượng Sách Thuê Và Doanh Thu</h2>
            <?php
            Database::db_connect();

            $sql = "SELECT Email, Book_id,Charges, So_Luong, So_Luong * Charges as Tong_Phi FROM
                        (SELECT Email, Book_id, Charges, COUNT(*) AS So_Luong FROM library_records
                         GROUP BY Email, Book_id, Charges) AS Q1";
            if (Database::db_execute($sql)) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Email</th>';
                echo '<th>Mã Sách</th>';
                echo '<th>Mức Phí</th>';
                echo '<th>Số Lượng</th>';
                echo '<th>Tổng Phí</th>';
                echo '</tr>';

                $library_records = Database::db_get_list($sql);
                foreach ($library_records as $records) {
                    echo '<tr>';
                    echo '<td>' . $records["Email"] . '</td>';
                    echo '<td>' . $records["Book_id"] . '</td>';
                    echo '<td>' . $records["Charges"] . '</td>';
                    echo '<td>' . $records["So_Luong"] . '</td>';
                    echo '<td>' . $records["Tong_Phi"] . '</td>';
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
<!-- SELECT Book_id,Charges, Tong, Tong * Charges as Tong_Phi FROM
(SELECT Book_id, Charges, COUNT(*) AS Tong FROM library_records
GROUP BY Book_id, Charges) AS Q1 -->

</html>