<?php
session_start();
include('connection.php'); // Đảm bảo kết nối database

if(isset($_POST['place_order']) ) {
    
    // 1. Lấy thông tin người dùng từ form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    // Kiểm tra nếu session total có tồn tại
    if (!isset($_SESSION['total'])) {
        die("Lỗi: Không tìm thấy tổng tiền đơn hàng.");
    }

    $order_cost = $_SESSION['total'] * 23000; 
    $order_status = "on hold";
    $user_id = 1; 
    $order_date = date('Y-m-d H:i:s');


    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isissss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id; 
        echo "Đơn hàng đã tạo thành công! ID: " . $order_id;
    } else {
        die("Lỗi khi tạo đơn hàng: " . $stmt->error);
    }



//2.issue new order and store order inot on database
    $order_id =$stmt->insert_id;





//3. get product from cart

foreach($_SESSION['cart'] as $key => $value){
    
    $product =$_SESSION['cart'][$key]; 
    $product_id=$product['product_id'];
    $product_name=$product['product_name'];
    $product_image=$product['product_image'];
    $product_price=$product['product_price'];
    $product_quantity=$product['product_quantity'];
    // 4. store each single item in order_items database
    $stmt1= $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
                        VALUES (?,?,?,?,?,?,?,?)");
    
    
    $stmt1->bind_param('iissiiis',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);

    $stmt1-> execute();
}
 




// 5.remove evething from cart-> delay until payment is done
//unset($_SESSION['cart']);

// 6.inform user whether everything is fine or there is a problem
header('location: ../payment.php?order_status="order placed successfully"');





}

?>
