-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2017 at 08:24 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `snkrup`
--

-- --------------------------------------------------------

--
-- Table structure for table `raffles`
--

CREATE TABLE IF NOT EXISTS `raffles` (
  `raffleID` int(10) NOT NULL AUTO_INCREMENT,
  `shoeName` varchar(50) NOT NULL,
  `shoeDescription` mediumtext NOT NULL,
  `price` varchar(5) NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`raffleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `raffles`
--

INSERT INTO `raffles` (`raffleID`, `shoeName`, `shoeDescription`, `price`, `startTime`, `endTime`, `status`) VALUES
(2, 'lslasd', 'kkn', '34', '2017-02-26 07:39:00', '1899-11-23 00:00:00', 0),
(3, 'skdks', 'ljsdkljs', '23', '2017-02-02 00:00:00', '2017-02-26 12:00:00', 0),
(4, 'skdks', 'ljsdkljs', '23', '2017-02-27 19:46:00', '2017-03-30 12:05:00', 0),
(5, 'skdkssdsd', 'ljsdkljs', '23', '2017-02-28 00:00:00', '2017-02-27 19:47:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shoesizes`
--

CREATE TABLE IF NOT EXISTS `shoesizes` (
  `sizeId` int(2) NOT NULL AUTO_INCREMENT,
  `sizeValue` varchar(6) NOT NULL,
  PRIMARY KEY (`sizeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `soldtickets`
--

CREATE TABLE IF NOT EXISTS `soldtickets` (
  `ticketID` int(11) NOT NULL AUTO_INCREMENT,
  `raffleID` int(11) NOT NULL,
  `shoeSize` varchar(5) NOT NULL,
  `buyerName` varchar(50) NOT NULL,
  `buyerEmail` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`ticketID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `soldtickets`
--

INSERT INTO `soldtickets` (`ticketID`, `raffleID`, `shoeSize`, `buyerName`, `buyerEmail`, `status`) VALUES
(1, 2, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 1),
(2, 2, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(3, 3, 'usM7', 'SIMOND', 'test@paypal.com', 0),
(4, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(5, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(6, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(7, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(8, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(9, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(10, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(11, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(12, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(13, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(14, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(15, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(16, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(17, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(18, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(19, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(20, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(21, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(22, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(23, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 1),
(24, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(25, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(26, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(27, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(28, 3, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(29, 5, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 1),
(30, 5, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 1),
(31, 5, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(32, 5, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 1),
(33, 5, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(34, 5, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(35, 5, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(36, 5, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0),
(37, 5, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 1),
(38, 5, 'USM6', 'Kiran Gopalakrishnan', 'test@paypal.com', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
