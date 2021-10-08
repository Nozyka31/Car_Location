-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 06 oct. 2021 à 10:25
-- Version du serveur :  5.7.33
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


DROP TABLE IF EXISTS `contract`;
DROP TABLE IF EXISTS `messages`;
DROP TABLE IF EXISTS `announce`;
DROP TABLE IF EXISTS `cars`;
DROP TABLE IF EXISTS `users`;

--
-- Base de données : `location-de-voiture`
--


-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 NOT NULL,
  `role` varchar(100) CHARACTER SET utf8 NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `city` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `phone` varchar(25) CHARACTER SET utf8 NOT NULL,
  `rate` float NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) CHARACTER SET utf8 NOT NULL,
  `model` varchar(50) CHARACTER SET utf8 NOT NULL,
  `power` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Structure de la table `announce`
--

CREATE TABLE IF NOT EXISTS `announce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `registration_number` varchar(100) CHARACTER SET utf8 NOT NULL,
  `brand` varchar(50) CHARACTER SET utf8 NOT NULL,
  `model` varchar(50) CHARACTER SET utf8 NOT NULL,
  `color` varchar(50) CHARACTER SET utf8 NOT NULL,
  `power` int(11) DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 NOT NULL,
  `km` int(11) NOT NULL,
  `daily_price` int(11) NOT NULL,
  `picture` varchar(50) CHARACTER SET utf8 NULL,
  `year` INT NOT NULL,
  `rate` float NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_announce` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `previous_message_date` date NOT NULL,
  `announce_id` int(11) NOT NULL,
  `message` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sender_message` (`sender_id`),
  KEY `fk_receiver_message` (`receiver_id`),
  KEY `fk_announce_id` (`announce_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Structure de la table `contract`
--

CREATE TABLE IF NOT EXISTS `contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `renter_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `registration_number` varchar(100) CHARACTER SET utf8 NOT NULL,
  `start_date` datetime NOT NULL,
  `estimated_end` datetime NOT NULL,
  `reel_end` datetime NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_contract` (`user_id`),
  KEY `fk_users_renter_contract` (`renter_id`),
  KEY `fk_cars_contract` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;


--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `announce`
--
ALTER TABLE `announce`
  ADD CONSTRAINT `fk_users_announce` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `fk_cars_contract` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `fk_users_contract` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_users_renter_contract` FOREIGN KEY (`renter_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_announce_id` FOREIGN KEY (`announce_id`) REFERENCES `announce` (`id`),
  ADD CONSTRAINT `fk_receiver_message` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_sender_message` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);
COMMIT;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 NOT NULL,
  `role` varchar(100) CHARACTER SET utf8 NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `city` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `phone` varchar(25) CHARACTER SET utf8 NOT NULL,
  `rate` float NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `username`, `password`, `role`, `birthday`, `address`, `city`, `postal_code`, `phone`, `rate`)
/*Pour le prix : prix d'origine */
VALUES
  ('1', 'yoyo@gmail.com', 'Yoan', 'VolksWagen', 'Polo', '$argon2id$v=19$m=65536,t=4,p=1$LjRtZTBWSkFyOWguZno5Rw$XUjHTww6IYGb8r6PmaOA/4AuCxE1KSNIAH2FcOhCuXY', 'USER', '11/03/1965', '11 boulevard Niel', 'Muret', '31600', '0561561147', '4.5');

INSERT INTO `announce` (`id`, `user_id`, `title`, `registration_number`, `brand`, `model`, `color`, `power`, `city`, `km`, `daily_price`, `picture`, `year`, `rate`)
/*Pour le prix : prix d'origine */
VALUES
  ('1', '1', 'Ma bagnole', 'YV-593-OB', 'VolksWagen', 'Polo', 'gris cendré', '80ch', 'Toulouse', '200000', '16', '', '2011', '4.5');
