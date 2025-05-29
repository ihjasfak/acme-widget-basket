-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 01:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acme_widget_basket`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_rules`
--

CREATE TABLE `delivery_rules` (
  `id` int(11) NOT NULL,
  `min_amount` decimal(10,2) DEFAULT NULL,
  `max_amount` decimal(10,2) DEFAULT NULL,
  `delivery_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_rules`
--

INSERT INTO `delivery_rules` (`id`, `min_amount`, `max_amount`, `delivery_cost`) VALUES
(1, 0.00, 49.99, 4.95),
(2, 50.00, 89.99, 2.95),
(3, 90.00, NULL, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `offer_type` enum('bogo','percentage','fixed','bulk_discount') DEFAULT NULL,
  `min_quantity` int(11) DEFAULT 1,
  `discount_type` varchar(255) NOT NULL DEFAULT 'percentage',
  `discount_value` decimal(5,2) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `product_id`, `offer_type`, `min_quantity`, `discount_type`, `discount_value`, `description`) VALUES
(1, 1, 'bogo', 1, 'percentage', 50.00, 'Buy one get one half price');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `price`) VALUES
(1, 'R01', 'Red Widget', 32.95),
(2, 'G01', 'Green Widget', 24.95),
(3, 'B01', 'Blue Widget', 7.95);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_rules`
--
ALTER TABLE `delivery_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_rules`
--
ALTER TABLE `delivery_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
