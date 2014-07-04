-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 04 2014 г., 21:14
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
-- Структура таблицы `airyo_content`
--

CREATE TABLE IF NOT EXISTS `airyo_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `h1` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

--
-- Дамп данных таблицы `airyo_content`
--

INSERT INTO `airyo_content` (`id`, `title`, `h1`, `content`, `alias`, `meta_description`, `meta_keywords`, `enabled`, `type`) VALUES
(96, '', 'Part 3', '', 'part3', '', '', 1, '1'),
(101, '', 'test', 'test1', 'er', '', '', 1, '1'),
(102, '', '3333', '333', '333', '', '', 1, '1'),
(104, '', '12345', '[22:28:15] Andrey Zhuravlev: <h1>Почему именно Амарга?</h1>\n<img src="/public/amarga.jpg" width="200" style="float: right">\n<p>Это не случайный человек. Ма Прем Амарга не сама приезжает в Россию, ее ПРИГЛАШАЮТ в Россию: в Москву, в Санкт-Петербург, в Казань, в Екатеринбург, в Пермь, в Челябинск…</p>\n<p>За 20 лет своей духовной практики она помогла и продолжает помогать людям начать любить и уважать себя, понимать и удовлетворять свои базовые потребности, увидеть свою жизнь в ясном свете осознанности.</p>\n<p>И самое главное - это все - ее личный опыт. Она начала с себя, и прошла сложный и достаточно болезненный путь.</p>\n<p>То, что есть у Амарги сейчас - здоровые глубокие и любящие отношения, самореализация и очень светлая красивая энергия, - позволяет сказать: У Амарги есть полное право делиться своей мудростью, опытом и своей любовью к людям.</p>\n<h2>Немного истории</h2>\n<p>Ма Прем Амарга родилась в Германии и своё внутреннее путешествие она начала в 1982 году, когда благодаря индийскому мистику Ошо она соприкоснулась с духовностью и медитацией.</p>\n<p>В 1992 она завершила обучающий курс Ошо «Исцеление Праной» и «Снятие Шока» и продолжила развивать свои навыки, работая в качестве члена Пранического Кольца Ошо и в Школе Мистицизма в Пуне. Там она давала индивидуальные сессии, ассистировала на многих группах и тренингах, и со временем начала проводить группы и тренинги самостоятельно. С годами ей удалось создать свой уникальный метод работы, которым она делится на семинарах, тренингах и индивидуальных сессиях на протяжении последних 20 лет по всему миру.</p>\n<p>\nОна освоила следующие практики:\n</p>\n<ul class="templatemo_list">\n<li>Работа с Энергией (Исцеление Праной)</li>\n<li>Снятие шока и работа с травмами</li>\n<li>Усуйя система Рейки (степень мастера)</li>\n<li>Гипноз и НЛП</li>\n<li>Интуитивный массаж</li>\n<li>Чтение Энергий.</li>\n</ul>', 'contacts', '', '', 1, '1'),
(105, '', 'gfdgfdfdgd', 'dfgfgffd dfgdgfd', 'dfgdgfdgfdgfd', '', '', 0, '3'),
(106, '', 'gfhfg', 'fghfghfgh fghfhf', 'fghert', '', '', 0, '2');

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_counters`
--

CREATE TABLE IF NOT EXISTS `airyo_counters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `ip` text NOT NULL,
  `domain` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `airyo_counters`
--

INSERT INTO `airyo_counters` (`id`, `text`, `ip`, `domain`) VALUES
(1, '', '89.218.130.23, 92.53.109.165', '*.airyo.ru, zherelevich.dev.airyo.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_groups`
--

CREATE TABLE IF NOT EXISTS `airyo_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `airyo_groups`
--

INSERT INTO `airyo_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_login_attempts`
--

CREATE TABLE IF NOT EXISTS `airyo_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_menu`
--

CREATE TABLE IF NOT EXISTS `airyo_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` tinytext NOT NULL,
  `menu_group` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `airyo_menu`
--

INSERT INTO `airyo_menu` (`id`, `name`, `url`, `menu_group`, `parent_id`, `order`) VALUES
(4, 'Амарга', 'part3', 1, 0, 1),
(5, 'Level 1.1', 'gfdfgdf', 1, 15, 1),
(6, 'Level 1.2', 'gfdfgdf', 1, 21, 1),
(8, 'Контакты', 'contacts', 1, 0, 2),
(9, 'Level 2', 'dgfdfgdg', 1, 4, 2),
(12, '23', '2', 2, 0, 5),
(13, '24', '24', 2, 0, 6),
(14, 'asda', 'asasd', 1, 6, 1),
(15, 'p2', 'part2', 1, 24, 1),
(16, 'asdasd', 'asdasd', 1, 1, 1),
(19, 'Lvl3', 'sdfsgdsgd', 1, 4, 3),
(20, 'Levl3.1', 'dfsdfs', 1, 4, 1),
(21, 'ghfghfhfh', 'fghfhfhf', 1, 14, 1),
(22, 'Levll', 'sdfsd', 1, 24, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_menu_group`
--

