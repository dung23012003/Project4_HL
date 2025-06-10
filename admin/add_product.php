<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $price = $_POST['price'];

    $sql = "INSERT INTO products (product_name, product_category, product_description, product_image, product_price) 
            VALUES ('$name', '$category', '$description', '$image', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Thêm sản phẩm thành công"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi: " . $conn->error]);
    }
}
?>
