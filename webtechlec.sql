CREATE DATABASE  IF NOT EXISTS `webtechlec` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `webtechlec`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: webtechlec
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `type` enum('mc','text') NOT NULL,
  `question` varchar(1023) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `choice1` varchar(255) NOT NULL,
  `choice2` varchar(255) NOT NULL,
  `choice3` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `q_set` int(11) NOT NULL,
  `questionNumber` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `questionNumber` (`questionNumber`),
  KEY `set` (`q_set`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'text','PHP is an acronym for?','PHP: Hypertext Processor','','','','Originally meant Personal Home Page',1,1),(2,'mc','Who was the creator of PHP?','Rasmus Lerdorf','Rasmus Ledork','Rasmus Lepork','Rasmus Ledorf','He authored the first two versions',1,2),(3,'mc','When was PHP released?','June 1995','July 1995','August 1995','May 1995','Lerdorf started working on PHP on 1994',1,3),(4,'mc','PHP is a ____-side scripting language that is used for web development','Server','Admin','Client','Customer','One of the most commonly used for this purpose',1,4),(5,'text','A ____ and ?> tag tells what code PHP has to interpret','<?php','','','','Everything in between the tags are interpreted',1,5),(6,'mc','How many primitive types does PHP support?','ten','eight','nine','seven','Includes boolean, integer, float, string, and more',1,6),(7,'mc','In PHP, variables start with what character?','$','#','&','%','This is used to assign by value',1,7),(8,'mc','Is PHP loosely typed or strongly typed','loosely typed','strongly typed','strictly typed','neither','This makes working with variables relatively easy',1,8),(9,'text','What is the keyword used to output string in PHP?','echo','','','','It is not actually a function but a construct',1,9),(10,'text','What is the keyword used to start defining a function in PHP?','function','','','','Any valid code can be put in a function: like other functions or class definitions',1,10),(11,'mc','Java Servlet was created to provide ____, user-oriented content','dynamic','constant','static','services','This makes for a better website',2,1),(12,'text','Java Servlets handle ____ request and generate ____ responses','HTTP','','','','Works with HTTPS as well',2,2),(13,'mc','Java Servlets are protocol- and platform-____','independent','dependent','excluded','sided','This dynamically extend Java enabled servers',2,3),(14,'text','What is the package that provides the interfaces and classes for writing servlets?','javax.servlet','','','','These are not specified to any protocol',2,4),(15,'text','What method is used to initialize the Java Servlet and start its life cycle','init()','','','','It is only called once',2,5),(16,'text','What is the method used to handle the request of the clients?','service()','','','','This is called by the servlet container and is the main method to perform the actual task',2,6),(17,'text','What method is used to handle GET requests?','doGet()','','','','A GET request results from a normal request for a URL or from an HTML form',2,7),(18,'text','What method is used to handle POST requests?','doPost()','','','','A POST request results from an HTML form that specifically lists POST as the METHOD',2,8),(19,'text','What method is called to end the life cycle?','destroy()','','','','This gives the servlet a chance to close database connections and perform cleanup activities',2,9),(20,'text','What will be marked for garbage collection after the destroy() method is called?','Servlet Object','','','','Garbage collection is deleting an object from the heap memory',2,10),(21,'mc','JavaServer Pages is a server-side programming technology used to create ____ web content','static and dynamic','static','dynamic','None of the choices','JSP includes the dynamic capabilities of Java Servlets',3,1),(22,'mc','In JavaServer Pages, what data is expressed in text-based format?','static','dynamic','static and dynamic','None of the choices','Text-based format such as HTML and XML',3,2),(23,'mc','In JavaServer Pages, what content are expressed with JSP Elements?','dynamic','static','None of the choices','static and dynamic','JSP Elements are JSP constructs',3,3),(24,'text','JavaServer Page elements are expressed in two syntaxes: XML and ____','standard','','','','However, a file can only use one syntax',3,4),(25,'text','A Javaserver Page using the ____ syntax is considered an ____ document','XML','','','','Which can be manipulated by tools and APIs for that document',3,5),(26,'text','What are JavaServer Pages converted into?','Java Servlets','','','','A JSP services requests as a servlet',3,6),(27,'text','What does Java Servlet determine for JavaServer Pages?','life cycle','','','','Capabilities are also determined by the servlet',3,7),(28,'text','An advantage of JavaServer Pages over Java Servlets is that the build process is performed ____','automatically','','','','Which is better during development phase',3,8),(29,'text','What controls the execution parameters of JavaServer Pages?','page directives','','','','It also controls how the web container translates and executes the JSP Page',3,9),(30,'text','Output written to the response object is ____ when a JavaServer Page is executed','buffered','','','','The size of the buffer can be set using page directives',3,10);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz` (
  `idquiz` int(11) NOT NULL AUTO_INCREMENT,
  `q_user` varchar(16) NOT NULL,
  `q_set` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `stat` enum('done','inprog') NOT NULL,
  PRIMARY KEY (`idquiz`),
  KEY `q_user_idx` (`q_user`),
  KEY `q_set_idx` (`q_set`),
  CONSTRAINT `q_set` FOREIGN KEY (`q_set`) REFERENCES `questions` (`q_set`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `q_user` FOREIGN KEY (`q_user`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz`
--

LOCK TABLES `quiz` WRITE;
/*!40000 ALTER TABLE `quiz` DISABLE KEYS */;
INSERT INTO `quiz` VALUES (1,'user',2,20,'done');
/*!40000 ALTER TABLE `quiz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('user','$2y$10$B/tpjGPDm6D4sDW.7Kwh/ORk/nse9.SwalU6B5LaRUa6cnhAjpzwG','dev.mintgames@gmail.com');
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

-- Dump completed on 2018-05-12 16:20:42
