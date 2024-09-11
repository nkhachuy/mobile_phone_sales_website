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
// Kết nối CSDL
include("Connection.php");

$id_san_pham = $_GET["id"];

// Truy vấn để lấy thông tin sản phẩm từ CSDL
$sql = "SELECT * FROM san_pham WHERE id_san_pham = :id_san_pham";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_san_pham', $id_san_pham);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);


// Kiểm tra xem biểu mẫu đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $id_san_pham = $_POST["id_san_pham"];
    $ten_san_pham = $_POST["ten_san_pham"];
    $hinh = $_POST["hinh"]; // Cần xử lý hình ảnh ở đây, nếu có
    $don_gia = $_POST["don_gia"];
    $man_hinh = $_POST["man_hinh"];
    $he_dieu_hanh = $_POST["he_dieu_hanh"];
    $camera_sau = $_POST["camera_sau"];
    $camera_truoc = $_POST["camera_truoc"];
    $chip = $_POST["chip"];
    $ram = $_POST["ram"];
    $dung_luong_luu_tru = $_POST["dung_luong_luu_tru"];
    $sim = $_POST["sim"];
    $pin_sac = $_POST["pin_sac"];
    $hang = $_POST["hang"];
    $id_loai = $_POST["id_loai"];

    // Cập nhật sản phẩm trong CSDL
    $sql = "UPDATE san_pham SET ten_san_pham = :ten_san_pham, hinh = :hinh, don_gia = :don_gia, man_hinh = :man_hinh, he_dieu_hanh = :he_dieu_hanh, camera_sau = :camera_sau, camera_truoc = :camera_truoc, chip = :chip, ram = :ram, dung_luong_luu_tru = :dung_luong_luu_tru, sim = :sim, pin_sac = :pin_sac, hang = :hang, id_loai = :id_loai WHERE id_san_pham = :id_san_pham";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_san_pham', $id_san_pham);
    $stmt->bindParam(':ten_san_pham', $ten_san_pham);
    $stmt->bindParam(':hinh', $hinh);
    $stmt->bindParam(':don_gia', $don_gia);
    $stmt->bindParam(':man_hinh', $man_hinh);
    $stmt->bindParam(':he_dieu_hanh', $he_dieu_hanh);
    $stmt->bindParam(':camera_sau', $camera_sau);
    $stmt->bindParam(':camera_truoc', $camera_truoc);
    $stmt->bindParam(':chip', $chip);
    $stmt->bindParam(':ram', $ram);
    $stmt->bindParam(':dung_luong_luu_tru', $dung_luong_luu_tru);
    $stmt->bindParam(':sim', $sim);
    $stmt->bindParam(':pin_sac', $pin_sac);
    $stmt->bindParam(':hang', $hang);
    $stmt->bindParam(':id_loai', $id_loai);

    if ($stmt->execute()) {
        // Redirect đến trang khác hoặc hiển thị thông báo cập nhật thành công
        header("location: SanPhamAdmin.php"); // Chuyển hướng đến trang danh_sach_san_pham.php sau khi cập nhật
        exit();
    } else {
        echo "Có lỗi xảy ra. Vui lòng thử lại sau.";
    }
}
?>


<body>
    <?php
    include("adminHeader.php");
    include("sidebar.php");
    ?>
    <h2 class="text-center">TRANG THÊM SẢN PHẨM</h2>
    <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="post">
            <input type="hidden" name="id_san_pham" value="<?php echo $product['id_san_pham']; ?>">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Tên sản phẩm:</label>
                <div class="col-sm-10">
                    <input type="text" id="name" name="ten_san_pham" value="<?php echo $product['ten_san_pham'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Hình ảnh:</label>
                <div class="col-sm-10">
                    <input type="file" id="image" name="hinh" value="<?php echo $product['hinh'] ?>" class="form-control-file" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Giá:</label>
                <div class="col-sm-10">
                    <input type="text" id="price" name="don_gia" value="<?php echo $product['don_gia'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Màn hình:</label>
                <div class="col-sm-10">
                    <input type="text" id="" name="man_hinh" value="<?php echo $product['man_hinh'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Hệ điều hành:</label>
                <div class="col-sm-10">
                    <input type="text" id="" name="he_dieu_hanh" value="<?php echo $product['he_dieu_hanh'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Camera sau:</label>
                <div class="col-sm-10">
                    <input type="text" id="" name="camera_sau" value="<?php echo $product['camera_sau'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Camera trước:</label>
                <div class="col-sm-10">
                    <input type="text" id="" name="camera_truoc" value="<?php echo $product['camera_truoc'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Chip:</label>
                <div class="col-sm-10">
                    <input type="text" id="" name="chip" value="<?php echo $product['chip'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Ram:</label>
                <div class="col-sm-10">
                    <input type="text" id="" name="ram" value="<?php echo $product['ram'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Dung lượng lưu trữ:</label>
                <div class="col-sm-10">
                    <input type="text" id="" name="dung_luong_luu_tru" value="<?php echo $product['dung_luong_luu_tru'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Sim:</label>
                <div class="col-sm-10">
                    <input type="text" id="" name="sim" value="<?php echo $product['sim'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Pin, sạc:</label>
                <div class="col-sm-10">
                    <input type="text" id="" name="pin_sac" value="<?php echo $product['pin_sac'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Hãng:</label>
                <div class="col-sm-10">
                    <input type="text" id="" name="hang" value="<?php echo $product['hang'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="product_type" class="col-sm-2 col-form-label">Loại sản phẩm:</label>
                <div class="col-sm-10">
                    <select id="product_type" name="id_loai" class="form-control" required>
                        <?php
                        // Kết nối CSDL và truy vấn để lấy dữ liệu từ bảng loai_san_pham
                        include("Connection.php");
                        $sql = "SELECT * FROM loai_san_pham";
                        $stmt = $pdo->query($sql);
                        // Duyệt qua các hàng kết quả và tạo các tùy chọn trong select
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // Kiểm tra xem id_loai của loại sản phẩm hiện tại có trùng với id_loai của sản phẩm đang được chỉnh sửa không
                            $selected = ($row['id_loai'] == $product['id_loai']) ? "selected" : "";
                            echo "<option value='" . $row['id_loai'] . "' $selected>" . $row['ten_loai'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>


            <!-- Các trường thông tin khác của sản phẩm -->

            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
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