-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2021 at 02:58 PM
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
(48, 'marketing', 'as a user i want to .....', 'test properly', 'M'),
(49, 'grade', 'as a user i want ....', 'test properly', 'L'),
(50, 'SIGN OUT', '', '', ''),
(51, 'log out', '', '', ''),
(52, 'happy', '', '', ''),
(53, 'goal', '', '', ''),
(54, 'sad', '', '', ''),
(55, 'yes', '', '', ''),
(56, 'test', '', '', ''),
(57, 'market', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task` varchar(225) NOT NULL,
  `task_start` date NOT NULL,
  `task_end` date NOT NULL,
  `is_completed` enum('yes','no','maybe') DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `task_start`, `task_end`, `is_completed`, `assigned_to`) VALUES
(24, 'html', '2021-03-04', '2021-03-13', 'no', 12),
(25, 'css', '2021-03-05', '2021-03-13', 'no', 11),
(26, 'css', '2021-03-05', '2021-03-13', 'yes', 11),
(27, 'css', '2021-03-05', '2021-03-13', 'no', 13),
(29, 'css', '2021-03-05', '2021-03-13', 'yes', 12),
(30, 'css', '2021-03-05', '2021-03-13', 'no', NULL),
(31, 'css', '2021-03-05', '2021-03-13', 'no', NULL),
(32, 'css', '2021-03-05', '2021-03-13', 'no', NULL),
(33, 'css', '2021-03-05', '2021-03-13', 'no', NULL),
(34, 'css', '2021-03-05', '2021-03-13', 'no', NULL),
(35, 'javascript', '2021-03-04', '2021-03-11', 'no', 13),
(36, 'move', '2021-03-12', '2021-03-20', 'no', 15);

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
(15, 'chukwuka', 'chukwudi', 'c.chukwudi@rgu.ac.uk', '123456', 'c'),
(29, 'admin', 'admin', 'admin@rgu.ac.uk', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `product_backlog`
--
ALTER TABLE `product_backlog`
  ADD PRIMARY KEY (`product_backlog_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_to`);

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
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_backlog`
--
ALTER TABLE `product_backlog`
  MODIFY `product_backlog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `team_users`
--
ALTER TABLE `team_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `team_users` (`ID`);
COMMIT;

ALTER TABLE `chat`
    MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;