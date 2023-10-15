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
echo "Email: " . $new_email . "<br>";
echo "UserName: " . $new_username . "<br>";
echo "Gender: " . $new_gender . "<br>";
echo "Password: " . $new_password . "<br>";
echo "Place of origin: " . $new_place_of_origin . "<br>";
echo "A phone number: " . $new_a_phone_number . "<br>";


// Đóng kết nối
mysqli_close($conn);
