-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Oct 28, 2015 at 07:47 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airyo`
--

-- --------------------------------------------------------

--
-- Table structure for table `airyo_albums`
--

CREATE TABLE `airyo_albums` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Альбомы' AUTO_INCREMENT=13 ;

--
-- Dumping data for table `airyo_albums`
--

INSERT INTO `airyo_albums` (`id`, `label`, `title`, `description`, `image_id`, `user_id`, `create_date`, `enable`) VALUES
(12, 'album1444295654', 'Как живет енот, считающий себя собакой', 'Жительница Багамских островов нашла детеныша енота, оставшегося без матери, и приютила его у себя дома. Повзрослев в компании собак, енот усвоил множество их повадок.', 1, 2, '2015-10-08 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `airyo_chunks`
--

CREATE TABLE `airyo_chunks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `airyo_chunks`
--

INSERT INTO `airyo_chunks` (`id`, `name`, `alias`, `content`) VALUES
(2, 'Копирайты внизу страницы', 'copyright', '© 2015 Company Name'),
(3, 'Новости - текст перед лентой', 'news_intro', 'Два итальянских мальчика, которым суждено будет раз и навсегда изменить самый американский жанр кино — вестерн. Рим, 1937 год. Серджио Леоне и Эннио Морриконе. Будущему мэтру и будущему маэстро по 8 лет, в школе они сидели за одной партой.');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_content`
--

CREATE TABLE `airyo_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `h1` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `alias` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `type` varchar(200) NOT NULL,
  `template` varchar(200) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `airyo_content`
--

INSERT INTO `airyo_content` (`id`, `title`, `h1`, `content`, `alias`, `meta_description`, `meta_keywords`, `enabled`, `type`, `template`) VALUES
(106, '0', 'Главная страница', '<h1>Airyo <small>хорошая основа вашего сайта</small></h1>\n\n<p>Как известно, можно сделать сайт на основе популярной коробочной или облачной CMS, a можно на основе фреймворка. В первом случае вы получаете стандартный админский интерфейс, и некоторые особенности создания новых модулей (либо невозможность их создания в случае облака). Во втором случае, админский интерфейс может быть максимально заточен под нужны проекта, при создании новых модулей ограничений нет.</p>\n\n<p>Плюсы работы с коробочной CMS в том, что сайт на ее основе может быть дешевле, при условии, что используется стандартная комплектация. В случае с фреймворком плюсы заключаются в гибкости, возможности сделать ровно то, что хочется.</p>\n\n<p>Большинство популярных веб-ресурсов, конечно же, не являются коробочными продуктами, поскольку ограничения CMS сильно мешают гибкому развитию проекта. Такие ресурсы сделаны на фреймворках.</p>\n\n<!--<div class="well"></div>-->\n\n<p class="lead">Мы постарались объединить положительные стороны разных методов разработки:</p>\n\n<ul>\n<li>В основе сайта популярный фреймворк, а значит это гибкое, быстрое, безопасное решение.</li>\n<li>Сайт уже содержит каркас CMS с набором <a href="#">модулей первой необходимости</a>, но данная CMS не ограничивает свободу в создании новых модулей.</li>\n<li>Есть несколько хорошо протестированных <a href="#">готовых дизайн тем для сайта</a>, каждая из которых может быть переработана и адаптирована под ваши нужны.</li>\n<li>Сайт может быть расположен на хостинге повышенной доступности с резервированием данных, но при этом, в отличие от облака, вы будете фактическим владельцем сайта, а не просто его арендатором.</li>\n<li>Любые изменения в сайте вы можете заказать через <a href="http://smartandy.ru">наш сервис</a> на условиях 500р/час, что дешевле средней стоимости на рынке фриланса, при этом, вам не потребуется искать и выбирать специалистов. Большинство задач выполняются в день обращения.</li>\n</ul>\n\n<h2>Про дизайн этого сайта</h2>\n\n<p>В качестве демонстрации того, как все работает, мы сделали несколько готовых сайтов на основе проверенных и популярных дизайн-тем. Каждый сайт протестирован на разных устройствах и использует только качественные библиотеки.</p>\n\n<p>Любой из представленных дизайнов вы можете взять для себя бесплатно и использовать для своих нужд как есть, либо с любыми доработками.</p>\n\n<p>Дизайн-тема данного сайта называется <a href="#">Twitter Bootstrap</a>. Это, пожалуй, наиболее известный и часто используемый на данный момент Frontend Framework. Внешне сайт на Bootstrap может выглядеть лаконично, а может быть доработан и насыщен графикой. Но даже самый простой вариант сайта имеет очень много преимуществ. Он будет очень быстро загружаться и работать, будет выглядеть хорошо и аккуратно на любых устройствах.</p>\n\n<div class="well">\n<p>Для того, чтобы выбрать эту версию для основы своего сайта, вы можете действовать тремя способами:</p>\n<ol>\n<li>Забрать ее бесплатно из репозитория и настроить на своем сервере (потребуются навыки веб-разработчика)</li>\n<li>Воспользоваться автоматическим сервисом нашего хостинга. Не требует специальных знаний.</li>\n<li>Отправить заявку на развертывание и доработку сайта нам.</li>\n</ol>\n</div>\n\n\n\n<h2>А теперь немного картинок <small>не забудьте попробовать посмотреть на смартфоне</small></h2>\n\n[[Gallery:album1444295654]]\n\n\n<p><a href="#" class="btn btn-default btn-lg btn-block" role="button">Хочу такой сайт</a></p>\n\n\n\n<!--\n\n[[news_last:2]]\n\n[[gallery_last:2]]\n\n-->', '', '0', '0', 1, '0', 'pages_default'),
(122, '0', 'Информация', 'Тест', 'info', '0', '0', 1, '0', 'pages_default');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_counters`
--

CREATE TABLE `airyo_counters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `ip` text NOT NULL,
  `domain` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `airyo_counters`
--

INSERT INTO `airyo_counters` (`id`, `text`, `ip`, `domain`) VALUES
(1, '', '', 'airyo.loc');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_groups`
--

CREATE TABLE `airyo_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `airyo_groups`
--

