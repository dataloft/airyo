-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 12, 2015 at 10:02 AM
-- Server version: 5.5.42
-- PHP Version: 5.4.42

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `air`
--

-- --------------------------------------------------------

--
-- Table structure for table `airyo_slide`
--

CREATE TABLE `airyo_slide` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(511) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sliders_id` int(11) unsigned NOT NULL,
  `create_date` datetime NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='Слайд';

--
-- Dumping data for table `airyo_slide`
--

INSERT INTO `airyo_slide` (`id`, `title`, `description`, `link`, `sliders_id`, `create_date`, `enabled`) VALUES
(5, 'Slide #1', 'This is a first slide', 'www.ya.ru', 1, '0000-00-00 00:00:00', 1),
(6, 'Slide #2', 'This is a second slide', 'http://google.com', 1, '0000-00-00 00:00:00', 1),
(7, 'Slide #3', 'This is a third slide', 'http://apple.com', 1, '0000-00-00 00:00:00', 1),
(10, 'Slide 1 from slider 2', 'First slide of second slider', 'http://www.codeigniter.com/', 2, '0000-00-00 00:00:00', 1),
(11, 'Slide 2 from slider 2', 'Second slide of second slider', 'http://laravel.com', 2, '0000-00-00 00:00:00', 1),
(15, 'Slide 3 from slider 2', 'Third slide of second slider', 'http://php.net', 2, '0000-00-00 00:00:00', 1),
(16, 'Slide 4 from slider 2', 'Fourth slide of second slider', 'http://stackoverflow.com/questions/4061293/mysql-cant-create-table-errno-150', 2, '0000-00-00 00:00:00', 1),
(17, 'Slide 5 from slider 2', 'Fifth slide of second slider', 'http://kinopoisk.ru', 2, '0000-00-00 00:00:00', 1),
(18, 'Slide 6 from slider 2', 'Sixth slide of second slider', 'http://habrahabr.ru/company/jugru/blog/268607/', 2, '0000-00-00 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airyo_slide`
--
ALTER TABLE `airyo_slide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_airyo_sliders_1_idx` (`sliders_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airyo_slide`
--
ALTER TABLE `airyo_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `airyo_slide`
--
ALTER TABLE `airyo_slide`
  ADD CONSTRAINT `fk_airyo_slider_sliders` FOREIGN KEY (`sliders_id`) REFERENCES `airyo_sliders` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
