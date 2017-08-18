-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2017 at 08:23 PM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
