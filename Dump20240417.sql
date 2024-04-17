CREATE DATABASE  IF NOT EXISTS `bixoteca` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bixoteca`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: bixoteca
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `bixo`
--

DROP TABLE IF EXISTS `bixo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bixo` (
  `idbixo` int NOT NULL AUTO_INCREMENT,
  `bixoname` varchar(45) NOT NULL,
  `ataque` int DEFAULT NULL,
  `defensa` int DEFAULT NULL,
  `instinto` int DEFAULT NULL,
  `poblacion` int DEFAULT NULL,
  `puntosevo` int DEFAULT NULL,
  `user_iduser` int NOT NULL,
  PRIMARY KEY (`idbixo`),
  KEY `fk_bixo_user_idx` (`user_iduser`),
  CONSTRAINT `fk_bixo_user` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bixo`
--

LOCK TABLES `bixo` WRITE;
/*!40000 ALTER TABLE `bixo` DISABLE KEYS */;
/*!40000 ALTER TABLE `bixo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bixo_habs`
--

DROP TABLE IF EXISTS `bixo_habs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bixo_habs` (
  `idbixo` int NOT NULL,
  `idhab` int NOT NULL,
  PRIMARY KEY (`idbixo`,`idhab`),
  KEY `fk_bixo_has_habilidad_habilidad1_idx` (`idhab`),
  KEY `fk_bixo_has_habilidad_bixo1_idx` (`idbixo`),
  CONSTRAINT `fk_bixo_has_habilidad_bixo1` FOREIGN KEY (`idbixo`) REFERENCES `bixo` (`idbixo`),
  CONSTRAINT `fk_bixo_has_habilidad_habilidad1` FOREIGN KEY (`idhab`) REFERENCES `habilidad` (`idhab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bixo_habs`
--

LOCK TABLES `bixo_habs` WRITE;
/*!40000 ALTER TABLE `bixo_habs` DISABLE KEYS */;
/*!40000 ALTER TABLE `bixo_habs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `habilidad`
--

DROP TABLE IF EXISTS `habilidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `habilidad` (
  `idhab` int NOT NULL AUTO_INCREMENT,
  `habname` varchar(45) DEFAULT NULL,
  `habimg` varchar(245) DEFAULT NULL,
  `habdescrip` varchar(245) DEFAULT NULL,
  `habpuntos` int DEFAULT NULL,
  `habtipo` tinyint DEFAULT NULL,
  PRIMARY KEY (`idhab`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habilidad`
--

LOCK TABLES `habilidad` WRITE;
/*!40000 ALTER TABLE `habilidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `habilidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planta`
--

DROP TABLE IF EXISTS `planta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planta` (
  `idplanta` int NOT NULL AUTO_INCREMENT,
  `plantaname` varchar(45) NOT NULL,
  `ataque` int DEFAULT NULL,
  `defensa` int DEFAULT NULL,
  `instinto` int DEFAULT NULL,
  `poblacion` int DEFAULT NULL,
  `puntosevo` int DEFAULT NULL,
  `user_iduser` int NOT NULL,
  PRIMARY KEY (`idplanta`),
  KEY `fk_planta_user1_idx` (`user_iduser`),
  CONSTRAINT `fk_planta_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planta`
--

LOCK TABLES `planta` WRITE;
/*!40000 ALTER TABLE `planta` DISABLE KEYS */;
/*!40000 ALTER TABLE `planta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planta_habs`
--

DROP TABLE IF EXISTS `planta_habs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planta_habs` (
  `idplanta` int NOT NULL,
  `idhab` int NOT NULL,
  PRIMARY KEY (`idplanta`,`idhab`),
  KEY `fk_planta_has_habilidad_habilidad1_idx` (`idhab`),
  KEY `fk_planta_has_habilidad_planta1_idx` (`idplanta`),
  CONSTRAINT `fk_planta_has_habilidad_habilidad1` FOREIGN KEY (`idhab`) REFERENCES `habilidad` (`idhab`),
  CONSTRAINT `fk_planta_has_habilidad_planta1` FOREIGN KEY (`idplanta`) REFERENCES `planta` (`idplanta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planta_habs`
--

LOCK TABLES `planta_habs` WRITE;
/*!40000 ALTER TABLE `planta_habs` DISABLE KEYS */;
/*!40000 ALTER TABLE `planta_habs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-17 18:44:26
