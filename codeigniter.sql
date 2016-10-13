-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 13, 2016 at 05:17 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `user_id`, `title`, `name`, `created`) VALUES
(22, 11, 'profile_pictures', 'Profile pictures', '2016-10-13 11:21:43'),
(23, 20, 'profile_pictures', 'Profile pictures', '2016-10-13 11:22:29'),
(25, 11, 'Some_album', 'Some album', '2016-10-13 11:49:23');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `from_id`, `to_id`, `message`, `seen`, `sent_date`, `deleted`) VALUES
(41, 20, 20, 11, 'Barev', 0, '2016-10-13 13:16:03', 0),
(42, 11, 20, 11, 'Barev', 0, '2016-10-13 13:16:03', 0),
(43, 11, 11, 20, 'Asenq', 0, '2016-10-13 13:16:26', 0),
(44, 20, 11, 20, 'Asenq', 0, '2016-10-13 13:16:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` text NOT NULL,
  `profile_picture` int(11) NOT NULL,
  `uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `album_id`, `user_id`, `path`, `profile_picture`, `uploaded`) VALUES
(89, 22, 11, './uploads/narek.keryan/profile_pictures/images.jpg', 0, '2016-10-13 11:21:43'),
(90, 23, 20, './uploads/qwerty/profile_pictures/IMG_6461.JPG', 1, '2016-10-13 11:22:29'),
(91, 22, 11, './uploads/narek.keryan/profile_pictures/1461455_298544220308761_6883446226170935652_n.jpg', 1, '2016-10-13 11:22:45'),
(100, 25, 11, './uploads/narek.keryan/Some_album/IMG_6395.JPG', 0, '2016-10-13 11:49:23'),
(102, 25, 11, './uploads/narek.keryan/Some_album/IMG_6397.JPG', 0, '2016-10-13 11:49:23'),
(105, 25, 11, './uploads/narek.keryan/Some_album/IMG_6400.JPG', 0, '2016-10-13 11:49:23'),
(106, 25, 11, './uploads/narek.keryan/Some_album/IMG_6402.JPG', 0, '2016-10-13 11:49:23'),
(107, 25, 11, './uploads/narek.keryan/Some_album/IMG_6403.JPG', 0, '2016-10-13 11:49:23');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fname`, `lname`, `status`, `joined`) VALUES
(11, 'narek.keryan', '8e484ceef97b499ebf7561d7462c385a', 'narek.keryan@gmail.com', 'Narek', 'Keryan', 'active', '2016-10-10 08:18:37'),
(20, 'qwerty', 'e15fb07c0b9e1ecfc32e03f5dbd9f137', 'qwerty@gmail.com', 'Qwe', 'Rty', 'active', '2016-10-13 11:18:33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
