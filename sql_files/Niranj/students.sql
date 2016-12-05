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
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `RegNo` varchar(20) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Batch` int(4) NOT NULL,
  `Degree` varchar(100) NOT NULL,
  `Email_Id` varchar(40) NOT NULL,
  `Recovery_Email_Id` varchar(40) NOT NULL,
  `Block_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`RegNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`RegNo`, `Name`, `Batch`, `Degree`, `Email_Id`, `Recovery_Email_Id`, `Block_Status`, `Password`) VALUES
('13BCE1040', 'Ganesh', 2017, 'B.Tech(ComputerandScienceEngineering)', 't.ganesh2013@vit.ac.in', 'ganesh.t2013@vit.ac.in', 0, '1234'),
('13BCE1066', 'Kartik Lovekar', 2017, 'B.Tech(MechanicalEngineering)', 'kartik@gmail.com', 'kartik@gmail.com', 0, '1234'),
('13BCE1085', 'Niranj', 2017, 'B.Tech(ComputerandScienceEngineering)', 'niranj.jyothish2013@vit.ac.in', 'niranj.jyothish2013@vit.ac.in', 1, '1234'),
('13BCE1088', 'Pallavi', 2016, 'M.Tech(CloudComputing)', 'pallivi@gmail.com', 'pallivi95@gmail.com', 0, ''),
('13BCE1103', 'Prithvi ChakraBarty', 2016, 'M.Tech(CyberSecurity)', 'prithvi@gmail.com', 'prithvi@gmail.com', 0, ''),
('13BCE1105', 'Ankit Rai', 2019, 'B.Tech(ElectronicsandCommunicationEngineering)', 'raiankit.kumar2013@vit.ac.in', 'raiankit474@gmail.com', 0, ''),
('13BCE1146', 'Siddhant', 2016, 'M.Tech(CloudComputing)', 'siddhant.verma2013@vit.ac.in', 'siddhant.verma2013@vit.ac.in', 0, '1234');
