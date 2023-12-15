<?php
// Start the session
session_start();
?>
<?php
include('../libs/helper.php');
Database::db_connect();
// Thực hiện sau khi nhấn đăng kí
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $email = $_SESSION['email'];
    $sql = "INSERT INTO library_records(Email, Book_id)
                            VALUES ('$email','$book_id')";
    if (Database::db_execute($sql)) {
        Helper::redirect(Helper::get_url('../Web_QLTV/PHP/users/my_books.php?book_id=' . $book_id));
    }
}


Database::db_disconnect();
?>