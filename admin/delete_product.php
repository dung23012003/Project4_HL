<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE product_id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Xóa sản phẩm thành công"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi: " . $conn->error]);
    }
}
?>
