-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2016 at 07:03 PM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codeigniter`
--
CREATE DATABASE IF NOT EXISTS `codeigniter` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `codeigniter`;

-- --------------------------------------------------------

--
-- Table structure for table `activation`
--

CREATE TABLE IF NOT EXISTS `activation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(16) NOT NULL,
  `valid_time` varchar(16) NOT NULL,
  `hash` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `activation`
--

INSERT INTO `activation` (`id`, `user_username`, `valid_time`, `hash`) VALUES
(1, 'asdfga', '1476455786551', '206769971b260798f50d2db8451e2567');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `user_id`, `title`, `name`, `created`) VALUES
(3, 11, 'profile_pictures', 'Profile pictures', '2016-10-10 15:06:55'),
(10, 11, 'Test_Album', 'Test Album', '2016-10-11 10:44:49'),
(17, 11, 'sdfghj', 'sdfghj', '2016-10-11 12:09:54'),
(18, 16, 'profile_pictures', 'Profile pictures', '2016-10-12 14:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `sent_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `from_id`, `to_id`, `message`, `seen`, `sent_date`, `deleted`) VALUES
(31, 11, 11, 12, 'Hello', 0, '2016-10-12 14:15:17', 0),
(32, 12, 11, 12, 'Hello', 0, '2016-10-12 14:15:17', 0),
(33, 12, 12, 11, 'Hi', 0, '2016-10-12 14:15:23', 0),
(34, 11, 12, 11, 'Hi', 0, '2016-10-12 14:15:23', 0),
(35, 16, 16, 12, 'asdfg', 0, '2016-10-12 14:39:42', 0),
(36, 12, 16, 12, 'asdfg', 0, '2016-10-12 14:39:42', 0),
(37, 12, 12, 16, 'tfryiu', 0, '2016-10-12 14:39:58', 0),
(38, 16, 12, 16, 'tfryiu', 0, '2016-10-12 14:39:58', 1),
(39, 12, 12, 16, 'ygu', 0, '2016-10-12 14:40:01', 0),
(40, 16, 12, 16, 'ygu', 0, '2016-10-12 14:40:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `album_title` varchar(128) NOT NULL,
  `album_name` varchar(128) NOT NULL,
  `path` text NOT NULL,
  `profile_picture` int(11) NOT NULL,
  `uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `user_id`, `album_title`, `album_name`, `path`, `profile_picture`, `uploaded`) VALUES
(7, 11, 'profile_pictures', 'Profile pictures', './uploads/narek.keryan/profile_pictures/1461455_298544220308761_6883446226170935652_n.jpg', 0, '2016-10-10 15:06:55'),
(8, 11, 'profile_pictures', 'Profile pictures', './uploads/narek.keryan/profile_pictures/images.jpg', 0, '2016-10-11 08:14:45'),
(32, 11, 'Test_Album', 'Test Album', './uploads/narek.keryan/Test_Album/IMG_6395.JPG', 0, '2016-10-11 10:44:49'),
(33, 11, 'Test_Album', 'Test Album', './uploads/narek.keryan/Test_Album/IMG_6396.JPG', 0, '2016-10-11 10:44:49'),
(34, 11, 'Test_Album', 'Test Album', './uploads/narek.keryan/Test_Album/IMG_6400.JPG', 0, '2016-10-11 10:44:49'),
(35, 11, 'Test_Album', 'Test Album', './uploads/narek.keryan/Test_Album/IMG_6402.JPG', 0, '2016-10-11 10:44:49'),
(36, 11, 'Test_Album', 'Test Album', './uploads/narek.keryan/Test_Album/IMG_6404.JPG', 0, '2016-10-11 11:03:52'),
(67, 11, 'sdfghj', 'sdfghj', './uploads/narek.keryan/sdfghj/IMG_6395.JPG', 0, '2016-10-11 12:09:54'),
(70, 11, 'sdfghj', 'sdfghj', './uploads/narek.keryan/sdfghj/IMG_6398.JPG', 0, '2016-10-11 12:09:54'),
(71, 16, 'profile_pictures', 'Profile pictures', './uploads/narekk/profile_pictures/IMG_6395.JPG', 1, '2016-10-12 14:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `fname` varchar(16) NOT NULL,
  `lname` varchar(16) NOT NULL,
  `status` enum('active','waiting','freezed','deleted') NOT NULL DEFAULT 'waiting',
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fname`, `lname`, `status`, `joined`) VALUES
(11, 'narek.keryan', '8e484ceef97b499ebf7561d7462c385a', 'narek.keryan@gmail.com', 'Narek', 'Keryan', 'active', '2016-10-10 08:18:37'),
(12, 'qwerty', 'e15fb07c0b9e1ecfc32e03f5dbd9f137', 'qwerty@gmail.com', 'Qwe', 'Rty', 'active', '2016-10-10 12:22:08'),
(13, 'focusoft', '23365914930a371719ca8a950408dcef', 'focusoft@gmail.com', 'Focu', 'Soft', 'active', '2016-10-10 12:24:00'),
(14, 'keryan', '017d2947c63171e462c57c4e65f0208f', 'keryan@gmail.com', 'SaD', 'DASDAS', 'active', '2016-10-10 14:09:56'),
(15, 'asdfga', '0e7f2d1afe94886ef62cca3280309ab5', 'asdfgh@gmail.com', 'ssa', 'asadasfsd', 'waiting', '2016-10-12 14:36:26'),
(16, 'narekk', '06000b031fdf72b9d936ad8aae19e6a4', 'narekk@gmail.com', 'narek', 'keryan', 'active', '2016-10-12 14:37:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
