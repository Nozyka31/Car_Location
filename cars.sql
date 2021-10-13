-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 11 oct. 2021 à 14:05
-- Version du serveur :  5.7.33
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `location-de-voiture`
--

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) CHARACTER SET utf8 NOT NULL,
  `model` varchar(50) CHARACTER SET utf8 NOT NULL,
  `power` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf16;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`id`, `brand`, `model`, `power`) VALUES
(1, 'Volskwagen', 'polo', 80),
(2, 'Volskwagen', 'golf', 95),
(3, 'Volskwagen', 'taigo', 85),
(4, 'Volskwagen', 'T-Cross', 95),
(5, 'VolksWagen', 'T-Roc', 110),
(6, 'VolksWagen', 'Tiguan', 130),
(7, 'VolksWagen', 'Passat', 122),
(8, 'VolksWagen', 'Touran', 150),
(9, 'VolksWagen', 'Arteon', 190),
(10, 'VolksWagen', 'Caddy', 75),
(11, 'VolksWagen', 'Caravelle', 110),
(12, 'VolksWagen', 'California', 110),
(13, 'VolksWagen', 'Multivan', 102),
(14, 'Hyundai', 'Ioniq', 136),
(15, 'Hyundai', 'Nexo', 136),
(16, 'Hyundai', 'Santa Fe', 230),
(17, 'Hyundai', 'Tucson', 265),
(18, 'Hyundai', 'i10', 67),
(19, 'Hyundai', 'i20', 84),
(20, 'Hyundai', 'i30', 120),
(21, 'Hyundai', 'i30 Fastback', 159),
(22, 'Hyundai', 'Bayon', 84),
(23, 'Toyota', 'Yaris', 116),
(24, 'Toyota', 'Yaris Cross', 116),
(25, 'Toyota', 'Corolla', 122),
(26, 'Toyota', 'C-HR', 122),
(27, 'Toyota', 'Rav4', 218),
(28, 'Toyota', 'Highlander', 248),
(29, 'Toyota', 'Prius', 122),
(30, 'Toyota', 'Camry', 218),
(31, 'Toyota', 'Mirai', 182),
(32, 'Toyota', 'GR Supra', 258),
(33, 'Toyota', 'Yaris', 116),
(34, 'Toyota', 'Yaris Cross', 116),
(35, 'Toyota', 'Corolla', 122),
(36, 'Toyota', 'C-HR', 122),
(37, 'Toyota', 'Rav4', 218),
(38, 'Toyota', 'Highlander', 248),
(39, 'Toyota', 'Prius', 122),
(40, 'Toyota', 'Camry', 218),
(41, 'Toyota', 'Mirai', 182),
(42, 'Toyota', 'GR Supra', 258),
(43, 'Toyota', 'Proace', 100),
(44, 'Seat', 'Ibiza', 95),
(45, 'Seat', 'Leon', 150),
(46, 'Seat', 'Alteca', 110),
(47, 'Seat', 'Arona', 95),
(48, 'Seat', 'Tarraco', 150),
(49, 'Mercedes', 'classe A', 109),
(50, 'Mercedes', 'classe B', 109),
(51, 'Mercedes', 'classe C', 163),
(52, 'Mercedes', 'classe E', 194),
(53, 'Mercedes', 'classe V', 163),
(54, 'Mercedes', 'classe S limousine', 286),
(55, 'Mercedes', 'CLA shooting brake', 136),
(56, 'Mercedes', 'EQA', 190),
(57, 'Mercedes', 'EQB', 190),
(58, 'Mercedes', 'EQC', 190),
(59, 'Mercedes', 'EQE', 292),
(60, 'Mercedes', 'EQS', 333),
(61, 'Mercedes', 'GLA', 163),
(62, 'Mercedes', 'GLB', 163),
(63, 'Mercedes', 'GLC coupé', 163),
(64, 'Mercedes', 'GLS', 330),
(65, 'Skoda', 'Kodiaq', 150),
(66, 'Skoda', 'Fabia', 65),
(67, 'Skoda', 'Scala', 95),
(68, 'Skoda', 'Octavia', 110),
(69, 'Skoda', 'Superb Sportline', 150),
(70, 'Skoda', 'Kamiq', 110),
(71, 'Skoda', 'Karoq', 110),
(72, 'Alfa Romeo', 'Giulia', 200),
(73, 'Alfa Romeo', 'Stelvio Quadrifolio', 510),
(74, 'Alfa Romeo', 'Giulietta', 120),
(75, 'Fiat', '500', 118),
(76, 'Fiat', '500 X', 120),
(77, 'Fiat', '500 L', 95),
(78, 'Fiat', 'Tipo Cross', 100),
(79, 'Fiat', 'Tipo Berline', 100),
(80, 'Fiat', 'Panda life', 70),
(81, 'Opel', 'Zafira-E Life', 136),
(82, 'Opel', 'Vivaro', 120),
(83, 'Opel', 'Mokka', 100),
(84, 'Opel', 'Crossland', 83),
(85, 'Opel', 'Movano', 135),
(86, 'Opel', 'Insignia Grand sport', 122),
(87, 'Opel', 'Grandland X', 225),
(88, 'Opel', 'Astra', 110),
(89, 'Opel', 'Combo Cargo', 110),
(90, 'Opel', 'Combo Life', 110),
(91, 'Opel', 'Corsa-E', 100),
(92, 'Audi', 'A1', 95),
(93, 'Audi', 'A3', 110),
(94, 'Audi', 'A4', 150),
(95, 'Audi', 'A5', 150),
(96, 'Audi', 'A6', 163),
(97, 'Audi', 'A7', 204),
(98, 'Audi', 'A8', 110),
(99, 'Audi', 'Q7', 381),
(100, 'Audi', 'Q8', 381),
(101, 'Audi', 'TT', 197),
(102, 'Audi', 'R8', 570),
(103, 'Renault', 'Talisman', 160),
(104, 'Renault', 'Espace', 160),
(105, 'Renault', 'Trafic Combi', 150),
(106, 'Renault', 'Kangoo', 100),
(107, 'Renault', 'Kadjar', 140),
(108, 'Renault', 'Clio', 140),
(109, 'Renault', 'Twingo E-tech', 81),
(110, 'Renault', 'Captur', 145),
(111, 'Renault', 'Megane E-tech hybride', 130),
(112, 'Renault', 'Megane Estate', 160),
(113, 'Renault', 'Arkana', 145),
(114, 'Renault', 'Scenic', 115),
(115, 'Renault', 'Koleos', 160),
(116, 'Nissan', 'Qashqai', 140),
(117, 'Mazda', '2', 90),
(118, 'Mazda', '3', 122),
(119, 'Mazda', '6', 194),
(120, 'Mazda', 'CX-30', 122),
(121, 'Mazda', 'CV-5', 165),
(122, 'Mazda', 'MV-30', 145),
(123, 'Volvo', 'C40', 408),
(124, 'Volvo', 'XC40', 231),
(125, 'Volvo', 'XC60', 197),
(126, 'Volvo', 'XC90', 235),
(127, 'Volvo', 'V60', 163),
(128, 'Volvo', 'V90', 197),
(129, 'Volvo', 'S60', 163);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
