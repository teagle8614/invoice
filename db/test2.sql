-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-05-24 19:19:53
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
-- 資料表結構 `test2`
--

CREATE TABLE `test2` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '流水號',
  `year` year(4) NOT NULL COMMENT '年份',
  `period` tinyint(1) UNSIGNED NOT NULL COMMENT '期別',
  `number` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '發票號碼	',
  `type` tinyint(1) UNSIGNED NOT NULL COMMENT '獎項'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `test2`
--

INSERT INTO `test2` (`id`, `year`, `period`, `number`, `type`) VALUES
(1, 2020, 3, '78451296', 1),
(2, 2020, 3, '02154876', 2),
(3, 2020, 3, '89651502', 3),
(4, 2020, 3, '65320012', 3),
(5, 2020, 3, '45869201', 3),
(6, 2020, 3, '512', 4),
(7, 2020, 3, '487', 4),
(8, 2020, 3, '210', 4),
(9, 2020, 1, '12620024', 1),
(10, 2020, 1, '39793895', 2),
(11, 2020, 1, '67913945', 3),
(12, 2020, 1, '09954061', 3),
(13, 2020, 1, '54574947', 3),
(14, 2020, 1, '007', 4),
(15, 2019, 6, '59647042', 1),
(16, 2019, 6, '01260528', 2),
(17, 2019, 6, '01616970', 3),
(18, 2019, 6, '69921388', 3),
(19, 2019, 6, '53451508', 3),
(20, 2019, 6, '710', 4),
(21, 2019, 6, '585', 4),
(22, 2019, 6, '633', 4),
(23, 2019, 5, '41482012', 1),
(24, 2019, 5, '58837976', 2),
(25, 2019, 5, '20379435', 3),
(26, 2019, 5, '47430762', 3),
(27, 2019, 5, '36193504', 3),
(28, 2019, 5, '693', 4),
(29, 2019, 5, '043', 4),
(30, 2019, 5, '425', 4),
(31, 2019, 4, '45698621', 1),
(32, 2019, 4, '19614436', 2),
(33, 2019, 4, '96182420', 3),
(34, 2019, 4, '47464012', 3),
(35, 2019, 4, '62781818', 3),
(36, 2019, 4, '928', 4),
(37, 2019, 4, '899', 4);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `test2`
--
ALTER TABLE `test2`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `test2`
--
ALTER TABLE `test2`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
