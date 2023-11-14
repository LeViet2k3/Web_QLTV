<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-image: url(../Image/background/anh7.jpg);
            background-size: cover;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .full_search {
            display: flex;
            width: 100%;
        }

        .search {
            width: 50%;
            /* border: 1px solid blue; */

        }

        .search h2 {
            text-align: center;
        }

        .search a {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            text-decoration: none;
            border: 1px solid black;
            text-align: center;
            margin: auto;
            color: black;
            padding: 10px;
            width: 50%;
        }

        .display {
            width: 50%;
        }

        .display table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
            text-align: center;
            margin: auto;
        }

        .display table {
            width: 90%;
        }

        .display h2 {
            text-align: center;
        }

        .show_modal {
            font-size: 1.5rem;
            font-weight: 600;
            padding: 3%;
            margin: 20% 30%;
            border: none;
            background-color: #fff;
            color: #444;
            border-radius: 10rem;
            cursor: pointer;
            border: 1px solid black;
        }

        .close-modal {
            position: absolute;
            top: 2.5rem;
            right: 2.3rem;
            font-size: 3.5rem;
            color: rgb(190, 192, 195);
            cursor: pointer;
            border: none;
            background: none;
        }

        .hidden {
            display: none;
        }

        .modal {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            z-index: 10;
        }
    </style>
</head>

<body>
    <div class="full_search">
        <div class="search">
            <?php
            include('../libs/helper.php');
            Database::db_connect();
            $sql_select_bookname = "SELECT Book_name FROM book
                                    JOIN library_records ON book.Book_id = library_records.Book_id ";
            echo "<h2>Tất Cả Sách Trong Thư Viện:</h2>";
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
                $sql_select_info = "SELECT File_pdf
                FROM book
                WHERE Book_name = '$bookname'";

                $info_book = Database::db_get_list($sql_select_info);
                foreach ($info_book as $name) {
                    $name_file =  $name['File_pdf'];
                }
            }

            ?>
            <div>
                <button class="show_modal">Open PDF</button>

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
    const overlay = document.querySelector(".overlay");
    const btnCloseModal = document.querySelector(".close-modal");
    const btnsShowModal = document.querySelectorAll(".show_modal");

    const closeModal = function() {
        modal.classList.add("hidden");
        overlay.classList.add("hidden");
    };

    const showModal = function() {
        modal.classList.remove("hidden");
        overlay.classList.remove("hidden");
    };

    for (let i = 0; i < btnsShowModal.length; i++) {
        btnsShowModal[i].addEventListener("click", showModal);
    }

    btnCloseModal.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);

    // Close the Modal by pressing ESC keydown
    document.addEventListener("keydown", function(e) {
        if (e.key === "Escape" && !modal.classList.contains("hidden")) {
            closeModal();
        }
    });
</script>

</html>