<?php
session_start();
include('server/connection.php');

if(isset($_SESSION['logged_in'] )){
    header('location: account.php');
    exit;
}  


if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Kiểm tra mật khẩu có khớp không
    if ($password !== $confirmPassword) {
        header('location: register.php?error=Mật khẩu không khớp');
        exit();
    } 
    // Kiểm tra độ dài mật khẩu
    else if (strlen($password) < 6) {
        header('location: register.php?error=Mật khẩu phải lớn hơn 6 ký tự');
        exit();
    } else {
        // Kiểm tra email đã tồn tại chưa
        $stmt1 = $conn->prepare("SELECT user_id FROM users WHERE user_email = ?");
    if (!$stmt1) {
    die("Lỗi SQL: " . $conn->error); // Kiểm tra lỗi SQL
        }
            $stmt1->bind_param('s', $email);
            $stmt1->execute();
            $stmt1->store_result();
            $num_rows = $stmt1->num_rows;
            $stmt1-> fetch();

        if ($num_rows > 0) {
            header('location: register.php?error=Email đã tồn tại');
            exit();
        } else {
            // Mã hóa mật khẩu an toàn hơn
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Tạo user mới
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $name, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register_success=Tạo tài khoản thành công');
                exit();
            } else {
                header('location: register.php?error=Không thể tạo tài khoản');
                exit();
            }
        }
    }
}
  //neu usẻr da ton tai

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
<!--Navbar-->    
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">
        <img class="logo" src="assets/imgs/logo.png">
        <h2  class="brand mx-auto">ND Mobile</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.html">
                        <i class="fas fa-home"></i> Trang chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop.html">
                        <i class="fas fa-list"></i> Tất cả sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.html">
                        <i class="fas fa-shopping-cart"></i> Giỏ Hàng
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
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div> -->
    </div>
</nav>
<!--register-->
<section class="my-5 py-5">
<div class="container text-center mt-3 pt-5">
    <h2 class="Form-weight-bold">Đăng ký</h2>
    <hr class="mx-auto">
</div>
<div class="mx-auto container">
    <form id="register-form" method="POST" action="register.php">
        <p style="color: red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
        <div class="form-group">
            <label>Tên</label>
            <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required/>
        </div>
        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="text" class="form-control" id="register-password" name="password" placeholder="password" required/>
        </div>
        <div class="form-group">
            <label> Xác nhận mật khẩu</label>
            <input type="text" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="password" required/>
        </div>
        <div class="form-group">
            <input type="submit" class="btn" id="register-btn"name="register" value="Tạo tài khoản"/>
        </div>
        <div class="form-group">
            <a id="login-url" href="login.php"class="btn">Đã có tài khoản? Đăng nhập</a>
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