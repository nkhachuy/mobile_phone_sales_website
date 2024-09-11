<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./CSS/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./JS/javascript.js">
    <link rel="stylesheet" href="./CSS/Page.css">
    <title>Document</title>
</head>
<?php
session_start();
include("Connection.php");
include("Pager.php");

$limit = 10;
$p = new Pager();
$cur = isset($_GET["page"]) ? $_GET["page"] : 1;
$vt = $p->findStart($limit);

$sql = "SELECT * FROM san_pham";
if (isset($_GET['ml']) && $_GET['ml'] != 0) {
    $ml = $_GET['ml'];
    $sql .= " WHERE id_loai = :ml";
} 

$sta = $pdo->prepare($sql);
if (isset($ml) && $ml != 0) {
    $sta->bindParam(':ml', $ml, PDO::PARAM_INT);
} 
$sta->execute();
$san_pham = $sta->fetchAll(PDO::FETCH_OBJ);
$count = count($san_pham);

// Pagination calculations
$pages = $p->findPages($count, $limit);
$phantrang = $p->pageList($cur, $pages);

// Adjust the query to get products for the current page
$sql .= " LIMIT :vt, :limit";
$sta = $pdo->prepare($sql);
if (isset($ml) && $ml != 0) {
    $sta->bindParam(':ml', $ml, PDO::PARAM_INT);
}
$sta->bindParam(':vt', $vt, PDO::PARAM_INT);
$sta->bindParam(':limit', $limit, PDO::PARAM_INT);
$sta->execute();
$san_pham_trang_hien_tai = $sta->fetchAll(PDO::FETCH_OBJ);

// Fetch product categories
$sql1 = "SELECT * FROM loai_san_pham";
$sta1 = $pdo->prepare($sql1);
$sta1->execute();
$loai_san_pham = $sta1->fetchAll(PDO::FETCH_OBJ);

$pdo = NULL;
?>

<body>
    <?php
    include("Header.php");
    include("Menu.php");
    ?>
    <section class="main_content">
        <section class="slider">
            <div class="container_slider">
                <div class="slider_content">
                    <div class="slider_content_left">
                        <div class="container_left_top">
                            <div class="slider_content_left_top">
                                <a href="#"><img src="./Images_Logo/slider1.webp" alt=""></a>
                                <a href="#"><img src="./Images_Logo/slider2.webp" alt=""></a>
                                <a href="#"><img src="./Images_Logo/slider3.webp" alt=""></a>
                                <a href="#"><img src="./Images_Logo/slider4.webp" alt=""></a>
                            </div>
                            <div class="btn_chevron">
                                <i class="fas fa-chevron-left"></i>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                        <div class="slider_content_left_bottom">
                            <li class="active"><a href="#">Đổi 2G lên Smartphone 4G</a></li>
                            <li><a href="#">Đồng hồ giá sốc</a></li>
                            <li><a href="#">Giảm từ 25% Từ 12.29 triệu</a></li>
                            <li><a href="#">Giảm đến 50%++</a></li>
                        </div>
                    </div>
                    <div class="slider_content_right">
                        <div class="img"><a href="#"><img src="./Images_Logo/img1.webp" alt=""></a></div>
                        <div class="img"><a href="#"><img src="./Images_Logo/img2.webp" alt=""></a></div>
                        <div class="img"><a href="#"><img src="./Images_Logo/img3.webp" alt=""></a></li>
                        </div>
                        <div class="img"><a href="#"><img src="./Images_Logo/img4.webp" alt=""></a></div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            
            <div class="menu_brand_products">
                <ul>
                    <?php
                    foreach ($loai_san_pham as $lsp) {
                    ?>
                        <li><a href="./SanPhamTheoLoai.php?ml=<?php echo $lsp->id_loai ?>"><img src="./Images_Logo/<?php echo $lsp->hinh ?>" alt=""></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="text_nhu_cau_mua">
                <p style="font-size: 14px;font-family: Arial, Helvetica, sans-serif;">Chọn điện thoại theo nhu cầu:</p>
            </div>
            <div class="menu_mua_theo_nhu_cau">
                <ul>
                    <li><a href="./SanPhamTheoGia.php">Dưới 2 triệu</a></li>
                    <li><a href="./SanPhamTheoGia.php?gt=2000000&gc=4000000">Từ 2 - 4 triệu</a></li>
                    <li><a href="./SanPhamTheoGia.php?gt=4000000&gc=7000000">Từ 4 - 7 triệu</a></li>
                    <li><a href="./SanPhamTheoGia.php?gt=7000000&gc=13000000">Từ 7 - 13 triệu</a></li>
                    <li><a href="./SanPhamTheoGia.php?gt=13000000&gc=20000000">Từ 13 - 20 triệu</a></li>
                    <li><a href="./SanPhamTheoGia.php?gt=20000000&gc=100000000">Trên 20 triệu</a></li>
                </ul>
            </div>
            <div class="menu_checkbox_locSP">
                <ul>
                    <li><strong><?php echo $count ?> điện thoại</strong></li>
                    <li><input type="checkbox" name="discount">Giảm giá</li>
                    <li><input type="checkbox" name="limit" id="limit">Sản phẩm đặc quyền</li>
                    <li><input type="checkbox" name="new" id="new">Mới</li>
                </ul>
            </div>
            <!--------San Pham-------->
            <section class="slider_products">
                <div class="container">
                    <div class="container_items">
                        <div class="container_main_products">
                            <div class="container_slider_main_products">
                                <div class="main_products">

                                    <?php
                                    
                                        foreach ($san_pham_trang_hien_tai as $sp) {
                                            ?>
                                                <div class="item_content">
                                                    <img src="./Image_SanPham/<?php echo $sp->hinh ?>" alt="">
                                                    <div class="item_text">
                                                        <li class="tro_gia"><img src="./Image_products/icon_2.jpg" alt="">
                                                            <p>Trợ giá hấp dẫn</p>
                                                        </li>
                                                        <li><a href="./ChiTietSanPham.php?id=<?php echo $sp->id_san_pham ?>">
                                                                <h3><?php echo $sp->ten_san_pham; ?></h3>
                                                            </a></li>
                                                        <div class="item-compare gray-bg">
                                                            <span><?php echo $sp->man_hinh ?></span>
                                                        </div>
                                                        <div class="dung_luong_iphone">
                                                            <ul>
                                                                <li><a href="#">256GB</a></li>
                                                                <li><a href="#">512GB</a></li>
                                                                <li><a href="#">1TB</a></li>
                                                            </ul>
                                                        </div>
                                                        <li><a href=""><del>29.590.000</del><sup>đ</sup></a><span>-10%</span></li>
                                                        <li><a href="#"><?php echo number_format($sp->don_gia, 0, ',', '.') ?> <sup>đ</sup></a></li>
                                                        <li>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </li>
                                                    </div>
                                                </div>
        
                                            <?php
                                        }                               

                                    
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </section>
            <div class="button_show_all">
                <!--<button name="show_all"><a href="#">Xem thêm kết quả</a></button> -->
                <div class="pagination"><?php echo $phantrang ?></div>

            </div>
        </section>
        <?php
        include("Footer.php");
        ?>
</body>

</html>