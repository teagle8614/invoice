-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-05-18 17:13:15
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
-- 資料表結構 `award_list`
--

CREATE TABLE `award_list` (
  `id` tinyint(1) UNSIGNED NOT NULL COMMENT '編號',
  `award` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '獎項',
  `bonus` int(8) UNSIGNED NOT NULL COMMENT '獎金'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `award_list`
--

INSERT INTO `award_list` (`id`, `award`, `bonus`) VALUES
(1, '特別獎', 10000000),
(2, '特獎', 2000000),
(3, '頭獎', 200000),
(4, '二獎', 40000),
(5, '三獎', 10000),
(6, '四獎', 4000),
(7, '五獎', 1000),
(8, '六獎', 200),
(9, '增開六獎', 200);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `award_list`
--
ALTER TABLE `award_list`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `award_list`
--
ALTER TABLE `award_list`
  MODIFY `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '編號', AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
