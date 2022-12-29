-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: us-cdbr-east-03.cleardb.com    Database: heroku_bb9f71dbaf1a90e
-- ------------------------------------------------------
-- Server version	5.6.50-log

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `firstName` char(128) NOT NULL,
  `lastName` char(128) NOT NULL,
  `a_password` varchar(256) NOT NULL,
  `profile_pic` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (2,'pasindulakshan','Pasindu','Lakshan','4abeccbafe94c737a66d81103ae01bfcabfcab77b71c05fac3a3e3b357de450e',NULL),(4,'pasindux','Pasindu','Rangana','$2y$10$GjoMOGzoeOVpk4fRny4JZOwO.i72P8zLcFbVXCwmfeQGjgflJXaqm','pasindux-60cae44a96ad98.21656586.jpg');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrator_email`
--

DROP TABLE IF EXISTS `administrator_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrator_email` (
  `adminID` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`adminID`,`email`),
  CONSTRAINT `FK_AdministratorEmail` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator_email`
--

LOCK TABLES `administrator_email` WRITE;
/*!40000 ALTER TABLE `administrator_email` DISABLE KEYS */;
INSERT INTO `administrator_email` VALUES (4,'it20518578@my.sliit.lk');
/*!40000 ALTER TABLE `administrator_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `CID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(128) NOT NULL,
  `categoryDescription` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`CID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Quiz','Quiz games'),(2,'Puzzle','Puzzle games');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL AUTO_INCREMENT,
  `memberID` int(11) NOT NULL,
  `name` char(128) NOT NULL,
  `subject` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `c_datetime` datetime NOT NULL,
  `adminID` int(11) NOT NULL,
  `view_datetime` datetime NOT NULL,
  PRIMARY KEY (`contactID`,`memberID`),
  KEY `FK_Contact1` (`memberID`),
  KEY `FK_Contact2` (`adminID`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (54,34,'Pasindu Lakshan','English','dkp9912@gmail.com','Add more questions based on parts of speech','2021-06-16 16:14:08',0,'0000-00-00 00:00:00'),(64,34,'Pasindu Lakshan','Test','dkp9912@gmail.com','Test','2021-06-17 06:30:08',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `developer`
--

DROP TABLE IF EXISTS `developer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `developer` (
  `devID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` char(128) NOT NULL,
  `lastName` char(128) NOT NULL,
  `devDescription` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`devID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `developer`
--

LOCK TABLES `developer` WRITE;
/*!40000 ALTER TABLE `developer` DISABLE KEYS */;
INSERT INTO `developer` VALUES (1,'Pasindu','Lakshan','Game Developer');
/*!40000 ALTER TABLE `developer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `developer_email`
--

DROP TABLE IF EXISTS `developer_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `developer_email` (
  `devID` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`devID`,`email`),
  CONSTRAINT `FK_DeveloperEmail` FOREIGN KEY (`devID`) REFERENCES `developer` (`devID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `developer_email`
--

LOCK TABLES `developer_email` WRITE;
/*!40000 ALTER TABLE `developer_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `developer_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game` (
  `gameID` int(11) NOT NULL AUTO_INCREMENT,
  `gameName` varchar(128) NOT NULL,
  `gameGrade` varchar(128) NOT NULL,
  `gameCategory` varchar(128) NOT NULL,
  `gameSubject` varchar(128) NOT NULL,
  `gameDescription` varchar(1000) DEFAULT NULL,
  `gameInstructions` varchar(1000) DEFAULT NULL,
  `gameAccess` char(10) NOT NULL,
  `adminID` int(11) NOT NULL,
  `devID` int(11) NOT NULL,
  `gFile` varchar(256) DEFAULT NULL,
  `gThumbnail` varchar(256) DEFAULT NULL,
  `added_date` date NOT NULL,
  `last_modified_date` date NOT NULL,
  PRIMARY KEY (`gameID`),
  KEY `FK_Game1` (`adminID`),
  KEY `FK_Game2` (`devID`),
  CONSTRAINT `FK_Game1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`),
  CONSTRAINT `FK_Game2` FOREIGN KEY (`devID`) REFERENCES `developer` (`devID`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (64,'Bingo Additions','Grade 5','Quiz','Mathematics','Bingo Addition Game is a quiz to test your knowledge of additions.','Choose the correct answer from the given answers. and then click the next questions button. after answering all questions you can submit the answers by clicking submit button.','Free',4,1,'60b22b9b033530.99447546.php','60b22b9b5b1a44.82255669.jpg','2021-05-29','2021-05-29'),(84,'Bingo Additions','Preschool','Quiz','English','Bingo Addition Game is an educational & interactive way to learn addition online','Clicks the start now button. then follow the on-screen instructions','Free',4,1,'60ca1619948e43.99828745.php','60ca161994cb02.17460918.jpg','2021-06-16','2021-06-16'),(94,'Multiplication Race','Grade 1','Puzzle','Mathematics','Practice your multiplication skills with this awesome game','Clicks the start now button. then follow the on-screen instructions','Free',4,1,'60ca16c52acd60.58879549.php','60ca16c52adc89.11965572.jpg','2021-06-16','2021-06-16'),(104,'Active Passive','Grade 2','Quiz','English','Best way learn how to convert Active voice to Passive Voice','Clicks the start now button. then follow the on-screen instructions','Premium',4,1,'60ca17f5ab2eb9.99260990.php','60ca17f5ab5804.94635590.jpg','2021-06-16','2021-06-16'),(114,'Find Synonyms','Grade 3','Quiz','English','This game teaches synonyms. Learn Synonyms while having fun','Clicks the start now button. then follow the on-screen instructions','Free',4,1,'60ca184b802ca4.37349484.php','60ca184b804af3.22390049.jpg','2021-06-16','2021-06-16'),(124,'Measuring Matter','Grade 4','Puzzle','Mathematics','learn about the various tools and units of measuring matter','Clicks the start now button. then follow the on-screen instructions','Free',4,1,'60ca189a0ebb19.11820884.php','60ca189a0ed787.60588537.jpg','2021-06-16','2021-06-16');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grade` (
  `GID` int(11) NOT NULL AUTO_INCREMENT,
  `gradeName` varchar(128) NOT NULL,
  `gradeDescription` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`GID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grade`
--

LOCK TABLES `grade` WRITE;
/*!40000 ALTER TABLE `grade` DISABLE KEYS */;
INSERT INTO `grade` VALUES (1,'Preschool','Games for Preschool kids'),(2,'Grade 1','Games for grade 1 students'),(3,'Grade 2','Games for grade 2 students'),(4,'Grade 3','Games for grade 3 students'),(5,'Grade 4','Games for grade 4 students'),(6,'Grade 5','Games for grade 5 students'),(7,'Grade 6','Games for grade 6 students'),(8,'Grade 7','Games for grade 7 students'),(9,'Grade 8','Games for grade 8 students'),(10,'Grade 9','Games for grade 9 students');
/*!40000 ALTER TABLE `grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `history` (
  `HID` int(11) NOT NULL AUTO_INCREMENT,
  `memberID` int(11) NOT NULL,
  `gameID` int(11) NOT NULL,
  `h_datetime` datetime NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`HID`),
  KEY `FK_History1` (`memberID`),
  KEY `FK_History2` (`gameID`),
  CONSTRAINT `FK_History1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`),
  CONSTRAINT `FK_History2` FOREIGN KEY (`gameID`) REFERENCES `game` (`gameID`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (4,34,64,'2021-05-29 03:39:48',10),(14,34,64,'2021-05-29 02:23:43',100),(24,34,64,'2021-05-29 05:12:23',200),(34,34,64,'2021-05-30 04:34:56',90),(44,34,64,'2021-05-31 05:12:12',70),(54,34,64,'2021-05-31 06:45:42',80),(64,34,64,'2021-05-31 07:46:23',140),(74,34,114,'2021-06-17 08:09:06',3),(84,34,114,'2021-06-17 08:10:14',0);
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member` (
  `memberID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `firstName` char(128) NOT NULL,
  `lastName` char(128) NOT NULL,
  `m_password` varchar(256) NOT NULL,
  `m_rank` char(20) NOT NULL DEFAULT 'No Rank',
  `TID` int(11) NOT NULL,
  `profile_pic` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`memberID`),
  KEY `FK_Member` (`TID`),
  CONSTRAINT `FK_Member` FOREIGN KEY (`TID`) REFERENCES `type` (`TID`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (34,'pasindux','Pasindu','Rangana','$2y$10$/mde2Cm21yzlSeOnZLL/1.2u2jUOmCvUiSdaAHLV6MjTY8c6FP47m','No Rank',2,'pasindux-60b4f25acda595.63732602.jpg'),(44,'rumi','chamodya','rumindi','$2y$10$VvR83FC87gpbVGFQWeCy8etLNE40Z7kBE2JGDSrAA/.UdUcgNfP56','No Rank',2,NULL),(54,'cham','cham','rumindi','$2y$10$Y0PIZZq1Kcf9rPHAbMyiGehUg8LUuLjt3VC6b8rjoj31GMhwzbc06','No Rank',2,NULL),(64,'ruuuu','ruu','chaa','$2y$10$n57EbAFPHRWoVfujy9P53uC4xRmimUzoGzLtx4qQ0IpWsaqCahXy2','No Rank',2,NULL),(74,'kkl','ddss','fff','$2y$10$dr/pPBm6wN5vmD5TEXF1Te79UiEEgUnQYbqPvC5KPduaTqGgJny.S','No Rank',2,NULL),(84,'rumindi','rumi','cham','$2y$10$onBPvlPkJ7iei3ZX1Csc4.5BO0dpsZYbci9u2TWcLOI1KuwZ2L08i','No Rank',2,NULL),(94,'nethu','nethmini','tharuka','$2y$10$AgUUXvcCaS4Bq0G.puNVzOC5GNJ66XR6WI5UwACys7ti8MV58dPQW','No Rank',1,NULL),(114,'chaa','chaa','ruu','$2y$10$B9mXsGv20zSQgSc5Nkgt3.0vjeuohxBUcOTPYkeyOsA6c1oTGmXl.','No Rank',2,NULL),(124,'qaaa','qqq','qqqq','$2y$10$livZ2Z7/.U3Bc2zLqi5kA.4xoT2qSV/DMAGlq99uqqJ4LjneS7l7q','No Rank',2,NULL),(134,'qqq','mmm','yyy','$2y$10$Bu3VD53PzHw6oRzROhB5cuoNBMvAWyniORd8sIU7CZ1QvIGC58NIe','No Rank',2,NULL),(144,'chanaka','chanaka','kamal','$2y$10$2quYGsN71TqD1o664ZQweOoGvS0hh2lFzWAUsSi3zvag6H3jaApV2','No Rank',2,NULL),(154,'nayana','nayana','tharu','$2y$10$H4/hfZn3OFaeOLS7YVpSRe3Kxapa49PDo4lY38YGlFKEkKwqeSF0O','No Rank',2,NULL);
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_email`
--

DROP TABLE IF EXISTS `member_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_email` (
  `memberID` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `emailType` varchar(32) NOT NULL,
  PRIMARY KEY (`memberID`,`email`),
  CONSTRAINT `FK_MemberEmail` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_email`
--

LOCK TABLES `member_email` WRITE;
/*!40000 ALTER TABLE `member_email` DISABLE KEYS */;
INSERT INTO `member_email` VALUES (34,'test@gmail.com','Primary'),(44,'rumicham99@gmail.com','Primary'),(54,'aasss@ahana.gmail.com','Primary'),(64,'asss@gmail.com','Primary'),(74,'asg@gmail.com','Primary'),(84,'abc@gamil.com','Primary'),(94,'tharukatharu16@gmail.com','Primary'),(114,'aswdd@gamil.com','Primary'),(124,'awd@gmail.com','Primary'),(134,'sde@gmail.com','Primary'),(144,'chanakakamal99@gmail.com','Primary'),(154,'ffff@gmail.com','Primary');
/*!40000 ALTER TABLE `member_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership`
--

DROP TABLE IF EXISTS `membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membership` (
  `MID` int(11) NOT NULL AUTO_INCREMENT,
  `memberID` int(11) NOT NULL,
  `m_plan` varchar(20) NOT NULL,
  `m_status` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `renewal_date` date NOT NULL,
  PRIMARY KEY (`MID`),
  KEY `FK_Membership1` (`memberID`),
  CONSTRAINT `FK_Membership1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership`
--

LOCK TABLES `membership` WRITE;
/*!40000 ALTER TABLE `membership` DISABLE KEYS */;
INSERT INTO `membership` VALUES (14,34,'Annual','Canceled','2021-05-24','2021-07-21'),(24,44,'','','2021-05-29','0000-00-00'),(34,54,'','','2021-05-30','0000-00-00'),(44,64,'','','2021-05-30','0000-00-00'),(54,74,'','','2021-05-30','0000-00-00'),(64,84,'','','2021-05-31','0000-00-00'),(74,94,'','','2021-05-31','0000-00-00'),(94,114,'','','2021-05-31','0000-00-00'),(104,124,'','','2021-05-31','0000-00-00'),(114,134,' ',' ','2021-05-31','0000-00-00'),(124,144,'','','2021-06-16','0000-00-00'),(134,154,'','','2021-06-17','0000-00-00');
/*!40000 ALTER TABLE `membership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `PID` int(11) NOT NULL AUTO_INCREMENT,
  `memberID` int(11) NOT NULL,
  `p_datetime` datetime NOT NULL,
  `amount` float NOT NULL,
  `p_description` varchar(128) DEFAULT NULL,
  `MID` int(11) NOT NULL,
  PRIMARY KEY (`PID`),
  KEY `FK_Payment1` (`memberID`),
  KEY `FK_Payment2` (`MID`),
  CONSTRAINT `FK_Payment1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`),
  CONSTRAINT `FK_Payment2` FOREIGN KEY (`MID`) REFERENCES `membership` (`MID`)
) ENGINE=InnoDB AUTO_INCREMENT=704 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (474,34,'2020-07-12 16:23:23',60,'Paypal',14),(484,34,'2020-08-12 16:23:23',80,'Paypal',14),(494,34,'2020-09-12 16:23:23',120,'Paypal',14),(504,34,'2020-10-12 16:23:23',100,'Paypal',14),(514,34,'2020-11-12 16:23:23',90,'Paypal',14),(524,34,'2020-12-12 16:23:23',200,'Paypal',14),(534,34,'2021-01-12 16:23:23',300,'Paypal',14),(544,34,'2021-02-12 16:23:23',270,'Paypal',14),(554,34,'2021-03-12 16:23:23',400,'Paypal',14),(564,34,'2021-04-12 16:23:23',600,'Paypal',14),(574,34,'2021-05-12 16:23:23',550,'Paypal',14),(584,34,'2021-06-05 16:23:23',750,'Paypal',14),(594,34,'2020-08-12 16:23:23',80,'Paypal',14),(604,34,'2020-09-12 16:23:23',120,'Paypal',14),(614,34,'2020-10-12 16:23:23',100,'Paypal',14),(624,34,'2020-11-12 16:23:23',90,'Paypal',14),(634,34,'2020-12-12 16:23:23',200,'Paypal',14),(644,34,'2021-01-12 16:23:23',300,'Paypal',14),(654,34,'2021-02-12 16:23:23',270,'Paypal',14),(664,34,'2021-03-12 16:23:23',400,'Paypal',14),(674,34,'2021-04-12 16:23:23',600,'Paypal',14),(684,34,'2021-05-12 16:23:23',550,'Paypal',14);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `RID` int(11) NOT NULL AUTO_INCREMENT,
  `memberID` int(11) NOT NULL,
  `gameID` int(11) NOT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `submit_date` date NOT NULL,
  PRIMARY KEY (`RID`,`memberID`),
  KEY `FK_Review1` (`memberID`),
  KEY `FK_Review2` (`gameID`),
  CONSTRAINT `FK_Review1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`),
  CONSTRAINT `FK_Review2` FOREIGN KEY (`gameID`) REFERENCES `game` (`gameID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subject` (
  `SID` int(11) NOT NULL AUTO_INCREMENT,
  `subjectName` varchar(128) NOT NULL,
  `subjectDescription` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (1,'English','Learn English while playing games'),(2,'Mathematics','Our online math games are designed to provide kids with multiple opportunities to understand the power and beauty of math.'),(3,'Science','Learn Science while playing these awesome games'),(4,'History','Learn History while playing games'),(5,'Environment','Learn Environment while playing games.');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type` (
  `TID` int(11) NOT NULL AUTO_INCREMENT,
  `mType` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`TID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (1,'Premium',9.99,'Premium Membership'),(2,'Free',0,'Free Membership'),(3,'Premium',9.99,'Premium Membership'),(4,'Free',0,'Free Membership');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-24 14:10:14
