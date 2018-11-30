-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2018 at 04:07 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wheelsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessrights`
--

CREATE TABLE `accessrights` (
  `AccessID` bigint(20) UNSIGNED NOT NULL,
  `RoleID` int(11) NOT NULL,
  `ActivityID` int(11) NOT NULL,
  `ActivityRights` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accessrights`
--

INSERT INTO `accessrights` (`AccessID`, `RoleID`, `ActivityID`, `ActivityRights`) VALUES
(1, 1, 1, 'C R U D'),
(2, 1, 2, 'C R U D'),
(3, 1, 3, 'C R U D'),
(4, 1, 4, 'C R U D'),
(5, 1, 5, 'C R U D'),
(6, 1, 6, 'C R U D'),
(7, 1, 7, 'C R U D'),
(8, 1, 8, 'C R U D'),
(9, 1, 9, 'C R U D'),
(10, 1, 10, 'C R U D'),
(11, 1, 11, 'C R U D'),
(12, 2, 1, 'C R U D'),
(13, 2, 2, 'C R U D'),
(14, 2, 3, 'C R U D'),
(15, 2, 4, 'C R U D'),
(16, 2, 5, 'C R U D'),
(17, 2, 6, 'C R U D'),
(18, 2, 7, 'C R U D'),
(19, 2, 8, 'C R U D'),
(20, 2, 9, 'C R U D'),
(21, 2, 10, 'C R U D'),
(22, 2, 11, 'C R U D'),
(56, 15, 1, 'R'),
(57, 15, 2, 'R'),
(58, 15, 3, 'C'),
(59, 16, 1, 'C R'),
(60, 16, 2, 'C R U D'),
(61, 16, 3, 'R'),
(62, 17, 1, 'C R'),
(63, 17, 2, 'C R U D'),
(64, 17, 3, 'R');

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `ActivityID` int(11) NOT NULL,
  `ActivityName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`ActivityID`, `ActivityName`) VALUES
(1, 'Activity Logs'),
(2, 'MiniProf Wheel Alarm Settings'),
(3, 'Manual Wheel Warning Settings'),
(4, 'Average Distance Management'),
(5, 'Average Wear Rates Management'),
(6, 'Coach-Axle Serial Number Mapping'),
(7, 'Coach Asset Register Management'),
(8, 'Number of Axles per Coach Type'),
(9, 'Wheel Measurements Management'),
(10, 'Planning Report Management'),
(11, 'Wheel Re-profiling Data Management');

-- --------------------------------------------------------

--
-- Table structure for table `activitylog`
--

CREATE TABLE `activitylog` (
  `LogID` bigint(20) UNSIGNED NOT NULL,
  `TaskID` int(11) NOT NULL,
  `TransactionName` text NOT NULL,
  `Activity` int(11) NOT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `DateModified` date NOT NULL,
  `TimeModified` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activitylog`
--

