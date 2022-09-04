-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Lis 2021, 09:18
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
-- Baza danych: `pracazadanie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Krakow'),
(2, 'Wroclaw'),
(3, 'Miasto'),
(4, 'gdansk'),
(5, 'Bialystrok');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `combined`
--

CREATE TABLE `combined` (
  `id` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  `id_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `combined`
--

INSERT INTO `combined` (`id`, `id_city`, `id_code`) VALUES
(2, 2, 2),
(3, 4, 2),
(4, 5, 1),
(18, 1, 3),
(20, 3, 1),
(21, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `postcode`
--

CREATE TABLE `postcode` (
  `id` int(11) NOT NULL,
  `postcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `postcode`
--

INSERT INTO `postcode` (`id`, `postcode`) VALUES
(1, '32-531'),
(2, '53-634'),
(3, '32-510'),
(4, '61-593'),
(5, '32-532'),
(7, '53-521');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `combined`
--
ALTER TABLE `combined`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_city` (`id_city`),
  ADD KEY `id_code` (`id_code`);

--
-- Indeksy dla tabeli `postcode`
--
ALTER TABLE `postcode`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `combined`
--
ALTER TABLE `combined`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `postcode`
--
ALTER TABLE `postcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `combined`
--
ALTER TABLE `combined`
  ADD CONSTRAINT `combined_ibfk_1` FOREIGN KEY (`id_city`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `combined_ibfk_2` FOREIGN KEY (`id_code`) REFERENCES `postcode` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
