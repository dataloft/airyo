-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE DATABASE "air" -----------------------------------
CREATE DATABASE IF NOT EXISTS `air` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `air`;
-- ---------------------------------------------------------


-- CREATE TABLE "airyo_sliders" ----------------------------
DROP TABLE IF EXISTS `airyo_sliders` CASCADE;

CREATE TABLE `airyo_sliders` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL, 
	`title` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, 
	`create_date` DateTime NOT NULL,
	 PRIMARY KEY ( `id` )
 )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT 'Слайдеры'
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- ---------------------------------------------------------


-- Dump data of "airyo_sliders" ----------------------------
/*!40000 ALTER TABLE `airyo_sliders` DISABLE KEYS */

BEGIN;

INSERT INTO `airyo_sliders`(`id`,`title`,`create_date`) VALUES ( '1', 'First slide', '0000-00-00 00:00:00' );
INSERT INTO `airyo_sliders`(`id`,`title`,`create_date`) VALUES ( '2', 'Second slide', '0000-00-00 00:00:00' );
COMMIT;
/*!40000 ALTER TABLE `airyo_sliders` ENABLE KEYS */

-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


