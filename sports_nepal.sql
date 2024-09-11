-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Sep 11, 2024 at 05:57 AM
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
-- Database: `sports@nepal`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `created_at`) VALUES
(4, 'Cricket Bat', 10000.00, 'The blade of the paddle-shaped bat is made of willow and must not be broader than 4.25 inches (10.8 cm). The length of the bat, including the handle, must not exceed 38 inches (96.5 cm). The ball, which has a core of cork built up with string, was traditionally encased…', '0', '2024-09-05 03:42:33'),
(5, 'Cricket Ball', 500.00, 'A cricket ball is a hard, solid ball used to play cricket. A cricket ball consists of a cork core wound with string then a leather cover stitched on, and manufacture is regulated by cricket law at first-class level                     ', 'uploads/shiny-new-test-match-cricket-600nw-2341082493.webp', '2024-09-10 13:11:19'),
(6, 'Football', 4000.00, 'Take your game to the next level with our premium quality football! Designed for both casual play and competitive matches, this ball offers superior control, durability, and precision. Made from high-grade synthetic leather, it provides excellent grip and water resistance, making it perfect for all weather conditions.                        ', '0', '2024-09-10 13:20:33'),
(7, 'Cricket Bat', 50000.00, '                        ', 'uploads/cricketbat.webp', '2024-09-10 13:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'Sandesh Gharti Magar', 'sandesh@gmail.com', '$2y$10$2n7b2GoQPm.TySEKAk87MOp1Ma49Bz3idYP2fekreZ6NHBUUq0pG2', 1),
(6, 'Gagan Sunar', 'gagan@gmail.com', '$2y$10$uzb6U6kSIO6menMzmtgYnuhzG0WL5DT6nug3yzfwPXBO.6Zenscua', 0),
(7, 'Gokarna Chaudhary', 'gokarna@gmail.com', '$2y$10$NUpF8AvPQ3.kmtXgW35vWebOGEI5RHNY3jvrR4Z7yIwRN8.d8HKqm', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
