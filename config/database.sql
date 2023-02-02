-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2023 at 08:35 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cryptoscope`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', '631c1de754e98780d71d60027d9ed27b', '09-09-2022 02:44:03 PM'),
(2, 'ramon1', '99834FF61E4114EF40A0A966231874B2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE `adminlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlog`
--

INSERT INTO `adminlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 1, 'admin', 0x3132372e302e302e3100000000000000, '2022-08-03 20:52:45', '04-08-2022 09:55:23 PM', 1),
(2, 1, 'admin', 0x3a3a3100000000000000000000000000, '2022-08-04 16:32:51', NULL, 1),
(3, 1, 'admin', 0x3132372e302e302e3100000000000000, '2022-08-04 23:54:36', '05-08-2022 05:54:20 AM', 1),
(4, 1, 'admin', 0x3a3a3100000000000000000000000000, '2022-08-05 08:12:34', NULL, 1),
(5, 1, 'admin', 0x3132372e302e302e3100000000000000, '2022-08-06 11:30:58', '07-08-2022 07:45:44 PM', 1),
(6, 1, 'admin', 0x3a3a3100000000000000000000000000, '2022-08-07 14:15:46', NULL, 1),
(7, 1, 'admin', 0x3132372e302e302e3100000000000000, '2022-09-05 12:08:04', NULL, 1),
(8, 1, 'admin', 0x3a3a3100000000000000000000000000, '2022-09-05 18:28:08', NULL, 1),
(9, 1, 'admin', 0x3a3a3100000000000000000000000000, '2022-09-05 19:12:44', NULL, 1),
(10, 1, 'admin', 0x3a3a3100000000000000000000000000, '2022-09-06 18:26:56', NULL, 1),
(11, 1, 'admin', 0x3a3a3100000000000000000000000000, '2022-09-07 19:48:38', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coins`
--

CREATE TABLE `coins` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `symbol` varchar(225) NOT NULL,
  `address` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coins`
--

INSERT INTO `coins` (`id`, `name`, `symbol`, `address`) VALUES
(1, 'Bitcoin', 'btc', 'bc1qfdpr9znslk72t4gy9p2gxttrkn4yaucnxmwhc4'),
(2, 'Etherium', 'eth', '0xfEE817C3214509b3f08218D550af4cBd8665A9b9'),
(4, 'Litecoin', 'ltc', 'ltc0o9eur094oinse');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`id`, `uid`, `amount`, `status`, `creationDate`) VALUES
(14, 28, '150', 0, '2022-09-09 14:31:23'),
(15, 28, '150', 0, '2022-09-09 14:32:43'),
(16, 28, '150', 0, '2022-09-09 14:33:01'),
(17, 0, '3.5', 0, '2022-09-14 23:48:54'),
(18, 0, '1.5', 0, '2022-09-14 23:48:54'),
(19, 0, '0.017013888888889', 0, '2022-09-14 23:48:54'),
(20, 28, '3.5', 0, '2022-09-14 23:49:16'),
(21, 28, '1.5', 0, '2022-09-14 23:49:16'),
(22, 28, '0.017013888888889', 0, '2022-09-14 23:49:16'),
(23, 28, '3.5', 0, '2022-09-15 11:48:51'),
(24, 28, '1.5', 0, '2022-09-15 11:48:51'),
(25, 28, '0.017013888888889', 0, '2022-09-15 11:48:51'),
(26, 28, '3.5', 0, '2022-09-15 11:49:19'),
(27, 28, '1.5', 0, '2022-09-15 11:49:19'),
(28, 28, '0.017013888888889', 0, '2022-09-15 11:49:19'),
(29, 28, '3.5', 0, '2022-09-15 11:49:21'),
(30, 28, '1.5', 0, '2022-09-15 11:49:21'),
(31, 28, '0.017013888888889', 1, '2022-09-15 11:49:21'),
(32, 28, '3.5', 1, '2022-09-15 11:49:23'),
(33, 28, '1.5', 0, '2022-09-15 11:49:23'),
(34, 28, '0.017013888888889', 1, '2022-09-15 11:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `investment`
--

CREATE TABLE `investment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan` varchar(225) DEFAULT NULL,
  `amount` varchar(225) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investment`
--

INSERT INTO `investment` (`id`, `user_id`, `plan`, `amount`, `creationDate`) VALUES
(1, 28, 'Silver', '600', '2022-09-05 18:39:27'),
(4, 28, 'Gold', '55000', '2022-09-08 14:14:42'),
(8, 28, 'Pro-Stater', '150', '2022-09-09 12:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `investment_address`
--

CREATE TABLE `investment_address` (
  `id` int(1) NOT NULL,
  `name` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investment_address`
--

INSERT INTO `investment_address` (`id`, `name`, `address`) VALUES
(1, 'usdt', '0xfEE817C3214509b3f08218D550af4cBd8665A9b9');

-- --------------------------------------------------------

--
-- Table structure for table `investment_plans`
--

CREATE TABLE `investment_plans` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `min` varchar(225) DEFAULT NULL,
  `max` varchar(225) DEFAULT NULL,
  `referral_bonus` varchar(225) DEFAULT NULL,
  `support` varchar(225) DEFAULT NULL,
  `days` varchar(3) DEFAULT NULL,
  `description` varchar(225) DEFAULT NULL,
  `profit` varchar(225) DEFAULT NULL,
  `hourly` varchar(225) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investment_plans`
--

INSERT INTO `investment_plans` (`id`, `name`, `min`, `max`, `referral_bonus`, `support`, `days`, `description`, `profit`, `hourly`, `creationDate`) VALUES
(1, 'Pro-Stater', '100', '500', '5', 'Full', '7', 'hourly', '0.5', '0.5', '2022-09-14 11:34:43'),
(2, 'Silver', '500', '50000', '5', 'Full', '30', 'weekly', '1.5', '0.2142857142857143', '2022-09-14 11:35:34'),
(3, 'Gold', '50000', '250000', '5', 'Full', '60', 'for 60 days', '3.5', '0.0024305555555556', '2022-09-14 11:39:03'),
(4, 'Diamond', '100000', '1000000', '5', 'Full', '90', 'for 90 days', '4.5', '0.0020833333333333', '2022-09-15 01:02:53'),
(5, 'IRA/401K', '5000', '10000000', '5', 'Full', '365', 'per annum', '9.5', '0.0010844748858447', '2022-09-15 01:03:47');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `type` varchar(225) NOT NULL,
  `coin` varchar(225) NOT NULL,
  `address` varchar(300) DEFAULT NULL,
  `code` varchar(115) DEFAULT NULL,
  `ref` varchar(300) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Pending',
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(226) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `type`, `coin`, `address`, `code`, `ref`, `status`, `date`, `updationDate`) VALUES
(21, 28, '0.005', 'Deposit', 'btc', NULL, '23773136', 'jdfpojdkfposjd', 'Confirmed', '2022-08-28 23:40:46', '09-09-2022 04:42:08 PM'),
(23, 28, '500', 'Withdrawal', 'btc', 'koidjfosjdfs0.', '08082172', NULL, 'Confirmed', '2022-08-29 11:24:32', '09-09-2022 04:42:53 PM'),
(25, 28, '70', 'Withdrawal', 'btc', 'khsoishjoisjhdfs', '46908363', NULL, 'Confirmed', '2022-08-29 11:40:19', NULL),
(26, 28, '0.3', 'Withdrawal', '', NULL, '94828598', NULL, 'Confirmed', '2022-08-29 18:50:40', '09-09-2022 04:42:00 PM'),
(28, 28, '150', 'Pro-Stater plan', '', NULL, '35811584', 'kdfholjdfkdjfwd', 'Pending', '2022-08-31 15:05:58', '09-09-2022 02:52:29 PM'),
(29, 28, '55000', 'Gold Plan', '', NULL, '78652237', NULL, 'Pending', '2022-08-31 15:06:45', '08-09-2022 04:17:01 PM'),
(30, 28, '0.05', 'Deposit', 'eth', NULL, '76463776', NULL, 'Pending', '2023-01-05 11:09:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `ref` varchar(225) DEFAULT NULL,
  `name` varchar(225) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `dob` varchar(225) DEFAULT NULL,
  `present_address` varchar(225) DEFAULT NULL,
  `permanent_address` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `country` varchar(225) DEFAULT NULL,
  `postal_code` varchar(225) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `image` varchar(225) DEFAULT 'avatar.svg',
  `invite` varchar(115) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `balance` varchar(225) DEFAULT '0',
  `premium` int(1) DEFAULT 0,
  `btc` varchar(225) NOT NULL DEFAULT '0.00000',
  `bnb-bep2` varchar(225) NOT NULL DEFAULT '0.00000',
  `bnb-bep20` varchar(225) NOT NULL DEFAULT '0.00000',
  `tether-erc` varchar(225) NOT NULL DEFAULT '0.00000',
  `tether-trc` varchar(225) NOT NULL DEFAULT '0.00000',
  `tether-bep20` varchar(225) NOT NULL DEFAULT '0.00000',
  `xrp` varchar(225) NOT NULL DEFAULT '0.00000',
  `bch` varchar(225) NOT NULL DEFAULT '0.00000',
  `ada` varchar(225) NOT NULL DEFAULT '0.00000',
  `btg` varchar(225) NOT NULL DEFAULT '0.00000',
  `doge` varchar(225) NOT NULL DEFAULT '0.00000',
  `tron` varchar(225) NOT NULL DEFAULT '0.00000',
  `etc` varchar(225) NOT NULL DEFAULT '0.00000',
  `eth` varchar(225) NOT NULL DEFAULT '0.00000',
  `ltc` varchar(225) NOT NULL DEFAULT '0.00000',
  `trx` varchar(225) NOT NULL DEFAULT '0.00000',
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `ref`, `name`, `phone`, `dob`, `present_address`, `permanent_address`, `city`, `country`, `postal_code`, `password`, `image`, `invite`, `code`, `status`, `balance`, `premium`, `btc`, `bnb-bep2`, `bnb-bep20`, `tether-erc`, `tether-trc`, `tether-bep20`, `xrp`, `bch`, `ada`, `btg`, `doge`, `tron`, `etc`, `eth`, `ltc`, `trx`, `creationDate`, `updationDate`) VALUES
(28, 'majorp', 'precious@gmail.com', NULL, 'Omagbemi Precious', '09033944592', '12-04-1995', '20,Old Brooklyn', '123,Central Square', 'Los Angeles', '', '56578484', '631c1de754e98780d71d60027d9ed27b', 'avatar.svg', NULL, '', 1, '385303.53402778', 0, '0.015', '0.5', '0.00030', '15', '2300', '0.00000', '0.00000', '0.00000', '0.00000', '0.00300', '5309', '0.00000', '0.00000', '0.00000', '12.400', '1240', '2022-09-05 16:53:28', '06-09-2022 12:15:03 PM'),
(31, 'majorp2', 'bignamepreciousonstage@gmail.com', 'majorp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '631c1de754e98780d71d60027d9ed27b', 'avatar.svg', NULL, '0', 0, '400', 0, '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '2022-09-05 16:53:28', NULL),
(33, 'dev', 'bignamepreciousonsetage@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '631c1de754e98780d71d60027d9ed27b', 'avatar.svg', NULL, '571795', 0, '400', 0, '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '2022-09-05 16:53:28', NULL),
(34, 'john', 'john@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '527bd5b5d689e2c32ae974c6229ff785', 'avatar.svg', NULL, '383964', 0, '0', 0, '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '2023-01-05 10:14:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userslog`
--

CREATE TABLE `userslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(225) DEFAULT NULL,
  `userip` varchar(250) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userslog`
--

INSERT INTO `userslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(83, 26, 'precious@gmail.com', '::1', '2022-08-27 09:45:21', NULL, 'Successful'),
(84, 26, 'precious@gmail.com', '::1', '2022-08-27 09:45:33', NULL, 'Successful'),
(85, 26, 'precious@gmail.com', '::1', '2022-08-27 09:47:00', NULL, 'Successful'),
(86, 26, 'precious@gmail.com', '::1', '2022-08-27 09:50:49', NULL, 'Successful'),
(87, 0, 'precious@gmail.com', '::1', '2022-08-27 13:16:47', NULL, 'Failed'),
(88, 0, 'precious@gmail.com', '::1', '2022-08-27 13:16:58', NULL, 'Failed'),
(89, 28, 'precious@gmail.com', '::1', '2022-08-27 13:17:31', NULL, 'Successful'),
(90, 28, 'precious@gmail.com', '::1', '2022-08-27 13:18:00', NULL, 'Successful'),
(91, 28, 'precious@gmail.com', '::1', '2022-08-27 16:44:27', NULL, 'Successful'),
(92, 28, 'precious@gmail.com', '::1', '2022-08-27 16:49:09', NULL, 'Successful'),
(93, 28, 'precious@gmail.com', '::1', '2022-08-27 16:56:11', NULL, 'Successful'),
(94, 28, 'precious@gmail.com', '::1', '2022-08-27 16:56:43', NULL, 'Successful'),
(95, 28, 'precious@gmail.com', '::1', '2022-08-27 18:09:26', NULL, 'Successful'),
(96, 28, 'precious@gmail.com', '::1', '2022-08-28 14:42:23', NULL, 'Successful'),
(97, 28, 'precious@gmail.com', '::1', '2022-08-28 20:25:59', NULL, 'Successful'),
(98, 28, 'precious@gmail.com', '127.0.0.1', '2022-08-28 21:01:15', NULL, 'Successful'),
(99, 28, 'precious@gmail.com', '::1', '2022-08-28 22:11:01', NULL, 'Successful'),
(100, 28, 'precious@gmail.com', '::1', '2022-08-28 23:11:46', NULL, 'Successful'),
(101, 28, 'precious@gmail.com', '::1', '2022-08-29 12:49:13', NULL, 'Successful'),
(102, 28, 'precious@gmail.com', '::1', '2022-08-29 12:52:06', NULL, 'Successful'),
(103, 31, 'bignamepreciousonstage@gmail.com', '::1', '2022-08-29 17:47:15', NULL, 'Successful'),
(104, 28, 'precious@gmail.com', '::1', '2022-08-29 17:47:31', NULL, 'Successful'),
(105, 28, 'precious@gmail.com', '::1', '2022-08-29 17:48:06', NULL, 'Successful'),
(106, 28, 'precious@gmail.com', '127.0.0.1', '2022-09-01 08:02:16', NULL, 'Successful'),
(107, 28, 'precious@gmail.com', '::1', '2022-09-01 16:47:41', NULL, 'Successful'),
(108, 28, 'precious@gmail.com', '::1', '2022-09-01 18:09:24', NULL, 'Successful'),
(109, 0, 'precious@gmail.com', '::1', '2022-09-02 11:33:49', NULL, 'Failed'),
(110, 28, 'precious@gmail.com', '::1', '2022-09-02 11:34:00', NULL, 'Successful'),
(111, 0, '', '127.0.0.1', '2022-09-03 09:54:10', NULL, 'Failed'),
(112, 28, 'precious@gmail.com', '127.0.0.1', '2022-09-03 09:54:16', NULL, 'Successful'),
(113, 28, 'precious@gmail.com', '::1', '2022-09-03 17:23:12', NULL, 'Successful'),
(114, 28, 'precious@gmail.com', '::1', '2022-09-03 17:47:19', NULL, 'Successful'),
(115, 28, 'precious@gmail.com', '::1', '2022-09-04 17:20:15', NULL, 'Successful'),
(116, 28, 'precious@gmail.com', '::1', '2022-09-04 17:41:38', NULL, 'Successful'),
(117, 28, 'precious@gmail.com', '::1', '2022-09-05 17:32:20', NULL, 'Successful'),
(118, 28, 'precious@gmail.com', '::1', '2022-09-06 09:39:32', NULL, 'Successful'),
(119, 28, 'precious@gmail.com', '::1', '2022-09-06 10:18:03', NULL, 'Successful'),
(120, 28, 'precious@gmail.com', '::1', '2022-09-07 13:02:24', NULL, 'Successful'),
(121, 28, 'precious@gmail.com', '::1', '2022-09-07 16:31:54', NULL, 'Successful'),
(122, 28, 'precious@gmail.com', '127.0.0.1', '2022-09-20 14:37:03', NULL, 'Successful'),
(123, 28, 'precious@gmail.com', '::1', '2022-09-20 15:22:33', NULL, 'Successful'),
(124, 0, 'bignamepreciousonstage@gmail.com', '127.0.0.1', '2022-10-29 23:36:39', NULL, 'Failed'),
(125, 0, 'bignamepreciousonstage@gmail.com', '127.0.0.1', '2022-10-29 23:36:54', NULL, 'Failed'),
(126, 28, 'precious@gmail.com', '127.0.0.1', '2022-10-29 23:37:05', NULL, 'Successful'),
(127, 28, 'precious@gmail.com', '127.0.0.1', '2022-11-28 19:07:06', NULL, 'Successful'),
(128, 0, 'precious@gmail.com', '127.0.0.1', '2022-12-13 22:20:51', NULL, 'Failed'),
(129, 0, '', '127.0.0.1', '2022-12-13 22:21:01', NULL, 'Failed'),
(130, 0, 'bignamepreciousonstage@gmail.com', '127.0.0.1', '2022-12-13 22:21:09', NULL, 'Failed'),
(131, 0, 'bignamepreciousonstage@gmail.com', '127.0.0.1', '2022-12-13 22:21:22', NULL, 'Failed'),
(132, 28, 'precious@gmail.com', '127.0.0.1', '2022-12-13 22:21:34', NULL, 'Successful'),
(133, 0, 'bignamepreciousonstage@gmail.com', '127.0.0.1', '2023-01-02 14:20:53', NULL, 'Failed'),
(134, 0, 'bignamepreciousonstage@gmail.com', '127.0.0.1', '2023-01-02 14:21:06', NULL, 'Failed'),
(135, 0, 'precious@gmail.com', '127.0.0.1', '2023-01-02 14:22:23', NULL, 'Failed'),
(136, 28, 'precious@gmail.com', '127.0.0.1', '2023-01-02 14:22:34', NULL, 'Successful'),
(137, 28, 'precious@gmail.com', '127.0.0.1', '2023-01-05 10:04:55', NULL, 'Successful'),
(138, 34, 'john@gmail.com', '127.0.0.1', '2023-01-05 10:14:46', NULL, 'Successful'),
(139, 28, 'precious@gmail.com', '127.0.0.1', '2023-01-05 16:01:36', NULL, 'Successful'),
(140, 28, 'precious@gmail.com', '127.0.0.1', '2023-01-05 16:02:32', NULL, 'Successful'),
(141, 28, 'precious@gmail.com', '127.0.0.1', '2023-01-07 22:03:55', NULL, 'Successful');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminlog`
--
ALTER TABLE `adminlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coins`
--
ALTER TABLE `coins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment`
--
ALTER TABLE `investment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment_address`
--
ALTER TABLE `investment_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment_plans`
--
ALTER TABLE `investment_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userslog`
--
ALTER TABLE `userslog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `adminlog`
--
ALTER TABLE `adminlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `coins`
--
ALTER TABLE `coins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `investment`
--
ALTER TABLE `investment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `investment_address`
--
ALTER TABLE `investment_address`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `investment_plans`
--
ALTER TABLE `investment_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `userslog`
--
ALTER TABLE `userslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
