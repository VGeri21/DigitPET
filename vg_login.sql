-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: mysql.omega:3306
-- Létrehozás ideje: 2026. Már 30. 16:39
-- Kiszolgáló verziója: 5.7.42-log
-- PHP verzió: 7.2.34-61+0~20260213.113+debian12~1.gbp7055a0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `vg_login`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allatok`
--

CREATE TABLE `allatok` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `kutya_nev` varchar(100) NOT NULL,
  `fajta` varchar(100) DEFAULT NULL,
  `szul_datum` date DEFAULT NULL,
  `gazdi_telefonszam` varchar(20) DEFAULT NULL,
  `lakcim` varchar(255) DEFAULT NULL,
  `extra_megjegyzes` text,
  `bileta_kod` varchar(50) DEFAULT NULL,
  `letrehozva` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `allatok`
--

INSERT INTO `allatok` (`id`, `felhasznalo_id`, `kutya_nev`, `fajta`, `szul_datum`, `gazdi_telefonszam`, `lakcim`, `extra_megjegyzes`, `bileta_kod`, `letrehozva`) VALUES
(18, 1, 'Lord', 'Keverék', '2025-11-14', '06303091969', 'Inárcs,Barackos Utca 45', 'Fekete kutya fehér csíkkal a fején', 'DOG-20251120-5bc303', '2025-11-20 13:07:44'),
(19, 1, 'Lucky', 'Magyar vizsla', '2025-11-27', '06303091969', 'Inárcs,Barackos Utca 45', 'Aranyos', 'DOG-20251120-232dfa', '2025-11-20 13:10:38'),
(25, 1, 'Appel', 'Palotapincsi', '2025-11-02', 'Nincs', 'Nincs', 'Nincs', 'DOG-20251120-c330f1', '2025-11-20 14:08:44'),
(26, 1, 'Lemon', 'Keverék', '2025-11-12', '06303091969', '2365,inárcs barackos utca 45', 'Aranyos', 'DOG-20251120-fa97c5', '2025-11-20 17:58:32'),
(29, 7, 'Lucky', 'Vizsla', '2025-11-13', '0630300473', '', '', 'DOG-20251123-fdb185', '2025-11-23 18:16:47'),
(30, 8, 'Hippi', 'mixer', '2025-11-24', '063055641411', 'Pataksor u 2', 'asfds', 'DOG-20251124-10f0fb', '2025-11-24 14:42:22'),
(31, 9, 'Bonifác', 'Hörcsög', '2025-12-02', '06305847412', 'Sátoraljaújhely', 'Egy kis buzi de szeretem', 'DOG-20251204-9eb198', '2025-12-04 08:35:35'),
(33, 12, 'szia', 'szia', '2020-01-10', '69696969', 'Otthon lakik', 'Ez egy kutya, négy lába van, ha ennél kevesebb akkor az baj, és nem az a baj hogy elveszett!', 'DOG-20251204-f07101', '2025-12-04 08:49:05'),
(34, 12, 'Állat neve', 'Fajta', '2020-01-01', 'telefonszám', 'lakcím', 'megjegyzés', 'DOG-20251204-2d2559', '2025-12-04 08:50:21'),
(36, 17, 'Marci', 'Jorli', '0000-00-00', '06303091969', '', '', 'DOG-20251228-c288dd', '2025-12-28 10:49:42'),
(37, 1, 'Bence', 'Spániel', '2003-01-19', '06303091969', 'Mátyásföld', 'Aranyos cuki nagy harpós', 'DOG-20260108-fa471c', '2026-01-08 09:09:18'),
(38, 14, 'asd', 'as', '2000-01-01', '01012012', 'asd', 'asd', 'DOG-20260108-0a5703', '2026-01-08 09:21:13'),
(39, 1, 'Kuki', 'Keverék', '2025-04-11', '06303091969', 'Sátoraljaújhely', 'kkk', 'DOG-20260108-e01a97', '2026-01-08 10:32:52'),
(40, 1, 'Marcipán', 'Jorki', '2018-02-02', '06302176300', 'Csömör Nap u 15', 'asdasdsadas', 'DOG-20260213-b59fe3', '2026-02-13 17:53:43'),
(41, 20, 'Marcipán', 'Jorki', '2000-01-01', '06302176300', 'Csömör Nap u 15', 'Kicsi', 'DOG-20260213-65b4dd', '2026-02-13 18:07:25'),
(42, 24, 'Lina', 'Tacskó', '0000-00-00', '304221370', '2365 Inárcs Traktor utca 8', '', 'DOG-20260215-9afe4b', '2026-02-15 11:12:56'),
(43, 1, 'asd', 'asd', '0000-00-00', 'asd', 'asd', 'sad', 'DOG-20260222-55e6de', '2026-02-22 10:31:05'),
(44, 25, 'ads', 'asd', '2000-02-02', '0630', 'asd', 'sad', 'DOG-20260226-ecfeaa', '2026-02-26 08:51:59'),
(45, 14, 'asd', 'asd', '0000-00-00', 'asd', 'asd', 'asd', 'DOG-20260330-7c47fd', '2026-03-30 12:58:41'),
(46, 14, 'asd', 'asd', '0000-00-00', 'asd', 'asd', 'asd', 'DOG-20260330-fb56ae', '2026-03-30 12:58:47'),
(47, 14, 'asd', 'asd', '0000-00-00', 'asd', 'asd', 'asd', 'DOG-20260330-b5510b', '2026-03-30 12:58:53'),
(48, 14, 'asd', 'asd', '0000-00-00', 'asd', 'asd', 'asd', 'DOG-20260330-492ae1', '2026-03-30 12:58:59');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(50) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `letrehozva` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `felhasznalonev`, `jelszo`, `email`, `letrehozva`, `is_admin`) VALUES
(1, 'VGeri', '$2y$10$XvmLGuKPHIxyN5gGcQAzduJ91cfELCNWof8qIfT12FsHWrRL5KRc.', 'gerivinc@gmail.com', '2025-11-20 10:24:36', 1),
(2, 'Geri', '$2y$10$d72xsX4nPY12Z8lGkCfmLONmGHlZCCrM3twSdcf3dPPYgl9DN7RJ6', 'asd@gmail.com', '2025-11-20 12:00:20', 0),
(7, 'Orsi', '$2y$10$VtPJ2sEmaBNq6utEffBcMu34XDmOcUyB4vCFBWl3J6sPr8aWspYXi', 'asde@gmail.com', '2025-11-23 18:16:15', 0),
(8, 'sp', '$2y$10$U3FinJ9Tk8s8ADwVJhMJTuk942ToNbU/0X6tuZylgh4QfMhPdRoBu', 'sp@gmail.com', '2025-11-24 14:41:11', 0),
(9, 'Cucu', '$2y$10$O2k4sCcsb5PXe7ZuMvOUXekQyk0c.Fzvcld6n4esY1iQplHkFCbSC', 'cucu@gmail.com', '2025-12-04 08:34:41', 0),
(12, 'szia', '$2y$10$XxFiQVD84EHpUdz/LP8cVu0LWlUNalf4LbqGHhzf/CDCTFIdPF2uS', 'szia@gmail.com', '2025-12-04 08:44:57', 0),
(13, 'asdw', '$2y$10$e0NRWq6n2yQdE5bX6HnQdeVxj87l1xj0zFJ0uDgXHq8e8C05QMd.G', 'w@gmail.com', '2025-12-04 11:21:40', 0),
(14, 'fasz', '$2y$10$7r2j40TsipTQjvVRFWdr2OZPNPGpk6HBCSrqVr6RzHVwCbW7sDLma', 'fasz@gmail.com', '2025-12-15 12:50:08', 0),
(15, 'fassz', '$2y$10$9er/XT40kbU7kp7iL9l5Uep1TcoQJRmOcqBw3mMe0ogccFC1MIgZO', 'fassz@gmail.com', '2025-12-15 12:50:26', 0),
(16, 'teszt2', '$2y$10$L3caQJ..oVmSXegCFZlDJ.LDmLE5FFoXHKszBGiWdSDuuXsykWX8G', 'teszt2@gmail.com', '2025-12-15 13:45:31', 0),
(17, 'Ftc', '$2y$10$WQ81o7Ga/sL/uP9YTLr31.ZQq26Czxe2RfV8nGVXkMGo4n2HqqI2W', 'ftc@gmail.com', '2025-12-28 10:49:13', 0),
(18, 'Kriszta', '$2y$10$UPOYyMlMEOS.utBtm6PD.e6MfuaYHdNrP/eLavgDVrGdt9Fc44d1W', 'krisztivinc@gmail.com', '2026-02-13 17:55:02', 0),
(19, 'asd', '$2y$10$xO0llr.CmaUGa8.CDYQl0eGNWiDudo.2bWhRteI/3TxkAGdssjkyy', 'sad@gmail.com', '2026-02-13 17:56:05', 0),
(20, 'Kriszti', '$2y$10$QtGK5MBQWL0zGW5.LdjHIe/E8wFTzIZOSr72.xCEnc84G21ddo1Qu', 'a@gmail.com', '2026-02-13 17:56:34', 0),
(21, 'gg', '$2y$10$Sk.x2dpPeJg8XIgs9d602Oj4OY0y.obnab3PLAquFE7xpbzrZLTt.', 'g@gmail.com', '2026-02-13 18:03:33', 0),
(22, 'ggg', '$2y$10$ulFNl6ma8FoVbGloKou/G.2qsOoAPIH6bl99tZrT/8rTF2Zsoc5Pa', 'ggg@gmail.com', '2026-02-13 18:03:52', 0),
(23, 'www', '$2y$10$o.1ZGgGhD40btSrr6E/UTelBQBHKcrtXkzmaZAiwSsSUq.xi5hV4e', 'we@gmail.com', '2026-02-13 18:04:20', 0),
(24, 'Éva', '$2y$10$0sviD38D7oIAb.ishCgVYeBk8dasD1UUfY.rbFphHAzMtYpis9Zha', 'vinczene.eva@gmail.com', '2026-02-15 11:11:12', 0),
(25, 'dani', '$2y$10$vcVRnJzibEnEY.6B5LRIaOyp9/RrM6ik2Jf3k6gLb7ofSEGCHSKmm', 'hulyegeri@gmail.com', '2026-02-26 08:49:06', 0),
(26, 'teszt', '$2y$10$KgW4SrGQ4wmAPq47Loks/uNAOzTT2y4AXQ0pKy1qrX1.VZT8GJ6.q', 'teszt@gmail.com', '2026-03-12 11:12:13', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `forma`
--

CREATE TABLE `forma` (
  `id` int(11) NOT NULL,
  `forma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `forma`
