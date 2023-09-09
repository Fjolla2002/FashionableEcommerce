-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 11:55 PM
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
-- Database: `clothes_accessories`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `idcontact` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`idcontact`, `name`, `email`, `message`) VALUES
(1, 'Fjolla', 'fjolla_selimi2002@hotmail.com', 'hh'),
(3, 'Fjolla1', 'fjolla_selimi2002@hotmail.com', 'ho');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` varchar(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `phonenumber` int(21) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `name`, `lastname`, `phonenumber`, `address`) VALUES
('2147483647', 'Altin', 'Duraku', 2147483647, 'None'),
('647905', 'Altin', 'Duraku', 2147483647, 'None1'),
('647906', 'Altin1', 'Duraku', 2147483647, 'None'),
('6479060', 'Altin1', 'Duraku1', 2147483647, 'None1'),
('64790728b4a8a0.66949700', 'Altin1', 'Duraku', 2147483647, 'None'),
('6479073083a992.31870211', 'Altin12', 'Duraku', 2147483647, 'None'),
('647907378ed194.25730152', 'Altin', 'Duraku', 2147483647, 'None'),
('64790a007b7973.23388770', 'Altin', 'Duraku', 2147483647, 'None'),
('64790bf59c5870.97062000', 'Altin', 'Duraku', 2147483647, 'None'),
('64790c02b60310.31766989', 'Altin', 'Duraku', 2147483647, 'None'),
('64790c2fe59cd0.36288539', 'Altin', 'Duraku', 2147483647, 'None'),
('64790c47e17766.46202367', 'Altin', 'Duraku', 2147483647, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `category` varchar(30) NOT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `times_sold` int(11) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagepath` varchar(150) DEFAULT NULL,
  `imagepathhover` varchar(160) DEFAULT NULL,
  `old_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idproduct`, `name`, `type`, `description`, `category`, `price`, `times_sold`, `date_added`, `imagepath`, `imagepathhover`, `old_price`) VALUES
