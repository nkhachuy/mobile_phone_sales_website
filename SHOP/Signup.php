<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/footer.css">
    <link rel="stylesheet" href="./CSS/Cart.css">
    <link rel="stylesheet" href="./CSS/Signup.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<?php
session_start();
include("Connection.php");

// Initialize error array
$errors = array();

// Initialize old values array
$old_values = array(
    'ten_khach_hang' => '',
    'ngay_sinh' => '',
    'dien_thoai' => '',
    'dia_chi' => '',
    'tai_khoan' => '',
    'mat_khau' => '',
    'email' => ''
);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_khach_hang = $_POST['ten_khach_hang'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $dien_thoai = $_POST['dien_thoai'];
    $dia_chi = $_POST['dia_chi'];
    $tai_khoan = $_POST['tai_khoan'];
    $mat_khau = $_POST['mat_khau'];
    $email = $_POST['email'];

    // Save old values
    $old_values = array(
        'ten_khach_hang' => $ten_khach_hang,
        'ngay_sinh' => $ngay_sinh,
        'dien_thoai' => $dien_thoai,
        'dia_chi' => $dia_chi,
        'tai_khoan' => $tai_khoan,
        'mat_khau' => $mat_khau,
        'email' => $email
    );

    // Validate required fields
    if (empty($ten_khach_hang)) {
        $errors['ten_khach_hang'] = "Vui lòng nhập tên hiển thị!";
    }
    if (empty($ngay_sinh)) {
        $errors['ngay_sinh'] = "Vui lòng nhập ngày sinh!";
    }
    if (empty($dien_thoai)) {
        $errors['dien_thoai'] = "Vui lòng nhập số điện thoại!";
    }
    if (empty($dia_chi)) {
        $errors['dia_chi'] = "Vui lòng nhập địa chỉ!";
    }
    if (empty($tai_khoan)) {
        $errors['tai_khoan'] = "Vui lòng nhập tên đăng nhập!";
    }
    if (empty($mat_khau)) {
        $errors['mat_khau'] = "Vui lòng nhập mật khẩu!";
    }
    if (empty($email)) {
        $errors['email'] = "Vui lòng nhập email!";
    }

    if (empty($errors)) {
        // Check for duplicate account
        $stmt = $pdo->prepare("SELECT * FROM khach_hang WHERE tai_khoan = :tai_khoan OR email = :email");
        $stmt->bindParam(':tai_khoan', $tai_khoan);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $errors['tai_khoan'] = "Tài khoản hoặc email đã tồn tại!";
        } else {
            // Insert data into khach_hang table
            $stmt = $pdo->prepare("INSERT INTO khach_hang (ten_khach_hang, ngay_sinh, dia_chi, dien_thoai, tai_khoan, mat_khau, email)
                                   VALUES (:ten_khach_hang, :ngay_sinh, :dia_chi, :dien_thoai, :tai_khoan, :mat_khau, :email)");
            $stmt->bindParam(':ten_khach_hang', $ten_khach_hang);
            $stmt->bindParam(':ngay_sinh', $ngay_sinh);
            $stmt->bindParam(':dia_chi', $dia_chi);
            $stmt->bindParam(':dien_thoai', $dien_thoai);
            $stmt->bindParam(':tai_khoan', $tai_khoan);
            $stmt->bindParam(':mat_khau', $mat_khau);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                echo '<script>alert("Đăng ký thành công!"); window.location.href="Login.php";</script>';
            } else {
                echo "Error: Không thể đăng ký.";
            }
        }
    }
}
?>

<body>
    <?php include("Header.php"); ?>
    <div class="container">
        <h2 class="text-center text-danger mt-4">ĐĂNG KÝ TÀI KHOẢN</h2>
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <p class="text-center">Get started with your free account</p>
                <p>
                    <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login with Twitter</a>
                    <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login with facebook</a>
                </p>
                <p class="divider-text">
                    <span class="bg-light">OR</span>
                </p>
                <form action="" method="post">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="ten_khach_hang" class="form-control" placeholder="Tên hiển thị" type="text" value="<?= htmlspecialchars($old_values['ten_khach_hang']) ?>">
                    </div>
                    <?php if (isset($errors['ten_khach_hang'])): ?>
                        <h6 class="text-danger"><?= $errors['ten_khach_hang'] ?></h6>
                    <?php endif; ?>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-calendar-day"></i> </span>
                        </div>
                        <input name="ngay_sinh" class="form-control" placeholder="Ngày sinh" type="text" value="<?= htmlspecialchars($old_values['ngay_sinh']) ?>">
                    </div>
                    <?php if (isset($errors['ngay_sinh'])): ?>
                        <h6 class="text-danger"><?= $errors['ngay_sinh'] ?></h6>
                    <?php endif; ?>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                        </div>
                        <input name="dien_thoai" class="form-control" placeholder="Số điện thoại" type="text" value="<?= htmlspecialchars($old_values['dien_thoai']) ?>">
                    </div>
                    <?php if (isset($errors['dien_thoai'])): ?>
                        <h6 class="text-danger"><?= $errors['dien_thoai'] ?></h6>
                    <?php endif; ?>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fas fa-globe-asia"></i> </span>
                        </div>
                        <input name="dia_chi" class="form-control" placeholder="Địa chỉ" type="text" value="<?= htmlspecialchars($old_values['dia_chi']) ?>">
                    </div>
                    <?php if (isset($errors['dia_chi'])): ?>
                        <h6 class="text-danger"><?= $errors['dia_chi'] ?></h6>
                    <?php endif; ?>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="email" class="form-control" placeholder="Email" type="text" value="<?= htmlspecialchars($old_values['email']) ?>">
                    </div>
                    <?php if (isset($errors['email'])): ?>
                        <h6 class="text-danger"><?= $errors['email'] ?></h6>
                    <?php endif; ?>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="tai_khoan" class="form-control" placeholder="Tên đăng nhập" type="text" value="<?= htmlspecialchars($old_values['tai_khoan']) ?>">
                    </div>
                    <?php if (isset($errors['tai_khoan'])): ?>
                        <h6 class="text-danger"><?= $errors['tai_khoan'] ?></h6>
                    <?php endif; ?>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input name="mat_khau" class="form-control" placeholder="Mật khẩu" type="password" value="<?= htmlspecialchars($old_values['mat_khau']) ?>">
                    </div>
                    <?php if (isset($errors['mat_khau'])): ?>
                        <h6 class="text-danger"><?= $errors['mat_khau'] ?></h6>
                    <?php endif; ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Đăng ký  </button>
                    </div>
                    <p class="text-center">Bạn đã có tài khoản? <a href="Login.php">Đăng nhập</a> </p>
                </form>
            </article>
        </div>
    </div>
    <?php include("Footer.php"); ?>
</body>

</html>
