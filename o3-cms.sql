-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2016 at 07:00 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `o3-cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_pages`
--

CREATE TABLE IF NOT EXISTS `o3_cms_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `can_be_deleted` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `deleted` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `deleted` (`deleted`),
  UNIQUE KEY `active` (`active`),
  KEY `template_id` (`template_id`),
  KEY `can_be_deleted` (`can_be_deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `o3_cms_pages`
--

INSERT INTO `o3_cms_pages` (`id`, `template_id`, `name`, `title`, `active`, `can_be_deleted`, `deleted`) VALUES
(1, 1, 'Frontpage', '', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_pages_url`
--

CREATE TABLE IF NOT EXISTS `o3_cms_pages_url` (
  `url` varchar(64) NOT NULL,
  `page_id` int(10) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `url` (`url`),
  KEY `timestamp` (`timestamp`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `o3_cms_pages_url`
--

INSERT INTO `o3_cms_pages_url` (`url`, `page_id`, `timestamp`) VALUES
('/', 1, '2016-02-13 19:58:43'),
('/frontpage', 1, '2016-01-04 20:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_templates`
--

CREATE TABLE IF NOT EXISTS `o3_cms_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `styles` longtext NOT NULL,
  `deleted` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `active` (`active`),
  UNIQUE KEY `system` (`system`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `o3_cms_templates`
--

INSERT INTO `o3_cms_templates` (`id`, `name`, `file`, `active`, `system`, `styles`, `deleted`) VALUES
(1, 'Frontpage', '', 0, 0, '', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `o3_cms_pages`
--
ALTER TABLE `o3_cms_pages`
  ADD CONSTRAINT `o3_cms_pages_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `o3_cms_templates` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `o3_cms_pages_url`
--
ALTER TABLE `o3_cms_pages_url`
  ADD CONSTRAINT `o3_cms_pages_url_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `o3_cms_pages` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
