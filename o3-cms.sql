-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2016 at 02:57 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `o3-cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_pages`
--

CREATE TABLE `o3_cms_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `template_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `can_be_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `deleted` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `o3_cms_pages`
--

INSERT INTO `o3_cms_pages` (`id`, `template_id`, `name`, `title`, `active`, `can_be_deleted`, `deleted`) VALUES
(1, 1, 'Frontpage', 'O3-CMS Frontpage', 1, 1, 0),
(2, 1, 'Contact', 'O3-CMS Contact', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_pages_url`
--

CREATE TABLE `o3_cms_pages_url` (
  `url` varchar(64) NOT NULL,
  `page_id` int(10) UNSIGNED DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `o3_cms_pages_url`
--

INSERT INTO `o3_cms_pages_url` (`url`, `page_id`, `timestamp`) VALUES
('/', 1, '2016-02-13 19:58:43'),
('/contact', 2, '2016-02-21 13:31:19'),
('/frontpage', 1, '2016-01-04 20:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_templates`
--

CREATE TABLE `o3_cms_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `system` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `styles` longtext NOT NULL,
  `deleted` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `o3_cms_templates`
--

INSERT INTO `o3_cms_templates` (`id`, `name`, `title`, `active`, `system`, `styles`, `deleted`) VALUES
(1, 'frontpage', 'Frontpage', 1, 0, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `o3_cms_pages`
--
ALTER TABLE `o3_cms_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`) USING BTREE,
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `can_be_deleted` (`can_be_deleted`) USING BTREE,
  ADD KEY `template_id` (`template_id`) USING BTREE;

--
-- Indexes for table `o3_cms_pages_url`
--
ALTER TABLE `o3_cms_pages_url`
  ADD UNIQUE KEY `url` (`url`),
  ADD KEY `timestamp` (`timestamp`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `o3_cms_templates`
--
ALTER TABLE `o3_cms_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `system` (`system`) USING BTREE,
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `o3_cms_pages`
--
ALTER TABLE `o3_cms_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `o3_cms_templates`
--
ALTER TABLE `o3_cms_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
