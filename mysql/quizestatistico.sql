CREATE DATABASE  IF NOT EXISTS `quizestatistico` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `quizestatistico`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: quizestatistico
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador` (
  `idadministrador` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(34) NOT NULL,
  `acesso` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idadministrador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso` (
  `idcurso` int NOT NULL AUTO_INCREMENT,
  `curso` varchar(100) NOT NULL,
  PRIMARY KEY (`idcurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hanking`
--

DROP TABLE IF EXISTS `hanking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hanking` (
  `idhanking` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `pontuacao` int NOT NULL,
  `acerto` int NOT NULL,
  `erro` int NOT NULL,
  `fkidcurso` int NOT NULL,
  PRIMARY KEY (`idhanking`),
  KEY `fk_hanking_curso1_idx` (`fkidcurso`),
  CONSTRAINT `fk_hanking_curso1` FOREIGN KEY (`fkidcurso`) REFERENCES `curso` (`idcurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hanking`
--

LOCK TABLES `hanking` WRITE;
/*!40000 ALTER TABLE `hanking` DISABLE KEYS */;
/*!40000 ALTER TABLE `hanking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel`
--

DROP TABLE IF EXISTS `nivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nivel` (
  `idnivel` int NOT NULL,
  `nivel` varchar(45) NOT NULL COMMENT 'Representa o nível de dificuldade que vai ter na pergunta',
  PRIMARY KEY (`idnivel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel`
--

LOCK TABLES `nivel` WRITE;
/*!40000 ALTER TABLE `nivel` DISABLE KEYS */;
/*!40000 ALTER TABLE `nivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nomequiz`
--

DROP TABLE IF EXISTS `nomequiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nomequiz` (
  `idnomequiz` int NOT NULL AUTO_INCREMENT,
  `nomequiz` varchar(255) NOT NULL,
  PRIMARY KEY (`idnomequiz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nomequiz`
--

LOCK TABLES `nomequiz` WRITE;
/*!40000 ALTER TABLE `nomequiz` DISABLE KEYS */;
/*!40000 ALTER TABLE `nomequiz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pergunta`
--

DROP TABLE IF EXISTS `pergunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pergunta` (
  `idpergunta` int NOT NULL,
  `pergunta` text NOT NULL,
  PRIMARY KEY (`idpergunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pergunta`
--

LOCK TABLES `pergunta` WRITE;
/*!40000 ALTER TABLE `pergunta` DISABLE KEYS */;
/*!40000 ALTER TABLE `pergunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questao`
--

DROP TABLE IF EXISTS `questao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questao` (
  `idquestao` int NOT NULL AUTO_INCREMENT,
  `fkidnivel` int NOT NULL COMMENT 'Representa o nível de dificuldade que vai ter na pergunta',
  `fkidcurso` int NOT NULL,
  `fkidpergunta` int NOT NULL,
  `fkidresposta` int NOT NULL,
  PRIMARY KEY (`idquestao`),
  KEY `fk_pergunta_nivel1_idx` (`fkidnivel`),
  KEY `fk_pergunta_curso1_idx` (`fkidcurso`),
  KEY `fk_pergunta_resposta1_idx` (`fkidresposta`),
  KEY `fk_questao_pergunta1_idx` (`fkidpergunta`),
  CONSTRAINT `fk_pergunta_curso1` FOREIGN KEY (`fkidcurso`) REFERENCES `curso` (`idcurso`),
  CONSTRAINT `fk_pergunta_nivel1` FOREIGN KEY (`fkidnivel`) REFERENCES `nivel` (`idnivel`),
  CONSTRAINT `fk_pergunta_resposta1` FOREIGN KEY (`fkidresposta`) REFERENCES `resposta` (`idresposta`),
  CONSTRAINT `fk_questao_pergunta1` FOREIGN KEY (`fkidpergunta`) REFERENCES `pergunta` (`idpergunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questao`
--

LOCK TABLES `questao` WRITE;
/*!40000 ALTER TABLE `questao` DISABLE KEYS */;
/*!40000 ALTER TABLE `questao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quiz` (
  `idquiz` int NOT NULL AUTO_INCREMENT,
  `fkidquestao` int NOT NULL,
  `fkidnomequiz` int NOT NULL,
  PRIMARY KEY (`idquiz`),
  KEY `fk_quiz_questao1_idx` (`fkidquestao`),
  KEY `fk_quiz_nomequiz1_idx` (`fkidnomequiz`),
  CONSTRAINT `fk_quiz_nomequiz1` FOREIGN KEY (`fkidnomequiz`) REFERENCES `nomequiz` (`idnomequiz`),
  CONSTRAINT `fk_quiz_questao1` FOREIGN KEY (`fkidquestao`) REFERENCES `questao` (`idquestao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz`
--

LOCK TABLES `quiz` WRITE;
/*!40000 ALTER TABLE `quiz` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resposta`
--

DROP TABLE IF EXISTS `resposta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resposta` (
  `idresposta` int NOT NULL AUTO_INCREMENT,
  `respostacerta` varchar(255) NOT NULL,
  `respostaerra1` varchar(255) NOT NULL,
  `respostaerra2` varchar(255) NOT NULL,
  `respostaerra3` varchar(500) NOT NULL,
  PRIMARY KEY (`idresposta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resposta`
--

LOCK TABLES `resposta` WRITE;
/*!40000 ALTER TABLE `resposta` DISABLE KEYS */;
/*!40000 ALTER TABLE `resposta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-30  0:38:08
