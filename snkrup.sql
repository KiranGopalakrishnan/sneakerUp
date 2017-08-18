-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 02:33 PM
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
  `raffleID` int(11) NOT NULL AUTO_INCREMENT,
  `shoeName` varchar(50) NOT NULL,
  `shoeDescription` mediumtext NOT NULL,
  `price` varchar(5) NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`raffleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shoecolors`
--

CREATE TABLE IF NOT EXISTS `shoecolors` (
  `colorID` int(10) NOT NULL AUTO_INCREMENT,
  `raffleID` int(10) NOT NULL,
  `Name` varchar(20) NOT NULL,
  PRIMARY KEY (`colorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shoesizes`
--

CREATE TABLE IF NOT EXISTS `shoesizes` (
  `sizeId` int(2) NOT NULL AUTO_INCREMENT,
  `raffleID` int(10) NOT NULL,
  `sizeValue` varchar(10) NOT NULL,
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
  `Firstname` varchar(25) NOT NULL,
  `Lastname` varchar(25) NOT NULL,
  `buyerEmail` varchar(50) NOT NULL,
  `purchaseTime` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`ticketID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `soldtickets`
--

INSERT INTO `soldtickets` (`ticketID`, `raffleID`, `shoeSize`, `Firstname`, `Lastname`, `buyerEmail`, `purchaseTime`, `status`) VALUES
(1, 2, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 1),
(2, 2, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(3, 3, 'usM7', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(4, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(6, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(8, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(9, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(10, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(11, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(12, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(13, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(14, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(15, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(16, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(17, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(18, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(19, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(20, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(21, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(22, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(23, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(24, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(25, 3, 'USM6', 'Kiran', 'Gopal', 'test@paypal.com', '0000-00-00 00:00:00', 1),
(26, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(27, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(28, 3, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(30, 5, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 1),
(31, 5, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(32, 5, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 1),
(33, 5, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(34, 5, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(35, 5, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(36, 5, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(37, 5, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 1),
(38, 5, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(39, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(40, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(41, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(42, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(43, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(44, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(45, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(46, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(47, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(48, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(49, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(50, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(51, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(52, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(53, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(54, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(55, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(56, 4, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(58, 7, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(59, 14, 'USM6', 'Kiran', 'Gopal', 'test@paypal.com', '0000-00-00 00:00:00', 1),
(60, 14, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(61, 14, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(62, 14, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(63, 14, 'USM6', '', '', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(64, 14, 'USM6', 'Dorvil', 'Simon', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(65, 14, 'USM6', 'Dorvil', 'Simon', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(66, 14, 'USM6', 'Dorvil', 'Simon', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(67, 14, 'USM6', 'Dorvil', 'Simon', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(68, 14, 'USM6', 'Dorvil', 'Simon', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(69, 14, 'USM6', 'Dorvil', 'Simon', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(70, 14, 'USM6', 'Dorvil', 'Simon', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(71, 14, 'USM6', 'Dorvil', 'Simon', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(72, 14, 'USM6', 'Dorvil', 'Simon', 'test@paypal.com', '0000-00-00 00:00:00', 0),
(73, 14, 'USM6', 'Dorvil', 'Simon', 'test@paypal.com', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `winnerdata`
--

CREATE TABLE IF NOT EXISTS `winnerdata` (
  `winnerID` int(11) NOT NULL AUTO_INCREMENT,
  `ticketID` int(11) NOT NULL,
  `isImagePresent` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `instagramLink` varchar(50) DEFAULT NULL,
  `Location` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`winnerID`),
  UNIQUE KEY `ticketID` (`ticketID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `winnerdata`
--
ALTER TABLE `winnerdata`
  ADD CONSTRAINT `winnerdata_ibfk_1` FOREIGN KEY (`ticketID`) REFERENCES `soldtickets` (`ticketID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