CREATE TABLE IF NOT EXISTS `airyo_menu_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `airyo_menu_group`
--

INSERT INTO `airyo_menu_group` (`id`, `name`) VALUES
(1, 'Главное меню'),
(2, 'Информация');

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_trash`
--

CREATE TABLE IF NOT EXISTS `airyo_trash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deleted_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `airyo_trash`
--

INSERT INTO `airyo_trash` (`id`, `deleted_id`, `data`, `type`) VALUES
(1, 16, 'O:8:"stdClass":9:{s:2:"id";s:2:"16";s:5:"title";s:28:"Easy and lite website engine";s:2:"h1";s:28:"Easy and lite website engine";s:7:"content";s:15:"<p>Content</p>\n";s:5:"alias";s:0:"";s:16:"meta_description";s:36:"Content Easy and lite website engine";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(2, 16, 'O:8:"stdClass":9:{s:2:"id";s:2:"16";s:5:"title";s:28:"Easy and lite website engine";s:2:"h1";s:28:"Easy and lite website engine";s:7:"content";s:15:"<p>Content</p>\n";s:5:"alias";s:0:"";s:16:"meta_description";s:36:"Content Easy and lite website engine";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(3, 102, 'O:8:"stdClass":9:{s:2:"id";s:3:"102";s:5:"title";s:0:"";s:2:"h1";s:4:"3333";s:7:"content";s:3:"333";s:5:"alias";s:3:"333";s:16:"meta_description";s:0:"";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(4, 16, 'O:8:"stdClass":9:{s:2:"id";s:2:"16";s:5:"title";s:28:"Easy and lite website engine";s:2:"h1";s:28:"Easy and lite website engine";s:7:"content";s:15:"<p>Content</p>\n";s:5:"alias";s:0:"";s:16:"meta_description";s:36:"Content Easy and lite website engine";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(5, 16, 'O:8:"stdClass":9:{s:2:"id";s:2:"16";s:5:"title";s:28:"Easy and lite website engine";s:2:"h1";s:28:"Easy and lite website engine";s:7:"content";s:15:"<p>Content</p>\n";s:5:"alias";s:0:"";s:16:"meta_description";s:36:"Content Easy and lite website engine";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(6, 16, 'O:8:"stdClass":9:{s:2:"id";s:2:"16";s:5:"title";s:28:"Easy and lite website engine";s:2:"h1";s:28:"Easy and lite website engine";s:7:"content";s:15:"<p>Content</p>\n";s:5:"alias";s:0:"";s:16:"meta_description";s:36:"Content Easy and lite website engine";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(7, 16, 'O:8:"stdClass":9:{s:2:"id";s:2:"16";s:5:"title";s:28:"Easy and lite website engine";s:2:"h1";s:28:"Easy and lite website engine";s:7:"content";s:15:"<p>Content</p>\n";s:5:"alias";s:0:"";s:16:"meta_description";s:36:"Content Easy and lite website engine";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(8, 16, 'O:8:"stdClass":9:{s:2:"id";s:2:"16";s:5:"title";s:28:"Easy and lite website engine";s:2:"h1";s:28:"Easy and lite website engine";s:7:"content";s:15:"<p>Content</p>\n";s:5:"alias";s:0:"";s:16:"meta_description";s:36:"Content Easy and lite website engine";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(9, 92, 'O:8:"stdClass":9:{s:2:"id";s:2:"92";s:5:"title";s:0:"";s:2:"h1";s:6:"Part 1";s:7:"content";s:2:"14";s:5:"alias";s:5:"part1";s:16:"meta_description";s:0:"";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(10, 16, 'O:8:"stdClass":9:{s:2:"id";s:2:"16";s:5:"title";s:28:"Easy and lite website engine";s:2:"h1";s:28:"Easy and lite website engine";s:7:"content";s:15:"<p>Content</p>\n";s:5:"alias";s:0:"";s:16:"meta_description";s:36:"Content Easy and lite website engine";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(11, 16, 'O:8:"stdClass":9:{s:2:"id";s:2:"16";s:5:"title";s:28:"Easy and lite website engine";s:2:"h1";s:28:"Easy and lite website engine";s:7:"content";s:15:"<p>Content</p>\n";s:5:"alias";s:0:"";s:16:"meta_description";s:36:"Content Easy and lite website engine";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(12, 101, 'O:8:"stdClass":9:{s:2:"id";s:3:"101";s:5:"title";s:0:"";s:2:"h1";s:4:"test";s:7:"content";s:5:"test1";s:5:"alias";s:2:"er";s:16:"meta_description";s:0:"";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"0";s:4:"type";s:16:"Страницы";}', 'page'),
(13, 102, 'O:8:"stdClass":9:{s:2:"id";s:3:"102";s:5:"title";s:0:"";s:2:"h1";s:4:"3333";s:7:"content";s:3:"333";s:5:"alias";s:3:"333";s:16:"meta_description";s:0:"";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(14, 93, 'O:8:"stdClass":9:{s:2:"id";s:2:"93";s:5:"title";s:0:"";s:2:"h1";s:6:"Part 2";s:7:"content";s:2:"p2";s:5:"alias";s:5:"part2";s:16:"meta_description";s:0:"";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(15, 102, 'O:8:"stdClass":9:{s:2:"id";s:3:"102";s:5:"title";s:0:"";s:2:"h1";s:4:"3333";s:7:"content";s:3:"333";s:5:"alias";s:3:"333";s:16:"meta_description";s:0:"";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(16, 16, 'O:8:"stdClass":9:{s:2:"id";s:2:"16";s:5:"title";s:28:"Easy and lite website engine";s:2:"h1";s:28:"Easy and lite website engine";s:7:"content";s:15:"<p>Content</p>\n";s:5:"alias";s:0:"";s:16:"meta_description";s:36:"Content Easy and lite website engine";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(17, 16, 'O:8:"stdClass":9:{s:2:"id";s:2:"16";s:5:"title";s:28:"Easy and lite website engine";s:2:"h1";s:28:"Easy and lite website engine";s:7:"content";s:15:"<p>Content</p>\n";s:5:"alias";s:0:"";s:16:"meta_description";s:36:"Content Easy and lite website engine";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(18, 92, 'O:8:"stdClass":9:{s:2:"id";s:2:"92";s:5:"title";s:0:"";s:2:"h1";s:6:"Part 1";s:7:"content";s:2:"14";s:5:"alias";s:5:"part1";s:16:"meta_description";s:0:"";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:16:"Страницы";}', 'page'),
(19, 24, 'O:8:"stdClass":6:{s:2:"id";s:2:"24";s:4:"name";s:19:"На главную";s:3:"url";s:1:"/";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:1:"0";s:5:"order";s:1:"1";}', 'menu'),
(20, 7, 'O:8:"stdClass":6:{s:2:"id";s:1:"7";s:4:"name";s:11:"Level 1.1.1";s:3:"url";s:7:"gfdfgdf";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:1:"4";s:5:"order";s:1:"6";}', 'menu'),
(21, 23, 'O:8:"stdClass":6:{s:2:"id";s:2:"23";s:4:"name";s:3:"xxx";s:3:"url";s:4:"gggg";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:1:"4";s:5:"order";s:1:"7";}', 'menu'),
(22, 17, 'O:8:"stdClass":6:{s:2:"id";s:2:"17";s:4:"name";s:4:"LVL2";s:3:"url";s:3:"lvl";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:1:"4";s:5:"order";s:1:"1";}', 'menu'),
(23, 18, 'O:8:"stdClass":6:{s:2:"id";s:2:"18";s:4:"name";s:3:"111";s:3:"url";s:5:"ya.ru";s:10:"menu_group";s:1:"1";s:9:"parent_id";s:1:"4";s:5:"order";s:1:"3";}', 'menu'),
(24, 93, 'O:8:"stdClass":9:{s:2:"id";s:2:"93";s:5:"title";s:0:"";s:2:"h1";s:6:"Part 2";s:7:"content";s:2:"p2";s:5:"alias";s:5:"part2";s:16:"meta_description";s:0:"";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:1:"1";}', 'page'),
(25, 103, 'O:8:"stdClass":9:{s:2:"id";s:3:"103";s:5:"title";s:0:"";s:2:"h1";s:38:""Название в кавычках"";s:7:"content";s:3156:"<h1>Почему именно Амарга?</h1>\n<img src="/public/amarga.jpg" width="200" style="float: right">\n<p>Это не случайный человек. Ма Прем Амарга не сама приезжает в Россию, ее ПРИГЛАШАЮТ в Россию: в Москву, в Санкт-Петербург, в Казань, в Екатеринбург, в Пермь, в Челябинск…</p>\n<p>За 20 лет своей духовной практики она помогла и продолжает помогать людям начать любить и уважать себя, понимать и удовлетворять свои базовые потребности, увидеть свою жизнь в ясном свете осознанности.</p>\n<p>И самое главное - это все - ее личный опыт. Она начала с себя, и прошла сложный и достаточно болезненный путь.</p>\n<p>То, что есть у Амарги сейчас - здоровые глубокие и любящие отношения, самореализация и очень светлая красивая энергия, - позволяет сказать: У Амарги есть полное право делиться своей мудростью, опытом и своей любовью к людям.</p>\n<h2>Немного истории</h2>\n<p>Ма Прем Амарга родилась в Германии и своё внутреннее путешествие она начала в 1982 году, когда благодаря индийскому мистику Ошо она соприкоснулась с духовностью и медитацией.</p>\n<p>В 1992 она завершила обучающий курс Ошо «Исцеление Праной» и «Снятие Шока» и продолжила развивать свои навыки, работая в качестве члена Пранического Кольца Ошо и в Школе Мистицизма в Пуне. Там она давала индивидуальные сессии, ассистировала на многих группах и тренингах, и со временем начала проводить группы и тренинги самостоятельно. С годами ей удалось создать свой уникальный метод работы, которым она делится на семинарах, тренингах и индивидуальных сессиях на протяжении последних 20 лет по всему миру.</p>\n<p>\nОна освоила следующие практики:\n</p>\n<ul class="templatemo_list">\n<li>Работа с Энергией (Исцеление Праной)</li>\n<li>Снятие шока и работа с травмами</li>\n<li>Усуйя система Рейки (степень мастера)</li>\n<li>Гипноз и НЛП</li>\n<li>Интуитивный массаж</li>\n<li>Чтение Энергий.</li>\n</ul>";s:5:"alias";s:8:"per/love";s:16:"meta_description";s:0:"";s:13:"meta_keywords";s:0:"";s:7:"enabled";s:1:"1";s:4:"type";s:1:"1";}', 'page');

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_type_content`
--

