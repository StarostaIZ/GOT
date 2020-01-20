-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Sty 2020, 02:17
-- Wersja serwera: 10.3.16-MariaDB
-- Wersja PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `got`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `administratorzy`
--

CREATE TABLE `administratorzy` (
  `id` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `haslo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_ur` date NOT NULL,
  `pesel` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nr_tel` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `administratorzy`
--

INSERT INTO `administratorzy` (`id`, `login`, `haslo`, `email`, `data_ur`, `pesel`, `nr_tel`) VALUES
(1, 'MacBar', 'qwerty123', 'maciek@bartosik.wtf', '1998-06-13', '98061312331', '111222333'),
(2, 'MichMat', 'qwerty123', 'michal@got.pl', '1991-07-10', '91071012331', '111222334'),
(3, 'AdamKub', 'qwerty123', 'adam@got.pl', '1995-10-10', '95101012331', '511222334');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bledy`
--

CREATE TABLE `bledy` (
  `id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `temat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tresc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategoria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `bledy`
--

INSERT INTO `bledy` (`id`, `autor_id`, `temat`, `tresc`, `kategoria`) VALUES
(1, 1, 'Test1', 'Nie działa', 'Niezgodnosc danych');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `grupy_gorskie`
--

CREATE TABLE `grupy_gorskie` (
  `id` int(11) NOT NULL,
  `nazwa_grupy` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `grupy_gorskie`
--

INSERT INTO `grupy_gorskie` (`id`, `nazwa_grupy`) VALUES
(1, 'Tatry Wysokie'),
(2, 'Tatry Zachodnie'),
(3, 'Podtatrze'),
(5, 'Beskid Mały'),
(6, 'Beskid Sądecki'),
(7, 'Beskid Śląski'),
(8, 'Beskid Średni'),
(9, 'Beskid Wyspowy'),
(10, 'Beskid Żywiecki'),
(11, 'Gorce'),
(12, 'Orawa'),
(13, 'Pogórze'),
(14, 'Pogórze Wielicike');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191231140442', '2019-12-31 14:07:50'),
('20191231151020', '2019-12-31 15:10:31'),
('20191231160053', '2019-12-31 16:00:57'),
('20191231164157', '2019-12-31 16:42:10'),
('20191231175749', '2019-12-31 17:57:53'),
('20191231175919', '2019-12-31 17:59:24'),
('20200103185639', '2020-01-03 18:56:55'),
('20200103205616', '2020-01-03 20:56:26'),
('20200103212236', '2020-01-03 21:22:41'),
('20200103224414', '2020-01-03 22:44:34'),
('20200103224516', '2020-01-03 22:45:32'),
('20200103225231', '2020-01-03 22:52:50'),
('20200105221643', '2020-01-05 22:17:01'),
('20200105223108', '2020-01-05 22:31:21');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odcinki_tras`
--

CREATE TABLE `odcinki_tras` (
  `punkt_poczatkowy_id` int(11) NOT NULL,
  `punkt_koncowy_id` int(11) NOT NULL,
  `przowodnik_zatwierdzajacy_id` int(11) DEFAULT NULL,
  `dlugosc` double DEFAULT NULL,
  `pkt_za_przejsce` int(11) NOT NULL,
  `pkt_za_powrot` int(11) NOT NULL,
  `czy_zatwierdzone_przez_przodownika` tinyint(1) DEFAULT NULL,
  `suma_przewyzszen` int(11) DEFAULT NULL,
  `suma_spadkow` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `odcinki_tras`
--

INSERT INTO `odcinki_tras` (`punkt_poczatkowy_id`, `punkt_koncowy_id`, `przowodnik_zatwierdzajacy_id`, `dlugosc`, `pkt_za_przejsce`, `pkt_za_powrot`, `czy_zatwierdzone_przez_przodownika`, `suma_przewyzszen`, `suma_spadkow`, `id`) VALUES
(29, 10, NULL, 1.3, 1, 1, NULL, 9, 115, 10),
(10, 9, NULL, 0.6, 1, 1, NULL, 14, 8, 11);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odznaki`
--

CREATE TABLE `odznaki` (
  `id` int(11) NOT NULL,
  `zdobywca_id` int(11) NOT NULL,
  `typ_odznaki_id` int(11) NOT NULL,
  `potrzebna_ilosc_pkt` int(11) NOT NULL,
  `aktualna_ilosc_pkt` int(11) NOT NULL,
  `czy_zdobyto` tinyint(1) NOT NULL,
  `kiedy_zdobyto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przodownicy_turystyki_gorskiej_pttk`
--

CREATE TABLE `przodownicy_turystyki_gorskiej_pttk` (
  `id` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `haslo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_ur` date NOT NULL,
  `pesel` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nr_tel` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imie` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nazwisko` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przodownik_turystyki_gorskiej_pttk_grupa_gorska`
--

CREATE TABLE `przodownik_turystyki_gorskiej_pttk_grupa_gorska` (
  `przodownik_turystyki_gorskiej_pttk_id` int(11) NOT NULL,
  `grupa_gorska_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `punkty`
--

CREATE TABLE `punkty` (
  `id` int(11) NOT NULL,
  `grupa_gorska_id` int(11) NOT NULL,
  `nazwa_pkt` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `szerokosc_geogr` double DEFAULT NULL,
  `dlugosc_geogr` double DEFAULT NULL,
  `wysokosc` double DEFAULT NULL,
  `czy_zdef_przez_uzytk` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `punkty`
--

INSERT INTO `punkty` (`id`, `grupa_gorska_id`, `nazwa_pkt`, `szerokosc_geogr`, `dlugosc_geogr`, `wysokosc`, `czy_zdef_przez_uzytk`) VALUES
(1, 1, ' Rusinowa Polana (1170 ÷ 1300 m)', NULL, NULL, 1300, 0),
(2, 1, 'Łysa Polana', NULL, NULL, NULL, 0),
(3, 1, 'Gęsia Szyja (1489 m)', NULL, NULL, 1489, 0),
(4, 1, 'Wodogrzmoty Mickiewicza', NULL, NULL, NULL, 0),
(5, 1, 'Schronisko PTTK nad Morskim Okiem (1410 m)', NULL, NULL, 1410, 0),
(6, 1, 'Czarny Staw nad Morskim Okiem (1583 m)', NULL, NULL, 1583, 0),
(7, 1, 'Dolina za Mnichem (1785 ÷ 2100 m)', NULL, NULL, 2100, 0),
(8, 1, 'Szpiglasowa Przełęcz (2110 m)', NULL, NULL, 2110, 0),
(9, 1, '\r\n Schronisko PTTK w Dolinie Pięciu Stawów Polskich (1671 m)', NULL, NULL, 1671, 0),
(10, 1, 'Siklawa (1666 m)', NULL, NULL, 1666, 0),
(11, 1, 'Kozi Wierch (2291 m)', NULL, NULL, 2291, 0),
(12, 1, 'Kozia Przełęcz (2137 m)', NULL, NULL, 2137, 0),
(13, 1, 'Przełęcz Zawrat (2159 m)', NULL, NULL, 2159, 0),
(14, 1, 'Świnica (2301 m)', NULL, NULL, 2301, 0),
(15, 1, 'Świnicka Przełęcz (2050 m)', NULL, NULL, 2050, 0),
(16, 1, 'Kozia Dolinka', NULL, NULL, NULL, 0),
(17, 1, 'Żleb Kulczyńskiego', NULL, NULL, NULL, 0),
(18, 1, 'Skrajny Granat (2225 m)', NULL, NULL, 2225, 0),
(19, 1, 'Przełęcz Krzyżne (2114 m)', NULL, NULL, 2114, 0),
(20, 1, 'Przełęcz Krab (1853 m)', NULL, NULL, 1853, 0),
(21, 1, 'Dwoiśniak', NULL, NULL, NULL, 0),
(22, 1, ' Schronisko PTTK na Hali Gąsienicowej (1500 m)', NULL, NULL, 1500, 0),
(23, 1, 'Doliny Filipka', NULL, NULL, NULL, 0),
(24, 1, 'Wierch Porońca (1036 m)', NULL, NULL, 1036, 0),
(25, 1, 'Palenica Białczańska', NULL, NULL, NULL, 0),
(26, 1, 'Polana pod Wołoszynem 1245 ÷ 1320 m', NULL, NULL, 1320, 0),
(29, 1, 'tablica S. Bronikowskiego (1772 m)', NULL, NULL, 1772, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trasa_odcinek_trasy`
--

CREATE TABLE `trasa_odcinek_trasy` (
  `trasa_id` int(11) NOT NULL,
  `odcinek_trasy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trasy`
--

CREATE TABLE `trasy` (
  `id` int(11) NOT NULL,
  `grupa_gorska_id` int(11) DEFAULT NULL,
  `odznaka_id` int(11) NOT NULL,
  `data_utworzenia` date NOT NULL,
  `suma_pkt` int(11) NOT NULL,
  `dlugosc` double NOT NULL,
  `roznica_wysokosci` double NOT NULL,
  `data_pokonania` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `turysci`
--

CREATE TABLE `turysci` (
  `id` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `haslo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_ur` date NOT NULL,
  `imie` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nazwisko` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `turysci`
--

INSERT INTO `turysci` (`id`, `login`, `haslo`, `email`, `data_ur`, `imie`, `nazwisko`) VALUES
(1, 'JanKow', 'qwerty123', 'jankow@gmail.com', '1970-07-02', 'Jan', 'Kowalski');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typy_odznak`
--

CREATE TABLE `typy_odznak` (
  `id` int(11) NOT NULL,
  `nazwa_typu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `administratorzy`
--
ALTER TABLE `administratorzy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7FD6E57AAA08CB10` (`login`),
  ADD UNIQUE KEY `UNIQ_7FD6E57AE7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_7FD6E57A3931747B` (`pesel`),
  ADD UNIQUE KEY `UNIQ_7FD6E57A9C3611CF` (`nr_tel`);

--
-- Indeksy dla tabeli `bledy`
--
ALTER TABLE `bledy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F3B5DA7F14D45BBE` (`autor_id`);

--
-- Indeksy dla tabeli `grupy_gorskie`
--
ALTER TABLE `grupy_gorskie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indeksy dla tabeli `odcinki_tras`
--
ALTER TABLE `odcinki_tras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CC95DE533C0B5E938CF59731` (`punkt_poczatkowy_id`,`punkt_koncowy_id`),
  ADD KEY `IDX_CC95DE533C0B5E93` (`punkt_poczatkowy_id`),
  ADD KEY `IDX_CC95DE538CF59731` (`punkt_koncowy_id`),
  ADD KEY `IDX_CC95DE53691CD510` (`przowodnik_zatwierdzajacy_id`);

--
-- Indeksy dla tabeli `odznaki`
--
ALTER TABLE `odznaki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2FA3257B15CDDF7A` (`zdobywca_id`),
  ADD KEY `IDX_2FA3257BE50B905E` (`typ_odznaki_id`);

--
-- Indeksy dla tabeli `przodownicy_turystyki_gorskiej_pttk`
--
ALTER TABLE `przodownicy_turystyki_gorskiej_pttk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7C85F3E4AA08CB10` (`login`),
  ADD UNIQUE KEY `UNIQ_7C85F3E4E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_7C85F3E43931747B` (`pesel`),
  ADD UNIQUE KEY `UNIQ_7C85F3E49C3611CF` (`nr_tel`);

--
-- Indeksy dla tabeli `przodownik_turystyki_gorskiej_pttk_grupa_gorska`
--
ALTER TABLE `przodownik_turystyki_gorskiej_pttk_grupa_gorska`
  ADD PRIMARY KEY (`przodownik_turystyki_gorskiej_pttk_id`,`grupa_gorska_id`),
  ADD KEY `IDX_FF165D3DA3F4D67` (`przodownik_turystyki_gorskiej_pttk_id`),
  ADD KEY `IDX_FF165D36CC9CEA7` (`grupa_gorska_id`);

--
-- Indeksy dla tabeli `punkty`
--
ALTER TABLE `punkty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_718F1770827A72B1` (`nazwa_pkt`),
  ADD KEY `IDX_718F17706CC9CEA7` (`grupa_gorska_id`);

--
-- Indeksy dla tabeli `trasa_odcinek_trasy`
--
ALTER TABLE `trasa_odcinek_trasy`
  ADD PRIMARY KEY (`trasa_id`,`odcinek_trasy_id`),
  ADD KEY `IDX_38CF5D5F518F4BA5` (`trasa_id`),
  ADD KEY `IDX_38CF5D5F2F84E4DC` (`odcinek_trasy_id`);

--
-- Indeksy dla tabeli `trasy`
--
ALTER TABLE `trasy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AE59B4BB6CC9CEA7` (`grupa_gorska_id`),
  ADD KEY `IDX_AE59B4BB13204B24` (`odznaka_id`);

--
-- Indeksy dla tabeli `turysci`
--
ALTER TABLE `turysci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `typy_odznak`
--
ALTER TABLE `typy_odznak`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `administratorzy`
--
ALTER TABLE `administratorzy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `bledy`
--
ALTER TABLE `bledy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `grupy_gorskie`
--
ALTER TABLE `grupy_gorskie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `odcinki_tras`
--
ALTER TABLE `odcinki_tras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `odznaki`
--
ALTER TABLE `odznaki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `przodownicy_turystyki_gorskiej_pttk`
--
ALTER TABLE `przodownicy_turystyki_gorskiej_pttk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `punkty`
--
ALTER TABLE `punkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT dla tabeli `trasy`
--
ALTER TABLE `trasy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `turysci`
--
ALTER TABLE `turysci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `typy_odznak`
--
ALTER TABLE `typy_odznak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `bledy`
--
ALTER TABLE `bledy`
  ADD CONSTRAINT `FK_F3B5DA7F14D45BBE` FOREIGN KEY (`autor_id`) REFERENCES `turysci` (`id`);

--
-- Ograniczenia dla tabeli `odcinki_tras`
--
ALTER TABLE `odcinki_tras`
  ADD CONSTRAINT `FK_CC95DE533C0B5E93` FOREIGN KEY (`punkt_poczatkowy_id`) REFERENCES `punkty` (`id`),
  ADD CONSTRAINT `FK_CC95DE53691CD510` FOREIGN KEY (`przowodnik_zatwierdzajacy_id`) REFERENCES `przodownicy_turystyki_gorskiej_pttk` (`id`),
  ADD CONSTRAINT `FK_CC95DE538CF59731` FOREIGN KEY (`punkt_koncowy_id`) REFERENCES `punkty` (`id`);

--
-- Ograniczenia dla tabeli `odznaki`
--
ALTER TABLE `odznaki`
  ADD CONSTRAINT `FK_2FA3257B15CDDF7A` FOREIGN KEY (`zdobywca_id`) REFERENCES `turysci` (`id`),
  ADD CONSTRAINT `FK_2FA3257BE50B905E` FOREIGN KEY (`typ_odznaki_id`) REFERENCES `typy_odznak` (`id`);

--
-- Ograniczenia dla tabeli `przodownik_turystyki_gorskiej_pttk_grupa_gorska`
--
ALTER TABLE `przodownik_turystyki_gorskiej_pttk_grupa_gorska`
  ADD CONSTRAINT `FK_FF165D36CC9CEA7` FOREIGN KEY (`grupa_gorska_id`) REFERENCES `grupy_gorskie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FF165D3DA3F4D67` FOREIGN KEY (`przodownik_turystyki_gorskiej_pttk_id`) REFERENCES `przodownicy_turystyki_gorskiej_pttk` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `punkty`
--
ALTER TABLE `punkty`
  ADD CONSTRAINT `FK_718F17706CC9CEA7` FOREIGN KEY (`grupa_gorska_id`) REFERENCES `grupy_gorskie` (`id`);

--
-- Ograniczenia dla tabeli `trasa_odcinek_trasy`
--
ALTER TABLE `trasa_odcinek_trasy`
  ADD CONSTRAINT `FK_38CF5D5F2F84E4DC` FOREIGN KEY (`odcinek_trasy_id`) REFERENCES `odcinki_tras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_38CF5D5F518F4BA5` FOREIGN KEY (`trasa_id`) REFERENCES `trasy` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `trasy`
--
ALTER TABLE `trasy`
  ADD CONSTRAINT `FK_AE59B4BB13204B24` FOREIGN KEY (`odznaka_id`) REFERENCES `odznaki` (`id`),
  ADD CONSTRAINT `FK_AE59B4BB6CC9CEA7` FOREIGN KEY (`grupa_gorska_id`) REFERENCES `grupy_gorskie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
