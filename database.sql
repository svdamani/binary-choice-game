DROP DATABASE IF EXISTS `binary_choice_game`;

CREATE DATABASE IF NOT EXISTS `binary_choice_game`;

USE `binary_choice_game`;

CREATE TABLE IF NOT EXISTS `users` (
	`userid`    int(11) NOT NULL AUTO_INCREMENT,
	`username`  varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`password`  varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`email`     varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`age`       int(11) NOT NULL,
	`gender`    char(1) COLLATE utf8_unicode_ci NOT NULL,
	`country`   varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`language`  varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`education` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`religion`  varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`politics`  varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`userid`),
	UNIQUE KEY `username` (`username`),
	UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11;

CREATE TABLE IF NOT EXISTS `signin_log` (
	`sessid`     varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`username`   varchar(32) COLLATE utf8_unicode_ci NOT NULL,
	`ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
	`timestamp`  timestamp NOT NULL,
	PRIMARY KEY (`sessid`),
	UNIQUE KEY (`sessid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE  TABLE IF NOT EXISTS `problems` (
	`problem_id` int(11) NOT NULL,
	`p`      float NOT NULL,
	`w`      float NOT NULL,
	`x`      float NOT NULL,
	`q`      float NOT NULL,
	`y`      float NOT NULL,
	`z`      float NOT NULL,
	PRIMARY KEY (`problem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `conditions` (
	`condition_id`     int(11) NOT NULL,
	`problems` varchar(64) NOT NULL,
	PRIMARY KEY (`condition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `played` (
	`userid` int(11) NOT NULL,
	`condition_id` int(11) NOT NULL,
	PRIMARY KEY (`userid`, `condition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;