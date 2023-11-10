<?php
// Start the session
session_start();
?>
<?php
include('libs/helper.php');
Database::db_connect();



// Dữ liệu đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set session variables
    $_SESSION['email'] = $_POST['email'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql_check_users = "SELECT * FROM users 
    where Email = '$email' and UserName = '$username' and Passwords = '$password' and Users_status = 'Đang hoạt động'";
    $sql_check_admin = "SELECT * FROM admins 
    where Email = '$email' and Admin_name = '$username' and Passwords = '$password'";
    // Thực thi câu lệnh SQL
    if (Database::db_execute($sql_check_users)) {
        Helper::redirect(Helper::get_url('../Web_QLTV/HTML/users_interface.html'));
    } elseif (Database::db_execute($sql_check_admin)) {
        Helper::redirect(Helper::get_url('../Web_QLTV/HTML/admins_interface.html'));
    } else {
        Helper::redirect(Helper::get_url('../Web_QLTV/PHP/sign_up.php?success=2'));
    }
}
// Đóng kết nối
Database::db_disconnect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../CSS/log_in.css">
    <link rel="stylesheet" href="../CSS/header_footer.css">
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
    <!-- sidebar -->
    <div class="sidebar">
        <div class="title">
            <h4>Thông Báo Mới Nhất</h4>
        </div>
        <div>
            <ol>
                <li>Thông tin về giờ mở cửa và đóng cửa</li>
                <li>Thông tin về các sự kiện sắp tới</li>
                <li>Thông tin về tình trạng sách và tài liệu mới</li>
                <li>Thông tin về tình trạng các dự án xây dựng và nâng cấp thư viện</li>
                <li>Thông tin về tình trạng tài khoản và mượn trả sách</li>
                <li>Thông báo về tình trạng vị trí và tiện ích trong thư viện</li>
                <li>Thông báo về tài liệu đặc biệt và bộ sưu tập đặc trưng</li>
            </ol>
        </div>
    </div>
    <!-- thông báo -->
    <div class="thong_bao">
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo "Đăng ký thành công!";
        }
        ?>
    </div>
    <!-- login -->
    <div class="login">
        <form action="" method="post">
            <div class="box1">
                <h3>Log in</h3>
            </div>
            <div class="box2">
                <input type="email" name="email" class="mail" placeholder="Email" required>
            </div>
            <div class="box2">
                <input type="text" name="username" class="mail" placeholder="UserName" required>
            </div>
            <div class="box2">
                <input id="password" type="password" name="password" class="mail" placeholder="Password" required>
                <i class="bi bi-eye-slash" id="togglePassword"></i>
            </div>
            <div class="box3">
                <button type="submit">Log in</button>
            </div>
        </form>

        <div class="box4">
            <p> Don't have a account</p>
            <a href="./sign_up.php">Sign up</a>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            password.type = password.type === "password" ? "text" : "password";
            this.classList.toggle("bi-eye");

        });
    </script>
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