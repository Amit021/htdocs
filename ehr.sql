-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 28, 2024 at 11:32 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `profile` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `profile`) VALUES
(11, 'admin1', 'admin1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `status` enum('scheduled','completed','cancelled') DEFAULT NULL,
  `date_booked` datetime DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `symptoms` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `patient_id`, `doctor_id`, `appointment_date`, `status`, `date_booked`, `gender`, `firstname`, `surname`, `phone`, `symptoms`) VALUES
(1, 1, 1, '2024-01-25 00:00:00', 'scheduled', '2024-01-23 23:09:03', 'male', 'patient1', 'pat', '33333', 'fever'),
(2, 1, 3, '2024-01-11 00:00:00', 'scheduled', '2024-01-24 14:20:07', 'female', 'patient1', 'pat', '33333', 'cough'),
(3, 1, 1, '2024-01-19 00:00:00', 'scheduled', '2024-01-24 14:21:52', 'female', 'patient1', 'pat', '33333', 'fever'),
(6, 3, 14, '2024-01-17 00:00:00', 'scheduled', '2024-01-27 13:13:52', 'male', 'pat1111', 'pat1111', '3322', 'fever'),
(13, 6, 1, '2024-01-31 00:00:00', 'scheduled', '2024-01-29 00:03:58', NULL, NULL, NULL, NULL, 'Fever');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `data_reg` varchar(15) DEFAULT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `firstname`, `surname`, `specialty`, `phone`, `email`, `username`, `password`, `gender`, `data_reg`, `profile`, `country`, `status`) VALUES
(1, 'doctor1', 'doc', 'speciality1', NULL, NULL, 'doc1', 'doc1', 'male', NULL, NULL, 'Germany', NULL),
(3, 'doc2', 'doc', 'specialty2', '123456', 'doc2@email.com', 'doc2', 'doc2', 'female', NULL, NULL, NULL, NULL),
(14, 'doc111', 'doc111', 'doc111', '2344', 'doc111@email.com', 'doc111', 'doc111', 'female', '', 'Screenshot 2024-01-25 at 8.38.01 PM.png', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `record_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `visit_date` date DEFAULT NULL,
  `notes` text,
  `diagnosis` text,
  `treatment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`record_id`, `patient_id`, `visit_date`, `notes`, `diagnosis`, `treatment`) VALUES
(5, 1, '2024-01-24', 'lorem ipsum', 'Jaundice', 'Rest, drink fluid'),
(8, 3, '2024-01-24', 'test', 'tets', 'tets'),
(9, 3, '2024-01-24', 'test1', 'test1', 'test1'),
(11, 3, '2024-01-07', 'lorem Ipsum', 'Muscle Strain', 'Rest'),
(37, NULL, NULL, NULL, NULL, NULL),
(38, NULL, NULL, NULL, NULL, NULL),
(39, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text,
  `country` varchar(30) DEFAULT NULL,
  `profile` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `date_reg` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `firstname`, `surname`, `password`, `date_of_birth`, `gender`, `phone`, `email`, `address`, `country`, `profile`, `username`, `date_reg`) VALUES
(1, 'patient1', 'pat', 'pat1', NULL, 'male', NULL, NULL, NULL, 'Germany', NULL, 'pat1', NULL),
(3, 'pat1111', 'pat1111', 'pat1111', '2024-01-27', 'male', '112334', 'pat1111@email.com', 'pat1111', '', '', 'pat1111', NULL),
(4, 'patient2', 'pat', 'pat2', '2023-04-12', 'female', '1234', 'pat2@email.com', 'pat2', '', '', 'pat2', NULL),
(5, 'patient3', 'pat', 'pat3', '2023-07-07', 'male', '4566', 'pat3@email.com', 'pat3', '', '', 'pat3', NULL),
(6, 'patient123', 'pat', 'patient123', '2014-07-29', 'female', '1234567', 'patient123@email.com', 'pfarrkirchen', '', '', 'patient123', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `medical_records_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
