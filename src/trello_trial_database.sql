-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Mar 2022, 08:13
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `trello_trial`
--
CREATE DATABASE IF NOT EXISTS `trello_trial` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trello_trial`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lists`
--

CREATE TABLE `lists` (
  `id_l` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `lists`
--

INSERT INTO `lists` (`id_l`, `name`) VALUES
(18, 'dupaaaaaaaaaa'),
(19, 'dfdfgfdfgfdf');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) NOT NULL,
  `id_l` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picture` varchar(64) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `position` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tasks`
--

INSERT INTO `tasks` (`id`, `id_l`, `name`, `picture`, `description`, `position`, `created_at`, `updated_at`) VALUES
(34256, 18, 'uigkgykug', NULL, '', 3, '2022-03-15 13:25:40', '2022-03-15 13:25:40'),
(34257, 18, ',jhvkk,jjhv', NULL, '', 2, '2022-03-15 13:25:46', '2022-03-15 13:25:46'),
(34258, 19, 'kjuiouoiuou', NULL, '', 2, '2022-03-15 13:26:26', '2022-03-15 13:26:26'),
(34259, 19, 'qwertyuiopp', NULL, '', 1, '2022-03-15 13:26:32', '2022-03-15 13:26:32'),
(34260, 19, 'mnbvc', NULL, '', 3, '2022-03-15 13:26:38', '2022-03-15 13:26:38'),
(34261, 19, 'fffffff', NULL, '', 4, '2022-03-15 13:33:31', '2022-03-15 13:33:31'),
(34263, 18, 'fffffffff999999', NULL, '', 1, '2022-03-15 13:37:30', '2022-03-15 13:37:30');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id_l`);

--
-- Indeksy dla tabeli `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `lists`
--
ALTER TABLE `lists`
  MODIFY `id_l` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34264;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
