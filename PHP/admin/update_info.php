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
        echo "<h3><b>Update Successful.</b></h3>";
    } else {
        echo "<h3><b>Error during data update</b></h3> ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../../CSS/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../CSS/update_infor.css">
    <title>Update Information</title>
    <link href="../../Image/logo.png" rel="icon">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">

            <div id="logo">
                <h1><a href="../admins_interface.php">Open Lib<span>rary</span></a></h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="../admins_interface.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="./statistics.php">Statistics</a></li>
                    <li><a class="nav-link scrollto" href="./add_book.php">Add Book</a></li>
                    <li><a class="nav-link scrollto active" href="./update_info.php">Update Information</a></li>
                    <li><a href="../log_out.php">Log Out</a></li>
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
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
    <div class="update">
        <div id="update">
            <div class="title">
                <h3><b>Personal Information</b></h3>
                <h4><?php echo $email ?></h4>
            </div>
            <div id="form">
                <form class="form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">User Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $username ?>" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Gender:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $gender ?>" name="gender" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Password:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $password ?>" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Place of Origin:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $place_of_origin ?>" name="place_of_origin" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">A Phone Number:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $a_phone_number ?>" name="a_phone_number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="btn" class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Update</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>