(0, 'Shirt', 'clothes', 'shirt', 'Men', 222.00, 2, '2023-05-24 23:04:31', 'dist/images/product14.jpg', '', 250),
(1, 'Watch', 'accessories', 'useful watch', 'Women', 19.00, 3, '2023-05-25 00:42:26', 'dist/images/product9.jpg', NULL, NULL),
(2, 'Jeans', 'clothes', 'Description of jeans', 'Men', 49.99, 10, '2023-05-25 00:54:09', 'dist/images/product15.jpg', NULL, 55),
(3, 'Dress', 'clothes', 'Description of dress', 'Women', 59.99, 3, '2023-05-25 00:54:09', 'dist/images/product12.jpg', NULL, NULL),
(4, 'Shoes', 'clothes', 'Description of shoes', 'Men', 79.99, 0, '2023-05-25 00:54:09', 'dist/images/product6.jpg', NULL, NULL),
(5, 'Handbag', 'accessories', 'Description of handbag', 'Women', 39.99, 0, '2023-05-25 00:54:09', 'dist/images/product5.jpg', NULL, NULL),
(6, 'T-Shirt', 'clothes', 'Description of t-shirt', 'Men', 19.99, 0, '2023-05-25 00:54:09', 'dist/images/product13.jpg', NULL, 0),
(7, 'Jeans', 'Jeans', 'Jeans for girls', 'Kids', 34.99, 0, '2023-05-25 00:54:09', 'dist/images/product16.jpg', NULL, NULL),
(8, 'Handbag', 'accessories', 'Description of hat', 'Kids', 24.99, 5, '2023-05-25 00:54:09', 'dist/images/product8.jpg', NULL, 56),
(9, 'Watch', 'clothes', 'Watch for Mens', 'Men', 89.99, 1, '2023-05-25 00:54:09', 'dist/images/product9.jpg', NULL, NULL),
(10, 'Sunglasses', 'accessories', 'Description of sunglasses', 'Kids', 59.99, 8, '2023-05-25 00:54:09', 'dist/images/product4.jpg', NULL, 88),
(11, 'Shoes', 'clothes', 'Mens shoes', 'Men', 29.99, 0, '2023-05-25 00:54:09', 'dist/images/product1.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(128) NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `phonenumber` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `name`, `email`, `username`, `password`, `address`, `phonenumber`) VALUES
(1, 'a', 'altinduraku404@gmail.com', 'aaaa', 'adsdsadsadsa', 'aaadd', '12323121'),
(2, 'hhhhhhhhh', 'altinduraku40@gmail.com', 'hhasda', 'dsadsaasd', 'Noneadssda', '531112211'),
(3, 'Altin', 'altini@gmail.com', 'altini', '$2y$10$eF0rXaQszKOnm/l8ViaRDeFz7CEUnX6hrAJ.t7dwu4dJo2WQBFGnC', 'aaaa', '123321'),
(4, 'ff', 'fjolla.selimi17@gmail.com', 'ffff', '$2y$10$jM6g7rVZTpe8LbOx.Ca98e.3FLQROWP9lb6RqmHZ8PCcLruUnlphO', 'Lluge, Podujeve', '1213'),
(5, 'Altin', 'altinduraku@gmail.com', 'altinduraku', '$2y$10$F20f8diQuLhCn7lJL7/InuJzqpiUZATTza9voiHrMxfGmF9quZ4Gm', 'vushtrri', '1233321'),
(7, 'Altin Duraku', 'altinduraku4024@gmail.com', 'aaaaaaae32', '#13Altini', 'None', '231123132'),
(8, 'Altin Duraku', 'altinduraku4014@gmail.com', 'altindurakua', '#Altini1', 'None', '213213'),
(9, 'Altin Duraku', 'altinduraku40224@gmail.com', 'asddsaassad', '#Altini1', 'None', '213123123'),
(11, 'Altin Duraku', 'altinduraku4@gmail.com', 'aaltini', '#Altini1', 'None', '123321123'),
(12, 'altini', 'alt@gmail.com', 'altinii', '$2y$10$ZMPi.o05fggPESuKscGeg.sYXhgMupEjirFzmosbOpLDnwfsOh7py', 'ads', '12332112233'),
(13, 'Altini', 'adsas@gmail.com', 'jdasjdasjd', '$2y$10$aU834LuVHRw8OTpVUYqLceeyelhXK3YxpYVcECV9nol1hkHzkMYR6', 'dsads', '123231323222'),
(14, 'Altin Duraku', 'altinduraku404222@gmail.com', 'alt1ni', '$2y$10$jCRQ8d5FMPgA6Kc.YKyLGOe1ex3.8tRnGqrw3xCerHBNN6lxzu1/G', 'None', '2133311'),
(15, 'Fjolla', 'fjolla.selimi1@gmail.com', 'fjollaa1', '$2y$10$vnj0.NpwViMBPyW5RKEPS./Yso6ZJSljclqlqhAoNmU6L51BQ7BZC', 'pd', '123132'),
(19, 'Fjolla', 'fjolla@gmail.com', 'lola', '$2y$10$h/IigZTyFcgC4v2ialB.m.r8C8gpTP6yAL642BSJFShSmqdGsx1v6', 'none', '423421343'),
(22, 'ff', 'sas@gmail.com', 'dwwq', '$2y$10$vBDUPwM09..c32Uym8qm9.b7OM2jEMWWGZd3h88k3ggM8xqwt/mwW', 'dff', '3214452');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD UNIQUE KEY `order_id` (`orders_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idproduct`),
  ADD UNIQUE KEY `idproducts_UNIQUE` (`idproduct`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `phonenumber_UNIQUE` (`phonenumber`),
  ADD UNIQUE KEY `iduser_UNIQUE` (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
