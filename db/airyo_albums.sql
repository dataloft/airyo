-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 28 2014 г., 19:13
-- Версия сервера: 5.5.36-34.0-632.precise
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `airyo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_albums`
--

CREATE TABLE IF NOT EXISTS `airyo_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(511) DEFAULT NULL,
  `image_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `create_date` datetime NOT NULL,
  `enable` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_airyo_albums_1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Альбомы' AUTO_INCREMENT=12 ;

--
-- Ограничения внешнего ключа таблицы `airyo_albums`
--
ALTER TABLE `airyo_albums`
  ADD CONSTRAINT `fk_airyo_albums_users` FOREIGN KEY (`user_id`) REFERENCES `airyo_users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
