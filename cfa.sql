-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2018 at 11:12 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cfa`
--
CREATE DATABASE IF NOT EXISTS `cfa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cfa`;

-- --------------------------------------------------------

--
-- Table structure for table `calculate`
--

DROP TABLE IF EXISTS `calculate`;
CREATE TABLE IF NOT EXISTS `calculate` (
  `calculate_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `water` double NOT NULL,
  `electricity` double NOT NULL,
  `gas` double NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`calculate_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calculate`
--

INSERT INTO `calculate` (`calculate_id`, `user_id`, `water`, `electricity`, `gas`, `date`) VALUES
(1, 5, 133.6, 90, 21.168, 'January 2017'),
(2, 5, 200.4, 180, 10.584, 'February 2017'),
(3, 5, 167, 156, 14.112, 'March 2017'),
(4, 5, 153.64, 144.6, 14.112, 'April 2017'),
(5, 5, 100.2, 49.2, 10.584, 'May 2017'),
(6, 5, 113.56, 144.6, 14.112, 'June 2017'),
(7, 5, 80.16, 150, 24.696, 'July 2017'),
(8, 5, 93.52, 120, 10.584, 'August 2017'),
(9, 5, 153.64, 126, 17.64, 'September 2017'),
(11, 5, 120.24, 102, 21.168, 'October 2017'),
(12, 5, 106.88, 126, 8.4672, 'November 2017'),
(13, 5, 66.8, 90, 24.696, 'December 2017'),
(14, 7, 66.8, 120, 21.168, 'January 2018'),
(15, 5, 133.6, 60, 21.168, 'September 2018');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `age` varchar(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `profile_image` varchar(255) NOT NULL DEFAULT 'noimage.jpg',
  `password` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `age`, `username`, `email`, `address`, `phone`, `profile_image`, `password`, `register_date`) VALUES
(5, 'Haimanul Iman', '22', 'iman', 'hibur95@gmail.com', 'Kolej Canselor, UPM', '0123456789', 'batman.jpg', '202cb962ac59075b964b07152d234b70', '2017-11-16 19:51:51'),
(7, 'Yusmadi Yah Jusoh', '', 'yusmadi', 'yusmadi@gmail.com', '', '', 'noimage.jpg', '202cb962ac59075b964b07152d234b70', '2018-01-11 17:17:33'),
(8, 'Tester', '', 'test', 'test@gmail.com', '', '', 'noimage.jpg', '202cb962ac59075b964b07152d234b70', '2018-01-23 03:21:54');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calculate`
--
ALTER TABLE `calculate`
  ADD CONSTRAINT `calculate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
