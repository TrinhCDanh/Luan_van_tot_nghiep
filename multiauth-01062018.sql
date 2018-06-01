/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost:3306
 Source Schema         : multiauth

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 01/06/2018 22:39:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ca
-- ----------------------------
DROP TABLE IF EXISTS `ca`;
CREATE TABLE `ca`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tenca` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tietso` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '123 - 456 - 789 - 012',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ca
-- ----------------------------
INSERT INTO `ca` VALUES (1, 'Ca 1', '123');
INSERT INTO `ca` VALUES (3, 'Ca 2', '456');
INSERT INTO `ca` VALUES (4, 'Ca 3', '789');
INSERT INTO `ca` VALUES (5, 'Ca 4', '012');
INSERT INTO `ca` VALUES (6, 'Ca 5', '345');

-- ----------------------------
-- Table structure for chitiet_truc
-- ----------------------------
DROP TABLE IF EXISTS `chitiet_truc`;
CREATE TABLE `chitiet_truc`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hocky_id` int(5) NOT NULL,
  `thu_id` int(5) NOT NULL,
  `ca_id` int(5) NOT NULL,
  `kythuatvien_id` int(11) NULL DEFAULT NULL,
  `ghichu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `hocky_id`, `thu_id`, `ca_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of chitiet_truc
-- ----------------------------
INSERT INTO `chitiet_truc` VALUES (7, 1, 1, 1, 2, NULL);
INSERT INTO `chitiet_truc` VALUES (5, 3, 1, 1, 4, NULL);
INSERT INTO `chitiet_truc` VALUES (10, 3, 6, 5, 4, NULL);
INSERT INTO `chitiet_truc` VALUES (15, 3, 7, 4, 3, NULL);
INSERT INTO `chitiet_truc` VALUES (11, 3, 8, 3, 3, NULL);
INSERT INTO `chitiet_truc` VALUES (12, 3, 1, 6, 1, NULL);
INSERT INTO `chitiet_truc` VALUES (13, 1, 4, 4, 3, NULL);
INSERT INTO `chitiet_truc` VALUES (14, 1, 6, 4, 4, NULL);
INSERT INTO `chitiet_truc` VALUES (16, 3, 2, 4, 2, NULL);
INSERT INTO `chitiet_truc` VALUES (17, 3, 4, 3, 2, NULL);

-- ----------------------------
-- Table structure for giangvien
-- ----------------------------
DROP TABLE IF EXISTS `giangvien`;
CREATE TABLE `giangvien`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `giangvien_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of giangvien
-- ----------------------------
INSERT INTO `giangvien` VALUES (1, 'Giangvien', 'giangvien@giangvien.com', '$2y$10$1wDlJkCKiDvhh/dsPdp2M.Q.WMnv6hV1ALtfJVbBwBH39KLnBR/ti', 'q7DmSSCgKjNaUnStrovAlDEsLACbRfHLTRJaeg9WBkXGFd1obLgXdK1e3SQN', 1, '2018-05-16 07:44:16', '2018-05-16 07:44:16');

-- ----------------------------
-- Table structure for hocky
-- ----------------------------
DROP TABLE IF EXISTS `hocky`;
CREATE TABLE `hocky`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tenhocky` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Học kỳ I, II, Hè',
  `namhoc` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ngaybatdau` date NULL DEFAULT NULL COMMENT 'ngày bắt đầu của học kỳ',
  `ngayketthuc` date NULL DEFAULT NULL COMMENT 'ngày kết thúc của học kỳ',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hocky
-- ----------------------------
INSERT INTO `hocky` VALUES (1, 'Học kỳ I', '2018 - 2019', '2018-09-01', '2018-12-31');
INSERT INTO `hocky` VALUES (3, 'Học kỳ II', '2017 - 2018', '2018-01-31', '2018-06-01');

-- ----------------------------
-- Table structure for image
-- ----------------------------
DROP TABLE IF EXISTS `image`;
CREATE TABLE `image`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of image
-- ----------------------------
INSERT INTO `image` VALUES (1, '1527863958.jpeg');
INSERT INTO `image` VALUES (2, '1527864030.jpeg');

