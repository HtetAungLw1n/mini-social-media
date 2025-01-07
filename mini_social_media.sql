-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 05:16 AM
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
-- Database: `mini_social_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `post_id`, `user_id`, `created_at`) VALUES
(1, 'testing', 25, 10, '2025-01-02 10:10:42'),
(2, 'great', 25, 10, '2025-01-02 10:10:52'),
(3, 'testing comment', 25, 11, '2025-01-02 10:16:26'),
(4, 'nice watch', 28, 12, '2025-01-02 10:20:57'),
(5, 'hi', 25, 12, '2025-01-02 10:22:08');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `status` text NOT NULL,
  `image` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `edited_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `status`, `image`, `user_id`, `created_at`, `edited_at`) VALUES
(24, 'Hi This is me', '', 12, '2025-01-02 08:25:01', '2025-01-02 14:55:01'),
(25, 'Hello Sweet Heart', 'Ada Wong.jpg', 13, '2025-01-02 08:30:00', '2025-01-02 15:00:00'),
(26, 'The need', 'Melhores Perfumes Masculinos.jpg', 10, '2025-01-02 08:33:13', '2025-01-02 15:03:13'),
(28, 'new year chilling', 'download.jpg', 11, '2025-01-02 08:36:30', '2025-01-02 15:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` text NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `profile_picture`, `role`) VALUES
(10, 'Hurricane', 'hurricane2@gmail.com', '$2y$10$hrRaNEHG6H1CyN1lTnggtOrTz1hctmf3wJwzUJgWnDcpMqhPwsijO', '2025-01-02 08:15:07', 'Yukimiya Kenyu.jpg', 0),
(11, 'Htet Aung Lwin', 'htetaunglwin1@gmail.com', '$2y$10$P5lknqim3SmNjMbv4oKZxOH3PI/FWpYSxDJ74ksTJl6DO/OQLSfR.', '2025-01-02 08:17:16', 'itoshi sae.jpg', 0),
(12, 'Gojo Satoru', 'gojo69@gmail.com', '$2y$10$rcfep0uC3FS0Ct56MipU9O2t/zr6cVZ2o2o6yXSHXN5FfTSt5J8Ka', '2025-01-02 08:20:55', 'gojo.jpg', 0),
(13, 'Ada Wong', 'ada5@gmail.com', '$2y$10$KYl..QKlRDnYF/yenl20x.W4kRDBySb51xJCyKY3MFd78DU83Q1gi', '2025-01-02 08:25:40', 'ada.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
