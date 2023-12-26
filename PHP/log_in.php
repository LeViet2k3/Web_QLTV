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
    $password = $_POST['password'];


    $sql_check_users = "SELECT * FROM users 
    where Email = '$email' and Passwords = '$password' and Users_status = 'Đang hoạt động'";
    // Thực thi câu lệnh SQL
    if (Database::db_execute($sql_check_users)) {
        Helper::redirect(Helper::get_url('../Web_QLTV/PHP/admins_interface.php'));
    } else {
        Helper::redirect(Helper::get_url('../Web_QLTV/PHP/log_in.php?error=5'));
    }
}
// Đóng kết nối
Database::db_disconnect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../CSS/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/log_in.css">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/img/logo.png" rel="icon">
    <title>Home Page</title>

</head>

<body>
    <div class="full">
        <!-- ======= Header ======= -->
        <header id="header" class="d-flex align-items-center">
            <div class="container d-flex justify-content-between">

                <div id="logo">
                    <h1><a href="../index.php">Open Lib<span>rary</span></a></h1>
                </div>
            </div>
        </header><!-- End Header -->
        <div class="full_home_page">
            <!-- sidebar -->
            <div class="home_book">
                <div class="home_img_book">
                    <img src="../Image/book1.jpg" alt="book1">
                    <img src="../Image/book2.jpg" alt="book2">
                    <img src="../Image/book3.jpg" alt="book3">
                </div>
                <div class="home_img_book">
                    <img src="../Image/book4.jpg" alt="book4">
                    <img src="../Image/book5.jpg" alt="book5">
                    <img src="../Image/book6.jpg" alt="book6">
                </div>
            </div>
            <!-- login -->
            <div class="full_login">
                <div class="login">
                    <form action="" method="post">
                        <div class="box1">
                            <h3>Log in</h3>
                        </div>
                        <div class="box2">
                            <input type="email" name="email" class="mail" placeholder="Email" required>
                        </div>
                        <div class="box2">
                            <div>
                                <input id="pass" type="password" name="password" class="mail" placeholder="Password" required>
                            </div>
                            <div class="notification">
                                <?php
                                if (isset($_GET['error']) && $_GET['error'] == 5) {
                                    echo "<h5>Email/password was wrong. Please log in again!</h5>";
                                }
                                ?>
                            </div>
                            <div class="showpass">
                                <input id="check" type="checkbox"> Show password
                            </div>
                        </div>
                        <div class="box3">
                            <button type="submit">Log in</button>
                        </div>
                    </form>

                    <div class="box4">
                        <p> Don't have a account<a href="./sign_up.php">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    check.onclick = togglePassword;

    function togglePassword() {
        if (check.checked) pass.type = "text";
        else pass.type = "password";
    }
</script>

</html>