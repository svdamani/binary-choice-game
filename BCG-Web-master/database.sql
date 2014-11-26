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

/* if suppose the user has not played all the problems of a particular condition
then this played table will not be able to handle it, which is bad for obvious
reasons.*/

CREATE TABLE IF NOT EXISTS `used_trials` (
	`userid` int(11) NOT NULL,
	`trial_id` int(11) NOT NULL,
	PRIMARY KEY (`userid`, `trial_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sg_trials` (
        `ID` int(11) NOT NULL,
        `permutation` VARCHAR(545) NOT NULL,
        PRIMARY KEY  (`permutation`)
) ;

CREATE TABLE IF NOT EXISTS `used_conditions` (
        `id` int(11) NOT NULL,
        `choiceid` int(11) NOT NULL,
        FOREIGN KEY (`choiceid`) REFERENCES `used_trials`
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sg_conditions` (
	`condition_id`     int(11) NOT NULL,
	`problems` varchar(64) NOT NULL,
	PRIMARY KEY (`condition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `sg_subjects` (
        `ID` int(11) NOT NULL,
        `userid` int(11) NOT NULL ,
        `trial_played` int(11),
        `condition` int(11),
        `chosen_option` int(11),
        FOREIGN KEY (`userid`) REFERENCES `users`,
        FOREIGN KEY (`trial_played`) REFERENCES `sg_trials`,
        FOREIGN KEY (`condition`) REFERENCES `sg_conditions`
) ENGINE=MyISAM DEFAULT CHARSET=latin1;