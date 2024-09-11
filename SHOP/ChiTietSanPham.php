<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./JS/detail.js">
    <link rel="stylesheet" href="./CSS/thong_tin_san_pham.css">
    <link rel="stylesheet" href="./JS/thong_tin_san_pham.js">
    <link rel="stylesheet" href="./JS/javascript.js">
    <link rel="stylesheet" href="./CSS/footer.css">


    <title>Document</title>
</head>
<?php
session_start();
include("Connection.php");
if (isset($_GET["id"])) {
    $id_sp = $_GET["id"];
    $sql = "SELECT * FROM san_pham WHERE id_san_pham =" . $id_sp;
    $sta = $pdo->prepare($sql);
    $sta->execute();
}

if ($sta->rowCount() > 0) {
    $spct = $sta->fetchAll(PDO::FETCH_OBJ);
}
$pdo = NULL;
?>

<body>
    <?php
    include("Header.php");
    include("Menu.php");
    ?>

    <?php
    foreach ($spct as $sp) {
    ?>
        <h1 style="margin-top: 10px; margin-left: 20px;">Điện thoại <?php echo $sp->ten_san_pham ?></h1>
    <?php
    }
    ?>



    <hr style="width: 1300px;margin: 10px auto;">
    <section>
        <div class="box_main">

            <div class="box_left">
                <div class="product-gallery">
                    <?php
                    foreach ($spct as $sp) {
                    ?>
                        <img id="mainImage" src="./Image_SanPham/<?php echo $sp->hinh ?>" alt="Main Product Image" style="margin: 10px;">
                    <?php
                    }
                    ?>

                    <!-- <div class="thumbnails">
                        <img src="./Images_Logo/titan-xanh.jpg" alt="Thumbnail 1" onclick="changeImage('./Images_Logo/titan-xanh.jpg')">
                        <img src="./Images_Logo/titan-xanh-1.jpg" alt="Thumbnail 2" onclick="changeImage('./Images_Logo/titan-xanh-1.jpg')">
                        <img src="./Images_Logo/titan-xanh-2.jpg" alt="Thumbnail 3" onclick="changeImage('./Images_Logo/titan-xanh-2.jpg')">
                        <img src="./Images_Logo/titan-xanh-3.jpg" alt="Thumbnail 4" onclick="changeImage('./Images_Logo/titan-xanh-3.jpg')">
                        <img src="./Images_Logo/thong-tin-san-pham.jpeg" alt="Thumbnail 4" onclick="changeImage('./Images_Logo/thong-tin-san-pham.jpeg')">
                    </div>
                    <div class="controls">
                        <button class="prev" onclick="prevImage()"><i class="fas fa-chevron-left"></i></button>
                        <button class="next" onclick="nextImage()"><i class="fas fa-chevron-right"></i></button>
                    </div> -->
                </div>
                <div class="chinh_sach_bao_hanh">
                    <div class="chinh_sach_bao_hanh_top">
                        <ul>
                            <li>Hư gì đổi nấy 12 tháng tại 3158 siêu thị toàn quốc (miễn phí tháng đầu).</li>
                            <li>Bảo hành chính hãng điện thoại 1 năm tại các trung tâm bảo hành hãng. </li>
                        </ul>
                    </div>
                    <div class="chinh_sach_bao_hanh_bottom" style="color: red;">
                        <ul>
                            <li>Bộ sản phẩm gồm: hộp, sách hướng dẫn, que chọc sim, cáp sạc.</li>
                        </ul>
                    </div>
                </div>
                <div class="tieu_de_san_pham_lien_quan">
                    <strong style="font-size: 14px; margin-left: 10px; padding-top: 10px;">Phụ kiện nên có cho iPhone 15 Pro Max 256GB</strong>
                    <div class="container_san_pham_lien_quan">
                        <div class="san_pham_lien_quan">
                            <div class="main_san_pham_lien_quan">
                                <div class="noi_dung_san_pham">
                                    <img src="./Image_SanPham/ava-pj-jp192-thumb-600x600.jpeg" alt="">
                                    <div class="noi_dung">
                                        <li><img src="./Image_products/icon_2.jpg" alt="">
                                            <p>Giá rẻ quá</p>
                                        </li>
                                        <li><a href="#">
                                                <h3>Sạc dự phòng AVA+ 12W PJ JP192</h3>
                                            </a></li>
                                        <li><a href="#">190.000 <sup>đ</sup></a></li>
                                        <li><a href="#"> <del>380.000</del><sup>đ</sup></a><span>-50%</span></li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="san_pham_lien_quan">
                            <div class="main_san_pham_lien_quan">
                                <div class="noi_dung_san_pham">
                                    <img src="./Image_SanPham/tai-nghe-bluetooth-chup-tai-havit-h667bt-xanh-tn-600x600.jpg" alt="">
                                    <div class="noi_dung">
                                        <li><img src="./Image_products/icon_2.jpg" alt="">
                                            <p>Giá rẻ quá</p>
                                        </li>
                                        <li><a href="#">
                                                <h3>Tai nghe Bluetooth Chụp Tai HAVIT H667BT</h3>
                                            </a></li>
                                        <li><a href="#">350.000 <sup>đ</sup></a></li>
                                        <li><a href=""> <del>650.000</del><sup>đ</sup></a><span>-46%</span></li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="san_pham_lien_quan">
                            <div class="main_san_pham_lien_quan">
                                <div class="noi_dung_san_pham">
                                    <img src="./Image_SanPham/huawei-watch-gt4-46-day-cao-su-tb-1-600x600.jpg" alt="">
                                    <div class="noi_dung">
                                        <li><img src="./Image_products/icon_2.jpg" alt="">
                                            <p>Giá rẻ quá</p>
                                        </li>
                                        <li><a href="#">
                                                <h3>Đồng hồ thông minh Huawei Watch GT 4 46mm</h3>
                                            </a></li>
                                        <li><a href="#">4.290.000 <sup>đ</sup></a></li>
                                        <li><a href=""> <del>5.990.000</del><sup>đ</sup></a><span>-28%</span></li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="san_pham_lien_quan">
                            <div class="main_san_pham_lien_quan">
                                <div class="noi_dung_san_pham">
                                    <img src="./Image_SanPham/adapter-sac-3-cong-usb-type-c-pd-qc3-0-gan-65w-ugreen-robot-nexode-15570-600x600.jpg" alt="">
                                    <div class="noi_dung">
                                        <li><img src="./Image_products/icon_2.jpg" alt="">
                                            <p>Giá rẻ quá</p>
                                        </li>
                                        <li><a href="#">
                                                <h3>Sạc 3 cổng Ugreen Robot Nexode 15570</h3>
                                            </a></li>
                                        <li><a href="#">630.000 <sup>đ</sup></a></li>
                                        <li><a href=""> <del>900.000</del><sup>đ</sup></a><span>-30%</span></li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="review-section" style="width: 100%;">
                    <h2>Đánh giá Điện thoại <?php echo $sp->ten_san_pham ?></h2>
                    <div class="overall-rating">
                        <span class="rating-number" style="font-weight: bold; color: #ff9700;">4.0</span>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="total-reviews">126 đánh giá</span>
                    </div>
                    <div class="rating-distribution">
                        <div class="rating-bar">
                            <span>5 <i class="fas fa-star"></i></span>
                            <div class="bar">
                                <div class="filled" style="width: 56%;"></div>
                            </div>
                            <span>56%</span>
                        </div>
                        <div class="rating-bar">
                            <span>4 <i class="fas fa-star"></i></span>
                            <div class="bar">
                                <div class="filled" style="width: 10%;"></div>
                            </div>
                            <span>10%</span>
                        </div>
                        <div class="rating-bar">
                            <span>3 <i class="fas fa-star"></i></span>
                            <div class="bar">
                                <div class="filled" style="width: 19%;"></div>
                            </div>
                            <span>19%</span>
                        </div>
                        <div class="rating-bar">
                            <span>2 <i class="fas fa-star"></i></span>
                            <div class="bar">
                                <div class="filled" style="width: 10%;"></div>
                            </div>
                            <span>10%</span>
                        </div>
                        <div class="rating-bar">
                            <span>1 <i class="fas fa-star"></i></span>
                            <div class="bar">
                                <div class="filled" style="width: 6%;"></div>
                            </div>
                            <span>6%</span>
                        </div>
                    </div>
                    <div class="user-reviews">
                        <div class="review">
                            <div class="user-info">
                                <img src="./User/tải xuống.jpg" alt="User Image">
                                <span>Trần Văn Niên</span>
                                <span class="verified"><i class="fas fa-check-circle"></i> Đã mua tại TGDD</span>
                            </div>
                            <div class="user-review">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <p>Sẽ giới thiệu cho bạn bè, người thân. Mới sạc có 25 lần đã tụt 1% pin rồi.</p>
                                <div class="review-images">
                                    <img src="./Image_products/dongho_2.webp" alt="Review Image">
                                    <img src="./Image_products/chuot-bluetooth-silent-logitech-m240-thumb-600x600.webp" alt="Review Image">
                                </div>
                                <div class="review-footer">
                                    <span class="helpful"><i class="fas fa-thumbs-up"></i> Hữu ích</span>
                                    <span class="time">Đã dùng khoảng 1 tháng</span>
                                </div>
                            </div>
                        </div>
                        <div class="review">
                            <div class="user-info">
                                <img src="./User/Img2904-159927756318.jpg" alt="User Image">
                                <span>Cao Lê Hoàng Vũ</span>
                                <span class="verified"><i class="fas fa-check-circle"></i> Đã mua tại TGDD</span>
                            </div>
                            <div class="user-review">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <p>Sẽ giới thiệu cho bạn bè, người thân. Mua hàng ở tgdd xem trên web có ưu đãi mà ra tiệm thì lại không có, quá tệ.</p>
                                <div class="review-images">
                                    <img src="./Image_products/camera-ip-360-do-1080p-imou-ranger-2c-a22ep-l-thumb-600x600.webp" alt="Review Image">
                                </div>
                                <div class="review-footer">
                                    <span class="helpful"><i class="fas fa-thumbs-up"></i> Hữu ích (7)</span>
                                    <span class="time">Đã dùng khoảng 1 ngày</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="review-buttons">
                        <button class="view-all-reviews">Xem 126 đánh giá</button>
                        <button class="write-review">Viết đánh giá</button>
                    </div>
                </div>

            </div>
            <div class="box_right">
                <div class="dung_luong">
                    <a href="">256GB</a>
                    <a href="">512GB</a>
                    <a href="">1TB</a>
                </div>
                <div class="mau_sac">
                    <a href="">Titan xanh</a>
                    <a href="">Titan đen</a>
                    <a href="">Titan tự nhiên</a>
                    <a href="">Titan trắng</a>
                </div>
                <div class="tieu_de_" style="margin: 10px 0;">
                    <p style="font-size: 15px;">Giá tại <span style="color: rgb(51, 189, 227);font-size: 15px;">Hồ Chí
                            Minh</span> </p>
                </div>
                <div class="gia_san_pham">
                    <?php
                    foreach ($spct as $sp) {
                    ?>
                        <strong style="color: #D0021C;"><?php echo number_format($sp->don_gia, 0, ',', '.') ?><sup>đ</sup></strong>
                        <p><del><?php echo number_format($sp->don_gia * 110 / 100, 0, ',', '.') ?><sup>đ</sup></del></p>
                        <p style="color: #f14e64;">-10%</p>
                        <span>Trả góp 0%</span>

                    <?php
                    }
                    ?>

                </div>
                <div class="khuyen_mai">
                    <div class="top_khuyen_mai">
                        <p style="font-weight: bold;padding: 5px 5px;">Khuyến mãi</p>
                        <i style="padding:5px 5px;">Giá và khuyến mãi dự kiến áp dụng đến 23:00 | 31/05</i>
                    </div>
                    <div class="bottom_khuyen_mai">
                        <p>1</p>
                        <span>Ốp lưng chính hãng Apple giảm thêm 300K khi mua kèm iPhone (áp dụng tuỳ model)</span>
                    </div>
                    <div class="bottom_khuyen_mai">
                        <p>2</p>
                        <span>Thu cũ Đổi mới: Giảm đến 2 triệu (Tuỳ model máy cũ,thanh toán qua cổng online) <a href="#">Xem chi tiết</a></span><br>

                    </div>
                    <div class="bottom_khuyen_mai">
                        <p>3</p>
                        <span>
                            Cơ hội trúng 10 xe máy Yamaha Sirius mỗi tháng, tổng giải thưởng lên đến 390 Triệu <a href="#">Xem chi tiết</a></span>
                    </div>
                </div>
                <form action="ShowCart.php" method="POST" class="btn_mua_ngay">
                    <div class="btn_mua_ngay">
                        <?php foreach ($spct as $sp) {
                        ?>
                            <input type="hidden" name="id_san_pham" value="<?php echo $sp->id_san_pham ?>">
                            <input type="hidden" name="hinh" value="<?php echo $sp->hinh ?>">
                            <input type="hidden" name="ten_san_pham" value="<?php echo $sp->ten_san_pham ?>">
                            <input type="hidden" name="don_gia" value="<?php echo $sp->don_gia ?>">
                            <input type="hidden" name="sl" id="productQty" class="form-control" placeholder="Quantity" min="1" max="1000" value="1" size="7" style="margin-right:30px;">
                        <?php
                        }

                        ?>

                        <button type="submit" name="add_to_cart" value="add to cart" style="width: 100%; height: 100%; background-color: #FB6E2E; color: #fff; border: none; display: flex; justify-content: center; align-items: center; font-size: 18px;">
                            MUA NGAY
                        </button>
                        <!-- <a href="#">MUA NGAY</a> -->
                    </div>
                </form>

                <div class="btn_mua_tra_gop">
                    <div class="btn_left" style="padding-top: 5px;"><a href="#">MUA TRẢ GÓP 0%</a><br><span>Duyệt hồ sơ trong vòng 5 phút</span>
                    </div>
                    <div class="btn_right" style="padding-top: 5px;"><a href="#">TRẢ GÓP 0 đồng qua thẻ</a><br><span>Visa, Mastercard, JCB,
                            Amex</span></div>
                </div>
                <div class="goi_mua_hang"><span style="font-size: 14px;">Gọi đặt mua <a href="#">1900 232 460</a> (7:30
                        - 22:00)</span></div>
                <div class="container_uu_dai">
                    <h3>ƯU ĐÃI HẤP DẪN KHI MUA KÈM</h3>
                    <hr>
                    <div class="san_pham_mua_sam">
                        <img src="./Images_Logo/iphone-13-xanh-la-thumb-new-600x600.jpg" alt="">
                        <div class="san_pham_di_kem">
                            <div class="content_top">
                                <p>Điện thoại iPhone 15 Pro Max 256GB</p>
                            </div>
                            <div class="content_bottom">
                                <p style="color: #D0021C;font-weight: bold;margin-right: 5px;">29.590.000<sup>đ</sup>
                                </p>
                                <span><del>34.990.000<sup>đ</sup></del></span>
                            </div>
                        </div>
                    </div>
                    <div class="mua_sam_uu_dai">
                        <img src="./Images_Logo/iphone-13-xanh-la-thumb-new-600x600.jpg" alt="">
                        <div class="discount-label">Giảm 10%</div>
                        <div class="san_pham_di_kem">
                            <div class="content_top">
                                <input type="checkbox">
                                <p>Điện thoại iPhone 15 Pro Max 256GB</p>
                            </div>
                            <div class="content_bottom">
                                <p style="color: #D0021C;font-weight: bold;margin-right: 5px;">29.590.000<sup>đ</sup>
                                </p>
                                <span><del>34.990.000<sup>đ</sup></del></span>
                            </div>
                        </div>
                    </div>
                    <div class="mua_sam_uu_dai">
                        <img src="./Images_Logo/iphone-13-xanh-la-thumb-new-600x600.jpg" alt="">
                        <div class="discount-label">Giảm 10%</div>
                        <div class="san_pham_di_kem">
                            <div class="content_top">
                                <input type="checkbox">
                                <p>Điện thoại iPhone 15 Pro Max 256GB</p>
                            </div>
                            <div class="content_bottom">
                                <p style="color: #D0021C;font-weight: bold;margin-right: 5px;">29.590.000<sup>đ</sup>
                                </p>
                                <span><del>34.990.000<sup>đ</sup></del></span>
                            </div>
                        </div>
                    </div>
                    <div class="mua_sam_uu_dai">
                        <img src="./Images_Logo/iphone-13-xanh-la-thumb-new-600x600.jpg" alt="">
                        <div class="discount-label">Giảm 10%</div>
                        <div class="san_pham_di_kem">
                            <div class="content_top">
                                <input type="checkbox">
                                <p>Điện thoại iPhone 15 Pro Max 256GB</p>
                            </div>
                            <div class="content_bottom">
                                <p style="color: #D0021C;font-weight: bold;margin-right: 5px;">29.590.000<sup>đ</sup>
                                </p>
                                <span><del>34.990.000<sup>đ</sup></del></span>
                            </div>
                        </div>
                    </div>
                    <div class="tong_tien" style="text-align: center;font-size: 14px;">
                        <p>Tổng tiền: <strong style="color: #D0021C;font-size: 25px;"><?php echo number_format($sp->don_gia, 0, ',', '.') ?><sup>đ</sup></strong>
                        </p>
                    </div>
                    <div class="mua_theo_combo">
                        <a href="#" style="color: #fff;font-size: 20px;">MUA 1 SẢN PHẨM</a>
                    </div>
                </div>
                <div class="container_khuyen_mai">
                    <div class="khuyen_mai">
                        <div class="top_khuyen_mai">
                            <p style="font-weight: bold; padding: 5px 5px;">7 ưu đãi thêm</p>
                            <i style="padding: 5px 5px;">Giá và khuyến mãi dự kiến áp dụng đến 23:00 | 31/05</i>
                        </div>
                        <div class="bottom_khuyen_mai">
                            <p>1</p>
                            <span>Mua kèm sim Vina Thoại 6T giảm giá 30%</span>
                        </div>
                        <div class="bottom_khuyen_mai">
                            <p>2</p>
                            <span>Apple Watch giảm thêm đến 1,500,000đ (Tùy Model) khi mua kèm Iphone/iPad/Macbook/iMac
                                <a href="#" style="color: rgb(65, 183, 226);">Xem chi tiết</a></span><br>
                        </div>
                        <div class="bottom_khuyen_mai">
                            <p>3</p>
                            <span>Mua 1 số iPad giảm đến 20% (Không kèm khuyến mãi khác của iPad)</span>
                        </div>
                        <div class="extra_khuyen_mai" style="display: none;">
                            <div class="bottom_khuyen_mai">
                                <p>4</p>
                                <span>Mua Miếng Dán/ Tai nghe Apple giảm đến 50% (Không áp dụng khuyến mãi khác)</span>
                            </div>
                            <div class="bottom_khuyen_mai">
                                <p>5</p>
                                <span>Mua Adapter sạc/Cáp sạc Apple giảm đến 20% (Không áp dụng khuyến mãi khác)</span>
                            </div>
                            <div class="bottom_khuyen_mai">
                                <p>6</p>
                                <span>Mua Ốp lưng/Bao da/miếng dán mặt sau/Kính bảo vệ camera giảm đến 70% (Không áp
                                    dụng)</span>
                            </div>
                            <div class="bottom_khuyen_mai">
                                <p>7</p>
                                <span>Mua đồng hồ thời trang giảm 40% (không áp dụng khuyến mãi khác)</span>
                            </div>
                        </div>
                        <a href="#" id="xemThem" style="color: rgb(65, 183, 226); display: block; margin: 10px 0;text-align: center;">Xem
                            thêm</a>
                    </div>
                </div>



                <div class="cau_hinh_san_pham">
                    <?php
                    foreach ($spct as $sp) {
                    ?>
                        <h3 style="margin: 20px 0px;text-align: center;font-size: 22px;">Cấu hình điện thoại <?php echo $sp->ten_san_pham ?></h3>
                        <div class="container_cau_hinh_san_pham">
                            <div class="content_cau_hinh_san_pham">
                                <ul>
                                    <li>
                                        <p>Màn hình: </p> <span><?php echo $sp->man_hinh ?></span>
                                    </li>
                                    <li>
                                        <p>Hệ điều hành: </p><span><?php echo $sp->he_dieu_hanh ?></span>
                                    </li>
                                    <li>
                                        <p>Camera sau:</p><span><?php echo $sp->camera_sau ?></span>
                                    </li>
                                    <li>
                                        <p>Camera trước:</p><span><?php echo $sp->camera_truoc ?></span>
                                    </li>
                                    <li>
                                        <p>Chip:</p><span><?php echo $sp->chip ?></span>
                                    </li>
                                    <li>
                                        <p>RAM:</p><span><?php echo $sp->ram ?></span>
                                    </li>
                                    <li>
                                        <p>Dung lượng lưu trữ:</p><span><?php echo $sp->dung_luong_luu_tru ?></span>
                                    </li>
                                    <li>
                                        <p>SIM:</p><span><?php echo $sp->sim ?></span>
                                    </li>
                                    <li>
                                        <p>Pin, Sạc:</p><span><?php echo $sp->pin_sac ?></span>
                                    </li>
                                    <li>
                                        <p>Hãng</p><span><?php echo $sp->hang ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>

            </div>
    </section>
    <section class="slider_products">
        <div class="container">
            <div class="container_items">
                <h3 style="font-size: 22px">Sản phẩm thường mua cùng</h3>
                <div class="container_main_products">
                    <div class="container_slider_main_products">
                        <div class="main_products">
                            <div class="item_content">
                                <img src="./Image_products/iphone-15-pro-max-(12).webp" alt="">
                                <div class="item_text">
                                    <li><img src="./Image_products/icon_2.jpg" alt="">
                                        <p>Trợ giá hấp dẫn</p>
                                    </li>
                                    <li><a href="#">
                                            <h3>iphone 15 Pro Max 256GB</h3>
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
                            <div class="item_content">
                                <img src="./Image_products/tai-nghe-bluetooth-airpods-2-apple-mv7n2-trang-200923-112201-600x600.webp" alt="">
                                <div class="item_text">
                                    <li><img src="./Image_products/icon_2.jpg" alt="">
                                        <p>Trợ giá hấp dẫn</p>
                                    </li>
                                    <li><a href="#">
                                            <h3>iphone 15 Pro Max 256GB</h3>
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
                            <div class="item_content">
                                <img src="./Image_products/samsung-galaxy-z-fold5-blue-thumbnew-600x600.webp" alt="">
                                <div class="item_text">
                                    <li><img src="./Image_products/icon_2.jpg" alt="">
                                        <p>Trợ giá hấp dẫn</p>
                                    </li>
                                    <li><a href="#">
                                            <h3>iphone 15 Pro Max 256GB</h3>
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
                            <div class="item_content">
                                <img src="./Image_products/tai-nghe-bluetooth-true-wireless-ava-go-p210-trang-tb-600x600.webp" alt="">
                                <div class="item_text">
                                    <li><img src="./Image_products/icon_2.jpg" alt="">
                                        <p>Trợ giá hấp dẫn</p>
                                    </li>
                                    <li><a href="#">
                                            <h3>iphone 15 Pro Max 256GB</h3>
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
                            <div class="item_content">
                                <img src="./Image_products/dongho_2.webp" alt="">
                                <div class="item_text">
                                    <li><img src="./Image_products/icon_2.jpg" alt="">
                                        <p>Trợ giá hấp dẫn</p>
                                    </li>
                                    <li><a href="#">
                                            <h3>iphone 15 Pro Max 256GB</h3>
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
                        </div>

                    </div>
                </div>
            </div>
            <!-- -------------------BUTTON--------------------------- -->
        </div>
    </section>
    <?php
    include("Footer.php");
    ?>
    <script src="./JS/detail.js"></script>
    <script src="./JS/thong_tin_san_pham.js"></script>

</body>

</html>