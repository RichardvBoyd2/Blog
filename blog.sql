-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 16, 2019 at 11:10 PM
-- Server version: 5.7.24
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

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Category_id`, `Category_name`, `Created_date`, `Created_by`, `Active_flag`) VALUES
(1, 'Funny', '2019-04-27', 8, 'n'),
(2, 'Verse/Quote', '2019-04-27', 8, 'n'),
(3, 'Testing', '2019-05-01', 8, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comment_id` int(11) NOT NULL,
  `Post_id` int(11) NOT NULL,
  `Comment_text` varchar(1000) NOT NULL,
  `Posted_date` datetime NOT NULL,
  `Posted_by` int(11) NOT NULL,
  `Updated_date` date DEFAULT NULL,
  `Updated_by` int(11) DEFAULT NULL,
  `Deleted_flag` enum('y','n') DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_id`, `Post_id`, `Comment_text`, `Posted_date`, `Posted_by`, `Updated_date`, `Updated_by`, `Deleted_flag`) VALUES
(1, 30, 'Wow that\'s awesome that the new data handling is working for editing posts! And if you\'re seeing this then comments are working too!', '2019-05-08 16:57:49', 8, NULL, NULL, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `Post_id` int(11) NOT NULL,
  `Post_title` varchar(100) NOT NULL,
  `Category_id` int(11) DEFAULT NULL,
  `Post_content` longtext NOT NULL,
  `Posted_date` datetime NOT NULL,
  `Posted_by` int(11) DEFAULT NULL,
  `Updated_date` date DEFAULT NULL,
  `Updated_by` int(11) DEFAULT NULL,
  `Post_rating` float(10,3) NOT NULL DEFAULT '0.000',
  `Deleted_Flag` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`Post_id`, `Post_title`, `Category_id`, `Post_content`, `Posted_date`, `Posted_by`, `Updated_date`, `Updated_by`, `Post_rating`, `Deleted_Flag`) VALUES
(29, 'Editing titles works', 3, 'And editing the content works too!', '2019-04-26 23:18:13', 7, '2019-05-01', 8, 5.000, 'n'),
(30, 'Searching posts! *edited', 3, 'Searching for blog posts should be working now, I\'m adding this post so I can search for it after it\'s posted. If this works I\'ll be done with Milestone 7 already! This class is going great!\r\nThis is testing the editing form with the new data handling. I\'m hoping this will work.', '2019-05-07 19:57:58', 9, '2019-05-08', 8, 4.500, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `ID` int(11) NOT NULL,
  `Rating_value` float(10,3) NOT NULL,
  `Post_id` int(11) NOT NULL,
  `Rated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`ID`, `Rating_value`, `Post_id`, `Rated_by`) VALUES
(1, 4.000, 30, 8),
(2, 5.000, 30, 7),
(3, 5.000, 29, 7);

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
  `Updated_date` date DEFAULT NULL,
  `Updated_by` int(11) DEFAULT NULL,
  `Active_flag` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Role_id`, `Role_name`, `Role_description`, `Created_date`, `Created_by`, `Updated_date`, `Updated_by`, `Active_flag`) VALUES
(1, 'Administrator', 'Administrator of the website, allowed to tag and remove posts', '2019-04-27', 8, NULL, NULL, 'y'),
(2, 'Author', 'Writes Posts', '2019-04-30', 8, NULL, NULL, 'y'),
(3, 'Editor', 'Edits Post titles and content, add tags', '2019-04-30', 8, NULL, NULL, 'y'),
(4, 'Moderator', 'Delete Posts and Comments', '2019-04-30', 8, NULL, NULL, 'y'),
(5, 'Subscriber', 'Can view Posts, write comments', '2019-04-30', 8, NULL, NULL, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_id` int(11) NOT NULL,
  `User_name` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `User_role` int(11) NOT NULL DEFAULT '5',
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_id`, `User_name`, `Password`, `User_role`, `User_nickname`, `First_name`, `Middle_name`, `Last_name`, `Email1`, `Email2`, `Address1`, `Address2`, `City`, `State`, `Zipcode`, `Country`, `User_banned`, `User_deleted`) VALUES
(7, 'test', 'Testtest1', 5, 'FakeUser', 'Fake', '', 'User', 'example@email.com', '', '1001 S Fake St', 'Apt 5', 'Notreal', 'Testing', '55555', 'United States', 'n', 'n'),
(8, 'admin', 'Password1', 1, 'Admin', 'Ad', '', 'min', 'admin@blog.com', '', '', '', '', '', '', '', 'n', 'n'),
(9, 'testAuthor', 'Password1', 2, 'Author', 'Au', '', 'thor', 'author@blog.com', '', '', '', '', '', '', '', 'n', 'n'),
(10, 'testEditor', 'Password1', 3, 'editor', 'ed', '', 'itor', 'editor@blog.com', 'editor@email.com', '', '', '', '', '', '', 'n', 'n'),
(11, 'testModerator', 'Password1', 4, 'Moderator', 'Mod', '', 'erator', 'moderator@blog.com', '', '', '', '', '', '', '', 'n', 'n'),
(12, 'testPlan', 'Testplan1', 5, 'TestPlan', 'Test', '', 'Plan', 'testplan@blog.com', '', '', '', '', '', '', '', 'n', 'n');

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
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Post_id` (`Post_id`),
  ADD KEY `Rated_by` (`Rated_by`);

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
  MODIFY `Category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `Post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`Post_id`) REFERENCES `posts` (`Post_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`Rated_by`) REFERENCES `users` (`User_id`);

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
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`User_role`) REFERENCES `roles` (`Role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
