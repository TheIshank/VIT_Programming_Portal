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
-- Table structure for table `problems_quiz`
--

CREATE TABLE IF NOT EXISTS `problems_quiz` (
  `Problem_Id` int(11) NOT NULL,
  `Tag1` varchar(25) NOT NULL,
  `Tag2` varchar(25) NOT NULL,
  `Subject` varchar(10) NOT NULL,
  `Problem_Title` varchar(50) NOT NULL,
  `Description_Path` varchar(50) NOT NULL,
  `question_mark` int(3) NOT NULL,
  `Option_1` varchar(150) NOT NULL,
  `Option_2` varchar(150) NOT NULL,
  `Option_3` varchar(150) DEFAULT NULL,
  `Option_4` varchar(150) DEFAULT NULL,
  `Answer` varchar(10) NOT NULL,
  `Type` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problems_quiz`
--

INSERT INTO `problems_quiz` (`Problem_Id`, `Tag1`, `Tag2`, `Subject`, `Problem_Title`, `Description_Path`, `question_mark`, `Option_1`, `Option_2`, `Option_3`, `Option_4`, `Answer`, `Type`) VALUES
(8, 'nalgo', 'loop', 'CSE2001', 'Subtract two numbers', 'admin-login/8/description.txt', 10, '17', '14', NULL, NULL, '1,2', 1),
(43, 'some', 'so', 'CSE2002', 'hello chef', 'something about it ', 2, '12', '23', '32', '43', '1,2', 1),
(51, 'pop', 'so', 'CSE1003', 'utkarsh', 'dkjrhgdhgdkvhkd', 1, 'TRUE', 'FALE', '', '', '2', 0),
(52, 'some', 'lo', 'CSE2002', 'for looping', 'we do questions on for loop', 1, 'TRUE', 'FALSE', '', '', '1', 0),
(53, 'pop', 'lo', 'CSE1003', 'some problem', 'some description', 1, 'TRUE', 'FALSE', '', '', '1', 0),
(56, 'some', 'lo', 'CSE2002', 'hello people', 'yo people', 1, 'TRUE', 'FALSE', '', '', '2', 0),
(58, 'tag1', 'tag2', 'CSE2001', 'shukla ', '<p>something about something</p>\r\n', 1, 'TRUE', 'FALSE', '', '', '1', 0),
(59, 'algorithm', 'graph theory', 'CSE2001', 'hello to chefs game', '<p>here we shall be giving the description of the ', 2, '12 if even', '13 if even', '21 if odd', '23 if odd', '2,3', 1),
(60, 'algorithm', 'array', 'CSE3001', 'kill it', '<p>dndjvndskvnkccxvncxv</p>\r\n', 1, 'TRUE', 'FALSE', '', '', '1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `problems_quiz`
--
ALTER TABLE `problems_quiz`
  ADD PRIMARY KEY (`Problem_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `problems_quiz`
--
ALTER TABLE `problems_quiz`
  MODIFY `Problem_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
