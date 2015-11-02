-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 02, 2015 at 06:01 PM
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
-- Table structure for table `airyo_slide`
--

CREATE TABLE `airyo_slide` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(511) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sliders_id` int(11) unsigned NOT NULL,
  `create_date` datetime NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1',
  `order` varchar(255) DEFAULT NULL,
  `img_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='Слайд';

--
-- Dumping data for table `airyo_slide`
--

INSERT INTO `airyo_slide` (`id`, `title`, `description`, `link`, `sliders_id`, `create_date`, `enabled`, `order`, `img_title`) VALUES
(67, NULL, NULL, NULL, 1, '2015-11-02 14:59:52', 0, '1', 'a13.jpg'),
(68, NULL, NULL, NULL, 1, '2015-11-02 14:59:52', 0, '0', 'a9.jpg'),
(69, NULL, NULL, NULL, 1, '2015-11-02 14:59:52', 0, '2', 'a19.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
