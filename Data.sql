-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mundialfan
-- ------------------------------------------------------
-- Server version	8.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'News','Posts about World Cup news and teams'),(2,'Players','Content related to featured footballers'),(3,'Matches','Posts about results and analysis'),(4,'Opinion','User analysis and commentary'),(5,'Multimedia','World Cup videos, images or clips');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `championships`
--

LOCK TABLES `championships` WRITE;
/*!40000 ALTER TABLE `championships` DISABLE KEYS */;
INSERT INTO `championships` VALUES (1,1930,'Uruguay','https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_Uruguay.svg','Uruguay','Argentina',70,13,'First World Cup organized by FIFA.'),(2,1934,'Italy','https://upload.wikimedia.org/wikipedia/commons/0/03/Flag_of_Italy.svg','Italy','Czechoslovakia',70,16,'Second edition, the first with knockout format.'),(3,1938,'France','https://upload.wikimedia.org/wikipedia/commons/c/c3/Flag_of_France.svg','Italy','Hungary',84,15,'Last World Cup before World War II.'),(4,1950,'Brazil','https://upload.wikimedia.org/wikipedia/commons/0/05/Flag_of_Brazil.svg','Uruguay','Brazil',88,13,'Famous for the Maracanazo.'),(5,1954,'Switzerland','https://upload.wikimedia.org/wikipedia/commons/f/f3/Flag_of_Switzerland.svg','Germany','Hungary',140,16,'First televised final.'),(6,1958,'Sweden','https://upload.wikimedia.org/wikipedia/commons/4/4c/Flag_of_Sweden.svg','Brazil','Sweden',126,16,'Brazil\'s first World Cup win with Pelé.'),(7,1962,'Chile','https://upload.wikimedia.org/wikipedia/commons/7/78/Flag_of_Chile.svg','Brazil','Czechoslovakia',89,16,'Brazil repeated as world champions.'),(8,1966,'England','https://upload.wikimedia.org/wikipedia/commons/b/be/Flag_of_England.svg','England','Germany',89,16,'England won on home soil.'),(9,1970,'Mexico','https://upload.wikimedia.org/wikipedia/commons/f/fc/Flag_of_Mexico.svg','Brazil','Italy',95,16,'Pelé won his third World Cup title.'),(10,1978,'Argentina','https://upload.wikimedia.org/wikipedia/commons/1/1a/Flag_of_Argentina.svg','Argentina','Netherlands',102,16,'Argentina\'s first World Cup title.'),(11,1982,'Spain','https://upload.wikimedia.org/wikipedia/commons/8/89/Flag_of_Spain.svg','Italy','Germany',146,24,'First Cup with 24 teams. Italy won their third title.'),(12,1986,'Mexico','https://upload.wikimedia.org/wikipedia/commons/f/fc/Flag_of_Mexico.svg','Argentina','Germany',132,24,'Maradona shone with the \"Goal of the Century\" and the \"Hand of God\".'),(13,1990,'Italy','https://upload.wikimedia.org/wikipedia/commons/0/03/Flag_of_Italy.svg','Germany','Argentina',115,24,'Germany won their third world title.'),(14,1994,'United States','https://upload.wikimedia.org/wikipedia/commons/a/a4/Flag_of_the_United_States.svg','Brazil','Italy',141,24,'Brazil won on penalties; first World Cup in the USA.'),(15,1998,'France','https://upload.wikimedia.org/wikipedia/commons/c/c3/Flag_of_France.svg','France','Brazil',171,32,'France won their first title at home.'),(16,2002,'South Korea / Japan','https://upload.wikimedia.org/wikipedia/commons/0/09/Flag_of_South_Korea.svg','Brazil','Germany',161,32,'First Cup in Asia, Brazil\'s fifth crown.'),(17,2006,'Germany','https://upload.wikimedia.org/wikipedia/commons/b/ba/Flag_of_Germany.svg','Italy','France',147,32,'Italy won their fourth world title.'),(18,2010,'South Africa','https://upload.wikimedia.org/wikipedia/commons/a/af/Flag_of_South_Africa.svg','Spain','Netherlands',145,32,'Spain won their first World Cup with Iniesta\'s goal.'),(19,2014,'Brazil','https://upload.wikimedia.org/wikipedia/commons/0/05/Flag_of_Brazil.svg','Germany','Argentina',171,32,'Germany won their fourth title with Götze\'s goal.'),(20,2018,'Russia','https://upload.wikimedia.org/wikipedia/commons/f/f3/Flag_of_Russia.svg','France','Croatia',169,32,'France repeated as champions with a young dominant squad.'),(21,2022,'Qatar','https://upload.wikimedia.org/wikipedia/commons/6/65/Flag_of_Qatar.svg','Argentina','France',172,32,'Messi led Argentina to the third title in a historic final.');
/*!40000 ALTER TABLE `championships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Argentina','argentina','South America','https://upload.wikimedia.org/wikipedia/commons/1/1a/Flag_of_Argentina.svg','Argentina national football team.','Argentina debuted in 1930...',3,18,'Lionel Scaloni','Lionel Messi',NULL),(2,'Brazil','brasil','South America','https://upload.wikimedia.org/wikipedia/commons/0/05/Flag_of_Brazil.svg','Brazil national football team.','Brazil is the only country...',5,22,'Dorival Júnior','Pelé',NULL),(3,'Mexico','mexico','North America','https://upload.wikimedia.org/wikipedia/commons/f/fc/Flag_of_Mexico.svg','Mexico national team.','Mexico has participated in 17 editions...',0,17,'Jaime Lozano','Hugo Sánchez',NULL),(4,'Puerto Rico','puertorico','South America','https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_Puerto_Rico.svg','','',0,0,'','',NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `country_images`
--

LOCK TABLES `country_images` WRITE;
/*!40000 ALTER TABLE `country_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `country_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `country_videos`
--

LOCK TABLES `country_videos` WRITE;
/*!40000 ALTER TABLE `country_videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `country_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `featured_players`
--

LOCK TABLES `featured_players` WRITE;
/*!40000 ALTER TABLE `featured_players` DISABLE KEYS */;
INSERT INTO `featured_players` VALUES (1,'Pelé','Brazil','Only player with 3 World Cup titles (1958, 1962, 1970).','imagenes/pele.jpg'),(2,'Diego Maradona','Argentina','World Cup 1986 champion with the \"Goal of the Century\".','imagenes/diego.jpg'),(3,'Zinedine Zidane','France','World champion 1998 and runner-up in 2006.','imagenes/zinedine.jpg'),(4,'Ronaldo Nazário','Brazil','Top scorer at the 2002 World Cup with 8 goals.','imagenes/ronaldo.jpg'),(5,'Miroslav Klose','Germany','All-time top scorer in World Cup history (16 goals).','imagenes/miroslav.jpg'),(6,'Lionel Messi','Argentina','2022 World Cup champion and Golden Ball winner of the tournament.','imagenes/messi.jpg');
/*!40000 ALTER TABLE `featured_players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `successful_teams`
--

LOCK TABLES `successful_teams` WRITE;
/*!40000 ALTER TABLE `successful_teams` DISABLE KEYS */;
INSERT INTO `successful_teams` VALUES (1,'Brazil','https://flagicons.lipis.dev/flags/4x3/br.svg',5),(2,'Germany','https://flagicons.lipis.dev/flags/4x3/de.svg',4),(3,'Italy','https://flagicons.lipis.dev/flags/4x3/it.svg',4),(4,'Argentina','https://flagicons.lipis.dev/flags/4x3/ar.svg',3),(5,'France','https://flagicons.lipis.dev/flags/4x3/fr.svg',2),(6,'Uruguay','https://flagicons.lipis.dev/flags/4x3/uy.svg',2),(7,'England','https://flagicons.lipis.dev/flags/4x3/gb.svg',1),(8,'Spain','https://flagicons.lipis.dev/flags/4x3/es.svg',1);
/*!40000 ALTER TABLE `successful_teams` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-07 19:41:04