CREATE TABLE IF NOT EXISTS `airyo_type_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `airyo_type_content`
--

INSERT INTO `airyo_type_content` (`id`, `type`, `alias`) VALUES
(1, 'Страницы', 'pages'),
(2, 'Новости', 'news'),
(3, 'Фрагменты', 'fragments'),
(4, 'Страница входа', 'page_login');

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_users`
--

CREATE TABLE IF NOT EXISTS `airyo_users` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `airyo_users`
--

INSERT INTO `airyo_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '\0\0', 'Administrator', 'e10adc3949ba59abbe56e057f20f883e', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '��,�', 'Андрей Журавлёв', '064161f8f1efd34ed8c7a39a3885eb7ab4424db0', NULL, 'andreyka.ru@gmail.com', NULL, NULL, NULL, '3edd35af0df1f94d8d8ff686d9136fd17cf3609e', 1392664432, 1404154143, 1, 'Андрей', 'Журавлёв', NULL, NULL),
(4, '_9•@', 'zherelevich zherelevich', '18a8908b90b1f1f684e285810b12a6a284234aab', NULL, 'zherelevich@mail.ru', NULL, NULL, NULL, NULL, 1396067836, 1404485923, 1, 'zherelevich', 'zherelevich', 'zherelevich', '454654654');

-- --------------------------------------------------------

--
-- Структура таблицы `airyo_users_groups`
--

CREATE TABLE IF NOT EXISTS `airyo_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `airyo_users_groups`
--

INSERT INTO `airyo_users_groups` (`id`, `user_id`, `group_id`) VALUES
(2, 1, 2),
(3, 2, 1),
(4, 4, 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `airyo_users_groups`
--
ALTER TABLE `airyo_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `airyo_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `airyo_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
