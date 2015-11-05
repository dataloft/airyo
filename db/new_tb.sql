-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 05, 2015 at 05:35 PM
-- Server version: 5.5.42
-- PHP Version: 5.4.42

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airyo`
--

-- --------------------------------------------------------

--
-- Table structure for table `airyo_pages`
--

CREATE TABLE `airyo_pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `h1` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `alias` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `type` varchar(200) NOT NULL,
  `template` varchar(200) NOT NULL DEFAULT 'default'
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `airyo_pages`
--

INSERT INTO `airyo_pages` (`id`, `title`, `h1`, `content`, `alias`, `meta_description`, `meta_keywords`, `enabled`, `type`, `template`) VALUES
(106, '0', 'Главная страница', '<h1>Airyo <small>хорошая основа вашего сайта</small></h1>\n\n<p>Как известно, можно сделать сайт на основе популярной коробочной или облачной CMS, a можно на основе фреймворка. В первом случае вы получаете стандартный админский интерфейс, и некоторые особенности создания новых модулей (либо невозможность их создания в случае облака). Во втором случае, админский интерфейс может быть максимально заточен под нужны проекта, при создании новых модулей ограничений нет.</p>\n\n<p>Плюсы работы с коробочной CMS в том, что сайт на ее основе может быть дешевле, при условии, что используется стандартная комплектация. В случае с фреймворком плюсы заключаются в гибкости, возможности сделать ровно то, что хочется.</p>\n\n<p>Большинство популярных веб-ресурсов, конечно же, не являются коробочными продуктами, поскольку ограничения CMS сильно мешают гибкому развитию проекта. Такие ресурсы сделаны на фреймворках.</p>\n\n<!--<div class="well"></div>-->\n\n<p class="lead">Мы постарались объединить положительные стороны разных методов разработки:</p>\n\n<ul>\n<li>В основе сайта популярный фреймворк, а значит это гибкое, быстрое, безопасное решение.</li>\n<li>Сайт уже содержит каркас CMS с набором <a href="#">модулей первой необходимости</a>, но данная CMS не ограничивает свободу в создании новых модулей.</li>\n<li>Есть несколько хорошо протестированных <a href="#">готовых дизайн тем для сайта</a>, каждая из которых может быть переработана и адаптирована под ваши нужны.</li>\n<li>Сайт может быть расположен на хостинге повышенной доступности с резервированием данных, но при этом, в отличие от облака, вы будете фактическим владельцем сайта, а не просто его арендатором.</li>\n<li>Любые изменения в сайте вы можете заказать через <a href="http://smartandy.ru">наш сервис</a> на условиях 500р/час, что дешевле средней стоимости на рынке фриланса, при этом, вам не потребуется искать и выбирать специалистов. Большинство задач выполняются в день обращения.</li>\n</ul>\n\n<h2>Про дизайн этого сайта</h2>\n\n<p>В качестве демонстрации того, как все работает, мы сделали несколько готовых сайтов на основе проверенных и популярных дизайн-тем. Каждый сайт протестирован на разных устройствах и использует только качественные библиотеки.</p>\n\n<p>Любой из представленных дизайнов вы можете взять для себя бесплатно и использовать для своих нужд как есть, либо с любыми доработками.</p>\n\n<p>Дизайн-тема данного сайта называется <a href="#">Twitter Bootstrap</a>. Это, пожалуй, наиболее известный и часто используемый на данный момент Frontend Framework. Внешне сайт на Bootstrap может выглядеть лаконично, а может быть доработан и насыщен графикой. Но даже самый простой вариант сайта имеет очень много преимуществ. Он будет очень быстро загружаться и работать, будет выглядеть хорошо и аккуратно на любых устройствах.</p>\n\n<div class="well">\n<p>Для того, чтобы выбрать эту версию для основы своего сайта, вы можете действовать тремя способами:</p>\n<ol>\n<li>Забрать ее бесплатно из репозитория и настроить на своем сервере (потребуются навыки веб-разработчика)</li>\n<li>Воспользоваться автоматическим сервисом нашего хостинга. Не требует специальных знаний.</li>\n<li>Отправить заявку на развертывание и доработку сайта нам.</li>\n</ol>\n</div>\n\n\n\n<h2>А теперь немного картинок <small>не забудьте попробовать посмотреть на смартфоне</small></h2>\n\n[[Gallery:album1444295654]]\n\n\n<p><a href="#" class="btn btn-default btn-lg btn-block" role="button">Хочу такой сайт</a></p>\n\n\n\n<!--\n\n[[news_last:2]]\n\n[[gallery_last:2]]\n\n--!>', '', '0', '0', 1, '0', 'pages_default'),
(130, '', 'Информация', '<h1>Information page test</h1>\n<!-- Comments --!>', 'info', '', '', 1, '', 'pages_default'),
(145, '', 'О нас', '<h1>About us section</h1>', 'about', '', '', 0, '', 'pages_foundation');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_pages_views`
--

CREATE TABLE `airyo_pages_views` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `view` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `airyo_pages_views`
--

INSERT INTO `airyo_pages_views` (`id`, `title`, `view`) VALUES
(1, 'Bootstrap 3', 'pages_default'),
(2, 'Foundation 5', 'pages_foundation');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airyo_pages`
--
ALTER TABLE `airyo_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Indexes for table `airyo_pages_views`
--
ALTER TABLE `airyo_pages_views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airyo_pages`
--
ALTER TABLE `airyo_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `airyo_pages_views`
--
ALTER TABLE `airyo_pages_views`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
