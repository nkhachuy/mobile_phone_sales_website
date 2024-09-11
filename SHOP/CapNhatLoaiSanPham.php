<?php
include("Connection.php");

$id_loai = $_GET["id"];

// Truy vấn để lấy thông tin khách hàng từ CSDL
$sql = "SELECT * FROM loai_san_pham WHERE id_loai = :id_loai";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_loai', $id_loai);
$stmt->execute();
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra xem biểu mẫu đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $ten_loai = $_POST["ten_loai"];
    $hinh = $_POST["hinh"];
    

    // Cập nhật thông tin khách hàng trong CSDL
    $sql = "UPDATE loai_san_pham SET ten_loai = :ten_loai, hinh = :hinh WHERE id_loai = :id_loai";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_loai', $id_loai);
    $stmt->bindParam(':ten_loai', $ten_loai);
    $stmt->bindParam(':hinh', $hinh);
    

    if ($stmt->execute()) {
        // Chuyển hướng đến trang danh sách khách hàng sau khi cập nhật thành công
        header("Location: LoaiSanPhamAdmin.php");
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
    <h2 class="text-center">TRANG CẬP NHẬT THÔNG TIN LOẠI SẢN PHẨM</h2>
    <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id_loai; ?>" class="form" method="post">
            <div class="form-group row">
                <label for="ten_khach_hang" class="col-sm-2 col-form-label">Tên loại:</label>
                <div class="col-sm-10">
                    <input type="text" id="ten_khach_hang" name="ten_loai" value="<?php echo $customer['ten_loai']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="ngay_sinh" class="col-sm-2 col-form-label">Hình:</label>
                <div class="col-sm-10">
                    <input type="file" id="ngay_sinh" name="hinh" value="<?php echo $customer['hinh']; ?>" class="form-control" required>
                </div>
            </div>

            
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Cập nhật thông tin loại sản phẩm</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
