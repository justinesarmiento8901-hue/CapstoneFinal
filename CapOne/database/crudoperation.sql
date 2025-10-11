-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2025 at 12:16 PM
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
-- Table structure for table `infantinfo`
--

CREATE TABLE `infantinfo` (
  `id` int(11) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `surname` varchar(25) NOT NULL,
  `dateofbirth` varchar(25) NOT NULL,
  `placeofbirth` varchar(25) NOT NULL,
  `sex` char(1) NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `bloodtype` varchar(5) NOT NULL,
  `nationality` varchar(25) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `infantinfo`
--

INSERT INTO `infantinfo` (`id`, `firstname`, `middlename`, `surname`, `dateofbirth`, `placeofbirth`, `sex`, `weight`, `height`, `bloodtype`, `nationality`, `parent_id`) VALUES
(3, 'joan', 'matias', 'zoro', '2025-01-01', 'aliaga', 'M', 5, 40, 'AB+', 'Filipino', 1);

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
(12, '2114141@gmail.com', '::1', '2025-10-11 15:49:01');

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
(14, 'Updated parent record with ID 1', '::1', '2025-06-02 11:22:04');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Ruby', 'Catacutan', 'angelicacute@gmail.com', '09921435643', 'zone 2, Bibiclat, Aliaga, Nueva Ecija', '2025-04-24 05:26:52', '2025-06-02 03:19:40'),
(2, 'Bianca', 'Umali', 'biancakes@gmail.com', '09923245453', 'zone 4, San Carlos, Aliaga, Nueva Ecija', '2025-04-24 05:29:42', '2025-04-24 05:29:42'),
(4, 'liza', 'bombio', 'lizabombio@gmail.com', '09925094535', 'sto.rosario, aliaga nueva ecija', '2025-06-20 05:53:04', '2025-06-20 05:53:04');

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
(5, 'mariateressa@gmail.com', '$2y$10$A4mA6yacMxfbluuSypBug..KAirca9QNOVb6o/8ke/zJFnr5xjI/y', 'maria terresa', '2025-04-24', 0, 'parent');

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
(32, 1, 'admin@gmail.com', '::1', 1, 'Login successful', '2025-10-11 15:50:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `infantinfo`
--
ALTER TABLE `infantinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_child_parent` (`parent_id`);

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
-- AUTO_INCREMENT for table `infantinfo`
--
ALTER TABLE `infantinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `logs_del_edit`
--
ALTER TABLE `logs_del_edit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `infantinfo`
--
ALTER TABLE `infantinfo`
  ADD CONSTRAINT `fk_child_parent` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
