-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2021 at 04:24 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collaborations`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `text` varchar(5000) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(20) NOT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- Table structure for table `product_backlog`
--

CREATE TABLE `product_backlog` (
  `product_backlog_id` int(11) NOT NULL,
  `product_item` varchar(225) NOT NULL,
  `product_task` varchar(225) NOT NULL,
  `criteria` varchar(225) NOT NULL,
  `effort` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_backlog`
--

INSERT INTO `product_backlog` (`product_backlog_id`, `product_item`, `product_task`, `criteria`, `effort`) VALUES
(3, 'grade', 'user can grade themselves', 'it must be tested', 'smal'),
(4, 'report', 'student can report', 'it must be tested', 'smal'),
(5, 'submit', 'have a submit buton', 'it must be tested', 'smal'),
(6, 'marketing', 'a user must have a marketing tool', 'it must be tested', 'smal'),
(7, 'marking', 'as a user', 'input', 's'),
(8, 'access', 'admin should have access to users page', 'it must be tested', 'smal'),
(29, 'movie', '', '', ''),
(30, 'name', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sprint_backlog`
--

CREATE TABLE `sprint_backlog` (
  `sprint_id` int(11) NOT NULL,
  `sprint_activities` varchar(225) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `team_users`
--

CREATE TABLE `team_users` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(225) NOT NULL,
  `LastName` varchar(225) NOT NULL,
  `email_address` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `team_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_users`
--

INSERT INTO `team_users` (`ID`, `FirstName`, `LastName`, `email_address`, `password`, `team_name`) VALUES
(11, 'Olivia', 'Atkinson', 'o.atkinson@rgu.ac.uk', '123456', 'c'),
(12, 'Onyinye', 'Iloanugo', 'o.iloanugo@rgu.ac.uk', '123456', 'c'),
(13, 'Darlington', 'Uzor', 'd.uzor@rgu.ac.uk', '123456', 'c'),
(14, 'francis', 'ogundiran', 'f.ogundiran@rgu.ac.uk', '123456', 'c'),
(15, 'chukwuka', 'chukwudi', 'c.chukwudi@rgu.ac.uk', '123456', 'c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--

--
-- Indexes for table `product_backlog`
--
ALTER TABLE `product_backlog`
  ADD PRIMARY KEY (`product_backlog_id`);

--
-- Indexes for table `sprint_backlog`
--
ALTER TABLE `sprint_backlog`
  ADD PRIMARY KEY (`sprint_id`);

--
-- Indexes for table `team_users`
--
ALTER TABLE `team_users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product_backlog`
--
ALTER TABLE `product_backlog`
  MODIFY `product_backlog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sprint_backlog`
--
ALTER TABLE `sprint_backlog`
  MODIFY `sprint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_users`
--
ALTER TABLE `team_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
