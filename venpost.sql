-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 04:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `venpost`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `post_id`, `name`, `image`, `comment`) VALUES
(1, 9, 23, 'USER A', 'cover3.jpg', 'Hello To You Too'),
(2, 9, 25, 'USER A', 'cover3.jpg', 'Hello'),
(3, 12, 24, 'Customer', '', 'Cute Cat <3'),
(4, 9, 26, 'USER A', 'cover3.jpg', 'Yes It Works'),
(5, 16, 24, 'admin', 'olli-the-polite-cat.jpg', 'Nice'),
(6, 16, 29, 'admin', 'olli-the-polite-cat.jpg', 'lemonz'),
(7, 9, 29, 'USER A', 'cover3.jpg', 'I Like Lemonz');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `check_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `check_like`) VALUES
(4, 9, 24, 2),
(5, 9, 23, 1),
(6, 9, 25, 1),
(7, 12, 24, 1),
(8, 12, 23, 1),
(12, 9, 26, 2),
(13, 12, 25, 1),
(14, 12, 26, 2),
(15, 9, 27, 2),
(16, 14, 25, 2),
(18, 16, 29, 1),
(19, 16, 27, 1),
(20, 16, 23, 1),
(21, 9, 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `added` int(11) NOT NULL,
  `tags` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `image1`, `text`, `date`, `name`, `image`, `added`, `tags`) VALUES
(23, 9, '', 'Hello World', '2023-06-11 01:36:06', 'USER A', 'cover3.jpg', 2, 'HelloWorld'),
(24, 9, 'ac2.jpg', 'Cat', '2023-06-11 01:35:57', 'USER A', 'cover3.jpg', 1, 'CuteCat'),
(25, 12, '', 'hello', '2023-06-11 01:43:22', 'Customer', '', 1, 'Hello'),
(26, 12, '', 'Testing', '2023-06-11 01:40:21', 'Customer', '', 0, 'Test'),
(27, 9, 'cover3.jpg', 'Meow', '2023-06-10 21:37:18', 'USER A', 'cover3.jpg', 1, 'Meow'),
(29, 16, 'lemon.jpg', 'When Life Gives You Lemons', '2023-06-11 02:34:21', 'admin', 'olli-the-polite-cat.jpg', 0, 'Lemon');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` int(255) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `image`) VALUES
(9, 'USER A', 'user1@gmail.com', 0, 'cover3.jpg'),
(12, 'Customer', 'Customer@gmail.com', 91, ''),
(13, 'Burger', 'burger@example.com', 2147483647, ''),
(14, 'Burger1', 'burger1@example.com', 6, ''),
(16, 'admin', 'admin@example.com', 0, 'olli-the-polite-cat.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
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
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
