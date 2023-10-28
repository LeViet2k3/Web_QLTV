<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../CSS/library_records.css"> -->
    <title>Document</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center;
        }

        .okok {
            width: 40%;
            display: flex;
            flex-direction: column;
            float: right;
        }

        .okok1 {
            width: 58%;
            margin-right: 20px;
        }

        .okok2 {
            border: 1px solid black;
            padding: 10px;
            background-color: rgba(240, 248, 255, 0.7);
        }

        .library {
            text-align: center;
        }

        .uruku2 {
            padding: 15px;

        }

        .ok1_1 {
            flex: 1;
        }

        .full {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="full">
        <div class="okok1">
            <?php
            include('libs/helper.php');
            db_connect();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Dữ liệu bạn muốn chèn
                $email = $_SESSION['email'];
                $book_id = $_POST['Book_id'];
                $return_day = $_POST['time'];
                $expense;

                if ($_POST['time'] == "3 ngày") {
                    $expense = "MP01";
                }
                if ($_POST['time'] == "5 ngày") {
                    $expense = "MP02";
                }
                if ($_POST['time'] == "7 ngày") {
                    $expense = "MP03";
                }

                // Kiểm tra $remaining của sách
                $sql_check_remaining = "SELECT COALESCE(quantity - Dem, quantity) AS remaining
                    FROM book
                    LEFT JOIN (
                        SELECT Book_id, COUNT(Book_id) AS Dem
                        FROM library_records
                        WHERE Book_id = '$book_id'
                        GROUP BY Book_id
                    ) AS Q1 ON Q1.Book_id = book.Book_id";
                $result_check_remaining = mysqli_query($conn, $sql_check_remaining);
                if (mysqli_num_rows($result_check_remaining) > 0) {
                    $row = mysqli_fetch_assoc($result_check_remaining);
                    $remaining = $row["remaining"];

                    if ($remaining > 0) {
                        // Câu lệnh SQL để chèn dữ liệu
                        $sql = "INSERT INTO library_records (Email, Book_id, Book_return_day, Expense_id) 
                                VALUES ('$email', '$book_id', '$return_day', '$expense' )";
                        // Thực thi câu lệnh SQL
                        if (mysqli_query($conn, $sql)) {
                            $sql1 = "SELECT library_records.Email, library_records.Book_id, library_records.Book_borrowed_day, library_records.Book_return_day, expense.Charges
                                        FROM library_records
                                        JOIN expense ON library_records.Expense_id = expense.Expense_id
                                        WHERE Email = '$email'
                                        ORDER BY library_records.Id ASC ";
                            $result1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($result1) > 0) {
                                echo '<table>';
                                echo '<tr>';
                                echo '<th>Email</th>';
                                echo '<th>Mã Sách</th>';
                                echo '<th>Ngày Mượn</th>';
                                echo '<th>Thời Hạn</th>';
                                echo '<th>Mức Phí</th>';
                                echo '</tr>';

                                while ($row = mysqli_fetch_assoc($result1)) {
                                    echo '<tr>';
                                    echo '<td>' . $row["Email"] . '</td>';
                                    echo '<td>' . $row["Book_id"] . '</td>';
                                    echo '<td>' . $row["Book_borrowed_day"] . '</td>';
                                    echo '<td>' . $row["Book_return_day"] . '</td>';
                                    echo '<td>' . $row["Charges"] . '</td>';
                                    echo '</tr>';
                                }
                                echo '</table>';
                            }
                        } else {
                            echo "Lỗi khi thêm dữ liệu vào bảng: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Sách đã hết. Không thể mượn thêm.";
                    }
                } else {
                    echo "Không có dữ liệu trong bảng website.";
                }
            }

            // Đóng kết nối
            db_disconnect();
            ?>
        </div>
        <div class="okok">
            <div class="okok2">
                <form action="" method="post">
                    <div class="library">
                        <div class="ok1">
                            Nhập mã sách:&emsp; <input type="text" class="ok1_1" name="Book_id" placeholder="Nhập mã sách" required>
                        </div><br>
                        <div class="ok1">
                            Thời hạn:&emsp;
                            <input type="radio" name="time" value="3 ngày" required>&nbsp; 3 ngày &emsp;
                            <input type="radio" name="time" value="5 ngày" required>&nbsp; 5 ngày &emsp;
                            <input type="radio" name="time" value="7 ngày" required>&nbsp; 7 ngày &emsp;
                        </div><br>
                        <div class="ok2">
                            <input type="submit">
                        </div>
                    </div>
                </form>
            </div>
            <div class="uruku2">
                <table>
                    <tr>
                        <th>Mã Sách</th>
                        <th>Tên Sách</th>
                        <th>Số Lượng</th>
                        <th>Sách Còn</th>

                    </tr>
                    <?php
                    $sql1 = "SELECT book.Book_id, book.Book_name, book.quantity, COALESCE(book.quantity - Q1.Dem, book.quantity) AS remaining
                    FROM book
                    LEFT JOIN (
                        SELECT Book_id, COUNT(Book_id) AS Dem
                        FROM library_records
                        GROUP BY Book_id
                    ) AS Q1 ON Q1.Book_id = book.Book_id ";
                    $result1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                        while ($row = mysqli_fetch_assoc($result1)) {
                            echo "<tr>";
                            echo "<td>" . $row["Book_id"] . "</td>";
                            echo "<td>" . $row["Book_name"] . "</td>";
                            echo "<td>" . $row["quantity"] . "</td>";
                            echo "<td>" . $row["remaining"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Không có dữ liệu trong bảng website.";
                    }
                    db_disconnect();
                    ?>
                </table>

            </div>
        </div>
    </div>
</body>

</html>