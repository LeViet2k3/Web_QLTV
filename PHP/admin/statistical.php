<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .delete_user h2 {
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

        .uruku table,
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
            margin: 10% 0 4% 0;
        }
    </style>
</head>

<body>

    <div class="delete_user">
        <h2>List of Accounts Currently Using The Service</h2>
        <?php
        include('../libs/helper.php');
        Database::db_connect();
        $sql_select_users = "SELECT Email, UserName, Gender, Place_of_origin, A_phone_number
        FROM users WHERE Users_status = 'Đang hoạt động'";
        if (Database::db_execute($sql_select_users)) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Email</th>';
            echo '<th>Full Name</th>';
            echo '<th>Gender</th>';
            echo '<th>Place of Origin</th>';
            echo '<th>A Phone Number</th>';
            echo '<th>Delete</th>';
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
                <a href='delete.php?email=" . $user['Email'] . "'><button>Delete</button></a>
                </td>";

                echo '</tr>';
            }
            echo '</table>';
        }
        ?>
    </div>
    <div class="uruku">
        <div>
            <h2>Statistics Table For The Number of Rented Books And Revenue</h2>
            <?php
            $sql = "SELECT lr.Email, lr.Book_id, book.Book_name, lr.Price, lr.Book_borrowed_day
                    FROM library_records lr
                    JOIN book ON book.Book_id = lr.Book_id";
            if (Database::db_execute($sql)) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Email</th>';
                echo '<th>Book ID</th>';
                echo '<th>Book Name</th>';
                echo '<th>Price</th>';
                echo '<th>Borrowing Date</th>';
                echo '</tr>';

                $library_records = Database::db_get_list($sql);
                foreach ($library_records as $records) {
                    echo '<tr>';
                    echo '<td>' . $records["Email"] . '</td>';
                    echo '<td>' . $records["Book_id"] . '</td>';
                    echo '<td>' . $records["Book_name"] . '</td>';
                    echo '<td>' . $records["Price"] . '</td>';
                    echo '<td>' . $records["Book_borrowed_day"] . '</td>';
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

</html>