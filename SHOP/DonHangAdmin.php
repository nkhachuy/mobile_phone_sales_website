<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./CSS/Page.css">
</head>

<?php
include("Connection.php");
include("Pager.php");

// Initialize the $orders variable
$orders = [];

// Query to get the orders
$sql = "SELECT hd.*, cthd.id_san_pham, cthd.so_luong, cthd.don_gia, cthd.thanh_tien 
        FROM hoa_don hd 
        JOIN chi_tiet_hoa_don cthd ON hd.id_hoa_don = cthd.id_hoa_don";
$sta = $pdo->prepare($sql);
$sta->execute();

if ($sta->rowCount() > 0) {
    $orders = $sta->fetchAll(PDO::FETCH_OBJ);
}

// Handling pagination
$p = new Pager();
$limit = 10;
$count = count($orders);
$vt = $p->findStart($limit);
$pages = $p->findPages($count, $limit);

$cur = isset($_GET["page"]) ? $_GET["page"] : 1;
$phantrang = $p->pageList($cur, $pages);

// Query to get the paginated orders
$sql = "SELECT hd.*, cthd.id_san_pham, cthd.so_luong, cthd.don_gia, cthd.thanh_tien 
        FROM hoa_don hd 
        JOIN chi_tiet_hoa_don cthd ON hd.id_hoa_don = cthd.id_hoa_don
        LIMIT $vt, $limit";
$sta = $pdo->prepare($sql);
$sta->execute();
$orders = $sta->fetchAll(PDO::FETCH_OBJ);

// Handling delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id_hoa_don_to_delete = $_POST["id_hoa_don"];

    $sql = "DELETE FROM chi_tiet_hoa_don WHERE id_hoa_don = :id_hoa_don";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_hoa_don', $id_hoa_don_to_delete);
    $stmt->execute();

    $sql_delete = "DELETE FROM hoa_don WHERE id_hoa_don = :id_hoa_don";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':id_hoa_don', $id_hoa_don_to_delete);

    if ($stmt_delete->execute()) {
        header("location: DonHangAdmin.php");
        exit();
    } else {
        echo "Có lỗi xảy ra khi xóa đơn hàng. Vui lòng thử lại sau.";
    }
}

$pdo = NULL;
?>

<body>
    <?php
    include("adminHeader.php");
    include("sidebar.php");
    ?>
    <div class="container-fluid">
        <h2 align="center">TRANG QUẢN LÝ ĐƠN HÀNG</h2>
        <table class="table table-bordered table-responsive">
            <thead>
                <th style="color: black;">ID Hóa Đơn</th>
                <th style="color: black;">ID Khách Hàng</th>
                <th style="color: black;">Ngày Đặt Hàng</th>
                <th style="color: black;">Ngày Giao Hàng</th>
                <th style="color: black;">Tình Trạng Thanh Toán</th>
                <th style="color: black;">Phương Thức Thanh Toán</th>
                <th style="color: black;">Tình Trạng Giao Hàng</th>
                <th style="color: black;">Tổng Tiền</th>
                <th style="color: black;">ID Sản Phẩm</th>
                <th style="color: black;">Số Lượng</th>
                <th style="color: black;">Đơn Giá</th>
                <th style="color: black;">Thành Tiền</th>
                <th colspan="2" style="color: black;">CRUD</th>
            </thead>
            <tbody>
                <?php
                foreach ($orders as $order) {
                ?>
                    <tr>
                        <td><?php echo $order->id_hoa_don ?></td>
                        <td><?php echo $order->id_khach_hang ?></td>
                        <td><?php echo $order->ngay_dat_hang ?></td>
                        <td><?php echo $order->ngay_giao_hang ?></td>
                        <td><?php echo $order->tinh_trang_thanh_toan ?></td>
                        <td><?php echo $order->phuong_thuc_thanh_toan ?></td>
                        <td><?php echo $order->tinh_trang_giao_hang ?></td>
                        <td><?php echo $order->tong_tien ?></td>
                        <td><?php echo $order->id_san_pham ?></td>
                        <td><?php echo $order->so_luong ?></td>
                        <td><?php echo $order->don_gia ?></td>
                        <td><?php echo $order->thanh_tien ?></td>
                        <td>
                            <button class="btn btn-success" type="submit">
                                <a href="CapNhatDonHang.php?id=<?php echo $order->id_hoa_don ?>" class="text-light">Cập nhật</a>
                            </button>
                        </td>
                        <td>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="id_hoa_don" value="<?php echo $order->id_hoa_don ?>">
                                <button class="btn btn-danger" type="submit" name="delete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="pagination justify-content-center mb-3"><?php echo $phantrang ?></div>
    </div>
    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
