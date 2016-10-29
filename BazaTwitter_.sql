-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 28 Paź 2016, 20:01
-- Wersja serwera: 5.5.50-0ubuntu0.14.04.1
-- Wersja PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `Twitter_warsztaty`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `creationDate` datetime NOT NULL,
  `userId` int(11) NOT NULL,
  `tweetId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `tweetId` (`tweetId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Zrzut danych tabeli `Comment`
--

INSERT INTO `Comment` (`id`, `text`, `creationDate`, `userId`, `tweetId`) VALUES
(29, 'AKAJ', '2016-10-27 04:35:52', 9, 105),
(30, 'AKAJ', '2016-10-27 04:37:19', 9, 105),
(31, 'AKAJ', '2016-10-27 04:37:44', 9, 105),
(32, 'komentarz3', '2016-10-27 04:38:17', 9, 99),
(33, 'koemntarz', '2016-10-27 04:38:42', 1, 105),
(34, 'asdf', '2016-10-27 04:39:09', 1, 104),
(35, 'KOM', '2016-10-27 19:18:37', 1, 105),
(36, 'blablal', '2016-10-28 19:37:57', 17, 101),
(37, 'komentarz', '2016-10-28 19:48:26', 18, 106);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipientUserId` int(11) NOT NULL,
  `senderUserId` int(11) NOT NULL,
  `text` text NOT NULL,
  `creationDate` datetime NOT NULL,
  `ifRead` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `senderUserId` (`senderUserId`),
  KEY `recipientUserId` (`recipientUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweet`
--

CREATE TABLE IF NOT EXISTS `Tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Zrzut danych tabeli `Tweet`
--

INSERT INTO `Tweet` (`id`, `userId`, `text`, `creationDate`) VALUES
(97, 9, 'tweet2', '2016-10-26 00:15:35'),
(98, 9, 'tweet2', '2016-10-26 00:23:00'),
(99, 9, 'tweet2', '2016-10-26 00:23:27'),
(100, 9, 'tweet2', '2016-10-26 00:25:13'),
(101, 9, 'tweet3', '2016-10-27 01:31:33'),
(102, 9, 'tweet3', '2016-10-27 01:32:45'),
(103, 9, 'tweet3', '2016-10-27 01:34:32'),
(104, 9, 'tweet3', '2016-10-27 01:36:44'),
(105, 9, 'tweet3', '2016-10-27 01:38:58'),
(106, 17, 'lorem ipsum', '2016-10-28 19:37:32'),
(107, 18, 'tweet', '2016-10-28 19:48:18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`id`, `username`, `email`, `hashed_password`) VALUES
(2, 'lukasz', 'lukaszz@op.pl', '$2y$10$0g9kuiwUNO47ZrWFYOy1nefCf.3lZuJn8T1IjIKQInE/gfZy52n1a'),
(3, 'bogumil', 'bogumil@op.pl', '$2y$10$rMlP9aYt7nJrzaZb7tlBdOx9um5XbzQJT53O18bX2O7jqa9JpJvPW'),
(4, 'natalia', 'natalka@gmail.com', '$2y$10$9SRNHDow/751.BOEtnoMguDtG/wn/TyYWf4aHPViLNL7soswWTcXu'),
(5, 'janek', 'janek@op.pl', '$2y$10$CpB1uceFFv9VLIOTJbPfPOA64pWUsqIhOoV6I/PiyobDnW7RZTDV.'),
(6, 'gosia', 'gosia@op.pl', '$2y$10$/UFhS1iTBolSr/5nP0wNpe1ac3KzSt2ZCGIgS8j8xd20xsgsP/tX.'),
(7, 'gosia', 'goska@wp.pl', '$2y$10$XyiePfCHXjgj4hGuaL1FLedIdW8jHGWTtG2LafrYyk/Lbx8SYqL9q'),
(8, 'beata', 'beata@wp.pl', '$2y$10$y.di7EVKtXfql4cnS/uGjOKJzVc.NlVSZ5Ik86QBL4fwTPs56rIk.'),
(9, 'kasia', 'kasia@op.pl', '$2y$10$RiwmDUIaTg.dlDq9Gy3//.HJ.y/grI7OMqbOS3TjHZkPnDWGyPSVe'),
(10, 'Hubert', 'hubert@gmail.com', '$2y$10$IacWrjxrpBTqyFqoa15T4OieE1Qh8C0fCOWCKye7j/VdCpV7.WSXa'),
(11, 'BARTEK', 'bartek@op.pl', '$2y$10$HN63wO2csMn4PXqjGSL33O5h9SR0HO.x5v6/2Z8vM.aJlO8/7DymK'),
(12, 'artur', 'artur@wp.pl', '$2y$10$yRzHSCnsD3U8MAls9Iz1/uYKgQgWxjxWKcAyeZm4aYCw4YNNAW1Wy'),
(13, 'asia', 'asia@op.pl', '$2y$10$kOcD6Ty7ZugMZqkyHLCu7OsdX53zi6vBW8wvS1RrhTvD7InqZRXEG'),
(14, 'basia', 'basia@gmail.com', '$2y$10$3bqTr3z4HBiUiRt6HOUhtuZBusUoU.wHKAhKAJTfCIYpdi7Wd6Fge'),
(17, 'rafal', 'rafal@wp.pl', '$2y$10$ALv22St2jn9yscN1OimjT.ghdgSytY6ubHKnc6WhdLNt8kQUu6dXi'),
(18, 'Jola', 'jola@gmail.com', '$2y$10$djX5BgOxW/ceTllfVOWGPOJJYPBGGBTUp.ZpUW.LDrd37TRxV7GLK');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`tweetId`) REFERENCES `Tweet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`tweetId`) REFERENCES `Tweet` (`id`);

--
-- Ograniczenia dla tabeli `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`senderUserId`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`recipientUserId`) REFERENCES `Users` (`id`);

--
-- Ograniczenia dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  ADD CONSTRAINT `Tweet_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Tweet_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
