# Assumed credentials:
# username := "root"
# password := ""

CREATE DATABASE `62130_Ivan_Hristov`;

USE `62130_Ivan_Hristov`;

CREATE TABLE `users` (
  `fn` varchar(32) NOT NULL PRIMARY KEY,
  `first_name` varchar(128) NOT NULL,
  `family_name` varchar(128) NOT NULL,
  `course_year` int(11) NOT NULL,
  `specialty` varchar(128) NOT NULL,
  `group_name` varchar(16) NOT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `zodiac_sign` varchar(32) DEFAULT NULL,
  `link` varchar(512) DEFAULT NULL,
  `photo` varchar(64) DEFAULT NULL,
  `motivation` text NOT NULL
) CHARSET = utf8mb4;
