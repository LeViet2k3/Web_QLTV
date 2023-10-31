<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h2 {
            text-align: center;
        }

        .delete_user table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center;
            margin: auto;
        }
    </style>
</head>

<body>
    <h2>Danh Sách Các Tài Khoản Đang Sử Dụng Dịch Vụ</h2>
    <div class="delete_user">
        <?php
        include('libs/helper.php');
        db_connect();
        $sql = "SELECT Email, UserName, Gender, Place_of_origin, A_phone_number
        FROM users WHERE Users_status = 'Đang hoạt động'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Email</th>';
            echo '<th>Họ Tên</th>';
            echo '<th>Giới Tính</th>';
            echo '<th>Quê Quán</th>';
            echo '<th>Số Điện Thoại</th>';
            echo '<th>Xóa</th>';
            echo '</tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . $row['UserName'] . "</td>";
                echo "<td>" . $row['Gender'] . "</td>";
                echo "<td>" . $row['Place_of_origin'] . "</td>";
                echo "<td>" . $row['A_phone_number'] . "</td>";
                echo "<td>
                <a href='delete.php?email=" . $row['Email'] . "'><button>Xóa</button></a>
                </td>";

                echo '</tr>';
            }
            echo '</table>';
        }

        db_disconnect();
        ?>
    </div>
</body>

</html>