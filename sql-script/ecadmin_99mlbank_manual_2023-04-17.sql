-- add `password` col to `user` tbl

ALTER TABLE users ADD password varchar(255);

--
-- Table structure for table `rent`
--

DROP TABLE IF EXISTS `rent`;

/*!40101 SET @saved_cs_client     = @@character_set_client */;

/*!50503 SET character_set_client = utf8mb4 */;


CREATE TABLE `rent` (`id` int NOT NULL AUTO_INCREMENT,
                                       `superadmin` int(11) NOT NULL,
                                                            `pay_date` date NOT NULL,
                                                                            `amount` int(11) NOT NULL,
                                                                                             `remarks` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
                                                                                                                                                       PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT
CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rent`
--
 LOCK TABLES `rent` WRITE;

/*!40000 ALTER TABLE `rent` DISABLE KEYS */;


INSERT INTO `rent`
VALUES (1,
        1,
        '2023-04-11',
        1111,
        'for emergency');


INSERT INTO `rent`
VALUES (2,
        3,
        '2023-04-12',
        1000,
        'for emergency111');

/*!40000 ALTER TABLE `rent` ENABLE KEYS */;

UNLOCK TABLES;

-- rename rent.superadmin TO rent.user_id

ALTER TABLE rent RENAME COLUMN superadmin TO user_id;

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;

/*!40101 SET @saved_cs_client     = @@character_set_client */;

/*!50503 SET character_set_client = utf8mb4 */;


CREATE TABLE `expense` (`id` int NOT NULL AUTO_INCREMENT,
                                          `description` varchar(255) CHARACTER
                        SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
                                                               `claim_date` date NOT NULL,
                                                                                 `amount` int(11) NOT NULL,
                                                                                                  PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT
CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense`
--
 LOCK TABLES `expense` WRITE;

/*!40000 ALTER TABLE `expense` DISABLE KEYS */;


INSERT INTO `expense`
VALUES ('1',
        'buy ps',
        '2023-04-12',
        '222'), ('2',
                 'buy car',
                 '2023-04-12',
                 '100');

/*!40000 ALTER TABLE `expense` ENABLE KEYS */;

UNLOCK TABLES;

-- * use singular for tbl name
 -- 2023 Apr 19
-- drop table administration

DROP TABLE administration;

-- drop table users

DROP TABLE users;


DROP TABLE IF EXISTS `user`;

/*!40101 SET @saved_cs_client     = @@character_set_client */;

/*!50503 SET character_set_client = utf8mb4 */;


CREATE TABLE `user` (`id` int NOT NULL AUTO_INCREMENT,
                                       `name` varchar(255) CHARACTER
                     SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
                                                            `contact` varchar(255) CHARACTER
                     SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
                                                                    `username` varchar(255) CHARACTER
                     SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
                                                                    `role` varchar(255) CHARACTER
                     SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
                                                                    `upline` int DEFAULT NULL,
                                                                                         `status` varchar(255) CHARACTER
                     SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
                                                                    `password` varchar(255),
                                                                               PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT
CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--
 LOCK TABLES `user` WRITE;

/*!40000 ALTER TABLE `user` DISABLE KEYS */;


INSERT INTO `user`
VALUES (1,
        'Master Admin',
        '33366',
        'Masteradmin',
        'Masteradmin',
        0,
        'Active',
        '123456789'),(2,
                      '22666',
                      '33366',
                      'admin111',
                      'Superadmins',
                      1,
                      'Active',
                      '123456789'),(3,
                                    '22666',
                                    '33366',
                                    'Username',
                                    'Superadmins',
                                    1,
                                    'Active',
                                    'NULL'),(4,
                                             '1111',
                                             '111122',
                                             'hihihi',
                                             'Customer',
                                             1,
                                             'Active',
                                             'NULL');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;

UNLOCK TABLES;

