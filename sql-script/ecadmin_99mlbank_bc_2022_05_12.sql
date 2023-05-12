-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2023 at 01:57 PM
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
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `name`, `status`) VALUES
(1, 'Testing Testing 123', 'Inactive'),
(11, 'Announcement Name 2', 'Inactive'),
(13, 'This is an announcement!!!', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `name`) VALUES
(1, 'ALLIANCE BANK'),
(2, 'AMBANK'),
(3, 'AMBANK COMPANY'),
(4, 'ARGO'),
(5, 'ARGO COMPANY'),
(6, 'BSN'),
(7, 'BSN COMPANY'),
(8, 'CIMB'),
(9, 'CIMB COMPANY'),
(10, 'CIMB COMPANY TNG+DUITNOW'),
(11, 'CIMB CREDIT CARD'),
(12, 'HLB'),
(13, 'HLB COMPANY'),
(14, 'HLB CREDIT CARD'),
(15, 'MBB'),
(16, 'MBB COMPANY'),
(17, 'MBB TNG'),
(18, 'PBB'),
(19, 'PBB COMPANY'),
(20, 'RHB'),
(21, 'RHB COMPANY'),
(22, 'UOB COMPANY');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
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
  `approved_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `bank_id`, `card_name`, `ic`, `online_user_id`, `online_password`, `atm_password`, `account_no`, `otp_no`, `card_no`, `address_of_bank`, `secure_word`, `gmail_of_bank`, `home_address`, `mother_name`, `token_key`, `monthly_cost`, `status`, `created_by`, `created_at`, `rejected_by`, `rejected_at`, `reject_remark`, `cased_by`, `cased_at`, `case_remark`, `approved_by`, `approved_at`) VALUES
(1, 20, 'RHB card', '111111', 'online_user_id', 'online_password', 'atm_password', 'account_no', 'otp_no', '111', 'address_of_bank', 'secure_word', 'gmail_of_bank', NULL, NULL, NULL, 316666.67, 'Approved', 1, '2023-04-28', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-04-28'),
(2, 3, 'Am Card', '121212', 'online_user_id', 'online_password', 'atm_password', 'account_no', 'otp_no', '1212', 'address_of_bank', 'secure_word', 'gmail_of_bank', NULL, NULL, NULL, 316666.67, 'Approved', 1, '2023-04-28', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-04-28'),
(8, 2, 'Name', 'IC', 'Online User ID', 'Online Password2', 'Atm Password', 'Account No', 'OTP No', 'Card No/Company ID', 'Address of Bank', 'Secure word', 'Gmail of Bank', '', '', '', 666.00, 'Approved', 1, '2023-04-29', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-04-29'),
(9, 1, 'TESTING Name', '123456-71-8901', 'ABC123', 'OnlinePassword', 'AtmPassword', 'A123456B', '123456', '123-123-123', 'No 111, Jalan 111, Taman 111.', 'SecureWord', 'Gmail@Bank.com', 'No 222, Jalan 222, Taman 222.', 'Tan Ah Mei', 'XYZ Company', 0.00, 'Waiting for Approval', 1, '2023-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `claim_date` date NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `description`, `claim_date`, `amount`) VALUES
(1, 'buy ps', '2023-04-12', 222),
(2, 'buy car', '2023-04-12', 100);

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`id`, `user_id`, `pay_date`, `amount`, `remarks`) VALUES
(1, 1, '2023-04-11', 1111, 'for emergency'),
(2, 3, '2023-04-12', 1000, 'for emergency111');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `upline` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `contact`, `username`, `role`, `upline`, `status`, `password`) VALUES
(1, 'Master Admin', '33366', 'Masteradmin', 'Masteradmin', 0, 'Active', '123456789'),
(2, '22666', '33366', 'admin111', 'Superadmins', 1, 'Active', '123456789'),
(3, 'Name', '33366', 'Username', 'Superadmins', 1, 'Active', 'NULL'),
(4, '1111', '111122', 'hihihi', 'Customer', 1, 'Active', 'NULL'),
(10, 'Name', 'Contact No', 'Username', 'Customer', 1, 'Active', NULL),
(11, 'A B C', '0123456789', 'abc', 'Customer', 1, 'Active', '123456789'),
(12, 'Name 2', 'Contact No 2', 'Username 2', 'Superadmins', 1, 'Inactive', '123456789'),
(13, '22', '32', '1', 'Customer', 1, 'Active', '123456789'),
(14, 'GANINAVOO', '3514', 'GANINAVOO ', 'Superadmins', 1, 'Inactive', '123456789'),
(15, 'kopi13', '1', 'kopi13', 'Customer', 1, 'Active', '123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rent`
--
ALTER TABLE `rent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
