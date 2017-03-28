-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2017 at 08:11 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `train_inf`
--

-- --------------------------------------------------------

--
-- Table structure for table `inf`
--

CREATE TABLE `inf` (
  `id` int(10) NOT NULL,
  `train_no` int(10) NOT NULL,
  `station1` varchar(20) NOT NULL,
  `station2` varchar(20) NOT NULL,
  `time` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inf`
--

INSERT INTO `inf` (`id`, `train_no`, `station1`, `station2`, `time`) VALUES
(1, 21, 'a', 'b', 8),
(2, 222, 'a', 'd', 5),
(3, 342, 'a', 'c', 2),
(4, 123, 'b', 'd', 2),
(5, 456, 'c', 'd', 2),
(6, 567, 'b', 'f', 13),
(7, 9987, 'f', 'd', 6),
(8, 127, 'f', 'g', 2),
(9, 767, 'f', 'h', 3),
(10, 345, 'd', 'g', 3),
(11, 55, 'd', 'e', 1),
(12, 43, 'c', 'e', 5),
(13, 444, 'e', 'g', 1),
(14, 567, 'g', 'h', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inf`
--
ALTER TABLE `inf`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
