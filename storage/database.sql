-- MySQL dump 10.13  Distrib 5.6.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: jp
-- ------------------------------------------------------
-- Server version	5.6.24-0ubuntu2

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
  `topic_id` int(11) unsigned DEFAULT NULL,
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
  KEY `body` (`body`(255)),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` VALUES (1,NULL,1,2,'How to unlock iPhone 5?','Does any one have any idea how or where can I unlock iPhone 5?',6,'2017-02-16 18:26:56','2017-02-19 19:25:54'),(2,NULL,1,1,'The best android phone?','Which is the best android this year?',8,'2017-02-16 20:52:18','2017-02-20 12:41:37'),(3,NULL,2,2,'Android or ios?','Which is more secure?',0,'2017-02-16 20:52:18','2017-02-19 19:26:52'),(4,1,2,0,NULL,'I don\'t think it\'s possible',0,'2017-02-17 03:12:39','0000-00-00 00:00:00'),(5,1,1,0,NULL,'Ok, Thanks for your reply, hopefully there would be one soon.',0,'2017-02-17 03:12:39','2017-02-17 17:14:26'),(6,1,2,0,NULL,'I don\'t think it\'s possible',0,'2017-02-17 03:58:10','0000-00-00 00:00:00'),(7,1,1,0,NULL,'Ok, Thanks for your reply',0,'2017-02-17 03:58:10','0000-00-00 00:00:00'),(9,1,1,0,NULL,'Ok, Thanks for your reply',0,'2017-02-17 03:58:17','0000-00-00 00:00:00'),(13,1,1,0,NULL,'anyone else',0,'2017-02-17 15:07:31','0000-00-00 00:00:00'),(15,2,2,0,NULL,'I guess it\'s google pixel',0,'2017-02-18 01:33:59','0000-00-00 00:00:00'),(16,2,2,0,NULL,'or \r\nsamsung\r\ngalaxy \r\ns7',0,'2017-02-18 01:34:54','0000-00-00 00:00:00'),(17,2,2,0,NULL,'also moto x',0,'2017-02-18 01:36:26','0000-00-00 00:00:00'),(18,2,2,0,NULL,'sdfsd',0,'2017-02-18 01:37:43','0000-00-00 00:00:00'),(19,2,2,0,NULL,'sdfsdsdf',0,'2017-02-18 01:41:07','0000-00-00 00:00:00'),(20,2,2,0,NULL,'ggc',0,'2017-02-18 01:52:41','0000-00-00 00:00:00'),(22,2,15,0,NULL,'hello world',0,'2017-02-18 19:10:03','2017-02-18 19:11:28'),(23,NULL,15,2,'Iphone 6','&lt;p&gt;How To Jailbreak Iphone 6&lt;/p&gt;',0,'2017-02-18 19:12:05','2017-02-20 14:00:42'),(25,2,15,NULL,NULL,'hhhh',0,'2017-02-20 12:41:37','0000-00-00 00:00:00'),(30,NULL,15,1,'sfdasdf','&lt;p&gt;sdfasfd&lt;/p&gt;',2,'2017-02-20 14:21:59','2017-02-20 14:23:03'),(31,30,15,NULL,NULL,'&lt;p&gt;hh&lt;/p&gt;',0,'2017-02-20 14:22:52','0000-00-00 00:00:00'),(32,30,15,NULL,NULL,'&lt;p&gt;h&lt;/p&gt;',0,'2017-02-20 14:23:03','0000-00-00 00:00:00'),(33,NULL,15,3,'windows','&lt;p&gt;how to downgrade win 10 to win 8.1&lt;/p&gt;',0,'2017-02-20 15:45:30','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` VALUES (1,'Android OS'),(2,'Apple iOS'),(3,'Windows');
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nasim','genleeshin@gmail.com','$2y$10$xCF3EoaH6wlqMOXQm6NbeeReN03YTBcr7U6rpdqYcSiqOpmPSTKhu','2017-02-17 01:15:39','0000-00-00 00:00:00'),(2,'Hayath','nasimhayath@gmail.com','$2y$10$0reSnCAh4QDIClGbzj.7Tel.qAtx6cSJksweJZV/G2Tv.FuIoO/oK','2017-02-17 12:05:07','2017-02-17 12:05:35'),(15,'sayem','sayem.ab@gmail.com','$2y$10$VmsOKFp/XAVneFVbFx5JrOV.ZRQuJ7uS5lyJBRU8kG93RcHjJS8LW','2017-02-18 19:06:10','0000-00-00 00:00:00');
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

-- Dump completed on 2017-02-20 21:50:57
