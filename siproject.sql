-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Lis 2021, 18:27
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

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`IDcomment`, `IDparent`, `IDuser`, `IDpost`, `text`, `points`) VALUES
(1, 0, 1, 3, 'cos', -1),
(2, 0, 1, 3, 'cos', 0),
(3, 1, 1, 3, 'cos', 0),
(4, 1, 1, 3, 'cos', 0),
(5, 3, 1, 3, 'cos', 0),
(6, 5, 1, 3, 'cos', 0),
(7, 2, 1, 3, 'Był sobie las', 1),
(8, 0, 1, 3, 'Adam tu był', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `favoritedposts`
--

CREATE TABLE `favoritedposts` (
  `IDuser` int(10) UNSIGNED NOT NULL,
  `IDpost` int(10) UNSIGNED NOT NULL
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
-- Zrzut danych tabeli `likedcomments`
--

INSERT INTO `likedcomments` (`IDcomment`, `IDuser`, `vote`) VALUES
(7, 1, 1),
(1, 1, 0);

--
-- Wyzwalacze `likedcomments`
--
DELIMITER $$
CREATE TRIGGER `Update_points_comment_0` AFTER UPDATE ON `likedcomments` FOR EACH ROW BEGIN
UPDATE users SET points=points-2 WHERE IDuser=NEW.IDuser AND NEW.vote=0;
UPDATE comments SET points=points-2 WHERE IDcomment=NEW.IDcomment AND NEW.vote=0;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Update_points_comment_1` AFTER UPDATE ON `likedcomments` FOR EACH ROW BEGIN
UPDATE users SET points=points+2 WHERE IDuser=NEW.IDuser AND NEW.vote=1;
UPDATE comments SET points=points+2 WHERE IDcomment=NEW.IDcomment AND NEW.vote=1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `dec_points_comment` AFTER INSERT ON `likedcomments` FOR EACH ROW BEGIN
UPDATE users SET points=points-1 WHERE IDuser=NEW.IDuser AND NEW.vote=0;
UPDATE comments SET points=points-1 WHERE IDcomment=NEW.IDcomment AND NEW.vote=0;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inc_points_comment` AFTER INSERT ON `likedcomments` FOR EACH ROW BEGIN
UPDATE users SET points=points+1 WHERE IDuser=NEW.IDuser AND NEW.vote=1;
UPDATE comments SET points=points+1 WHERE IDcomment=NEW.IDcomment AND NEW.vote=1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `removepoint_0_comment` AFTER DELETE ON `likedcomments` FOR EACH ROW BEGIN
UPDATE users SET points=points+1 WHERE IDuser=OLD.IDuser AND OLD.vote=0;
UPDATE comments SET points=points+1 WHERE IDcomment=OLD.IDcomment AND OLD.vote=0;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `removepoint_1_comment` AFTER DELETE ON `likedcomments` FOR EACH ROW BEGIN
UPDATE users SET points=points-1 WHERE IDuser=OLD.IDuser AND OLD.vote=1;
UPDATE comments SET points=points-1 WHERE IDcomment=OLD.IDcomment AND OLD.vote=1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `likedposts`
--

CREATE TABLE `likedposts` (
  `IDuser` int(10) UNSIGNED NOT NULL,
  `IDpost` int(10) UNSIGNED NOT NULL,
  `vote` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `likedposts`
--

INSERT INTO `likedposts` (`IDuser`, `IDpost`, `vote`) VALUES
(1, 3, 1);

--
-- Wyzwalacze `likedposts`
--
DELIMITER $$
CREATE TRIGGER `dec_points_post` AFTER INSERT ON `likedposts` FOR EACH ROW UPDATE users SET points=points-1 WHERE IDuser=NEW.IDuser AND NEW.vote=0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inc_points_post` AFTER INSERT ON `likedposts` FOR EACH ROW UPDATE users SET points=points+1 WHERE IDuser=NEW.IDuser AND NEW.vote=1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `post_dec_points` AFTER INSERT ON `likedposts` FOR EACH ROW UPDATE posts SET points=points-1 WHERE NEW.vote=0 AND IDpost=NEW.IDpost
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `post_inc_points` AFTER INSERT ON `likedposts` FOR EACH ROW UPDATE posts SET points=points+1 WHERE NEW.vote=1 AND IDpost=NEW.IDpost
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `post_removepoint_0` AFTER DELETE ON `likedposts` FOR EACH ROW UPDATE posts SET points=points+1 WHERE OLD.vote=0 AND IDpost=OLD.IDpost
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `post_removepoint_1` AFTER DELETE ON `likedposts` FOR EACH ROW UPDATE posts SET points=points-1 WHERE OLD.vote=1 AND IDpost=OLD.IDpost
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `removepoint_0_post` AFTER DELETE ON `likedposts` FOR EACH ROW UPDATE users SET points=points+1 WHERE IDuser=OLD.IDuser AND OLD.vote=0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `removepoint_1_post` AFTER DELETE ON `likedposts` FOR EACH ROW UPDATE users SET points=points-1 WHERE IDuser=OLD.IDuser AND OLD.vote=1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `photos`
--

CREATE TABLE `photos` (
  `IDpost` int(11) UNSIGNED NOT NULL,
  `IDphoto` int(11) UNSIGNED NOT NULL,
  `ext` varchar(4) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `photos`
--

INSERT INTO `photos` (`IDpost`, `IDphoto`, `ext`, `description`) VALUES
(3, 4, 'png', ''),
(6, 7, 'png', 'aaaa'),
(7, 8, 'png', 'ggfsd'),
(8, 9, 'png', 'fdsa'),
(10, 11, 'png', 'dfsa'),
(11, 12, 'png', 'fdsa'),
(12, 13, 'png', ''),
(13, 14, 'gif', 'kljh'),
(14, 15, 'gif', 'fgds'),
(15, 16, 'gif', ''),
(16, 17, 'png', ''),
(17, 18, 'png', ''),
(18, 19, 'png', '');

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
(3, 'dghdgg', 1, 1),
(6, 'fda', 0, 1),
(7, 'gfds', 0, 0),
(8, 'fdsa', 0, 0),
(10, 'fdsa', 0, 0),
(11, 'fdsa', 0, 0),
(12, 'fdsa', 0, 0),
(13, 'jkh', 0, 0),
(14, 'fdsa', 0, 0),
(15, 'fdsa', 0, 0),
(16, 'kjg', 0, 0),
(17, 'fdsa', 0, 0),
(18, 'fdsa', 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `userposts`
--

CREATE TABLE `userposts` (
  `IDpost` int(11) UNSIGNED NOT NULL,
  `IDuser` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `userposts`
--

INSERT INTO `userposts` (`IDpost`, `IDuser`) VALUES
(3, 1),
(6, 1),
(7, 1),
(8, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1);

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
(1, 'adam', 'adamnosol@gmail.com', '$2y$10$ZjzWwpc30STeWbPRxMNmied/O1XisDhFgt0L5FE/FMFGNLYRkBskG', 'admin', NULL, 1),
(2, 'kamil', 'kamil@wp.pl', '$2y$10$X2IQhv79RYrnVNvyRv/sH.wDvj.0QuSWnLxJxThJ7u6b1Udx9N7BK', 'user', NULL, 0),
(3, 'kacper', 'kamil@wp.pl', '$2y$10$UNF2LDzazIQTLC1rwnXUaeulQzE.F1dOzcLR7r7RXNqY7RF5ezlzi', 'user', NULL, 0),
(4, 'fda', 'fdsa@wp.pl', '$2y$10$lBlGWNURbQIqsVBOEUa3Y.GATv5DMuZpkWiIEpUsru6.HGAYCLYFa', 'user', NULL, 0);

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
-- Indeksy dla tabeli `favoritedposts`
--
ALTER TABLE `favoritedposts`
  ADD KEY `IDpost` (`IDpost`),
  ADD KEY `IDuser` (`IDuser`);

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
  ADD KEY `IDpost` (`IDpost`),
  ADD KEY `IDuser` (`IDuser`);

--
-- Indeksy dla tabeli `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`IDphoto`),
  ADD KEY `photos_ibfk_1` (`IDpost`);

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
  MODIFY `IDcomment` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `photos`
--
ALTER TABLE `photos`
  MODIFY `IDphoto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `IDpost` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `IDuser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Ograniczenia dla tabeli `favoritedposts`
--
ALTER TABLE `favoritedposts`
  ADD CONSTRAINT `favoritedposts_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `posts` (`IDpost`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoritedposts_ibfk_2` FOREIGN KEY (`IDuser`) REFERENCES `users` (`IDuser`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`IDpost`) REFERENCES `posts` (`IDpost`) ON DELETE CASCADE ON UPDATE CASCADE;

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
