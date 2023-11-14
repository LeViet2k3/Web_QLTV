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
        include('../libs/helper.php');
        Database::db_connect();
        $sql_select_users = "SELECT Email, UserName, Gender, Place_of_origin, A_phone_number
        FROM users WHERE Users_status = 'Đang hoạt động'";
        if (Database::db_execute($sql_select_users)) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Email</th>';
            echo '<th>Họ Tên</th>';
            echo '<th>Giới Tính</th>';
            echo '<th>Quê Quán</th>';
            echo '<th>Số Điện Thoại</th>';
            echo '<th>Xóa</th>';
            echo '</tr>';
            $users = Database::db_get_list($sql_select_users);
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['Email'] . "</td>";
                echo "<td>" . $user['UserName'] . "</td>";
                echo "<td>" . $user['Gender'] . "</td>";
                echo "<td>" . $user['Place_of_origin'] . "</td>";
                echo "<td>" . $user['A_phone_number'] . "</td>";
                echo "<td>
                <a href='delete.php?email=" . $user['Email'] . "'><button>Xóa</button></a>
                </td>";

                echo '</tr>';
            }
            echo '</table>';
        }

        Database::db_disconnect();
        ?>
    </div>
</body>

</html>