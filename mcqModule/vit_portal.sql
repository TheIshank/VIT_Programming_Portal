-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2016 at 04:26 PM
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
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Admin_Id` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `salt` varchar(6) NOT NULL,
  `hash` varchar(80) NOT NULL
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
  `Course_Title` varchar(30) NOT NULL
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
('1269', 'fac5', 2017, 'some title');

-- --------------------------------------------------------

--
-- Table structure for table `classes_tests`
--

CREATE TABLE IF NOT EXISTS `classes_tests` (
  `Class_Id` varchar(20) NOT NULL,
  `Test_Id` int(11) NOT NULL
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
('1264', 56),
('1264', 57),
('1264', 58),
('1267', 58),
('1265', 59),
('1264', 60),
('1267', 60),
('1264', 62),
('1267', 62),
('1264', 63),
('1267', 63),
('1264', 83),
('1265', 83),
('1266', 83),
('1267', 83),
('1268', 83),
('1264', 84),
('1266', 84);

-- --------------------------------------------------------

--
-- Table structure for table `email_group`
--

CREATE TABLE IF NOT EXISTS `email_group` (
  `Group_Id` int(11) NOT NULL,
  `Batch` int(4) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Reg_Nos` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

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
(55, 2013, 'random', '13bce1091,13bce1040,13bce1105,13bce1146,13bce1085'),
(59, 2013, 'Random', '13BCE1085'),
(60, 2017, 'Absentees', '13BCE1040,13BCE1085');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `Faculty_Id` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
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
  `Expiary_Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE IF NOT EXISTS `problems` (
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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`Problem_Id`, `Tag1`, `Tag2`, `Subject`, `Problem_Title`, `Description_Path`, `question_mark`, `Option_1`, `Option_2`, `Option_3`, `Option_4`, `Answer`, `Type`) VALUES
(3, 'algorithm', 'looping', 'CSE2002', 'XOR', '<p>some stuff</p>\r\n', 1, 'TRUE', 'FALSE', '', '', '2', 0),
(8, 'nalgo', 'loop', 'CSE2001', 'Subtract two numbers', 'admin-login/8/description.txt', 10, '17', '14', NULL, NULL, '1,2', 1),
(43, 'some', 'so', 'CSE2002', 'hello chef', 'something about it ', 2, '12', '23', '32', '43', '1,2', 1),
(51, 'pop', 'so', 'CSE1003', 'utkarsh', 'dkjrhgdhgdkvhkd', 1, 'TRUE', 'FALE', '', '', '2', 0),
(52, 'some', 'lo', 'CSE2002', 'for looping', 'we do questions on for loop', 1, 'TRUE', 'FALSE', '', '', '1', 0),
(53, 'pop', 'lo', 'CSE1003', 'some problem', 'some description', 1, 'TRUE', 'FALSE', '', '', '1', 0),
(56, 'some', 'lo', 'CSE2002', 'hello people', 'yo people', 1, 'TRUE', 'FALSE', '', '', '2', 0),
(58, 'tag1', 'tag2', 'CSE2001', 'shukla ', '<p>something about something</p>\r\n', 1, 'TRUE', 'FALSE', '', '', '1', 0),
(59, 'algorithm', 'graph theory', 'CSE2001', 'hello to chefs game', '<p>here we shall be giving the description of the ', 2, '12 if even', '13 if even', '21 if odd', '23 if odd', '2,3', 1);

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
  `Password` varchar(20) NOT NULL,
  `salt` varchar(6) NOT NULL,
  `hash` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`RegNo`, `Name`, `Batch`, `Degree`, `Email_Id`, `Recovery_Email_Id`, `Block_Status`, `Password`, `salt`, `hash`) VALUES
('13BCE1085', 'Niranj', 2017, 'B.Tech(ComputerandScienceEngineering)', 'niranj.jyothish2013@vit.ac.in', 'niranj.jyothish2013@vit.ac.in', 1, '1234', 'eq1yn', 'eqpcr77gqs6qE'),
('13BCE1105', 'Ankit Rai', 2017, 'B.Tech(ElectronicsandCommunicationEngineering)', 'raiankit.kumar2013@vit.ac.in', 'raiankit474@gmail.com', 0, '789', '', ''),
('13BCE1146', 'Siddhant', 2016, 'M.Tech(CloudComputing)', 'siddhant.verma2013@vit.ac.in', 'siddhant.verma2013@vit.ac.in', 0, 'siddhant', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `students_classes`
--

CREATE TABLE IF NOT EXISTS `students_classes` (
  `Class_Id` varchar(20) NOT NULL,
  `RegNo` varchar(20) NOT NULL
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
  `Block_Status` tinyint(4) NOT NULL DEFAULT '0',
  `Marks` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tests`
--

