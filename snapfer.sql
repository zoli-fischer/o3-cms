-- --------------------------------------------------------

--
-- Database: `snapfer`
--

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_menu_groups`
--

CREATE TABLE `o3_cms_menu_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `o3_cms_menu_groups`
--

INSERT INTO `o3_cms_menu_groups` (`id`, `name`) VALUES
(1, 'Main menu'),
(2, 'Footer menu'),
(3, 'Social menu');

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_menu_items`
--

CREATE TABLE `o3_cms_menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_danish_ci NOT NULL,
  `href` longtext COLLATE utf8_danish_ci NOT NULL,
  `target` varchar(255) COLLATE utf8_danish_ci NOT NULL,
  `attr_json` longtext COLLATE utf8_danish_ci NOT NULL,
  `priority` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `active` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `deleted` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `o3_cms_menu_items`
--

INSERT INTO `o3_cms_menu_items` (`id`, `group_id`, `title`, `href`, `target`, `attr_json`, `priority`, `active`, `deleted`) VALUES
(1, 1, 'Send files', '/#', '_parent', '', 3, 1, 0),
(2, 1, 'About', '/#about', '_parent', '', 2, 1, 0),
(3, 1, 'Premium', '/#premium', '_parent', '', 1, 1, 0),
(4, 2, 'Contact', '/contact', '_parent', '', 1, 1, 0),
(5, 2, 'Terms & Policies', '/terms-conditions-and-policies-of-use', '_parent', '', 2, 1, 0),
(6, 3, 'Facebook', 'javascript:alert(''Link to Facebook profile'')', '_parent', '{"class":"fa fa-facebook"}', 3, 1, 0),
(7, 3, 'Twitter', 'javascript:alert(''Link to Twitter profile'')', '_parent', '{"class":"fa fa-twitter"}', 2, 1, 0),
(8, 3, 'Google plus', 'javascript:alert(''Link to Google+ profile'')', '_parent', '{"class":"fa fa-google-plus"}', 1, 1, 0),
(9, 2, 'Style guide', '/style-guide', '', '', 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_pages`
--

CREATE TABLE `o3_cms_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `template_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` longtext COLLATE utf8_danish_ci NOT NULL,
  `keywords` longtext COLLATE utf8_danish_ci NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `can_be_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `deleted` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `o3_cms_pages`
--

INSERT INTO `o3_cms_pages` (`id`, `template_id`, `name`, `title`, `description`, `keywords`, `active`, `can_be_deleted`, `deleted`) VALUES
(1, 1, 'Home', 'Send or share files up to 25GB with no expiration date with Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(2, 2, 'Contact', 'Contact - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(5, 3, 'Terms, conditions and policies\n of use', 'Terms, conditions and policies\n of use - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(6, 4, 'Account', 'Account overview - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(7, 5, 'Edit profile', 'Edit profile - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(8, 6, 'Change password', 'Change password - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(9, 7, 'Subscription and payment', 'Subscription and payment - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(10, 8, 'Update payment method', 'Update payment method - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(11, 9, 'Edit billing information', 'Edit billing information - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(12, 10, 'Cancel subscription', 'Cancel subscription - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(13, 11, 'Reset password', 'Reset password - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(14, 11, 'Reset your password', 'Reset your password - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(15, 12, 'Transfer history / Storage', 'Your transfers - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\r\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\r\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(16, 13, 'Transfer', 'Transfer - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration.\nRegister for free to get 5GB per upload and transfer historty up to 2 months.\nRegister to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0),
(17, 14, 'Style guide', 'Style guide - Snapfer', 'Send unlimited number of files up to 2.5GB to unlimited number of recepients for free without registration. Register for free to get 5GB per upload and transfer historty up to 2 months. Register to Snapfer Premium with 125GB cloud storage included and send unlimited number of files up to 25GB to unlimited number of recepients that are never expires.', 'transfer, share files, send files, big files, no expiration, files up to 25 gigabyte', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_pages_url`
--

CREATE TABLE `o3_cms_pages_url` (
  `url` varchar(64) CHARACTER SET latin1 NOT NULL,
  `page_id` int(10) UNSIGNED DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `o3_cms_pages_url`
--

INSERT INTO `o3_cms_pages_url` (`url`, `page_id`, `timestamp`) VALUES
('/', 1, '2016-02-13 19:58:43'),
('/account', 6, '2016-03-14 06:32:22'),
('/cancel-subscription', 12, '2016-04-09 08:02:58'),
('/change-password', 8, '2016-03-15 18:58:44'),
('/contact', 2, '2016-02-21 13:31:19'),
('/edit-billing-information', 11, '2016-03-19 09:11:05'),
('/edit-profile', 7, '2016-03-15 18:58:34'),
('/frontpage', 1, '2016-01-04 20:18:52'),
('/reset-password', 13, '2016-04-15 17:09:24'),
('/reset-your-password', 14, '2016-04-15 20:42:09'),
('/style-guide', 17, '2016-05-13 05:35:01'),
('/subscription', 9, '2016-03-15 18:59:26'),
('/terms-conditions-and-policies-of-use', 5, '2016-04-29 18:41:24'),
('/transfer', 16, '2016-05-03 06:11:05'),
('/transfers', 15, '2016-05-01 06:03:02'),
('/update-payment-method', 10, '2016-03-17 14:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_snapfer_countries`
--

CREATE TABLE `o3_cms_snapfer_countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_code` char(2) COLLATE utf8_danish_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_danish_ci NOT NULL,
  `time_zone_utc` varchar(5) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `date_format` varchar(16) COLLATE utf8_danish_ci NOT NULL DEFAULT 'j/n/Y',
  `number_dec_count` int(10) UNSIGNED NOT NULL DEFAULT '2',
  `number_dec_sep` varchar(16) COLLATE utf8_danish_ci NOT NULL DEFAULT '.',
  `number_thousand_sep` varchar(16) COLLATE utf8_danish_ci NOT NULL DEFAULT ',',
  `is_eu` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `currency` varchar(8) COLLATE utf8_danish_ci NOT NULL DEFAULT 'USD',
  `monthly_price` float UNSIGNED NOT NULL DEFAULT '9.99',
  `price_format` varchar(16) COLLATE utf8_danish_ci NOT NULL DEFAULT 'cp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `o3_cms_snapfer_countries`
--

INSERT INTO `o3_cms_snapfer_countries` (`id`, `country_code`, `name`, `time_zone_utc`, `date_format`, `number_dec_count`, `number_dec_sep`, `number_thousand_sep`, `is_eu`, `currency`, `monthly_price`, `price_format`) VALUES
(1, 'AU', 'AUSTRALIA', '1000', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(2, 'AT', 'AUSTRIA', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(3, 'BE', 'BELGIUM', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(4, 'BG', 'BULGARIA', '200', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(5, 'CA', 'CANADA', '-500', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(6, 'CN', 'CHINA', '800', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(7, 'HR', 'CROATIA', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(8, 'CU', 'CUBA', '-500', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(9, 'CY', 'CYPRUS', '200', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(10, 'CZ', 'CZECH REPUBLIC', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(11, 'DK', 'DENMARK', '100', 'j/n/Y', 0, '.', ',', 1, 'DKK', 79, 'p f'),
(12, 'EE', 'ESTONIA', '200', 'j/n/Y', 2, '.', ',', 1, 'DKK', 79, 'p f'),
(13, 'FO', 'FAROE ISLANDS', '0', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(14, 'FI', 'FINLAND', '200', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(15, 'FR', 'FRANCE', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(16, 'DE', 'GERMANY', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(17, 'GR', 'GREECE', '200', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(18, 'HU', 'HUNGARY', '100', 'Y.n.j', 0, ',', '.', 1, 'HUF', 2499, 'p f'),
(19, 'IS', 'ICELAND', '0', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(20, 'IN', 'INDIA', '530', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(21, 'IE', 'IRELAND', '0', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(22, 'IT', 'ITALY', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(23, 'JP', 'JAPAN', '900', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(24, 'LV', 'LATVIA', '200', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(25, 'LI', 'LIECHTENSTEIN', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(26, 'LT', 'LITHUANIA', '200', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(27, 'LU', 'LUXEMBOURG', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(28, 'MY', 'MALAYSIA', '800', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(29, 'MT', 'MALTA', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(30, 'MX', 'MEXICO', '-600', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(31, 'NL', 'NETHERLANDS', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(32, 'NZ', 'NEW ZEALAND', '1245', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(33, 'NO', 'NORWAY', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(34, 'PL', 'POLAND', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(35, 'PT', 'PORTUGAL', '0', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(36, 'RO', 'ROMANIA', '200', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(37, 'RU', 'RUSSIAN FEDERATION', '300', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(38, 'SK', 'SLOVAKIA', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(39, 'ES', 'SPAIN', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(40, 'SE', 'SWEDEN', '100', 'j/n/Y', 2, '.', ',', 1, 'EUR', 8.99, 'fp'),
(41, 'CH', 'SWITZERLAND', '100', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(42, 'TN', 'TUNISIA', '100', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(43, 'TR', 'TURKEY', '200', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(44, 'UA', 'UKRAINE', '200', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp'),
(45, 'GB', 'UNITED KINGDOM', '0', 'j/n/Y', 2, '.', ',', 1, 'GBP', 6.99, 'fp'),
(46, 'US', 'UNITED STATES', '-500', 'j/n/Y', 2, '.', ',', 0, 'USD', 9.99, 'fp');

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_snapfer_email_queue`
--

CREATE TABLE `o3_cms_snapfer_email_queue` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` text COLLATE utf8_danish_ci NOT NULL,
  `to` text COLLATE utf8_danish_ci NOT NULL,
  `cc` text COLLATE utf8_danish_ci NOT NULL,
  `bcc` text COLLATE utf8_danish_ci NOT NULL,
  `subject` text COLLATE utf8_danish_ci NOT NULL,
  `message` longtext COLLATE utf8_danish_ci NOT NULL,
  `priority` tinyint(3) UNSIGNED NOT NULL DEFAULT '9',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sent` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_snapfer_ips`
--

CREATE TABLE `o3_cms_snapfer_ips` (
  `ip_from` int(10) UNSIGNED ZEROFILL NOT NULL DEFAULT '0000000000',
  `ip_to` int(10) UNSIGNED ZEROFILL NOT NULL DEFAULT '0000000000',
  `country_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_snapfer_payments`
--

CREATE TABLE `o3_cms_snapfer_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `mobile` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `bil_name` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `bil_vat` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `bil_country` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `bil_city` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `bil_zip` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `bil_address` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `product` text COLLATE utf8_danish_ci NOT NULL,
  `currency` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `show_vat` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `vat_percent` float UNSIGNED NOT NULL DEFAULT '0',
  `total_excl_vat` float UNSIGNED NOT NULL DEFAULT '0',
  `total_vat` float UNSIGNED NOT NULL DEFAULT '0',
  `total_incl_vat` float NOT NULL DEFAULT '0',
  `subscription_pay_type` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `subscription_pay_card` varchar(4) COLLATE utf8_danish_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_snapfer_reset_password_requests`
--

CREATE TABLE `o3_cms_snapfer_reset_password_requests` (
  `id` varchar(39) COLLATE utf8_danish_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_snapfer_transfers`
--

CREATE TABLE `o3_cms_snapfer_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `way` enum('email','download','social') COLLATE utf8_danish_ci NOT NULL DEFAULT 'download',
  `email` varchar(255) COLLATE utf8_danish_ci NOT NULL,
  `message` longtext COLLATE utf8_danish_ci NOT NULL,
  `expire` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `temp` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 - temporary, 0 - finished',
  `ip` varchar(45) COLLATE utf8_danish_ci NOT NULL COMMENT 'ip from where the transfer was added'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_snapfer_transfer_canonical_ids`
--

CREATE TABLE `o3_cms_snapfer_transfer_canonical_ids` (
  `canonical_id` varchar(68) COLLATE utf8_danish_ci NOT NULL,
  `transfer_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_snapfer_transfer_files`
--

CREATE TABLE `o3_cms_snapfer_transfer_files` (
  `id` int(10) UNSIGNED NOT NULL,
  `transfer_id` int(10) UNSIGNED DEFAULT NULL,
  `name` tinytext COLLATE utf8_danish_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_danish_ci NOT NULL,
  `filesize` bigint(20) NOT NULL DEFAULT '0',
  `thumb1` bigint(20) NOT NULL DEFAULT '0' COMMENT '0 - not generated, -1 - can''t be generated, > 0 size of file',
  `thumb2` bigint(20) NOT NULL DEFAULT '0' COMMENT '0 - not generated, -1 - can''t be generated, > 0 size of file',
  `preview1` bigint(20) NOT NULL DEFAULT '0' COMMENT '0 - not generated, -1 - can''t be generated, > 0 size of file',
  `preview2` bigint(20) NOT NULL DEFAULT '0' COMMENT '0 - not generated, -1 - can''t be generated, > 0 size of file',
  `pages` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'only for documents',
  `downloads` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `type` enum('image','video','audio','doc','other') COLLATE utf8_danish_ci NOT NULL DEFAULT 'other'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_snapfer_transfer_recipients`
--

CREATE TABLE `o3_cms_snapfer_transfer_recipients` (
  `id` int(10) UNSIGNED NOT NULL,
  `transfer_id` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_danish_ci NOT NULL,
  `sent` timestamp NULL DEFAULT NULL,
  `first_open` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_snapfer_users`
--

CREATE TABLE `o3_cms_snapfer_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) COLLATE utf8_danish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_danish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `bday` date NOT NULL,
  `gender` enum('male','female') COLLATE utf8_danish_ci NOT NULL DEFAULT 'male',
  `mobile` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `bil_name` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `bil_vat` varchar(32) COLLATE utf8_danish_ci DEFAULT NULL,
  `bil_city` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `bil_zip` varchar(16) COLLATE utf8_danish_ci DEFAULT NULL,
  `bil_address` varchar(255) COLLATE utf8_danish_ci DEFAULT NULL,
  `subsciption_type` enum('free','premium') COLLATE utf8_danish_ci NOT NULL DEFAULT 'free',
  `subsciption_start` date DEFAULT NULL,
  `subsciption_end` date DEFAULT NULL,
  `subscription_paid` date DEFAULT NULL,
  `subscription_pay_type` enum('card','paypal','') COLLATE utf8_danish_ci NOT NULL DEFAULT '',
  `subscription_pay_card` varchar(4) COLLATE utf8_danish_ci DEFAULT NULL COMMENT 'last 4 digit of card',
  `subscription_trial` date DEFAULT NULL COMMENT 'if not null the user already used/using the trial period, do not allow  another period for he/she',
  `subscription_storage` bigint(20) NOT NULL DEFAULT '0',
  `deleted` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_templates`
--

CREATE TABLE `o3_cms_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `system` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `styles` longtext CHARACTER SET latin1 NOT NULL,
  `deleted` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `o3_cms_templates`
--

INSERT INTO `o3_cms_templates` (`id`, `name`, `title`, `active`, `system`, `styles`, `deleted`) VALUES
(1, 'frontpage', 'Frontpage', 1, 1, '', 0),
(2, 'contact', 'Contact', 1, 1, '', 0),
(3, 'legal_stuff', 'Legal stuff', 1, 1, '', 0),
(4, 'account', 'Account', 1, 1, '', 0),
(5, 'edit_profile', 'Edit profile', 1, 1, '', 0),
(6, 'change_password', 'Change password', 1, 1, '', 0),
(7, 'subscription', 'Subscription', 1, 1, '', 0),
(8, 'update_payment', 'Update payment', 1, 1, '', 0),
(9, 'edit_billing_information', 'Edit billing information', 1, 1, '', 0),
(10, 'cancel_subscription', 'Cancel subscription', 1, 1, '', 0),
(11, 'reset_password', 'Reset password', 1, 1, '', 0),
(12, 'transfer_history', 'User''s transfers', 1, 1, '', 0),
(13, 'transfer', 'Transfer', 1, 1, '', 0),
(14, 'styleguide', 'Style guide', 1, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `o3_cms_users`
--

CREATE TABLE `o3_cms_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) COLLATE utf8_danish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_danish_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_danish_ci NOT NULL,
  `deleted` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Dumping data for table `o3_cms_users`
--

INSERT INTO `o3_cms_users` (`id`, `username`, `password`, `name`, `deleted`) VALUES
(1, 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'Zoltan Fischer', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `o3_cms_menu_groups`
--
ALTER TABLE `o3_cms_menu_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `o3_cms_menu_items`
--
ALTER TABLE `o3_cms_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `active` (`active`),
  ADD KEY `priority` (`priority`);

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
-- Indexes for table `o3_cms_snapfer_countries`
--
ALTER TABLE `o3_cms_snapfer_countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_eu` (`is_eu`);

--
-- Indexes for table `o3_cms_snapfer_email_queue`
--
ALTER TABLE `o3_cms_snapfer_email_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `o3_cms_snapfer_ips`
--
ALTER TABLE `o3_cms_snapfer_ips`
  ADD PRIMARY KEY (`ip_to`),
  ADD KEY `country_id_2` (`country_id`);

--
-- Indexes for table `o3_cms_snapfer_payments`
--
ALTER TABLE `o3_cms_snapfer_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `created` (`created`);

--
-- Indexes for table `o3_cms_snapfer_reset_password_requests`
--
ALTER TABLE `o3_cms_snapfer_reset_password_requests`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `created` (`created`);

--
-- Indexes for table `o3_cms_snapfer_transfers`
--
ALTER TABLE `o3_cms_snapfer_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expire` (`expire`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `temp` (`temp`);

--
-- Indexes for table `o3_cms_snapfer_transfer_canonical_ids`
--
ALTER TABLE `o3_cms_snapfer_transfer_canonical_ids`
  ADD PRIMARY KEY (`canonical_id`) USING BTREE,
  ADD UNIQUE KEY `transfer_id` (`transfer_id`);

--
-- Indexes for table `o3_cms_snapfer_transfer_files`
--
ALTER TABLE `o3_cms_snapfer_transfer_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfer_id` (`transfer_id`);

--
-- Indexes for table `o3_cms_snapfer_transfer_recipients`
--
ALTER TABLE `o3_cms_snapfer_transfer_recipients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfer_id` (`transfer_id`);

--
-- Indexes for table `o3_cms_snapfer_users`
--
ALTER TABLE `o3_cms_snapfer_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `subsciption_trial` (`subscription_trial`);

--
-- Indexes for table `o3_cms_templates`
--
ALTER TABLE `o3_cms_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `system` (`system`) USING BTREE,
  ADD KEY `deleted` (`deleted`) USING BTREE;

--
-- Indexes for table `o3_cms_users`
--
ALTER TABLE `o3_cms_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `deleted` (`deleted`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `o3_cms_menu_items`
--
ALTER TABLE `o3_cms_menu_items`
  ADD CONSTRAINT `o3_cms_menu_items_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `o3_cms_menu_groups` (`id`) ON UPDATE CASCADE;

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

--
-- Constraints for table `o3_cms_snapfer_ips`
--
ALTER TABLE `o3_cms_snapfer_ips`
  ADD CONSTRAINT `o3_cms_snapfer_ips_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `o3_cms_snapfer_countries` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `o3_cms_snapfer_payments`
--
ALTER TABLE `o3_cms_snapfer_payments`
  ADD CONSTRAINT `o3_cms_snapfer_payments_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `o3_cms_snapfer_countries` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `o3_cms_snapfer_payments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `o3_cms_snapfer_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `o3_cms_snapfer_reset_password_requests`
--
ALTER TABLE `o3_cms_snapfer_reset_password_requests`
  ADD CONSTRAINT `o3_cms_snapfer_reset_password_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `o3_cms_snapfer_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `o3_cms_snapfer_transfers`
--
ALTER TABLE `o3_cms_snapfer_transfers`
  ADD CONSTRAINT `o3_cms_snapfer_transfers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `o3_cms_snapfer_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `o3_cms_snapfer_transfer_canonical_ids`
--
ALTER TABLE `o3_cms_snapfer_transfer_canonical_ids`
  ADD CONSTRAINT `o3_cms_snapfer_transfer_canonical_ids_ibfk_1` FOREIGN KEY (`transfer_id`) REFERENCES `o3_cms_snapfer_transfers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `o3_cms_snapfer_transfer_files`
--
ALTER TABLE `o3_cms_snapfer_transfer_files`
  ADD CONSTRAINT `o3_cms_snapfer_transfer_files_ibfk_1` FOREIGN KEY (`transfer_id`) REFERENCES `o3_cms_snapfer_transfers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `o3_cms_snapfer_transfer_recipients`
--
ALTER TABLE `o3_cms_snapfer_transfer_recipients`
  ADD CONSTRAINT `o3_cms_snapfer_transfer_recipients_ibfk_1` FOREIGN KEY (`transfer_id`) REFERENCES `o3_cms_snapfer_transfers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `o3_cms_snapfer_users`
--
ALTER TABLE `o3_cms_snapfer_users`
  ADD CONSTRAINT `o3_cms_snapfer_users_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `o3_cms_snapfer_countries` (`id`) ON UPDATE CASCADE;
