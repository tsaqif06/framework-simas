-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: test_fw
-- ------------------------------------------------------
-- Server version 	8.0.30
-- Date: Tue, 21 Nov 2023 02:35:16 +0100

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `products`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `products` VALUES (3,'Saturn','c5da1c9fe220e2e16a51.jpeg','2023-10-19 04:02:44','2023-10-20 02:34:03',NULL),(4,'Stamford Bridge','a8d363d4cc1991474f30.jpeg','2023-10-19 04:03:31','2023-10-20 02:33:35',NULL),(5,'Earth','059ee4a27bdab4591711.jpg','2023-10-20 02:38:16','2023-10-20 02:38:35','2023-10-20 09:38:48'),(6,'test','11ba462e3c49563b0b97.png','2023-10-20 03:44:17','2023-10-20 04:06:36','2023-10-20 11:06:40'),(7,'Sunset','99739e2104c8067fae51.jpeg','2023-10-20 07:03:54','2023-11-20 04:10:44',NULL),(8,'sapi','cd8580b26eaacb4f12c3.png','2023-10-20 07:09:29','2023-10-20 07:09:38',NULL),(9,'we won champions league','73e9d3d4878dd5cedb06.jpeg','2023-10-20 07:19:57','2023-10-20 07:20:32',NULL),(10,'Code','d060a38f24bec7913774.png','2023-11-20 04:06:23',NULL,'2023-11-20 10:10:48'),(11,'sad','388dc01608e79194938f.png','2023-11-20 04:07:26',NULL,'2023-11-20 10:10:52'),(12,'London','39672a96afebec14f60d.jpeg','2023-11-20 04:09:02','2023-11-20 04:11:09',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `products` with 10 row(s)
--

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(40) NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'test','test@gmail.com','$2y$10$ggCXdOBVj/bqmUoLVgOKEuN9jtCXAW9ijepl2F366T7LTLkj0KaLa','admin','2023-10-13 03:38:49',NULL,NULL),(2,'sapi','sapi@gmail.com','sapi123','user','2023-10-20 07:01:05',NULL,NULL),(3,'dugongg','dugong@gmail.com','dugong123','user','2023-10-20 07:01:19','2023-10-20 07:03:03',NULL),(4,'ikanas','ikan@gmail.com','ikan123','user','2023-10-20 07:10:09','2023-10-20 07:19:14',NULL),(5,'kadal air','kadal@gmail.com','kadal123','user','2023-10-20 07:19:31','2023-10-20 07:19:39',NULL),(6,'sad','test@gmail.com','ekksdv','user','2023-11-20 04:21:08',NULL,'2023-11-20 10:21:11'),(8,'anjay','anjay@gmail.com','$2y$10$TklDcvf/uJyi/luAPC785uU/7D2QlQULjt8SYrvB8NRC.mOhDxAbm','user','2023-11-20 08:34:13',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 7 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Tue, 21 Nov 2023 02:35:16 +0100
