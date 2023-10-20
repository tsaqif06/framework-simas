-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2023 at 07:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_fw`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Saturn', 'c5da1c9fe220e2e16a51.jpeg', '2023-10-19 04:02:44', '2023-10-20 02:34:03', NULL),
(4, 'Stamford Bridge', 'a8d363d4cc1991474f30.jpeg', '2023-10-19 04:03:31', '2023-10-20 02:33:35', NULL),
(5, 'Earth', '059ee4a27bdab4591711.jpg', '2023-10-20 02:38:16', '2023-10-20 02:38:35', '2023-10-20 09:38:48'),
(6, 'test', '11ba462e3c49563b0b97.png', '2023-10-20 03:44:17', '2023-10-20 04:06:36', '2023-10-20 11:06:40'),
(7, 'moon horizon', 'd07deecb7ebdae31dbf4.jpg', '2023-10-20 07:03:54', '2023-10-20 07:09:21', NULL),
(8, 'sapi', 'cd8580b26eaacb4f12c3.png', '2023-10-20 07:09:29', '2023-10-20 07:09:38', NULL),
(9, 'we won champions league', '73e9d3d4878dd5cedb06.jpeg', '2023-10-20 07:19:57', '2023-10-20 07:20:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(40) NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', 'test@gmail.com', 'test123', 'admin', '2023-10-13 03:38:49', NULL, NULL),
(2, 'sapi', 'sapi@gmail.com', 'sapi123', 'user', '2023-10-20 07:01:05', NULL, NULL),
(3, 'dugongg', 'dugong@gmail.com', 'dugong123', 'user', '2023-10-20 07:01:19', '2023-10-20 07:03:03', NULL),
(4, 'ikanas', 'ikan@gmail.com', 'ikan123', 'user', '2023-10-20 07:10:09', '2023-10-20 07:19:14', NULL),
(5, 'kadal air', 'kadal@gmail.com', 'kadal123', 'user', '2023-10-20 07:19:31', '2023-10-20 07:19:39', NULL);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
