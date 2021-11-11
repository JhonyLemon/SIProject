-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Lis 2021, 15:51
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `siproject`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `IDcomment` int(10) UNSIGNED NOT NULL,
  `IDparent` int(10) UNSIGNED NOT NULL,
  `IDuser` int(11) UNSIGNED NOT NULL,
  `IDpost` int(11) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `likedcomments`
--

CREATE TABLE `likedcomments` (
  `IDcomment` int(11) UNSIGNED NOT NULL,
  `IDuser` int(11) UNSIGNED NOT NULL,
  `vote` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Wyzwalacze `likedcomments`
--
DELIMITER $$
CREATE TRIGGER `dec_points_comment` AFTER INSERT ON `likedcomments` FOR EACH ROW UPDATE users SET points=points-1 WHERE id=NEW.IDuser AND NEW.vote=0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inc_points_comment` AFTER INSERT ON `likedcomments` FOR EACH ROW UPDATE users SET points=points+1 WHERE id=NEW.IDuser AND NEW.vote=1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `removepoint_0_comment` AFTER DELETE ON `likedcomments` FOR EACH ROW UPDATE users SET points=points+1 WHERE id=OLD.IDuser AND OLD.vote=0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `removepoint_1_comment` AFTER DELETE ON `likedcomments` FOR EACH ROW UPDATE users SET points=points-1 WHERE id=OLD.IDuser AND OLD.vote=1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `likedposts`
--

CREATE TABLE `likedposts` (
  `IDuser` int(11) UNSIGNED NOT NULL,
  `IDpost` int(11) UNSIGNED NOT NULL,
  `vote` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Wyzwalacze `likedposts`
--
DELIMITER $$
CREATE TRIGGER `dec_points_post` AFTER INSERT ON `likedposts` FOR EACH ROW UPDATE users SET points=points-1 WHERE id=NEW.IDuser AND NEW.vote=0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inc_points_post` AFTER INSERT ON `likedposts` FOR EACH ROW UPDATE users SET points=points+1 WHERE id=NEW.IDuser AND NEW.vote=1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `removepoint_0_post` AFTER DELETE ON `likedposts` FOR EACH ROW UPDATE users SET points=points+1 WHERE id=OLD.IDuser AND OLD.vote=0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `removepoint_1_post` AFTER DELETE ON `likedposts` FOR EACH ROW UPDATE users SET points=points-1 WHERE id=OLD.IDuser AND OLD.vote=1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `IDpost` int(11) UNSIGNED NOT NULL,
  `tittle` text NOT NULL,
  `description` text NOT NULL,
  `file` text NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `valid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `userposts`
--

CREATE TABLE `userposts` (
  `IDpost` int(11) UNSIGNED NOT NULL,
  `IDuser` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `IDuser` int(10) UNSIGNED NOT NULL,
  `login` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(64) NOT NULL,
  `permission` enum('admin','moderator','user','') NOT NULL DEFAULT 'user',
  `birthday` date DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`IDcomment`),
  ADD KEY `comments_ibfk_1` (`IDpost`),
  ADD KEY `comments_ibfk_2` (`IDuser`);

--
-- Indeksy dla tabeli `likedcomments`
--
ALTER TABLE `likedcomments`
  ADD KEY `likedcomments_ibfk_1` (`IDcomment`),
  ADD KEY `likedcomments_ibfk_2` (`IDuser`);

--
-- Indeksy dla tabeli `likedposts`
--
ALTER TABLE `likedposts`
  ADD KEY `likedposts_ibfk_1` (`IDpost`),
  ADD KEY `likedposts_ibfk_2` (`IDuser`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`IDpost`);

--
-- Indeksy dla tabeli `userposts`
--
ALTER TABLE `userposts`
  ADD KEY `userposts_ibfk_1` (`IDpost`),
  ADD KEY `userposts_ibfk_2` (`IDuser`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IDuser`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `IDcomment` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `IDpost` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `IDuser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `posts` (`IDpost`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`IDuser`) REFERENCES `users` (`IDuser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `likedcomments`
--
ALTER TABLE `likedcomments`
  ADD CONSTRAINT `likedcomments_ibfk_1` FOREIGN KEY (`IDcomment`) REFERENCES `comments` (`IDcomment`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likedcomments_ibfk_2` FOREIGN KEY (`IDuser`) REFERENCES `users` (`IDuser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `likedposts`
--
ALTER TABLE `likedposts`
  ADD CONSTRAINT `likedposts_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `posts` (`IDpost`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likedposts_ibfk_2` FOREIGN KEY (`IDuser`) REFERENCES `users` (`IDuser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `userposts`
--
ALTER TABLE `userposts`
  ADD CONSTRAINT `userposts_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `posts` (`IDpost`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userposts_ibfk_2` FOREIGN KEY (`IDuser`) REFERENCES `users` (`IDuser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
