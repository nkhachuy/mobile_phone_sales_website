<?php
include("Connection.php");

// Kiểm tra nếu người dùng đăng xuất
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: Index.php");
    exit;
}

// Lấy thông tin tài khoản nếu người dùng đã đăng nhập
$loggedIn = false;
$userName = '';
if (isset($_SESSION['tai_khoan'])) {
    $loggedIn = true;
    $userName = $_SESSION['tai_khoan'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="./CSS/header.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
    <header>
        <img src="./Images_Logo/logotop2.webp" alt="">
    </header>
    <nav>
        <div class="header_top">
            <ul>
                <li>
                    <a href="Index.php"><img src="./Images_Logo/logotgdd.png" style="width: 300px;" alt=""></a>
                </li>
                <li id="address_form"><a href="#"><span>Xem giá tồn kho tại:</span><br>Hồ Chí Minh<i class="fas fa-sort-down"></i></a>
                    <div class="address_form">
                        <div class="address_form_content">
                            <h2>Chọn địa chỉ giao hàng <span id="close_form">x Đóng</span></h2>
                            <form action="">
                                <p>Chọn đầy đủ địa chỉ nhận hàng để biết chính xác thời gian giao</p>
                                <select name="" id="">
                                    <option value="">Hồ Chí Minh</option>
                                    <option value="">Hà Nội</option>
                                    <option value="">Hải Phòng</option>
                                </select>
                                <select name="" id="">
                                    <option value="">Đống Đa</option>
                                    <option value="">Quận 1</option>
                                    <option value="">Bình Thạnh</option>
                                </select>
                                <select name="" id="">
                                    <option value="">Phường 15</option>
                                    <option value="">Thống Nhất</option>
                                    <option value="">Thanh Đa</option>
                                </select>
                                <input type="text" name="text" placeholder="Số nhà, tên đường(không bắt buộc)">
                                <button>XÁC NHẬN</button>
                            </form>
                        </div>
                    </div>
                </li>
                
                <form action="Search.php" method="get">
                <input type="text" name="txt_Search" id="search" placeholder="Bạn tìm gì...?" style="font-size: 14px;">
                <button id="search"><i class="fas fa-search"></i></button>

                
                </form>
                
                
                <li><a href="ShowCart.php"><button><i class="fas fa-shopping-cart"></i>Giỏ hàng
                            <?php
                            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                echo '(' . count($_SESSION['cart']) . ')';
                            }
                            ?>
                        </button></a></li>
                <li class="dropdown">
                    <?php if ($loggedIn) : ?>
                        <a href="#" class="user-dropdown"><i class="fas fa-user"></i> <span class="user-name"><?= htmlspecialchars($userName) ?></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="?action=logout" class="logout-btn">Đăng xuất</a></li>
                        </ul>
                    <?php else : ?>
                        <a href="Login.php">Tài khoản</a>
                    <?php endif; ?>
                </li>

                <li><a href=""><span class="btn_in"><span class="btn_out"></span></span>Mua thẻ nạp ngay!</a></li>
                <li><a href="">24h<br>Công nghệ</a></li>
                <li><a href="">Hỏi đáp</a></li>
                <li><a href="">Game App</a></li>
            </ul>
        </div>
    </nav>
    <!-- Phần nội dung của bạn -->
</body>

</html>