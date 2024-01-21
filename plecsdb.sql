-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 10:53 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plecsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `admin_username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`admin_username`, `password`) VALUES
('Fira', '$2y$10$P89fqKFCQTf35ZHbd5n7Xefhv4clALljULWpSsLBw.l5Jklt/xyhC');

-- --------------------------------------------------------

--
-- Table structure for table `plecs_cart`
--

CREATE TABLE `plecs_cart` (
  `cart_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plecs_cart`
--

INSERT INTO `plecs_cart` (`cart_id`, `quantity`, `user_name`, `product_id`) VALUES
(21, 1, 'user_name', 39),
(22, 1, 'user_name', 40);

-- --------------------------------------------------------

--
-- Table structure for table `plecs_feedback`
--

CREATE TABLE `plecs_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_date` date NOT NULL,
  `feedback_text` text NOT NULL,
  `feedback_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plecs_feedback`
--

INSERT INTO `plecs_feedback` (`feedback_id`, `feedback_date`, `feedback_text`, `feedback_email`) VALUES
(1, '2024-01-18', 'Good2', 'leofira@gmail.com'),
(2, '2024-01-26', 'not so good', 'bambam1123@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `plecs_order`
--

CREATE TABLE `plecs_order` (
  `order_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plecs_order`
--

INSERT INTO `plecs_order` (`order_id`, `total_price`, `user_name`, `payment_id`, `shipping_id`) VALUES
(1, '13.00', 'syed', 2, 1),
(2, '30.00', 'bambam2809', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plecs_order_item`
--

