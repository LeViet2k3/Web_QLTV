<?php
// Start the session
session_start();
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
    $server = "localhost"; // Tên máy chủ MySQL (mặc định là localhost)
    $username = "root";    // Tên đăng nhập MySQL
    $password = "";        // Mật khẩu MySQL (nếu bạn có mật khẩu)
    $database = "quan_ly_thu_vien";    // Tên cơ sở dữ liệu MySQL

    // Kết nối tới cơ sở dữ liệu
    $conn = mysqli_connect($server, $username, $password, $database);

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }

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