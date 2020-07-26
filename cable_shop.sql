-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2019 at 06:39 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cable_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `session_id` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `email` varchar(200) NOT NULL,
  `subject` varchar(1100) NOT NULL,
  `message` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `shipping_address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `user_id`, `name`, `phone`, `email`, `address`, `shipping_address`) VALUES
(-8, 13, 'Md. Mominul Islam', '01521487472', 'admin@com', 'Nevy Hospital gate, Bondor , Chittagong', 'Nevy Hospital gate, Bondor , Chittagong'),
(1, 8, 'Md. Mominul Islam', '01521487473', 'user@com', 'Nevy Hospital gate, chittagong', 'Nevy Hospital gate'),
(4, 15, 'Md. Mominul Islam', '+8801521487473', 'manik1@com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `date` varchar(200) NOT NULL,
  `tracking_date` varchar(200) NOT NULL,
  `transection_id` varchar(2000) NOT NULL,
  `o_status` int(11) NOT NULL,
  `invalid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `customer_id`, `total_amount`, `date`, `tracking_date`, `transection_id`, `o_status`, `invalid`) VALUES
(3, 1, 133, '2019-08-29', '2019-08-29', '', 1, 0),
(4, -8, 111, '2019-08-31', '2019-08-31', '', 1, 0),
(5, 1, 10, '2019-09-01', '2019-09-01', '', 1, 0),
(6, 1, 10, '2019-09-01', '2019-09-01', '', 0, 0),
(7, 1, 10, '2019-09-01', '2019-09-01', '', 0, 0),
(8, 1, 66, '2019-09-01', '2019-09-01', '', 0, 0),
(9, -1, 96, '2019-09-01', '2019-09-01', '', 0, 0),
(10, 1, 230, '2019-09-03', '2019-09-03', 'Tx27367eg3e638', 0, 0),
(11, 1, 10, '2019-09-03', '2019-09-03', 'uta752q7812', 0, 0),
(12, 1, 11, '2019-09-03', '2019-09-03', 'Tx27367eg3e638', 0, 0),
(13, 1, 85, '2019-09-03', '2019-09-03', 'Akds53726382', 0, 0),
(14, 4, 24, '2019-09-13', '2019-09-13', 'qifwat123', 1, 0),
(15, 1, 25, '2019-09-13', '2019-09-13', 'qifwat123', 0, 1),
(16, 1, 94, '2019-09-13', '2019-09-13', 'Tx1218ucshf1', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `orderdetails_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantities` varchar(200) NOT NULL,
  `product_total_price` varchar(200) NOT NULL,
  `order_id` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`orderdetails_id`, `customer_id`, `shop_id`, `product_id`, `product_quantities`, `product_total_price`, `order_id`, `status`) VALUES
