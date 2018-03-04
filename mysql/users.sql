-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2018 at 09:34 PM
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
-- Database: `elegant-mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `first_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'first name',
  `last_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'last name',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status 0 = inactive, 1 = active',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attemps',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_registration_datetime` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_registration_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `user_type` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_rememberme_token`, `user_failed_logins`, `user_last_failed_login`, `user_registration_datetime`, `user_registration_ip`, `user_type`) VALUES
(1, 'Michael', 'Harootoonyan', 'MichaelHarootoonyan', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'michael.harootoonyan.535@my.csun.edu', 1, NULL, NULL, NULL, '9c8836915cc93f3efa95e6398a02f8c914a858c1d2b8a7f299754bc5f8d2014d', 0, NULL, '2018-02-04 13:26:03', '::1', 1),
(2, 'Marvin', 'Harootoonyan', 'MarvinHarootoonyan', '$2y$10$cq7BbbWzaQA/F34bTBpjbeC8XuDONDlIIS0pzTNIjPwPKrpgAumy.', 'marvin.harootoonyan.570@my.csun.edu', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:31:14', '::1', 1),
(3, 'Chris', 'Silva', 'ChrisSilva', '$2y$10$.tqt7Y2xGDrCl0e1k2JUkuofI7FoJZO9HppytDMiz/p4v1PII3maO', 'christopher.silva.11@my.csun.edu', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:42:11', '::1', 1),
(4, 'Chad', 'Buntrakulsuk', 'ChadBuntrakulsuk', '$2y$10$zO4YC6vHxCyE3LcXX86h9eaWhIp50JbFAM16Qt3z94N.pOg8kXWPe', 'chad.buntrakulsuk.770@my.csun.edu', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:42:30', '::1', 1),
(5, 'Foo', 'Bar', 'FooBar', '$2y$10$mBXq6U8PdtaioaWRLfBoSORz1xiIfUEtO75jQ/65BirYemVCQby1i', 'michaelharootoonyan@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-09 23:15:59', '192.168.1.130', 2),
(6, 'Maria', 'Anders', 'MariaAnders1', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MariaAnders@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(7, 'Ana', 'Trujillo', 'AnaTrujillo2', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AnaTrujillo@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(8, 'Antonio', 'Moreno', 'AntonioMoreno3', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AntonioMoreno@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(9, 'Thomas', 'Hardy', 'ThomasHardy4', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ThomasHardy@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(10, 'Christina', 'Berglund', 'ChristinaBerglund5', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ChristinaBerglund@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(11, 'Hanna', 'Moos', 'HannaMoos6', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'HannaMoos@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(12, 'FrÃ©dÃ©rique', 'Citeaux', 'FrÃ©dÃ©riqueCiteaux7', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'FrÃ©dÃ©riqueCiteaux@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(13, 'MartÃ­n', 'Sommer', 'MartÃ­nSommer8', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MartÃ­nSommer@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(14, 'Laurence', 'Lebihans', 'LaurenceLebihans9', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'LaurenceLebihans@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(15, 'Elizabeth', 'Lincoln', 'ElizabethLincoln10', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ElizabethLincoln@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(16, 'Victoria', 'Ashworth', 'VictoriaAshworth11', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'VictoriaAshworth@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(17, 'Patricio', 'Simpson', 'PatricioSimpson12', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PatricioSimpson@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(18, 'Francisco', 'Chang', 'FranciscoChang13', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'FranciscoChang@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(19, 'Yang', 'Wang', 'YangWang14', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'YangWang@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(20, 'Pedro', 'Afonso', 'PedroAfonso15', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PedroAfonso@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(21, 'Elizabeth', 'Brown', 'ElizabethBrown16', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ElizabethBrown@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(22, 'Sven', 'Ottlieb', 'SvenOttlieb17', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'SvenOttlieb@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(23, 'Janine', 'Labrune', 'JanineLabrune18', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'JanineLabrune@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(24, 'Ann', 'Devon', 'AnnDevon19', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AnnDevon@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(25, 'Roland', 'Mendel', 'RolandMendel20', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'RolandMendel@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(26, 'Aria', 'Cruz', 'AriaCruz21', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AriaCruz@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(27, 'Diego', 'Roel', 'DiegoRoel22', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'DiegoRoel@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(28, 'Martine', 'RancÃ©', 'MartineRancÃ©23', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MartineRancÃ©@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(29, 'Maria', 'Larsson', 'MariaLarsson24', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MariaLarsson@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(30, 'Peter', 'Franken', 'PeterFranken25', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PeterFranken@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(31, 'Carine', 'Schmitt', 'CarineSchmitt26', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'CarineSchmitt@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(32, 'Paolo', 'Accorti', 'PaoloAccorti27', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PaoloAccorti@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(33, 'Lino', '', 'Lino28', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'Lino@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(34, 'Eduardo', 'Saavedra', 'EduardoSaavedra29', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'EduardoSaavedra@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(35, 'JosÃ©', 'Freyre', 'JosÃ©Freyre30', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'JosÃ©Freyre@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(36, 'AndrÃ©', 'Fonseca', 'AndrÃ©Fonseca31', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AndrÃ©Fonseca@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(37, 'Howard', 'Snyder', 'HowardSnyder32', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'HowardSnyder@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(38, 'Manuel', 'Pereira', 'ManuelPereira33', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ManuelPereira@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(39, 'Mario', 'Pontes', 'MarioPontes34', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MarioPontes@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(40, 'Carlos', 'HernÃ¡ndez', 'CarlosHernÃ¡ndez35', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'CarlosHernÃ¡ndez@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(41, 'Yoshi', 'Latimer', 'YoshiLatimer36', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'YoshiLatimer@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(42, 'Patricia', 'McKenna', 'PatriciaMcKenna37', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PatriciaMcKenna@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(43, 'Helen', 'Bennett', 'HelenBennett38', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'HelenBennett@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(44, 'Philip', 'Cramer', 'PhilipCramer39', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PhilipCramer@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(45, 'Daniel', 'Tonini', 'DanielTonini40', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'DanielTonini@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(46, 'Annette', 'Roulet', 'AnnetteRoulet41', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AnnetteRoulet@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(47, 'Yoshi', 'Tannamuri', 'YoshiTannamuri42', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'YoshiTannamuri@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(48, 'John', 'Steel', 'JohnSteel43', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'JohnSteel@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(49, 'Renate', 'Messner', 'RenateMessner44', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'RenateMessner@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(50, 'Jaime', 'Yorres', 'JaimeYorres45', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'JaimeYorres@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(51, 'Carlos', 'GonzÃ¡lez', 'CarlosGonzÃ¡lez46', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'CarlosGonzÃ¡lez@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(52, 'Felipe', 'Izquierdo', 'FelipeIzquierdo47', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'FelipeIzquierdo@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(53, 'Fran', 'Wilson', 'FranWilson48', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'FranWilson@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(54, 'Giovanni', 'Rovelli', 'GiovanniRovelli49', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'GiovanniRovelli@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(55, 'Catherine', 'Dewey', 'CatherineDewey50', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'CatherineDewey@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(56, 'Jean', 'FresniÃ¨re', 'JeanFresniÃ¨re51', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'JeanFresniÃ¨re@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(57, 'Alexander', 'Feuer', 'AlexanderFeuer52', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AlexanderFeuer@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(58, 'Simon', 'Crowther', 'SimonCrowther53', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'SimonCrowther@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(59, 'Yvonne', 'Moncada', 'YvonneMoncada54', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'YvonneMoncada@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(60, 'Rene', 'Phillips', 'RenePhillips55', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'RenePhillips@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(61, 'Henriette', 'Pfalzheim', 'HenriettePfalzheim56', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'HenriettePfalzheim@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(62, 'Marie', 'Bertrand', 'MarieBertrand57', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MarieBertrand@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(63, 'Guillermo', 'FernÃ¡ndez', 'GuillermoFernÃ¡ndez58', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'GuillermoFernÃ¡ndez@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(64, 'Georg', 'Pipps', 'GeorgPipps59', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'GeorgPipps@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(65, 'Isabel', 'Castro', 'IsabelCastro60', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'IsabelCastro@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(66, 'Bernardo', 'Batista', 'BernardoBatista61', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'BernardoBatista@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(67, 'LÃºcia', 'Carvalho', 'LÃºciaCarvalho62', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'LÃºciaCarvalho@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(68, 'Horst', 'Kloss', 'HorstKloss63', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'HorstKloss@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(69, 'Sergio', 'GutiÃ©rrez', 'SergioGutiÃ©rrez64', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'SergioGutiÃ©rrez@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(70, 'Paula', 'Wilson', 'PaulaWilson65', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PaulaWilson@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(71, 'Maurizio', 'Moroni', 'MaurizioMoroni66', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MaurizioMoroni@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(72, 'Janete', 'Limeira', 'JaneteLimeira67', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'JaneteLimeira@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(73, 'Michael', 'Holz', 'MichaelHolz68', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MichaelHolz@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(74, 'Alejandra', 'Camino', 'AlejandraCamino69', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AlejandraCamino@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(75, 'Jonas', 'Bergulfsen', 'JonasBergulfsen70', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'JonasBergulfsen@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(76, 'Jose', 'Pavarotti', 'JosePavarotti71', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'JosePavarotti@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(77, 'Hari', 'Kumar', 'HariKumar72', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'HariKumar@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(78, 'Jytte', 'Petersen', 'JyttePetersen73', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'JyttePetersen@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(79, 'Dominique', 'Perrier', 'DominiquePerrier74', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'DominiquePerrier@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(80, 'Art', 'Braunschweiger', 'ArtBraunschweiger75', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ArtBraunschweiger@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(81, 'Pascale', 'Cartrain', 'PascaleCartrain76', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PascaleCartrain@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(82, 'Liz', 'Nixon', 'LizNixon77', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'LizNixon@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(83, 'Liu', 'Wong', 'LiuWong78', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'LiuWong@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(84, 'Karin', 'Josephs', 'KarinJosephs79', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'KarinJosephs@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(85, 'Miguel', 'Paolino', 'MiguelPaolino80', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MiguelPaolino@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(86, 'Anabela', 'Domingues', 'AnabelaDomingues81', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AnabelaDomingues@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(87, 'Helvetius', 'Nagy', 'HelvetiusNagy82', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'HelvetiusNagy@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(88, 'Palle', 'Ibsen', 'PalleIbsen83', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PalleIbsen@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(89, 'Mary', 'Saveley', 'MarySaveley84', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MarySaveley@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(90, 'Paul', 'Henriot', 'PaulHenriot85', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PaulHenriot@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(91, 'Rita', 'MÃ¼ller', 'RitaMÃ¼ller86', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'RitaMÃ¼ller@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(92, 'Pirkko', 'Koskitalo', 'PirkkoKoskitalo87', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PirkkoKoskitalo@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(93, 'Paula', 'Parente', 'PaulaParente88', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PaulaParente@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(94, 'Karl', 'Jablonski', 'KarlJablonski89', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'KarlJablonski@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(95, 'Matti', 'Karttunen', 'MattiKarttunen90', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MattiKarttunen@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(96, 'Zbyszek', 'Karttunen', 'ZbyszekKarttunen91', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ZbyszekKarttunen@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 2),
(97, 'Charlotte', 'Cooper', 'CharlotteCooper92', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'CharlotteCooper@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(98, 'Shelley', 'Burke', 'ShelleyBurke93', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ShelleyBurke@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(99, 'Regina', 'Murphy', 'ReginaMurphy94', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ReginaMurphy@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(100, 'Yoshi', 'Nagase', 'YoshiNagase95', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'YoshiNagase@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(101, 'Antonio', '', 'Antonio96', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'Antonio@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(102, 'Mayumi', 'Ohno', 'MayumiOhno97', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MayumiOhno@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(103, 'Ian', 'Devling', 'IanDevling98', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'IanDevling@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(104, 'Peter', 'Wilson', 'PeterWilson99', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PeterWilson@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(105, 'Lars', 'Peterson', 'LarsPeterson100', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'LarsPeterson@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(106, 'Carlos', 'Diaz', 'CarlosDiaz101', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'CarlosDiaz@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(107, 'Petra', 'Winkler', 'PetraWinkler102', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'PetraWinkler@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(108, 'Martin', 'Bein', 'MartinBein103', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MartinBein@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(109, 'Sven', 'Petersen', 'SvenPetersen104', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'SvenPetersen@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(110, 'Elio', 'Rossi', 'ElioRossi105', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ElioRossi@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(111, 'Beate', 'Vileid', 'BeateVileid106', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'BeateVileid@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(112, 'Cheryl', 'Saylor', 'CherylSaylor107', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'CherylSaylor@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(113, 'Michael', 'BjÃ¶rn', 'MichaelBjÃ¶rn108', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MichaelBjÃ¶rn@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(114, 'GuylÃ¨ne', 'Nodier', 'GuylÃ¨neNodier109', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'GuylÃ¨neNodier@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(115, 'Robb', 'Merchant', 'RobbMerchant110', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'RobbMerchant@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(116, 'Chandra', 'Leka', 'ChandraLeka111', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ChandraLeka@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(117, 'Niels', 'Petersen', 'NielsPetersen112', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'NielsPetersen@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(118, 'Dirk', 'Luchte', 'DirkLuchte113', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'DirkLuchte@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(119, 'Anne', 'Heikkonen', 'AnneHeikkonen114', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AnneHeikkonen@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(120, 'Wendy', 'Mackenzie', 'WendyMackenzie115', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'WendyMackenzie@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(121, 'Jean-Guy', 'Lauzon', 'Jean-GuyLauzon116', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'Jean-GuyLauzon@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(122, 'Giovanni', 'Giudici', 'GiovanniGiudici117', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'GiovanniGiudici@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(123, 'Marie', 'Delamare', 'MarieDelamare118', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MarieDelamare@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(124, 'Eliane', 'Noz', 'ElianeNoz119', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ElianeNoz@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(125, 'Chantal', 'Goulet', 'ChantalGoulet120', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'ChantalGoulet@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 4),
(126, 'Nancy', 'Davolio', 'NancyDavolio121', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'NancyDavolio@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 3),
(127, 'Andrew', 'Fuller', 'AndrewFuller122', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AndrewFuller@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 3),
(128, 'Janet', 'Leverling', 'JanetLeverling123', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'JanetLeverling@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 3),
(129, 'Margaret', 'Peacock', 'MargaretPeacock124', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MargaretPeacock@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 3),
(130, 'Steven', 'Buchanan', 'StevenBuchanan125', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'StevenBuchanan@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 3),
(131, 'Michael', 'Suyama', 'MichaelSuyama126', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'MichaelSuyama@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 3),
(132, 'Robert', 'King', 'RobertKing127', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'RobertKing@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 3),
(133, 'Laura', 'Callahan', 'LauraCallahan128', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'LauraCallahan@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 3),
(134, 'Anne', 'Dodsworth', 'AnneDodsworth129', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AnneDodsworth@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 3),
(135, 'Adam', 'West', 'AdamWest130', '$2y$10$Qk7adUWnJEe6ZtsWNs7PaOK61ZaCQdyexedJrbAEI6eMz03U8swOi', 'AdamWest@gmail.com', 1, NULL, NULL, NULL, NULL, 0, NULL, '2018-02-04 13:26:03', '::1', 3);

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=136;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;