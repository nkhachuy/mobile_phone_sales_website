<?php
require_once 'C:/xampp/htdocs/PHP/SHOP/PHPMailer/Mailer.php'; // Include the Mailer class

ob_start();
// Khởi tạo PDO để kết nối đến cơ sở dữ liệu
include("Connection.php");

// Khởi tạo biến để lưu thông báo
$message = '';

// Kiểm tra nếu form đã được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy địa chỉ email từ form và kiểm tra tính hợp lệ
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Truy vấn cơ sở dữ liệu để kiểm tra xem email có tồn tại không
    $stmt = $pdo->prepare("SELECT * FROM khach_hang WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Nếu email tồn tại trong cơ sở dữ liệu
    if ($user) {
        // Tạo mật khẩu mới (ví dụ: chuỗi ngẫu nhiên)
        $newPassword = substr(md5(mt_rand()), 0, 8); // Ví dụ: mật khẩu gồm 8 ký tự ngẫu nhiên

        // Cập nhật mật khẩu mới vào cơ sở dữ liệu
        $stmt = $pdo->prepare("UPDATE khach_hang SET mat_khau = :password WHERE email = :email");
        $stmt->bindParam(":password", $newPassword);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // Gửi email chứa mật khẩu mới
        $mailer = new Mailer();
        $title = "Reset Password";
        $content = "Mật khẩu mới của bạn là: $newPassword";
        $addressMail = $email;
        $mailer->sendMail($title, $content, $addressMail);

        // Thiết lập thông báo
        $message = "Mật khẩu mới đã được gửi vui lòng kiểm tra email của bạn!";
    } else {
        // Nếu email không tồn tại trong cơ sở dữ liệu
        $message = "Email không tồn tại!";
    }
    ob_end_clean();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
        <h2 class="text-center text-danger mt-4">QUÊN MẬT KHẨU</h2>
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="email" class="form-control" placeholder="Email" type="email" id="email">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Gửi mật khẩu </button>
                    </div>
                    <!-- Hiển thị thông báo -->
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                </form>
            </article>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>
