-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2016 at 07:15 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vit_programming_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Admin_Id` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  PRIMARY KEY (`Admin_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_Id`, `Password`) VALUES
('ankit', 'ankit'),
('ganesh', 'ganesh'),
('niranj', 'niranj'),
('siddhant', 'siddhant'),
('trushangi', 'trushangi');

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
('1268', 43);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `email_group`
--

INSERT INTO `email_group` (`Group_Id`, `Batch`, `Description`, `Reg_Nos`) VALUES
(3, 2015, 'fuegflakfniqfpoa;fmiafyowndf', '13bce1146,13bce1047'),
(4, 2015, 'fbejflqefleflnclfdqfff;jf', 'ss'),
(5, 2015, 'fbejflqefleflnclfdqfff;jf', 'RegNos'),
(6, 2015, 'fbejflqefleflnclfdqfff;jf', '13BCE1146,13BCE1040'),
(7, 0, '', 'f'),
(8, 0, '', 'f'),
(9, 0, '', 'f'),
(10, 0, 'fhilfkgkfo``', '13BCE1105,13BCE1091'),
(11, 0, 'fhilfkgkfo``', '13BCE1105,13BCE1091'),
(12, 2013, 'retest', '13BCE1146,13BCE1040,13BCE1091,13BCE1105'),
(13, 2017, 'maa kasam', '13BCE1091,13BCE1146,13BCE1105,13BCE1040'),
(14, 2013, 'new test', '13BCE1091,13BCE1146,13BCE1105');

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
('fac1', 'fac1'),
('fac2', 'fac2'),
('fac3', 'fac3'),
('fac4', 'fac4'),
('fac5', 'fac5');

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE IF NOT EXISTS `problems` (
  `Problem_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Test_Id` int(11) NOT NULL,
  `Problem_Title` varchar(50) NOT NULL,
  `Execution_Time` int(2) NOT NULL,
  `Description_Path` varchar(50) NOT NULL,
  `Test_Case_Input_Path` varchar(50) NOT NULL,
  `Test_Case_Output_Path` varchar(30) NOT NULL,
  `Hidden_Case_Input_Path` varchar(30) NOT NULL,
  `Hidden_Case_Output_Path` varchar(30) NOT NULL,
  `Difficulty_Level` int(1) NOT NULL,
  `Maximum_Marks` int(3) NOT NULL,
  PRIMARY KEY (`Problem_Id`,`Test_Id`),
  KEY `Problems_fk0` (`Test_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`Problem_Id`, `Test_Id`, `Problem_Title`, `Execution_Time`, `Description_Path`, `Test_Case_Input_Path`, `Test_Case_Output_Path`, `Hidden_Case_Input_Path`, `Hidden_Case_Output_Path`, `Difficulty_Level`, `Maximum_Marks`) VALUES
(1, 1, 'Sherlock and Knightange', 1, '1234567890', 'xfxgxgfxg', 'gjfg', 'fhgfhf', 'hfff', 1, 10),
(2, 1, 'Siddhant and Ankit', 2, 'gg', 'ggg', 'gg', 'gg', 'g', 2, 20),
(3, 2, 'Siddhant and Deapth first search', 2, 'g', 'gh', 'g', 'hg', 'hjgj', 1, 10),
(4, 4, 'bfs', 1, 'jgjg', 'jgj', 'gjh', 'g', 'g', 3, 30);

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
  PRIMARY KEY (`RegNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`RegNo`, `Name`, `Email_Id`, `Recovery_Email_Id`, `Block_Status`) VALUES
('13BCE1040', 'Ganesh', 't.ganesh2013@vit.ac.in', 'ganesh.t2013@vit.ac.in', 0),
('13BCE1085', 'Niranj', 'niranj.jyothish2013@vit.ac.in', 'niranj.jyothish2013@vit.ac.in', 1),
('13BCE1091', 'Time Pass', 'time.pass@biscuit.com', 'time@pass.com', 0),
('13BCE1105', 'Ankit Rai', 'raiankit.kumar2013@vit.ac.in', 'raiankit474@gmail.com', 0),
('13BCE1146', 'Siddhant', 'siddhant.verma2013@vit.ac.in', 'siddhant.verma2013@vit.ac.in', 0);

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
('1264', '13BCE1040'),
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
(1, '13BCE1040', 0, 0),
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
  `Language_Used` varchar(20) NOT NULL,
  `Marks_Given` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Problem_Id`,`Test_Id`,`RegNo`),
  KEY `Submissions_fk1` (`Test_Id`),
  KEY `Submissions_fk2` (`RegNo`),
  KEY `Submissions_fk3` (`Class_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`Problem_Id`, `Test_Id`, `RegNo`, `Class_Id`, `Number_Of_Attempts`, `Submitted_Solution_Path`, `Language_Used`, `Marks_Given`) VALUES
(1, 1, '13BCE1040', '1266', 2, 'wrw', 'c', 20),
(4, 2, '13BCE1085', '1268', 2, '', 'python', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`Test_Id`, `Test_Title`, `Start_Time`, `End_Time`, `Open_Status`, `Begin_Key`, `Remove_Begin_Key`, `Type`) VALUES
(1, 'left shift', '2016-06-02 00:00:00', '2016-06-04 00:00:00', 1, 'begin_key', 0, 0),
(2, 'right shift', '2016-06-03 00:00:00', '2016-06-05 00:00:00', 0, 'begin_key', 0, 0),
(3, 'niranj and calls', '2016-06-05 00:00:00', '2016-06-16 00:00:00', 0, 'begin_key', 1, 0),
(4, 'niranj and runs', '2016-06-03 00:00:00', '2016-06-13 00:00:00', 0, 'begin_key', 1, 0),
(43, 'asdfyhbnjk', '2016-01-16 00:00:00', '2016-01-17 00:00:00', 1, 'sid', 0, 0);

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
  ADD CONSTRAINT `Classes_Tests_fk1` FOREIGN KEY (`Test_Id`) REFERENCES `tests` (`Test_Id`),
  ADD CONSTRAINT `Classes_Tests_fk0` FOREIGN KEY (`Class_Id`) REFERENCES `classes` (`Class_Id`);

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `Problems_fk0` FOREIGN KEY (`Test_Id`) REFERENCES `tests` (`Test_Id`);

--
-- Constraints for table `students_classes`
--
ALTER TABLE `students_classes`
  ADD CONSTRAINT `Students_Classes_fk1` FOREIGN KEY (`RegNo`) REFERENCES `students` (`RegNo`),
  ADD CONSTRAINT `Students_Classes_fk0` FOREIGN KEY (`Class_Id`) REFERENCES `classes` (`Class_Id`);

--
-- Constraints for table `student_tests`
--
ALTER TABLE `student_tests`
  ADD CONSTRAINT `Student_Tests_fk1` FOREIGN KEY (`RegNo`) REFERENCES `students` (`RegNo`),
  ADD CONSTRAINT `Student_Tests_fk0` FOREIGN KEY (`Test_Id`) REFERENCES `tests` (`Test_Id`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `Submissions_fk3` FOREIGN KEY (`Class_Id`) REFERENCES `classes` (`Class_Id`),
  ADD CONSTRAINT `Submissions_fk0` FOREIGN KEY (`Problem_Id`) REFERENCES `problems` (`Problem_Id`),
  ADD CONSTRAINT `Submissions_fk1` FOREIGN KEY (`Test_Id`) REFERENCES `tests` (`Test_Id`),
  ADD CONSTRAINT `Submissions_fk2` FOREIGN KEY (`RegNo`) REFERENCES `students` (`RegNo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
