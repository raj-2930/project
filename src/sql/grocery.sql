-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2022 at 02:44 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstName` varchar(125) NOT NULL,
  `lastName` varchar(125) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `confirmCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`, `type`, `confirmCode`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '6464651', 'okay', 'f6fdffe48c908deb0f4c3bd36c032e72', 'admin', '789456');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `uid`, `pid`, `quantity`) VALUES
(11, 2, 12, 0),
(12, 0, 46, 0),
(15, 43, 47, 0),
(19, 42, 54, 0),
(20, 42, 53, 0),
(21, 0, 47, 0),
(22, 0, 99, 0),
(23, 46, 81, 0),
(24, 49, 82, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `oplace` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `odate` date NOT NULL,
  `delivery` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `pid`, `quantity`, `oplace`, `mobile`, `odate`, `delivery`) VALUES
(93, 49, 108, 1, 'dublin', '9874563210', '2022-12-15', 'Standard Delivery'),
(95, 49, 107, 3, 'dublin', '9874563210', '2022-12-15', 'Standard Delivery'),
(98, 50, 116, 2, 'Blanchardstown', '9632587410', '2022-12-15', 'Standard Delivery'),
(99, 53, 107, 2, 'blanch', '1234567890', '2022-12-18', 'Standard Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pName` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `piece` int(11) NOT NULL,
  `description` text NOT NULL,
  `available` int(11) NOT NULL,
  `item` varchar(100) NOT NULL,
  `pCode` varchar(20) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pName`, `price`, `piece`, `description`, `available`, `item`, `pCode`, `picture`) VALUES
(105, 'maggi', 10, 5, '2 minutes noodles', 100, 'noodles', 'ma', '1671064405.png'),
(107, 'Mr. Egg Noodles', 50, 5, 'Egg noodles masala flavor', 100, 'noodles', 'en', '1671065422.jpg'),
(108, 'Yippie Noodles', 20, 5, 'Sunfeast YiPPee! Magic Masala Instant Noodles', 100, 'noodles', 'yn', '1671065599.jpg'),
(109, 'Peri Peri', 25, 5, 'Peri peri seasoning', 100, 'seasoning', 'pp', '1671065828.jpg'),
(110, 'Tomato Ketchup', 150, 5, 'Heinz tomato ketchup', 100, 'seasoning', 'tk', '1671066149.jpg'),
(111, 'Mayonnaise', 60, 5, 'Veg mayonnaise original', 100, 'seasoning', 'mayo', '1671066542.png'),
(112, 'Salt', 30, 5, 'Tata pure salt.', 100, 'seasoning', 'ts', '1671066681.jpg'),
(114, 'Coke', 20, 5, 'Coca-Cola', 100, 'drink', 'cc', '1671066944.jpg'),
(115, 'Pepsi', 20, 5, 'Pepsi', 100, 'drink', 'pep', '1671067100.jpg'),
(116, 'Sprite', 20, 5, 'Sprite', 100, 'drink', 'sp', '1671067148.PNG'),
(118, 'Lays', 10, 5, 'Cheese & onion lays', 100, 'snack', 'la', '1671067325.jpg'),
(119, 'Pringles', 40, 5, 'Classic Pringles', 100, 'snack', 'cp', '1671067414.jpeg'),
(120, 'Dorritos', 40, 5, 'Dorritos tangy cheese', 100, 'snack', 'dor', '1671067623.jpeg'),
(122, 'Too Yum', 30, 5, 'Chilli Achari', 100, 'snack', 'ty', '1671067980.jpg'),
(123, 'Gulab Jamun', 120, 5, 'gulab jamun instant mix', 100, 'sweet', 'gj', '1671068128.jpeg'),
(124, 'Kaju Katli', 250, 5, 'Kaju Katli 500g', 100, 'sweet', 'kk', '1671068249.jpg'),
(125, 'Dove', 20, 5, 'Dove soap', 100, 'soap', 'ds', '1671068752.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(120) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `mobile`, `address`, `password`) VALUES
(53, 'Prince', 'Gaikwad', 'prince@gaik.com', '1234567890', 'blanch', '345616f307c62eaf232f2d5e25c430958023c91436d2ef2caebb5b866b07ecd1'),
(54, 'Ankit', 'Kumar', 'abc@xyz.com', '9874563210', 'blanch', '345616f307c62eaf232f2d5e25c430958023c91436d2ef2caebb5b866b07ecd1');

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
