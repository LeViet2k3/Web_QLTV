<?php
// Start the session
session_start();
?>
<?php
include('libs/helper.php');
db_connect();

$email = $_SESSION['email'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_email = $_POST['email'];
    $new_username = $_POST['username'];
    $new_gender = $_POST['gender'];
    $new_password = $_POST['password'];
    $new_place_of_origin = $_POST['place_of_origin'];
    $new_a_phone_number = $_POST['a_phone_number'];
    // Cập nhật dữ liệu
    $UpdateSql = "UPDATE users 
                SET Email = '$new_email', UserName = '$new_username', Gender = '$new_gender', Passwords = '$new_password', Place_of_origin = '$new_place_of_origin', A_phone_number = '$new_a_phone_number'
                WHERE Email = '$email'";

    // Thực hiện câu lệnh UPDATE
    $UpdateResult = mysqli_query($conn, $UpdateSql);

    if ($UpdateResult) {
        echo "<h3>Cập nhật thành công.<br></h3>";
    } else {
        echo "Lỗi trong quá trình cập nhật dữ liệu: " . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/sign_up.css">
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

    $sql1 = "SELECT * FROM users where Email = '$email'";

    // Thực thi câu lệnh SQL1
    $result1 = mysqli_query($conn, $sql1);

    // Kiểm tra kết quả
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            // Gán dữ liệu
            $username = $row["UserName"];
            $gender = $row["Gender"];
            $password = $row["Passwords"];
            $place_of_origin = $row["Place_of_origin"];
            $a_phone_number = $row["A_phone_number"];
        }
    }
    // Đóng kết nối
    db_disconnect();
    ?>
    <!-- Update -->
    <form action="" method="post">
        <div class="sign_up">
            <div class="title">
                <h3>Thông tin cá nhân</h3>
            </div>
            <div class="info">
                Email: <input type="email" name="email" value="<?php echo $email ?>"><br>
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