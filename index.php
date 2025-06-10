<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="icon" type="image/png" href="assets/imgs/favicon.png">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>
<body>
    <?php echo "Server is working!"; ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <img class="logo" src="assets/imgs/logo.png">
            <h2 class="brand">ND Mobile</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php"><i class="fas fa-list"></i> Tất cả sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-headset"></i> Bài viết</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-info-circle"></i> Liên hệ</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="account.php"><i class="fas fa-user"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Home -->
    <section id="home">
        <div class="container">
            <h5 style="color: blue; font-family: 'Verdana', sans-serif; font-size: 24px; font-weight: bold;">ND Mobile</h5>
            <h1><span style="color: orange; font-weight: bold; font-family: 'Arial', sans-serif; font-size: 48px;">KHÔNG ZIN</span> <span style="color: black; font-family: 'Times New Roman', serif; font-size: 48px;">TẶNG MÁY</span></h1>
            <h5 style="color: green; font-family: 'Courier New', monospace; font-size: 22px;">Chất lượng đặt lên hàng đầu</h5>
            <button>Xem ngay</button>
        </div>
    </section>

    <!-- New -->
    <section id="new" class="w-10">
        <div class="row p-0 m-0">
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0"><img class="img-fluid" src="assets/imgs/new2.jpg"><div class="details"><h2>Hàng 99%</h2><button class="text-uppercase">Xem ngay</button></div></div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0"><img class="img-fluid" src="assets/imgs/new3.jpg"><div class="details"><h2>Hàng 96%-98%</h2><button class="text-uppercase">Xem ngay</button></div></div>
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0"><img class="img-fluid" src="assets/imgs/new4.jpg"><div class="details"><h2>Hàng 95%</h2><button class="text-uppercase">Xem ngay</button></div></div>
        </div>
    </section>

    <!-- Featured Products (example with single include) -->
    <?php include('server/get_featured_products.php'); ?>
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py">
            <h3>Iphone 11 series</h3><hr class="mx-auto"><p>Vẫn luôn thể hiện được sự quyến rũ riêng</p>
        </div>
        <div class="row mx-auto container justify-content-evenly">
            <?php while ($row = $featured_products->fetch_assoc()) { ?>
                <div class="product col-lg-3 col-md-4 col-sm-6">
                    <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image2']; ?>"/>
                    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                    <h4 class="p-price"><?php echo number_format($row['product_price'] * 23000, 0, ',', '.') . ' VND'; ?></h4>
                    <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>"><button class="buy-btn">Mua ngay</button></a>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Thêm các section khác tương tự, chỉ include get_featured_products.php một lần -->

    <!-- Footer -->
    <footer class="mt-5 py-5">
        <div class="row">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12"><img class="logo" src="assets/imgs/logo.png"><p class="pt-3">Cảm ơn quý khách đã ghé thăm và tin dùng sản phẩm của ND Mobile</p></div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12"><h5 class="pb-2">Các mặt hàng</h5><ul class="text-uppercase"><li><a href="#">iphone 11promax</a></li><li><a href="#">iphone 12 promax</a></li><li><a href="#">iphone 13promax</a></li><li><a href="#">iphone 14promax</a></li><li><a href="#">iphone 15promax</a></li></ul></div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12"><h5 class="pb-2"> Thông tin liên hệ</h5><div><h5 class="text-uppercase">Địa chỉ:</h5><p>1234 Street Name, City</p></div><div><h5 class="text-uppercase">Số điện thoại</h5><p>0865118827</p></div><div><h5 class="text-uppercase">Email</h5><p>nguyendung@gmail.com</p></div></div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12"><h5 class="pb-2">Đồng sáng lập</h5><div class="row"><img src="assets/imgs/nd3.jpg" class="img-fluid w-25 h-100 m-2"/><img src="assets/imgs/putin.jpg" class="img-fluid w-25 h-100 m-2"/><img src="assets/imgs/trump.jpg" class="img-fluid w-25 h-100 m-2"/><img src="assets/imgs/elonmusk.jpg" class="img-fluid w-25 h-100 m-2"/><img src="assets/imgs/kim.jpg" class="img-fluid w-25 h-100 m-2"/><img src="assets/imgs/billgate.jpg" class="img-fluid w-25 h-100 m-2"/></div></div>
        </div>
        <div class="copyright mt-5"><div class="row container mx-auto pt-5"><div class="col-lg-3 col-md-5 col-sm-12 mb-4"><img src="assets/imgs/visa.jpg"></div><div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2"><p>eCommerce @2025 NND</p></div><div class="col-lg-3 col-md-5 col-sm-12 mb-4"><a href="https://www.facebook.com/profile.php?id=100009816372045"><i class="fab fa-facebook"></i></a><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-twitter"></i></a></div></div></div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>