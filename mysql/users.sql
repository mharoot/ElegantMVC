-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2018 at 10:43 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `first_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'first name',
  `last_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'last name',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'user''s activation status',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attemps',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `user_type` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_rememberme_token`, `user_failed_logins`, `user_last_failed_login`, `user_registration_datetime`, `user_registration_ip`, `user_type`) VALUES
(1, 'Michael', 'Harootoonyan', 'MichaelHarootoonyan', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', NULL, 1, 'd5950a59ad5d57f1b0f1a9e8d66302789cab2845', NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', 'deprecated', 1),
(2, 'Marvin', 'Harootoonyan', 'MarvinHarootoonyan', '$2y$10$cq7BbbWzaQA/F34bTBpjbeC8XuDONDlIIS0pzTNIjPwPKrpgAumy.', NULL, 1, '045dd515ab932d284b5d6c3fb535809a1c4bd9fa', NULL, NULL, NULL, 0, NULL, '2018-02-04 13:31:14', 'deprecated', 1),
(3, 'Chris', 'Silva', 'ChrisSilva', '$2y$10$.tqt7Y2xGDrCl0e1k2JUkuofI7FoJZO9HppytDMiz/p4v1PII3maO', NULL, 1, 'd9bab13e9f87a7642f39aaab4b10b83202e6f027', NULL, NULL, NULL, 0, NULL, '2018-02-04 13:42:11', 'deprecated', 1),
(4, 'Chad', 'Buntrakulsuk', 'ChadBuntrakulsuk', '$2y$10$zO4YC6vHxCyE3LcXX86h9eaWhIp50JbFAM16Qt3z94N.pOg8kXWPe', NULL, 1, 'a0e3e58ef5833f90faed5fa4c6e7f9208c6af394', NULL, NULL, NULL, 0, NULL, '2018-02-04 13:42:30', 'deprecated', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
