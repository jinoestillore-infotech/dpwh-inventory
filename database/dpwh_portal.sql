-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 16, 2026 at 06:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dpwh_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `device_issued` enum('PC','Laptop','Printer','Mobile','Others') NOT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `serial_number` varchar(100) NOT NULL,
  `date_purchased` date DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `status` enum('Assigned','Repair','Returned') DEFAULT 'Assigned',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `first_name`, `last_name`, `device_issued`, `manufacturer`, `model`, `serial_number`, `date_purchased`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Juan', 'Dela Cruz', 'Laptop', 'Dell', 'Latitude 5420', 'SN-123456', '2024-05-10', 65000.00, 'Assigned', '2026-03-09 08:03:13', '2026-03-10 02:12:40'),
(3, 'Jino', 'Estillore', 'Laptop', 'DELL', 'DELL ASPIRON', '1230984567X', '2026-03-08', 30000.00, 'Repair', '2026-03-10 00:02:10', '2026-03-16 04:37:40'),
(4, 'Levin', 'Torregosa', 'Others', 'X21', 'JABRA1', '12334241WXE', '2026-03-06', 20000.00, 'Assigned', '2026-03-10 00:05:10', '2026-03-10 00:05:10'),
(6, 'Levin', 'Lloyd', 'Laptop', 'DELL', 'JABRA1', '12334241WXEE', '2026-03-03', 20000.00, 'Returned', '2026-03-10 02:01:16', '2026-03-10 02:23:57'),
(7, 'Jino', 'Estillore', 'Mobile', 'SAMSUNG', 'SAMSUNG SERIES', '23423WWWQ', '2026-03-06', 30000.00, 'Repair', '2026-03-10 02:17:40', '2026-03-10 02:26:12'),
(8, 'John', 'Lloyd', 'Laptop', 'ASUS', 'ASUS Inspire 5', '32523WQHHH', '2026-03-01', 50000.00, 'Assigned', '2026-03-10 02:26:58', '2026-03-10 02:26:58'),
(9, 'Joes', 'Doe', 'Mobile', 'SAMSUNG', 'SAMSUNG 7', '343434343EEE', '2026-02-11', 12000.00, 'Repair', '2026-03-10 02:29:13', '2026-03-10 03:11:37'),
(10, 'Jinos', 'Estillore', 'Printer', 'ACER', 'ACER', '23874WWUIQ', '2026-03-06', 50000.00, 'Assigned', '2026-03-10 03:11:16', '2026-03-16 03:34:01'),
(11, 'Joni', 'Estillore', 'Mobile', 'ACER', 'ACER X20', '09KKAWUUXX', '2026-02-04', 50000.00, 'Returned', '2026-03-16 04:36:50', '2026-03-16 04:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`id`, `action`, `description`, `user_name`, `created_at`) VALUES
(1, 'PERMISSION_UPDATE', 'Updated permissions for user \'Jino Estillore\': Permission — Delete Asset Activated', 'Jino', '2026-03-16 05:09:39'),
(2, 'PERMISSION_UPDATE', 'Updated permissions for user \'Jino Estillore\': Permission — Edit Asset Deactivated, Permission — Delete Asset Deactivated', 'Jino', '2026-03-16 05:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','moderator','normal') DEFAULT 'normal',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `can_add_asset` tinyint(1) DEFAULT 0,
  `can_edit_asset` tinyint(1) DEFAULT 0,
  `can_delete_asset` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `can_add_asset`, `can_edit_asset`, `can_delete_asset`) VALUES
(1, 'Jino', '$2y$10$NyRqS1a6X2JjBV2dNgzBG.U6hOel5xRogSRzMFHuMi.CB/fdC68Sa', 'admin', '2026-03-09 07:07:33', 1, 1, 1),
(2, 'Jino Estillore', '$2y$10$QC0LuyCrfn1Q1pXqY3E/zOct07Sflrtz10QcJRudXv6gbHM8nfh0u', 'normal', '2026-03-09 07:24:12', 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
