-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2016 at 05:54 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vit_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `Test_Id` int(11) NOT NULL,
  `Test_Title` varchar(50) NOT NULL,
  `Start_Time` datetime NOT NULL,
  `End_Time` datetime NOT NULL,
  `Begin_Key` varchar(20) NOT NULL,
  `Remove_Begin_Key` tinyint(1) NOT NULL,
  `Type` int(2) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `Problem_Id` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`Test_Id`, `Test_Title`, `Start_Time`, `End_Time`, `Begin_Key`, `Remove_Begin_Key`, `Type`, `Subject`, `Problem_Id`) VALUES
(1, 'left shift', '2016-10-12 00:00:00', '2016-10-25 16:47:00', 'utkarsh', 0, 0, 'CSE2002', ''),
(2, 'right shift', '2016-01-02 00:00:00', '2016-10-18 07:13:36', 'begin_key', 0, 0, 'CSE2002', '8'),
(3, 'niranj and calls', '2016-06-05 00:00:00', '2016-06-16 00:00:00', 'begin_key', 1, 0, 'CSE2002', ''),
(4, 'niranj and runs', '2016-06-03 00:00:00', '2016-06-13 00:00:00', 'begin_key', 1, 0, 'CSE2002', ''),
(43, 'asdfyhbnjk', '2016-06-22 00:00:00', '2016-06-23 00:00:00', 'sid', 0, 0, 'CSE2002', ''),
(44, 'asdfghjk', '2016-01-02 00:00:00', '2016-10-22 07:56:35', 'zdfzggzgh', 0, 0, 'CSE2002', ''),
(45, 'wertyui', '2016-01-08 00:00:00', '2016-01-30 00:00:00', 'ghjjkll', 0, 0, 'CSE2002', ''),
(46, 'qwerty', '2016-01-02 00:00:00', '2016-01-24 00:00:00', 'thujik', 0, 0, 'CSE2002', ''),
(47, 'qwrfhnim', '2016-01-05 00:00:00', '2016-01-14 00:00:00', 'ujmnhytg', 0, 0, 'CSE2002', ''),
(48, 'qwertyu', '2016-01-11 00:00:00', '2016-01-31 00:00:00', 'yhnmjuki', 0, 0, 'CSE2002', ''),
(49, 'ascfgb', '2016-01-15 00:00:00', '2016-01-17 00:00:00', '', 1, 0, 'CSE2002', ''),
(50, 'dfvgbhnjm', '2016-01-13 00:00:00', '2016-01-16 00:00:00', '10236', 0, 0, 'CSE2002', ''),
(51, 'awsedrfth', '2016-01-02 00:00:00', '2016-01-24 00:00:00', 'bnmjk', 0, 0, 'CSE2002', ''),
(52, 'rtgbnh', '2016-02-25 10:00:00', '2016-11-01 08:47:11', '', 1, 0, 'CSE2001', '43,52,56'),
(53, 'q', '2016-01-12 00:00:00', '2016-01-22 00:00:00', '', 1, 0, 'CSE2001', ''),
(54, 'qwerty', '2016-01-13 00:00:00', '2016-01-22 00:00:00', '', 1, 0, 'CSE2001', ''),
(55, 'qaqxd', '2016-02-18 00:00:00', '2016-02-27 00:00:00', '', 1, 0, 'CSE2001', ''),
(56, 'Bit Manip', '2016-06-14 00:00:00', '2016-06-15 00:00:00', '', 1, 0, 'CSE2001', ''),
(57, 'test 1', '2016-01-01 00:00:00', '2016-01-09 00:00:00', '', 1, 0, 'CSE2001', ''),
(58, 'Test 1', '2016-06-23 00:00:00', '2016-06-24 00:00:00', '', 1, 0, 'CSE2001', ''),
(59, 'Left shift!!', '2016-01-02 00:00:00', '2016-01-10 00:00:00', '', 1, 0, 'CSE2001', ''),
(60, 'Test 23', '2016-01-01 00:00:00', '2016-01-03 00:00:00', '123', 0, 0, 'CSE2001', ''),
(62, 'NewTest', '2016-03-06 00:00:00', '2016-03-20 00:00:00', '', 1, 0, 'CSE2001', ''),
(63, 'New Test', '2016-03-06 00:00:00', '2016-03-20 00:00:00', '', 1, 0, 'CSE2001', '8'),
(73, 'asdadadadaasdasasd', '2013-12-30 00:59:00', '2016-12-31 12:59:00', 'sdadad', 0, 1, 'CSE2002', '8'),
(74, 'swap the array', '2015-12-31 12:59:00', '2016-12-31 11:59:00', 'utkarsh', 0, 1, 'CSE2001', '2,3,7'),
(75, 'terwwe', '2012-01-01 00:59:00', '2016-12-31 12:59:00', '', 0, 1, 'CSE2002', '16,17,18'),
(76, 'arrays and graphs', '2014-12-31 23:59:00', '2016-12-31 12:59:00', 'utkarsh', 0, 1, 'CSE2002', '43,52'),
(77, 'stacks and queue', '2015-12-31 12:59:00', '2016-12-31 12:59:00', '', 0, 1, 'CSE2001', '3,7'),
(83, 'data_structures_all', '2015-12-31 12:59:00', '2016-12-31 12:59:00', '', 0, 1, 'CSE2002', '43,52,56'),
(84, 'operating systems', '2014-12-31 12:59:00', '2016-12-31 12:59:00', 'key', 0, 1, 'CSE2002', '43,52,56'),
(85, 'array', '2016-11-15 02:00:00', '2017-02-24 16:15:00', 'yes', 0, 1, 'CSE3001', '60');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`Test_Id`,`Type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `Test_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
