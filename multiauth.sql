-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th5 25, 2018 lúc 02:06 PM
-- Phiên bản máy phục vụ: 5.7.21
-- Phiên bản PHP: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `multiauth`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ca`
--

DROP TABLE IF EXISTS `ca`;
CREATE TABLE IF NOT EXISTS `ca` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tenca` varchar(20) DEFAULT NULL,
  `tietso` varchar(20) DEFAULT NULL COMMENT '123 - 456 - 789 - 012',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ca`
--

INSERT INTO `ca` (`id`, `tenca`, `tietso`) VALUES
(1, 'Ca 1', '123'),
(3, 'Ca 2', '456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_truc`
--

DROP TABLE IF EXISTS `chitiet_truc`;
CREATE TABLE IF NOT EXISTS `chitiet_truc` (
  `id` int(11) NOT NULL,
  `hocky_id` int(5) NOT NULL,
  `thu_id` int(5) NOT NULL,
  `ca_id` int(5) NOT NULL,
  `kythuatvien_id` int(11) DEFAULT NULL,
  `ghichu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`hocky_id`,`thu_id`,`ca_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

DROP TABLE IF EXISTS `giangvien`;
CREATE TABLE IF NOT EXISTS `giangvien` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `giangvien_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giangvien`
--

INSERT INTO `giangvien` (`id`, `username`, `email`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Giangvien', 'giangvien@giangvien.com', '$2y$10$1wDlJkCKiDvhh/dsPdp2M.Q.WMnv6hV1ALtfJVbBwBH39KLnBR/ti', 'q7DmSSCgKjNaUnStrovAlDEsLACbRfHLTRJaeg9WBkXGFd1obLgXdK1e3SQN', 1, '2018-05-16 00:44:16', '2018-05-16 00:44:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocky`
--

DROP TABLE IF EXISTS `hocky`;
CREATE TABLE IF NOT EXISTS `hocky` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tenhocky` varchar(100) DEFAULT NULL COMMENT 'Học kỳ I, II, Hè',
  `namhoc` varchar(20) DEFAULT NULL,
  `ngaybatdau` date DEFAULT NULL COMMENT 'ngày bắt đầu của học kỳ',
  `ngayketthuc` date DEFAULT NULL COMMENT 'ngày kết thúc của học kỳ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hocky`
--

INSERT INTO `hocky` (`id`, `tenhocky`, `namhoc`, `ngaybatdau`, `ngayketthuc`) VALUES
(1, 'học kỳ IXX', 'fafadf', '2018-05-31', '2018-06-30'),
(3, 'Học kỳ II', '2019 - 2020', '2018-05-17', '2018-05-24'),
(15, 'fff', 'fdaf', '2018-05-21', '2018-05-29'),
(16, 'XXX', 'XXX', '2018-05-20', '2018-05-26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kythuatvien`
--

DROP TABLE IF EXISTS `kythuatvien`;
CREATE TABLE IF NOT EXISTS `kythuatvien` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kythuatvien_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kythuatvien`
--

INSERT INTO `kythuatvien` (`id`, `name`, `email`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kythuatvien', 'kythuatvien@kythuatvien.com', '$2y$10$b2GPrchILm8FWhZ/udKtquqvyZ2zK/rioJsHbY8QMPUAFGI1Emng.', 'DDaIQdU5qELNjN6G49djmGqX4izGTvfdLY0tCclhverNTlgFCzRencfgpZT5', 1, '2018-05-16 00:44:16', '2018-05-16 00:44:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

DROP TABLE IF EXISTS `lop`;
CREATE TABLE IF NOT EXISTS `lop` (
  `id` varchar(10) NOT NULL,
  `tenlop` varchar(20) DEFAULT NULL,
  `siso` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`id`, `tenlop`, `siso`) VALUES
('d14-th01', 'D14_TH01', 35),
('d14-th02', 'D14_TH02', 30);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `may`
--

DROP TABLE IF EXISTS `may`;
CREATE TABLE IF NOT EXISTS `may` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sothutumay` int(5) DEFAULT NULL COMMENT 'số thứ tự của từng máy',
  `tinhtrang` int(1) DEFAULT NULL,
  `phongmay_id` int(11) DEFAULT NULL COMMENT 'một phòng máy có nhiều máy',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `may`
--

INSERT INTO `may` (`id`, `sothutumay`, `tinhtrang`, `phongmay_id`) VALUES
(1, 1, 0, 5),
(2, 2, 0, 5),
(3, 3, 0, 5),
(4, 4, 0, 5),
(14, 1, 0, 10),
(15, 2, 0, 10),
(7, 3, 0, 1),
(16, 3, 0, 10),
(17, 4, 0, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_05_16_072056_create_giangvien_table', 1),
(4, '2018_05_16_072208_create_kythuatvien_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

DROP TABLE IF EXISTS `monhoc`;
CREATE TABLE IF NOT EXISTS `monhoc` (
  `id` varchar(15) NOT NULL,
  `tenmonhoc` varchar(255) DEFAULT NULL,
  `ngaybatdau` date DEFAULT NULL,
  `ngayketthuc` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`id`, `tenmonhoc`, `ngaybatdau`, `ngayketthuc`) VALUES
('MH01', 'Môn học 01', '2018-05-25', '2018-05-31'),
('MH02', 'Môn học 02', '2018-05-25', '2018-05-31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongmay`
--

DROP TABLE IF EXISTS `phongmay`;
CREATE TABLE IF NOT EXISTS `phongmay` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id phân biệt dựa vào tên phòng máy',
  `tenphongmay` varchar(20) DEFAULT NULL COMMENT 'PM1, PM2, PM3,...',
  `soluongmay` int(2) DEFAULT NULL COMMENT 'số lượng pc có trong phòng',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phongmay`
--

INSERT INTO `phongmay` (`id`, `tenphongmay`, `soluongmay`) VALUES
(1, 'PM1', 1),
(2, 'PM2', 2),
(4, 'PM3', 10),
(9, 'PM5', 0),
(10, 'PM6', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thu`
--

DROP TABLE IF EXISTS `thu`;
CREATE TABLE IF NOT EXISTS `thu` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tenthu` varchar(20) DEFAULT NULL COMMENT 'thứ hai, thứ ba, thứ tư,...',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `thu`
--

INSERT INTO `thu` (`id`, `tenthu`) VALUES
(1, 'Thứ hai'),
(2, 'Thứ ba'),
(4, 'Thứ tư 4');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$ppbXPqqY2uUWdya0EItkDOuQzxtqGrWwGClMAMbztAGFQ0W/iUzFe', 'WFWbSECkpN5PxO6pm7LALs3N7RAOoF7zZ5aN79DCeCiy33US1aTh6KqBQ39F', '2018-05-16 00:34:36', '2018-05-16 00:34:36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
