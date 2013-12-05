-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2013 at 03:45 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mjr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`) VALUES
(1, 'Mala'),
(2, 'Ring');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE IF NOT EXISTS `tbl_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_feedback`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `weight` float NOT NULL,
  `description` text NOT NULL,
  `image_path` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_category_id` (`sub_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `sub_category_id`, `name`, `weight`, `description`, `image_path`) VALUES
(1, 1, 'Moti Mala 1', 45.6, 'sdfsdfs', 'MotiMala_45.6_17112013190850.jpg'),
(2, 1, 'Moti Mala - 2', 12.3, 'dfsdfsdsdf', 'MotiMala_12.3_17112013190949_1.jpg'),
(3, 1, 'Moti Mala - 3', 45.6, 'dfsdfsdsdf', 'MotiMala_45.6_17112013190949_2.jpg'),
(4, 1, 'Moti Mala - 4', 12.3, 'sdfsd', 'MotiMala_12.3_01122013182043_0.jpg'),
(5, 1, 'Moti Mala - 5', 45.6, 'sdfsd', 'MotiMala_45.6_01122013182043_1.jpg'),
(6, 1, 'Moti Mala - 6', 12.3, 'fdf', 'MotiMala_12.3_04122013002306_0.jpg'),
(7, 1, 'Moti Mala - 7', 45.6, 'fdf', 'MotiMala_45.6_04122013002306_1.jpg'),
(8, 2, 'Casting Ring - 8', 35.6, 'xvxc', 'CastingRing_35.6_04122013144801_0.jpg'),
(9, 2, 'Casting Ring - 9', 132.3, 'xvxc', 'CastingRing_132.3_04122013144802_1.jpg'),
(10, 3, 'Diamond Ring - 10', 102.02, 'sdee', 'DiamondRing_102.02_04122013145316_0.jpg'),
(11, 3, 'Diamond Ring - 11', 120.45, 'sdee', 'DiamondRing_120.45_04122013145316_1.jpg'),
(12, 3, 'Diamond Ring - 12', 12.3, 'dsd', 'DiamondRing_12.3_04122013204838_0.jpg'),
(13, 3, 'Diamond Ring - 13', 35.6, 'dsd', 'DiamondRing_35.6_04122013204838_1.jpg'),
(14, 3, 'Diamond Ring - 14', 45.6, 'dsd', 'DiamondRing_45.6_04122013204838_2.jpg'),
(15, 3, 'Diamond Ring - 15', 102.02, 'dsd', 'DiamondRing_102.02_04122013204839_3.jpg'),
(16, 3, 'Diamond Ring - 16', 120.45, 'dsd', 'DiamondRing_120.45_04122013204839_4.jpg'),
(17, 3, 'Diamond Ring - 17', 132.3, 'dsd', 'DiamondRing_132.3_04122013204839_5.jpg'),
(18, 4, 'Rudrax Mala - 18', 12.3, 'dfgdf', 'RudraxMala_12.3_04122013205008_0.jpg'),
(19, 4, 'Rudrax Mala - 19', 35.6, 'dfgdf', 'RudraxMala_35.6_04122013205009_1.jpg'),
(20, 4, 'Rudrax Mala - 20', 45.6, 'dfgdf', 'RudraxMala_45.6_04122013205009_2.jpg'),
(21, 4, 'Rudrax Mala - 21', 102.02, 'dfgdf', 'RudraxMala_102.02_04122013205009_3.jpg'),
(22, 4, 'Rudrax Mala - 22', 120.45, 'dfgdf', 'RudraxMala_120.45_04122013205009_4.jpg'),
(23, 4, 'Rudrax Mala - 23', 132.3, 'dfgdf', 'RudraxMala_132.3_04122013205010_5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_category`
--

CREATE TABLE IF NOT EXISTS `tbl_sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_sub_category`
--

INSERT INTO `tbl_sub_category` (`id`, `category_id`, `name`) VALUES
(1, 1, 'Moti Mala'),
(2, 2, 'Casting Ring'),
(3, 2, 'Diamond Ring'),
(4, 1, 'Rudrax Mala'),
(5, 1, 'Mix Mala');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` text NOT NULL,
  `contact_person` text NOT NULL,
  `email` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip_code` varchar(12) NOT NULL,
  `type` varchar(5) NOT NULL,
  `is_approve` char(1) NOT NULL DEFAULT '0',
  `random` text NOT NULL,
  `is_confirm` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `company_name`, `contact_person`, `email`, `password`, `contact_no`, `address`, `city`, `state`, `zip_code`, `type`, `is_approve`, `random`, `is_confirm`) VALUES
(1, '', '', 'mjr', 'mjr', '', '', '', '', '', 'admin', '0', '', ''),
(9, 'ram', 'ram', 'r', '4b43b0aee35624cd95b910189b3dc231', '1', '1', '1', '1', '1', 'user', '0', '', ''),
(10, 'a', 'a', 'a', '0cc175b9c0f1b6a831c399e269772661', 'a', 'a', 'a', 'a', 'a', 'user', '1', '', ''),
(11, 'kishan', 'kishan', 'patadiakishan@gmail.com', '202cb962ac59075b964b07152d234b70', '8460895048', 'fddq', 'raj', 'guj', '360002', 'user', '1', '', '0'),
(12, 'rr', 'ii', 'patadiakgishan@gmail.com', '202cb962ac59075b964b07152d234b70', '1', '11', '1', '1', '1', 'user', '1', 'fb87582825f9d28a8d42c5e5e5e8b23d', '0'),
(13, 'jk', 'jhjh', 'hjjk@gm.c', '202cb962ac59075b964b07152d234b70', 'jkhkj', 'hkjh', 'jkh', 'kjh', 'jkh', 'user', '0', 'f4667a2fccf527dad06cc706baf81a70', '0'),
(14, 'uhj', 'khjk', 'q@g.com', '202cb962ac59075b964b07152d234b70', 'jkhj', 'khjkh', 'jk', 'jkh', 'hjk', 'user', '0', 'a5e0ff62be0b08456fc7f1e88812af3d', '0');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`sub_category_id`) REFERENCES `tbl_sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sub_category`
--
ALTER TABLE `tbl_sub_category`
  ADD CONSTRAINT `tbl_sub_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
