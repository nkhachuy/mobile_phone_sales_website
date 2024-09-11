<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/footer.css">
    <link rel="stylesheet" href="./CSS/products.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Di Động Việt</title>
</head>
<?php
session_start();
include("Connection.php");
$sql = "SELECT * FROM san_pham ORDER BY id_san_pham LIMIT 5";
$sta = $pdo->prepare($sql);
$sta->execute();

if ($sta->rowCount() > 0) {
    $san_pham = $sta->fetchAll(PDO::FETCH_OBJ);
}
$pdo = NULL;
?>

<body>
    <?php
    include("Header.php");
    include("Menu.php");
    ?>

    <div class="banner">
        <a href="#"> <img src="./Images_Logo/Laptop-banner-big-desk-2-min-1920x450.webp" alt=""></a>
    </div>
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

                        <!-- <li><a href=""><img src="./Images_Logo/img2.webp" alt=""></a></li>
                            <li><a href=""><img src="./Images_Logo/img3.webp" alt=""></a></li>
                            <li><a href=""><img src="./Images_Logo/img4.webp" alt=""></a></li> -->
                        <div class="img"><a href="#"><img src="./Images_Logo/img1.webp" alt=""></a></div>
                        <div class="img"><a href="#"><img src="./Images_Logo/img2.webp" alt=""></a></div>
                        <div class="img"><a href="#"><img src="./Images_Logo/img3.webp" alt=""></a></li>
                        </div>
                        <div class="img"><a href="#"><img src="./Images_Logo/img4.webp" alt=""></a></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- -----------------------------------------BANNER MID----------------------------- -->
        <div class="banner_mid">
            <a href="#"><img src="./Images_Logo/logotop.webp" alt=""></a>
        </div>
        <!-- -----------------------------------------SLIDER PRODUCTS------------------------ -->
        <section class="slider_products">
            <div class="container">
                <section class="flash_sale_banner"><a href="#"><img src="./Images_Logo/flashsale.gif" alt=""></a>
            </div>
            <div class="container_items">
                <div class="container_main_products">
                    <div class="container_slider_main_products">
                        <div class="main_products">

                            <?php
                            foreach ($san_pham as $sp) {
                            ?>
                                <div class="item_content">
                                    <img src="./Image_SanPham/<?php echo $sp->hinh ?>" alt="">
                                    <div class="item_text">
                                        <li><img src="./Image_products/icon_2.jpg" alt="">
                                            <p>Trợ giá hấp dẫn</p>
                                        </li>
                                        <li><a href="#">
                                                <h3><?php echo $sp->ten_san_pham ?></h3>
                                            </a></li>
                                        <li><a href="#">Online giá rẻ</a></li>
                                        <li><a href="#">29.590.000 <sup>đ</sup></a></li>
                                        <li><a href=""> <del>2.950.000</del><sup>đ</sup></a><span>-10%</span></li>
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
                <div class="btn_chevron_2">
                    <i class="fas fa-chevron-left fa-chevron-left_2"></i>
                    <i class="fas fa-chevron-right fa-chevron-right_2"></i>
                </div>
            </div>
            <!-- -------------------BUTTON--------------------------- -->

        </section>
        <!-- -----------------------------------XU HƯỚNG MUA SẮM ------------------------------->
        <section class="buy_trend">
            <div class="container_buy_trend">
                <div class="content_title"><strong>XU HƯỚNG MUA SẮM</strong></div>
                <div class="xu_huong_mua_sam">
                    <div class="main_content_buy_trend">
                        <img src="./Images_Logo/trend1.webp" alt="">
                        <div class="content_text">
                            <h3>iPhone 11</h3>
                            <strong>Chỉ từ 8.990.000 <sup>đ</sup></strong>
                        </div>
                    </div>
                    <div class="main_content_buy_trend">
                        <img src="./Images_Logo/trend2.webp" alt="">
                        <div class="content_text">
                            <h3>Laptop Gaming</h3>
                            <strong>Chỉ từ 15.990.000 <sup>đ</sup></strong>
                        </div>
                    </div>
                    <div class="main_content_buy_trend">
                        <img src="./Images_Logo/trend3.webp" alt="">
                        <div class="content_text">
                            <h3>Sạc dự phòng giá rẻ</h3>
                            <strong>Chỉ từ 190.000 <sup>đ</sup></strong>
                        </div>
                    </div>
                    <div class="main_content_buy_trend">
                        <img src="./Images_Logo/trend4.webp" alt="">
                        <div class="content_text">
                            <h3>Xiaomi Watch mới</h3>
                            <strong>Chỉ từ 1.590.000 <sup>đ</sup></strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="gallery">
            <div class="container_gallery">
                <div class="title_gallery"><strong>DANH MỤC NỔI BẬT</strong></div>
                <div class="contain_gallery">
                    <div class="content_gallery">
                        <img src="./Image_products/gallery1.webp" alt="">
                        <span>Điện thoại đặc quyền</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery2.webp" alt="">
                        <span>Laptop</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery3.webp" alt="">
                        <span>Tablet</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery4.webp" alt="">
                        <span>Đồng hồ thông minh</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery5.webp" alt="">
                        <span>Đồng hồ thời trang</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery6.webp" alt="">
                        <span>Máy cũ giá rẻ</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery7.webp" alt="">
                        <span>Ốp lưng</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery8.webp" alt="">
                        <span>Chuột máy tính</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery9.webp" alt="">
                        <span>Bàn phím</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery11.webp" alt="">
                        <span>Sim, thẻ cào</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery10.webp" alt="">
                        <span> Loa</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery12.webp" alt="">
                        <span>Tai nghe</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery14.webp" alt="">
                        <span>Sạc dự phòng</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery13.webp" alt="">
                        <span>Camera</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery15.webp" alt="">
                        <span>Cáp sạc</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery16.webp" alt="">
                        <span>Máy tính bộ</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery17.webp" alt="">
                        <span>Máy in</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery20.webp" alt="">
                        <span>Màn hình máy tính</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery18.webp" alt="">
                        <span>Thẻ nhớ</span>
                    </div>
                    <div class="content_gallery">
                        <img src="./Image_products/gallery19.webp" alt="">
                        <span>Phụ kiện cho laptop</span>
                    </div>
                </div>
            </div>
            <!-- ------------------------------BANNER KHUYEN MAI--------------------- -->
        </section>
        <section class="banner_sale">
            <div class="container_banner_sale">
                <strong class="name-box">KHUYẾN MÃI CHỈ CÓ TRÊN ONLINE</strong><br>
                <img src="./Images_Logo/banner_discount.png" alt="#">
            </div>
        </section>
        <!-- ---------------------------------END------------------------------------ -->
        <!-- ----------------------------------DỊCH VỤ TIỆN ÍCH---------------------- -->
        <section class="dich_vu_tien-ich">
            <div class="container_service">
                <div class="content_service">
                    <p>DỊCH VỤ TIỆN ÍCH</p>
                    <ul>
                        <li style="background-color: #DCEEFF;">
                            <!-- <div class="content_service_text">
                                <small class="text-conv-title">Mua Mã thẻ cào</small><br>
                                <small><strong>Giảm 2%</strong> cho mệnh giá từ 100.000 trở lên</small>
                            </div> -->
                        </li>
                        <li style="background-color: #FEF5CF;"></li>
                        <li style="background-color: #FEEFDB;"></li>
                        <li style="background-color: #E1FECF;"></li>
                    </ul>
                </div>
            </div>
        </section>
        <?php
        include("Footer.php");
        ?>

</body>

</html>