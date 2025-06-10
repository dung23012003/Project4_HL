<?php
ob_start();
session_start();
include('server/connection.php');

if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('location: login.php');
    exit;
}

if (isset($_POST['change_password'])) {
    $password = $_POST['password'];
    $confirm_Password = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    if ($password !== $confirm_password) {
        header('location: account.php?error=Mật khẩu không khớp');
        exit();
    } 
    else if (strlen($password) < 6) {
        header('location: account.php?error=Mật khẩu phải lớn hơn 6 ký tự');
        exit();
    } 
    else {
        // Mã hóa mật khẩu trước khi lưu vào database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $user_email = $_SESSION['user_email'];

        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $stmt->bind_param("ss", $hashed_password, $user_email);

        if ($stmt->execute()) {
            header('location: account.php?message=Đổi mật khẩu thành công');
        
            
        } else {
            $error = $stmt->error ? $stmt->error : "Đổi mật khẩu thất bại";
            header('location: account.php?error=' . urlencode($error));
           
            
        }
    }
}
?>




<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang chủ</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" 
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" 
        crossorigin="anonymous"/>
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
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="shop.php"><i class="fas fa-list"></i> Tất cả sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" href="blog.php"><i class="fas fa-headset"></i> Bài viết</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-info-circle"></i> Liên hệ</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>

                <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="account.php">
                            <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['user_name'] ?? 'Người dùng'); ?>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                    </li> -->
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Account -->
<section class="my-5 py-5">
    <div class="container">
        <div class="row">
            <!-- Thông tin tài khoản -->
            <div class="col-lg-6 col-md-12 text-center mt-3 pt-5">
                <h3 class="font-weight-bold">Tài khoản của bạn</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p><strong>Tên:</strong> <span><?= htmlspecialchars($_SESSION['user_name'] ?? 'Không có thông tin'); ?></span></p>
                    <p><strong>Email:</strong> <span><?= htmlspecialchars($_SESSION['user_email'] ?? 'Không có thông tin'); ?></span></p>
                    <p><a href="#orders">Đơn hàng của bạn</a></p>
                    <p><a href="account.php?logout=1">Đăng xuất</a></p>
                </div>
            </div>

            <!-- Form đổi mật khẩu -->
            <div class="col-lg-6 col-md-12">
                <form id="account-form" method="POST" action="account.php">
                    <h3 >Đổi mật khẩu</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Nhập mật khẩu mới" required />
                    </div>
                    <div class="form-group">
                        <label>Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Nhập lại mật khẩu" required />
                    </div>
                    <div class="form-group text-center mt-3">
                        <input type="submit" value="Xác nhận" name="change_password" class="btn" id="change-pass-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Đơn hàng -->
<section id="orders" class="cart container my-5 py-3">
    <div class="container">
        <h2 class="text-center">Giỏ hàng của bạn</h2>
        <hr class="mx-auto">
    </div>
    <table class="table mt-5">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Ngày đặt</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="assets/imgs/ip11prm3.png" width="80" height="80" class="me-3"/>
                        <p class="mb-0">iPhone 11 Pro Max</p>
                    </div>
                </td>
                <td>2025-05-08</td>
            </tr>
        </tbody>
    </table>
    <div class="cart-total">
        <table class="table">
            <tr>
                <td><strong>Thành tiền:</strong></td>
                <td>9.000.000 VND</td>
            </tr>
        </table>
    </div>
    <div class="text-center">
        <button class="btn btn-primary">Thanh toán</button>
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