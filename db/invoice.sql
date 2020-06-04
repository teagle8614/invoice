-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-06-03 19:30:36
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `invoice`
--

-- --------------------------------------------------------

--
-- 資料表結構 `invoice`
--

CREATE TABLE `invoice` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '流水號',
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '英文碼',
  `number` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '發票號碼',
  `period` tinyint(1) UNSIGNED NOT NULL COMMENT '期別',
  `expend` int(8) UNSIGNED NOT NULL COMMENT '花費',
  `year` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '年份'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `invoice`
--

INSERT INTO `invoice` (`id`, `code`, `number`, `period`, `expend`, `year`) VALUES
(1, 'LB', '123132', 2, 0, '2020'),
(2, 'LG', '14888886', 3, 205, '2020'),
(3, 'QQ', '88888887', 6, 305, '2019'),
(4, 'AA', '44444444', 1, 540, '2020'),
(5, 'WQ', '48515654', 1, 240, '2020'),
(6, 'DF', '18652244', 1, 360, '2020'),
(7, 'HF', '84636554', 2, 234, '2020'),
(8, 'NG', '17753978', 2, 308, '2020'),
(9, 'ZX', '45896873', 3, 550, '2020'),
(10, 'JU', '46250120', 3, 98, '2020'),
(11, 'GH', '58444444', 3, 111, '2020'),
(12, 'UH', '12345003', 4, 78, '2020'),
(13, 'KJ', '12475466', 4, 123, '2020'),
(14, 'FS', '45123698', 2, 53, '2020'),
(15, 'DS', '55874545', 6, 654, '2020'),
(16, 'JH', '18864545', 5, 326, '2020'),
(17, 'TY', '15758773', 5, 230, '2020'),
(18, 'GH', '44552169', 1, 154, '2020'),
(19, 'MD', '11236550', 1, 154, '2020'),
(20, 'GH', '15498959', 3, 465, '2020'),
(21, 'GF', '15445688', 6, 159, '2020'),
(22, 'HG', '41555425', 5, 156, '2020'),
(23, 'AA', '26596640', 5, 489, '2020'),
(24, 'JG', '54462950', 1, 156, '2020'),
(28, 'DC', '56212358', 5, 65, '2020'),
(29, 'TT', '45789815', 3, 300, '2020'),
(30, 'AA', '78451296', 3, 100, '2020'),
(31, 'BB', '02154876', 3, 200, '2020'),
(32, 'CC', '89651502', 3, 300, '2020'),
(33, 'CC', '09651502', 3, 300, '2020'),
(34, 'CC', '00651502', 3, 300, '2020'),
(35, 'DD', '00020012', 3, 123, '2020'),
(36, 'DD', '00000012', 3, 321, '2020'),
(37, 'GB', '11111201', 3, 451, '2020'),
(38, 'TT', '12121512', 3, 156, '2020'),
(39, 'HG', '78784487', 3, 614, '2020'),
(40, 'SF', '45612210', 3, 892, '2020'),
(41, 'YY', '22222512', 3, 452, '2020'),
(42, 'UU', '44444487', 3, 565, '2020'),
(43, 'JJ', '66666210', 3, 482, '2020'),
(44, 'HH', '15153945', 1, 415, '2020'),
(45, 'BN', '98453007', 1, 512, '2020'),
(46, 'JH', '78453508', 6, 482, '2019');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
