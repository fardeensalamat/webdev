-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 02, 2022 at 04:32 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softcode`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_transactions`
--

CREATE TABLE `balance_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `subscriber_id` int(10) UNSIGNED DEFAULT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `moved_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `new_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `addedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `balance_transactions`
--

INSERT INTO `balance_transactions` (`id`, `user_id`, `subscriber_id`, `from`, `to`, `purpose`, `previous_balance`, `moved_balance`, `new_balance`, `type`, `type_id`, `details`, `addedby_id`, `created_at`, `updated_at`) VALUES
(1, 2, 32, 'subscriber', 'user', 'move_to_wallet', '0.00', '30.00', '30.00', 'move_to_wallet', NULL, 'Balance moved from my subscriber account 011000000016744 to my cashout wallet', 2, '2021-03-08 23:09:15', '2021-03-08 23:09:15'),
(2, 2, NULL, 'user', 'user', 'withdraw', '30.00', '10.00', '20.00', 'mobile_recharge', NULL, 'Successfully TK 10 recharged in 01918515567. Thank you for using softcode mobile recharge solution.', 2, '2021-03-09 07:15:30', '2021-03-28 08:09:25'),
(3, 2, NULL, 'user', 'user', 'deposit', '20.00', '1000.00', '1020.00', 'deposit_by_bkash', NULL, 'order #1 for deposit to my balance.', 2, '2021-03-09 23:39:42', '2021-03-09 23:39:42'),
(4, 2, NULL, 'user', 'user', 'withdraw', '1020.00', '10.00', '1010.00', 'mobile_recharge', NULL, 'Successfully TK 10 recharged in 01518643843. Thank you for using softcode mobile recharge solution.', 2, '2021-03-09 23:56:08', '2021-03-28 08:09:25'),
(5, 2, 32, 'user', 'user', 'withdraw', '1010.00', '10.00', '1000.00', 'mobile_recharge', NULL, 'Successfully TK 10 recharged in 01518643843. Thank you for using softcode mobile recharge solution.', 2, '2021-03-09 23:59:06', '2021-03-28 08:09:25'),
(6, 2, 32, 'user', 'user', 'deposit', '1000.00', '150.00', '1150.00', 'deposit_by_bkash', NULL, 'order #2 for deposit to my balance.', 2, '2021-03-10 02:17:34', '2021-03-10 02:17:34'),
(7, 2, 32, 'user', 'user', 'deposit', '1150.00', '200.00', '1350.00', 'deposit_by_bkash', NULL, 'order #3 for deposit to my balance.', 2, '2021-03-10 02:20:01', '2021-03-10 02:20:01'),
(8, 2, 32, 'user', 'admin', 'job_post', '1290.00', '60.00', '1230.00', 'order', 5, '60 TK deducted from my balance for job post.', 2, '2021-03-10 04:24:25', '2021-03-10 04:24:25'),
(9, 2, 32, 'user', 'admin', 'job_post', '1230.00', '60.00', '1170.00', 'order', 6, '60 TK deducted from my balance for job post.', 2, '2021-03-10 04:24:54', '2021-03-10 04:24:54'),
(10, 2, 32, 'user', 'admin', 'job_post', '1170.00', '31.00', '1139.00', 'order', 7, '31 TK deducted from my balance for job post.', 2, '2021-03-10 04:53:34', '2021-03-10 04:53:34'),
(11, 2, 53, 'admin', 'admin', 'reward', '90.00', '0.00', '90.00', 'joining_reward', NULL, 'Reward balance 0 of SubcriberPayment of #26 transfered from joining balance to reward balance', 2, '2021-03-10 05:33:27', '2021-03-10 05:33:27'),
(12, 2, 32, 'user', 'admin', 'job_post', '1139.00', '1000.00', '139.00', 'order', 8, '1000 TK deducted from my balance for job post.', 2, '2021-03-11 02:12:16', '2021-03-11 02:12:16'),
(13, 2, 32, 'user', 'admin', 'job_post', '139.00', '50.00', '89.00', 'order', 9, '50 TK deducted from my balance for job post.', 2, '2021-03-11 02:14:59', '2021-03-11 02:14:59'),
(14, 2, 32, 'user', 'admin', 'job_post', '89.00', '20.00', '69.00', 'order', 10, '20 TK deducted from my balance for job post.', 2, '2021-03-11 05:13:03', '2021-03-11 05:13:03'),
(15, 2, 32, 'user', 'admin', 'job_post', '69.00', '20.00', '49.00', 'order', 11, '20 TK deducted from my balance for job post.', 2, '2021-03-11 07:35:21', '2021-03-11 07:35:21'),
(16, 1, 54, 'admin', 'admin', 'reward', '180.00', '0.00', '180.00', 'joining_reward', NULL, 'Reward balance 0 of SubcriberPayment of #27 transfered from joining balance to reward balance', 2, '2021-03-12 22:44:54', '2021-03-12 22:44:54'),
(17, 37, 55, 'admin', 'admin', 'reward', '270.00', '0.00', '270.00', 'joining_reward', NULL, 'Reward balance 0 of SubcriberPayment of #11 transfered from joining balance to reward balance', 2, '2021-03-13 07:16:10', '2021-03-13 07:16:10'),
(18, 2, 32, 'user', 'user', 'deposit', '49.00', '400.00', '449.00', 'order', 4, 'order #4 for deposit to my balance.', 2, '2021-03-13 23:50:46', '2021-03-13 23:50:46'),
(19, 2, 32, 'user', 'user', 'deposit', '449.00', '100.00', '549.00', 'order', 2, 'order #2 for deposit to my balance.', 2, '2021-03-14 00:37:05', '2021-03-14 00:37:05'),
(20, 2, 32, 'user', 'user', 'deposit', '549.00', '500.00', '1049.00', 'order', 3, 'order #3 for deposit to my balance.', 2, '2021-03-14 00:41:09', '2021-03-14 00:41:09'),
(21, 2, 32, 'user', 'user', 'deposit', '1049.00', '100.00', '1149.00', 'order', 4, 'order #4 for deposit to my balance.', 2, '2021-03-14 00:57:13', '2021-03-14 00:57:13'),
(22, 2, 32, 'user', 'admin', 'job_post', '1149.00', '20.00', '1129.00', 'order', 6, '20.0000 TK deducted from my balance for job post.', 2, '2021-03-14 03:24:06', '2021-03-14 03:24:06'),
(23, 2, 32, 'user', 'admin', 'job_post', '1129.00', '800.00', '329.00', 'order', 7, '800 TK deducted from my balance for job post.', 2, '2021-03-14 03:32:31', '2021-03-14 03:32:31'),
(24, 2, 32, 'user', 'admin', 'job_post', '329.00', '16.00', '313.00', 'order', 8, '16 TK deducted from my balance for job post.', 2, '2021-03-14 03:33:10', '2021-03-14 03:33:10'),
(25, 42, 56, 'admin', 'admin', 'reward', '360.00', '0.00', '360.00', 'joining_reward', NULL, 'Reward balance 0 of SubcriberPayment of #28 transfered from joining balance to reward balance', 2, '2021-03-14 03:46:10', '2021-03-14 03:46:10'),
(26, 44, 57, 'admin', 'admin', 'reward', '450.00', '0.00', '450.00', 'joining_reward', NULL, 'Reward balance 0 of SubcriberPayment of #30 transfered from joining balance to reward balance', 2, '2021-03-14 04:35:30', '2021-03-14 04:35:30'),
(27, 46, 58, 'admin', 'admin', 'reward', '540.00', '0.00', '540.00', 'joining_reward', NULL, 'Reward balance 0 of SubcriberPayment of #31 transfered from joining balance to reward balance', 2, '2021-03-14 04:36:09', '2021-03-14 04:36:09'),
(28, 43, 59, 'admin', 'admin', 'reward', '630.00', '0.00', '630.00', 'joining_reward', NULL, 'Reward balance 0 of SubcriberPayment of #29 transfered from joining balance to reward balance', 2, '2021-03-14 04:36:48', '2021-03-14 04:36:48'),
(29, 47, 60, 'admin', 'admin', 'reward', '720.00', '0.00', '720.00', 'joining_reward', NULL, 'Reward balance 0 of SubcriberPayment of #32 transfered from joining balance to reward balance', 2, '2021-03-14 04:59:37', '2021-03-14 04:59:37'),
(30, 2, 32, 'user', 'admin', 'job_post', '313.00', '20.00', '293.00', 'order', 9, '20 TK deducted from my balance for job post.', 2, '2021-03-14 08:03:42', '2021-03-14 08:03:42'),
(31, 2, 32, 'user', 'admin', 'job_post', '293.00', '110.00', '183.00', 'order', 10, '110 TK deducted from my balance for job post.', 2, '2021-03-14 08:16:18', '2021-03-14 08:16:18'),
(32, 2, 32, 'user', 'user', 'deposit', '183.00', '100.00', '283.00', 'order', 11, 'order #11 for deposit to my balance.', 2, '2021-03-15 02:41:28', '2021-03-15 02:41:28'),
(33, 2, 32, 'user', 'user', 'deposit', '283.00', '100.00', '383.00', 'order', 12, 'order #12 for deposit to my balance.', 2, '2021-03-15 02:51:51', '2021-03-15 02:51:51'),
(34, 2, 32, 'user', 'user', 'deposit', '383.00', '500.00', '883.00', 'order', 15, 'order #15 for deposit to my balance.', 2, '2021-03-15 03:45:24', '2021-03-15 03:45:24'),
(35, 2, 32, 'user', 'user', 'deposit', '883.00', '150.00', '1033.00', 'order', 14, 'order #14 for deposit to my balance.', 2, '2021-03-15 03:45:30', '2021-03-15 03:45:30'),
(36, 2, 32, 'user', 'user', 'deposit', '1033.00', '100.00', '1133.00', 'order', 13, 'order #13 for deposit to my balance.', 2, '2021-03-15 03:45:55', '2021-03-15 03:45:55'),
(37, 2, 32, 'user', 'user', 'deposit', '1133.00', '300.00', '1433.00', 'order', 17, 'order #17 for deposit to my balance.', 2, '2021-03-15 03:48:21', '2021-03-15 03:48:21'),
(38, 2, 32, 'user', 'user', 'deposit', '1433.00', '400.00', '1833.00', 'order', 16, 'order #16 for deposit to my balance.', 2, '2021-03-15 03:48:28', '2021-03-15 03:48:28'),
(39, 2, 32, 'user', 'admin', 'job_post', '1833.00', '120.00', '1713.00', 'order', 18, '120 TK deducted from my balance for job post.', 2, '2021-03-15 05:00:30', '2021-03-15 05:00:30'),
(40, 2, 32, 'user', 'admin', 'job_post', '1713.00', '120.00', '1593.00', 'order', 19, '120 TK deducted from my balance for job post.', 2, '2021-03-15 05:00:59', '2021-03-15 05:00:59'),
(41, 2, 32, 'user', 'admin', 'job_post', '1593.00', '30.00', '1563.00', 'order', 20, '30 TK deducted from my balance for job post.', 2, '2021-03-15 05:01:47', '2021-03-15 05:01:47'),
(42, 2, 33, 'admin', 'subscriber', 'work_done', '0.00', '5.00', '5.00', 'APP\\Models\\FreelanceJobWork', 1, 'balance 5.0000 TK transfer to admin from subscriber for work approved.', 2, '2021-03-15 07:20:24', '2021-07-06 18:30:32'),
(43, 2, 33, 'admin', 'subscriber', 'work_done', '0.00', '5.00', '5.00', 'APP\\Models\\FreelanceJobWork', 5, 'balance 5.0000 TK transfer to admin from subscriber for work approved.', 2, '2021-03-15 07:21:52', '2021-07-06 18:30:32'),
(44, 2, 33, 'admin', 'subscriber', 'work_done', '0.00', '5.00', '5.00', 'APP\\Models\\FreelanceJobWork', 6, 'balance 5.0000 TK transfer to admin from subscriber for work approved.', 2, '2021-03-15 07:22:12', '2021-07-06 18:30:32'),
(45, 2, 32, 'admin', 'subscriber', 'work_done', '66.30', '5.00', '71.30', 'APP\\Models\\FreelanceJobWork', 7, 'balance 5.0000 TK transfer to admin from subscriber for work approved.', 2, '2021-03-15 07:24:06', '2021-07-06 18:30:32'),
(46, 2, 43, 'admin', 'subscriber', 'work_done', '20.00', '5.00', '25.00', 'APP\\Models\\FreelanceJobWork', 10, 'balance 5.0000 TK transfer to admin from subscriber for work approved.', 2, '2021-03-15 07:27:01', '2021-07-06 18:30:32'),
(47, 2, 53, 'admin', 'subscriber', 'work_done', '10.00', '5.00', '15.00', 'APP\\Models\\FreelanceJobWork', 11, 'balance 5.0000 TK transfer to admin from subscriber for work approved.', 2, '2021-03-15 07:44:44', '2021-07-06 18:30:32'),
(48, 2, NULL, 'user', 'user', 'withdraw', '1563.00', '10.00', '1553.00', 'mobile_recharge', NULL, 'Successfully TK 10 recharged in 01518643843. Thank you for using softcode mobile recharge solution.', 2, '2021-03-16 04:52:51', '2021-03-28 08:09:25'),
(49, 2, NULL, 'user', 'user', 'withdraw', '1553.00', '10.00', '1543.00', 'mobile_recharge', NULL, 'Successfully TK 10 recharged in 01518643843. Thank you for using softcode mobile recharge solution.', 2, '2021-03-16 04:53:28', '2021-03-28 08:09:25'),
(50, 2, 32, 'user', 'user', 'deposit', '1543.00', '100.00', '1643.00', 'order', 21, 'order #21 for deposit to my balance.', 2, '2021-03-16 06:52:54', '2021-03-16 06:52:54'),
(51, 2, 32, 'user', 'user', 'deposit', '1643.00', '200.00', '1843.00', 'order', 23, 'order #23 for deposit to my balance.', 2, '2021-03-16 06:54:25', '2021-03-16 06:54:25'),
(52, 2, NULL, 'user', 'user', 'withdraw', '1843.00', '10.00', '1833.00', 'mobile_recharge', NULL, 'Successfully TK 10 recharged in 01753007145. Thank you for using softcode mobile recharge solution.', 2, '2021-03-16 06:56:32', '2021-03-28 08:09:25'),
(53, 2, 32, 'user', 'admin', 'job_post', '1833.00', '20.00', '1813.00', 'order', 24, '20 TK deducted from my balance for job post.', 2, '2021-03-16 08:15:00', '2021-03-16 08:15:00'),
(54, 2, NULL, 'user', 'user', 'withdraw', '1813.00', '10.00', '1803.00', 'mobile_recharge', NULL, 'Successfully TK 10 recharged in 01918515567. Thank you for using softcode mobile recharge solution.', 2, '2021-03-16 09:10:38', '2021-03-28 08:09:25'),
(55, 2, 43, 'admin', 'subscriber', 'work_done', '20.00', '5.00', '25.00', 'APP\\Models\\FreelanceJobWork', 12, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-21 01:01:16', '2021-07-06 18:30:32'),
(56, 2, 32, 'user', 'admin', 'job_post', '1803.00', '100.00', '1703.00', 'order', 25, '100 TK deducted from my balance for job post.', 2, '2021-03-21 01:38:52', '2021-03-21 01:38:52'),
(57, 2, 32, 'user', 'admin', 'job_post', '1703.00', '20.00', '1683.00', 'order', 26, '20 TK deducted from my balance for job post.', 2, '2021-03-21 01:46:50', '2021-03-21 01:46:50'),
(58, 2, 42, 'admin', 'subscriber', 'work_done', '20.00', '5.00', '25.00', 'APP\\Models\\FreelanceJobWork', 13, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-21 01:54:09', '2021-07-06 18:30:32'),
(59, 2, 62, 'admin', 'subscriber', 'work_done', '10.00', '5.00', '15.00', 'APP\\Models\\FreelanceJobWork', 14, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-21 05:43:18', '2021-07-06 18:30:33'),
(60, 2, 61, 'admin', 'subscriber', 'work_done', '10.00', '5.00', '15.00', 'APP\\Models\\FreelanceJobWork', 15, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-21 05:47:48', '2021-07-06 18:30:33'),
(61, 2, 32, 'user', 'admin', 'job_post', '1683.00', '10.00', '1673.00', 'order', 27, '10 TK deducted from my balance for job post.', 2, '2021-03-21 06:10:04', '2021-03-21 06:10:04'),
(62, 2, 33, 'admin', 'subscriber', 'work_done', '5.00', '5.00', '10.00', 'APP\\Models\\FreelanceJobWork', 21, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-21 06:56:00', '2021-07-06 18:30:33'),
(63, 2, 42, 'admin', 'subscriber', 'work_done', '25.00', '5.00', '30.00', 'APP\\Models\\FreelanceJobWork', 22, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-21 06:56:00', '2021-07-06 18:30:33'),
(64, 2, 32, 'user', 'admin', 'job_post', '1673.00', '10.00', '1663.00', 'order', 28, '10 TK deducted from my balance for job post.', 2, '2021-03-22 05:30:15', '2021-03-22 05:30:15'),
(65, 2, 32, 'user', 'user', 'deposit', '1663.00', '100.00', '1763.00', 'order', 31, 'order #31 for deposit to my balance.', 2, '2021-03-23 00:40:08', '2021-03-23 00:40:08'),
(66, 2, 32, 'user', 'user', 'deposit', '1763.00', '100.00', '1863.00', 'order', 33, 'order #33 for deposit to my balance.', 2, '2021-03-23 00:40:18', '2021-03-23 00:40:18'),
(67, 2, 32, 'user', 'user', 'deposit', '1863.00', '100.00', '1963.00', 'order', 34, 'order #34 for deposit to my balance.', 2, '2021-03-23 00:40:21', '2021-03-23 00:40:21'),
(68, 2, NULL, 'user', 'user', 'withdraw', '1963.00', '10.00', '1953.00', 'mobile_recharge', NULL, 'Successfully TK 10 recharged in 01518643843. Thank you for using softcode mobile recharge solution.', 2, '2021-03-23 02:08:53', '2021-03-28 08:09:25'),
(69, 2, 33, 'user', 'admin', 'job_post', '1913.00', '10.00', '1903.00', 'order', 37, '10 TK deducted from my balance for job post.', 2, '2021-03-23 22:04:40', '2021-03-23 22:04:40'),
(70, 2, 33, 'user', 'admin', 'job_post', '1903.00', '40.00', '1863.00', 'order', 38, '40 TK deducted from my balance for job post.', 2, '2021-03-23 22:10:28', '2021-03-23 22:10:28'),
(71, 2, 32, 'user', 'user', 'deposit', '1863.00', '100.00', '1963.00', 'order', 30, 'order #30 for deposit to my balance.', 2, '2021-03-23 22:55:01', '2021-03-23 22:55:01'),
(72, 2, 32, 'user', 'user', 'deposit', '1963.00', '100.00', '2063.00', 'order', 39, 'order #39 for deposit to my balance.', 2, '2021-03-23 22:55:05', '2021-03-23 22:55:05'),
(73, 2, 32, 'user', 'user', 'deposit', '2063.00', '1000.00', '3063.00', 'order', 41, 'order #41 for deposit to my balance.', 2, '2021-03-23 23:13:48', '2021-03-23 23:13:48'),
(74, 2, 32, 'user', 'admin', 'job_post', '3063.00', '10.00', '3053.00', 'order', 42, '10 TK deducted from my balance for job post.', 2, '2021-03-23 23:33:18', '2021-03-23 23:33:18'),
(75, 2, 32, 'user', 'admin', 'job_post', '3053.00', '20.00', '3033.00', 'order', 43, '20 TK deducted from my balance for job post.', 2, '2021-03-24 06:48:22', '2021-03-24 06:48:22'),
(76, 2, 32, 'user', 'admin', 'job_post', '3033.00', '100.00', '2933.00', 'order', 44, '100 TK deducted from my balance for job post.', 2, '2021-03-24 06:57:14', '2021-03-24 06:57:14'),
(77, 2, 32, 'user', 'admin', 'job_post', '2933.00', '100.00', '2833.00', 'order', 45, '100 TK deducted from my balance for job post.', 2, '2021-03-24 07:17:08', '2021-03-24 07:17:08'),
(78, 2, 32, 'user', 'admin', 'job_post', '2833.00', '20.00', '2813.00', 'order', 46, '20 TK deducted from my balance for job post.', 2, '2021-03-24 23:17:36', '2021-03-24 23:17:36'),
(79, 2, 62, 'admin', 'subscriber', 'work_done', '15.00', '5.00', '20.00', 'APP\\Models\\FreelanceJobWork', 23, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-25 00:11:56', '2021-07-06 18:30:33'),
(80, 2, 32, 'user', 'admin', 'job_post', '2813.00', '20.00', '2793.00', 'order', 47, '20 TK deducted from my balance for job post.', 2, '2021-03-25 01:33:19', '2021-03-25 01:33:19'),
(81, 2, 32, 'admin', 'subscriber', 'job_post', '84.80', '1.00', '2793.00', 'order', 47, '1 TK add to subscriber balance from admin.', 2, '2021-03-25 01:33:19', '2021-03-25 01:33:19'),
(82, 2, 32, 'admin', 'subscriber', 'job_post', '85.80', '0.00', '85.80', 'order', 47, '0 TK add to subscriber balance from admin.', 2, '2021-03-25 01:33:19', '2021-03-25 01:33:19'),
(83, 2, 32, 'admin', 'subscriber', 'job_post', '85.80', '0.00', '85.80', 'order', 47, '0 TK add to subscriber balance from admin.', 2, '2021-03-25 01:33:19', '2021-03-25 01:33:19'),
(84, 2, 32, 'user', 'admin', 'job_post', '2793.00', '100.00', '2693.00', 'order', 48, '100 TK deducted from my balance for job post.', 2, '2021-03-25 01:35:58', '2021-03-25 01:35:58'),
(85, 2, 32, 'admin', 'subscriber', 'job_post', '85.80', '5.00', '2693.00', 'order', 48, '5 TK add to subscriber balance from admin.', 2, '2021-03-25 01:35:58', '2021-03-25 01:35:58'),
(86, 2, 32, 'admin', 'subscriber', 'job_post', '90.80', '0.00', '90.80', 'order', 48, '0 TK add to subscriber balance from admin.', 2, '2021-03-25 01:35:58', '2021-03-25 01:35:58'),
(87, 2, 32, 'admin', 'subscriber', 'job_post', '90.80', '0.00', '90.80', 'order', 48, '0 TK add to subscriber balance from admin.', 2, '2021-03-25 01:35:58', '2021-03-25 01:35:58'),
(88, 2, 32, 'user', 'admin', 'job_post', '2693.00', '12.00', '2681.00', 'order', 49, '12 TK deducted from my balance for job post.', 2, '2021-03-25 03:37:00', '2021-03-25 03:37:00'),
(89, 2, 32, 'admin', 'subscriber', 'job_post', '90.80', '0.60', '2681.00', 'order', 49, '0.6 TK add to subscriber balance from admin.', 2, '2021-03-25 03:37:00', '2021-03-25 03:37:00'),
(90, 2, 32, 'admin', 'subscriber', 'job_post', '91.40', '0.00', '91.40', 'order', 49, '0 TK add to subscriber balance from admin.', 2, '2021-03-25 03:37:00', '2021-03-25 03:37:00'),
(91, 2, 32, 'admin', 'subscriber', 'job_post', '91.40', '0.00', '91.40', 'order', 49, '0 TK add to subscriber balance from admin.', 2, '2021-03-25 03:37:00', '2021-03-25 03:37:00'),
(92, 2, 32, 'user', 'admin', 'job_post', '2681.00', '20.00', '2661.00', 'order', 50, '20 TK deducted from my balance for job post.', 2, '2021-03-27 22:34:59', '2021-03-27 22:34:59'),
(93, 2, 32, 'admin', 'subscriber', 'job_post', '91.40', '1.00', '2661.00', 'order', 50, '1 TK add to subscriber balance from admin.', 2, '2021-03-27 22:34:59', '2021-03-27 22:34:59'),
(94, 2, 32, 'admin', 'subscriber', 'job_post', '92.40', '0.00', '92.40', 'order', 50, '0 TK add to subscriber balance from admin.', 2, '2021-03-27 22:34:59', '2021-03-27 22:34:59'),
(95, 2, 32, 'admin', 'subscriber', 'job_post', '92.40', '0.00', '92.40', 'order', 50, '0 TK add to subscriber balance from admin.', 2, '2021-03-27 22:34:59', '2021-03-27 22:34:59'),
(96, 2, 33, 'admin', 'subscriber', 'work_done', '12.50', '5.00', '17.50', 'APP\\Models\\FreelanceJobWork', 27, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-27 23:34:11', '2021-07-06 18:30:33'),
(97, 2, 42, 'admin', 'subscriber', 'work_done', '30.00', '5.00', '35.00', 'APP\\Models\\FreelanceJobWork', 30, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-27 23:34:11', '2021-07-06 18:30:33'),
(98, 2, 62, 'admin', 'subscriber', 'work_done', '20.00', '0.00', '20.00', 'APP\\Models\\FreelanceJobWork', 31, 'balance 0.0000 TK transfer to subscriber for work approved.', 2, '2021-03-28 00:32:20', '2021-07-06 18:30:33'),
(99, 2, 62, 'admin', 'subscriber', 'work_done', '20.00', '5.00', '25.00', 'APP\\Models\\FreelanceJobWork', 33, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-28 00:47:37', '2021-07-06 18:30:33'),
(100, 2, 33, 'admin', 'subscriber', 'work_done', '17.50', '5.00', '22.50', 'APP\\Models\\FreelanceJobWork', 34, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-28 01:19:18', '2021-07-06 18:30:33'),
(101, 2, 53, 'admin', 'subscriber', 'work_done', '10.00', '5.00', '15.00', 'APP\\Models\\FreelanceJobWork', 35, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-28 01:28:12', '2021-07-06 18:30:33'),
(102, 2, 33, 'admin', 'subscriber', 'work_done', '22.50', '5.00', '27.50', 'APP\\Models\\FreelanceJobWork', 36, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-28 01:28:21', '2021-07-06 18:30:33'),
(103, 2, 42, 'admin', 'subscriber', 'work_done', '35.00', '5.00', '40.00', 'work_done', NULL, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-03-28 01:28:21', '2021-03-28 01:28:21'),
(104, 2, 33, 'user', 'admin', 'job_post', '2661.00', '50.00', '2611.00', 'order', 51, '50 TK deducted from my balance for job post.', 2, '2021-03-31 08:19:06', '2021-03-31 08:19:06'),
(105, 2, 33, 'admin', 'subscriber', 'job_post', '27.50', '2.50', '2611.00', 'order', 51, '2.5 TK add to subscriber balance from admin.', 2, '2021-03-31 08:19:06', '2021-03-31 08:19:06'),
(106, 2, 33, 'admin', 'subscriber', 'job_post', '30.00', '0.00', '30.00', 'order', 51, '0 TK add to subscriber balance from admin.', 2, '2021-03-31 08:19:06', '2021-03-31 08:19:06'),
(107, 2, 33, 'admin', 'subscriber', 'job_post', '30.00', '0.00', '30.00', 'order', 51, '0 TK add to subscriber balance from admin.', 2, '2021-03-31 08:19:06', '2021-03-31 08:19:06'),
(108, 2, 32, 'user', 'admin', 'job_post', '2611.00', '20.00', '2591.00', 'order', 52, '20 TK deducted from my balance for job post.', 2, '2021-03-31 08:54:30', '2021-03-31 08:54:30'),
(109, 2, 32, 'admin', 'subscriber', 'job_post', '92.40', '1.00', '2591.00', 'order', 52, '1 TK add to subscriber balance from admin.', 2, '2021-03-31 08:54:30', '2021-03-31 08:54:30'),
(110, 2, 32, 'admin', 'subscriber', 'job_post', '93.40', '0.00', '93.40', 'order', 52, '0 TK add to subscriber balance from admin.', 2, '2021-03-31 08:54:30', '2021-03-31 08:54:30'),
(111, 2, 32, 'admin', 'subscriber', 'job_post', '93.40', '0.00', '93.40', 'order', 52, '0 TK add to subscriber balance from admin.', 2, '2021-03-31 08:54:30', '2021-03-31 08:54:30'),
(112, 2, 32, 'user', 'admin', 'job_post', '2591.00', '20.00', '2571.00', 'order', 53, '20 TK deducted from my balance for job post updated work.', 2, '2021-03-31 10:41:09', '2021-03-31 10:41:09'),
(113, 2, 32, 'user', 'admin', 'job_post', '2571.00', '20.00', '2551.00', 'order', 54, '20 TK deducted from my balance for job post updated work.', 2, '2021-03-31 10:46:43', '2021-03-31 10:46:43'),
(114, 2, 32, 'user', 'admin', 'job_post', '2551.00', '20.00', '2531.00', 'order', 55, '20 TK deducted from my balance for job post updated work.', 2, '2021-03-31 10:54:33', '2021-03-31 10:54:33'),
(115, 2, 32, 'user', 'admin', 'job_post', '2531.00', '10.00', '2521.00', 'order', 56, '10 TK deducted from my balance for job post updated work.', 2, '2021-03-31 10:57:02', '2021-03-31 10:57:02'),
(116, 2, 32, 'user', 'admin', 'job_post', '2521.00', '10.00', '2511.00', 'order', 57, '10 TK deducted from my balance for job post updated work.', 2, '2021-03-31 10:58:22', '2021-03-31 10:58:22'),
(117, 2, 32, 'user', 'admin', 'job_post', '2511.00', '10.00', '2501.00', 'order', 58, '10 TK deducted from my balance for job post updated work.', 2, '2021-03-31 10:58:55', '2021-03-31 10:58:55'),
(118, 2, 32, 'user', 'admin', 'job_post', '2501.00', '10.00', '2491.00', 'order', 59, '10 TK deducted from my balance for job post updated work.', 2, '2021-03-31 11:00:10', '2021-03-31 11:00:10'),
(119, 2, 32, 'user', 'admin', 'job_post', '2491.00', '10.00', '2481.00', 'order', 60, '10 TK deducted from my balance for job post updated work.', 2, '2021-03-31 11:02:01', '2021-03-31 11:02:01'),
(120, 2, 62, 'admin', 'subscriber', 'work_done', '35.00', '10.00', '45.00', 'work_done', NULL, 'balance 10.0000 TK transfer to subscriber for work approved.', 2, '2021-04-03 01:13:44', '2021-04-03 01:13:44'),
(121, 2, 53, 'admin', 'subscriber', 'work_done', '15.00', '10.00', '25.00', 'work_done', NULL, 'balance 10.0000 TK transfer to subscriber for work approved.', 2, '2021-04-03 01:13:50', '2021-04-03 01:13:50'),
(122, 2, 61, 'admin', 'subscriber', 'work_done', '15.00', '5.00', '20.00', 'work_done', NULL, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-04-07 05:02:01', '2021-04-07 05:02:01'),
(123, 2, 32, 'user', 'admin', 'job_post', '2231.00', '24.00', '2207.00', 'order', 66, '24 TK deducted from my balance for job post.', 2, '2021-04-12 22:30:56', '2021-04-12 22:30:56'),
(124, 2, 32, 'admin', 'subscriber', 'job_post', '113.90', '1.20', '115.10', 'order', 66, '1.2 TK add to subscriber balance from admin.', 2, '2021-04-12 22:30:56', '2021-04-12 22:30:56'),
(125, 2, 32, 'admin', 'subscriber', 'job_post', '115.10', '0.00', '115.10', 'order', 66, '0 TK add to subscriber balance from admin.', 2, '2021-04-12 22:30:57', '2021-04-12 22:30:57'),
(126, 2, 32, 'admin', 'subscriber', 'job_post', '115.10', '0.00', '115.10', 'order', 66, '0 TK add to subscriber balance from admin.', 2, '2021-04-12 22:30:57', '2021-04-12 22:30:57'),
(127, 2, 32, 'user', 'admin', 'job_post', '2207.00', '10.00', '2197.00', 'order', 67, '10 TK deducted from my balance for job post.', 2, '2021-04-18 14:52:17', '2021-04-18 14:52:17'),
(128, 2, 32, 'admin', 'subscriber', 'job_post', '115.10', '0.50', '115.60', 'order', 67, '0.5 TK add to subscriber balance from admin.', 2, '2021-04-18 14:52:18', '2021-04-18 14:52:18'),
(129, 2, 32, 'admin', 'subscriber', 'job_post', '115.60', '0.00', '115.60', 'order', 67, '0 TK add to subscriber balance from admin.', 2, '2021-04-18 14:52:18', '2021-04-18 14:52:18'),
(130, 2, 32, 'admin', 'subscriber', 'job_post', '115.60', '0.00', '115.60', 'order', 67, '0 TK add to subscriber balance from admin.', 2, '2021-04-18 14:52:18', '2021-04-18 14:52:18'),
(131, 2, 32, 'user', 'admin', 'job_post', '2197.00', '10.00', '2187.00', 'order', 68, '10 TK deducted from my balance for job post.', 2, '2021-04-20 02:02:58', '2021-04-20 02:02:58'),
(132, 2, 32, 'admin', 'subscriber', 'job_post', '115.60', '0.50', '116.10', 'order', 68, '0.5 TK add to subscriber balance from admin.', 2, '2021-04-20 02:02:59', '2021-04-20 02:02:59'),
(133, 2, 32, 'admin', 'subscriber', 'job_post', '116.10', '0.00', '116.10', 'order', 68, '0 TK add to subscriber balance from admin.', 2, '2021-04-20 02:02:59', '2021-04-20 02:02:59'),
(134, 2, 32, 'admin', 'subscriber', 'job_post', '116.10', '0.00', '116.10', 'order', 68, '0 TK add to subscriber balance from admin.', 2, '2021-04-20 02:02:59', '2021-04-20 02:02:59'),
(135, 2, 32, 'user', 'admin', 'job_post', '1887.00', '20.00', '1867.00', 'order', 69, '20 TK deducted from my balance for job post.', 2, '2021-04-30 00:00:45', '2021-04-30 00:00:45'),
(136, 2, 32, 'admin', 'subscriber', 'job_post', '136.10', '1.00', '137.10', 'order', 69, '1 TK add to subscriber balance from admin.', 2, '2021-04-30 00:00:45', '2021-04-30 00:00:45'),
(137, 2, 32, 'admin', 'subscriber', 'job_post', '137.10', '0.00', '137.10', 'order', 69, '0 TK add to subscriber balance from admin.', 2, '2021-04-30 00:00:45', '2021-04-30 00:00:45'),
(138, 2, 32, 'admin', 'subscriber', 'job_post', '137.10', '0.00', '137.10', 'order', 69, '0 TK add to subscriber balance from admin.', 2, '2021-04-30 00:00:45', '2021-04-30 00:00:45'),
(139, 2, 32, 'user', 'admin', 'job_post', '1867.00', '10.00', '1857.00', 'order', 70, '10 TK deducted from my balance for job post.', 2, '2021-04-30 00:03:09', '2021-04-30 00:03:09'),
(140, 2, 32, 'admin', 'subscriber', 'job_post', '137.10', '0.50', '137.60', 'order', 70, '0.5 TK add to subscriber balance from admin.', 2, '2021-04-30 00:03:10', '2021-04-30 00:03:10'),
(141, 2, 32, 'admin', 'subscriber', 'job_post', '137.60', '0.00', '137.60', 'order', 70, '0 TK add to subscriber balance from admin.', 2, '2021-04-30 00:03:10', '2021-04-30 00:03:10'),
(142, 2, 32, 'admin', 'subscriber', 'job_post', '137.60', '0.00', '137.60', 'order', 70, '0 TK add to subscriber balance from admin.', 2, '2021-04-30 00:03:10', '2021-04-30 00:03:10'),
(143, 2, 32, 'user', 'admin', 'job_post', '1857.00', '10.00', '1847.00', 'order', 71, '10 TK deducted from my balance for job post.', 2, '2021-04-30 00:04:29', '2021-04-30 00:04:29'),
(144, 2, 32, 'admin', 'subscriber', 'job_post', '137.60', '0.50', '138.10', 'order', 71, '0.5 TK add to subscriber balance from admin.', 2, '2021-04-30 00:04:29', '2021-04-30 00:04:29'),
(145, 2, 32, 'admin', 'subscriber', 'job_post', '138.10', '0.00', '138.10', 'order', 71, '0 TK add to subscriber balance from admin.', 2, '2021-04-30 00:04:29', '2021-04-30 00:04:29'),
(146, 2, 32, 'admin', 'subscriber', 'job_post', '138.10', '0.00', '138.10', 'order', 71, '0 TK add to subscriber balance from admin.', 2, '2021-04-30 00:04:30', '2021-04-30 00:04:30'),
(147, 2, 32, 'subscriber', 'admin', 'job_post', '1876.00', '10.00', '1866.00', 'order', 72, '10 TK deducted from subscriber balance for job post.', 2, '2021-06-29 00:56:23', '2021-06-29 00:56:23'),
(148, 2, 32, 'admin', 'subscriber', 'honorarium', '138.10', '0.50', '138.60', 'affiliate', 72, '0.5 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-06-29 00:56:23', '2021-06-29 00:56:23'),
(149, 2, 32, 'subscriber', 'admin', 'job_post', '1866.00', '3.00', '1863.00', 'order', 73, '3 TK deducted from subscriber balance for job post.', 2, '2021-06-29 02:20:28', '2021-06-29 02:20:28'),
(150, 2, 32, 'admin', 'subscriber', 'honorarium', '138.60', '0.15', '138.75', 'affiliate', 73, '0.15 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-06-29 02:20:29', '2021-06-29 02:20:29'),
(151, 2, 33, 'admin', 'subscriber', 'work_done', '30.00', '5.00', '35.00', 'App\\Models\\FreelanceJobWork', 18, 'balance 5.0000 TK transfer to subscriber for work (work id 18) approved.', 2, '2021-07-06 18:30:33', '2021-07-06 18:30:33'),
(152, 2, 44, 'admin', 'subscriber', 'work_done', '20.00', '2.00', '22.00', 'App\\Models\\FreelanceJobWork', 37, 'balance 2.0000 TK transfer to subscriber for work (work id 37) approved.', 2, '2021-07-06 18:30:34', '2021-07-06 18:30:34'),
(153, 2, 61, 'admin', 'subscriber', 'work_done', '20.00', '0.50', '20.50', 'App\\Models\\FreelanceJobWork', 39, 'balance 0.5000 TK transfer to subscriber for work (work id 39) approved.', 2, '2021-07-06 18:30:34', '2021-07-06 18:30:34'),
(154, 2, 33, 'admin', 'subscriber', 'work_done', '35.00', '0.50', '35.50', 'App\\Models\\FreelanceJobWork', 40, 'balance 0.5000 TK transfer to subscriber for work (work id 40) approved.', 2, '2021-07-06 18:30:34', '2021-07-06 18:30:34'),
(155, 63, 76, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000342801 balance.', 2, '2021-07-13 08:23:38', '2021-07-13 08:23:38'),
(156, 63, 76, 'admin', 'subscriber', 'honorarium', '22.00', '10.00', '32.00', 'refferal_reward', NULL, '10 tk refferal reward honorarium added to subscriber 011000000342801 balance. (aoc:356)', 2, '2021-07-13 08:23:38', '2021-07-13 08:23:38'),
(157, 2, NULL, 'tenant', 'admin', 'new_subscription', '1863.00', '100.00', '1763.00', 'order', 50, 'To create new (pf-011000000366744) subscriber of (T-69) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 50', 2, '2021-07-18 01:51:04', '2021-07-18 01:51:04'),
(158, 69, 79, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000366744 balance.', 2, '2021-07-18 01:51:04', '2021-07-18 01:51:04'),
(159, 2, 32, 'admin', 'subscriber', 'honorarium', '138.75', '10.00', '148.75', 'refferal_reward', NULL, '10 tk refferal reward honorarium balance added to subscriber 011000000016744 balance  purpose of 011000000366744. ( udc:1118)', 2, '2021-07-18 01:51:04', '2021-07-18 01:51:04'),
(160, 2, 77, 'subscriber', 'admin', 'upgrade_postpaid_account', '200.00', '100.00', '100.00', 'order', NULL, '100 TK deducted from subscriber balance for upgrade postpaid account.', 2, '2021-07-31 07:57:14', '2021-07-31 07:57:14'),
(161, 2, 77, 'subscriber', 'admin', 'job_post', '1763.00', '1000.00', '763.00', 'order', 74, '1000 TK deducted from subscriber balance for job post.', 2, '2021-07-31 07:58:32', '2021-07-31 07:58:32'),
(162, 2, 77, 'subscriber', 'admin', 'job_post', '763.00', '20.00', '743.00', 'order', 75, '20 TK deducted from subscriber balance for job post.', 2, '2021-07-31 08:05:50', '2021-07-31 08:05:50'),
(163, 2, 77, 'admin', 'subscriber', 'honorarium', '100.00', '1.00', '101.00', 'affiliate', 75, '1 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-07-31 08:05:50', '2021-07-31 08:05:50'),
(164, 2, 32, 'subscriber', 'admin', 'job_post', '743.00', '20.00', '723.00', 'order', 76, '20 TK deducted from subscriber balance for job post.', 2, '2021-08-07 22:15:26', '2021-08-07 22:15:26'),
(165, 2, 32, 'admin', 'subscriber', 'honorarium', '148.75', '1.00', '149.75', 'affiliate', 76, '1 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-07 22:15:27', '2021-08-07 22:15:27'),
(166, 2, 32, 'subscriber', 'admin', 'job_post', '723.00', '24.00', '699.00', 'order', 77, '24 TK deducted from subscriber balance for job post.', 2, '2021-08-07 22:32:40', '2021-08-07 22:32:40'),
(167, 2, 32, 'admin', 'subscriber', 'honorarium', '149.75', '1.20', '150.95', 'affiliate', 77, '1.2 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-07 22:32:40', '2021-08-07 22:32:40'),
(168, 2, 32, 'subscriber', 'admin', 'job_post', '699.00', '100.00', '599.00', 'order', 78, '100 TK deducted from subscriber balance for job post.', 2, '2021-08-09 03:37:39', '2021-08-09 03:37:39'),
(169, 2, 32, 'admin', 'subscriber', 'honorarium', '150.95', '5.00', '155.95', 'affiliate', 78, '5 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-09 03:37:39', '2021-08-09 03:37:39'),
(170, 2, 33, 'admin', 'subscriber', 'work_done', '35.50', '5.00', '40.50', 'App\\Models\\FreelanceJobWork', 49, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-09 04:53:34', '2021-08-09 04:53:34'),
(171, 2, 42, 'admin', 'subscriber', 'work_done', '40.00', '5.00', '45.00', 'App\\Models\\FreelanceJobWork', 50, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-09 04:55:13', '2021-08-09 04:55:13'),
(172, 2, 43, 'admin', 'subscriber', 'work_done', '25.00', '5.00', '30.00', 'App\\Models\\FreelanceJobWork', 51, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-09 05:02:58', '2021-08-09 05:02:58'),
(173, 2, 44, 'admin', 'subscriber', 'work_done', '22.00', '5.00', '27.00', 'App\\Models\\FreelanceJobWork', 52, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-09 05:03:01', '2021-08-09 05:03:01'),
(174, 2, 53, 'admin', 'subscriber', 'work_done', '25.00', '5.00', '30.00', 'App\\Models\\FreelanceJobWork', 53, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-09 05:03:03', '2021-08-09 05:03:03'),
(175, 2, 32, 'subscriber', 'admin', 'job_post', '599.00', '100.00', '499.00', 'order', 79, '100 TK deducted from subscriber balance for job post.', 2, '2021-08-09 06:34:08', '2021-08-09 06:34:08'),
(176, 2, 32, 'admin', 'subscriber', 'honorarium', '155.95', '5.00', '160.95', 'affiliate', 79, '5 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-09 06:34:08', '2021-08-09 06:34:08'),
(177, 73, 84, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000415201 balance.', 2, '2021-08-10 04:47:34', '2021-08-10 04:47:34'),
(178, 72, 83, 'admin', 'subscriber', 'honorarium', '0.00', '10.00', '10.00', 'refferal_reward', NULL, '10 tk refferal reward honorarium balance  added to subscriber 011000000402601 balance purpose of 011000000415201. (aoc:298)', 2, '2021-08-10 04:47:34', '2021-08-10 04:47:34'),
(179, 2, 32, 'admin', 'subscriber', 'honorarium', '160.95', '1.00', '161.95', 'refferal_reward', NULL, '1 tk refferal reward honorarium balance  added to subscriber 011000000016744 balance purpose of 011000000402601. (aoc:298)', 2, '2021-08-10 04:47:34', '2021-08-10 04:47:34'),
(180, 2, 32, 'subscriber', 'admin', 'job_post', '499.00', '100.00', '399.00', 'order', 80, '100 TK deducted from subscriber balance for job post.', 2, '2021-08-11 05:12:35', '2021-08-11 05:12:35'),
(181, 2, 32, 'admin', 'subscriber', 'honorarium', '161.95', '5.00', '166.95', 'affiliate', 80, '5 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-11 05:12:35', '2021-08-11 05:12:35'),
(182, 2, 53, 'admin', 'subscriber', 'work_done', '30.00', '5.00', '35.00', 'App\\Models\\FreelanceJobWork', 68, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-11 06:42:33', '2021-08-11 06:42:33'),
(183, 2, 42, 'admin', 'subscriber', 'work_done', '45.00', '5.00', '50.00', 'App\\Models\\FreelanceJobWork', 66, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-11 07:27:34', '2021-08-11 07:27:34'),
(184, 2, 32, 'subscriber', 'admin', 'job_post', '399.00', '40.00', '359.00', 'order', 81, '40 TK deducted from subscriber balance for job post.', 2, '2021-08-11 08:13:53', '2021-08-11 08:13:53'),
(185, 2, 32, 'admin', 'subscriber', 'honorarium', '166.95', '2.00', '168.95', 'affiliate', 81, '2 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-11 08:13:53', '2021-08-11 08:13:53'),
(186, 2, 77, 'subscriber', 'admin', 'job_post', '359.00', '20.00', '339.00', 'order', 82, '20 TK deducted from subscriber balance for job post.', 2, '2021-08-11 08:22:21', '2021-08-11 08:22:21'),
(187, 2, 77, 'admin', 'subscriber', 'honorarium', '101.00', '1.00', '102.00', 'affiliate', 82, '1 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-11 08:22:21', '2021-08-11 08:22:21'),
(188, 2, 32, 'admin', 'subscriber', 'work_done', '168.95', '5.00', '173.95', 'App\\Models\\FreelanceJobWork', 72, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-11 08:30:51', '2021-08-11 08:30:51'),
(189, 2, 32, 'subscriber', 'admin', 'job_post', '339.00', '50.00', '289.00', 'order', 83, '50 TK deducted from subscriber balance for job post.', 2, '2021-08-12 10:52:28', '2021-08-12 10:52:28'),
(190, 2, 32, 'admin', 'subscriber', 'honorarium', '173.95', '2.50', '176.45', 'affiliate', 83, '2.5 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-12 10:52:28', '2021-08-12 10:52:28'),
(191, 2, 42, 'subscriber', 'admin', 'job_post', '289.00', '10.00', '279.00', 'order', 84, '10 TK deducted from subscriber balance for job post.', 2, '2021-08-14 04:51:36', '2021-08-14 04:51:36'),
(192, 2, 42, 'admin', 'subscriber', 'honorarium', '50.00', '0.50', '50.50', 'affiliate', 84, '0.5 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-14 04:51:37', '2021-08-14 04:51:37'),
(193, 2, 33, 'admin', 'subscriber', 'work_done', '40.50', '5.00', '45.50', 'App\\Models\\FreelanceJobWork', 73, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-15 22:34:54', '2021-08-15 22:34:54'),
(194, 2, 62, 'admin', 'subscriber', 'work_done', '45.00', '5.00', '50.00', 'App\\Models\\FreelanceJobWork', 70, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-15 22:38:11', '2021-08-15 22:38:11'),
(195, 2, 32, 'subscriber', 'admin', 'job_post', '279.00', '20.00', '259.00', 'order', 85, '20 TK deducted from subscriber balance for job post.', 2, '2021-08-15 22:55:03', '2021-08-15 22:55:03'),
(196, 2, 32, 'admin', 'subscriber', 'honorarium', '176.45', '1.00', '177.45', 'affiliate', 85, '1 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-15 22:55:03', '2021-08-15 22:55:03'),
(197, 2, 32, 'subscriber', 'admin', 'job_post', '259.00', '30.00', '229.00', 'order', 86, '30 TK deducted from subscriber balance for job post.', 2, '2021-08-15 23:04:29', '2021-08-15 23:04:29'),
(198, 2, 32, 'admin', 'subscriber', 'honorarium', '177.45', '1.50', '178.95', 'affiliate', 86, '1.5 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-15 23:04:29', '2021-08-15 23:04:29'),
(199, 2, 32, 'subscriber', 'admin', 'job_post', '229.00', '50.00', '179.00', 'order', 87, '50 TK deducted from subscriber balance for job post.', 2, '2021-08-15 23:35:04', '2021-08-15 23:35:04'),
(200, 2, 32, 'admin', 'subscriber', 'honorarium', '178.95', '2.50', '181.45', 'affiliate', 87, '2.5 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-15 23:35:04', '2021-08-15 23:35:04'),
(201, 2, 33, 'admin', 'subscriber', 'work_done', '45.50', '5.00', '50.50', 'App\\Models\\FreelanceJobWork', 79, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-15 23:42:00', '2021-08-15 23:42:00'),
(202, 2, 33, 'admin', 'subscriber', 'work_done', '50.50', '5.00', '55.50', 'App\\Models\\FreelanceJobWork', 79, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-15 23:43:16', '2021-08-15 23:43:16'),
(203, 2, 42, 'admin', 'subscriber', 'work_done', '50.50', '5.00', '55.50', 'App\\Models\\FreelanceJobWork', 80, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-15 23:51:40', '2021-08-15 23:51:40'),
(204, 2, 42, 'admin', 'subscriber', 'work_done', '55.50', '5.00', '60.50', 'App\\Models\\FreelanceJobWork', 80, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-15 23:52:56', '2021-08-15 23:52:56'),
(205, 2, NULL, 'tenant', 'admin', 'new_subscription', '179.00', '100.00', '79.00', 'order', 55, 'To create new (pf-011000000446744) subscriber of (T-2) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 55.', 2, '2021-08-16 04:47:36', '2021-08-16 04:47:36'),
(206, 2, 87, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000446744 balance.', 2, '2021-08-16 04:47:36', '2021-08-16 04:47:36'),
(207, 2, 32, 'admin', 'subscriber', 'honorarium', '181.45', '10.00', '191.45', 'refferal_reward', NULL, '10 tk refferal reward honorarium balance  added to subscriber 011000000016744 balance purpose of 011000000446744. (udc:546)', 2, '2021-08-16 04:47:36', '2021-08-16 04:47:36'),
(208, 2, 32, 'subscriber', 'admin', 'job_post', '79.00', '20.00', '59.00', 'order', 88, '20 TK deducted from subscriber balance for job post.', 2, '2021-08-16 04:49:10', '2021-08-16 04:49:10'),
(209, 2, 32, 'admin', 'subscriber', 'honorarium', '191.45', '1.00', '192.45', 'affiliate', 88, '1 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-16 04:49:10', '2021-08-16 04:49:10'),
(210, 2, 32, 'subscriber', 'admin', 'upgrade_postpaid_account', '192.45', '100.00', '92.45', 'order', NULL, '100 TK deducted from subscriber balance for upgrade postpaid account.', 2, '2021-08-16 06:14:03', '2021-08-16 06:14:03'),
(211, 2, NULL, 'tenant', 'admin', 'upgrade_account', '1559.00', '100.00', '1459.00', 'upgrade_account', 58, 'To upgrade account (pf-011000000016744) subscriber of (T-2) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 58.', 2, '2021-08-16 07:53:13', '2021-08-16 07:53:13'),
(212, 75, 88, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000455001 balance.', 2, '2021-08-17 01:33:26', '2021-08-17 01:33:26'),
(213, 75, 88, 'admin', 'subscriber', 'honorarium', '22.00', '10.00', '32.00', 'refferal_reward', NULL, '10 tk refferal reward honorarium added to subscriber 011000000455001 balance. (aoc:356)', 2, '2021-08-17 01:33:26', '2021-08-17 01:33:26'),
(214, 77, 90, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000471101 balance.', 2, '2021-08-20 06:00:40', '2021-08-20 06:00:40'),
(215, 75, 88, 'admin', 'subscriber', 'honorarium', '32.00', '10.00', '42.00', 'refferal_reward', NULL, '10 tk refferal reward honorarium balance  added to subscriber 011000000455001 balance purpose of 011000000471101. (aoc:298)', 2, '2021-08-20 06:00:40', '2021-08-20 06:00:40'),
(216, 78, 91, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000485601 balance.', 2, '2021-08-20 06:06:30', '2021-08-20 06:06:30'),
(217, 77, 89, 'admin', 'subscriber', 'honorarium', '0.00', '10.00', '10.00', 'refferal_reward', NULL, '10 tk refferal reward honorarium balance  added to subscriber 01100000046111 balance purpose of 011000000485601. (aoc:298)', 2, '2021-08-20 06:06:30', '2021-08-20 06:06:30'),
(218, 2, 33, 'admin', 'subscriber', 'honorarium', '55.50', '1.00', '56.50', 'refferal_reward', NULL, '1 tk refferal reward honorarium balance  added to subscriber 011000000026744 balance purpose of 01100000046111. (aoc:298)', 2, '2021-08-20 06:06:30', '2021-08-20 06:06:30'),
(219, 78, 91, 'subscriber', 'user', 'move_to_wallet', '0.00', '22.00', '22.00', 'move_to_wallet', NULL, 'Balance moved from my subscriber account 011000000485601 to my cashout wallet', 78, '2021-08-20 06:08:33', '2021-08-20 06:08:33'),
(220, 77, 89, 'admin', 'subscriber', 'honorarium', '10.00', '0.00', '10.00', 'move_to_wallet', NULL, '0 TK lifetime refer honorarium added to introducer subscriber balance from admin.', 78, '2021-08-20 06:08:33', '2021-08-20 06:08:33'),
(221, 78, 91, 'subscriber', 'admin', 'job_post', '22.00', '20.00', '2.00', 'order', 89, '20 TK deducted from subscriber balance for job post.', 78, '2021-08-20 06:12:20', '2021-08-20 06:12:20'),
(222, 78, 91, 'admin', 'subscriber', 'honorarium', '0.00', '1.00', '1.00', 'affiliate', 89, '1 TK affiliate honorarium added to subscriber balance from admin.', 78, '2021-08-20 06:12:20', '2021-08-20 06:12:20'),
(223, 2, NULL, 'tenant', 'admin', 'new_subscription', '1459.00', '100.00', '1359.00', 'order', 62, 'To create new (pf-011000000490944) subscriber of (T-79) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 62', 2, '2021-08-21 01:44:59', '2021-08-21 01:44:59'),
(224, 79, 92, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000490944 balance.', 2, '2021-08-21 01:45:00', '2021-08-21 01:45:00'),
(225, 2, 32, 'admin', 'subscriber', 'honorarium', '92.45', '11.00', '103.45', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance added to subscriber 011000000016744 balance  purpose of 011000000490944. ( udc:1118)', 2, '2021-08-21 01:45:00', '2021-08-21 01:45:00'),
(226, 2, NULL, 'tenant', 'admin', 'new_subscription', '1359.00', '100.00', '1259.00', 'order', 63, 'To create new (pf-011000000509944) subscriber of (T-80) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 63', 2, '2021-08-21 01:48:15', '2021-08-21 01:48:15'),
(227, 80, 93, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000509944 balance.', 2, '2021-08-21 01:48:15', '2021-08-21 01:48:15'),
(228, 2, 32, 'admin', 'subscriber', 'honorarium', '103.45', '11.00', '114.45', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance added to subscriber 011000000016744 balance  purpose of 011000000509944. ( udc:1118)', 2, '2021-08-21 01:48:15', '2021-08-21 01:48:15'),
(229, 2, NULL, 'tenant', 'admin', 'new_subscription', '1259.00', '100.00', '1159.00', 'order', 64, 'To create new (pf-011000000516744) subscriber of (T-2) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 64.', 2, '2021-08-21 01:51:23', '2021-08-21 01:51:23'),
(230, 2, 94, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000516744 balance.', 2, '2021-08-21 01:51:23', '2021-08-21 01:51:23'),
(231, 2, 32, 'admin', 'subscriber', 'honorarium', '114.45', '11.00', '125.45', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000016744 balance purpose of 011000000516744. (udc:546)', 2, '2021-08-21 01:51:23', '2021-08-21 01:51:23'),
(232, 2, NULL, 'tenant', 'admin', 'new_subscription', '1159.00', '100.00', '1059.00', 'order', 65, 'To create new (pf-011000000526744) subscriber of (T-2) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 65.', 2, '2021-08-21 01:56:29', '2021-08-21 01:56:29'),
(233, 2, 95, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000526744 balance.', 2, '2021-08-21 01:56:29', '2021-08-21 01:56:29'),
(234, 2, 33, 'admin', 'subscriber', 'honorarium', '56.50', '11.00', '67.50', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000026744 balance purpose of 011000000526744. (udc:546)', 2, '2021-08-21 01:56:29', '2021-08-21 01:56:29'),
(235, 2, NULL, 'tenant', 'admin', 'new_subscription', '1059.00', '100.00', '959.00', 'order', 66, 'To create new (pf-011000000536744) subscriber of (T-81) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 66', 2, '2021-08-21 01:57:47', '2021-08-21 01:57:47'),
(236, 81, 96, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000536744 balance.', 2, '2021-08-21 01:57:47', '2021-08-21 01:57:47'),
(237, 2, 33, 'admin', 'subscriber', 'honorarium', '67.50', '11.00', '78.50', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance added to subscriber 011000000026744 balance  purpose of 011000000536744. ( udc:1118)', 2, '2021-08-21 01:57:47', '2021-08-21 01:57:47'),
(238, 2, NULL, 'tenant', 'admin', 'new_subscription', '959.00', '100.00', '859.00', 'order', 67, 'To create new (pf-011000000546744) subscriber of (T-2) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 67.', 2, '2021-08-21 02:04:19', '2021-08-21 02:04:19');
INSERT INTO `balance_transactions` (`id`, `user_id`, `subscriber_id`, `from`, `to`, `purpose`, `previous_balance`, `moved_balance`, `new_balance`, `type`, `type_id`, `details`, `addedby_id`, `created_at`, `updated_at`) VALUES
(239, 2, 97, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000546744 balance.', 2, '2021-08-21 02:04:19', '2021-08-21 02:04:19'),
(240, 2, 33, 'admin', 'subscriber', 'honorarium', '78.50', '11.00', '89.50', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000026744 balance purpose of 011000000546744. (udc:546)', 2, '2021-08-21 02:04:19', '2021-08-21 02:04:19'),
(241, 2, NULL, 'tenant', 'admin', 'new_subscription', '859.00', '100.00', '759.00', 'order', 68, 'To create new (pf-011000000554444) subscriber of (T-82) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 68', 2, '2021-08-21 02:08:51', '2021-08-21 02:08:51'),
(242, 82, 98, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000554444 balance.', 2, '2021-08-21 02:08:51', '2021-08-21 02:08:51'),
(243, 2, 33, 'admin', 'subscriber', 'honorarium', '89.50', '11.00', '100.50', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance added to subscriber 011000000026744 balance  purpose of 011000000554444. ( udc:1317)', 2, '2021-08-21 02:08:51', '2021-08-21 02:08:51'),
(244, 2, NULL, 'tenant', 'admin', 'upgrade_account', '759.00', '44.00', '715.00', 'upgrade_account', 69, 'To upgrade account (pf-011000000566744) subscriber of (T-2) tenant, 44 TK deducted from tenant balance for subscription order. Payment id is 69.', 2, '2021-08-21 09:34:22', '2021-08-21 09:34:22'),
(245, 2, NULL, 'tenant', 'admin', 'upgrade_account', '715.00', '100.00', '615.00', 'upgrade_account', 70, 'To upgrade account (pf-011000000576744) subscriber of (T-2) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 70.', 2, '2021-08-21 09:39:47', '2021-08-21 09:39:47'),
(246, 2, 62, 'admin', 'subscriber', 'work_done', '50.00', '5.00', '55.00', 'App\\Models\\FreelanceJobWork', 47, 'balance 5.0000 TK transfer to subscriber for work approved.', 2, '2021-08-22 08:40:59', '2021-08-22 08:40:59'),
(247, 2, NULL, 'tenant', 'admin', 'new_subscription', '615.00', '100.00', '515.00', 'order', 71, 'To create new (pf-011000000596744) subscriber of (T-2) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 71.', 2, '2021-08-22 16:31:31', '2021-08-22 16:31:31'),
(248, 2, 102, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000596744 balance.', 2, '2021-08-22 16:31:31', '2021-08-22 16:31:31'),
(249, 2, NULL, 'tenant', 'admin', 'new_subscription', '515.00', '100.00', '415.00', 'order', 72, 'To create new (pf-011000000608744) subscriber of (T-84) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 72', 2, '2021-08-22 16:31:52', '2021-08-22 16:31:52'),
(250, 84, 103, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000608744 balance.', 2, '2021-08-22 16:31:52', '2021-08-22 16:31:52'),
(251, 85, 104, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000617701 balance.', 2, '2021-08-22 16:42:54', '2021-08-22 16:42:54'),
(252, 86, 105, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000629901 balance.', 2, '2021-08-22 16:49:35', '2021-08-22 16:49:35'),
(253, 86, 106, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000639901 balance.', 2, '2021-08-22 16:51:24', '2021-08-22 16:51:24'),
(254, 86, 107, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000649901 balance.', 2, '2021-08-22 16:54:02', '2021-08-22 16:54:02'),
(255, 86, 108, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000659901 balance.', 2, '2021-08-22 16:55:06', '2021-08-22 16:55:06'),
(256, 86, 109, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000669901 balance.', 2, '2021-08-22 16:56:20', '2021-08-22 16:56:20'),
(257, 86, 110, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000679901 balance.', 2, '2021-08-22 16:57:16', '2021-08-22 16:57:16'),
(258, 86, 109, 'admin', 'subscriber', 'honorarium', '22.00', '11.00', '33.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000669901 balance purpose of 011000000679901. (aoc:298)', 2, '2021-08-22 16:57:16', '2021-08-22 16:57:16'),
(259, 86, NULL, 'tenant', 'admin', 'new_subscription', '500.00', '100.00', '400.00', 'order', 80, 'To create new (pf-011000000689901) subscriber of (T-86) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 80.', 86, '2021-08-22 17:00:51', '2021-08-22 17:00:51'),
(260, 86, 111, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000689901 balance.', 86, '2021-08-22 17:00:51', '2021-08-22 17:00:51'),
(261, 86, 110, 'admin', 'subscriber', 'honorarium', '22.00', '11.00', '33.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000679901 balance purpose of 011000000689901. (udc:828)', 86, '2021-08-22 17:00:51', '2021-08-22 17:00:51'),
(262, 86, NULL, 'tenant', 'admin', 'new_subscription', '400.00', '100.00', '300.00', 'order', 81, 'To create new (pf-011000000692301) subscriber of (T-87) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 81', 86, '2021-08-22 17:02:35', '2021-08-22 17:02:35'),
(263, 87, 112, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000692301 balance.', 86, '2021-08-22 17:02:35', '2021-08-22 17:02:35'),
(264, 86, 111, 'admin', 'subscriber', 'honorarium', '22.00', '11.00', '33.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance added to subscriber 011000000689901 balance  purpose of 011000000692301. ( udc:1317)', 86, '2021-08-22 17:02:35', '2021-08-22 17:02:35'),
(265, 88, 113, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000708501 balance.', 2, '2021-08-22 17:53:52', '2021-08-22 17:53:52'),
(266, 87, 112, 'admin', 'subscriber', 'honorarium', '22.00', '11.00', '33.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000692301 balance purpose of 011000000708501. (aoc:298)', 2, '2021-08-22 17:53:52', '2021-08-22 17:53:52'),
(267, 88, 114, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance to subscriber 011000000718501 balance.', 2, '2021-08-22 17:55:17', '2021-08-22 17:55:17'),
(268, 88, 113, 'admin', 'subscriber', 'honorarium', '22.00', '11.00', '33.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000708501 balance purpose of 011000000718501. (aoc:298)', 2, '2021-08-22 17:55:17', '2021-08-22 17:55:17'),
(269, 88, NULL, 'tenant', 'admin', 'new_subscription', '300.00', '100.00', '200.00', 'order', 84, 'To create new (pf-011000000729801) subscriber of (T-89) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 84', 88, '2021-08-22 17:59:52', '2021-08-22 17:59:52'),
(270, 89, 115, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000729801 balance.', 88, '2021-08-22 17:59:52', '2021-08-22 17:59:52'),
(271, 88, 114, 'admin', 'subscriber', 'honorarium', '22.00', '11.00', '33.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance added to subscriber 011000000718501 balance  purpose of 011000000729801. ( udc:1317)', 88, '2021-08-22 17:59:52', '2021-08-22 17:59:52'),
(272, 88, NULL, 'tenant', 'admin', 'new_subscription', '200.00', '100.00', '100.00', 'order', 85, 'To create new (pf-011000000738501) subscriber of (T-88) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 85.', 88, '2021-08-22 18:01:02', '2021-08-22 18:01:02'),
(273, 88, 116, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000738501 balance.', 88, '2021-08-22 18:01:02', '2021-08-22 18:01:02'),
(274, 89, 115, 'admin', 'subscriber', 'honorarium', '22.00', '11.00', '33.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000729801 balance purpose of 011000000738501. (udc:828)', 88, '2021-08-22 18:01:02', '2021-08-22 18:01:02'),
(275, 88, NULL, 'tenant', 'admin', 'new_subscription', '100.00', '100.00', '0.00', 'order', 86, 'To create new (pf-011000000748501) subscriber of (T-88) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 86.', 88, '2021-08-22 18:03:06', '2021-08-22 18:03:06'),
(276, 88, 117, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000748501 balance.', 88, '2021-08-22 18:03:06', '2021-08-22 18:03:06'),
(277, 88, 116, 'admin', 'subscriber', 'honorarium', '22.00', '11.00', '33.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000738501 balance purpose of 011000000748501. (udc:828)', 88, '2021-08-22 18:03:06', '2021-08-22 18:03:06'),
(278, 2, NULL, 'tenant', 'admin', 'new_subscription', '415.00', '100.00', '315.00', 'order', 87, 'To create new (pf-011000000751044) subscriber of (T-90) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 87. udc:1236', 2, '2021-08-24 16:26:20', '2021-08-24 16:26:20'),
(279, 90, 118, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000751044 balance.', 2, '2021-08-24 16:26:20', '2021-08-24 16:26:20'),
(280, 2, 99, 'admin', 'subscriber', 'honorarium', '56.00', '11.00', '67.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance added to subscriber 011000000566744 balance  purpose of 011000000751044. ( udc:1317)', 2, '2021-08-24 16:26:20', '2021-08-24 16:26:20'),
(281, 2, NULL, 'tenant', 'admin', 'new_subscription', '315.00', '100.00', '215.00', 'order', 88, 'To create new (pf-011000000766744) subscriber of (T-2) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 88.', 2, '2021-08-24 16:26:47', '2021-08-24 16:26:47'),
(282, 2, 119, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000766744 balance.', 2, '2021-08-24 16:26:47', '2021-08-24 16:26:47'),
(283, 2, 99, 'admin', 'subscriber', 'honorarium', '67.00', '11.00', '78.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000566744 balance purpose of 011000000766744. (udc:828)', 2, '2021-08-24 16:26:47', '2021-08-24 16:26:47'),
(284, 2, NULL, 'tenant', 'admin', 'upgrade_account', '215.00', '75.00', '140.00', 'upgrade_account', 89, 'To upgrade account (pf-011000000376744) subscriber of (T-2) tenant, 75 TK deducted from tenant balance for subscription order. Payment id is 89.', 2, '2021-08-27 16:39:14', '2021-08-27 16:39:14'),
(285, 2, 80, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000376744 balance. usdc:322', 2, '2021-08-27 16:39:14', '2021-08-27 16:39:14'),
(286, 2, 32, 'admin', 'subscriber', 'honorarium', '125.45', '11.00', '136.45', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance added to subscriber 011000000016744 balance  purpose of 011000000376744. ( usdc:402)', 2, '2021-08-27 16:39:15', '2021-08-27 16:39:15'),
(287, 2, NULL, 'tenant', 'admin', 'upgrade_account', '140.00', '65.00', '75.00', 'upgrade_account', 90, 'To upgrade account (pf-011000000776744) subscriber of (T-2) tenant, 65 TK deducted from tenant balance for subscription order. Payment id is 90.', 2, '2021-08-27 16:51:57', '2021-08-27 16:51:57'),
(288, 2, NULL, 'subscriber', 'admin', 'upgrade_account', '35.00', '35.00', '0.00', 'upgrade_account', 90, 'To upgrade account (pf-011000000776744) subscriber of (T-2) tenant, 65 TK deducted from this subscription account for subscription order. Payment id is 90.', 2, '2021-08-27 16:51:57', '2021-08-27 16:51:57'),
(289, 2, 120, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000776744 balance. usdc:322', 2, '2021-08-27 16:51:57', '2021-08-27 16:51:57'),
(290, 2, 32, 'admin', 'subscriber', 'honorarium', '136.45', '11.00', '147.45', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance added to subscriber 011000000016744 balance  purpose of 011000000776744. ( usdc:402)', 2, '2021-08-27 16:51:57', '2021-08-27 16:51:57'),
(291, 2, NULL, 'tenant', 'admin', 'upgrade_account', '75.00', '25.00', '50.00', 'upgrade_account', 91, 'To upgrade account (pf-011000000786744) subscriber of (T-2) tenant, 25 TK deducted from tenant balance for subscription order. Payment id is 91. usdc:300', 2, '2021-08-27 16:58:12', '2021-08-27 16:58:12'),
(292, 2, NULL, 'subscriber', 'admin', 'upgrade_account', '75.00', '75.00', '0.00', 'upgrade_account', 91, 'To upgrade account (pf-011000000786744) subscriber of (T-2) tenant, 75 TK deducted from this subscription account for subscription order. Payment id is 91. usdc:315', 2, '2021-08-27 16:58:12', '2021-08-27 16:58:12'),
(293, 2, 121, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000786744 balance. usdc:343', 2, '2021-08-27 16:58:12', '2021-08-27 16:58:12'),
(294, 2, 32, 'admin', 'subscriber', 'honorarium', '147.45', '11.00', '158.45', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance added to subscriber 011000000016744 balance  purpose of 011000000786744. ( usdc:402)', 2, '2021-08-27 16:58:12', '2021-08-27 16:58:12'),
(295, 2, 122, 'subscriber', 'admin', 'upgrade_postpaid_account', '101.00', '100.00', '1.00', 'order', NULL, '100 TK deducted from subscriber balance for upgrade postpaid account. usdc:155', 2, '2021-08-27 17:07:36', '2021-08-27 17:07:36'),
(296, 2, 122, 'admin', 'subscriber', 'honorarium', '1.00', '22.00', '23.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000796744 balance. usdc:183', 2, '2021-08-27 17:07:36', '2021-08-27 17:07:36'),
(297, 2, 32, 'admin', 'subscriber', 'honorarium', '158.45', '11.00', '169.45', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance added to subscriber 011000000016744 balance  purpose of 011000000796744. ( usdc:262)', 2, '2021-08-27 17:07:36', '2021-08-27 17:07:36'),
(298, 2, 32, 'subscriber', 'admin', 'job_post', '5000.00', '200.00', '4800.00', 'order', 90, '200 TK deducted from subscriber balance for job post.', 2, '2021-08-27 18:55:15', '2021-08-27 18:55:15'),
(299, 2, 32, 'subscriber', 'admin', 'job_post', '4800.00', '40.00', '4760.00', 'order', 91, '40 TK deducted from subscriber balance for job post.', 2, '2021-08-27 18:56:28', '2021-08-27 18:56:28'),
(300, 2, 32, 'admin', 'subscriber', 'honorarium', '169.45', '2.00', '171.45', 'affiliate', 91, '2 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-08-27 18:56:28', '2021-08-27 18:56:28'),
(301, 2, 32, 'user', 'user', 'deposit', '4760.00', '200.00', '4960.00', 'order', 92, 'order #92 for deposit to my balance.', 2, '2021-09-06 04:43:24', '2021-09-06 04:43:24'),
(302, 2, 32, 'user', 'user', 'deposit', '4960.00', '100.00', '5060.00', 'order', 93, 'order #93 for deposit to my balance.', 2, '2021-09-13 03:23:51', '2021-09-13 03:23:51'),
(303, 2, 32, 'subscriber', 'user', NULL, '5040.00', '10.00', '5030.00', 'short_paid_view', NULL, 'Balance debit from my subscriber account 011000000016744 to Short paid View', 2, NULL, NULL),
(304, 2, 32, 'subscriber', 'user', 'short paid view', '5030.00', '10.00', '5020.00', 'short_paid_view', NULL, 'Balance debit from my subscriber account 011000000016744 to Short paid View', 2, NULL, NULL),
(305, 2, 32, 'subscriber', 'user', 'short paid view', '5020.00', '10.00', '5010.00', 'short_paid_view', NULL, 'Balance debit from my subscriber account 011000000016744 to Short paid View', 2, NULL, NULL),
(306, 2, 32, 'user', 'admin', 'short_price', '5010.00', '10.00', '5000.00', 'service_profile', 1, '10 TK deducted from my balance for visiting business profile.', 2, '2021-09-27 04:07:59', '2021-09-27 04:07:59'),
(307, 2, 32, 'user', 'admin', 'short_price', '5000.00', '10.00', '4990.00', 'service_profile', 1, '10 TK deducted from my balance for visiting business profile.', 2, '2021-09-27 04:12:01', '2021-09-27 04:12:01'),
(308, 2, 32, 'user', 'admin', 'full_price', '4990.00', '100.00', '4890.00', 'service_profile', 1, '100 TK deducted from my balance for visiting business profile.', 2, '2021-09-27 04:13:42', '2021-09-27 04:13:42'),
(309, 2, 32, 'user', 'admin', 'short_price', '4890.00', '10.00', '4880.00', 'service_profile', 1, '10 TK deducted from my balance for visiting business profile.', 2, '2021-09-27 04:14:17', '2021-09-27 04:14:17'),
(310, 2, 32, 'user', 'admin', 'full_price', '4880.00', '100.00', '4780.00', 'service_profile', 1, '100 TK deducted from my balance for visiting business profile.', 2, '2021-09-27 04:14:23', '2021-09-27 04:14:23'),
(311, 2, 33, 'user', 'admin', 'short_price', '4780.00', '10.00', '4770.00', 'service_profile', 1, '10 TK deducted from my balance for visiting business profile.', 2, '2021-09-27 06:47:42', '2021-09-27 06:47:42'),
(312, 2, NULL, 'user', 'user', 'withdraw', '4770.00', '100.00', '4670.00', 'mobile_recharge', NULL, 'Successfully TK 100 recharged in 01744508287. Thank you for using softcode mobile recharge solution.', 2, '2021-09-28 02:14:06', '2021-09-28 02:14:06'),
(313, 2, NULL, 'user', 'user', 'withdraw', '4670.00', '100.00', '4570.00', 'mobile_recharge', NULL, 'Successfully TK 100 recharged in 01744508287. Thank you for using softcode mobile recharge solution.', 2, '2021-09-28 02:14:39', '2021-09-28 02:14:39'),
(314, 2, NULL, 'user', 'user', 'withdraw', '4570.00', '100.00', '4470.00', 'mobile_recharge', NULL, 'Successfully TK 100 recharged in 01744508287. Thank you for using softcode mobile recharge solution.', 2, '2021-09-28 02:15:11', '2021-09-28 02:15:11'),
(315, 2, NULL, 'user', 'user', 'withdraw', '4470.00', '1000.00', '3470.00', 'rocket', NULL, 'Successfully TK 1000 rocket CashIn 01744508287. Thank you for using softcode payment solution.', 2, '2021-09-28 02:16:18', '2021-09-28 02:16:18'),
(316, 2, NULL, 'user', 'user', 'withdraw', '3470.00', '100.00', '3370.00', 'mobile_recharge', NULL, 'Successfully TK 100 recharged in 01744508287. Thank you for using softcode mobile recharge solution.', 2, '2021-09-28 04:08:24', '2021-09-28 04:08:24'),
(317, 2, NULL, 'user', 'user', 'withdraw', '3370.00', '100.00', '3270.00', 'mobile_recharge', NULL, 'Successfully TK 100 recharged in 01744508287. Thank you for using softcode mobile recharge solution.', 2, '2021-09-28 04:09:46', '2021-09-28 04:09:46'),
(318, 2, NULL, 'user', 'user', 'withdraw', '3270.00', '20.00', '3250.00', 'mobile_recharge', NULL, 'Successfully TK 20 recharged in 01744508287. Thank you for using softcode mobile recharge solution.', 2, '2021-09-28 04:10:52', '2021-09-28 04:10:52'),
(319, 2, NULL, 'user', 'user', 'withdraw', '3250.00', '10.00', '3240.00', 'mobile_recharge', NULL, 'Successfully TK 10 recharged in 01744508287. Thank you for using softcode mobile recharge solution.', 2, '2021-09-28 04:12:33', '2021-09-28 04:12:33'),
(320, 2, NULL, 'user', 'user', 'withdraw', '3240.00', '15.00', '3225.00', 'mobile_recharge', NULL, 'Successfully TK 15 recharged in 01744508287. Thank you for using softcode mobile recharge solution.', 2, '2021-09-28 04:14:08', '2021-09-28 04:14:08'),
(321, 2, NULL, 'user', 'user', 'withdraw', '3225.00', '25.00', '3200.00', 'mobile_recharge', NULL, 'Successfully TK 25 recharged in 01744508287. Thank you for using softcode mobile recharge solution.', 2, '2021-09-28 04:15:57', '2021-09-28 04:15:57'),
(322, 2, NULL, 'user', 'user', 'withdraw', '3175.00', '100.00', '3075.00', 'nagad', NULL, 'Successfully TK 100 nagad CashIn 01744508287. Thank you for using softcode payment solution.', 2, '2021-09-28 04:58:50', '2021-09-28 04:58:50'),
(323, 2, NULL, 'user', 'user', 'withdraw', '3075.00', '10.00', '3065.00', 'mobile_recharge', NULL, 'Successfully TK 10 recharged in 01744508287. Thank you for using softcode mobile recharge solution.', 2, '2021-09-28 05:28:46', '2021-09-28 05:28:46'),
(324, 2, NULL, 'user', 'user', 'withdraw', '3065.00', '100.00', '2965.00', 'nagad', NULL, 'Successfully TK 100 nagad CashIn 01744508287. Thank you for using softcode payment solution.', 2, '2021-09-28 05:35:47', '2021-09-28 05:35:47'),
(325, 2, NULL, 'user', 'user', 'withdraw', '2965.00', '10.00', '2955.00', 'mobile_recharge', NULL, 'Successfully TK 10 recharged in 01744508287. Thank you for using softcode mobile recharge solution.', 2, '2021-09-28 05:38:46', '2021-09-28 05:38:46'),
(326, 2, NULL, 'user', 'user', 'withdraw', '2955.00', '50.00', '2905.00', 'bkash', NULL, 'Successfully TK 50 bkash CashIn 01744508287. Thank you for using softcode payment solution.', 2, '2021-09-28 06:00:25', '2021-09-28 06:00:25'),
(327, 2, NULL, 'user', 'user', 'withdraw', '2855.00', '50.00', '2805.00', 'nagad', NULL, 'Successfully TK 50 nagad CashIn 01744508287. Thank you for using softcode payment solution.', 2, '2021-09-28 06:31:49', '2021-09-28 06:31:49'),
(328, 2, NULL, 'user', 'user', 'withdraw', '2805.00', '50.00', '2755.00', 'nagad', NULL, 'Successfully TK 50 nagad CashIn 01744508287. Thank you for using softcode payment solution.', 2, '2021-09-28 06:33:40', '2021-09-28 06:33:40'),
(329, 2, NULL, 'user', 'user', 'withdraw', '2755.00', '50.00', '2705.00', 'rocket', NULL, 'Your Payment request listed successfully. TK 50 rocket will be CashIn 01744508287. Thank you for using softcode payment solution.', 2, '2021-09-28 06:35:25', '2021-09-28 06:35:25'),
(330, 2, 32, 'user', 'admin', 'short_price', '2575.00', '10.00', '2565.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:02:28', '2021-09-28 23:02:28'),
(331, 2, 32, 'user', 'admin', 'short_price', '2565.00', '10.00', '2555.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:24:53', '2021-09-28 23:24:53'),
(332, 2, 32, 'admin', 'user', 'short_price_percentage', '2565.00', '0.50', '2564.50', 'service_profile', 1, '0.5 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:24:54', '2021-09-28 23:24:54'),
(333, 2, 32, 'user', 'admin', 'short_price', '2555.00', '10.00', '2545.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:39:17', '2021-09-28 23:39:17'),
(334, 2, 32, 'admin', 'user', 'short_price_percentage', '1360.21', '0.50', '1359.71', 'service_profile', 1, '0.5 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:39:17', '2021-09-28 23:39:17'),
(335, 2, 32, 'user', 'admin', 'short_price', '2545.00', '10.00', '2535.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:40:01', '2021-09-28 23:40:01'),
(336, 2, 32, 'admin', 'user', 'short_price_percentage', '1360.71', '0.50', '1360.21', 'service_profile', 1, '0.5 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:40:01', '2021-09-28 23:40:01'),
(337, 2, 32, 'user', 'admin', 'short_price', '2535.00', '10.00', '2525.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:44:57', '2021-09-28 23:44:57'),
(338, 2, 32, 'admin', 'user', 'short_price_percentage', '1361.21', '0.50', '1360.71', 'service_profile', 1, '0.5 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:44:57', '2021-09-28 23:44:57'),
(339, 2, 32, 'user', 'admin', 'short_price', '2525.00', '10.00', '2515.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:49:35', '2021-09-28 23:49:35'),
(340, 2, 32, 'user', 'admin', 'short_price', '2515.00', '10.00', '2505.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:50:00', '2021-09-28 23:50:00'),
(341, 2, 32, 'user', 'admin', 'short_price', '2505.00', '10.00', '2495.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:51:14', '2021-09-28 23:51:14'),
(342, 2, 32, 'user', 'admin', 'short_price', '2495.00', '10.00', '2485.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:52:15', '2021-09-28 23:52:15'),
(343, 2, 32, 'user', 'admin', 'short_price', '2485.00', '10.00', '2475.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:53:57', '2021-09-28 23:53:57'),
(344, 2, 32, 'user', 'admin', 'short_price', '2475.00', '10.00', '2465.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:55:44', '2021-09-28 23:55:44'),
(345, 2, 32, 'admin', 'user', 'short_price_percentage', '1362.21', '0.50', '1362.71', 'service_profile', 1, '0.5 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:55:44', '2021-09-28 23:55:44'),
(346, 2, 32, 'user', 'admin', 'full_price', '2465.00', '100.00', '2565.00', 'service_profile', 1, '100.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:57:29', '2021-09-28 23:57:29'),
(347, 2, 32, 'admin', 'user', 'full_price_percentage', '1362.71', '40.00', '1402.71', 'service_profile', 1, '40 TK Commision added from admin for visiting business profile', 2, '2021-09-28 23:57:29', '2021-09-28 23:57:29'),
(348, 2, 32, 'user', 'admin', 'short_price', '2365.00', '10.00', '2355.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-28 23:59:53', '2021-09-28 23:59:53'),
(349, 2, 32, 'admin', 'user', 'short_price_percentage', '1402.71', '0.50', '1403.21', 'service_profile', 1, '0.5 TK Commision added from admin for visiting business profile.', 2, '2021-09-28 23:59:53', '2021-09-28 23:59:53'),
(350, 2, 32, 'user', 'admin', 'short_price', '2365.00', '10.00', '2355.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-29 00:13:12', '2021-09-29 00:13:12'),
(351, 2, 32, 'admin', 'user', 'short_price_percentage', '1403.21', '0.50', '1403.71', 'service_profile', 1, '0.5 TK Commision added from admin for visiting business profile.', 2, '2021-09-29 00:13:12', '2021-09-29 00:13:12'),
(352, 2, 32, 'user', 'admin', 'short_price', '2355.00', '10.00', '2345.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-29 00:13:56', '2021-09-29 00:13:56'),
(353, 2, 32, 'admin', 'user', 'short_price_percentage', '1403.71', '0.50', '1404.21', 'service_profile', 1, '0.5 TK Commision added from admin for visiting business profile.', 2, '2021-09-29 00:13:56', '2021-09-29 00:13:56'),
(354, 2, 32, 'user', 'admin', 'full_price', '2345.00', '100.00', '2445.00', 'service_profile', 1, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-09-29 00:14:55', '2021-09-29 00:14:55'),
(355, 2, 32, 'admin', 'user', 'full_price_percentage', '1404.21', '40.00', '1444.21', 'service_profile', 1, '40 TK Commision added from admin for visiting your business profile', 2, '2021-09-29 00:14:55', '2021-09-29 00:14:55'),
(356, 2, 32, 'user', 'admin', 'short_price', '2245.00', '10.00', '2235.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-29 01:03:39', '2021-09-29 01:03:39'),
(357, 2, 32, 'admin', 'user', 'short_price_percentage', '1444.21', '0.50', '1444.71', 'service_profile', 1, '0.5 TK Commision added from admin for visiting business profile.', 2, '2021-09-29 01:03:39', '2021-09-29 01:03:39'),
(358, 2, 32, 'user', 'admin', 'short_price', '2235.00', '10.00', '2225.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-29 01:05:06', '2021-09-29 01:05:06'),
(359, 2, 32, 'admin', 'user', 'short_price_percentage', '1444.21', '0.50', '1444.71', 'service_profile', 1, '0.5 TK Commision added from admin for visiting business profile.', 2, '2021-09-29 01:05:06', '2021-09-29 01:05:06'),
(360, 2, 32, 'user', 'admin', 'full_price', '2225.00', '100.00', '2325.00', 'service_profile', 1, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-09-29 01:06:00', '2021-09-29 01:06:00'),
(361, 2, 32, 'admin', 'user', 'full_price_percentage', '1444.21', '40.00', '1484.21', 'service_profile', 1, '40 TK Commision added from admin for visiting your business profile', 2, '2021-09-29 01:06:00', '2021-09-29 01:06:00'),
(362, 2, 32, 'user', 'admin', 'short_price', '2125.00', '10.00', '2115.00', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-29 01:08:56', '2021-09-29 01:08:56'),
(363, 2, 32, 'admin', 'user', 'short_price_percentage', '212.45', '0.50', '212.95', 'service_profile', 1, '0.5 TK Commision added from admin for visiting business profile.', 2, '2021-09-29 01:08:56', '2021-09-29 01:08:56'),
(364, 2, 32, 'user', 'admin', 'full_price', '2115.00', '100.00', '2215.00', 'service_profile', 1, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-09-29 01:09:09', '2021-09-29 01:09:09'),
(365, 2, 32, 'admin', 'user', 'full_price_percentage', '212.95', '40.00', '252.95', 'service_profile', 1, '40 TK Commision added from admin for visiting your business profile', 2, '2021-09-29 01:09:09', '2021-09-29 01:09:09'),
(366, 2, 33, 'subscriber', 'user', 'move_to_wallet', '2015.00', '100.50', '2115.50', 'move_to_wallet', NULL, 'Balance moved from my subscriber account 011000000026744 to my cashout wallet', 2, '2021-09-29 03:05:33', '2021-09-29 03:05:33'),
(367, 2, NULL, 'user', 'user', 'withdraw', '2115.50', '10.00', '2105.50', 'mobile_recharge', NULL, 'Mobile Recharge request for Number 01744508287 amount tk 10 received, type prepaid', 2, '2021-09-29 03:34:04', '2021-09-29 03:34:04'),
(368, 2, NULL, 'user', 'user', 'withdraw', '2105.50', '10.00', '2095.50', 'mobile_recharge', NULL, 'Mobile Recharge request for Number 01744508287 amount tk 10 received, type prepaid', 2, '2021-09-29 03:37:57', '2021-09-29 03:37:57'),
(369, 2, NULL, 'user', 'user', 'withdraw', '2095.50', '10.00', '2085.50', 'mobile_recharge', NULL, 'Mobile Recharge request for Number 01744508287 amount tk 10 received, type prepaid', 2, '2021-09-29 07:10:32', '2021-09-29 07:10:32'),
(370, 2, 32, 'user', 'admin', 'short_price', '2085.50', '10.00', '2075.50', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-09-29 07:30:36', '2021-09-29 07:30:36'),
(371, 2, 32, 'admin', 'subscriber', 'short_price_percentage', '252.95', '0.50', '253.45', 'service_profile', 1, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-09-29 07:30:36', '2021-09-29 07:30:36'),
(372, 2, 32, 'user', 'admin', 'full_price', '2075.50', '100.00', '2175.50', 'service_profile', 1, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-09-29 07:31:23', '2021-09-29 07:31:23'),
(373, 2, 32, 'admin', 'subscriber', 'full_price_percentage', '253.45', '40.00', '293.45', 'service_profile', 1, '40 TK Commision added from admin for visiting full price part of business profile', 2, '2021-09-29 07:31:23', '2021-09-29 07:31:23'),
(374, 2, 120, 'user', 'admin', 'short_price', '1975.50', '10.00', '1965.50', 'service_profile', 4, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-05 05:06:49', '2021-10-05 05:06:49'),
(375, 2, 120, 'user', 'admin', 'full_price', '1965.50', '100.00', '2065.50', 'service_profile', 4, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-10-05 05:10:06', '2021-10-05 05:10:06'),
(376, 2, NULL, 'tenant', 'admin', 'new_subscription', '1865.50', '100.00', '1765.50', 'order', 92, 'To create new (pf-011000000826744) subscriber of (T-2) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 92.', 2, '2021-10-05 06:30:18', '2021-10-05 06:30:18'),
(377, 2, 126, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000826744 balance.', 2, '2021-10-05 06:30:18', '2021-10-05 06:30:18'),
(378, 2, 32, 'admin', 'subscriber', 'honorarium', '293.45', '11.00', '304.45', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000016744 balance purpose of 011000000826744. (udc:828)', 2, '2021-10-05 06:30:18', '2021-10-05 06:30:18'),
(379, 2, NULL, 'tenant', 'admin', 'new_subscription', '1765.50', '100.00', '1665.50', 'order', 93, 'To create new (pf-011000000846744) subscriber of (T-2) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 93.', 2, '2021-10-05 22:56:58', '2021-10-05 22:56:58'),
(380, 2, 128, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000846744 balance.', 2, '2021-10-05 22:56:58', '2021-10-05 22:56:58'),
(381, 2, 32, 'admin', 'subscriber', 'honorarium', '304.45', '11.00', '315.45', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000000016744 balance purpose of 011000000846744. (udc:828)', 2, '2021-10-05 22:56:58', '2021-10-05 22:56:58'),
(382, 2, 75, 'user', 'admin', 'short_price', '1665.50', '10.00', '1655.50', 'service_profile', 5, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 00:49:25', '2021-10-06 00:49:25'),
(383, 2, 75, 'admin', 'subscriber', 'short_price_percentage', '22.00', '0.50', '22.50', 'service_profile', 5, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 00:49:25', '2021-10-06 00:49:25'),
(384, 2, 75, 'user', 'admin', 'short_price', '1655.50', '10.00', '1645.50', 'service_profile', 5, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 00:50:15', '2021-10-06 00:50:15'),
(385, 2, 75, 'admin', 'subscriber', 'short_price_percentage', '22.50', '0.50', '23.00', 'service_profile', 5, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 00:50:15', '2021-10-06 00:50:15'),
(386, 2, 75, 'user', 'admin', 'short_price', '1645.50', '10.00', '1635.50', 'service_profile', 5, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 00:51:36', '2021-10-06 00:51:36'),
(387, 2, 75, 'admin', 'subscriber', 'short_price_percentage', '23.00', '0.50', '23.50', 'service_profile', 5, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 00:51:36', '2021-10-06 00:51:36'),
(388, 2, 75, 'user', 'admin', 'short_price', '1635.50', '10.00', '1625.50', 'service_profile', 5, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 01:09:18', '2021-10-06 01:09:18'),
(389, 2, 75, 'admin', 'subscriber', 'short_price_percentage', '23.50', '0.50', '24.00', 'service_profile', 5, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 01:09:18', '2021-10-06 01:09:18'),
(390, 2, 75, 'user', 'admin', 'short_price', '1625.50', '10.00', '1615.50', 'service_profile', 5, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 01:13:36', '2021-10-06 01:13:36'),
(391, 2, 75, 'admin', 'subscriber', 'short_price_percentage', '24.00', '0.50', '24.50', 'service_profile', 5, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 01:13:36', '2021-10-06 01:13:36'),
(392, 2, 75, 'user', 'admin', 'short_price', '1615.50', '10.00', '1605.50', 'service_profile', 5, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 01:13:56', '2021-10-06 01:13:56'),
(393, 2, 75, 'admin', 'subscriber', 'short_price_percentage', '24.50', '0.50', '25.00', 'service_profile', 5, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 01:13:57', '2021-10-06 01:13:57'),
(394, 2, 75, 'user', 'admin', 'short_price', '1605.50', '10.00', '1595.50', 'service_profile', 5, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 01:22:21', '2021-10-06 01:22:21'),
(395, 2, 75, 'admin', 'subscriber', 'short_price_percentage', '25.00', '0.50', '25.50', 'service_profile', 5, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 01:22:21', '2021-10-06 01:22:21'),
(396, 2, 75, 'user', 'admin', 'full_price', '1595.50', '100.00', '1695.50', 'service_profile', 5, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-10-06 01:26:00', '2021-10-06 01:26:00'),
(397, 2, 75, 'admin', 'subscriber', 'full_price_percentage', '25.50', '10.00', '35.50', 'service_profile', 5, '10 TK Commision added from admin for visiting full price part of business profile', 2, '2021-10-06 01:26:00', '2021-10-06 01:26:00'),
(398, 2, 42, 'user', 'admin', 'short_price', '1495.50', '10.00', '1485.50', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 03:03:31', '2021-10-06 03:03:31'),
(399, 2, 32, 'admin', 'subscriber', 'short_price_percentage', '315.45', '0.50', '315.95', 'service_profile', 1, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 03:03:31', '2021-10-06 03:03:31'),
(400, 2, 42, 'user', 'admin', 'full_price', '1485.50', '100.00', '1585.50', 'service_profile', 1, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-10-06 03:04:46', '2021-10-06 03:04:46'),
(401, 2, 32, 'admin', 'subscriber', 'full_price_percentage', '315.95', '40.00', '355.95', 'service_profile', 1, '40 TK Commision added from admin for visiting full price part of business profile', 2, '2021-10-06 03:04:46', '2021-10-06 03:04:46'),
(402, 2, 102, 'user', 'admin', 'short_price', '1385.50', '10.00', '1375.50', 'service_profile', 5, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 03:26:37', '2021-10-06 03:26:37'),
(403, 2, 75, 'admin', 'subscriber', 'short_price_percentage', '35.50', '0.50', '36.00', 'service_profile', 5, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 03:26:37', '2021-10-06 03:26:37'),
(404, 2, 102, 'user', 'admin', 'full_price', '1375.50', '100.00', '1475.50', 'service_profile', 5, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-10-06 03:26:40', '2021-10-06 03:26:40'),
(405, 2, 75, 'admin', 'subscriber', 'full_price_percentage', '36.00', '10.00', '46.00', 'service_profile', 5, '10 TK Commision added from admin for visiting full price part of business profile', 2, '2021-10-06 03:26:40', '2021-10-06 03:26:40'),
(406, 2, 102, 'user', 'admin', 'short_price', '1275.50', '10.00', '1265.50', 'service_profile', 5, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 03:28:21', '2021-10-06 03:28:21'),
(407, 2, 75, 'admin', 'subscriber', 'short_price_percentage', '36.00', '0.50', '36.50', 'service_profile', 5, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 03:28:21', '2021-10-06 03:28:21'),
(408, 2, 102, 'user', 'admin', 'full_price', '1265.50', '100.00', '1365.50', 'service_profile', 5, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-10-06 03:28:25', '2021-10-06 03:28:25'),
(409, 2, 75, 'admin', 'subscriber', 'full_price_percentage', '36.50', '10.00', '46.50', 'service_profile', 5, '10 TK Commision added from admin for visiting full price part of business profile', 2, '2021-10-06 03:28:25', '2021-10-06 03:28:25'),
(410, 2, 33, 'user', 'admin', 'short_price', '1165.50', '10.00', '1155.50', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 03:30:07', '2021-10-06 03:30:07'),
(411, 2, 32, 'admin', 'subscriber', 'short_price_percentage', '315.95', '0.50', '316.45', 'service_profile', 1, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 03:30:07', '2021-10-06 03:30:07'),
(412, 2, 33, 'user', 'admin', 'full_price', '1155.50', '100.00', '1255.50', 'service_profile', 1, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-10-06 03:30:10', '2021-10-06 03:30:10'),
(413, 2, 32, 'admin', 'subscriber', 'full_price_percentage', '316.45', '40.00', '356.45', 'service_profile', 1, '40 TK Commision added from admin for visiting full price part of business profile', 2, '2021-10-06 03:30:10', '2021-10-06 03:30:10'),
(414, 2, 33, 'user', 'admin', 'short_price', '1055.50', '10.00', '1045.50', 'service_profile', 1, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 03:39:55', '2021-10-06 03:39:55'),
(415, 2, 32, 'admin', 'subscriber', 'short_price_percentage', '316.45', '0.50', '316.95', 'service_profile', 1, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 03:39:55', '2021-10-06 03:39:55'),
(416, 2, 33, 'user', 'admin', 'full_price', '1045.50', '100.00', '1145.50', 'service_profile', 1, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-10-06 03:40:25', '2021-10-06 03:40:25'),
(417, 2, 32, 'admin', 'subscriber', 'full_price_percentage', '316.95', '40.00', '356.95', 'service_profile', 1, '40 TK Commision added from admin for visiting full price part of business profile', 2, '2021-10-06 03:40:25', '2021-10-06 03:40:25'),
(418, 2, 121, 'user', 'admin', 'short_price', '945.50', '10.00', '935.50', 'service_profile', 5, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-06 03:48:47', '2021-10-06 03:48:47'),
(419, 2, 75, 'admin', 'subscriber', 'short_price_percentage', '36.50', '0.50', '37.00', 'service_profile', 5, '0.5 TK Commision added from admin for visiting short price part of business profile.', 2, '2021-10-06 03:48:47', '2021-10-06 03:48:47'),
(420, 2, 121, 'user', 'admin', 'full_price', '935.50', '100.00', '1035.50', 'service_profile', 5, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-10-06 03:48:50', '2021-10-06 03:48:50'),
(421, 2, 75, 'admin', 'subscriber', 'full_price_percentage', '37.00', '10.00', '47.00', 'service_profile', 5, '10 TK Commision added from admin for visiting full price part of business profile', 2, '2021-10-06 03:48:50', '2021-10-06 03:48:50'),
(422, 95, NULL, 'tenant', 'admin', 'new_subscription', '4500.00', '100.00', '4400.00', 'order', 95, 'To create new (pf-011000000888701) subscriber of (T-95) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 95.', 95, '2021-10-18 04:21:35', '2021-10-18 04:21:35'),
(423, 95, 148, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000888701 balance.', 95, '2021-10-18 04:21:35', '2021-10-18 04:21:35'),
(424, 95, 147, 'admin', 'subscriber', 'honorarium', '0.00', '11.00', '11.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 01100000087871 balance purpose of 011000000888701. (udc:828)', 95, '2021-10-18 04:21:35', '2021-10-18 04:21:35'),
(425, 2, 120, 'subscriber', 'user', 'deposit', '835.50', '700.00', '1535.50', 'balance_transfer', NULL, 'Balance (700.00) Added from From product (Camtasia 2021 Pro Max) sale', NULL, '2021-10-23 00:52:44', '2021-10-23 00:52:44'),
(426, 95, 120, 'order_user', 'profile_owner', 'order_confirmed_balance', '7900.00', '700.00', '7200.00', 'profile_order', 3, 'Balance (700) diducted from your balance For product Order', NULL, '2021-10-23 02:23:58', '2021-10-23 02:23:58'),
(428, 95, NULL, 'profile_owner', 'order_user', 'confirmed_balance_return', '5800.00', '1400.00', '7200.00', 'profile_order', 2, 'Form order Only one product is cancelled. Balance (1400.00) Added from From product (Camtasia 2021 Pro Max) sale', NULL, '2021-10-23 02:47:09', '2021-10-23 02:47:09'),
(429, 95, NULL, 'profile_owner', 'order_user', 'confirmed_balance_return', '7200.00', '1400.00', '8600.00', 'profile_order', 2, 'Form order Only one product is cancelled. Balance (1400.00) Added from From product (Camtasia 2021 Pro Max) sale', NULL, '2021-10-23 03:50:58', '2021-10-23 03:50:58'),
(430, 95, 120, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '7200.00', '2100.00', '5100.00', 'profile_order', 5, 'Balance (2100) diducted from your balance For product Order', NULL, '2021-10-23 03:54:19', '2021-10-23 03:54:19'),
(431, 2, 120, 'order_user', 'profile_owner', 'order_confirmed_balance', '2935.50', '2100.00', '5035.50', 'profile_order', 5, 'Balance (2100.00) Added from For product (Camtasia 2021 Pro Max) sale', NULL, '2021-10-23 04:04:38', '2021-10-23 04:04:38'),
(432, 2, 148, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '5035.50', '1000.00', '4035.50', 'profile_order', 1, 'Balance (1000) diducted from your balance For product Order', NULL, '2021-10-24 04:03:55', '2021-10-24 04:03:55'),
(433, 2, 148, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '4035.50', '1000.00', '3035.50', 'profile_order', 2, 'Balance (1000) diducted from your balance For product Order', NULL, '2021-10-24 06:35:35', '2021-10-24 06:35:35'),
(434, 97, 148, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '5000.00', '1000.00', '4000.00', 'profile_order', 3, 'Balance (1000) diducted from your balance For product Order', NULL, '2021-10-25 02:17:13', '2021-10-25 02:17:13'),
(435, 97, 120, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '4000.00', '130.00', '3870.00', 'profile_order', 4, 'Balance (130) diducted from your balance For product Order', NULL, '2021-10-25 02:18:10', '2021-10-25 02:18:10'),
(436, 2, 120, 'order_user', 'profile_owner', 'order_confirmed_balance', '3035.50', '130.00', '3165.50', 'profile_order', 4, 'Balance (130.00) Added from From product (Hannah Solomon) sale', NULL, '2021-10-25 03:23:17', '2021-10-25 03:23:17'),
(437, 2, 120, 'order_user', 'profile_owner', 'order_confirmed_balance', '3165.50', '0.00', '3165.50', 'profile_order', 4, 'Balance (0.00) Added from From product sale', NULL, '2021-10-25 03:38:04', '2021-10-25 03:38:04'),
(438, 2, 120, 'order_user', 'profile_owner', 'order_confirmed_balance', '3165.50', '130.00', '3295.50', 'profile_order', 4, 'Balance (130.00) Added from From product sale', NULL, '2021-10-25 03:41:25', '2021-10-25 03:41:25'),
(439, 97, NULL, 'tenant', 'admin', 'new_subscription', '3870.00', '100.00', '3770.00', 'order', 96, 'To create new (pf-011000000905401) subscriber of (T-97) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 96.', 97, '2021-10-25 22:37:00', '2021-10-25 22:37:00'),
(440, 97, 150, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000000905401 balance.', 97, '2021-10-25 22:37:00', '2021-10-25 22:37:00'),
(441, 97, 149, 'admin', 'subscriber', 'honorarium', '0.00', '11.00', '11.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 01100000089541 balance purpose of 011000000905401. (udc:828)', 97, '2021-10-25 22:37:00', '2021-10-25 22:37:00'),
(442, 97, 120, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '3770.00', '130.00', '3640.00', 'profile_order', 5, 'Balance (130) diducted from your balance For product Order', NULL, '2021-10-25 23:28:50', '2021-10-25 23:28:50'),
(443, 97, 120, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '3640.00', '130.00', '3510.00', 'profile_order', 6, 'Balance (130) diducted from your balance For product Order', NULL, '2021-10-25 23:52:36', '2021-10-25 23:52:36'),
(444, 2, 120, 'profile_owner', 'admin', 'service_product_commission', '0.00', '13.00', '13.00', 'profile_order', 6, 'Balance (13) TK Added from From product Commission', NULL, '2021-10-26 00:19:06', '2021-10-26 00:19:06'),
(445, 2, 120, 'order_user', 'profile_owner', 'order_confirmed_balance', '3295.50', '117.00', '3412.50', 'profile_order', 6, 'Balance (117) Added from From product (Hannah Solomon) sale', NULL, '2021-10-26 00:19:06', '2021-10-26 00:19:06');
INSERT INTO `balance_transactions` (`id`, `user_id`, `subscriber_id`, `from`, `to`, `purpose`, `previous_balance`, `moved_balance`, `new_balance`, `type`, `type_id`, `details`, `addedby_id`, `created_at`, `updated_at`) VALUES
(446, 97, 148, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '3510.00', '2000.00', '1510.00', 'profile_order', 7, 'Balance (2000) diducted from your balance For product Order', NULL, '2021-10-26 00:51:19', '2021-10-26 00:51:19'),
(447, 97, 120, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '1510.00', '130.00', '1380.00', 'profile_order', 8, 'Balance (130) diducted from your balance For product Order', NULL, '2021-10-26 01:01:56', '2021-10-26 01:01:56'),
(448, 2, 120, 'profile_owner', 'admin', 'service_product_commission', '0.00', '13.00', '13.00', 'profile_order', 8, 'Balance (13) TK Added from From product Commission', NULL, '2021-10-26 01:03:35', '2021-10-26 01:03:35'),
(449, 2, 120, 'order_user', 'profile_owner', 'order_confirmed_balance', '3412.50', '117.00', '3529.50', 'profile_order', 8, 'Balance (117) Added from From product (Hannah Solomon) sale', NULL, '2021-10-26 01:03:35', '2021-10-26 01:03:35'),
(450, 97, 120, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '1380.00', '130.00', '1250.00', 'profile_order', 9, 'Balance (130) diducted from your balance For product Order', NULL, '2021-10-26 01:09:43', '2021-10-26 01:09:43'),
(451, 2, 120, 'profile_owner', 'admin', 'service_product_commission', '0.00', '13.00', '13.00', 'profile_order', 9, 'Balance (13) TK Added from From product Commission', NULL, '2021-10-26 01:11:36', '2021-10-26 01:11:36'),
(452, 2, 120, 'order_user', 'profile_owner', 'order_confirmed_balance', '3529.50', '117.00', '3646.50', 'profile_order', 9, 'Balance (117) Added from From product (Hannah Solomon) sale', NULL, '2021-10-26 01:11:36', '2021-10-26 01:11:36'),
(453, 97, 120, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '1250.00', '130.00', '1120.00', 'profile_order', 10, 'Balance (130) diducted from your balance For product Order', NULL, '2021-10-26 01:17:29', '2021-10-26 01:17:29'),
(454, 2, 120, 'profile_owner', 'admin', 'service_product_commission', '0.00', '29.90', '29.90', 'profile_order', 10, 'Balance (29.9) TK Added from From product Commission', NULL, '2021-10-26 01:18:13', '2021-10-26 01:18:13'),
(455, 2, 120, 'order_user', 'profile_owner', 'order_confirmed_balance', '3646.50', '100.10', '3746.60', 'profile_order', 10, 'Balance (100.1) Added from From product (Hannah Solomon) sale', NULL, '2021-10-26 01:18:13', '2021-10-26 01:18:13'),
(456, 2, 80, 'user', 'admin', 'short_price', '3746.60', '10.00', '3736.60', 'service_profile', 10, '10.00 TK deducted from my balance for visiting business profile.', 2, '2021-10-26 02:35:16', '2021-10-26 02:35:16'),
(457, 2, 80, 'user', 'admin', 'full_price', '3736.60', '100.00', '3836.60', 'service_profile', 10, '100.00 TK deducted from my balance for visiting your business profile.', 2, '2021-10-26 02:35:22', '2021-10-26 02:35:22'),
(458, 97, 120, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '1120.00', '130.00', '990.00', 'profile_order', 11, 'Balance (130) diducted from your balance For product Order', NULL, '2021-10-26 04:19:50', '2021-10-26 04:19:50'),
(459, 97, 120, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '990.00', '130.00', '860.00', 'profile_order', 12, 'Balance (130) diducted from your balance For product Order', NULL, '2021-10-26 04:22:45', '2021-10-26 04:22:45'),
(460, 97, 120, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '860.00', '130.00', '730.00', 'profile_order', 13, 'Balance (130) diducted from your balance For product Order', NULL, '2021-10-26 04:27:00', '2021-10-26 04:27:00'),
(461, 2, 62, 'subscriber', 'user', 'move_to_wallet', '3636.60', '55.00', '3691.60', 'move_to_wallet', NULL, 'Balance moved from my subscriber account 011000000216744 to my cashout wallet', 2, '2021-11-02 01:31:05', '2021-11-02 01:31:05'),
(462, 2, 121, 'subscriber', 'user', 'move_to_wallet', '3691.60', '32.00', '3723.60', 'move_to_wallet', NULL, 'Balance moved from my subscriber account 011000000786744 to my cashout wallet', 2, '2021-11-02 01:33:58', '2021-11-02 01:33:58'),
(463, 2, 121, 'subscriber', 'user', 'move_to_wallet', '3723.60', '300.00', '4023.60', 'move_to_wallet', NULL, 'Balance moved from my subscriber account 011000000786744 to my cashout wallet', 2, '2021-11-02 01:34:41', '2021-11-02 01:34:41'),
(464, 105, 120, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '5000.00', '130.00', '4870.00', 'profile_order', 14, 'Balance (130) diducted from your balance For product Order', NULL, '2021-11-07 05:14:16', '2021-11-07 05:14:16'),
(465, 2, 148, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '4023.60', '1000.00', '3023.60', 'profile_order', 15, 'Balance (1000) diducted from your balance For product Order', NULL, '2021-11-13 00:31:06', '2021-11-13 00:31:06'),
(466, 2, 148, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '3023.60', '0.00', '3023.60', 'profile_order', 16, 'Balance (0) diducted from your balance For product Order', NULL, '2021-11-13 00:31:33', '2021-11-13 00:31:33'),
(467, 2, 148, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '3023.60', '0.00', '3023.60', 'profile_order', 17, 'Balance (0) diducted from your balance For product Order', NULL, '2021-11-13 00:33:39', '2021-11-13 00:33:39'),
(468, 2, 148, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '3023.60', '0.00', '3023.60', 'profile_order', 18, 'Balance (0) diducted from your balance For product Order', NULL, '2021-11-13 00:34:42', '2021-11-13 00:34:42'),
(469, 2, 148, 'order_user', 'order_confirmed_balance', 'order_confirmed_balance', '3023.60', '1000.00', '2023.60', 'profile_order', 19, 'Balance (1000) diducted from your balance For product Order', NULL, '2021-11-13 00:36:12', '2021-11-13 00:36:12'),
(470, 2, NULL, 'tenant', 'admin', 'needs', '2023.60', '124.00', '1899.60', 'needs', 2, 'To Spproved Bid (1) for (Ut dolore cupidatat). 124.00 TK deducted from tenant balance for \"Needs\" order. ', 2, '2021-11-15 02:21:47', '2021-11-15 02:21:47'),
(471, 2, NULL, 'tenant', 'admin', 'needs', '1899.60', '240.00', '1659.60', 'needs', 2, 'To Spproved Bid (2) for (Id sit rerum sed o). 240.00 TK deducted from tenant balance for \"Needs\" order. ', 2, '2021-11-16 01:40:50', '2021-11-16 01:40:50'),
(472, 2, NULL, 'tenant', 'admin', 'needs', '1659.60', '240.00', '1419.60', 'needs', 2, 'To Spproved Bid (2) for (Id sit rerum sed o). 240.00 TK deducted from tenant balance for \"Needs\" order. ', 2, '2021-11-16 01:45:03', '2021-11-16 01:45:03'),
(473, 2, NULL, 'tenant', 'admin', 'needs', '1419.60', '240.00', '1179.60', 'needs', 2, 'To Spproved Bid (2) for (Id sit rerum sed o). 240.00 TK deducted from tenant balance for \"Needs\" order. ', 2, '2021-11-16 01:45:21', '2021-11-16 01:45:21'),
(474, 2, NULL, 'tenant', 'admin', 'needs', '1179.60', '10.00', '1169.60', 'needs', 2, 'To Spproved Bid (4) for (Id sit rerum sed o). 10.00 TK deducted from tenant balance for \"Needs\" order. ', 2, '2021-11-16 05:12:54', '2021-11-16 05:12:54'),
(475, 111, NULL, 'need_owner', 'bid_owner', 'need_delivery', '0.00', '10.00', '10.00', 'order', 4, 'To Delivery Needs, 10.00 TK deducted from User balance for Delivery Needs order.', 2, '2021-11-16 05:45:58', '2021-11-16 05:45:58'),
(476, 111, NULL, 'need_owner', 'bid_owner', 'need_delivery', '10.00', '0.00', '10.00', 'order', 4, 'To Delivery Needs, 0.00 TK deducted from User balance for Delivery Needs order.', 2, '2021-11-16 07:30:42', '2021-11-16 07:30:42'),
(477, 2, 80, 'user', 'admin', 'sp_create_charge', '1169.60', '100.00', '1069.60', 'service_profile', 3, '100 TK deducted from my balance for creating business profile.', 2, '2021-11-16 23:33:21', '2021-11-16 23:33:21'),
(478, 2, 80, 'user', 'admin', 'sp_create_charge', '1169.60', '100.00', '1069.60', 'service_profile', 3, '100 TK deducted from my balance for creating business profile.', 2, '2021-11-16 23:34:57', '2021-11-16 23:34:57'),
(479, 2, 80, 'user', 'admin', 'sp_create_charge', '1169.60', '100.00', '1069.60', 'service_profile', 3, '100 TK deducted from my balance for creating business profile.', 2, '2021-11-16 23:35:25', '2021-11-16 23:35:25'),
(480, 2, 80, 'user', 'admin', 'sp_create_charge', '1069.60', '100.00', '969.60', 'service_profile', 3, '100 TK deducted from my balance for creating business profile.', 2, '2021-11-16 23:36:50', '2021-11-16 23:36:50'),
(481, 2, 123, 'user', 'admin', 'sp_create_charge', '969.60', '90.00', '879.60', 'service_profile', 5, '90 TK deducted from my balance for creating business profile.', 2, '2021-11-17 04:27:18', '2021-11-17 04:27:18'),
(482, 2, NULL, 'user', 'admin', 'service_profile_creation', '879.60', '100.00', '779.60', 'service', 3, '100 TK deducted from User balance to Createing Service/Shop for user_id(112), Mobile (+8801755889966) .', 2, '2021-11-17 06:25:15', '2021-11-17 06:25:15'),
(483, 2, NULL, 'user', 'admin', 'service_profile_creation', '879.60', '100.00', '779.60', 'service', 3, '100 TK deducted from User balance to Createing Service/Shop for user_id(112), Mobile (+8801755889966) .', 2, '2021-11-17 06:25:59', '2021-11-17 06:25:59'),
(484, 2, 127, 'user', 'admin', 'sp_create_charge', '779.60', '0.00', '779.60', 'service_profile', 1, '0 TK deducted from my balance for creating business profile.', 2, '2021-11-20 04:14:54', '2021-11-20 04:14:54'),
(485, 2, 287, 'user', 'admin', 'service_profile_creation', '779.60', '0.00', '779.60', 'service', 12, '0 TK deducted from User balance. to Createing Service/Shop for user_id(113), Mobile (+8801788441100) .', 2, '2021-11-20 06:51:04', '2021-11-20 06:51:04'),
(486, 2, 124, 'user', 'admin', 'sp_create_charge', '779.60', '100.00', '679.60', 'service_profile', 3, '100 TK deducted from my balance for creating business profile.', 2, '2021-11-24 06:59:21', '2021-11-24 06:59:21'),
(487, 2, 124, 'user', 'admin', 'sp_create_charge', '679.60', '100.00', '579.60', 'service_profile', 3, '100 TK deducted from my balance for creating business profile.', 2, '2021-11-24 07:19:51', '2021-11-24 07:19:51'),
(488, 2, 124, 'user', 'admin', 'sp_create_charge', '579.60', '100.00', '479.60', 'service_profile', 3, '100 TK deducted from my balance for creating business profile.', 2, '2021-11-24 08:08:04', '2021-11-24 08:08:04'),
(489, 2, 32, 'subscriber', 'user', 'balance_status_send', '0.00', '30.00', '30.00', 'move_to_wallet', NULL, 'Balance moved from my subscriber account 011000000016744 to my cashout wallet', 2, '2021-10-12 23:09:15', '2021-03-08 23:09:15'),
(490, 2, 32, 'user', 'admin', 'balance_status_send', '478.60', '2.00', '476.60', 'service', 2, 'Dear MK. Masud, Your softcodeint Mobile : +8801918515567 and your current balance : 478.60 . www.softcodeint.com', 2, '2021-11-28 01:29:59', '2021-11-28 01:29:59'),
(491, 82, 98, 'user', 'admin', 'balance_status_send', '100.00', '2.00', '98.00', 'service', 82, 'Dear NEw world, Your softcodeint Mobile : +8801965444444 and your current balance : 100.00 . www.softcodeint.com', 2, '2021-11-28 01:29:59', '2021-11-28 01:29:59'),
(492, 86, 105, 'user', 'admin', 'balance_status_send', '300.00', '2.00', '298.00', 'service', 86, 'Dear eee, Your softcodeint Mobile : +8801888989899 and your current balance : 300.00 . www.softcodeint.com', 2, '2021-11-28 01:29:59', '2021-11-28 01:29:59'),
(493, 93, 130, 'user', 'admin', 'balance_status_send', '5.00', '2.00', '3.00', 'service', 93, 'Dear Abdul Mannaf, Your softcodeint Mobile : +8801744508288 and your current balance : 5.00 . www.softcodeint.com', 2, '2021-11-28 01:29:59', '2021-11-28 01:29:59'),
(494, 95, 147, 'user', 'admin', 'balance_status_send', '5100.00', '2.00', '5098.00', 'service', 95, 'Dear Robin Travis, Your softcodeint Mobile : +8801744587487 and your current balance : 5100.00 . www.softcodeint.com', 2, '2021-11-28 01:29:59', '2021-11-28 01:29:59'),
(495, 97, 149, 'user', 'admin', 'balance_status_send', '730.00', '2.00', '728.00', 'service', 97, 'Dear Robin Travis, Your softcodeint Mobile : +8801322587854 and your current balance : 730.00 . www.softcodeint.com', 2, '2021-11-28 01:29:59', '2021-11-28 01:29:59'),
(496, 105, 242, 'user', 'admin', 'balance_status_send', '4870.00', '2.00', '4868.00', 'service', 105, 'Dear sdddd, Your softcodeint Mobile : +8801788989545 and your current balance : 4870.00 . www.softcodeint.com', 2, '2021-11-28 01:29:59', '2021-11-28 01:29:59'),
(497, 109, 254, 'user', 'admin', 'balance_status_send', '10.00', '2.00', '8.00', 'service', 109, 'Dear Ezekiel Zimmerman, Your softcodeint Mobile : +8801744112233 and your current balance : 10.00 . www.softcodeint.com', 2, '2021-11-28 01:29:59', '2021-11-28 01:29:59'),
(498, 111, 267, 'user', 'admin', 'balance_status_send', '10.00', '2.00', '8.00', 'service', 111, 'Dear 01788996633, Your softcodeint Mobile : +8801788996633 and your current balance : 10.00 . www.softcodeint.com', 2, '2021-10-05 01:29:59', '2021-11-28 01:29:59'),
(499, 111, 267, 'user', 'admin', 'balance_status_send', '10.00', '2.00', '8.00', 'service', 111, 'Dear 01788996633, Your softcodeint Mobile : +8801788996633 and your current balance : 10.00 . www.softcodeint.com', 2, '2021-11-28 03:50:09', '2021-11-28 03:50:09'),
(500, 2, NULL, 'user', 'user', 'withdraw', '478.60', '100.00', '378.60', 'user', NULL, 'Your Payment request listed successfully. TK 100  will be Credit in you bank account  11111111111111. Thank you for using softcode payment solution.', 2, '2021-11-29 06:15:42', '2021-11-29 06:15:42'),
(501, 2, NULL, 'user', 'user', 'withdraw', '378.60', '100.00', '278.60', 'user', 2, 'Your Payment request listed successfully. TK 100  will be Credit in you bank account  22222222222222. Thank you for using softcode payment solution.', 2, '2021-11-29 07:01:59', '2021-11-29 07:01:59'),
(502, 2, NULL, 'user', 'user', 'withdraw', '278.60', '50.00', '228.60', 'user', 2, 'Your Payment request listed successfully. TK 50  will be Credit in you bank account  5194654564564. Thank you for using softcode payment solution.', 2, '2021-11-29 07:25:03', '2021-11-29 07:25:03'),
(503, 2, 123, 'user', 'admin', 'sp_create_charge', '228.60', '90.00', '138.60', 'service_profile', 5, '90 TK deducted from my balance for creating business profile.', 2, '2021-12-01 02:05:46', '2021-12-01 02:05:46'),
(504, 2, 33, 'user', 'admin', 'sp_create_charge', '138.60', '0.00', '138.60', 'service_profile', 1, '0 TK deducted from my balance for creating business profile.', 2, '2021-12-01 02:12:57', '2021-12-01 02:12:57'),
(505, 2, 32, 'user', 'admin', 'service_profile_creation', '138.60', '0.00', '138.60', 'service', 1, '0 TK deducted from admin balance to Createing Service/Shop for user_id(2), Mobile (+8801918515567) .', 2, '2021-12-01 03:49:57', '2021-12-01 03:49:57'),
(506, 2, 32, 'subscriber', 'admin', 'job_post', '138.60', '12.00', '126.60', 'order', 123, '12 TK deducted from subscriber balance for job post.', 2, '2021-12-01 03:58:02', '2021-12-01 03:58:02'),
(507, 2, 32, 'admin', 'subscriber', 'honorarium', '316.95', '0.60', '317.55', 'affiliate', 123, '0.6 TK affiliate honorarium added to subscriber balance from admin.', 2, '2021-12-01 03:58:02', '2021-12-01 03:58:02'),
(508, 2, 123, 'user', 'admin', 'sp_create_charge', '126.60', '90.00', '36.60', 'service_profile', 5, '90 TK deducted from my balance for creating business profile.', 2, '2021-12-01 06:16:55', '2021-12-01 06:16:55'),
(509, 2, NULL, 'user', 'user', 'withdraw', '5000.00', '100.00', '4900.00', 'bkash', NULL, 'Your Payment request listed successfully. TK 100 bkash will be CashIn 01744508287. Thank you for using softcode payment solution.', 2, '2021-12-01 06:29:56', '2021-12-01 06:29:56'),
(510, 2, 32, 'admin', 'user', 'to_decline', '4900.00', '10.00', '4910.00', 'to_decline', NULL, 'afdsfsf', 2, '2021-12-01 07:06:02', '2021-12-01 07:06:02'),
(511, 2, 32, 'admin', 'user', 'to_decline', '4910.00', '50.00', '4960.00', 'to_decline', NULL, 'Taka Ache', 2, '2021-12-01 07:23:47', '2021-12-01 07:23:47'),
(512, 2, NULL, 'user', 'user', 'withdraw', '4960.00', '50.00', '4910.00', 'bkash', NULL, 'Your Payment request listed successfully. TK 50 bkash will be CashIn 01744508287. Thank you for using softcode payment solution.', 2, '2021-12-01 07:37:40', '2021-12-01 07:37:40'),
(513, 2, 32, 'user', 'user', 'withdrow_decline', '4910.00', '50.00', '4960.00', 'withdrow_decline', NULL, 'Declined', 2, '2021-12-01 07:38:15', '2021-12-01 07:38:15'),
(514, 2, 360, 'user', 'admin', 'sp_create_charge', '4960.00', '0.00', '4960.00', 'service', 2, '0 TK deducted from User balance. to Createing Service/Shop for user_id(126), Mobile (+8801744525252) .', 2, '2021-12-04 03:47:52', '2021-12-04 03:47:52'),
(515, 2, 361, 'user', 'admin', 'sp_create_charge', '4960.00', '0.00', '4960.00', 'service', 2, '0 TK deducted from User balance. to Createing Service/Shop for user_id(126), Mobile (+8801744525252) .', 2, '2021-12-04 03:52:16', '2021-12-04 03:52:16'),
(516, 2, 362, 'user', 'admin', 'sp_create_charge', '4960.00', '100.00', '4860.00', 'service', 3, '100 TK deducted from User balance. to Createing Service/Shop for user_id(126), Mobile (+8801744525252) .', 2, '2021-12-04 03:57:32', '2021-12-04 03:57:32'),
(517, 2, NULL, 'user', 'user', 'withdraw', '4860.00', '304.00', '4556.00', 'bkash', NULL, 'Your Payment request listed successfully. TK 304 bkash will be CashIn 01744508287. Thank you for using softcode payment solution.', 2, '2021-12-06 05:27:53', '2021-12-06 05:27:53'),
(518, 2, NULL, 'user', 'admin', 'withdraw_charge', '4556.00', '5.00', '4551.00', 'online_banking', NULL, 'Successfully TK 5 Charge for recharge 96 Taka. Thank you for using softcode mobile recharge solution.', 2, '2021-12-06 05:29:51', '2021-12-06 05:29:51'),
(519, 2, NULL, 'user', 'user', 'withdraw', '4551.00', '96.00', '4455.00', 'bkash', NULL, 'Your Payment request listed successfully. TK 96 bkash will be CashIn 01755555555. Thank you for using softcode payment solution.', 2, '2021-12-06 05:29:51', '2021-12-06 05:29:51'),
(520, 2, NULL, 'user', 'admin', 'withdraw_charge', '4455.00', '5.00', '4450.00', 'online_banking', NULL, 'Successfully TK 5 Charge for recharge 194 Taka. Thank you for using softcode mobile recharge solution.', 2, '2021-12-06 05:31:34', '2021-12-06 05:31:34'),
(521, 2, NULL, 'user', 'user', 'withdraw', '4450.00', '194.00', '4256.00', 'bkash', NULL, 'Your Payment request listed successfully. TK 194 bkash will be CashIn 01744508287. Thank you for using softcode payment solution.', 2, '2021-12-06 05:31:34', '2021-12-06 05:31:34'),
(522, 2, NULL, 'admin', 'user', 'withdraw_charge_decline', '4256.00', '5.00', '4261.00', 'withdraw_decline', NULL, 'Diclined', 2, '2021-12-06 05:33:41', '2021-12-06 05:33:41'),
(523, 2, NULL, 'user', 'user', 'withdraw_decline', '4261.00', '194.00', '4455.00', 'withdraw_decline', NULL, 'Diclined', 2, '2021-12-06 05:33:41', '2021-12-06 05:33:41'),
(524, 2, NULL, 'user', 'admin', 'withdraw_charge', '4455.00', '5.00', '4450.00', 'online_banking', NULL, 'Successfully TK 5 Charge for recharge 96 Taka. Thank you for using softcode mobile recharge solution.', 2, '2021-12-06 05:36:18', '2021-12-06 05:36:18'),
(525, 2, NULL, 'user', 'user', 'withdraw', '4450.00', '96.00', '4354.00', 'bkash', NULL, 'Your Payment request listed successfully. TK 96 bkash will be CashIn 01755555555. Thank you for using softcode payment solution.', 2, '2021-12-06 05:36:18', '2021-12-06 05:36:18'),
(526, 2, NULL, 'admin', 'user', 'withdraw_charge_decline', '4354.00', '5.00', '4359.00', 'withdraw_decline', NULL, '101 taka returned', 2, '2021-12-06 05:36:44', '2021-12-06 05:36:44'),
(527, 2, NULL, 'user', 'user', 'withdraw_decline', '4359.00', '96.00', '4455.00', 'withdraw_decline', NULL, '101 taka returned', 2, '2021-12-06 05:36:44', '2021-12-06 05:36:44'),
(528, 2, 44, 'user', 'admin', 'sp_create_charge', '4455.00', '0.00', '4455.00', 'service_profile', 1, '0 TK deducted from my balance for creating business profile.', 2, '2021-12-21 05:45:07', '2021-12-21 05:45:07'),
(529, 128, NULL, 'tenant', 'admin', 'new_subscription', '120.00', '100.00', '20.00', 'order', 97, 'To create new (pf-011000001729901) subscriber of (T-128) tenant, 100 TK deducted from tenant balance for subscription order. Payment id is 97.', 128, '2021-12-22 05:47:30', '2021-12-22 05:47:30'),
(530, 128, 365, 'admin', 'subscriber', 'honorarium', '0.00', '22.00', '22.00', 'joining_bonus', NULL, '22 tk joining honorarium balance added to subscriber 011000001729901 balance.', 128, '2021-12-22 05:47:30', '2021-12-22 05:47:30'),
(531, 128, 365, 'admin', 'subscriber', 'honorarium', '22.00', '11.00', '33.00', 'refferal_reward', NULL, '11 tk refferal reward honorarium balance  added to subscriber 011000001729901 balance (udc:617)', 128, '2021-12-22 05:47:30', '2021-12-22 05:47:30'),
(532, 2, 44, 'admin', 'user', 'order', '4955.00', '500.00', '5455.00', 'user', 3, '500 taka was added for complete Service Item order. Thanks for using softcode', 128, '2021-12-26 05:37:48', '2021-12-26 05:37:48'),
(533, 2, 44, 'admin', 'user', 'order', '5455.00', '0.00', '5455.00', 'user', 3, '0 taka was added for complete Service Item order. Thanks for using softcode', 128, '2021-12-26 05:39:51', '2021-12-26 05:39:51'),
(534, 2, 44, 'admin', 'user', 'order', '5455.00', '500.00', '5455.00', 'user', 3, '0 taka was added for complete Service Item order. Thanks for using softcode', 128, '2021-12-26 05:41:31', '2021-12-26 05:41:31'),
(535, 128, 44, 'user', 'admin', 'order', '1300.00', '500.00', '800.00', 'user', 128, '500.00 taka was deducted from your balance for Order service item (Business Card Service (2)). Thanks for using softcode', 128, '2021-12-26 06:04:43', '2021-12-26 06:04:43'),
(536, 2, 44, 'admin', 'user', 'order', '800.00', '500.00', '5455.00', 'user', 1, '500.00 taka was returned . Thanks for using softcode', 2, '2021-12-26 06:14:19', '2021-12-26 06:14:19'),
(537, 128, 44, 'user', 'admin', 'order', '1300.00', '500.00', '800.00', 'user', 128, '500.00 taka was deducted from your balance for Order service item (Business Card Service (2)). Thanks for using softcode', 128, '2021-12-26 06:15:07', '2021-12-26 06:15:07'),
(538, 2, 44, 'admin', 'user', 'order', '800.00', '500.00', '5455.00', 'user', 2, '500.00 taka was returned . Thanks for using softcode', 2, '2021-12-26 06:15:21', '2021-12-26 06:15:21'),
(539, 2, 32, 'user', 'admin', 'sp_create_charge', '5455.00', '0.00', '5455.00', 'service_profile', 1, '0 TK deducted from my balance for creating business profile.', 2, '2021-12-27 07:39:02', '2021-12-27 07:39:02'),
(540, 129, 44, 'user', 'admin', 'order', '25000.00', '500.00', '24500.00', 'user', 129, '500.00 taka was deducted from your balance for Order service item (Business Card Service (2)). Thanks for using softcode', 129, '2021-12-28 03:54:30', '2021-12-28 03:54:30'),
(541, 2, 44, 'admin', 'user', 'order', '5455.00', '500.00', '5955.00', 'user', 3, '500.00 taka was added for complete Service Item order. Thanks for using softcode', 129, '2021-12-28 04:21:46', '2021-12-28 04:21:46'),
(542, 129, 32, 'user', 'admin', 'order', '24500.00', '988.00', '23512.00', 'user', 129, '988.00 taka was deducted from your balance for Order service item (Consectetur facilis (5)). Thanks for using softcode', 129, '2021-12-28 04:55:08', '2021-12-28 04:55:08'),
(543, 129, 32, 'user', 'admin', 'order', '23512.00', '988.00', '22524.00', 'user', 129, '988.00 taka was deducted from your balance for Order service item (Consectetur facilis (5)). Thanks for using softcode', 129, '2021-12-28 04:55:39', '2021-12-28 04:55:39'),
(544, 2, 32, 'user', 'admin', 'order', '0.00', '0.00', '5955.00', 'user', 4, '0 taka was added for Service item sale . Order id (4) .', 129, '2021-12-28 05:25:22', '2021-12-28 05:25:22'),
(545, 2, 32, 'user', 'user', 'order', '5955.00', '0.00', '5955.00', 'user', 4, '0 taka was added for complete Service Item order. Thanks for using softcode', 129, '2021-12-28 05:25:22', '2021-12-28 05:25:22'),
(546, 128, 32, 'user', 'admin', 'order', '1300.00', '988.00', '312.00', 'user', 128, '988.00 taka was deducted from your balance for Order service item (Consectetur facilis (5)). Thanks for using softcode', 128, '2021-12-29 02:14:47', '2021-12-29 02:14:47'),
(547, 2, 32, 'user', 'admin', 'order', '0.00', '98.80', '6053.80', 'user', 5, '98.8 taka was added for Service item sale . Order id (5) .', 128, '2021-12-29 02:15:37', '2021-12-29 02:15:37'),
(548, 2, 32, 'user', 'user', 'order', '5955.00', '889.20', '6844.20', 'user', 5, '889.2 taka was added for complete Service Item order. Thanks for using softcode', 128, '2021-12-29 02:15:37', '2021-12-29 02:15:37'),
(549, 128, 32, 'user', 'admin', 'order', '8000.00', '500.00', '7500.00', 'user', 128, '500.00 taka was deducted from your balance for Order service item (Nostrud consequatur (4)). Thanks for using softcode', 128, '2021-12-29 02:20:01', '2021-12-29 02:20:01'),
(550, 128, 32, 'user', 'admin', 'order', '7500.00', '500.00', '7000.00', 'user', 128, '500.00 taka was deducted from your balance for Order service item (Nostrud consequatur (4)). Thanks for using softcode', 128, '2021-12-29 06:09:01', '2021-12-29 06:09:01'),
(551, 128, 365, 'user', 'admin', 'sp_create_charge', '7000.00', '0.00', '7000.00', 'service_profile', 1, '0 TK deducted from my balance for creating business profile.', 128, '2022-01-02 06:13:04', '2022-01-02 06:13:04'),
(552, 2, 365, 'user', 'admin', 'order', '6844.20', '120.00', '6724.20', 'user', 2, '120.00 taka was deducted from your balance for Order service item (Auto Repire (7)). Thanks for using softcode', 2, '2022-01-02 06:14:18', '2022-01-02 06:14:18'),
(553, 128, 365, 'user', 'admin', 'order', '0.00', '12.00', '7012.00', 'user', 8, '12 taka was added for Service item sale . Order id (8) .', 2, '2022-01-02 06:18:33', '2022-01-02 06:18:33'),
(554, 128, 365, 'user', 'user', 'order', '7000.00', '108.00', '7108.00', 'user', 8, '108 taka was added for complete Service Item order. Thanks for using softcode', 2, '2022-01-02 06:18:33', '2022-01-02 06:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `need_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ws_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `workstation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_profile` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `delivery_date` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `excerpt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_img_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `categories` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `publish_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'temp',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` int(10) UNSIGNED DEFAULT NULL,
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `title`, `description`, `excerpt`, `feature_img_name`, `tags`, `categories`, `date`, `publish_status`, `type`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'The best matchmaker and matrimonial site', 'The best matchmaker and matrimonial site in Bangladesh is bridegroombd.com. It is the most trusted marriage media and leading matrimony matchmaking service provider in Bangladesh. In previous time a ghotok was an important person in the process of marriage. He physically played a vital role for marriage by negotiating between', 'Duis eos consequatu', '1637488614.jpg', 'aa, b, s, cd', NULL, NULL, 'published', 'blog', 2, NULL, '2021-11-21 03:38:36', '2021-11-21 03:56:54'),
(2, 2, 'Duis eos consequatu', 'The best matchmaker and matrimonial site in Bangladesh is bridegroombd.com. It is the most trusted marriage media and leading matrimony matchmaking service provider in Bangladesh. In previous time a ghotok was an important person in the process of marriage. He physically played a vital role for marriage by negotiating between', 'Duis eos consequatu', '1637488838.jpg', 'aa, b, s, cd', NULL, NULL, 'published', 'blog', 2, NULL, '2021-11-21 04:00:38', '2021-11-21 04:00:38'),
(3, 2, 'Duis eos consequatu', 'The best matchmaker and matrimonial site in Bangladesh is bridegroombd.com. It is the most trusted marriage media and leading matrimony matchmaking service provider in Bangladesh. In previous time a ghotok was an important person in the process of marriage. He physically played a vital role for marriage by negotiating between', 'Duis eos consequatu', '1637488876.jpg', 'aa, b, s, cd', NULL, NULL, 'published', 'blog', 2, NULL, '2021-11-21 04:01:16', '2021-11-21 04:01:16'),
(4, 2, 'Perspiciatis sit e', 'Hic corrupti ullam', 'Perspiciatis sit e', '1637488927.jpg', 'Fugit', NULL, NULL, 'published', 'blog', 2, NULL, '2021-11-21 04:01:18', '2021-11-21 04:02:07'),
(5, 2, 'Perspiciatis sit ePerspiciatis sit e', 'Hic corrupti ullam', 'Perspiciatis sit e', '1637488989.jpg', 'Fugit', NULL, NULL, 'published', 'blog', 2, NULL, '2021-11-21 04:03:09', '2021-11-21 04:03:09'),
(6, 2, 'Aperiam expedita ear afds', 'Aperiam expedita ear afds', 'Porro labore aute cu', '1637489081.jpg', 'asd, ad', NULL, NULL, 'published', 'event', 2, NULL, '2021-11-21 04:04:27', '2021-11-21 04:04:41'),
(8, 2, 'Similique ut unde te', 'Similique ut unde te', 'Modi quisquam sit v', '1637489179.jpg', 'Excepteur', NULL, NULL, 'published', 'blog', 2, NULL, '2021-11-21 04:06:11', '2021-11-21 04:06:19'),
(10, 2, 'The best matchmaker and matrimonial site in Bangladesh is bridegroombd', 'The best matchmaker and matrimonial site in The best matchmaker and matrimonial site in Bangladesh is bridegroombdThe best matchmaker and matrimonial site in Bangladesh is bridegroombdThe best matchmaker and matrimonial site in Bangladesh is bridegroombdThe best matchmaker and matrimonial site in Bangladesh is bridegroombdThe best matchmaker and matrimonial site in Bangladesh is bridegroombdBangladesh is bridegroombd', 'The best matchmaker and matrimonial site in Bangladesh is bridegroombdThe best matchmaker and matrimonial site in Bangladesh is bridegroombdThe best matchmaker and matrimonial site in Bangladesh is bridegroombd', '1637497171.jpg', 'matrimonial, matchmaker', NULL, NULL, 'published', 'news', 2, NULL, '2021-11-21 04:11:12', '2021-11-21 06:19:31'),
(11, 2, 'Aliquip aspernatur n', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.', 'Quibusdam in volupta', '1637497405.jpg', 'matchmaker', NULL, NULL, 'published', 'blog', 2, NULL, '2021-11-21 06:19:31', '2021-11-21 06:23:25');
INSERT INTO `blogs` (`id`, `user_id`, `title`, `description`, `excerpt`, `feature_img_name`, `tags`, `categories`, `date`, `publish_status`, `type`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
INSERT INTO `blogs` (`id`, `user_id`, `title`, `description`, `excerpt`, `feature_img_name`, `tags`, `categories`, `date`, `publish_status`, `type`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(13, 2, 'news 1', 'Eum sunt consecteturEum sunt consecteturEum sunt consecteturEum sunt consecteturEum sunt consecteturEum sunt consecteturEum sunt consectetur', 'Unde velit tenetur o Eum sunt consecteturEum sunt consecteturEum sunt consectetur', '1637562429.png', 'news1', NULL, NULL, 'published', 'news', 2, NULL, '2021-11-22 00:21:17', '2021-11-22 00:27:09'),
(14, 2, 'Electronics', 'ElectronicsElectronicsElectronicsElectronics ElectronicsElectronicsElectronics Exercitationem facer', 'Anim quia quaerat ve ElectronicsElectronicsElectronics', '1637563061.png', 'Electronics', NULL, NULL, 'published', 'news', 2, NULL, '2021-11-22 00:27:09', '2021-11-22 00:37:41'),
(15, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'temp', NULL, 2, NULL, '2021-11-22 00:37:42', '2021-11-22 00:37:42'),
(16, 120, 'Contrary to popular belief, Lorem Ipsum is not simply random text.', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum,', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,', '1637588451.jpg', '01722336655, new', NULL, NULL, 'pending', 'blog', 120, NULL, '2021-11-22 07:40:51', '2021-11-22 07:40:51'),
(17, 120, 'Contrary to popular belief, Lorem Ipsum is not simply random text.', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum,', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,', '1637588630.jpeg', '01722336655, new', NULL, NULL, 'published', 'blog', 121, NULL, '2021-11-22 07:43:50', '2021-11-24 01:28:19');
INSERT INTO `blogs` (`id`, `user_id`, `title`, `description`, `excerpt`, `feature_img_name`, `tags`, `categories`, `date`, `publish_status`, `type`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Home', '2021-11-21 03:38:56', '2021-11-21 03:38:56'),
(2, 'Office', '2021-11-21 03:39:00', '2021-11-21 03:39:00'),
(3, 'Electronics', '2021-11-21 03:39:07', '2021-11-21 07:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_tags`
--

INSERT INTO `blog_tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'aa', '2021-11-21 03:56:53', '2021-11-21 03:56:53'),
(2, 'b', '2021-11-21 03:56:53', '2021-11-21 03:56:53'),
(3, 's', '2021-11-21 03:56:53', '2021-11-21 03:56:53'),
(4, 'cd', '2021-11-21 03:56:53', '2021-11-21 03:56:53'),
(5, 'Fugit', '2021-11-21 04:02:07', '2021-11-21 04:02:07'),
(6, 'asd', '2021-11-21 04:04:41', '2021-11-21 04:04:41'),
(7, 'ad', '2021-11-21 04:04:41', '2021-11-21 04:04:41'),
(8, 'Excepteur', '2021-11-21 04:06:19', '2021-11-21 04:06:19'),
(9, 'nice articlew', '2021-11-21 04:11:12', '2021-11-21 04:11:12'),
(10, 'idk', '2021-11-21 04:11:12', '2021-11-21 04:11:12'),
(11, 'om', '2021-11-21 04:11:12', '2021-11-21 04:11:12'),
(12, 'ondhokar', '2021-11-21 05:21:34', '2021-11-21 05:21:34'),
(13, 'matrimonial88', '2021-11-21 06:19:30', '2021-11-21 07:42:39'),
(14, 'matchmaker', '2021-11-21 06:19:30', '2021-11-21 06:19:30'),
(15, 'new', '2021-11-22 00:21:16', '2021-11-22 00:21:16'),
(16, 'latest', '2021-11-22 00:21:16', '2021-11-22 00:21:16'),
(17, 'news1', '2021-11-22 00:27:09', '2021-11-22 00:27:09'),
(18, 'Electronics', '2021-11-22 00:37:41', '2021-11-22 00:37:41'),
(19, '01744589785', '2021-11-22 07:18:01', '2021-11-22 07:18:01'),
(20, '01722336655', '2021-11-22 07:40:51', '2021-11-22 07:40:51'),
(21, 'Quis', '2021-11-22 07:46:39', '2021-11-22 07:46:39');

-- --------------------------------------------------------

--
-- Table structure for table `brand_outlets`
--

CREATE TABLE `brand_outlets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `outlet_id` int(11) DEFAULT NULL,
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_outlets`
--

INSERT INTO `brand_outlets` (`id`, `brand_id`, `outlet_id`, `addedby_id`, `created_at`, `updated_at`) VALUES
(8, 3, 3, 2, '2021-02-13 23:44:17', '2021-02-13 23:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `drag_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_product_commission` int(11) NOT NULL DEFAULT '10',
  `product_commission_balance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `img_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_station_id` int(11) DEFAULT NULL,
  `sp_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_header_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_header_text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_footer_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_footer_text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_body_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_body_text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_short_price` decimal(10,2) DEFAULT '0.00',
  `sp_full_price` decimal(10,2) DEFAULT '0.00',
  `sp_full_price_owner_com` int(11) NOT NULL DEFAULT '0',
  `sp_full_p_view_btn_txt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_short_price_owner_com` int(11) NOT NULL DEFAULT '0',
  `sp_short_p_view_btn_txt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_chat` tinyint(1) NOT NULL DEFAULT '1',
  `sp_active` tinyint(1) NOT NULL DEFAULT '0',
  `sp_review` tinyint(1) DEFAULT '1',
  `sp_featured` tinyint(1) NOT NULL DEFAULT '1',
  `sp_location` tinyint(1) NOT NULL DEFAULT '1',
  `sp_bidding` tinyint(1) NOT NULL DEFAULT '0',
  `sp_order` tinyint(1) NOT NULL DEFAULT '0',
  `sp_create_charge` float(10,2) NOT NULL DEFAULT '100.00',
  `pp_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_header_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_header_text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_footer_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_footer_text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_body_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_body_text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_featured` tinyint(1) NOT NULL DEFAULT '1',
  `pp_chat` tinyint(1) NOT NULL DEFAULT '1',
  `pp_review` tinyint(1) NOT NULL DEFAULT '1',
  `pp_active` tinyint(1) NOT NULL DEFAULT '0',
  `pp_location` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `business_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'shop',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `drag_id`, `name`, `description`, `service_product_commission`, `product_commission_balance`, `img_name`, `banner_name`, `work_station_id`, `sp_title`, `sp_description`, `sp_header_bg_color`, `sp_header_text_color`, `sp_footer_bg_color`, `sp_footer_text_color`, `sp_body_bg_color`, `sp_body_text_color`, `sp_short_price`, `sp_full_price`, `sp_full_price_owner_com`, `sp_full_p_view_btn_txt`, `sp_short_price_owner_com`, `sp_short_p_view_btn_txt`, `sp_chat`, `sp_active`, `sp_review`, `sp_featured`, `sp_location`, `sp_bidding`, `sp_order`, `sp_create_charge`, `pp_title`, `pp_description`, `pp_header_bg_color`, `pp_header_text_color`, `pp_footer_bg_color`, `pp_footer_text_color`, `pp_body_bg_color`, `pp_body_text_color`, `pp_featured`, `pp_chat`, `pp_review`, `pp_active`, `pp_location`, `active`, `business_type`, `featured`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, NULL, '{\"en\":\"OBSB\"}', '{\"en\":\"OBSB\"}', 10, '209.60', '', '1.jpg', 1, 'Biz Prof', 'asdfasdf', '#ff0000', '#ffffff', '#0040ff', '#ffffff', '#ffbb00', '#000000', '10.00', '100.00', 40, 'Full price', 5, 'click here for short paid', 1, 1, 1, 1, 1, 0, 0, 0.00, 'Per Prof', 'asdfasdf', '#008552', '#ffffff', '#112c0c', '#ffffff', '#005706', '#0f0000', 1, 1, 1, 1, 1, 1, 'service', 0, NULL, 2, '2021-03-04 00:36:55', '2022-01-02 06:18:33'),
(2, NULL, '{\"en\":\"Graphics Design\"}', '{\"en\":\"Graphics Design\"}', 10, '0.00', '2_img_2021_04_18_112441_81060578.gif', NULL, 1, 'Graphic Designer', 'Graphic Designer', '#990f0f', '#f5f5f5', '#830707', '#ffffff', '#ffffff', '#000000', '10.00', '100.00', 10, 'Full View', 5, 'Short View', 1, 1, 1, 1, 1, 0, 1, 0.00, 'GP Seeker', 'GP Seeker', '#000000', '#ffffff', '#000000', '#ffffff', '#000000', '#ffffff', 1, 1, 1, 1, 1, 1, 'shop', 0, NULL, 2, '2021-03-04 00:37:17', '2021-10-06 00:47:50'),
(3, NULL, '{\"en\":\"Video Editing\"}', '{\"en\":\"Video Editing\"}', 10, '29.90', NULL, NULL, 1, 'Business', 'test 2', '#ff0000', '#ffffff', '#00801a', '#ffffff', '#c0b9b9', '#000000', '10.00', '100.00', 0, NULL, 0, NULL, 1, 1, 1, 1, 1, 0, 1, 100.00, 'Personal', 'asdkjlkjasdn', '#ec1313', '#793e3e', '#d91212', '#4b9f1e', '#6911ee', '#d2ea1f', 0, 1, 0, 1, 0, 1, 'shop', 0, NULL, 2, '2021-03-04 00:37:37', '2021-11-07 01:43:01'),
(4, NULL, '{\"en\":\"Academic\"}', '{\"en\":\"academic\"}', 10, '0.00', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 1, 0, 1, 1, 1, 0, 0, 0.00, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 1, 1, 'shop', 0, NULL, 2, '2021-04-18 17:06:02', '2021-04-18 17:06:02'),
(5, NULL, '{\"en\":\"okk\"}', '{\"en\":\"done\"}', 10, '0.00', NULL, NULL, 2, 'biz profile', 'tesss 777', '#ff0000', '#ffffff', '#d5d3f3', '#3329c2', '#b6c7b2', '#003170', '50.00', '100.00', 0, NULL, 0, NULL, 1, 1, 0, 0, 0, 0, 1, 90.00, 'personal profile', 'tetet', '#1300a3', '#ffffff', '#a34700', '#ffffff', '#ea7b7b', '#000000', 1, 1, 1, 1, 1, 1, 'service', 1, NULL, 2, '2021-04-18 17:07:21', '2021-12-18 07:13:31'),
(7, NULL, '{\"en\":\"Inbound\"}', '{\"en\":\"Domestic\"}', 10, '0.00', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 1, 0, 1, 1, 1, 0, 0, 0.00, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 1, 1, 'shop', 0, NULL, 2, '2021-04-18 17:11:03', '2021-04-18 17:11:03'),
(8, NULL, '{\"en\":\"Outbound\"}', '{\"en\":\"International\"}', 10, '0.00', NULL, NULL, 3, 'Plumber', 'Plumber Details', '#000000', '#000000', '#000000', '#000000', '#000000', '#000000', '10.00', '100.00', 10, 'View', 5, 'View', 1, 0, 1, 1, 1, 0, 0, 100.00, 'Personal Profile', 'Personal Profile Desc', '#ffffff', '#000000', '#ffffff', '#000000', '#ffffff', '#000000', 1, 1, 1, 0, 1, 1, 'service', 0, NULL, 2, '2021-04-18 17:11:22', '2021-12-18 07:13:02'),
(11, NULL, '{\"en\":\"Buyer\"}', '{\"en\":\"property buyer\"}', 10, '0.00', NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 1, 0, 1, 1, 1, 0, 0, 0.00, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 1, 1, 'shop', 0, NULL, 2, '2021-04-18 17:18:21', '2021-04-18 17:18:21'),
(12, NULL, '{\"en\":\"Seller\"}', '{\"en\":\"Property Seller\"}', 10, '0.00', NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 1, 0, 1, 1, 1, 0, 0, 0.00, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 1, 1, 'shop', 0, NULL, 2, '2021-04-18 17:18:51', '2021-04-18 17:18:51'),
(13, NULL, '{\"en\":\"Individual\"}', '{\"en\":\"trans...\"}', 10, '0.00', NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 1, 0, 1, 1, 1, 0, 0, 0.00, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 1, 1, 'shop', 0, NULL, 2, '2021-04-18 17:20:11', '2021-04-18 17:20:11'),
(14, NULL, '{\"en\":\"Business\"}', '{\"en\":\"Biz\"}', 10, '0.00', NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 1, 0, 1, 1, 1, 0, 0, 0.00, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 1, 1, 'shop', 0, NULL, 2, '2021-04-18 17:20:47', '2021-04-18 17:20:47'),
(15, NULL, '{\"en\":\"Test\"}', '{\"en\":\"test\"}', 10, '0.00', '15_img_2021_11_14_095447_50858965.jpeg', '15_banner_2021_11_14_095447_35682830.png', 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', 0, NULL, 0, NULL, 1, 0, 1, 1, 1, 0, 1, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0, 1, 1, 'shop', 0, NULL, 2, '2021-11-14 03:54:46', '2021-11-14 03:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `category_products`
--

CREATE TABLE `category_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addedby_id` bigint(20) UNSIGNED NOT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `description`, `commentable_id`, `commentable_type`, `addedby_id`, `editedby_id`, `verified`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'asdf\r\nasdf\r\na\r\nadfsdf\r\nsdfsdf', 10, 'App\\Models\\Post', 2, NULL, 1, '2021-04-28 03:56:22', '2021-04-28 03:56:22', NULL),
(3, 'asdf\r\nasdf\r\na\r\nadfsdf\r\nsdfsdf\r\nasdfasdf', 10, 'App\\Models\\Post', 2, NULL, 1, '2021-04-28 04:21:06', '2021-04-28 04:21:06', NULL),
(6, 'aaa', 4, 'App\\Models\\Post', 2, NULL, 1, '2021-04-29 19:17:11', '2021-04-29 19:17:11', NULL),
(7, 'wewe', 7, 'App\\Models\\Post', 2, NULL, 1, '2021-04-29 19:17:26', '2021-04-29 19:17:26', NULL),
(15, 'a', 10, 'App\\Models\\Post', 2, NULL, 1, '2021-04-29 23:14:46', '2021-04-29 23:14:46', NULL),
(16, 'abc', 10, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 03:55:40', '2021-04-30 03:55:40', NULL),
(17, 'aa', 8, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 03:57:10', '2021-04-30 03:57:10', NULL),
(18, 'aa', 8, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:00:23', '2021-04-30 04:00:23', NULL),
(19, 'bb', 8, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:00:29', '2021-04-30 04:00:29', NULL),
(20, 'cc', 8, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:00:34', '2021-04-30 04:00:34', NULL),
(21, 'dd', 8, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:00:37', '2021-04-30 04:00:37', NULL),
(22, 'aa', 6, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:02:04', '2021-04-30 04:02:04', NULL),
(23, 'asdf afasdf asdf asd fasd fas dfas df asdf', 6, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:02:12', '2021-04-30 04:02:12', NULL),
(24, 'aa', 6, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:03:12', '2021-04-30 04:03:12', NULL),
(27, 'asdf', 7, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:04:17', '2021-04-30 04:04:17', NULL),
(28, 'a', 7, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:05:28', '2021-04-30 04:05:28', NULL),
(29, 'asdf', 10, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:05:47', '2021-04-30 04:05:47', NULL),
(30, 'as', 10, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:06:06', '2021-04-30 04:06:06', NULL),
(31, 'eee', 10, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:06:27', '2021-04-30 04:06:27', NULL),
(32, 'ee', 7, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:07:33', '2021-04-30 04:07:33', NULL),
(33, 'ee', 6, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:07:58', '2021-04-30 04:07:58', NULL),
(34, 'ee', 6, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:08:13', '2021-04-30 04:08:13', NULL),
(35, 'aa', 8, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 04:10:29', '2021-04-30 04:10:29', NULL),
(37, 'asdf', 8, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 09:27:33', '2021-04-30 09:27:33', NULL),
(38, 'wqer', 8, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 09:27:35', '2021-04-30 09:27:35', NULL),
(39, 'sdf', 8, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 09:27:38', '2021-04-30 09:27:38', NULL),
(40, 'qwrew', 8, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 09:27:42', '2021-04-30 09:27:42', NULL),
(41, 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqq qqqqqqqqqqqqqqqqqq qqqqqqqqqqqqqqq', 10, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 09:27:57', '2021-04-30 09:27:57', NULL),
(42, 'asdf', 9, 'App\\Models\\Post', 2, NULL, 1, '2021-04-30 09:30:30', '2021-04-30 09:30:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `division_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bn_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addedby_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `website`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 3, 'Dhaka', 'ঢাকা', 23.7115253, 90.4111451, 'www.dhaka.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(2, 3, 'Faridpur', 'ফরিদপুর', 23.6070822, 89.8429406, 'www.faridpur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(3, 3, 'Gazipur', 'গাজীপুর', 24.0022858, 90.4264283, 'www.gazipur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(4, 3, 'Gopalganj', 'গোপালগঞ্জ', 23.0050857, 89.8266059, 'www.gopalganj.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(5, 8, 'Jamalpur', 'জামালপুর', 24.937533, 89.937775, 'www.jamalpur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(6, 3, 'Kishoreganj', 'কিশোরগঞ্জ', 24.444937, 90.776575, 'www.kishoreganj.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(7, 3, 'Madaripur', 'মাদারীপুর', 23.164102, 90.1896805, 'www.madaripur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(8, 3, 'Manikganj', 'মানিকগঞ্জ', 0, 0, 'www.manikganj.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(9, 3, 'Munshiganj', 'মুন্সিগঞ্জ', 0, 0, 'www.munshiganj.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(10, 8, 'Mymensingh', 'ময়মনসিং', 0, 0, 'www.mymensingh.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(11, 3, 'Narayanganj', 'নারায়াণগঞ্জ', 23.63366, 90.496482, 'www.narayanganj.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(12, 3, 'Narsingdi', 'নরসিংদী', 23.932233, 90.71541, 'www.narsingdi.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(13, 8, 'Netrokona', 'নেত্রকোনা', 24.870955, 90.727887, 'www.netrokona.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(14, 3, 'Rajbari', 'রাজবাড়ি', 23.7574305, 89.6444665, 'www.rajbari.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(15, 3, 'Shariatpur', 'শরীয়তপুর', 0, 0, 'www.shariatpur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(16, 8, 'Sherpur', 'শেরপুর', 25.0204933, 90.0152966, 'www.sherpur.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(17, 3, 'Tangail', 'টাঙ্গাইল', 0, 0, 'www.tangail.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(18, 5, 'Bogra', 'বগুড়া', 24.8465228, 89.377755, 'www.bogra.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(19, 5, 'Joypurhat', 'জয়পুরহাট', 0, 0, 'www.joypurhat.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(20, 5, 'Naogaon', 'নওগাঁ', 0, 0, 'www.naogaon.gov.bd', 1, NULL, '2018-09-27 07:06:23', '2018-09-27 07:06:23'),
(21, 5, 'Natore', 'নাটোর', 24.420556, 89.000282, 'www.natore.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(22, 5, 'Nawabganj', 'নবাবগঞ্জ', 24.5965034, 88.2775122, 'www.chapainawabganj.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(23, 5, 'Pabna', 'পাবনা', 23.998524, 89.233645, 'www.pabna.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(24, 5, 'Rajshahi', 'রাজশাহী', 0, 0, 'www.rajshahi.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(25, 5, 'Sirajgonj', 'সিরাজগঞ্জ', 24.4533978, 89.7006815, 'www.sirajganj.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(26, 6, 'Dinajpur', 'দিনাজপুর', 25.6217061, 88.6354504, 'www.dinajpur.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(27, 6, 'Gaibandha', 'গাইবান্ধা', 25.328751, 89.528088, 'www.gaibandha.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(28, 6, 'Kurigram', 'কুড়িগ্রাম', 25.805445, 89.636174, 'www.kurigram.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(29, 6, 'Lalmonirhat', 'লালমনিরহাট', 0, 0, 'www.lalmonirhat.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(30, 6, 'Nilphamari', 'নীলফামারী', 25.931794, 88.856006, 'www.nilphamari.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(31, 6, 'Panchagarh', 'পঞ্চগড়', 26.3411, 88.5541606, 'www.panchagarh.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(32, 6, 'Rangpur', 'রংপুর', 25.7558096, 89.244462, 'www.rangpur.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(33, 6, 'Thakurgaon', 'ঠাকুরগাঁও', 26.0336945, 88.4616834, 'www.thakurgaon.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(34, 1, 'Barguna', 'বরগুনা', 0, 0, 'www.barguna.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(35, 1, 'Barisal', 'বরিশাল', 0, 0, 'www.barisal.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(36, 1, 'Bhola', 'ভোলা', 22.685923, 90.648179, 'www.bhola.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(37, 1, 'Jhalokati', 'ঝালকাঠি', 0, 0, 'www.jhalakathi.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(38, 1, 'Patuakhali', 'পটুয়াখালী', 22.3596316, 90.3298712, 'www.patuakhali.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(39, 1, 'Pirojpur', 'পিরোজপুর', 0, 0, 'www.pirojpur.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(40, 2, 'Bandarban', 'বান্দরবান', 22.1953275, 92.2183773, 'www.bandarban.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(41, 2, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', 23.9570904, 91.1119286, 'www.brahmanbaria.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(42, 2, 'Chandpur', 'চাঁদপুর', 23.2332585, 90.6712912, 'www.chandpur.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(43, 2, 'Chittagong', 'চট্টগ্রাম', 22.335109, 91.834073, 'www.chittagong.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(44, 2, 'Comilla', 'কুমিল্লা', 23.4682747, 91.1788135, 'www.comilla.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(45, 2, 'Cox\'s Bazar', 'কক্স বাজার', 0, 0, 'www.coxsbazar.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(46, 2, 'Feni', 'ফেনী', 23.023231, 91.3840844, 'www.feni.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(47, 2, 'Khagrachari', 'খাগড়াছড়ি', 23.119285, 91.984663, 'www.khagrachhari.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(48, 2, 'Lakshmipur', 'লক্ষ্মীপুর', 22.942477, 90.841184, 'www.lakshmipur.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(49, 2, 'Noakhali', 'নোয়াখালী', 22.869563, 91.099398, 'www.noakhali.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(50, 2, 'Rangamati', 'রাঙ্গামাটি', 0, 0, 'www.rangamati.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(51, 7, 'Habiganj', 'হবিগঞ্জ', 24.374945, 91.41553, 'www.habiganj.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(52, 7, 'Maulvibazar', 'মৌলভীবাজার', 24.482934, 91.777417, 'www.moulvibazar.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(53, 7, 'Sunamganj', 'সুনামগঞ্জ', 25.0658042, 91.3950115, 'www.sunamganj.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(54, 7, 'Sylhet', 'সিলেট', 24.8897956, 91.8697894, 'www.sylhet.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(55, 4, 'Bagerhat', 'বাগেরহাট', 22.651568, 89.785938, 'www.bagerhat.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(56, 4, 'Chuadanga', 'চুয়াডাঙ্গা', 23.6401961, 88.841841, 'www.chuadanga.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(57, 4, 'Jessore', 'যশোর', 23.16643, 89.2081126, 'www.jessore.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(58, 4, 'Jhenaidah', 'ঝিনাইদহ', 23.5448176, 89.1539213, 'www.jhenaidah.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(59, 4, 'Khulna', 'খুলনা', 22.815774, 89.568679, 'www.khulna.gov.bd', 1, NULL, '2018-09-27 07:06:24', '2018-09-27 07:06:24'),
(60, 4, 'Kushtia', 'কুষ্টিয়া', 23.901258, 89.120482, 'www.kushtia.gov.bd', 1, NULL, '2018-09-27 07:06:25', '2018-09-27 07:06:25'),
(61, 4, 'Magura', 'মাগুরা', 23.487337, 89.419956, 'www.magura.gov.bd', 1, NULL, '2018-09-27 07:06:25', '2018-09-27 07:06:25'),
(62, 4, 'Meherpur', 'মেহেরপুর', 23.762213, 88.631821, 'www.meherpur.gov.bd', 1, NULL, '2018-09-27 07:06:25', '2018-09-27 07:06:25'),
(63, 4, 'Narail', 'নড়াইল', 23.172534, 89.512672, 'www.narail.gov.bd', 1, NULL, '2018-09-27 07:06:25', '2018-09-27 07:06:25'),
(64, 4, 'Satkhira', 'সাতক্ষীরা', 0, 0, 'www.satkhira.gov.bd', 1, NULL, '2018-09-27 07:06:25', '2018-09-27 07:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bn_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addedby_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Barisal', 'বরিশাল', 1, 1, '2018-08-14 08:10:15', '2018-09-15 06:01:57'),
(2, 'Chittagong', 'চট্টগ্রাম', 1, NULL, '2018-08-14 08:10:15', '2018-08-14 08:10:15'),
(3, 'Dhaka', 'ঢাকা', 1, NULL, '2018-08-14 08:10:15', '2018-08-14 08:10:15'),
(4, 'Khulna', 'খুলনা', 1, NULL, '2018-08-14 08:10:15', '2018-08-14 08:10:15'),
(5, 'Rajshahi', 'রাজশাহী', 1, NULL, '2018-08-14 08:10:16', '2018-08-14 08:10:16'),
(6, 'Rangpur', 'রংপুর', 1, NULL, '2018-08-14 08:10:16', '2018-08-14 08:10:16'),
(7, 'Sylhet', 'সিলেট', 1, NULL, '2018-08-14 08:10:16', '2018-08-14 08:10:16'),
(8, 'Mymensingh', 'ময়মনসিংহ', 1, NULL, '2018-08-14 08:10:16', '2018-08-14 08:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `favourable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `favourable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `favourable_id`, `favourable_type`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(23, 2, 20, 'App\\Models\\ServiceProfile', 2, NULL, '2021-11-17 05:36:07', '2021-11-17 05:36:07'),
(25, 2, 24, 'App\\Models\\ServiceProfile', 2, NULL, '2021-11-17 05:47:55', '2021-11-17 05:47:55'),
(42, 2, 1, 'App\\Models\\ServiceProfileProduct', 2, NULL, '2021-11-20 03:52:25', '2021-11-20 03:52:25'),
(44, 2, 7, 'App\\Models\\ServiceProfile', 2, NULL, '2021-11-20 03:57:27', '2021-11-20 03:57:27'),
(45, 125, 5, 'App\\Models\\Need', 125, NULL, '2021-11-27 05:50:12', '2021-11-27 05:50:12'),
(47, 2, 10, 'App\\Models\\ServiceProfile', 2, NULL, '2021-11-29 02:16:45', '2021-11-29 02:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_jobs`
--

CREATE TABLE `freelancer_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_station_id` int(11) DEFAULT NULL,
  `subscriber_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `subcategory_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `link` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_worker` int(10) UNSIGNED DEFAULT NULL,
  `work_done` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `job_post_price` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `job_work_price` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `total_job_work_cost` decimal(12,3) UNSIGNED DEFAULT NULL,
  `commission` int(10) UNSIGNED NOT NULL DEFAULT '10',
  `total_job_post_cost` decimal(12,4) UNSIGNED DEFAULT '0.0000',
  `expired_day` date DEFAULT NULL,
  `status` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_given_workers` bigint(20) NOT NULL DEFAULT '0',
  `admin_completed_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_custom_job_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` int(10) UNSIGNED NOT NULL,
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `freelancer_jobs`
--

INSERT INTO `freelancer_jobs` (`id`, `work_station_id`, `subscriber_id`, `user_id`, `category_id`, `subcategory_id`, `title`, `description`, `link`, `img_name`, `total_worker`, `work_done`, `job_post_price`, `job_work_price`, `total_job_work_cost`, `commission`, `total_job_post_cost`, `expired_day`, `status`, `admin_given_workers`, `admin_completed_status`, `admin_custom_job_status`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 1, 32, 2, 3, 8, 'Aliquid voluptates e', 'Et velit autem occa', NULL, '1_img_2021_03_04_104715_74554348.jpg', 9, 0, '0.0000', '0.0000', '10.000', 10, '100.0000', '2021-03-31', 'temp', 0, NULL, NULL, 2, NULL, '2021-03-04 04:47:15', '2021-03-04 04:47:15'),
(2, 1, 32, 2, 2, 5, 'Deserunt elit vel i', 'In aperiam culpa ips', NULL, NULL, 24, 0, '0.0000', '0.0000', '5.000', 10, '130.0000', '2021-03-05', NULL, 0, NULL, 'ongoing', 2, NULL, '2021-03-04 06:04:42', '2021-08-10 02:38:00'),
(3, 1, 32, 2, 4, NULL, 'Repellendus Qui dis', 'Et autem culpa alias', NULL, NULL, 1, 0, '0.0000', '0.0000', '10.000', 10, '20.0000', '2021-03-26', NULL, 0, NULL, NULL, 2, NULL, '2021-03-05 22:30:38', '2021-03-28 00:32:20'),
(4, 1, 32, 2, 4, 9, 'Similique magna perf', 'Facilis totam omnis', NULL, NULL, 22, 0, '0.0000', '0.0000', '11.000', 10, '252.0000', '2021-03-23', 'completed', 0, NULL, NULL, 2, 2, '2021-03-05 22:32:15', '2021-08-10 05:43:22'),
(5, 1, 32, 2, 1, 2, 'test business', 'asdadasd', NULL, '5_img_2021_03_06_010120_45575559.jpg', 122, 0, '0.0000', '0.0000', '1.000', 10, '132.0000', '2021-03-31', 'completed', 10, NULL, NULL, 2, 2, '2021-03-06 07:01:20', '2021-08-10 05:49:43'),
(6, 1, 32, 2, 1, 2, 'test business', '123test', NULL, '6_img_2021_03_10_102353_86254830.png', 5, 0, '0.0000', '0.0000', '10.000', 10, '60.0000', '2021-03-17', NULL, 0, NULL, NULL, 2, NULL, '2021-03-10 04:23:52', '2021-03-10 04:23:53'),
(7, 1, 32, 2, 1, 2, 'test business', '123test', NULL, '7_img_2021_03_10_102425_92462474.png', 5, 0, '0.0000', '0.0000', '10.000', 10, '60.0000', '2021-03-17', 'completed', 2, NULL, NULL, 2, 2, '2021-03-10 04:24:25', '2021-08-10 06:14:37'),
(9, 1, 32, 2, 1, 2, 'At fugiat sequi asp', 'Beatae eaque obcaeca', NULL, NULL, 7, 0, '0.0000', '0.0000', '3.000', 10, '31.0000', '2021-04-07', NULL, 0, NULL, 'Selece One', 2, NULL, '2021-03-10 04:53:34', '2021-10-04 06:38:45'),
(10, 1, 32, 2, 1, 3, 'mamamia', 'ghhjgghjghjhjhgj', NULL, '10_img_2021_03_11_081216_66393540.jpg', 2, 0, '8.0000', '3.0000', '10.000', 0, '16.0000', '2021-03-31', NULL, 0, NULL, NULL, 2, NULL, '2021-03-11 02:12:15', '2021-03-14 03:33:10'),
(11, 1, 32, 2, 1, 1, 'fsdfdsw342', 'sdfsdfdsf', NULL, '11_img_2021_03_11_081459_24587893.webp', 5, 0, '0.0000', '0.0000', '10.000', 0, '50.0000', '2021-04-02', NULL, 0, NULL, NULL, 2, NULL, '2021-03-11 02:14:59', '2021-03-11 02:14:59'),
(12, 1, 32, 2, 1, 1, 'asdadsad', 'asdsadaasdsa', NULL, NULL, 2, 2, '0.0000', '0.0000', '10.000', 0, '20.0000', '2021-04-09', 'temp', 0, NULL, NULL, 2, NULL, '2021-03-11 05:13:03', '2021-04-07 05:42:28'),
(13, 1, 32, 2, 1, 1, 'okkkiikkk', 'Dolores quod laborum', NULL, NULL, 2, 1, '10.0000', '5.0000', NULL, 0, '20.0000', '2021-04-09', 'full_paid', 0, NULL, NULL, 2, NULL, '2021-03-11 07:35:21', '2021-03-28 00:47:37'),
(14, 1, 32, 2, 1, 1, 'sdfsdffs', 'sdfsdfsdf', NULL, NULL, 2, 0, '10.0000', '5.0000', NULL, 0, '20.0000', '2021-03-31', NULL, 0, NULL, NULL, 2, NULL, '2021-03-14 08:03:42', '2021-03-14 08:03:42'),
(15, 1, 32, 2, 1, 1, 'sadfsadasd', 'asdad', NULL, '15_img_2021_03_14_021618_52731399.jpg', 11, 0, '10.0000', '5.0000', NULL, 0, '110.0000', '2021-03-31', 'completed', 1, NULL, NULL, 2, 2, '2021-03-14 08:16:17', '2021-08-10 05:56:12'),
(16, 1, 32, 2, 1, 1, 'new job', 'asdasdsad', NULL, '16_img_2021_03_15_110030_43403743.jpg', 12, 1, '10.0000', '5.0000', '120.000', 0, '120.0000', '2021-03-31', 'completed', 6, NULL, NULL, 2, 2, '2021-03-15 05:00:29', '2021-08-10 05:51:52'),
(18, 1, 32, 2, 1, 1, 'ajker job', 'ajker job', NULL, '18_img_2021_03_15_110147_36910229.jpg', 3, 3, '10.0000', '5.0000', '30.000', 0, '30.0000', '2021-04-09', 'completed', 0, NULL, NULL, 2, NULL, '2021-03-15 05:01:47', '2021-04-07 05:42:28'),
(19, 1, 32, 2, 1, 1, 'Deleniti libero iste', 'In consequatur eveni', NULL, '19_img_2021_03_16_021500_41804018.jpg', 2, 2, '10.0000', '5.0000', '20.000', 0, '20.0000', '2021-04-01', 'completed', 0, NULL, NULL, 2, NULL, '2021-03-16 08:15:00', '2021-04-07 05:42:28'),
(20, 1, 32, 2, 1, 1, 'Labore itaque et qui', 'Reprehenderit illo', '', '20_img_2021_03_21_073852_72354998.jpg', 10, 3, '10.0000', '5.0000', '100.000', 0, '100.0000', '2021-04-09', 'completed', 6, NULL, NULL, 2, 2, '2021-03-21 01:38:52', '2021-08-10 05:40:15'),
(21, 1, 32, 2, 1, 1, 'Facilis minus deseru', 'Blanditiis a eiusmod', 'htttps://bridegroombd.com', '21_img_2021_03_21_074649_52624359.jpg', 2, 2, '10.0000', '5.0000', '20.000', 0, '20.0000', '2021-04-08', 'completed', 0, NULL, NULL, 2, NULL, '2021-03-21 01:46:49', '2021-04-07 05:42:28'),
(22, 1, 32, 2, 1, 1, 'Ut nulla qui quibusd', 'Est ipsum nobis ame', 'Praesentium error ac', '22_img_2021_03_21_121004_16403737.jpg', 1, 2, '10.0000', '5.0000', '10.000', 0, '10.0000', '2021-04-09', 'completed', 0, NULL, NULL, 2, NULL, '2021-03-21 06:10:04', '2021-04-07 05:42:28'),
(23, 1, 32, 2, 1, 1, 'what a job for you', 'asdasdasdadad', 'https://www.prothomalo.com/', '23_img_2021_03_22_113015_38837628.jpg', 1, 0, '10.0000', '5.0000', '10.000', 0, '10.0000', '2021-04-09', 'full_paid', 0, NULL, NULL, 2, NULL, '2021-03-22 05:30:14', '2021-03-28 01:19:18'),
(24, 1, 33, 2, 1, 1, 'test business', 'lorem ipsum', 'htttps://bridegroombd.com', '24_img_2021_03_24_040115_22729496.png', 4, 0, '10.0000', '5.0000', '40.000', 0, '40.0000', '2021-03-25', NULL, 0, NULL, NULL, 2, NULL, '2021-03-23 22:01:14', '2021-03-23 22:01:15'),
(25, 1, 33, 2, 1, 1, 'test', 'dsfsfds', 'htttps://bridegroombd.com', '25_img_2021_03_24_040440_75633561.png', 1, 0, '10.0000', '5.0000', '10.000', 0, '10.0000', '2021-04-09', NULL, 0, NULL, NULL, 2, NULL, '2021-03-23 22:04:40', '2021-03-23 22:04:40'),
(26, 1, 33, 2, 1, 1, 'el claso mundro', 'In lorem sit vero si', 'Iure Nam quam incidi', '26_img_2021_03_24_041028_14565885.jpg', 4, 0, '10.0000', '5.0000', '40.000', 0, '40.0000', '1990-06-27', NULL, 0, NULL, NULL, 2, NULL, '2021-03-23 22:10:28', '2021-03-23 22:10:28'),
(27, 1, 32, 2, 1, 1, 'test business', 'asdasd asdasd', NULL, '27_img_2021_03_24_053318_19189941.jpg', 1, 0, '10.0000', '5.0000', '10.000', 0, '10.0000', '2021-04-08', 'completed', 0, NULL, NULL, 2, NULL, '2021-03-23 23:33:18', '2021-08-11 04:57:39'),
(28, 1, 32, 2, 1, 1, 'rerereerer', 'asdadd', NULL, '28_img_2021_03_24_124822_95541060.png', 2, 0, '10.0000', '5.0000', '20.000', 0, '20.0000', '2021-04-08', NULL, 0, NULL, NULL, 2, NULL, '2021-03-24 06:48:22', '2021-03-24 06:48:22'),
(29, 1, 32, 2, 1, 1, 'test sdfsdads', 'dsdsfsd', NULL, '29_img_2021_03_24_125713_16393072.jpg', 10, 0, '10.0000', '5.0000', '100.000', 0, '100.0000', '2021-03-31', NULL, 0, NULL, NULL, 2, NULL, '2021-03-24 06:57:13', '2021-03-24 06:57:13'),
(30, 1, 32, 2, 1, 1, 'test business sddfs', 'sdfsdf sdfsdf', NULL, '30_img_2021_03_24_011708_95340800.jpg', 10, 0, '10.0000', '5.0000', '100.000', 0, '100.0000', '2021-04-09', NULL, 0, NULL, NULL, 2, NULL, '2021-03-24 07:17:08', '2021-03-24 07:17:08'),
(31, 1, 32, 2, 1, 1, 'competition', 'asdsadasdsadasd', NULL, '31_img_2021_03_25_051736_78452404.jpeg', 2, 1, '10.0000', '5.0000', '20.000', 0, '20.0000', '2021-03-30', 'full_paid', 0, NULL, NULL, 2, NULL, '2021-03-24 23:17:36', '2021-03-28 01:28:12'),
(32, 1, 32, 2, 1, 1, 'test business', 'khsdhkjhkds', NULL, '32_img_2021_03_25_073319_24157362.jpeg', 2, 0, '10.0000', '5.0000', '20.000', 0, '20.0000', '2021-03-31', 'full_paid', 0, NULL, NULL, 2, NULL, '2021-03-25 01:33:19', '2021-03-28 01:28:21'),
(33, 1, 32, 2, 1, 1, 'Entertainment', 'jjkkkllll', NULL, '33_img_2021_03_25_073558_81371954.png', 10, 0, '10.0000', '5.0000', '100.000', 0, '100.0000', '2021-03-31', NULL, 0, NULL, NULL, 2, NULL, '2021-03-25 01:35:58', '2021-03-25 01:35:58'),
(34, 1, 32, 2, 1, 10, 'urssbasi', 'kkalllarrs', NULL, '34_img_2021_03_25_093700_60760281.jpg', 3, 0, '4.0000', '2.0000', '12.000', 0, '12.0000', '2021-04-09', NULL, 0, NULL, NULL, 2, NULL, '2021-03-25 03:37:00', '2021-03-25 03:37:00'),
(35, 1, 32, 2, 1, 1, 'test business', 'afdsfsdf', NULL, '35_img_2021_03_28_043459_83359000.jpg', 2, 2, '10.0000', '5.0000', '20.000', 0, '20.0000', NULL, 'completed', 0, NULL, NULL, 2, NULL, '2021-03-27 22:34:58', '2021-04-07 05:42:28'),
(36, 1, 33, 2, 1, 11, 'aaaaaaaaaaaaaaaaaaaaaaaa', 'sssssssssssssssss', 'cccccccccccccccc', '36_img_2021_03_31_021905_81839487.exe', 5, 2, '10.0000', '10.0000', '50.000', 0, '50.0000', NULL, NULL, 0, NULL, NULL, 2, NULL, '2021-03-31 08:19:04', '2021-04-03 01:00:46'),
(37, 1, 32, 2, 1, 11, 'New Jobs', 'some descriptions', 'https://fb.coms', '37_img_2021_03_31_025429_31671301.jpg', 18, 0, '10.0000', '10.0000', '180.000', 0, '180.0000', NULL, NULL, 0, NULL, NULL, 2, NULL, '2021-03-31 08:54:29', '2021-03-31 11:06:56'),
(38, 1, 32, 2, 1, 2, 'Job title', 'description\r\nasdf\r\nasdf\r\nasdf', 'link', '38_img_2021_04_13_043056_33347906.png', 4, 3, '6.0000', '2.0000', '24.000', 0, '24.0000', NULL, NULL, 0, NULL, NULL, 2, 2, '2021-04-12 22:30:55', '2021-08-07 10:54:59'),
(39, 1, 32, 2, 1, 1, 'dddd', 'asdfasdf', 'https://jam.com.bd', '39_img_2021_04_18_085217_15089802.jpeg', 1, 0, '10.0000', '5.0000', '10.000', 0, '10.0000', NULL, 'cancel', 0, NULL, NULL, 2, NULL, '2021-04-18 14:52:16', '2021-08-10 04:57:39'),
(40, 1, 32, 2, 1, 1, 'aasdfasdf', 'basdfasdf', NULL, '40_img_2021_04_20_080258_68828840.gif', 1, 0, '10.0000', '5.0000', '10.000', 0, '10.0000', NULL, 'cancel', 0, NULL, NULL, 2, NULL, '2021-04-20 02:02:58', '2021-08-10 04:58:17'),
(41, 1, 32, 2, 1, 1, 'Facebook >> Picture Like', NULL, NULL, '41_img_2021_04_30_060044_89996833.png', 2, 0, '10.0000', '5.0000', '20.000', 0, '20.0000', NULL, NULL, 0, NULL, NULL, 2, NULL, '2021-04-30 00:00:44', '2021-04-30 00:00:44'),
(42, 1, 32, 2, 1, 1, 'Facebook>>Picture Like>>5.0000 Taka', NULL, NULL, '42_img_2021_04_30_060309_95487649.png', 1, 0, '10.0000', '5.0000', '10.000', 0, '10.0000', NULL, NULL, 0, NULL, NULL, 2, NULL, '2021-04-30 00:03:09', '2021-04-30 00:03:09'),
(43, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'asdsadsdsa asdsa', NULL, '43_img_2021_08_14_104843_10280493.jpg', 1, 0, '10.0000', '5.0000', '10.000', 0, '10.0000', '2021-08-19', NULL, 0, NULL, NULL, 2, NULL, '2021-04-30 00:04:29', '2021-08-14 04:48:43'),
(44, 1, 32, 2, 4, 9, 'Tik Tok>Follow>0.5000 Taka', 'ssss', 'https://fb.com', '44_img_2021_06_29_065623_23640113.gif', 10, 1, '1.0000', '0.5000', '10.000', 0, '10.0000', NULL, NULL, 0, NULL, NULL, 2, NULL, '2021-06-29 00:56:22', '2021-06-29 01:53:31'),
(45, 1, 32, 2, 4, 9, 'Tik Tok>Follow>0.5000 Taka', 'asdf', NULL, '45_img_2021_06_29_082028_94229291.gif', 3, 1, '1.0000', '0.5000', '3.000', 0, '3.0000', NULL, NULL, 0, NULL, NULL, 2, NULL, '2021-06-29 02:20:28', '2021-08-07 06:53:21'),
(46, 1, 77, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'fasdfasdfsadfasdfdfsg', NULL, '46_img_2021_07_31_015831_91899446.jpg', 100, 1, '10.0000', '5.0000', '1000.000', 0, '1000.0000', NULL, NULL, 0, NULL, NULL, 2, NULL, '2021-07-31 07:58:31', '2021-08-11 05:38:36'),
(47, 1, 77, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'czXCsadasdf', NULL, '47_img_2021_07_31_020550_19629253.jpg', 2, 1, '10.0000', '5.0000', '20.000', 0, '20.0000', NULL, NULL, 0, NULL, NULL, 2, NULL, '2021-07-31 08:05:49', '2021-08-07 22:15:53'),
(48, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'sdfsdfsdfffsfdf', 'Deserunt ut ipsum u', '48_img_2021_08_08_041526_85452787.png', 2, 3, '10.0000', '5.0000', '20.000', 0, '20.0000', NULL, NULL, 0, NULL, NULL, 2, NULL, '2021-08-07 22:15:25', '2021-08-22 08:40:59'),
(49, 1, 32, 2, 1, 2, 'Facebook>page Like>2.0000 Taka', 'hello I am rtss', 'Veritatis voluptatum', '49_img_2021_08_08_043239_13351481.png', 4, 0, '6.0000', '2.0000', '24.000', 0, '24.0000', NULL, 'completed', 0, NULL, NULL, 2, NULL, '2021-08-07 22:32:39', '2021-08-11 05:37:29'),
(50, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test test test test 3.37', NULL, '50_img_2021_08_09_093739_35201207.jpg', 10, 6, '10.0000', '5.0000', '100.000', 0, '100.0000', NULL, 'completed', 7, NULL, NULL, 2, 2, '2021-08-09 03:37:38', '2021-08-10 05:57:04'),
(51, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'done done done 75', NULL, '51_img_2021_08_09_123408_80678010.jpg', 10, 1, '10.0000', '5.0000', '100.000', 0, '100.0000', NULL, 'completed', 8, NULL, NULL, 2, 2, '2021-08-09 06:34:08', '2021-08-10 06:12:32'),
(52, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'asadsad asdsadsa sadsa  321', NULL, '52_img_2021_08_11_111235_54861322.png', 10, 6, '10.0000', '5.0000', '100.000', 0, '100.0000', NULL, NULL, 0, NULL, NULL, 2, NULL, '2021-08-11 05:12:34', '2021-08-11 06:15:37'),
(53, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'sdfsdfdsf', NULL, '53_img_2021_08_11_021352_54504697.jpg', 4, 0, '10.0000', '5.0000', '40.000', 0, '40.0000', '2021-09-25', NULL, 0, NULL, NULL, 2, NULL, '2021-08-11 08:13:52', '2021-08-11 08:18:58'),
(54, 1, 77, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'safsffd sdfs sdf', 'Deserunt ut ipsum u', '54_img_2021_08_11_022220_20586715.jpg', 2, 1, '10.0000', '5.0000', '20.000', 0, '20.0000', '2021-08-31', NULL, 0, NULL, NULL, 2, NULL, '2021-08-11 08:22:20', '2021-08-11 08:30:41'),
(55, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'atiqur rahman Jams\r\nhed fff', NULL, '55_img_2021_08_14_103657_44163700.jpg', 5, 1, '10.0000', '5.0000', '50.000', 0, '50.0000', '2012-03-31', NULL, 1, 'completed', NULL, 2, 2, '2021-08-12 10:52:26', '2021-08-15 22:54:11'),
(56, 1, 42, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'sadfsdfsdf sdfsdfsdf sdfsdfsdf sdfsdf', NULL, '56_img_2021_08_14_105136_81430857.jpg', 1, 0, '10.0000', '5.0000', '10.000', 0, '10.0000', '2021-08-17', NULL, 0, NULL, NULL, 2, NULL, '2021-08-14 04:51:36', '2021-08-14 04:52:00'),
(57, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test 1996', NULL, '57_img_2021_08_16_045503_11259467.jpg', 2, 2, '10.0000', '5.0000', '20.000', 0, '20.0000', '2021-08-25', NULL, 0, NULL, NULL, 2, NULL, '2021-08-15 22:55:02', '2021-08-16 04:43:12'),
(58, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test 2201', NULL, '58_img_2021_08_16_050429_51967728.jpg', 3, 0, '10.0000', '5.0000', '30.000', 0, '30.0000', '2021-09-03', NULL, 0, NULL, NULL, 2, NULL, '2021-08-15 23:04:29', '2021-08-15 23:30:46'),
(59, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test final approve', NULL, '59_img_2021_08_16_053504_77000501.jpg', 5, 5, '10.0000', '5.0000', '50.000', 0, '50.0000', '2021-08-25', NULL, 0, NULL, NULL, 2, NULL, '2021-08-15 23:35:04', '2021-08-16 23:27:06'),
(60, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'youtube toy', NULL, '60_img_2021_08_16_104910_10184604.jpg', 2, 2, '10.0000', '5.0000', '20.000', 0, '20.0000', '2021-08-26', NULL, 0, NULL, NULL, 2, NULL, '2021-08-16 04:49:10', '2021-08-16 04:51:30'),
(61, 1, 91, 78, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'sadf', NULL, '61_img_2021_08_20_121220_19513066.png', 2, 1, '10.0000', '5.0000', '20.000', 0, '20.0000', '2021-08-21', NULL, 0, NULL, NULL, 78, NULL, '2021-08-20 06:12:20', '2021-11-30 06:23:08'),
(62, 1, 32, 2, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'sadfasdf ffrrr', 'sdfsadf', '62_img_2021_08_28_125515_20067669.png', 20, 0, '10.0000', '5.0000', '200.000', 0, '200.0000', '2021-08-29', NULL, 0, NULL, NULL, 2, NULL, '2021-08-27 18:55:15', '2021-10-06 00:19:20'),
(63, 1, 32, 2, 1, 3, 'Facebook>Join Group>3.0000 Taka', 'dsfasdf', 'sadfasdf', '63_img_2021_08_28_125628_85803268.jpg', 5, 1, '8.0000', '3.0000', '40.000', 0, '40.0000', NULL, NULL, 0, NULL, NULL, 2, NULL, '2021-08-27 18:56:28', '2021-08-27 18:57:23'),
(64, 1, 32, 2, 1, 2, 'Facebook>page Like>2.0000 Taka', 'Consequatur digniss', 'In aliqua Nihil dic', '64_img_2021_12_01_095802_25414139.jpg', 2, 0, '6.0000', '2.0000', '12.000', 0, '12.0000', '2021-12-31', NULL, 0, NULL, NULL, 2, NULL, '2021-12-01 03:58:02', '2021-12-01 03:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `freelance_job_works`
--

CREATE TABLE `freelance_job_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_station_id` int(11) DEFAULT NULL,
  `subscriber_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `freelancer_job_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `subcategory_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `require_details` text COLLATE utf8mb4_unicode_ci,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img2` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `job_owner_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_note` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ratting` int(10) DEFAULT NULL,
  `editedby_id` bigint(20) DEFAULT NULL,
  `distributed_at` timestamp NULL DEFAULT NULL,
  `pending_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `freelance_job_works`
--

INSERT INTO `freelance_job_works` (`id`, `work_station_id`, `subscriber_id`, `user_id`, `freelancer_job_id`, `category_id`, `subcategory_id`, `title`, `description`, `require_details`, `img`, `img2`, `status`, `job_owner_note`, `admin_note`, `ratting`, `editedby_id`, `distributed_at`, `pending_at`, `approved_at`, `rejected_at`, `created_at`, `updated_at`) VALUES
(1, 1, 32, 2, 13, 1, 1, 'Ipsum in aut minima', 'Dolores quod laborum', 'asddasdasd', '_img_2021_03_13_092602_36752037.jpg', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-13 03:26:02', '2021-03-21 05:38:55', NULL, '2021-03-13 03:26:02', '2021-03-15 07:24:06'),
(5, 1, 43, 2, 18, 1, 1, 'ajker job', 'ajker job', 'done ok', '5_img_2021_03_15_012622_94908515.jpg', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-15 07:26:22', '2021-03-15 07:27:01', NULL, '2021-03-15 07:26:22', '2021-03-15 07:27:01'),
(6, 1, 53, 2, 18, 1, 1, 'ajker job', 'ajker job', 'done ok', '6_img_2021_03_15_013209_95563992.jpg', NULL, 'approved', 'asdsad asdsad', NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-15 07:32:09', '2021-03-15 07:44:44', NULL, '2021-03-15 07:32:09', '2021-03-15 07:44:44'),
(7, 1, 42, 2, 18, 1, 1, 'ajker job', 'ajker job', 'gdgdfgfdg', '7_img_2021_03_16_054017_63753167.jpg', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-15 23:40:17', '2021-03-21 01:54:09', NULL, '2021-03-15 23:40:17', '2021-03-21 01:54:09'),
(10, 1, 33, 2, 19, 1, 1, 'Deleniti libero iste', 'In consequatur eveni', 'test test test', '10_img_2021_03_21_063849_21362520.jpg', '10_img_2021_03_21_063849_29556615.webp', 'approved', 'sssddffff', NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-21 00:38:49', '2021-03-21 00:39:41', NULL, '2021-03-21 00:38:49', '2021-03-21 00:39:41'),
(11, 1, 43, 2, 19, 1, 1, 'Deleniti libero iste', 'In consequatur eveni', 'ok ok ok ok', '11_img_2021_03_21_070047_57065581.jpg', '11_img_2021_03_21_070047_36573382.jpg', 'approved', 'ghghj', NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-21 01:00:47', '2021-03-21 01:01:16', NULL, '2021-03-21 01:00:47', '2021-03-21 01:01:16'),
(12, 1, 62, 2, 21, 1, 1, 'Facilis minus deseru', 'Blanditiis a eiusmod', 'ytyt tyty', '12_img_2021_03_21_093513_95853979.jpg', '12_img_2021_03_21_093513_99974273.jpg', 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-21 03:35:13', '2021-03-21 05:43:18', NULL, '2021-03-21 03:35:13', '2021-03-21 05:43:18'),
(13, 1, 61, 2, 21, 1, 1, 'Facilis minus deseru', 'Blanditiis a eiusmod', 'Sed maxime quaerat r', '13_img_2021_03_21_093609_23224060.jpg', '13_img_2021_03_21_093610_12586617.jpg', 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-21 03:36:09', '2021-03-21 05:47:47', NULL, '2021-03-21 03:36:09', '2021-03-21 05:47:47'),
(14, 1, 33, 2, 22, 1, 1, 'Ut nulla qui quibusd', 'Est ipsum nobis ame', 'dfgdfgdg', '14_img_2021_03_21_121052_10883384.jpg', '14_img_2021_03_21_121052_93512627.jpg', 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-21 06:10:52', '2021-03-21 06:56:00', NULL, '2021-03-21 06:10:52', '2021-03-21 06:56:00'),
(15, 1, 42, 2, 22, 1, 1, 'Ut nulla qui quibusd', 'Est ipsum nobis ame', 'youdgdfg', '15_img_2021_03_21_121132_32909217.jpg', '15_img_2021_03_21_121132_62063732.jpg', 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-21 06:11:32', '2021-03-21 06:56:00', NULL, '2021-03-21 06:11:32', '2021-03-21 06:56:00'),
(18, 1, 33, 2, 16, 1, 1, 'new job', 'asdasdsad', NULL, '18_img_2021_03_22_044314_71621157.jpg', '18_img_2021_03_22_044315_82528711.jpg', 'approved', NULL, NULL, NULL, NULL, '2021-07-06 18:30:33', '2021-03-21 22:43:14', '2021-07-06 18:30:33', NULL, '2021-03-21 22:43:14', '2021-07-06 18:30:33'),
(21, 1, 62, 2, 20, 1, 1, 'Labore itaque et qui', 'Reprehenderit illo', NULL, '21_img_2021_03_22_092108_89155779.jpg', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-04-07 02:19:09', '2021-03-22 03:21:08', '2021-04-07 01:13:44', NULL, '2021-03-22 03:21:08', '2021-04-07 02:19:09'),
(22, 1, 33, 2, 20, 1, 1, 'Labore itaque et qui', 'Reprehenderit illo', NULL, '22_img_2021_03_22_094030_43532331.jpg', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-04-07 02:19:09', '2021-03-22 03:40:30', '2021-04-07 01:13:44', NULL, '2021-03-22 03:40:30', '2021-04-07 02:19:09'),
(23, 1, 61, 2, 20, 1, 1, 'Labore itaque et qui', 'Reprehenderit illo', NULL, '23_img_2021_03_22_104309_80436806.jpg', '23_img_2021_03_22_104309_44085662.png', 'approved', NULL, NULL, NULL, NULL, '2021-04-07 05:02:01', '2021-03-22 04:43:09', '2021-04-07 01:13:44', NULL, '2021-03-22 04:43:09', '2021-04-07 05:02:01'),
(27, 1, 62, 2, 31, 1, 1, 'competition', 'asdsadasdsadasd', NULL, '27_img_2021_03_25_060550_21452784.png', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-25 00:05:50', '2021-03-25 00:11:56', NULL, '2021-03-25 00:05:50', '2021-03-25 00:11:56'),
(30, 1, 33, 2, 35, 1, 1, 'test business', 'afdsfsdf', NULL, '30_img_2021_03_28_053249_47124273.jpg', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-27 23:32:49', '2021-03-27 23:34:11', NULL, '2021-03-27 23:32:49', '2021-03-27 23:34:11'),
(31, 1, 42, 2, 35, 1, 1, 'test business', 'afdsfsdf', NULL, '31_img_2021_03_28_053319_42642343.jpg', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-27 23:33:19', '2021-03-27 23:34:11', NULL, '2021-03-27 23:33:19', '2021-03-27 23:34:11'),
(32, 1, 43, 2, 36, 1, 11, 'aaaaaaaaaaaaaaaaaaaaaaaa', 'sssssssssssssssss', NULL, '32_img_2021_03_31_021954_99865306.jpg', '32_img_2021_03_31_021954_94341573.jpeg', 'rejected', 'sdasdasd', NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-03-31 08:19:54', NULL, '2021-04-03 01:00:46', '2021-03-31 08:19:54', '2021-04-03 01:00:46'),
(33, 1, 62, 2, 36, 1, 11, 'aaaaaaaaaaaaaaaaaaaaaaaa', 'sssssssssssssssss', NULL, '33_img_2021_04_03_061607_21047772.png', '33_img_2021_04_03_061607_60245811.png', 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-04-03 00:16:06', '2021-04-03 01:13:43', NULL, '2021-04-03 00:16:06', '2021-04-03 01:13:43'),
(34, 1, 53, 2, 36, 1, 11, 'aaaaaaaaaaaaaaaaaaaaaaaa', 'sssssssssssssssss', NULL, '34_img_2021_04_03_064155_59980820.png', '34_img_2021_04_03_064155_42767328.png', 'approved', NULL, NULL, NULL, NULL, '2021-04-07 06:52:18', '2021-04-03 00:41:55', '2021-04-03 01:13:49', NULL, '2021-04-03 00:41:55', '2021-04-03 01:13:49'),
(35, 1, 33, 2, 38, 1, 2, 'Job title', 'description', NULL, '35_img_2021_04_13_043200_19169326.png', NULL, 'approved', 'something', NULL, NULL, NULL, '2021-04-13 03:24:40', '2021-04-12 22:32:00', '2021-04-13 03:24:40', '2021-04-12 22:59:37', '2021-04-12 22:32:00', '2021-04-13 03:24:40'),
(36, 1, 43, 2, 38, 1, 2, 'Job title', 'description', NULL, '36_img_2021_04_13_050056_37019856.png', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-04-19 13:38:50', '2021-04-12 23:00:56', '2021-04-19 13:38:50', NULL, '2021-04-12 23:00:56', '2021-04-19 13:38:50'),
(37, 1, 44, 2, 38, 1, 2, 'Job title', 'description', NULL, '37_img_2021_04_13_101504_25408999.png', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-07-06 18:30:34', '2021-04-13 04:15:04', '2021-07-06 18:30:34', NULL, '2021-04-09 23:00:56', '2021-07-06 18:30:34'),
(38, 1, 61, 2, 38, 1, 2, 'Job title', 'description', NULL, '38_img_2021_05_20_010800_58266891.webp', NULL, 'rejected', 'some note', 'very badd', NULL, 2, NULL, '2021-05-20 07:07:59', NULL, '2021-08-07 10:54:59', '2021-05-20 07:07:59', '2021-08-07 10:54:59'),
(39, 1, 61, 2, 44, 4, 9, 'Tik Tok>Follow>0.5000 Taka', 'ssss', NULL, '39_img_2021_06_29_075331_65318860.gif', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-07-06 18:30:34', '2021-06-29 01:53:31', '2021-07-06 18:30:34', NULL, '2021-06-29 01:53:31', '2021-07-06 18:30:34'),
(40, 1, 33, 2, 45, 4, 9, 'Tik Tok>Follow>0.5000 Taka', 'asdf', NULL, '40_img_2021_06_29_082133_56822689.gif', NULL, 'approved', NULL, NULL, NULL, NULL, '2021-07-06 18:30:34', '2021-06-29 02:21:32', '2021-07-06 18:30:34', NULL, '2021-06-29 02:21:32', '2021-07-06 18:30:34'),
(41, 1, 53, 2, 45, 4, 9, 'Tik Tok>Follow>0.5000 Taka', 'asdf', NULL, '41_img_2021_07_07_011849_92916082.jpg', NULL, 'rejected', 'okk', 'Enter Reasons For Cancel', NULL, 2, NULL, '2021-07-06 19:18:49', NULL, '2021-08-07 06:53:21', '2021-07-06 19:18:49', '2021-08-07 06:53:21'),
(42, 1, 33, 2, 47, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'czXCsadasdf', NULL, '42_img_2021_08_08_041553_10790437.png', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2021-08-07 22:15:53', NULL, NULL, '2021-08-07 22:15:53', '2021-08-07 22:15:53'),
(43, 1, 77, 2, 49, 1, 2, 'Facebook>page Like>2.0000 Taka', 'hello I am rtss', NULL, '43_img_2021_08_08_043710_79674597.png', NULL, 'rejected', 'none', 'none', NULL, 2, NULL, '2021-08-07 22:37:10', NULL, '2021-08-07 22:38:51', '2021-08-07 22:37:10', '2021-08-07 22:38:51'),
(44, 1, 62, 2, 49, 1, 2, 'Facebook>page Like>2.0000 Taka', 'hello I am rtss', NULL, '44_img_2021_08_08_044815_42409214.png', NULL, 'rejected', 'test', 'testt', NULL, 2, NULL, '2021-08-07 22:48:15', NULL, '2021-08-07 22:48:51', '2021-08-07 22:48:15', '2021-08-07 22:48:51'),
(45, 1, 61, 2, 48, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'sdfsdfsdfffsfdf', NULL, '45_img_2021_08_08_045100_10337283.png', NULL, 'rejected', 'test lost', 'lost', NULL, 2, NULL, '2021-08-07 22:51:00', NULL, '2021-08-07 22:51:34', '2021-08-07 22:51:00', '2021-08-07 22:51:34'),
(46, 1, 61, 2, 49, 1, 2, 'Facebook>page Like>2.0000 Taka', 'hello I am rtss', NULL, '46_img_2021_08_08_114431_64159019.png', NULL, 'rejected', 'bad things', 'bad things', NULL, 2, NULL, '2021-08-08 05:44:31', NULL, '2021-08-08 05:52:22', '2021-08-08 05:44:31', '2021-08-08 05:52:22'),
(47, 1, 62, 2, 48, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'sdfsdfsdfffsfdf', NULL, '47_img_2021_08_08_115631_50992720.png', NULL, 'approved', 'do again wrong', 'do again wrongss', 5, 2, '2021-08-22 08:40:59', '2021-08-08 05:56:31', '2021-08-22 08:40:59', '2021-08-08 05:58:48', '2021-08-08 05:56:31', '2021-08-22 08:40:59'),
(48, 1, 44, 2, 49, 1, 2, 'Facebook>page Like>2.0000 Taka', 'hello I am rtss', NULL, '48_img_2021_08_08_121303_59418481.png', NULL, 'rejected', 'doooo', 'doooo aganin', NULL, 2, NULL, '2021-08-08 06:13:03', NULL, '2021-08-09 03:19:16', '2021-08-08 06:13:03', '2021-08-09 03:19:16'),
(49, 1, 33, 2, 50, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test test test test 3.37', NULL, '49_img_2021_08_09_104757_16903036.jpg', NULL, 'approved', NULL, NULL, NULL, 2, '2021-08-09 04:53:34', '2021-08-09 04:47:56', '2021-08-09 04:53:34', NULL, '2021-08-09 04:47:56', '2021-08-09 04:53:34'),
(50, 1, 42, 2, 50, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test test test test 3.37', NULL, '50_img_2021_08_09_105415_39704404.jpg', NULL, 'approved', NULL, NULL, NULL, 2, '2021-08-09 04:55:13', '2021-08-09 04:54:15', '2021-08-09 04:55:13', NULL, '2021-08-09 04:54:15', '2021-08-09 04:55:13'),
(51, 1, 43, 2, 50, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test test test test 3.37', NULL, '51_img_2021_08_09_105753_89167290.jpg', NULL, 'approved', NULL, NULL, NULL, 2, '2021-08-09 05:02:58', '2021-08-09 04:57:52', '2021-08-09 05:02:58', NULL, '2021-08-09 04:57:52', '2021-08-09 05:02:58'),
(52, 1, 44, 2, 50, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test test test test 3.37', NULL, '52_img_2021_08_09_105840_67167161.jpg', NULL, 'approved', NULL, NULL, NULL, 2, '2021-08-09 05:03:00', '2021-08-09 04:58:40', '2021-08-09 05:03:00', NULL, '2021-08-09 04:58:40', '2021-08-09 05:03:00'),
(53, 1, 53, 2, 50, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test test test test 3.37', NULL, '53_img_2021_08_09_105956_23009425.jpg', NULL, 'approved', NULL, NULL, NULL, 2, '2021-08-09 05:03:03', '2021-08-09 04:59:55', '2021-08-09 05:03:03', NULL, '2021-08-09 04:59:55', '2021-08-09 05:03:03'),
(54, 1, 77, 2, 50, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test test test test 3.37', NULL, '54_img_2021_08_09_120652_41586582.jpg', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2021-08-09 06:06:52', NULL, NULL, '2021-08-09 06:06:52', '2021-08-09 06:06:52'),
(55, 1, 42, 2, 51, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'done done done 75', NULL, '55_img_2021_08_09_124355_83385688.jpg', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2021-08-09 06:43:55', NULL, NULL, '2021-08-09 06:43:55', '2021-08-09 06:43:55'),
(56, 1, 33, 2, 43, 1, 1, 'Facebook>Picture Like>5.0000 Taka', NULL, NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 04:43:49', '2021-08-11 04:43:49'),
(57, 1, 33, 2, 42, 1, 1, 'Facebook>>Picture Like>>5.0000 Taka', NULL, NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 04:55:34', '2021-08-11 04:55:34'),
(58, 1, 33, 2, 27, 1, 1, 'test business', 'asdasd asdasd', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 04:57:36', '2021-08-11 04:57:36'),
(59, 1, 69, 2, 49, 1, 2, 'Facebook>page Like>2.0000 Taka', 'hello I am rtss', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 05:03:00', '2021-08-11 05:03:00'),
(60, 1, 69, 2, 49, 1, 2, 'Facebook>page Like>2.0000 Taka', 'hello I am rtss', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 05:05:09', '2021-08-11 05:05:09'),
(61, 1, 33, 2, 48, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'sdfsdfsdfffsfdf', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 05:14:25', '2021-08-11 05:14:25'),
(62, 1, 33, 2, 52, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'asadsad asdsadsa sadsa  321', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 05:16:41', '2021-08-11 05:16:41'),
(63, 1, 33, 2, 49, 1, 2, 'Facebook>page Like>2.0000 Taka', 'hello I am rtss', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 05:17:37', '2021-08-11 05:17:37'),
(64, 1, 69, 2, 49, 1, 2, 'Facebook>page Like>2.0000 Taka', 'hello I am rtss', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 05:37:26', '2021-08-11 05:37:26'),
(65, 1, 33, 2, 46, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'fasdfasdfsadfasdfdfsg', NULL, '65_img_2021_08_11_113836_39406782.jpg', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2021-08-11 05:38:36', NULL, NULL, '2021-08-11 05:38:05', '2021-08-11 05:38:36'),
(66, 1, 42, 2, 52, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'asadsad asdsadsa sadsa  321', NULL, '66_img_2021_08_11_114234_39633490.jpg', NULL, 'approved', NULL, NULL, NULL, 2, '2021-08-11 07:27:34', '2021-08-11 05:42:34', '2021-08-11 07:27:34', NULL, '2021-08-11 05:42:26', '2021-08-11 07:27:34'),
(67, 1, 44, 2, 52, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'asadsad asdsadsa sadsa  321', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 05:47:10', '2021-08-11 05:47:10'),
(68, 1, 53, 2, 52, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'asadsad asdsadsa sadsa  321', NULL, '68_img_2021_08_11_114822_97174929.jpg', NULL, 'approved', NULL, NULL, NULL, 2, '2021-08-11 06:42:32', '2021-08-11 05:48:22', '2021-08-11 06:42:32', NULL, '2021-08-11 05:48:15', '2021-08-11 06:42:32'),
(69, 1, 77, 2, 52, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'asadsad asdsadsa sadsa  321', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 05:52:59', '2021-08-11 05:52:59'),
(70, 1, 62, 2, 52, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'asadsad asdsadsa sadsa  321', NULL, '70_img_2021_08_11_121537_31201709.jpg', NULL, 'approved', NULL, NULL, NULL, 2, '2021-08-15 22:38:11', '2021-08-11 06:15:37', '2021-08-15 22:38:11', NULL, '2021-08-11 06:12:06', '2021-08-15 22:38:11'),
(71, 1, 42, 2, 48, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'sdfsdfsdfffsfdf', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 07:58:28', '2021-08-11 07:58:28'),
(72, 1, 32, 2, 54, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'safsffd sdfs sdf', NULL, '72_img_2021_08_11_023041_68486686.jpg', NULL, 'approved', NULL, NULL, NULL, 2, '2021-08-11 08:30:51', '2021-08-11 08:30:41', '2021-08-11 08:30:51', NULL, '2021-08-11 08:27:36', '2021-08-11 08:30:51'),
(73, 1, 33, 2, 55, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'atiqur rahman ssssss', NULL, '73_img_2021_08_12_045343_18931419.jpg', NULL, 'approved', NULL, NULL, NULL, 2, '2021-08-15 22:34:54', '2021-08-12 10:53:43', '2021-08-15 22:34:54', NULL, '2021-08-12 10:53:13', '2021-08-15 22:34:54'),
(74, 1, 33, 2, 56, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'sadfsdfsdf sdfsdfsdf sdfsdfsdf sdfsdf', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-15 22:52:46', '2021-08-15 22:52:46'),
(75, 1, 33, 2, 57, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test 1996', NULL, '75_img_2021_08_16_045535_71191567.jpg', NULL, 'rejected', 'ok', 'ok', 5, 2, NULL, '2021-08-15 22:55:34', NULL, '2021-08-15 23:34:13', '2021-08-15 22:55:29', '2021-08-15 23:34:13'),
(76, 1, 42, 2, 57, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test 1996', NULL, NULL, NULL, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-15 23:02:37', '2021-08-15 23:02:37'),
(77, 1, 33, 2, 58, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test 2201', NULL, '77_img_2021_08_16_050510_32526624.jpg', NULL, 'rejected', 'badd', 'badd', NULL, 2, NULL, '2021-08-15 23:05:10', NULL, '2021-08-15 23:26:11', '2021-08-15 23:05:04', '2021-08-15 23:26:11'),
(78, 1, 44, 2, 58, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test 2201', NULL, '78_img_2021_08_16_052737_98494425.jpg', NULL, 'rejected', 'ok', 'ok', NULL, 2, NULL, '2021-08-15 23:27:37', NULL, '2021-08-15 23:30:46', '2021-08-15 23:27:33', '2021-08-15 23:30:46'),
(79, 1, 33, 2, 59, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test final approve', NULL, '79_img_2021_08_16_053530_65043162.jpg', NULL, 'approved', NULL, NULL, 4, 2, '2021-08-15 23:43:16', '2021-08-15 23:35:30', '2021-08-15 23:43:16', NULL, '2021-08-15 23:35:24', '2021-08-15 23:43:16'),
(80, 1, 42, 2, 59, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test final approve', NULL, '80_img_2021_08_16_054407_54608227.jpg', NULL, 'approved', NULL, NULL, 3, 2, '2021-08-15 23:52:56', '2021-08-15 23:44:07', '2021-08-15 23:52:56', NULL, '2021-08-15 23:44:02', '2021-08-15 23:52:56'),
(81, 1, 69, 2, 59, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test final approve', NULL, '81_img_2021_08_17_043233_60173318.png', NULL, 'approved', 'test work approved', NULL, NULL, 2, NULL, '2021-08-16 22:32:33', '2021-08-16 23:24:05', NULL, '2021-08-16 04:31:29', '2021-08-16 23:24:05'),
(82, 1, 69, 2, 57, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test 1996', NULL, '82_img_2021_08_16_104312_98324657.jpg', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2021-08-16 04:43:12', NULL, NULL, '2021-08-16 04:43:06', '2021-08-16 04:43:13'),
(83, 1, 33, 2, 60, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'youtube toy', NULL, '83_img_2021_08_16_105047_33639032.jpg', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2021-08-16 04:50:47', NULL, NULL, '2021-08-16 04:50:37', '2021-08-16 04:50:47'),
(84, 1, 42, 2, 60, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'youtube toy', NULL, '84_img_2021_08_16_105130_40263260.jpg', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2021-08-16 04:51:30', NULL, NULL, '2021-08-16 04:51:14', '2021-08-16 04:51:30'),
(85, 1, 87, 2, 59, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test final approve', NULL, '85_img_2021_08_17_051201_13253337.png', NULL, 'approved', 'test work approved', NULL, NULL, 2, NULL, '2021-08-16 23:12:01', '2021-08-16 23:24:05', NULL, '2021-08-16 23:11:56', '2021-08-16 23:24:05'),
(86, 1, 68, 2, 59, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'test final approve', NULL, '86_img_2021_08_17_052706_65021406.png', NULL, 'approved', 'done', NULL, NULL, 2, NULL, '2021-08-16 23:27:06', '2021-08-16 23:27:23', NULL, '2021-08-16 23:27:01', '2021-08-16 23:27:23'),
(87, 1, 68, 2, 63, 1, 3, 'Facebook>Join Group>3.0000 Taka', 'dsfasdf', NULL, '87_img_2021_08_28_125723_70162756.jpg', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2021-08-27 18:57:23', NULL, NULL, '2021-08-27 18:57:16', '2021-08-27 18:57:23'),
(88, 1, 32, 2, 61, 1, 1, 'Facebook>Picture Like>5.0000 Taka', 'sadf', NULL, '88_img_2021_11_30_122308_47097881.sql', NULL, 'pending', NULL, NULL, NULL, NULL, NULL, '2021-11-30 06:23:08', NULL, NULL, '2021-11-30 06:22:53', '2021-11-30 06:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `honoraria`
--

CREATE TABLE `honoraria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `workstation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `system_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `earning_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission` int(11) NOT NULL DEFAULT '0',
  `workorder_upto_amount` decimal(10,4) DEFAULT '0.0000',
  `payment_duration` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_id` bigint(20) UNSIGNED NOT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `honoraria`
--

INSERT INTO `honoraria` (`id`, `title`, `description`, `workstation_id`, `system_type`, `earning_type`, `commission`, `workorder_upto_amount`, `payment_duration`, `active`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Joining Signup', 'lorem ipsum', 1, 'Joining', 'Signup', 10, '0.0000', 0, 1, 2, 2, '2021-03-08 06:31:55', '2021-03-09 23:37:47'),
(3, 'test business', 'asdasdd', 1, 'Joining', 'Refferal', 11, '0.0000', 0, 1, 2, 2, '2021-03-09 22:36:20', '2021-08-21 01:43:24'),
(4, 'asdfasdf', 'asdsdad', 1, 'Joining', 'Pair', 45, '0.0000', 0, 0, 2, NULL, '2021-03-09 22:37:01', '2021-03-09 22:37:01'),
(5, 'test business', 'ewrwr', 1, 'Joining', 'Signup', 2, '0.0000', 0, 1, 2, 2, '2021-03-09 22:37:28', '2021-03-23 23:21:27'),
(6, 'test business', 'fsdfsfd', 1, 'Joining', 'Signup', 10, '0.0000', 10, 1, 2, 2, '2021-03-09 22:37:57', '2021-03-16 05:43:38'),
(9, 'Dolor suscipit qui m', 'Eum necessitatibus a', 1, 'Working', 'Affiliate', 3, '100.0000', 0, 1, 2, 2, '2021-03-11 01:18:23', '2021-03-24 07:15:04'),
(10, 'Atque tempore nulla', 'A provident amet v', 1, 'Working', 'Affiliate', 1, '100.0000', 0, 1, 2, 2, '2021-03-11 01:19:00', '2021-03-24 07:14:48'),
(11, 'asdsad', 'sdfsdfsd', 1, 'Working', 'Affiliate', 1, '100.0000', 0, 1, 2, 2, '2021-03-11 01:19:39', '2021-03-24 07:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `job_categories`
--

CREATE TABLE `job_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_categories`
--

INSERT INTO `job_categories` (`id`, `title`, `description`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Facebook', 'Facebook', NULL, 2, '2021-03-04 04:34:15', '2021-03-04 04:34:15'),
(2, 'Gamil Account', 'gmail', NULL, 2, '2021-03-04 04:35:20', '2021-03-04 04:35:20'),
(3, 'Instagram', NULL, NULL, 2, '2021-03-04 04:36:02', '2021-03-04 04:36:02'),
(4, 'Tik Tok', NULL, NULL, 2, '2021-03-04 04:36:35', '2021-03-04 04:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `job_subcategories`
--

CREATE TABLE `job_subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_category_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_post_price` decimal(10,4) DEFAULT '0.0000',
  `job_work_price` decimal(10,4) DEFAULT '0.0000',
  `screenshot` int(10) NOT NULL DEFAULT '1',
  `admin_approve` tinyint(1) NOT NULL DEFAULT '0',
  `work_link` tinyint(1) NOT NULL DEFAULT '0',
  `instraction` text COLLATE utf8mb4_unicode_ci,
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_subcategories`
--

INSERT INTO `job_subcategories` (`id`, `job_category_id`, `title`, `description`, `job_post_price`, `job_work_price`, `screenshot`, `admin_approve`, `work_link`, `instraction`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(2, 1, 'page Like', 'like', '6.0000', '2.0000', 1, 0, 0, 'test', 2, 2, '2021-03-04 04:34:45', '2021-03-21 07:34:27'),
(3, 1, 'Join Group', 'like', '8.0000', '3.0000', 1, 0, 0, 'Join Group test', 2, 2, '2021-03-04 04:34:58', '2021-03-21 07:34:50'),
(4, 2, 'new gmail', NULL, NULL, NULL, 1, 0, 0, NULL, 2, NULL, '2021-03-04 04:35:36', '2021-03-04 04:35:36'),
(5, 2, 'old gmail', NULL, NULL, NULL, 1, 0, 0, NULL, 2, NULL, '2021-03-04 04:35:42', '2021-03-04 04:35:42'),
(6, 3, 'Like', NULL, NULL, NULL, 1, 0, 0, NULL, 2, NULL, '2021-03-04 04:36:09', '2021-03-04 04:36:09'),
(7, 3, 'Follow', NULL, NULL, NULL, 1, 0, 0, NULL, 2, NULL, '2021-03-04 04:36:13', '2021-03-04 04:36:13'),
(8, 3, 'Comment', NULL, NULL, NULL, 1, 0, 0, NULL, 2, NULL, '2021-03-04 04:36:21', '2021-03-04 04:36:21'),
(9, 4, 'Follow', NULL, '1.0000', '0.5000', 1, 0, 1, NULL, 2, 2, '2021-03-04 04:36:45', '2021-06-29 00:52:12'),
(10, 1, 'hjhjkh', 'hkjkj', '4.0000', '2.0000', 1, 1, 1, '<iframe width=\"100%\" height=\"100\" src=\"https://www.youtube.com/embed/JH2nXMv6yZI\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\"></iframe>\r\n\r\n<p class=\"mt-3\">Test test test description test test test.Test test test description test test test </p>', 2, 2, '2021-03-22 04:56:04', '2021-06-29 00:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `job_work_links`
--

CREATE TABLE `job_work_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscriber_id` bigint(20) UNSIGNED DEFAULT NULL,
  `work_id` bigint(20) UNSIGNED DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_work_links`
--

INSERT INTO `job_work_links` (`id`, `subscriber_id`, `work_id`, `link`, `created_at`, `updated_at`) VALUES
(1, 61, 39, 'fb.com', '2021-06-29 01:53:31', '2021-06-29 01:53:31'),
(2, 33, 40, 'fb.com', '2021-06-29 02:21:32', '2021-06-29 02:21:32'),
(3, 53, 41, 'fasdfasdf', '2021-07-06 19:18:49', '2021-07-06 19:18:49'),
(4, 32, 88, NULL, '2021-11-30 06:23:08', '2021-11-30 06:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `likeable_id` bigint(20) UNSIGNED NOT NULL,
  `likeable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `choice` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `likeable_id`, `likeable_type`, `user_id`, `choice`, `created_at`, `updated_at`) VALUES
(96, 10, 'App\\Models\\Post', 2, 0, '2021-04-27 14:40:14', '2021-04-27 14:40:14'),
(97, 7, 'App\\Models\\Post', 2, 0, '2021-04-27 14:41:03', '2021-04-27 14:41:03'),
(100, 1, 'App\\Models\\Comment', 2, 0, '2021-04-29 22:24:09', '2021-04-29 22:24:09'),
(101, 3, 'App\\Models\\Comment', 2, 0, '2021-04-29 22:25:51', '2021-04-29 22:25:51'),
(102, 2, 'App\\Models\\Comment', 2, 0, '2021-04-29 22:27:09', '2021-04-29 22:27:09'),
(104, 7, 'App\\Models\\Comment', 2, 0, '2021-04-29 22:29:13', '2021-04-29 22:29:13'),
(109, 4, 'App\\Models\\Comment', 2, 0, '2021-04-29 22:37:18', '2021-04-29 22:37:18'),
(111, 11, 'App\\Models\\Comment', 2, 0, '2021-04-29 22:40:18', '2021-04-29 22:40:18'),
(112, 10, 'App\\Models\\Comment', 2, 0, '2021-04-29 22:40:23', '2021-04-29 22:40:23'),
(114, 6, 'App\\Models\\Post', 2, 0, '2021-04-29 22:55:54', '2021-04-29 22:55:54'),
(116, 6, 'App\\Models\\Comment', 2, 0, '2021-04-29 22:57:57', '2021-04-29 22:57:57'),
(119, 13, 'App\\Models\\Comment', 2, 0, '2021-04-29 23:08:03', '2021-04-29 23:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_id` bigint(20) DEFAULT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_mime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` int(10) UNSIGNED DEFAULT NULL,
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_id`, `model_type`, `file_name`, `file_original_name`, `file_mime`, `file_ext`, `file_size`, `file_type`, `width`, `height`, `file_url`, `addedby_id`, `editedby_id`, `collection_name`, `created_at`, `updated_at`) VALUES
(7, 5, 'App\\Models\\ProductBrand', '5_img_2021_02_14_111413_48495758.jpg', 'curren-8321-quartz-01-watch-aponzone-600x540.jpg', 'jpg', 'jpg', '76323', 'image', '600', '540', 'storage/media/brand/image/5_img_2021_02_14_111413_48495758.jpg', 2, NULL, 'brand_image', '2021-02-14 05:14:13', '2021-02-14 05:14:13'),
(8, 1, 'App\\Models\\Product', '1_lfi_2021_02_14_111918_20036074.jpg', '120763-ezurgunlgb-1559313125.jpg', 'image/jpeg', 'jpg', '339966', 'image', '640', '640', 'storage/product/fi/1_lfi_2021_02_14_111918_20036074.jpg', 2, NULL, 'product_feature_image', '2021-02-14 05:19:18', '2021-02-14 05:19:18'),
(9, 1, 'App\\Models\\Product', '1_lei_2021_02_14_112915_31915670.jpg', '120763-ezurgunlgb-1559313125.jpg', 'image/jpeg', 'jpg', '196579', 'image', '640', '640', 'storage/product/ei/1_lei_2021_02_14_112915_31915670.jpg', 2, NULL, 'product_extra_image', '2021-02-14 05:29:15', '2021-02-14 05:29:15'),
(13, 1, 'App\\Models\\Product', '1_lei_2021_02_14_013101_10448059.jpg', 'xiaomi-mi-10-review.jpg', 'image/jpeg', 'jpg', '696510', 'image', '1200', '883', 'storage/product/ei/1_lei_2021_02_14_013101_10448059.jpg', 2, NULL, 'product_extra_image', '2021-02-14 07:31:01', '2021-02-14 07:31:01'),
(14, 9, 'App\\Models\\Product', '9_lfi_2021_02_22_065641_16103924.jpg', '120763-ezurgunlgb-1559313125.jpg', 'image/jpeg', 'jpg', '339966', 'image', '640', '640', 'storage/product/fi/9_lfi_2021_02_22_065641_16103924.jpg', 2, NULL, 'product_feature_image', '2021-02-22 00:56:42', '2021-02-22 00:56:42'),
(15, 3, 'App\\Models\\FreelancerJob', '3_img_2021_03_03_112827_45254076.png', 'image.png', 'png', 'png', '1722', 'image', '200', '200', 'storage/media/job/3_img_2021_03_03_112827_45254076.png', 2, NULL, 'job_image', '2021-03-03 05:28:27', '2021-03-03 05:28:27'),
(16, 1, 'App\\Models\\FreelancerJob', '1_img_2021_03_04_104715_74554348.jpg', '1.jpg', 'jpg', 'jpg', '101869', 'image', '1400', '875', 'storage/media/job/1_img_2021_03_04_104715_74554348.jpg', 2, NULL, 'job_image', '2021-03-04 04:47:15', '2021-03-04 04:47:15'),
(17, 5, 'App\\Models\\FreelancerJob', '5_img_2021_03_06_010120_45575559.jpg', 'banner2.jpg', 'jpg', 'jpg', '434811', 'image', '1200', '472', 'storage/media/job/5_img_2021_03_06_010120_45575559.jpg', 2, NULL, 'job_image', '2021-03-06 07:01:20', '2021-03-06 07:01:20'),
(18, 6, 'App\\Models\\FreelancerJob', '6_img_2021_03_10_102353_86254830.png', 'pfi.png', 'png', 'png', '13560', 'image', '160', '160', 'storage/media/job/6_img_2021_03_10_102353_86254830.png', 2, NULL, 'job_image', '2021-03-10 04:23:53', '2021-03-10 04:23:53'),
(19, 7, 'App\\Models\\FreelancerJob', '7_img_2021_03_10_102425_92462474.png', 'pfi.png', 'png', 'png', '13560', 'image', '160', '160', 'storage/media/job/7_img_2021_03_10_102425_92462474.png', 2, NULL, 'job_image', '2021-03-10 04:24:25', '2021-03-10 04:24:25'),
(20, 8, 'App\\Models\\FreelancerJob', '8_img_2021_03_10_102454_71836212.png', 'pfi.png', 'png', 'png', '13560', 'image', '160', '160', 'storage/media/job/8_img_2021_03_10_102454_71836212.png', 2, NULL, 'job_image', '2021-03-10 04:24:54', '2021-03-10 04:24:54'),
(21, 10, 'App\\Models\\FreelancerJob', '10_img_2021_03_11_081216_66393540.jpg', '120763-ezurgunlgb-1559313125.jpg', 'jpg', 'jpg', '196579', 'image', '640', '640', 'storage/media/job/10_img_2021_03_11_081216_66393540.jpg', 2, NULL, 'job_image', '2021-03-11 02:12:16', '2021-03-11 02:12:16'),
(22, 11, 'App\\Models\\FreelancerJob', '11_img_2021_03_11_081459_24587893.webp', 'image.webp', 'webp', 'webp', '53214', 'image', '2000', '1050', 'storage/media/job/11_img_2021_03_11_081459_24587893.webp', 2, NULL, 'job_image', '2021-03-11 02:14:59', '2021-03-11 02:14:59'),
(23, 15, 'App\\Models\\FreelancerJob', '15_img_2021_03_14_021618_52731399.jpg', '1.jpg', 'jpg', 'jpg', '101869', 'image', '1400', '875', 'storage/media/job/15_img_2021_03_14_021618_52731399.jpg', 2, NULL, 'job_image', '2021-03-14 08:16:18', '2021-03-14 08:16:18'),
(24, 16, 'App\\Models\\FreelancerJob', '16_img_2021_03_15_110030_43403743.jpg', 'img-20210228-wa0002.jpg', 'jpg', 'jpg', '61760', 'image', '1280', '1280', 'storage/media/job/16_img_2021_03_15_110030_43403743.jpg', 2, NULL, 'job_image', '2021-03-15 05:00:30', '2021-03-15 05:00:30'),
(25, 17, 'App\\Models\\FreelancerJob', '17_img_2021_03_15_110059_74333734.jpg', 'img-20210228-wa0002.jpg', 'jpg', 'jpg', '61760', 'image', '1280', '1280', 'storage/media/job/17_img_2021_03_15_110059_74333734.jpg', 2, NULL, 'job_image', '2021-03-15 05:00:59', '2021-03-15 05:00:59'),
(26, 18, 'App\\Models\\FreelancerJob', '18_img_2021_03_15_110147_36910229.jpg', 'img-20210228-wa0002.jpg', 'jpg', 'jpg', '61760', 'image', '1280', '1280', 'storage/media/job/18_img_2021_03_15_110147_36910229.jpg', 2, NULL, 'job_image', '2021-03-15 05:01:47', '2021-03-15 05:01:47'),
(27, 19, 'App\\Models\\FreelancerJob', '19_img_2021_03_16_021500_41804018.jpg', 'img-20210228-wa0002.jpg', 'jpg', 'jpg', '61760', 'image', '1280', '1280', 'storage/media/job/19_img_2021_03_16_021500_41804018.jpg', 2, NULL, 'job_image', '2021-03-16 08:15:00', '2021-03-16 08:15:00'),
(28, 20, 'App\\Models\\FreelancerJob', '20_img_2021_03_21_073852_72354998.jpg', 'img-20210228-wa0002.jpg', 'jpg', 'jpg', '61760', 'image', '1280', '1280', 'storage/media/job/20_img_2021_03_21_073852_72354998.jpg', 2, NULL, 'job_image', '2021-03-21 01:38:52', '2021-03-21 01:38:52'),
(29, 21, 'App\\Models\\FreelancerJob', '21_img_2021_03_21_074649_52624359.jpg', 'xiaomi-redmi-note-8-1-500x500.jpg', 'jpg', 'jpg', '35244', 'image', '500', '500', 'storage/media/job/21_img_2021_03_21_074649_52624359.jpg', 2, NULL, 'job_image', '2021-03-21 01:46:49', '2021-03-21 01:46:49'),
(30, 22, 'App\\Models\\FreelancerJob', '22_img_2021_03_21_121004_16403737.jpg', '120763-ezurgunlgb-1559313125.jpg', 'jpg', 'jpg', '196579', 'image', '640', '640', 'storage/media/job/22_img_2021_03_21_121004_16403737.jpg', 2, NULL, 'job_image', '2021-03-21 06:10:04', '2021-03-21 06:10:04'),
(31, 23, 'App\\Models\\FreelancerJob', '23_img_2021_03_22_113015_38837628.jpg', 'laptops-lowres-2x1--1024x512.jpg', 'jpg', 'jpg', '86676', 'image', '1024', '512', 'storage/media/job/23_img_2021_03_22_113015_38837628.jpg', 2, NULL, 'job_image', '2021-03-22 05:30:15', '2021-03-22 05:30:15'),
(32, 24, 'App\\Models\\FreelancerJob', '24_img_2021_03_24_040115_22729496.png', '480px-xiaomi_logo.svg.png', 'png', 'png', '2847', 'image', '480', '480', 'storage/media/job/24_img_2021_03_24_040115_22729496.png', 2, NULL, 'job_image', '2021-03-23 22:01:15', '2021-03-23 22:01:15'),
(33, 25, 'App\\Models\\FreelancerJob', '25_img_2021_03_24_040440_75633561.png', '480px-xiaomi_logo.svg.png', 'png', 'png', '2847', 'image', '480', '480', 'storage/media/job/25_img_2021_03_24_040440_75633561.png', 2, NULL, 'job_image', '2021-03-23 22:04:40', '2021-03-23 22:04:40'),
(34, 26, 'App\\Models\\FreelancerJob', '26_img_2021_03_24_041028_14565885.jpg', '120763-ezurgunlgb-1559313125.jpg', 'jpg', 'jpg', '196579', 'image', '640', '640', 'storage/media/job/26_img_2021_03_24_041028_14565885.jpg', 2, NULL, 'job_image', '2021-03-23 22:10:28', '2021-03-23 22:10:28'),
(35, 27, 'App\\Models\\FreelancerJob', '27_img_2021_03_24_053318_19189941.jpg', 'maxresdefault (1).jpg', 'jpg', 'jpg', '64568', 'image', '1280', '720', 'storage/media/job/27_img_2021_03_24_053318_19189941.jpg', 2, NULL, 'job_image', '2021-03-23 23:33:18', '2021-03-23 23:33:18'),
(36, 28, 'App\\Models\\FreelancerJob', '28_img_2021_03_24_124822_95541060.png', 'imglogo.png', 'png', 'png', '15406', 'image', '217', '217', 'storage/media/job/28_img_2021_03_24_124822_95541060.png', 2, NULL, 'job_image', '2021-03-24 06:48:22', '2021-03-24 06:48:22'),
(37, 29, 'App\\Models\\FreelancerJob', '29_img_2021_03_24_125713_16393072.jpg', '599ec578-86cc-4f1e-bfd8-0dc0a2d60f2e-500x600.jpg', 'jpg', 'jpg', '26332', 'image', '500', '600', 'storage/media/job/29_img_2021_03_24_125713_16393072.jpg', 2, NULL, 'job_image', '2021-03-24 06:57:13', '2021-03-24 06:57:13'),
(38, NULL, 'App\\Models\\FreelancerJob', '_img_2021_03_24_011556_63454878.jpeg', '0053865_rupchanda-soyabean-oil-5ltr-3500000025.jpeg', 'jpeg', 'jpeg', '41049', 'image', '609', '684', 'storage/media/job/_img_2021_03_24_011556_63454878.jpeg', 2, NULL, 'job_image', '2021-03-24 07:15:56', '2021-03-24 07:15:56'),
(39, 30, 'App\\Models\\FreelancerJob', '30_img_2021_03_24_011708_95340800.jpg', '599ec578-86cc-4f1e-bfd8-0dc0a2d60f2e-500x600.jpg', 'jpg', 'jpg', '26332', 'image', '500', '600', 'storage/media/job/30_img_2021_03_24_011708_95340800.jpg', 2, NULL, 'job_image', '2021-03-24 07:17:08', '2021-03-24 07:17:08'),
(40, 31, 'App\\Models\\FreelancerJob', '31_img_2021_03_25_051736_78452404.jpeg', '0053865_rupchanda-soyabean-oil-5ltr-3500000025.jpeg', 'jpeg', 'jpeg', '41049', 'image', '609', '684', 'storage/media/job/31_img_2021_03_25_051736_78452404.jpeg', 2, NULL, 'job_image', '2021-03-24 23:17:36', '2021-03-24 23:17:36'),
(41, 32, 'App\\Models\\FreelancerJob', '32_img_2021_03_25_073319_24157362.jpeg', '0053865_rupchanda-soyabean-oil-5ltr-3500000025.jpeg', 'jpeg', 'jpeg', '41049', 'image', '609', '684', 'storage/media/job/32_img_2021_03_25_073319_24157362.jpeg', 2, NULL, 'job_image', '2021-03-25 01:33:19', '2021-03-25 01:33:19'),
(42, 33, 'App\\Models\\FreelancerJob', '33_img_2021_03_25_073558_81371954.png', 'imglogo.png', 'png', 'png', '15406', 'image', '217', '217', 'storage/media/job/33_img_2021_03_25_073558_81371954.png', 2, NULL, 'job_image', '2021-03-25 01:35:58', '2021-03-25 01:35:58'),
(43, 34, 'App\\Models\\FreelancerJob', '34_img_2021_03_25_093700_60760281.jpg', '120763-ezurgunlgb-1559313125.jpg', 'jpg', 'jpg', '196579', 'image', '640', '640', 'storage/media/job/34_img_2021_03_25_093700_60760281.jpg', 2, NULL, 'job_image', '2021-03-25 03:37:00', '2021-03-25 03:37:00'),
(44, 35, 'App\\Models\\FreelancerJob', '35_img_2021_03_28_043459_83359000.jpg', '16458094805022.jpg', 'jpg', 'jpg', '290262', 'image', '1200', '1200', 'storage/media/job/35_img_2021_03_28_043459_83359000.jpg', 2, NULL, 'job_image', '2021-03-27 22:34:59', '2021-03-27 22:34:59'),
(45, 36, 'App\\Models\\FreelancerJob', '36_img_2021_03_31_021905_81839487.exe', 'd-lan-1.1.0beta15-2012-12-16_16-22-setup.exe', 'exe', 'exe', '5839268', 'image', NULL, NULL, 'storage/media/job/36_img_2021_03_31_021905_81839487.exe', 2, NULL, 'job_image', '2021-03-31 08:19:05', '2021-03-31 08:19:05'),
(46, 37, 'App\\Models\\FreelancerJob', '37_img_2021_03_31_025429_31671301.jpg', 'h15.jpg', 'jpg', 'jpg', '42384', 'image', '600', '400', 'storage/media/job/37_img_2021_03_31_025429_31671301.jpg', 2, NULL, 'job_image', '2021-03-31 08:54:29', '2021-03-31 08:54:29'),
(47, 38, 'App\\Models\\FreelancerJob', '38_img_2021_04_13_043056_33347906.png', 'a.png', 'PNG', 'png', '44087', 'image', '972', '562', 'storage/media/job/38_img_2021_04_13_043056_33347906.png', 2, NULL, 'job_image', '2021-04-12 22:30:56', '2021-04-12 22:30:56'),
(48, 39, 'App\\Models\\FreelancerJob', '39_img_2021_04_18_085217_15089802.jpeg', 'whatsapp image 2021-04-15 at 3.24.36 pm.jpeg', 'jpeg', 'jpeg', '86600', 'image', '1280', '719', 'storage/media/job/39_img_2021_04_18_085217_15089802.jpeg', 2, NULL, 'job_image', '2021-04-18 14:52:17', '2021-04-18 14:52:17'),
(50, 2, 'App\\Models\\Category', '2_img_2021_04_18_112441_81060578.gif', 'website-hosting.gif', 'gif', 'gif', '651146', 'image', '430', '307', 'storage/media/category/image/2_img_2021_04_18_112441_81060578.gif', 2, NULL, 'category_image', '2021-04-18 17:24:41', '2021-04-18 17:24:41'),
(51, 40, 'App\\Models\\FreelancerJob', '40_img_2021_04_20_080258_68828840.gif', 'epl-ssl-logo.gif', 'gif', 'gif', '3235', 'image', '180', '74', 'storage/media/job/40_img_2021_04_20_080258_68828840.gif', 2, NULL, 'job_image', '2021-04-20 02:02:58', '2021-04-20 02:02:58'),
(52, 41, 'App\\Models\\FreelancerJob', '41_img_2021_04_30_060044_89996833.png', 'ladies-lounge_banner.png', 'png', 'png', '10122', 'image', '1171', '111', 'storage/media/job/41_img_2021_04_30_060044_89996833.png', 2, NULL, 'job_image', '2021-04-30 00:00:44', '2021-04-30 00:00:44'),
(53, 42, 'App\\Models\\FreelancerJob', '42_img_2021_04_30_060309_95487649.png', 'ladies-lounge_banner.png', 'png', 'png', '10122', 'image', '1171', '111', 'storage/media/job/42_img_2021_04_30_060309_95487649.png', 2, NULL, 'job_image', '2021-04-30 00:03:09', '2021-04-30 00:03:09'),
(54, 43, 'App\\Models\\FreelancerJob', '43_img_2021_04_30_060429_91049114.png', 'ladies-lounge_banner.png', 'png', 'png', '10122', 'image', '1171', '111', 'storage/media/job/43_img_2021_04_30_060429_91049114.png', 2, NULL, 'job_image', '2021-04-30 00:04:29', '2021-04-30 00:04:29'),
(55, 44, 'App\\Models\\FreelancerJob', '44_img_2021_06_29_065623_23640113.gif', 'website-hosting.gif', 'gif', 'gif', '651146', 'image', '430', '307', 'storage/media/job/44_img_2021_06_29_065623_23640113.gif', 2, NULL, 'job_image', '2021-06-29 00:56:23', '2021-06-29 00:56:23'),
(56, 45, 'App\\Models\\FreelancerJob', '45_img_2021_06_29_082028_94229291.gif', 'website-hosting.gif', 'gif', 'gif', '651146', 'image', '430', '307', 'storage/media/job/45_img_2021_06_29_082028_94229291.gif', 2, NULL, 'job_image', '2021-06-29 02:20:28', '2021-06-29 02:20:28'),
(57, 46, 'App\\Models\\FreelancerJob', '46_img_2021_07_31_015831_91899446.jpg', 'logo111.jpg', 'jpg', 'jpg', '6382', 'image', '100', '100', 'storage/media/job/46_img_2021_07_31_015831_91899446.jpg', 2, NULL, 'job_image', '2021-07-31 07:58:31', '2021-07-31 07:58:31'),
(58, 47, 'App\\Models\\FreelancerJob', '47_img_2021_07_31_020550_19629253.jpg', 'logo111.jpg', 'jpg', 'jpg', '6382', 'image', '100', '100', 'storage/media/job/47_img_2021_07_31_020550_19629253.jpg', 2, NULL, 'job_image', '2021-07-31 08:05:50', '2021-07-31 08:05:50'),
(59, 48, 'App\\Models\\FreelancerJob', '48_img_2021_08_08_041526_85452787.png', '1st.png', 'png', 'png', '73453', 'image', '1366', '768', 'storage/media/job/48_img_2021_08_08_041526_85452787.png', 2, NULL, 'job_image', '2021-08-07 22:15:26', '2021-08-07 22:15:26'),
(60, 49, 'App\\Models\\FreelancerJob', '49_img_2021_08_08_043239_13351481.png', '1st.png', 'png', 'png', '73453', 'image', '1366', '768', 'storage/media/job/49_img_2021_08_08_043239_13351481.png', 2, NULL, 'job_image', '2021-08-07 22:32:39', '2021-08-07 22:32:39'),
(61, 50, 'App\\Models\\FreelancerJob', '50_img_2021_08_09_093739_35201207.jpg', 'cristina-gottardi-cspju6hyo_0-unsplash.jpg', 'jpg', 'jpg', '2124497', 'image', '4896', '3264', 'storage/media/job/50_img_2021_08_09_093739_35201207.jpg', 2, NULL, 'job_image', '2021-08-09 03:37:39', '2021-08-09 03:37:39'),
(62, 51, 'App\\Models\\FreelancerJob', '51_img_2021_08_09_123408_80678010.jpg', 'asus-rog-delta-usb-c-gaming-headset-for-pc-2c-mac-2c-playstation-4-2c-teamspeak-2c-and-discord-with-hi-res-e-500x500.jpg', 'jpg', 'jpg', '21627', 'image', '500', '500', 'storage/media/job/51_img_2021_08_09_123408_80678010.jpg', 2, NULL, 'job_image', '2021-08-09 06:34:08', '2021-08-09 06:34:08'),
(63, 52, 'App\\Models\\FreelancerJob', '52_img_2021_08_11_111235_54861322.png', 'driver.png', 'png', 'png', '135111', 'image', '1366', '768', 'storage/media/job/52_img_2021_08_11_111235_54861322.png', 2, NULL, 'job_image', '2021-08-11 05:12:35', '2021-08-11 05:12:35'),
(64, 53, 'App\\Models\\FreelancerJob', '53_img_2021_08_11_021352_54504697.jpg', 'horlicks.jpg', 'jpg', 'jpg', '32133', 'image', '250', '250', 'storage/media/job/53_img_2021_08_11_021352_54504697.jpg', 2, NULL, 'job_image', '2021-08-11 08:13:52', '2021-08-11 08:13:52'),
(65, 54, 'App\\Models\\FreelancerJob', '54_img_2021_08_11_022220_20586715.jpg', 'mi.jpg', 'jpg', 'jpg', '5140', 'image', '250', '250', 'storage/media/job/54_img_2021_08_11_022220_20586715.jpg', 2, NULL, 'job_image', '2021-08-11 08:22:20', '2021-08-11 08:22:20'),
(67, 55, 'App\\Models\\FreelancerJob', '55_img_2021_08_14_103657_44163700.jpg', 'honda.jpg', 'jpg', 'jpg', '74920', 'image', '250', '250', 'storage/media/job/55_img_2021_08_14_103657_44163700.jpg', 2, NULL, 'job_image', '2021-08-14 04:36:57', '2021-08-14 04:36:57'),
(68, 43, 'App\\Models\\FreelancerJob', '43_img_2021_08_14_104843_10280493.jpg', 'toyota.jpg', 'jpg', 'jpg', '10264', 'image', '250', '250', 'storage/media/job/43_img_2021_08_14_104843_10280493.jpg', 2, NULL, 'job_image', '2021-08-14 04:48:43', '2021-08-14 04:48:43'),
(69, 56, 'App\\Models\\FreelancerJob', '56_img_2021_08_14_105136_81430857.jpg', 'mi.jpg', 'jpg', 'jpg', '5140', 'image', '250', '250', 'storage/media/job/56_img_2021_08_14_105136_81430857.jpg', 2, NULL, 'job_image', '2021-08-14 04:51:36', '2021-08-14 04:51:36'),
(70, 57, 'App\\Models\\FreelancerJob', '57_img_2021_08_16_045503_11259467.jpg', 'toyota.jpg', 'jpg', 'jpg', '10264', 'image', '250', '250', 'storage/media/job/57_img_2021_08_16_045503_11259467.jpg', 2, NULL, 'job_image', '2021-08-15 22:55:03', '2021-08-15 22:55:03'),
(71, 58, 'App\\Models\\FreelancerJob', '58_img_2021_08_16_050429_51967728.jpg', 'teer.jpg', 'jpg', 'jpg', '56820', 'image', '250', '250', 'storage/media/job/58_img_2021_08_16_050429_51967728.jpg', 2, NULL, 'job_image', '2021-08-15 23:04:29', '2021-08-15 23:04:29'),
(72, 59, 'App\\Models\\FreelancerJob', '59_img_2021_08_16_053504_77000501.jpg', 'gillete.jpg', 'jpg', 'jpg', '25293', 'image', '250', '250', 'storage/media/job/59_img_2021_08_16_053504_77000501.jpg', 2, NULL, 'job_image', '2021-08-15 23:35:04', '2021-08-15 23:35:04'),
(73, 60, 'App\\Models\\FreelancerJob', '60_img_2021_08_16_104910_10184604.jpg', 'blog_03.jpg', 'jpg', 'jpg', '35626', 'image', '570', '220', 'storage/media/job/60_img_2021_08_16_104910_10184604.jpg', 2, NULL, 'job_image', '2021-08-16 04:49:10', '2021-08-16 04:49:10'),
(74, 61, 'App\\Models\\FreelancerJob', '61_img_2021_08_20_121220_19513066.png', 'aab.png', 'png', 'png', '12848', 'image', '471', '471', 'storage/media/job/61_img_2021_08_20_121220_19513066.png', 78, NULL, 'job_image', '2021-08-20 06:12:20', '2021-08-20 06:12:20'),
(75, 62, 'App\\Models\\FreelancerJob', '62_img_2021_08_28_125515_20067669.png', 'aab.png', 'png', 'png', '12848', 'image', '471', '471', 'storage/media/job/62_img_2021_08_28_125515_20067669.png', 2, NULL, 'job_image', '2021-08-27 18:55:15', '2021-08-27 18:55:15'),
(76, 63, 'App\\Models\\FreelancerJob', '63_img_2021_08_28_125628_85803268.jpg', 'aaa.jpg', 'jpg', 'jpg', '32686', 'image', '600', '600', 'storage/media/job/63_img_2021_08_28_125628_85803268.jpg', 2, NULL, 'job_image', '2021-08-27 18:56:28', '2021-08-27 18:56:28'),
(77, 15, 'App\\Models\\Category', '15_banner_2021_11_14_095447_35682830.png', 'capture.png', 'PNG', 'png', '12239', 'image', '865', '308', 'storage/media/category/banner/15_banner_2021_11_14_095447_35682830.png', 2, NULL, 'category_banner', '2021-11-14 03:54:47', '2021-11-14 03:54:47'),
(78, 15, 'App\\Models\\Category', '15_img_2021_11_14_095447_50858965.jpeg', 'whatsapp image 2021-05-31 at 3.02.38 pm.jpeg', 'jpeg', 'jpeg', '255006', 'image', '1280', '853', 'storage/media/category/image/15_img_2021_11_14_095447_50858965.jpeg', 2, NULL, 'category_image', '2021-11-14 03:54:47', '2021-11-14 03:54:47'),
(81, 64, 'App\\Models\\FreelancerJob', '64_img_2021_12_01_095802_25414139.jpg', 'tokyo-night.jpg', 'jpg', 'jpg', '59746', 'image', '583', '280', 'storage/media/job/64_img_2021_12_01_095802_25414139.jpg', 2, NULL, 'job_image', '2021-12-01 03:58:02', '2021-12-01 03:58:02'),
(82, NULL, NULL, 'aXS121120642.jpg', '234786300_3818339501603624_6216994269369323979_n.jpg', 'image/jpeg', 'jpg', '472636', 'image', '2000', '2015', 'storage/media/image/aXS121120642.jpg', 2, NULL, '0', '2021-12-06 00:06:42', '2021-12-06 00:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `membership_packages`
--

CREATE TABLE `membership_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_description` text COLLATE utf8mb4_unicode_ci,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_amount` decimal(12,2) DEFAULT NULL,
  `package_acount_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single',
  `package_duration` int(11) DEFAULT NULL,
  `package_format` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'prepaid',
  `operation_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'get_work',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` int(10) UNSIGNED NOT NULL,
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_title`, `menu_type`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(7, 'About Us', 'Full', 2, NULL, '2021-02-22 06:56:13', '2021-02-22 06:56:13'),
(8, 'Contact Us', 'Full', 2, NULL, '2021-02-22 06:56:23', '2021-02-22 06:56:23'),
(9, 'Terms & Conditions', 'Full', 2, NULL, '2021-02-22 06:56:38', '2021-02-22 06:56:38'),
(10, 'Privacy & Policies', 'Full', 2, NULL, '2021-02-22 06:57:01', '2021-02-22 06:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `menu_pages`
--

CREATE TABLE `menu_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `page_id` int(10) UNSIGNED NOT NULL,
  `addedby_id` int(10) UNSIGNED DEFAULT NULL,
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(17, '2014_10_12_100000_create_password_resets_table', 2),
(18, '2016_12_08_075609_create_user_roles_table', 2),
(19, '2018_07_04_163826_create_pages_table', 2),
(20, '2019_04_11_145253_create_page_items_table', 2),
(21, '2019_08_19_000000_create_failed_jobs_table', 2),
(22, '2020_07_18_165702_create_product_brands_table', 3),
(23, '2021_02_13_103902_create_outlets_table', 4),
(25, '2021_02_13_110139_create_brand_outlets_table', 5),
(26, '2021_02_14_055810_create_products_table', 6),
(27, '2021_02_14_064111_create_category_products_table', 7),
(28, '2016_06_01_000001_create_oauth_auth_codes_table', 8),
(29, '2016_06_01_000002_create_oauth_access_tokens_table', 8),
(30, '2016_06_01_000003_create_oauth_refresh_tokens_table', 8),
(31, '2016_06_01_000004_create_oauth_clients_table', 8),
(32, '2016_06_01_000005_create_oauth_personal_access_clients_table', 8),
(34, '2021_02_23_052450_create_subscribers_table', 9),
(36, '2021_02_23_103642_create_work_stations_table', 10),
(37, '2021_02_24_110715_create_subcriber_payments_table', 11),
(38, '2021_01_28_085459_create_categories_table', 12),
(39, '2021_02_28_103909_create_subcategories_table', 12),
(40, '2021_03_02_123712_create_freelancer_jobs_table', 13),
(43, '2021_03_04_064723_create_job_categories_table', 14),
(44, '2021_03_04_065208_create_job_subcategories_table', 14),
(45, '2021_03_06_060012_create_orders_table', 15),
(46, '2021_03_06_060654_create_order_items_table', 15),
(47, '2021_03_06_061101_create_order_payments_table', 15),
(53, '2021_03_07_062922_create_honoraria_table', 17),
(54, '2021_03_07_063043_create_subscriber_honoraria_table', 17),
(62, '2021_03_06_083615_create_balance_transactions_table', 19),
(64, '2021_03_13_070515_create_freelance_job_works_table', 20),
(66, '2021_03_07_122027_create_admin_balances_table', 21),
(67, '2021_03_13_112136_create_order_works_table', 21),
(68, '2021_04_20_101157_create_posts_table', 22),
(69, '2021_04_20_101134_create_post_files_table', 23),
(70, '2021_04_23_093551_create_comments_table', 24),
(71, '2021_04_23_095747_create_likes_table', 24),
(72, '2021_04_23_100712_create_views_table', 25),
(73, '2021_04_23_100855_create_saves_table', 25),
(74, '2021_04_24_085024_create_touches_table', 26),
(75, '2021_04_26_090240_create_notifications_table', 27),
(77, '2021_06_29_053543_create_job_work_links_table', 28),
(84, '2021_06_02_235041_create_verified_data_table', 29),
(85, '2021_07_12_132830_create_membership_packages_table', 29),
(90, '2021_09_05_124927_create_service_profiles_table', 30),
(91, '2021_09_11_055919_create_service_profile_infos_table', 31),
(92, '2021_09_13_112739_create_service_profile_info_values_table', 32),
(94, '2021_09_25_111706_create_service_profile_visitors_table', 33),
(99, '2021_09_28_045907_create_withdrawal_lists_table', 34),
(101, '2021_10_11_085956_create_opinions_table', 35),
(105, '2021_10_12_092607_create_user_update_information_table', 36),
(106, '2021_10_13_095052_create_service_profile_products_table', 37),
(107, '2021_10_16_054217_create_service_product_images_table', 38),
(111, '2021_10_18_091414_create_service_product_carts_table', 39),
(116, '2021_10_19_060013_create_service_product_orders_table', 40),
(117, '2021_10_19_060723_create_service_product_order_items_table', 40),
(119, '2021_10_25_044505_create_service_profile_product_wishlists_table', 41),
(121, '2021_11_13_120849_create_needs_table', 42),
(127, '2021_11_14_115617_create_bids_table', 43),
(128, '2021_11_16_072732_create_needs_payments_table', 44),
(129, '2021_11_17_085823_create_favourites_table', 45),
(139, '2021_11_21_043909_create_blogs_table', 46),
(140, '2021_11_21_052943_create_blog_tags_table', 46),
(141, '2021_11_21_053140_create_blog_categories_table', 46),
(142, '2021_11_21_083511_create_post_categories_table', 46),
(143, '2021_11_27_072802_create_social_groups_table', 47),
(144, '2021_12_01_101146_create_notes_table', 48),
(147, '2021_12_19_104940_create_serviceitems_table', 49),
(148, '2021_12_21_123314_create_negotiations_table', 50),
(151, '2021_12_26_083828_create_service_payments_table', 51),
(153, '2021_12_26_122635_create_suggestions_table', 52);

-- --------------------------------------------------------

--
-- Table structure for table `needs`
--

CREATE TABLE `needs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `closed_date` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ws_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `workstation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_status` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `satisfied_at` timestamp NULL DEFAULT NULL,
  `unsatisfied_at` timestamp NULL DEFAULT NULL,
  `order_confirmed_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `needs`
--

INSERT INTO `needs` (`id`, `title`, `description`, `closed_date`, `user_id`, `ws_cat_id`, `workstation_id`, `payment_status`, `order_status`, `delivered_at`, `satisfied_at`, `unsatisfied_at`, `order_confirmed_price`, `status`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(2, 'Commodi sit accusan', 'Voluptatem Non culp', '2021-11-24 18:00:00', 2, 3, 1, NULL, NULL, NULL, NULL, NULL, '0.00', 'approved', 2, 2, '2021-11-16 23:03:48', '2021-11-16 23:10:01'),
(4, 'Qui ut eum proident', 'Est eligendi asperio', '2021-11-24 18:00:00', 2, 3, 1, NULL, NULL, NULL, NULL, NULL, '0.00', 'approved', 2, 2, '2021-11-17 04:18:28', '2021-11-17 04:18:40'),
(5, '0172221212801722212128', '<p>01722212121</p><p><font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">01722212121</font></p><hr><p><br></p><hr><p>01722212121</p><hr><p>01722212121</p><hr><p>01722212121</p><hr><p>01722212121</p><hr><p><br></p>', '2021-12-05 18:00:00', 123, 3, 1, NULL, NULL, NULL, NULL, NULL, '0.00', 'approved', NULL, 2, '2021-11-27 04:44:14', '2021-11-27 04:46:07'),
(6, 'Velit nostrud quaera', '<p>Impedit, nihil quas . Impedit, nihil quas .Impedit, nihil quas .</p><p>Impedit, nihil quas . Impedit, nihil quas .Impedit, nihil quas .</p><p>Impedit, nihil quas . Impedit, nihil quas .Impedit, nihil quas .<br></p>', '2001-09-30 18:00:00', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', 'pending', NULL, NULL, '2021-11-27 04:48:49', '2021-11-27 04:48:49');
INSERT INTO `needs` (`id`, `title`, `description`, `closed_date`, `user_id`, `ws_cat_id`, `workstation_id`, `payment_status`, `order_status`, `delivered_at`, `satisfied_at`, `unsatisfied_at`, `order_confirmed_price`, `status`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `needs_payments`
--

CREATE TABLE `needs_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `need_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bid_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_balance` decimal(22,2) DEFAULT NULL,
  `paid_balance` decimal(22,2) DEFAULT NULL,
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `needs_payments`
--

INSERT INTO `needs_payments` (`id`, `need_id`, `bid_id`, `user_id`, `payment_status`, `pending_balance`, `paid_balance`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 2, 'advanced', '240.00', NULL, 2, NULL, '2021-11-16 01:45:21', '2021-11-16 01:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `negotiations`
--

CREATE TABLE `negotiations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `owner_id` bigint(20) DEFAULT NULL,
  `service_profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `workstation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subscriber_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` int(10) UNSIGNED DEFAULT NULL,
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `negotiations`
--

INSERT INTO `negotiations` (`id`, `user_id`, `owner_id`, `service_profile_id`, `category_id`, `workstation_id`, `subscriber_id`, `item_id`, `price`, `approved`, `type`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(3, 91, 2, 33, 1, 1, 44, 2, '120.00', 0, NULL, 91, NULL, '2021-12-22 05:37:32', '2021-12-22 05:37:32'),
(4, 2, 2, 33, 1, 1, 44, 2, '750.00', 0, NULL, 2, NULL, '2021-12-22 06:01:39', '2021-12-22 06:01:39'),
(5, 128, 2, 33, 1, 1, 44, 2, '800.00', 0, NULL, 128, NULL, '2021-12-22 06:01:51', '2021-12-22 06:01:51'),
(6, 128, 2, 33, 1, 1, 44, 2, '50.00', 0, NULL, 128, NULL, '2021-12-22 06:47:03', '2021-12-22 06:47:03'),
(7, 128, 2, 33, 1, 1, 44, 2, '500.00', 1, NULL, 128, NULL, '2021-12-22 07:06:53', '2021-12-26 00:34:24'),
(8, 91, 2, 33, 1, 1, 44, 2, '500.00', 1, NULL, 91, NULL, '2021-12-22 07:31:49', '2021-12-28 07:59:08'),
(9, 128, 2, 33, 1, 1, 44, 2, '700.00', 0, NULL, 2, NULL, '2021-12-22 07:42:11', '2021-12-22 07:42:11'),
(10, 128, 2, 33, 1, 1, 44, 2, '450.00', 0, NULL, 2, NULL, '2021-12-22 07:52:18', '2021-12-22 07:52:18'),
(11, 91, 2, 33, 1, 1, 44, 2, '450.00', 0, NULL, 2, NULL, '2021-12-22 07:56:31', '2021-12-22 07:56:31'),
(12, 128, NULL, 33, 1, 1, 44, 2, '540.00', 0, NULL, 128, NULL, '2021-12-22 07:56:45', '2021-12-22 07:56:45'),
(13, 128, 2, 33, 1, 1, 44, 2, '530.00', 0, NULL, 2, NULL, '2021-12-22 07:57:00', '2021-12-22 07:57:00'),
(14, 91, NULL, 33, 1, 1, 99, 1, '1350.00', 0, NULL, 91, NULL, '2021-12-22 08:04:58', '2021-12-22 08:04:58'),
(15, 91, 2, 33, 1, 1, 99, 1, '1355.00', 0, NULL, 2, NULL, '2021-12-22 08:05:13', '2021-12-22 08:05:13'),
(16, 2, 2, 33, 1, 1, 44, 2, '10.00', 0, NULL, 2, NULL, '2021-12-26 00:27:53', '2021-12-26 00:27:53'),
(17, 2, 2, 33, 1, 1, 44, 2, '120.00', 0, NULL, 2, NULL, '2021-12-26 00:28:15', '2021-12-26 00:28:15'),
(20, 128, NULL, 33, 1, 1, 99, 1, '1200.00', 1, NULL, 128, NULL, '2021-12-26 02:18:48', '2021-12-29 02:14:23'),
(21, 129, NULL, 33, 1, 1, 44, 2, '400.00', 0, NULL, 129, NULL, '2021-12-28 03:49:52', '2021-12-28 03:49:52'),
(22, 129, 2, 33, 1, 1, 44, 2, '500.00', 1, NULL, 2, NULL, '2021-12-28 03:51:43', '2021-12-28 03:52:42'),
(23, 129, NULL, 33, 1, 1, 32, 4, '300.00', 0, NULL, 129, NULL, '2021-12-28 05:50:47', '2021-12-28 05:50:47'),
(24, 129, NULL, 33, 1, 1, 32, 4, '150.00', 0, NULL, 129, NULL, '2021-12-28 05:51:50', '2021-12-28 05:51:50'),
(25, 129, NULL, 33, 1, 1, 32, 4, '50.00', 0, NULL, 129, NULL, '2021-12-28 06:07:36', '2021-12-28 06:07:36'),
(26, 129, NULL, 33, 1, 1, 32, 4, '500.00', 0, NULL, 129, NULL, '2021-12-28 06:38:46', '2021-12-28 06:38:46'),
(27, 129, 2, 33, 1, 1, 32, 4, '10.00', 0, NULL, 2, NULL, '2021-12-28 06:54:13', '2021-12-28 06:54:13'),
(28, 128, 2, 33, 1, 1, 99, 1, '50.00', 0, NULL, 2, NULL, '2021-12-28 06:56:51', '2021-12-28 06:56:51'),
(29, 129, NULL, 33, 1, 1, 32, 4, '40.00', 0, NULL, 129, NULL, '2021-12-28 07:59:51', '2021-12-28 07:59:51'),
(30, 128, NULL, 33, 1, 1, 32, 4, '100.00', 0, NULL, 128, NULL, '2021-12-29 02:17:33', '2021-12-29 02:17:33'),
(31, 128, 2, 33, 1, 1, 32, 4, '500.00', 1, 'negotiation', 2, NULL, '2021-12-29 02:18:28', '2021-12-29 02:19:23'),
(32, 127, NULL, 33, 1, 1, 32, 4, '344.00', 0, NULL, 127, NULL, '2022-01-02 03:28:08', '2022-01-02 03:28:08'),
(33, 2, NULL, 51, 1, 1, 365, 7, '120.00', 1, NULL, 2, NULL, '2022-01-02 06:14:02', '2022-01-02 06:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addedby_id` int(10) UNSIGNED DEFAULT NULL,
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `note`, `image`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(2, 125, 'Velit magnam veniam  Velit magnam veniam', '125_img_2021_12_01_104332_44211060.jpg', 2021, NULL, '2021-12-01 04:43:32', '2021-12-01 04:43:32'),
(3, 91, 'Test Note', '3_img_2021_12_07_051118_26179294.jpg', 2021, NULL, '2021-12-06 23:11:18', '2021-12-06 23:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('01b2a616-9b41-428c-9839-6e4457d7e4f4', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":37,\"commentable_id\":8,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"as\",\"comment_by_id\":2,\"comments_count_of_item\":7}', NULL, '2021-04-30 09:27:33', '2021-04-30 09:27:33'),
('0397e979-b6ef-4dca-a9d5-fb87e3c06a38', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":19,\"commentable_id\":8,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"as\",\"comment_by_id\":2,\"comments_count_of_item\":3}', NULL, '2021-04-30 04:00:29', '2021-04-30 04:00:29'),
('096f0c42-889c-4820-a9c5-1bd4359e9f58', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":33,\"commentable_id\":6,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"some text\",\"comment_by_id\":2,\"comments_count_of_item\":4}', NULL, '2021-04-30 04:07:58', '2021-04-30 04:07:58'),
('09bd5237-53ab-4209-8fdc-b3145fc86183', 'App\\Notifications\\Liked', 'App\\Models\\User', 2, '{\"like_id\":112,\"likeable_id\":10,\"likeable_type\":\"App\\\\Models\\\\Comment\",\"likeable_title\":null,\"like_by_id\":2,\"likes_count_of_item\":1}', NULL, '2021-04-29 22:40:23', '2021-04-29 22:40:23'),
('1102c0e4-ef75-4470-864a-e30d42184004', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":40,\"commentable_id\":8,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"as\",\"comment_by_id\":2,\"comments_count_of_item\":10}', NULL, '2021-04-30 09:27:42', '2021-04-30 09:27:42'),
('12a7c732-d87e-45cf-b359-489234eb1b0f', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":20,\"commentable_id\":8,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"as\",\"comment_by_id\":2,\"comments_count_of_item\":4}', NULL, '2021-04-30 04:00:34', '2021-04-30 04:00:34'),
('18c5bae9-fcad-428e-a914-78b7e96c863a', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":27,\"commentable_id\":7,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"asdfsdaf\",\"comment_by_id\":2,\"comments_count_of_item\":2}', NULL, '2021-04-30 04:04:17', '2021-04-30 04:04:17'),
('1ee6839d-3f33-4972-97a9-b7ddfd0e0d03', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":39,\"commentable_id\":8,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"as\",\"comment_by_id\":2,\"comments_count_of_item\":9}', NULL, '2021-04-30 09:27:39', '2021-04-30 09:27:39'),
('2077b57c-1df2-4989-b449-5898a16e28be', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":15,\"commentable_id\":10,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"saa\",\"comment_by_id\":2,\"comments_count_of_item\":3}', NULL, '2021-04-29 23:14:46', '2021-04-29 23:14:46'),
('21111fbf-cdeb-4b08-b89d-499205445c82', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":31,\"commentable_id\":10,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"saa\",\"comment_by_id\":2,\"comments_count_of_item\":7}', NULL, '2021-04-30 04:06:27', '2021-04-30 04:06:27'),
('22dd0e65-6038-4bdd-97e2-7ceecf8a9024', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":13,\"commentable_id\":3,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"aaaa\",\"comment_by_id\":2,\"comments_count_of_item\":4}', NULL, '2021-04-29 22:40:38', '2021-04-29 22:40:38'),
('25f97a46-28ae-4d72-bcf7-17e612e87d38', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":30,\"commentable_id\":10,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"saa\",\"comment_by_id\":2,\"comments_count_of_item\":6}', NULL, '2021-04-30 04:06:06', '2021-04-30 04:06:06'),
('29c22ab7-4f1b-4d10-9ac0-dc5b4062dad1', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":6,\"commentable_id\":4,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"asdfsadf\\r\\nasdfsadf\",\"comment_by_id\":2,\"comments_count_of_item\":1}', NULL, '2021-04-29 19:17:12', '2021-04-29 19:17:12'),
('329c8351-4012-4c99-94c1-9420f0d6bd00', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":10,\"commentable_id\":3,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"aaaa\",\"comment_by_id\":2,\"comments_count_of_item\":3}', NULL, '2021-04-29 19:31:01', '2021-04-29 19:31:01'),
('3ac7cf7b-eb31-4e05-be9e-98eff33fc8cd', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":32,\"commentable_id\":7,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"asdfsdaf\",\"comment_by_id\":2,\"comments_count_of_item\":4}', NULL, '2021-04-30 04:07:33', '2021-04-30 04:07:33'),
('515c4e45-b957-41fa-a090-17dfe33f2f39', 'App\\Notifications\\Liked', 'App\\Models\\User', 2, '{\"like_id\":111,\"likeable_id\":11,\"likeable_type\":\"App\\\\Models\\\\Comment\",\"likeable_title\":null,\"like_by_id\":2,\"likes_count_of_item\":1}', NULL, '2021-04-29 22:40:18', '2021-04-29 22:40:18'),
('56793b55-d422-4619-8925-f6a7971ad15d', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":23,\"commentable_id\":6,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"some text\",\"comment_by_id\":2,\"comments_count_of_item\":2}', NULL, '2021-04-30 04:02:12', '2021-04-30 04:02:12'),
('5f24f009-3d42-405f-a888-d0b9b15b2e05', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":35,\"commentable_id\":8,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"as\",\"comment_by_id\":2,\"comments_count_of_item\":6}', NULL, '2021-04-30 04:10:30', '2021-04-30 04:10:30'),
('65668892-4cdf-4b54-b22d-6cebb6c488b4', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":29,\"commentable_id\":10,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"saa\",\"comment_by_id\":2,\"comments_count_of_item\":5}', NULL, '2021-04-30 04:05:47', '2021-04-30 04:05:47'),
('6b9dfdd7-5ab6-4dff-a9bb-c557b811f22f', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":38,\"commentable_id\":8,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"as\",\"comment_by_id\":2,\"comments_count_of_item\":8}', NULL, '2021-04-30 09:27:36', '2021-04-30 09:27:36'),
('76b9abfe-2209-4669-a7d4-5e19b0f8aea1', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":18,\"commentable_id\":8,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"as\",\"comment_by_id\":2,\"comments_count_of_item\":2}', NULL, '2021-04-30 04:00:24', '2021-04-30 04:00:24'),
('7862071a-e25c-4146-b5b7-ec78c239b984', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":41,\"commentable_id\":10,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"saa\",\"comment_by_id\":2,\"comments_count_of_item\":8}', NULL, '2021-04-30 09:27:57', '2021-04-30 09:27:57'),
('7a51bac1-a553-4468-bac7-05f308dc8fac', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":22,\"commentable_id\":6,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"some text\",\"comment_by_id\":2,\"comments_count_of_item\":1}', NULL, '2021-04-30 04:02:05', '2021-04-30 04:02:05'),
('7c255b3a-2cb7-411a-9595-875474cb6c3f', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":21,\"commentable_id\":8,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"as\",\"comment_by_id\":2,\"comments_count_of_item\":5}', NULL, '2021-04-30 04:00:37', '2021-04-30 04:00:37'),
('8440e52d-7dd1-4e32-9f36-d47095df35aa', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":24,\"commentable_id\":6,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"some text\",\"comment_by_id\":2,\"comments_count_of_item\":3}', NULL, '2021-04-30 04:03:12', '2021-04-30 04:03:12'),
('9d9852d7-f4fb-4f31-ae76-3268955ab39c', 'App\\Notifications\\Liked', 'App\\Models\\User', 2, '{\"like_id\":96,\"likeable_id\":10,\"likeable_type\":\"App\\\\Models\\\\Post\",\"likeable_title\":\"\",\"like_by_id\":2,\"likes_count_of_item\":1}', NULL, '2021-04-27 14:40:14', '2021-04-27 14:40:14'),
('a07cc0ba-fcc6-4b3a-a21d-e911127fe005', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":9,\"commentable_id\":3,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"aaaa\",\"comment_by_id\":2,\"comments_count_of_item\":2}', NULL, '2021-04-29 19:30:50', '2021-04-29 19:30:50'),
('a1f14a5c-2e56-494c-be85-f4b76f3b1791', 'App\\Notifications\\Liked', 'App\\Models\\User', 2, '{\"like_id\":114,\"likeable_id\":6,\"likeable_type\":\"App\\\\Models\\\\Post\",\"likeable_title\":\"\",\"like_by_id\":2,\"likes_count_of_item\":1}', NULL, '2021-04-29 22:55:54', '2021-04-29 22:55:54'),
('a5cb6772-7dc4-4841-a92f-268dc95ce527', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":42,\"commentable_id\":9,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"asdfsdfasdf\",\"comment_by_id\":2,\"comments_count_of_item\":1}', NULL, '2021-04-30 09:30:30', '2021-04-30 09:30:30'),
('a64cb2ac-cf38-4d27-bcb9-9febdea58d5c', 'App\\Notifications\\Liked', 'App\\Models\\User', 2, '{\"like_id\":116,\"likeable_id\":6,\"likeable_type\":\"App\\\\Models\\\\Comment\",\"likeable_title\":null,\"like_by_id\":2,\"likes_count_of_item\":1}', NULL, '2021-04-29 22:57:57', '2021-04-29 22:57:57'),
('a76bff95-2cfd-46f4-ba64-6df2913290a6', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":28,\"commentable_id\":7,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"asdfsdaf\",\"comment_by_id\":2,\"comments_count_of_item\":3}', NULL, '2021-04-30 04:05:28', '2021-04-30 04:05:28'),
('af9b5b75-757d-4efe-8b3d-68518dbaed21', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":34,\"commentable_id\":6,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"some text\",\"comment_by_id\":2,\"comments_count_of_item\":5}', NULL, '2021-04-30 04:08:13', '2021-04-30 04:08:13'),
('b488e14c-b731-44c5-8955-ec78f9d638ca', 'App\\Notifications\\Liked', 'App\\Models\\User', 2, '{\"like_id\":97,\"likeable_id\":7,\"likeable_type\":\"App\\\\Models\\\\Post\",\"likeable_title\":\"\",\"like_by_id\":2,\"likes_count_of_item\":1}', NULL, '2021-04-27 14:41:03', '2021-04-27 14:41:03'),
('c47f2654-ae3b-4245-8c3c-0adf32d727df', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":16,\"commentable_id\":10,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"saa\",\"comment_by_id\":2,\"comments_count_of_item\":4}', NULL, '2021-04-30 03:55:40', '2021-04-30 03:55:40'),
('e8627310-9790-45bc-a610-fa19a4c92795', 'App\\Notifications\\Liked', 'App\\Models\\User', 2, '{\"like_id\":118,\"likeable_id\":14,\"likeable_type\":\"App\\\\Models\\\\Comment\",\"likeable_title\":null,\"like_by_id\":2,\"likes_count_of_item\":1}', NULL, '2021-04-29 23:00:30', '2021-04-29 23:00:30'),
('ebd50d20-65eb-4e80-9f60-766230308967', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":11,\"commentable_id\":3,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"aaaa\",\"comment_by_id\":2,\"comments_count_of_item\":4}', NULL, '2021-04-29 19:31:54', '2021-04-29 19:31:54'),
('ef6a2b1f-1259-414f-aa36-b321a4cb3cf8', 'App\\Notifications\\Liked', 'App\\Models\\User', 2, '{\"like_id\":119,\"likeable_id\":13,\"likeable_type\":\"App\\\\Models\\\\Comment\",\"likeable_title\":null,\"like_by_id\":2,\"likes_count_of_item\":1}', NULL, '2021-04-29 23:08:03', '2021-04-29 23:08:03'),
('f14106ff-7af2-421a-b18d-51afd0c29fed', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":7,\"commentable_id\":7,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"asdfsdaf\",\"comment_by_id\":2,\"comments_count_of_item\":1}', NULL, '2021-04-29 19:17:26', '2021-04-29 19:17:26'),
('f67d9a47-6afd-4697-8982-a0ae458165db', 'App\\Notifications\\Commented', 'App\\Models\\User', 2, '{\"comment_id\":17,\"commentable_id\":8,\"commentable_type\":\"App\\\\Models\\\\Post\",\"commentable_title\":\"as\",\"comment_by_id\":2,\"comments_count_of_item\":1}', NULL, '2021-04-30 03:57:10', '2021-04-30 03:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('a88824e3369245623ed2d483b763619ad4d4e77bd95c275dc94d459ed1b7f6e860cfcf798c0bb526', 2, 1, 'authToken', '[]', 0, '2021-02-15 07:10:35', '2021-02-15 07:10:35', '2022-02-15 13:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Caliconshop Personal Access Client', 'n17ToJhqT6c9mC9Ng7Jo7EJRWZ7SBtCLRzHhW9Z8', NULL, 'http://localhost', 1, 0, 0, '2021-02-15 06:03:12', '2021-02-15 06:03:12'),
(2, NULL, 'Caliconshop Password Grant Client', 'yCfVRwzxxw3iiKdAVLwgHVHHewy1Zi4ekB0z81NL', 'users', 'http://localhost', 0, 1, 0, '2021-02-15 06:03:12', '2021-02-15 06:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-02-15 06:03:12', '2021-02-15 06:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opinions`
--

CREATE TABLE `opinions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `opinion` text COLLATE utf8mb4_unicode_ci,
  `visit_count` bigint(20) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `opinions`
--

INSERT INTO `opinions` (`id`, `user_id`, `opinion`, `visit_count`, `featured`, `status`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'First Opinions 10', 0, 0, 'pending', 2, NULL, '2021-10-11 03:45:04', '2021-10-11 07:35:05'),
(2, 2, 'Second Opinion', 0, 1, 'pending', 2, NULL, '2021-10-11 03:52:01', '2021-10-11 07:59:20'),
(5, 2, 'Hllo', 78, 1, 'lived', 2, NULL, '2021-10-11 07:58:12', '2021-12-26 06:33:44'),
(6, 96, 'Hello', 78, 1, 'lived', 96, NULL, '2021-10-23 22:41:51', '2021-12-26 06:33:44'),
(7, 2, 'Et esse eveniet et Dolore in est consecEt esse eveniet et Dolore in est consecEt esse eveniet et Dolore in est consecEt esse eveniet et Dolore in est consecEt esse eveniet et Dolore in est consec', 33, 1, 'lived', 2, NULL, '2021-12-01 00:44:01', '2021-12-26 06:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_station_id` int(11) DEFAULT NULL,
  `subscriber_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_number` bigint(20) DEFAULT NULL,
  `order_for` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product',
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `due_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pending_at` timestamp NULL DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `processing_at` timestamp NULL DEFAULT NULL,
  `ready_to_ship_at` timestamp NULL DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `returned_at` timestamp NULL DEFAULT NULL,
  `undelivered_at` timestamp NULL DEFAULT NULL,
  `inv_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marchant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentref_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `work_station_id`, `subscriber_id`, `user_id`, `name`, `mobile`, `invoice_number`, `order_for`, `order_status`, `payment_status`, `paid_amount`, `due_amount`, `addedby_id`, `editedby_id`, `pending_at`, `confirmed_at`, `processing_at`, `ready_to_ship_at`, `shipped_at`, `delivered_at`, `cancelled_at`, `returned_at`, `undelivered_at`, `inv_id`, `marchant_id`, `paymentref_id`, `amount`, `created_at`, `updated_at`) VALUES
(2, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-14 00:36:48', NULL, NULL, NULL, NULL, '2021-03-14 00:37:05', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-14 00:36:48', '2021-03-14 00:37:05'),
(3, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '500.00', '0.00', 2, NULL, '2021-03-14 00:39:05', NULL, NULL, NULL, NULL, '2021-03-14 00:41:09', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-14 00:38:38', '2021-03-14 00:41:09'),
(4, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-14 00:41:15', NULL, NULL, NULL, NULL, '2021-03-14 00:57:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-14 00:41:15', '2021-03-14 00:57:13'),
(6, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-14 03:24:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-14 03:24:06', '2021-03-14 03:24:06'),
(7, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '800.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-14 03:32:31', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-14 03:32:31', '2021-03-14 03:32:31'),
(8, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '16.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-14 03:33:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-14 03:33:10', '2021-03-14 03:33:10'),
(9, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-14 08:03:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-14 08:03:42', '2021-03-14 08:03:42'),
(10, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'pending', 'unpaid', '110.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-14 08:16:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-14 08:16:18', '2021-03-14 08:16:18'),
(11, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-15 02:40:59', NULL, NULL, NULL, NULL, '2021-03-15 02:41:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-15 02:40:59', '2021-03-15 02:41:28'),
(12, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-15 02:51:18', NULL, NULL, NULL, NULL, '2021-03-15 02:51:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-15 02:51:18', '2021-03-15 02:51:50'),
(13, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-15 03:44:22', NULL, NULL, NULL, NULL, '2021-03-15 03:45:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-15 03:44:22', '2021-03-15 03:45:55'),
(14, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '150.00', '0.00', 2, NULL, '2021-03-15 03:44:50', NULL, NULL, NULL, NULL, '2021-03-15 03:45:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-15 03:44:50', '2021-03-15 03:45:30'),
(15, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '500.00', '0.00', 2, NULL, '2021-03-15 03:45:08', NULL, NULL, NULL, NULL, '2021-03-15 03:45:24', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-15 03:45:08', '2021-03-15 03:45:24'),
(16, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '400.00', '0.00', 2, NULL, '2021-03-15 03:47:25', NULL, NULL, NULL, NULL, '2021-03-15 03:48:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-15 03:47:25', '2021-03-15 03:48:28'),
(17, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '300.00', '0.00', 2, NULL, '2021-03-15 03:48:04', NULL, NULL, NULL, NULL, '2021-03-15 03:48:21', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-15 03:48:04', '2021-03-15 03:48:21'),
(18, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '120.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 05:00:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-15 05:00:30', '2021-03-15 05:00:30'),
(19, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '120.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 05:00:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-15 05:00:59', '2021-03-15 05:00:59'),
(20, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '30.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 05:01:47', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-15 05:01:47', '2021-03-15 05:01:47'),
(21, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-16 06:52:20', NULL, NULL, NULL, NULL, '2021-03-16 06:52:54', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-16 06:52:20', '2021-03-16 06:52:54'),
(22, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-16 06:53:45', NULL, NULL, NULL, NULL, '2021-03-23 22:54:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-16 06:53:45', '2021-03-23 22:54:52'),
(23, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '200.00', '0.00', 2, NULL, '2021-03-16 06:54:03', NULL, NULL, NULL, NULL, '2021-03-16 06:54:25', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-16 06:54:03', '2021-03-16 06:54:25'),
(24, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 08:15:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-16 08:15:00', '2021-03-16 08:15:00'),
(25, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '100.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-21 01:38:52', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-21 01:38:52', '2021-03-21 01:38:52'),
(26, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-21 01:46:49', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-21 01:46:49', '2021-03-21 01:46:49'),
(27, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-21 06:10:04', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-21 06:10:04', '2021-03-21 06:10:04'),
(28, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 05:30:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-22 05:30:15', '2021-03-22 05:30:15'),
(30, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-23 00:03:36', NULL, NULL, NULL, NULL, '2021-03-23 22:55:01', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 00:03:36', '2021-03-23 22:55:01'),
(31, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-23 00:15:52', NULL, NULL, NULL, NULL, '2021-03-23 00:40:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 00:15:52', '2021-03-23 00:40:08'),
(32, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-03-23 00:18:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 00:18:03', '2021-03-23 00:18:03'),
(33, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-23 00:23:43', NULL, NULL, NULL, NULL, '2021-03-23 00:40:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 00:23:43', '2021-03-23 00:40:18'),
(34, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-23 00:28:11', NULL, NULL, NULL, NULL, '2021-03-23 00:40:21', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 00:28:11', '2021-03-23 00:40:21'),
(35, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'temp', 'unpaid', '410.00', '0.00', 2, NULL, '2021-03-23 06:07:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 06:07:01', '2021-03-23 06:07:01'),
(36, 1, 33, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '40.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:01:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 22:01:15', '2021-03-23 22:01:15'),
(37, 1, 33, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:04:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 22:04:40', '2021-03-23 22:04:40'),
(38, 1, 33, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '40.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:10:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 22:10:28', '2021-03-23 22:10:28'),
(39, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-03-23 22:34:09', NULL, NULL, NULL, NULL, '2021-03-23 22:55:05', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 22:34:09', '2021-03-23 22:55:05'),
(41, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'deposit', 'delivered', 'paid', '1000.00', '0.00', 2, NULL, '2021-03-23 22:59:38', NULL, NULL, NULL, NULL, '2021-03-23 23:13:48', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 22:59:38', '2021-03-23 23:13:48'),
(42, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 23:33:18', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 23:33:18', '2021-03-23 23:33:18'),
(43, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 06:48:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-24 06:48:22', '2021-03-24 06:48:22'),
(44, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '100.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 06:57:13', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-24 06:57:13', '2021-03-24 06:57:13'),
(45, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '100.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 07:17:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-24 07:17:08', '2021-03-24 07:17:08'),
(46, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 23:17:36', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-24 23:17:36', '2021-03-24 23:17:36'),
(47, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-25 01:33:19', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-25 01:33:19', '2021-03-25 01:33:19'),
(48, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '100.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-25 01:35:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-25 01:35:58', '2021-03-25 01:35:58'),
(49, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '12.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:37:00', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-25 03:37:00', '2021-03-25 03:37:00'),
(50, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-27 22:34:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-27 22:34:59', '2021-03-27 22:34:59'),
(51, 1, 33, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '50.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 08:19:05', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 08:19:05', '2021-03-31 08:19:05'),
(52, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 08:54:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 08:54:29', '2021-03-31 08:54:29'),
(53, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:41:09', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 10:41:09', '2021-03-31 10:41:09'),
(54, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:46:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 10:46:43', '2021-03-31 10:46:43'),
(55, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:54:33', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 10:54:33', '2021-03-31 10:54:33'),
(56, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:57:02', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 10:57:02', '2021-03-31 10:57:02'),
(57, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:58:22', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 10:58:22', '2021-03-31 10:58:22'),
(58, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:58:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 10:58:55', '2021-03-31 10:58:55'),
(59, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:00:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 11:00:10', '2021-03-31 11:00:10'),
(60, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:02:01', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 11:02:01', '2021-03-31 11:02:01'),
(61, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:02:43', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 11:02:43', '2021-03-31 11:02:43'),
(62, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:04:55', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 11:04:55', '2021-03-31 11:04:55'),
(63, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:05:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 11:05:39', '2021-03-31 11:05:39'),
(64, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:06:12', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 11:06:12', '2021-03-31 11:06:12'),
(65, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:06:56', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-31 11:06:56', '2021-03-31 11:06:56'),
(66, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '24.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-12 22:30:56', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-12 22:30:56', '2021-04-12 22:30:56'),
(67, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-18 14:52:17', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-18 14:52:17', '2021-04-18 14:52:17'),
(68, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-20 02:02:58', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-20 02:02:58', '2021-04-20 02:02:58'),
(69, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-30 00:00:44', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-30 00:00:44', '2021-04-30 00:00:44'),
(70, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-30 00:03:09', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-30 00:03:09', '2021-04-30 00:03:09'),
(71, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-30 00:04:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-30 00:04:29', '2021-04-30 00:04:29'),
(72, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-29 00:56:23', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-06-29 00:56:23', '2021-06-29 00:56:23'),
(73, 1, 32, 2, 'MK. Masud', '01918515567', NULL, 'job_post', 'delivered', 'paid', '3.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-29 02:20:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-06-29 02:20:28', '2021-06-29 02:20:28'),
(74, 1, 77, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '1000.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-31 07:58:31', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-07-31 07:58:31', '2021-07-31 07:58:31'),
(75, 1, 77, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-31 08:05:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-07-31 08:05:50', '2021-07-31 08:05:50'),
(76, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-07 22:15:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-07 22:15:26', '2021-08-07 22:15:26'),
(77, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '24.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-07 22:32:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-07 22:32:39', '2021-08-07 22:32:39'),
(78, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '100.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-09 03:37:39', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-09 03:37:39', '2021-08-09 03:37:39'),
(79, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '100.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-09 06:34:08', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-09 06:34:08', '2021-08-09 06:34:08'),
(80, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '100.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 05:12:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-11 05:12:35', '2021-08-11 05:12:35'),
(81, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '40.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 08:13:53', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-11 08:13:53', '2021-08-11 08:13:53'),
(82, 1, 77, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 08:22:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-11 08:22:20', '2021-08-11 08:22:20'),
(83, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '50.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-12 10:52:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-12 10:52:27', '2021-08-12 10:52:27'),
(84, 1, 42, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '10.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-14 04:51:36', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-14 04:51:36', '2021-08-14 04:51:36'),
(85, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-15 22:55:03', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-15 22:55:03', '2021-08-15 22:55:03'),
(86, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '30.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-15 23:04:29', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-15 23:04:29', '2021-08-15 23:04:29'),
(87, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '50.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-15 23:35:04', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-15 23:35:04', '2021-08-15 23:35:04'),
(88, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-16 04:49:10', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-16 04:49:10', '2021-08-16 04:49:10'),
(89, 1, 91, 78, 'Sormila', '+8801851565656', NULL, 'job_post', 'delivered', 'paid', '20.00', '0.00', 78, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-20 06:12:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-20 06:12:20', '2021-08-20 06:12:20'),
(90, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '200.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-27 18:55:15', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-27 18:55:15', '2021-08-27 18:55:15'),
(91, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '40.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-27 18:56:28', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-27 18:56:28', '2021-08-27 18:56:28'),
(92, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'delivered', 'paid', '200.00', '0.00', 2, NULL, '2021-09-06 04:42:52', NULL, NULL, NULL, NULL, '2021-09-06 04:43:24', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-09-06 04:42:52', '2021-09-06 04:43:24'),
(93, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'delivered', 'paid', '100.00', '0.00', 2, NULL, '2021-09-13 03:14:40', NULL, NULL, NULL, NULL, '2021-09-13 03:23:51', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-09-13 03:14:40', '2021-09-13 03:23:51'),
(94, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-09-13 03:15:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-09-13 03:15:53', '2021-09-13 03:15:53'),
(95, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-09-29 05:40:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-09-29 05:40:22', '2021-09-29 05:40:22'),
(96, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-10-24 04:29:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-10-24 04:29:40', '2021-10-24 04:29:40'),
(97, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-11-01 00:29:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-01 00:29:22', '2021-11-01 00:29:22'),
(98, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '1200.00', '0.00', 2, NULL, '2021-11-01 00:30:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-01 00:30:01', '2021-11-01 00:30:01'),
(99, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-11-03 08:04:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:04:28', '2021-11-03 08:04:28'),
(100, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-11-03 08:15:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:15:32', '2021-11-03 08:15:32'),
(101, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-11-03 08:17:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:17:38', '2021-11-03 08:17:38'),
(102, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-11-03 08:18:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:18:00', '2021-11-03 08:18:00'),
(103, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '20.00', '0.00', 2, NULL, '2021-11-03 08:18:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:18:22', '2021-11-03 08:18:22'),
(104, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-11-03 08:20:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:20:06', '2021-11-03 08:20:06'),
(105, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-11-03 08:20:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:20:27', '2021-11-03 08:20:27'),
(106, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-11-03 08:23:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:23:22', '2021-11-03 08:23:22'),
(107, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'nagad', 'nagad', 'unpaid', '10.00', '0.00', NULL, NULL, '2021-11-03 14:23:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Na000107', NULL, NULL, 0, '2021-11-03 14:23:24', '2021-11-03 14:23:24'),
(108, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-11-03 08:23:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:23:36', '2021-11-03 08:23:36'),
(109, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'nagad', 'nagad', 'unpaid', '10.00', '0.00', NULL, NULL, '2021-11-03 14:23:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Na000109', NULL, NULL, 0, '2021-11-03 14:23:38', '2021-11-03 14:23:38'),
(110, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '40001.00', '0.00', 2, NULL, '2021-11-03 08:33:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:33:33', '2021-11-03 08:33:33'),
(111, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'nagad', 'nagad', 'unpaid', '40001.00', '0.00', NULL, NULL, '2021-11-03 14:33:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Na000111', NULL, NULL, 0, '2021-11-03 14:33:35', '2021-11-03 14:33:35'),
(112, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-11-03 08:36:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:36:27', '2021-11-03 08:36:27'),
(113, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'nagad', 'nagad', 'unpaid', '100.00', '0.00', NULL, NULL, '2021-11-03 14:36:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Na000113', NULL, NULL, 0, '2021-11-03 14:36:41', '2021-11-03 14:36:41'),
(114, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'nagad', 'nagad', 'unpaid', '40001.00', '0.00', NULL, NULL, '2021-11-03 14:47:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Na000114', NULL, NULL, 0, '2021-11-03 14:47:04', '2021-11-03 14:47:04'),
(115, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'nagad', 'nagad', 'unpaid', '40001.00', '0.00', NULL, NULL, '2021-11-03 14:47:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Na000115', NULL, NULL, 0, '2021-11-03 14:47:04', '2021-11-03 14:47:04'),
(116, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'nagad', 'nagad', 'unpaid', '40001.00', '0.00', NULL, NULL, '2021-11-03 14:47:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Na000116', NULL, NULL, 0, '2021-11-03 14:47:05', '2021-11-03 14:47:05'),
(117, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '1000.00', '0.00', 2, NULL, '2021-11-03 08:47:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:47:34', '2021-11-03 08:47:34'),
(118, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'nagad', 'nagad', 'unpaid', '1000.00', '0.00', NULL, NULL, '2021-11-03 14:47:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Na000118', NULL, NULL, 0, '2021-11-03 14:47:40', '2021-11-03 14:47:40'),
(119, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10000.00', '0.00', 2, NULL, '2021-11-03 08:48:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-03 08:48:28', '2021-11-03 08:48:28'),
(120, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-11-10 06:38:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-10 06:38:07', '2021-11-10 06:38:07'),
(121, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'nagad', 'nagad', 'unpaid', '100.00', '0.00', NULL, NULL, '2021-11-10 12:38:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Na000121', NULL, NULL, 0, '2021-11-10 12:38:10', '2021-11-10 12:38:10'),
(122, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-11-15 03:07:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-11-15 03:07:59', '2021-11-15 03:07:59'),
(123, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'job_post', 'delivered', 'paid', '12.00', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-01 03:58:02', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-01 03:58:02', '2021-12-01 03:58:02'),
(124, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-15 02:06:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-15 02:06:58', '2021-12-15 02:06:58'),
(125, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-15 02:07:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-15 02:07:44', '2021-12-15 02:07:44'),
(126, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-12-15 02:07:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-15 02:07:51', '2021-12-15 02:07:51'),
(127, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-12-15 02:10:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-15 02:10:50', '2021-12-15 02:10:50'),
(128, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-12-15 02:11:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-15 02:11:49', '2021-12-15 02:11:49'),
(129, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-12-15 02:14:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-15 02:14:01', '2021-12-15 02:14:01'),
(130, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '10.00', '0.00', 2, NULL, '2021-12-15 02:26:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-15 02:26:29', '2021-12-15 02:26:29'),
(131, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-15 02:26:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-15 02:26:39', '2021-12-15 02:26:39'),
(132, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-15 02:33:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-15 02:33:44', '2021-12-15 02:33:44'),
(133, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-15 02:42:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-15 02:42:57', '2021-12-15 02:42:57'),
(134, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-15 02:44:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-15 02:44:24', '2021-12-15 02:44:24'),
(135, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-19 07:41:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-19 07:41:50', '2021-12-19 07:41:50'),
(136, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-19 07:44:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-19 07:44:39', '2021-12-19 07:44:39'),
(137, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-19 07:45:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-19 07:45:43', '2021-12-19 07:45:43'),
(138, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-19 07:46:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-19 07:46:41', '2021-12-19 07:46:41'),
(139, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-19 07:46:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-19 07:46:48', '2021-12-19 07:46:48'),
(140, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-19 07:49:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-19 07:49:12', '2021-12-19 07:49:12'),
(141, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-19 07:49:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-19 07:49:39', '2021-12-19 07:49:39'),
(142, NULL, NULL, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', NULL, NULL, '2021-12-19 07:50:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SC46490211219', NULL, NULL, 100, '2021-12-19 07:50:50', '2021-12-19 07:50:50'),
(143, 1, 32, 2, 'MK. Masud', '+8801918515567', NULL, 'deposit', 'temp', 'unpaid', '100.00', '0.00', 2, NULL, '2021-12-20 04:23:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-12-20 04:23:42', '2021-12-20 04:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `work_station_id` int(11) DEFAULT NULL,
  `subscriber_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `itemable_id` bigint(20) DEFAULT NULL,
  `itemable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_description` text COLLATE utf8mb4_unicode_ci,
  `final_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pending_at` timestamp NULL DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `processing_at` timestamp NULL DEFAULT NULL,
  `ready_to_ship_at` timestamp NULL DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `returned_at` timestamp NULL DEFAULT NULL,
  `undelivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `work_station_id`, `subscriber_id`, `user_id`, `order_status`, `itemable_id`, `itemable_type`, `extra_description`, `final_price`, `addedby_id`, `editedby_id`, `pending_at`, `confirmed_at`, `processing_at`, `ready_to_ship_at`, `shipped_at`, `delivered_at`, `cancelled_at`, `returned_at`, `undelivered_at`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 32, 2, 'delivered', 5, 'App/Models/Order', '', '60.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-10 04:24:25', NULL, NULL, NULL, '2021-03-10 04:24:25', '2021-03-10 04:24:25'),
(3, 7, 1, 32, 2, 'delivered', 7, 'App/Models/Order', '', '31.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-10 04:53:34', NULL, NULL, NULL, '2021-03-10 04:53:34', '2021-03-10 04:53:34'),
(4, 8, 1, 32, 2, 'delivered', 10, 'App/Models/FreelancerJob', NULL, '1000.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-11 02:12:16', NULL, NULL, NULL, '2021-03-11 02:12:16', '2021-03-11 02:12:16'),
(5, 9, 1, 32, 2, 'delivered', 11, 'App/Models/FreelancerJob', NULL, '50.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-11 02:14:59', NULL, NULL, NULL, '2021-03-11 02:14:59', '2021-03-11 02:14:59'),
(6, 10, 1, 32, 2, 'delivered', 12, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-11 05:13:03', NULL, NULL, NULL, '2021-03-11 05:13:03', '2021-03-11 05:13:03'),
(7, 11, 1, 32, 2, 'delivered', 13, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-11 07:35:21', NULL, NULL, NULL, '2021-03-11 07:35:21', '2021-03-11 07:35:21'),
(8, 6, 1, 32, 2, 'delivered', 13, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-14 03:24:06', NULL, NULL, NULL, '2021-03-14 03:24:06', '2021-03-14 03:24:06'),
(9, 7, 1, 32, 2, 'delivered', 10, 'App/Models/FreelancerJob', NULL, '800.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-14 03:32:31', NULL, NULL, NULL, '2021-03-14 03:32:31', '2021-03-14 03:32:31'),
(10, 8, 1, 32, 2, 'delivered', 10, 'App/Models/FreelancerJob', NULL, '16.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-14 03:33:10', NULL, NULL, NULL, '2021-03-14 03:33:10', '2021-03-14 03:33:10'),
(11, 9, 1, 32, 2, 'delivered', 14, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-14 08:03:42', NULL, NULL, NULL, '2021-03-14 08:03:42', '2021-03-14 08:03:42'),
(12, 10, 1, 32, 2, 'delivered', 15, 'App/Models/FreelancerJob', NULL, '110.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-14 08:16:18', NULL, NULL, NULL, '2021-03-14 08:16:18', '2021-03-14 08:16:18'),
(13, 18, 1, 32, 2, 'delivered', 16, 'App/Models/FreelancerJob', NULL, '120.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 05:00:30', NULL, NULL, NULL, '2021-03-15 05:00:30', '2021-03-15 05:00:30'),
(14, 19, 1, 32, 2, 'delivered', 17, 'App/Models/FreelancerJob', NULL, '120.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 05:00:59', NULL, NULL, NULL, '2021-03-15 05:00:59', '2021-03-15 05:00:59'),
(15, 20, 1, 32, 2, 'delivered', 18, 'App/Models/FreelancerJob', NULL, '30.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 05:01:47', NULL, NULL, NULL, '2021-03-15 05:01:47', '2021-03-15 05:01:47'),
(16, 24, 1, 32, 2, 'delivered', 19, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-16 08:15:00', NULL, NULL, NULL, '2021-03-16 08:15:00', '2021-03-16 08:15:00'),
(17, 25, 1, 32, 2, 'delivered', 20, 'App/Models/FreelancerJob', NULL, '100.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-21 01:38:52', NULL, NULL, NULL, '2021-03-21 01:38:52', '2021-03-21 01:38:52'),
(18, 26, 1, 32, 2, 'delivered', 21, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-21 01:46:49', NULL, NULL, NULL, '2021-03-21 01:46:49', '2021-03-21 01:46:49'),
(19, 27, 1, 32, 2, 'delivered', 22, 'App/Models/FreelancerJob', NULL, '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-21 06:10:04', NULL, NULL, NULL, '2021-03-21 06:10:04', '2021-03-21 06:10:04'),
(20, 28, 1, 32, 2, 'delivered', 23, 'App/Models/FreelancerJob', NULL, '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-22 05:30:15', NULL, NULL, NULL, '2021-03-22 05:30:15', '2021-03-22 05:30:15'),
(21, 36, 1, 33, 2, 'delivered', 24, 'App/Models/FreelancerJob', NULL, '40.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:01:15', NULL, NULL, NULL, '2021-03-23 22:01:15', '2021-03-23 22:01:15'),
(22, 37, 1, 33, 2, 'delivered', 25, 'App/Models/FreelancerJob', NULL, '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:04:40', NULL, NULL, NULL, '2021-03-23 22:04:40', '2021-03-23 22:04:40'),
(23, 38, 1, 33, 2, 'delivered', 26, 'App/Models/FreelancerJob', NULL, '40.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 22:10:28', NULL, NULL, NULL, '2021-03-23 22:10:28', '2021-03-23 22:10:28'),
(24, 42, 1, 32, 2, 'delivered', 27, 'App/Models/FreelancerJob', NULL, '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-23 23:33:18', NULL, NULL, NULL, '2021-03-23 23:33:18', '2021-03-23 23:33:18'),
(25, 43, 1, 32, 2, 'delivered', 28, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 06:48:22', NULL, NULL, NULL, '2021-03-24 06:48:22', '2021-03-24 06:48:22'),
(26, 44, 1, 32, 2, 'delivered', 29, 'App/Models/FreelancerJob', NULL, '100.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 06:57:14', NULL, NULL, NULL, '2021-03-24 06:57:14', '2021-03-24 06:57:14'),
(27, 45, 1, 32, 2, 'delivered', 30, 'App/Models/FreelancerJob', NULL, '100.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 07:17:08', NULL, NULL, NULL, '2021-03-24 07:17:08', '2021-03-24 07:17:08'),
(28, 46, 1, 32, 2, 'delivered', 31, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-24 23:17:36', NULL, NULL, NULL, '2021-03-24 23:17:36', '2021-03-24 23:17:36'),
(29, 47, 1, 32, 2, 'delivered', 32, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-25 01:33:19', NULL, NULL, NULL, '2021-03-25 01:33:19', '2021-03-25 01:33:19'),
(30, 48, 1, 32, 2, 'delivered', 33, 'App/Models/FreelancerJob', NULL, '100.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-25 01:35:58', NULL, NULL, NULL, '2021-03-25 01:35:58', '2021-03-25 01:35:58'),
(31, 49, 1, 32, 2, 'delivered', 34, 'App/Models/FreelancerJob', NULL, '12.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-25 03:37:00', NULL, NULL, NULL, '2021-03-25 03:37:00', '2021-03-25 03:37:00'),
(32, 50, 1, 32, 2, 'delivered', 35, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-27 22:34:59', NULL, NULL, NULL, '2021-03-27 22:34:59', '2021-03-27 22:34:59'),
(33, 51, 1, 33, 2, 'delivered', 36, 'App/Models/FreelancerJob', NULL, '50.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 08:19:05', NULL, NULL, NULL, '2021-03-31 08:19:05', '2021-03-31 08:19:05'),
(34, 52, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 08:54:29', NULL, NULL, NULL, '2021-03-31 08:54:29', '2021-03-31 08:54:29'),
(35, 53, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:41:09', NULL, NULL, NULL, '2021-03-31 10:41:09', '2021-03-31 10:41:09'),
(36, 54, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:46:43', NULL, NULL, NULL, '2021-03-31 10:46:43', '2021-03-31 10:46:43'),
(37, 55, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:54:33', NULL, NULL, NULL, '2021-03-31 10:54:33', '2021-03-31 10:54:33'),
(38, 56, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:57:02', NULL, NULL, NULL, '2021-03-31 10:57:02', '2021-03-31 10:57:02'),
(39, 57, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:58:22', NULL, NULL, NULL, '2021-03-31 10:58:22', '2021-03-31 10:58:22'),
(40, 58, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 10:58:55', NULL, NULL, NULL, '2021-03-31 10:58:55', '2021-03-31 10:58:55'),
(41, 59, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:00:10', NULL, NULL, NULL, '2021-03-31 11:00:10', '2021-03-31 11:00:10'),
(42, 60, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:02:01', NULL, NULL, NULL, '2021-03-31 11:02:01', '2021-03-31 11:02:01'),
(43, 61, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:02:43', NULL, NULL, NULL, '2021-03-31 11:02:43', '2021-03-31 11:02:43'),
(44, 62, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:04:55', NULL, NULL, NULL, '2021-03-31 11:04:55', '2021-03-31 11:04:55'),
(45, 63, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:05:39', NULL, NULL, NULL, '2021-03-31 11:05:39', '2021-03-31 11:05:39'),
(46, 64, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:06:12', NULL, NULL, NULL, '2021-03-31 11:06:12', '2021-03-31 11:06:12'),
(47, 65, 1, 32, 2, 'delivered', 37, 'App/Models/FreelancerJob', 'Extra job worker added', '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 11:06:56', NULL, NULL, NULL, '2021-03-31 11:06:56', '2021-03-31 11:06:56'),
(48, 66, 1, 32, 2, 'delivered', 38, 'App/Models/FreelancerJob', NULL, '24.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-12 22:30:56', NULL, NULL, NULL, '2021-04-12 22:30:56', '2021-04-12 22:30:56'),
(49, 67, 1, 32, 2, 'delivered', 39, 'App/Models/FreelancerJob', NULL, '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-18 14:52:17', NULL, NULL, NULL, '2021-04-18 14:52:17', '2021-04-18 14:52:17'),
(50, 68, 1, 32, 2, 'delivered', 40, 'App/Models/FreelancerJob', NULL, '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-20 02:02:58', NULL, NULL, NULL, '2021-04-20 02:02:58', '2021-04-20 02:02:58'),
(51, 69, 1, 32, 2, 'delivered', 41, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-30 00:00:45', NULL, NULL, NULL, '2021-04-30 00:00:45', '2021-04-30 00:00:45'),
(52, 70, 1, 32, 2, 'delivered', 42, 'App/Models/FreelancerJob', NULL, '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-30 00:03:09', NULL, NULL, NULL, '2021-04-30 00:03:09', '2021-04-30 00:03:09'),
(53, 71, 1, 32, 2, 'delivered', 43, 'App/Models/FreelancerJob', NULL, '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-30 00:04:29', NULL, NULL, NULL, '2021-04-30 00:04:29', '2021-04-30 00:04:29'),
(54, 72, 1, 32, 2, 'delivered', 44, 'App/Models/FreelancerJob', NULL, '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-29 00:56:23', NULL, NULL, NULL, '2021-06-29 00:56:23', '2021-06-29 00:56:23'),
(55, 73, 1, 32, 2, 'delivered', 45, 'App/Models/FreelancerJob', NULL, '3.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-29 02:20:28', NULL, NULL, NULL, '2021-06-29 02:20:28', '2021-06-29 02:20:28'),
(56, 74, 1, 77, 2, 'delivered', 46, 'App/Models/FreelancerJob', NULL, '1000.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-31 07:58:32', NULL, NULL, NULL, '2021-07-31 07:58:32', '2021-07-31 07:58:32'),
(57, 75, 1, 77, 2, 'delivered', 47, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-31 08:05:50', NULL, NULL, NULL, '2021-07-31 08:05:50', '2021-07-31 08:05:50'),
(58, 76, 1, 32, 2, 'delivered', 48, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-07 22:15:26', NULL, NULL, NULL, '2021-08-07 22:15:26', '2021-08-07 22:15:26'),
(59, 77, 1, 32, 2, 'delivered', 49, 'App/Models/FreelancerJob', NULL, '24.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-07 22:32:39', NULL, NULL, NULL, '2021-08-07 22:32:39', '2021-08-07 22:32:39'),
(60, 78, 1, 32, 2, 'delivered', 50, 'App/Models/FreelancerJob', NULL, '100.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-09 03:37:39', NULL, NULL, NULL, '2021-08-09 03:37:39', '2021-08-09 03:37:39'),
(61, 79, 1, 32, 2, 'delivered', 51, 'App/Models/FreelancerJob', NULL, '100.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-09 06:34:08', NULL, NULL, NULL, '2021-08-09 06:34:08', '2021-08-09 06:34:08'),
(62, 80, 1, 32, 2, 'delivered', 52, 'App/Models/FreelancerJob', NULL, '100.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 05:12:35', NULL, NULL, NULL, '2021-08-11 05:12:35', '2021-08-11 05:12:35'),
(63, 81, 1, 32, 2, 'delivered', 53, 'App/Models/FreelancerJob', NULL, '40.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 08:13:53', NULL, NULL, NULL, '2021-08-11 08:13:53', '2021-08-11 08:13:53'),
(64, 82, 1, 77, 2, 'delivered', 54, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-11 08:22:20', NULL, NULL, NULL, '2021-08-11 08:22:20', '2021-08-11 08:22:20'),
(65, 83, 1, 32, 2, 'delivered', 55, 'App/Models/FreelancerJob', NULL, '50.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-12 10:52:27', NULL, NULL, NULL, '2021-08-12 10:52:27', '2021-08-12 10:52:27'),
(66, 84, 1, 42, 2, 'delivered', 56, 'App/Models/FreelancerJob', NULL, '10.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-14 04:51:36', NULL, NULL, NULL, '2021-08-14 04:51:36', '2021-08-14 04:51:36'),
(67, 85, 1, 32, 2, 'delivered', 57, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-15 22:55:03', NULL, NULL, NULL, '2021-08-15 22:55:03', '2021-08-15 22:55:03'),
(68, 86, 1, 32, 2, 'delivered', 58, 'App/Models/FreelancerJob', NULL, '30.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-15 23:04:29', NULL, NULL, NULL, '2021-08-15 23:04:29', '2021-08-15 23:04:29'),
(69, 87, 1, 32, 2, 'delivered', 59, 'App/Models/FreelancerJob', NULL, '50.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-15 23:35:04', NULL, NULL, NULL, '2021-08-15 23:35:04', '2021-08-15 23:35:04'),
(70, 88, 1, 32, 2, 'delivered', 60, 'App/Models/FreelancerJob', NULL, '20.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-16 04:49:10', NULL, NULL, NULL, '2021-08-16 04:49:10', '2021-08-16 04:49:10'),
(71, 89, 1, 91, 78, 'delivered', 61, 'App/Models/FreelancerJob', NULL, '20.00', 78, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-20 06:12:20', NULL, NULL, NULL, '2021-08-20 06:12:20', '2021-08-20 06:12:20'),
(72, 90, 1, 32, 2, 'delivered', 62, 'App/Models/FreelancerJob', NULL, '200.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-27 18:55:15', NULL, NULL, NULL, '2021-08-27 18:55:15', '2021-08-27 18:55:15'),
(73, 91, 1, 32, 2, 'delivered', 63, 'App/Models/FreelancerJob', NULL, '40.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-27 18:56:28', NULL, NULL, NULL, '2021-08-27 18:56:28', '2021-08-27 18:56:28'),
(74, 123, 1, 32, 2, 'delivered', 64, 'App/Models/FreelancerJob', NULL, '12.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-01 03:58:02', NULL, NULL, NULL, '2021-12-01 03:58:02', '2021-12-01 03:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

CREATE TABLE `order_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `work_station_id` int(11) DEFAULT NULL,
  `subscriber_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trans_date` date DEFAULT NULL,
  `payment_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `receivedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_payments`
--

INSERT INTO `order_payments` (`id`, `order_id`, `work_station_id`, `subscriber_id`, `user_id`, `trans_date`, `payment_by`, `payment_type`, `payment_status`, `bank_name`, `account_number`, `cheque_number`, `sender`, `note`, `paid_amount`, `receivedby_id`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 32, 2, '2021-03-14', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '123456', '100.00', NULL, 2, NULL, '2021-03-14 00:36:55', '2021-03-14 00:37:05'),
(3, 3, 1, 32, 2, '2021-03-14', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '123456', '500.00', NULL, 2, NULL, '2021-03-14 00:38:43', '2021-03-14 00:41:09'),
(4, 4, 1, 32, 2, '2021-03-14', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '123', '100.00', NULL, 2, NULL, '2021-03-14 00:41:23', '2021-03-14 00:57:13'),
(5, 6, 1, 32, 2, '2021-03-14', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '20.00', NULL, 2, NULL, '2021-03-14 03:24:06', '2021-03-14 03:24:06'),
(6, 7, 1, 32, 2, '2021-03-14', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '800.00', NULL, 2, NULL, '2021-03-14 03:32:31', '2021-03-14 03:32:31'),
(7, 8, 1, 32, 2, '2021-03-14', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '16.00', NULL, 2, NULL, '2021-03-14 03:33:10', '2021-03-14 03:33:10'),
(8, 9, 1, 32, 2, '2021-03-14', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '20.00', NULL, 2, NULL, '2021-03-14 08:03:42', '2021-03-14 08:03:42'),
(9, 10, 1, 32, 2, '2021-03-14', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '110.00', NULL, 2, NULL, '2021-03-14 08:16:18', '2021-03-14 08:16:18'),
(10, 11, 1, 32, 2, '2021-03-15', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '123', '100.00', NULL, 2, NULL, '2021-03-15 02:41:08', '2021-03-15 02:41:28'),
(11, 12, 1, 32, 2, '2021-03-15', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '123', '100.00', NULL, 2, NULL, '2021-03-15 02:51:24', '2021-03-15 02:51:50'),
(12, 13, 1, 32, 2, '2021-03-15', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '123', '100.00', NULL, 2, NULL, '2021-03-15 03:44:29', '2021-03-15 03:45:55'),
(13, 14, 1, 32, 2, '2021-03-15', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '123', '150.00', NULL, 2, NULL, '2021-03-15 03:44:56', '2021-03-15 03:45:30'),
(14, 15, 1, 32, 2, '2021-03-15', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '55', '500.00', NULL, 2, NULL, '2021-03-15 03:45:16', '2021-03-15 03:45:24'),
(15, 16, 1, 32, 2, '2021-03-15', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '123', '400.00', NULL, 2, NULL, '2021-03-15 03:47:41', '2021-03-15 03:48:28'),
(16, 17, 1, 32, 2, '2021-03-15', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '123', '300.00', NULL, 2, NULL, '2021-03-15 03:48:11', '2021-03-15 03:48:21'),
(17, 18, 1, 32, 2, '2021-03-15', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '120.00', NULL, 2, NULL, '2021-03-15 05:00:30', '2021-03-15 05:00:30'),
(18, 19, 1, 32, 2, '2021-03-15', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '120.00', NULL, 2, NULL, '2021-03-15 05:00:59', '2021-03-15 05:00:59'),
(19, 20, 1, 32, 2, '2021-03-15', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '30.00', NULL, 2, NULL, '2021-03-15 05:01:47', '2021-03-15 05:01:47'),
(20, 21, 1, 32, 2, '2021-03-16', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '123', '100.00', NULL, 2, NULL, '2021-03-16 06:52:32', '2021-03-16 06:52:54'),
(21, 23, 1, 32, 2, '2021-03-16', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '', '123', '200.00', NULL, 2, NULL, '2021-03-16 06:54:08', '2021-03-16 06:54:25'),
(22, 24, 1, 32, 2, '2021-03-16', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '20.00', NULL, 2, NULL, '2021-03-16 08:15:00', '2021-03-16 08:15:00'),
(23, 25, 1, 32, 2, '2021-03-21', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '100.00', NULL, 2, NULL, '2021-03-21 01:38:52', '2021-03-21 01:38:52'),
(24, 26, 1, 32, 2, '2021-03-21', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '20.00', NULL, 2, NULL, '2021-03-21 01:46:49', '2021-03-21 01:46:49'),
(25, 27, 1, 32, 2, '2021-03-21', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '10.00', NULL, 2, NULL, '2021-03-21 06:10:04', '2021-03-21 06:10:04'),
(26, 28, 1, 32, 2, '2021-03-22', 'balance', NULL, 'completed', NULL, NULL, NULL, '', '', '10.00', NULL, 2, NULL, '2021-03-22 05:30:15', '2021-03-22 05:30:15'),
(27, 30, 1, 32, 2, '2021-03-23', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '01918515567', '123', '100.00', NULL, 2, NULL, '2021-03-23 00:04:01', '2021-03-23 22:55:01'),
(28, 31, 1, 32, 2, '2021-03-23', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '01518643843', '123', '100.00', NULL, 2, NULL, '2021-03-23 00:16:15', '2021-03-23 00:40:08'),
(29, 33, 1, 32, 2, '2021-03-23', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '01518436843', '123456', '100.00', NULL, 2, NULL, '2021-03-23 00:23:54', '2021-03-23 00:40:18'),
(30, 34, 1, 32, 2, '2021-03-23', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '01518463843', '04gfd25669', '100.00', NULL, 2, NULL, '2021-03-23 00:33:53', '2021-03-23 00:40:21'),
(31, 37, 1, 33, 2, '2021-03-24', 'balance', NULL, 'completed', NULL, NULL, NULL, NULL, '', '10.00', NULL, 2, NULL, '2021-03-23 22:04:40', '2021-03-23 22:04:40'),
(32, 38, 1, 33, 2, '2021-03-24', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '40.00', NULL, 2, NULL, '2021-03-23 22:10:28', '2021-03-23 22:10:28'),
(33, 39, 1, 32, 2, '2021-03-24', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '01918515123', '123456', '100.00', NULL, 2, NULL, '2021-03-23 22:34:25', '2021-03-23 22:55:05'),
(35, 41, 1, 32, 2, '2021-03-24', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, '01818643843', 'eft099u', '1000.00', NULL, 2, NULL, '2021-03-23 23:05:53', '2021-03-23 23:13:48'),
(36, 42, 1, 32, 2, '2021-03-24', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-03-23 23:33:18', '2021-03-23 23:33:18'),
(37, 43, 1, 32, 2, '2021-03-24', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '20.00', NULL, 2, NULL, '2021-03-24 06:48:22', '2021-03-24 06:48:22'),
(38, 44, 1, 32, 2, '2021-03-24', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '100.00', NULL, 2, NULL, '2021-03-24 06:57:14', '2021-03-24 06:57:14'),
(39, 45, 1, 32, 2, '2021-03-24', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '100.00', NULL, 2, NULL, '2021-03-24 07:17:08', '2021-03-24 07:17:08'),
(40, 46, 1, 32, 2, '2021-03-25', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '20.00', NULL, 2, NULL, '2021-03-24 23:17:36', '2021-03-24 23:17:36'),
(41, 47, 1, 32, 2, '2021-03-25', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '20.00', NULL, 2, NULL, '2021-03-25 01:33:19', '2021-03-25 01:33:19'),
(42, 48, 1, 32, 2, '2021-03-25', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '100.00', NULL, 2, NULL, '2021-03-25 01:35:58', '2021-03-25 01:35:58'),
(43, 49, 1, 32, 2, '2021-03-25', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '12.00', NULL, 2, NULL, '2021-03-25 03:37:00', '2021-03-25 03:37:00'),
(44, 50, 1, 32, 2, '2021-03-28', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '20.00', NULL, 2, NULL, '2021-03-27 22:34:59', '2021-03-27 22:34:59'),
(45, 51, 1, 33, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '50.00', NULL, 2, NULL, '2021-03-31 08:19:05', '2021-03-31 08:19:05'),
(46, 52, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '20.00', NULL, 2, NULL, '2021-03-31 08:54:29', '2021-03-31 08:54:29'),
(47, 53, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '20.00', NULL, 2, NULL, '2021-03-31 10:41:09', '2021-03-31 10:41:09'),
(48, 54, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '20.00', NULL, 2, NULL, '2021-03-31 10:46:43', '2021-03-31 10:46:43'),
(49, 55, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '20.00', NULL, 2, NULL, '2021-03-31 10:54:33', '2021-03-31 10:54:33'),
(50, 56, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-03-31 10:57:02', '2021-03-31 10:57:02'),
(51, 57, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-03-31 10:58:22', '2021-03-31 10:58:22'),
(52, 58, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-03-31 10:58:55', '2021-03-31 10:58:55'),
(53, 59, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-03-31 11:00:10', '2021-03-31 11:00:10'),
(54, 60, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-03-31 11:02:01', '2021-03-31 11:02:01'),
(55, 61, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-03-31 11:02:43', '2021-03-31 11:02:43'),
(56, 62, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-03-31 11:04:55', '2021-03-31 11:04:55'),
(57, 63, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-03-31 11:05:39', '2021-03-31 11:05:39'),
(58, 64, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-03-31 11:06:12', '2021-03-31 11:06:12'),
(59, 65, 1, 32, 2, '2021-03-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-03-31 11:06:56', '2021-03-31 11:06:56'),
(60, 66, 1, 32, 2, '2021-04-13', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '24.00', NULL, 2, NULL, '2021-04-12 22:30:56', '2021-04-12 22:30:56'),
(61, 67, 1, 32, 2, '2021-04-18', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-04-18 14:52:17', '2021-04-18 14:52:17'),
(62, 68, 1, 32, 2, '2021-04-20', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-04-20 02:02:58', '2021-04-20 02:02:58'),
(63, 69, 1, 32, 2, '2021-04-30', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '20.00', NULL, 2, NULL, '2021-04-30 00:00:45', '2021-04-30 00:00:45'),
(64, 70, 1, 32, 2, '2021-04-30', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-04-30 00:03:09', '2021-04-30 00:03:09'),
(65, 71, 1, 32, 2, '2021-04-30', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-04-30 00:04:29', '2021-04-30 00:04:29'),
(66, 72, 1, 32, 2, '2021-06-29', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '10.00', NULL, 2, NULL, '2021-06-29 00:56:23', '2021-06-29 00:56:23'),
(67, 73, 1, 32, 2, '2021-06-29', 'balance', NULL, 'completed', NULL, NULL, NULL, '01918515567', '', '3.00', NULL, 2, NULL, '2021-06-29 02:20:28', '2021-06-29 02:20:28'),
(68, 74, 1, 77, 2, '2021-07-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '1000.00', NULL, 2, NULL, '2021-07-31 07:58:32', '2021-07-31 07:58:32'),
(69, 75, 1, 77, 2, '2021-07-31', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '20.00', NULL, 2, NULL, '2021-07-31 08:05:50', '2021-07-31 08:05:50'),
(70, 76, 1, 32, 2, '2021-08-08', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '20.00', NULL, 2, NULL, '2021-08-07 22:15:26', '2021-08-07 22:15:26'),
(71, 77, 1, 32, 2, '2021-08-08', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '24.00', NULL, 2, NULL, '2021-08-07 22:32:39', '2021-08-07 22:32:39'),
(72, 78, 1, 32, 2, '2021-08-09', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '100.00', NULL, 2, NULL, '2021-08-09 03:37:39', '2021-08-09 03:37:39'),
(73, 79, 1, 32, 2, '2021-08-09', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '100.00', NULL, 2, NULL, '2021-08-09 06:34:08', '2021-08-09 06:34:08'),
(74, 80, 1, 32, 2, '2021-08-11', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '100.00', NULL, 2, NULL, '2021-08-11 05:12:35', '2021-08-11 05:12:35'),
(75, 81, 1, 32, 2, '2021-08-11', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '40.00', NULL, 2, NULL, '2021-08-11 08:13:53', '2021-08-11 08:13:53'),
(76, 82, 1, 77, 2, '2021-08-11', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '20.00', NULL, 2, NULL, '2021-08-11 08:22:20', '2021-08-11 08:22:20'),
(77, 83, 1, 32, 2, '2021-08-12', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '50.00', NULL, 2, NULL, '2021-08-12 10:52:28', '2021-08-12 10:52:28'),
(78, 84, 1, 42, 2, '2021-08-14', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '10.00', NULL, 2, NULL, '2021-08-14 04:51:36', '2021-08-14 04:51:36'),
(79, 85, 1, 32, 2, '2021-08-16', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '20.00', NULL, 2, NULL, '2021-08-15 22:55:03', '2021-08-15 22:55:03'),
(80, 86, 1, 32, 2, '2021-08-16', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '30.00', NULL, 2, NULL, '2021-08-15 23:04:29', '2021-08-15 23:04:29'),
(81, 87, 1, 32, 2, '2021-08-16', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '50.00', NULL, 2, NULL, '2021-08-15 23:35:04', '2021-08-15 23:35:04'),
(82, 88, 1, 32, 2, '2021-08-16', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '20.00', NULL, 2, NULL, '2021-08-16 04:49:10', '2021-08-16 04:49:10'),
(83, 89, 1, 91, 78, '2021-08-20', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801851565656', '', '20.00', NULL, 78, NULL, '2021-08-20 06:12:20', '2021-08-20 06:12:20'),
(84, 90, 1, 32, 2, '2021-08-28', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '200.00', NULL, 2, NULL, '2021-08-27 18:55:15', '2021-08-27 18:55:15'),
(85, 91, 1, 32, 2, '2021-08-28', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '40.00', NULL, 2, NULL, '2021-08-27 18:56:28', '2021-08-27 18:56:28'),
(86, 92, 1, 32, 2, '2021-09-06', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, 'dgfdfg45454', '04gfd25669', '200.00', NULL, 2, NULL, '2021-09-06 04:43:03', '2021-09-06 04:43:24'),
(87, 93, 1, 32, 2, '2021-09-13', 'bkash', 'mobile bank', 'completed', NULL, '01821952907', NULL, 'Voluptatibus quas te', '04gfd25669', '100.00', NULL, 2, NULL, '2021-09-13 03:14:47', '2021-09-13 03:23:51'),
(88, 123, 1, 32, 2, '2021-12-01', 'balance', NULL, 'completed', NULL, NULL, NULL, '+8801918515567', '', '12.00', NULL, 2, NULL, '2021-12-01 03:58:02', '2021-12-01 03:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_works`
--

CREATE TABLE `order_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `workstation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subscriber_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_itemable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_itemable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `job_owner_note` text COLLATE utf8mb4_unicode_ci,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `amount` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `review_expired_at` timestamp NULL DEFAULT NULL,
  `payment_delivered_at` timestamp NULL DEFAULT NULL,
  `addedby_id` bigint(20) UNSIGNED NOT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `drag_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `user_id`, `drag_id`, `thana_id`, `district_id`, `division_id`, `zip_code`, `address`, `name`, `mobile`, `code`, `lat`, `lng`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(3, NULL, NULL, 2, 34, 1, NULL, 'Nostrum consequatur', 'Yuli Turner', 'Explicabo Voluptatu', 'Nulla necessitatibus', NULL, NULL, NULL, NULL, '2021-02-13 23:44:17', '2021-02-13 23:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `drag_id` int(10) UNSIGNED DEFAULT NULL,
  `title_hide` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `list_in_menu` tinyint(1) NOT NULL DEFAULT '0',
  `addedby_id` int(10) UNSIGNED NOT NULL,
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_title`, `route_name`, `content`, `drag_id`, `title_hide`, `active`, `list_in_menu`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 'Contact US', 'contact_u_s', NULL, 2, 0, 1, 1, 1, 2, '2021-02-10 04:44:00', '2021-12-05 06:10:00'),
(2, 'About Us', 'about-us', NULL, 1, 0, 1, 1, 1, 2, '2021-02-22 07:26:04', '2021-12-05 06:10:34'),
(3, 'Terms And Conditions', 'term&condition', NULL, 3, 0, 1, 1, 1, 2, '2021-02-22 07:26:57', '2021-12-05 06:10:00'),
(4, 'Privacy and policy', 'p&_p', NULL, 0, 0, 1, 1, 1, 2, '2021-02-22 07:28:12', '2021-12-05 06:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `page_items`
--

CREATE TABLE `page_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `editor` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `addedby_id` int(10) UNSIGNED NOT NULL,
  `editedby_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_items`
--

INSERT INTO `page_items` (`id`, `page_id`, `title`, `content`, `editor`, `active`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'comming soon', '<p>comming Soon</p>', 1, 1, 2, NULL, '2021-02-22 07:22:19', '2021-02-22 07:22:19'),
(2, 2, 'comming soon', '<p>comming soon</p>', 1, 1, 2, NULL, '2021-02-22 07:26:24', '2021-02-22 07:26:24'),
(3, 3, 'term ansd', '<p>coming soon</p>', 1, 1, 2, NULL, '2021-02-22 07:27:25', '2021-02-22 07:27:25'),
(4, 4, 'Privacy and policy', '<p>coming soon</p>', 1, 1, 2, NULL, '2021-02-22 07:28:49', '2021-02-22 07:28:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscriber_id` bigint(20) UNSIGNED DEFAULT NULL,
  `postable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `postable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `excerpt` json DEFAULT NULL,
  `workstation_id` int(10) UNSIGNED DEFAULT NULL,
  `ws_cat_id` int(10) UNSIGNED DEFAULT NULL,
  `publish_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'temp',
  `read` int(10) UNSIGNED DEFAULT NULL,
  `addedby_id` bigint(20) UNSIGNED NOT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `subscriber_id`, `postable_id`, `postable_type`, `title`, `description`, `excerpt`, `workstation_id`, `ws_cat_id`, `publish_status`, `read`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 'App\\Models\\User', '{\"en\": null}', '{\"en\": \"some info\"}', '{\"en\": null}', 1, 1, 'draft', NULL, 2, NULL, '2021-04-22 12:51:35', '2021-04-22 12:52:17'),
(4, NULL, 2, 'App\\Models\\User', '{\"en\": null}', '{\"en\": \"asdfsadf\\r\\nasdfsadf\"}', '{\"en\": null}', 1, 1, 'published', NULL, 2, NULL, '2021-04-23 22:49:13', '2021-04-23 22:49:13'),
(6, NULL, 2, 'App\\Models\\User', '{\"en\": null}', '{\"en\": \"some text\"}', '{\"en\": null}', 1, 1, 'published', NULL, 2, NULL, '2021-04-25 01:04:52', '2021-04-25 01:04:52'),
(7, NULL, 2, 'App\\Models\\User', '{\"en\": null}', '{\"en\": \"asdfsdaf\"}', '{\"en\": null}', 1, 1, 'published', NULL, 2, NULL, '2021-04-26 14:33:39', '2021-04-26 14:33:39'),
(8, NULL, 2, 'App\\Models\\User', '{\"en\": null}', '{\"en\": \"as\"}', '{\"en\": null}', 2, 4, 'published', NULL, 2, NULL, '2021-04-26 14:35:04', '2021-04-26 14:35:04'),
(9, NULL, 2, 'App\\Models\\User', '{\"en\": null}', '{\"en\": \"asdfsdfasdf\"}', '{\"en\": null}', 2, 4, 'published', NULL, 2, NULL, '2021-04-26 14:35:29', '2021-04-26 14:35:29'),
(10, NULL, 2, 'App\\Models\\User', '{\"en\": null}', '{\"en\": \"saa\"}', '{\"en\": null}', 1, 1, 'published', NULL, 2, NULL, '2021-04-26 14:41:51', '2021-04-26 14:41:51'),
(12, NULL, 2, 'App\\Models\\User', '{\"en\": null}', '{\"en\": \"asdf\\r\\neeeeeee\\r\\nrrrrrrrrrrrrrr\\r\\nttttttttttttttt\"}', '{\"en\": null}', 1, 1, 'published', NULL, 2, NULL, '2021-04-29 23:26:27', '2021-04-29 23:26:27'),
(13, NULL, NULL, 'App\\Models\\User', NULL, NULL, NULL, NULL, NULL, 'temp', NULL, 2, NULL, '2021-04-29 23:26:27', '2021-04-29 23:26:27'),
(14, NULL, 2, 'App\\Models\\User', NULL, NULL, NULL, NULL, NULL, 'temp', NULL, 2, NULL, '2021-04-30 00:14:54', '2021-04-30 00:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `addedby_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `category_id`, `post_id`, `addedby_id`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 2, '2021-11-21 04:06:19', '2021-11-21 04:06:19'),
(2, 3, 8, 2, '2021-11-21 04:06:19', '2021-11-21 04:06:19'),
(11, 2, 10, 2, '2021-11-21 06:19:31', '2021-11-21 06:19:31'),
(12, 2, 11, 2, '2021-11-21 06:23:25', '2021-11-21 06:23:25'),
(16, 2, 13, 2, '2021-11-22 00:27:09', '2021-11-22 00:27:09'),
(17, 3, 14, 2, '2021-11-22 00:37:41', '2021-11-22 00:37:41'),
(18, 1, 17, 121, '2021-11-22 07:43:50', '2021-11-22 07:43:50'),
(19, 2, 17, 121, '2021-11-22 07:43:50', '2021-11-22 07:43:50'),
(21, 1, 12, 2, '2021-11-22 23:37:35', '2021-11-22 23:37:35'),
(22, 3, 12, 2, '2021-11-22 23:37:35', '2021-11-22 23:37:35'),
(24, 2, 18, 2, '2021-11-22 23:42:39', '2021-11-22 23:42:39'),
(25, 3, 18, 2, '2021-11-22 23:42:39', '2021-11-22 23:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `post_files`
--

CREATE TABLE `post_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_mime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` bigint(20) UNSIGNED NOT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` json DEFAULT NULL,
  `excerpt` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `pre_order` tinyint(1) NOT NULL DEFAULT '0',
  `digital` tinyint(1) NOT NULL DEFAULT '0',
  `refundable` tinyint(1) NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `close_date` date DEFAULT NULL,
  `mfg_date` date DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `feature_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `sale_price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `profit` decimal(11,2) NOT NULL DEFAULT '0.00',
  `pv` decimal(11,2) NOT NULL DEFAULT '0.00',
  `unit_weight` decimal(9,2) DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedby_id` bigint(20) UNSIGNED NOT NULL,
  `editedby_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `excerpt`, `description`, `pre_order`, `digital`, `refundable`, `status`, `brand_id`, `publish_date`, `close_date`, `mfg_date`, `exp_date`, `feature_img`, `purchase_price`, `sale_price`, `profit`, `pv`, `unit_weight`, `unit`, `addedby_id`, `editedby_id`, `created_at`, `updated_at`) VALUES


--
--


--
--



--
--


