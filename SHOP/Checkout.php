<?php
session_start();
include("Connection.php");

$cartItemCount = count($_SESSION['cart'] ?? []); // Sử dụng null coalescing để tránh lỗi khi 'cart' không được thiết lập

if (isset($_POST['submit'])) {
    if (!empty($_POST['full_name']) && !empty($_POST['date']) && !empty($_POST['address']) && !empty($_POST['phone'])) {
        $fullName = $_POST['full_name'];
        $date = $_POST['date'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $submitType = $_POST['submit'];
        try {
            // Kiểm tra xem khách hàng đã tồn tại chưa
            $sql = 'SELECT count(*) AS count FROM khach_hang WHERE dien_thoai = :phone';
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':phone', $phone);
            $statement->execute();
            $kq = $statement->fetch(PDO::FETCH_ASSOC);
            $count = $kq['count'];

            if ($count == 0) {
                $sql1 = 'INSERT INTO khach_hang (ten_khach_hang, ngay_sinh, dia_chi, dien_thoai) VALUES (:fullName, :date, :address, :phone)';
                $statement = $pdo->prepare($sql1);
                $statement->bindParam(':fullName', $fullName);
                $statement->bindParam(':date', $date);
                $statement->bindParam(':address', $address);
                $statement->bindParam(':phone', $phone);
                $statement->execute();

                $getCustomerId = $pdo->lastInsertId();
            } else {
                $sql2 = 'SELECT * FROM khach_hang WHERE dien_thoai = :phone';
                $statement = $pdo->prepare($sql2);
                $statement->bindParam(':phone', $phone);
                $statement->execute();
                $kq = $statement->fetch(PDO::FETCH_ASSOC);
                $getCustomerId = $kq['id_khach_hang'];
            }

            // Chèn dữ liệu vào hóa đơn
            $MaKH = $getCustomerId;
            $NgayDat = date('Y-m-d');
            $NgayGiao = date('Y-m-d');
            $TinhTrangThanhToan = "Đã thanh toán";
            $PhuongThucThanhToan = "Tiền Mặt";
            $TinhTrangGiaoHang = "Chưa giao";
            $TongTien = $_SESSION['total'];
            unset($_SESSION['total']);

            $sql3 = 'INSERT INTO hoa_don (id_khach_hang, ngay_dat_hang, ngay_giao_hang, tinh_trang_thanh_toan, phuong_thuc_thanh_toan, tinh_trang_giao_hang, tong_tien) VALUES (:MaKH, :NgayDat, :NgayGiao, :TinhTrangThanhToan, :PhuongThucThanhToan, :TinhTrangGiaoHang, :TongTien)';
            $statement = $pdo->prepare($sql3);
            $statement->bindParam(':MaKH', $MaKH);
            $statement->bindParam(':NgayDat', $NgayDat);
            $statement->bindParam(':NgayGiao', $NgayGiao);
            $statement->bindParam(':TinhTrangThanhToan', $TinhTrangThanhToan);
            $statement->bindParam(':PhuongThucThanhToan', $PhuongThucThanhToan);
            $statement->bindParam(':TinhTrangGiaoHang', $TinhTrangGiaoHang);
            $statement->bindParam(':TongTien', $TongTien);
            $statement->execute();

            // Chèn dữ liệu vào chi tiết hóa đơn
            $getOrderId = $pdo->lastInsertId();
            foreach ($_SESSION['cart'] as $key => $item) {
                $id_san_pham = $item['id_san_pham'];
                $sl = $item['sl'];
                $donGia = $item['don_gia'];
                $thanhTien = $sl * $donGia;

                $sql4 = 'INSERT INTO chi_tiet_hoa_don (id_hoa_don, id_san_pham, so_luong, don_gia, thanh_tien) VALUES (:getOrderId, :id_san_pham, :sl, :donGia, :thanhTien)';
                $statement = $pdo->prepare($sql4);
                $statement->bindParam(':getOrderId', $getOrderId);
                $statement->bindParam(':id_san_pham', $id_san_pham);
                $statement->bindParam(':sl', $sl);
                $statement->bindParam(':donGia', $donGia);
                $statement->bindParam(':thanhTien', $thanhTien);
                $statement->execute();
            }

            // Giải phóng biến giỏ hàng
            unset($_SESSION['cart']);
            echo '<script>alert("Đặt hàng thành công!"); window.location.href="ThongBaoDH.php";</script>';
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    } else {
        echo '<script>alert("Vui lòng nhập đầy đủ thông tin!");</script>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Thông tin đơn hàng</title>

    <!--Bootstrap 4-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>
    <link rel="stylesheet" href="./CSS/products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./CSS/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./JS/javascript.js">
    <link rel="stylesheet" href="./CSS/Page.css">
</head>

<body>
    <?php include("Header.php"); ?>
    <div class="container">
        <div class="btn btn-primary" style="width:100%; height:100px;"></div>
        <h1 align="center" style="margin:20px;">THÔNG TIN ĐƠN HÀNG</h1>
        <div class="row mt-3">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Giỏ hàng</span>
                    <span class="badge badge-secondary badge-pill"><?php echo $cartItemCount; ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $key => $cartItem) {
                        $total += $cartItem['sl'] * $cartItem['don_gia'];
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $cartItem['ten_san_pham'] ?></h6>
                                <small class="text-muted">Số lượng: <?php echo $cartItem['sl'] ?> X Giá: <?php echo number_format($cartItem['don_gia'], 0, ',', '.') ?></small>
                            </div>
                            <span class="text-muted"><?php echo number_format(($cartItem['don_gia'] * $cartItem['sl']), 0, ',', '.') ?></span>
                        </li>
                    <?php
                    }
                    ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Tổng (VNĐ)</span>
                        <strong>
                            <?php echo number_format($_SESSION['total'] = $total, 0, ',', '.') ?>
                        </strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="fullName">Họ và tên</label>
                            <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Nhập họ và tên...">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="date">Ngày sinh</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>

                    <div class="mb-3">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ...">
                    </div>

                    <div class="mb-3">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại...">
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="submit">Tiếp tục thanh toán</button>                   
                </form>
                <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                          action="xulithanhtoanatm.php">
                          <input type="hidden" name="total_amount" value="<?php echo $_SESSION['total']; ?>">
                          <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Thanh toán ATM">Thanh toán ATM</button>
                    </form>
                <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                          action="xulithanhtoanmomo.php">
                          <input type="hidden" name="total_amount" value="<?php echo $_SESSION['total']; ?>">
                          <button class="btn btn-primary btn-lg btn-block" type="submit" name="momo" value="Thanh toán momo">Thanh toán momo</button>
                </form>
              
            </div>
        </div>
    </div>
    <?php include("Footer.php"); ?>
</body>

</html>
