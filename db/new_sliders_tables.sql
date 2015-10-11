# ************************************************************
# Sequel Pro SQL dump
# Версия 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: localhost (MySQL 5.5.42)
# Схема: air
# Время создания: 2015-10-11 18:16:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы airyo_slide
# ------------------------------------------------------------

DROP TABLE IF EXISTS `airyo_slide`;

CREATE TABLE `airyo_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(511) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sliders_id` int(11) unsigned NOT NULL,
  `create_date` datetime NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_airyo_sliders_1_idx` (`sliders_id`),
  CONSTRAINT `fk_airyo_slider_sliders` FOREIGN KEY (`sliders_id`) REFERENCES `airyo_sliders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Слайд';

LOCK TABLES `airyo_slide` WRITE;
/*!40000 ALTER TABLE `airyo_slide` DISABLE KEYS */;

INSERT INTO `airyo_slide` (`id`, `title`, `description`, `link`, `sliders_id`, `create_date`, `enabled`)
VALUES
	(5,'Slide #1','This is a first slide','www.ya.ru',1,'0000-00-00 00:00:00',1),
	(6,'Slide #2','This is a second slide','http://google.com',1,'0000-00-00 00:00:00',1),
	(7,'Slide #3','This is a third slide','http://apple.com',1,'0000-00-00 00:00:00',1),
	(10,'Slide 1 from slider 2','First slide of second slider','http://www.codeigniter.com/',2,'0000-00-00 00:00:00',1),
	(11,'Slide 2 from slider 2','Second slide of second slider','http://laravel.com',2,'0000-00-00 00:00:00',1),
	(15,'Slide 3 from slider 2','Third slide of second slider','http://php.net',2,'0000-00-00 00:00:00',1),
	(16,'Slide 4 from slider 2','Fourth slide of second slider','http://stackoverflow.com/questions/4061293/mysql-cant-create-table-errno-150',2,'0000-00-00 00:00:00',1),
	(17,'Slide 5 from slider 2','Fifth slide of second slider','http://kinopoisk.ru',2,'0000-00-00 00:00:00',1),
	(18,'Slide 6 from slider 2','Sixth slide of second slider','http://habrahabr.ru/company/jugru/blog/268607/',2,'0000-00-00 00:00:00',1);

/*!40000 ALTER TABLE `airyo_slide` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы airyo_sliders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `airyo_sliders`;

CREATE TABLE `airyo_sliders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Слайдеры';

LOCK TABLES `airyo_sliders` WRITE;
/*!40000 ALTER TABLE `airyo_sliders` DISABLE KEYS */;

INSERT INTO `airyo_sliders` (`id`, `title`, `create_date`)
VALUES
	(1,'First slide','0000-00-00 00:00:00'),
	(2,'Second slide','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `airyo_sliders` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
