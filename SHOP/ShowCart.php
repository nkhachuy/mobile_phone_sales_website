<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/footer.css">
    <link rel="stylesheet" href="./CSS/Cart.css">
</head>
<?php
session_start();


if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if (isset($_GET['emptyCart']) && ($_GET['emptyCart'] == 1)) unset($_SESSION['cart']);

if (isset($_GET['delId']) && ($_GET['delId'] >= 0)) {
    array_splice($_SESSION['cart'], $_GET['delId'], 1);
}

if (isset($_POST['update_cart']) && isset($_POST['num_sl']) && isset($_POST['updateId'])) {
    $updateId = $_POST['updateId'];
    $num_sl = $_POST['num_sl'];
    if (isset($_SESSION['cart'][$updateId])) {
        $_SESSION['cart'][$updateId]['sl'] = $num_sl;
    }
}

if (isset($_POST['add_to_cart']) && ($_POST['add_to_cart'])) {
    $id_san_pham = $_POST['id_san_pham'];
    $ten_san_pham = $_POST['ten_san_pham'];
    $hinh = $_POST['hinh'];
    $don_gia = $_POST['don_gia'];
    $sl = $_POST['sl'];

    $flag = 0;
    $count = count($_SESSION['cart']);
    for ($i = 0; $i < $count; $i++) {
        $item = $_SESSION['cart'][$i];
        if ($item["id_san_pham"] == $id_san_pham) {
            $flag = 1;
            $sl_new = $sl + $item["sl"];
            $item["sl"] = $sl_new;
            $_SESSION['cart'][$i] = $item;
            break;
        }
    }

    if ($flag == 0) {
        $sp = array(
            'id_san_pham' => $id_san_pham,
            'ten_san_pham' => $ten_san_pham,
            'hinh' => $hinh,
            'don_gia' => $don_gia,
            'sl' => $sl,
        );
        $_SESSION['cart'][] = $sp;
    }
}
?>

<body>
    <?php include("Header.php"); 
    ?>
    <div class="container">
        <h2 class="text-center text-danger mt-4">THÔNG TIN GIỎ HÀNG CỦA BẠN</h2>
        <?php if (empty($_SESSION['cart'])) { ?>
            <div class="alert alert-info text-center">
                <p>Bạn chưa có sản phẩm nào trong giỏ hàng!</p>
            </div>
        <?php } else { ?>
            <table class="table cart-table">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Hình</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalCounter = 0;
                    $itemCounter = 0;
                    $count = count($_SESSION['cart']);
                    for ($i = 0; $i < $count; $i++) {
                        $item = $_SESSION['cart'][$i];
                        $imgUrl = "./Image_SanPham" . "/" . $item["hinh"];
                        $total = (double)$item["don_gia"] * (int)$item["sl"];
                        $totalCounter += $total;
                        $itemCounter += $item["sl"];
                    ?>
                        <tr>
                            <td>
                            <?php echo $item['ten_san_pham']; ?>
                                
                            </td>
                            <td>
                            <img src="<?php echo $imgUrl; ?>" class="rounded img-thumbnail">
                                
                                
                            </td>
                            
                            <td><?php echo number_format($item['don_gia'], 0, ',', '.') ?></td>
                            <td>
                                <form action="ShowCart.php" method="post" class="form-inline">
                                    <input type="hidden" name="updateId" value="<?php echo $i ?>">
                                    <input type="number" name="num_sl" class="form-control cart-qty-single" value="<?php echo $item['sl']; ?>" min="1" max="1000">
                                    <button type="submit" class="btn btn-link text-primary p-0" name="update_cart">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </form>
                            </td>
                            
                            <td><?php echo number_format($total, 0, ',', '.') ?></td>
                            <td><a href="ShowCart.php?delId=<?php echo $i ?>" class="text-danger ml-2">
                                    <i class="fas fa-trash-alt"></i>
                                </a></td>
                        </tr>
                    <?php } ?>
                    <tr class="border-top">
                        <td><a class="btn btn-danger btn-sm" href="ShowCart.php?emptyCart=1">Xóa tất cả</a></td>
                        <td></td>
                        <td></td>
                        <td class="cart-summary" style="color: red; font-weight: bold;"><?php echo $itemCounter; ?> sản phẩm</td>
                        <td class="cart-summary total" style="color: red; font-weight: bold;"><?php echo number_format($totalCounter, 0, ',', '.')?> VNĐ</td>
                    </tr>
                </tbody>
            </table>
            <div class="cart-actions">
                <a href="Checkout.php" class="btn btn-primary btn-lg">Thanh toán</a>
            </div>
        <?php } ?>
    </div>
    <?php include("Footer.php"); ?>
</body>

</html>
