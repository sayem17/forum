-- MySQL dump 10.13  Distrib 5.6.33, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sayem
-- ------------------------------------------------------
-- Server version	5.6.33-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `threads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `replies` int(11) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  KEY `created_at` (`created_at`),
  KEY `replies` (`replies`),
  KEY `body` (`body`(255))
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` VALUES (1,NULL,1,'How to unlock iPhone 5?','Does any one have any idea how or where can I unlock iPhone 5?',6,'2017-02-16 18:26:56','2017-02-18 02:59:36'),(2,NULL,1,'The best android phone?','Which is the best android this year?',6,'2017-02-16 20:52:18','2017-02-18 01:52:41'),(3,NULL,2,'Android or ios?','Which is more secure?',0,'2017-02-16 20:52:18','2017-02-17 03:05:58'),(4,1,2,NULL,'I don\'t think it\'s possible',0,'2017-02-17 03:12:39','0000-00-00 00:00:00'),(5,1,1,NULL,'Ok, Thanks for your reply, hopefully there would be one soon.',0,'2017-02-17 03:12:39','2017-02-17 17:14:26'),(6,1,2,NULL,'I don\'t think it\'s possible',0,'2017-02-17 03:58:10','0000-00-00 00:00:00'),(7,1,1,NULL,'Ok, Thanks for your reply',0,'2017-02-17 03:58:10','0000-00-00 00:00:00'),(9,1,1,NULL,'Ok, Thanks for your reply',0,'2017-02-17 03:58:17','0000-00-00 00:00:00'),(13,1,1,NULL,'anyone else',0,'2017-02-17 15:07:31','0000-00-00 00:00:00'),(15,2,2,NULL,'I guess it\'s google pixel',0,'2017-02-18 01:33:59','0000-00-00 00:00:00'),(16,2,2,NULL,'or \r\nsamsung\r\ngalaxy \r\ns7',0,'2017-02-18 01:34:54','0000-00-00 00:00:00'),(17,2,2,NULL,'also moto x',0,'2017-02-18 01:36:26','0000-00-00 00:00:00'),(18,2,2,NULL,'sdfsd',0,'2017-02-18 01:37:43','0000-00-00 00:00:00'),(19,2,2,NULL,'sdfsdsdf',0,'2017-02-18 01:41:07','0000-00-00 00:00:00'),(20,2,2,NULL,'ggc',0,'2017-02-18 01:52:41','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nasim','genleeshin@gmail.com','$2y$10$xCF3EoaH6wlqMOXQm6NbeeReN03YTBcr7U6rpdqYcSiqOpmPSTKhu','2017-02-17 01:15:39','0000-00-00 00:00:00'),(2,'Hayath','nasimhayath@gmail.com','$2y$10$0reSnCAh4QDIClGbzj.7Tel.qAtx6cSJksweJZV/G2Tv.FuIoO/oK','2017-02-17 12:05:07','2017-02-17 12:05:35');
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

-- Dump completed on 2017-02-18 17:55:36
