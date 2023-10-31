<?php
include('libs/helper.php');
db_connect();
// Dữ liệu bạn muốn chèn
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $place_of_origin = $_POST['place_of_origin'];
    $a_phone_number = $_POST['a_phone_number'];
    // Kiểm tra tồn tại
    $sql1 = "SELECT Email FROM users WHERE Email = '$email' AND Users_status = 'Đã xóa'";
    if (mysqli_query($conn, $sql1)) {
        $sql2 = " UPDATE users 
                    SET UserName = '$username', Gender = '$gender', Passwords = '$password', Place_of_origin = '$place_of_origin', A_phone_number = '$a_phone_number', Users_status = 'Đang hoạt động' 
                    WHERE Email = '$email'";
        if (mysqli_query($conn, $sql2)) {
            header("Location: http://localhost:8282/Web_QLTV/PHP/log_in.php?success=1");
            exit; // Đảm bảo rằng mã không tiếp tục chạy sau khi chuyển hướng 
        }
    } else {
        // Chèn dữ liệu
        $sql = "INSERT INTO users (Email, UserName, Gender, Passwords, Place_of_origin, A_phone_number, Users_status)
                        VALUES ('$email', '$username', '$gender', '$password', '$place_of_origin', '$a_phone_number', 'Đang hoạt động' )";
        if (mysqli_query($conn, $sql)) {
            // Chuyển hướng và truyền thông báo thành công
            header("Location: http://localhost:8282/Web_QLTV/PHP/log_in.php?success=1");
            exit; // Đảm bảo rằng mã không tiếp tục chạy sau khi chuyển hướng
        } else {
            echo "Lỗi khi thêm dữ liệu vào bảng: " . mysqli_error($conn);
        }
    }
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
    <link rel="stylesheet" href="../CSS/header_footer.css">
    <title>Sign_up</title>
</head>

<body>
    <!-- header -->
    <div class="header">
        <img src="../Image/logo.png" alt="logo_team">
        <div>
            <h2>HỆ THỐNG QUẢN LÝ THƯ VIỆN</h2>
            <h3>Đội Ngũ Phát Triễn - Team 2</h3>
        </div>
    </div>
    <!-- thông báo -->
    <div class="thong_bao">
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 2) {
            echo "Tài khoản chưa được đăng ký. Vui lòng đăng ký!";
        }
        ?>
    </div>
    <!-- Sign_up -->
    <form action="" method="post">
        <div class="sign_up">
            <div class="title">
                <h3>Vui Lòng Điền Các Thông Tin</h3>
            </div>
            <div class="info">
                Email: <input type="email" name="email" required><br>
                UserName: <input type="text" name="username" required><br>
                Gender: <input type="text" name="gender" required><br>
                Password: <input type="password" name="password" required> <br>
                Place of origin: <input type="text" name="place_of_origin" required><br>
                A phone number: <input type="number" name="a_phone_number" required>
            </div>
            <div class="submit">
                <button type="submit">Sign up</button>
            </div>
        </div>


    </form>
    <!--Footer-->
    <div class="footer">
        <ul>
            <li>
                <p><i class="fa-solid fa-location-dot"></i> Địa chỉ: 136 Phạm Như Xương, Hòa Khánh Nam, quận
                    Liên Chiểu, TP.Đà Nẵng</p>
            </li>
            <li>
                <p><i class="fa-solid fa-phone"></i> Điện thoại: 0867548549 - 0702032064</p>
            </li>
            <li>
                <p><i class="fa-solid fa-envelope"></i> Email: viet.gm.2k3@gmail.com</p>
            </li>
            <div class="license">
                <li>
                    <p>&#169 Bản quyền thuộc Hệ Thống Quản Lý Thư Viện - Team 2</p>
                </li>
            </div>

    </div>
</body>

</html>