INSERT INTO `student_tests` (`Test_Id`, `RegNo`, `Block_Status`, `Marks`) VALUES
(1, '13BCE1105', 0, 0),
(3, '13BCE1085', 1, 0),
(3, '13BCE1146', 1, 0),
(4, '13BCE1085', 0, 0),
(43, '13BCE1085', 0, 54),
(58, '13BCE1085', 0, 41);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(4) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_code`, `name`) VALUES
(3, 'CSE1003', 'Digital Logics and Design'),
(1, 'CSE2001', 'data structures'),
(2, 'CSE2002', 'Problem Solving and Algorithms'),
(4, 'CSE2004', 'Database Management System'),
(5, 'CSE3001', 'software eng');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `Problem_Id` int(11) NOT NULL,
  `Test_Id` int(11) NOT NULL,
  `RegNo` varchar(20) NOT NULL,
  `Class_Id` varchar(20) NOT NULL,
  `Solution_Path` varchar(70) NOT NULL,
  `Marks_Given` int(3) NOT NULL DEFAULT '0',
  `QuestionAttempted` tinyint(1) DEFAULT '0',
  `IsFlag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`Test_Id`, `Test_Title`, `Start_Time`, `End_Time`, `Begin_Key`, `Remove_Begin_Key`, `Type`, `Subject`, `Problem_Id`) VALUES
(1, 'left shift', '2016-10-12 00:00:00', '2016-10-25 16:47:00', 'utkarsh', 0, 0, 'CSE2002', ''),
(2, 'right shift', '2016-01-02 00:00:00', '2016-10-18 07:13:36', 'begin_key', 0, 0, 'CSE2002', ''),
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
(52, 'rtgbnh', '2016-02-25 10:00:00', '2016-11-01 08:47:11', '', 1, 0, 'CSE2001', ''),
(53, 'q', '2016-01-12 00:00:00', '2016-01-22 00:00:00', '', 1, 0, 'CSE2001', ''),
(54, 'qwerty', '2016-01-13 00:00:00', '2016-01-22 00:00:00', '', 1, 0, 'CSE2001', ''),
(55, 'qaqxd', '2016-02-18 00:00:00', '2016-02-27 00:00:00', '', 1, 0, 'CSE2001', ''),
(56, 'Bit Manip', '2016-06-14 00:00:00', '2016-06-15 00:00:00', '', 1, 0, 'CSE2001', ''),
(57, 'test 1', '2016-01-01 00:00:00', '2016-01-09 00:00:00', '', 1, 0, 'CSE2001', ''),
(58, 'Test 1', '2016-06-23 00:00:00', '2016-06-24 00:00:00', '', 1, 0, 'CSE2001', ''),
(59, 'Left shift!!', '2016-01-02 00:00:00', '2016-01-10 00:00:00', '', 1, 0, 'CSE2001', ''),
(60, 'Test 23', '2016-01-01 00:00:00', '2016-01-03 00:00:00', '123', 0, 0, 'CSE2001', ''),
(62, 'NewTest', '2016-03-06 00:00:00', '2016-03-20 00:00:00', '', 1, 0, 'CSE2001', ''),
(63, 'New Test', '2016-03-06 00:00:00', '2016-03-20 00:00:00', '', 1, 0, 'CSE2001', ''),
(73, 'asdadadadaasdasasd', '2013-12-30 00:59:00', '2016-12-31 12:59:00', 'sdadad', 0, 1, 'CSE2002', '17,18'),
(74, 'swap the array', '2015-12-31 12:59:00', '2016-12-31 11:59:00', 'utkarsh', 0, 1, 'CSE2001', '2,3,7'),
(75, 'terwwe', '2012-01-01 00:59:00', '2016-12-31 12:59:00', '', 0, 1, 'CSE2002', '16,17,18'),
(76, 'arrays and graphs', '2014-12-31 23:59:00', '2016-12-31 12:59:00', 'utkarsh', 0, 1, 'CSE2002', '43,52'),
(77, 'stacks and queue', '2015-12-31 12:59:00', '2016-12-31 12:59:00', '', 0, 1, 'CSE2001', '3,7'),
(83, 'data_structures_all', '2015-12-31 12:59:00', '2016-12-31 12:59:00', '', 0, 1, 'CSE2002', '43,52,56'),
(84, 'operating systems', '2014-12-31 12:59:00', '2016-12-31 12:59:00', 'key', 0, 1, 'CSE2002', '43,52,56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_Id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Class_Id`,`Batch`),
  ADD KEY `Classes_fk0` (`Faculty_Id`);

--
-- Indexes for table `classes_tests`
--
ALTER TABLE `classes_tests`
  ADD PRIMARY KEY (`Class_Id`,`Test_Id`),
  ADD KEY `Classes_Tests_fk1` (`Test_Id`);

--
-- Indexes for table `email_group`
--
ALTER TABLE `email_group`
  ADD PRIMARY KEY (`Group_Id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`Faculty_Id`);

--
-- Indexes for table `password_reset_otp`
--
ALTER TABLE `password_reset_otp`
  ADD PRIMARY KEY (`Reg_No`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`Problem_Id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`RegNo`);

--
-- Indexes for table `students_classes`
--
ALTER TABLE `students_classes`
  ADD PRIMARY KEY (`Class_Id`,`RegNo`),
  ADD KEY `Students_Classes_fk1` (`RegNo`);

--
-- Indexes for table `student_tests`
--
ALTER TABLE `student_tests`
  ADD PRIMARY KEY (`Test_Id`,`RegNo`),
  ADD KEY `Student_Tests_fk1` (`RegNo`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_code`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`Problem_Id`,`Test_Id`,`RegNo`),
  ADD KEY `Submissions_fk1` (`Test_Id`),
  ADD KEY `Submissions_fk2` (`RegNo`),
  ADD KEY `Submissions_fk3` (`Class_Id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`Test_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_group`
--
ALTER TABLE `email_group`
  MODIFY `Group_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `Problem_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `Test_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
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
