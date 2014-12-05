-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 05, 2014 at 02:55 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Альбомы' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `airyo_albums`
--

INSERT INTO `airyo_albums` (`id`, `label`, `title`, `description`, `image_id`, `user_id`, `create_date`, `enable`) VALUES
(2, 'album1417784733', '123', '', 1, 2, '2014-12-05 13:05:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `airyo_content`
--

CREATE TABLE `airyo_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `h1` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `type` varchar(200) NOT NULL,
  `template` varchar(200) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `airyo_content`
--

INSERT INTO `airyo_content` (`id`, `title`, `h1`, `content`, `alias`, `meta_description`, `meta_keywords`, `enabled`, `type`, `template`) VALUES
(96, '0', 'part3', '<p class="p1"><span class="glyphicon glyphicon-star" >', 'part3', '0', '0', 1, '1', 'pages_default'),
(101, '0', 'part2', '<p class="p1"><span class="glyphicon glyphicon-star" >', 'part2', '0', '0', 1, '1', 'pages_default'),
(102, '0', 'part1', '<p class="p1"><span class="glyphicon glyphicon-star" style="padding-right: 1.3em; font-size: 75%;">', 'part1', '0', '0', 1, '1', 'pages_default'),
(106, '0', 'Главная страница', '<h1>A Full Width Image Slider Template</h1>\n<p >This is a great starting point for yet another modern and stylish website. Here are some things to consider when working with this template:</p>\n<ul>\n<li>Unique Fonts</li>\n<li>Attractive Colors</li>\n<li>Content Spacing for Legibility and Design</li>\n<li>Decent Pictures that Still Load Quickly (less than 400KB for example)</li>\n<li>Make the Pictures INFORMATIVE</li>\n<li>Custom Styling for the Captions</li>\n</ul>', '', '0', '0', 1, '1', 'pages_default'),
(108, '', 'contacts', '', 'contacts', '', '', 1, '1', 'pages_default'),
(110, '', 'dfgdfg', 'sdfsdfsdfsf', 'dfgdfg', '', '', 1, '1', 'pages_default'),
(112, '0', 'dfgdgfdg', 'a:2:{s:8:"content1";s:99:"<p class="p1"><span class="glyphicon glyphicon-star" style="padding-right: 1.3em; font-size: 75%;">";s:8:"content2";s:10:"текст";}', 'dfgdfgdfg', '0', '0', 1, '0', 'pages_1block'),
(113, '', 'fsdfsdf', 'dfsdfsd', 'sdfsdfsdfsdf', '', '', 1, '3', 'pages_default'),
(116, '', 'меню тест', 'меню тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тестменю тест', 'm', '', '', 1, '', 'pages_menu'),
(120, '0', 'test', 'a:2:{s:8:"content1";s:99:"<p class="p1"><span class="glyphicon glyphicon-star" style="padding-right: 1.3em; font-size: 75%;">";s:8:"content2";s:99:"<p class="p1"><span class="glyphicon glyphicon-star" style="padding-right: 1.3em; font-size: 75%;">";}', 'test', '0', '0', 1, '1', 'pages_1block');

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
(1, ' gsdg sgsd gsd', '89.218.130.23, 92.53.109.165', '*.airyo.ru, zherelevich.dev.airyo.ru');

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
(1, 'adminа', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `airyo_images`
--

CREATE TABLE `airyo_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Изображения' AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица для логирования' AUTO_INCREMENT=199 ;

--
-- Dumping data for table `airyo_logs`
--

INSERT INTO `airyo_logs` (`id`, `user_id`, `type`, `description`) VALUES
(1, 2, 'redirect', 'admin/menu'),
(2, 2, 'redirect', 'admin/content'),
(3, 2, 'redirect', 'admin/menu'),
(4, 2, 'redirect', 'admin/files'),
(5, 2, 'redirect', 'admin/menu'),
(6, 2, 'redirect', 'admin/content'),
(7, 2, 'redirect', 'admin/menu'),
(8, 2, 'redirect', 'admin/files'),
(9, 2, 'redirect', 'admin/users'),
(10, 2, 'redirect', 'admin/gallery'),
(11, 2, 'redirect', 'admin/counters'),
(12, 2, 'redirect', 'admin/files'),
(13, 2, 'redirect', 'admin/menu'),
(14, 2, 'redirect', 'admin/content'),
(15, 2, 'redirect', 'admin/content'),
(16, 2, 'redirect', 'admin/menu'),
(17, 2, 'redirect', 'admin/content'),
(18, 2, 'redirect', 'admin/content'),
(19, 2, 'redirect', 'admin/content/edit/96'),
(20, 2, 'redirect', 'admin/content'),
(21, 2, 'redirect', 'admin/content'),
(22, 2, 'redirect', 'admin/menu'),
(23, 2, 'redirect', 'admin/files'),
(24, 2, 'redirect', 'admin/content'),
(25, 2, 'redirect', 'admin/menu'),
(26, 2, 'redirect', 'admin/files'),
(27, 2, 'redirect', 'admin/content'),
(28, 2, 'redirect', 'admin/content/edit/118'),
(29, 2, 'redirect', 'admin/content/edit/118'),
(30, 2, 'redirect', 'admin/content/edit/118'),
(31, 2, 'redirect', 'admin/content'),
(32, 2, 'redirect', 'admin/content/edit/108'),
(33, 2, 'redirect', 'admin/content'),
(34, 2, 'redirect', 'admin/content/edit/106'),
(35, 2, 'redirect', 'admin/content/edit/106'),
(36, 2, 'redirect', 'admin/content'),
(37, 2, 'redirect', 'admin/content'),
(38, 2, 'redirect', 'admin/content/edit/96'),
(39, 2, 'redirect', 'admin/content/edit/96'),
(40, 2, 'redirect', 'admin/content'),
(41, 2, 'redirect', 'admin/content/edit/96'),
(42, 2, 'redirect', 'admin/content/edit/96'),
(43, 2, 'redirect', 'admin/menu'),
(44, 2, 'redirect', 'admin/files'),
(45, 2, 'redirect', 'admin/files/content'),
(46, 2, 'redirect', 'admin/files/content/5V68iM1RK_Y.jpg'),
(47, 2, 'redirect', 'admin/menu'),
(48, 2, 'redirect', 'admin/content'),
(49, 2, 'redirect', 'admin/files'),
(50, 2, 'redirect', 'admin/users'),
(51, 2, 'redirect', 'admin/gallery'),
(52, 2, 'redirect', 'admin/counters'),
(53, 2, 'redirect', 'admin/users'),
(54, 2, 'redirect', 'admin/files'),
(55, 2, 'redirect', 'admin/menu'),
(56, 2, 'redirect', 'admin/content'),
(57, 2, 'redirect', 'admin/content/edit'),
(58, 2, 'redirect', 'admin/content/add'),
(59, 2, 'redirect', 'admin/content/add'),
(60, 2, 'redirect', 'admin/content/add'),
(61, 2, 'redirect', 'admin/content/edit/120'),
(62, 2, 'redirect', 'admin/content/edit/120'),
(63, 2, 'redirect', 'admin/content/edit/120'),
(64, 2, 'redirect', 'admin/content/edit/120'),
(65, 2, 'redirect', 'admin/content'),
(66, 2, 'redirect', 'admin/content/edit/106'),
(67, 2, 'redirect', 'admin/content/edit/106'),
(68, 2, 'redirect', 'admin/content/edit/106'),
(69, 2, 'redirect', 'admin/content/edit/106'),
(70, 2, 'redirect', 'admin/content'),
(71, 2, 'redirect', 'admin/content/edit/106'),
(72, 2, 'redirect', 'admin/content/edit/106'),
(73, 2, 'redirect', 'admin/content/edit/106'),
(74, 2, 'redirect', 'admin/menu'),
(75, 2, 'redirect', 'admin/files'),
(76, 2, 'redirect', 'admin/content'),
(77, 2, 'redirect', 'admin/menu'),
(78, 2, 'redirect', 'admin/files'),
(79, 2, 'redirect', 'admin/menu'),
(80, 2, 'redirect', 'admin/content'),
(81, 2, 'redirect', 'admin/menu'),
(82, 2, 'redirect', 'admin/files'),
(83, 2, 'redirect', 'admin/menu'),
(84, 2, 'redirect', 'admin/content'),
(85, 2, 'redirect', 'admin/users'),
(86, 2, 'redirect', 'admin/gallery'),
(87, 2, 'redirect', 'admin/counters'),
(88, 2, 'redirect', 'admin/files'),
(89, 2, 'redirect', 'admin/menu'),
(90, 2, 'redirect', 'admin/content'),
(91, 2, 'redirect', 'admin/content'),
(92, 2, 'redirect', 'admin/menu'),
(93, 2, 'redirect', 'admin/files'),
(94, 2, 'redirect', 'admin/files'),
(95, 2, 'redirect', 'admin/menu'),
(96, 2, 'redirect', 'admin/content'),
(97, 2, 'redirect', 'admin/content/edit/106'),
(98, 2, 'redirect', 'admin/content'),
(99, 2, 'redirect', 'admin/menu'),
(100, 2, 'redirect', 'admin/files'),
(101, 2, 'redirect', 'admin/content'),
(102, 2, 'redirect', 'admin/menu'),
(103, 2, 'redirect', 'admin/files'),
(104, 2, 'redirect', 'admin/menu'),
(105, 2, 'redirect', 'admin/content'),
(106, 2, 'redirect', 'admin/content/edit/106'),
(107, 2, 'redirect', 'admin/content/edit/106'),
(108, 2, 'redirect', 'admin/content'),
(109, 2, 'redirect', 'admin/content/edit/101'),
(110, 2, 'redirect', 'admin/content/edit/101'),
(111, 2, 'redirect', 'admin/content'),
(112, 2, 'redirect', 'admin/content/edit/106'),
(113, 2, 'redirect', 'admin/content'),
(114, 2, 'redirect', 'admin/content/edit/102'),
(115, 2, 'redirect', 'admin/content'),
(116, 2, 'redirect', 'admin/content/edit/112'),
(117, 2, 'redirect', 'admin/content/edit/112'),
(118, 2, 'redirect', 'admin/content/edit/112'),
(119, 2, 'redirect', 'admin/menu'),
(120, 2, 'redirect', 'admin/menu'),
(121, 2, 'redirect', 'admin/pages'),
(122, 2, 'redirect', 'admin/pages'),
(123, 2, 'redirect', 'admin/pages'),
(124, 2, 'redirect', 'admin/pages/edit/106'),
(125, 2, 'redirect', 'admin/pages/edit/106'),
(126, 2, 'redirect', 'admin/pages'),
(127, 2, 'redirect', 'admin/pages'),
(128, 2, 'redirect', 'admin/pages/edit/118'),
(129, 2, 'redirect', 'admin/pages/edit/118'),
(130, 2, 'redirect', 'admin/pages/delete'),
(131, 2, 'redirect', 'admin/pages'),
(132, 2, 'redirect', 'admin/pages'),
(133, 2, 'redirect', 'admin/pages/edit/96'),
(134, 2, 'redirect', 'admin/pages'),
(135, 2, 'redirect', 'admin/menu'),
(136, 2, 'redirect', 'admin/pages'),
(137, 2, 'redirect', 'admin/menu'),
(138, 2, 'redirect', 'admin/files'),
(139, 2, 'redirect', 'admin/menu'),
(140, 2, 'redirect', 'admin/pages'),
(141, 2, 'redirect', 'admin/menu'),
(142, 2, 'redirect', 'admin/files'),
(143, 2, 'redirect', 'admin/menu'),
(144, 2, 'redirect', 'admin/pages'),
(145, 2, 'redirect', 'admin/menu'),
(146, 2, 'redirect', 'admin/files'),
(147, 2, 'redirect', 'admin/menu'),
(148, 2, 'redirect', 'admin/pages'),
(149, 2, 'redirect', 'admin/menu'),
(150, 2, 'redirect', 'admin/files'),
(151, 2, 'redirect', 'admin/pages'),
(152, 2, 'redirect', 'admin/menu'),
(153, 2, 'redirect', 'admin/pages'),
(154, 2, 'redirect', 'admin/pages/edit/102'),
(155, 2, 'redirect', 'admin/pages/edit/102'),
(156, 2, 'redirect', 'admin/pages/edit/102'),
(157, 2, 'redirect', 'admin/pages/edit/102'),
(158, 2, 'redirect', 'admin/pages/edit/102'),
(159, 2, 'redirect', 'admin/pages/edit/102'),
(160, 2, 'redirect', 'admin/pages/edit/102'),
(161, 2, 'redirect', 'admin/pages/edit/102'),
(162, 2, 'redirect', 'admin/pages/edit/102'),
(163, 2, 'redirect', 'admin/pages'),
(164, 2, 'redirect', 'admin/menu'),
(165, 2, 'redirect', 'admin/files'),
(166, 2, 'redirect', 'admin/users'),
(167, 2, 'redirect', 'admin/gallery'),
(168, 2, 'redirect', 'admin/gallery/album1417784733'),
(169, 2, 'redirect', 'admin/files'),
(170, 2, 'redirect', 'admin/menu'),
(171, 2, 'redirect', 'admin/pages'),
(172, 2, 'redirect', 'admin/pages/edit/112'),
(173, 2, 'redirect', 'admin/pages/edit/112'),
(174, 2, 'redirect', 'admin/pages/edit/112'),
(175, 2, 'redirect', 'admin/pages'),
(176, 2, 'redirect', 'admin/pages/edit/106'),
(177, 2, 'redirect', 'admin/pages'),
(178, 2, 'redirect', 'admin/pages/edit/113'),
(179, 2, 'redirect', 'admin/pages'),
(180, 2, 'redirect', 'admin/pages/edit/110'),
(181, 2, 'redirect', 'admin/pages'),
(182, 2, 'redirect', 'admin/pages/edit/113'),
(183, 2, 'redirect', 'admin/pages'),
(184, 2, 'redirect', 'admin/pages/edit/116'),
(185, 2, 'redirect', 'admin/pages'),
(186, 2, 'redirect', 'admin/pages/edit/108'),
(187, 2, 'redirect', 'admin/pages'),
(188, 2, 'redirect', 'admin/pages/edit/110'),
(189, 2, 'redirect', 'admin/pages'),
(190, 2, 'redirect', 'admin/pages/edit/102'),
(191, 2, 'redirect', 'admin/pages'),
(192, 2, 'redirect', 'admin/pages/edit/106'),
(193, 2, 'redirect', 'admin/pages'),
(194, 2, 'redirect', 'admin/pages/edit/96'),
(195, 2, 'redirect', 'admin/pages'),
(196, 2, 'redirect', 'admin/pages/edit/112'),
(197, 2, 'redirect', 'admin/pages/edit/112'),
(198, 2, 'redirect', 'admin/pages');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `airyo_menu`
--

INSERT INTO `airyo_menu` (`id`, `name`, `url`, `menu_group`, `parent_id`, `order`) VALUES
(4, 'Раздел 3', 'part3', 1, 0, 4),
(8, 'Контакты', 'contacts', 1, 0, 2),
(23, 'Раздел 2', 'part2', 1, 0, 3),
(24, 'Раздел 1', 'part1', 1, 0, 1),
(25, 'Подраздел 1', 'part1/part1', 1, 24, 1),
(26, 'Подраздел 2', 'part1/part2', 1, 24, 2);

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
-- Table structure for table `airyo_trash`
--

CREATE TABLE `airyo_trash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `airyo_trash`
--

INSERT INTO `airyo_trash` (`id`, `deleted_id`, `data`, `type`) VALUES
(1, 118, 'a:10:{s:2:"id";s:3:"118";s:5:"title";s:0:"";s:2:"h1";s:6:"dfgdfg";s:7:"content";s:65:"a:2:{s:8:"content1";s:8:"dfgdgdgf";s:8:"content2";s:7:"dfgdgdg";}";s:5:"alias";s:4:"dgdg";s:16:"meta_description";s:0:"";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:1:"1";s:8:"template";s:12:"pages_1block";}', 'page');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `airyo_users`
--

INSERT INTO `airyo_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '\0\0', 'Administrator', 'e10adc3949ba59abbe56e057f20f883e', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '��,�', 'andreyka', '064161f8f1efd34ed8c7a39a3885eb7ab4424db0', NULL, 'andreyka.ru@gmail.com', NULL, NULL, NULL, '3edd35af0df1f94d8d8ff686d9136fd17cf3609e', 1392664432, 1417782767, 1, 'Андрей', 'Журавлёв', '', ''),
(4, '_9•@', 'zherelevich zherelevich', '18a8908b90b1f1f684e285810b12a6a284234aab', NULL, 'zherelevich@mail.ru', NULL, NULL, NULL, NULL, 1396067836, 1404485923, 1, 'zherelevich', 'zherelevich', 'zherelevich', '454654654'),
(5, '\0\0', 'sddf', 'b16e3b530c1fbc703b3743d50163b84b77081718', NULL, 'sdfsd@sdfsdf.df', NULL, NULL, NULL, NULL, 1415637110, 1415637110, 1, '', NULL, NULL, NULL),
(6, '\0\0', 'dfgdfg', 'c3b695090eb2f9407724cc43ff142cdca928ef7e', NULL, 'dfgdg@fsdfd.df', NULL, NULL, NULL, NULL, 1415638789, 1415638789, 1, 'dfgdfg', NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `airyo_users_groups`
--

INSERT INTO `airyo_users_groups` (`id`, `user_id`, `group_id`) VALUES
(66, 1, 1),
(67, 1, 2),
(68, 2, 1),
(69, 2, 2),
(4, 4, 1),
(18, 5, 1),
(19, 6, 1);

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
