<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<?php
session_start();
include("Connection.php");

// Khởi tạo mảng lỗi
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $ten_khach_hang = $_POST["ten_khach_hang"];
    $ngay_sinh = $_POST["ngay_sinh"];
    $dia_chi = $_POST["dia_chi"];
    $dien_thoai = $_POST["dien_thoai"];
    $email = $_POST["email"];
    $tai_khoan = $_POST["tai_khoan"];
    $mat_khau = $_POST["mat_khau"];

    // Mã hóa mật khẩu
    

    // Thực hiện insert vào bảng khach_hang
    $sql = "INSERT INTO khach_hang (ten_khach_hang, ngay_sinh, dia_chi, dien_thoai, email, tai_khoan, mat_khau) 
            VALUES (:ten_khach_hang, :ngay_sinh, :dia_chi, :dien_thoai, :email, :tai_khoan, :mat_khau)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ten_khach_hang', $ten_khach_hang);
    $stmt->bindParam(':ngay_sinh', $ngay_sinh);
    $stmt->bindParam(':dia_chi', $dia_chi);
    $stmt->bindParam(':dien_thoai', $dien_thoai);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':tai_khoan', $tai_khoan);
    $stmt->bindParam(':mat_khau', $mat_khau);

    // Chuyển hướng người dùng về trang danh sách khách hàng sau khi thêm thành công
    if ($stmt->execute()) {
        // Nếu insert thành công, chuyển hướng đến trang danh sách khách hàng
        header("Location: KhachHangAdmin.php");
        exit();
    } else {
        // Nếu insert không thành công, báo lỗi
        echo "Đã xảy ra lỗi khi thêm khách hàng.";
    }
    $pdo = null;
}
?>



<body>
    <?php
    include("adminHeader.php");
    include("sidebar.php");
    ?>
    <h2 class="text-center">TRANG THÊM KHÁCH HÀNG</h2>
    <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="post">
            <div class="form-group row">
                <label for="ten_khach_hang" class="col-sm-2 col-form-label">Tên khách hàng:</label>
                <div class="col-sm-10">
                    <input type="text" id="ten_khach_hang" name="ten_khach_hang" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="ngay_sinh" class="col-sm-2 col-form-label">Ngày sinh:</label>
                <div class="col-sm-10">
                    <input type="date" id="ngay_sinh" name="ngay_sinh" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="dia_chi" class="col-sm-2 col-form-label">Địa chỉ:</label>
                <div class="col-sm-10">
                    <input type="text" id="dia_chi" name="dia_chi" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="dien_thoai" class="col-sm-2 col-form-label">Điện thoại:</label>
                <div class="col-sm-10">
                    <input type="text" id="dien_thoai" name="dien_thoai" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="tai_khoan" class="col-sm-2 col-form-label">Tài khoản:</label>
                <div class="col-sm-10">
                    <input type="text" id="tai_khoan" name="tai_khoan" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="mat_khau" class="col-sm-2 col-form-label">Mật khẩu:</label>
                <div class="col-sm-10">
                    <input type="password" id="mat_khau" name="mat_khau" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Thêm khách hàng</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>