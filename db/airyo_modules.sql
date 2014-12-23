-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 23 2014 г., 23:59
-- Версия сервера: 5.5.36-34.0-632.precise
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mckolan_airyo2`
--

-- --------------------------------------------------------

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
