-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Lis 2021, 11:37
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
-- Struktura tabeli dla tabeli `photos`
--

CREATE TABLE `photos` (
  `IDpost` int(11) UNSIGNED NOT NULL,
  `IDphoto` int(11) UNSIGNED NOT NULL,
  `ext` varchar(3) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `photos`
--

INSERT INTO `photos` (`IDpost`, `IDphoto`, `ext`, `description`) VALUES
(1, 1, 'png', 'fdsa'),
(1, 2, 'png', ''),
(2, 3, 'png', 'Fajno');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `IDpost` int(11) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `valid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`IDpost`, `title`, `points`, `valid`) VALUES
(1, 'fdsa', 0, 0),
(2, 'Drugi post', 0, 0);

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
  `password` varchar(100) NOT NULL,
  `permission` enum('admin','moderator','user','') NOT NULL DEFAULT 'user',
  `birthday` date DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`IDuser`, `login`, `email`, `password`, `permission`, `birthday`, `points`) VALUES
(1, 'adam', 'adamnosol@gmail.com', '$2y$10$ZjzWwpc30STeWbPRxMNmied/O1XisDhFgt0L5FE/FMFGNLYRkBskG', 'admin', NULL, 0),
(2, 'kamil', 'kamil@wp.pl', '$2y$10$X2IQhv79RYrnVNvyRv/sH.wDvj.0QuSWnLxJxThJ7u6b1Udx9N7BK', 'user', NULL, 0),
(3, 'kacper', 'kamil@wp.pl', '$2y$10$UNF2LDzazIQTLC1rwnXUaeulQzE.F1dOzcLR7r7RXNqY7RF5ezlzi', 'user', NULL, 0);

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
-- Indeksy dla tabeli `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`IDphoto`),
  ADD KEY `IDpost` (`IDpost`);

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
-- AUTO_INCREMENT dla tabeli `photos`
--
ALTER TABLE `photos`
  MODIFY `IDphoto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `IDpost` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `IDuser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Ograniczenia dla tabeli `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `posts` (`IDpost`);

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
