-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: e_commerce_project
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adresse` (
  `idAdresse` int(11) NOT NULL AUTO_INCREMENT,
  `idUsers` int(30) NOT NULL,
  `adresseUsers` varchar(200) NOT NULL,
  PRIMARY KEY (`idAdresse`),
  UNIQUE KEY `unique_isUsers` (`idUsers`),
  CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adresse`
--

LOCK TABLES `adresse` WRITE;
/*!40000 ALTER TABLE `adresse` DISABLE KEYS */;
/*!40000 ALTER TABLE `adresse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animals` (
  `idAnimals` int(100) NOT NULL AUTO_INCREMENT,
  `nameAnimals` varchar(100) NOT NULL,
  `typeAnimals` varchar(100) NOT NULL,
  `weightAnimals` varchar(100) NOT NULL,
  `colorAnimals` varchar(100) NOT NULL,
  `priceAnimals` decimal(5,2) NOT NULL,
  PRIMARY KEY (`idAnimals`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animals`
--

LOCK TABLES `animals` WRITE;
/*!40000 ALTER TABLE `animals` DISABLE KEYS */;
INSERT INTO `animals` VALUES (1,'Wisky','Cat','5','Gray',24.99),(2,'Wiskas','Cat','3','White',24.99),(3,'John','Dog','20','Brown and White',25.99),(4,'Franklin','Turtle','0.5','Green',13.99),(5,'Frédérique','Cat','8','White and Black',24.99),(6,'Roger','Dog','4','Orange',25.99),(7,'Cerise','Dog','10','Orange',26.99);
/*!40000 ALTER TABLE `animals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `command`
--

DROP TABLE IF EXISTS `command`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `command` (
  `idCommand` int(11) NOT NULL AUTO_INCREMENT,
  `idUsers` int(30) NOT NULL,
  `amount` decimal(5,2) NOT NULL,
  `commandDate` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`idCommand`),
  UNIQUE KEY `unique_isUsers` (`idUsers`) USING BTREE,
  CONSTRAINT `command_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `command`
--

LOCK TABLES `command` WRITE;
/*!40000 ALTER TABLE `command` DISABLE KEYS */;
/*!40000 ALTER TABLE `command` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `command_details`
--

DROP TABLE IF EXISTS `command_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `command_details` (
  `idDetails` int(11) NOT NULL AUTO_INCREMENT,
  `idCommand` int(11) NOT NULL,
  `idAnimals` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(5,3) NOT NULL,
  PRIMARY KEY (`idDetails`),
  UNIQUE KEY `unique_idAnimals` (`idAnimals`) USING BTREE,
  UNIQUE KEY `unique_command` (`idCommand`) USING BTREE,
  CONSTRAINT `command_details_ibfk_1` FOREIGN KEY (`idAnimals`) REFERENCES `animals` (`idAnimals`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `command_details_ibfk_2` FOREIGN KEY (`idCommand`) REFERENCES `command` (`idCommand`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `command_details`
--

LOCK TABLES `command_details` WRITE;
/*!40000 ALTER TABLE `command_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `command_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `idComment` int(100) NOT NULL AUTO_INCREMENT,
  `idAnimals` int(11) NOT NULL,
  `nameAnimals` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `comment` varchar(512) NOT NULL,
  `note` float NOT NULL,
  `dateComment` date NOT NULL,
  PRIMARY KEY (`idComment`),
  UNIQUE KEY `unique_idAnimals` (`idAnimals`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idAnimals`) REFERENCES `animals` (`idAnimals`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (4,2,'Wiskas','toto','TROP BIEN !!!',5,'2025-02-24');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `expires_at` datetime NOT NULL,
  `etat_du_ticket` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_email` (`email`),
  CONSTRAINT `fk_EMAIL` FOREIGN KEY (`email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idUser` int(30) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `etat_du_token` varchar(100) DEFAULT '0',
  `token` varchar(100) NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT current_timestamp(),
  `adresseUsers` varchar(200) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'admin','admin','e.commerce.project.insta@gmail.com','$2y$10$ZfNh.DCnEEXMU/XUadhpn.GEk.fE93P/r94VRe8Z8VuJJvqj7CvDm','0000000000','1','aba3c8edb1591a74158e8f3a76d34f71','2025-02-21 10:35:19',''),(5,'Lucas','Casenaz','lucascasenaz95@gmail.com','$2y$10$Vk8VWUlFlk3tYYLm1j07CeDrIEIc7tnKnAb2hWVxphxehk..Xy6rm','0601265927','1','a42ff27f78cd40d19b166de1ea587cc0','2025-02-21 11:15:46',''),(6,'toto','toto','casenazl95@gmail.com','$2y$10$WC.IeQ0wKhPfR2hdvBUWZeWCyHrOds56kweyqNNtQt/1/tTlyx/mi','0741852963','1','0cf23cde0b8618f54dcb126bffd55238','2025-02-21 11:27:35','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-24 12:48:03
