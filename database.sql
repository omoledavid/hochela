-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 23, 2024 at 01:24 PM
-- Server version: 8.2.0
-- PHP Version: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hochela`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'johnwena10@gmail.com', 'admin', NULL, '5ff1c3531ed3f1609679699.jpg', '$2y$10$g0dgm0OdVf/vWddGPimRye6A.kxteWsTyDHKu.W5Wl7LKK8.YTvzi', 1, NULL, '2022-01-16 05:43:59'),
(4, 'Blogger', 'blogger10@gmail.com', 'adminblogger', NULL, '5ff1c3531ed3f1609679699.jpg', '$2y$10$g0dgm0OdVf/vWddGPimRye6A.kxteWsTyDHKu.W5Wl7LKK8.YTvzi', 2, NULL, '2022-01-16 05:43:59'),
(5, 'Jennifer', 'jennifer@gmail.com', 'jennifer', NULL, NULL, '$2y$10$gO1l5l9JAaKeSioDkKise.6Blo.mmg7a8kGRjXTBPy48ZesCjOKb6', 2, '2024-06-22 15:02:44', '2024-06-22 15:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

DROP TABLE IF EXISTS `admin_notifications`;
CREATE TABLE IF NOT EXISTS `admin_notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `owner_id` int UNSIGNED NOT NULL DEFAULT '0',
  `bloggers_id` int NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_status` tinyint(1) NOT NULL DEFAULT '0',
  `click_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `user_id`, `owner_id`, `bloggers_id`, `title`, `read_status`, `click_url`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 0, 'New owner registered', 1, '/admin/owner/detail/1', '2024-06-17 23:52:31', '2024-06-18 22:49:13'),
