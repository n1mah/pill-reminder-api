-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 23, 2022 at 08:00 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pillremind`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_user_added` int(11) NOT NULL DEFAULT '0',
  `title` varchar(127) NOT NULL,
  `nameFa` varchar(127) DEFAULT NULL,
  `nameEn` varchar(127) DEFAULT NULL,
  `drugInteractions` text,
  `descriptionDosage` text,
  `dose` varchar(127) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `id_type`, `id_user_added`, `title`, `nameFa`, `nameEn`, `drugInteractions`, `descriptionDosage`, `dose`) VALUES
(1, 1, 1, 'test', NULL, NULL, NULL, NULL, NULL),
(2, 1, 1, 'test2', NULL, NULL, NULL, NULL, NULL),
(3, 1, 1, 'test3', 'a1', 'b1', 'c1', 'd1', 'e1');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `title` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `title`) VALUES
(1, 'قرص'),
(2, 'کپسول'),
(3, 'آمپول');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(127) NOT NULL,
  `lastName` varchar(127) NOT NULL,
  `level` int(2) NOT NULL DEFAULT '1',
  `isActive` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `level`, `isActive`) VALUES
(1, 'nima', 'alizade', 1, 1),
(3, 'a', 'a', 1, 1),
(4, 'ali', 'alizade', 1, 1),
(5, '', '', 1, 1),
(6, '', '', 1, 1),
(7, 'a ', 'b', 1, 1),
(10, 'rexs', 'fff', 1, 1),
(11, '', '', 1, 1),
(12, 'omid', 'omidi', 1, 1),
(13, '', '', 1, 1),
(14, 'omid', 'omidi', 1, 1),
(15, 'aaa', 'bbbb', 1, 1),
(16, 'ali', 'alizade', 1, 1),
(17, '', '', 1, 1),
(18, 'nima', 'Heidari', 1, 1),
(19, '', '', 1, 1),
(23, 'reza', 'rezaie', 1, 1),
(24, 'asd ', 'fff', 1, 1),
(25, 'reza', 'rezaie', 1, 1),
(26, '', 'rezaie', 1, 1),
(27, '', 'rezaie', 1, 1),
(28, 'asd ', 'fff', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_user_added` (`id_user_added`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
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
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
