<?php
// Start the session
session_start();
?>
<?php
include('../libs/helper.php');
Database::db_connect();

$email = $_SESSION['email'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['username'];
    $new_gender = $_POST['gender'];
    $new_password = $_POST['password'];
    $new_place_of_origin = $_POST['place_of_origin'];
    $new_a_phone_number = $_POST['a_phone_number'];
    // Cập nhật dữ liệu
    $UpdateSql = "UPDATE users 
                SET UserName = '$new_username', Gender = '$new_gender', Passwords = '$new_password', Place_of_origin = '$new_place_of_origin', A_phone_number = '$new_a_phone_number'
                WHERE Email = '$email'";

    // Thực hiện câu lệnh UPDATE
    if (Database::db_execute($UpdateSql)) {
        echo "<h3>Cập nhật thành công.<br></h3>";
    } else {
        echo "Lỗi trong quá trình cập nhật dữ liệu: ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../../CSS/sign_up.css">
    <title>Update</title>
    <style>
        h3 {
            text-align: center;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <?php

    $email = $_SESSION['email'];
    $sql_select_info_users = "SELECT * FROM users where Email = '$email'";

    // Kiểm tra kết quả
    if (Database::db_execute($sql_select_info_users)) {
        $info_users = Database::db_get_list($sql_select_info_users);
        foreach ($info_users as $user) {
            // Gán dữ liệu
            $username = $user["UserName"];
            $gender = $user["Gender"];
            $password = $user["Passwords"];
            $place_of_origin = $user["Place_of_origin"];
            $a_phone_number = $user["A_phone_number"];
        }
    }
    // Đóng kết nối
    Database::db_disconnect();
    ?>
    <!-- Update -->
    <form action="" method="post">
        <div class="sign_up">
            <div class="title">
                <h3>Thông tin cá nhân</h3>
                <h4><?php echo $email ?></h4>
            </div>
            <div class="info">
                UserName: <input type="text" name="username" value="<?php echo $username ?>"><br>
                Gender: <input type="text" name="gender" value="<?php echo $gender ?>"><br>
                Password: <input type="text" name="password" value="<?php echo $password ?>"> <br>
                Place of origin: <input type="text" name="place_of_origin" value="<?php echo $place_of_origin ?>"><br>
                A phone number: <input type="number" name="a_phone_number" value="<?php echo $a_phone_number ?>">
            </div>
            <div class="submit">
                <button type="submit">Update</button>
            </div>
        </div>
    </form>
</body>

</html>