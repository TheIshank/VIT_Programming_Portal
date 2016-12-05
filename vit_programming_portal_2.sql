-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2016 at 07:16 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vit_programming_portal_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Admin_Id` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `salt` varchar(6) NOT NULL,
  `hash` varchar(80) NOT NULL,
  PRIMARY KEY (`Admin_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_Id`, `Password`, `salt`, `hash`) VALUES
('admin', 'admin', 'pxhom', 'pxYs9AtNy6TyM'),
('ankit', 'rai', '', ''),
('ganesh', 'tata', '', ''),
('niranj', 'jyothish', '', ''),
('siddhant', 'siddhant', '', ''),
('trushangi', 'trushangi', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `Class_Id` varchar(20) NOT NULL,
  `Faculty_Id` varchar(20) NOT NULL,
  `Batch` int(4) NOT NULL,
  PRIMARY KEY (`Class_Id`,`Batch`),
  KEY `Classes_fk0` (`Faculty_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`Class_Id`, `Faculty_Id`, `Batch`) VALUES
('1264', 'fac1', 2013),
('1264', 'fac1', 2014),
('1265', 'fac2', 2013),
('1266', 'fac2', 2013),
('1266', 'fac2', 2014),
('1267', 'fac2', 2013),
('1265', 'fac3', 2015),
('1268', 'fac5', 2013);

-- --------------------------------------------------------

--
-- Table structure for table `classes_tests`
--

