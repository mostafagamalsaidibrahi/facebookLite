-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2020 at 04:57 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebooklite`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `uId` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `day` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `profileImage` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'User',
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`uId`, `fullname`, `email`, `password`, `day`, `month`, `year`, `gender`, `profileImage`, `type`, `active`) VALUES
(1, 'Mostafa Gamal', 'mostafagamalsaid475@gmail.com', 'M1032017y', '1', 'Jan', '2020', 'Female', '1602446579.jpg', 'User', 1),
(3, 'sosososo', 'sosososo@gmail.com', 'sosososososo', '1', 'Jan', '2020', 'Female', '1602113033.jpg', 'User', 1),
(4, 'bolabola', 'bolabola@gmail.com', 'bolabolabolabola', '1', 'Jan', '2020', 'Female', 'NULL', 'User', 1),
(5, 'samysamysamy', 'samysamysamy', 'samy@gmail.com', '1', 'Jan', '2020', 'Female', '1602675179.jpg', 'User', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `uId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `commentContent` text NOT NULL,
  `cTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `uId`, `pId`, `commentContent`, `cTime`) VALUES
(1, 1, 18, 'comment', '2020-10-13 12:07:27'),
(2, 1, 18, 'كومنت بتاعى', '2020-10-13 12:08:32'),
(3, 1, 18, 'الكومنت يتاعى 2', '2020-10-13 12:09:01'),
(4, 1, 22, 'my comment on my post', '2020-10-13 12:10:10'),
(5, 1, 22, 'بعمل كومنت تانى', '2020-10-13 13:18:23'),
(6, 1, 21, 'ازيك يا اقرع', '2020-10-13 13:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `friendrequest`
--

CREATE TABLE `friendrequest` (
  `rId` int(11) NOT NULL,
  `firstSide` int(11) NOT NULL,
  `secondSide` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likeId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `uId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likeId`, `postId`, `uId`) VALUES
(13, 14, 1),
(14, 13, 1),
(15, 15, 1),
(16, 18, 1),
(17, 21, 1),
(18, 20, 1),
(19, 19, 1),
(20, 22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `messenger`
--

CREATE TABLE `messenger` (
  `msgId` int(11) NOT NULL,
  `uId` int(11) NOT NULL,
  `fId` int(11) NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messenger`
--

INSERT INTO `messenger` (`msgId`, `uId`, `fId`, `msg`) VALUES
(1, 1, 3, 'hi soso'),
(2, 3, 1, 'hello'),
(3, 1, 3, '.'),
(4, 1, 3, 'mostafa!!'),
(5, 1, 3, 'walla'),
(6, 3, 1, 'ezayk yalla'),
(7, 3, 1, 'sasa'),
(8, 3, 1, 'hoda'),
(9, 3, 1, '5wl'),
(10, 1, 3, '2eh ya mama'),
(11, 3, 1, 'ana soso'),
(12, 1, 3, 'ana mostafa'),
(13, 1, 3, 'soso ya mama'),
(14, 1, 4, 'dfg'),
(15, 1, 4, 'wert');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `uId` int(11) NOT NULL,
  `postContent` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `uId`, `postContent`, `time`) VALUES
(19, 3, 'انا سندس', '2020-10-12 22:41:05'),
(20, 4, 'انا بولا', '2020-10-12 23:06:44'),
(21, 5, 'انا سامى', '2020-10-12 23:07:11'),
(22, 1, 'post 123', '2020-10-13 12:09:58'),
(24, 1, 'my Post', '2020-10-13 13:32:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`uId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `friendrequest`
--
ALTER TABLE `friendrequest`
  ADD PRIMARY KEY (`rId`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeId`);

--
-- Indexes for table `messenger`
--
ALTER TABLE `messenger`
  ADD PRIMARY KEY (`msgId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `friendrequest`
--
ALTER TABLE `friendrequest`
  MODIFY `rId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messenger`
--
ALTER TABLE `messenger`
  MODIFY `msgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
