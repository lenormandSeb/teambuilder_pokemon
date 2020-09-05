-- MySQL dump 10.13  Distrib 5.5.62, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: teambuilderpokemon
-- ------------------------------------------------------
-- Server version	5.5.62-0ubuntu0.14.04.1

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
-- Table structure for table `attack_dex`
--

DROP TABLE IF EXISTS `attack_dex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attack_dex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_attaque_id` int(11) DEFAULT NULL,
  `name` varchar(255)  NOT NULL,
  `categorie` int(11) DEFAULT NULL,
  `tm` varchar(255)  DEFAULT NULL,
  `power` varchar(255)  DEFAULT NULL,
  `accurate` int(11) DEFAULT NULL,
  `pp` int(11) DEFAULT NULL,
  `effet` longtext ,
  `prob` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F5D6C96C8C3137` (`type_attaque_id`),
  CONSTRAINT `FK_8F5D6C96C8C3137` FOREIGN KEY (`type_attaque_id`) REFERENCES `type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14)  NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nature`
--

DROP TABLE IF EXISTS `nature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255)  NOT NULL,
  `stat_aug` varchar(255)  NOT NULL,
  `stat_down` varchar(255)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pokedex`
--

DROP TABLE IF EXISTS `pokedex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pokedex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pokemon`
--

DROP TABLE IF EXISTS `pokemon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pokemon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_one_id` int(11) DEFAULT NULL,
  `type_two_id` int(11) DEFAULT NULL,
  `talent_one_id` int(11) DEFAULT NULL,
  `talent_two_id` int(11) DEFAULT NULL,
  `talent_hide_id` int(11) DEFAULT NULL,
  `name` varchar(255)  NOT NULL,
  `num_dex` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `defense` int(11) NOT NULL,
  `spe_attack` int(11) NOT NULL,
  `spe_defense` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `generation` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_62DC90F3D84DA52B` (`type_one_id`),
  KEY `IDX_62DC90F3B31142E4` (`type_two_id`),
  KEY `IDX_62DC90F388B0888E` (`talent_one_id`),
  KEY `IDX_62DC90F3E3EC6F41` (`talent_two_id`),
  KEY `IDX_62DC90F37D498C4F` (`talent_hide_id`),
  CONSTRAINT `FK_62DC90F37D498C4F` FOREIGN KEY (`talent_hide_id`) REFERENCES `talent` (`id`),
  CONSTRAINT `FK_62DC90F388B0888E` FOREIGN KEY (`talent_one_id`) REFERENCES `talent` (`id`),
  CONSTRAINT `FK_62DC90F3B31142E4` FOREIGN KEY (`type_two_id`) REFERENCES `type` (`id`),
  CONSTRAINT `FK_62DC90F3D84DA52B` FOREIGN KEY (`type_one_id`) REFERENCES `type` (`id`),
  CONSTRAINT `FK_62DC90F3E3EC6F41` FOREIGN KEY (`talent_two_id`) REFERENCES `talent` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `talent`
--

DROP TABLE IF EXISTS `talent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255)  NOT NULL,
  `effet_combat` longtext  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255)  NOT NULL,
  `color` varchar(6)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-30 20:16:05