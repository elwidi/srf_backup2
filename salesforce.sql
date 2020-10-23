-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 30, 2018 at 02:46 AM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salesforce`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `activitytype_id` int(10) UNSIGNED NOT NULL,
  `workflow_id` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_date` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activity_activitytype1_idx` (`activitytype_id`),
  KEY `fk_activity_customer1_idx` (`customer_id`),
  KEY `fk_activity_workflow1_idx` (`workflow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `activitytype`
--

DROP TABLE IF EXISTS `activitytype`;
CREATE TABLE IF NOT EXISTS `activitytype` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `created_date` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customer_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `user_id`, `name`, `telephone`, `address`, `created_date`) VALUES
(1, 3, 'Halwan', '087770927761', 'Magetan', '2018-07-26 20:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_no` varchar(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_no`, `name`) VALUES
(1, '000', 'Root'),
(2, '123', 'Kardiwan'),
(3, '111', 'Abdul Akbar Aziz');

-- --------------------------------------------------------

--
-- Table structure for table `leveluser`
--

DROP TABLE IF EXISTS `leveluser`;
CREATE TABLE IF NOT EXISTS `leveluser` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leveluser`
--

INSERT INTO `leveluser` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Supervisor'),
(3, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_sales` int(10) UNSIGNED NOT NULL,
  `user_supervisor` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_date` timestamp NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_note_user1_idx` (`user_sales`),
  KEY `fk_note_user2_idx` (`user_supervisor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `workflow_id` int(10) UNSIGNED NOT NULL,
  `created_date` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stages_customer1_idx` (`customer_id`),
  KEY `fk_stages_workflow1_idx` (`workflow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `customer_id`, `workflow_id`, `created_date`) VALUES
(1, 1, 1, '2018-07-26 20:04:39'),
(2, 1, 2, '2018-07-27 03:33:50'),
(3, 1, 2, '2018-07-27 03:34:53'),
(4, 1, 5, '2018-07-27 03:38:55'),
(5, 1, 2, '2018-07-27 03:39:40'),
(6, 1, 4, '2018-07-27 03:39:48'),
(7, 1, 1, '2018-07-27 03:40:00'),
(8, 1, 5, '2018-07-27 03:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `leveluser_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `supervisor_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_employee1_idx` (`employee_id`),
  KEY `fk_user_leveluser1_idx` (`leveluser_id`),
  KEY `fk_user_employee2_idx` (`supervisor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `employee_id`, `leveluser_id`, `email`, `password`, `active`, `supervisor_id`) VALUES
(1, 1, 1, 'javaziez@gmail.com', 'c6f057b86584942e415435ffb1fa93d4', 1, NULL),
(2, 2, 2, 'kardiwan@moratelindo.co.id', '202cb962ac59075b964b07152d234b70', 1, NULL),
(3, 3, 3, 'akbar.aziz@moratelindo.co.id', '698d51a19d8a121ce581499d7b701668', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `workflow`
--

DROP TABLE IF EXISTS `workflow`;
CREATE TABLE IF NOT EXISTS `workflow` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `order` tinyint(4) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workflow`
--

INSERT INTO `workflow` (`id`, `name`, `order`, `active`) VALUES
(1, 'Canvasing', 1, 1),
(2, 'Prospect', 2, 1),
(3, 'Negotiation', 3, 1),
(4, 'Registration', 4, 1),
(5, 'Berita Acara', 5, 1),
(6, 'Close', 6, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `fk_activity_activitytype1` FOREIGN KEY (`activitytype_id`) REFERENCES `activitytype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_activity_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_activity_workflow1` FOREIGN KEY (`workflow_id`) REFERENCES `workflow` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk_note_user1` FOREIGN KEY (`user_sales`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_note_user2` FOREIGN KEY (`user_supervisor`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `fk_stages_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_stages_workflow1` FOREIGN KEY (`workflow_id`) REFERENCES `workflow` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_employee1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_employee2` FOREIGN KEY (`supervisor_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_leveluser1` FOREIGN KEY (`leveluser_id`) REFERENCES `leveluser` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
