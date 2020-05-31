-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-05-31 19:25:10
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
-- 資料表結構 `reward_record`
--

CREATE TABLE `reward_record` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '流水號',
  `year` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '年份',
  `period` tinyint(1) UNSIGNED NOT NULL COMMENT '期別',
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '英文碼',
  `number` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '發票號碼',
  `expend` int(8) UNSIGNED NOT NULL COMMENT '花費',
  `reward` tinyint(1) UNSIGNED NOT NULL COMMENT '獎項'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `reward_record`
--

INSERT INTO `reward_record` (`id`, `year`, `period`, `code`, `number`, `expend`, `reward`) VALUES
(1, '2020', 3, 'AA', '78451296', 100, 1),
(2, '2020', 3, 'BB', '02154876', 200, 2),
(3, '2020', 3, 'TT', '12121512', 156, 9),
(4, '2020', 3, 'HG', '78784487', 614, 9),
(5, '2020', 3, 'SF', '45612210', 892, 9),
(6, '2020', 3, 'YY', '22222512', 452, 9),
(7, '2020', 3, 'UU', '44444487', 565, 9),
(8, '2020', 3, 'JJ', '66666210', 482, 9),
(9, '2020', 3, 'GB', '11111201', 451, 8),
(10, '2020', 3, 'DD', '00000012', 321, 7),
(11, '2020', 3, 'DD', '00020012', 123, 6),
(12, '2020', 3, 'CC', '00651502', 300, 5),
(13, '2020', 3, 'CC', '09651502', 300, 4),
(14, '2020', 3, 'CC', '89651502', 300, 3);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `reward_record`
--
ALTER TABLE `reward_record`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `reward_record`
--
ALTER TABLE `reward_record`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
