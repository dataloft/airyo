# ************************************************************
# Sequel Pro SQL dump
# Версия 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: localhost (MySQL 5.5.42)
# Схема: air
# Время создания: 2015-10-11 12:18:48 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы airyo_sliders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `airyo_sliders`;

CREATE TABLE `airyo_sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(511) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `create_date` datetime NOT NULL,
  `enable` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_airyo_sliders_1_idx` (`user_id`),
  CONSTRAINT `fk_airyo_sliders_users` FOREIGN KEY (`user_id`) REFERENCES `airyo_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Слайдеры';

LOCK TABLES `airyo_sliders` WRITE;
/*!40000 ALTER TABLE `airyo_sliders` DISABLE KEYS */;

INSERT INTO `airyo_sliders` (`id`, `label`, `title`, `description`, `link`, `user_id`, `create_date`, `enable`)
VALUES
	(1,NULL,'First slider','My first slider',NULL,2,'0000-00-00 00:00:00',1),
	(3,NULL,'Second slider','My second slider',NULL,2,'0000-00-00 00:00:00',1),
	(4,NULL,'Absolutely new awesome slider','It\'s actually a third slider',NULL,2,'0000-00-00 00:00:00',1);

/*!40000 ALTER TABLE `airyo_sliders` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