-- ----------------------------
-- Table structure for kythuatvien
-- ----------------------------
DROP TABLE IF EXISTS `kythuatvien`;
CREATE TABLE `kythuatvien`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `makythuatvien` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `makythuatvien`) USING BTREE,
  UNIQUE INDEX `kythuatvien_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kythuatvien
-- ----------------------------
INSERT INTO `kythuatvien` VALUES (1, 'KTV01', 'Kythuatvien', 'kythuatvien@kythuatvien.com', '$2y$10$b2GPrchILm8FWhZ/udKtquqvyZ2zK/rioJsHbY8QMPUAFGI1Emng.', 'DDaIQdU5qELNjN6G49djmGqX4izGTvfdLY0tCclhverNTlgFCzRencfgpZT5', 1, '2018-05-16 07:44:16', '2018-05-16 07:44:16');
INSERT INTO `kythuatvien` VALUES (2, 'KTV02', 'Kythuatvien Two', 'kythuatvien02@gmail.com', '$2y$10$3.pUu3OmKilbhDevmEksUuxaSUdYrl5IUOlDzIvMK7omJjvP0wHae', '071Vq7V4YhbRVAu8RYaU1IVDGJ0d2yRW7igVwIZuLtrOH3ylskfhUzFrXVMv', 1, '2018-05-28 09:42:25', '2018-05-29 14:07:12');
INSERT INTO `kythuatvien` VALUES (3, 'KTV03', 'Kythuatvien Three', 'kythuatvien03@gmail.com', '$2y$10$8iCMgiew0WS4lzqLtwuna.k3/bN9c.49t1rtLmTU24LBI/BNf55F6', '8wKZBXVFeeNKMsqJ9NcTrhetEks1PgH6hCHrFRJmK9WcXwliF7GXlZv48o5J', 1, '2018-05-28 09:43:10', '2018-05-29 14:41:23');
INSERT INTO `kythuatvien` VALUES (4, 'KTV04', 'Trần Cao Minh Thiệp Pháo', 'kythuatvien04@gmail.com', '$2y$10$wZb02dyOzoM/VFF8gZBahOpURTCATuYP0aJQN3yuKIhiIvL4eKNDe', NULL, 0, '2018-05-29 12:09:30', '2018-05-31 16:35:12');

-- ----------------------------
-- Table structure for lop
-- ----------------------------
DROP TABLE IF EXISTS `lop`;
CREATE TABLE `lop`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tenlop` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `siso` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lop
-- ----------------------------
INSERT INTO `lop` VALUES (1, 'D14_TH01', 35);
INSERT INTO `lop` VALUES (2, 'D14_TH02', 30);

-- ----------------------------
-- Table structure for may
-- ----------------------------
DROP TABLE IF EXISTS `may`;
CREATE TABLE `may`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sothutumay` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'số thứ tự của từng máy',
  `tinhtrang` int(1) NULL DEFAULT NULL,
  `phongmay_id` int(11) NULL DEFAULT NULL COMMENT 'một phòng máy có nhiều máy',
  `slug` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`, `slug`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 40 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of may
-- ----------------------------
INSERT INTO `may` VALUES (1, '1', 0, 5, '');
INSERT INTO `may` VALUES (2, '2', 0, 5, '');
INSERT INTO `may` VALUES (3, '3', 0, 5, '');
INSERT INTO `may` VALUES (4, '4', 0, 5, '');
INSERT INTO `may` VALUES (14, '1', 0, 10, '');
INSERT INTO `may` VALUES (15, '2', 0, 10, '');
INSERT INTO `may` VALUES (7, '3', 0, 1, '');
INSERT INTO `may` VALUES (16, '3', 0, 10, '');
INSERT INTO `may` VALUES (17, '4', 0, 10, '');
INSERT INTO `may` VALUES (18, '1', 0, 11, '');
INSERT INTO `may` VALUES (19, '1', 0, 12, '');
INSERT INTO `may` VALUES (20, '01', 0, 15, '01');
INSERT INTO `may` VALUES (21, '02', 0, 15, '02');
INSERT INTO `may` VALUES (22, '03', 0, 15, '03');
INSERT INTO `may` VALUES (23, '04', 0, 15, '04');
INSERT INTO `may` VALUES (24, '05', 0, 15, '05');
INSERT INTO `may` VALUES (25, '06', 0, 15, '06');
INSERT INTO `may` VALUES (26, '07', 0, 15, '07');
INSERT INTO `may` VALUES (27, '08', 0, 15, '08');
INSERT INTO `may` VALUES (28, '09', 0, 15, '09');
INSERT INTO `may` VALUES (29, '10', 0, 15, '10');
INSERT INTO `may` VALUES (30, '11', 0, 15, '11');
INSERT INTO `may` VALUES (31, 'P10_01', 0, 16, 'p10-01');
INSERT INTO `may` VALUES (32, 'P10_02', 0, 16, 'p10-02');
INSERT INTO `may` VALUES (33, 'P10_03', 0, 16, 'p10-03');
INSERT INTO `may` VALUES (36, 'P10_04', 0, 16, 'p10-04');
INSERT INTO `may` VALUES (37, 'P10_05', 0, 16, 'p10-05');
INSERT INTO `may` VALUES (38, 'P10_06', 0, 16, 'p10-06');
INSERT INTO `may` VALUES (39, 'P10_07', 0, 16, 'p10-07');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2018_05_16_072056_create_giangvien_table', 1);
INSERT INTO `migrations` VALUES (4, '2018_05_16_072208_create_kythuatvien_table', 1);

