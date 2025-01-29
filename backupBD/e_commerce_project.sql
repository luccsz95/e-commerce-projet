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
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `etat_du_ticket` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES (26,'admin@admin.fr','434c7f0cbbe0b064142188e56de11c31937caeafad203129331fbdba4bc85f5b','2025-01-27 16:02:06','2025-01-27 15:47:06',0),(27,'admin@admin.fr','a7d13157795d7115d6b4b51383b94c7ca65ed987761f3b586881ee3a0b9f415c','2025-01-27 16:02:18','2025-01-27 15:47:18',0),(28,'admin@admin.fr','cb2ebe3c1855b526d8b34f5d30f4785501f43ca250da705fcd8867c047807e59','2025-01-27 16:02:18','2025-01-27 15:47:18',0),(29,'admin@admin.fr','fb8df65c9f01e265d7ba098bc35bb69637a3ad0b043e9933c21ae2639f90437a','2025-01-27 16:02:19','2025-01-27 15:47:19',0),(30,'contact.kcc0@gmail.com','60edb422cd66da692ef3cf80d21ff109','2025-01-28 11:58:00','2025-01-28 11:43:00',1),(31,'contact.kcc0@gmail.com','1cd962691e7d75817d19c81f8e667740','2025-01-28 12:02:38','2025-01-28 11:47:38',1),(32,'contact.kcc0@gmail.com','22589e5135dcfff2cc6f83f2372ac9bf','2025-01-28 12:03:20','2025-01-28 11:48:20',1),(33,'contact.kcc0@gmail.com','8252da4c9dcdc62847096fb25147377d','2025-01-28 12:04:24','2025-01-28 11:49:24',1),(34,'contact.kcc0@gmail.com','191d07ab029942d9e49a3d7424d64659','2025-01-28 12:05:36','2025-01-28 11:50:36',1),(35,'contact.kcc0@gmail.com','e1f4937dc823a26cf0d74a0299dc47f8','2025-01-28 12:05:55','2025-01-28 11:50:55',1),(36,'contact.kcc0@gmail.com','978d9770851231e63a690527bf40f383','2025-01-28 12:11:11','2025-01-28 11:56:11',1),(37,'contact.kcc0@gmail.com','7a55729826c25931cf1aed82c11ea4a9','2025-01-28 12:12:12','2025-01-28 11:57:12',1),(38,'contact.kcc0@gmail.com','1947cd697aa027a6fd7d06b534dc017b','2025-01-28 12:12:44','2025-01-28 11:57:44',1),(39,'toto@gmail.com','c40e9b567b8b0583b259d4d1c43cde50','2025-01-28 12:13:52','2025-01-28 11:58:52',1),(40,'contact.kcc0@gmail.com','e43f3fd95031837d20775a95d99944a9','2025-01-28 12:14:51','2025-01-28 11:59:51',1),(41,'contact.kcc0@gmail.com','b51bf369b57f7f206980cd4f3a22d85a','2025-01-28 12:17:58','2025-01-28 12:02:58',1),(42,'contact.kcc0@gmail.com','d330d18763f98a9fcf18dd0c7eb048d2','2025-01-28 12:19:34','2025-01-28 12:04:34',1),(43,'contact.kcc0@gmail.com','74b62222c8a5485cb45f2999daea5062','2025-01-28 12:20:03','2025-01-28 12:05:03',1),(44,'contact.kcc0@gmail.com','e6b2781087fd361096028debc50fe03d','2025-01-28 12:25:05','2025-01-28 12:10:05',1),(45,'contact.kcc0@gmail.com','ddff52c3a81595182aeb19da2dbfd237','2025-01-28 12:26:41','2025-01-28 12:11:41',1),(46,'contact.kcc0@gmail.com','f7cd8e6100fd0fcb34c0e6caeedc6f0c','2025-01-28 12:40:42','2025-01-28 12:25:42',1),(47,'contact.kcc0@gmail.com','c42e1003258ef3906c3c4e8ee395a2e9','2025-01-28 12:53:50','2025-01-28 12:38:50',1),(48,'contact.kcc0@gmail.com','2858540409674a50f46335370e9807bb','2025-01-28 12:56:09','2025-01-28 12:41:09',1),(49,'e.commerceprojet@yahoo.fr','c73594df1a4a2b06290a3f7c154abbcc','2025-01-28 13:02:47','2025-01-28 12:47:47',1),(50,'lucascasenaz95@gmail.com','04215ac0c94638740e0cf9e25c0cbe82','2025-01-28 13:04:26','2025-01-28 12:49:26',1),(51,'lucascasenaz95@gmail.com','43ad39f226bf4e45aab7e1997a68f8b0','2025-01-28 13:06:27','2025-01-28 12:51:27',1),(52,'lucascasenaz95@gmail.com','c8ce5d55ce4c53f05987aa1e76aeab4e','2025-01-28 13:08:55','2025-01-28 12:53:55',1),(53,'lucascasenaz95@gmail.com','fcc824bc25e6961bbf4a280a12afd619','2025-01-28 13:09:54','2025-01-28 12:54:54',1),(54,'contact.kcc0@gmail.com','2b985f766bb7075c461cd1a15ca546e0','2025-01-28 13:10:29','2025-01-28 12:55:29',1),(55,'lucascasenaz95@gmail.com','b747ed402f7c04204f3c60f9c2adae33','2025-01-28 13:13:56','2025-01-28 12:58:56',1),(56,'lucascasenaz95@gmail.com','fdacb845e7dbe435070c6945643c0b26','2025-01-28 13:14:28','2025-01-28 12:59:28',1),(57,'casenazl95610@gmail.com','bd2d35c17d954a580e0cb89b1315198a','2025-01-28 14:18:08','2025-01-28 14:03:08',1),(58,'casenazl95@gmail.com','31b81445cf02eba1f8a5ef04f621348f','2025-01-28 14:22:14','2025-01-28 14:07:14',1),(59,'casenazl95@gmail.com','dae5d0a7353ad20e2aa0d4edcc4065be','2025-01-28 14:25:51','2025-01-28 14:10:51',1),(64,'casenazl95@gmail.com','e7cb30d52a7ad231953e69a676771b2d','2025-01-28 20:31:43','2025-01-28 20:16:43',1),(65,'lucascasenaz95@gmail.com','d221c6bd32adeeddc6ee9f7fcf701a42','2025-01-28 20:54:14','2025-01-28 20:39:14',1),(67,'lucascasenaz95@gmail.com','63b320bba9cf8b8ef93cd5315a750ab9','2025-01-29 10:26:34','2025-01-29 10:11:34',1);
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propreties`
--

DROP TABLE IF EXISTS `propreties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propreties` (
  `IdProprety` int(100) NOT NULL AUTO_INCREMENT,
  `TypeProprety` varchar(100) NOT NULL,
  `ConstructionYear` varchar(100) NOT NULL,
  `Surface` varchar(100) NOT NULL,
  `NbRoom` varchar(100) NOT NULL,
  `NbBedRoom` varchar(100) NOT NULL,
  `PropretyPrice` varchar(100) NOT NULL,
  PRIMARY KEY (`IdProprety`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propreties`
--

LOCK TABLES `propreties` WRITE;
/*!40000 ALTER TABLE `propreties` DISABLE KEYS */;
/*!40000 ALTER TABLE `propreties` ENABLE KEYS */;
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
  PRIMARY KEY (`idUser`)
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

-- Dump completed on 2025-01-29 10:38:44