INSERT INTO `airyo_groups` (`id`, `name`, `description`) VALUES
(1, 'agent', 'Administrator'),
(2, 'member', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_images`
--

CREATE TABLE `airyo_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(511) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `enable` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_airyo_images_1_idx` (`album_id`),
  KEY `fk_airyo_images_users_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Изображения' AUTO_INCREMENT=164 ;

--
-- Dumping data for table `airyo_images`
--

INSERT INTO `airyo_images` (`id`, `order`, `label`, `title`, `description`, `album_id`, `user_id`, `create_date`, `enable`) VALUES
(155, 1, '864d6dcc89b5ba03686ff95f0667d877.jpg', '864d6dcc89b5ba03686ff95f0667d877', '', 12, 2, '2015-10-08 09:15:08', 1),
(156, 4, '148ee3336fcd4141ed40d22bb242f8f1.jpg', '148ee3336fcd4141ed40d22bb242f8f1', '', 12, 2, '2015-10-08 09:15:08', 1),
(157, 2, '6fe46d76c0f62887db5df417cb601d79.jpg', '6fe46d76c0f62887db5df417cb601d79', '', 12, 2, '2015-10-08 09:15:08', 1),
(158, 0, '22b80944dc6d639d4b7ce5058d7e7736.jpg', '22b80944dc6d639d4b7ce5058d7e7736', '', 12, 2, '2015-10-08 09:15:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `airyo_login_attempts`
--

CREATE TABLE `airyo_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `airyo_logs`
--

CREATE TABLE `airyo_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_logs_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица для логирования' AUTO_INCREMENT=740 ;

--
-- Dumping data for table `airyo_logs`
--

INSERT INTO `airyo_logs` (`id`, `user_id`, `type`, `description`) VALUES
(1, 2, 'redirect', 'pages'),
(2, 2, 'redirect', 'users'),
(3, 2, 'redirect', 'menu'),
(4, 2, 'redirect', 'pages'),
(5, 2, 'redirect', 'menu'),
(6, 2, 'redirect', 'news'),
(7, 2, 'redirect', 'chunks'),
(8, 2, 'redirect', 'counters'),
(9, 2, 'redirect', 'gallery'),
(10, 2, 'redirect', 'users'),
(11, 2, 'redirect', 'files'),
(12, 2, 'redirect', 'news'),
(13, 2, 'redirect', 'menu'),
(14, 2, 'redirect', 'menu/1'),
(15, 2, 'redirect', 'menu/1'),
(16, 2, 'redirect', 'pages'),
(17, 2, 'redirect', 'menu'),
(18, 2, 'redirect', 'menu'),
(19, 2, 'redirect', 'pages'),
(20, 2, 'redirect', 'menu'),
(21, 2, 'redirect', 'pages'),
(22, 2, 'redirect', 'pages'),
(23, 2, 'redirect', 'menu'),
(24, 2, 'redirect', 'news'),
(25, 2, 'redirect', 'files'),
(26, 2, 'redirect', 'users'),
(27, 2, 'redirect', 'gallery'),
(28, 2, 'redirect', 'users'),
(29, 2, 'redirect', 'gallery'),
(30, 2, 'redirect', 'counters'),
(31, 2, 'redirect', 'chunks'),
(32, 2, 'redirect', 'menu'),
(33, 2, 'redirect', 'pages'),
(34, 2, 'redirect', 'users'),
(35, 2, 'redirect', 'pages'),
(36, 2, 'redirect', 'pages'),
(37, 2, 'redirect', 'menu'),
(38, 2, 'redirect', 'news'),
(39, 2, 'redirect', 'pages'),
(40, 2, 'redirect', 'menu'),
(41, 2, 'redirect', 'news'),
(42, 2, 'redirect', 'files'),
(43, 2, 'redirect', 'users'),
(44, 2, 'redirect', 'gallery'),
(45, 2, 'redirect', 'pages'),
(46, 2, 'redirect', 'menu'),
(47, 2, 'redirect', 'news'),
(48, 2, 'redirect', 'news'),
(49, 2, 'redirect', 'menu'),
(50, 2, 'redirect', 'pages'),
(51, 2, 'redirect', 'menu'),
(52, 2, 'redirect', 'news'),
(53, 2, 'redirect', 'menu'),
(54, 2, 'redirect', 'pages'),
(55, 2, 'redirect', 'airyo/news'),
(56, 2, 'redirect', 'airyo/gallery'),
(57, 2, 'redirect', 'airyo/files'),
(58, 2, 'redirect', 'airyo/news'),
(59, 2, 'redirect', 'airyo/menu'),
(60, 2, 'redirect', 'airyo/pages'),
(61, 2, 'redirect', 'airyo/menu'),
(62, 2, 'redirect', 'airyo/pages'),
(63, 2, 'redirect', 'airyo/pages'),
(64, 2, 'redirect', 'airyo/menu'),
(65, 2, 'redirect', 'airyo/news'),
(66, 2, 'redirect', 'airyo/gallery'),
(67, 2, 'redirect', 'airyo/gallery'),
(68, 2, 'redirect', 'airyo/gallery'),
(69, 2, 'redirect', ''),
(70, 2, 'redirect', ''),
(71, 2, 'redirect', ''),
(72, 2, 'redirect', ''),
(73, 2, 'redirect', ''),
(74, 2, 'redirect', ''),
(75, 2, 'redirect', ''),
(76, 2, 'redirect', ''),
(77, 2, 'redirect', ''),
(78, 2, 'redirect', ''),
(79, 2, 'redirect', ''),
(80, 2, 'redirect', ''),
(81, 2, 'redirect', ''),
(82, 2, 'redirect', ''),
(83, 2, 'redirect', ''),
(84, 2, 'redirect', 'airyo/pages'),
(85, 2, 'redirect', 'airyo/pages'),
(86, 2, 'redirect', 'airyo/pages'),
(87, 2, 'redirect', 'airyo/pages'),
(88, 2, 'redirect', 'airyo/pages'),
(89, 2, 'redirect', 'airyo/pages'),
(90, 2, 'redirect', 'airyo/pages'),
(91, 2, 'redirect', 'airyo/pages'),
(92, 2, 'redirect', 'airyo/pages'),
(93, 2, 'redirect', 'airyo/pages'),
(94, 2, 'redirect', 'airyo/pages'),
(95, 2, 'redirect', 'airyo/pages'),
(96, 2, 'redirect', 'airyo/pages'),
(97, 2, 'redirect', 'airyo/pages'),
(98, 2, 'redirect', 'airyo/pages'),
(99, 2, 'redirect', 'airyo/pages'),
(100, 2, 'redirect', 'airyo/pages'),
(101, 2, 'redirect', 'airyo/pages'),
(102, 2, 'redirect', ''),
(103, 2, 'redirect', ''),
(104, 2, 'redirect', 'airyo/pages'),
(105, 2, 'redirect', 'airyo/pages'),
(106, 2, 'redirect', 'airyo/pages'),
(107, 2, 'redirect', 'airyo/pages'),
(108, 2, 'redirect', 'airyo/pages'),
(109, 2, 'redirect', 'airyo/pages'),
(110, 2, 'redirect', 'airyo/pages'),
(111, 2, 'redirect', 'airyo/pages'),
(112, 2, 'redirect', 'airyo/pages'),
(113, 2, 'redirect', 'airyo/pages'),
(114, 2, 'redirect', 'airyo/pages'),
(115, 2, 'redirect', 'airyo/pages'),
(116, 2, 'redirect', 'airyo/pages'),
(117, 2, 'redirect', 'airyo/pages'),
(118, 2, 'redirect', 'airyo/pages'),
(119, 2, 'redirect', 'airyo/pages'),
(120, 2, 'redirect', 'airyo/pages'),
(121, 2, 'redirect', 'airyo/pages'),
(122, 2, 'redirect', 'airyo/pages'),
(123, 2, 'redirect', 'airyo/pages'),
(124, 2, 'redirect', 'airyo/pages'),
(125, 2, 'redirect', 'airyo/pages'),
(126, 2, 'redirect', 'airyo/menu'),
(127, 2, 'redirect', 'airyo/news'),
(128, 2, 'redirect', 'airyo/files'),
(129, 2, 'redirect', 'airyo/files/content'),
(130, 2, 'redirect', 'airyo/files'),
(131, 2, 'redirect', 'airyo/news'),
(132, 2, 'redirect', 'airyo/menu'),
(133, 2, 'redirect', 'airyo/pages'),
(134, 2, 'redirect', 'airyo/menu'),
(135, 2, 'redirect', 'airyo/menu'),
(136, 2, 'redirect', 'airyo/pages'),
(137, 2, 'redirect', 'airyo/users'),
(138, 2, 'redirect', 'airyo/pages'),
(139, 2, 'redirect', 'airyo/menu'),
(140, 2, 'redirect', 'airyo/news'),
(141, 2, 'redirect', 'airyo/menu'),
(142, 2, 'redirect', 'airyo/pages'),
(143, 2, 'redirect', 'airyo/menu'),
(144, 2, 'redirect', 'airyo/news'),
(145, 2, 'redirect', 'airyo/files'),
(146, 2, 'redirect', 'airyo/chunks'),
(147, 2, 'redirect', 'airyo/chunks'),
(148, 2, 'redirect', 'airyo/news'),
(149, 2, 'redirect', 'airyo/news'),
(150, 2, 'redirect', 'airyo/news'),
(151, 2, 'redirect', 'airyo/news'),
(152, 2, 'redirect', 'airyo/news'),
(153, 2, 'redirect', 'airyo/pages'),
(154, 2, 'redirect', 'airyo/menu'),
(155, 2, 'redirect', ''),
(156, 2, 'redirect', ''),
(157, 2, 'redirect', ''),
(158, 2, 'redirect', 'airyo/menu'),
(159, 2, 'redirect', 'airyo/pages'),
(160, 2, 'redirect', 'airyo/news'),
(161, 2, 'redirect', 'airyo/news'),
(162, 2, 'redirect', 'airyo/news'),
(163, 2, 'redirect', 'airyo/news'),
(164, 2, 'redirect', 'airyo/news'),
(165, 2, 'redirect', 'airyo/news'),
(166, 2, 'redirect', ''),
(167, 2, 'redirect', ''),
(168, 2, 'redirect', 'airyo/pages'),
(169, 2, 'redirect', 'airyo/pages'),
(170, 2, 'redirect', 'airyo/menu'),
(171, 2, 'redirect', 'airyo/pages'),
(172, 2, 'redirect', ''),
(173, 2, 'redirect', ''),
(174, 2, 'redirect', ''),
(175, 2, 'redirect', ''),
(176, 2, 'redirect', ''),
(177, 2, 'redirect', ''),
(178, 2, 'redirect', ''),
(179, 2, 'redirect', ''),
(180, 2, 'redirect', ''),
(181, 2, 'redirect', ''),
(182, 2, 'redirect', 'airyo/pages'),
(183, 2, 'redirect', 'airyo/pages'),
(184, 2, 'redirect', 'airyo/pages'),
(185, 2, 'redirect', ''),
(186, 2, 'redirect', ''),
(187, 2, 'redirect', 'airyo/menu'),
(188, 2, 'redirect', 'airyo/pages'),
(189, 2, 'redirect', ''),
(190, 2, 'redirect', 'airyo/pages'),
(191, 2, 'redirect', 'airyo/pages'),
(192, 2, 'redirect', 'airyo/menu'),
(193, 2, 'redirect', 'airyo/news'),
(194, 2, 'redirect', 'airyo/files'),
(195, 2, 'redirect', 'airyo/news'),
(196, 2, 'redirect', 'airyo/menu'),
(197, 2, 'redirect', 'airyo/pages'),
(198, 2, 'redirect', 'airyo/pages'),
(199, 2, 'redirect', 'airyo/menu'),
(200, 2, 'redirect', 'airyo/news'),
(201, 2, 'redirect', 'airyo/gallery'),
(202, 2, 'redirect', 'airyo/files'),
(203, 2, 'redirect', 'airyo/news'),
(204, 2, 'redirect', 'airyo/menu'),
(205, 2, 'redirect', 'airyo/pages'),
(206, 2, 'redirect', 'airyo/pages'),
(207, 2, 'redirect', 'airyo/menu'),
(208, 2, 'redirect', 'airyo/news'),
(209, 2, 'redirect', 'airyo/users'),
(210, 2, 'redirect', 'airyo/files'),
(211, 2, 'redirect', 'airyo/chunks'),
(212, 2, 'redirect', 'airyo/news'),
(213, 2, 'redirect', 'airyo/menu'),
(214, 2, 'redirect', 'airyo/pages'),
(215, 2, 'redirect', 'airyo/pages'),
(216, 2, 'redirect', 'airyo/pages'),
(217, 2, 'redirect', 'airyo/pages'),
(218, 2, 'redirect', 'airyo/pages'),
(219, 2, 'redirect', 'airyo/pages'),
(220, 2, 'redirect', 'airyo/pages'),
(221, 2, 'redirect', 'airyo/menu'),
(222, 2, 'redirect', 'airyo/news'),
(223, 2, 'redirect', 'airyo/pages'),
(224, 2, 'redirect', 'airyo/files'),
(225, 2, 'redirect', 'airyo/menu'),
(226, 2, 'redirect', 'airyo/pages'),
(227, 2, 'redirect', 'airyo/menu'),
(228, 2, 'redirect', 'airyo/news'),
(229, 2, 'redirect', ''),
(230, 2, 'redirect', ''),
(231, 2, 'redirect', ''),
(232, 2, 'redirect', ''),
(233, 2, 'redirect', 'airyo/pages'),
(234, 2, 'redirect', 'airyo/pages'),
(235, 2, 'redirect', ''),
(236, 2, 'redirect', ''),
(237, 2, 'redirect', 'airyo/menu'),
(238, 2, 'redirect', 'airyo/pages'),
(239, 2, 'redirect', ''),
(240, 2, 'redirect', 'airyo/news'),
(241, 2, 'redirect', 'airyo/news'),
(242, 2, 'redirect', 'airyo/menu'),
(243, 2, 'redirect', 'airyo/pages'),
(244, 2, 'redirect', ''),
(245, 2, 'redirect', ''),
(246, 2, 'redirect', ''),
(247, 2, 'redirect', ''),
(248, 2, 'redirect', 'airyo/pages'),
(249, 2, 'redirect', 'airyo/pages'),
(250, 2, 'redirect', 'airyo/pages'),
(251, 2, 'redirect', 'airyo/pages'),
(252, 2, 'redirect', ''),
(253, 2, 'redirect', 'airyo/pages'),
(254, 2, 'redirect', 'airyo/pages'),
(255, 2, 'redirect', 'airyo/pages'),
(256, 2, 'redirect', ''),
(257, 2, 'redirect', ''),
(258, 2, 'redirect', ''),
(259, 2, 'redirect', ''),
(260, 2, 'redirect', ''),
(261, 2, 'redirect', 'airyo/news'),
(262, 2, 'redirect', 'airyo/news'),
(263, 2, 'redirect', 'airyo/pages'),
(264, 2, 'redirect', 'airyo/pages'),
(265, 2, 'redirect', 'airyo/menu'),
(266, 2, 'redirect', 'airyo/news'),
(267, 2, 'redirect', 'airyo/menu'),
(268, 2, 'redirect', 'airyo/pages'),
(269, 2, 'redirect', 'airyo/menu'),
(270, 2, 'redirect', 'airyo/news'),
(271, 2, 'redirect', 'airyo/files'),
(272, 2, 'redirect', 'airyo/users'),
(273, 2, 'redirect', 'airyo/gallery'),
(274, 2, 'redirect', ''),
(275, 2, 'redirect', 'airyo/menu'),
(276, 2, 'redirect', 'airyo/menu'),
(277, 2, 'redirect', 'airyo/news'),
(278, 2, 'redirect', 'airyo/files'),
(279, 2, 'redirect', 'airyo/users'),
(280, 2, 'redirect', 'airyo/users'),
(281, 2, 'redirect', 'airyo/pages'),
(282, 2, 'redirect', 'airyo/menu'),
(283, 2, 'redirect', 'airyo/news'),
(284, 2, 'redirect', 'airyo/files'),
(285, 2, 'redirect', 'airyo/files/content'),
(286, 2, 'redirect', 'airyo/files'),
(287, 2, 'redirect', 'airyo/files/gallery'),
(288, 2, 'redirect', 'airyo/files/gallery/.DS_Store'),
(289, 2, 'redirect', 'airyo/news'),
(290, 2, 'redirect', 'airyo/menu'),
(291, 2, 'redirect', 'airyo/pages'),
(292, 2, 'redirect', 'airyo/menu'),
(293, 2, 'redirect', 'airyo/news'),
(294, 2, 'redirect', 'airyo/news'),
(295, 2, 'redirect', 'airyo/news'),
(296, 2, 'redirect', 'airyo/menu'),
(297, 2, 'redirect', 'airyo/files'),
(298, 2, 'redirect', 'airyo/users'),
(299, 2, 'redirect', 'airyo/gallery'),
(300, 2, 'redirect', 'airyo/news'),
(301, 2, 'redirect', 'airyo/menu'),
(302, 2, 'redirect', 'airyo/pages'),
(303, 2, 'redirect', 'airyo/menu'),
(304, 2, 'redirect', 'airyo/news'),
(305, 2, 'redirect', 'airyo/news'),
(306, 2, 'redirect', 'airyo/menu'),
(307, 2, 'redirect', 'airyo/pages'),
(308, 2, 'redirect', 'airyo/users'),
(309, 2, 'redirect', 'airyo/pages'),
(310, 2, 'redirect', 'airyo/menu'),
(311, 2, 'redirect', 'airyo/news'),
(312, 2, 'redirect', 'airyo/pages'),
(313, 2, 'redirect', 'airyo/pages'),
(314, 2, 'redirect', 'airyo/news'),
(315, 2, 'redirect', 'airyo/menu'),
(316, 2, 'redirect', 'airyo/files'),
(317, 2, 'redirect', 'airyo/chunks'),
(318, 2, 'redirect', 'airyo/pages'),
(319, 2, 'redirect', 'airyo/pages'),
(320, 2, 'redirect', 'airyo/menu'),
(321, 2, 'redirect', 'airyo/news'),
(322, 2, 'redirect', 'airyo/news'),
(323, 2, 'redirect', 'airyo/pages'),
(324, 2, 'redirect', 'airyo/menu'),
(325, 2, 'redirect', 'airyo/news'),
(326, 2, 'redirect', 'airyo/files'),
(327, 2, 'redirect', 'airyo/files/content'),
(328, 2, 'redirect', 'airyo/files'),
(329, 2, 'redirect', 'airyo/files/img'),
(330, 2, 'redirect', 'airyo/files'),
(331, 2, 'redirect', 'airyo/files/docs'),
(332, 2, 'redirect', 'airyo/files/docs/test'),
(333, 2, 'redirect', 'airyo/files'),
(334, 2, 'redirect', 'airyo/files/pages'),
(335, 2, 'redirect', 'airyo/files'),
(336, 2, 'redirect', 'airyo/files/img'),
(337, 2, 'redirect', 'airyo/files/img'),
(338, 2, 'redirect', 'airyo/files'),
(339, 2, 'redirect', 'airyo/files/gallery'),
(340, 2, 'redirect', 'airyo/files/gallery/album1444295654'),
(341, 2, 'redirect', 'airyo/files/gallery/album1444295654/148ee3336fcd4141ed40d22bb242f8f1.jpg'),
(342, 2, 'redirect', 'airyo/users'),
(343, 2, 'redirect', 'airyo/gallery'),
(344, 2, 'redirect', 'airyo/gallery'),
(345, 2, 'redirect', 'airyo/news'),
(346, 2, 'redirect', 'airyo/menu'),
(347, 2, 'redirect', 'airyo/pages'),
(348, 2, 'redirect', 'airyo/menu'),
(349, 2, 'redirect', 'airyo/news'),
(350, 2, 'redirect', 'airyo/users'),
(351, 2, 'redirect', 'airyo/menu'),
(352, 2, 'redirect', 'airyo/menu/1'),
(353, 2, 'redirect', 'airyo/menu/1'),
(354, 2, 'redirect', 'airyo/pages'),
(355, 2, 'redirect', 'airyo/pages'),
(356, 2, 'redirect', 'airyo/pages'),
(357, 2, 'redirect', 'airyo/pages'),
(358, 2, 'redirect', 'airyo/pages'),
(359, 2, 'redirect', 'airyo/pages'),
(360, 2, 'redirect', 'airyo/menu'),
(361, 2, 'redirect', 'airyo/news'),
(362, 2, 'redirect', 'airyo/files'),
(363, 2, 'redirect', 'airyo/users'),
(364, 2, 'redirect', 'airyo/gallery'),
(365, 2, 'redirect', 'airyo/users'),
(366, 2, 'redirect', 'airyo/news'),
(367, 2, 'redirect', 'airyo/menu'),
(368, 2, 'redirect', 'airyo/pages'),
(369, 2, 'redirect', 'airyo/news'),
(370, 2, 'redirect', 'airyo/pages'),
(371, 2, 'redirect', 'airyo/menu'),
(372, 2, 'redirect', 'airyo/news'),
(373, 2, 'redirect', 'airyo/menu'),
(374, 2, 'redirect', 'airyo/pages'),
(375, 2, 'redirect', 'airyo/menu'),
(376, 2, 'redirect', 'airyo/news'),
(377, 2, 'redirect', 'airyo/files'),
(378, 2, 'redirect', 'airyo/users'),
(379, 2, 'redirect', 'airyo/gallery'),
(380, 2, 'redirect', 'airyo/news'),
(381, 2, 'redirect', 'airyo/menu'),
(382, 2, 'redirect', 'airyo/pages'),
(383, 2, 'redirect', 'airyo/pages'),
(384, 2, 'redirect', 'airyo/menu'),
(385, 2, 'redirect', 'airyo/news'),
(386, 2, 'redirect', 'airyo/news'),
(387, 2, 'redirect', 'airyo/news'),
(388, 2, 'redirect', 'airyo/menu'),
(389, 2, 'redirect', 'airyo/pages'),
(390, 2, 'redirect', 'airyo/files'),
(391, 2, 'redirect', 'airyo/files/gallery'),
(392, 2, 'redirect', 'airyo/files/gallery/.DS_Store'),
(393, 2, 'redirect', 'airyo/files/gallery'),
(394, 2, 'redirect', 'airyo/files/gallery/album1444295654'),
(395, 2, 'redirect', 'airyo/files/gallery/album1444295654/148ee3336fcd4141ed40d22bb242f8f1.jpg'),
(396, 2, 'redirect', 'airyo/files'),
(397, 2, 'redirect', 'airyo/pages'),
(398, 2, 'redirect', 'airyo/menu'),
(399, 2, 'redirect', 'airyo/news'),
(400, 2, 'redirect', 'airyo/menu'),
(401, 2, 'redirect', 'airyo/pages'),
(402, 2, 'redirect', 'airyo/menu'),
(403, 2, 'redirect', 'airyo/news'),
(404, 2, 'redirect', 'airyo/news'),
(405, 2, 'redirect', 'airyo/menu'),
(406, 2, 'redirect', 'airyo/pages'),
(407, 2, 'redirect', 'airyo/menu'),
(408, 2, 'redirect', 'airyo/menu/1'),
(409, 2, 'redirect', 'airyo/pages'),
(410, 2, 'redirect', 'airyo/news'),
(411, 2, 'redirect', 'airyo/files'),
(412, 2, 'redirect', 'airyo/files'),
(413, 2, 'redirect', 'airyo/files'),
(414, 2, 'redirect', 'airyo/pages'),
(415, 2, 'redirect', 'airyo/menu'),
(416, 2, 'redirect', 'airyo/news'),
(417, 2, 'redirect', 'airyo/files'),
(418, 2, 'redirect', 'airyo/users'),
(419, 2, 'redirect', 'airyo/gallery'),
(420, 2, 'redirect', 'airyo/counters'),
(421, 2, 'redirect', 'airyo/counters'),
(422, 2, 'redirect', 'airyo/counters'),
(423, 2, 'redirect', 'airyo/chunks'),
(424, 2, 'redirect', 'airyo/counters'),
(425, 2, 'redirect', 'airyo/chunks'),
(426, 2, 'redirect', 'airyo/chunks'),
(427, 2, 'redirect', 'airyo/news'),
(428, 2, 'redirect', 'airyo/menu'),
(429, 2, 'redirect', 'airyo/pages'),
(430, 2, 'redirect', 'airyo/menu'),
(431, 2, 'redirect', 'airyo/news'),
(432, 2, 'redirect', 'airyo/pages'),
(433, 2, 'redirect', 'airyo/menu'),
(434, 2, 'redirect', 'airyo/news'),
(435, 2, 'redirect', 'airyo/menu'),
(436, 2, 'redirect', 'airyo/pages'),
(437, 2, 'redirect', 'airyo/users'),
(438, 2, 'redirect', 'airyo/pages'),
(439, 2, 'redirect', 'airyo/news'),
(440, 2, 'redirect', 'airyo/menu'),
(441, 2, 'redirect', 'airyo/pages'),
(442, 2, 'redirect', 'airyo/files'),
(443, 2, 'redirect', 'airyo/news'),
(444, 2, 'redirect', 'airyo/menu'),
(445, 2, 'redirect', 'airyo/pages'),
(446, 2, 'redirect', 'airyo/menu'),
(447, 2, 'redirect', 'airyo/news'),
(448, 2, 'redirect', 'airyo/counters'),
(449, 2, 'redirect', 'airyo/chunks'),
(450, 2, 'redirect', 'airyo/news'),
(451, 2, 'redirect', 'airyo/menu'),
(452, 2, 'redirect', 'airyo/pages'),
(453, 2, 'redirect', 'airyo/menu'),
(454, 2, 'redirect', 'airyo/news'),
(455, 2, 'redirect', 'airyo/files'),
(456, 2, 'redirect', 'airyo/menu'),
(457, 2, 'redirect', 'airyo/menu'),
(458, 2, 'redirect', 'airyo/news'),
(459, 2, 'redirect', 'airyo/pages'),
(460, 2, 'redirect', 'airyo/menu'),
(461, 2, 'redirect', 'airyo/news'),
(462, 2, 'redirect', 'airyo/pages'),
(463, 2, 'redirect', 'airyo/pages'),
(464, 2, 'redirect', 'airyo/menu'),
(465, 2, 'redirect', 'airyo/news'),
(466, 2, 'redirect', 'airyo/news'),
(467, 2, 'redirect', 'airyo/news'),
(468, 2, 'redirect', 'airyo/pages'),
(469, 2, 'redirect', 'airyo/pages'),
(470, 2, 'redirect', 'airyo/pages'),
(471, 2, 'redirect', 'airyo/menu'),
(472, 2, 'redirect', 'airyo/news'),
(473, 2, 'redirect', 'airyo/pages'),
(474, 2, 'redirect', 'airyo/news'),
(475, 2, 'redirect', 'airyo/menu'),
(476, 2, 'redirect', 'airyo/pages'),
(477, 2, 'redirect', 'airyo/news'),
(478, 2, 'redirect', 'airyo/news'),
(479, 2, 'redirect', 'airyo/pages'),
(480, 2, 'redirect', 'airyo/menu'),
(481, 2, 'redirect', 'airyo/pages'),
(482, 2, 'redirect', 'airyo/pages'),
(483, 2, 'redirect', 'airyo/menu'),
(484, 2, 'redirect', 'airyo/news'),
(485, 2, 'redirect', 'airyo/pages'),
(486, 2, 'redirect', 'airyo/menu'),
(487, 2, 'redirect', 'airyo/news'),
(488, 2, 'redirect', 'airyo/pages'),
(489, 2, 'redirect', 'airyo/menu'),
(490, 2, 'redirect', 'airyo/menu/1'),
(491, 2, 'redirect', 'airyo/news'),
(492, 2, 'redirect', 'airyo/news'),
(493, 2, 'redirect', 'airyo/menu'),
(494, 2, 'redirect', 'airyo/pages'),
(495, 2, 'redirect', 'airyo/menu'),
(496, 2, 'redirect', 'airyo/news'),
(497, 2, 'redirect', 'airyo/users'),
(498, 2, 'redirect', 'airyo/users'),
(499, 2, 'redirect', 'airyo/users'),
(500, 2, 'redirect', 'airyo/news'),
(501, 2, 'redirect', 'airyo/gallery'),
(502, 2, 'redirect', 'airyo/users'),
(503, 2, 'redirect', 'airyo/files'),
(504, 2, 'redirect', 'airyo/files'),
(505, 2, 'redirect', 'airyo/news'),
(506, 2, 'redirect', 'airyo/menu'),
(507, 2, 'redirect', 'airyo/pages'),
(508, 2, 'redirect', 'airyo/files'),
(509, 2, 'redirect', 'airyo/gallery'),
(510, 2, 'redirect', 'airyo/chunks'),
(511, 3, 'redirect', 'airyo/pages'),
(512, 3, 'redirect', 'airyo/pages'),
(513, 3, 'redirect', 'airyo/menu'),
(514, 3, 'redirect', 'airyo/pages'),
(515, 3, 'redirect', 'airyo/menu'),
(516, 3, 'redirect', 'airyo/pages'),
(517, 3, 'redirect', 'airyo/menu'),
(518, 3, 'redirect', 'airyo/menu'),
(519, 3, 'redirect', 'airyo/pages'),
(520, 3, 'redirect', 'airyo/pages'),
(521, 3, 'redirect', 'airyo/menu'),
(522, 3, 'redirect', 'airyo/pages'),
(523, 3, 'redirect', 'airyo/menu'),
(524, 2, 'redirect', 'airyo/chunks'),
(525, 2, 'redirect', 'airyo/news'),
(526, 2, 'redirect', 'airyo/menu'),
(527, 2, 'redirect', 'airyo/pages'),
(528, 2, 'redirect', 'airyo/files'),
(529, 2, 'redirect', 'airyo/users'),
(530, 2, 'redirect', 'airyo/gallery'),
(531, 2, 'redirect', 'airyo/news'),
(532, 2, 'redirect', 'airyo/menu'),
(533, 2, 'redirect', 'airyo/pages'),
(534, 2, 'redirect', 'airyo/pages'),
(535, 2, 'redirect', 'airyo/menu'),
(536, 3, 'redirect', 'airyo/menu'),
(537, 3, 'redirect', 'airyo/pages'),
(538, 3, 'redirect', 'airyo/menu'),
(539, 3, 'redirect', 'airyo/pages'),
(540, 3, 'redirect', 'airyo/menu'),
(541, 3, 'redirect', 'airyo/pages'),
(542, 3, 'redirect', 'airyo/menu'),
(543, 3, 'redirect', 'airyo/pages'),
(544, 3, 'redirect', 'airyo/menu'),
(545, 3, 'redirect', 'airyo/pages'),
(546, 3, 'redirect', 'airyo/menu'),
(547, 2, 'redirect', 'airyo/menu'),
(548, 2, 'redirect', 'airyo/menu/1'),
(549, 2, 'redirect', 'airyo/news'),
(550, 2, 'redirect', 'airyo/menu'),
(551, 2, 'redirect', 'airyo/pages'),
(552, 2, 'redirect', 'airyo/pages'),
(553, 2, 'redirect', 'airyo/files'),
(554, 2, 'redirect', 'airyo/users'),
(555, 2, 'redirect', 'airyo/gallery'),
(556, 2, 'redirect', 'airyo/counters'),
(557, 2, 'redirect', 'airyo/counters'),
(558, 2, 'redirect', 'airyo/counters'),
(559, 2, 'redirect', 'airyo/chunks'),
(560, 2, 'redirect', 'airyo/counters'),
(561, 2, 'redirect', 'airyo/gallery'),
(562, 2, 'redirect', 'airyo/users'),
(563, 2, 'redirect', 'airyo/files'),
(564, 2, 'redirect', 'airyo/news'),
(565, 2, 'redirect', 'airyo/menu'),
(566, 2, 'redirect', 'airyo/pages'),
(567, 2, 'redirect', 'airyo/pages'),
(568, 2, 'redirect', 'airyo/menu'),
(569, 2, 'redirect', 'airyo/news'),
(570, 3, 'redirect', 'airyo/menu'),
(571, 3, 'redirect', 'airyo/pages'),
(572, 3, 'redirect', 'airyo/menu'),
(573, 3, 'redirect', 'airyo/pages'),
(574, 3, 'redirect', 'airyo/menu'),
(575, 3, 'redirect', 'airyo/pages'),
(576, 3, 'redirect', 'airyo/pages'),
(577, 3, 'redirect', 'airyo/pages'),
(578, 3, 'redirect', 'airyo/menu'),
(579, 3, 'redirect', 'airyo/pages'),
(580, 2, 'redirect', 'airyo/news'),
(581, 2, 'redirect', 'airyo/menu'),
(582, 2, 'redirect', 'airyo/pages'),
(583, 2, 'redirect', 'airyo/files'),
(584, 2, 'redirect', 'airyo/users'),
(585, 2, 'redirect', 'airyo/gallery'),
(586, 2, 'redirect', 'airyo/counters'),
(587, 2, 'redirect', 'airyo/chunks'),
(588, 2, 'redirect', 'airyo/news'),
(589, 2, 'redirect', 'airyo/menu'),
(590, 2, 'redirect', 'airyo/pages'),
(591, 3, 'redirect', 'airyo/pages'),
(592, 3, 'redirect', 'airyo/menu'),
(593, 3, 'redirect', 'airyo/pages'),
(594, 2, 'redirect', 'airyo/pages'),
(595, 2, 'redirect', 'airyo/users'),
(596, 2, 'redirect', 'airyo/users'),
(597, 2, 'redirect', 'airyo/users'),
(598, 2, 'redirect', 'airyo/users'),
(599, 2, 'redirect', 'airyo/menu'),
(600, 2, 'redirect', 'airyo/news'),
(601, 2, 'redirect', 'airyo/files'),
(602, 2, 'redirect', 'airyo/users'),
(603, 2, 'redirect', 'airyo/gallery'),
(604, 2, 'redirect', 'airyo/gallery'),
(605, 2, 'redirect', 'airyo/pages'),
(606, 2, 'redirect', 'airyo/menu'),
(607, 2, 'redirect', 'airyo/news'),
(608, 2, 'redirect', 'airyo/menu'),
(609, 2, 'redirect', 'airyo/pages'),
(610, 2, 'redirect', 'airyo/menu'),
(611, 2, 'redirect', 'airyo/news'),
(612, 2, 'redirect', 'airyo/files'),
(613, 2, 'redirect', 'airyo/users'),
(614, 2, 'redirect', 'airyo/chunks'),
(615, 2, 'redirect', 'airyo/counters'),
(616, 2, 'redirect', 'airyo/gallery'),
(617, 2, 'redirect', 'airyo/users'),
(618, 2, 'redirect', 'airyo/files'),
(619, 2, 'redirect', 'airyo/pages'),
(620, 2, 'redirect', 'airyo/pages'),
(621, 2, 'redirect', 'airyo/pages'),
(622, 2, 'redirect', 'airyo/pages'),
(623, 2, 'redirect', 'airyo/pages'),
(624, 2, 'redirect', 'airyo/pages'),
(625, 2, 'redirect', 'airyo/pages'),
(626, 2, 'redirect', 'airyo/pages'),
(627, 2, 'redirect', 'airyo/pages'),
(628, 2, 'redirect', 'airyo/pages'),
(629, 2, 'redirect', 'airyo/pages'),
(630, 2, 'redirect', 'airyo/pages'),
(631, 2, 'redirect', 'airyo/pages'),
(632, 2, 'redirect', 'airyo/pages'),
(633, 2, 'redirect', 'airyo/pages'),
(634, 2, 'redirect', 'airyo/pages'),
(635, 2, 'redirect', 'airyo/pages'),
(636, 2, 'redirect', 'airyo/pages'),
(637, 2, 'redirect', 'airyo/pages'),
(638, 2, 'redirect', 'airyo/pages'),
(639, 2, 'redirect', 'airyo/pages'),
(640, 2, 'redirect', 'airyo/pages'),
(641, 2, 'redirect', 'airyo/pages'),
(642, 2, 'redirect', 'airyo/pages'),
(643, 2, 'redirect', 'airyo/pages'),
(644, 2, 'redirect', 'airyo/pages'),
(645, 2, 'redirect', 'airyo/pages'),
(646, 2, 'redirect', 'airyo/pages'),
(647, 2, 'redirect', 'airyo/pages'),
(648, 2, 'redirect', 'airyo/pages'),
(649, 2, 'redirect', 'airyo/pages'),
(650, 2, 'redirect', 'airyo/pages'),
(651, 2, 'redirect', 'airyo/pages'),
(652, 2, 'redirect', 'airyo/pages'),
(653, 2, 'redirect', 'airyo/pages'),
(654, 2, 'redirect', 'airyo/pages'),
(655, 2, 'redirect', 'airyo/pages'),
(656, 2, 'redirect', 'airyo/pages'),
(657, 2, 'redirect', 'airyo/pages'),
(658, 2, 'redirect', 'airyo/pages'),
(659, 2, 'redirect', 'airyo/pages'),
(660, 2, 'redirect', 'airyo/pages'),
(661, 2, 'redirect', 'airyo/pages'),
(662, 2, 'redirect', 'airyo/pages'),
(663, 2, 'redirect', 'airyo/pages'),
(664, 2, 'redirect', 'airyo/pages'),
(665, 2, 'redirect', 'airyo/pages'),
(666, 2, 'redirect', 'airyo/pages'),
(667, 2, 'redirect', 'airyo/pages'),
(668, 2, 'redirect', 'airyo/pages'),
(669, 2, 'redirect', 'airyo/pages'),
(670, 2, 'redirect', 'airyo/menu'),
(671, 2, 'redirect', 'airyo/pages'),
(672, 2, 'redirect', 'airyo/menu'),
(673, 2, 'redirect', 'airyo/menu'),
(674, 2, 'redirect', 'airyo/menu'),
(675, 2, 'redirect', 'airyo/pages'),
(676, 2, 'redirect', 'airyo/news'),
(677, 2, 'redirect', 'airyo/files'),
(678, 2, 'redirect', 'airyo/users'),
(679, 2, 'redirect', 'airyo/gallery'),
(680, 2, 'redirect', 'airyo/counters'),
(681, 2, 'redirect', 'airyo/chunks'),
(682, 2, 'redirect', 'airyo/gallery'),
(683, 2, 'redirect', 'airyo/users'),
(684, 2, 'redirect', 'airyo/gallery'),
(685, 2, 'redirect', 'airyo/news'),
(686, 2, 'redirect', 'airyo/menu'),
(687, 2, 'redirect', 'airyo/pages'),
(688, 2, 'redirect', 'airyo/pages'),
(689, 2, 'redirect', 'airyo/menu'),
(690, 2, 'redirect', 'airyo/pages'),
(691, 2, 'redirect', 'airyo/pages'),
(692, 2, 'redirect', 'airyo/pages'),
(693, 2, 'redirect', 'airyo/pages'),
(694, 2, 'redirect', 'airyo/pages'),
(695, 2, 'redirect', 'airyo/pages'),
(696, 2, 'redirect', 'airyo/pages'),
(697, 2, 'redirect', 'airyo/pages'),
(698, 2, 'redirect', 'airyo/pages'),
(699, 2, 'redirect', 'airyo/menu'),
(700, 2, 'redirect', 'airyo/pages'),
(701, 2, 'redirect', 'airyo/pages'),
(702, 2, 'redirect', 'airyo/pages'),
(703, 2, 'redirect', 'airyo/pages'),
(704, 2, 'redirect', 'airyo/pages'),
(705, 2, 'redirect', 'airyo/pages'),
(706, 2, 'redirect', 'airyo/pages'),
(707, 2, 'redirect', 'airyo/menu'),
(708, 2, 'redirect', 'airyo/news'),
(709, 2, 'redirect', 'airyo/files'),
(710, 2, 'redirect', 'airyo/files/content'),
(711, 2, 'redirect', 'airyo/files'),
(712, 2, 'redirect', 'airyo/files/sliders'),
(713, 2, 'redirect', 'airyo/files/sliders/a10.jpg'),
(714, 2, 'redirect', 'airyo/files'),
(715, 2, 'redirect', 'airyo/menu'),
(716, 2, 'redirect', 'airyo/news'),
(717, 2, 'redirect', 'airyo/menu'),
(718, 2, 'redirect', 'airyo/pages'),
(719, 2, 'redirect', 'airyo/menu'),
(720, 2, 'redirect', 'airyo/menu/1'),
(721, 2, 'redirect', 'airyo/menu'),
(722, 2, 'redirect', 'airyo/menu'),
(723, 2, 'redirect', 'airyo/pages'),
(724, 2, 'redirect', 'airyo/pages'),
(725, 2, 'redirect', 'airyo/users'),
(726, 2, 'redirect', 'airyo/menu'),
(727, 2, 'redirect', 'airyo/gallery'),
(728, 2, 'redirect', 'airyo/pages'),
(729, 2, 'redirect', 'airyo/menu'),
(730, 2, 'redirect', 'airyo/pages'),
(731, 2, 'redirect', 'airyo/news'),
(732, 2, 'redirect', 'airyo/news'),
(733, 2, 'redirect', 'airyo/menu'),
(734, 2, 'redirect', 'airyo/gallery'),
(735, 2, 'redirect', 'airyo/news'),
(736, 2, 'redirect', 'airyo/files'),
(737, 2, 'redirect', 'airyo/pages'),
(738, 2, 'redirect', 'airyo/pages'),
(739, 2, 'redirect', 'airyo/menu');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_menu`
--

CREATE TABLE `airyo_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` tinytext NOT NULL,
  `menu_group` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `airyo_menu`
--

INSERT INTO `airyo_menu` (`id`, `name`, `url`, `menu_group`, `parent_id`, `order`, `enabled`) VALUES
(4, 'ЛРСЗЦ', 'lrszc', 1, 72, 0, 0),
(8, 'Информация', 'info', 1, 0, 0, 1),
(23, 'История', 'story', 1, 32, 0, 1),
(24, 'Новости', 'news', 1, 0, 1, 1),
(26, 'ВЫСТАВКИ в 2015 году', 'exhibitions', 1, 24, 0, 1),
(27, 'Конференции', 'conference', 1, 24, 5, 0),
(28, 'Семинары', 'workshops', 1, 24, 3, 0),
(29, 'ЛТО и ЛТ', 'lto', 1, 24, 4, 0),
(31, 'Библиография', 'bibliography', 1, 8, 0, 1),
(32, 'Лазерные технологии (ЛТ)', 'lt', 1, 8, 6, 0),
(33, 'Лазерное технологическое оборудование (ЛТО)', 'lto', 1, 8, 5, 0),
(34, 'Рынок ЛТО и ЛТ', 'market', 1, 8, 4, 0),
(35, 'Благодарности и награды', 'thanks_and_awards', 1, 23, 3, 0),
(37, 'Изобретения и патенты', 'inventions-and-patents', 1, 8, 1, 1),
(38, 'Партнеры и заказчики', 'partnersandcustomers', 1, 23, 1, 1),
(42, 'О фирме', 'http://andreyka.ru', 2, 0, 3, 1),
(43, 'Контакты', 'contact', 2, 0, 2, 1),
(44, 'Сертификаты', 'certificates', 2, 0, 0, 0),
(45, 'Терминология и ключевые слова', 'keywords', 1, 8, 3, 1),
(47, 'Основные обозначения', 'oboznacheniya', 1, 31, 0, 1),
(48, 'Перечень сокращений', 'sokr', 1, 8, 2, 1),
(50, 'Аттестаты', '23', 2, 0, 1, 0),
(51, 'Сертификаты', 'certificates', 1, 23, 2, 1),
(52, 'Аттестаты', 'attestat', 1, 23, 0, 1),
(53, 'В Санкт-Петербурге', 'vystavki-spb-2015', 1, 26, 4, 1),
(54, 'В странах СНГ', 'vystavki-prom-sng-2015', 1, 26, 0, 1),
(55, 'В мире', 'vystavki-prom-mir-2015', 1, 26, 3, 1),
(56, 'В России', 'vystavki-prom-rossiya', 1, 26, 2, 1),
(57, 'В Москве', 'vystavki-msk-2015', 1, 26, 1, 1),
(58, 'ЛАЗЕРНАЯ АССОЦИАЦИЯ ', 'news', 1, 24, 1, 1),
(59, 'ЛАЗЕРНОЕ ТЕХНОЛОГИЧЕСКОЕ ОБОРУДОВАНИЕ ', 'news/publication/lto-lt', 1, 70, 0, 1),
(60, 'Дисковые лазеры', 'news', 1, 59, 2, 1),
(61, 'Волоконные лазеры', 'news', 1, 59, 0, 1),
(62, 'ЛАЗЕРНЫЕ ТЕХНОЛОГИИ', 'news', 1, 70, 1, 1),
(63, 'Диодные лазеры', 'news', 1, 59, 1, 1),
(64, 'Сварка', 'news', 1, 62, 0, 1),
(65, 'Резка', 'news', 1, 62, 1, 1),
(66, 'Наплавка', 'news', 1, 62, 3, 1),
(67, 'Маркировка / Гравировка', 'news', 1, 62, 2, 1),
(70, 'НОВЫЕ ПУБЛИКАЦИИ ', 'news', 1, 24, 2, 1),
(71, 'Фото', 'gallery', 1, 0, 2, 1),
(72, 'Выставки / семинары / конференции', 'photo', 1, 71, 0, 0),
(73, 'ываываыв', 'аываыва', 2, 76, 0, 1),
(74, 'ачпфв', 'авафыв', 2, 44, 2, 1),
(75, 'fasdfas', 'dfasdfasdf', 2, 44, 1, 1),
(76, 'erwe', 'andreykaru', 2, 44, 0, 1),
(77, 'ббб', 'ываыва', 2, 73, 0, 1),
(78, '111', '111', 2, 0, 4, 0),
(79, 'aaa', 'aaa', 2, 73, 1, 1),
(80, 'sdfsf', 'sdfsdf', 2, 0, 5, 0),
(81, 'ergd', 'dsfdsfg', 1, 8, 7, 1),
(82, 'asd', 'asdsadf', 1, 0, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `airyo_menu_group`
--

CREATE TABLE `airyo_menu_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `airyo_menu_group`
--

INSERT INTO `airyo_menu_group` (`id`, `name`) VALUES
(1, 'Главное меню'),
(2, 'Информация');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_modules`
--

CREATE TABLE `airyo_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(511) DEFAULT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Модули' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `airyo_modules`
--

INSERT INTO `airyo_modules` (`id`, `title`, `alias`, `description`, `position`) VALUES
(1, 'Страницы', 'pages', NULL, 1),
(2, 'Меню', 'menu', NULL, 2),
(3, 'Файлы', 'files', NULL, 4),
(4, 'Пользователи', 'users', NULL, 5),
(5, 'Фотоальбомы', 'gallery', NULL, 6),
(6, 'Счётчики', 'counters', NULL, 8),
(7, 'Новости', 'news', NULL, 3),
(8, 'Фрагменты', 'chunks', NULL, 9),
(9, 'Поисковая оптимизация', 'seo', NULL, 10),
(10, 'Слайдеры', 'sliders', NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `airyo_news`
--

CREATE TABLE `airyo_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `anons` text NOT NULL,
  `content` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `img_ext` varchar(32) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `airyo_news`
--

INSERT INTO `airyo_news` (`id`, `title`, `anons`, `content`, `alias`, `img_ext`, `enabled`, `date`) VALUES
(42, 'Видео: велосипедист проехал по тросу над обрывом', 'Велосипедиста Кенни Белэя (Kenny Belaey) называют «волшебником» не случайно: едва ли найдется кто-нибудь еще, способный проехать на велосипеде по 20-метровому тросу над пропастью.', '<p style="">У спортсмена на подготовку к этому трюку ушел год. И это при том, что он четырехкратный чемпион UCI World в дисциплине, требующей от велосипедистов прохождения полосы препятствий без касания земли ногами.</p>\n<p style=""><iframe width="560" height="315" src="https://www.youtube.com/embed/3um6o3O9Q44" frameborder="0" allowfullscreen=""></iframe></p>\n<p>Видео было снято на горнолыжном курорте Ла-Плань во Франции. Кенни провел на его склонах немало времени. «Когда я впервые въехал на трос — и это после нескольких месяцев подготовки! — я решил, что это невозможно, — рассказывает велосипедист. — В итоге трюк оказался самым сложным из всех, с которыми мы сталкивались».</p>\n', 'nadex_record', '.jpg', 1, '2015-05-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_pages_layouts`
--

CREATE TABLE `airyo_pages_layouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `airyo_pages_layouts`
--

INSERT INTO `airyo_pages_layouts` (`id`, `name`, `view`) VALUES
(1, 'Стандартная страница', 'default.php');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_roles`
--

CREATE TABLE `airyo_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Роли пользователей' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `airyo_roles`
--

INSERT INTO `airyo_roles` (`id`, `title`, `description`) VALUES
(1, 'editor', 'Редактор в административной части'),
(2, 'root', 'Суперадмин');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_seo`
--

CREATE TABLE `airyo_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `last_modified` datetime NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `path` (`path`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `airyo_seo`
--

INSERT INTO `airyo_seo` (`id`, `title`, `meta_keywords`, `meta_description`, `last_modified`, `path`) VALUES
(1, 'test1', 'test1, test1', 'test1 test1 test1', '2015-05-03 10:10:00', 'contact');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_slide`
--

CREATE TABLE `airyo_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(511) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sliders_id` int(11) unsigned NOT NULL,
  `create_date` datetime NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1',
  `order` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_airyo_sliders_1_idx` (`sliders_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Слайд' AUTO_INCREMENT=24 ;

--
-- Dumping data for table `airyo_slide`
--

INSERT INTO `airyo_slide` (`id`, `title`, `description`, `link`, `sliders_id`, `create_date`, `enabled`, `order`) VALUES
(5, 'Slide 1', 'First slide.', 'http://yandex.ru', 1, '0000-00-00 00:00:00', 1, '2'),
(6, 'Slide 2', 'This is a second slide', 'http://google.com', 1, '0000-00-00 00:00:00', 1, '0'),
(7, 'Slide 32222', 'This is a last slide', 'http://apple.com', 1, '0000-00-00 00:00:00', 1, '1'),
(10, 'Slide 11 from slider 2', 'First slide of second slider', 'http://www.codeigniter.com/', 2, '0000-00-00 00:00:00', 0, '0'),
(11, 'Slide 22 from slider 2', 'Second slide of second slider', 'http://laravel.com', 2, '0000-00-00 00:00:00', 1, '2'),
(15, 'Slide 33 from slider 2', 'Third slide of second slider', 'http://php.net', 2, '0000-00-00 00:00:00', 1, '1'),
(16, 'Slide 44 from slider 2', 'Fourth slide of second slider', 'http://stackoverflow.com/questions/4061293/mysql-cant-create-table-errno-150', 2, '0000-00-00 00:00:00', 1, '4'),
(17, 'Slide 55 from slider 2', 'Fifth slide of second slider', 'http://kinopoisk.ru', 2, '0000-00-00 00:00:00', 0, '3'),
(18, 'Slide 66 from slider 2', 'Sixth slide of second slider', 'http://habrahabr.ru/company/jugru/blog/268607/', 2, '0000-00-00 00:00:00', 1, '5'),
(20, 'Slide 3-1', 'Text1', NULL, 3, '0000-00-00 00:00:00', 1, '2'),
(21, 'Slide 3-2', 'Text2', NULL, 3, '0000-00-00 00:00:00', 1, '3'),
(22, 'Slide 3-3', 'Text3', NULL, 3, '0000-00-00 00:00:00', 1, '1'),
(23, 'Slide 3-4', 'Text4', NULL, 3, '0000-00-00 00:00:00', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_sliders`
--

CREATE TABLE `airyo_sliders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Слайдеры' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `airyo_sliders`
--

INSERT INTO `airyo_sliders` (`id`, `title`, `create_date`) VALUES
(1, 'First slide', '0000-00-00 00:00:00'),
(2, 'Second slide', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_trash`
--

CREATE TABLE `airyo_trash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `airyo_trash`
--

INSERT INTO `airyo_trash` (`id`, `deleted_id`, `data`, `type`) VALUES
(1, 118, 'a:10:{s:2:"id";s:3:"118";s:5:"title";s:0:"";s:2:"h1";s:6:"dfgdfg";s:7:"content";s:65:"a:2:{s:8:"content1";s:8:"dfgdgdgf";s:8:"content2";s:7:"dfgdgdg";}";s:5:"alias";s:4:"dgdg";s:16:"meta_description";s:0:"";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:1:"1";s:8:"template";s:12:"pages_1block";}', 'page'),
(2, 40, 'O:8:"stdClass":6:{s:2:"id";s:2:"40";s:4:"name";s:11:"sdfsdsdfsdf";s:3:"url";s:5:"sdfsd";s:10:"menu_group";s:1:"2";s:9:"parent_id";s:1:"0";s:5:"order";s:1:"0";}', 'menu'),
(3, 41, 'O:8:"stdClass":6:{s:2:"id";s:2:"41";s:4:"name";s:8:"sdfdsfsd";s:3:"url";s:5:"sdfsd";s:10:"menu_group";s:1:"2";s:9:"parent_id";s:1:"0";s:5:"order";s:1:"0";}', 'menu'),
(4, 45, 'O:8:"stdClass":6:{s:2:"id";s:2:"45";s:4:"name";s:5:"23424";s:3:"url";s:6:"цук";s:10:"menu_group";s:1:"2";s:9:"parent_id";s:1:"0";s:5:"order";s:1:"4";}', 'menu'),
(5, 73, 'O:8:"stdClass":7:{s:2:"id";s:2:"73";s:4:"name";s:4:"test";s:3:"url";s:4:"test";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:2:"68";s:5:"order";s:1:"0";s:7:"enabled";s:1:"1";}', 'menu'),
(6, 147, 'a:10:{s:2:"id";s:3:"147";s:5:"title";s:1:"0";s:2:"h1";s:3:"sdf";s:7:"content";s:6:"sdfsdf";s:5:"alias";s:3:"sdf";s:16:"meta_description";s:1:"0";s:13:"meta_keywords";s:1:"0";s:7:"enabled";s:1:"1";s:4:"type";s:0:"";s:8:"template";s:7:"default";}', 'page'),
(7, 146, 'a:10:{s:2:"id";s:3:"146";s:5:"title";s:1:"0";s:2:"h1";s:4:"test";s:7:"content";s:4:"test";s:5:"alias";s:4:"test";s:16:"meta_description";s:1:"0";s:13:"meta_keywords";s:1:"0";s:7:"enabled";s:1:"1";s:4:"type";s:0:"";s:8:"template";s:7:"default";}', 'page'),
(8, 145, 'a:10:{s:2:"id";s:3:"145";s:5:"title";s:1:"0";s:2:"h1";s:6:"sdfsdf";s:7:"content";s:41:"[[Gallery:index;label="album1424958384"]]";s:5:"alias";s:4:"foto";s:16:"meta_description";s:1:"0";s:13:"meta_keywords";s:1:"0";s:7:"enabled";s:1:"1";s:4:"type";s:1:"0";s:8:"template";s:13:"pages_default";}', 'page'),
(9, 150, 'a:10:{s:2:"id";s:3:"150";s:5:"title";s:1:"0";s:2:"h1";s:3:"aaa";s:7:"content";s:2:"as";s:5:"alias";s:2:"aa";s:16:"meta_description";s:1:"0";s:13:"meta_keywords";s:1:"0";s:7:"enabled";s:1:"0";s:4:"type";s:0:"";s:8:"template";s:13:"pages_default";}', 'page'),
(10, 73, 'O:8:"stdClass":7:{s:2:"id";s:2:"73";s:4:"name";s:3:"ssd";s:3:"url";s:2:"sd";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:1:"0";s:5:"order";s:1:"6";s:7:"enabled";s:1:"1";}', 'menu'),
(11, 2, 'a:7:{s:2:"id";s:1:"2";s:5:"title";s:8:"Нов 2";s:5:"anons";s:29:"укукеу кеукеуну";s:7:"content";s:58:"уке укеуекукеукеукеуке кеукеуе";s:5:"alias";s:18:"укеукеуке";s:7:"enabled";s:1:"1";s:4:"date";s:19:"2015-01-15 00:52:26";}', 'page'),
(12, 5, 'a:7:{s:2:"id";s:1:"5";s:5:"title";s:3:"111";s:5:"anons";s:4:"1111";s:7:"content";s:3:"111";s:5:"alias";s:4:"1111";s:7:"enabled";s:1:"1";s:4:"date";s:19:"2015-04-10 15:15:19";}', 'page'),
(13, 6, 'a:7:{s:2:"id";s:1:"6";s:5:"title";s:9:"sdfsdfdsf";s:5:"anons";s:9:"sdfsdfsdf";s:7:"content";s:8:"dfssdfds";s:5:"alias";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:19:"2015-04-10 19:14:18";}', 'page'),
(14, 8, 'a:8:{s:2:"id";s:1:"8";s:5:"title";s:3:"111";s:5:"anons";s:3:"111";s:7:"content";s:3:"111";s:5:"alias";s:0:"";s:3:"img";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:19:"2015-04-10 20:44:10";}', 'page'),
(15, 3, 'a:8:{s:2:"id";s:1:"3";s:5:"title";s:8:"Нов 2";s:5:"anons";s:29:"укукеу кеукеуну";s:7:"content";s:58:"уке укеуекукеукеукеуке кеукеуе";s:5:"alias";s:19:"укеукеуке1";s:3:"img";s:5:"3.jpg";s:7:"enabled";s:1:"1";s:4:"date";s:19:"2015-01-15 01:02:15";}', 'page'),
(16, 4, 'a:8:{s:2:"id";s:1:"4";s:5:"title";s:16:"Новость 3";s:5:"anons";s:67:"Новость 3 Новость 3 Новость 3 Новость 3";s:7:"content";s:27:"текст новости 3";s:5:"alias";s:7:"novost3";s:3:"img";s:5:"4.jpg";s:7:"enabled";s:1:"1";s:4:"date";s:19:"2015-01-15 20:48:26";}', 'page'),
(17, 10, 'a:8:{s:2:"id";s:2:"10";s:5:"title";s:24:"цукецуекцуек";s:5:"anons";s:30:"цукецукецуецуек";s:7:"content";s:16:"цукецуек";s:5:"alias";s:0:"";s:3:"img";s:6:"10.jpg";s:7:"enabled";s:1:"0";s:4:"date";s:19:"2015-04-10 21:15:36";}', 'page'),
(18, 11, 'a:8:{s:2:"id";s:2:"11";s:5:"title";s:6:"asdads";s:5:"anons";s:6:"asdasd";s:7:"content";s:6:"asdads";s:5:"alias";s:6:"asdasd";s:3:"img";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:19:"2015-04-10 22:03:38";}', 'page'),
(19, 23, 'a:8:{s:2:"id";s:2:"23";s:5:"title";s:3:"www";s:5:"anons";s:2:"ww";s:7:"content";s:3:"www";s:5:"alias";s:0:"";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"1";s:4:"date";s:19:"2015-04-11 10:09:04";}', 'page'),
(20, 24, 'a:8:{s:2:"id";s:2:"24";s:5:"title";s:6:"ккк";s:5:"anons";s:6:"ккк";s:7:"content";s:6:"ккк";s:5:"alias";s:0:"";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:19:"2015-04-11 10:15:24";}', 'page'),
(21, 25, 'a:8:{s:2:"id";s:2:"25";s:5:"title";s:6:"ккк";s:5:"anons";s:6:"ккк";s:7:"content";s:6:"ккк";s:5:"alias";s:0:"";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:19:"2015-04-11 10:15:57";}', 'page'),
(22, 26, 'a:8:{s:2:"id";s:2:"26";s:5:"title";s:6:"ккк";s:5:"anons";s:4:"кк";s:7:"content";s:6:"ккк";s:5:"alias";s:0:"";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:19:"2015-04-11 10:16:22";}', 'page'),
(23, 28, 'a:8:{s:2:"id";s:2:"28";s:5:"title";s:33:"Оплата задачи 1sdfsdf";s:5:"anons";s:3:"sfd";s:7:"content";s:3:"sdf";s:5:"alias";s:0:"";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"1";s:4:"date";s:10:"20.04.2011";}', 'page'),
(24, 1, 'a:4:{s:2:"id";s:1:"1";s:4:"name";s:23:"dfasdfasdfasasdfdsafsaf";s:5:"alias";s:6:"345345";s:7:"content";s:6:"123123";}', 'page'),
(25, 1, 'a:4:{s:2:"id";s:1:"1";s:4:"name";s:23:"dfasdfasdfasasdfdsafsaf";s:5:"alias";s:6:"345345";s:7:"content";s:6:"123123";}', 'page'),
(26, 1, 'a:4:{s:2:"id";s:1:"1";s:4:"name";s:23:"dfasdfasdfasasdfdsafsaf";s:5:"alias";s:6:"345345";s:7:"content";s:6:"123123";}', 'page'),
(27, 1, 'a:4:{s:2:"id";s:1:"1";s:4:"name";s:23:"dfasdfasdfasasdfdsafsaf";s:5:"alias";s:6:"345345";s:7:"content";s:6:"123123";}', 'page'),
(28, 69, 'O:8:"stdClass":7:{s:2:"id";s:2:"69";s:4:"name";s:24:"Тематический";s:3:"url";s:11:"spravochnik";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:2:"46";s:5:"order";s:1:"0";s:7:"enabled";s:1:"1";}', 'menu'),
(29, 68, 'O:8:"stdClass":7:{s:2:"id";s:2:"68";s:4:"name";s:20:"Алфавитный";s:3:"url";s:11:"spravochnik";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:2:"46";s:5:"order";s:1:"1";s:7:"enabled";s:1:"1";}', 'menu'),
(30, 121, 'a:10:{s:2:"id";s:3:"121";s:5:"title";s:1:"0";s:2:"h1";s:14:"Новости";s:7:"content";s:53:"Информация подготавливается";s:5:"alias";s:4:"news";s:16:"meta_description";s:1:"0";s:13:"meta_keywords";s:1:"0";s:7:"enabled";s:1:"0";s:4:"type";s:1:"0";s:8:"template";s:13:"pages_default";}', 'page'),
(31, 19, 'a:8:{s:2:"id";s:2:"19";s:5:"title";s:3:"888";s:5:"anons";s:3:"888";s:7:"content";s:3:"888";s:5:"alias";s:3:"888";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"10.04.2015";}', 'page'),
(32, 40, 'a:8:{s:2:"id";s:2:"40";s:5:"title";s:3:"sdf";s:5:"anons";s:4:"sdfs";s:7:"content";s:0:"";s:5:"alias";s:4:"8888";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"1";s:4:"date";s:10:"27.04.2015";}', 'page'),
(33, 49, 'a:8:{s:2:"id";s:2:"49";s:5:"title";s:3:"asd";s:5:"anons";s:3:"asd";s:7:"content";s:3:"ads";s:5:"alias";s:3:"asd";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"02.05.2015";}', 'page'),
(34, 55, 'a:8:{s:2:"id";s:2:"55";s:5:"title";s:4:"4444";s:5:"anons";s:3:"444";s:7:"content";s:0:"";s:5:"alias";s:4:"4444";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"28.04.2015";}', 'page'),
(35, 44, 'a:8:{s:2:"id";s:2:"44";s:5:"title";s:4:"2222";s:5:"anons";s:3:"222";s:7:"content";s:3:"222";s:5:"alias";s:8:"sdf67854";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"29.04.2015";}', 'page'),
(36, 1, 'a:8:{s:2:"id";s:1:"1";s:5:"title";s:6:"sdfsdf";s:5:"anons";s:57:"Тестовая новость анонс  апв апв";s:7:"content";s:514:"Тестовая новость ''Тестовая новостьТ естовая новость Тестовая  новостьТестовая новость  Тестовая новостьТестовая новость Тестовая новость Тестовая новость Тестовая новость Тестовая новость Тестовая новость  Тестовая новость Тестовая новость Т естовая новость Тестовая новость";s:5:"alias";s:3:"sdf";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"1";s:4:"date";s:10:"24.04.2015";}', 'page'),
(37, 53, 'a:8:{s:2:"id";s:2:"53";s:5:"title";s:3:"sdf";s:5:"anons";s:3:"sdf";s:7:"content";s:8:"sdfsdffs";s:5:"alias";s:4:"sdf1";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"1";s:4:"date";s:10:"12.04.2015";}', 'page'),
(38, 32, 'a:8:{s:2:"id";s:2:"32";s:5:"title";s:3:"234";s:5:"anons";s:3:"234";s:7:"content";s:3:"234";s:5:"alias";s:2:"67";s:7:"img_ext";s:4:".gif";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(39, 54, 'a:8:{s:2:"id";s:2:"54";s:5:"title";s:4:"5556";s:5:"anons";s:4:"5555";s:7:"content";s:0:"";s:5:"alias";s:4:"f555";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"19.04.2015";}', 'page'),
(40, 33, 'a:8:{s:2:"id";s:2:"33";s:5:"title";s:4:"5555";s:5:"anons";s:3:"555";s:7:"content";s:4:"5555";s:5:"alias";s:4:"2323";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"11.04.2015";}', 'page'),
(41, 34, 'a:8:{s:2:"id";s:2:"34";s:5:"title";s:8:"ewrtwert";s:5:"anons";s:8:"wertwert";s:7:"content";s:11:"wertwetrwet";s:5:"alias";s:3:"789";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(42, 38, 'a:8:{s:2:"id";s:2:"38";s:5:"title";s:4:"9999";s:5:"anons";s:3:"999";s:7:"content";s:3:"999";s:5:"alias";s:3:"bu6";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(43, 37, 'a:8:{s:2:"id";s:2:"37";s:5:"title";s:5:"55555";s:5:"anons";s:5:"55555";s:7:"content";s:5:"55555";s:5:"alias";s:4:"3c43";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(44, 39, 'a:8:{s:2:"id";s:2:"39";s:5:"title";s:19:"456кепаепва";s:5:"anons";s:6:"рпа";s:7:"content";s:22:"ривапрривар";s:5:"alias";s:3:"dsf";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(45, 43, 'a:8:{s:2:"id";s:2:"43";s:5:"title";s:3:"wer";s:5:"anons";s:3:"wer";s:7:"content";s:6:"werwer";s:5:"alias";s:4:"v5y4";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(46, 35, 'a:8:{s:2:"id";s:2:"35";s:5:"title";s:6:"890808";s:5:"anons";s:8:"09890890";s:7:"content";s:9:"890809809";s:5:"alias";s:5:"eu536";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(47, 41, 'a:8:{s:2:"id";s:2:"41";s:5:"title";s:5:"fdgfd";s:5:"anons";s:4:"dfgd";s:7:"content";s:7:"fgdfgdg";s:5:"alias";s:7:"6yub465";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(48, 27, 'a:8:{s:2:"id";s:2:"27";s:5:"title";s:2:"se";s:5:"anons";s:3:"sfd";s:7:"content";s:3:"sdf";s:5:"alias";s:5:"ert34";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"1";s:4:"date";s:10:"20.04.2011";}', 'page'),
(49, 46, 'a:8:{s:2:"id";s:2:"46";s:5:"title";s:3:"dsf";s:5:"anons";s:6:"sdfsdf";s:7:"content";s:6:"sdfsfd";s:5:"alias";s:2:"fh";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(50, 45, 'a:8:{s:2:"id";s:2:"45";s:5:"title";s:3:"ert";s:5:"anons";s:3:"ert";s:7:"content";s:3:"ert";s:5:"alias";s:5:"9o89m";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(51, 51, 'a:8:{s:2:"id";s:2:"51";s:5:"title";s:3:"asd";s:5:"anons";s:2:"ad";s:7:"content";s:3:"ads";s:5:"alias";s:12:"asddhlkljsss";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(52, 15, 'a:8:{s:2:"id";s:2:"15";s:5:"title";s:3:"444";s:5:"anons";s:3:"444";s:7:"content";s:3:"444";s:5:"alias";s:3:"444";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"10.04.2015";}', 'page'),
(53, 7, 'a:8:{s:2:"id";s:1:"7";s:5:"title";s:15:"ываыва123";s:5:"anons";s:10:"ываыа";s:7:"content";s:10:"ыавыа";s:5:"alias";s:5:"23424";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"1";s:4:"date";s:10:"10.04.2015";}', 'page'),
(54, 14, 'a:8:{s:2:"id";s:2:"14";s:5:"title";s:3:"333";s:5:"anons";s:3:"333";s:7:"content";s:3:"333";s:5:"alias";s:3:"333";s:7:"img_ext";s:4:".gif";s:7:"enabled";s:1:"1";s:4:"date";s:10:"10.04.2015";}', 'page'),
(55, 13, 'a:8:{s:2:"id";s:2:"13";s:5:"title";s:3:"222";s:5:"anons";s:3:"222";s:7:"content";s:3:"222";s:5:"alias";s:3:"222";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"10.04.2015";}', 'page'),
(56, 16, 'a:8:{s:2:"id";s:2:"16";s:5:"title";s:3:"555";s:5:"anons";s:3:"555";s:7:"content";s:3:"555";s:5:"alias";s:3:"555";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"10.04.2015";}', 'page'),
(57, 36, 'a:8:{s:2:"id";s:2:"36";s:5:"title";s:9:"tyururtyu";s:5:"anons";s:8:"rtuytruy";s:7:"content";s:9:"rtyurtuyt";s:5:"alias";s:4:"45tc";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"08.04.2015";}', 'page'),
(58, 29, 'a:8:{s:2:"id";s:2:"29";s:5:"title";s:3:"yyy";s:5:"anons";s:3:"yyy";s:7:"content";s:3:"yyy";s:5:"alias";s:3:"wee";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"1";s:4:"date";s:10:"20.04.2011";}', 'page'),
(59, 52, 'a:8:{s:2:"id";s:2:"52";s:5:"title";s:2:"11";s:5:"anons";s:2:"11";s:7:"content";s:2:"11";s:5:"alias";s:1:"1";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2015";}', 'page'),
(60, 48, 'a:8:{s:2:"id";s:2:"48";s:5:"title";s:3:"sdf";s:5:"anons";s:3:"sdf";s:7:"content";s:6:"sdfsfd";s:5:"alias";s:2:"sd";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"1";s:4:"date";s:10:"11.04.2015";}', 'page'),
(61, 20, 'a:8:{s:2:"id";s:2:"20";s:5:"title";s:4:"9993";s:5:"anons";s:8:"999sf sf";s:7:"content";s:3:"999";s:5:"alias";s:3:"999";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"10.04.2015";}', 'page'),
(62, 47, 'a:8:{s:2:"id";s:2:"47";s:5:"title";s:5:"rsgsd";s:5:"anons";s:6:"fgsdfg";s:7:"content";s:8:"dsfgdsfg";s:5:"alias";s:4:"67er";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"1";s:4:"date";s:10:"01.04.2015";}', 'page'),
(63, 50, 'a:8:{s:2:"id";s:2:"50";s:5:"title";s:5:"werwr";s:5:"anons";s:6:"wrewre";s:7:"content";s:3:"wer";s:5:"alias";s:2:"24";s:7:"img_ext";s:4:".jpg";s:7:"enabled";s:1:"1";s:4:"date";s:10:"01.04.2015";}', 'page'),
(64, 22, 'a:8:{s:2:"id";s:2:"22";s:5:"title";s:3:"qqq";s:5:"anons";s:3:"qqq";s:7:"content";s:3:"qqq";s:5:"alias";s:3:"tyt";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"11.04.2014";}', 'page'),
(65, 31, 'a:8:{s:2:"id";s:2:"31";s:5:"title";s:3:"www";s:5:"anons";s:3:"www";s:7:"content";s:3:"www";s:5:"alias";s:2:"23";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"20.04.2011";}', 'page'),
(66, 30, 'a:8:{s:2:"id";s:2:"30";s:5:"title";s:3:"111";s:5:"anons";s:3:"111";s:7:"content";s:3:"111";s:5:"alias";s:2:"jk";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"20.04.2011";}', 'page'),
(67, 12, 'a:8:{s:2:"id";s:2:"12";s:5:"title";s:3:"111";s:5:"anons";s:3:"111";s:7:"content";s:3:"111";s:5:"alias";s:2:"ew";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"01.04.2015";}', 'page'),
(68, 18, 'a:8:{s:2:"id";s:2:"18";s:5:"title";s:3:"777";s:5:"anons";s:3:"777";s:7:"content";s:3:"777";s:5:"alias";s:3:"777";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"10.04.2015";}', 'page'),
(69, 17, 'a:8:{s:2:"id";s:2:"17";s:5:"title";s:3:"666";s:5:"anons";s:3:"666";s:7:"content";s:3:"666";s:5:"alias";s:3:"666";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"10.04.2015";}', 'page'),
(70, 9, 'a:8:{s:2:"id";s:1:"9";s:5:"title";s:3:"wer";s:5:"anons";s:3:"111";s:7:"content";s:3:"111";s:5:"alias";s:5:"wersd";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"0";s:4:"date";s:10:"10.04.2015";}', 'page'),
(71, 56, 'a:8:{s:2:"id";s:2:"56";s:5:"title";s:3:"ttt";s:5:"anons";s:7:"tttsd f";s:7:"content";s:3:"ttt";s:5:"alias";s:3:"ttt";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"28.04.2015";}', 'page'),
(72, 21, 'a:8:{s:2:"id";s:2:"21";s:5:"title";s:3:"000";s:5:"anons";s:3:"000";s:7:"content";s:8:"asdasdad";s:5:"alias";s:3:"000";s:7:"img_ext";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"30.04.2015";}', 'page'),
(73, 49, 'O:8:"stdClass":7:{s:2:"id";s:2:"49";s:4:"name";s:40:"Список научных трудов";s:3:"url";s:15:"scientific-work";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:2:"31";s:5:"order";s:1:"1";s:7:"enabled";s:1:"1";}', 'menu'),
(74, 46, 'O:8:"stdClass":7:{s:2:"id";s:2:"46";s:4:"name";s:57:"Библиографические справочники";s:3:"url";s:11:"spravochnik";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:2:"31";s:5:"order";s:1:"0";s:7:"enabled";s:1:"1";}', 'menu'),
(75, 36, 'O:8:"stdClass":7:{s:2:"id";s:2:"36";s:4:"name";s:20:"Достижения";s:3:"url";s:12:"achievements";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:2:"23";s:5:"order";s:1:"4";s:7:"enabled";s:1:"0";}', 'menu'),
(76, 39, 'O:8:"stdClass":7:{s:2:"id";s:2:"39";s:4:"name";s:22:"Фотогалерея";s:3:"url";s:7:"gallery";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:2:"23";s:5:"order";s:1:"5";s:7:"enabled";s:1:"0";}', 'menu'),
(77, 25, 'O:8:"stdClass":7:{s:2:"id";s:2:"25";s:4:"name";s:30:"Вакансии и кадры";s:3:"url";s:7:"vacancy";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:1:"8";s:5:"order";s:1:"4";s:7:"enabled";s:1:"0";}', 'menu'),
(78, 30, 'O:8:"stdClass":7:{s:2:"id";s:2:"30";s:4:"name";s:39:"Аналитические обзоры";s:3:"url";s:18:"analytical-reviews";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:1:"8";s:5:"order";s:1:"5";s:7:"enabled";s:1:"0";}', 'menu');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_type_content`
--

CREATE TABLE `airyo_type_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `airyo_type_content`
--

INSERT INTO `airyo_type_content` (`id`, `type`, `alias`) VALUES
(1, 'Страницы', 'pages'),
(2, 'Новости', 'news'),
(3, 'Фрагменты', 'fragments');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_users`
--

CREATE TABLE `airyo_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `airyo_users`
--

INSERT INTO `airyo_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `role_id`) VALUES
(2, '��,�', 'root', 'ae53bfd913251b7ddf5a09623ed074e4a5048d9d', NULL, 'root@airyo.ru', NULL, NULL, NULL, 'a819b0355785a72ec08d6535790ceadddc01235a', 1392664432, 1446018195, 1, 'root', '', '', '', 2),
(3, '\\5m�', 'editor', '834dfce1709c5f9f68f3c3fd609a1adca2c5e798', NULL, 'editor@airyo.ru', NULL, NULL, NULL, '68ff2e8044eeb2ecbc9d2209f307f75d52090830', 1422555843, 1445411189, 1, 'editor', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `airyo_users_groups`
--

CREATE TABLE `airyo_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=199 ;

--
-- Dumping data for table `airyo_users_groups`
--

INSERT INTO `airyo_users_groups` (`id`, `user_id`, `group_id`) VALUES
(196, 2, 1),
(197, 2, 2),
(198, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `airyo_users_modules`
--

CREATE TABLE `airyo_users_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Соотношения пользователей и групп' AUTO_INCREMENT=99 ;

--
-- Dumping data for table `airyo_users_modules`
--

INSERT INTO `airyo_users_modules` (`id`, `user_id`, `module_id`) VALUES
(81, 5, 1),
(82, 5, 2),
(83, 5, 3),
(84, 6, 1),
(96, 3, 1),
(97, 3, 2),
(98, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `airyo_versions`
--

CREATE TABLE `airyo_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  `type` varchar(32) NOT NULL,
  `id_origin` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `airyo_versions`
--

INSERT INTO `airyo_versions` (`id`, `data`, `type`, `id_origin`, `author`, `timestamp`) VALUES
(1, 'a:7:{s:5:"title";s:111:"Японские специалисты в NADEX Laser R & D Center (Tsuruga) УСТАНОВИЛИ РЕКОРД";s:5:"alias";s:12:"nadex_record";s:5:"anons";s:822:"За 21 один проход специалисты проплавили на волоконном 100-кВт-ке IPG нержавеющую сталь SUS 304 толщиной 100 мм ( 50 кВт) и 125 мм  (70 кВт) в низком вакууме 0,1 Ра. В азоте, защитном газе, глубина проплавления – 40 и 38 мм со скоростью 2 и 3 м/мин соответственно. Диаметр фокальной точки составлял 1 мм / WHAT''s new with 100 kW fiber lasers ?// Industrial Laser Solutions.-2015, №1 Jan/Feb.- Р.2: <a href="http://www.industrial-lasers.com/articles/print/volume-30/issue-1/departments/update/what-s-new-with-100kw-fiber-lasers.html" target="_blank">http//www.industrial-lasers.com</a><br>Ред.: А.Игнатов";s:7:"content";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-05-29";s:2:"id";s:2:"42";}', 'news', 42, 0, '2015-04-28 10:55:03'),
(2, 'a:7:{s:5:"title";s:111:"Японские специалисты в NADEX Laser R & D Center (Tsuruga) УСТАНОВИЛИ РЕКОРД";s:5:"alias";s:12:"nadex_record";s:5:"anons";s:822:"За 21 один проход специалисты проплавили на волоконном 100-кВт-ке IPG нержавеющую сталь SUS 304 толщиной 100 мм ( 50 кВт) и 125 мм  (70 кВт) в низком вакууме 0,1 Ра. В азоте, защитном газе, глубина проплавления – 40 и 38 мм со скоростью 2 и 3 м/мин соответственно. Диаметр фокальной точки составлял 1 мм / WHAT''s new with 100 kW fiber lasers ?// Industrial Laser Solutions.-2015, №1 Jan/Feb.- Р.2: <a href="http://www.industrial-lasers.com/articles/print/volume-30/issue-1/departments/update/what-s-new-with-100kw-fiber-lasers.html" target="_blank">http//www.industrial-lasers.com</a><br>Ред.: А.Игнатов";s:7:"content";s:0:"";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-05-29";s:2:"id";s:2:"42";}', 'news', 42, 0, '2015-04-28 10:56:18'),
(3, 'a:7:{s:5:"title";s:111:"Японские специалисты в NADEX Laser R & D Center (Tsuruga) УСТАНОВИЛИ РЕКОРД";s:5:"alias";s:12:"nadex_record";s:5:"anons";s:822:"За 21 один проход специалисты проплавили на волоконном 100-кВт-ке IPG нержавеющую сталь SUS 304 толщиной 100 мм ( 50 кВт) и 125 мм  (70 кВт) в низком вакууме 0,1 Ра. В азоте, защитном газе, глубина проплавления – 40 и 38 мм со скоростью 2 и 3 м/мин соответственно. Диаметр фокальной точки составлял 1 мм / WHAT''s new with 100 kW fiber lasers ?// Industrial Laser Solutions.-2015, №1 Jan/Feb.- Р.2: <a href="http://www.industrial-lasers.com/articles/print/volume-30/issue-1/departments/update/what-s-new-with-100kw-fiber-lasers.html" target="_blank">http//www.industrial-lasers.com</a><br>Ред.: А.Игнатов";s:7:"content";s:8:"sdfsdfsd";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-05-29";s:2:"id";s:2:"42";}', 'news', 42, 0, '2015-04-28 10:56:25'),
(4, 'a:7:{s:5:"title";s:111:"Японские специалисты в NADEX Laser R & D Center (Tsuruga) УСТАНОВИЛИ РЕКОРД";s:5:"alias";s:12:"nadex_record";s:5:"anons";s:822:"За 21 один проход специалисты проплавили на волоконном 100-кВт-ке IPG нержавеющую сталь SUS 304 толщиной 100 мм ( 50 кВт) и 125 мм  (70 кВт) в низком вакууме 0,1 Ра. В азоте, защитном газе, глубина проплавления – 40 и 38 мм со скоростью 2 и 3 м/мин соответственно. Диаметр фокальной точки составлял 1 мм / WHAT''s new with 100 kW fiber lasers ?// Industrial Laser Solutions.-2015, №1 Jan/Feb.- Р.2: <a href="http://www.industrial-lasers.com/articles/print/volume-30/issue-1/departments/update/what-s-new-with-100kw-fiber-lasers.html" target="_blank">http//www.industrial-lasers.com</a><br>Ред.: А.Игнатов";s:7:"content";s:8:"sdfsdfsd";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-05-29";s:2:"id";s:2:"42";}', 'news', 42, 0, '2015-04-28 10:56:33'),
(5, 'a:7:{s:5:"title";s:111:"Японские специалисты в NADEX Laser R & D Center (Tsuruga) УСТАНОВИЛИ РЕКОРД";s:5:"alias";s:12:"nadex_record";s:5:"anons";s:822:"За 21 один проход специалисты проплавили на волоконном 100-кВт-ке IPG нержавеющую сталь SUS 304 толщиной 100 мм ( 50 кВт) и 125 мм  (70 кВт) в низком вакууме 0,1 Ра. В азоте, защитном газе, глубина проплавления – 40 и 38 мм со скоростью 2 и 3 м/мин соответственно. Диаметр фокальной точки составлял 1 мм / WHAT''s new with 100 kW fiber lasers ?// Industrial Laser Solutions.-2015, №1 Jan/Feb.- Р.2: <a href="http://www.industrial-lasers.com/articles/print/volume-30/issue-1/departments/update/what-s-new-with-100kw-fiber-lasers.html" target="_blank">http//www.industrial-lasers.com</a><br>Ред.: А.Игнатов";s:7:"content";s:8:"sdfsdfsd";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-05-29";s:2:"id";s:2:"42";}', 'news', 42, 0, '2015-04-28 10:56:54'),
(6, 'a:7:{s:5:"title";s:112:"Японские1 специалисты в NADEX Laser R & D Center (Tsuruga) УСТАНОВИЛИ РЕКОРД";s:5:"alias";s:12:"nadex_record";s:5:"anons";s:822:"За 21 один проход специалисты проплавили на волоконном 100-кВт-ке IPG нержавеющую сталь SUS 304 толщиной 100 мм ( 50 кВт) и 125 мм  (70 кВт) в низком вакууме 0,1 Ра. В азоте, защитном газе, глубина проплавления – 40 и 38 мм со скоростью 2 и 3 м/мин соответственно. Диаметр фокальной точки составлял 1 мм / WHAT''s new with 100 kW fiber lasers ?// Industrial Laser Solutions.-2015, №1 Jan/Feb.- Р.2: <a href="http://www.industrial-lasers.com/articles/print/volume-30/issue-1/departments/update/what-s-new-with-100kw-fiber-lasers.html" target="_blank">http//www.industrial-lasers.com</a><br>Ред.: А.Игнатов";s:7:"content";s:8:"sdfsdfsd";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-05-29";s:2:"id";s:2:"42";}', 'news', 42, 0, '2015-04-28 10:57:33'),
(7, 'a:7:{s:5:"title";s:112:"Японские1 специалисты в NADEX Laser R & D Center (Tsuruga) УСТАНОВИЛИ РЕКОРД";s:5:"alias";s:12:"nadex_record";s:5:"anons";s:822:"За 21 один проход специалисты проплавили на волоконном 100-кВт-ке IPG нержавеющую сталь SUS 304 толщиной 100 мм ( 50 кВт) и 125 мм  (70 кВт) в низком вакууме 0,1 Ра. В азоте, защитном газе, глубина проплавления – 40 и 38 мм со скоростью 2 и 3 м/мин соответственно. Диаметр фокальной точки составлял 1 мм / WHAT''s new with 100 kW fiber lasers ?// Industrial Laser Solutions.-2015, №1 Jan/Feb.- Р.2: <a href="http://www.industrial-lasers.com/articles/print/volume-30/issue-1/departments/update/what-s-new-with-100kw-fiber-lasers.html" target="_blank">http//www.industrial-lasers.com</a><br>Ред.: А.Игнатов";s:7:"content";s:9:"sdfsdfsd ";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-05-29";s:2:"id";s:2:"42";}', 'news', 42, 0, '2015-04-28 10:59:52'),
(8, 'a:7:{s:5:"title";s:3:"asd";s:5:"alias";s:3:"asd";s:5:"anons";s:3:"asd";s:7:"content";s:3:"ads";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-05-02";s:2:"id";s:2:"49";}', 'news', 49, 0, '2015-04-28 11:07:09'),
(9, 'a:7:{s:5:"title";s:3:"555";s:5:"alias";s:3:"555";s:5:"anons";s:3:"555";s:7:"content";s:3:"555";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-04-10";s:2:"id";s:2:"16";}', 'news', 16, 0, '2015-04-28 11:07:54'),
(10, 'a:7:{s:5:"title";s:3:"ttt";s:5:"alias";s:3:"ttt";s:5:"anons";s:3:"ttt";s:7:"content";s:3:"ttt";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-04-28";s:2:"id";i:56;}', 'news', 56, 0, '2015-04-28 11:14:12'),
(15, 'a:7:{s:5:"title";s:3:"ttt";s:5:"alias";s:3:"ttt";s:5:"anons";s:7:"tttsd f";s:7:"content";s:3:"ttt";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-04-28";s:2:"id";i:56;}', 'news', 56, 0, '2015-04-28 11:17:56'),
(16, 'a:7:{s:5:"title";s:3:"666";s:5:"alias";s:3:"666";s:5:"anons";s:3:"666";s:7:"content";s:3:"666";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-04-10";s:2:"id";i:17;}', 'news', 17, 0, '2015-04-28 11:20:12'),
(17, 'a:7:{s:5:"title";s:112:"Японские1 специалисты в NADEX Laser R & D Center (Tsuruga) УСТАНОВИЛИ РЕКОРД";s:5:"alias";s:12:"nadex_record";s:5:"anons";s:822:"За 21 один проход специалисты проплавили на волоконном 100-кВт-ке IPG нержавеющую сталь SUS 304 толщиной 100 мм ( 50 кВт) и 125 мм  (70 кВт) в низком вакууме 0,1 Ра. В азоте, защитном газе, глубина проплавления – 40 и 38 мм со скоростью 2 и 3 м/мин соответственно. Диаметр фокальной точки составлял 1 мм / WHAT''s new with 100 kW fiber lasers ?// Industrial Laser Solutions.-2015, №1 Jan/Feb.- Р.2: <a href="http://www.industrial-lasers.com/articles/print/volume-30/issue-1/departments/update/what-s-new-with-100kw-fiber-lasers.html" target="_blank">http//www.industrial-lasers.com</a><br>Ред.: А.Игнатов";s:7:"content";s:9:"sdfsdfsd ";s:7:"enabled";s:1:"1";s:4:"date";s:10:"2015-05-29";s:2:"id";i:42;}', 'news', 42, 2, '2015-04-28 11:24:36'),
(18, 'a:3:{s:4:"name";s:46:"Копирайты внизу страницы";s:7:"content";s:91:"© ЛазерИнформСервис, 1992-2015    \n© Игнатов А.Г., 1982-2015";s:2:"id";i:2;}', 'chunks', 2, 2, '2015-04-28 11:37:32'),
(19, 'a:3:{s:4:"name";s:51:"Новости - текст перед лентой";s:7:"content";s:1948:"<p>Информация для сайта LASERIS.RU подготавливается на основе постоянного мониторинга средств научно-технической информации и в т.ч.: интернета, с акцентом на лазерную технику и лазерные технологии обработки материалов и, в первую очередь - лазерную сварку. При этом необходимо иметь в виду, что технологические особенности сварки и др.лазерных технологий на базе новейших мощных волоконных, диодных и дисковых лазеров - являются конфиденциальной информацией ООО"ЛазерИнформСервис" и других Исполнителей и Партнёров, и, к сожалению - не могут размещаться на сайте и  передаются Заказчикам только на договорной или контрактной основе.</p>\n<p>Новые библиографические источники: статьи и книги, отчёты и обзоры, изобретения и патенты,  касающиеся достаточно узкой области науки и техники - только лазерного технологического  оборудования и лазерных технологий обработки материалов, представляют из себя значительный объём - до тысячи источников в месяц, поэтому в разделах сайта приводятся только отдельные примеры таких источников и наиболее актуальная информация.</p>\n\n<br>";s:2:"id";i:3;}', 'chunks', 3, 2, '2015-04-28 11:37:44'),
(20, 'a:3:{s:4:"name";s:51:"Новости - текст перед лентой";s:7:"content";s:1949:"<p>Информация для сайта LASERIS.RU подготавливается на основе постоянного мониторинга средств научно-технической информации и в т.ч.: интернета, с акцентом на лазерную технику и лазерные технологии обработки материалов и, в первую очередь - лазерную сварку. При этом необходимо иметь в виду, что технологические особенности сварки и др.лазерных технологий на базе новейших мощных волоконных, диодных и дисковых лазеров - являются конфиденциальной информацией ООО"ЛазерИнформСервис" и других Исполнителей и Партнёров, и, к сожалению - не могут размещаться на сайте и  передаются Заказчикам только на договорной или контрактной основе.</p>\n<p>Новые библиографические источники: статьи и книги, отчёты и обзоры, изобретения и патенты,  касающиеся достаточно узкой области науки и техники - только лазерного технологического  оборудования и лазерных технологий обработки материалов, представляют из себя значительный объём - до тысячи источников в месяц, поэтому в разделах сайта приводятся только отдельные примеры таких источников и наиболее актуальная информация.</p>\n\n<br> ";s:2:"id";i:3;}', 'chunks', 3, 2, '2015-04-28 11:37:54');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airyo_albums`
--
ALTER TABLE `airyo_albums`
  ADD CONSTRAINT `fk_airyo_albums_users` FOREIGN KEY (`user_id`) REFERENCES `airyo_users` (`id`);

--
-- Constraints for table `airyo_images`
--
ALTER TABLE `airyo_images`
  ADD CONSTRAINT `fk_airyo_images_albums` FOREIGN KEY (`album_id`) REFERENCES `airyo_albums` (`id`),
  ADD CONSTRAINT `fk_airyo_images_users` FOREIGN KEY (`user_id`) REFERENCES `airyo_users` (`id`);

--
-- Constraints for table `airyo_users_groups`
--
ALTER TABLE `airyo_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `airyo_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `airyo_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
