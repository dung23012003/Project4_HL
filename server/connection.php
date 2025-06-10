<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "php_project";

// Kết nối database
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Lỗi kết nối database: " . $conn->connect_error);
}

?>
