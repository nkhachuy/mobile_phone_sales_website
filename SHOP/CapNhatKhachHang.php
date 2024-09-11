<?php
include("Connection.php");

$id_khach_hang = $_GET["id"];

// Truy vấn để lấy thông tin khách hàng từ CSDL
$sql = "SELECT * FROM khach_hang WHERE id_khach_hang = :id_khach_hang";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_khach_hang', $id_khach_hang);
$stmt->execute();
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra xem biểu mẫu đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $ten_khach_hang = $_POST["ten_khach_hang"];
    $ngay_sinh = $_POST["ngay_sinh"];
    $dia_chi = $_POST["dia_chi"];
    $dien_thoai = $_POST["dien_thoai"];
    $email = $_POST["email"];
    $tai_khoan = $_POST["tai_khoan"];
    $mat_khau = $_POST["mat_khau"];

    // Cập nhật thông tin khách hàng trong CSDL
    $sql = "UPDATE khach_hang SET ten_khach_hang = :ten_khach_hang, ngay_sinh = :ngay_sinh, dia_chi = :dia_chi, dien_thoai = :dien_thoai, email = :email, tai_khoan = :tai_khoan, mat_khau = :mat_khau WHERE id_khach_hang = :id_khach_hang";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_khach_hang', $id_khach_hang);
    $stmt->bindParam(':ten_khach_hang', $ten_khach_hang);
    $stmt->bindParam(':ngay_sinh', $ngay_sinh);
    $stmt->bindParam(':dia_chi', $dia_chi);
    $stmt->bindParam(':dien_thoai', $dien_thoai);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':tai_khoan', $tai_khoan);
    $stmt->bindParam(':mat_khau', $mat_khau);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang danh sách khách hàng sau khi cập nhật thành công
        header("Location: KhachHangAdmin.php");
        exit();
    } else {
        echo "Có lỗi xảy ra. Vui lòng thử lại sau.";
    }
}
?>

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

<body>
    <?php
    include("adminHeader.php");
    include("sidebar.php");
    ?>
    <h2 class="text-center">TRANG CẬP NHẬT THÔNG TIN KHÁCH HÀNG</h2>
    <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id_khach_hang; ?>" class="form" method="post">
            <div class="form-group row">
                <label for="ten_khach_hang" class="col-sm-2 col-form-label">Tên khách hàng:</label>
                <div class="col-sm-10">
                    <input type="text" id="ten_khach_hang" name="ten_khach_hang" value="<?php echo htmlspecialchars($customer['ten_khach_hang']); ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="ngay_sinh" class="col-sm-2 col-form-label">Ngày sinh:</label>
                <div class="col-sm-10">
                    <input type="date" id="ngay_sinh" name="ngay_sinh" value="<?php echo htmlspecialchars($customer['ngay_sinh']); ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="dia_chi" class="col-sm-2 col-form-label">Địa chỉ:</label>
                <div class="col-sm-10">
                    <input type="text" id="dia_chi" name="dia_chi" value="<?php echo htmlspecialchars($customer['dia_chi']); ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="dien_thoai" class="col-sm-2 col-form-label">Điện thoại:</label>
                <div class="col-sm-10">
                    <input type="text" id="dien_thoai" name="dien_thoai" value="<?php echo htmlspecialchars($customer['dien_thoai']); ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="tai_khoan" class="col-sm-2 col-form-label">Tài khoản:</label>
                <div class="col-sm-10">
                    <input type="text" id="tai_khoan" name="tai_khoan" value="<?php echo htmlspecialchars($customer['tai_khoan']); ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="mat_khau" class="col-sm-2 col-form-label">Mật khẩu:</label>
                <div class="col-sm-10">
                    <input type="password" id="mat_khau" name="mat_khau" value="<?php echo htmlspecialchars($customer['mat_khau']); ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Cập nhật thông tin khách hàng</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