(2, 1, 0, 0, 'New member registered', 1, '/admin/user/detail/1', '2024-06-18 12:09:28', '2024-06-18 22:49:13'),
(3, 0, 0, 0, 'A new support ticket has opened ', 1, '/admin/tickets/view/1', '2024-06-20 07:01:42', '2024-06-21 06:00:40'),
(4, 0, 2, 0, 'New owner registered', 1, '/admin/owner/detail/2', '2024-06-20 07:55:59', '2024-06-21 06:00:40'),
(5, 0, 0, 5, 'New Bloggers registered', 1, '/admin/bloggers/detail/5', '2024-06-20 08:20:31', '2024-06-21 06:00:40'),
(6, 0, 0, 6, 'New Bloggers registered', 1, '/admin/bloggers/detail/6', '2024-06-20 08:21:49', '2024-06-21 06:00:40'),
(7, 0, 0, 7, 'New Bloggers registered', 1, '/admin/bloggers/detail/7', '2024-06-20 08:23:33', '2024-06-21 06:00:40'),
(8, 0, 0, 8, 'New Bloggers registered', 1, '/admin/bloggers/detail/8', '2024-06-20 08:26:04', '2024-06-21 06:00:40'),
(9, 0, 0, 9, 'New Bloggers registered', 1, '/admin/bloggers/detail/9', '2024-06-20 08:31:38', '2024-06-21 06:00:40'),
(10, 0, 0, 10, 'New Bloggers registered', 1, '/admin/bloggers/detail/10', '2024-06-20 08:34:17', '2024-06-21 06:00:40'),
(11, 0, 0, 11, 'New Bloggers registered', 1, '/admin/bloggers/detail/11', '2024-06-20 08:51:28', '2024-06-21 06:00:40'),
(12, 0, 0, 12, 'New Bloggers registered', 1, '/admin/bloggers/detail/12', '2024-06-20 08:54:57', '2024-06-21 06:00:40'),
(13, 0, 0, 13, 'New Bloggers registered', 1, '/admin/bloggers/detail/13', '2024-06-20 08:55:23', '2024-06-21 06:00:40'),
(14, 0, 0, 14, 'New Bloggers registered', 1, '/admin/bloggers/detail/14', '2024-06-20 08:55:59', '2024-06-21 06:00:40'),
(15, 0, 0, 15, 'New Bloggers registered', 1, '/admin/bloggers/detail/15', '2024-06-20 08:58:10', '2024-06-21 06:00:40'),
(16, 0, 0, 16, 'New Bloggers registered', 1, '/admin/bloggers/detail/16', '2024-06-20 08:59:18', '2024-06-21 06:00:40'),
(17, 0, 0, 17, 'New Bloggers registered', 1, '/admin/bloggers/detail/17', '2024-06-20 09:02:30', '2024-06-21 06:00:40'),
(18, 0, 0, 18, 'New Bloggers registered', 1, '/admin/bloggers/detail/18', '2024-06-20 09:03:03', '2024-06-21 06:00:40'),
(19, 0, 0, 19, 'New Bloggers registered', 1, '/admin/bloggers/detail/19', '2024-06-20 09:04:51', '2024-06-21 06:00:40'),
(20, 0, 0, 20, 'New Bloggers registered', 1, '/admin/bloggers/detail/20', '2024-06-20 09:15:48', '2024-06-21 06:00:40'),
(21, 0, 3, 0, 'New owner registered', 1, '/admin/owner/detail/3', '2024-06-20 13:15:38', '2024-06-21 06:00:40'),
(22, 1, 0, 0, 'New support ticket has opened', 0, '/admin/tickets/view/2', '2024-06-23 10:12:01', '2024-06-23 10:12:01'),
(23, 1, 0, 0, 'Deposit request from mikedoss', 0, '/admin/payment/details/1', '2024-06-23 10:55:09', '2024-06-23 10:55:09'),
(24, 0, 0, 0, 'A new support ticket has opened ', 0, '/admin/tickets/view/3', '2024-06-23 11:35:45', '2024-06-23 11:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

DROP TABLE IF EXISTS `admin_password_resets`;
CREATE TABLE IF NOT EXISTS `admin_password_resets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agent_reviews`
--

DROP TABLE IF EXISTS `agent_reviews`;
CREATE TABLE IF NOT EXISTS `agent_reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `agent_id` int NOT NULL,
  `stars` tinyint NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
CREATE TABLE IF NOT EXISTS `amenities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Light', '<i class=\"las la-fax\"></i>', 1, '2024-06-18 00:00:21', '2024-06-18 00:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `amenity_room_categories`
--

DROP TABLE IF EXISTS `amenity_room_categories`;
CREATE TABLE IF NOT EXISTS `amenity_room_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `amenity_id` int UNSIGNED NOT NULL DEFAULT '0',
  `room_category_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenity_room_categories`
--

INSERT INTO `amenity_room_categories` (`id`, `amenity_id`, `room_category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2024-06-18 00:05:50', '2024-06-18 00:05:50'),
(2, 1, 3, '2024-06-20 12:55:22', '2024-06-20 12:55:22'),
(3, 1, 4, '2024-06-20 13:26:23', '2024-06-20 13:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `bloggers`
--

DROP TABLE IF EXISTS `bloggers`;
CREATE TABLE IF NOT EXISTS `bloggers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `ev` tinyint NOT NULL DEFAULT '0',
  `sv` tinyint NOT NULL DEFAULT '0',
  `ver_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ver_code_send_at` datetime NOT NULL,
  `ts` tinyint NOT NULL DEFAULT '0',
  `tv` tinyint NOT NULL DEFAULT '1',
  `tsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bloggers`
--

INSERT INTO `bloggers` (`id`, `firstname`, `lastname`, `username`, `mobile`, `email`, `email_verified_at`, `password`, `country_code`, `image`, `address`, `status`, `ev`, `sv`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `created_at`, `updated_at`) VALUES
(19, 'Mike', 'Amon', 'kikeamon', '1860525292712', 'kamon@gmail.com', NULL, '$2y$10$LR.N0jbgbCHCl6OP9/0UzOPcjX6lLVzslr2EqLqe7/AG.btu9hUs.', 'US', NULL, '{\"address\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"United States\",\"city\":\"\"}', 1, 1, 1, NULL, '0000-00-00 00:00:00', 0, 1, NULL, '2024-06-20 09:04:51', '2024-06-20 09:04:51'),
(20, 'mikw', 'wrwr', 'wrwerwrwrw', '93242424', 'david@gmail.com', NULL, '$2y$10$BxSpE4lB5DBrePWUbhQRjO9B8L4/3QnwxlEOZzrwutOxD8wO2/voq', 'AF', NULL, '{\"address\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"Afghanistan\",\"city\":\"\"}', 1, 1, 1, NULL, '0000-00-00 00:00:00', 0, 1, NULL, '2024-06-20 09:15:48', '2024-06-20 09:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `booked_properties`
--

DROP TABLE IF EXISTS `booked_properties`;
CREATE TABLE IF NOT EXISTS `booked_properties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `property_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `total_price` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Success, 2=Cancel\r\n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booked_properties`
--

INSERT INTO `booked_properties` (`id`, `property_id`, `user_id`, `total_price`, `date_from`, `date_to`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 28518000.00000000, '2024-06-18', '2024-12-31', 0, '2024-06-18 12:15:15', '2024-06-18 12:15:15'),
(2, 2, 1, 2500000.00000000, '2024-06-24', '2024-06-29', 0, '2024-06-23 10:54:16', '2024-06-23 10:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `booked_rooms`
--

DROP TABLE IF EXISTS `booked_rooms`;
CREATE TABLE IF NOT EXISTS `booked_rooms` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `booked_property_id` int UNSIGNED NOT NULL DEFAULT '0',
  `property_id` int UNSIGNED NOT NULL DEFAULT '0',
  `room_category_id` int UNSIGNED NOT NULL DEFAULT '0',
  `room_id` int UNSIGNED NOT NULL DEFAULT '0',
  `price` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `status` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Success',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booked_rooms`
--

INSERT INTO `booked_rooms` (`id`, `booked_property_id`, `property_id`, `room_category_id`, `room_id`, `price`, `date_from`, `date_to`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 28518000.00000000, '2024-06-18', '2024-12-31', 0, '2024-06-18 12:15:15', '2024-06-18 12:15:15'),
(2, 2, 2, 2, 2, 2500000.00000000, '2024-06-24', '2024-06-29', 0, '2024-06-23 10:54:16', '2024-06-23 10:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial` int NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `serial`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Business', 1, 1, '2024-06-21 09:33:29', '2024-06-21 09:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
CREATE TABLE IF NOT EXISTS `deposits` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `owner_id` int UNSIGNED NOT NULL DEFAULT '0',
  `booked_property_id` int UNSIGNED NOT NULL DEFAULT '0',
  `method_code` int UNSIGNED NOT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `method_currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `final_amo` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `btc_amo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `try` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT '0',
  `admin_feedback` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `owner_id`, `booked_property_id`, `method_code`, `amount`, `method_currency`, `charge`, `rate`, `final_amo`, `detail`, `btc_amo`, `btc_wallet`, `trx`, `try`, `status`, `from_api`, `admin_feedback`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 2, 1000, 2500000.00000000, 'NGN', 0.00000000, 1.00000000, 2500000.00000000, '{\"note\":{\"field_name\":null,\"type\":\"textarea\"}}', '0', '', 'CCQBRXB79VCT', 0, 2, 0, NULL, '2024-06-23 10:54:22', '2024-06-23 10:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

DROP TABLE IF EXISTS `email_logs`;
CREATE TABLE IF NOT EXISTS `email_logs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED DEFAULT '0',
  `owner_id` int UNSIGNED NOT NULL DEFAULT '0',
  `mail_sender` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_to` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_logs`
--

INSERT INTO `email_logs` (`id`, `user_id`, `owner_id`, `mail_sender`, `email_from`, `email_to`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 'php', 'Hochela info@hochela.com', 'mikedoss@gmail.com', 'Reply Support Ticket', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\"><a href=\"#\"><img src=\"https://i.imgur.com/z5uHdr2.png\" width=\"481\"><br>\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello Mike Doss (mikedoss@gmail.com)</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\"><div><p><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong>A member from our support team has replied to the following ticket:</strong></span></p><p><b><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong><br></strong></span></b></p><p><b>[Ticket#183521] Hello<br><br>Click here to reply:&nbsp; http://hochela.local/ticket/view/183521</b></p><p>----------------------------------------------</p><p>Here is the reply : <br></p><p> Thank you for your message<br></p></div><div><br></div></td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2024&nbsp;<a href=\"#\">Website Name</a> . All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', '2024-06-23 10:14:02', '2024-06-23 10:14:02'),
(2, 1, 0, 'php', 'Hochela info@hochela.com', 'mikedoss@gmail.com', 'Payment Request Submitted Successfully', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\"><a href=\"#\"><img src=\"https://i.imgur.com/z5uHdr2.png\" width=\"481\"><br>\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello Mike Doss (mikedoss)</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\"><div>Your payment request of <b>2,500,000.00 NGN</b> is via&nbsp; <b>Bank Transfer </b>submitted successfully<b> .<br></b></div><div><b><br></b></div><div><b>Details of your Payment:<br></b></div><div><br></div><div>Amount : 2,500,000.00 NGN</div><div>Charge: <font color=\"#FF0000\">0.00 NGN</font></div><div><br></div><div>Conversion Rate : 1 NGN = 1.00 NGN</div><div>Payable : 2,500,000.00 NGN <br></div><div>Pay via :&nbsp; Bank Transfer</div><div><br></div><div>Transaction Number : CCQBRXB79VCT</div><div><br></div><div><br></div></td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2024&nbsp;<a href=\"#\">Website Name</a> . All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', '2024-06-23 10:55:10', '2024-06-23 10:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_templates`
--

DROP TABLE IF EXISTS `email_sms_templates`;
CREATE TABLE IF NOT EXISTS `email_sms_templates` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `sms_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_sms_templates`
--

INSERT INTO `email_sms_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'PASS_RESET_CODE', 'Password Reset', 'Password Reset', '<div>We have received a request to reset the password for your account on <b>{{time}} .<br></b></div><div>Requested From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div><div><br></div><br><div><div><div>Your account recovery code is:&nbsp;&nbsp; <font size=\"6\"><b>{{code}}</b></font></div><div><br></div></div></div><div><br></div><div><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><br>', 'Your account recovery code is: {{code}}', ' {\"code\":\"Password Reset Code\",\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2021-01-06 00:49:06'),
(2, 'PASS_RESET_DONE', 'Password Reset Confirmation', 'You have Reset your password', '<div><p>\r\n    You have successfully reset your password.</p><p>You changed from&nbsp; IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}}&nbsp;</b> on <b>{{time}}</b></p><p><b><br></b></p><p><font color=\"#FF0000\"><b>If you did not changed that, Please contact with us as soon as possible.</b></font><br></p></div>', 'Your password has been changed successfully', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-07 10:23:47'),
(3, 'EVER_CODE', 'Email Verification', 'Please verify your email address', '<div><br></div><div>Thanks For join with us. <br></div><div>Please use below code to verify your email address.<br></div><div><br></div><div>Your email verification code is:<font size=\"6\"><b> {{code}}</b></font></div>', 'Your email verification code is: {{code}}', '{\"code\":\"Verification code\"}', 1, 1, '2019-09-24 23:04:05', '2021-01-03 23:35:10'),
(4, 'SVER_CODE', 'SMS Verification ', 'Please verify your phone', 'Your phone verification code is: {{code}}', 'Your phone verification code is: {{code}}', '{\"code\":\"Verification code\"}', 0, 1, '2019-09-24 23:04:05', '2020-03-08 01:28:52'),
(5, '2FA_ENABLE', 'Google Two Factor - Enable', 'Google Two Factor Authentication is now  Enabled for Your Account', '<div>You just enabled Google Two Factor Authentication for Your Account.</div><div><br></div><div>Enabled at <b>{{time}} </b>From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div>', 'Your verification code is: {{code}}', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-08 01:42:59'),
(6, '2FA_DISABLE', 'Google Two Factor Disable', 'Google Two Factor Authentication is now  Disabled for Your Account', '<div>You just Disabled Google Two Factor Authentication for Your Account.</div><div><br></div><div>Disabled at <b>{{time}} </b>From IP: <b>{{ip}}</b> using <b>{{browser}}</b> on <b>{{operating_system}} </b>.</div>', 'Google two factor verification is disabled', '{\"ip\":\"IP of User\",\"browser\":\"Browser of User\",\"operating_system\":\"Operating System of User\",\"time\":\"Request Time\"}', 1, 1, '2019-09-24 23:04:05', '2020-03-08 01:43:46'),
(16, 'ADMIN_SUPPORT_REPLY', 'Support Ticket Reply ', 'Reply Support Ticket', '<div><p><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong>A member from our support team has replied to the following ticket:</strong></span></p><p><b><span style=\"font-size: 11pt;\" data-mce-style=\"font-size: 11pt;\"><strong><br></strong></span></b></p><p><b>[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</b></p><p>----------------------------------------------</p><p>Here is the reply : <br></p><p> {{reply}}<br></p></div><div><br></div>', '{{subject}}\r\n\r\n{{reply}}\r\n\r\n\r\nClick here to reply:  {{link}}', '{\"ticket_id\":\"Support Ticket ID\", \"ticket_subject\":\"Subject Of Support Ticket\", \"reply\":\"Reply from Staff/Admin\",\"link\":\"Ticket URL For relpy\"}', 1, 1, '2020-06-08 18:00:00', '2020-05-04 02:24:40'),
(206, 'DEPOSIT_COMPLETE', 'Automated Deposit - Successful', 'Payment Completed Successfully', '<div>Your payment of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>has been completed Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your Payment:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#000000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br></div><div><br><br><br></div>', '{{amount}} {{currrency}} Deposit successfully by {{gateway_name}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2020-06-24 18:00:00', '2022-01-27 04:52:44'),
(207, 'DEPOSIT_REQUEST', 'Manual Deposit - User Requested', 'Payment Request Submitted Successfully', '<div>Your payment request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>submitted successfully<b> .<br></b></div><div><b><br></b></div><div><b>Details of your Payment:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br></div>', '{{amount}} Deposit requested by {{method}}. Charge: {{charge}} . Trx: {{trx}}\r\n', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\"}', 1, 1, '2020-05-31 18:00:00', '2022-01-25 12:47:27'),
(208, 'DEPOSIT_APPROVE', 'Manual Deposit - Admin Approved', 'Your Payment is Approved', '<div>Your payment request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} </b>is Approved .<b><br></b></div><div><b><br></b></div><div><b>Details of your Payment:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}} <br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br></div><div><br><br></div>', 'Admin Approve Your {{amount}} {{gateway_currency}} payment request by {{gateway_name}} transaction : {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2020-06-16 18:00:00', '2022-01-27 04:51:48'),
(209, 'DEPOSIT_REJECT', 'Manual Deposit - Admin Rejected', 'Your Payment Request is Rejected', '<div>Your payment request of <b>{{amount}} {{currency}}</b> is via&nbsp; <b>{{method_name}} has been rejected</b>.<b><br></b></div><br><div>Transaction Number was : {{trx}}</div><div><br></div><div>if you have any query, feel free to contact us.<br></div><br><div><br><br></div>\r\n\r\n\r\n\r\n{{rejection_message}}', 'Admin Rejected Your {{amount}} {{gateway_currency}} payment request by {{gateway_name}}\r\n\r\n{{rejection_message}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\",\"rejection_message\":\"Rejection message\"}', 1, 1, '2020-06-09 18:00:00', '2022-01-25 12:48:43'),
(210, 'WITHDRAW_REQUEST', 'Withdraw  - User Requested', 'Withdraw Request Submitted Successfully', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been submitted Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You will get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"4\" color=\"#FF0000\"><b><br></b></font></div><div><font size=\"4\" color=\"#FF0000\"><b>This may take {{delay}} to process the payment.</b></font><br></div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\"><b><br></b></font></div><div><font size=\"5\">Your current Balance is <b>{{post_balance}} {{currency}}</b></font></div><div><br></div><div><br><br><br><br></div>', '{{amount}} {{currency}} withdraw requested by {{method_name}}. You will get {{method_amount}} {{method_currency}} in {{delay}}. Trx: {{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\", \"delay\":\"Delay time for processing\"}', 1, 1, '2020-06-07 18:00:00', '2021-05-08 06:49:06'),
(211, 'WITHDRAW_REJECT', 'Withdraw - Admin Rejected', 'Withdraw Request has been Rejected and your money is refunded to your account', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been Rejected.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You should get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br></div><div>----</div><div><font size=\"3\"><br></font></div><div><font size=\"3\"> {{amount}} {{currency}} has been <b>refunded </b>to your account and your current Balance is <b>{{post_balance}}</b><b> {{currency}}</b></font></div><div><br></div><div>-----</div><div><br></div><div><font size=\"4\">Details of Rejection :</font></div><div><font size=\"4\"><b>{{admin_details}}</b></font></div><div><br></div><div><br><br><br><br><br><br></div>', 'Admin Rejected Your {{amount}} {{currency}} withdraw request. Your Main Balance {{main_balance}}  {{method}} , Transaction {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"post_balance\":\"Users Balance After this operation\", \"admin_details\":\"Details Provided By Admin\"}', 1, 1, '2020-06-09 18:00:00', '2020-06-14 18:00:00'),
(212, 'WITHDRAW_APPROVE', 'Withdraw - Admin  Approved', 'Withdraw Request has been Processed and your money is sent', '<div>Your withdraw request of <b>{{amount}} {{currency}}</b>&nbsp; via&nbsp; <b>{{method_name}} </b>has been Processed Successfully.<b><br></b></div><div><b><br></b></div><div><b>Details of your withdraw:<br></b></div><div><br></div><div>Amount : {{amount}} {{currency}}</div><div>Charge: <font color=\"#FF0000\">{{charge}} {{currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{currency}} = {{rate}} {{method_currency}}</div><div>You will get: {{method_amount}} {{method_currency}} <br></div><div>Via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div>-----</div><div><br></div><div><font size=\"4\">Details of Processed Payment :</font></div><div><font size=\"4\"><b>{{admin_details}}</b></font></div><div><br></div><div><br><br><br><br><br></div>', 'Admin Approve Your {{amount}} {{currency}} withdraw request by {{method}}. Transaction {{transaction}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\", \"admin_details\":\"Details Provided By Admin\"}', 1, 1, '2020-06-10 18:00:00', '2020-06-06 18:00:00'),
(215, 'BAL_ADD', 'Balance Add by Admin', 'Your Account has been Credited', '<div>{{amount}} {{currency}} has been added to your account .</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>{{post_balance}}&nbsp; {{currency}}&nbsp;</b></font>', '{{amount}} {{currency}} credited in your account. Your Current Balance {{remaining_balance}} {{currency}} . Transaction: #{{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 19:14:22', '2021-01-06 00:46:18'),
(216, 'BAL_SUB', 'Balance Subtracted by Admin', 'Your Account has been Debited', '<div>{{amount}} {{currency}} has been subtracted from your account .</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div>Your Current Balance is : <font size=\"3\"><b>{{post_balance}}&nbsp; {{currency}}</b></font>', '{{amount}} {{currency}} debited from your account. Your Current Balance {{remaining_balance}} {{currency}} . Transaction: #{{trx}}', '{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"post_balance\":\"Users Balance After this operation\"}', 1, 1, '2019-09-14 19:14:22', '2019-11-10 09:07:12'),
(217, 'PROPERTY_BOOKED', 'Property Booked Successfully', 'Property Booked Successfully', '<div><span style=\"color: rgb(33, 37, 41); font-size: 1rem;\">Your property </span><b style=\"font-size: 1rem;\">{{ property_name }} </b><span style=\"color: rgb(33, 37, 41); font-size: 1rem;\">recently\r\n        booked by </span><b style=\"font-size: 1rem;\">{{ user_name }} </b><span style=\"color: rgb(33, 37, 41); font-size: 1rem;\">.</span><br></div>\r\n<div><br></div>\r\n<div><b><br></b></div>\r\n<div><b>Details of your booked property:<br></b></div>\r\n<div><span style=\"font-size: 1rem;\"><br></span></div>\r\n<div><span>Check In Date: {{ check_in_date }}</span><br></div>\r\n<div><span>Check out Date: {{ check_out_date }}</span><span style=\"font-size: 1rem;\"><br></span></div>\r\n<div>Amount : {{ amount }} {{ currency }}</div>\r\n<div>Total Rooms: {{ total_room }}</div>\r\n<div><br></div>\r\n<div>Balance: {{ post_balance }}</div>\r\n<div><br></div>\r\n<div>Paid via :&nbsp; {{ method_name }}</div>\r\n<div>Currency: {{ method_currency }}</div>\r\n<div><br></div>\r\n<div>Transaction Number : {{ trx }}</div>\r\n<div><br></div>\r\n<div><br></div>\r\n<div><br><br><br></div>', '{{amount}} {{currrency}} Deposit successfully by {{gateway_name}}', '{\r\n  \"property_name\": \"Property Name\",\r\n  \"user_name\": \"User Fullname\",\r\n  \"check_in_date\": \"Check In Date\",\r\n  \"check_out_date\": \"Check Out Date\",\r\n  \"trx\": \"Transaction Number\",\r\n  \"amount\": \"Request Amount By user\",\r\n  \"currency\": \"Site Currency\",\r\n  \"total_room\": \"Total Rooms\",\r\n  \"method_name\": \"Payment Method Name\",\r\n  \"method_currency\": \"Payment Method Currency\",\r\n  \"post_balance\": \"Owner Balance After this operation\"\r\n}', 1, 1, '2020-06-24 18:00:00', '2022-02-13 08:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

DROP TABLE IF EXISTS `extensions`;
CREATE TABLE IF NOT EXISTS `extensions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'object',
  `support` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, NULL, '2019-10-18 23:16:05', '2022-02-16 08:24:54'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\r\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\r\n<div class=\"g-recaptcha\" data-sitekey=\"{{sitekey}}\" data-callback=\"verifyCaptcha\"></div>\r\n<div id=\"g-recaptcha-error\"></div>', '{\"sitekey\":{\"title\":\"Site Key\",\"value\":\"6Lfpm3cUAAAAAGIjbEJKhJNKS4X1Gns9ANjh8MfH\"}}', 'recaptcha.png', 0, NULL, '2019-10-18 23:16:05', '2022-02-16 08:31:35'),
(3, 'custom-captcha', 'Custom Captcha', 'Just Put Any Random String', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, NULL, '2019-10-18 23:16:05', '2022-02-16 08:31:32'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\r\n                <script>\r\n                  window.dataLayer = window.dataLayer || [];\r\n                  function gtag(){dataLayer.push(arguments);}\r\n                  gtag(\"js\", new Date());\r\n                \r\n                  gtag(\"config\", \"{{app_key}}\");\r\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, NULL, '2022-02-16 08:31:53'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.PNG', 0, NULL, NULL, '2022-02-16 08:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

DROP TABLE IF EXISTS `frontends`;
CREATE TABLE IF NOT EXISTS `frontends` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_keys` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"hochela\",\"accomodation\"],\"description\":\"hochela\",\"social_title\":\"Hochela- Student Accommodation\",\"social_description\":\"Find your perfect accommodation, attend great events, and stay up-to-date with the latest news, all in one place!\",\"image\":\"6670e728634d91718675240.png\"}', '2020-07-04 23:42:52', '2024-06-18 00:47:20'),
(24, 'about.content', '{\"has_image\":\"1\",\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\",\"description\":\"fdg sdfgsdf g ggg\",\"about_icon\":\"<i class=\\\"las la-address-card\\\"><\\/i>\",\"background_image\":\"60951a84abd141620384388.png\",\"about_image\":\"5f9914e907ace1603867881.jpg\"}', '2020-10-28 00:51:20', '2021-05-07 10:16:28'),
(25, 'blog.content', '{\"heading\":\"Latest Campus News\",\"sub_heading\":\"Be informed on all happenings around you\"}', '2020-10-28 00:51:34', '2024-06-18 11:21:35'),
(27, 'contact_us.content', '{\"title\":\"Contact us for any information\",\"contact_address\":\"\\u00a0\",\"email_address\":\"info@hochela.com\",\"contact_number\":\"(+234) - 8034 756 2381\",\"contact_form_title\":\"Do you have any question?\",\"google_map_embed_url\":\"#\"}', '2020-10-28 00:59:19', '2024-06-20 13:42:12'),
(28, 'counter.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\"}', '2020-10-28 01:04:02', '2020-10-28 01:04:02'),
(31, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"lab la-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', '2020-11-12 04:07:30', '2022-01-16 12:24:04'),
(33, 'feature.content', '{\"heading\":\"asdf\",\"sub_heading\":\"asdf\"}', '2021-01-03 23:40:54', '2021-01-03 23:40:55'),
(34, 'feature.element', '{\"title\":\"asdf\",\"description\":\"asdf\",\"feature_icon\":\"asdf\"}', '2021-01-03 23:41:02', '2021-01-03 23:41:02'),
(35, 'service.element', '{\"trx_type\":\"withdraw\",\"service_icon\":\"<i class=\\\"las la-highlighter\\\"><\\/i>\",\"title\":\"asdfasdf\",\"description\":\"asdfasdfasdfasdf\"}', '2021-03-06 01:12:10', '2021-03-06 01:12:10'),
(36, 'service.content', '{\"trx_type\":\"withdraw\",\"heading\":\"asdf fffff\",\"sub_heading\":\"asdf asdfasdf\"}', '2021-03-06 01:27:34', '2021-03-06 02:19:39'),
(39, 'banner.content', '{\"has_image\":\"1\",\"heading\":\"Student Accommodation Just Made a Whole Lot Easier\",\"sub_heading\":\"Find your perfect accommodation, attend great events, and stay up-to-date with the latest news, all in one place!\",\"background_image\":\"66721bbb65a511718754235.png\"}', '2021-05-02 06:09:30', '2024-06-18 22:43:55'),
(41, 'cookie.data', '{\"link\":\"#\",\"description\":\"<font color=\\\"#fff\\\" face=\\\"Exo, sans-serif\\\"><span style=\\\"font-size: 18px; display:inline\\\">We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.<\\/span><\\/font>\",\"status\":1}', '2020-07-04 23:42:52', '2022-02-14 14:17:53'),
(42, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">How do we protect your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">All provided delicate\\/credit data is sent through Stripe.<br \\/>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Do we disclose any information to outside parties?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Children\'s Online Privacy Protection Act Compliance<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Changes to our Privacy Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">If we decide to change our privacy policy, we will post those changes on this page.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">How long we retain your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">What we don\\u2019t do with your data<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\"}', '2021-06-09 08:50:42', '2021-06-09 08:50:42'),
(43, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We claim all authority to dismiss, end, or handicap any help with or without cause per administrator discretion. This is a Complete independent facilitating, on the off chance that you misuse our ticket or Livechat or emotionally supportive network by submitting solicitations or protests we will impair your record. The solitary time you should reach us about the seaward facilitating is if there is an issue with the worker. We have not many substance limitations and everything is as per laws and guidelines. Try not to join on the off chance that you intend to do anything contrary to the guidelines, we do check these things and we will know, don\'t burn through our own and your time by joining on the off chance that you figure you will have the option to sneak by us and break the terms.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><ul class=\\\"font-18\\\" style=\\\"padding-left:15px;list-style-type:disc;font-size:18px;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Configuration requests - If you have a fully managed dedicated server with us then we offer custom PHP\\/MySQL configurations, firewalls for dedicated IPs, DNS, and httpd configurations.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Software requests - Cpanel Extension Installation will be granted as long as it does not interfere with the security, stability, and performance of other users on the server.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Emergency Support - We do not provide emergency support \\/ Phone Support \\/ LiveChat Support. Support may take some hours sometimes.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Webmaster help - We do not offer any support for webmaster related issues and difficulty including coding, &amp; installs, Error solving. if there is an issue where a library or configuration of the server then we can help you if it\'s possible from our end.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Backups - We keep backups but we are not responsible for data loss, you are fully responsible for all backups.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">We Don\'t support any child porn or such material.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No spam-related sites or material, such as email lists, mass mail programs, and scripts, etc.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No harassing material that may cause people to retaliate against you.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No phishing pages.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">You may not run any exploitation script from the server. reason can be terminated immediately.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">If Anyone attempting to hack or exploit the server by using your script or hosting, we will terminate your account to keep safe other users.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Malicious Botnets are strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Spam, mass mailing, or email marketing in any way are strictly forbidden here.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Malicious hacking materials, trojans, viruses, &amp; malicious bots running or for download are forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Resource and cronjob abuse is forbidden and will result in suspension or termination.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Php\\/CGI proxies are strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">CGI-IRC is strictly forbidden.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">No fake or disposal mailers, mass mailing, mail bombers, SMS bombers, etc.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">NO CREDIT OR REFUND will be granted for interruptions of service, due to User Agreement violations.<\\/li><\\/ul><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Terms &amp; Conditions for Users<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">Before getting to this site, you are consenting to be limited by these site Terms and Conditions of Use, every single appropriate law, and guidelines, and concur that you are answerable for consistency with any material neighborhood laws. If you disagree with any of these terms, you are restricted from utilizing or getting to this site.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Support<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">Whenever you have downloaded our item, you may get in touch with us for help through email and we will give a valiant effort to determine your issue. We will attempt to answer using the Email for more modest bug fixes, after which we will refresh the center bundle. Content help is offered to confirmed clients by Tickets as it were. Backing demands made by email and Livechat.<\\/p><p class=\\\"my-3 font-18 font-weight-bold\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">On the off chance that your help requires extra adjustment of the System, at that point, you have two alternatives:<\\/p><ul class=\\\"font-18\\\" style=\\\"padding-left:15px;list-style-type:disc;font-size:18px;\\\"><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Hang tight for additional update discharge.<\\/li><li style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">Or on the other hand, enlist a specialist (We offer customization for extra charges).<\\/li><\\/ul><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Ownership<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">You may not guarantee scholarly or selective possession of any of our items, altered or unmodified. All items are property, we created them. Our items are given \\\"with no guarantees\\\" without guarantee of any sort, either communicated or suggested. On no occasion will our juridical individual be subject to any harms including, however not restricted to, immediate, roundabout, extraordinary, accidental, or significant harms or different misfortunes emerging out of the utilization of or powerlessness to utilize our items.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Warranty<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We don\'t offer any guarantee or assurance of these Services in any way. When our Services have been modified we can\'t ensure they will work with all outsider plugins, modules, or internet browsers. Program similarity ought to be tried against the show formats on the demo worker. If you don\'t mind guarantee that the programs you use will work with the component, as we can not ensure that our systems will work with all program mixes.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Unauthorized\\/Illegal Usage<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">You may not utilize our things for any illicit or unapproved reason or may you, in the utilization of the stage, disregard any laws in your locale (counting yet not restricted to copyright laws) just as the laws of your nation and International law. Specifically, it is disallowed to utilize the things on our foundation for pages that advance: brutality, illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez programming joins.<br \\/><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment, utilization of the offered on our things, or admittance to the administration without the express composed consent by us or item proprietor.<br \\/><br \\/>Our Members are liable for all substance posted on the discussion and demo and movement that happens under your record.<br \\/><br \\/>We hold the chance of hindering your participation account quickly if we will think about a particularly not allowed conduct.<br \\/><br \\/>If you make a record on our site, you are liable for keeping up the security of your record, and you are completely answerable for all exercises that happen under the record and some other activities taken regarding the record. You should quickly inform us, of any unapproved employments of your record or some other penetrates of security.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Fiverr, Seoclerks Sellers Or Affiliates<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We do NOT ensure full SEO campaign conveyance within 24 hours. We make no assurance for conveyance time by any means. We give our best assessment to orders during the putting in of requests, anyway, these are gauges. We won\'t be considered liable for loss of assets, negative surveys or you being prohibited for late conveyance. If you are selling on a site that requires time touchy outcomes, utilize Our SEO Services at your own risk.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Payment\\/Refund Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">No refund or cash back will be made. After a deposit has been finished, it is extremely unlikely to invert it. You should utilize your equilibrium on requests our administrations, Hosting, SEO campaign. You concur that once you complete a deposit, you won\'t document a debate or a chargeback against us in any way, shape, or form.<br \\/><br \\/>If you document a debate or chargeback against us after a deposit, we claim all authority to end every single future request, prohibit you from our site. False action, for example, utilizing unapproved or taken charge cards will prompt the end of your record. There are no special cases.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color:rgb(111,111,111);font-family:Nunito, sans-serif;margin-bottom:3rem;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:24px;font-family:Exo, sans-serif;color:rgb(54,54,54);\\\">Free Balance \\/ Coupon Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right:0px;margin-left:0px;font-size:18px;\\\">We offer numerous approaches to get FREE Balance, Coupons and Deposit offers yet we generally reserve the privilege to audit it and deduct it from your record offset with any explanation we may it is a sort of misuse. If we choose to deduct a few or all of free Balance from your record balance, and your record balance becomes negative, at that point the record will naturally be suspended. If your record is suspended because of a negative Balance you can request to make a custom payment to settle your equilibrium to actuate your record.<\\/p><\\/div>\"}', '2021-06-09 08:51:18', '2021-06-09 08:51:18'),
(44, 'location.content', '{\"has_image\":\"1\",\"heading\":\"Discover best location for your next apartment.\",\"sub_heading\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum inventore fugiat earum voluptas similique quibusdam quasi voluptatibus. Qui, minima minus.\",\"button\":\"Discover All\",\"button_url\":\"locations\",\"background_image\":\"61cd8b6347a371640860515.jpg\"}', '2021-12-30 09:43:00', '2024-06-18 11:25:04'),
(45, 'property_type.content', '{\"heading\":\"Choose your preferred property type\",\"sub_heading\":\"Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et maxime tenetur autem similique exercitationem error libero perferendis ex veritatis molestias.\"}', '2021-12-30 09:44:11', '2024-06-18 11:42:16'),
(46, 'top_trip.content', '{\"has_image\":\"1\",\"heading\":\"Featured Apartment\",\"sub_heading\":\"Featured Apartment  Discover luxury and convenience in our featured apartment. Enjoy modern amenities, spacious rooms, and stunning views in a prime location. Schedule a tour today and make this your new home.\",\"background_image\":\"66717b7a5323b1718713210.png\"}', '2021-12-30 09:45:16', '2024-06-18 11:20:10'),
(47, 'testimonial.content', '{\"heading\":\"Our Happy travelers\",\"sub_heading\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, incidunt quisquam accusamus cupiditate neque aut dolor minus repellendus obcaecati consequuntur.\"}', '2021-12-30 10:26:35', '2021-12-30 10:26:35'),
(48, 'testimonial.element', '{\"name\":\"Sayara Ahmed\",\"feedback\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint laudantium quis velit delectus molestias. Animi quae in nam, sed, quis, odit aut cumque voluptatum nihil possimus accusantium modi. Deserunt, optio. Maiores possimus eos vitae quam odit mollitia, ipsam aperiam temporibus. Blanditiis eligendi atque sapiente perferendis magni ullam rerum laborum labore incidunt libero.\",\"star\":\"5\",\"has_image\":\"1\",\"image\":\"61cd910cf214a1640861964.jpg\"}', '2021-12-30 10:29:24', '2022-02-09 12:25:18'),
(49, 'testimonial.element', '{\"name\":\"Sayara Ahmed\",\"feedback\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint laudantium quis velit delectus molestias. Animi quae in nam, sed, quis, odit aut cumque voluptatum nihil possimus accusantium modi. Deserunt, optio. Maiores possimus eos vitae quam odit mollitia, ipsam aperiam temporibus. Blanditiis eligendi atque sapiente perferendis magni ullam rerum laborum labore incidunt libero.\",\"star\":\"4\",\"has_image\":\"1\",\"image\":\"61cd93451e5d41640862533.jpg\"}', '2021-12-30 10:30:36', '2022-02-09 12:25:26'),
(50, 'testimonial.element', '{\"name\":\"Sayara Ahmed\",\"feedback\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint laudantium quis velit delectus molestias. Animi quae in nam, sed, quis, odit aut cumque voluptatum nihil possimus accusantium modi. Deserunt, optio. Maiores possimus eos vitae quam odit mollitia, ipsam aperiam temporibus. Blanditiis eligendi atque sapiente perferendis magni ullam rerum laborum labore incidunt libero.\",\"star\":\"5\",\"has_image\":\"1\",\"image\":\"61cd916345e131640862051.jpg\"}', '2021-12-30 10:30:51', '2022-02-09 12:24:41'),
(51, 'works.content', '{\"title\":\"How it Works\",\"heading\":\"Pick your next Apartment with ease\",\"has_image\":\"1\",\"background_image\":\"61cd93f54844f1640862709.jpg\",\"left_image\":\"61cdb6fd2f2e81640871677.png\",\"right_image\":\"61cdb6fd48ace1640871677.png\"}', '2021-12-30 10:41:49', '2024-06-17 23:21:02'),
(52, 'works.element', '{\"step\":\"Create an account\"}', '2021-12-30 10:42:05', '2021-12-30 10:42:05'),
(53, 'works.element', '{\"step\":\"Search desire Apartment\"}', '2021-12-30 10:42:16', '2024-06-17 23:18:18'),
(54, 'works.element', '{\"step\":\"Inspect\"}', '2021-12-30 10:42:26', '2024-06-17 23:19:32'),
(55, 'works.element', '{\"step\":\"Make Payment and Enjoy\"}', '2021-12-30 10:42:37', '2024-06-17 23:19:47'),
(56, 'video.content', '{\"has_image\":\"1\",\"heading\":\"Take a short look &amp; enjoy your holiday\",\"sub_heading\":\"Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, commodi.\",\"video_url\":\"https:\\/\\/www.youtube.com\\/embed\\/nqye02H_H6I\",\"background_image\":\"61cd9bf71f39a1640864759.jpg\"}', '2021-12-30 11:15:59', '2022-02-16 08:38:31'),
(57, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Optio omnis quaerat illum imilique\",\"description_nic\":\"<p class=\\\"mt-4 mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">sPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h3 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.5rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h3><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.375rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h4><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h5 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.25rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h5><div class=\\\"row g-4\\\" style=\\\"color:rgb(70,70,70);font-family:Roboto, sans-serif;\\\"><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Must have medical certificat<\\/li><\\/ul><\\/div><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Must have medical certificat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><\\/ul><\\/div><\\/div>\",\"blog_image\":\"620d12df75f161645023967.jpg\"}', '2021-12-30 11:59:24', '2022-02-16 09:06:07'),
(58, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Deleniti odio dolore dignissimos ullam\",\"description_nic\":\"<p class=\\\"mt-4 mb-3\\\" style=\\\"margin-right:0px;margin-left:0px;color:rgb(70,70,70);font-family:Roboto, sans-serif;font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"mb-3\\\" style=\\\"margin-right:0px;margin-left:0px;color:rgb(70,70,70);font-family:Roboto, sans-serif;font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h3 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.5rem;font-family:\'Playfair Display\', serif;color:rgb(55,62,74);\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h3><p class=\\\"mb-3\\\" style=\\\"margin-right:0px;margin-left:0px;color:rgb(70,70,70);font-family:Roboto, sans-serif;font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.375rem;font-family:\'Playfair Display\', serif;color:rgb(55,62,74);\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h4><p class=\\\"mb-3\\\" style=\\\"margin-right:0px;margin-left:0px;color:rgb(70,70,70);font-family:Roboto, sans-serif;font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h5 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.25rem;font-family:\'Playfair Display\', serif;color:rgb(55,62,74);\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h5><div class=\\\"row g-4\\\" style=\\\"color:rgb(70,70,70);font-family:Roboto, sans-serif;\\\"><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Must have medical certificat<\\/li><\\/ul><\\/div><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Must have medical certificat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><\\/ul><\\/div><\\/div>\",\"blog_image\":\"620d13ec7160b1645024236.jpg\"}', '2021-12-30 11:59:33', '2022-02-16 09:10:36'),
(59, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Amet consectetur adipisicing elit pede\",\"description_nic\":\"<p class=\\\"mt-4 mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h3 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.5rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h3><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.375rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h4><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h5 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.25rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h5><div class=\\\"row g-4\\\" style=\\\"color:rgb(70,70,70);font-family:Roboto, sans-serif;\\\"><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Must have medical certificat<\\/li><\\/ul><\\/div><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Must have medical certificat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><\\/ul><\\/div><\\/div>\",\"blog_image\":\"620d130052d3e1645024000.jpg\"}', '2021-12-30 11:59:41', '2022-02-16 09:06:40'),
(60, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Lorem ipsum dolor sit amet velit faucibus\",\"description_nic\":\"<p class=\\\"mt-4 mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h3 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.5rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h3><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.375rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h4><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h5 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.25rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h5><div class=\\\"row g-4\\\" style=\\\"color:rgb(70,70,70);font-family:Roboto, sans-serif;\\\"><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Must have medical certificat<\\/li><\\/ul><\\/div><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Must have medical certificat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><\\/ul><\\/div><\\/div>\",\"blog_image\":\"620d134732f441645024071.jpg\"}', '2021-12-30 11:59:50', '2022-02-16 09:07:51');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `created_at`, `updated_at`) VALUES
(61, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Sequi impedit culpa distinctio dolor\",\"description_nic\":\"<p class=\\\"mt-4 mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h3 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.5rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h3><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.375rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h4><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h5 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.25rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h5><div class=\\\"row g-4\\\" style=\\\"color:rgb(70,70,70);font-family:Roboto, sans-serif;\\\"><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Must have medical certificat<\\/li><\\/ul><\\/div><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Must have medical certificat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><\\/ul><\\/div><\\/div>\",\"blog_image\":\"620d13c7e1fbc1645024199.jpg\"}', '2021-12-30 12:00:23', '2022-02-16 09:10:00'),
(62, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Nam odio molestias possimus perspiciatis.\",\"description_nic\":\"<p class=\\\"mt-4 mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h3 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.5rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h3><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><div class=\\\"my-4\\\" style=\\\"color:rgb(70,70,70);font-family:Roboto, sans-serif;\\\"><div class=\\\"row g-4\\\"><div class=\\\"col-md-6\\\" style=\\\"width:410px;max-width:100%;\\\"><img src=\\\"https:\\/\\/localhost\\/project\\/updated\\/hotelbooking\\/assets\\/images\\/frontend\\/blog\\/5f9d068a341211604126346.jpg\\\" alt=\\\"viserfly\\\" class=\\\"blog-post__img-is rounded\\\" style=\\\"height:270px;width:386px;\\\" \\/><\\/div><div class=\\\"col-md-6\\\" style=\\\"width:410px;max-width:100%;\\\"><img src=\\\"https:\\/\\/localhost\\/project\\/updated\\/hotelbooking\\/assets\\/images\\/frontend\\/blog\\/5f9d068a341211604126346.jpg\\\" alt=\\\"viserfly\\\" class=\\\"blog-post__img-is rounded\\\" style=\\\"height:270px;width:386px;\\\" \\/><\\/div><\\/div><\\/div><h4 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.375rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h4><p class=\\\"mb-3\\\" style=\\\"color:rgb(70,70,70);font-size:16px;margin-right:0px;margin-left:0px;font-family:Roboto, sans-serif;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h5 class=\\\"text-capitalize mb-3\\\" style=\\\"font-weight:600;line-height:1.3;font-size:1.25rem;color:rgb(55,62,74);font-family:\'Playfair Display\', serif;\\\">Maecenas Dempuget Condimentum Rhoncus<\\/h5><div class=\\\"row g-4\\\" style=\\\"color:rgb(70,70,70);font-family:Roboto, sans-serif;\\\"><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Must have medical certificat<\\/li><\\/ul><\\/div><div class=\\\"col-lg-6\\\" style=\\\"width:410px;max-width:100%;\\\"><ul class=\\\"list list--primary list--column\\\"><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Must have medical certificat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Curabitur ullamcorper ultricies nisiam eget<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Fringilla mauris sit amet nibonec sodales<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin:0px 0px 0.5rem;\\\">\\u00a0Aenean leo ligula porttitor euconsequat<\\/li><li class=\\\"list__item list--column__item-sm\\\" style=\\\"margin-top:0px;margin-right:0px;margin-left:0px;\\\">\\u00a0Maecenas tempus tellus eget condim<\\/li><\\/ul><\\/div><\\/div>\",\"blog_image\":\"620d13d762d051645024215.jpg\"}', '2021-12-30 12:01:06', '2022-02-16 09:10:15'),
(63, 'footer.content', '{\"has_image\":\"1\",\"short_description\":\"Real Homes|Real Student|Real Success\",\"address\":\"\\u00a0\",\"background_image\":\"61cdac5c147871640868956.jpg\"}', '2021-12-30 12:25:56', '2024-06-18 07:19:28'),
(64, 'auth.content', '{\"heading\":\"Find Your Own Apartment\",\"sub_heading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laboriosam dolor est beatae a possimus cumque quaerat, provident.\",\"has_image\":\"1\",\"background_image\":\"61cfee13d4ce21641016851.jpg\"}', '2022-01-01 05:30:51', '2022-01-01 05:30:53'),
(65, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/www.twitter.com\\/\"}', '2022-01-16 12:32:52', '2022-01-16 12:32:52'),
(66, 'social_icon.element', '{\"title\":\"LinkedIn\",\"social_icon\":\"<i class=\\\"lab la-linkedin-in\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"}', '2022-01-16 12:33:16', '2022-01-16 12:33:16'),
(69, 'subscribe.content', '{\"heading\":\"Subscribe to our weekly newsletter\"}', '2022-02-03 10:35:42', '2024-06-18 08:25:57'),
(70, 'login.content', '{\"has_image\":\"1\",\"heading\":\"Find Your Own Apartment\",\"sub_heading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laboriosam dolor est beatae a possimus cumque quaerat, provident.\",\"background_image\":\"62075a78e99771644649080.jpg\"}', '2022-02-12 06:28:00', '2022-02-12 06:34:38'),
(71, 'register.content', '{\"has_image\":\"1\",\"heading\":\"Find Your Own Apartment\",\"sub_heading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laboriosam dolor est beatae a possimus cumque quaerat, provident.\",\"background_image\":\"62075bed6ab921644649453.jpg\"}', '2022-02-12 06:34:13', '2022-02-12 06:34:14'),
(72, '2fa_verify.content', '{\"has_image\":\"1\",\"heading\":\"Find Your Own Apartment\",\"sub_heading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laboriosam dolor est beatae a possimus cumque quaerat, provident.\",\"background_image\":\"62075ee7e5d451644650215.jpg\"}', '2022-02-12 06:46:55', '2022-02-12 06:46:56'),
(73, 'code_verify.content', '{\"has_image\":\"1\",\"heading\":\"Find Your Own Apartment\",\"sub_heading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laboriosam dolor est beatae a possimus cumque quaerat, provident.\",\"background_image\":\"62075f497fe351644650313.jpg\"}', '2022-02-12 06:48:33', '2022-02-12 06:48:34'),
(74, 'email_verify.content', '{\"has_image\":\"1\",\"heading\":\"Find Your Own Apartment\",\"sub_heading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laboriosam dolor est beatae a possimus cumque quaerat, provident.\",\"background_image\":\"62075f5fdfb441644650335.jpg\"}', '2022-02-12 06:48:55', '2022-02-12 06:48:56'),
(75, 'reset_password.content', '{\"has_image\":\"1\",\"heading\":\"Find Your Own Apartment\",\"sub_heading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laboriosam dolor est beatae a possimus cumque quaerat, provident.\",\"background_image\":\"62075f787613d1644650360.jpg\"}', '2022-02-12 06:49:07', '2022-02-12 06:49:21'),
(76, 'sms_verify.content', '{\"has_image\":\"1\",\"heading\":\"Find Your Own Apartment\",\"sub_heading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laboriosam dolor est beatae a possimus cumque quaerat, provident.\",\"background_image\":\"62075f83d8f1b1644650371.jpg\"}', '2022-02-12 06:49:31', '2022-02-12 06:49:32'),
(77, 'reset_password_email.content', '{\"has_image\":\"1\",\"heading\":\"Find Your Own Apartment\",\"sub_heading\":\"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti laboriosam dolor est beatae a possimus cumque quaerat, provident.\",\"background_image\":\"620762dc654ea1644651228.jpg\"}', '2022-02-12 07:03:48', '2022-02-12 07:03:49'),
(79, 'agents.content', '{\"has_image\":\"1\",\"heading\":\"Top Agents\",\"sub_heading\":\"You\'re in safe hands\"}', '2024-06-20 11:29:22', '2024-06-20 11:29:22'),
(80, 'faq.content', '{\"heading\":\"Frequently Asked Questions\",\"sub_heading\":\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.\"}', NULL, NULL),
(81, 'faq.element', '{\"question\":\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem\",\"answer\":\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.\"}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

DROP TABLE IF EXISTS `gateways`;
CREATE TABLE IF NOT EXISTS `gateways` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` int DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `supported_currencies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `crypto` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `input_form` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `code`, `name`, `alias`, `image`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `input_form`, `created_at`, `updated_at`) VALUES
(1, 101, 'Paypal', 'Paypal', '5f6f1bd8678601601117144.jpg', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-owud61543012@business.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:04:38'),
(2, 102, 'Perfect Money', 'PerfectMoney', '5f6f1d2a742211601117482.jpg', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"hR26aw02Q1eEeUPSIfuwNypXX\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:35:33'),
(3, 103, 'Stripe Hosted', 'Stripe', '5f6f1d4bc69e71601117515.jpg', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:48:36'),
(4, 104, 'Skrill', 'Skrill', '5f6f1d41257181601117505.jpg', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:30:16'),
(5, 105, 'PayTM', 'Paytm', '5f6f1d1d3ec731601117469.jpg', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 03:00:44'),
(6, 106, 'Payeer', 'Payeer', '5f6f1bc61518b1601117126.jpg', 0, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, NULL, '2019-09-14 13:14:22', '2020-12-28 01:26:58'),
(7, 107, 'PayStack', 'Paystack', '5f7096563dfb71601214038.jpg', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_cd330608eb47970889bca397ced55c1dd5ad3783\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_8a0b1f199362d7acc9c390bff72c4e81f74e2ac3\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:49:51'),
(8, 108, 'VoguePay', 'Voguepay', '5f6f1d5951a111601117529.jpg', 1, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"demo\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:22:38'),
(9, 109, 'Flutterwave', 'Flutterwave', '5f6f1b9e4bb961601117086.jpg', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-06-05 11:37:45'),
(10, 110, 'RazorPay', 'Razorpay', '5f6f1d3672dd61601117494.jpg', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:51:32'),
(11, 111, 'Stripe Storefront', 'StripeJs', '5f7096a31ed9a1601214115.jpg', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:53:10'),
(12, 112, 'Instamojo', 'Instamojo', '5f6f1babbdbb31601117099.jpg', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:56:20'),
(13, 501, 'Blockchain', 'Blockchain', '5f6f1b2b20c6f1601116971.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:25:00'),
(14, 502, 'Block.io', 'Blockio', '5f6f19432bedf1601116483.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":false,\"value\":\"1658-8015-2e5e-9afb\"},\"api_pin\":{\"title\":\"API PIN\",\"global\":true,\"value\":\"75757575\"}}', '{\"BTC\":\"BTC\",\"LTC\":\"LTC\"}', 1, '{\"cron\":{\"title\": \"Cron URL\",\"value\":\"ipn.Blockio\"}}', NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:31:09'),
(15, 503, 'CoinPayments', 'Coinpayments', '5f6f1b6c02ecd1601117036.jpg', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:07:14'),
(16, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', '5f6f1b94e9b2b1601117076.jpg', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"6515561\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:07:44'),
(17, 505, 'Coingate', 'Coingate', '5f6f1b5fe18ee1601117023.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"6354mwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:49:30'),
(18, 506, 'Coinbase Commerce', 'CoinbaseCommerce', '5f6f1b4c774af1601117004.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:02:47'),
(24, 113, 'Paypal Express', 'PaypalSdk', '5f6f1bec255c61601117164.jpg', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-20 23:01:08'),
(25, 114, 'Stripe Checkout', 'StripeV3', '5f709684736321601214084.jpg', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:58:38'),
(27, 115, 'Mollie', 'Mollie', '5f6f1bb765ab11601117111.jpg', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"vi@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:44:45'),
(30, 116, 'Cashmaal', 'Cashmaal', '60d1a0b7c98311624350903.png', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, NULL, '2021-06-22 08:05:04'),
(36, 119, 'Mercado Pago', 'MercadoPago', '60f2ad85a82951626516869.png', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"3Vee5S2F\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, NULL, '2021-07-17 09:44:29'),
(37, 1000, 'Bank Transfer', 'bank_transfer', '66780cd5f406e1719143637.png', 1, '[]', '[]', 0, NULL, 'Provide Payment Proof', '{\"proof\":{\"field_name\":\"proof\",\"field_level\":\"Proof\",\"type\":\"file\",\"validation\":\"nullable\"},\"note\":{\"field_name\":\"note\",\"field_level\":\"Note\",\"type\":\"textarea\",\"validation\":\"nullable\"}}', '2024-06-23 10:53:42', '2024-06-23 10:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

DROP TABLE IF EXISTS `gateway_currencies`;
CREATE TABLE IF NOT EXISTS `gateway_currencies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int DEFAULT NULL,
  `gateway_alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `max_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) NOT NULL DEFAULT '0.00',
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_parameter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateway_currencies`
--

INSERT INTO `gateway_currencies` (`id`, `name`, `currency`, `symbol`, `method_code`, `gateway_alias`, `min_amount`, `max_amount`, `percent_charge`, `fixed_charge`, `rate`, `image`, `gateway_parameter`, `created_at`, `updated_at`) VALUES
(1, 'Bank Transfer', 'NGN', '', 1000, 'bank_transfer', 1000.00000000, 10000000.00000000, 0.00, 0.00000000, 1.00000000, '66780cd5f406e1719143637.png', '{\"proof\":{\"field_name\":\"proof\",\"field_level\":\"Proof\",\"type\":\"file\",\"validation\":\"nullable\"},\"note\":{\"field_name\":\"note\",\"field_level\":\"Note\",\"type\":\"textarea\",\"validation\":\"nullable\"}}', '2024-06-23 10:53:43', '2024-06-23 10:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

DROP TABLE IF EXISTS `general_settings`;
CREATE TABLE IF NOT EXISTS `general_settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sitename` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_api` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_max_star` tinyint UNSIGNED DEFAULT '1',
  `mail_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'email configuration',
  `sms_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sms verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sms notification, 0 - dont send, 1 - send',
  `force_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `secure_password` tinyint(1) NOT NULL DEFAULT '0',
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `registration` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sys_version` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `sitename`, `cur_text`, `cur_sym`, `email_from`, `email_template`, `sms_api`, `base_color`, `property_max_star`, `mail_config`, `sms_config`, `ev`, `en`, `sv`, `sn`, `force_ssl`, `secure_password`, `agree`, `registration`, `active_template`, `sys_version`, `created_at`, `updated_at`) VALUES
(1, 'Hochela', 'NGN', '₦', 'info@hochela.com', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\"><a href=\"#\"><img src=\"https://i.imgur.com/z5uHdr2.png\" width=\"481\"><br>\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2024&nbsp;<a href=\"#\">Website Name</a> . All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{name}}, {{message}}', '3059B8', 3, '{\"name\":\"php\"}', '{\"clickatell_api_key\":\"----------------------------\",\"infobip_username\":\"--------------\",\"infobip_password\":\"----------------------\",\"message_bird_api_key\":\"-------------------\",\"nexmo_api_key\":\"----------------------\",\"nexmo_api_secret\":\"----------------------\",\"sms_broadcast_username\":\"----------------------\",\"sms_broadcast_password\":\"-----------------------------\",\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\",\"text_magic_username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\",\"name\":\"textMagic\"}', 0, 1, 0, 0, 0, 0, 1, 1, 'basic', NULL, NULL, '2024-06-18 00:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_align` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: left to right text align, 1: right to left text align',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `text_align`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', '5f15968db08911595250317.png', 0, 1, '2020-07-06 03:47:55', '2022-02-16 08:34:35'),
(5, 'Hindi', 'hn', NULL, 0, 0, '2020-12-29 02:20:07', '2020-12-29 02:20:16'),
(9, 'Bangla', 'bn', NULL, 0, 0, '2021-03-14 04:37:41', '2021-05-12 05:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `average_price` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `image` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `average_price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Warri', 250000.00000000, '66706d53747441718644051.png', 1, '2024-06-17 16:07:31', '2024-06-17 16:07:31'),
(2, 'Lagos', 350000.00000000, '66706e17e30f11718644247.png', 1, '2024-06-17 16:10:48', '2024-06-17 16:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_06_20_070801_create_bloggers_table', 1),
(3, '2024_06_21_015654_create_roles_table', 2),
(4, '2024_06_21_070423_create_categories_table', 3),
(5, '2024_06_21_071644_create_news_table', 4),
(6, '2024_06_23_092632_create_agent_reviews_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `category_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` mediumtext COLLATE utf8mb4_unicode_ci,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `have_video` tinyint(1) NOT NULL DEFAULT '0',
  `video_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int NOT NULL DEFAULT '0',
  `must_read` tinyint(1) NOT NULL DEFAULT '0',
  `trending` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `admin_check` tinyint NOT NULL DEFAULT '0' COMMENT '0=Not checked, 1=Approved, 2=Rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `user_id`, `category_id`, `title`, `tags`, `short_description`, `description`, `image`, `have_video`, `video_link`, `views`, `must_read`, `trending`, `status`, `admin_check`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Housing', '[\"house\",\"landlord\"]', 'This description', 'Hello world', '2024/06/21/66755798f3b791718966168.jpg', 0, NULL, 0, 0, 0, 1, 1, '2024-06-21 09:36:09', '2024-06-21 09:42:18'),
(2, 4, 1, 'Testing Blog again', '[\"landlord\"]', 'Blog by blogger', 'Hello', '2024/06/21/66756ba72485e1718971303.jpg', 0, NULL, 0, 0, 0, 1, 1, '2024-06-21 11:01:43', '2024-06-21 11:01:43'),
(3, 4, 1, 'Rejected Blog', '[\"rejected\"]', 'Rejected blog post', 'testing rejected&nbsp;Rejected blog post', '2024/06/22/6676c3d11b9c31719059409.jpg', 0, NULL, 0, 0, 0, 1, 1, '2024-05-21 04:23:18', '2024-06-22 11:30:09'),
(4, 4, 1, 'Testing the secong pending blog post12', '[\"rejected\"]', 'Hello world12', 'Testing theories', '2024/06/22/6676c3b2eafc61719059378.jpg', 0, NULL, 0, 0, 0, 1, 1, '2024-06-22 04:27:05', '2024-06-22 11:29:39'),
(5, 4, 1, 'Tesing Recent Post', '[\"nice\"]', 'Short Description', 'This is long description', '2024/06/22/6676c3c301a921719059395.jpg', 0, NULL, 0, 0, 0, 1, 1, '2024-06-22 11:21:28', '2024-06-22 11:29:55'),
(6, 4, 1, 'Fun people', '[\"happy\",\"techlige\"]', 'short description', 'this is the post body', '2024/06/22/6676f802219521719072770.png', 0, NULL, 0, 0, 0, 1, 1, '2024-06-22 15:12:50', '2024-06-22 15:13:54');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

DROP TABLE IF EXISTS `owners`;
CREATE TABLE IF NOT EXISTS `owners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `balance` decimal(38,8) UNSIGNED NOT NULL DEFAULT '0.00000000',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `ev` tinyint NOT NULL DEFAULT '0',
  `sv` tinyint NOT NULL DEFAULT '0',
  `ver_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ver_code_send_at` datetime NOT NULL,
  `ts` tinyint NOT NULL DEFAULT '0',
  `tv` tinyint NOT NULL DEFAULT '1',
  `tsc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `firstname`, `lastname`, `username`, `mobile`, `email`, `email_verified_at`, `balance`, `password`, `country_code`, `image`, `about_me`, `address`, `status`, `ev`, `sv`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Doe', 'johndoe', '438605252927', 'johndoe@gmail.com', NULL, 0.00000000, '$2y$10$eJ/1AEmNHuYAbe0oUFwXZuF6Brn4SA7Rvt8ADQWqamHBmWnfrjXwC', 'AT', NULL, '', '{\"address\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"Austria\",\"city\":\"\"}', 1, 1, 1, NULL, '0000-00-00 00:00:00', 0, 1, NULL, '2024-06-17 23:52:31', '2024-06-17 23:52:31'),
(2, 'Daniel', 'Doss', 'mikeamon', '938605252927', 'danieldoss@gmail.com', NULL, 0.00000000, '$2y$10$hyy2GME9ZQ39cbK/QM.Ooe556C4ZannM.BifhlzLyzGfLyYOCHY7y', 'AF', NULL, '', '{\"address\":null,\"city\":null,\"state\":null,\"zip\":null,\"country\":\"Afghanistan\"}', 1, 1, 1, NULL, '0000-00-00 00:00:00', 0, 1, NULL, '2024-06-20 07:55:59', '2024-06-20 11:30:29'),
(3, 'Dave', 'Doss', 'davedoss', '18605252927', 'davedoss@gmail.com', NULL, 0.00000000, '$2y$10$ULH3TKTt2wup/t.KidWX4ui.OXd0S7kfObxaeppFR7aUoSqm92N1y', 'US', '66743b9c106ea1718893468.jpeg', 'I love music and I am trustworthy', '{\"address\":\"recipient address\",\"state\":\"Delta\",\"zip\":\"22323\",\"country\":\"United States\",\"city\":\"Soio\"}', 1, 1, 1, NULL, '0000-00-00 00:00:00', 0, 1, NULL, '2024-06-20 13:15:38', '2024-06-23 10:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `owner_password_resets`
--

DROP TABLE IF EXISTS `owner_password_resets`;
CREATE TABLE IF NOT EXISTS `owner_password_resets` (
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', 'home', 'templates.basic.', '[\"location\",\"property_type\",\"top_trip\",\"agents\",\"works\",\"blog\",\"subscribe\"]', 1, '2020-07-11 06:23:58', '2024-06-20 11:35:51'),
(4, 'Blog', 'blog', 'templates.basic.', NULL, 1, '2020-10-22 01:14:43', '2022-02-12 05:27:43'),
(5, 'Contact', 'contact', 'templates.basic.', NULL, 1, '2020-10-22 01:14:53', '2024-06-22 11:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_type_id` int UNSIGNED NOT NULL DEFAULT '0',
  `owner_id` int UNSIGNED NOT NULL DEFAULT '0',
  `bloggers_id` int UNSIGNED NOT NULL DEFAULT '0',
  `location_id` int UNSIGNED NOT NULL DEFAULT '0',
  `discount` decimal(5,2) DEFAULT '0.00',
  `total_rating` int UNSIGNED NOT NULL DEFAULT '0',
  `review` int UNSIGNED NOT NULL DEFAULT '0',
  `rating` decimal(28,8) UNSIGNED NOT NULL DEFAULT '0.00000000',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `map_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `phone` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_call_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_features` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `star` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `top_reviewed` tinyint(1) NOT NULL DEFAULT '0',
  `all_time_booked_counter` int UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `property_type_id`, `owner_id`, `bloggers_id`, `location_id`, `discount`, `total_rating`, `review`, `rating`, `description`, `map_url`, `image`, `images`, `phone`, `phone_call_time`, `extra_features`, `star`, `top_reviewed`, `all_time_booked_counter`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Major Hostel', 1, 1, 0, 1, 3.00, 0, 0, 0.00000000, '<br>', NULL, '6670daadb10901718672045.png', '[]', '8605252927', '8605252927', '[\"light\",\"wifi\"]', 3, 0, 0, 1, '2024-06-17 23:54:06', '2024-06-18 00:02:49'),
(2, 'Oxford Hostel', 2, 1, 0, 1, 0.00, 0, 0, 0.00000000, '<br>', NULL, '66719d1f2bdfb1718721823.png', '[\"66719d1e6c98d1718721822.png\",\"66719d1eb4e911718721822.png\",\"66719d1f2bdfb1718721823.png\"]', '8605252927', '8605252927', '[\"light\"]', 3, 0, 0, 1, '2024-06-18 00:04:49', '2024-06-18 13:43:43'),
(3, 'Newford', 1, 2, 0, 1, 0.00, 0, 0, 0.00000000, 'good accommodation', NULL, '667434ad6b77c1718891693.jpg', '[\"667434ad5636c1718891693.jpg\",\"667434ad6b77c1718891693.jpg\"]', '8605252927', '8605252927', '[\"light\",\"security\"]', 3, 0, 0, 1, '2024-06-20 12:54:53', '2024-06-20 12:54:53'),
(4, 'New city hostel', 1, 3, 0, 2, 0.00, 0, 0, 0.00000000, 'Safe environmrnt', NULL, '66743b5410cdd1718893396.jpg', '[\"66743b53d55271718893395.jpg\",\"66743b53ed0ca1718893395.jpg\",\"66743b5410cdd1718893396.jpg\"]', '8605252927', '8605252927', '[\"security\",\"24hours light\"]', 2, 0, 0, 1, '2024-06-20 13:23:16', '2024-06-20 13:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

DROP TABLE IF EXISTS `property_types`;
CREATE TABLE IF NOT EXISTS `property_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Single Room', '6670d6576078e1718670935.png', 1, '2024-06-17 23:35:35', '2024-06-18 00:58:59'),
(2, '2 Bedrom Flat', '6670dcf6e9cdc1718672630.png', 1, '2024-06-18 00:03:51', '2024-06-18 00:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `rating` int UNSIGNED NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `property_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Blogger', 0, NULL, NULL),
(2, 'Super Admin', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_number` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult` int UNSIGNED NOT NULL DEFAULT '0',
  `child` int UNSIGNED NOT NULL DEFAULT '0',
  `price` decimal(28,8) UNSIGNED NOT NULL DEFAULT '0.00000000',
  `property_id` int UNSIGNED NOT NULL DEFAULT '0',
  `owner_id` int UNSIGNED NOT NULL DEFAULT '0',
  `room_category_id` int UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `adult`, `child`, `price`, `property_id`, `owner_id`, `room_category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '301', 1, 1, 150000.00000000, 1, 1, 1, 1, '2024-06-17 23:58:28', '2024-06-17 23:58:28'),
(2, '302', 1, 1, 500000.00000000, 2, 1, 2, 1, '2024-06-18 00:07:03', '2024-06-18 00:07:03'),
(3, '344', 3, 2, 2000000.00000000, 3, 2, 3, 1, '2024-06-20 12:55:22', '2024-06-20 12:55:22'),
(4, '232', 3, 2, 150000.00000000, 4, 3, 4, 1, '2024-06-20 13:26:23', '2024-06-20 13:26:23'),
(5, '123', 3, 2, 150000.00000000, 4, 3, 4, 1, '2024-06-20 13:26:23', '2024-06-20 13:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `room_categories`
--

DROP TABLE IF EXISTS `room_categories`;
CREATE TABLE IF NOT EXISTS `room_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_categories`
--

INSERT INTO `room_categories` (`id`, `name`, `property_id`, `created_at`, `updated_at`) VALUES
(1, 'Medium Size room', 1, '2024-06-17 23:55:31', '2024-06-17 23:55:31'),
(2, 'Medium Size room', 2, '2024-06-18 00:05:50', '2024-06-18 00:05:50'),
(3, 'Medium Size room', 3, '2024-06-20 12:55:22', '2024-06-20 12:55:22'),
(4, 'Medium Size room', 4, '2024-06-20 13:26:23', '2024-06-20 13:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'temiopeabd02@gmail.com', '2024-06-20 06:56:31', '2024-06-20 06:56:31'),
(2, 'newman@dav.com', '2024-06-23 11:30:19', '2024-06-23 11:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

DROP TABLE IF EXISTS `support_attachments`;
CREATE TABLE IF NOT EXISTS `support_attachments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `support_message_id` int UNSIGNED NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

DROP TABLE IF EXISTS `support_messages`;
CREATE TABLE IF NOT EXISTS `support_messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supportticket_id` int UNSIGNED NOT NULL DEFAULT '0',
  `admin_id` int UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_messages`
--

INSERT INTO `support_messages` (`id`, `supportticket_id`, `admin_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Location of the mail and response time', '2024-06-20 07:01:43', '2024-06-20 07:01:43'),
(2, 2, 0, 'World people', '2024-06-23 10:12:01', '2024-06-23 10:12:01'),
(3, 2, 1, 'Thank you for your message', '2024-06-23 10:14:02', '2024-06-23 10:14:02'),
(4, 3, 0, 'Testing this out', '2024-06-23 11:35:45', '2024-06-23 11:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

DROP TABLE IF EXISTS `support_tickets`;
CREATE TABLE IF NOT EXISTS `support_tickets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT '0',
  `owner_id` int UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `owner_id`, `name`, `email`, `ticket`, `subject`, `status`, `priority`, `last_reply`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'Hochela Limited', 'contact@hochela.com', '09998019', 'Time you respond!', 0, 2, '2024-06-20 03:01:42', '2024-06-20 07:01:42', '2024-06-20 07:01:42'),
(2, 1, 0, 'Mike Doss', 'mikedoss@gmail.com', '183521', 'Hello', 1, 2, '2024-06-23 11:14:02', '2024-06-23 10:12:01', '2024-06-23 10:14:02'),
(3, 0, 0, 'John Doe', 'admin@admin.com', '16936616', 'Welcome', 0, 2, '2024-06-23 12:35:45', '2024-06-23 11:35:45', '2024-06-23 11:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `owner_id` int UNSIGNED NOT NULL DEFAULT '0',
  `bloggers_id` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `post_balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_by` int UNSIGNED NOT NULL DEFAULT '0',
  `balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'contains full address',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: banned, 1: active',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: sms unverified, 1: sms verified',
  `ver_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `country_code`, `mobile`, `ref_by`, `balance`, `password`, `image`, `address`, `status`, `ev`, `sv`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mike', 'Doss', 'mikedoss', 'mikedoss@gmail.com', 'NG', '2348062765353', 0, 0.00000000, '$2y$10$GlvxjEwW50qSCgAMGlCy6eBt0BMX/HvRUg0t4K7Uz5/p9giUuCJjm', NULL, '{\"address\":\"\",\"state\":\"\",\"zip\":\"\",\"country\":\"Nigeria\",\"city\":\"\"}', 1, 1, 1, NULL, NULL, 0, 1, NULL, NULL, '2024-06-18 12:09:28', '2024-06-18 12:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

DROP TABLE IF EXISTS `user_logins`;
CREATE TABLE IF NOT EXISTS `user_logins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `owner_id` int UNSIGNED NOT NULL DEFAULT '0',
  `bloggers_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_ip` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `owner_id`, `bloggers_id`, `user_ip`, `city`, `country`, `country_code`, `longitude`, `latitude`, `browser`, `os`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 0, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-17 23:52:32', '2024-06-17 23:52:32'),
(2, 1, 0, 0, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-18 12:09:28', '2024-06-18 12:09:28'),
(3, 1, 0, 0, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-18 14:21:42', '2024-06-18 14:21:42'),
(4, 0, 2, 0, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 07:55:59', '2024-06-20 07:55:59'),
(5, 0, 0, 6, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 08:21:49', '2024-06-20 08:21:49'),
(6, 0, 0, 7, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 08:23:33', '2024-06-20 08:23:33'),
(7, 0, 0, 8, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 08:26:04', '2024-06-20 08:26:04'),
(8, 0, 0, 9, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 08:31:38', '2024-06-20 08:31:38'),
(9, 0, 0, 10, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 08:34:17', '2024-06-20 08:34:17'),
(10, 0, 0, 11, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 08:51:28', '2024-06-20 08:51:28'),
(11, 0, 0, 12, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 08:54:57', '2024-06-20 08:54:57'),
(12, 0, 0, 13, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 08:55:23', '2024-06-20 08:55:23'),
(13, 0, 0, 14, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 08:55:59', '2024-06-20 08:55:59'),
(14, 0, 0, 15, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 08:58:10', '2024-06-20 08:58:10'),
(15, 0, 0, 16, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 08:59:18', '2024-06-20 08:59:18'),
(16, 0, 0, 17, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 09:02:30', '2024-06-20 09:02:30'),
(17, 0, 0, 18, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 09:03:03', '2024-06-20 09:03:03'),
(18, 0, 0, 19, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 09:04:51', '2024-06-20 09:04:51'),
(19, 0, 0, 20, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 09:15:48', '2024-06-20 09:15:48'),
(20, 0, 2, 0, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 12:52:53', '2024-06-20 12:52:53'),
(21, 0, 3, 0, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-20 13:15:38', '2024-06-20 13:15:38'),
(22, 1, 0, 0, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-23 08:06:46', '2024-06-23 08:06:46'),
(23, 1, 0, 0, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-23 08:13:33', '2024-06-23 08:13:33'),
(24, 1, 0, 0, '::1', '', '', '', '', '', 'Chrome', 'Windows 10', '2024-06-23 11:46:47', '2024-06-23 11:46:47');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

DROP TABLE IF EXISTS `withdrawals`;
CREATE TABLE IF NOT EXISTS `withdrawals` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `method_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `owner_id` int UNSIGNED NOT NULL DEFAULT '0',
  `bloggers_id` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `after_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `withdraw_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel,  ',
  `admin_feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

DROP TABLE IF EXISTS `withdraw_methods`;
CREATE TABLE IF NOT EXISTS `withdraw_methods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_limit` decimal(28,8) DEFAULT '0.00000000',
  `max_limit` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `delay` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_charge` decimal(28,8) DEFAULT '0.00000000',
  `rate` decimal(28,8) DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
