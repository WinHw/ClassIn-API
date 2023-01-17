-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 04:49 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classin`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` enum('student','lecturer') NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `level`, `name`, `email`, `phone`, `picture`) VALUES
(2, 'admin', 'admin', 'lecturer', 'Administrator', '', NULL, NULL),
(3, '198603032010121004', '198603032010121004', 'lecturer', 'Romi Fadillah Rahmat B.Comp.Sc., M.Sc.', '198603032010121004@students.usu.ac.id', NULL, NULL),
(4, '191402012', '191402012', 'student', 'Arafah Nur Ihza', '191402012@students.usu.ac.id', NULL, NULL),
(5, '191402027', '191402027', 'student', 'Jefry Lianto', '191402027@students.usu.ac.id', NULL, NULL),
(6, '191402066', '191402066', 'student', 'Mhd. Arsya Fikri', '191402066@students.usu.ac.id', NULL, NULL),
(7, '191402072', '191402072', 'student', 'Hendry Winata', '191402072@students.usu.ac.id', NULL, NULL),
(8, '191402114', '191402114', 'student', 'Dolok Marsaong Asi Malau', '191402114@students.usu.ac.id', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(8) NOT NULL,
  `class` enum('A','B','C','D','E','F') NOT NULL,
  `semester` enum('odd','even') NOT NULL,
  `year` varchar(9) NOT NULL,
  `lecturer_id` int(10) UNSIGNED NOT NULL,
  `status` enum('active','locked','past') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `class`, `semester`, `year`, `lecturer_id`, `status`) VALUES
(1, 'TIF4501', 'C', 'odd', '2022/2023', 3, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `course_details`
--

CREATE TABLE `course_details` (
  `code` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `credits` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_details`
--

INSERT INTO `course_details` (`code`, `name`, `credits`) VALUES
('TIF4501', 'Pemrograman Mobile', 3),
('TIF4504', 'IT-Preneurship', 2),
('TIF4505', 'Data Warehouse dan inis Intelligence', 3),
('TIF4506', 'Teknik Penulisan Karya Ilmiah', 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_participants`
--

CREATE TABLE `course_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_participants`
--

INSERT INTO `course_participants` (`id`, `course_id`, `student_id`) VALUES
(1, 1, 4),
(2, 1, 5),
(3, 1, 6),
(4, 1, 7),
(5, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `course_presences`
--

CREATE TABLE `course_presences` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `start` datetime NOT NULL DEFAULT current_timestamp(),
  `end` datetime NOT NULL,
  `status` enum('opened','closed','cancelled') NOT NULL,
  `location` text NOT NULL,
  `lecturer_location` text NOT NULL,
  `lecturer_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants_presences`
--

CREATE TABLE `participants_presences` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_presence_id` int(10) UNSIGNED NOT NULL,
  `participant_id` int(10) UNSIGNED NOT NULL,
  `presence_datetime` datetime NOT NULL,
  `location` text DEFAULT NULL,
  `status` enum('?','present','late','absent','sick','permission') NOT NULL DEFAULT '?',
  `proof` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecturer_id` (`lecturer_id`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `course_details`
--
ALTER TABLE `course_details`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `course_participants`
--
ALTER TABLE `course_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course_presences`
--
ALTER TABLE `course_presences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `participants_presences`
--
ALTER TABLE `participants_presences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_presence_id` (`course_presence_id`),
  ADD KEY `participant_id` (`participant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_participants`
--
ALTER TABLE `course_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_presences`
--
ALTER TABLE `course_presences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants_presences`
--
ALTER TABLE `participants_presences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`code`) REFERENCES `course_details` (`code`);

--
-- Constraints for table `course_participants`
--
ALTER TABLE `course_participants`
  ADD CONSTRAINT `course_participants_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `course_participants_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `course_presences`
--
ALTER TABLE `course_presences`
  ADD CONSTRAINT `course_presences_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `participants_presences`
--
ALTER TABLE `participants_presences`
  ADD CONSTRAINT `participants_presences_ibfk_1` FOREIGN KEY (`course_presence_id`) REFERENCES `course_presences` (`id`),
  ADD CONSTRAINT `participants_presences_ibfk_2` FOREIGN KEY (`participant_id`) REFERENCES `course_participants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
