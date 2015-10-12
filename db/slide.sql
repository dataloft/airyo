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


-- CREATE TABLE "airyo_slide" ------------------------------
DROP TABLE IF EXISTS `airyo_slide` CASCADE;

CREATE TABLE `airyo_slide` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL, 
	`title` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, 
	`description` VarChar( 511 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, 
	`link` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, 
	`sliders_id` Int( 11 ) UNSIGNED NOT NULL, 
	`create_date` DateTime NOT NULL, 
	`enabled` Int( 11 ) NOT NULL DEFAULT '1',
	 PRIMARY KEY ( `id` )
 )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT 'Слайд'
ENGINE = InnoDB
AUTO_INCREMENT = 19;
-- ---------------------------------------------------------


-- Dump data of "airyo_slide" ------------------------------
/*!40000 ALTER TABLE `airyo_slide` DISABLE KEYS */

BEGIN;

INSERT INTO `airyo_slide`(`id`,`title`,`description`,`link`,`sliders_id`,`create_date`,`enabled`) VALUES ( '5', 'Slide #1', 'This is a first slide', 'www.ya.ru', '1', '0000-00-00 00:00:00', '1' );
INSERT INTO `airyo_slide`(`id`,`title`,`description`,`link`,`sliders_id`,`create_date`,`enabled`) VALUES ( '6', 'Slide #2', 'This is a second slide', 'http://google.com', '1', '0000-00-00 00:00:00', '1' );
INSERT INTO `airyo_slide`(`id`,`title`,`description`,`link`,`sliders_id`,`create_date`,`enabled`) VALUES ( '7', 'Slide #3', 'This is a third slide', 'http://apple.com', '1', '0000-00-00 00:00:00', '1' );
INSERT INTO `airyo_slide`(`id`,`title`,`description`,`link`,`sliders_id`,`create_date`,`enabled`) VALUES ( '10', 'Slide 1 from slider 2', 'First slide of second slider', 'http://www.codeigniter.com/', '2', '0000-00-00 00:00:00', '1' );
INSERT INTO `airyo_slide`(`id`,`title`,`description`,`link`,`sliders_id`,`create_date`,`enabled`) VALUES ( '11', 'Slide 2 from slider 2', 'Second slide of second slider', 'http://laravel.com', '2', '0000-00-00 00:00:00', '1' );
INSERT INTO `airyo_slide`(`id`,`title`,`description`,`link`,`sliders_id`,`create_date`,`enabled`) VALUES ( '15', 'Slide 3 from slider 2', 'Third slide of second slider', 'http://php.net', '2', '0000-00-00 00:00:00', '1' );
INSERT INTO `airyo_slide`(`id`,`title`,`description`,`link`,`sliders_id`,`create_date`,`enabled`) VALUES ( '16', 'Slide 4 from slider 2', 'Fourth slide of second slider', 'http://stackoverflow.com/questions/4061293/mysql-cant-create-table-errno-150', '2', '0000-00-00 00:00:00', '1' );
INSERT INTO `airyo_slide`(`id`,`title`,`description`,`link`,`sliders_id`,`create_date`,`enabled`) VALUES ( '17', 'Slide 5 from slider 2', 'Fifth slide of second slider', 'http://kinopoisk.ru', '2', '0000-00-00 00:00:00', '1' );
INSERT INTO `airyo_slide`(`id`,`title`,`description`,`link`,`sliders_id`,`create_date`,`enabled`) VALUES ( '18', 'Slide 6 from slider 2', 'Sixth slide of second slider', 'http://habrahabr.ru/company/jugru/blog/268607/', '2', '0000-00-00 00:00:00', '1' );
COMMIT;
/*!40000 ALTER TABLE `airyo_slide` ENABLE KEYS */

-- ---------------------------------------------------------


-- CREATE INDEX "fk_airyo_sliders_1_idx" -------------------
CREATE INDEX `fk_airyo_sliders_1_idx` USING BTREE ON `airyo_slide`( `sliders_id` );
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


