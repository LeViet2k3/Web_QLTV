<?php
class Helper
{
    public static function get_url($url = '')
    {
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
        $app_path = explode('/', $uri);
        return 'http://' . $_SERVER['HTTP_HOST'] . '/' . $app_path[1] . '/' . $url;
    }

    public static function redirect($url)
    {
        header("Location:{$url}");
        exit();
    }

    public static function redirect_js($url)
    {
        if ($url) {
            echo '<script>window.location.href="' . $url . '"</script>';
        }
    }

    public static function input_value($inputname, $filter = FILTER_DEFAULT, $option = FILTER_SANITIZE_STRING)
    {
        $value = filter_input(INPUT_POST, $inputname, $filter, $option);
        if ($value === null) {
            $value = filter_input(INPUT_GET, $inputname, $filter, $option);
        }
        return $value;
    }

    public static function is_submit($hidden)
    {
        return (!empty(self::input_value('action')) && self::input_value('action') == $hidden);
    }
}

class Database
{
    private static $dsn = 'mysql:host=localhost;dbname=quan_ly_thu_vien';
    private static $username = "root";
    private static $password = "";
    private static $con = null;

    public function __construct()
    {
        self::db_connect();
    }

    public static function db_connect()
    {
        try {
            if (is_null(self::$con)) {
                self::$con = new PDO(self::$dsn, self::$username, self::$password);
                self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include_once '../errors/database_error.php';
        }
    }

    public static function db_disconnect()
    {
        if (!is_null(self::$con)) {
            self::$con = null;
        }
    }

    public function __destruct()
    {
        self::db_disconnect();
    }

    public static function db_execute($sql = '')
    {
        if (!is_null(self::$con)) {
            $result = self::$con->prepare($sql);
            $result->execute();
            if ($result->rowCount() > 0) {
                $result->closeCursor();
                return true;
            }
        }
        return false;
    }

    public static function db_get_list($sql = '')
    {
        if (!is_null(self::$con)) {
            $result = self::$con->prepare($sql);
            $result->execute();
            if ($result->rowCount() > 0) {
                $rows = $result->fetchAll();
                $result->closeCursor();
                return $rows;
            }
        }
        return false;
    }

    public static function getBookSuggestions($input)
    {
        if (!is_null(self::$con)) {
            $result = self::$con->prepare("SELECT Book_name FROM book WHERE Book_name LIKE :input LIMIT 5");
            $result->execute([':input' => "$input%"]);
            $suggestions = $result->fetchAll(\PDO::FETCH_COLUMN);
            return $suggestions; 
        }
        return false;
    }

    public static function db_get_list_condition($sql = '', $params = [])
    {
        if (!is_null(self::$con)) {
            $result = self::$con->prepare($sql);
            $result->execute($params);
            if ($result->rowCount() > 0) {
                $rows = $result->fetchAll();
                $result->closeCursor();
                return $rows;
            }
        }
        return false;
    }

    public static function db_get_row($sql = '', $params = [])
    {
        if (!is_null(self::$con)) {
            $result = self::$con->prepare($sql);
            $result->execute($params);
            if ($result->rowCount() > 0) {
                $row = $result->fetch();
                $result->closeCursor();
                return $row;
            }
        }
        return false;
    }
}
