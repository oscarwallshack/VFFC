-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Lut 2021, 00:20
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `vffc`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `Id` int(255) NOT NULL,
  `user` varchar(250) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`Id`, `user`, `haslo`, `email`) VALUES
(1, 'Bartosz', '$2y$10$zIRFsLOu1LAss6jLkxiJc.3YyEYAYFcxu/XtwE9nD15l.NqJaSaYC', 'walczak@wp.pl'),
(2, 'Andrzej', '$2y$10$DMYUmP22P3a6OD/CBIfjU.F07Ll2fN0rW7C7TdX8xwNzal/umQeHu', 'andrzej@kon.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id` int(11) NOT NULL,
  `imie` varchar(100) NOT NULL,
  `nazwisko` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dataSesji` date NOT NULL,
  `jakieAuto` text NOT NULL,
  `miejsce` text NOT NULL,
  `pakiet` enum('niskobudzetowy','podstawowy','premium') NOT NULL,
  `komentarz` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id`, `imie`, `nazwisko`, `email`, `dataSesji`, `jakieAuto`, `miejsce`, `pakiet`, `komentarz`) VALUES
(36, 'Bartolomeo', 'Walczakini', 'walczi@walczi.pl', '2021-02-16', 'Lamborghini, ', 'Lotnisko, ', 'premium', 'Moje potrzeby.'),
(37, 'Adrian', 'Kolwalski', 'kowal@kow.pl', '2021-02-16', 'Lamborghini, ', 'Lotnisko, ', 'niskobudzetowy', 'Chciałbym takie auto, wooow'),
(38, 'Kamil', 'Lasso', 'picasso@paint.pl', '2021-02-16', 'Porshe, ', 'Stare miasto, ', 'niskobudzetowy', 'Moje wymagania są ściśle związane z miejscem mojego pochodzenia. Trudno będzie je spełnić ale myślę że się da!');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
