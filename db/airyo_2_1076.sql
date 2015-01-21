-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 16 2015 г., 15:37
-- Версия сервера: 5.5.36-34.0-632.precise
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_roles`
--

CREATE TABLE IF NOT EXISTS `airyo_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Роли пользователей' AUTO_INCREMENT=3 ;

--
-- Очистка таблицы таблицы `airyo_roles`
--

TRUNCATE TABLE `airyo_roles`;

--
-- Дамп данных таблицы `airyo_roles`
--

INSERT INTO `airyo_roles` (`id`, `title`, `description`) VALUES
(1, 'editor', 'Редактор в административной части'),
(2, 'root', 'Суперадмин');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