--

INSERT INTO `forma` (`id`, `forma`) VALUES
(1, 'csont'),
(2, 'kor'),
(3, 'negyzet');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kosar`
--

CREATE TABLE `kosar` (
  `id` int(11) NOT NULL,
  `rendeles_id` int(11) NOT NULL,
  `szin_id` int(11) DEFAULT NULL,
  `forma_id` int(11) DEFAULT NULL,
  `allat_id` int(11) DEFAULT NULL,
  `termek_tipus` varchar(50) DEFAULT NULL,
  `egyedi_alapszin` varchar(20) DEFAULT NULL,
  `egyedi_keretszin` varchar(20) DEFAULT NULL,
  `egyedi_felirat` varchar(50) DEFAULT NULL,
  `egyedi_forma` varchar(20) DEFAULT 'csont'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `kosar`
--

INSERT INTO `kosar` (`id`, `rendeles_id`, `szin_id`, `forma_id`, `allat_id`, `termek_tipus`, `egyedi_alapszin`, `egyedi_keretszin`, `egyedi_felirat`, `egyedi_forma`) VALUES
(98, 82, NULL, NULL, 18, NULL, '#00ff00', '#000000', 'Lord', 'csont'),
(99, 82, NULL, NULL, 19, 'Basick fekete alapon fehér', NULL, NULL, NULL, 'csont'),
(100, 83, NULL, NULL, 18, NULL, '#00ff00', '#000000', 'Állat Neve', 'csont'),
(102, 84, NULL, NULL, 46, 'Basick fehér alapon fekete', NULL, NULL, NULL, 'csont'),
(103, 84, NULL, NULL, 45, 'Basick fehér alapon fekete', NULL, NULL, NULL, 'csont');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendeles`
--

