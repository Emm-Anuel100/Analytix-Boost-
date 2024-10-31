-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 06:06 PM
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
-- Database: `main_pos_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `user_email`, `name`, `image`, `status`, `timestamp`) VALUES
(1, 'emmanuelodel75@gmail.com', 'amazon', 'img_66f48617bbcc87.00493448.png', 'active', '2024-09-25 21:52:23'),
(2, 'emmanuelodel75@gmail.com', 'lenovo', 'img_66f486c6e13114.49354735.png', 'active', '2024-09-25 21:55:18'),
(3, 'emmanuelodel75@gmail.com', 'lenovo', 'img_66f486cb6b5d93.22051768.png', 'active', '2024-09-25 21:55:23'),
(4, 'emmanuelodel75@gmail.com', 'lenovo', 'img_66f486cfac1148.32926314.png', 'active', '2024-09-25 21:55:27'),
(5, 'emmanuelodel75@gmail.com', 'excgvbhnm', 'img_66f4893f7b14d2.78545823.png', 'inactive', '2024-09-25 22:05:51'),
(6, 'emmanuelodel75@gmail.com', 'lenovcfvgbhn', 'img_66f4896fd5c4a8.09072229.png', 'inactive', '2024-09-25 22:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `user_email` varchar(100) NOT NULL COMMENT 'user''s email',
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_email`, `name`, `slug`, `status`, `timestamp`) VALUES
(2, 'emmanuelodel75@gmail.com', 'Emmanuel', '45678', 'active', '2024-09-25 17:50:11'),
(3, 'emmanuelodel75@gmail.com', 'Brenda', '44', 'inactive', '2024-09-25 20:49:26'),
(4, 'emmanuelodel75@gmail.com', 'emma', 'reftgyh', 'active', '2024-09-25 20:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `expired_products`
--

CREATE TABLE `expired_products` (
  `id` int(255) NOT NULL,
  `email` varchar(100) NOT NULL COMMENT 'user''s email',
  `product_name` varchar(100) NOT NULL,
  `product_id` int(255) NOT NULL,
  `store` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `manufactured_date` varchar(100) NOT NULL,
  `expiry_date` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='expired products list';

--
-- Dumping data for table `expired_products`
--

INSERT INTO `expired_products` (`id`, `email`, `product_name`, `product_id`, `store`, `image`, `sku`, `manufactured_date`, `expiry_date`, `timestamp`) VALUES
(23, 'emmanuelodel75@gmail.com', 'watch', 8, 'ggggg', 'img_66f3e944575e23.06930400.png', '3e4rf5g6h', '03-10-2024', '25-10-2024', '2024-10-19 15:20:39'),
(24, 'emmanuelodel75@gmail.com', 'Banana', 11, 'ade', 'img_671397f1593798.18310246.png', '74yryr', '20-10-2024', '01-11-2024', '2024-10-19 15:20:39'),
(25, 'emmanuelodel75@gmail.com', 'Burger', 12, 'gracia', 'img_6713c69fb0a0b4.63247596.png', '3e4rf5g6h', '19-10-2024', '26-10-2024', '2024-10-19 15:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL COMMENT 'user''s email',
  `store` varchar(255) DEFAULT NULL,
  `warehouse` varchar(50) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `selling_type` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `barcode_symbology` varchar(255) DEFAULT NULL,
  `product_barcode` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(50) DEFAULT NULL,
  `price` int(50) DEFAULT NULL,
  `tax_value` int(50) DEFAULT NULL,
  `discount_type` varchar(255) DEFAULT NULL,
  `discount_value` int(50) DEFAULT NULL,
  `manufactured_date` varchar(50) DEFAULT NULL,
  `expiry_on` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `email`, `store`, `warehouse`, `sku`, `product_name`, `slug`, `category`, `selling_type`, `brand`, `unit`, `barcode_symbology`, `product_barcode`, `description`, `quantity`, `price`, `tax_value`, `discount_type`, `discount_value`, `manufactured_date`, `expiry_on`, `image`, `created_at`) VALUES
(8, 'emmanuelodel75@gmail.com', 'ggggg', 'Emmanuel Brendan', '3e4rf5g6h', 'watch', '45678', 'Electronics', 'Transactional selling', 'Nike', 'Pc', 'Code34', '3sd4f5gyuh', 'dftyunmi', 4567, 4567, 50, 'Percentage', 30, '03-10-2024', '25-10-2024', 'img_66f3e944575e23.06930400.png', '2024-09-25 10:43:16'),
(10, 'emmanuelodel75@gmail.com', 'gracia', 'Sincere', 'hed', 'headset', 'h35', 'emma', 'Up-Selling', 'amazon', 'sdrf', 'EAN-13', 'sedrftvbnm', 'yfufuhfyguhuhih', 2344, 45000, 0, 'Cash', 200, '27-09-2024', '16-01-2025', 'img_66f5708ed736e3.58629982.png', '2024-09-26 14:32:46'),
(11, 'emmanuelodel75@gmail.com', 'ade', 'Emmanuel Brendan', '74yryr', 'Banana', 'reftgyh', 'Emmanuel', 'Transactional selling', 'amazon', 'kg', 'EAN-13', '3sd4f5gyuhe', 'banana', 2143, 21, 21, 'Cash', 22, '20-10-2024', '01-11-2024', 'img_671397f1593798.18310246.png', '2024-10-19 11:28:49'),
(12, 'emmanuelodel75@gmail.com', 'gracia', 'Emmanuel Brendan', '3e4rf5g6h', 'Burger', 'watch', 'Emmanuel', 'Transactional selling', 'amazon', 'kg', 'Code 128', '456y8yhgra', 'eeee', 621, 33, 33, 'Cash', 30, '19-10-2024', '26-10-2024', 'img_6713c69fb0a0b4.63247596.png', '2024-10-19 14:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(25) NOT NULL,
  `user_email` varchar(100) NOT NULL COMMENT 'User''s email',
  `customer` varchar(50) NOT NULL,
  `products` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `payment_by` varchar(50) NOT NULL,
  `amount_paid` varchar(100) NOT NULL,
  `amount_due` varchar(100) NOT NULL,
  `change_element` varchar(100) NOT NULL,
  `grand_total` double NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_email`, `customer`, `products`, `date`, `status`, `reference`, `payment_by`, `amount_paid`, `amount_due`, `change_element`, `grand_total`, `timestamp`) VALUES
(23, 'emmanuelodel75@gmail.com', 'Walk-in-customer', 'watch (quantity: 2, price: 4567, image: img_66f3e944575e23.06930400.png, discount type: Percentage, discount value: 30, tax: 50, unit: Pc, total cost: 9134); Banana (quantity: 1, price: 21, image: img_671397f1593798.18310246.png, discount type: Cash, discount value: 22, tax: 21, unit: kg, total cost: 20)', '26-10-2024', 'Completed', 'MqQkWeIVC7', 'Transfer', '1300', '0', '0', 6513.8, '2024-10-26 11:42:12'),
(25, 'emmanuelodel75@gmail.com', 'Walk-in-customer', 'watch (quantity: 1, price: 4567, image: img_66f3e944575e23.06930400.png, discount type: Percentage, discount value: 30, tax: 50, unit: Pc, total cost: 4567)', '26-10-2024', 'Completed', '4IplRv1pc9', 'Cash', '6500', '200', '2', 3246.9, '2024-10-26 12:55:23'),
(27, 'emmanuelodel75@gmail.com', 'Walk-in-customer', 'watch (quantity: 2, price: 4567.00, image: img_66f3e944575e23.06930400.png, discount type: Percentage, discount value: 30.00, tax: 50.00, unit: Pc, total cost: 6493.80)', '27-10-2024', 'Completed', 'kMfVppHWvN', 'Transfer', '6500', '0', '100', 6493.8, '2024-10-27 12:30:09'),
(28, 'emmanuelodel75@gmail.com', 'Walk-in-customer', 'watch (quantity: 2, price: 4567.00, image: img_66f3e944575e23.06930400.png, discount type: Percentage, discount value: 30.00, tax: 50.00, unit: Pc, total cost: 6493.80)', '27-10-2024', 'Completed', 'QHWAVWp5ad', 'Transfer', '6500', '0', '100', 6493.8, '2024-10-27 12:31:16'),
(29, 'emmanuelodel75@gmail.com', 'Walk-in-customer', 'watch (quantity: 2, price: 4567.00, image: img_66f3e944575e23.06930400.png, discount type: Percentage, discount value: 30.00, tax: 50.00, unit: Pc, total cost: 6493.80)', '27-10-2024', 'Completed', 'jSNvPMzcRd', 'Transfer', '6500', '0', '100', 6493.8, '2024-10-27 12:39:45'),
(30, 'emmanuelodel75@gmail.com', 'Walk-in-customer', 'watch (quantity: 2, price: 4567.00, image: img_66f3e944575e23.06930400.png, discount type: Percentage, discount value: 30.00, tax: 50.00, unit: Pc, total cost: 6493.80)', '27-10-2024', 'Completed', 'ih5PvivQxF', 'Cash', '6500', '0', '100', 6493.8, '2024-10-27 12:44:29'),
(31, 'emmanuelodel75@gmail.com', 'Walk-in-customer', 'watch (quantity: 1, price: 4567, image: img_66f3e944575e23.06930400.png, discount type: Percentage, discount value: 30, tax: 50, unit: Pc, total cost: 4567)', '27-10-2024', 'In Progress', 'pGInxwTGVr', 'Card', '6500', '0', '100', 3246.9, '2024-10-27 12:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `sales_return`
--

CREATE TABLE `sales_return` (
  `id` int(255) NOT NULL,
  `user_email` varchar(100) NOT NULL COMMENT 'User''s email',
  `customer` varchar(50) NOT NULL,
  `products` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `amount_returned` varchar(100) NOT NULL,
  `grand_total_returned` double NOT NULL,
  `return_reason` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_return`
--

INSERT INTO `sales_return` (`id`, `user_email`, `customer`, `products`, `date`, `status`, `reference`, `amount_returned`, `grand_total_returned`, `return_reason`, `timestamp`) VALUES
(15, 'emmanuelodel75@gmail.com', 'Walk-in-customer', 'Burger (quantity: 1, price: 33.00, image: img_6713c69fb0a0b4.63247596.png, discount type: Cash, discount value: 30.00, tax: 33.00, unit: kg, total cost: 36.00)', '26-10-2024', 'Received', 'C7VwX1fUe6', '0', 36, 'broken', '2024-10-26 12:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(255) NOT NULL,
  `user_email` varchar(255) NOT NULL COMMENT 'user''s email',
  `store_name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `user_email`, `store_name`, `user_name`, `password`, `phone`, `email`, `status`, `timestamp`) VALUES
(19, 'ola@mail.com', 'ggggg', 'ggggg', '$2y$10$M.fyOyc2uqYvj1kXIh0c3uFZSniNwUTEYX7BWTJgEP0XRxMd1LEnS', '8121669013', 'chinweokwuemmanuel2004@gmail.com', 'active', '2024-09-24 07:45:07'),
(22, 'emmanuelodel75@gmail.com', 'kenny', 'kenny', '$2y$10$0MYQJ1Qth1Jixurn9AQKo.pM47Opg6qavBRKpifrs1lrOA.5PIUQq', '4567', 'chinweokwuemmanuel2004@gmail.com', 'inactive', '2024-09-24 08:11:07'),
(29, 'emmanuelodel75@gmail.com', 'gracia', 'gracia', '$2y$10$pTHoMF7ZpUxyvBZBQKHmlOrYtL78LLlsEA6mz3dUjISbzX.Slwzn2', '1234', 'gracia@gmail.com', 'active', '2024-09-24 18:09:36'),
(32, 'emmanuelodel75@gmail.com', 'uche', 'uche', '$2y$10$.fhekEXbMaw9QwscamgsvOdCKrTAH/fVsyKQYXfhaMSkrvpMuubJi', '56789', 'uche@h.com', 'active', '2024-09-25 16:16:39'),
(33, 'emmanuelodel75@gmail.com', 'kenny', 'kenny', '$2y$10$HR/ZezaVdZPwRyqeKhrWO.Vj41DQJgixRY/rp6btyIAP9JddTnTqy', '1234', 'chinweokwuemmanuel2004@gmail.com', 'active', '2024-09-25 16:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(255) NOT NULL,
  `user_email` varchar(100) NOT NULL COMMENT 'user''s email',
  `name` varchar(100) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `user_email`, `name`, `short_name`, `status`, `timestamp`) VALUES
(1, 'emmanuelodel75@gmail.com', 'kilogramme', 'kg', 'active', '2024-09-26 12:38:16'),
(11, 'emmanuelodel75@gmail.com', 'name', 'kf', 'inactive', '2024-10-20 18:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0 COMMENT '0 = unverified, 1 = verified',
  `password_reset_timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='users data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `verification_token`, `is_verified`, `password_reset_timestamp`) VALUES
(39, 'jake', 'lola', 'jake', 'imsu1981@gmail.com', '$2y$10$p9bAkOVLKgYYs2aVwvTXCO6wiqt0cbhHmbRcEB7diV/Aetim.TaTe', NULL, 1, NULL),
(40, 'Emmanuel', 'Ejike', 'Emmanuel', 'emmanuelodel75@gmail.com', '$2y$10$/R1Yv0/Oyc9E7lvMK9v81ei3M/b4gykKOrYALbMhgiWSKEsKxRbwy', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(255) NOT NULL,
  `user_email` varchar(100) NOT NULL COMMENT 'user''s email',
  `name` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address_1` varchar(100) NOT NULL,
  `address_2` varchar(100) NOT NULL,
  `country` text NOT NULL,
  `state` text NOT NULL,
  `city` text NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `user_email`, `name`, `contact_person`, `phone`, `email`, `address_1`, `address_2`, `country`, `state`, `city`, `zip_code`, `status`, `timestamp`) VALUES
(3, 'emmanuelodel75@gmail.co', 'ware', 'Emmanuel Brendan', '08121669013', 'chinweokwuemmanuel2004@gmail.com', 'Redeemed street Abuja Nigeria', 'Redeemed street Abuja Nigeria', 'united state', 'Abuja', 'F.c.t', '100101', 'Active', '2024-09-24 18:03:08'),
(4, 'emmanuelodel75@gmail.com', 'Emmanuel Brendan', 'Emmanuel Brendan', '08121669013', 'chinweokwuemmanuel2004@gmail.com', 'Redeemed street Abuja Nigeria', 'Redeemed street Abuja Nigeria', 'united kingdom', 'Abuja', 'F.c.t', '100101', 'Active', '2024-09-24 16:50:58'),
(5, 'emmanuelodel75@gmail.com', 'Sincere', 'Emmanuel Brendan', '08121669013', 'chinweokwuemmanuel2004@gmail.com', 'Redeemed street Abuja Nigeria', 'Redeemed street Abuja Nigeria', 'Nigeria', 'Abuja', 'F.c.t', '100101', 'Active', '2024-09-24 17:41:56'),
(6, 'emmanuelodel75@gmail.com', 'Emmanuel Brendan', 'Emmanuel Brendan', '08121669013', 'chinweokwuemmanuel2004@gmail.com', 'Redeemed street Abuja Nigeria', 'Redeemed street Abuja Nigeria', 'Tunisia', 'Abuja', 'F.c.t', '100101', 'Active', '2024-09-26 13:57:53'),
(7, 'emmanuelodel75@gmail.com', 'Emmanuel ', 'Emmanuel Brendan', '08121669013', 'chinweokwuemmanuel2004@gmail.com', 'Redeemed street Abuja Nigeria', 'Redeemed street Abuja Nigeria', 'Niger', 'Abuja', 'F.c.t', '100101', 'Active', '2024-09-26 13:59:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expired_products`
--
ALTER TABLE `expired_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_return`
--
ALTER TABLE `sales_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expired_products`
--
ALTER TABLE `expired_products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sales_return`
--
ALTER TABLE `sales_return`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
