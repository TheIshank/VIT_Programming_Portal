-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2016 at 06:01 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newhnt`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `Class_Id` varchar(20) NOT NULL,
  `Faculty_Id` varchar(20) NOT NULL,
  `Batch` int(4) NOT NULL,
  `Course_Title` varchar(30) NOT NULL,
  PRIMARY KEY (`Class_Id`,`Batch`),
  KEY `Classes_fk0` (`Faculty_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`Class_Id`, `Faculty_Id`, `Batch`, `Course_Title`) VALUES
('1264', 'fac1', 2013, 'Embedded Systems'),
('1264', 'fac1', 2014, 'Computer Networks'),
('1265', 'fac2', 2013, 'Electronics'),
('1265', 'fac3', 2015, 'Complex Numbers'),
('1266', 'fac2', 2013, 'Python'),
('1266', 'fac2', 2014, 'Cplusplus'),
('1267', 'fac2', 2013, 'Programming in C'),
('1268', 'fac5', 2013, 'Operating System'),
('1269', 'fac4', 2016, 'Cloud Computing');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `Classes_fk0` FOREIGN KEY (`Faculty_Id`) REFERENCES `faculties` (`Faculty_Id`);
