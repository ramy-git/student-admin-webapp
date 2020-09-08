-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2020 at 07:14 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `created_at`) VALUES
(1, 'First Year 1', '');

-- --------------------------------------------------------

--
-- Table structure for table `class_group`
--

CREATE TABLE `class_group` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `name` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class_group`
--

INSERT INTO `class_group` (`id`, `class_id`, `name`, `created_at`) VALUES
(1, 1, 'A1', '2020-03-31 15:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL DEFAULT 'teacher',
  `image` varchar(1000) NOT NULL,
  `class_group` int(250) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `verify` int(11) NOT NULL,
  `updated_at` varchar(250) NOT NULL,
  `created_at` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `name`, `surname`, `email`, `password`, `type`, `image`, `class_group`, `student_id`, `phone`, `verify`, `updated_at`, `created_at`) VALUES
(1, 'Admin', 'c', 'admin@gmail.com', '12345', 'admin', '1585661991.jpg', 0, '', '', 0, '2020-03-31 19:09:53', ''),
(2, 'USER', 'c', 'user@gmail.com', '12345', 'teacher', '1585661960.jpg', 0, '', '', 0, '2020-03-31 19:14:27', ''),
(3, 'The', 'Rock', 'som@mailinator.com', '12345', 'student', '1585638337.jpg', 0, '125888', '0000000000', 0, '', ''),
(4, 'Drupal', 'V', 'max@mailinator.com', '12345', 'student', '1585646971.jpg', 1, '125888', '0000000000', 1, '2020-03-31 19:25:25', ''),
(5, 'Joe', 'Doea', 'som1288@mailinator.com', '12345', 'student', '1585659577.jpg', 1, '125888c', '5545651', 1, '2020-03-31 18:31:13', ''),
(6, 'Teacher 1  ', 'CC', 'teacher1288@mailinator.com', '12345', 'teacher', '1585662735.jpg', 0, '', '', 0, '2020-03-31 19:22:16', '2020-03-31 19:22:16'),
(7, 'rrgs', 'aa', 'rrgs1288@mailinator.com', '12345', 'student', '1585670437.jpg', 1, '125888aa', '0000000000', 0, '2020-03-31 21:30:39', '2020-03-31 21:30:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_group`
--
ALTER TABLE `class_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_group`
--
ALTER TABLE `class_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
