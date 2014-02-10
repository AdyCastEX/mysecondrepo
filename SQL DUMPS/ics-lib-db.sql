-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2014 at 11:10 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ics-lib-db`
--
CREATE DATABASE IF NOT EXISTS `ics-lib-db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ics-lib-db`;

-- --------------------------------------------------------

--
-- Table structure for table `account_history`
--

CREATE TABLE IF NOT EXISTS `account_history` (
  `username_user` varchar(18) NOT NULL,
  `username_admin` varchar(18) NOT NULL,
  `email` varchar(24) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` enum('enable','disable','activate') NOT NULL,
  PRIMARY KEY (`username_user`,`username_admin`,`email`),
  KEY `account_history_username_admin` (`username_admin`),
  KEY `account_history_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `name_first` varchar(24) NOT NULL,
  `name_middle` varchar(24) NOT NULL,
  `name_last` varchar(24) NOT NULL,
  `username` varchar(18) NOT NULL,
  `password` varchar(18) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `book_no` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`book_no`,`name`),
  KEY `book_no` (`book_no`),
  KEY `book_no_2` (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`book_no`, `name`) VALUES
('AB 1234', 'Maila Medina'),
('CD 4321', 'Ysa Angeles'),
('EF 5678', 'Rey Benedicto'),
('GH 8765', 'Yay Sabado'),
('IJ 1357', 'Paulo Cuenca'),
('KL 2468', 'Kim Samaniego');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_no` varchar(12) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `status` enum('available','borrowed','reserved') NOT NULL DEFAULT 'available',
  `description` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `date_published` date DEFAULT NULL,
  `Tags` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_no`, `book_title`, `status`, `description`, `publisher`, `date_published`, `Tags`) VALUES
('AB 1234', 'Merry Christmas', 'available', 'Happy New Yeare', 'Santa Claus', '2014-01-18', NULL),
('CD 4321', 'How To Program in Java', 'reserved', 'Search Google Chrome', 'Not A Programmer', '2014-01-01', NULL),
('EF 5678', 'How To Kill Spiders', 'borrowed', 'Shoe', 'Microsoft', '2013-08-06', NULL),
('GH 8765', 'Sleeping in Class Tips', 'available', 'Sleep peacefully while in Class', 'Rey Benedicto', '2014-04-18', NULL),
('IJ 1357', 'French Fries from Potatoes', 'reserved', 'Learn how to eat potatoes', 'McDo', '2013-09-17', NULL),
('KL 2468', 'Cram Efficiently', 'available', 'Learn how to waste time then cram', 'Rey Benedicto', '2012-11-06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `username` varchar(18) NOT NULL,
  `book_no` varchar(12) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`book_no`),
  KEY `favorites_book_no` (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lend`
--

CREATE TABLE IF NOT EXISTS `lend` (
  `transaction_no` int(8) NOT NULL AUTO_INCREMENT,
  `book_no` varchar(12) NOT NULL,
  `username_user` varchar(18) NOT NULL,
  `email` varchar(18) NOT NULL,
  `date_borrowed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_returned` timestamp NULL DEFAULT NULL,
  `username_admin` varchar(18) NOT NULL,
  PRIMARY KEY (`transaction_no`,`book_no`,`username_user`,`email`,`username_admin`),
  KEY `lend_book_no` (`book_no`),
  KEY `lend_username_user` (`username_user`),
  KEY `lend_email` (`email`),
  KEY `lend_username_admin` (`username_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username_admin` varchar(18) NOT NULL,
  `username_user` varchar(18) NOT NULL,
  `book_no` varchar(12) NOT NULL,
  `message` varchar(755) NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` enum('overdue','claim','custom') NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`username_admin`,`username_user`,`book_no`),
  KEY `notifications_username_user` (`username_admin`),
  KEY `notifications_username_admin` (`username_user`),
  KEY `notifications_book_no` (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `our`
--

CREATE TABLE IF NOT EXISTS `our` (
  `student_no` varchar(10) NOT NULL,
  `name_first` varchar(24) NOT NULL,
  `name_middle` varchar(24) NOT NULL,
  `name_last` varchar(24) NOT NULL,
  PRIMARY KEY (`student_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reserves`
--

CREATE TABLE IF NOT EXISTS `reserves` (
  `book_no` varchar(12) NOT NULL,
  `username` varchar(18) NOT NULL,
  `email` varchar(24) NOT NULL,
  `date_reserved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rank` smallint(6) NOT NULL,
  PRIMARY KEY (`book_no`,`username`,`email`),
  KEY `reserves_username` (`username`),
  KEY `reserves_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(18) NOT NULL,
  `password` varchar(18) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `status` enum('enabled','disabled','pending') NOT NULL DEFAULT 'pending',
  `email` varchar(55) NOT NULL,
  `usertype` enum('student','employee') NOT NULL,
  `emp_no` varchar(12) DEFAULT NULL,
  `student_no` varchar(10) DEFAULT NULL,
  `name_first` varchar(24) NOT NULL,
  `name_middle` varchar(24) NOT NULL,
  `name_last` varchar(24) NOT NULL,
  `mobile_no` int(12) DEFAULT NULL,
  `course` varchar(8) DEFAULT NULL,
  `college` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`username`,`email`),
  UNIQUE KEY `emp_no` (`emp_no`,`student_no`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_history`
--
ALTER TABLE `account_history`
  ADD CONSTRAINT `account_history_email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `account_history_username_admin` FOREIGN KEY (`username_admin`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `account_history_username_user` FOREIGN KEY (`username_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `favorites_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `lend`
--
ALTER TABLE `lend`
  ADD CONSTRAINT `lend_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `lend_email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `lend_username_admin` FOREIGN KEY (`username_admin`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `lend_username_user` FOREIGN KEY (`username_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `notifications_username_admin` FOREIGN KEY (`username_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `notifications_username_user` FOREIGN KEY (`username_admin`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `reserves`
--
ALTER TABLE `reserves`
  ADD CONSTRAINT `reserves_book_no` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserves_email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reserves_username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
