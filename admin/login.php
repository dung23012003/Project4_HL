<?php
session_start();
include '../server/connection.php';

// Kiểm tra kết nối database
if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Nếu đã đăng nhập thì chuyển hướng về index.php
if (isset($_SESSION['admin_logged_in'])) {
    header('location: index.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];   
    $password = $_POST['password']; 

    // Kiểm tra bảng `admins` để lấy đúng tên cột
    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? LIMIT 1");

    if (!$stmt) {
        die("Lỗi chuẩn bị truy vấn: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Nếu tìm thấy user
    if ($stmt->num_rows == 1) {  
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt->fetch();

        // Kiểm tra mật khẩu
        if (password_verify($password, $admin_password)) { 
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            header('location: index.php?login_success=Đăng nhập thành công');
            exit;
        } else {
            header('location: login.php?error=Mật khẩu không đúng');
            exit;
        }
    } else {
        header('location: login.php?error=Email không tồn tại');
        exit;
    }
    $stmt->close();
}
?>
<?php include('header.php');?>

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="fw-bold">Đăng nhập</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container w-50"> 
        <form id="login-form" enctype="multipart/form-data" method="POST" action="login.php">
            <p style="color:red" class="text-center">
                <?php if(isset($_GET['error'])){ echo $_GET['error']; } ?>
            </p>

            <div class="form-group mt-3">
                <label for="Login-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="Login-email" name="email" placeholder="Nhập email" required/>
            </div>

            <div class="form-group mt-3">
                <label for="Login-password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="Login-password" name="password" placeholder="Nhập mật khẩu" required/>
            </div>

            <div class="form-group mt-4 text-center">
                <input type="submit" class="btn btn-primary w-100" id="Login-btn" name="login_btn" value="Đăng nhập"/>
            </div>

            <div class="form-group mt-3 text-center">
                <a id="register-url" href="register.php" class="btn btn-outline-secondary w-100">Chưa có tài khoản? Đăng ký</a>
            </div>
        </form>
    </div>
</section> 

</body>
</html>