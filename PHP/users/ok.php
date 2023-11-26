<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/read_book.css">
</head>

<body>
    <div class="full_search">
        <div class="search">
            <?php
            include('../libs/helper.php');
            Database::db_connect();
            $email = $_SESSION['email'];
            $sql_select_bookname = "SELECT Book_name FROM book ";
            echo "<h2>All Books In The Library:</h2>";
            if (Database::db_execute($sql_select_bookname)) {
                $bookname = Database::db_get_list($sql_select_bookname);
                foreach ($bookname as $name) {
                    echo '<a href="?bookname=' . $name["Book_name"] . '">' . $name["Book_name"] . '</a><br>';
                }
            }
            ?>
        </div>

        <div class="display">
            <?php
            // Xử lý khi có tham số truyền vào
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['bookname'])) {
                $bookname = $_GET['bookname'];
                $sql_select_info = "SELECT Book_id, File_pdf
                FROM book
                WHERE Book_name = '$bookname'";

                $info_book = Database::db_get_list($sql_select_info);
                foreach ($info_book as $name) {
                    $book_id = $name['Book_id'];
                    $name_file =  $name['File_pdf'];
                }
                echo '<button class="show_modal" onclick="openPdf()">Open PDF</button>';
            }

            ?>
            <div>
                <!-- The Modal -->
                <div class="modal hidden">
                    <button class="close-modal">&times;</button>
                    <iframe src="../../Document/<?php echo $name_file ?>" frameborder="0" width="100%" height="700vh">

                    </iframe>
                </div>
            </div>
            <?php
            Database::db_disconnect();
            ?>
        </div>
    </div>

</body>
<script>
    "use strict";

    const modal = document.querySelector(".modal");
    const btnCloseModal = document.querySelector(".close-modal");
    const btnsShowModal = document.querySelectorAll(".show_modal");
    const closeModal = function() {
        modal.classList.add("hidden");
    };

    const showModal = function() {
        let button = true;
        if (button) {
            button = false; // Đặt trạng thái là đã nhấn
            modal.classList.remove("hidden"); // Hiển thị modal
        }
    };
    for (let i = 0; i < btnsShowModal.length; i++) {
        btnsShowModal[i].addEventListener("click", showModal);
    }
    btnCloseModal.addEventListener("click", closeModal);
    // Close the Modal by pressing ESC keydown
    document.addEventListener("keydown", function(e) {
        if (e.key === "Escape" && !modal.classList.contains("hidden")) {
            closeModal();
        }
    });
</script>

</html>