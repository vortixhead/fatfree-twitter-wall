-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `category` varchar(11) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'pendiente',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `images` (`id`, `title`, `url`, `category`, `status`, `created`, `modified`) VALUES
(1,	'Imagen de ejemplo',	'http://placehold.it/350x150',	'twitter',	'aprobada',	'0000-00-00 00:00:00',	'2016-04-25 20:05:03'),
(2,	'Imagen de ejemplo2',	'http://placehold.it/350x150',	'instagram',	'rechazada',	'0000-00-00 00:00:00',	'2016-04-25 19:58:51'),
(3,	'Imagen de ejemplo3',	'http://placehold.it/350x150',	'twitter',	'pendiente',	'0000-00-00 00:00:00',	'2016-04-25 20:05:04');

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `data` text COLLATE utf8_unicode_ci,
  `ip` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1,	'admin',	'admin',	'admin');

-- 2016-04-26 13:16:21
