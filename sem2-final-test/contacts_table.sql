-- phpMyAdmin SQL Dump
-- version 4.1.14
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: March 01, 2024 at 06:41 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phone-book-management`
--

-- --------------------------------------------------------------

--
-- Table structure for table `contacts`
--
DROP TABLE `contacts`;
CREATE TABLE IF NOT EXIST `contacts` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `Name` varchar(100) NOT NULL,
    `Phone Number` varchar(10) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`ID`, `Name`, `Phone Number`) VALUES
(01, 'Marcus Rooney', '0124329823'),
(02, 'Harry Paul', '0492185642'),
(03, 'Vincent Arnold', '0324189123');

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;