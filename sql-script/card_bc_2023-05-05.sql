-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 05, 2023 at 12:45 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


SET AUTOCOMMIT = 0;


START TRANSACTION;


SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecadmin_99mlbank`
--
 -- --------------------------------------------------------
 --
-- Table structure for table `card`
--

CREATE TABLE `card` (`id` int(11) NOT NULL,
                                  `bank_id` int(11) NOT NULL,
                                                    `card_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                     `ic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                                                               `online_user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                                                                                                                     `online_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                                                                                                                                                                            `atm_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                                                                                                                                                                                                                                `account_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                                                                                                                                                                                                                                                                                  `otp_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                `card_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                               `address_of_bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      `secure_word` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         `gmail_of_bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              `home_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          `mother_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     `token_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              `monthly_cost` double(10,2) NOT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        `created_by` int(11) DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     `created_at` date DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               `rejected_by` int(11) DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             `rejected_at` date DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        `reject_remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     `cased_by` int(11) DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                `cased_at` date DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        `case_remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   `approved_by` int(11) DEFAULT NULL,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 `approved_at` date DEFAULT NULL) ENGINE=InnoDB DEFAULT
CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `bank_id`, `card_name`, `ic`, `online_user_id`, `online_password`, `atm_password`, `account_no`, `otp_no`, `card_no`, `address_of_bank`, `secure_word`, `gmail_of_bank`, `home_address`, `mother_name`, `token_key`, `monthly_cost`, `status`, `created_by`, `created_at`, `rejected_by`, `rejected_at`, `reject_remark`, `cased_by`, `cased_at`, `case_remark`, `approved_by`, `approved_at`)
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
        '2023-04-28',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        NULL,
        1,
        '2023-04-28'), (2,
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
                        '2023-04-28',
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        1,
                        '2023-04-28'), (8,
                                        2,
                                        'Name',
                                        'IC',
                                        'Online User ID',
                                        'Online Password2',
                                        'Atm Password',
                                        'Account No',
                                        'OTP No',
                                        'Card No/Company ID',
                                        'Address of Bank',
                                        'Secure word',
                                        'Gmail of Bank',
                                        '',
                                        '',
                                        '',
                                        666.00,
                                        'Approved',
                                        1,
                                        '2023-04-29',
                                        NULL,
                                        NULL,
                                        NULL,
                                        NULL,
                                        NULL,
                                        NULL,
                                        1,
                                        '2023-04-29'), (9,
                                                        1,
                                                        'TESTING Name',
                                                        '123456-71-8901',
                                                        'ABC123',
                                                        'OnlinePassword',
                                                        'AtmPassword',
                                                        'A123456B',
                                                        '123456',
                                                        '123-123-123',
                                                        'No 111, Jalan 111, Taman 111.',
                                                        'SecureWord',
                                                        'Gmail@Bank.com',
                                                        'No 222, Jalan 222, Taman 222.',
                                                        'Tan Ah Mei',
                                                        'XYZ Company',
                                                        0.00,
                                                        'Waiting for Approval',
                                                        1,
                                                        '2023-05-05',
                                                        NULL,
                                                        NULL,
                                                        NULL,
                                                        NULL,
                                                        NULL,
                                                        NULL,
                                                        NULL,
                                                        NULL);

--
-- Indexes for dumped tables
--
 --
-- Indexes for table `card`
--

ALTER TABLE `card` ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--
 --
-- AUTO_INCREMENT for table `card`
--

ALTER TABLE `card` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
                                                AUTO_INCREMENT=10;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- ALTER TABLE `card` MODIFY `cased_at` date DEFAULT NULL;