(6, 1, 1, 10, '4', '40', '3', 4),
(7, 1, 1, 19, '2', '26', '3', 4),
(8, 1, 1, 17, '3', '45', '3', 4),
(9, 1, 2, 22, '2', '22', '3', 4),
(10, -8, 1, 16, '5', '55', '4', 3),
(11, -8, 2, 20, '4', '56', '4', 1),
(12, 1, 1, 10, '1', '10', '5', 3),
(13, 1, 1, 10, '1', '10', '6', 1),
(14, 1, 1, 10, '1', '10', '7', 1),
(15, 1, 1, 10, '4', '40', '8', 2),
(16, 1, 2, 19, '2', '26', '8', 1),
(17, -1, 1, 10, '3', '30', '9', 1),
(18, -1, 2, 22, '6', '66', '9', 1),
(19, 1, 1, 10, '6', '60', '10', 1),
(20, 1, 1, 14, '9', '90', '10', 1),
(21, 1, 1, 16, '2', '22', '10', 1),
(22, 1, 2, 22, '1', '11', '10', 1),
(23, 1, 2, 21, '2', '32', '10', 1),
(24, 1, 1, 17, '1', '15', '10', 1),
(25, 1, 1, 14, '1', '10', '11', 1),
(26, 1, 1, 16, '1', '11', '12', 1),
(27, 1, 1, 10, '3', '30', '13', 1),
(28, 1, 2, 22, '5', '55', '13', 1),
(29, 4, 1, 14, '1', '10', '14', 3),
(30, 4, 2, 20, '1', '14', '14', 1),
(31, 1, 1, 14, '1', '10', '15', 1),
(32, 1, 1, 17, '1', '15', '15', 1),
(33, 1, 1, 14, '1', '10', '16', 1),
(34, 1, 2, 19, '3', '39', '16', 1),
(35, 1, 1, 17, '3', '45', '16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `product_name` varchar(2000) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_details` varchar(5000) NOT NULL,
  `category` varchar(200) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_image` varchar(500) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `product_name`, `product_price`, `product_details`, `category`, `shop_id`, `product_image`, `discount`, `product_quantity`) VALUES
(10, 'Ul 3573 high voltage silicone rubber insulated', 10, 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; es', 'cat2', 1, 'cable1.jpg', 0, 1000),
(14, 'Ul 3573 high voltage silicone rubber insulated', 10, 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; es', 'cat1', 1, 'cable1.jpg', 0, 1000),
(16, ' high voltage silicone rubber insulated', 11, 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; es', 'cat3', 1, 'vguard.jpg', 0, 1000),
(17, 'RR Cable', 15, 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; es', 'cat4', 1, 'rrcable.jpg', 0, 1000),
(19, '4G RG cable', 13, 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; es', 'cat6', 2, '4grgbled.jpg', 0, 1000),
(20, 'Enamel Copper', 14, 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; es', 'cat6', 2, 'enamelcopper.jpg', 0, 1000),
(21, 'Switch Cable', 16, 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; es', 'cat1', 2, 'switch.jpg', 0, 1000),
(22, 'HPL wire', 11, 'Thiouoifcbd baifyhoe vsacg vbhgc kvshykjhbv hfgas N bcjhbdj Bkjgdkbjv', 'cat1', 2, 'HPL.jpg', 0, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`product_id`, `customer_id`, `rating`) VALUES
(10, 1, '4'),
(14, 1, '4.5'),
(16, 1, '4.5'),
(17, 1, '4');

-- --------------------------------------------------------

--
-- Table structure for table `shop_owner`
--

CREATE TABLE `shop_owner` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `shop_name` varchar(2000) NOT NULL,
  `address` varchar(10000) NOT NULL,
  `nid_image` varchar(1000) NOT NULL,
  `nid_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_owner`
--

INSERT INTO `shop_owner` (`id`, `user_id`, `name`, `phone`, `email`, `shop_name`, `address`, `nid_image`, `nid_no`) VALUES
(1, 1, 'Md. Mominul Islam', '01521487472', 'demo@paragon.com', 'ABC Electrical Store', 'Nevy Hospital gate, Bondor , Chittagong', 'ss.jpg', '1585465932459'),
(2, 2, 'Md. Mominul Islam', '01521487472', 'demo@hospital.com', 'XYZ Electrical Store', 'Bhatiary, Chittagong', 'customer.jpg', '152324364918'),
(8, 13, 'Md. Mominul Islam', '01521487472', 'admin@com', 'Momin Electrical Store', 'Nevy Hospital gate, Bondor , Chittagong', '', '1585465932458');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(110) NOT NULL,
  `role` varchar(200) NOT NULL,
  `phone` varchar(110) NOT NULL,
  `image` varchar(1100) NOT NULL,
  `nid_no` varchar(110) NOT NULL,
  `nid_image` varchar(1100) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `user_id`, `name`, `role`, `phone`, `image`, `nid_no`, `nid_image`, `address`, `status`) VALUES
(1, 4, 'Abdul Kuddus', 'electrician', '01521487473', '1111.jpg', '15732846348312498', 'mojid.JPG', 'Nevy Hospital gate', 1),
(2, 5, 'Abdur Rahim', 'electrician', '01521487472', '1111.jpg', '1585465932458', 'mojid.JPG', 'EPZ', 1),
(3, 6, 'Abdus Salam', 'driver', '01521487471', 'manik.jpg', '12345678986', 'IMG_1521.JPG', 'Nevy Hospital gate, Bondor , Chittagong', 1),
(4, 7, 'Abdul Basir', 'driver', '01521487473', 'manik.jpg', '1585465932458', 'IMG_1521.JPG', 'Nevy Hospital gate', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type`, `password`) VALUES
(1, 'Md. Mominul Islam', 'demo@paragon.com', 'shop_owner', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Md. Mominul Islam', 'demo@hospital.com', 'shop_owner', '827ccb0eea8a706c4c34a16891f84e7b'),
(4, 'Abdul Kuddus', 'driver@com', 'driver', '827ccb0eea8a706c4c34a16891f84e7b'),
(5, 'Abdur Rahim', 'electrician@com', 'electrician', '827ccb0eea8a706c4c34a16891f84e7b'),
(6, 'Abdus Salam', 'driver1@com', 'driver', '827ccb0eea8a706c4c34a16891f84e7b'),
(7, 'Abdul Basir', 'driver3@com', 'driver', '827ccb0eea8a706c4c34a16891f84e7b'),
(8, 'Md. Mominul Islam', 'user@com', 'customers', '827ccb0eea8a706c4c34a16891f84e7b'),
(13, 'Md. Mominul Islam', 'admin@com', 'shop_owner', '827ccb0eea8a706c4c34a16891f84e7b'),
(14, 'Syem Uddin', 'sayem@com', 'admin', '827ccb0eea8a706c4c34a16891f84e7b'),
(15, 'Md. Mominul Islam', 'manik1@com', 'customers', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `warning`
--

CREATE TABLE `warning` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warning`
--

INSERT INTO `warning` (`id`, `shop_id`, `message`, `date`) VALUES
(3, 2, 'Customer not satisfied.', '2019-09-13 19:37:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`orderdetails_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `shop_owner`
--
ALTER TABLE `shop_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warning`
--
ALTER TABLE `warning`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `orderdetails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `shop_owner`
--
ALTER TABLE `shop_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `warning`
--
ALTER TABLE `warning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
