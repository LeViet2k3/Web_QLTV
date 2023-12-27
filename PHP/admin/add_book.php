<?php
include('../libs/helper.php');
Database::db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    // ////
    $image = $_FILES['image']['tmp_name'];
    $imageData = file_get_contents($image);
    $base64Image = base64_encode($imageData);
    ////////
    $introduce = $_POST['introduce'];
    $author_id = $_POST['author_id'];
    $author_name = $_POST['author_name'];
    $new_genre_id = $_POST['genre_id'];
    $new_genre_name = $_POST['genre_name'];

    // Upload file tài liệu
    $target_dir = __DIR__ . "/../../Document/";
    $target_file_pdf = $target_dir . basename($_FILES["pdfFile"]["name"]);
    // Kiểm tra file tồn tại trước khi upload
    if (file_exists($target_file_pdf)) {
        echo "The file already exists.";
        echo "Unable to upload the file.";
    } else {
        // Di chuyển tệp tải lên vào thư mục lưu trữ trên máy chủ
        if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $target_file_pdf)) {
            $File_pdf = htmlspecialchars(basename($_FILES["pdfFile"]["name"]));

            // Kiểm tra Genre_id bảng genre
            $sql_check_genre = "SELECT * FROM genre WHERE Genre_id = '$new_genre_id' AND Genre_name = '$new_genre_name'";
            if (Database::db_execute($sql_check_genre)) {
                // Thêm dữ liệu vào bảng book
                $sql_insert_book = "INSERT INTO book(Book_id, Book_name, File_pdf, Genre_id, Images, introduce)
                VALUES ('$book_id', '$book_name','$File_pdf', '$new_genre_id', '$base64Image', '$introduce')";
                Database::db_execute($sql_insert_book);
            } else {
                // Thêm dữ liệu vào bảng genre
                $sql_insert_genre = "INSERT INTO genre(Genre_id, Genre_name)
                VALUES ('$new_genre_id', '$new_genre_name')";
                if (Database::db_execute($sql_insert_genre)) {
                    // Thêm dữ liệu vào bảng book
                    $sql_insert_book = "INSERT INTO book(Book_id, Book_name, Genre_id, File_pdf, Images, introduce)
                    VALUES ('$book_id', '$book_name', '$new_genre_id', '$File_pdf', '$base64Image', '$introduce')";
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
        } else {
            echo "An error occurred while uploading the file.";
        }
    }

    // Helper::redirect(Helper::get_url('../test_qltv/PHP/admin/add_book.php'));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../CSS/add_book.css">
    <title>Add Book</title>
    <link href="../../Image/logo.png" rel="icon">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div id="logo">
            <h1><a href="../admins_interface.php">Open Lib<span>rary</span></a></h1>
        </div>

        <div id="navbar" class="navbar">
            <ul>
                <li><a href="../admins_interface.php">Home</a></li>
                <li><a class="nav-link scrollto" href="./statistics.php">Statistics</a></li>
                <li><a class="nav-link scrollto active" href="./add_book.php">Add Book</a></li>
                <li><a class="nav-link scrollto" href="./update_info.php">Profile</a></li>
                <li><a href="../log_out.php">Log Out</a></li>
            </ul>
        </div><!-- .navbar -->
    </header><!-- End Header -->
    <div class="full_add_book">
        <div class="add_book">
            <h3>Add New Books</h3>
            <div id="form_add_book">
                <div class="form">
                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="book_id" placeholder="Enter book id" required required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="book_name" placeholder="Enter book name" required>
                            </div>
                        </div>
                        <div class="input_file">
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <input type="file" name="pdfFile" id="pdfFile">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="introduce" placeholder="Enter introduce" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="author_id" placeholder="Enter author id" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="author_name" placeholder="Enter author name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="genre_id" placeholder="Enter genre id" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="genre_name" placeholder="Enter genre name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="btn" class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">ADD</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="full_display">
            <div class="display_book">
                <h3>Book Table</h3>
                <?php
                // Hiển thị bảng book
                $sql_select_book = "SELECT Book_id, Book_name, Genre_id FROM book ";
                if (Database::db_execute($sql_select_book)) {
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Book ID</th>';
                    echo '<th>Book Name</th>';
                    echo '<th>Genre ID</th>';
                    echo '</tr>';

                    $books = Database::db_get_list($sql_select_book);
                    foreach ($books as $book) {
                        echo '<tr>';
                        echo '<td>' . $book["Book_id"] . '</td>';
                        echo '<td>' . $book["Book_name"] . '</td>';
                        echo '<td>' . $book["Genre_id"] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                }
                ?>
            </div>
            <div class="display_genre">
                <h3>Genre Table</h3>
                <?php
                // Hiển thị bảng genre
                $sql_select_genre = "SELECT * FROM genre ";
                if (Database::db_execute($sql_select_genre)) {
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Genre ID</th>';
                    echo '<th>Genre Name</th>';
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
                <h3>Author Table</h3>
                <?php
                // Hiển thị bảng author
                $sql_select_author = "SELECT * FROM author ";
                if (Database::db_execute($sql_select_author)) {
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Author ID</th>';
                    echo '<th>Author Name</th>';
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
    </div>

</body>

</html>