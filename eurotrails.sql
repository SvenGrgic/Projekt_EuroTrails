-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2026 at 12:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eurotrails`
--
CREATE DATABASE IF NOT EXISTS `eurotrails` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `eurotrails`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `korisnicko_ime` varchar(32) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `level`) VALUES
(1, 'gost', 'gost', 'gost', '$2y$10$umTJDXIpXOb4y/KwN/xzeuql.bw9PEsgkrpmnk4EJ5WYz4EjyrFcq', 0),
(2, 'admin', 'admin', 'admin', '$2y$10$4f8ssv1Xdx8pou/BBPaZTuiOR0eRXP3aCFyq8eCNUBSI/QcyBjX46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `putopisi`
--

CREATE TABLE `putopisi` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `sazetak` varchar(50) NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(255) NOT NULL,
  `kategorija` varchar(50) NOT NULL,
  `arhiva` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `putopisi`
--

INSERT INTO `putopisi` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '2026-06-21', 'SKRIVENI GRAD INKA: VODIČ KROZ MISTIČNI MACHU PICCHU', 'Putovanje u izgubljeni i čarobni grad Inka.', 'Smješten na visokom i nepristupačnom planinskom grebenu u peruanskim Andama, na nadmorskoj visini od 2.430 metara, ponosno stoji Machu Picchu – jedno od sedam novih svjetskih čuda. Ovaj fascinantni drevni grad Inka izgrađen je sredinom 15. stoljeća, u vrijeme procvata imperija pod vladavinom cara Pachacutija. Ipak, ono što ga čini posebnim jest činjenica da je nakon španjolskog osvajanja ostao potpuno zaboravljen i skriven od vanjskog svijeta, sve dok ga 1911. godine ponovno nije otkrio američki istraživač Hiram Bingham.\r\n\r\nArhitektura Machu Picchua ostavlja posjetitelje bez daha. Grad je izgrađen klasičnim stilom Inka, koristeći tehniku suhozida zvanu ashlar. Golemi granitni blokovi klesani su s tolikom preciznošću da se između njih ne može ugurati ni oštrica noža, i to bez upotrebe ikakvog vezivnog materijala ili žbuke. Cijeli kompleks podijeljen je na poljoprivrednu zonu s impresivnim terasama koje su sprječavale eroziju tla i urbanu zonu u kojoj su smješteni hramovi, palače i stambene četvrti. Među najvažnijim strukturama ističu se Hram Sunca, Soba s tri prozora te Intihuatana – mistični ritualni kamen koji je Inkam služio kao astronomski sat i kalendar.\r\n\r\nDanas je posjet Machu Picchu spektakularna avantura. Najpoznatiji način dolaska je legendarna višednevna ruta Inca Trail koja vodi kroz planinske prijevoje i tropske šume izravno do Vrata Sunca (Intipunku), odakle se pruža nezaboravan pogled na izlazak sunca nad citadelom. Za one koji preferiraju komforniju opciju, dostupan je slikoviti vlak iz Cusca ili Ollantaytamba do podnožja u gradiću Aguas Calientes. Bez obzira na način dolaska, stajanje usred ovog mističnog mjesta, dok se jutarnja magla polako podiže iznad zelenih vrhova Huayna Picchua, pruža jedinstven osjećaj povezanosti s prošlošću koji se pamti cijeli život.', 'machu.jpg', 'Regija i Jug', 1),
(2, '2026-06-21', 'ATENA KROZ POVIJEST: USPON NA AKROPOLU I ISTRAŽIVANJE ČETVRTI PLAKA', 'Grčka gostoljubivost i Partenon', 'Kolijevka zapadne civilizacije, Atena, grad je u kojem se prošlost i sadašnjost sudaraju na svakom koraku. Antički hramovi ponosno stoje iznad modernih stambenih zgrada, a energija grada koji nikada ne spava osjeti se od ranog jutra na užurbanim tržnicama pa sve do kasnih noćnih sati u tavernama.\r\n\r\nApsolutno polazište svakog putovanja je veličanstvena Akropola i kultni hram Partenon. Nakon obilaska ovog povijesnog čuda arhitekture, spustite se u moderni Muzej Akropole, a zatim u labirint uličica četvrti Plaka – najstarijeg naseljenog dijela Atene sa slikovitim neoklasičnim kućama.\r\n\r\nZa ljubitelje panoramskih vidika, brdo Lycabettus pruža najljepši pogled na grad koji se proteže sve do mora i luke Pirej. Navečer obavezno posjetite živahni trg Monastiraki i četvrt Psiri, mjesta poznata po odličnom uličnom souvlakiju, tradicionalnom žestokom piću Ouzo i glazbi uživo.\r\n\r\nAtena može djelovati kaotično na prvi pogled, no njezina povijesna težina, mediteranski šarm, vrhunska gastronomska scena i blizina obale čine je jednom od najuzbudljivijih prijestolnica Europe.', 'atena.jpg', 'Regija i Jug', 0),
(3, '2026-06-21', 'GRAZ NA DLANU: JEDNODNEVNI IZLET NA SCHLOSSBERG I CASCO ANTIGUO', 'Pogled s Schlossberga otkriva more crvenih krovova', 'Smješten tik uz granicu, Graz je drugi po veličini austrijski grad, ali često ostaje nepravedno u sjeni Beča. Poznat kao studentsko središte s očuvanom renesansnom starom jezgrom pod zaštitom UNESCO-a, ovaj šarmantni grad idealan je izbor za opušteni jednodnevni ili vikend izlet.\r\n\r\nGlavna atrakcija i orijentir vidljiv iz svakog kuta je brdo Schlossberg. Do vrha se možete popeti povijesnim stubama, žičarom ili modernim dizalom izgrađenim unutar stijene. Tamo vas čeka kultni toranj sa satom, Uhrturm, čije kazaljke imaju zamijenjene uloge – velika pokazuje sate, a mala minute.\r\n\r\nNajbolji primjer te arhitektonske hrabrosti je Kunsthaus Graz, muzej suvremene umjetnosti koji lokalno stanovništvo od milja zove \"prijateljski izvanzemaljac\" zbog njegovog specifičnog plavog, amorfno-organskog oblika koji se izdiže tik uz rijeku Muru.\r\n\r\nOdmah pored nalazi se i Murinsel, umjetni plutajući otok od čelika u obliku školjke, savršen za popodnevnu kavu.\"\r\n\r\nNakon šetnje kroz skrivena dvorišta (od kojih je najpoznatije renesansno dvorište Landhausa), posjetite tržnicu Kaiser-Josef-Platz i kušajte autohtono bučino ulje. Graz nudi savršen spoj štajerske tradicije i mediteranske ležernosti.', 'graz.jpg', 'Srednja Europa', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `putopisi`
--
ALTER TABLE `putopisi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `putopisi`
--
ALTER TABLE `putopisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
