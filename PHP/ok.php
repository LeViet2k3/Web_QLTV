<?php
session_start();
?>
<?php
include('libs/helper.php');
if (!$_SESSION['email']) {
    Helper::redirect(Helper::get_url('../Web_QLTV/PHP/log_in.php'));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/header_footer.css">
    <style>
        /* Thêm CSS cho hiệu ứng chuyển động của thanh sidebar */
        #mySidebar {
            width: 0;
            position: fixed;
            z-index: 1;
            height: 100%;
            overflow-x: hidden;
            background-color: #333;
            padding-top: 60px;
            /* Khoảng cách từ trên xuống */
            color: white;
            transition: width 0.3s;
            /* Thời gian chuyển động 0.3 giây */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        #mySidebar.show {
            width: 250px;
            /* Kích thước khi hiển thị */
        }

        /* Thêm CSS cho button menu */
        .menuok {
            cursor: pointer;
            font-size: 24px;
            border: none;
            background: none;
            color: white;
            padding: 10px;
        }

        /* Thêm CSS cho button đóng thanh sidebar */
        #mySidebar button {
            cursor: pointer;
            font-size: 24px;
            background: none;
            border: none;
            color: white;
            padding: 10px;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* Thêm CSS cho các mục menu trong sidebar */
        .menu li {
            margin-bottom: 10px;
        }

        .menu a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            display: block;
            transition: 5s;
            padding: 10px;
        }

        .menu a:hover {
            background-color: #555;
        }
    </style>
    <title>Team 2 - User</title>
</head>

<body>
    <!-- header -->
    <div class="header">
        <img src="../Image/logo.png" alt="logo_team">
        <div>
            <h2>Open Library</h2>
            <h3>Development Team - Team 2</h3>
        </div>
    </div>
    <div>
        <button class="menuok" onclick="w3_open()">&#9776;</button>
    </div>
    <div id="mainok">
        <div style="display:none" id="mySidebar">
            <button onclick="w3_close()">Close &times;</button>
            <ul class="menu">
                <li><a href="../HTML/home.html" class="showContentLink">Home</a></li>
                <li><a href="./users/search.php" class="showContentLink">Link 2</a></li>
                <li><a href="./users/read_book.php" class="showContentLink">Link 3</a></li>
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
        </ul>
    </div>

</body>

</html>