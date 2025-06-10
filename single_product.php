<?php
include('server/connection.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result();

    if ($product->num_rows == 0) {
        header('location: index.php');
        exit();
    }
} else {
    header('location: index.php');
    exit();
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
                    <a class="nav-link" href="shop.php">
                        <i class="fas fa-list"></i> Tất cả sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-headset"></i> Bài viết
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">
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
<!-- Single Product -->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">
        <?php if ($product->num_rows > 0) { 
            while ($row = $product->fetch_assoc()) { 
                $price_vnd = $row['product_price'] * 23000; // Quy đổi giá từ USD sang VND
        ?>

        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" id="mainImg" />
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img" />
                </div>
                <?php if (!empty($row['product_image2'])) { ?>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img" />
                </div>
                <?php } ?>
                <?php if (!empty($row['product_image3'])) { ?>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img" />
                </div>
                <?php } ?>
                <?php if (!empty($row['product_image4'])) { ?>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img" />
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
    <h3 class="py-4"><?php echo htmlspecialchars($row['product_name']); ?></h3>

    <!-- Hiển thị giá tiền VND đã định dạng -->
    <h2><?php echo number_format($price_vnd, 0, ',', '.'); ?> VND</h2>

    <div class="product-info.p">
        <form method="POST" action="cart.php" class="cart-form">  
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
            <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
            <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
            <input type="hidden" name="product_price" value="<?php echo $price_vnd; ?>"/>

            <input type="number" name="product_quantity" value="1" class="quantity-input">
            <button class="buy-btn" type="submit" name="add_to_cart">Thêm vào giỏ hàng</button>
        </form>

        <div class="product-details">
            <h4>Product Details</h4>
            <span><?php echo nl2br(htmlspecialchars($row['product_description'])); ?></span>
        </div>
             </div>
            </div>

        <?php } } else { ?>
            <p class="text-center">Không tìm thấy sản phẩm nào.</p>
        <?php } ?>
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

    <script>

    for (let i = 0; i < smallImgs.length; i++) {
    smallImgs[i].onclick = function () {
        mainImg.src = smallImgs[i].src;
    };
        }


    </script>
</body>
</html>