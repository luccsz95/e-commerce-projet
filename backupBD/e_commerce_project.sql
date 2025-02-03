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
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animals` (
  `idAnimals` int(100) NOT NULL AUTO_INCREMENT,
  `nameAnimals` varchar(100) NOT NULL,
  `raceAnimals` varchar(100) NOT NULL,
  `genderAnimals` varchar(100) NOT NULL,
  `typeAnimals` varchar(100) NOT NULL,
  `bithdayAnimals` date NOT NULL,
  `weight Animals` varchar(100) NOT NULL,
  `colorAnimals` varchar(100) NOT NULL,
  `priceAnimals` varchar(100) NOT NULL,
  PRIMARY KEY (`idAnimals`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animals`
--

LOCK TABLES `animals` WRITE;
/*!40000 ALTER TABLE `animals` DISABLE KEYS */;
INSERT INTO `animals` VALUES (1,'Eclipse','British Shorthair','Female','Cat','0000-00-00','5','Black','9 999 999 999 999'),(2,'Fluffy','Persian','Female','Cat','0000-00-00','3','Orange','3500'),(3,'Woody','Beagle','Male','Dog','0000-00-00','20','Brown and White','2400'),(4,'Franklin','Turtle','Male','Turtle','0000-00-00','0.5','Green','150'),(5,'Phoebe','Stray Cat','Female','Cat','0000-00-00','8','White and Black','3400'),(6,'Elphie','Corgi','Female','Dog','0000-00-00','4','Orange','2500'),(7,'Valentine','Corgi','Female','Dog','0000-00-00','10','Orange','2500');
/*!40000 ALTER TABLE `animals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `expires_at` datetime NOT NULL,
  `etat_du_ticket` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  CONSTRAINT `fk_EMAIL` FOREIGN KEY (`email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `etat_du_token` varchar(100) DEFAULT '0',
  `token` varchar(100) NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'admin','admin','admin@admin.fr','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918','0','0','','2025-01-29 09:14:29'),(82,'toto','toto','toto@gmail.com','$2y$10$164QE43.5Lnma6T9IA.cWeB/9xewgHFHTRU9FHImUWAebjhQYdtMG','0123456789','0','','2025-01-29 09:14:29'),(83,'test','test','charles@gmail.com','$2y$10$kPLsIvYQ30tfQK5MXMtnYO66KnYb0.VF4MUfATPNNqSete/C2V3yO','0258741369','0','','2025-01-29 09:14:29'),(86,'Jean Pierre','Pernaut','e.commerceprojet@yahoo.fr','$2y$10$pyk2Nkl2xm6A4XfzfvXZxOMzwdenhw3IZLzowNYYtP8RQ2G5vwW0K','0852741963','0','','2025-01-29 09:14:29'),(106,'test','toto','casenazl95@gmail.com','$2y$10$G.Ba4IAm5aYw81cIhPpHfePK797JivCajc1Kem6fhDKgfz6UX..zS','0258741369','1','a8b31b395de528f61270bbafdd4a5c65','2025-01-29 09:14:29'),(112,'Lucas','Casenaz','lucascasenaz95@gmail.com','$2y$10$9OvY7bolbRjax5M8ho..ZOgdPG.70mkQFmBbS36hXBUx4H41iVYT.','0101010101','1','ad9f6139e1928d98e28b13e2f468242b','2025-01-29 10:09:12');
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

-- Dump completed on 2025-02-03 15:58:47
