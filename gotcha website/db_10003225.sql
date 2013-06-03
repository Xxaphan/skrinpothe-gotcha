-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: 10.22.227.22
-- Generation Time: Jun 03, 2013 at 07:22 PM
-- Server version: 5.5.22
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_10003225`
--

-- --------------------------------------------------------

--
-- Table structure for table `gotcha_events`
--

CREATE TABLE IF NOT EXISTS `gotcha_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventname` varchar(100) NOT NULL,
  `organizer` int(11) NOT NULL,
  `invited_participants` int(11) NOT NULL,
  `accepted_participants` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `start` date NOT NULL DEFAULT '0000-00-00',
  `end` date NOT NULL DEFAULT '0000-00-00',
  `winner` varchar(1000) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `eventname` (`eventname`,`winner`(255)),
  KEY `organizer` (`organizer`),
  KEY `winner` (`winner`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `gotcha_events`
--

INSERT INTO `gotcha_events` (`id`, `eventname`, `organizer`, `invited_participants`, `accepted_participants`, `status`, `start`, `end`, `winner`) VALUES
(19, 'RevoltLive', 2, 2, 2, 1, '0000-00-00', '0000-00-00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `gotcha_event_participants`
--

CREATE TABLE IF NOT EXISTS `gotcha_event_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`,`eventid`),
  KEY `userid_2` (`userid`),
  KEY `eventid` (`eventid`),
  KEY `target` (`target`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `gotcha_event_participants`
--

INSERT INTO `gotcha_event_participants` (`id`, `userid`, `eventid`, `target`) VALUES
(22, 2, 19, 1),
(23, 1, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `gotcha_users`
--

CREATE TABLE IF NOT EXISTS `gotcha_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cellphone` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profilepic` varchar(100) NOT NULL DEFAULT 'files/profilepic/none.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gotcha_users`
--

INSERT INTO `gotcha_users` (`id`, `name`, `firstname`, `email`, `cellphone`, `username`, `password`, `profilepic`) VALUES
(1, 'pothe', 'skrin', 'pothe.skrin@gmail.com', '0477253006', 'skrin', 'skrin', 'files/profilepic/none.jpg'),
(2, 'ilya', 'michiels', 'droopy007@gmail.com', '13', 'ilya', '67e21d45f7b1fab0a3c43dd4339ee8e9', 'files/profilepic/none.jpg'),
(3, 'test', 'test', 'test', 'test', 'test', 'test', 'files/profilepic/none.jpg'),
(4, 'testsqdf', 'qsdfqd', 'qdfqdsf', 'dfqdsfq', 'qsdfqdsf', 'qdsfqdsfq', 'files/profilepic/none.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gotcha_user_location`
--

CREATE TABLE IF NOT EXISTS `gotcha_user_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `longt` double NOT NULL,
  `lat` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gotcha_user_location`
--

INSERT INTO `gotcha_user_location` (`id`, `user`, `longt`, `lat`) VALUES
(1, 1, 3.525998358350686, 50.90006741670082),
(2, 2, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gotcha_events`
--
ALTER TABLE `gotcha_events`
  ADD CONSTRAINT `gotcha_events_ibfk_1` FOREIGN KEY (`organizer`) REFERENCES `gotcha_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gotcha_event_participants`
--
ALTER TABLE `gotcha_event_participants`
  ADD CONSTRAINT `gotcha_event_participants_ibfk_3` FOREIGN KEY (`target`) REFERENCES `gotcha_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gotcha_event_participants_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `gotcha_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gotcha_event_participants_ibfk_2` FOREIGN KEY (`eventid`) REFERENCES `gotcha_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gotcha_user_location`
--
ALTER TABLE `gotcha_user_location`
  ADD CONSTRAINT `gotcha_user_location_ibfk_2` FOREIGN KEY (`user`) REFERENCES `gotcha_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
