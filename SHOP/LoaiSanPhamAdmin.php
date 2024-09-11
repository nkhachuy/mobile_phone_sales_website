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
$sql = "SELECT * FROM loai_san_pham";
$sta = $pdo->prepare($sql);
$sta->execute();

if ($sta->rowCount() > 0) {
    $loai_san_pham = $sta->fetchAll(PDO::FETCH_OBJ);
}

$p = new Pager();
$limit = 10;
$count = count($loai_san_pham);
$vt = $p->findStart($limit);
$pages = $p->findPages($count, $limit);

$cur = $_GET["page"];
$phantrang = $p->pageList($cur, $pages);

$sql = "SELECT * FROM loai_san_pham LIMIT $vt, $limit";
$sta = $pdo->prepare($sql);
$sta->execute();
$loai_san_pham = $sta->fetchAll(PDO::FETCH_OBJ);

$id_loai = isset($_GET["id"]) ? $_GET["id"] : null;


// Truy vấn để lấy thông tin sản phẩm từ CSDL
$sql = "SELECT * FROM loai_san_pham WHERE id_loai = :id_loai";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_loai', $id_loai);
$stmt->execute();
$khach_hang1 = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra xem nút "Xóa sản phẩm" đã được nhấn chưa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Lấy id sản phẩm cần xóa
    $id_loai = $_POST["id_loai"];

    // Truy vấn SQL để xóa sản phẩm
    $sql_delete = "DELETE FROM loai_san_pham WHERE id_loai = :id_loai";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':id_loai', $id_loai);

    // Thực thi truy vấn
    if ($stmt_delete->execute()) {
        // Xóa sản phẩm thành công, chuyển hướng người dùng đến trang khác hoặc hiển thị thông báo
        header("location: LoaiSanPhamAdmin.php");
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

        <h2 align="center">TRANG QUẢN LÝ KHÁCH HÀNG</h2>
        <button class="btn btn-primary my-2" type="submit"><a class="text-light" href="ThemLoaiSanPham.php">Thêm mới</a> </button>
        <table class="table table-bordered">
            <thead>
                <th style="color: black;">ID</th>
                <th style="color: black;">Tên loại</th>
                <th style="color: black;">Hình</th>
                <th colspan="2" style="color: black;">CRUD</th>                
            </thead>
            <tbody>
                <?php
                foreach ($loai_san_pham as $lsp) {
                ?>
                    <tr>
                        <td><?php echo $lsp->id_loai ?></td>
                        <td><?php echo $lsp->ten_loai ?></td>
                        <td><img src="./Images_Logo/<?php echo $lsp->hinh ?>" alt="" width="50px"></td>                      
                        <td>
                            <button class="btn btn-success" type="submit">
                                <a href="CapNhatLoaiSanPham.php?id=<?php echo $lsp->id_loai ?>" class="text-light">Cập nhật</a>
                            </button>
                        </td>
                        <td>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="id_loai" value="<?php echo $lsp->id_loai ?>">
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