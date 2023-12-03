<?php
session_start();
?>
<?php
include('libs/helper.php');
if (!$_SESSION['email']) {
    Helper::redirect(Helper::get_url('../Web_QLTV/PHP/log_in.php'));
}
Database::db_connect();
$email = $_SESSION['email'];
$sql_select_name = "SELECT UserName FROM users 
where Email = '$email'";
$names = Database::db_get_list($sql_select_name);
foreach ($names as $name) {
    $username = $name["UserName"];
}

Database::db_disconnect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/header_footer.css">
    <title>Team 2 - User</title>
</head>

<body>
    <!-- header -->
    <div class="full_header">
        <div class="header">
            <img src="../Image/logo.png" alt="logo_team">
            <div>
                <h2>Open Library</h2>
                <h3>Development Team - Team 2</h3>
            </div>
        </div>
        <div class="avatar">
            <img src="../Image/avatar.jpg" alt="avatar">
            <div>
                <h3><?php echo $username ?></h3>
            </div>
        </div>
    </div>
    <div>
        <button class="menuok" onclick="w3_open()">&#9776;</button>
    </div>
    <div id="mainok">
        <div style="display:none" id="mySidebar">
            <button class="close" onclick="w3_close()"><i class="fa-solid fa-arrow-left"></i></button>
            <ul>
                <div class="menu">
                    <li><a href="../HTML/home.html" class="showContentLink">Home</a></li>
                </div>
                <div class="menu">
                    <li><a href="./users/read_book.php" class="showContentLink">Book Search</a></li>
                </div>
                <div class="menu">
                    <li><a href="./users/update_info.php" class="showContentLink">Update Information</a></li>
                </div>
                <div class="menu">
                    <li><a href="./log_out.php" class="logout">Log Out</a></li>
                </div>
            </ul>
        </div>

        <!-- content -->
        <div id="main" class="content">
            <iframe id="contentFrame" src="../HTML/home.html" width="100%" height="100%" style="border:none;"></iframe>

            <script>
                var contentFrame = document.getElementById("contentFrame");
                var showLinks = document.querySelectorAll(".showContentLink");

                showLinks.forEach(function(link) {
                    link.addEventListener("click", function(event) {
                        event.preventDefault();
                        contentFrame.src = this.href;
                    });
                });
            </script>
        </div>
    </div>

    <!--Footer-->
    <div class="footer">
        <ul>
            <li>
                <p><i class="fa-solid fa-location-dot"></i> Address: 136 Phạm Như Xương, Hòa Khánh Nam, quận
                    Liên Chiểu, TP.Đà Nẵng</p>
            </li>
            <li>
                <p><i class="fa-solid fa-phone"></i> A Phone Number: 0867548549 - 0702032064</p>
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
<script>
    function w3_open() {
        document.getElementById("mySidebar").style.width = "16%";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("openNav").style.display = 'none';
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
    }
</script>

</html><?php
        session_start();
        ?>
<?php
include('libs/helper.php');
if (!$_SESSION['email']) {
    Helper::redirect(Helper::get_url('../Web_QLTV/PHP/log_in.php'));
}
Database::db_connect();
$email = $_SESSION['email'];
$sql_select_name = "SELECT UserName FROM users 
where Email = '$email'";
$names = Database::db_get_list($sql_select_name);
foreach ($names as $name) {
    $username = $name["UserName"];
}

Database::db_disconnect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/header_footer.css">
    <title>Team 2 - User</title>
</head>

<body>
    <!-- header -->
    <div class="full_header">
        <div class="header">
            <img src="../Image/logo.png" alt="logo_team">
            <div>
                <h2>Open Library</h2>
                <h3>Development Team - Team 2</h3>
            </div>
        </div>
        <div class="avatar">
            <img src="../Image/avatar.jpg" alt="avatar">
            <div>
                <h3><?php echo $username ?></h3>
            </div>
        </div>
    </div>
    <div>
        <button class="menuok" onclick="w3_open()">&#9776;</button>
    </div>
    <div id="mainok">
        <div style="display:none" id="mySidebar">
            <button class="close" onclick="w3_close()"><i class="fa-solid fa-arrow-left"></i></button>
            <ul>
                <div class="menu">
                    <li><a href="../HTML/home.html" class="showContentLink">Home</a></li>
                </div>
                <div class="menu">
                    <li><a href="./users/read_book.php" class="showContentLink">Book Search</a></li>
                </div>
                <div class="menu">
                    <li><a href="./users/read_book.php" class="showContentLink">Read Book</a></li>
                </div>
                <div class="menu">
                    <li><a href="./users/update_info.php" class="showContentLink">Update Information</a></li>
                </div>
                <div class="menu">
                    <li><a href="./log_out.php" class="logout">Log Out</a></li>
                </div>
            </ul>
        </div>

        <!-- content -->
        <div id="main" class="content">
            <iframe id="contentFrame" src="../HTML/home.html" width="100%" height="100%" style="border:none;"></iframe>

            <script>
                var contentFrame = document.getElementById("contentFrame");
                var showLinks = document.querySelectorAll(".showContentLink");

                showLinks.forEach(function(link) {
                    link.addEventListener("click", function(event) {
                        event.preventDefault();
                        contentFrame.src = this.href;
                    });
                });
            </script>
        </div>
    </div>

    <!--Footer-->
    <div class="footer">
        <ul>
            <li>
                <p><i class="fa-solid fa-location-dot"></i> Address: 136 Phạm Như Xương, Hòa Khánh Nam, quận
                    Liên Chiểu, TP.Đà Nẵng</p>
            </li>
            <li>
                <p><i class="fa-solid fa-phone"></i> A Phone Number: 0867548549 - 0702032064</p>
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
<script>
    function w3_open() {
        document.getElementById("mySidebar").style.width = "16%";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("openNav").style.display = 'none';
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
    }
</script>

</html>