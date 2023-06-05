-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 08:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuser`
--

CREATE TABLE `cuser` (
  `id` int(3) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cuser`
--

INSERT INTO `cuser` (`id`, `Username`, `Password`) VALUES
(1, 'Jade', 'Jabagat'),
(2, 'Soul', 'Shiro');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `STATUS` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `quantity`, `total_cost`, `STATUS`, `created_at`, `payment_method`) VALUES
(1, 1, 'Jade', 20, '130000.00', 'Approved', '2023-05-10 07:17:32', ''),
(2, 1, 'Soul', 300, '1950000.00', 'Approved', '2023-05-10 07:54:18', ''),
(3, 1, 'Jade', 50, '325000.00', 'Approved', '2023-05-10 07:58:29', ''),
(4, 1, 'Jade', 100, '650000.00', 'Approved', '2023-05-10 08:00:09', ''),
(5, 1, 'Jade', 200, '1300000.00', 'Approved', '2023-05-10 08:03:29', ''),
(6, 1, 'Jade', 50, '325000.00', 'Approved', '2023-05-10 08:07:55', ''),
(7, 3, 'Jade', 250, '5000000.00', 'Approved', '2023-05-11 00:49:41', ''),
(8, 1, 'Jade', 20, '130000.00', 'Approved', '2023-05-11 00:55:24', ''),
(9, 2, 'Soul', 2, '7000.00', 'pending', '2023-06-05 04:45:24', ''),
(10, 4, 'Soul', 5, '12500.00', 'pending', '2023-06-05 04:49:35', 'cod');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(3) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sales` int(50) NOT NULL,
  `stock` int(50) NOT NULL,
  `price` int(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `sales`, `stock`, `price`, `image`) VALUES
(1, 'Lerond Pro Baseline Leather Sneakers', 120, 80, 6500, 'Lerond Pro Baseline Leather Sneakers.jpeg'),
(2, 'LT Court 125 Leather Sneakers', 122, 578, 3500, 'LT Court 125 Leather Sneakers.jpeg'),
(3, 'Graduate Pro Leather Sneakers', 500, 120, 20000, 'Graduate Pro Leather Sneakers.jpeg'),
(4, 'Gripshot Leather and Synthetic Sneakers', 5, 95, 2500, 'Gripshot Leather and Synthetic Sneakers.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `Username`, `Password`) VALUES
(1, 'Jade', 'Angco');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuser`
--
ALTER TABLE `cuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuser`
--
ALTER TABLE `cuser`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
