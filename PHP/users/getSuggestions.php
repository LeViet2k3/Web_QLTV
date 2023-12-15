<?php
include('../libs/helper.php');
Database::db_connect();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $input = $_POST["input"];

  // Tạo đối tượng FormularyMedication_DB_Test

  // Lấy danh sách gợi ý từ cơ sở dữ liệu
  $suggestions = Database::getBookSuggestions($input);

  // Hiển thị danh sách gợi ý
  foreach ($suggestions as $suggestion) {
    echo "<div class='suggestion'>$suggestion</div>";
  }
}
?>
