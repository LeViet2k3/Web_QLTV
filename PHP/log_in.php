<?php
// Start the session
session_start();
?>
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

// Set session variables
$_SESSION['email'] = $_POST['email'];

// Dữ liệu đăng nhập
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users 
        where Email = '$email' and UserName = '$username' and Passwords = '$password'";

// Thực thi câu lệnh SQL
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả
if (mysqli_num_rows($result) > 0) {
    // while ($row = mysqli_fetch_assoc($result)) {
    //     echo "Email: " . $row["Email"] . "<br>";
    //     echo "UserName: " . $row["UserName"] . "<br>";
    //     echo "Gender: " . $row["Gender"] . "<br>";
    //     echo "Password: " . $row["Passwords"] . "<br>";
    //     echo "Place of origin: " . $row["Place_of_origin"] . "<br>";
    //     echo "A phone number: " . $row["A_phone_number"] . "<br>";
    // }
    header("Location: http://localhost:8282/Web_QLHT/HTML/index.html");
    exit; // Đảm bảo rằng mã không tiếp tục chạy sau khi chuyển hướng
} else {
    echo "Không có dữ liệu trong bảng website.";
}

// Đóng kết nối
mysqli_close($conn);
