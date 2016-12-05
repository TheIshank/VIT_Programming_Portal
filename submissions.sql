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
-- Table structure for table `submissions_quiz`
--

CREATE TABLE IF NOT EXISTS `submissions_quiz` (
  `Problem_Id` int(11) NOT NULL,
  `Test_Id` int(11) NOT NULL,
  `RegNo` varchar(20) NOT NULL,
  `Class_Id` varchar(20) NOT NULL,
  `Solution_Path` varchar(70) NOT NULL,
  `Marks_Given` int(3) NOT NULL DEFAULT '0',
  `QuestionAttempted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `submissions_quiz`
--
ALTER TABLE `submissions_quiz`
  ADD PRIMARY KEY (`Problem_Id`,`Test_Id`,`RegNo`),
  ADD KEY `Submissions_fk1` (`Test_Id`),
  ADD KEY `Submissions_fk2` (`RegNo`),
  ADD KEY `Submissions_fk3` (`Class_Id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `submissions_quiz`
--
ALTER TABLE `submissions_quiz`
  ADD CONSTRAINT `Submissions_fk0` FOREIGN KEY (`Problem_Id`) REFERENCES `problems` (`Problem_Id`),
  ADD CONSTRAINT `Submissions_fk1` FOREIGN KEY (`Test_Id`) REFERENCES `tests` (`Test_Id`),
  ADD CONSTRAINT `Submissions_fk2` FOREIGN KEY (`RegNo`) REFERENCES `students` (`RegNo`),
  ADD CONSTRAINT `Submissions_fk3` FOREIGN KEY (`Class_Id`) REFERENCES `classes` (`Class_Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
