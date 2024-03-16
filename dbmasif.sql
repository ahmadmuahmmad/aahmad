-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 11:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmasif`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(5, 'masif', '33f5f3903226b7d92d04eacb0b9300008b61b706');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(3, 0, 'test', 'test@test.com', '07502223311', 'test payam');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `descreption` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `descreption`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(13, 7, 'masif', '0750876123', 'masif@gmail.com', 'cash on delivery', 'کوردستان, هەولێر, شەقڵاوە, ., نزیک قایمەقام, زانیاری, زۆر ئاسانە لەسەر جادەم - 45', 'تکایە زوو بۆم بنێرن', 'Pizza (5000 x 2) - ', 10000, '2024-01-26', 'completed'),
(14, 7, 'masif', '0750876123', 'masif@gmail.com', 'cash on delivery', 'کوردستان, هەولێر, شەقڵاوە, ., نزیک قایمەقام, زانیاری, زۆر ئاسانە لەسەر جادەم - 45', 'تێبینیم نییە', 'Orange Juice (2000 x 1) - ', 2000, '2024-01-26', 'pending'),
(15, 7, 'masif', '0750876123', 'masif@gmail.com', 'cash on delivery', 'کوردستان, هەولێر, شەقڵاوە, ., نزیک قایمەقام, زانیاری, زۆر ئاسانە لەسەر جادەم - 45', 'تکایە زوو بۆم بنێرن', 'Orange Juice (2000 x 5) - Pizza (5000 x 2) - ', 20000, '2024-01-27', 'completed'),
(16, 7, 'masif', '0750876123', 'masif@gmail.com', 'cash on delivery', 'کوردستان, هەولێر, شەقڵاوە, ., نزیک قایمەقام, زانیاری, زۆر ئاسانە لەسەر جادەم - 45', ' ئەگەر تێبینیەکت هەیە بینووسە .....\r\n      ', 'Pizza (5000 x 5) - Orange Juice (2000 x 3) - ', 31000, '2024-01-30', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `descreption` varchar(500) NOT NULL,
  `engdescreption` varchar(500) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `descreption`, `engdescreption`, `category`, `price`, `image`) VALUES
(18, 'Pizza', 'پیتزای بەتام و نوێ', 'New Delicious Pizza', 'fastfoods', 5000, 'pizza-4.png'),
(19, 'Orange Juice', 'شەربەت پرتەقاڵی فرێش', 'Fresh Orange Juice', 'drinks', 2000, 'drink-1.png'),
(20, 'Coffe', 'قاوەی قەزوان', 'Qazwan Coffe', 'drinks', 1500, 'drink-2.png'),
(21, 'Noodles', 'ماکەرۆنی گەرم و بەتام', 'Hot and Delicious Noodles', 'dishes', 6000, 'dish-1.png'),
(22, 'Toast', 'خواردنێکی تورکی نوێ', 'New Turkish  Food', 'dishes', 3500, 'dish-3.png'),
(23, 'Azberry', 'خواردنەوەی ئەزبەری سارد', 'Cold Azberry Drink', 'drinks', 750, 'drink-4.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(7, 'masif', 'masif@gmail.com', '0750876123', '8bb1e26cbd9503d776e5e578cb7ab436d677ce52', 'کوردستان, هەولێر, شەقڵاوە, ., نزیک قایمەقام, زانیاری, زۆر ئاسانە لەسەر جادەم - 45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
