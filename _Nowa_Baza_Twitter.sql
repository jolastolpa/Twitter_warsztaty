-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2016 at 12:27 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Twitter_warsztaty`
--

-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderUserId` int(11) NOT NULL,
  `recipientUserId` int(11) NOT NULL,
  `text` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `ifRead` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `senderUserId` (`senderUserId`),
  KEY `recipientUserId` (`recipientUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Message`
--

INSERT INTO `Message` (`id`, `senderUserId`, `recipientUserId`, `text`, `creationDate`, `ifRead`) VALUES
(1, 18, 17, 'czesc', '2016-11-03 00:07:29', b'1'),
(2, 18, 9, 'hej', '2016-11-03 00:08:41', b'1'),
(3, 18, 9, 'jcjcch', '2016-11-03 00:33:13', b'1'),
(4, 18, 9, 'hej', '2016-11-03 00:33:20', b'1'),
(5, 9, 18, 'wiadomosc', '2016-11-03 00:34:56', b'1'),
(6, 17, 18, 'czecsc', '2016-11-03 00:46:42', b'1'),
(7, 17, 18, 'dkjhddhuhfudfhdncudfyhdcKdjhiuxchbdiuchdxbcdhcisudchhdbchdbcidiggidugfcbcidgfdf difgcdgxcfdfgfyidgfygdyfgcbccccccccccdhhhhhhhhhhhhhhhhhhbg', '2016-11-03 00:47:03', b'1'),
(8, 9, 18, 'jkbfsbsfdKf', '2016-11-03 01:01:02', b'1'),
(9, 9, 18, 'WIADOMOÅšÄ†', '2016-11-03 12:15:23', b'1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`senderUserId`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`recipientUserId`) REFERENCES `Users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
