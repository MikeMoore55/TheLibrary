-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2022 at 02:38 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thelibrary_db`
--
DROP DATABASE IF EXISTS `thelibrary_db`;
CREATE DATABASE IF NOT EXISTS `thelibrary_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `thelibrary_db`;

-- --------------------------------------------------------

--
-- Table structure for table `authors_books`
--
/* uses inner join */
CREATE TABLE `authors_books` (
  `book_author` varchar(200) NOT NULL,
  `book_name` varchar(250) NOT NULL,
  `book_genre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors_books`
--

INSERT INTO `authors_books` (`book_author`, `book_name`, `book_genre`) VALUES
('James Clear', 'Atomic Habits', 'Self-Help'),
('Robert Kiyosaki', 'Rich Dad Poor Dad', 'financial education'),
('Napolean Hill', 'Think and Grow Rich', 'Finance & Self-Help'),
('Robert Kiyosaki', 'FAKE', 'financial education'),
('Robert Kiyosaki', 'Why the Rich are getting Richer', 'financial education');

-- --------------------------------------------------------

--
-- Table structure for table `author_info`
--

CREATE TABLE `author_info` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author_info`
--

INSERT INTO `author_info` (`author_id`, `author_name`, `author_age`) VALUES
(1, 'James Clear', 36),
(2, 'Robert KiyoSaki', 81),
(3, 'Napolean Hill', 87);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(250) NOT NULL,
  `book_author` varchar(200) NOT NULL,
  `book_year` year(4) NOT NULL,
  `book_genre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `book_author`, `book_year`, `book_genre`) VALUES
(1, 'Atomic Habits', 'James Clear', 2013, 'Self-Help'),
(2, 'Rich Dad Poor Dad', 'Robert Kiyosaki', 1997, 'financial education'),
(3, 'Think and Grow Rich', 'Napolean Hill', 1937, 'Finance & Self-Help'),
(4, 'FAKE', 'Robert Kiyosaki', 2017, 'financial education'),
(5, 'Why the Rich are getting Richer', 'Robert Kiyosaki', 2001, 'financial education');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `user_age` int(11) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `username`, `user_age`, `user_password`, `user_type`) VALUES
(1, 'MainLibrarian1', 17, 'Library123', 'librarian');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author_info`
--
ALTER TABLE `author_info`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `book_name` (`book_name`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `user_password` (`user_password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author_info`
--
ALTER TABLE `author_info`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
