-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2025 at 06:31 AM
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
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `phone`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bang Diri', '08123456789', 'Jl. yang pernah ada', '2025-06-24 04:30:38', NULL, NULL),
(2, 'Muklis', '08645645645', 'Jl. Prikitiw no 19', '2025-06-24 04:31:10', NULL, NULL),
(3, 'Mutia', '0866669999', 'Jl. jalan mulu ngeluarin duid lagi', '2025-06-24 04:32:13', NULL, NULL),
(4, 'Diera', '0855566677', 'Sepanjang Jl. Kenangan no. 74', '2025-06-26 03:22:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `level_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', '2025-06-18 01:03:31', NULL, NULL),
(2, 'Operator', '2025-06-19 01:43:13', NULL, NULL),
(3, 'Pimpinan', '2025-06-19 01:45:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trans_laundry_pickups`
--

CREATE TABLE `trans_laundry_pickups` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `pickup_date` datetime NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_laundry_pickups`
--

INSERT INTO `trans_laundry_pickups` (`id`, `id_order`, `id_customer`, `pickup_date`, `notes`, `created_at`, `updated_at`) VALUES
(2, 7, 1, '2025-06-26 04:40:15', '', '2025-06-26 02:40:15', NULL),
(3, 10, 2, '2025-06-26 05:21:46', '', '2025-06-26 03:21:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trans_orders`
--

CREATE TABLE `trans_orders` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `order_end_date` date NOT NULL,
  `order_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `order_pay` int(11) NOT NULL,
  `order_change` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_orders`
--

INSERT INTO `trans_orders` (`id`, `id_customer`, `order_code`, `order_date`, `order_end_date`, `order_status`, `created_at`, `updated_at`, `deleted_at`, `order_pay`, `order_change`, `total`) VALUES
(7, 1, 'TRS1', '2025-06-26', '2025-06-30', 1, '2025-06-26 02:38:26', '2025-06-26 02:40:15', NULL, 50000, 19000, 31000),
(8, 2, 'TRS8', '2025-06-26', '2025-06-28', 0, '2025-06-26 02:39:45', '2025-06-26 02:39:45', NULL, 0, 0, 29000),
(9, 3, 'TRS9', '2025-06-26', '2025-06-29', 0, '2025-06-26 02:40:05', '2025-06-26 02:40:05', NULL, 0, 0, 30000),
(10, 2, 'TRS10', '2025-06-26', '2025-07-02', 1, '2025-06-26 03:21:21', '2025-06-26 03:21:46', NULL, 30000, 9000, 21000);

-- --------------------------------------------------------

--
-- Table structure for table `trans_order_details`
--

CREATE TABLE `trans_order_details` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_order_details`
--

INSERT INTO `trans_order_details` (`id`, `id_order`, `id_service`, `qty`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES
(8, 7, 3, 1000, 15000.00, '', '2025-06-26 02:38:26', NULL),
(9, 7, 2, 2000, 16000.00, '', '2025-06-26 02:38:26', NULL),
(10, 8, 1, 1000, 5000.00, '', '2025-06-26 02:39:45', NULL),
(11, 8, 2, 3000, 24000.00, '', '2025-06-26 02:39:45', NULL),
(12, 9, 3, 2000, 30000.00, '', '2025-06-26 02:40:05', NULL),
(13, 10, 4, 3000, 21000.00, '', '2025-06-26 03:21:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_of_services`
--

CREATE TABLE `type_of_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_of_services`
--

INSERT INTO `type_of_services` (`id`, `service_name`, `price`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Wash', 4500, 'Nyuci Baju', '2025-06-24 03:48:34', '2025-06-26 03:20:48', NULL),
(2, 'Ironing', 5000, 'Gosok baju, mahalan dikit karna lama', '2025-06-24 04:28:57', '2025-06-26 03:20:20', NULL),
(3, 'Wash and Ironing', 7000, 'Nyuci ma gosok baju', '2025-06-24 04:29:25', '2025-06-26 03:20:38', NULL),
(4, 'Bigger Laundry', 7000, 'buat bersihin selimut, karpet, mantel dan sprei my love bau kamu', '2025-06-26 03:20:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_level`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(5, 1, 'Ananda NL', 'admin@gmail.com', '93ba1608fc10b710894fb9f8c89724c6eeb44d11', '2025-06-26 02:47:58', NULL),
(6, 2, 'Dinda', 'op@gmail.com', '6dbb12e070f4734037e2fc054a0d47d3ebb14477', '2025-06-26 02:48:16', NULL),
(7, 3, 'Nopal', 'lead@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2025-06-26 02:48:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_laundry_pickups`
--
ALTER TABLE `trans_laundry_pickups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_orders`
--
ALTER TABLE `trans_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_order_details`
--
ALTER TABLE `trans_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_services`
--
ALTER TABLE `type_of_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trans_laundry_pickups`
--
ALTER TABLE `trans_laundry_pickups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trans_orders`
--
ALTER TABLE `trans_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trans_order_details`
--
ALTER TABLE `trans_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `type_of_services`
--
ALTER TABLE `type_of_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
