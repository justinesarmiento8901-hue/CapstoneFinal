-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2025 at 05:15 AM
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
-- Database: `crudoperation`
--

-- --------------------------------------------------------

--
-- Table structure for table `growth_reference`
--

CREATE TABLE `growth_reference` (
  `id` int(11) NOT NULL,
  `age_in_months` int(11) NOT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `weight_min` decimal(4,1) NOT NULL,
  `weight_max` decimal(4,1) NOT NULL,
  `height_min` decimal(5,1) NOT NULL,
  `height_max` decimal(5,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `growth_reference`
--

INSERT INTO `growth_reference` (`id`, `age_in_months`, `sex`, `weight_min`, `weight_max`, `height_min`, `height_max`) VALUES
(1, 0, NULL, 2.5, 4.3, 45.0, 55.0),
(2, 1, NULL, 3.4, 5.5, 50.0, 58.0),
(3, 2, NULL, 4.3, 6.8, 54.0, 62.0),
(4, 3, NULL, 5.0, 7.5, 57.0, 65.0),
(5, 4, NULL, 5.6, 8.1, 59.0, 67.0),
(6, 5, NULL, 6.1, 8.6, 61.0, 69.0),
(7, 6, NULL, 6.4, 9.1, 63.0, 71.0),
(8, 7, NULL, 6.7, 9.5, 65.0, 72.0),
(9, 8, NULL, 7.0, 9.8, 66.0, 74.0),
(10, 9, NULL, 7.2, 10.2, 67.0, 75.0),
(11, 10, NULL, 7.4, 10.5, 68.0, 76.0),
(12, 11, NULL, 7.6, 10.8, 69.0, 77.0),
(13, 12, NULL, 7.8, 11.0, 70.0, 78.0),
(14, 0, 'Male', 2.5, 4.3, 46.0, 54.0),
(15, 0, 'Female', 2.4, 4.2, 45.0, 53.0),
(16, 1, 'Male', 3.4, 5.8, 50.0, 59.0),
(17, 1, 'Female', 3.2, 5.5, 49.0, 58.0),
(18, 2, 'Male', 4.3, 7.0, 53.0, 62.0),
(19, 2, 'Female', 4.0, 6.6, 52.0, 61.0),
(20, 3, 'Male', 5.0, 7.8, 55.0, 65.0),
(21, 3, 'Female', 4.6, 7.5, 54.0, 64.0),
(22, 4, 'Male', 5.6, 8.6, 57.0, 67.0),
(23, 4, 'Female', 5.1, 8.2, 56.0, 66.0),
(24, 5, 'Male', 6.1, 9.2, 59.0, 69.0),
(25, 5, 'Female', 5.5, 8.8, 58.0, 68.0),
(26, 6, 'Male', 6.4, 9.7, 60.0, 70.0),
(27, 6, 'Female', 5.8, 9.2, 59.0, 70.0),
(28, 7, 'Male', 6.7, 10.2, 61.0, 71.5),
(29, 7, 'Female', 6.0, 9.6, 60.0, 71.0),
(30, 8, 'Male', 6.9, 10.6, 62.0, 73.0),
(31, 8, 'Female', 6.2, 10.0, 61.0, 72.0),
(32, 9, 'Male', 7.1, 11.0, 63.0, 74.0),
(33, 9, 'Female', 6.4, 10.4, 62.0, 73.5),
(34, 10, 'Male', 7.4, 11.3, 64.0, 75.0),
(35, 10, 'Female', 6.6, 10.8, 63.0, 74.5),
(36, 11, 'Male', 7.6, 11.7, 65.0, 76.0),
(37, 11, 'Female', 6.8, 11.1, 64.0, 75.5),
(38, 12, 'Male', 7.8, 12.0, 66.0, 77.0),
(39, 12, 'Female', 7.0, 11.5, 65.0, 77.0);

-- --------------------------------------------------------

--
-- Table structure for table `infantinfo`
--

CREATE TABLE `infantinfo` (
  `id` int(11) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `surname` varchar(25) NOT NULL,
  `dateofbirth` varchar(25) NOT NULL,
  `placeofbirth` varchar(25) NOT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `bloodtype` varchar(5) NOT NULL,
  `nationality` varchar(25) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `infantinfo`
--

INSERT INTO `infantinfo` (`id`, `firstname`, `middlename`, `surname`, `dateofbirth`, `placeofbirth`, `sex`, `weight`, `height`, `remarks`, `bloodtype`, `nationality`, `parent_id`) VALUES
(5, 'Justine', 'matias', 'Sarmiento', '2002-11-11', 'bibiclat', NULL, 6.5, 63, NULL, 'B-', 'Filipino', 2),
(6, 'angelo', 'M', 'magallanes', '2004-10-01', 'surigao', NULL, 2, 2, NULL, 'AB+', 'Filipino', 4),
(7, 'vanessa', 'a', 'bombio', '2002-11-23', 'manila', NULL, 11, 12, NULL, 'B+', 'Filipino', 2),
(8, 'jessy mae', 'angeles', 'Bombio', '2002-11-23', 'pampanga', NULL, 11, 23, NULL, 'AB-', 'American', 4),
(9, 'micheal', 'Rale', 'Suryaw', '2002-11-23', 'africa', NULL, 6.7, 66, NULL, 'A-', 'American', 2),
(10, 'roronoa', 'Dangalo', 'zoro', '2002-11-23', 'Cavite', NULL, 43, 21, NULL, 'B-', 'American', 5),
(11, 'angela', 'visconte', 'aguilar', '2002-11-23', 'rizal', NULL, 19, 20, NULL, 'B-', 'Filipino', 6),
(12, 'hayabusa', 'kagura', 'hanzo', '2009-12-25', 'rizal', NULL, 24, 23, NULL, 'AB+', 'Filipino', 6),
(13, 'zilong', 'kalabaw', 'aldouse', '2002-11-11', 'Cavite', NULL, 35, 34, NULL, 'B+', 'American', 7),
(14, 'Nike', 'Dagta', 'Sarmiento', '2002-11-23', 'Bibiclat', NULL, 11, 12, NULL, 'AB+', 'Filipino', 8),
(15, 'Justine ', 'Dagta', 'Sarmiento ', '2025-10-20', 'Bibiclat Aliaga Nueva Eci', NULL, 5, 5, NULL, 'O+', 'Filipino ', 9),
(16, 'Qw', 'Qw', 'Qwert', '2025-06-01', 'Cabanatuan City', NULL, 15, 40, NULL, 'A+', 'Filipino', 10),
(17, 'kang', 'kung', 'keng', '2002-11-23', 'sumacab', NULL, 23, 22, NULL, 'B-', 'Filipino', 11),
(18, 'addd', 'd', 'g', '2345-02-24', 'manila', NULL, 24, 52, NULL, 'B-', 'Filipino', 12),
(19, 'steven', 'argon', 'Sarmiento', '2000-01-23', 'New York, USA', NULL, 23, 23, NULL, 'AB-', 'Filipino', 7),
(20, 'Alpha', 'Mike', 'Froxtrot', '2025-10-15', 'Cabanatuan', NULL, 2, 2, NULL, 'A+', 'Filipino', 8),
(21, 'kiko', 'lase', 'lakam', '2025-03-21', 'New York, USA', NULL, 7.5, 67, NULL, 'A+', 'Filipino', 5),
(22, 'sun', 'los', 'Angeles', '2025-03-23', 'New York, USA', NULL, 2.6, 47, NULL, 'A+', 'Filipino', 8),
(23, 'new', 'yo', 'lage', '2025-02-12', 'New York, USA', 'Male', 2.6, 47, NULL, 'B+', 'American', 8);

-- --------------------------------------------------------

--
-- Table structure for table `infant_previous_records`
--

CREATE TABLE `infant_previous_records` (
  `id` int(11) NOT NULL,
  `infant_id` int(11) NOT NULL,
  `record_date` date DEFAULT curdate(),
  `previous_weight` decimal(5,2) DEFAULT NULL,
  `previous_height` decimal(5,2) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `growth_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `infant_previous_records`
--

INSERT INTO `infant_previous_records` (`id`, `infant_id`, `record_date`, `previous_weight`, `previous_height`, `remarks`, `growth_status`) VALUES
(1, 5, '2025-10-21', 22.20, 22.20, 'malnourish', NULL),
(2, 5, '2025-10-21', 11.00, 11.00, '', 'No reference data'),
(3, 5, '2025-10-21', 6.50, 63.00, '', 'No reference data'),
(4, 6, '2025-10-21', 42.00, 12.00, '', 'No reference data'),
(5, 9, '2025-10-21', 6.50, 63.00, '', 'No reference data'),
(6, 21, '2025-10-21', 7.00, 64.00, '', 'Normal Weight, Normal Height');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
  `id` int(11) NOT NULL,
  `plaintext` varchar(255) NOT NULL,
  `hashed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`id`, `plaintext`, `hashed`) VALUES
(1, 'asdfas', '$2y$10$gO3VQCJ.gOjihWzeqel.rOK4ktc3L1ON5LU5I00yJ4/pn.kdm/3Ai'),
(2, 'asdfas', '$2y$10$GVPHVVAoIGCk3WBddTOLrOmrQ6iQdPsm005TKBqUX/cEK7tWneW/S'),
(3, 'justine', '$2y$10$bFGaToEpYbH2dSyYI8PzQ.DbFrLtdBCRQzjGif4VtHccVkVQ.vRSe'),
(4, 'karl', '$2y$10$pnYbze/vplzQngsIQydQgeYdv.8jqMgxMbBMZo8Wpbr74gMdRd3W6'),
(5, 'karl', '$2y$10$HaRSVMmrQqBOJkQcrdRuv.BxrkVp9gnV9SBV8QfoIkop8ed.EP9ue'),
(6, 'raven', '$2y$10$pcdZ5ag.dfa8jPYKJGnmFeZBtCAp3P33FQUG/Rvkfolt62wCIoTaW'),
(7, 'noeliza ann angeles', '$2y$10$nCaKyTMVC5MG9kMThWESJuAh7ipbzKLWoi8YMQcvhPy//G8xwZZDu');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `attempt_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `email`, `ip_address`, `attempt_time`) VALUES
(1, 'sdf@gmail.com', '::1', '2025-04-19 22:26:59'),
(2, 'admin@example.com', '::1', '2025-04-19 22:28:00'),
(3, 'justine@gmail.com', '::1', '2025-04-19 22:28:54'),
(4, 'asdfas@gmail.com', '::1', '2025-04-21 15:02:10'),
(5, 'biancakes@gmail.com', '::1', '2025-04-24 13:30:18'),
(6, 'angelicacute@gmail.com', '::1', '2025-04-24 13:30:28'),
(7, 'baliw@gmail.com', '::1', '2025-04-24 13:30:45'),
(8, 'admin@gmail.com', '::1', '2025-05-06 21:26:55'),
(9, 'admin@gmail.com', '::1', '2025-05-06 21:27:02'),
(10, 'admin@gmail.com', '::1', '2025-05-06 21:27:15'),
(11, 'fffffffffffffffffffffff@gmail.com', '::1', '2025-10-11 15:47:19'),
(12, '2114141@gmail.com', '::1', '2025-10-11 15:49:01'),
(13, 'admin@gmail.com5', '::1', '2025-10-19 11:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `logs_del_edit`
--

CREATE TABLE `logs_del_edit` (
  `id` int(11) NOT NULL,
  `action` text NOT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs_del_edit`
--

INSERT INTO `logs_del_edit` (`id`, `action`, `user_ip`, `timestamp`) VALUES
(1, 'Updated infant record with ID 1', '::1', '2025-04-21 21:53:27'),
(2, 'Updated parent record with ID 3', '::1', '2025-04-24 14:53:50'),
(3, 'Updated infant record with ID 1', '::1', '2025-04-24 14:54:13'),
(4, 'Updated infant record with ID 1', '::1', '2025-04-24 14:58:37'),
(5, 'Updated infant record with ID 1', '::1', '2025-04-24 14:59:15'),
(6, 'Updated infant record with ID 1', '::1', '2025-04-24 15:06:06'),
(7, 'Updated infant record with ID 1', '::1', '2025-04-24 15:12:01'),
(8, 'Updated infant record with ID 1', '::1', '2025-04-24 15:12:46'),
(9, 'Updated parent record with ID 3', '::1', '2025-04-24 15:20:11'),
(10, 'Updated infant record with ID 1', '::1', '2025-04-24 15:20:28'),
(11, 'Deleted parent record with ID 3', '::1', '2025-04-24 15:33:43'),
(12, 'Updated parent record with ID 1', '::1', '2025-06-02 11:19:40'),
(13, 'Updated parent record with ID 1', '::1', '2025-06-02 11:21:00'),
(14, 'Updated parent record with ID 1', '::1', '2025-06-02 11:22:04'),
(15, 'SMS attempt to 09631982029: failed', '::1', '2025-10-15 14:11:58'),
(16, 'SMS attempt to +639631982029: failed', '::1', '2025-10-15 14:13:48'),
(17, 'Deleted infant record with ID 3', '::1', '2025-10-16 22:03:28'),
(18, 'Updated infant record with ID 10', '::1', '2025-10-18 00:29:39'),
(19, 'Deleted infant record with ID 4', '::1', '2025-10-18 02:03:38'),
(20, 'Updated parent record with ID 2', '::1', '2025-10-18 16:36:16'),
(21, 'Updated parent record with ID 1', '::1', '2025-10-18 21:42:32'),
(22, 'Updated infant record with ID 18', '::1', '2025-10-20 20:18:42'),
(23, 'Updated infant record with ID 9', '::1', '2025-10-21 23:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `baranggay` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `barangay` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `baranggay`, `created_at`, `updated_at`, `barangay`) VALUES
(1, 'Ruby', 'Catacutan', 'angelicacute@gmail.com', '09921435643', 'zone 2, Bibiclat, Aliaga, Nueva Ecijaz', NULL, '2025-04-24 05:26:52', '2025-10-18 13:42:32', NULL),
(2, 'Bianca', 'Umali', 'biancakes@gmail.com', '09524430383', 'zone 4, San Carlos, Aliaga, Nueva Ecija', NULL, '2025-04-24 05:29:42', '2025-10-18 08:36:16', NULL),
(4, 'liza', 'bombio', 'lizabombio@gmail.com', '09925094535', 'sto.rosario, aliaga nueva ecija', NULL, '2025-06-20 05:53:04', '2025-06-20 05:53:04', NULL),
(5, 'Raven', 'Zingapan', 'zingapanraven@gmail.com', '09925094535', 'zone 2, Bibiclat, Aliaga, Nueva Ecija', NULL, '2025-10-17 16:14:55', '2025-10-17 16:14:55', NULL),
(6, 'karl', 'untal', 'karluntal@gmail', '09695711178', 'Zone 3, San Esteban, Rizal Nueva Ecija', NULL, '2025-10-18 14:36:48', '2025-10-18 14:36:48', NULL),
(7, 'Gusion', 'kogmaw', 'gusionkogmaw@gmail.com', '09774759342', 'zone 2, Bibiclat, Aliaga, Nueva Ecija', NULL, '2025-10-18 15:01:59', '2025-10-18 15:01:59', NULL),
(8, 'Nyx', 'Sarmiento', 'nyxsarmiento@gmail.com', '09925094535', 'zone 2, Bibiclat, Aliaga, Nueva Ecija', NULL, '2025-10-19 10:36:38', '2025-10-19 10:36:38', NULL),
(9, 'Noeliza Ann', 'Bombio', 'noelizaannb@gmail.com', '09677506601', 'Bibiclat Aliaga Nueva Ecija', NULL, '2025-10-20 00:18:53', '2025-10-20 00:18:53', NULL),
(10, 'Prince Mert', 'Nicolas', 'prince@gmail.com', '09064462482', 'Rizal', NULL, '2025-10-20 08:23:47', '2025-10-20 08:23:47', NULL),
(11, 'king', 'kong', 'kingkong@gmail.com', '09925094535', 'zone 2, Bibiclat, Aliaga, Nueva Ecija', NULL, '2025-10-20 12:07:08', '2025-10-20 12:07:08', 'Bibiclat'),
(12, 'trala', 'lelo', 'tralalelo@gmail.com', '09925094535', 'asdfa', NULL, '2025-10-20 12:16:46', '2025-10-20 12:16:46', 'Betes');

-- --------------------------------------------------------

--
-- Table structure for table `sms_queue`
--

CREATE TABLE `sms_queue` (
  `id` int(11) NOT NULL,
  `vacc_id` int(11) NOT NULL,
  `infant_id` int(11) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `next_dose_date` date DEFAULT NULL,
  `schedule_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `barangay` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sms_queue`
--

INSERT INTO `sms_queue` (`id`, `vacc_id`, `infant_id`, `phone`, `next_dose_date`, `schedule_time`, `created_at`, `barangay`) VALUES
(57, 56, 6, '09925094535', '1111-11-11', '01:00:00', '2025-10-20 14:25:40', 'Bibiclat'),
(58, 58, 15, '09677506601', '2025-11-20', '08:00:00', '2025-10-20 14:25:40', 'Bibiclat'),
(59, 60, 17, '09925094535', '2025-11-20', '08:30:00', '2025-10-20 14:25:42', 'Bibiclat'),
(60, 57, 14, '09925094535', '2025-11-19', '08:30:00', '2025-10-20 14:25:43', 'Bibiclat'),
(61, 59, 16, '09064462482', '2025-11-20', '08:30:00', '2025-10-20 14:25:45', 'Bibiclat');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report_logs`
--

CREATE TABLE `tbl_report_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `run_type` enum('preview','csv','pdf') NOT NULL,
  `filters_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`filters_json`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_report_logs`
--

INSERT INTO `tbl_report_logs` (`id`, `user_id`, `run_type`, `filters_json`, `created_at`) VALUES
(1, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:32:10'),
(2, 1, 'preview', '{\"barangays\":[\"Betes\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:32:41'),
(3, 1, 'preview', '{\"barangays\":[\"Betes\"],\"date_from\":null,\"date_to\":null,\"status\":\"Completed\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:32:50'),
(4, 1, 'preview', '{\"barangays\":[\"Betes\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:33:03'),
(5, 1, 'preview', '{\"barangays\":[\"Betes\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:33:10'),
(6, 1, 'preview', '{\"barangays\":[\"Betes\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:33:11'),
(7, 1, 'preview', '{\"barangays\":[\"Betes\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:33:12'),
(8, 1, 'preview', '{\"barangays\":[\"Betes\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:33:12'),
(9, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:33:13'),
(10, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:33:16'),
(11, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"barangay\"}', '2025-10-20 12:33:48'),
(12, 1, 'preview', '{\"barangays\":[\"Bibiclat\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"barangay\"}', '2025-10-20 12:33:50'),
(13, 1, 'pdf', '{\"barangays\":[\"Bibiclat\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"barangay\"}', '2025-10-20 12:33:55'),
(14, 1, 'csv', '{\"barangays\":[\"Bibiclat\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"barangay\"}', '2025-10-20 12:34:44'),
(15, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:35:12'),
(16, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"Pending\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:35:16'),
(17, 1, 'preview', '{\"barangays\":[],\"date_from\":\"2025-09-20\",\"date_to\":null,\"status\":\"Pending\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:35:41'),
(18, 1, 'preview', '{\"barangays\":[],\"date_from\":\"2025-09-20\",\"date_to\":\"2025-10-20\",\"status\":\"Pending\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:35:48'),
(19, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:36:06'),
(20, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":\"BCG\",\"group_by\":\"none\"}', '2025-10-20 12:36:08'),
(21, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":\"Hepatitis B (HepB)\",\"group_by\":\"none\"}', '2025-10-20 12:36:22'),
(22, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":\"Pentavalent (1st dose)\",\"group_by\":\"none\"}', '2025-10-20 12:36:28'),
(23, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":\"Hepatitis B (HepB)\",\"group_by\":\"none\"}', '2025-10-20 12:36:32'),
(24, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 12:46:46'),
(25, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"vaccine\"}', '2025-10-20 12:47:06'),
(26, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"barangay\"}', '2025-10-20 12:47:10'),
(27, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"vaccine\"}', '2025-10-20 12:47:20'),
(28, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-20 14:37:48'),
(29, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:39:53'),
(30, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:40:08'),
(31, 1, 'preview', '{\"barangays\":[\"Bibiclat\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:40:17'),
(32, 1, 'preview', '{\"barangays\":[\"Betes\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:40:24'),
(33, 1, 'preview', '{\"barangays\":[\"Betes\"],\"date_from\":null,\"date_to\":null,\"status\":\"Pending\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:40:50'),
(34, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:40:54'),
(35, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"Pending\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:40:57'),
(36, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"Completed\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:41:04'),
(37, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:41:29'),
(38, 1, 'preview', '{\"barangays\":[\"Bibiclat\"],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:41:32'),
(39, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:41:41'),
(40, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":\"BCG\",\"group_by\":\"none\"}', '2025-10-21 09:41:57'),
(41, 1, 'csv', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":\"BCG\",\"group_by\":\"none\"}', '2025-10-21 09:42:11'),
(42, 1, 'pdf', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":\"BCG\",\"group_by\":\"none\"}', '2025-10-21 09:42:17'),
(43, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:42:43'),
(44, 1, 'csv', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:42:45'),
(45, 1, 'pdf', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:42:47'),
(46, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 09:47:13'),
(47, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 13:24:16'),
(48, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-21 15:28:45'),
(49, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-22 00:30:53'),
(50, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-22 01:26:07'),
(51, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-22 01:32:52'),
(52, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-22 01:32:55'),
(53, 1, 'preview', '{\"barangays\":[],\"date_from\":null,\"date_to\":null,\"status\":\"All\",\"vaccine\":null,\"group_by\":\"none\"}', '2025-10-22 01:59:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vaccination_details`
--

CREATE TABLE `tbl_vaccination_details` (
  `id` int(11) NOT NULL,
  `infant_id` int(11) NOT NULL,
  `vaccine_name` varchar(255) NOT NULL,
  `stage` varchar(20) NOT NULL,
  `status` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vaccination_details`
--

INSERT INTO `tbl_vaccination_details` (`id`, `infant_id`, `vaccine_name`, `stage`, `status`, `created_at`, `updated_at`) VALUES
(9, 6, 'Hepatitis B (HepB)', 'Birth', 'Pending', '2025-10-16 13:42:49', '2025-10-20 14:25:40'),
(10, 6, 'Pentavalent (1st dose)', '1½ mo', 'Pending', '2025-10-16 13:51:14', '2025-10-18 16:38:06'),
(16, 5, 'Pneumococcal Conjugate Vaccine (1st dose)', '1½ mo', 'Pending', '2025-10-16 14:06:54', '2025-10-18 10:59:29'),
(17, 5, 'Inactivated Polio Vaccine (1 dose)', '3½ mo', 'Pending', '2025-10-16 14:59:33', '2025-10-16 15:02:59'),
(18, 6, 'Oral Polio Vaccine (1st dose)', '1½ mo', 'Pending', '2025-10-16 15:05:28', '2025-10-17 18:22:33'),
(19, 6, 'Pentavalent (3rd dose)', '3½ mo', 'Pending', '2025-10-16 15:10:01', '2025-10-17 18:23:29'),
(22, 6, 'Pneumococcal Conjugate Vaccine (1st dose)', '1½ mo', 'Pending', '2025-10-17 18:22:42', '2025-10-17 18:22:42'),
(23, 5, 'Pneumococcal Conjugate Vaccine (3rd dose)', '3½ mo', 'Pending', '2025-10-17 18:22:52', '2025-10-17 18:24:58'),
(24, 5, 'Oral Polio Vaccine (2nd dose)', '2½ mo', 'Pending', '2025-10-17 18:25:24', '2025-10-18 08:36:54'),
(25, 5, 'Pentavalent (2nd dose)', '2½ mo', 'Pending', '2025-10-18 10:39:22', '2025-10-18 13:08:55'),
(26, 5, 'Hepatitis B (HepB)', 'Birth', 'Pending', '2025-10-18 11:13:26', '2025-10-18 11:22:26'),
(27, 5, 'Pentavalent (1st dose)', '1½ mo', 'Pending', '2025-10-18 11:45:03', '2025-10-18 13:08:51'),
(28, 8, 'Pentavalent (3rd dose)', '3½ mo', 'Pending', '2025-10-18 11:48:26', '2025-10-18 16:38:03'),
(29, 10, 'Pneumococcal Conjugate Vaccine (2nd dose)', '2½ mo', 'Pending', '2025-10-18 11:48:48', '2025-10-18 11:48:48'),
(30, 10, 'Measles, Mumps, Rubella (MMR 1st dose)', '9 mo', 'Pending', '2025-10-18 11:50:38', '2025-10-18 11:50:38'),
(31, 10, 'Pneumococcal Conjugate Vaccine (1st dose)', '1½ mo', 'Pending', '2025-10-18 11:50:56', '2025-10-18 11:50:56'),
(32, 10, 'Oral Polio Vaccine (3rd dose)', '3½ mo', 'Pending', '2025-10-18 11:51:22', '2025-10-18 16:37:56'),
(33, 9, 'Pentavalent (2nd dose)', '2½ mo', 'Pending', '2025-10-18 13:25:21', '2025-10-18 16:38:00'),
(34, 11, 'BCG', 'Birth', 'Pending', '2025-10-18 14:45:53', '2025-10-18 16:37:52'),
(35, 11, 'Pentavalent (1st dose)', '1½ mo', 'Pending', '2025-10-18 14:53:44', '2025-10-18 16:37:49'),
(36, 12, 'Pentavalent (1st dose)', '1½ mo', 'Pending', '2025-10-18 14:59:06', '2025-10-18 16:37:46'),
(37, 12, 'Pentavalent (2nd dose)', '2½ mo', 'Pending', '2025-10-18 15:00:30', '2025-10-18 16:37:43'),
(38, 13, 'Pentavalent (1st dose)', '1½ mo', 'Pending', '2025-10-18 15:03:31', '2025-10-18 16:37:40'),
(39, 14, 'BCG', 'Birth', 'Pending', '2025-10-19 10:50:07', '2025-10-20 14:25:43'),
(40, 15, 'Pentavalent (1st dose)', '1½ mo', 'Pending', '2025-10-20 00:40:47', '2025-10-20 14:25:40'),
(41, 16, 'Pentavalent (1st dose)', '1½ mo', 'Pending', '2025-10-20 08:30:24', '2025-10-20 14:25:45'),
(42, 17, 'Pentavalent (1st dose)', '1½ mo', 'Pending', '2025-10-20 12:09:45', '2025-10-20 14:25:42'),
(43, 18, 'Pentavalent (3rd dose)', '3½ mo', 'Completed', '2025-10-20 12:19:36', '2025-10-21 09:44:34'),
(44, 20, 'Pentavalent (1st dose)', '1½ mo', 'Completed', '2025-10-21 09:31:40', '2025-10-22 02:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vaccination_schedule`
--

CREATE TABLE `tbl_vaccination_schedule` (
  `vacc_id` int(11) NOT NULL,
  `infant_id` int(11) NOT NULL,
  `infant_name` varchar(100) DEFAULT NULL,
  `vaccine_name` varchar(100) NOT NULL,
  `stage` varchar(20) DEFAULT NULL,
  `date_vaccination` date NOT NULL,
  `next_dose_date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `status` enum('Pending','Completed') DEFAULT 'Pending',
  `remarks` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `barangay` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vaccination_schedule`
--

INSERT INTO `tbl_vaccination_schedule` (`vacc_id`, `infant_id`, `infant_name`, `vaccine_name`, `stage`, `date_vaccination`, `next_dose_date`, `time`, `status`, `remarks`, `date_created`, `barangay`) VALUES
(56, 6, NULL, 'Hepatitis B (HepB)', NULL, '1111-11-11', '1111-11-11', '01:00:00', 'Pending', '', '2025-10-18 16:59:18', 'Bibiclat'),
(57, 14, NULL, 'BCG', NULL, '2025-10-19', '2025-11-19', '08:30:00', 'Pending', '', '2025-10-19 10:50:07', 'Bibiclat'),
(58, 15, NULL, 'Pentavalent (1st dose)', NULL, '2025-10-20', '2025-11-20', '08:00:00', 'Pending', '', '2025-10-20 00:40:47', 'Bibiclat'),
(59, 16, NULL, 'Pentavalent (1st dose)', NULL, '2025-10-20', '2025-11-20', '08:30:00', 'Pending', '1st', '2025-10-20 08:30:24', 'Bibiclat'),
(60, 17, NULL, 'Pentavalent (1st dose)', NULL, '2025-10-20', '2025-11-20', '08:30:00', 'Pending', 'yes yow yeah', '2025-10-20 12:09:45', 'Bibiclat'),
(61, 18, NULL, 'Pentavalent (3rd dose)', NULL, '2025-10-20', '2025-11-20', '08:30:00', 'Completed', '', '2025-10-20 12:19:36', 'Betes'),
(62, 20, NULL, 'Pentavalent (1st dose)', NULL, '2025-10-21', '2025-11-21', '08:31:00', 'Completed', 'yes yow', '2025-10-21 09:31:40', 'Betes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vaccine_reference`
--

CREATE TABLE `tbl_vaccine_reference` (
  `id` int(11) NOT NULL,
  `vaccine_name` varchar(100) DEFAULT NULL,
  `disease_prevented` varchar(150) DEFAULT NULL,
  `age_stage` varchar(20) DEFAULT NULL,
  `at_birth` tinyint(1) DEFAULT 0,
  `one_half_month` tinyint(1) DEFAULT 0,
  `two_half_month` tinyint(1) DEFAULT 0,
  `three_half_month` tinyint(1) DEFAULT 0,
  `nine_month` tinyint(1) DEFAULT 0,
  `one_year` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vaccine_reference`
--

INSERT INTO `tbl_vaccine_reference` (`id`, `vaccine_name`, `disease_prevented`, `age_stage`, `at_birth`, `one_half_month`, `two_half_month`, `three_half_month`, `nine_month`, `one_year`) VALUES
(1, 'BCG', 'Tuberculosis', 'Birth', 0, 0, 0, 0, 0, 0),
(2, 'Hepatitis B (HepB)', 'Hepatitis B', 'Birth', 0, 0, 0, 0, 0, 0),
(3, 'Pentavalent (1st dose)', 'Diphtheria, Pertussis, Tetanus, Hepatitis B, Haemophilus influenzae type B', '1½ mo', 0, 0, 0, 0, 0, 0),
(4, 'Oral Polio Vaccine (1st dose)', 'Poliomyelitis', '1½ mo', 0, 0, 0, 0, 0, 0),
(5, 'Pneumococcal Conjugate Vaccine (1st dose)', 'Pneumonia, Meningitis, Otitis Media', '1½ mo', 0, 0, 0, 0, 0, 0),
(6, 'Pentavalent (2nd dose)', 'Diphtheria, Pertussis, Tetanus, Hepatitis B, Haemophilus influenzae type B', '2½ mo', 0, 0, 0, 0, 0, 0),
(7, 'Oral Polio Vaccine (2nd dose)', 'Poliomyelitis', '2½ mo', 0, 0, 0, 0, 0, 0),
(8, 'Pneumococcal Conjugate Vaccine (2nd dose)', 'Pneumonia, Meningitis, Otitis Media', '2½ mo', 0, 0, 0, 0, 0, 0),
(9, 'Pentavalent (3rd dose)', 'Diphtheria, Pertussis, Tetanus, Hepatitis B, Haemophilus influenzae type B', '3½ mo', 0, 0, 0, 0, 0, 0),
(10, 'Oral Polio Vaccine (3rd dose)', 'Poliomyelitis', '3½ mo', 0, 0, 0, 0, 0, 0),
(11, 'Inactivated Polio Vaccine (1 dose)', 'Poliomyelitis', '3½ mo', 0, 0, 0, 0, 0, 0),
(12, 'Pneumococcal Conjugate Vaccine (3rd dose)', 'Pneumonia, Meningitis, Otitis Media', '3½ mo', 0, 0, 0, 0, 0, 0),
(13, 'Measles, Mumps, Rubella (MMR 1st dose)', 'Measles, Mumps, Rubella', '9 mo', 0, 0, 0, 0, 0, 0),
(14, 'Measles, Mumps, Rubella (MMR 2nd dose)', 'Measles, Mumps, Rubella', '1 yr', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `usersname` int(255) NOT NULL,
  `role` enum('admin','healthworker','parent') NOT NULL DEFAULT 'parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `created_at`, `usersname`, `role`) VALUES
(1, 'admin@gmail.com', '$2y$10$Nvj2IJVcsZg/Ak54hQdzd.QdC5oEUpsZ3/QuxVROTNIcISCR/5PR2', 'Administrator', '2025-04-24', 0, 'admin'),
(2, 'healthworker@gmail.com', '$2y$10$k0N5uDn0pcBK6IkxJQtVfeQ2M1PVTXGqi5CHQejgIDPBmCjUxDgZu', 'Healthworker', '2025-04-24', 0, 'healthworker'),
(3, 'angelicacute@gmail.com', '$2y$10$.t41Y5PtxTl/r6AydOFa4OwNop9Zy91nB7CFW5MhApFimPcuhuX12', 'Angela Catacutan', '2025-04-24', 0, 'parent'),
(4, 'biancakes@gmail.com', '$2y$10$iC3JUZpGbDHmD28EHchW6uTYAf4FnJZ4dsT26Jn1ES2eGaAPZwO/S', 'Bianca Umali', '2025-04-24', 0, 'parent'),
(5, 'mariateressa@gmail.com', '$2y$10$A4mA6yacMxfbluuSypBug..KAirca9QNOVb6o/8ke/zJFnr5xjI/y', 'maria terresa', '2025-04-24', 0, 'parent'),
(6, 'zingapanraven@gmail.com', '$2y$10$FnP/LAAEHwTz83bk1EfmcOHjXvPmkCENsdwyU1fDrz4EsS.cuWsyK', 'Raven Zingapan', '2025-10-17', 0, 'parent'),
(7, 'karluntal@gmail', '$2y$10$8e0u6LMY6hK2X64i2G8TjubDsTzRmw3XbZz7UF1NRU0W4slb6xWoa', 'karl untal', '2025-10-18', 0, 'parent'),
(8, 'gusionkogmaw@gmail.com', '$2y$10$FAbJBBOo4ydHHfu8aCXmse8lj72XLV2BY0KDbW4eG/PzN.zZSG9g6', 'Gusion kogmaw', '2025-10-18', 0, 'parent'),
(9, 'nyxsarmiento@gmail.com', '$2y$10$XPSAoGwIO/LhVbmZxRTgyOu.R3ItfVL4E9qkk6VQxGUxXaRohNh/S', 'Nyx Sarmiento', '2025-10-19', 0, 'parent'),
(10, 'noelizaannb@gmail.com', '$2y$10$vhQDFTdXFxY7R6qXym0BZeyByKT7S1p3r.w2wTVqSvr/FQKsU7MfS', 'Noeliza Ann Bombio', '2025-10-20', 0, 'parent'),
(11, 'prince@gmail.com', '$2y$10$EA6pl6mbcl3/JlXHegIQmuDXsR9C3109lg7lJFLd.vSg6f1kgY03C', 'Prince Mert Nicolas', '2025-10-20', 0, 'parent'),
(12, 'kingkong@gmail.com', '$2y$10$SE30hGMMnUA0.SdqVG0rzO0Y9POxNkR/SXy1/J1mZgIOGURNFEEfO', 'king kong', '2025-10-20', 0, 'parent'),
(13, 'tralalelo@gmail.com', '$2y$10$IKIGkVRO.rPD.pouBnjPqOWKvMrqKidmFnbLaehu6EEckpygytXLO', 'trala lelo', '2025-10-20', 0, 'parent');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `success` tinyint(1) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `email`, `ip_address`, `success`, `reason`, `timestamp`) VALUES
(1, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-04-24 13:18:37'),
(2, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-04-24 13:21:00'),
(3, NULL, 'biancakes@gmail.com', '::1', 0, 'Incorrect password', '2025-04-24 13:30:18'),
(4, NULL, 'angelicacute@gmail.com', '::1', 0, 'Incorrect password', '2025-04-24 13:30:28'),
(5, NULL, 'baliw@gmail.com', '::1', 0, 'User not found', '2025-04-24 13:30:45'),
(6, 5, 'mariateressa@gmail.com', '::1', 1, 'Login successful', '2025-04-24 13:34:15'),
(7, 5, 'mariateressa@gmail.com', '::1', 1, 'Login successful', '2025-04-24 14:13:28'),
(8, 2, 'healthworker@gmail.com', '::1', 1, 'Login successful', '2025-04-24 14:48:28'),
(9, 2, 'healthworker@gmail.com', '::1', 1, 'Login successful', '2025-04-24 14:53:11'),
(10, 2, 'healthworker@gmail.com', '::1', 1, 'Login successful', '2025-04-24 15:19:27'),
(11, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-04-24 15:30:36'),
(12, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-04-24 15:32:34'),
(13, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-04-24 15:48:12'),
(14, 2, 'healthworker@gmail.com', '::1', 1, 'Login successful', '2025-04-24 15:51:21'),
(15, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-05-06 08:20:47'),
(16, NULL, 'admin@gmail.com', '::1', 0, 'Incorrect password', '2025-05-06 21:26:55'),
(17, NULL, 'admin@gmail.com', '::1', 0, 'Incorrect password', '2025-05-06 21:27:02'),
(18, NULL, 'admin@gmail.com', '::1', 0, 'Incorrect password', '2025-05-06 21:27:15'),
(19, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-05-06 21:27:53'),
(20, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-05-29 11:24:39'),
(21, 2, 'healthworker@gmail.com', '::1', 1, 'Login successful', '2025-05-29 11:25:19'),
(22, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-06-02 11:00:54'),
(23, 3, 'angelicacute@gmail.com', '::1', 1, 'Login successful', '2025-06-02 11:46:51'),
(24, 5, 'mariateressa@gmail.com', '::1', 1, 'Login successful', '2025-06-02 12:00:36'),
(25, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-06-06 09:52:09'),
(26, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-06-17 10:17:59'),
(27, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-06-20 13:15:40'),
(28, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-06-20 13:39:45'),
(29, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-07-14 14:06:32'),
(30, NULL, 'fffffffffffffffffffffff@gmail.com', '::1', 0, 'User not found', '2025-10-11 15:47:20'),
(31, NULL, '2114141@gmail.com', '::1', 0, 'User not found', '2025-10-11 15:49:01'),
(32, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-11 15:50:14'),
(33, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-15 13:46:50'),
(34, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-15 14:17:37'),
(35, 2, 'healthworker@gmail.com', '::1', 1, 'Login successful', '2025-10-15 14:17:46'),
(36, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-15 14:19:12'),
(37, 3, 'angelicacute@gmail.com', '::1', 1, 'Login successful', '2025-10-15 14:19:36'),
(38, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-15 14:23:41'),
(39, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-15 15:03:18'),
(40, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-15 20:55:54'),
(41, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-16 20:00:21'),
(42, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-17 11:26:56'),
(43, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-17 12:34:09'),
(44, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-17 21:02:28'),
(45, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-17 21:32:49'),
(46, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-17 21:37:04'),
(47, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-17 21:37:14'),
(48, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-17 21:45:18'),
(49, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-17 21:58:59'),
(50, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-17 23:09:16'),
(51, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-18 00:00:47'),
(52, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-18 00:13:37'),
(53, 6, 'zingapanraven@gmail.com', '::1', 1, 'Login successful', '2025-10-18 00:17:14'),
(54, 6, 'zingapanraven@gmail.com', '::1', 1, 'Login successful', '2025-10-18 00:18:57'),
(55, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-18 00:27:34'),
(56, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-18 20:22:30'),
(57, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-18 20:27:31'),
(58, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-18 20:29:15'),
(59, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-18 21:08:33'),
(60, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-18 21:09:03'),
(61, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-18 21:18:14'),
(62, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-18 21:20:31'),
(63, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-18 21:21:38'),
(64, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-18 21:21:56'),
(65, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-18 21:24:48'),
(66, 7, 'karluntal@gmail', '::1', 1, 'Login successful', '2025-10-18 22:38:00'),
(67, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-18 22:42:28'),
(68, 7, 'karluntal@gmail', '::1', 1, 'Login successful', '2025-10-18 23:10:18'),
(69, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-18 23:13:57'),
(70, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-18 23:51:52'),
(71, 7, 'karluntal@gmail', '::1', 1, 'Login successful', '2025-10-18 23:59:55'),
(72, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-19 00:13:16'),
(73, NULL, 'admin@gmail.com5', '::1', 0, 'User not found', '2025-10-19 11:16:15'),
(74, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-19 11:16:24'),
(75, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-19 11:43:22'),
(76, 4, 'biancakes@gmail.com', '::1', 1, 'Login successful', '2025-10-19 12:23:23'),
(77, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-19 12:24:23'),
(78, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-19 17:47:43'),
(79, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-19 18:31:56'),
(80, 9, 'nyxsarmiento@gmail.com', '::1', 1, 'Login successful', '2025-10-19 18:37:24'),
(81, 9, 'nyxsarmiento@gmail.com', '::1', 1, 'Login successful', '2025-10-19 18:44:14'),
(82, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-20 08:16:01'),
(83, 10, 'noelizaannb@gmail.com', '::1', 1, 'Login successful', '2025-10-20 08:19:18'),
(84, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-20 16:18:33'),
(85, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-20 16:21:20'),
(86, 11, 'prince@gmail.com', '::1', 1, 'Login successful', '2025-10-20 16:24:10'),
(87, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-20 18:22:36'),
(88, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-20 21:51:43'),
(89, 9, 'nyxsarmiento@gmail.com', '::1', 1, 'Login successful', '2025-10-20 21:52:14'),
(90, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-20 21:55:53'),
(91, 9, 'nyxsarmiento@gmail.com', '::1', 1, 'Login successful', '2025-10-20 22:05:24'),
(92, 9, 'nyxsarmiento@gmail.com', '::1', 1, 'Login successful', '2025-10-20 22:12:37'),
(93, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-20 22:15:26'),
(94, 9, 'nyxsarmiento@gmail.com', '::1', 1, 'Login successful', '2025-10-20 22:24:21'),
(95, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-20 22:24:50'),
(96, 9, 'nyxsarmiento@gmail.com', '::1', 1, 'Login successful', '2025-10-21 17:28:17'),
(97, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-21 17:28:43'),
(98, 9, 'nyxsarmiento@gmail.com', '::1', 1, 'Login successful', '2025-10-21 17:33:30'),
(99, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-21 21:24:07'),
(100, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-21 22:52:46'),
(101, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-22 08:00:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `growth_reference`
--
ALTER TABLE `growth_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infantinfo`
--
ALTER TABLE `infantinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_child_parent` (`parent_id`);

--
-- Indexes for table `infant_previous_records`
--
ALTER TABLE `infant_previous_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infant_id` (`infant_id`);

--
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs_del_edit`
--
ALTER TABLE `logs_del_edit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_queue`
--
ALTER TABLE `sms_queue`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_vacc` (`vacc_id`),
  ADD KEY `idx_infant` (`infant_id`);

--
-- Indexes for table `tbl_report_logs`
--
ALTER TABLE `tbl_report_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_report_logs_user_created` (`user_id`,`created_at`);

--
-- Indexes for table `tbl_vaccination_details`
--
ALTER TABLE `tbl_vaccination_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infant_id` (`infant_id`);

--
-- Indexes for table `tbl_vaccination_schedule`
--
ALTER TABLE `tbl_vaccination_schedule`
  ADD PRIMARY KEY (`vacc_id`),
  ADD KEY `infant_id` (`infant_id`);

--
-- Indexes for table `tbl_vaccine_reference`
--
ALTER TABLE `tbl_vaccine_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `growth_reference`
--
ALTER TABLE `growth_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `infantinfo`
--
ALTER TABLE `infantinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `infant_previous_records`
--
ALTER TABLE `infant_previous_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `logs_del_edit`
--
ALTER TABLE `logs_del_edit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sms_queue`
--
ALTER TABLE `sms_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_report_logs`
--
ALTER TABLE `tbl_report_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_vaccination_details`
--
ALTER TABLE `tbl_vaccination_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_vaccination_schedule`
--
ALTER TABLE `tbl_vaccination_schedule`
  MODIFY `vacc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_vaccine_reference`
--
ALTER TABLE `tbl_vaccine_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `infantinfo`
--
ALTER TABLE `infantinfo`
  ADD CONSTRAINT `fk_child_parent` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `infant_previous_records`
--
ALTER TABLE `infant_previous_records`
  ADD CONSTRAINT `infant_previous_records_ibfk_1` FOREIGN KEY (`infant_id`) REFERENCES `infantinfo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_report_logs`
--
ALTER TABLE `tbl_report_logs`
  ADD CONSTRAINT `fk_report_logs_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_vaccination_details`
--
ALTER TABLE `tbl_vaccination_details`
  ADD CONSTRAINT `tbl_vaccination_details_ibfk_1` FOREIGN KEY (`infant_id`) REFERENCES `infantinfo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_vaccination_schedule`
--
ALTER TABLE `tbl_vaccination_schedule`
  ADD CONSTRAINT `tbl_vaccination_schedule_ibfk_1` FOREIGN KEY (`infant_id`) REFERENCES `infantinfo` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
