-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 22 2014 г., 00:09
-- Версия сервера: 5.5.36-34.0-632.precise
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

ALTER TABLE `airyo_users` ADD COLUMN `role_id` INT(11) NOT NULL AFTER `phone` ;

UPDATE `airyo_users` SET `role_id` = 2 WHERE `id` IN (1, 2, 4);

--
-- Структура таблицы `airyo_roles`
--

CREATE TABLE IF NOT EXISTS `airyo_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Роли пользователей' AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `airyo_roles`
--

INSERT INTO `airyo_roles` (`id`, `title`, `description`) VALUES
(1, 'user', 'Простой пользователь сайта'),
(2, 'editor', 'Редактор в административной части'),
(3, 'root', 'Суперадмин');

--
-- Структура таблицы `airyo_modules`
--

CREATE TABLE IF NOT EXISTS `airyo_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(511) DEFAULT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Модули' AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `airyo_modules`
--

INSERT INTO `airyo_modules` (`id`, `title`, `alias`, `description`, `position`) VALUES
  (1, 'Страницы', 'pages', NULL, 1),
  (2, 'Меню', 'menu', NULL, 2),
  (3, 'Файлы', 'files', NULL, 3),
  (4, 'Пользователи', 'users', NULL, 4),
  (5, 'Фотоальбомы', 'gallery', NULL, 5),
  (6, 'Счётчики', 'counters', NULL, 6),
  (7, 'Слайдеры', 'sliders', NULL, 7),
  (8, 'Каталог товаров', 'products', NULL, 8),
  (9, 'Заказы', 'orders', NULL, 9),
  (10, 'Формы и запросы', 'forms', NULL, 10),
  (11, 'Комментарии', 'comments', NULL, 11),
  (12, 'Подписки и рассылки', 'subscription', NULL, 12),
  (13, 'Журнал действий', 'history', NULL, 13),
  (14, 'Настройки сайта', 'settings', NULL, 14),
  (15, 'Коллекция стилей', 'styles', NULL, 15),
  (16, 'Пакетные операции', 'operations', NULL, 16);

--
-- Структура таблицы `airyo_users_modules`
--

CREATE TABLE IF NOT EXISTS `airyo_users_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Соотношения пользователей и групп' AUTO_INCREMENT=69 ;

--
-- Дамп данных таблицы `airyo_users_modules`
--

INSERT INTO `airyo_users_modules` (`id`, `user_id`, `module_id`) VALUES
  (65, 7, 1),
  (66, 7, 3),
  (67, 7, 4),
  (68, 7, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
