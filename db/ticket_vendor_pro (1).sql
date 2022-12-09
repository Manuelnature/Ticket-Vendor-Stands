-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 09, 2022 at 09:49 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticket_vendor_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `tickets` varchar(255) DEFAULT NULL,
  `organizer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vending_points` varchar(255) DEFAULT NULL,
  `event_date` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `name`, `tickets`, `organizer_id`, `user_id`, `vending_points`, `event_date`, `created_at`) VALUES
(1, 'Youtees', '[{\"type\":\"Vip\",\"price\":\"200\",\"quantity\":\"100\"},{\"type\":\"Regular\",\"price\":\"100\",\"quantity\":\"200\"}]', 1, 1, '[\"1\",\"2\",\"2\"]', '2022-11-02', '2022-11-19 02:07:03'),
(2, 'Rhythms', '[{\"type\":\"Vip\",\"price\":\"400\",\"quantity\":\"50\"},{\"type\":\"Regular\",\"price\":\"200\",\"quantity\":\"50\"}]', 1, 1, '[\"1\"]', '2022-12-08', '2022-11-21 09:21:03'),
(3, 'Ayiyii', '[{\"type\":\"Vip\",\"price\":\"300\",\"quantity\":\"50\"},{\"type\":\"Regular\",\"price\":\"150\",\"quantity\":\"100\"}]', 1, 1, NULL, '2022-12-11', '2022-11-22 09:27:00'),
(4, 'Rukya Events', '[{\"type\":\"Vip\",\"price\":\"200\",\"quantity\":\"15\"},{\"type\":\"Regular\",\"price\":\"150\",\"quantity\":\"10\"},{\"type\":\"Economy\",\"price\":\"100\",\"quantity\":\"5\"}]', 1, 1, NULL, '2023-01-08', '2022-11-30 12:40:39'),
(5, 'Hammat Events', '[{\"type\":\"Vip\",\"price\":\"500\",\"quantity\":\"10\"},{\"type\":\"Regular\",\"price\":\"200\",\"quantity\":\"10\"},{\"type\":\"Economy\",\"price\":\"100\",\"quantity\":\"15\"},{\"type\":\"\",\"price\":null,\"quantity\":null}]', 1, 1, '[\"2\"]', '2022-12-11', '2022-11-30 12:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organization`
--

CREATE TABLE `tbl_organization` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_organization`
--

INSERT INTO `tbl_organization` (`id`, `name`, `created_at`) VALUES
(1, 'Empire Records', '2022-11-16 17:45:07'),
(2, '1945 Clothing', '2022-11-17 09:30:55'),
(3, 'Utv For Life', '2022-11-17 09:31:20'),
(4, 'Image Bereau', '2022-11-17 10:34:51'),
(5, 'Rhythms', '2022-11-17 10:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `tickets` varchar(255) DEFAULT NULL,
  `total_amount` varchar(50) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `vending_point_id` int(11) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`id`, `event_id`, `tickets`, `total_amount`, `phone_number`, `email`, `vending_point_id`, `created_by`, `created_at`) VALUES
(1, 1, '[{\"type\":\"Vip\",\"price\":\"200\",\"quantity\":\"2\",\"amount\":400},{\"type\":\"Regular\",\"price\":\"100\",\"quantity\":\"3\",\"amount\":300}]', '700', NULL, NULL, 1, 'Kofi', '2022-11-19 02:31:07'),
(2, 1, '[{\"type\":\"Vip\",\"price\":\"200\",\"quantity\":\"2\",\"amount\":400}]', '400', NULL, NULL, 1, 'Kofi', '2022-11-21 12:49:35'),
(3, 2, '[{\"type\":\"Vip\",\"price\":\"400\",\"quantity\":\"2\",\"amount\":800},{\"type\":\"Regular\",\"price\":\"200\",\"quantity\":\"2\",\"amount\":400}]', '1200', NULL, NULL, 1, 'Kofi', '2022-11-21 22:35:52'),
(5, 1, '[{\"type\":\"Regular\",\"price\":\"200\",\"quantity\":null,\"amount\":0}]', '0', NULL, NULL, 1, 'Kofi', '2022-11-22 12:34:15'),
(6, 1, '[{\"type\":\"Vip\",\"price\":\"200\",\"quantity\":\"2\",\"amount\":400}]', '400', NULL, NULL, 1, 'Kofi', '2022-11-22 12:35:51'),
(7, 1, '[{\"type\":\"Regular\",\"price\":\"100\",\"quantity\":\"3\",\"amount\":300}]', '300', NULL, NULL, 1, 'Kofi', '2022-11-23 15:21:56'),
(8, 1, '[{\"type\":\"Vip\",\"price\":\"200\",\"quantity\":\"500\",\"amount\":100000}]', '100000', NULL, NULL, 1, 'Kofi', '2022-11-23 21:30:45'),
(9, 1, '[{\"type\":\"Regular\",\"price\":\"100\",\"quantity\":\"10\",\"amount\":1000}]', '1000', NULL, NULL, 1, 'Kofi', '2022-11-23 21:47:58'),
(10, 1, '[{\"type\":\"Regular\",\"price\":\"100\",\"quantity\":\"15\",\"amount\":1500}]', '1500', NULL, NULL, 1, 'Kofi', '2022-11-23 22:12:16'),
(11, 1, '[{\"type\":\"Regular\",\"price\":\"100\",\"quantity\":\"52\",\"amount\":5200}]', '5200', NULL, NULL, 1, 'Kofi', '2022-11-23 22:25:56'),
(12, 1, '[{\"type\":\"Regular\",\"price\":\"100\",\"quantity\":\"2\",\"amount\":200}]', '200', NULL, NULL, 1, 'Kofi', '2022-11-23 22:29:08'),
(13, 1, '[{\"type\":\"Vip\",\"price\":\"200\",\"quantity\":\"3\",\"amount\":600}]', '600', NULL, NULL, 1, 'Kofi', '2022-11-23 23:33:24'),
(14, 1, '[{\"type\":\"Regular\",\"price\":\"100\",\"quantity\":\"5\",\"amount\":500}]', '500', NULL, NULL, 1, 'Kofi', '2022-11-23 23:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `organizer_id` int(11) DEFAULT NULL,
  `vending_point_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `contact`, `role`, `organizer_id`, `vending_point_id`, `created_at`) VALUES
