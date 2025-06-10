<?php
session_start();

if (isset($_POST['add_to_cart'])) {
    // Kiểm tra nếu giỏ hàng đã tồn tại
    if (isset($_SESSION['cart'])) {
        // Lấy danh sách ID sản phẩm đã có trong giỏ hàng
        $products_array_ids = array_column($_SESSION['cart'], "product_id");

        // Nếu sản phẩm chưa có trong giỏ hàng, thêm vào
        if (!in_array($_POST['product_id'], $products_array_ids)) {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = $_POST['product_quantity'];

            // Tạo mảng sản phẩm
            $product_array = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_quantity' => $product_quantity
            );

            // Lưu vào session giỏ hàng
            $_SESSION['cart'][$product_id] = $product_array;
        } else {
            echo '<script>alert("Sản phẩm đã có trong giỏ hàng!");</script>';
        }
    } else {
        // Nếu giỏ hàng chưa có, khởi tạo giỏ hàng
        $_SESSION['cart'] = array();

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        // Tạo mảng sản phẩm
        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );

        // Lưu vào session giỏ hàng
        $_SESSION['cart'][$product_id] = $product_array;
    }
   


// Xóa sản phẩm khỏi giỏ hàng
} elseif (isset($_POST['remove_product'])) {
    
    $product_id = $_POST['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
} elseif (isset($_POST['edit_quantity'])) {
    // Chỉnh sửa số lượng sản phẩm
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    if (isset($_SESSION['cart'][$product_id])) {
        // Đảm bảo số lượng là số nguyên dương
        $product_quantity = max(1, intval($product_quantity));
        $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
    }
     //tinh toan
     calculateTotalCart();

} else {
    // Nếu không có hành động nào được gửi, chuyển hướng về trang chính
    // header('Location: index.php');
    // exit();
}

function calculateTotalCart() {
    $total = 0;

    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        $_SESSION['total'] = $total;
        return;
    }

    foreach ($_SESSION['cart'] as $product) {
        $price = $product['product_price'] ?? 0;
        $quantity = $product['product_quantity'] ?? 0;
        $total += $price * $quantity;
    }

    $_SESSION['total'] = $total;
}

?>

<!DOCTYPE html>
<html lang="en">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME</title>
  <link rel="stylesheet" href="assets/css/style.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
   rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
  </head>
  <style>
    .checkout-btn{
   background-color: #fb774b;
   color: aliceblue;
}
.checkout-btn:hover{
    background-color: rgba(0, 69, 172, 0.426);
}
  </style>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">
        <img class="logo" src="assets/imgs/logo.png">
        <h2 class="brand">ND Mobile</h2>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        <i class="fas fa-home"></i> Trang chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop.html">
                        <i class="fas fa-list"></i> Tất cả sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-headset"></i> Bài viết
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">
                        <i class="fas fa-info-circle"></i> Liên hệ
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account.php">
                        <i class="fas fa-user"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Cart -->
<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bold">Giỏ hàng</h2>
        <hr>
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>

        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                <tr>
                    <td>
                    <div class="product-info">
    <img src="assets/imgs/<?php echo htmlspecialchars($value['product_image']); ?>" alt="<?php echo htmlspecialchars($value['product_name']); ?>" />
    <div>
        <p><?php echo htmlspecialchars($value['product_name']); ?></p>
        <small><?php echo number_format($value['product_price'] * 23000, 0, ',', '.'); ?> <span>VND</span></small>
        <br>
        <form method="POST" action="cart.php">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($value['product_id']); ?>" />
            <input type="submit" name="remove_product" class="remove-btn" value="Xóa" />
        </form>
    </div>
        </div>

                </td>
                    <td>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($value['product_id']); ?>" />
                            <input type="number" name="product_quantity" value="<?php echo htmlspecialchars($value['product_quantity']); ?>" min="1" />
                            <input type="submit" class="edit-btn" value="Cập nhật" name="edit_quantity" />
                        </form>
                    </td>
                    <td>
    <span class="product-price">
        <?php echo number_format($value['product_quantity'] * $value['product_price'] * 23000, 0, ',', '.'); ?>
    </span>
    <span>VND</span>
</td>

                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="3" class="text-center">Giỏ hàng của bạn đang trống.</td>
            </tr>
        <?php } ?>
    </table>

   
                <div class="cart-total">
                <table>
                    <tr>
                        <td>Thành tiền</td>
                        <td>
                            <?php 
                            if (isset($_SESSION['total']) && $_SESSION['total'] > 0) {
                                echo number_format($_SESSION['total'] * 23000, 0, ',', '.') . ' VND';
                            } else {
                                echo '0 VND';
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>



        <div class="checkout-container">
            <form method="POST" action="checkout.php">
            <input type="submit" class="btn checkout-btn" value="Thanh toán" name="checkout" >
        </div>
</section>




<!--footer-->
<footer class="mt-5 py-5">
    <div class="row">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <img class="logo" src="assets/imgs/logo.png">
        <p class="pt-3">Cảm ơn quý khách đã ghé thăm và tin dùng sản phẩm của ND Mobile</p>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Các mặt hàng</h5>
        <ul class="text-uppercase">
            <li><a href="#">iphone 11promax</a></li>
            <li><a href="#">iphone 12 promax</a></li>
            <li><a href="#">iphone 13promax</a></li>
            <li><a href="#">iphone 14promax</a></li>
            <li><a href="#">iphone 15promax</a></li>
         </ul>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2"> Thông tin liên hệ</h5>
            <div>
                <h5 class="text-uppercase">Địa chỉ:</h5>
                <p>1234 Street Name, City</p>

            </div>
            <div>
                <h5 class="text-uppercase">Số điện thoại</h5>
                <p>0865118827</p>
            </div>
            <div>
                <h5 class="text-uppercase">Email</h5>
                <p>nguyendung@gmail.com</p>
            </div>
            </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Đồng sáng lập</h5>
            <div class="row">
                <img src="assets/imgs/nd3.jpg" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/putin.jpg" class="img-fluid w-25 h-100 m-2"/>
              
                <img src="assets/imgs/trump.jpg" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/elonmusk.jpg" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/kim.jpg" class="img-fluid w-25 h-100 m-2"/>
                <img src="assets/imgs/billgate.jpg" class="img-fluid w-25 h-100 m-2"/>
               
            </div>
        </div>
    </div>

    <div class="copyright mt-5">
        <div class="row container mx-auto pt-5">
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                <img src="assets/imgs/visa.jpg">
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text nowrap mb-2">
                <p>eCommerce @2025 NND</p>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                <a href="https://www.facebook.com/profile.php?id=100009816372045"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>    