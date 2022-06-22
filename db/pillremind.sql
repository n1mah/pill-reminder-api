-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 22, 2022 at 07:36 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pillremind`
--

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
(7, '', '', 1, 1),
(8, '', '', 1, 1),
(9, '', '', 1, 1),
(10, '', '', 1, 1),
(11, '', '', 1, 1),
(12, '', '', 1, 1),
(13, '', '', 1, 1),
(14, '', '', 1, 1),
(15, 'aaa', 'bbbb', 1, 1),
(16, 'ali', 'alizade', 1, 1),
(17, '', '', 1, 1),
(18, 'nima', 'Heidari', 1, 1),
(19, '', '', 1, 1),
(23, 'reza', 'rezaie', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;