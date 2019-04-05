-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2019 at 01:34 AM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Category_id` int(11) NOT NULL,
  `Category_name` varchar(100) NOT NULL,
  `Created_date` date NOT NULL,
  `Created_by` int(11) NOT NULL,
  `Active_flag` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comment_id` int(11) NOT NULL,
  `Post_id` int(11) NOT NULL,
  `Comment_text` varchar(1000) NOT NULL,
  `Posted_date` date NOT NULL,
  `Posted_by` int(11) NOT NULL,
  `Updated_date` date NOT NULL,
  `Updated_by` int(11) NOT NULL,
  `Deleted_flag` enum('y','n') DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `Post_id` int(11) NOT NULL,
  `Post_title` varchar(100) NOT NULL,
  `Category_id` int(11) NOT NULL,
  `Post_content` varchar(1000) NOT NULL,
  `Posted_date` date NOT NULL,
  `Posted_by` int(11) NOT NULL,
  `Updated_date` date NOT NULL,
  `Updated_by` int(11) NOT NULL,
  `Deleted_Flag` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `Role_id` int(11) NOT NULL,
  `Role_name` varchar(100) NOT NULL,
  `Role_description` varchar(1000) NOT NULL,
  `Created_date` date NOT NULL,
  `Created_by` int(11) NOT NULL,
  `Updated_date` date NOT NULL,
  `Updated_by` int(11) NOT NULL,
  `Active_flag` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_id` int(11) NOT NULL,
  `User_name` varchar(100) NOT NULL,
  `User_role` int(11) DEFAULT NULL,
  `User_nickname` varchar(100) NOT NULL,
  `First_name` varchar(100) NOT NULL,
  `Middle_name` varchar(100) DEFAULT NULL,
  `Last_name` varchar(100) NOT NULL,
  `Email1` varchar(100) NOT NULL,
  `Email2` varchar(100) DEFAULT NULL,
  `Address1` varchar(100) DEFAULT NULL,
  `Address2` varchar(100) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `State` varchar(100) DEFAULT NULL,
  `Zipcode` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `User_banned` enum('y','n') NOT NULL DEFAULT 'n',
  `User_deleted` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Category_id`),
  ADD UNIQUE KEY `Category_name` (`Category_name`),
  ADD KEY `Created_by` (`Created_by`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_id`),
  ADD KEY `Post_id` (`Post_id`),
  ADD KEY `Posted_by` (`Posted_by`),
  ADD KEY `Updated_by` (`Updated_by`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`Post_id`),
  ADD UNIQUE KEY `Post_title` (`Post_title`),
  ADD KEY `Category_id` (`Category_id`),
  ADD KEY `Posted_by` (`Posted_by`),
  ADD KEY `Updated_by` (`Updated_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Role_id`),
  ADD UNIQUE KEY `Role_name` (`Role_name`),
  ADD KEY `Created_by` (`Created_by`),
  ADD KEY `Updated_by` (`Updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_id`),
  ADD UNIQUE KEY `User_name` (`User_name`),
  ADD UNIQUE KEY `User_nickname` (`User_nickname`),
  ADD UNIQUE KEY `Email1` (`Email1`),
  ADD KEY `User_role` (`User_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `Post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `Created_by` FOREIGN KEY (`Created_by`) REFERENCES `users` (`User_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Post_id` FOREIGN KEY (`Post_id`) REFERENCES `posts` (`Post_id`),
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`Posted_by`) REFERENCES `users` (`User_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`Updated_by`) REFERENCES `users` (`User_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `Category_id` FOREIGN KEY (`Category_id`) REFERENCES `categories` (`Category_id`),
  ADD CONSTRAINT `Posted_by` FOREIGN KEY (`Posted_by`) REFERENCES `users` (`User_id`),
  ADD CONSTRAINT `Updated_by` FOREIGN KEY (`Updated_by`) REFERENCES `users` (`User_id`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`Created_by`) REFERENCES `users` (`User_id`),
  ADD CONSTRAINT `roles_ibfk_2` FOREIGN KEY (`Updated_by`) REFERENCES `users` (`User_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `User_role` FOREIGN KEY (`User_role`) REFERENCES `roles` (`Role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
