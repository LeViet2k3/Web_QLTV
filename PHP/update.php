<?php
// Start the session
session_start();
?>
<?php
include('libs/helper.php');
db_connect();

$email = $_SESSION['email'];

$sql = "SELECT * FROM users where Email = '$email'";

// Thực thi câu lệnh SQL
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Gán dữ liệu
        $username = $row["UserName"];
        $gender = $row["Gender"];
        $password = $row["Passwords"];
        $place_of_origin = $row["Place_of_origin"];
        $a_phone_number = $row["A_phone_number"];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cập nhật dữ liệu
    $new_email = $_POST['email'];
    $new_username = $_POST['username'];
    $new_gender = $_POST['gender'];
    $new_password = $_POST['password'];
    $new_place_of_origin = $_POST['place_of_origin'];
    $new_a_phone_number = $_POST['a_phone_number'];
    if ($new_email != $email || $new_username != $username || $new_gender != $gender || $new_password != $password || $new_place_of_origin != $place_of_origin || $new_a_phone_number != $a_phone_number) {
        $updateSql = "UPDATE users 
                SET Email = '$new_email', UserName = '$new_username', Gender = '$new_gender', Passwords = '$new_password', Place_of_origin = '$new_place_of_origin', A_phone_number = '$new_a_phone_number'
                WHERE Email = '$email'";

        // Thực hiện câu lệnh UPDATE
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            echo "Cập nhật thành công.<br>";
        } else {
            echo "Lỗi trong quá trình cập nhật dữ liệu: " . mysqli_error($conn);
        }
    }
    // Hiển thị thông tin sau cập nhật
    // echo "Email: " . $new_email . "<br>";
    // echo "UserName: " . $new_username . "<br>";
    // echo "Gender: " . $new_gender . "<br>";
    // echo "Password: " . $new_password . "<br>";
    // echo "Place of origin: " . $new_place_of_origin . "<br>";
    // echo "A phone number: " . $new_a_phone_number . "<br>";
}


// Đóng kết nối
db_disconnect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/sign_up.css">
    <title>Update</title>

</head>

<body>

    <?php

    $email = $_SESSION['email'];

    $sql = "SELECT * FROM users where Email = '$email'";

    // Thực thi câu lệnh SQL
    $result = mysqli_query($conn, $sql);

    // Kiểm tra kết quả
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Gán dữ liệu
            $username = $row["UserName"];
            $gender = $row["Gender"];
            $password = $row["Passwords"];
            $place_of_origin = $row["Place_of_origin"];
            $a_phone_number = $row["A_phone_number"];
        }
    }
    ?>
    <!-- Update -->
    <form action="../PHP/update.php" method="post">
        <div class="sign_up">
            <div class="title">
                <h3>Chỉnh sửa thông tin cá nhân</h3>
            </div>
            <div class="info">
                Email: <input type="email" name="email" value="<?php echo $email ?>"><br>
                UserName: <input type="text" name="username" value="<?php echo $username ?>"><br>
                Gender: <input type="text" name="gender" value="<?php echo $gender ?>"><br>
                Password: <input type="password" name="password" value="<?php echo $password ?>"> <br>
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