-- ----------------------------
-- Table structure for monhoc
-- ----------------------------
DROP TABLE IF EXISTS `monhoc`;
CREATE TABLE `monhoc`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mamonhoc` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tenmonhoc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ngaybatdau` date NULL DEFAULT NULL,
  `ngayketthuc` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of monhoc
-- ----------------------------
INSERT INTO `monhoc` VALUES (4, 'MH04', 'BBBCCC', '2018-05-29', '2018-05-31');
INSERT INTO `monhoc` VALUES (5, 'MH05', 'CCC', '2018-05-14', '2018-05-31');
INSERT INTO `monhoc` VALUES (7, 'HHH', 'HHH', '2018-06-01', '2018-06-30');
INSERT INTO `monhoc` VALUES (6, 'FFF', 'FFF', '2018-05-29', '2018-05-31');
INSERT INTO `monhoc` VALUES (8, 'EEE', 'EEE', '2018-06-01', '2018-06-21');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for phongmay
-- ----------------------------
DROP TABLE IF EXISTS `phongmay`;
CREATE TABLE `phongmay`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id phân biệt dựa vào tên phòng máy',
  `slug` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tenphongmay` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'PM1, PM2, PM3,...',
  `soluongmay` int(2) NULL DEFAULT NULL COMMENT 'số lượng pc có trong phòng',
  PRIMARY KEY (`id`, `slug`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of phongmay
-- ----------------------------
INSERT INTO `phongmay` VALUES (1, 'pm1', 'PM1', 1);
INSERT INTO `phongmay` VALUES (2, '', 'PM2', 2);
INSERT INTO `phongmay` VALUES (4, '', 'PM3', 10);
INSERT INTO `phongmay` VALUES (9, '', 'PM5', 0);
INSERT INTO `phongmay` VALUES (10, '', 'PM6', 4);
INSERT INTO `phongmay` VALUES (11, '', 'PM6', 1);
INSERT INTO `phongmay` VALUES (12, 'pm7', 'PM7', 1);
INSERT INTO `phongmay` VALUES (14, 'pm8', 'PM8', 11);
INSERT INTO `phongmay` VALUES (15, 'pm9', 'PM9', 11);
INSERT INTO `phongmay` VALUES (16, 'pm10', 'PM10', 7);

-- ----------------------------
-- Table structure for thu
-- ----------------------------
DROP TABLE IF EXISTS `thu`;
CREATE TABLE `thu`  (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tenthu` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'thứ hai, thứ ba, thứ tư,...',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of thu
-- ----------------------------
INSERT INTO `thu` VALUES (1, 'Thứ hai');
INSERT INTO `thu` VALUES (2, 'Thứ ba');
INSERT INTO `thu` VALUES (4, 'Thứ tư');
INSERT INTO `thu` VALUES (5, 'Thứ năm');
INSERT INTO `thu` VALUES (6, 'Thứ sáu');
INSERT INTO `thu` VALUES (7, 'Thứ bảy');
INSERT INTO `thu` VALUES (8, 'Chủ nhật');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin', 'admin@admin.com', '$2y$10$ppbXPqqY2uUWdya0EItkDOuQzxtqGrWwGClMAMbztAGFQ0W/iUzFe', 'WFWbSECkpN5PxO6pm7LALs3N7RAOoF7zZ5aN79DCeCiy33US1aTh6KqBQ39F', '2018-05-16 07:34:36', '2018-05-16 07:34:36');

SET FOREIGN_KEY_CHECKS = 1;
