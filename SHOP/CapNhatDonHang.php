<?php
include("Connection.php");

$sql_products = "SELECT id_san_pham, ten_san_pham, don_gia FROM san_pham";
$stmt_products = $pdo->prepare($sql_products);
$stmt_products->execute();
$products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);

$id_hoa_don = $_GET["id"];

// Truy vấn để lấy thông tin đơn hàng và chi tiết đơn hàng từ CSDL
$sql = "SELECT hd.*, cthd.id_san_pham, cthd.so_luong, cthd.don_gia, cthd.thanh_tien 
        FROM hoa_don hd 
        JOIN chi_tiet_hoa_don cthd ON hd.id_hoa_don = cthd.id_hoa_don
        WHERE hd.id_hoa_don = :id_hoa_don";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_hoa_don', $id_hoa_don);
$stmt->execute();
$order = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra xem biểu mẫu đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $ngay_dat_hang = $_POST["ngay_dat_hang"];
    $ngay_giao_hang = $_POST["ngay_giao_hang"];
    $tinh_trang_thanh_toan = $_POST["tinh_trang_thanh_toan"];
    $phuong_thuc_thanh_toan = $_POST["phuong_thuc_thanh_toan"];
    $tinh_trang_giao_hang = $_POST["tinh_trang_giao_hang"];
    $tong_tien = $_POST["tong_tien"];
    $id_san_pham = $_POST["id_san_pham"];
    $so_luong = $_POST["so_luong"];
    $don_gia = $_POST["don_gia"];
    $thanh_tien = $_POST["thanh_tien"];

    // Cập nhật thông tin đơn hàng trong CSDL
    $sql = "UPDATE hoa_don SET ngay_dat_hang = :ngay_dat_hang, ngay_giao_hang = :ngay_giao_hang, tinh_trang_thanh_toan = :tinh_trang_thanh_toan, phuong_thuc_thanh_toan = :phuong_thuc_thanh_toan, tinh_trang_giao_hang = :tinh_trang_giao_hang, tong_tien = :tong_tien WHERE id_hoa_don = :id_hoa_don";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_hoa_don', $id_hoa_don);
    $stmt->bindParam(':ngay_dat_hang', $ngay_dat_hang);
    $stmt->bindParam(':ngay_giao_hang', $ngay_giao_hang);
    $stmt->bindParam(':tinh_trang_thanh_toan', $tinh_trang_thanh_toan);
    $stmt->bindParam(':phuong_thuc_thanh_toan', $phuong_thuc_thanh_toan);
    $stmt->bindParam(':tinh_trang_giao_hang', $tinh_trang_giao_hang);
    $stmt->bindParam(':tong_tien', $tong_tien);

    $order_updated = $stmt->execute();

    // Kiểm tra xem id_san_pham và id_hoa_don có tồn tại trong chi_tiet_hoa_don không
    $sql_check = "SELECT COUNT(*) FROM chi_tiet_hoa_don WHERE id_hoa_don = :id_hoa_don AND id_san_pham = :id_san_pham";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindParam(':id_hoa_don', $id_hoa_don);
    $stmt_check->bindParam(':id_san_pham', $id_san_pham);
    $stmt_check->execute();
    $count = $stmt_check->fetchColumn();

    if ($count == 0) {
        // Thêm chi tiết đơn hàng mới vào CSDL
        $sql = "INSERT INTO chi_tiet_hoa_don (id_hoa_don, id_san_pham, so_luong, don_gia, thanh_tien) VALUES (:id_hoa_don, :id_san_pham, :so_luong, :don_gia, :thanh_tien)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_hoa_don', $id_hoa_don);
        $stmt->bindParam(':id_san_pham', $id_san_pham);
        $stmt->bindParam(':so_luong', $so_luong);
        $stmt->bindParam(':don_gia', $don_gia);
        $stmt->bindParam(':thanh_tien', $thanh_tien);
        $detail_updated = $stmt->execute();
    } else {
        // Cập nhật chi tiết đơn hàng hiện có trong CSDL
        $sql = "UPDATE chi_tiet_hoa_don SET so_luong = :so_luong, don_gia = :don_gia, thanh_tien = :thanh_tien WHERE id_hoa_don = :id_hoa_don AND id_san_pham = :id_san_pham";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_hoa_don', $id_hoa_don);
        $stmt->bindParam(':id_san_pham', $id_san_pham);
        $stmt->bindParam(':so_luong', $so_luong);
        $stmt->bindParam(':don_gia', $don_gia);
        $stmt->bindParam(':thanh_tien', $thanh_tien);
        $detail_updated = $stmt->execute();
    }

    if ($order_updated && $detail_updated) {
        // Chuyển hướng đến trang danh sách đơn hàng sau khi cập nhật thành công
        header("Location: DonHangAdmin.php");
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
    <title>Cập Nhật Đơn Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php
    include("adminHeader.php");
    include("sidebar.php");
    ?>
    <h2 class="text-center">TRANG CẬP NHẬT ĐƠN HÀNG</h2>
    <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id_hoa_don; ?>" class="form" method="post">
            <div class="form-group row">
                <label for="ngay_dat_hang" class="col-sm-2 col-form-label">Ngày Đặt Hàng:</label>
                <div class="col-sm-10">
                    <input type="date" id="ngay_dat_hang" name="ngay_dat_hang" value="<?php echo $order['ngay_dat_hang']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="ngay_giao_hang" class="col-sm-2 col-form-label">Ngày Giao Hàng:</label>
                <div class="col-sm-10">
                    <input type="date" id="ngay_giao_hang" name="ngay_giao_hang" value="<?php echo $order['ngay_giao_hang']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="tinh_trang_thanh_toan" class="col-sm-2 col-form-label">Tình Trạng Thanh Toán:</label>
                <div class="col-sm-10">
                    <select id="tinh_trang_thanh_toan" name="tinh_trang_thanh_toan" class="form-control" required>
                        <option value="Đã thanh toán" <?php if ($order['tinh_trang_thanh_toan'] == 'Đã thanh toán') echo 'selected'; ?>>Đã thanh toán</option>
                        <option value="Chưa thanh toán" <?php if ($order['tinh_trang_thanh_toan'] == 'Chưa thanh toán') echo 'selected'; ?>>Chưa thanh toán</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="phuong_thuc_thanh_toan" class="col-sm-2 col-form-label">Phương Thức Thanh Toán:</label>
                <div class="col-sm-10">
                    <select id="phuong_thuc_thanh_toan" name="phuong_thuc_thanh_toan" class="form-control" required>
                        <option value="Tiền mặt" <?php if ($order['phuong_thuc_thanh_toan'] == 'Tiền mặt') echo 'selected'; ?>>Tiền mặt</option>
                        <option value="Chuyển khoản" <?php if ($order['phuong_thuc_thanh_toan'] == 'Chuyển khoản') echo 'selected'; ?>>Chuyển khoản</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="tinh_trang_giao_hang" class="col-sm-2 col-form-label">Tình Trạng Giao Hàng:</label>
                <div class="col-sm-10">
                    <select id="tinh_trang_giao_hang" name="tinh_trang_giao_hang" class="form-control" required>
                        <option value="Đã giao" <?php if ($order['tinh_trang_giao_hang'] == 'Đã giao') echo 'selected'; ?>>Đã giao</option>
                        <option value="Chưa giao" <?php if ($order['tinh_trang_giao_hang'] == 'Chưa giao') echo 'selected'; ?>>Chưa giao</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="tong_tien" class="col-sm-2 col-form-label">Tổng Tiền:</label>
                <div class="col-sm-10">
                    <input type="text" id="tong_tien" name="tong_tien" value="<?php echo $order['tong_tien']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="id_san_pham" class="col-sm-2 col-form-label">ID Sản Phẩm:</label>
                <div class="col-sm-10">
                    <select id="id_san_pham" name="id_san_pham" class="form-control" required>
                        <?php foreach ($products as $product) { ?>
                            <option value="<?php echo $product['id_san_pham']; ?>" data-don-gia="<?php echo $product['don_gia']; ?>" <?php if ($order['id_san_pham'] == $product['id_san_pham']) echo 'selected'; ?>>
                                <?php echo $product['ten_san_pham']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="so_luong" class="col-sm-2 col-form-label">Số Lượng:</label>
                <div class="col-sm-10">
                    <input type="number" id="so_luong" name="so_luong" value="<?php echo $order['so_luong']; ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="don_gia" class="col-sm-2 col-form-label">Đơn Giá:</label>
                <div class="col-sm-10">
                    <input type="text" id="don_gia" name="don_gia" value="<?php echo $order['don_gia']; ?>" class="form-control" readonly required>
                </div>
            </div>

            <div class="form-group row">
                <label for="thanh_tien" class="col-sm-2 col-form-label">Thành Tiền:</label>
                <div class="col-sm-10">
                    <input type="text" id="thanh_tien" name="thanh_tien" value="<?php echo $order['thanh_tien']; ?>" class="form-control" readonly required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Cập nhật đơn hàng</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            function updatePrice() {
                const donGia = parseFloat($("#id_san_pham option:selected").data("don-gia"));
                const soLuong = parseFloat($("#so_luong").val());
                $("#don_gia").val(donGia);
                $("#thanh_tien").val(donGia * soLuong);
            }

            $("#id_san_pham").change(updatePrice);
            $("#so_luong").on("input", updatePrice);

            // Trigger price update on page load
            updatePrice();
        });
    </script>
</body>

</html>
