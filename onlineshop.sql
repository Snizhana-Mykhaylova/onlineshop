-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Jul 2023 um 10:43
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `onlineshop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel`
--

CREATE TABLE `artikel` (
  `ArtikelID` int(11) UNSIGNED NOT NULL,
  `Artikelname` varchar(255) NOT NULL,
  `Beschreibung` varchar(255) NOT NULL,
  `Einzelpreis` decimal(13,2) UNSIGNED NOT NULL,
  `Bild` varchar(255) NOT NULL,
  `Lagerbestand` int(11) UNSIGNED NOT NULL,
  `KategorieNR` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `artikel`
--

INSERT INTO `artikel` (`ArtikelID`, `Artikelname`, `Beschreibung`, `Einzelpreis`, `Bild`, `Lagerbestand`, `KategorieNR`) VALUES
(6, 'Basic sweatshirt', 'swatshirt for women', 120.60, '../bilder/waren/img_6.png', 25, 1),
(7, 'Red dangle earrings', 'Red dangle earrings for women', 29.95, '../bilder/waren/img_7.png', 35, 1),
(8, 'Mid-rise slim cropped fit jeans', 'Mid-rise slim cropped fit jeans - stylish jeans for women', 40.00, '../bilder/waren/img_8.png', 80, 1),
(9, 'Black and white sport cap', 'A cap for men ', 18.15, '/', 44, 2),
(10, 'Gray shoes', 'Men fashion gray shoes', 85.50, '/', 25, 2),
(11, 'Chrono watch', 'Chrono watch with blue armband', 120.60, '/', 60, 2),
(12, 'Baby shoes', 'Baby shoes with laces', 30.60, '/', 70, 3),
(13, 'Green baby romper', 'Green baby romper for children', 20.40, '/', 55, 3),
(17, 'Check coat with colour contrast', 'A coat', 129.99, '/', 22, 1),
(18, 'Leather crossbody bag', 'A leather bag', 299.99, '/', 99, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikelkategorien`
--

CREATE TABLE `artikelkategorien` (
  `KategorieID` int(11) UNSIGNED NOT NULL,
  `Kategoriename` varchar(255) NOT NULL,
  `Beschreibung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `artikelkategorien`
--

INSERT INTO `artikelkategorien` (`KategorieID`, `Kategoriename`, `Beschreibung`) VALUES
(1, 'Frauen Klamotten', 'Geeignete und schöne Klamotten für Frauen.'),
(2, 'Herren Klamotten', 'Passende Klamotten für den Mann.'),
(3, 'Kinder Klamotten', 'Klamotten für die Kleinen.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellungen`
--

CREATE TABLE `bestellungen` (
  `BestellID` int(11) UNSIGNED NOT NULL,
  `UserNR` int(11) UNSIGNED NOT NULL,
  `Bestelldatum` date NOT NULL,
  `Beschreibung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellungsdetails`
--

CREATE TABLE `bestellungsdetails` (
  `BestellNR` int(11) UNSIGNED NOT NULL,
  `ArtikelNR` int(11) UNSIGNED NOT NULL,
  `Anzahl` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin123', '2023-06-29 11:59:02'),
(3, 'Johannes', '$2y$10$dn42uZI8EJ54nf5An.Ov.urp/tWgJwcn9CbYnilskeEXE9DqfEUJq', '2023-07-04 13:33:58'),
(4, 'Snizhana', '$2y$10$1jCgD.BEhYAKbCpk9i93a.OVmjzsBq.x2.SnLLWrpAMpobzpHve6u', '2023-07-05 10:30:23'),
(6, 'Csaba', '$2y$10$H979VQwkSvqqbVQero4iHOmAtoy92N6hiaVxKDxk0c2Jk132NKQBC', '2023-07-05 14:56:40'),
(7, 'Jonathan', '$2y$10$Tcw28yQCNxvvxJP4iZkJNOpdVMlhhiHydNm.035BzJervCBZuQtdm', '2023-07-06 10:20:45');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`ArtikelID`),
  ADD KEY `KategorieNR` (`KategorieNR`);

--
-- Indizes für die Tabelle `artikelkategorien`
--
ALTER TABLE `artikelkategorien`
  ADD PRIMARY KEY (`KategorieID`);

--
-- Indizes für die Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD PRIMARY KEY (`BestellID`),
  ADD KEY `UserNR` (`UserNR`);

--
-- Indizes für die Tabelle `bestellungsdetails`
--
ALTER TABLE `bestellungsdetails`
  ADD KEY `BestellNR` (`BestellNR`),
  ADD KEY `ArtikelNR` (`ArtikelNR`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `artikel`
--
ALTER TABLE `artikel`
  MODIFY `ArtikelID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `artikelkategorien`
--
ALTER TABLE `artikelkategorien`
  MODIFY `KategorieID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  MODIFY `BestellID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `KategorieNR` FOREIGN KEY (`KategorieNR`) REFERENCES `artikelkategorien` (`KategorieID`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD CONSTRAINT `UserNR` FOREIGN KEY (`UserNR`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `bestellungsdetails`
--
ALTER TABLE `bestellungsdetails`
  ADD CONSTRAINT `ArtikelNR` FOREIGN KEY (`ArtikelNR`) REFERENCES `artikel` (`ArtikelID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `BestellNR` FOREIGN KEY (`BestellNR`) REFERENCES `bestellungen` (`BestellID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
