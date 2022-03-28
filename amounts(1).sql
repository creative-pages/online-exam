-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 06:44 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `users` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `users`, `email`, `password`, `created_on`, `updated_on`) VALUES
(1, 'admin22', 'admin22@gmail.com', 'admin2022', '2022-03-16 18:38:45', '2022-03-16 18:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amounts` int(11) NOT NULL,
  `borrow` float DEFAULT NULL,
  `lend` float NOT NULL,
  `description` text DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `type`, `amounts`, `borrow`, `lend`, `description`, `created_on`, `updated_on`) VALUES
(21, 202219, 'lend', 0, 0, 22000, '', '2022-03-28 04:40:24', '2022-03-28 04:40:24'),
(22, 202219, 'borrow', 0, 50000, 0, '', '2022-03-28 04:41:35', '2022-03-28 04:41:35'),
(23, 202219, 'payments', 6880, 0, 0, 'payment', '2022-03-28 04:42:35', '2022-03-28 04:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(32) NOT NULL,
  `contack` varchar(11) NOT NULL,
  `per` float NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contack`, `per`, `password`, `created_on`, `updated_on`) VALUES
(202219, 'test', 'test@gmail.com', '01711111111', 20, 'abcde123', '2022-03-28 04:30:50', '2022-03-28 04:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_status`
--

CREATE TABLE `weekly_status` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payout` varchar(32) NOT NULL,
  `up_amounts` float NOT NULL,
  `user_amounts` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=pending and 1 = confirm',
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weekly_status`
--

INSERT INTO `weekly_status` (`id`, `user_id`, `payout`, `up_amounts`, `user_amounts`, `status`, `created_on`, `updated_on`) VALUES
(46, 202219, '2022-03-28', 500, 28880, 0, '2022-03-28 04:39:43', '2022-03-28 04:39:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekly_status`
--
ALTER TABLE `weekly_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202220;

--
-- AUTO_INCREMENT for table `weekly_status`
--
ALTER TABLE `weekly_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