CREATE TABLE IF NOT EXISTS `classes_tests` (
  `Class_Id` varchar(20) NOT NULL,
  `Test_Id` int(11) NOT NULL,
  PRIMARY KEY (`Class_Id`,`Test_Id`),
  KEY `Classes_Tests_fk1` (`Test_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes_tests`
--

INSERT INTO `classes_tests` (`Class_Id`, `Test_Id`) VALUES
('1264', 1),
('1265', 1),
('1267', 1),
('1264', 2),
('1265', 2),
('1268', 2),
('1264', 3),
('1265', 3),
('1266', 3),
('1268', 3),
('1265', 4),
('1264', 43),
('1266', 43),
('1268', 43),
('1265', 44),
('1267', 44),
('1266', 45),
('1268', 45),
('1265', 46),
('1267', 46),
('1266', 47),
('1268', 47),
('1268', 48),
('1265', 49),
('1264', 50),
('1267', 50),
('1268', 50),
('1264', 51),
('1267', 53),
('1268', 53),
('1267', 54),
('1268', 54),
('1264', 56);

-- --------------------------------------------------------

--
-- Table structure for table `email_group`
--

CREATE TABLE IF NOT EXISTS `email_group` (
  `Group_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Batch` int(4) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Reg_Nos` varchar(1000) NOT NULL,
  PRIMARY KEY (`Group_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `email_group`
--

INSERT INTO `email_group` (`Group_Id`, `Batch`, `Description`, `Reg_Nos`) VALUES
(38, 2019, 'dkwndk;wfn;wnf;wnf;fn;', 'nsfn;wwfs,.fw;ldnw;dwndw;dw'),
(42, 1313, '1313', '13BCE1146'),
(43, 1414, '1414', 'FO[O'),
(45, 2013, '2', '13vhgjjkl'),
(46, 2013, '2', '13bce1040'),
(47, 2013, '55678', '135477'),
(55, 2013, 'random', '13bce1091,13bce1040,13bce1105,13bce1146,13bce1085');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `Faculty_Id` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  PRIMARY KEY (`Faculty_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`Faculty_Id`, `Password`) VALUES
('fac1', 'faculty'),
('fac2', 'fac2'),
('fac3', 'fac3'),
('fac4', 'fac4'),
('fac5', 'fac5');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_otp`
--

CREATE TABLE IF NOT EXISTS `password_reset_otp` (
  `Reg_No` varchar(20) NOT NULL,
  `OTP` varchar(6) NOT NULL,
  `Expiary_Time` datetime NOT NULL,
  PRIMARY KEY (`Reg_No`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset_otp`
--

INSERT INTO `password_reset_otp` (`Reg_No`, `OTP`, `Expiary_Time`) VALUES
('13bce1085', 'TVKlI6', '2016-06-13 15:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE IF NOT EXISTS `problems` (
  `Problem_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Test_Id` int(11) NOT NULL,
  `Problem_Title` varchar(50) NOT NULL,
  `Execution_Time` int(11) NOT NULL,
  `Description_Path` varchar(50) NOT NULL,
  `Test_Case_Input_Path` varchar(50) NOT NULL,
  `Test_Case_Output_Path` varchar(30) NOT NULL,
  `Hidden_Case_Input_Path` varchar(30) NOT NULL,
  `Hidden_Case_Output_Path` varchar(30) NOT NULL,
  `Precode_Path` text NOT NULL,
  `Postcode_Path` text NOT NULL,
  `Difficulty_Level` int(1) NOT NULL,
  `Maximum_Marks` int(3) NOT NULL,
  `Lang_Freeze` varchar(20) NOT NULL,
  PRIMARY KEY (`Problem_Id`,`Test_Id`),
  KEY `Problems_fk0` (`Test_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`Problem_Id`, `Test_Id`, `Problem_Title`, `Execution_Time`, `Description_Path`, `Test_Case_Input_Path`, `Test_Case_Output_Path`, `Hidden_Case_Input_Path`, `Hidden_Case_Output_Path`, `Precode_Path`, `Postcode_Path`, `Difficulty_Level`, `Maximum_Marks`, `Lang_Freeze`) VALUES
(2, 3, 'Right Shift', 1000, 'admin-login/2/description.txt', 'admin-login/2/input.txt', 'admin-login/2/output.txt', 'admin-login/2/hiddenInput.txt', 'admin-login/2/hiddenOutput.txt', 'admin-login/2/precode.txt', 'admin-login/2/postcode.txt', 2, 10, ''),
(3, 56, 'XOR', 1000, 'admin-login/3/description.txt', 'admin-login/3/input.txt', 'admin-login/3/output.txt', 'admin-login/3/hiddenInput.txt', 'admin-login/3/hiddenOutput.txt', 'admin-login/3/precode.txt', 'admin-login/3/postcode.txt', 2, 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `RegNo` varchar(20) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Email_Id` varchar(40) NOT NULL,
  `Recovery_Email_Id` varchar(40) NOT NULL,
  `Block_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Password` varchar(20) NOT NULL,
  `salt` varchar(6) NOT NULL,
  `hash` varchar(80) NOT NULL,
  PRIMARY KEY (`RegNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`RegNo`, `Name`, `Email_Id`, `Recovery_Email_Id`, `Block_Status`, `Password`, `salt`, `hash`) VALUES
('13BCE1085', 'Niranj', 'niranj.jyothish2013@vit.ac.in', 'niranj.jyothish2013@vit.ac.in', 1, '1234', 'eq1yn', 'eqpcr77gqs6qE'),
('13BCE1105', 'Ankit Rai', 'raiankit.kumar2013@vit.ac.in', 'raiankit474@gmail.com', 0, 'kmnj', '', ''),
('13BCE1146', 'Siddhant', 'siddhant.verma2013@vit.ac.in', 'siddhant.verma2013@vit.ac.in', 0, 'siddhant', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `students_classes`
--

CREATE TABLE IF NOT EXISTS `students_classes` (
  `Class_Id` varchar(20) NOT NULL,
  `RegNo` varchar(20) NOT NULL,
  PRIMARY KEY (`Class_Id`,`RegNo`),
  KEY `Students_Classes_fk1` (`RegNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students_classes`
--

INSERT INTO `students_classes` (`Class_Id`, `RegNo`) VALUES
('1264', '13BCE1085'),
('1267', '13BCE1085'),
('1264', '13BCE1105'),
('1264', '13BCE1146'),
('1267', '13BCE1146');

-- --------------------------------------------------------

--
-- Table structure for table `student_tests`
--

CREATE TABLE IF NOT EXISTS `student_tests` (
  `Test_Id` int(11) NOT NULL,
  `RegNo` varchar(20) NOT NULL,
  `Evaluation_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Marks` int(3) NOT NULL,
  PRIMARY KEY (`Test_Id`,`RegNo`),
  KEY `Student_Tests_fk1` (`RegNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tests`
--

INSERT INTO `student_tests` (`Test_Id`, `RegNo`, `Evaluation_Status`, `Marks`) VALUES
(1, '13BCE1105', 0, 0),
(3, '13BCE1085', 1, 10),
(3, '13BCE1146', 1, 20),
(4, '13BCE1085', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `Problem_Id` int(11) NOT NULL,
  `Test_Id` int(11) NOT NULL,
  `RegNo` varchar(20) NOT NULL,
  `Class_Id` varchar(20) NOT NULL,
  `Number_Of_Attempts` int(3) NOT NULL,
  `Submitted_Solution_Path` varchar(50) NOT NULL,
  `File_Name` text NOT NULL,
  `Language_Used` varchar(20) NOT NULL,
  `Marks_Given` int(3) NOT NULL DEFAULT '0',
  `Status` int(11) NOT NULL DEFAULT '1',
  `Submit_Status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Problem_Id`,`Test_Id`,`RegNo`),
  KEY `Submissions_fk1` (`Test_Id`),
  KEY `Submissions_fk2` (`RegNo`),
  KEY `Submissions_fk3` (`Class_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`Problem_Id`, `Test_Id`, `RegNo`, `Class_Id`, `Number_Of_Attempts`, `Submitted_Solution_Path`, `File_Name`, `Language_Used`, `Marks_Given`, `Status`, `Submit_Status`) VALUES
(2, 3, '13bce1085', '1264', 0, '13bce1085/3/2/solution.txt', 'solve.cpp', 'cpp', 0, 2, 1),
(3, 56, '13bce1085', '1264', 0, '13bce1085/56/3/solution.txt', 'solve.cpp', 'cpp', 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `Test_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Test_Title` varchar(50) NOT NULL,
  `Start_Time` datetime NOT NULL,
  `End_Time` datetime NOT NULL,
  `Open_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Begin_Key` varchar(20) NOT NULL,
  `Remove_Begin_Key` tinyint(1) NOT NULL,
  `Type` int(2) NOT NULL,
  PRIMARY KEY (`Test_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`Test_Id`, `Test_Title`, `Start_Time`, `End_Time`, `Open_Status`, `Begin_Key`, `Remove_Begin_Key`, `Type`) VALUES
(1, 'left shift', '2016-06-02 00:00:00', '2016-06-04 00:00:00', 1, 'begin_key', 0, 0),
(2, 'right shift', '2016-06-03 00:00:00', '2016-06-05 00:00:00', 0, 'begin_key', 0, 0),
(3, 'niranj and calls', '2016-06-05 00:00:00', '2016-06-16 00:00:00', 1, 'begin_key', 1, 0),
(4, 'niranj and runs', '2016-06-03 00:00:00', '2016-06-13 00:00:00', 0, 'begin_key', 1, 0),
(43, 'asdfyhbnjk', '2016-01-16 00:00:00', '2016-01-17 00:00:00', 1, 'sid', 0, 0),
(44, 'asdfghjk', '2016-01-02 00:00:00', '2016-01-10 00:00:00', 1, 'zdfzggzgh', 0, 0),
(45, 'wertyui', '2016-01-08 00:00:00', '2016-01-30 00:00:00', 1, 'ghjjkll', 0, 0),
(46, 'qwerty', '2016-01-02 00:00:00', '2016-01-24 00:00:00', 1, 'thujik', 0, 0),
(47, 'qwrfhnim', '2016-01-05 00:00:00', '2016-01-14 00:00:00', 1, 'ujmnhytg', 0, 0),
(48, 'qwertyu', '2016-01-11 00:00:00', '2016-01-31 00:00:00', 1, 'yhnmjuki', 0, 0),
(49, 'ascfgb', '2016-01-15 00:00:00', '2016-01-17 00:00:00', 1, '', 1, 0),
(50, 'dfvgbhnjm', '2016-01-13 00:00:00', '2016-01-16 00:00:00', 1, '10236', 0, 0),
(51, 'awsedrfth', '2016-01-02 00:00:00', '2016-01-24 00:00:00', 1, 'bnmjk', 0, 0),
(52, 'rtgbnh', '2016-01-09 00:00:00', '2016-01-17 00:00:00', 1, '', 1, 0),
(53, 'q', '2016-01-12 00:00:00', '2016-01-22 00:00:00', 1, '', 1, 0),
(54, 'qwerty', '2016-01-13 00:00:00', '2016-01-22 00:00:00', 1, '', 1, 0),
(55, 'qaqxd', '2016-02-18 00:00:00', '2016-02-27 00:00:00', 1, '', 1, 0),
(56, 'Bit Manip', '2016-06-14 00:00:00', '2016-06-15 00:00:00', 1, '', 1, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `Classes_fk0` FOREIGN KEY (`Faculty_Id`) REFERENCES `faculties` (`Faculty_Id`);

--
-- Constraints for table `classes_tests`
--
ALTER TABLE `classes_tests`
  ADD CONSTRAINT `Classes_Tests_fk0` FOREIGN KEY (`Class_Id`) REFERENCES `classes` (`Class_Id`),
  ADD CONSTRAINT `Classes_Tests_fk1` FOREIGN KEY (`Test_Id`) REFERENCES `tests` (`Test_Id`);

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `Problems_fk0` FOREIGN KEY (`Test_Id`) REFERENCES `tests` (`Test_Id`);

--
-- Constraints for table `students_classes`
--
ALTER TABLE `students_classes`
  ADD CONSTRAINT `Students_Classes_fk0` FOREIGN KEY (`Class_Id`) REFERENCES `classes` (`Class_Id`),
  ADD CONSTRAINT `Students_Classes_fk1` FOREIGN KEY (`RegNo`) REFERENCES `students` (`RegNo`);

--
-- Constraints for table `student_tests`
--
ALTER TABLE `student_tests`
  ADD CONSTRAINT `Student_Tests_fk0` FOREIGN KEY (`Test_Id`) REFERENCES `tests` (`Test_Id`),
  ADD CONSTRAINT `Student_Tests_fk1` FOREIGN KEY (`RegNo`) REFERENCES `students` (`RegNo`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `Submissions_fk0` FOREIGN KEY (`Problem_Id`) REFERENCES `problems` (`Problem_Id`),
  ADD CONSTRAINT `Submissions_fk1` FOREIGN KEY (`Test_Id`) REFERENCES `tests` (`Test_Id`),
  ADD CONSTRAINT `Submissions_fk2` FOREIGN KEY (`RegNo`) REFERENCES `students` (`RegNo`),
  ADD CONSTRAINT `Submissions_fk3` FOREIGN KEY (`Class_Id`) REFERENCES `classes` (`Class_Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
