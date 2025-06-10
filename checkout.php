<?php

session_start();
if( !empty($_SESSION['cart']) && isset($_POST['checkout'])) {
    //let user in



    //send user to home page
}else{
 header ('location: index.php');
}



?>
<!DOCTYPE html>
<html lang="en">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME</title>
  <link rel="stylesheet" href="assets/css/style.css">

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

<!--checkout-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="Form-weight-bold">Đăng ký</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="checkout-form" method="POST" action="server/place_order.php">
            <div class="form-group checkout-small-element">
                <label>Họ và tên</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Tên" required/>
            </div>
            <div class="form-group checkout-small-element">
                <label>Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required/>
            </div>
            <div class="form-group checkout-small-element">
                <label>Điện thoại</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Số điện thoại" required/>
            </div>
            <div class="form-group checkout-small-element">
                <label> Thành phố</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Thành phố" required/>
            </div>
            <div class="form-group checkout-large-element">
                <label> Địa chỉ</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Địa chỉ" required/>
            </div>
            <div class="form-group checkout-btn-container">
            <?php 
            // Kiểm tra xem total có tồn tại không
            if (isset($_SESSION['total'])) {
            $total_vnd = $_SESSION['total'] * 23000; // Quy đổi từ USD sang VND
                } else {
            $total_vnd = 0; // Nếu không có giá trị, đặt về 0
                }
            ?>

            <p> Tổng số tiền : <?php echo number_format($total_vnd, 0, ',', '.'); ?> VND</p>

                
                <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Hoàn thành"/>
            </div>
        </form>
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