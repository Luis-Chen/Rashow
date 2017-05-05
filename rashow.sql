-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2017 at 03:03 AM
-- Server version: 5.5.49-log
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rashow`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4735 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `mail`, `password`, `google_id`, `date`, `level`) VALUES
(4724, 'f74373021@mailst.cjcu.edu.tw', '', '113594487411988309841', '2017-03-26', 0),
(4729, 'leo5916267@gmail.com', '', '115931849194481467797', '2017-03-26', 0),
(4730, 'root@Rashow.com', '63a9f0ea7bb98050796b649e85481845', '', '2017-03-27', 1),
(4731, 'asdf@gmail.com', '7815696ecbf1c96e6894b779456d330e', '', '2017-04-27', 0),
(4733, 'leo5916267@gmail.com', '7815696ecbf1c96e6894b779456d330e', '', '2017-04-27', 0),
(4734, 'leo5916267@gmail.com', '7815696ecbf1c96e6894b779456d330e', '', '2017-04-27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL,
  `mbid` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `mbid`, `title`, `text`, `date`) VALUES
(1, 4729, 'qwe', 'qwe', '2017-04-26 00:00:00'),
(2, 4724, 'ASD', 'asf', '2017-04-26 00:00:00'),
(3, 4724, 'asdsad', 'asd', '2017-04-27 00:00:00'),
(4, 4724, '[海報審核][通過]', '\r\n             <table>\r\n              <tr>\r\n                <td>寄件者\r\n                <td>Rashow管理員\r\n              <tr>\r\n                <td>標題\r\n                <td>[海報審核][通過]\r\n              <tr>\r\n                <td>海報\r\n                <td>http://i.imgur.com/rUP29pO.jpg\r\n              <tr>\r\n                <td>開始播放日期\r\n                <td>2017-04-28\r\n              <tr>\r\n                <td>結束播放時間\r\n                <td>2017-04-30\r\n              </tr>\r\n            </table>', '2017-04-28 00:00:00'),
(5, 4724, '[海報審核][通過]', '\r\n             <table>\r\n              <tr>\r\n                <td>寄件者\r\n                <td>Rashow管理員\r\n              <tr>\r\n                <td>標題\r\n                <td>[海報審核][通過]\r\n              <tr>\r\n                <td>海報\r\n                <td>http://i.imgur.com/rUP29pO.jpg\r\n              <tr>\r\n                <td>開始播放日期\r\n                <td>2017-04-28\r\n              <tr>\r\n                <td>結束播放時間\r\n                <td>2017-04-30\r\n              </tr>\r\n            </table>', '2017-04-28 00:00:00'),
(6, 4724, '[海報審核][通過]', '\r\n             <table>\r\n              <tr>\r\n                <td>寄件者\r\n                <td>Rashow管理員\r\n              <tr>\r\n                <td>標題\r\n                <td>[海報審核][通過]\r\n              <tr>\r\n                <td>海報\r\n                <td>http://i.imgur.com/rUP29pO.jpg\r\n              <tr>\r\n                <td>開始播放日期\r\n                <td>2017-04-28\r\n              <tr>\r\n                <td>結束播放時間\r\n                <td>2017-04-30\r\n              </tr>\r\n            </table>', '2017-04-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `poster`
--

CREATE TABLE IF NOT EXISTS `poster` (
  `id` int(11) NOT NULL COMMENT '編號',
  `mbid` int(11) NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci COMMENT '圖片',
  `toDay` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '上傳日期',
  `endDay` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '結束時間',
  `startplay` date NOT NULL,
  `sta_view` tinyint(1) NOT NULL COMMENT '看過',
  `sta_pass` tinyint(1) NOT NULL COMMENT '通過',
  `sta_del` int(11) NOT NULL COMMENT '刪除',
  `sta_play` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poster`
--

INSERT INTO `poster` (`id`, `mbid`, `link`, `toDay`, `endDay`, `startplay`, `sta_view`, `sta_pass`, `sta_del`, `sta_play`) VALUES
(1, 4724, 'http://i.imgur.com/rUP29pO.jpg', '2017-04-28', '2017-04-30', '2017-04-28', 1, 1, 0, 1),
(2, 4724, 'http://i.imgur.com/8GVFYQD.jpg', '2017-04-28', '2017-04-30', '2017-04-28', 1, 1, 0, 1),
(3, 4724, 'http://i.imgur.com/8CiCVOq.jpg', '2017-04-28', '2017-04-30', '2017-04-28', 1, 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mbid` (`mbid`) USING BTREE;

--
-- Indexes for table `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mbid_2` (`mbid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4735;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '編號',AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`mbid`) REFERENCES `member` (`id`);

--
-- Constraints for table `poster`
--
ALTER TABLE `poster`
  ADD CONSTRAINT `poster_ibfk_1` FOREIGN KEY (`mbid`) REFERENCES `member` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
