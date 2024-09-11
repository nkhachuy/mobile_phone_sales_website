<?php
session_start();
include("Connection.php");

// Khởi tạo mảng lỗi
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tai_khoan = $_POST['tai_khoan'];
    $mat_khau = $_POST['mat_khau'];

    // Kiểm tra thông tin bắt buộc
    if (empty($tai_khoan)) {
        $errors['tai_khoan'] = "Vui lòng nhập tên đăng nhập!";
    }
    if (empty($mat_khau)) {
        $errors['mat_khau'] = "Vui lòng nhập mật khẩu!";
    }

    if (empty($errors)) {
        // Kiểm tra tài khoản và mật khẩu
        $stmt = $pdo->prepare("SELECT * FROM khach_hang WHERE tai_khoan = :tai_khoan");
        $stmt->bindParam(':tai_khoan', $tai_khoan);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Kiểm tra mật khẩu
            if ($mat_khau === $user['mat_khau']) { // Kiểm tra mật khẩu dưới dạng văn bản thô
                // Lưu thông tin người dùng vào session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['tai_khoan'] = $user['tai_khoan'];
                echo '<script>alert("Đăng nhập thành công!"); window.location.href="index.php";</script>';
            } else {
                $errors['login'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
            }
        } else {
            $errors['login'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/footer.css">
    <link rel="stylesheet" href="./CSS/Cart.css">
    <link rel="stylesheet" href="./CSS/Login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <?php include("Header.php"); ?>
    <div class="container">
        <h2 class="text-center text-danger mt-4">ĐĂNG NHẬP</h2>
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <form action="" method="post">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="tai_khoan" class="form-control" placeholder="Tên đăng nhập" type="text" value="<?= isset($tai_khoan) ? htmlspecialchars($tai_khoan) : '' ?>">
                    </div>
                    <?php if (isset($errors['tai_khoan'])): ?>
                        <h6 class="text-danger"><?= $errors['tai_khoan'] ?></h6>
                    <?php endif; ?>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input name="mat_khau" class="form-control" placeholder="Mật khẩu" type="password">
                    </div>
                    <?php if (isset($errors['mat_khau'])): ?>
                        <h6 class="text-danger"><?= $errors['mat_khau'] ?></h6>
                    <?php endif; ?>
                    <?php if (isset($errors['login'])): ?>
                        <h6 class="text-danger"><?= $errors['login'] ?></h6>
                    <?php endif; ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Đăng nhập </button>
                    </div>
                    <p class="text-center">Bạn chưa có tài khoản? <a href="Signup.php">Đăng ký</a> </p>
                    <p class="text-center"><a href="ResetPassword.php">Quên mật khẩu</a> </p>
                </form>
            </article>
        </div>
    </div>
    <?php include("Footer.php"); ?>
</body>

</html>
