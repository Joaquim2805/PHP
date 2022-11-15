-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.26 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour gestion_badminton
CREATE DATABASE IF NOT EXISTS `gestion_badminton` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016  */;
USE `gestion_badminton`;

-- Listage de la structure de la table gestion_badminton. match
CREATE TABLE IF NOT EXISTS `match` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Id_reservation` int NOT NULL DEFAULT '0',
  `Id_joueur1` int DEFAULT NULL,
  `Id_joueur2` int DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
);

-- Listage de la structure de la table gestion_badminton. terrain
CREATE TABLE IF NOT EXISTS `terrain` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom_terrain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` tinyint(1) NOT NULL,
  `disponibilite` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
);

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table gestion_badminton. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `civilite` tinyint(1) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  CHECK (year(NOW() - date_naissance) > 17 )
);

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table gestion_badminton. reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `id_joueur` int NOT NULL,
  `id_terrain` int NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_match_reservation_utilisateur` (`id_joueur`),
  KEY `FK_match_reservation_terrain` (`id_terrain`),
  CONSTRAINT `FK_match_reservation_terrain` FOREIGN KEY (`id_terrain`) REFERENCES `terrain` (`ID`),
  CONSTRAINT `FK_match_reservation_utilisateur` FOREIGN KEY (`id_joueur`) REFERENCES `utilisateur` (`ID`)
);

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table gestion_badminton. set
CREATE TABLE IF NOT EXISTS `set` (
  `Id_match` int DEFAULT NULL,
  `numero_set` int DEFAULT NULL,
  `score1` int DEFAULT NULL,
  `score2` int DEFAULT NULL
);

-- Les données exportées n'étaient pas sélectionnées.


-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
