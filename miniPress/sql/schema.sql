-- Adminer 4.8.1 MySQL 5.5.5-10.11.3-MariaDB-1:10.11.3+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `Articles`;
CREATE TABLE `Articles` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `title` varchar(255) NOT NULL,
                            `summary` text DEFAULT NULL,
                            `content` text DEFAULT NULL,
                            `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                            `cat_id` int(11) NOT NULL,
                            `user_id` int(11) NOT NULL,
                            `image_url` varchar(512) DEFAULT NULL,
                            `isPublished` tinyint(1) NOT NULL DEFAULT 0,
                            `published_at` datetime DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            KEY `Category_ID` (`cat_id`),
                            KEY `User_ID` (`user_id`),
                            CONSTRAINT `Articles_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `Categories` (`ID`),
                            CONSTRAINT `Articles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Categories`;
CREATE TABLE `Categories` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `name` varchar(255) NOT NULL,
                              PRIMARY KEY (`id`),
                              CONSTRAINT `Categories_ibfk_1` FOREIGN KEY (`id`) REFERENCES `Articles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `email` varchar(255) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `role` enum('admin','editor') NOT NULL DEFAULT 'editor',
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- 2023-06-14 14:22:27