mysql>
ALTER TABLE CARD RENAME COLUMN reject_remark TO reject_remarks;

Query OK,
0 rows affected (0.33 sec) Records: 0 Duplicates: 0 Warnings: 0 mysql> mysql> mysql> mysql>
ALTER TABLE CARD RENAME COLUMN case_remark TO case_remarks;

Query OK,
0 rows affected (0.04 sec) Records: 0 Duplicates: 0 Warnings: 0 --
-- Table structure for table `rent_card`
--

DROP TABLE IF EXISTS `rent_card`;

/*!40101 SET @saved_cs_client     = @@character_set_client */;

/*!50503 SET character_set_client = utf8mb4 */;

--   `card_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,

CREATE TABLE `rent_card` (`id` int NOT NULL AUTO_INCREMENT,
                                            `card_id` int NOT NULL,
                                                          `from_date` date NOT NULL,
                                                                           `to_date` date NOT NULL,
                                                                                          `to_price` double(10,2) NOT NULL,
                                                                                                                  `insurance` double(10,2) NOT NULL,
                                                                                                                                           PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT
CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*!40101 SET character_set_client = @saved_cs_client */;

-- ???: online_user_id
 -- TODO: Price (RM), Card Status, This Month Rent(RM)
 -- TODO: LATER for below
 --
 -- Dumping data for table `rent_card`
 --
 LOCK TABLES `rent_card` WRITE;

/*!40000 ALTER TABLE `rent_card` DISABLE KEYS */;

/* INSERT INTO `rent_card`
        VALUES (1,
        20,
        'RHB card',
        '111111',
        'online_user_id',
        'online_password',
        'atm_password',
        'account_no',
        'otp_no',
        '111',
        'address_of_bank',
        'secure_word',
        'gmail_of_bank',
        NULL,
        NULL,
        NULL,
        316666.67,
        'Approved',
        1,
        '2023-4-28',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        1,
        '2023-4-28'), (2,
        3,
        'Am Card',
        '121212',
        'online_user_id',
        'online_password',
        'atm_password',
        'account_no',
        'otp_no',
        '1212',
        'address_of_bank',
        'secure_word',
        'gmail_of_bank',
        NULL,
        NULL,
        NULL,
        316666.67,
        'Approved',
        1,
        '2023-4-28',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        1,
        '2023-4-28'); */ /*!40000 ALTER TABLE `rent_card` ENABLE KEYS */;

UNLOCK TABLES;

///
ALTER TABLE `rent_card` ADD COLUMN `cased_by` int(11) DEFAULT NULL;


ALTER TABLE `rent_card` ADD COLUMN `cased_at` date DEFAULT NULL;


ALTER TABLE `rent_card` ADD COLUMN `case_remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL;


ALTER TABLE `rent_card` ADD COLUMN `user_id` int NOT NULL;

///
ALTER TABLE `rent_card` MODIFY `cased_at` datetime DEFAULT NULL;

///
ALTER TABLE `rent_card` ADD COLUMN `invoice_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL;

-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;

/*!40101 SET @saved_cs_client     = @@character_set_client */;

/*!50503 SET character_set_client = utf8mb4 */;

--   `card_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,

CREATE TABLE `payment` (`id` int NOT NULL AUTO_INCREMENT,
                                          `pay_date` date NOT NULL,
                                                          `pay_for` date NOT NULL,
                                                                         `amount` double(10,2) NOT NULL,
                                                                                               PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT
CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
 -- Dumping data for table `payment`
 --
 LOCK TABLES `payment` WRITE;

/*!40000 ALTER TABLE `payment` DISABLE KEYS */;


INSERT INTO `payment`
VALUES (1,
        '2023-04-12',
        '2023-4-1',
        '111');

/*!40000 ALTER TABLE `payment` ENABLE KEYS */;

UNLOCK TABLES;

///
ALTER TABLE `payment` ADD COLUMN `user_id` int NOT NULL;


UPDATE `payment`
SET user_id = 1;

/// -- Table structure for table `invoice_no`
--

DROP TABLE IF EXISTS `invoice_no`;

/*!40101 SET @saved_cs_client     = @@character_set_client */;

/*!50503 SET character_set_client = utf8mb4 */;

--   `card_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,

CREATE TABLE `invoice_no` (`id` int NOT NULL AUTO_INCREMENT,
                                             `end_of_month` date NOT NULL,
                                                                 `running_no` int NOT NULL,
                                                                                  PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT
CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
 -- Dumping data for table `invoice_no`
 --
 LOCK TABLES `invoice_no` WRITE;

/*!40000 ALTER TABLE `invoice_no` DISABLE KEYS */;

/* INSERT INTO `invoice_no`
VALUES (1,
        '2023-04-12',
        '2023-4-1',
        '111'); */ /*!40000 ALTER TABLE `invoice_no` ENABLE KEYS */;

UNLOCK TABLES;

///
ALTER TABLE rent_card ADD `no_of_days` int NOT NULL;


ALTER TABLE rent_card ADD `total` double(10,2) NOT NULL;

