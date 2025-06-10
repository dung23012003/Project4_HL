<?php
session_start();
include('../server/connection.php');

// Nếu đã đăng nhập thì chuyển hướng về account.php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('location: dashboard.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];   
    $password = $_POST['password']; 

    // Kiểm tra xem có user nào có email này không
    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Nếu tìm thấy user
    if ($stmt->num_rows == 1) {  
        $stmt->bind_result($user_id, $user_name, $user_email, $hashed_password);
        $stmt->fetch();

        // Kiểm tra mật khẩu
        if (password_verify($password, $hashed_password)) { 
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            header('location: account.php?message=Đăng nhập thành công');
            exit;
        } else {
            header('location: login.php?error=Mật khẩu không đúng');
            exit;
        }
    } else {
        header('location: login.php?error=Email không tồn tại');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            width: 250px;
            background: #f8f9fa;
            padding-top: 20px;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
        .header {
            background: #343a40;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <span>Company name</span>
        <button class="btn btn-danger">Sign out</button>
    </div>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-primary" href="#">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#">Orders</a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#">Products</a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#">Customers</a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#">Create Product</a></li>
                <li class="nav-item"><a class="nav-link text-primary" href="#">Account</a></li>
            </ul>
        </nav>
        
        <!-- Main Content -->
        <div class="main-content">
            <h1>Dashboard</h1>
            <h3>Section title</h3>
            <div class="table-container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Header</th>
                            <th>Header</th>
                            <th>Header</th>
                            <th>Header</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>1,001</td><td>random</td><td>data</td><td>placeholder</td><td>text</td></tr>
                        <tr><td>1,002</td><td>placeholder</td><td>irrelevant</td><td>visual</td><td>layout</td></tr>
                        <tr><td>1,003</td><td>data</td><td>rich</td><td>dashboard</td><td>tabular</td></tr>
                        <tr><td>1,003</td><td>information</td><td>placeholder</td><td>illustrative</td><td>data</td></tr>
                        <tr><td>1,004</td><td>text</td><td>random</td><td>layout</td><td>dashboard</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

