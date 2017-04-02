-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2017 at 10:07 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

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
  `train_no` varchar(20) DEFAULT NULL,
  `station1` varchar(20) NOT NULL,
  `station2` varchar(20) NOT NULL,
  `time` int(3) NOT NULL,
  `air_no` varchar(15) DEFAULT NULL,
  `selector` int(1) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inf`
--

INSERT INTO `inf` (`train_no`, `station1`, `station2`, `time`, `air_no`, `selector`, `id`) VALUES
('12417', 'allahabad', 'kanpur', 2, NULL, 1, 1),
('12417', 'kanpur', 'delhi', 7, NULL, 1, 2),
('12174', 'lucknow', 'kanpur', 2, NULL, 1, 3),
('22419', 'lucknow', 'delhi', 8, NULL, 1, 4),
('12561', 'varanasi', 'allahabad', 3, NULL, 1, 5),
('12404', 'agra', 'allahabad', 7, NULL, 1, 6),
('09809', 'kota', 'delhi', 7, NULL, 1, 7),
('22631', 'kota', 'jaipur', 4, NULL, 1, 8),
('12205', 'delhi', 'dehradun', 3, NULL, 1, 9),
('12505', 'patna', 'allahabad', 6, NULL, 1, 10),
(NULL, 'guwahati', 'patna', 4, 'IndiGo', 2, 11),
(NULL, 'pune', 'bangalore', 2, 'GoAir', 2, 12),
(NULL, 'bangalore', 'varanasi', 3, 'IndiGo', 2, 13),
(NULL, 'bhopal', 'pune', 6, 'jetAirways', 2, 14),
(NULL, 'pune', 'lucknow', 4, 'IndiGo', 2, 15),
(NULL, 'london', 'delhi', 8, 'AirIndia', 2, 16),
(NULL, 'london', 'bombay', 9, 'AirIndia', 2, 17),
(NULL, 'varanasi', 'london', 14, 'AirIndia', 2, 18),
(NULL, 'kolkata', 'varanasi', 2, 'AirIndia', 2, 19),
('Azad Hind Express', 'pune', 'bangalore', 19, NULL, 1, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inf`
--
ALTER TABLE `inf`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inf`
--
ALTER TABLE `inf`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
