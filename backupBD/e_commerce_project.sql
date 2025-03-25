-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 24 mars 2025 à 11:48
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e_commerce_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `idAdresse` int NOT NULL AUTO_INCREMENT,
  `idUsers` int NOT NULL,
  `adresseUsers` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idAdresse`),
  KEY `index_isUsers` (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`idAdresse`, `idUsers`, `adresseUsers`) VALUES
(4, 6, '4 rue de tata, Tataland, 44444'),
(11, 5, '75 rue des camions, Avions, 07800'),
(15, 6, '14 rue de des étoiles, Jupiter, 14520'),
(16, 5, '123 toto, Totoland , 12345');

-- --------------------------------------------------------

--
-- Structure de la table `animals`
--

DROP TABLE IF EXISTS `animals`;
CREATE TABLE IF NOT EXISTS `animals` (
  `idAnimals` int NOT NULL AUTO_INCREMENT,
  `nameAnimals` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `typeAnimals` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `weightAnimals` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `colorAnimals` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `priceAnimals` decimal(5,2) NOT NULL,
  `imageAnimals` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idAnimals`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animals`
--

INSERT INTO `animals` (`idAnimals`, `nameAnimals`, `typeAnimals`, `weightAnimals`, `colorAnimals`, `priceAnimals`, `imageAnimals`) VALUES
(1, 'Wisky', 'Chat', '5', 'Orange', 27.99, 'imageAnimals/wisky.png'),
(2, 'Wiskas', 'Chat', '3', 'Gris', 24.99, 'imageAnimals/wiskas.png'),
(3, 'John', 'Chiens', '20', 'Brown and White', 25.99, 'imageAnimals/john.png'),
(4, 'Franklin', 'Tortue', '0.5', 'Green', 13.99, 'imageAnimals/franklin.png'),
(5, 'Frédérique', 'Chat', '8', 'Black', 24.99, 'imageAnimals/frédérique.png'),
(6, 'Roger', 'Chiens', '4', 'Black', 25.99, 'imageAnimals/roger.png'),
(7, 'Cerise', 'Chiens', '10', 'Black and White', 26.99, 'imageAnimals/cerise.png'),
(8, 'Charlotte', 'Chiens', '0.35', 'Noir, blanc et orange', 23.99, 'imageAnimals/charlotte.png'),
(9, 'Michel', 'Lapin', '12', 'Violet', 23.99, 'imageAnimals/michel.png'),
(10, 'Addie', 'Panda', '15', 'Noir et Blanc', 19.99, 'imageAnimals/addie.png');

-- --------------------------------------------------------

--
-- Structure de la table `command`
--

DROP TABLE IF EXISTS `command`;
CREATE TABLE IF NOT EXISTS `command` (
  `idCommand` int NOT NULL AUTO_INCREMENT,
  `idUsers` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `commandDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idCommand`),
  KEY `index_isUsers` (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `command`
--

INSERT INTO `command` (`idCommand`, `idUsers`, `amount`, `commandDate`, `status`) VALUES
(132, 5, 88.96, '2025-03-12 12:27:51', ''),
(133, 5, 27.99, '2025-03-12 15:49:40', ''),
(141, 5, 311.88, '2025-03-12 16:05:45', ''),
(142, 5, 285.89, '2025-03-12 19:37:36', '');

-- --------------------------------------------------------

--
-- Structure de la table `command_details`
--

DROP TABLE IF EXISTS `command_details`;
CREATE TABLE IF NOT EXISTS `command_details` (
  `idDetails` int NOT NULL AUTO_INCREMENT,
  `idCommand` int NOT NULL,
  `idAnimals` int NOT NULL,
  `idAdresse` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`idDetails`),
  KEY `index_isCommand` (`idCommand`),
  KEY `index_isAnimals` (`idAnimals`),
  KEY `index_isAdresse` (`idAdresse`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `command_details`
--

INSERT INTO `command_details` (`idDetails`, `idCommand`, `idAnimals`, `idAdresse`, `quantity`) VALUES
(114, 133, 1, 11, 1),
(115, 141, 3, 11, 3),
(116, 141, 1, 11, 3),
(117, 141, 9, 11, 6);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `idComment` int NOT NULL AUTO_INCREMENT,
  `idAnimals` int NOT NULL,
  `nameAnimals` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `comment` varchar(512) COLLATE utf8mb4_general_ci NOT NULL,
  `note` float NOT NULL,
  `dateComment` date NOT NULL,
  PRIMARY KEY (`idComment`),
  KEY `comments_ibfk_1` (`idAnimals`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`idComment`, `idAnimals`, `nameAnimals`, `firstname`, `comment`, `note`, `dateComment`) VALUES
(5, 1, 'Wisky', 'toto', 'Wisky me tient chaud toute la nuit !', 5, '2025-02-25'),
(6, 3, 'John', 'toto', 'Je pense que John est vraiment une bonne peluche. Elle est très ressemblante à un vrai bigle, et elle est aussi très agréable une fois en main. Je recommande très fortement !', 5, '2025-03-05'),
(28, 2, 'Wiskas', 'Lucas', 'La peluche est vraiment drôle ! Puis avec son nom, elle me fait penser à la pub de croquette pour chat XD', 5, '2025-03-12'),
(29, 1, 'Wisky', 'Lucas', 'La peluche aurait été parfait si il ne lui manquais pas un bras, et si elle avait des yeux... \r\nMais dans l\'ensemble, c\'est un bon produit.', 3, '2025-03-12');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` datetime NOT NULL,
  `etat_du_ticket` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phonenumber` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `etat_du_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT '0',
  `token` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adresseUsers` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `firstname`, `lastname`, `email`, `password`, `phonenumber`, `etat_du_token`, `token`, `date_inscription`, `adresseUsers`) VALUES
(0, 'admin', 'admin', 'e.commerce.project.insta@gmail.com', '$2y$10$ZfNh.DCnEEXMU/XUadhpn.GEk.fE93P/r94VRe8Z8VuJJvqj7CvDm', '0000000000', '1', 'aba3c8edb1591a74158e8f3a76d34f71', '2025-02-21 10:35:19', ''),
(5, 'Lucas', 'Casenaz', 'lucascasenaz95@gmail.com', '$2y$10$apZhfHJo2/wSw1nWWLd76OHzwQhqMUC/hDargfT1EAyqcdjquU/nm', '1485718510', '1', 'a42ff27f78cd40d19b166de1ea587cc0', '2025-02-21 11:15:46', ''),
(6, 'toto', 'toto', 'casenazl95@gmail.com', '$2y$10$.qlxd3B6DMULe9PAXZYL6ugojMiovREsuzpkUiYoKS.qiZx8/972u', '0741852963', '1', '0cf23cde0b8618f54dcb126bffd55238', '2025-02-21 11:27:35', '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `command_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`idUser`);

--
-- Contraintes pour la table `command_details`
--
ALTER TABLE `command_details`
  ADD CONSTRAINT `command_details_ibfk_1` FOREIGN KEY (`idAnimals`) REFERENCES `animals` (`idAnimals`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `command_details_ibfk_2` FOREIGN KEY (`idCommand`) REFERENCES `command` (`idCommand`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `command_details_ibfk_3` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`idAdresse`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idAnimals`) REFERENCES `animals` (`idAnimals`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `fk_EMAIL` FOREIGN KEY (`email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
