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
  `idUsers` int(11) NOT NULL,
  `adresseUsers` varchar(200) NOT NULL,
  PRIMARY KEY (`idAdresse`),
  KEY `index_isUsers` (`idUsers`),
  CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adresse`
--

LOCK TABLES `adresse` WRITE;
/*!40000 ALTER TABLE `adresse` DISABLE KEYS */;
INSERT INTO `adresse` VALUES (4,6,'666 rue de toto, TotoLand, 66666'),(6,6,'7 les 10 arpents mauves, Éragny, 95610'),(9,5,'75 rue des camions, Avions, 07800'),(10,5,'Tour Jumelle , Avion, 00911'),(11,5,' 3 rue de toto, totoland, 12345');
/*!40000 ALTER TABLE `adresse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animals` (
  `idAnimals` int(11) NOT NULL,
  `nameAnimals` varchar(100) NOT NULL,
  `typeAnimals` varchar(100) NOT NULL,
  `weightAnimals` varchar(100) NOT NULL,
  `colorAnimals` varchar(100) NOT NULL,
  `priceAnimals` decimal(5,2) NOT NULL,
  `imageAnimals` varchar(100) NOT NULL,
  PRIMARY KEY (`idAnimals`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animals`
--

LOCK TABLES `animals` WRITE;
/*!40000 ALTER TABLE `animals` DISABLE KEYS */;
INSERT INTO `animals` VALUES (1,'Wisky','Cat','5','Gray',24.99,''),(2,'Wiskas','Cat','3','White',24.99,''),(3,'John','Dog','20','Brown and White',25.99,''),(4,'Franklin','Turtle','0.5','Green',13.99,''),(5,'Frédérique','Cat','8','White and Black',24.99,''),(6,'Roger','Dog','4','Orange',25.99,''),(7,'Cerise','Dog','10','Orange',26.99,'');
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
  `idUsers` int(11) NOT NULL,
  `amount` decimal(5,2) NOT NULL,
  `commandDate` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`idCommand`),
  KEY `index_isUsers` (`idUsers`),
  CONSTRAINT `command_ibfk_1` FOREIGN KEY (`idUsers`) REFERENCES `users` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `command`
--