CREATE TABLE `plecs_order_item` (
  `order_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `plecs_payments`
--

CREATE TABLE `plecs_payments` (
  `payment_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(32) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `user_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plecs_payments`
--

INSERT INTO `plecs_payments` (`payment_id`, `payment_date`, `payment_method`, `amount`, `user_name`) VALUES
(2, '2024-01-18', 'QR code', '20.00', 'bambam2809'),
(3, '2024-02-14', 'VISA', '34.00', 'syed'),
(4, '2024-03-20', 'VISA', '90.00', 'syed'),
(5, '2024-04-18', 'VISA', '100.00', 'bambam2809'),
(6, '2024-01-18', 'VISA', '12.00', 'bambam16');

-- --------------------------------------------------------

--
-- Table structure for table `plecs_product`
--

CREATE TABLE `plecs_product` (
  `product_id` int(11) NOT NULL,
  `product_cat` varchar(128) NOT NULL,
  `product_name` varchar(32) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_img` text NOT NULL,
  `popularity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plecs_product`
--

INSERT INTO `plecs_product` (`product_id`, `product_cat`, `product_name`, `price`, `product_img`, `popularity`) VALUES
(39, 'Premium Cream Puff', 'Oreo', '4.00', 'img/65a88b4b02289.jpg', 10),
(40, 'Cold Beverages', 'Yam Latte', '6.00', 'img/65a88b60b6f54.jpg', 30),
(41, 'Regular Cream Puff', 'Chocolate', '3.00', 'img/65a88b6f8a19d.jpg', 33),
(42, 'Premium Cream Puff', 'Blueberry', '4.00', 'img/65a88b7bc19cb.jpg', 5),
(43, 'Premium Cream Puff', 'Gula Apong', '4.00', 'img/65a88b8b020b2.jpg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `plecs_shipping`
--

CREATE TABLE `plecs_shipping` (
  `shipping_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `zip_code` int(11) NOT NULL,
  `city` varchar(11) NOT NULL,
  `state` varchar(11) NOT NULL,
  `country` varchar(11) NOT NULL,
  `user_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plecs_shipping`
--

INSERT INTO `plecs_shipping` (`shipping_id`, `address`, `zip_code`, `city`, `state`, `country`, `user_name`) VALUES
(1, 'Lot 1190, Lorong A2, Taman Sebiew Indah', 97000, 'Bintulu', 'Sarawak', 'Malaysia', 'bambam2809');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_name` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_name`, `email`, `password`) VALUES
('bambam16', 'bambam16@gmail.com', '$2y$10$IqJPAy9ZAuU/NPOxz.kD3.hQNcHSwBD1z0ZBj3lyf0TfSfZEvHTei'),
('bambam2809', 'bambam@gmail.com', '$2y$10$QqkyaF4WcvKeFXxmPgUE4uwwip7mQ0NQFqiTx2fPnZiYa6/ev9..q'),
('syed', 'syed160202@gmail.com', '$2y$10$pe6lFxCiefMmq.EtrVQOw.1XRqLmup7nHNUq/LR2OtYpeH0gGho0C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`admin_username`);

--
-- Indexes for table `plecs_cart`
--
ALTER TABLE `plecs_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `plecs_cartuser_account` (`user_name`),
  ADD KEY `plecs_cartplecs_product` (`product_id`);

--
-- Indexes for table `plecs_feedback`
--
ALTER TABLE `plecs_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `plecs_order`
--
ALTER TABLE `plecs_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `plecs_orderuser_account` (`user_name`),
  ADD KEY `plecs_orderplecs_payments` (`payment_id`),
  ADD KEY `plecs_orderplecs_shipping` (`shipping_id`);

--
-- Indexes for table `plecs_order_item`
--
ALTER TABLE `plecs_order_item`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `plecs_order_itemplecs_product` (`product_id`),
  ADD KEY `plecs_order_itemplecs_order` (`order_id`);

--
-- Indexes for table `plecs_payments`
--
ALTER TABLE `plecs_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `plecs_paymentsuser_account` (`user_name`);

--
-- Indexes for table `plecs_product`
--
ALTER TABLE `plecs_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `plecs_shipping`
--
ALTER TABLE `plecs_shipping`
  ADD PRIMARY KEY (`shipping_id`),
  ADD KEY `plecs_shippinguser_account` (`user_name`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plecs_cart`
--
ALTER TABLE `plecs_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `plecs_feedback`
--
ALTER TABLE `plecs_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plecs_order`
--
ALTER TABLE `plecs_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plecs_order_item`
--
ALTER TABLE `plecs_order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plecs_payments`
--
ALTER TABLE `plecs_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plecs_product`
--
ALTER TABLE `plecs_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `plecs_shipping`
--
ALTER TABLE `plecs_shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `plecs_cart`
--
ALTER TABLE `plecs_cart`
  ADD CONSTRAINT `plecs_cartplecs_product` FOREIGN KEY (`product_id`) REFERENCES `plecs_product` (`product_id`);

--
-- Constraints for table `plecs_order`
--
ALTER TABLE `plecs_order`
  ADD CONSTRAINT `plecs_orderplecs_payments` FOREIGN KEY (`payment_id`) REFERENCES `plecs_payments` (`payment_id`),
  ADD CONSTRAINT `plecs_orderplecs_shipping` FOREIGN KEY (`shipping_id`) REFERENCES `plecs_shipping` (`shipping_id`),
  ADD CONSTRAINT `plecs_orderuser_account` FOREIGN KEY (`user_name`) REFERENCES `user_account` (`user_name`);

--
-- Constraints for table `plecs_order_item`
--
ALTER TABLE `plecs_order_item`
  ADD CONSTRAINT `plecs_order_itemplecs_order` FOREIGN KEY (`order_id`) REFERENCES `plecs_order` (`order_id`),
  ADD CONSTRAINT `plecs_order_itemplecs_product` FOREIGN KEY (`product_id`) REFERENCES `plecs_product` (`product_id`);

--
-- Constraints for table `plecs_payments`
--
ALTER TABLE `plecs_payments`
  ADD CONSTRAINT `plecs_paymentsuser_account` FOREIGN KEY (`user_name`) REFERENCES `user_account` (`user_name`);

--
-- Constraints for table `plecs_shipping`
--
ALTER TABLE `plecs_shipping`
  ADD CONSTRAINT `plecs_shippinguser_account` FOREIGN KEY (`user_name`) REFERENCES `user_account` (`user_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
