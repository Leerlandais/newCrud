-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 16, 2024 at 04:05 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newcrud`
--
CREATE DATABASE IF NOT EXISTS `newcrud` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `newcrud`;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `art_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `art_title` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `art_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `art_slug` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `art_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `art_author` int UNSIGNED NOT NULL,
  `art_status` tinyint NOT NULL COMMENT '0 -> unpublished\r\n1 -> needs correcting\r\n2 -> published',
  PRIMARY KEY (`art_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`art_id`, `art_title`, `art_content`, `art_slug`, `art_date`, `art_author`, `art_status`) VALUES
(1, 'Bienvenue à mon nouveau projet', 'Dans ce projet, je vais essayer ce qui suit :-\r\n- Utilisez uniquement Bootstrap pour la conception\r\n- Avoir différents niveaux d\'accès par utilisateur\r\n- Pages et options variables par utilisateur\r\n- Aussi joli que possible et entièrement réactif\r\n- Entièrement protégé, bien sûr', 'bienvenue-a-mon-nouveau-projet', '2024-04-16 17:47:01', 1, 2),
(3, 'Badly Written', 'This neez cowwecting', 'badly-written', '2024-04-16 17:59:02', 3, 1),
(4, 'Another Article', 'This one is published', 'another-article', '2024-04-16 18:01:01', 2, 2),
(5, 'Different Article', 'This one is unpublished', 'different-article', '2024-04-16 18:04:07', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `user_pwd` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `user_lvl` tinyint UNSIGNED NOT NULL COMMENT '0 -> banished\r\n1 -> read only\r\n2 -> read and add\r\n3 -> read, add and publish\r\n8 -> full admin',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pwd`, `user_lvl`) VALUES
(1, 'admin', '123', 8),
(2, 'manager', '123', 3),
(3, 'writer', '123', 2),
(4, 'reader', '123', 1),
(5, 'banish', '123', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
