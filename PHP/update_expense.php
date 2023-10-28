<?php
include('libs/helper.php');
db_connect();
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

db_disconnect();
?>

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
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <input type="text" placeholder="Nhập mã mức phí" name="expenseID" required /><br><br>
        <input type="text" placeholder="Nhập mức phí..." name="charges" required />
        <button type="submit">ADD</button>
    </form>
</body>

</html>