(1, 'Manuel', '$2y$10$rYle3OGBbF.siweEu59IueucWWES.Ve.D26q2brUsEBbTen6K9aHi', '024512451', 'Organizer', 1, NULL, '2022-11-17 10:19:22'),
(2, 'Kofi', '$2y$10$VjqJeTF6kBMWL0/mPNe65.91u7Uzzg550LAmXf21w9xRJa7HJh8Me', '0245123254', 'Vendor', NULL, 1, '2022-11-17 14:36:49'),
(3, 'Agudey', '$2y$10$QEWVuwdgwzv9o6sCGNMp5OxM3q34T5qyFXnYyGtukbzvTZQ94tp2e', '12345', 'Admin', NULL, NULL, '2022-12-05 21:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vending_point`
--

CREATE TABLE `tbl_vending_point` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vending_point`
--

INSERT INTO `tbl_vending_point` (`id`, `name`, `location`, `created_at`) VALUES
(1, 'Nalem', 'Accra Mall', '2022-11-16 16:32:10'),
(2, 'Batsonaa Total', 'Batsonaa', '2022-11-17 09:29:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_EventOrg` (`organizer_id`),
  ADD KEY `FK_EventUser` (`user_id`);

--
-- Indexes for table `tbl_organization`
--
ALTER TABLE `tbl_organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_saleEvent` (`event_id`),
  ADD KEY `FK_SalesVend` (`vending_point_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_UserVen` (`vending_point_id`),
  ADD KEY `FK_UserOrg` (`organizer_id`);

--
-- Indexes for table `tbl_vending_point`
--
ALTER TABLE `tbl_vending_point`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_organization`
--
ALTER TABLE `tbl_organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_vending_point`
--
ALTER TABLE `tbl_vending_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD CONSTRAINT `FK_EventOrg` FOREIGN KEY (`organizer_id`) REFERENCES `tbl_organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EventUser` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD CONSTRAINT `FK_SalesVend` FOREIGN KEY (`vending_point_id`) REFERENCES `tbl_vending_point` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_saleEvent` FOREIGN KEY (`event_id`) REFERENCES `tbl_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `FK_UserOrg` FOREIGN KEY (`organizer_id`) REFERENCES `tbl_organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UserVen` FOREIGN KEY (`vending_point_id`) REFERENCES `tbl_vending_point` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
