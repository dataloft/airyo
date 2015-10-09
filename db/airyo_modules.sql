# ************************************************************
# Sequel Pro SQL dump
# Версия 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: localhost (MySQL 5.5.42)
# Схема: air
# Время создания: 2015-10-09 16:19:39 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы airyo_modules
# ------------------------------------------------------------

DROP TABLE IF EXISTS `airyo_modules`;

CREATE TABLE `airyo_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(511) DEFAULT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Модули';

LOCK TABLES `airyo_modules` WRITE;
/*!40000 ALTER TABLE `airyo_modules` DISABLE KEYS */;

INSERT INTO `airyo_modules` (`id`, `title`, `alias`, `description`, `position`)
VALUES
	(1,'Страницы','pages',NULL,1),
	(2,'Меню','menu',NULL,2),
	(3,'Файлы','files',NULL,4),
	(4,'Пользователи','users',NULL,5),
	(5,'Фотоальбомы','gallery',NULL,6),
	(6,'Счётчики','counters',NULL,8),
	(7,'Новости','news',NULL,3),
	(8,'Фрагменты','chunks',NULL,9),
	(9,'Поисковая оптимизация','seo',NULL,10),
	(10,'Слайдеры','sliders',NULL,7);

/*!40000 ALTER TABLE `airyo_modules` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
