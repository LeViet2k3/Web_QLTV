<?php
include('libs/helper.php');
db_connect();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $expenseID = $_POST['expenseID'];
    $charges = $_POST['charges'];
    if (is_numeric($charges)) {
        $sql1 = "INSERT INTO expense(Expense_id, Charges) VALUES ('$expenseID', '$charges')";
        $result1 = mysqli_query($conn, $sql1);

        if ($result1) {
            header("Location: http://localhost:8282/Web_QLTV/PHP/update_expense.php");
            exit;
        } else {
            echo "Lỗi: " . mysqli_error($conn);
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
            $sql = "SELECT * FROM expense";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Mã Phí</th>';
                echo '<th>Mức Phí</th>';
                echo '<th>Cập Nhật</th>';
                echo '</tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['Expense_id'] . "</td>";
                    echo "<td>" . $row['Charges'] . "</td>";
                    echo "<td>
                        <a href='edit.php?Expense_id=" . $row['Expense_id'] . "'><button>Cập Nhật</button></a>
                        </td>";

                    echo '</tr>';
                }
                echo '</table>';
            }
            db_disconnect();
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