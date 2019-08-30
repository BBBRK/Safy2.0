-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 30 août 2019 à 07:52
-- Version du serveur :  10.2.14-MariaDB
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `safy`
--

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_Facture` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_Facture` date DEFAULT NULL,
  `id_Moto` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_Facture`),
  KEY `FK_Facture_id_Moto` (`id_Moto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `description` varchar(400) NOT NULL,
  `date` date NOT NULL,
  `km` int(11) NOT NULL,
  `prix` int(4) NOT NULL,
  `id_moto` bigint(50) NOT NULL,
  `id_operation` bigint(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_moto` (`id_moto`),
  KEY `id_operation` (`id_operation`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`id`, `description`, `date`, `km`, `prix`, `id_moto`, `id_operation`) VALUES
(28, 'purge', '2019-07-12', 0, 100, 24, 3),
(29, 'Huile 5w30 Castrol + filtre à huile', '2019-08-26', 6000, 80, 24, 2),
(32, 'ezezezeze', '2019-06-14', 4000, 100, 28, 2),
(33, 'pneu arr', '2018-10-27', 5000, 150, 28, 5);

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `id_Marque` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_Marque` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_Marque`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id_Marque`, `nom_Marque`) VALUES
(1, 'Suzuki'),
(2, 'Yamaha'),
(3, 'Kawasaki'),
(4, 'Honda'),
(5, 'Ducati'),
(6, 'Aprilia'),
(7, 'Triumph'),
(8, 'Harley-Davidson'),
(9, 'Indian'),
(10, 'KTM'),
(11, 'Husqvarna'),
(12, 'BMW'),
(13, 'Moto-Guzzy'),
(14, 'MV-Agusta');

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `id_Modele` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_Modele` char(40) DEFAULT NULL,
  `id_Marque` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_Modele`),
  KEY `FK_Modele_id_Marque` (`id_Marque`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `modele`
--

INSERT INTO `modele` (`id_Modele`, `nom_Modele`, `id_Marque`) VALUES
(1, 'Multistrada 650', 5),
(2, 'Multistrada 950', 5),
(3, 'Multistrada 1000', 5),
(4, 'Multistrada 1100', 5),
(5, 'Multistrada 1200', 5),
(6, 'Multistrada DVT', 5),
(7, 'V-Strom', 1),
(8, 'Xdiavel', 5),
(9, 'Bandit 600', 1);

-- --------------------------------------------------------

--
-- Structure de la table `moto`
--

DROP TABLE IF EXISTS `moto`;
CREATE TABLE IF NOT EXISTS `moto` (
  `id_Moto` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_circu_Moto` date DEFAULT NULL,
  `km_Moto` bigint(20) DEFAULT NULL,
  `date_modif` date NOT NULL,
  `id_Proprietaire` bigint(20) DEFAULT NULL,
  `id_Modele` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_Moto`),
  KEY `FK_Moto_id_Proprietaire` (`id_Proprietaire`),
  KEY `FK_Moto_id_Modele` (`id_Modele`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `moto`
--

INSERT INTO `moto` (`id_Moto`, `date_circu_Moto`, `km_Moto`, `date_modif`, `id_Proprietaire`, `id_Modele`) VALUES
(24, '2012-02-10', 10000, '2019-08-26', 19, 3),
(28, '2019-08-08', 6000, '2019-08-29', 19, 9);

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

DROP TABLE IF EXISTS `operation`;
CREATE TABLE IF NOT EXISTS `operation` (
  `id` bigint(50) NOT NULL AUTO_INCREMENT,
  `type` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`id`, `type`) VALUES
(1, 'Révision constructeur'),
(2, 'Vidange'),
(3, 'Purge liquide de frein'),
(4, 'Pneu avant'),
(5, 'Pneu arrière'),
(6, 'Kit chaine'),
(7, 'Plaquettes de frein avant'),
(8, 'Plaquettes de frein arrière'),
(9, 'Autre ...');

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

DROP TABLE IF EXISTS `proprietaire`;
CREATE TABLE IF NOT EXISTS `proprietaire` (
  `id_Proprietaire` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_Proprietaire` char(50) DEFAULT NULL,
  `prenom_Proprietaire` char(50) DEFAULT NULL,
  `age_Proprietaire` int(11) DEFAULT NULL,
  `mail_Proprietaire` char(50) DEFAULT NULL,
  `verification_key` varchar(60) NOT NULL,
  `pw_Proprietaire` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_Proprietaire`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `proprietaire`
--

INSERT INTO `proprietaire` (`id_Proprietaire`, `nom_Proprietaire`, `prenom_Proprietaire`, `age_Proprietaire`, `mail_Proprietaire`, `verification_key`, `pw_Proprietaire`) VALUES
(9, 'Gressier', 'Jimmy', 26, 'test@test.fr', '0', '$2y$10$5Xjh75Y788J1obmcF2Gx3.d/5xqLgveWOBedYwFTXVpjK.b1yq//C'),
(10, 'Gressier', 'Jimmy', 26, 'testy@test.fr', '0', '$2y$10$2swJyBeqw0dhjKJOaCCmNOY5FYVOjaxyVDwh.YCYI/F9XQDQWPvD2'),
(11, 'Gressier', 'Jimmy', 26, 'test1@test.fr', '43', '$2y$10$MPof9mbeVU0/Z8P5WmUWaulYpSQT5h1P/HVbm8o02HbVAmPyLTERm'),
(12, 'Gressier', 'Jimmy', 26, 'test2@test.fr', '2', '$2y$10$kaIY/2m0eOmgzCs4RLJqmOyz8mK8aAg8E41oxMk9V7o8jXAJKGgpK'),
(13, 'Gressier', 'Jimmy', 26, 'test@test.fr2', '0', '$2y$10$ivb.Yf09w9GeC/KCNyDfIuCRuTrMhw24/OT7oHVKDgojqPxzUvbra'),
(14, 'Gressier', 'Jimmy', 26, 'test3@test.fr', '3682', '$2y$10$YDDn/AQwysEaGVA.sPjT/OrXHCi7VQ8ts8RNEMmFdrzBh2vpf8SAa'),
(15, 'Gressier', 'Jimmy', 26, 'test4@test.fr', '40', '$2y$10$rjje0qm3GxfHeYmjhik6qORYHS9UacvsZDY3OktWLgtWdcNOxqZji'),
(16, 'Gressier', 'Jimmy', 26, 'test5@test.fr', '6', '$2y$10$ZVLnNgHBAUSl/vvfgmOJtu8JRXCs0W/wS.dJGfrxxtCuQNoJESDhq'),
(18, 'Gressier', 'Jimmy', 26, 'test6@test.fr', '6831ab444b45f5312c66de7df52ae0f1', '$2y$10$98P3iDy.6T1VRr/I4TRNzeAN8X/dqYhGUuVuXtDCn4EEBkn0lsshS'),
(19, 'Gressier', 'Jimmy', 26, 'jimg@laposte.net', '4fff3a6fb62d604406d64af3e9e3aa8f', '$2y$10$PR/pJsn9HqAr0BUeuDnI9ubsgiBFqI5u2ZQ9gBFkTYlEnHsxUhgQq'),
(21, 'sqlzzzz', 'test', 41, 'sql@hotmail.fr', '565312551163b100b058ede8319b886f', '$2y$10$QPXrGdhVg2HfVMPuKqNlA.vEOZW1Fng21oCXyPLoIlDFxZ4Py6EUq'),
(22, 'gressier', 'jimmy', 26, 'wxcv@hotmail.fr', '72615fb8d09a1a330d72ee21e15f14e9', '$2y$10$WVw9vacoE3TB.UbDvHzQ7OtNxFb8cMSZQOU2KCDKOCtNOS10hQRlS'),
(29, 'medina', 'stephane', 0, 'steph@hotmail.fr', '', '$2y$10$FjKrkxRH0/LL7nTo10z13uoDkc6O6X62SFR6Kx9Wkr7Y.BP.1MZM.');

-- --------------------------------------------------------

--
-- Structure de la table `revision_constructeur`
--

DROP TABLE IF EXISTS `revision_constructeur`;
CREATE TABLE IF NOT EXISTS `revision_constructeur` (
  `id` bigint(50) NOT NULL AUTO_INCREMENT,
  `id_model` bigint(50) NOT NULL,
  `id_seuils_km` bigint(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_model` (`id_model`),
  KEY `id_seuils_km` (`id_seuils_km`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `seuils_km`
--

DROP TABLE IF EXISTS `seuils_km`;
CREATE TABLE IF NOT EXISTS `seuils_km` (
  `id` bigint(50) NOT NULL AUTO_INCREMENT,
  `description` varchar(400) NOT NULL,
  `km` varchar(20) NOT NULL,
  `prix` bigint(10) NOT NULL,
  `id_model` bigint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `FK_Facture_id_Moto` FOREIGN KEY (`id_Moto`) REFERENCES `moto` (`id_Moto`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `id_moto_fk` FOREIGN KEY (`id_moto`) REFERENCES `moto` (`id_Moto`),
  ADD CONSTRAINT `id_operation_fk` FOREIGN KEY (`id_operation`) REFERENCES `operation` (`id`);

--
-- Contraintes pour la table `modele`
--
ALTER TABLE `modele`
  ADD CONSTRAINT `FK_Modele_id_Marque` FOREIGN KEY (`id_Marque`) REFERENCES `marque` (`id_Marque`);

--
-- Contraintes pour la table `moto`
--
ALTER TABLE `moto`
  ADD CONSTRAINT `FK_Moto_id_Modele` FOREIGN KEY (`id_Modele`) REFERENCES `modele` (`id_Modele`),
  ADD CONSTRAINT `FK_Moto_id_Proprietaire` FOREIGN KEY (`id_Proprietaire`) REFERENCES `proprietaire` (`id_Proprietaire`);

--
-- Contraintes pour la table `revision_constructeur`
--
ALTER TABLE `revision_constructeur`
  ADD CONSTRAINT `id_model_fk` FOREIGN KEY (`id_model`) REFERENCES `modele` (`id_Modele`),
  ADD CONSTRAINT `id_seuils_km_fk` FOREIGN KEY (`id_seuils_km`) REFERENCES `seuils_km` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
