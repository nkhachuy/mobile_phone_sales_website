<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    </link>
    <link rel="stylesheet" href="./CSS/Page.css">

</head>
<?php
include("Connection.php");
include("Pager.php");
$sql = "SELECT * FROM san_pham";
$sta = $pdo->prepare($sql);
$sta->execute();

if ($sta->rowCount() > 0) {
    $san_pham = $sta->fetchAll(PDO::FETCH_OBJ);
}

$p = new Pager();
$limit = 10;
$count = count($san_pham);
$vt = $p->findStart($limit);
$pages = $p->findPages($count, $limit);

$cur = $_GET["page"];
$phantrang = $p->pageList($cur, $pages);

$sql = "SELECT * FROM san_pham LIMIT $vt, $limit";
$sta = $pdo->prepare($sql);
$sta->execute();
$san_pham = $sta->fetchAll(PDO::FETCH_OBJ);

$id_san_pham = isset($_GET["id"]) ? $_GET["id"] : null;


// Truy vấn để lấy thông tin sản phẩm từ CSDL
$sql = "SELECT * FROM san_pham WHERE id_san_pham = :id_san_pham";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_san_pham', $id_san_pham);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra xem nút "Xóa sản phẩm" đã được nhấn chưa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    // Lấy id sản phẩm cần xóa
    $id_san_pham_to_delete = $_POST["id_san_pham"];

    // Truy vấn SQL để xóa sản phẩm
    $sql_delete = "DELETE FROM san_pham WHERE id_san_pham = :id_san_pham";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':id_san_pham', $id_san_pham_to_delete);

    // Thực thi truy vấn
    if ($stmt_delete->execute()) {
        // Xóa sản phẩm thành công, chuyển hướng người dùng đến trang khác hoặc hiển thị thông báo
        header("location: SanPhamAdmin.php");
        exit();
    } else {
        echo "Có lỗi xảy ra khi xóa sản phẩm. Vui lòng thử lại sau.";
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
                <h2 align="center">TRANG QUẢN LÝ SẢN PHẨM</h2>
                <button class="btn btn-primary my-2" type="submit"><a class="text-light" href="ThemSanPham.php">Thêm mới</a> </button>
                <table class="table table-bordered table-responsive">
                    <thead>
                        <th style="color: black;">ID</th>
                        <th style="color: black;">Tên sản phẩm</th>
                        <th style="color: black;">Hình</th>
                        <th style="color: black;">Giá</th>
                        <th style="color: black;">Màn hình</th>
                        <th style="color: black;">Hệ điều hành</th>
                        <th style="color: black;">Camera sau</th>
                        <th style="color: black;">Camera trước</th>
                        <th style="color: black;">Chip</th>
                        <th style="color: black;">Ram</th>
                        <th style="color: black;">Dung lượng</th>
                        <th style="color: black;">Sim</th>
                        <th style="color: black;">Pin, sạc</th>
                        <th style="color: black;">Hãng</th>
                        <th style="color: black;">ID Loại</th>
                        <th colspan="2" style="color: black;">CRUD</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($san_pham as $sp) {
                        ?>
                            <tr>
                                <td><?php echo $sp->id_san_pham ?></td>
                                <td><?php echo $sp->ten_san_pham ?></td>
                                <td><img src="./Image_SanPham/<?php echo $sp->hinh ?>" alt="" width="50px"></td>
                                <td><?php echo $sp->don_gia ?></td>
                                <td><?php echo $sp->man_hinh ?></td>
                                <td><?php echo $sp->he_dieu_hanh ?></td>
                                <td><?php echo $sp->camera_sau ?></td>
                                <td><?php echo $sp->camera_truoc ?></td>
                                <td><?php echo $sp->chip ?></td>
                                <td><?php echo $sp->ram ?></td>
                                <td><?php echo $sp->dung_luong_luu_tru ?></td>
                                <td><?php echo $sp->sim ?></td>
                                <td><?php echo $sp->pin_sac ?></td>
                                <td><?php echo $sp->hang ?></td>
                                <td><?php echo $sp->id_loai ?></td>
                                <td>
                                    <button class="btn btn-success" type="submit">
                                        <a href="CapNhatSanPham.php?id=<?php echo $sp->id_san_pham ?>" class="text-light">Cập nhật</a>
                                    </button>
                                </td>
                                <td>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <input type="hidden" name="id_san_pham" value="<?php echo $sp->id_san_pham ?>">
                                        <button class="btn btn-danger" type="submit" name="delete_product">Xóa</button>
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