CREATE TABLE `rendeles` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `teljesitett` tinyint(1) DEFAULT '0',
  `nev` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cim` varchar(255) DEFAULT NULL,
  `telefonszam` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `rendeles`
--

INSERT INTO `rendeles` (`id`, `felhasznalo_id`, `datum`, `teljesitett`, `nev`, `email`, `cim`, `telefonszam`) VALUES
(82, 1, '2026-03-30 13:03:42', 1, 'Vincze Gergő', 'asd@gmail.com', 'sad', '06303091969'),
(83, 1, '2026-03-30 13:04:42', 1, 'Vincze Gergő', 'gerivinc@gmail.com', 'asd', '+36303091969'),
(84, 14, '2026-03-30 13:07:25', 1, 'qwe', 'qwe@szia.hu', 'qwe', '3021458'),
(85, 1, '2026-03-30 13:31:49', 0, NULL, NULL, NULL, NULL),
(86, 14, '2026-03-30 16:13:13', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szin`
--

CREATE TABLE `szin` (
  `id` int(11) NOT NULL,
  `szin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `szin`
--

INSERT INTO `szin` (`id`, `szin`) VALUES
(1, '#00FF00'),
(2, '#000000');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `allatok`
--
ALTER TABLE `allatok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bileta_kod` (`bileta_kod`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `felhasznalonev` (`felhasznalonev`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A tábla indexei `forma`
--
ALTER TABLE `forma`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kosar`
--
ALTER TABLE `kosar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendeles_id` (`rendeles_id`),
  ADD KEY `szin_id` (`szin_id`),
  ADD KEY `forma_id` (`forma_id`),
  ADD KEY `allat_id` (`allat_id`);

--
-- A tábla indexei `rendeles`
--
ALTER TABLE `rendeles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- A tábla indexei `szin`
--
ALTER TABLE `szin`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `allatok`
--
ALTER TABLE `allatok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT a táblához `forma`
--
ALTER TABLE `forma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `kosar`
--
ALTER TABLE `kosar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT a táblához `rendeles`
--
ALTER TABLE `rendeles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT a táblához `szin`
--
ALTER TABLE `szin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `allatok`
--
ALTER TABLE `allatok`
  ADD CONSTRAINT `allatok_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `kosar`
--
ALTER TABLE `kosar`
  ADD CONSTRAINT `kosar_ibfk_1` FOREIGN KEY (`rendeles_id`) REFERENCES `rendeles` (`id`),
  ADD CONSTRAINT `kosar_ibfk_2` FOREIGN KEY (`szin_id`) REFERENCES `szin` (`id`),
  ADD CONSTRAINT `kosar_ibfk_3` FOREIGN KEY (`forma_id`) REFERENCES `forma` (`id`),
  ADD CONSTRAINT `kosar_ibfk_4` FOREIGN KEY (`allat_id`) REFERENCES `allatok` (`id`);

--
-- Megkötések a táblához `rendeles`
--
ALTER TABLE `rendeles`
  ADD CONSTRAINT `rendeles_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
