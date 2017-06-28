-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2017 at 02:35 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `technofarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE IF NOT EXISTS `contracts` (
  `contract_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('rent','ownership') COLLATE utf8_bin NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `rent` decimal(13,2) DEFAULT NULL,
  `price` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`contract_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`contract_id`, `type`, `start_date`, `end_date`, `rent`, `price`) VALUES
(1, 'rent', '2017-06-26', '2018-06-25', '100.00', '0.00'),
(3, 'ownership', '2017-06-01', '2017-06-01', '0.00', '1000.00'),
(4, 'ownership', '2017-06-27', '2017-06-27', '0.00', '1000.00'),
(5, 'rent', '2017-06-01', '2018-06-01', '41.00', '0.00'),
(6, 'rent', '2014-06-30', '2016-06-30', '65.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `contract_property`
--

CREATE TABLE IF NOT EXISTS `contract_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ctr_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=22 ;

--
-- Dumping data for table `contract_property`
--

INSERT INTO `contract_property` (`id`, `ctr_id`, `property_id`) VALUES
(1, 1, 1343),
(3, 1, 2411),
(7, 3, 3111),
(8, 3, 4515),
(9, 4, 1536),
(10, 5, 1538),
(11, 3, 2113),
(18, 5, 1553),
(20, 5, 1515),
(21, 6, 1517);

-- --------------------------------------------------------

--
-- Table structure for table `ouner`
--

CREATE TABLE IF NOT EXISTS `ouner` (
  `ouner_id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `egn` varchar(8) COLLATE utf8_bin NOT NULL,
  `phone` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ouner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ouner`
--

INSERT INTO `ouner` (`ouner_id`, `name`, `egn`, `phone`) VALUES
(1, 'Камен Влахов', '84121221', '08888888'),
(2, 'Иван Шишман', '84212121', '08888');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unic_id` int(11) NOT NULL,
  `area` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=33 ;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `unic_id`, `area`) VALUES
(14, 1234, '12'),
(16, 2411, '20'),
(17, 3111, '20'),
(18, 4515, '10'),
(19, 1536, '10'),
(20, 1538, '40'),
(21, 2113, '12'),
(23, 1516, '10'),
(28, 1553, '53'),
(31, 1515, '5'),
(32, 1517, '20');

-- --------------------------------------------------------

--
-- Table structure for table `property_ouner`
--

CREATE TABLE IF NOT EXISTS `property_ouner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `ouner_id` int(11) NOT NULL,
  `part` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `property_ouner`
--

INSERT INTO `property_ouner` (`id`, `property_id`, `ouner_id`, `part`) VALUES
(1, 1234, 1, '50'),
(2, 1234, 2, '50'),
(3, 1553, 1, '50'),
(5, 1515, 2, '50'),
(6, 1517, 2, '30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