LOCK TABLES `command` WRITE;
/*!40000 ALTER TABLE `command` DISABLE KEYS */;
INSERT INTO `command` VALUES (1,6,0.00,'0000-00-00 00:00:00',''),(9,6,0.00,'0000-00-00 00:00:00',''),(10,6,25.99,'0000-00-00 00:00:00',''),(11,6,25.99,'0000-00-00 00:00:00',''),(12,6,25.99,'0000-00-00 00:00:00',''),(13,6,25.99,'0000-00-00 00:00:00',''),(14,6,25.99,'0000-00-00 00:00:00',''),(15,6,25.99,'0000-00-00 00:00:00',''),(16,6,25.99,'0000-00-00 00:00:00',''),(17,6,25.99,'0000-00-00 00:00:00',''),(18,6,25.99,'0000-00-00 00:00:00',''),(19,6,25.99,'0000-00-00 00:00:00',''),(20,6,25.99,'0000-00-00 00:00:00',''),(21,6,25.99,'0000-00-00 00:00:00',''),(22,6,25.99,'0000-00-00 00:00:00',''),(23,6,25.99,'0000-00-00 00:00:00',''),(24,6,25.99,'0000-00-00 00:00:00',''),(25,6,25.99,'0000-00-00 00:00:00',''),(26,6,25.99,'0000-00-00 00:00:00',''),(27,6,25.99,'0000-00-00 00:00:00',''),(28,6,49.98,'0000-00-00 00:00:00',''),(29,5,24.99,'0000-00-00 00:00:00',''),(30,5,24.99,'0000-00-00 00:00:00',''),(31,5,24.99,'0000-00-00 00:00:00',''),(32,5,24.99,'0000-00-00 00:00:00',''),(33,5,24.99,'0000-00-00 00:00:00',''),(34,5,24.99,'0000-00-00 00:00:00',''),(35,5,24.99,'0000-00-00 00:00:00',''),(36,5,24.99,'0000-00-00 00:00:00',''),(37,5,24.99,'0000-00-00 00:00:00',''),(38,5,24.99,'0000-00-00 00:00:00',''),(39,5,24.99,'0000-00-00 00:00:00',''),(40,5,24.99,'0000-00-00 00:00:00',''),(41,5,24.99,'0000-00-00 00:00:00',''),(42,5,24.99,'0000-00-00 00:00:00',''),(43,5,24.99,'0000-00-00 00:00:00',''),(44,5,24.99,'0000-00-00 00:00:00',''),(45,5,24.99,'0000-00-00 00:00:00',''),(46,5,24.99,'0000-00-00 00:00:00',''),(47,5,25.99,'0000-00-00 00:00:00',''),(48,5,13.99,'0000-00-00 00:00:00',''),(49,5,26.99,'0000-00-00 00:00:00',''),(50,5,25.99,'0000-00-00 00:00:00',''),(51,5,25.99,'0000-00-00 00:00:00',''),(52,5,25.99,'0000-00-00 00:00:00',''),(53,5,25.99,'0000-00-00 00:00:00',''),(54,5,25.99,'0000-00-00 00:00:00',''),(55,5,24.99,'0000-00-00 00:00:00',''),(56,5,24.99,'0000-00-00 00:00:00',''),(57,5,24.99,'0000-00-00 00:00:00',''),(58,5,88.96,'0000-00-00 00:00:00',''),(59,5,25.99,'0000-00-00 00:00:00',''),(60,5,13.99,'0000-00-00 00:00:00',''),(61,5,40.98,'0000-00-00 00:00:00',''),(62,5,65.97,'0000-00-00 00:00:00',''),(63,5,65.97,'0000-00-00 00:00:00',''),(64,5,65.97,'0000-00-00 00:00:00',''),(65,5,65.97,'0000-00-00 00:00:00',''),(66,5,25.99,'0000-00-00 00:00:00',''),(67,5,25.99,'0000-00-00 00:00:00',''),(68,5,25.99,'0000-00-00 00:00:00',''),(69,5,25.99,'0000-00-00 00:00:00',''),(70,5,25.99,'0000-00-00 00:00:00',''),(71,5,25.99,'0000-00-00 00:00:00',''),(72,5,25.99,'0000-00-00 00:00:00',''),(73,5,25.99,'0000-00-00 00:00:00',''),(74,5,25.99,'0000-00-00 00:00:00',''),(75,5,25.99,'0000-00-00 00:00:00',''),(76,5,25.99,'0000-00-00 00:00:00',''),(77,5,25.99,'0000-00-00 00:00:00',''),(78,5,25.99,'0000-00-00 00:00:00',''),(79,5,25.99,'0000-00-00 00:00:00',''),(80,5,25.99,'0000-00-00 00:00:00',''),(81,5,25.99,'0000-00-00 00:00:00',''),(82,6,13.99,'0000-00-00 00:00:00',''),(83,6,13.99,'0000-00-00 00:00:00',''),(84,6,13.99,'0000-00-00 00:00:00',''),(85,6,13.99,'0000-00-00 00:00:00',''),(86,6,26.99,'0000-00-00 00:00:00',''),(87,6,26.99,'0000-00-00 00:00:00',''),(88,6,26.99,'0000-00-00 00:00:00',''),(89,6,26.99,'0000-00-00 00:00:00',''),(90,6,26.99,'0000-00-00 00:00:00',''),(91,6,26.99,'0000-00-00 00:00:00',''),(92,6,26.99,'0000-00-00 00:00:00',''),(93,6,26.99,'0000-00-00 00:00:00',''),(94,6,26.99,'0000-00-00 00:00:00',''),(95,6,26.99,'0000-00-00 00:00:00',''),(96,6,26.99,'0000-00-00 00:00:00',''),(97,6,26.99,'0000-00-00 00:00:00',''),(98,6,26.99,'0000-00-00 00:00:00',''),(99,6,26.99,'0000-00-00 00:00:00',''),(100,6,26.99,'0000-00-00 00:00:00',''),(101,6,26.99,'0000-00-00 00:00:00',''),(102,6,26.99,'0000-00-00 00:00:00',''),(103,6,26.99,'0000-00-00 00:00:00',''),(104,6,26.99,'0000-00-00 00:00:00',''),(105,6,26.99,'0000-00-00 00:00:00','');
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
  `idAdresse` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`idDetails`),
  KEY `index_isCommand` (`idCommand`),
  KEY `index_isAnimals` (`idAnimals`),
  KEY `index_isAdresse` (`idAdresse`),
  CONSTRAINT `command_details_ibfk_1` FOREIGN KEY (`idAnimals`) REFERENCES `animals` (`idAnimals`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `command_details_ibfk_2` FOREIGN KEY (`idCommand`) REFERENCES `command` (`idCommand`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `command_details_ibfk_3` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`idAdresse`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `command_details`
--

LOCK TABLES `command_details` WRITE;
/*!40000 ALTER TABLE `command_details` DISABLE KEYS */;
INSERT INTO `command_details` VALUES (32,57,2,10,0),(33,58,1,10,0),(34,58,2,10,0),(35,58,4,10,0),(36,58,5,10,0),(37,59,3,10,0),(38,60,4,10,0),(39,61,4,10,0),(40,61,7,10,0),(41,62,4,10,0),(42,62,7,10,0),(43,62,2,10,0),(44,63,4,10,0),(45,63,7,10,0),(46,63,2,10,0),(47,64,4,10,0),(48,64,7,10,0),(49,64,2,10,0),(50,65,4,10,0),(51,65,7,10,0),(52,65,2,10,0),(53,66,3,10,0),(54,67,3,10,0),(60,88,7,6,0),(61,89,7,6,0),(62,90,7,6,0),(63,91,7,6,0),(64,92,7,6,0),(65,93,7,6,0),(66,94,7,6,0),(67,95,7,6,0),(68,96,7,6,0),(69,97,7,6,0),(70,98,7,6,0),(71,99,7,6,0),(72,100,7,6,0),(73,101,7,6,0),(74,102,7,6,0),(75,103,7,6,0),(76,104,7,6,0),(77,105,7,4,0);
/*!40000 ALTER TABLE `command_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `idAnimals` int(11) NOT NULL,
  `nameAnimals` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `comment` varchar(512) NOT NULL,
  `note` float NOT NULL,
  `dateComment` date NOT NULL,
  PRIMARY KEY (`idComment`),
  KEY `comments_ibfk_1` (`idAnimals`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idAnimals`) REFERENCES `animals` (`idAnimals`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (5,1,'Wisky','toto','Wisky me tient chaud toute la nuit !',5,'2025-02-25');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `expires_at` datetime NOT NULL,
  `etat_du_ticket` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `index_email` (`email`),
  CONSTRAINT `fk_EMAIL` FOREIGN KEY (`email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
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
INSERT INTO `users` VALUES (0,'admin','admin','e.commerce.project.insta@gmail.com','$2y$10$ZfNh.DCnEEXMU/XUadhpn.GEk.fE93P/r94VRe8Z8VuJJvqj7CvDm','0000000000','1','aba3c8edb1591a74158e8f3a76d34f71','2025-02-21 10:35:19',''),(5,'Lucas','Casenaz','lucascasenaz95@gmail.com','$2y$10$apZhfHJo2/wSw1nWWLd76OHzwQhqMUC/hDargfT1EAyqcdjquU/nm','0601265927','1','a42ff27f78cd40d19b166de1ea587cc0','2025-02-21 11:15:46',''),(6,'toto','toto','casenazl95@gmail.com','$2y$10$WC.IeQ0wKhPfR2hdvBUWZeWCyHrOds56kweyqNNtQt/1/tTlyx/mi','0741852963','1','0cf23cde0b8618f54dcb126bffd55238','2025-02-21 11:27:35','');
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

-- Dump completed on 2025-02-28 12:51:17
