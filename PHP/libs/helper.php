<?php

$server = "localhost"; // Tên máy chủ MySQL (mặc định là localhost)
$username = "root";    // Tên đăng nhập MySQL
$password = "";        // Mật khẩu MySQL (nếu bạn có mật khẩu)
$database = "quan_ly_thu_vien";    // Tên cơ sở dữ liệu MySQL



function get_url($url = '')
{
    $uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
    $app_path = explode('/', $uri);
    return 'http://' . $_SERVER['HTTP_HOST'] . '/' . $app_path[1] . '/' . $url;
}
// Kết nối tới cơ sở dữ liệu
$conn = mysqli_connect($server, $username, $password, $database);
//------------Database-------------------
function db_connect()
{
    global $conn;
    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }

    return $conn;
}


function db_disconnect()
{
    global $conn;
    if (!is_null($conn)) {
        $conn = null;
    }
}

function redirect($url)
{
    header("Location:{$url}");
    exit();
}

function input_value($inputname, $filter = FILTER_DEFAULT, $option = FILTER_DEFAULT)
{
    $value = filter_input(INPUT_POST, $inputname, $filter, $option);
    if ($value === null) {
        $value = filter_input(INPUT_GET, $inputname, $filter, $option);
    }
    return $value;
}

// function db_execute($sql = '', $params = [])
// {
//     global $conn;
//     if (!is_null($conn)) {
//         $result = $conn->prepare($sql);
//         $result->execute($params);
//         if ($result->rowCount() > 0) {
//             $result->closeCursor();
//             return true;
//         }
//     }
//     return false;
// }