INSERT INTO `activitylog` (`LogID`, `TaskID`, `TransactionName`, `Activity`, `ModifiedBy`, `DateModified`, `TimeModified`) VALUES
(58, 4, 'Updating Re-profiling Data', 2, 1, '2018-10-01', '17:27:51'),
(59, 9, 'Adding Alarm Event to Database', 1, 1, '2018-10-01', '17:28:47'),
(60, 9, 'Updating Alarm Events in Database', 2, 1, '2018-10-01', '17:28:47'),
(61, 5, 'Adding Asset to Database', 1, 1, '2018-10-01', '17:28:48'),
(62, 5, 'Adding Asset to Database', 1, 1, '2018-10-01', '17:28:48'),
(63, 5, 'Adding Asset to Database', 1, 1, '2018-10-01', '17:28:48'),
(64, 5, 'Adding Asset to Database', 1, 1, '2018-10-01', '17:28:48'),
(65, 5, 'Adding Asset to Database', 1, 1, '2018-10-01', '17:28:48'),
(66, 5, 'Adding Asset to Database', 1, 1, '2018-10-01', '17:28:48'),
(67, 5, 'Adding Asset to Database', 1, 1, '2018-10-01', '17:28:49'),
(68, 5, 'Updating Asset in Database', 2, 1, '2018-10-01', '17:28:49'),
(69, 2, 'Adding MiniProf Wheel Measurements Settings to Database', 1, 1, '2018-10-01', '17:28:49'),
(70, 2, 'Updating MiniProf Wheel Measurements Settings in Database', 2, 1, '2018-10-01', '17:28:50'),
(71, 2, 'Adding Axle Number Per Coach Type to Database', 1, 1, '2018-10-01', '17:28:50'),
(72, 2, 'Adding Axle Number Per Coach Type to Database', 1, 1, '2018-10-01', '17:28:50'),
(73, 2, 'Adding Axle Number Per Coach Type to Database', 1, 1, '2018-10-01', '17:28:51'),
(74, 2, 'Adding Axle Number Per Coach Type to Database', 1, 1, '2018-10-01', '17:28:51'),
(75, 2, 'Updating Axle Number Per Coach Type to Database', 2, 1, '2018-10-01', '17:28:51'),
(76, 2, 'Adding Daily Distance Travelled to Database', 1, 1, '2018-10-01', '17:28:51'),
(77, 2, 'Updating Daily Distance Travelled in Database', 2, 1, '2018-10-01', '17:28:51'),
(78, 1, 'Adding System License Information to Database', 1, 1, '2018-10-01', '17:28:51'),
(79, 1, 'Updating System License Information in Database', 2, 1, '2018-10-01', '17:28:56'),
(80, 6, 'Updating User Password for Staff Number:305941', 2, 1, '2018-10-01', '17:29:00'),
(81, 3, 'Adding Manual Wheel Measurements to Database', 1, 1, '2018-10-01', '17:29:03'),
(82, 3, 'Updating Manual Wheel Measurements in Database', 2, 1, '2018-10-01', '17:29:03'),
(83, 2, 'Adding Manual Wheel Measurements Settings to Database', 1, 1, '2018-10-01', '17:29:04'),
(84, 2, 'Updating Manual Wheel Measurements Settings in Database', 2, 1, '2018-10-01', '17:29:04'),
(85, 8, 'Adding MiniProf Wheel Measurements to Database', 1, 1, '2018-10-01', '17:29:04'),
(86, 8, 'Adding MiniProf Wheel Measurements to Database', 1, 1, '2018-10-01', '17:29:04'),
(87, 8, 'Adding MiniProf Wheel Measurements to Database', 1, 1, '2018-10-01', '17:29:04'),
(88, 8, 'Adding MiniProf Wheel Measurements to Database', 1, 1, '2018-10-01', '17:29:05'),
(89, 8, 'Adding MiniProf Wheel Measurements to Database', 1, 1, '2018-10-01', '17:29:05'),
(90, 1, 'Adding System Terms and Conditions to Database', 1, 1, '2018-10-01', '17:29:05'),
(91, 1, 'Updating System Terms and Conditions in Database', 2, 1, '2018-10-01', '17:29:11'),
(92, 6, 'Adding User Account to Database', 1, 1, '2018-10-01', '17:29:23'),
(93, 6, 'Adding User Account to Database', 1, 1, '2018-10-01', '17:29:27'),
(94, 6, 'Adding User Account to Database', 1, 1, '2018-10-01', '17:29:30'),
(95, 6, 'Adding User Account to Database', 1, 1, '2018-10-01', '17:29:34'),
(96, 6, 'Adding User Account to Database', 1, 1, '2018-10-01', '17:29:38'),
(97, 7, 'Adding User Role information to Database', 1, 1, '2018-10-01', '17:29:45'),
(98, 7, 'Updating User Role information in Database', 2, 1, '2018-10-01', '17:29:45'),
(99, 2, 'Adding Wear Rate Settings to Database', 1, 1, '2018-10-01', '17:29:46'),
(100, 2, 'Updating Wear Rate Settings in Database', 2, 1, '2018-10-01', '17:29:46'),
(101, 4, 'Adding Wheel Reprofiling Data to Database', 1, 1, '2018-10-01', '17:29:46'),
(102, 4, 'Updating Wheel Reprofiling Data in Database', 2, 1, '2018-10-01', '17:29:47'),
(103, 6, 'Updating User Password for Staff Number:', 2, 1, '2018-10-02', '16:30:00'),
(104, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '14:31:12'),
(105, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '14:33:49'),
(106, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '14:34:00'),
(107, 5, 'Updating Asset in Database', 2, 1, '2018-10-27', '14:38:59'),
(108, 5, 'Updating Asset in Database', 2, 1, '2018-10-27', '14:40:17'),
(109, 5, 'Updating Asset in Database', 2, 1, '2018-10-27', '14:41:42'),
(110, 6, 'Adding User Account to Database', 1, 1, '2018-10-27', '14:45:45'),
(111, 6, 'Adding User Account to Database', 1, 1, '2018-10-27', '14:47:24'),
(112, 5, 'Updating Asset in Database', 2, 1, '2018-10-27', '14:57:37'),
(113, 5, 'Updating Asset in Database', 2, 1, '2018-10-27', '14:58:00'),
(114, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:47'),
(115, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:47'),
(116, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:48'),
(117, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:48'),
(118, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:48'),
(119, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:48'),
(120, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:48'),
(121, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:48'),
(122, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:48'),
(123, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:48'),
(124, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:48'),
(125, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:48'),
(126, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:49'),
(127, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:49'),
(128, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:49'),
(129, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:49'),
(130, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:49'),
(131, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:49'),
(132, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:49'),
(133, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:49'),
(134, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:49'),
(135, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:49'),
(136, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:50'),
(137, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:50'),
(138, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:50'),
(139, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:50'),
(140, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:50'),
(141, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:50'),
(142, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:50'),
(143, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:50'),
(144, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:50'),
(145, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:51'),
(146, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:51'),
(147, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:51'),
(148, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:51'),
(149, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:51'),
(150, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:51'),
(151, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:51'),
(152, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:51'),
(153, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:51'),
(154, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:51'),
(155, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:51'),
(156, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:52'),
(157, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:52'),
(158, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:52'),
(159, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:52'),
(160, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:52'),
(161, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:52'),
(162, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:52'),
(163, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:52'),
(164, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:52'),
(165, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:52'),
(166, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:52'),
(167, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:53'),
(168, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:53'),
(169, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:53'),
(170, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:53'),
(171, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:53'),
(172, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:53'),
(173, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:53'),
(174, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:53'),
(175, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:53'),
(176, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:53'),
(177, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:53'),
(178, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:54'),
(179, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:54'),
(180, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:54'),
(181, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:54'),
(182, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:54'),
(183, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:54'),
(184, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:54'),
(185, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:54'),
(186, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:54'),
(187, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:54'),
(188, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:55'),
(189, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:55'),
(190, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:55'),
(191, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:55'),
(192, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:55'),
(193, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:55'),
(194, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:55'),
(195, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:55'),
(196, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:55'),
(197, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:55'),
(198, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:55'),
(199, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:56'),
(200, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:56'),
(201, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:56'),
(202, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:56'),
(203, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:56'),
(204, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:56'),
(205, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:56'),
(206, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:56'),
(207, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:56'),
(208, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:56'),
(209, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:57'),
(210, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:57'),
(211, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:57'),
(212, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:57'),
(213, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:57'),
(214, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:57'),
(215, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:57'),
(216, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:57'),
(217, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:57'),
(218, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:57'),
(219, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:58'),
(220, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:58'),
(221, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:58'),
(222, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:58'),
(223, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:58'),
(224, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:58'),
(225, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:58'),
(226, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:58'),
(227, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:58'),
(228, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:59'),
(229, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:59'),
(230, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:59'),
(231, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:59'),
(232, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:59'),
(233, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:59'),
(234, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:59'),
(235, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:59'),
(236, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:59'),
(237, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:59'),
(238, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:17:59'),
(239, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:00'),
(240, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:00'),
(241, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:00'),
(242, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:00'),
(243, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:00'),
(244, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:00'),
(245, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:00'),
(246, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:00'),
(247, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:00'),
(248, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:00'),
(249, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:00'),
(250, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:01'),
(251, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:01'),
(252, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:01'),
(253, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:01'),
(254, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:01'),
(255, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:01'),
(256, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:01'),
(257, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:01'),
(258, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:01'),
(259, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:01'),
(260, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:02'),
(261, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:02'),
(262, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:02'),
(263, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:02'),
(264, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:02'),
(265, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:02'),
(266, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:02'),
(267, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:02'),
(268, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:02'),
(269, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:02'),
(270, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:03'),
(271, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:03'),
(272, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:03'),
(273, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:03'),
(274, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:03'),
(275, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:03'),
(276, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:03'),
(277, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:03'),
(278, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:03'),
(279, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:03'),
(280, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:04'),
(281, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:04'),
(282, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:04'),
(283, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:04'),
(284, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:04'),
(285, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:04'),
(286, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:04'),
(287, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:04'),
(288, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:04'),
(289, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:04'),
(290, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:04'),
(291, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:05'),
(292, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:05'),
(293, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:05'),
(294, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:05'),
(295, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:05'),
(296, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:05'),
(297, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:05'),
(298, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:05'),
(299, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:05'),
(300, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:05'),
(301, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:06'),
(302, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:06'),
(303, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:06'),
(304, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:06'),
(305, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:06'),
(306, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:06'),
(307, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:06'),
(308, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:06'),
(309, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:06'),
(310, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:06'),
(311, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:06'),
(312, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:07'),
(313, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:07'),
(314, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:07'),
(315, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:07'),
(316, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:07'),
(317, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:07'),
(318, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:07'),
(319, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:07'),
(320, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:07'),
(321, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:07'),
(322, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:08'),
(323, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:08'),
(324, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:08'),
(325, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:08'),
(326, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:08'),
(327, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:08'),
(328, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:08'),
(329, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:08'),
(330, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:08'),
(331, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:08'),
(332, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:08'),
(333, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:09'),
(334, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:09'),
(335, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:09'),
(336, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:09'),
(337, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:09'),
(338, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:09'),
(339, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:09'),
(340, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:09'),
(341, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:09'),
(342, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:09'),
(343, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:10'),
(344, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:10'),
(345, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:10'),
(346, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:10'),
(347, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:10'),
(348, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:10'),
(349, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:10'),
(350, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:10'),
(351, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:10'),
(352, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:10'),
(353, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:11'),
(354, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:11'),
(355, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:11'),
(356, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:11'),
(357, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:11'),
(358, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:11'),
(359, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:11'),
(360, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:11'),
(361, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:11'),
(362, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:11'),
(363, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:12'),
(364, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:12'),
(365, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:12'),
(366, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:12'),
(367, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:12'),
(368, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:12'),
(369, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:12'),
(370, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:12'),
(371, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:12'),
(372, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:12'),
(373, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:13'),
(374, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:13'),
(375, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:13'),
(376, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:13'),
(377, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:13'),
(378, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:13'),
(379, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:13'),
(380, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:13'),
(381, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:13'),
(382, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:14'),
(383, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:14'),
(384, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:14'),
(385, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:14'),
(386, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:14'),
(387, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:14'),
(388, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:15'),
(389, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:15'),
(390, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:15'),
(391, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:15'),
(392, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:15'),
(393, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:15'),
(394, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:15'),
(395, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:15'),
(396, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:15'),
(397, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:16'),
(398, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:16'),
(399, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:16'),
(400, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:16'),
(401, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:16'),
(402, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:16'),
(403, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:16'),
(404, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:16'),
(405, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:16'),
(406, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:16'),
(407, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:17'),
(408, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:17'),
(409, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:17'),
(410, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:17'),
(411, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:17'),
(412, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:17'),
(413, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:18'),
(414, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:18'),
(415, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:18'),
(416, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:18'),
(417, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:18'),
(418, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:18'),
(419, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:18'),
(420, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:18'),
(421, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:18'),
(422, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:19'),
(423, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:19'),
(424, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:19'),
(425, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:19'),
(426, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:19'),
(427, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:19'),
(428, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:19'),
(429, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:19'),
(430, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:19'),
(431, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:19'),
(432, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:20'),
(433, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:20'),
(434, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:20'),
(435, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:20'),
(436, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:20'),
(437, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:20'),
(438, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:20'),
(439, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:20'),
(440, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:20'),
(441, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:20'),
(442, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:20'),
(443, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:21'),
(444, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:21'),
(445, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:21'),
(446, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:21'),
(447, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:21'),
(448, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:21'),
(449, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:21'),
(450, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:21'),
(451, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:21'),
(452, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:22'),
(453, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:22'),
(454, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:22'),
(455, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:22'),
(456, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:22'),
(457, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:22'),
(458, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:22'),
(459, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:22'),
(460, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:22'),
(461, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:22'),
(462, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:22'),
(463, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:23'),
(464, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:23'),
(465, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:23'),
(466, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:23'),
(467, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:23'),
(468, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:23'),
(469, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:23'),
(470, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:23'),
(471, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:23'),
(472, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:23'),
(473, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:24'),
(474, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:24'),
(475, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:24'),
(476, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:24'),
(477, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:24'),
(478, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:24'),
(479, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:24'),
(480, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:24'),
(481, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:24'),
(482, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:24'),
(483, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:24'),
(484, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:25'),
(485, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:25'),
(486, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:25'),
(487, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:25'),
(488, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:25'),
(489, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:25'),
(490, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:25'),
(491, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:25'),
(492, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:25'),
(493, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:25'),
(494, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:26'),
(495, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:26'),
(496, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:26'),
(497, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:26'),
(498, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:26'),
(499, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:26'),
(500, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:26'),
(501, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:26'),
(502, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:26'),
(503, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:27'),
(504, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:27'),
(505, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:27'),
(506, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:27'),
(507, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:27'),
(508, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:27'),
(509, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:27'),
(510, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:27'),
(511, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:27'),
(512, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:27'),
(513, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:27'),
(514, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:28'),
(515, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:28'),
(516, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:28'),
(517, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:28'),
(518, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:28'),
(519, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:28'),
(520, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:28'),
(521, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:28'),
(522, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:28'),
(523, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:28'),
(524, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:29'),
(525, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:29'),
(526, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:29'),
(527, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:29'),
(528, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:29'),
(529, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:29'),
(530, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:29'),
(531, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:29'),
(532, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:29'),
(533, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:30'),
(534, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:30'),
(535, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:30'),
(536, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:30'),
(537, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:30'),
(538, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:30'),
(539, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:30'),
(540, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:30'),
(541, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:31'),
(542, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:31'),
(543, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:31'),
(544, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:31'),
(545, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:31'),
(546, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:31'),
(547, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:31'),
(548, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:31'),
(549, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:31'),
(550, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:31'),
(551, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:32'),
(552, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:32'),
(553, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:32'),
(554, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:32'),
(555, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:32'),
(556, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:32'),
(557, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:32'),
(558, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:32'),
(559, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:33'),
(560, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:33'),
(561, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:33'),
(562, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:33'),
(563, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:33'),
(564, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:33'),
(565, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:33'),
(566, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:33'),
(567, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:33'),
(568, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:33'),
(569, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:34'),
(570, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:34'),
(571, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:34'),
(572, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:34'),
(573, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:34'),
(574, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:34'),
(575, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:34'),
(576, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:34'),
(577, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:34'),
(578, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:34'),
(579, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:34'),
(580, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:35'),
(581, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:35'),
(582, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:35'),
(583, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:35'),
(584, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:35'),
(585, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:35'),
(586, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:35'),
(587, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:35'),
(588, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:35'),
(589, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:35'),
(590, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:35'),
(591, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:36'),
(592, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:36'),
(593, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:36'),
(594, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:36'),
(595, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:36'),
(596, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:36'),
(597, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:36'),
(598, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:36'),
(599, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:36'),
(600, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(601, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(602, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(603, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(604, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(605, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(606, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(607, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(608, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(609, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(610, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(611, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:37'),
(612, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:38'),
(613, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:38'),
(614, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:38'),
(615, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:38'),
(616, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:38'),
(617, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:38'),
(618, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:38'),
(619, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:38'),
(620, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:38'),
(621, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:38'),
(622, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:39'),
(623, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:39'),
(624, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:39'),
(625, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:39'),
(626, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:39'),
(627, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:39'),
(628, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:39'),
(629, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:39'),
(630, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:39'),
(631, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:40'),
(632, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:40'),
(633, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:40'),
(634, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:40'),
(635, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:40'),
(636, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:40'),
(637, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:40'),
(638, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:40'),
(639, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:40'),
(640, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:40'),
(641, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:40'),
(642, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:41'),
(643, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:41'),
(644, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:41'),
(645, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:41'),
(646, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:41'),
(647, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:41'),
(648, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:41'),
(649, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:41'),
(650, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:41'),
(651, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:41'),
(652, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:41'),
(653, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:42'),
(654, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:42'),
(655, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:42'),
(656, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:42'),
(657, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:42'),
(658, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:42'),
(659, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:42'),
(660, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:42'),
(661, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:42'),
(662, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:42'),
(663, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:43'),
(664, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:43'),
(665, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:43'),
(666, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:43'),
(667, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:43'),
(668, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:43'),
(669, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:43'),
(670, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:43'),
(671, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:43'),
(672, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:43'),
(673, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:43'),
(674, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:44'),
(675, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:44'),
(676, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:44'),
(677, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:44'),
(678, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:44'),
(679, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:44'),
(680, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:44'),
(681, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:44'),
(682, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:44'),
(683, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:44'),
(684, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:45'),
(685, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:45'),
(686, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:45'),
(687, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:45'),
(688, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:45'),
(689, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:45'),
(690, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:45'),
(691, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:45'),
(692, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:45'),
(693, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:45'),
(694, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:46'),
(695, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:46'),
(696, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:46'),
(697, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:46'),
(698, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:46'),
(699, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:46'),
(700, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:46'),
(701, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:46'),
(702, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:46'),
(703, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:46'),
(704, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:47'),
(705, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:47'),
(706, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:47'),
(707, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:47'),
(708, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:47'),
(709, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:47'),
(710, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:47'),
(711, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:47'),
(712, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:47'),
(713, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:48'),
(714, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:48'),
(715, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:48'),
(716, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:48'),
(717, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:48'),
(718, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:48'),
(719, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:48'),
(720, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:48'),
(721, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:48'),
(722, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:48'),
(723, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(724, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(725, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(726, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(727, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(728, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(729, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(730, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(731, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(732, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(733, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(734, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:49'),
(735, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:50'),
(736, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:50'),
(737, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:50'),
(738, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:50'),
(739, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:50'),
(740, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:50'),
(741, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:50'),
(742, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:50'),
(743, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:50'),
(744, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:50'),
(745, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:51'),
(746, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:51'),
(747, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:51'),
(748, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:51'),
(749, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:51'),
(750, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:51'),
(751, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:51'),
(752, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:51'),
(753, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:51'),
(754, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:52'),
(755, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:52'),
(756, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:52'),
(757, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:52'),
(758, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:52'),
(759, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:52'),
(760, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:52'),
(761, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:52'),
(762, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:52'),
(763, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:52'),
(764, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:52'),
(765, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:53'),
(766, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:53'),
(767, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:53'),
(768, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:53'),
(769, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:53'),
(770, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:53'),
(771, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:53'),
(772, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:53'),
(773, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:54'),
(774, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:54'),
(775, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:54'),
(776, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:54'),
(777, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:54'),
(778, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:54'),
(779, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:54');
INSERT INTO `activitylog` (`LogID`, `TaskID`, `TransactionName`, `Activity`, `ModifiedBy`, `DateModified`, `TimeModified`) VALUES
(780, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:54'),
(781, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:54'),
(782, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:54'),
(783, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:55'),
(784, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:55'),
(785, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:55'),
(786, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:55'),
(787, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:55'),
(788, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:55'),
(789, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:55'),
(790, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:55'),
(791, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:55'),
(792, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:55'),
(793, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:55'),
(794, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:56'),
(795, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:56'),
(796, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:56'),
(797, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:56'),
(798, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:56'),
(799, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:56'),
(800, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:56'),
(801, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:56'),
(802, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:56'),
(803, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:56'),
(804, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:57'),
(805, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:57'),
(806, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:57'),
(807, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:57'),
(808, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:57'),
(809, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:57'),
(810, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:57'),
(811, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:57'),
(812, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:57'),
(813, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:57'),
(814, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:58'),
(815, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:58'),
(816, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:58'),
(817, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:58'),
(818, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:58'),
(819, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:58'),
(820, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:58'),
(821, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:58'),
(822, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:58'),
(823, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:58'),
(824, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:59'),
(825, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:59'),
(826, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:59'),
(827, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:59'),
(828, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:59'),
(829, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:59'),
(830, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:59'),
(831, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:59'),
(832, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:59'),
(833, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:59'),
(834, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:18:59'),
(835, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:00'),
(836, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:00'),
(837, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:00'),
(838, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:00'),
(839, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:00'),
(840, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:00'),
(841, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:00'),
(842, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:00'),
(843, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:00'),
(844, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:00'),
(845, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:01'),
(846, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:01'),
(847, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:01'),
(848, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:01'),
(849, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:01'),
(850, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:01'),
(851, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:01'),
(852, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:01'),
(853, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:02'),
(854, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:02'),
(855, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:02'),
(856, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:02'),
(857, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:02'),
(858, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:02'),
(859, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:02'),
(860, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:03'),
(861, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:03'),
(862, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:03'),
(863, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:03'),
(864, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:03'),
(865, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:03'),
(866, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:03'),
(867, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:03'),
(868, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:04'),
(869, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:04'),
(870, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:04'),
(871, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:04'),
(872, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:04'),
(873, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:04'),
(874, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:04'),
(875, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:04'),
(876, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:04'),
(877, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:05'),
(878, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:05'),
(879, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:05'),
(880, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:05'),
(881, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:05'),
(882, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:05'),
(883, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:05'),
(884, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:05'),
(885, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:05'),
(886, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:05'),
(887, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:06'),
(888, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:06'),
(889, 5, 'Adding Asset to Database', 1, 1, '2018-10-27', '15:19:51'),
(890, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:05'),
(891, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:05'),
(892, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:05'),
(893, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:05'),
(894, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:05'),
(895, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:05'),
(896, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:06'),
(897, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:06'),
(898, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:06'),
(899, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:06'),
(900, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:06'),
(901, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:36:06'),
(902, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:01'),
(903, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:01'),
(904, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:01'),
(905, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:02'),
(906, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:02'),
(907, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:02'),
(908, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:02'),
(909, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:02'),
(910, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:02'),
(911, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:02'),
(912, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:02'),
(913, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:37:02'),
(914, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:18'),
(915, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:18'),
(916, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:18'),
(917, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:19'),
(918, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:19'),
(919, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:19'),
(920, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:19'),
(921, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:19'),
(922, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:19'),
(923, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:19'),
(924, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:19'),
(925, 2, 'Adding Axle-Coach Mapping to Database', 1, 1, '2018-10-27', '15:39:19'),
(926, 3, 'Adding Manual Wheel Measurements to Database', 1, 1, '2018-11-04', '11:06:07'),
(927, 3, 'Updating Manual Wheel Measurements in Database', 2, 1, '2018-11-04', '11:07:10'),
(928, 5, 'Adding Asset to Database', 1, 1, '2018-11-04', '11:27:07'),
(929, 2, 'Adding MiniProf Wheel Measurements Settings to Database', 1, 1, '2018-11-04', '11:27:55'),
(930, 2, 'Updating MiniProf Wheel Measurements Settings in Database', 2, 1, '2018-11-04', '11:31:31'),
(931, 9, 'Adding Alarm Event to Database', 1, 1, '2018-11-04', '11:31:45'),
(932, 9, 'Adding Alarm Event to Database', 1, 1, '2018-11-04', '11:31:45'),
(933, 9, 'Adding Alarm Event to Database', 1, 1, '2018-11-04', '11:31:45'),
(934, 9, 'Adding Alarm Event to Database', 1, 1, '2018-11-04', '11:31:45'),
(935, 9, 'Adding Alarm Event to Database', 1, 1, '2018-11-04', '11:31:46'),
(936, 9, 'Updating Alarm Events in Database', 2, 1, '2018-11-04', '11:34:54'),
(937, 9, 'Updating Alarm Events in Database', 2, 1, '2018-11-04', '11:34:54'),
(938, 9, 'Updating Alarm Events in Database', 2, 1, '2018-11-04', '11:34:55'),
(939, 9, 'Updating Alarm Events in Database', 2, 1, '2018-11-04', '11:34:55'),
(940, 9, 'Updating Alarm Events in Database', 2, 1, '2018-11-04', '11:34:55'),
(941, 3, 'Updating Manual Wheel Measurements in Database', 2, 1, '2018-11-04', '11:36:17'),
(942, 9, 'Updating Alarm Events in Database', 2, 1, '2018-11-04', '11:36:29'),
(943, 9, 'Updating Alarm Events in Database', 2, 1, '2018-11-04', '11:36:29'),
(944, 9, 'Updating Alarm Events in Database', 2, 1, '2018-11-04', '11:36:29'),
(945, 9, 'Updating Alarm Events in Database', 2, 1, '2018-11-04', '11:36:30'),
(946, 9, 'Updating Alarm Events in Database', 2, 1, '2018-11-04', '11:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `activitylogtasks`
--

CREATE TABLE `activitylogtasks` (
  `TaskID` int(11) NOT NULL,
  `TaskName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activitylogtasks`
--

INSERT INTO `activitylogtasks` (`TaskID`, `TaskName`) VALUES
(1, 'Super Admin Functions'),
(2, 'System Settings'),
(3, 'Manual Wheel Measurements'),
(4, 'Re-profiling Data '),
(5, 'Coach Asset Register'),
(6, 'User Accounts '),
(7, 'User Roles'),
(8, 'MiniProf Wheel Measurements'),
(9, 'Alarm Event Logger');

-- --------------------------------------------------------

--
-- Table structure for table `alarmeventlog`
--

CREATE TABLE `alarmeventlog` (
  `RefID` bigint(20) UNSIGNED NOT NULL,
  `MeasurementID` bigint(20) UNSIGNED NOT NULL,
  `AlarmCause` text NOT NULL,
  `DefectSize` double NOT NULL,
  `RefDate` date NOT NULL,
  `PredictedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alarmeventlog`
--

INSERT INTO `alarmeventlog` (`RefID`, `MeasurementID`, `AlarmCause`, `DefectSize`, `RefDate`, `PredictedDate`) VALUES
(1, 3, 'The Flange Height has violated the wheel alarm settings thresholds', 30.2994, '2017-04-07', '2017-04-07'),
(2, 1, 'The Flange Height has violated the wheel alarm settings thresholds', 30.1317, '2017-04-07', '2017-04-07'),
(3, 2, 'The Flange Height has violated the wheel alarm settings thresholds', 30.064, '2017-04-07', '2017-04-07'),
(4, 4, 'The Flange Height has violated the wheel alarm settings thresholds', 30.0098, '2017-04-07', '2017-04-07'),
(5, 5, 'The Flange Height has violated the wheel alarm settings thresholds', 32.9504, '2017-04-07', '2017-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `alarmsettings`
--

CREATE TABLE `alarmsettings` (
  `AlarmID` int(11) NOT NULL,
  `SettingsID` int(11) NOT NULL,
  `CoachID` int(11) NOT NULL,
  `AlarmLevel` double NOT NULL,
  `NorminalLevel` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alarmsettings`
--

INSERT INTO `alarmsettings` (`AlarmID`, `SettingsID`, `CoachID`, `AlarmLevel`, `NorminalLevel`) VALUES
(1, 6, 1, 30, 29),
(2, 7, 1, 6.5, 9),
(3, 8, 1, 20.5, 29),
(4, 9, 1, 3.5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assetregister`
--

CREATE TABLE `assetregister` (
  `AssetID` int(11) NOT NULL,
  `CoachNumber` text NOT NULL,
  `CoachID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assetregister`
--

INSERT INTO `assetregister` (`AssetID`, `CoachNumber`, `CoachID`) VALUES
(1, '10805', 1);

-- --------------------------------------------------------

--
-- Table structure for table `axlecoachmapping`
--

CREATE TABLE `axlecoachmapping` (
  `MappingID` bigint(20) UNSIGNED NOT NULL,
  `AxleSerialNumber` text NOT NULL,
  `AxleNumber` int(11) NOT NULL,
  `SetNumber` text NOT NULL,
  `CoachNumber` text NOT NULL,
  `DateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `axlecoachmapping`
--

INSERT INTO `axlecoachmapping` (`MappingID`, `AxleSerialNumber`, `AxleNumber`, `SetNumber`, `CoachNumber`, `DateCreated`) VALUES
(32, '5M2A67R', 1, 'S3', '50081M', '2018-10-27'),
(33, '5M2A90R', 2, 'S3', '50081M', '2018-10-27'),
(34, '5M2A122R', 3, 'S3', '50081M', '2018-10-27'),
(35, '5M2A601R', 4, 'S4', '50081M', '2018-10-27'),
(36, '5M2A115R', 1, 'M4', '50083M', '2018-10-27'),
(37, '5M2A1066R', 2, 'M4', '50083M', '2018-10-27'),
(38, '5M2A773R', 3, 'M4', '50083M', '2018-10-27'),
(39, '5M2A686R', 4, 'M4', '50083M', '2018-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `axlespercoach`
--

CREATE TABLE `axlespercoach` (
  `AxlesID` int(11) NOT NULL,
  `CoachID` int(11) NOT NULL,
  `AxlesNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coachdetails`
--

CREATE TABLE `coachdetails` (
  `CoachID` int(11) NOT NULL,
  `CoachType` text NOT NULL,
  `CoachCategory` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coachdetails`
--

INSERT INTO `coachdetails` (`CoachID`, `CoachType`, `CoachCategory`) VALUES
(1, '5M2A', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `distancetravelled`
--

CREATE TABLE `distancetravelled` (
  `DistanceID` int(11) NOT NULL,
  `Distance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `distancetravelled`
--

INSERT INTO `distancetravelled` (`DistanceID`, `Distance`) VALUES
(1, 8192.23);

-- --------------------------------------------------------

--
-- Table structure for table `manualmeasurements`
--

CREATE TABLE `manualmeasurements` (
  `ManualID` bigint(20) UNSIGNED NOT NULL,
  `MeasurementID` bigint(20) UNSIGNED NOT NULL,
  `SR` double NOT NULL,
  `CTW` double NOT NULL,
  `CTD` double NOT NULL,
  `CTDFF` double NOT NULL,
  `WS` double NOT NULL,
  `GibsonDescription` text NOT NULL,
  `WheelSize` double NOT NULL,
  `Unit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manualmeasurements`
--

INSERT INTO `manualmeasurements` (`ManualID`, `MeasurementID`, `SR`, `CTW`, `CTD`, `CTDFF`, `WS`, `GibsonDescription`, `WheelSize`, `Unit`) VALUES
(2, 3, 0, 0, 0, 0, 0, 'pass', 73.25, 'in');

-- --------------------------------------------------------

--
-- Table structure for table `planningreportcolumns`
--

CREATE TABLE `planningreportcolumns` (
  `PlanningID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `ColumnID` int(11) NOT NULL,
  `ColumnVisibility` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `planningreportcolumns`
--

INSERT INTO `planningreportcolumns` (`PlanningID`, `RoleID`, `ColumnID`, `ColumnVisibility`) VALUES
(132, 2, 1, 1),
(133, 2, 2, 1),
(134, 2, 3, 1),
(135, 2, 4, 1),
(136, 2, 5, 1),
(137, 2, 6, 1),
(138, 2, 7, 1),
(139, 2, 8, 1),
(140, 16, 1, 0),
(141, 16, 2, 1),
(142, 17, 1, 0),
(143, 17, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reportcolumns`
--

CREATE TABLE `reportcolumns` (
  `ColumnID` int(11) NOT NULL,
  `ColumnName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reportcolumns`
--

INSERT INTO `reportcolumns` (`ColumnID`, `ColumnName`) VALUES
(1, 'Coach Number'),
(2, 'Axle Number'),
(3, 'Wheel ID'),
(4, 'Defect Size'),
(5, 'Reference Date'),
(6, 'Number of Days before Failure'),
(7, 'Predicted Date of Failure'),
(8, 'Comment');

-- --------------------------------------------------------

--
-- Table structure for table `systemlicense`
--

CREATE TABLE `systemlicense` (
  `LicenseID` int(11) NOT NULL,
  `CompanyName` text NOT NULL,
  `AddressType` tinyint(4) NOT NULL,
  `AddressLine1` text NOT NULL,
  `Surburb` text NOT NULL,
  `City` text NOT NULL,
  `Country` text NOT NULL,
  `PostalCode` text NOT NULL,
  `LicenseType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `systemlicense`
--

INSERT INTO `systemlicense` (`LicenseID`, `CompanyName`, `AddressType`, `AddressLine1`, `Surburb`, `City`, `Country`, `PostalCode`, `LicenseType`) VALUES
(558, 'CSIR', 1, 'C13 Windmills, Muller South Street', 'Buccleuch', 'Johannesburg', 'South Africa', '2066', 20);

-- --------------------------------------------------------

--
-- Table structure for table `termsconditions`
--

CREATE TABLE `termsconditions` (
  `TermsID` int(11) NOT NULL,
  `LicenseID` int(11) NOT NULL,
  `Terms` text NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `AccountID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Surname` text NOT NULL,
  `StaffNumber` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `ActivityState` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`AccountID`, `RoleID`, `Name`, `Surname`, `StaffNumber`, `Email`, `Password`, `ActivityState`) VALUES
(1, 2, 'Mzimkhulu', 'Mthethwa', '305941', 'bmthethwa@gqunsueng.co.za', '65f576a7ab0e93059028fbfec1126773', 1),
(21, 15, 'Bhekisizwe', 'Mthethwa', '305942', 'tshomie2020@yahoo.com', 'fddc4d88bc01eacf72a5c4ca138812ab', 1),
(22, 15, 'Bhekisizwe', 'Mthethwa', '305943', 'tshomie2020@yahoo.com', '2b8bf8bf5293c9aedf68d786943f8b4a', 1),
(23, 15, 'Bhekisizwe', 'Mthethwa', '305944', 'tshomie2020@yahoo.com', 'c088cda70fa0e17d499590db2b90ca40', 1),
(24, 15, 'Bhekisizwe', 'Mthethwa', '305945', 'tshomie2020@yahoo.com', '9383b4165d81f7f00e61a14b509b1566', 1),
(25, 2, 'Mzingaye', 'Mthethwa', '42512', 'bmthethwa@gqunsueng.co.za', 'd4a8e8c25eb83deafb305c75e3616343', 1),
(26, 15, 'Sekhotso', 'Mofokeng', '20140540', 'bmthethwa@gqunsueng.co.za', '6d9c16322185b191a4eee0dfdd13e724', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `RoleID` int(11) NOT NULL,
  `UserRoleName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`RoleID`, `UserRoleName`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(15, 'Baby'),
(16, 'Baby'),
(17, 'Baby');

-- --------------------------------------------------------

--
-- Table structure for table `warningsettings`
--

CREATE TABLE `warningsettings` (
  `SettingsID` int(11) NOT NULL,
  `WarningLevel` double NOT NULL,
  `ParamID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warningsettings`
--

INSERT INTO `warningsettings` (`SettingsID`, `WarningLevel`, `ParamID`) VALUES
(1, 30.78, 5),
(2, 88.62, 6),
(3, 10.25, 7),
(4, 20, 8),
(5, 25.89, 9),
(6, 31, 1),
(7, 6, 2),
(8, 20, 3),
(9, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `wearrates`
--

CREATE TABLE `wearrates` (
  `WearID` int(11) NOT NULL,
  `ParamID` int(11) NOT NULL,
  `WearRate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wearrates`
--

INSERT INTO `wearrates` (`WearID`, `ParamID`, `WearRate`) VALUES
(1, 1, 0.00325),
(2, 2, 0.01),
(3, 3, 0.002),
(4, 4, 0.0015);

-- --------------------------------------------------------

--
-- Table structure for table `wheelmeasurements`
--

CREATE TABLE `wheelmeasurements` (
  `MeasurementID` bigint(20) UNSIGNED NOT NULL,
  `CoachNumber` text NOT NULL,
  `SetNumber` text NOT NULL,
  `AxleNumber` int(11) NOT NULL,
  `WheelID` int(11) NOT NULL,
  `OperatorName` text NOT NULL,
  `Meas_Date` date NOT NULL,
  `Meas_Time` time NOT NULL,
  `Sh` double NOT NULL,
  `qR` double NOT NULL,
  `FW` double NOT NULL,
  `H` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wheelmeasurements`
--

INSERT INTO `wheelmeasurements` (`MeasurementID`, `CoachNumber`, `SetNumber`, `AxleNumber`, `WheelID`, `OperatorName`, `Meas_Date`, `Meas_Time`, `Sh`, `qR`, `FW`, `H`) VALUES
(1, '10805', 'N6', 4, 8, 'kilian', '2017-04-07', '09:33:00', 30.1317, 7.0652, 25.9776, -0.84),
(2, '10805', 'N6', 4, 7, 'kilian', '2017-04-07', '09:33:15', 30.064, 7.0026, 26.3435, -0.9357),
(3, '10805', 'N6', 3, 6, 'kilian', '2017-04-07', '09:33:36', 30.2994, 7.1113, 26.2741, -1.851),
(4, '10805', 'N6', 3, 5, 'kilian', '2017-04-07', '09:33:49', 30.0098, 7.1056, 26.2723, -0.9269),
(5, '10805', 'N6', 2, 4, 'kilian', '2017-04-07', '09:34:18', 32.9504, 11.2669, 27.4283, -3.0825);

-- --------------------------------------------------------

--
-- Table structure for table `wheelparameters`
--

CREATE TABLE `wheelparameters` (
  `ParamID` int(11) NOT NULL,
  `ParamName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wheelparameters`
--

INSERT INTO `wheelparameters` (`ParamID`, `ParamName`) VALUES
(1, 'Sh'),
(2, 'qR'),
(3, 'FW'),
(4, 'H'),
(5, 'CTD'),
(6, 'CTW'),
(7, 'CTDFF'),
(8, 'SR'),
(9, 'WS');

-- --------------------------------------------------------

--
-- Table structure for table `wheelreprofilingdata`
--

CREATE TABLE `wheelreprofilingdata` (
  `ReprofilingID` bigint(20) UNSIGNED NOT NULL,
  `AxleSerialNumber` text NOT NULL,
  `InitLeftDiameter` double NOT NULL,
  `FinalLeftDiameter` double NOT NULL,
  `InitRightDiameter` double NOT NULL,
  `FinalRightDiameter` double NOT NULL,
  `Cost` double NOT NULL,
  `DOW` date NOT NULL,
  `ServiceProvider` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wheelreprofilingdata`
--

INSERT INTO `wheelreprofilingdata` (`ReprofilingID`, `AxleSerialNumber`, `InitLeftDiameter`, `FinalLeftDiameter`, `InitRightDiameter`, `FinalRightDiameter`, `Cost`, `DOW`, `ServiceProvider`) VALUES
(1, 'MX2RA', 1020.25, 998.75, 1012.32, 789.23, 100023.78, '2018-09-01', 'PRASA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessrights`
--
ALTER TABLE `accessrights`
  ADD PRIMARY KEY (`AccessID`),
  ADD KEY `ActivityID` (`ActivityID`),
  ADD KEY `accessrights_ibfk_1` (`RoleID`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`ActivityID`);

--
-- Indexes for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `ModifiedBy` (`ModifiedBy`),
  ADD KEY `activitylog_ibfk_1` (`TaskID`);

--
-- Indexes for table `activitylogtasks`
--
ALTER TABLE `activitylogtasks`
  ADD PRIMARY KEY (`TaskID`);

--
-- Indexes for table `alarmeventlog`
--
ALTER TABLE `alarmeventlog`
  ADD PRIMARY KEY (`RefID`),
  ADD KEY `MeasurementID` (`MeasurementID`);

--
-- Indexes for table `alarmsettings`
--
ALTER TABLE `alarmsettings`
  ADD PRIMARY KEY (`AlarmID`),
  ADD KEY `SettingsID` (`SettingsID`),
  ADD KEY `CoachID` (`CoachID`);

--
-- Indexes for table `assetregister`
--
ALTER TABLE `assetregister`
  ADD PRIMARY KEY (`AssetID`),
  ADD KEY `CoachID` (`CoachID`);

--
-- Indexes for table `axlecoachmapping`
--
ALTER TABLE `axlecoachmapping`
  ADD PRIMARY KEY (`MappingID`);

--
-- Indexes for table `axlespercoach`
--
ALTER TABLE `axlespercoach`
  ADD PRIMARY KEY (`AxlesID`),
  ADD KEY `CoachID` (`CoachID`);

--
-- Indexes for table `coachdetails`
--
ALTER TABLE `coachdetails`
  ADD PRIMARY KEY (`CoachID`);

--
-- Indexes for table `distancetravelled`
--
ALTER TABLE `distancetravelled`
  ADD PRIMARY KEY (`DistanceID`);

--
-- Indexes for table `manualmeasurements`
--
ALTER TABLE `manualmeasurements`
  ADD PRIMARY KEY (`ManualID`),
  ADD KEY `MeasurementID` (`MeasurementID`);

--
-- Indexes for table `planningreportcolumns`
--
ALTER TABLE `planningreportcolumns`
  ADD PRIMARY KEY (`PlanningID`),
  ADD KEY `ColumnID` (`ColumnID`),
  ADD KEY `planningreportcolumns_ibfk_1` (`RoleID`);

--
-- Indexes for table `reportcolumns`
--
ALTER TABLE `reportcolumns`
  ADD PRIMARY KEY (`ColumnID`);

--
-- Indexes for table `systemlicense`
--
ALTER TABLE `systemlicense`
  ADD PRIMARY KEY (`LicenseID`);

--
-- Indexes for table `termsconditions`
--
ALTER TABLE `termsconditions`
  ADD PRIMARY KEY (`TermsID`),
  ADD KEY `LicenseID` (`LicenseID`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`AccountID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `warningsettings`
--
ALTER TABLE `warningsettings`
  ADD PRIMARY KEY (`SettingsID`),
  ADD KEY `warningsettings_ibfk_1` (`ParamID`);

--
-- Indexes for table `wearrates`
--
ALTER TABLE `wearrates`
  ADD PRIMARY KEY (`WearID`),
  ADD KEY `ParamID` (`ParamID`);

--
-- Indexes for table `wheelmeasurements`
--
ALTER TABLE `wheelmeasurements`
  ADD PRIMARY KEY (`MeasurementID`);

--
-- Indexes for table `wheelparameters`
--
ALTER TABLE `wheelparameters`
  ADD PRIMARY KEY (`ParamID`);

--
-- Indexes for table `wheelreprofilingdata`
--
ALTER TABLE `wheelreprofilingdata`
  ADD PRIMARY KEY (`ReprofilingID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessrights`
--
ALTER TABLE `accessrights`
  MODIFY `AccessID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `ActivityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `activitylog`
--
ALTER TABLE `activitylog`
  MODIFY `LogID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=947;

--
-- AUTO_INCREMENT for table `activitylogtasks`
--
ALTER TABLE `activitylogtasks`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `alarmeventlog`
--
ALTER TABLE `alarmeventlog`
  MODIFY `RefID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `alarmsettings`
--
ALTER TABLE `alarmsettings`
  MODIFY `AlarmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assetregister`
--
ALTER TABLE `assetregister`
  MODIFY `AssetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `axlecoachmapping`
--
ALTER TABLE `axlecoachmapping`
  MODIFY `MappingID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `axlespercoach`
--
ALTER TABLE `axlespercoach`
  MODIFY `AxlesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coachdetails`
--
ALTER TABLE `coachdetails`
  MODIFY `CoachID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `distancetravelled`
--
ALTER TABLE `distancetravelled`
  MODIFY `DistanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manualmeasurements`
--
ALTER TABLE `manualmeasurements`
  MODIFY `ManualID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `planningreportcolumns`
--
ALTER TABLE `planningreportcolumns`
  MODIFY `PlanningID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `reportcolumns`
--
ALTER TABLE `reportcolumns`
  MODIFY `ColumnID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `systemlicense`
--
ALTER TABLE `systemlicense`
  MODIFY `LicenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=559;

--
-- AUTO_INCREMENT for table `termsconditions`
--
ALTER TABLE `termsconditions`
  MODIFY `TermsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `userrole`
--
ALTER TABLE `userrole`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `warningsettings`
--
ALTER TABLE `warningsettings`
  MODIFY `SettingsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wearrates`
--
ALTER TABLE `wearrates`
  MODIFY `WearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wheelmeasurements`
--
ALTER TABLE `wheelmeasurements`
  MODIFY `MeasurementID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wheelparameters`
--
ALTER TABLE `wheelparameters`
  MODIFY `ParamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wheelreprofilingdata`
--
ALTER TABLE `wheelreprofilingdata`
  MODIFY `ReprofilingID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessrights`
--
ALTER TABLE `accessrights`
  ADD CONSTRAINT `accessrights_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `userrole` (`RoleID`) ON DELETE CASCADE,
  ADD CONSTRAINT `accessrights_ibfk_2` FOREIGN KEY (`ActivityID`) REFERENCES `activity` (`ActivityID`) ON DELETE CASCADE;

--
-- Constraints for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD CONSTRAINT `activitylog_ibfk_1` FOREIGN KEY (`TaskID`) REFERENCES `activitylogtasks` (`TaskID`) ON DELETE CASCADE,
  ADD CONSTRAINT `activitylog_ibfk_2` FOREIGN KEY (`ModifiedBy`) REFERENCES `useraccounts` (`AccountID`) ON DELETE CASCADE;

--
-- Constraints for table `alarmeventlog`
--
ALTER TABLE `alarmeventlog`
  ADD CONSTRAINT `alarmeventlog_ibfk_1` FOREIGN KEY (`MeasurementID`) REFERENCES `wheelmeasurements` (`MeasurementID`) ON DELETE CASCADE;

--
-- Constraints for table `alarmsettings`
--
ALTER TABLE `alarmsettings`
  ADD CONSTRAINT `alarmsettings_ibfk_1` FOREIGN KEY (`SettingsID`) REFERENCES `warningsettings` (`SettingsID`) ON DELETE CASCADE,
  ADD CONSTRAINT `alarmsettings_ibfk_2` FOREIGN KEY (`CoachID`) REFERENCES `coachdetails` (`CoachID`) ON DELETE CASCADE;

--
-- Constraints for table `assetregister`
--
ALTER TABLE `assetregister`
  ADD CONSTRAINT `assetregister_ibfk_1` FOREIGN KEY (`CoachID`) REFERENCES `coachdetails` (`CoachID`) ON DELETE CASCADE;

--
-- Constraints for table `axlespercoach`
--
ALTER TABLE `axlespercoach`
  ADD CONSTRAINT `axlespercoach_ibfk_1` FOREIGN KEY (`CoachID`) REFERENCES `coachdetails` (`CoachID`) ON DELETE CASCADE;

--
-- Constraints for table `manualmeasurements`
--
ALTER TABLE `manualmeasurements`
  ADD CONSTRAINT `manualmeasurements_ibfk_1` FOREIGN KEY (`MeasurementID`) REFERENCES `wheelmeasurements` (`MeasurementID`) ON DELETE CASCADE;

--
-- Constraints for table `planningreportcolumns`
--
ALTER TABLE `planningreportcolumns`
  ADD CONSTRAINT `planningreportcolumns_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `userrole` (`RoleID`) ON DELETE CASCADE,
  ADD CONSTRAINT `planningreportcolumns_ibfk_2` FOREIGN KEY (`ColumnID`) REFERENCES `reportcolumns` (`ColumnID`) ON DELETE CASCADE;

--
-- Constraints for table `termsconditions`
--
ALTER TABLE `termsconditions`
  ADD CONSTRAINT `termsconditions_ibfk_1` FOREIGN KEY (`LicenseID`) REFERENCES `systemlicense` (`LicenseID`) ON DELETE CASCADE;

--
-- Constraints for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD CONSTRAINT `useraccounts_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `userrole` (`RoleID`) ON DELETE CASCADE;

--
-- Constraints for table `warningsettings`
--
ALTER TABLE `warningsettings`
  ADD CONSTRAINT `warningsettings_ibfk_1` FOREIGN KEY (`ParamID`) REFERENCES `wheelparameters` (`ParamID`) ON DELETE CASCADE;

--
-- Constraints for table `wearrates`
--
ALTER TABLE `wearrates`
  ADD CONSTRAINT `wearrates_ibfk_1` FOREIGN KEY (`ParamID`) REFERENCES `wheelparameters` (`ParamID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
