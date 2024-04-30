-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 04:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `campus_id` int(11) NOT NULL,
  `campus_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `distance_to_city_center` decimal(10,2) DEFAULT NULL,
  `bus_route` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`campus_id`, `campus_name`, `address`, `distance_to_city_center`, `bus_route`) VALUES
(1, 'Engeering - Bio', 'Chatikra', 5.00, 'Same'),
(2, 'KESI CMPAUS', 'CHAUMUA Mathura', 400.00, 'Vhatikya');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `club_id` int(11) NOT NULL,
  `club_name` varchar(255) DEFAULT NULL,
  `building_location` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `sports_offered` varchar(255) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `Day_Created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`club_id`, `club_name`, `building_location`, `phone_number`, `sports_offered`, `campus_id`, `Day_Created`) VALUES
(1, 'Cyberknight', 'Ab-6', '8218429929', 'Cyber-security', 1, '2024-04-13'),
(2, 'GeekForGeek', 'Ab-7', '9412714387', 'Cs', 1, '2024-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

CREATE TABLE `committee` (
  `committee_id` int(11) NOT NULL,
  `committee_title` varchar(255) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `meeting_frequency` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`committee_id`, `committee_title`, `faculty_id`, `meeting_frequency`) VALUES
(1, 'Ragging', 1, '10');

-- --------------------------------------------------------

--
-- Table structure for table `committee_member`
--

CREATE TABLE `committee_member` (
  `committee_member_id` int(11) NOT NULL,
  `committee_id` int(11) DEFAULT NULL,
  `lecturer_id` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `course_title` varchar(255) DEFAULT NULL,
  `programme_id` int(11) DEFAULT NULL,
  `prerequisite_course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_code`, `course_title`, `programme_id`, `prerequisite_course_id`) VALUES
(20254, 'BCSC0051', 'English', 202401, NULL),
(202456, 'BCSC5465', 'DBMS', 202401, 20254);

-- --------------------------------------------------------

--
-- Table structure for table `course_result`
--

CREATE TABLE `course_result` (
  `result_id` varchar(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `term` varchar(50) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_result`
--

INSERT INTO `course_result` (`result_id`, `student_id`, `course_id`, `year`, `term`, `grade`) VALUES
('EXAM1001', 20240001, 202456, 2024, '1', 'A'),
('EXAM1002', 20240002, 20254, 2024, '2', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(255) DEFAULT NULL,
  `dean` varchar(255) DEFAULT NULL,
  `building_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `dean`, `building_location`) VALUES
(1, 'CSED', 'Manoj Sir', 'AB-1'),
(2, 'Biotech', 'XYZ', 'AB-8');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturer_id` varchar(11) NOT NULL,
  `lecturer_name` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `office_room` varchar(50) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `supervisor_id` varchar(11) DEFAULT NULL,
  `Joining_Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecturer_id`, `lecturer_name`, `title`, `office_room`, `school_id`, `supervisor_id`, `Joining_Date`) VALUES
('LEC001', 'Jatin Khetan', 'English', '107', 1, 'NULL', '2024-04-17'),
('LEC002', 'Mayank Sharma', 'Mathmetics', '105', 1, 'NULL', '2024-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE `programme` (
  `programme_id` int(11) NOT NULL,
  `programme_code` varchar(20) DEFAULT NULL,
  `programme_title` varchar(255) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`programme_id`, `programme_code`, `programme_title`, `level`, `duration`, `school_id`) VALUES
(202401, 'BCSC0051', 'Btech Honors', 'Medium', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `school_id` int(11) NOT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `building_location` varchar(255) DEFAULT NULL,
  `campus_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`school_id`, `school_name`, `building_location`, `campus_id`, `faculty_id`) VALUES
(1, 'School Of Biology', 'Ab-9', 1, 2),
(2, 'Maths', 'Ab-7', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `enrolment_date` date DEFAULT current_timestamp(),
  `programme_id` int(11) DEFAULT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `birthday`, `enrolment_date`, `programme_id`, `password`) VALUES
(20240001, 'Jatin Khetan', '2005-12-05', '2024-04-17', 202401, 'Jatin@321'),
(20240002, 'Mayank', '2004-07-05', '2024-04-17', 202401, 'mayank1234'),
(20240003, 'Mayank Sharma', '2005-12-05', '2024-04-22', 202401, 'iavoCzPZ#P'),
(20240004, 'Garvit', '2005-04-05', '2024-04-23', 202401, 'Garvit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`campus_id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`club_id`),
  ADD KEY `campus_id` (`campus_id`);

--
-- Indexes for table `committee`
--
ALTER TABLE `committee`
  ADD PRIMARY KEY (`committee_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `committee_member`
--
ALTER TABLE `committee_member`
  ADD PRIMARY KEY (`committee_member_id`),
  ADD KEY `committee_id` (`committee_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `programme_id` (`programme_id`),
  ADD KEY `prerequisite_course_id` (`prerequisite_course_id`);

--
-- Indexes for table `course_result`
--
ALTER TABLE `course_result`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturer_id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `supervisor_id` (`supervisor_id`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`programme_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `campus_id` (`campus_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `programme_id` (`programme_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ibfk_1` FOREIGN KEY (`campus_id`) REFERENCES `campus` (`campus_id`);

--
-- Constraints for table `committee`
--
ALTER TABLE `committee`
  ADD CONSTRAINT `committee_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`programme_id`) REFERENCES `programme` (`programme_id`),
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`prerequisite_course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `course_result`
--
ALTER TABLE `course_result`
  ADD CONSTRAINT `course_result_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `course_result_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `programme`
--
ALTER TABLE `programme`
  ADD CONSTRAINT `programme_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`school_id`);

--
-- Constraints for table `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `school_ibfk_1` FOREIGN KEY (`campus_id`) REFERENCES `campus` (`campus_id`),
  ADD CONSTRAINT `school_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`programme_id`) REFERENCES `programme` (`programme_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
