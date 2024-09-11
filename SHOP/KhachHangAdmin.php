<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./CSS/Page.css">
</head>

<?php
include("Connection.php");
include("Pager.php");

// Fetch all customers
$sql = "SELECT * FROM khach_hang";
$sta = $pdo->prepare($sql);
$sta->execute();

if ($sta->rowCount() > 0) {
    $khach_hang = $sta->fetchAll(PDO::FETCH_OBJ);
}

// Pagination setup
$p = new Pager();
$limit = 10;
$count = count($khach_hang);
$vt = $p->findStart($limit);
$pages = $p->findPages($count, $limit);

$cur = isset($_GET["page"]) ? $_GET["page"] : 1;
$phantrang = $p->pageList($cur, $pages);

// Fetch customers for current page
$sql = "SELECT * FROM khach_hang LIMIT :vt, :limit";
$sta = $pdo->prepare($sql);
$sta->bindValue(':vt', $vt, PDO::PARAM_INT);
$sta->bindValue(':limit', $limit, PDO::PARAM_INT);
$sta->execute();
$khach_hang = $sta->fetchAll(PDO::FETCH_OBJ);

// Get customer ID from query string
$id_khach_hang = isset($_GET["id"]) ? $_GET["id"] : null;

// Fetch customer details if ID is set
if ($id_khach_hang) {
    $sql = "SELECT * FROM khach_hang WHERE id_khach_hang = :id_khach_hang";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_khach_hang', $id_khach_hang);
    $stmt->execute();
    $khach_hang1 = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id_khach_hang_to_delete = $_POST["id_khach_hang"];

    $sql_delete = "DELETE FROM khach_hang WHERE id_khach_hang = :id_khach_hang";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':id_khach_hang', $id_khach_hang_to_delete);

    if ($stmt_delete->execute()) {
        header("Location: KhachHangAdmin.php");
        exit();
    } else {
        echo "Có lỗi xảy ra khi xóa sản phẩm. Vui lòng thử lại sau.";
    }
}

$pdo = null;
?>

<body>
    <?php
    include("adminHeader.php");
    include("sidebar.php");
    ?>
    <div class="container-fluid">
        <h2 align="center">TRANG QUẢN LÝ KHÁCH HÀNG</h2>
        <button class="btn btn-primary my-2" type="submit">
            <a class="text-light" href="ThemKhachHang.php">Thêm mới</a>
        </button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="color: black;">ID</th>
                    <th style="color: black;">Tên khách hàng</th>
                    <th style="color: black;">Ngày sinh</th>
                    <th style="color: black;">Địa chỉ</th>
                    <th style="color: black;">Điện thoại</th>
                    <th style="color: black;">Email</th>
                    <th style="color: black;">Tài khoản</th>
                    <th style="color: black;">Mật khẩu</th>
                    <th colspan="2" style="color: black;">CRUD</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($khach_hang as $kh) {
                ?>
                    <tr>
                        <td><?php echo $kh->id_khach_hang ?></td>
                        <td><?php echo $kh->ten_khach_hang ?></td>
                        <td><?php echo $kh->ngay_sinh ?></td>
                        <td><?php echo $kh->dia_chi ?></td>
                        <td><?php echo $kh->dien_thoai ?></td>
                        <td><?php echo $kh->email ?></td>
                        <td><?php echo $kh->tai_khoan ?></td>
                        <td><?php echo $kh->mat_khau ?></td>
                        <td>
                            <button class="btn btn-success" type="submit">
                                <a href="CapNhatKhachHang.php?id=<?php echo $kh->id_khach_hang ?>" class="text-light">Cập nhật</a>
                            </button>
                        </td>
                        <td>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="id_khach_hang" value="<?php echo $kh->id_khach_hang ?>">
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
