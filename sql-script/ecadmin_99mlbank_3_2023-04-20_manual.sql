-- MySQL dump 10.13  Distrib 8.0.32, for macos12.6 (x86_64)
--
-- Host: localhost    Database: ecadmin_99mlbank
-- ------------------------------------------------------
-- Server version	8.0.32
 /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!50503 SET NAMES utf8mb4 */;

/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;

/*!40103 SET TIME_ZONE='+00:00' */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;

/*!40101 SET @saved_cs_client     = @@character_set_client */;

/*!50503 SET character_set_client = utf8mb4 */;


CREATE TABLE `bank` ( `id` int NOT NULL AUTO_INCREMENT,
                                        `name` varchar(255) CHARACTER
                     SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
                                                            PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT
CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--
 LOCK TABLES `bank` WRITE;

/*!40000 ALTER TABLE `bank` DISABLE KEYS */;


INSERT INTO `bank`
VALUES (1,
        'ALLIANCE BANK'),(2,
                          'AMBANK'),(3,
                                     'AMBANK COMPANY'),(4,
                                                        'ARGO'),(5,
                                                                 'ARGO COMPANY'),(6,
                                                                                  'BSN'),(7,
                                                                                          'BSN COMPANY'),(8,
                                                                                                          'CIMB'),(9,
                                                                                                                   'CIMB COMPANY'),(10,
                                                                                                                                    'CIMB COMPANY TNG+DUITNOW'),(11,
                                                                                                                                                                 'CIMB CREDIT CARD'),(12,
                                                                                                                                                                                      'HLB'),(13,
                                                                                                                                                                                              'HLB COMPANY'),(14,
                                                                                                                                                                                                              'HLB CREDIT CARD'),(15,
                                                                                                                                                                                                                                  'MBB'),(16,
                                                                                                                                                                                                                                          'MBB COMPANY'),(17,
                                                                                                                                                                                                                                                          'MBB TNG'),(18,
                                                                                                                                                                                                                                                                      'PBB'),(19,
                                                                                                                                                                                                                                                                              'PBB COMPANY'),(20,
                                                                                                                                                                                                                                                                                              'RHB'),(21,
                                                                                                                                                                                                                                                                                                      'RHB COMPANY'),(22,
                                                                                                                                                                                                                                                                                                                      'UOB COMPANY');

/*!40000 ALTER TABLE `bank` ENABLE KEYS */;

UNLOCK TABLES;

-- MySQL dump 10.13  Distrib 8.0.32, for macos12.6 (x86_64)
--
-- Host: localhost    Database: ecadmin_99mlbank
-- ------------------------------------------------------
-- Server version	8.0.32
 /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!50503 SET NAMES utf8mb4 */;

/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;

/*!40103 SET TIME_ZONE='+00:00' */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;

/*!40101 SET @saved_cs_client     = @@character_set_client */;

/*!50503 SET character_set_client = utf8mb4 */;


CREATE TABLE `announcement` ( `id` int NOT NULL AUTO_INCREMENT,
                                                `name` varchar(255) CHARACTER
                             SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
                                                                    `status` varchar(10) CHARACTER
                             SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
                                                                    PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT
CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement`
--
 LOCK TABLES `announcement` WRITE;

/*!40000 ALTER TABLE `announcement` DISABLE KEYS */;


INSERT INTO `announcement`
VALUES (1,
        'Testing Testing 123',
        'Inactive'),(2,
                     '要好好的做，努力赚钱，美好未来！',
                     'Active');

/*!40000 ALTER TABLE `announcement` ENABLE KEYS */;

UNLOCK TABLES;

