-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 04, 2024 lúc 08:25 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_dtdd`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_hoa_don`
--

CREATE TABLE `chi_tiet_hoa_don` (
  `id_hoa_don` int(11) NOT NULL,
  `id_san_pham` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `don_gia` double NOT NULL,
  `thanh_tien` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_gia`
--

CREATE TABLE `danh_gia` (
  `id_danh_gia` int(11) NOT NULL,
  `noi_dung_danh_gia` varchar(200) NOT NULL,
  `diem` int(11) NOT NULL,
  `ngay_danh_gia` date NOT NULL,
  `id_khach_hang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `id_hoa_don` int(11) NOT NULL,
  `id_khach_hang` int(11) NOT NULL,
  `ngay_dat_hang` date NOT NULL,
  `ngay_giao_hang` date NOT NULL,
  `tinh_trang_thanh_toan` int(11) NOT NULL,
  `phuong_thuc_thanh_toan` int(11) NOT NULL,
  `tinh_trang_giao_hang` int(11) NOT NULL,
  `tong_tien` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id_khach_hang` int(11) NOT NULL,
  `ten_khach_hang` varchar(200) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `dia_chi` varchar(200) NOT NULL,
  `dien_thoai` varchar(20) NOT NULL,
  `tai_khoan` varchar(200) NOT NULL,
  `mat_khau` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `id_khuyen_mai` int(11) NOT NULL,
  `ten_khuyen_mai` varchar(200) NOT NULL,
  `noi_dung_khuyen_mai` varchar(200) NOT NULL,
  `phan_tram_khuyen_mai` int(11) NOT NULL,
  `id_san_pham` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_nhan_vien`
--

CREATE TABLE `loai_nhan_vien` (
  `id_loai_nhan_vien` int(11) NOT NULL,
  `ten_loai_nhan_vien` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_san_pham`
--

CREATE TABLE `loai_san_pham` (
  `id_loai` int(11) NOT NULL,
  `ten_loai` varchar(200) NOT NULL,
  `hinh` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_san_pham`
--

INSERT INTO `loai_san_pham` (`id_loai`, `ten_loai`, `hinh`) VALUES
(1, 'IPhone', 'iphone.png'),
(2, 'Samsung', 'samsung.png'),
(3, 'Oppo', 'oppo.jpg'),
(4, 'Xiaomi', 'xiaomi.png'),
(5, 'Vivo', 'vivo.png'),
(6, 'Realme', 'realme.png'),
(7, 'Honor', 'honor.png'),
(8, 'TCL', 'tcl.jpg'),
(9, 'Tecno', 'tecno.png'),
(10, 'Nokia', 'nokia.jpg'),
(11, 'Masstel', 'masstel.png'),
(12, 'Mobell', 'mobell.jpg'),
(13, 'Itel', 'itel.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `id_nhan_vien` int(11) NOT NULL,
  `ten_nhan_vien` varchar(200) NOT NULL,
  `tai_khoan` varchar(200) NOT NULL,
  `mat_khau` varchar(200) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `dia_chi` varchar(200) NOT NULL,
  `dien_thoai` varchar(200) NOT NULL,
  `chuc_vu` varchar(200) NOT NULL,
  `id_loai_nhan_vien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_hoi`
--

CREATE TABLE `phan_hoi` (
  `id_phan_hoi` int(11) NOT NULL,
  `noi_dung_phan_hoi` varchar(500) NOT NULL,
  `ngay_phan_hoi` date NOT NULL,
  `id_khach_hang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `id_san_pham` int(11) NOT NULL,
  `ten_san_pham` varchar(200) NOT NULL,
  `don_gia` double NOT NULL,
  `hinh` varchar(500) NOT NULL,
  `man_hinh` varchar(200) NOT NULL,
  `he_dieu_hanh` varchar(200) NOT NULL,
  `camera_sau` varchar(200) NOT NULL,
  `camera_truoc` varchar(200) NOT NULL,
  `chip` varchar(200) NOT NULL,
  `ram` varchar(200) NOT NULL,
  `dung_luong_luu_tru` varchar(200) NOT NULL,
  `sim` varchar(200) NOT NULL,
  `pin_sac` varchar(200) NOT NULL,
  `hang` varchar(200) NOT NULL,
  `id_loai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`id_san_pham`, `ten_san_pham`, `don_gia`, `hinh`, `man_hinh`, `he_dieu_hanh`, `camera_sau`, `camera_truoc`, `chip`, `ram`, `dung_luong_luu_tru`, `sim`, `pin_sac`, `hang`, `id_loai`) VALUES
(1, 'iPhone 15 Pro Max', 34990000, 'iphone-15-pro-max-blue-thumbnew-600x600.jpg', 'OLED, 6.7\", Super Retina XDR', 'iOS 17', 'Chính 48 MP & Phụ 12 MP, 12 MP', '12 MP', 'Apple A17 Pro 6 nhân', '8 GB', '256 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 5G', '4422 mAh, 20 W', 'iPhone (Apple).', 1),
(2, 'iPhone 15 Plus', 29590000, 'iphone-15-plus-xanh-la-128gb-thumb-600x600.jpg', 'OLED, 6.7\", Super Retina XDR', 'iOS 17', 'Chính 48 MP & Phụ 12 MP, 12 MP', '12 MP', 'Apple A17 Pro 6 nhân', '8 GB', '256 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 5G', '4422 mAh, 20 W', 'iPhone (Apple).', 1),
(3, 'iPhone 14 Pro Max', 26990000, 'iphone-14-pro-max-tim-thumb-600x600.jpg', 'OLED, 6.7\", Super Retina XDR', 'iOS 16', 'Chính 48 MP & Phụ 12 MP, 12 MP', '12 MP', 'Apple A16 Bionic', '6 GB', '128 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 5G', '4323 mAh, 20 W', 'iPhone (Apple).', 1),
(4, 'iPhone 12', 13090000, 'iphone-12-trang-13-600x600.jpg', 'OLED, 6.1\", Super Retina XDR', 'iOS 15', '2 camera 12 MP', '12 MP', 'Apple A14 Bionic', '4 GB', '64 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 5G', '2815 mAh, 20 W', 'iPhone (Apple).', 1),
(5, 'Samsung Galaxy A35 5G', 9290000, 'samsung-galaxy-a35-5g-xanh-thumb-1-600x600.jpg', 'Super AMOLED, 6.6\", Full HD+', 'Android 14', 'Chính 50 MP & Phụ 8 MP, 5 MP', '13 MP', 'Exynos 1380 8 nhân', '8 GB', '256 GB', '2 Nano SIM, Hỗ trợ 5G', '5000 mAh, 25 W', 'Samsung.', 2),
(6, 'Samsung Galaxy S23 Ultra 5G', 24990000, 'samsung-galaxy-s23-ultra-green-thumbnew-600x600.jpg', 'Dynamic AMOLED 2X, 6.8\", Quad HD+ (2K+)', 'Android 13', 'Chính 200 MP & Phụ 12 MP, 10 MP, 10 MP', '12 MP', 'Snapdragon 8 Gen 2 for Galaxy', '8 GB', '256 GB', '2 Nano SIM hoặc 1 Nano SIM + 1 eSIM, Hỗ trợ 5G', '5000 mAh, 45 W', 'Samsung.', 2),
(7, 'Samsung Galaxy S24 Ultra 5G', 33990000, 'samsung-galaxy-s24-ultra-grey-thumb-600x600.jpg', 'Dynamic AMOLED 2X, 6.8\", Quad HD+ (2K+)', 'Android 14', 'Chính 200 MP & Phụ 50 MP, 12 MP, 10 MP', '12 MP', 'Snapdragon 8 Gen 3 for Galaxy', '12 GB', '256 GB', '2 Nano SIM hoặc 2 eSIM hoặc 1 Nano SIM + 1 eSIM, Hỗ trợ 5G', '5000 mAh, 45 W', 'Samsung.', 2),
(8, 'Samsung Galaxy Z Flip5 5G', 25990000, 'samsung-galaxy-z-flip5-mint-thumbnew-600x600.jpg', 'Chính: Dynamic AMOLED 2X, Phụ: Super AMOLED, Chính 6.7\" & Phụ 3.4\", Full HD+', 'Android 13', '2 camera 12 MP', '10 MP', 'Snapdragon 8 Gen 2 for Galaxy', '8 GB', '256 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 5G', '3700 mAh, 25 W', 'Samsung.', 2),
(9, 'OPPO Reno11 F 5G', 8990000, 'oppo-reno11-f-purple-thumb-600x600.jpg', 'AMOLED, 6.7\", Full HD+', 'Android 14', 'Chính 64 MP & Phụ 8 MP, 2 MP', '32 MP', 'MediaTek Dimensity 7050 5G 8 nhân', '8 GB', '256 GB', '2 Nano SIM, Hỗ trợ 5G', '5000 mAh, 67 W', 'OPPO.', 3),
(10, 'OPPO Find N2 Flip 5G', 18490000, 'oppo-n2-flip-den-thumb-600x600.jpg', 'AMOLED, Chính 6.8\" & Phụ 3.26\", Full HD+', 'Android 13', 'Chính 50 MP & Phụ 8 MP', '32 MP', 'MediaTek Dimensity 9000+ 8 nhân', '8 GB', '256 GB', '2 Nano SIM, Hỗ trợ 5G', '4300 mAh, 44 W', 'OPPO.', 3),
(11, 'iPhone 11', 8690000, 'iphone-11-trang-600x600.jpg', 'IPS LCD, 6.1\", Liquid Retina', 'iOS 15', '2 camera 12 MP', '12 MP', 'Apple A13 Bionic', '4 GB', '64 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 4G', '\r\n3110 mAh, 18 W', 'iPhone (Apple)', 1),
(12, 'iPhone 13', 13590000, 'iphone-13-xanh-la-thumb-new-600x600.jpg', 'OLED, 6.1\", Super Retina XDR', 'iOS 15', '2 camera 12 MP', '12 MP', 'Apple A15 Bionic', '4 GB', '128 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 5G', '3240 mAh20 W', 'iPhone (Apple).', 1),
(13, 'iPhone 15', 19290000, 'iphone-15-hong-thumb-1-600x600.jpg', 'OLED, 6.1\", Super Retina XDR', 'iOS 17', 'Chính 48 MP & Phụ 12 MP', '12 MP', 'Apple A16 Bionic', '6 GB', '128 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 5G', '3349 mAh, 20 W', 'iPhone (Apple)', 1),
(14, 'iPhone 15 Pro', 25990000, 'iphone-15-pro-white-thumbnew-600x600.jpg', 'OLED, 6.1\", Super Retina XDR', 'iOS 17', 'Chính 48 MP & Phụ 12 MP, 12 MP', '12 MP', 'Apple A17 Pro 6 nhân', '8 GB', '128 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 5G', '3274 mAh, 20 W', 'iPhone (Apple)', 1),
(15, 'iPhone 14 Plus', 19390000, 'iPhone-14-plus-thumb-xanh-1-600x600.jpg', 'OLED6, 7\", Super Retina XDR', 'iOS 16', '2 camera 12 MP', '12 MP', 'Apple A15 Bionic', '6 GB', '128 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 5G', '4325 mAh, 20 W', 'iPhone (Apple)', 1),
(16, 'iPhone 14 ', 17190000, 'iPhone-14-thumb-tim-1-600x600.jpg', 'OLED, 6.1\", Super Retina XDR', 'iOS 16', '2 camera 12 MP\r\n', '12 MP', 'Apple A15 Bionic', '6 GB', '128 GB', '1 Nano SIM & 1 eSIM, Hỗ trợ 5G', '3279 mAh, 20 W', 'iPhone (Apple)', 1),
(17, 'Samsung Galaxy S23 FE 5G', 14890000, 'samsung-galaxy-s23-fe-mint-thumbnew-600x600.jpg', 'Dynamic AMOLED 2X, 6.4\", Full HD+', 'Android 13', 'Chính 50 MP & Phụ 12 MP, 8 MP', '10 MP', 'Exynos 2200 8 nhân', '8 GB', '128 GB', '2 Nano SIM hoặc 1 Nano SIM + 1 eSIM, Hỗ trợ 5G', '4500 mAh, 25 W', 'Samsung', 2),
(18, 'Samsung Galaxy A55 5G', 11990000, 'samsung-galaxy-a55-5g-xanh-thumb-1-600x600.jpg', 'Super AMOLED, 6.6\", Full HD+', 'Android 14', 'Chính 50 MP & Phụ 12 MP, 5 MP', '32 MP', 'Exynos 1480 8 nhân', '12 GB', '256 GB', '2 Nano SIM + 1 eSIMHỗ trợ 5G', '5000 mAh, 25 W', 'Samsung', 2),
(19, 'Samsung Galaxy M54 5G', 8990000, 'samsung-galaxy-m54-bac-thumb-600x600', 'Super AMOLED Plus, 6.7\", Full HD+', 'Android 13', 'Chính 108 MP & Phụ 8 MP, 2 MP', '32 MP', 'Exynos 1380 8 nhân', '8 GB', '256 GB', '2 Nano SIM (SIM 2 chung khe thẻ nhớ). Hỗ trợ 5G', '6000 mAh, 25 W', 'Samsung', 2),
(20, 'Samsung Galaxy S24+ 5G', 26990000, 'Dynamic AMOLED 2X, 6.7\", Quad HD+ (2K+)', 'Android 14', 'Chính 50 MP & Phụ 12 MP, 10 MP', '12 MP', 'Exynos 2400', '12 GB', '256 GB', '256 GB\r\n', '2 Nano SIM hoặc 2 eSIM hoặc 1 Nano SIM + 1 eSIM, Hỗ trợ 5G', '4900 mAh, 45 W', 'Samsung', 2),
(21, 'Samsung Galaxy S24 5G', 22990000, 'samsung-galaxy-s24-yellow-thumb-600x600.jpg', 'Dynamic AMOLED 2X6.2\"Full HD+', 'Android 14', 'Chính 50 MP & Phụ 12 MP, 10 MP', '12 MP', 'Exynos 2400', '8 GB', '256 GB', '2 Nano SIM hoặc 2 eSIM hoặc 1 Nano SIM + 1 eSIM, Hỗ trợ 5G', '4000 mAh, 25 W', 'Samsung.', 2),
(22, 'Samsung Galaxy A34 5G', 6940000, 'samsung-galaxy-a34-5g-bac-thumb-1-600x600.jpg', 'Super AMOLED, 6.6\", Full HD+', 'Android 13', 'Chính 48 MP & Phụ 8 MP, 5 MP', '13 MP', 'MediaTek Dimensity 1080 8 nhân', '8 GB', '256 GB', '2 Nano SIMHỗ trợ 5G', '5000 mAh, 25 W', '\r\nSamsung', 2),
(23, 'Samsung Galaxy A25 5G', 6990000, 'samsung-galaxy-a25-5g-xanh-duong-thumb-600x600.jpg', 'Super AMOLED6.5\"Full HD+', 'Android 14', 'Chính 50 MP & Phụ 8 MP, 2 MP', '13 MP', 'Exynos 1280', '8 GB', '128 GB', '2 Nano SIMHỗ trợ 5G', '5000 mAh, 25 W', 'Samsung', 2),
(24, 'Samsung Galaxy A15 5G', 6290000, 'samsung-galaxy-a15-5g-xanh-duong-nhat-thumb-600x600.jpg', 'Super AMOLED, 6.5\", Full HD+', 'Android 14', 'Chính 50 MP & Phụ 5 MP, 2 MP', '13 MP', 'MediaTek Dimensity 6100+', '8 GB', '256 GB', '2 Nano SIM, Hỗ trợ 5G', '5000 mAh, 25 W', 'Samsung', 2),
(25, 'Samsung Galaxy A15', 5590000, 'thumb-xanh-duong-4g-600x600.jgb', 'Super AMOLED, 6.5\", Full HD+', 'Android 14', 'Chính 50 MP & Phụ 5 MP, 2 MP', '13 MP', 'MediaTek Helio G99', '8 GB\r\n', '256 GB', '2 Nano SIM, Hỗ trợ 4G', '5000 mAh, 25 W', 'Samsung', 2),
(26, 'Samsung Galaxy A24', 4590000, 'samsung-galaxy-a24-black-thumb-600x600.jpg', 'Super AMOLED, 6.5\", Full HD+', 'Android 13', 'Chính 50 MP & Phụ 5 MP, 2 MP', '13 MP', 'MediaTek Helio G99', '6 GB', '128 GB', '2 Nano SIMHỗ trợ 4G', '5000 mAh, 25 W', 'Samsung', 2),
(27, 'Samsung Galaxy A14 5G', 3640000, 'samsung-galaxy-a14-5g-thumb-nau-600x600.jpg', 'PLS LCD, 6.6\", Full HD+', 'Android 13', 'Chính 50 MP & Phụ 2 MP, 2 MP', '13 MP', 'MediaTek Dimensity 700', '4 GB\r\n', '128 GB', '2 Nano SIM,Hỗ trợ 5G', '5000 mAh, 15 W', 'Samsung', 2),
(28, 'Samsung Galaxy A05s', 4490000, 'samsung-galaxy-a05s-sliver-thumbnew-600x600.jpg', 'PLS LCD, 6.7\", Full HD+', 'Android 13', 'Chính 50 MP & Phụ 2 MP, 2 MP', '13 MP', 'Snapdragon 680', '6 GB', '128 GB', '2 Nano SIM, Hỗ trợ 4G', '5000 mAh, 25 W', 'Samsung', 2),
(29, 'Samsung Galaxy A05', 3490000, 'samsung-galaxy-a05-black-thumbnew-600x600.jpg', 'PLS LCD6.7\"HD+', 'Android 13', 'Chính 50 MP & Phụ 2 MP', '8 MP', 'MediaTek Helio G85', '6 GB', '128 GB', '2 Nano SIM, Hỗ trợ 4G', '5000 mAh, 25 W', 'Samsung', 2),
(30, 'Samsung Galaxy Z Fold5 5G', 36990000, 'samsung-galaxy-z-fold5-blue-thumbnew-600x600.jpg', 'Dynamic AMOLED 2XChính 7.6\" & Phụ 6.2\"Quad HD+ (2K+)', 'Android 13', 'Chính 50 MP & Phụ 12 MP, 10 MP', '10 MP & 4 MP', 'Snapdragon 8 Gen 2 for Galaxy', '12 GB', '256 GB', '2 Nano SIM hoặc 1 Nano SIM + 1 eSIM,Hỗ trợ 5G', '4400 mAh, 25 W', 'Samsung', 2),
(31, 'OPPO A58', 5490000, 'oppo-a58-4g-green-thumb-600x600.jpg', 'LTPS LCD, 6.72\", Full HD+', 'Android 13', 'Chính 50 MP & Phụ 2 MP', '8 MP', 'MediaTek Helio G85', '8 GB', '128 GB', '2 Nano SIM, Hỗ trợ 4G', '5000 mAh, 33 W', 'OPPO', 2),
(32, 'OPPO A18', 3290000, 'oppo-a18-xanh-thumb-1-2-3-600x600.jpg', 'IPS LCD6.56\"HD+', 'Android 13', 'Chính 8 MP & Phụ 2 MP', '5 MP', 'MediaTek Helio G85', '4 GB', '64 GB\r\n', '2 Nano SIMHỗ trợ 4G', '5000 mAh, 10 W', 'OPPO', 3),
(33, 'OPPO Reno10 5G', 8690000, 'oppo-reno10-blue-thumbnew-600x600.jpg', 'AMOLED6.7\"Full HD+', 'Android 13', 'Chính 64 MP & Phụ 32 MP, 8 MP', '32 MP', 'MediaTek Dimensity 7050 5G 8 nhân', '8 GB\r\n', '256 GB', '2 Nano SIM (SIM 2 chung khe thẻ nhớ)Hỗ trợ 5G', '5000 mAh, 67 W', 'OPPO', 3),
(34, 'OPPO Reno10 Pro 5G', 11290000, 'oppo-reno10-pro-grey-thumbnew-600x600.jpg', 'AMOLED6.7\"Full HD+', 'Android 13', 'Chính 50 MP & Phụ 32 MP, 8 MP', '32 MP', 'Snapdragon 778G 5G', '12 GB', '256 GB', '2 Nano SIM,Hỗ trợ 5G', '4600 mAh,80 W', 'OPPO', 3),
(35, 'OPPO Reno10 Pro+ 5G', 15990000, 'oppo-reno10-pro-plus-xam-thumbnew-600x600.jpg', 'AMOLED6.74\"1.5K+', 'Android 13', 'Chính 50 MP & Phụ 64 MP, 8 MP', '32 MP', 'Snapdragon 8+ Gen 1', '12 GB', '256 GB', '2 Nano SIM,Hỗ trợ 5G', '4700 mAh, 100 W', 'OPPO', 3),
(36, 'OPPO Reno10 Pro+ 5G ', 15990000, 'oppo-reno10-pro-plus-xam-thumbnew-600x600.jpg', 'AMOLED6.74\"1.5K+', 'Android 13', 'Chính 50 MP & Phụ 64 MP, 8 MP', '32 MP', 'Snapdragon 8+ Gen 1', '12 GB', '256 GB', '2 Nano SIM,Hỗ trợ 5G', '4700 mAh, 100 W', 'OPPO', 3),
(37, 'OPPO Reno8 T', 6690000, 'oppo-reno8t-4g-cam1-thumb-600x600.jpg', 'AMOLED6.4\"Full HD+', 'Android 13', 'Chính 100 MP & Phụ 2 MP, 2 MP', '32 MP', 'MediaTek Helio G99', '8 GB', '256 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh,33 W', 'OPPO', 3),
(38, 'OPPO Find N3 5G ', 41990000, 'oppo-find-n3-vang-dong-thumb-600x600.jpg', 'AMOLED, Chính 7.82\" & Phụ 6.31\"Quad HD+ (2K+)', 'Android 13', 'Chính 48 MP & Phụ 48 MP, 64 MP', 'Trong: 20 MP & Ngoài: 32 MP', 'Snapdragon 8 Gen 2 8 nhân', '16 GB', '512 GB', '2 Nano SIM hoặc 1 Nano SIM + 1 eSIM,Hỗ trợ 5G', '4805 mAh,67 W', 'OPPO', 3),
(39, 'OPPO Find N3 Flip 5G', 22990000, 'oppo-find-n3-flip-pink-thumb-600x600.jpg', 'AMOLED, Chính 6.8\" & Phụ 3.26\"Full HD+', 'Android 13', 'Chính 50 MP & Phụ 48 MP, 32 MP', '32 MP', 'MediaTek Dimensity 9200 5G 8 nhân', '12 GB', '256 GB', '2 Nano SIM,Hỗ trợ 5G', '4300 mAh,44 W', 'OPPO', 3),
(40, 'OPPO A79 5G', 7990000, 'oppo-a79-5g-tim-thumb-1-2-600x600.jpg', 'LTPS LCD6.72\"Full HD+', 'Android 13', 'Chính 50 MP & Phụ 2 MP', '8 MP', 'MediaTek Dimensity 6020 5G 8 nhân', '8 GB', '256 GB', '2 Nano SIM,Hỗ trợ 5G', '5000 mAh,33 W', 'OPPO', 3),
(41, ' Xiaomi Redmi Note 13', 4790000, 'xiaomi-redmi-note-13-gold-thumb-600x600.jpg', 'AMOLED, 6.67\", Full HD+', 'Android 13', 'Chính 108 MP & Phụ 8 MP, 2 MP', '16 MP', 'Snapdragon 685 8 nhân', '8 GB', '128 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh,33 W', 'Xiaomi', 4),
(42, 'Xiaomi Redmi Note 13 Pro', 6290000, 'xiaomi-redmi-note-13-green-thumb-600x600.jpg', 'AMOLED, 6.67\", Full HD+', 'Android 13', 'Chính 200 MP & Phụ 8 MP, 2 MP', '16 MP', 'MediaTek Helio G99-Ultra 8 nhân', '8 GB', '128 GB', '2 Nano SIM (SIM 2 chung khe thẻ nhớ).Hỗ trợ 4G', '5000 mAh,67 W', 'Xiaomi', 4),
(43, 'Xiaomi Redmi 13C', 2790000, 'xiaomi-redmi-13c-xanh-la-1-2-3-600x600.jpg', 'IPS LCD, 6.74\", HD+', 'Android 13', 'Chính 50 MP & Phụ 2 MP', '8 MP', 'MediaTek Helio G85', '4 GB', '128 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh, 18 W', 'Xiaomi', 4),
(44, 'Xiaomi Redmi 12', 3490000, 'xiaomi-redmi-12-den-thumb-text-600x600.jpg', 'IPS LCD, 6.79\", Full HD+', 'Android 13', 'Chính 50 MP & Phụ 8 MP, 2 MP', '8 MP', 'MediaTek Helio G88', '4 GB', '128 GB', '2 Nano SIM (SIM 2 chung khe thẻ nhớ).Hỗ trợ 4G', '5000 mAh, 18 W', 'Xiaomi', 4),
(45, 'Xiaomi Redmi A3', 2490000, 'xiaomi-redmi-note-13-green-thumb-600x600.jpg', 'IPS LCD, 6.71\", HD+', 'Android 14', 'Chính 8 MP & Phụ 0.08 MP', '5 MP', 'MediaTek Helio G36 8 nhân', '3 GB', '64 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh, 10 W', 'Xiaomi', 4),
(46, 'Xiaomi Redmi Note 13 Pro 5G', 8990000, 'xiaomi-redmi-note-13-pro-5g-violet-thumb-600x600.jpg', 'AMOLED, 6.67\", 1.5K', 'Android 13', 'Chính 200 MP & Phụ 8 MP, 2 MP', '16 MP', 'Snapdragon 7s Gen 2 8 nhân', '8 GB', '256 GB', '2 Nano SIMHỗ trợ 5G', '5100 mAh,67 W', 'Xiaomi', 4),
(47, 'Xiaomi 14 5G', 21490000, 'xiaomi-14-green-thumbnew-600x600.jpg', 'AMOLED, 6.36\", 1.5K', 'Android 14', 'Chính 50 MP & Phụ 50 MP, 50 MP', '32 MP', 'Snapdragon 8 Gen 3 8 nhân', '12 GB', '512 GB', '2 Nano SIM, Hỗ trợ 5G', '4610 mAh,90 W', 'Xiaomi', 4),
(48, 'Xiaomi 14 Ultra', 29990000, 'xiaomi-14-ultra-white-thumb-600x600.jpg', 'AMOLED, 6.73\", Quad HD+ (2K+)', 'Android 14', '4 camera 50 MP', '32 MP', 'Snapdragon 8 Gen 3 8 nhân', '16 GB', '512 GB', '2 Nano SIM, Hỗ trợ 5G', '5000 mAh, 90 W', 'Xiaomi', 4),
(49, 'Xiaomi 13T 5G', 10990000, 'xiaomi-13-t-xanh-duong-thumb-thumb-600x600.jpg', 'AMOLED, 6.67\", 1.5K', 'Android 13', 'Chính 50 MP & Phụ 50 MP, 12 MP', '20 MP', 'MediaTek Dimensity 8200-Ultra', '8 GB', '256 GB', '2 Nano SIM, Hỗ trợ 5G', '5000 mAh, 67 W\r\n', 'Xiaomi', 4),
(50, 'Xiaomi Redmi Note 13 Pro+', 9990000, 'xiaomi-redmi-note-13-pro-plus-black-thumb-600x600.jpg', 'AMOLED, 6.67\", 1.5K', 'Android 13', 'Chính 200 MP & Phụ 8 MP, 2 MP', '16 MP', 'MediaTek Dimensity 7200 Ultra', '8 GB', '256 GB', '2 Nano SIM,Hỗ trợ 5G', '5000 mAh, 120 W', 'Xiaomi.', 4),
(51, 'realme C65', 4790000, 'realme-c65-thumb-1-600x600.jpg', 'IPS LCD, 6.67\", HD+', 'Android 14', 'Chính 50 MP & Cảm biến Flicker', '8 MP', 'MediaTek Helio G85', '8 GB', '256 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh, 45 W', 'realme', 6),
(52, 'realme Note 50', 2490000, 'realme-note-50-blue-thumb-600x600.jpg', 'IPS LCD, 6.74\", HD+', 'Android 13', 'Chính 13 MP & Phụ 0.08 MP', '5 MP', 'Unisoc Tiger T612', '3 GB', '64 GB', '2 Nano SIMHỗ trợ 4G', '5000 mAh, 10 W', 'realme', 6),
(53, 'realme C55', 3990000, 'realme-c35-vang-thumb-600x600.jpg', 'IPS LCD, 6.72\", Full HD+', 'Android 13', 'Chính 64 MP & Phụ 2 MP', '8 MP', 'MediaTek Helio G88', '6 GB', '128 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh,33 W', 'realme', 6),
(54, 'realme C67', 4990000, 'realme-c67-xanh-thumb-600x600.jpg', 'IPS LCD, 6.72\", Full HD+', 'Android 14', '8 MP', 'Snapdragon 685 8 nhân', '8 GB', '128 GB', '2 Nano SIM, Hỗ trợ 4G', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh, 33 W', 'realme', 6),
(56, 'realme 11', 6990000, 'realme-11-thumb-600x600.jpg', 'Super AMOLED, 6.4\", Full HD+', 'Android 13', 'Chính 108 MP & Phụ 2 MP', '16 MP', 'MediaTek Helio G99', '8 GB', '256 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh,67 W', 'realme', 6),
(57, 'realme C53', 4290000, 'realme-c53-gold-thumb-1-600x600.jpg', 'IPS LCD,6.74\",HD+', 'Android 13', 'Chính 50 MP & Phụ 0.08 MP', '8 MP', 'Unisoc Tiger T612', '6 GB', '128 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh, 33 W', 'realme', 6),
(58, 'realme C51', 3290000, 'realme-c51-xanh-thumbnail-600x600.jpg', 'IPS LCD, 6.74\", HD+', 'Android 13', 'Chính 50 MP & Phụ 0.3 MP', '5 MP', 'Unisoc Tiger T612', '4 GB', '64 GB', '2 Nano SIM, Hỗ trợ 4G', '5000 mAh, 33 W', 'realme', 6),
(59, 'realme 11 Pro+ 5G ', 12990000, 'realme-11-pro-plus-5g-thumb-600x600.jpg', 'AMOLED, 6.7\", Full HD+\r\n', 'Android 13', 'Chính 200 MP & Phụ 8 MP, 2 MP', '32 MP', 'MediaTek Dimensity 7050 5G 8 nhân', '12 GB', '512 GB', '2 Nano SIM,Hỗ trợ 5G', '5000 mAh, 100 W', 'realme', 6),
(60, 'realme C60', 2790000, 'realme-note-50-blue-thumb-600x600.jpg', 'IPS LCD, 6.74\", HD+', 'Android 13', 'Chính 13 MP & Phụ 0.08 MP', '5 MP', 'Unisoc Tiger T612', '4 GB', '64 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh, 10 W', 'realme', 6),
(61, 'vivo Y100', 7690000, 'vivo-y100-xanh-thumb-1-600x600.jpg', 'AMOLED, 6.67\", Full HD+', 'Android 14', 'Chính 50 MP & Phụ 2 MP, Flicker', '8 MP', 'Snapdragon 685 8 nhân', '8 GB', '256 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh, 80 W', 'vivo', 5),
(62, 'vivo Y36', 5040000, 'vivo-y36-xanh-thumbnew-600x600.jpg', 'IPS LCD, 6.64\", Full HD+', 'Android 13', 'Chính 50 MP & Phụ 2 MP', '16 MP', 'Snapdragon 680', '8 GB', '128 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh,44 W\r\n', 'vivo', 5),
(63, 'vivo Y03', 3290000, 'vivo-y03-xanh-thumb-1-600x600.jpg', 'IPS LCD, 6.56\",HD+', 'Android 14', 'Chính 13 MP & Phụ 0.08 MP', '5 MP', 'MediaTek Helio G85', '4 GB', '128 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh,15 W', 'vivo', 5),
(64, 'vivo Y17s', 3990000, 'vivo-y17s-thumb-600x600.jpg', 'IPS LCD, 6.56\", HD+', 'Android 13', 'Chính 50 MP & Phụ 2 MP', '8 MP', 'MediaTek Helio G85', '6 GB', '128 GB', '2 Nano SIM,Hỗ trợ 4G', '5000 mAh,15 W', 'vivo.', 5),
(66, 'vivo V30 5G', 13990000, 'vivo-v30-thumbn-600x600.jpg', 'AMOLED, 6.78\", 1.5K', 'Android 14', 'Chính 50 MP & Phụ 50 MP', '50 MP', 'Snapdragon 7 Gen 3 8 nhân', '12 GB', '512 GB', '2 Nano SIM,Hỗ trợ 5G', '5000 mAh,80 W', 'vivo', 5),
(67, 'vivo V29e 5G', 9990000, 'vivo-v29e-thumb-600x600.jpg', 'AMOLED, 6.67\", Full HD+', 'Android 13', 'Chính 64 MP & Phụ 8 MP', '50 MP\r\n', 'Snapdragon 695 5G', '12 GB', '256 GB', '2 Nano SIM,Hỗ trợ 5G', '4800 mAh,44 W', 'vivo. ', 5),
(68, 'vivo V30e 5G', 10490000, 'vivo-v30e-nau-thumb-600x600.jpg', 'AMOLED,6.78\",Full HD+', 'Android 14', 'Chính 50 MP & Phụ 8 MP', '32 MP', 'Snapdragon 6 Gen 1 8 nhân', '12 GB', '256 GB', '2 Nano SIM,Hỗ trợ 5G', '5500 mAh,44 W', 'vivo', 5),
(69, 'HONOR X8b', 7690000, 'honor-x8b-green-thumb-1-600x600.jpg', 'AMOLED,6.7\",Full HD+', 'Android 13', 'Chính 108 MP & Phụ 5 MP, 2 MP', '50 MP', 'Snapdragon 680', '8 GB', '512 GB', '2 Nano SIMHỗ trợ 4G', '4500 mAh, 35 W', 'HONOR', 7),
(70, 'HONOR 90 Lite', 5490000, 'honor-90-lite-xanh-thumb-600x600.jpg', 'LTPS LCD,6.7\",Full HD+\r\n', 'Android 13', 'Chính 100 MP & Phụ 5 MP, 2 MP', '16 MP', 'MediaTek Dimensity 6020 5G 8 nhân', '8 GB', '256 GB', '2 Nano SIM,Hỗ trợ 5G\r\n', '4500 mAh,22.5 W', 'HONOR', 7);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD PRIMARY KEY (`id_hoa_don`,`id_san_pham`),
  ADD KEY `FK_CTHD_SP` (`id_san_pham`);

--
-- Chỉ mục cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`id_danh_gia`),
  ADD KEY `FK_DG_KH` (`id_khach_hang`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`id_hoa_don`),
  ADD KEY `FK_HD_KH` (`id_khach_hang`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id_khach_hang`);

--
-- Chỉ mục cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`id_khuyen_mai`),
  ADD KEY `FK_KM_SP` (`id_san_pham`);

--
-- Chỉ mục cho bảng `loai_nhan_vien`
--
ALTER TABLE `loai_nhan_vien`
  ADD PRIMARY KEY (`id_loai_nhan_vien`);

--
-- Chỉ mục cho bảng `loai_san_pham`
--
ALTER TABLE `loai_san_pham`
  ADD PRIMARY KEY (`id_loai`);

--
-- Chỉ mục cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`id_nhan_vien`),
  ADD KEY `FK_NV_LNV` (`id_loai_nhan_vien`);

--
-- Chỉ mục cho bảng `phan_hoi`
--
ALTER TABLE `phan_hoi`
  ADD PRIMARY KEY (`id_phan_hoi`),
  ADD KEY `FK_PH_KH` (`id_khach_hang`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id_san_pham`),
  ADD KEY `FK_SP_LSP` (`id_loai`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  MODIFY `id_danh_gia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `id_hoa_don` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `id_khach_hang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  MODIFY `id_khuyen_mai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loai_nhan_vien`
--
ALTER TABLE `loai_nhan_vien`
  MODIFY `id_loai_nhan_vien` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loai_san_pham`
--
ALTER TABLE `loai_san_pham`
  MODIFY `id_loai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  MODIFY `id_nhan_vien` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phan_hoi`
--
ALTER TABLE `phan_hoi`
  MODIFY `id_phan_hoi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_san_pham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD CONSTRAINT `FK_CTHD_HD` FOREIGN KEY (`id_hoa_don`) REFERENCES `hoa_don` (`id_hoa_don`),
  ADD CONSTRAINT `FK_CTHD_SP` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`);

--
-- Các ràng buộc cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD CONSTRAINT `FK_DG_KH` FOREIGN KEY (`id_khach_hang`) REFERENCES `khach_hang` (`id_khach_hang`);

--
-- Các ràng buộc cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `FK_HD_KH` FOREIGN KEY (`id_khach_hang`) REFERENCES `khach_hang` (`id_khach_hang`);

--
-- Các ràng buộc cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD CONSTRAINT `FK_KM_SP` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`);

--
-- Các ràng buộc cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD CONSTRAINT `FK_NV_LNV` FOREIGN KEY (`id_loai_nhan_vien`) REFERENCES `loai_nhan_vien` (`id_loai_nhan_vien`);

--
-- Các ràng buộc cho bảng `phan_hoi`
--
ALTER TABLE `phan_hoi`
  ADD CONSTRAINT `FK_PH_KH` FOREIGN KEY (`id_khach_hang`) REFERENCES `khach_hang` (`id_khach_hang`);

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `FK_SP_LSP` FOREIGN KEY (`id_loai`) REFERENCES `loai_san_pham` (`id_loai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
