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
    $ten_loai = $_POST["ten_loai"];
    $hinh = $_POST["hinh"];
    

    // Mã hóa mật khẩu
    

    // Thực hiện insert vào bảng khach_hang
    $sql = "INSERT INTO loai_san_pham (ten_loai, hinh) 
            VALUES (:ten_loai, :hinh)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ten_loai', $ten_loai);
    $stmt->bindParam(':hinh', $hinh);
    

    // Chuyển hướng người dùng về trang danh sách khách hàng sau khi thêm thành công
    if ($stmt->execute()) {
        // Nếu insert thành công, chuyển hướng đến trang danh sách khách hàng
        header("Location: LoaiSanPhamAdmin.php");
        exit();
    } else {
        // Nếu insert không thành công, báo lỗi
        echo "Đã xảy ra lỗi khi thêm loại sản phẩm.";
    }
    $pdo = null;
}
?>


<body>
    <?php
    include("adminHeader.php");
    include("sidebar.php");
    ?>
    <h2 class="text-center">TRANG THÊM LOẠI SẢN PHẨM</h2>
    <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="post">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Tên loại:</label>
                <div class="col-sm-10">
                    <input type="text" id="name" name="ten_loai" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Hình:</label>
                <div class="col-sm-10">
                    <input type="file" id="hinh" name="hinh" class="form-control-file" required>
                </div>
            </div>

            




            <!-- Các trường thông tin khác của sản phẩm -->

            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Thêm loại sản phẩm</button>
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