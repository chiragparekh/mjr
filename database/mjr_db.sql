-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2013 at 10:27 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `order_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `user_id`, `product_id`, `product_qty`, `product_desc`, `order_date`) VALUES
(8, 15, 34, 0, '', '2013-12-08'),
(9, 15, 33, 0, '', '2013-12-08');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `sub_category_id`, `name`, `weight`, `description`, `image_path`) VALUES
(24, 1, 'Motimala 1', 1, 'asdfsdf', 'MotiMala_1_06122013121712.jpg'),
(25, 1, 'MM2 Pro 2', 2, 'sdf', 'MotiMala_2_06122013121727.jpg'),
(26, 4, 'Rudrax Mala - 26', 1.1, 'Rundrax mala desc', 'RudraxMala_1.1_06122013122037_0.jpg'),
(27, 4, 'Rudrax Mala - 27', 1.2, 'Rundrax mala desc', 'RudraxMala_1.2_06122013122037_1.jpg'),
(28, 4, 'Rudrax Mala - 28', 2.1, 'Rundrax mala desc', 'RudraxMala_2.1_06122013122037_2.jpg'),
(29, 4, 'Rudrax Mala - 29', 3.9, 'Rundrax mala desc', 'RudraxMala_3.9_06122013122037_3.jpg'),
(30, 4, 'Rudrax Mala - 30', 4.1, 'Rundrax mala desc', 'RudraxMala_4.1_06122013122037_4.jpg'),
(31, 4, 'Rudrax Mala - 31', 4.2, 'Rundrax mala desc', 'RudraxMala_4.2_06122013122037_5.jpg'),
(32, 3, 'Diamond Ring - 32', 5, 'dr desc', 'DiamondRing_5_06122013122100_0.jpg'),
(33, 3, 'Diamond Ring - 33', 6.8, 'dr desc', 'DiamondRing_6.8_06122013122100_1.jpg'),
(34, 3, 'Diamond Ring - 34', 8.5, 'dr desc', 'DiamondRing_8.5_06122013122100_2.jpg'),
(35, 5, 'Mix Mala - 35', 10.2, 'sdfsadfsdf', 'MixMala_10.2_06122013122115_0.jpg'),
(36, 5, 'Mix Mala - 36', 11.12, 'sdfsadfsdf', 'MixMala_11.12_06122013122115_1.jpg'),
(37, 4, 'Rudrax Mala - 37', 8.5, 'new pro desc', 'RudraxMala_8.5_06122013122336_0.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

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
(14, 'uhj', 'khjk', 'q@g.com', '202cb962ac59075b964b07152d234b70', 'jkhj', 'khjkh', 'jk', 'jkh', 'hjk', 'user', '0', 'a5e0ff62be0b08456fc7f1e88812af3d', '0'),
(15, 'asdf', 'sdf', 'chiragparekhn@gmail.com', 'e3a214873911a417fe414006f0be1bb6', 'sdf', 'asdf', 'sf', 'asdf', 'sdf', 'user', '1', '996955c302d92b352f9e3638cd8bafe1', '0');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
