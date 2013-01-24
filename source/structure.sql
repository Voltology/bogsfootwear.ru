-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 24, 2013 at 11:10 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bogsfootwear`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_genders`
--

CREATE TABLE `cart_genders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gender` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_groups`
--

CREATE TABLE `cart_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_inventory`
--

CREATE TABLE `cart_inventory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(40) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `color` varchar(16) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `group` varchar(30) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `size_1` int(11) DEFAULT NULL,
  `size_2` int(11) DEFAULT NULL,
  `size_3` int(11) DEFAULT NULL,
  `size_4` int(11) DEFAULT NULL,
  `size_5` int(11) DEFAULT NULL,
  `size_6` int(11) DEFAULT NULL,
  `size_7` int(11) DEFAULT NULL,
  `size_8` int(11) DEFAULT NULL,
  `size_9` int(11) DEFAULT NULL,
  `size_10` int(11) DEFAULT NULL,
  `size_11` int(11) DEFAULT NULL,
  `size_12` int(11) DEFAULT NULL,
  `size_13` int(11) DEFAULT NULL,
  `size_14` int(11) DEFAULT NULL,
  `size_15` int(11) DEFAULT NULL,
  `size_16` int(11) DEFAULT NULL,
  `size_17` int(11) DEFAULT NULL,
  `size_18` int(11) DEFAULT NULL,
  `size_19` int(11) DEFAULT NULL,
  `size_20` int(11) DEFAULT NULL,
  `size_21` int(11) DEFAULT NULL,
  `size_22` int(11) DEFAULT NULL,
  `size_s` int(11) DEFAULT NULL,
  `size_m` int(11) DEFAULT NULL,
  `size_l` int(11) DEFAULT NULL,
  `size_xl` int(11) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  `addedby` int(11) DEFAULT NULL,
  `last_modified` int(11) NOT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `sku` (`sku`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=331 ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_orders`
--

CREATE TABLE `cart_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_roles`
--

CREATE TABLE `cart_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_sessions`
--

CREATE TABLE `cart_sessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(255) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `size` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_users`
--

CREATE TABLE `cart_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `role` varchar(60) DEFAULT NULL,
  `lastlogin` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `ip` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;
