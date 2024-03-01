-- phpMyAdmin SQL Dump
-- version 4.1.14
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: January 31, 2024 at 06:17 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asm`
--

-- --------------------------------------------------------------

--
-- Table structure for table `students`
--
DROP TABLE `students`;
CREATE TABLE IF NOT EXISTS `students` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(20) NOT NULL,
    `status` varchar(11) NOT NULL,
    `phone` varchar(10) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `status`, `phone`) VALUES
(801, 'Nguyen Van A', 'nguyenvana@gmail.com', 'Active', '09874237'),
(802, 'Pham Van B', 'phamvanb@gmail.com', 'Learning', '09273819'),
(803, 'Tran Van C', 'tranvanc@gmail.com', 'Inactive', '04217845'),
(804, 'Le Van D', 'levand@gmail.com', 'Blacklisted', '09812394'),
(805, 'Hoang Van E', 'hoangvane@gmail.com', 'Active', '08721391');

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
