-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 22 2014 г., 16:47
-- Версия сервера: 5.5.36-cll-lve
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `v_6569_airyo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_templates`
--

CREATE TABLE IF NOT EXISTS `airyo_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `airyo_templates`
--

INSERT INTO `airyo_templates` (`id`, `name`, `description`) VALUES
(3, 'test', 'test');

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_templates_config`
--

CREATE TABLE IF NOT EXISTS `airyo_templates_config` (
  `tmpl_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_param` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `airyo_templates_config`
--

INSERT INTO `airyo_templates_config` (`tmpl_id`, `field_name`, `field_param`) VALUES
(3, 'content2', 'a:3:{s:4:"type";s:4:"text";s:5:"label";s:26:"Какой-то текст";s:8:"required";s:1:"1";}'),
(0, 'image', 'a:3:{s:4:"type";s:4:"file";s:5:"label";s:16:"Картинка";s:8:"required";s:1:"0";}'),
(3, 'image', 'a:3:{s:4:"type";s:4:"file";s:5:"label";s:16:"Картинка";s:8:"required";s:1:"0";}'),
(0, 'content1', 'a:4:{s:4:"type";s:8:"textarea";s:5:"label";s:2:"H1";s:8:"required";s:1:"1";s:10:"attributes";a:2:{s:4:"rows";i:20;s:4:"cols";i:10;}}'),
(3, 'content1', 'a:4:{s:4:"type";s:8:"textarea";s:5:"label";s:2:"H1";s:8:"required";s:1:"1";s:10:"attributes";a:2:{s:4:"rows";i:20;s:4:"cols";i:10;}}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `airyo_content` ADD `template` INT NOT NULL ;
