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
    $price = $_GET['price'];
    $email = $_SESSION['email'];

    $sql_check_remaining = "SELECT * FROM book WHERE quantity > 0 AND Book_id = '$book_id' ";
    if (Database::db_execute($sql_check_remaining)) {
        $remainings = Database::db_get_list($sql_check_remaining);
        // Kiểm tra sách đã thuê chưa
        $sql_check = "SELECT Email FROM library_records
                          WHERE Email = '$email' AND Book_id = '$book_id'";
        if (Database::db_execute($sql_check)) {
            echo "<h3>This Book Is Currently Rented by You:</h3>";
            echo '<div class = "btn"><button><a href="./search.php">Go Back</a></button></div>';
        } else {
            $sql = "INSERT INTO library_records(Email, Book_id, Price)
                            VALUES ('$email','$book_id','$price')";
            if (Database::db_execute($sql)) {
                echo "<h2>You Have Successfully Registered.</h2>";
                $sql_select = " SELECT lr.Email, book.Book_name, book.Price, lr.Book_borrowed_day
                                        FROM library_records lr
                                        JOIN book ON lr.Book_id = book.Book_id
                                        WHERE lr.Email = '$email' AND lr.Book_id = '$book_id'";
                if (Database::db_execute($sql_select)) {
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Customer</th>';
                    echo '<th>Book Name</th>';
                    echo '<th>Price</th>';
                    echo '<th>Registration Date</th>';
                    echo '</tr>';

                    $info_book = Database::db_get_list($sql_select);
                    foreach ($info_book as $book) {
                        echo '<tr>';
                        echo '<td>' . $book["Email"] . '</td>';
                        echo '<td>' . $book["Book_name"] . '</td>';
                        echo '<td>' . $book["Price"] . '</td>';
                        echo '<td>' . $book["Book_borrowed_day"] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '<div class = "btn"><button><a href="./read_book.php">Read Book</a></button></div>';
                }
            }
        }
    } else {
        echo "<h3>The book is out of stock.Please choose another book.</h3>";
        echo '<div class = "btn"><button><a href="./search.php">Go Back</a></button></div>';
    }
}


Database::db_disconnect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/library_records.css">
</head>

</html>