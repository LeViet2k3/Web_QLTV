<?php
include('../libs/helper.php');
Database::db_connect();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $author_id = $_POST['author_id'];
    $author_name = $_POST['author_name'];
    $new_genre_id = $_POST['genre_id'];
    $new_genre_name = $_POST['genre_name'];
    // up;oad file tài liệu
    $target_dir = __DIR__ . "/../../Document/";
    $target_file = $target_dir . basename($_FILES["pdfFile"]["name"]);
    $uploadOk = 1;

    // Kiểm tra file tồn tại trước khi upload
    if (file_exists($target_file)) {
        echo "File đã tồn tại.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Không thể upload file.";
    } else {
        if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $target_file)) {
            $File_pdf = htmlspecialchars(basename($_FILES["pdfFile"]["name"]));
        } else {
            echo "Có lỗi xảy ra khi upload file.";
        }
    }
    // Kiểm tra Genre_id bảng genre
    $sql_check_genre = "SELECT * FROM genre WHERE Genre_id = '$new_genre_id' AND Genre_name = '$new_genre_name'";
    if (Database::db_execute($sql_check_genre)) {
        // Thêm dữ liệu vào bảng book
        $sql_insert_book = "INSERT INTO book(Book_id, Book_name, File_pdf, quantity, Price, Genre_id)
                VALUES ('$book_id', '$book_name','$File_pdf', '$quantity', '$price', '$new_genre_id') ";
        Database::db_execute($sql_insert_book);
    } else {
        // Thêm dữ liệu vào bảng genre
        $sql_insert_genre = "INSERT INTO genre(Genre_id, Genre_name)
                VALUES ('$new_genre_id', '$new_genre_name')";
        if (Database::db_execute($sql_insert_genre)) {
            // Thêm dữ liệu vào bảng book
            $sql_insert_book = "INSERT INTO book(Book_id, Book_name, quantity, Genre_id)
                VALUES ('$book_id', '$book_name', '$quantity', '$new_genre_id') ";
            Database::db_execute($sql_insert_book);
        }
    }
    // Kiểm tra Author_id bảng Author
    $sql_check_author = "SELECT Author_id FROM author WHERE Author_id = '$author_id'";
    if (Database::db_execute($sql_check_author)) {
        // Thêm dữ liệu vào bảng book_has_author
        $sql_insert = "INSERT INTO book_has_author(Book_id, Author_id)
                VALUES ('$book_id', '$author_id') ";
        Database::db_execute($sql_insert);
    } else {
        // Thêm dữ liệu vào bảng author
        $sql_insert_author = "INSERT INTO author(Author_id, Author_name)
                VALUES ('$author_id', '$author_name')";
        if (Database::db_execute($sql_insert_author)) {
            // Thêm dữ liệu vào bảng book_has_author
            $sql_insert = "INSERT INTO book_has_author(Book_id, Author_id)
                        VALUES ('$book_id', '$author_id') ";
            Database::db_execute($sql_insert);
        }
    }
    Helper::redirect(Helper::get_url('../Web_QLTV/PHP/admin/add_book.php'));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/add_book.css">
    <title>Document</title>
</head>

<body>
    <div class="add_book">
        <h2>Thêm Sách</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="full_form">
                <div><input class="input" type="text" name="book_id" placeholder="Nhập mã sách" required></div>
                <div><input class="input" type="text" name="book_name" placeholder="Nhập tên sách" required></div>
                <input type="file" name="pdfFile" id="pdfFile">
                <div><input class="input" type="number" name="quantity" placeholder="Số lượng" required></div>
                <div><input class="input" type="number" name="price" placeholder="Giá" required></div>
                <div><input class="input" type="text" name="author_id" placeholder="Nhập mã tác giả" required></div>
                <div><input class="input" type="text" name="author_name" placeholder="Nhập tên tác giả" required></div>
                <div><input class="input" type="text" name="genre_id" placeholder="Nhập mã thể loại" required></div>
                <div><input class="input" type="text" name="genre_name" placeholder="Nhập tên thể loại" required></div>
            </div>
            <div class="submit"><input type="submit" value="ADD"></div>

        </form>
    </div>
    <div class="full_display">
        <div class="display_book">
            <h3>Bảng Sách</h3>
            <?php
            // Hiển thị bảng book
            $sql_select_book = "SELECT * FROM book ";
            if (Database::db_execute($sql_select_book)) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Mã Sách</th>';
                echo '<th>Tên Sách</th>';
                echo '<th>Số Lượng</th>';
                echo '<th>Giá</th>';
                echo '<th>Mã Thể Loại</th>';
                echo '</tr>';

                $books = Database::db_get_list($sql_select_book);
                foreach ($books as $book) {
                    echo '<tr>';
                    echo '<td>' . $book["Book_id"] . '</td>';
                    echo '<td>' . $book["Book_name"] . '</td>';
                    echo '<td>' . $book["quantity"] . '</td>';
                    echo '<td>' . $book["Price"] . '</td>';
                    echo '<td>' . $book["Genre_id"] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            ?>
        </div>
        <div class="display_genre">
            <h3>Bảng Thể Loại</h3>
            <?php
            // Hiển thị bảng genre
            $sql_select_genre = "SELECT * FROM genre ";
            if (Database::db_execute($sql_select_genre)) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Mã Thể Loại</th>';
                echo '<th>Tên Thể Loại</th>';
                echo '</tr>';

                $genres = Database::db_get_list($sql_select_genre);
                foreach ($genres as $genre) {
                    echo '<tr>';
                    echo '<td>' . $genre["Genre_id"] . '</td>';
                    echo '<td>' . $genre["Genre_name"] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            ?>
        </div>
        <div class="display_author">
            <h3>Bảng Tác Giả</h3>
            <?php
            // Hiển thị bảng author
            $sql_select_author = "SELECT * FROM author ";
            if (Database::db_execute($sql_select_author)) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Mã Tác Giả</th>';
                echo '<th>Tên Tác Giả</th>';
                echo '</tr>';
                $authors = Database::db_get_list($sql_select_author);
                foreach ($authors as $author) {
                    echo '<tr>';
                    echo '<td>' . $author["Author_id"] . '</td>';
                    echo '<td>' . $author["Author_name"] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            Database::db_disconnect();
            ?>
        </div>
    </div>

</body>

</html>