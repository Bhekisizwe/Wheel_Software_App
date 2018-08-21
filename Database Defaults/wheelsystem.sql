-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2018 at 11:33 PM
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
  `ActivityRights` text NOT NULL
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
(146, 45, 1, 'C R'),
(147, 45, 2, 'C R U D'),
(148, 45, 3, 'R'),
(149, 46, 1, 'C R'),
(150, 46, 2, 'C R U D'),
(151, 46, 3, 'R'),
(152, 47, 1, 'C R'),
(153, 47, 2, 'C R U D'),
(154, 47, 3, 'R'),
(155, 48, 1, 'C R'),
(156, 48, 2, 'C R U D'),
(157, 48, 3, 'R'),
(158, 49, 1, 'C R'),
(159, 49, 2, 'C R U D'),
(160, 49, 3, 'R'),
(161, 50, 1, 'C R'),
(162, 50, 2, 'C R U D'),
(163, 50, 3, 'R'),
(164, 51, 1, 'C R'),
(165, 51, 2, 'C R U D'),
(166, 51, 3, 'R'),
(167, 52, 1, 'C R'),
(168, 52, 2, 'C R U D'),
(169, 52, 3, 'R'),
(170, 53, 1, 'C R'),
(171, 53, 2, 'C R U D'),
(172, 53, 3, 'R'),
(173, 54, 1, 'C R'),
(174, 54, 2, 'C R U D'),
(175, 54, 3, 'R'),
(176, 55, 1, 'C R'),
(177, 55, 2, 'C R U D'),
(178, 55, 3, 'R'),
(179, 56, 1, 'C R'),
(180, 56, 2, 'C R U D'),
(181, 56, 3, 'R'),
(182, 57, 1, 'C R'),
(183, 57, 2, 'C R U D'),
(184, 57, 3, 'R'),
(185, 58, 1, 'C R'),
(186, 58, 2, 'C R U D'),
(187, 58, 3, 'R'),
(188, 59, 1, 'C R'),
(189, 59, 2, 'C R U D'),
(190, 59, 3, 'R'),
(191, 60, 1, 'C R'),
(192, 60, 2, 'C R U D'),
(193, 60, 3, 'R'),
(194, 61, 1, 'C R'),
(195, 61, 2, 'C R U D'),
(196, 61, 3, 'R'),
(197, 62, 1, 'C R'),
(198, 62, 2, 'C R U D'),
(199, 62, 3, 'R'),
(200, 63, 1, 'C R'),
(201, 63, 2, 'C R U D'),
(202, 63, 3, 'R'),
(203, 64, 1, 'C R'),
(204, 64, 2, 'C R U D'),
(205, 64, 3, 'R'),
(206, 65, 1, 'C R'),
(207, 65, 2, 'C R U D'),
(208, 65, 3, 'R'),
(209, 66, 1, 'C R'),
(210, 66, 2, 'C R U D'),
(211, 66, 3, 'R'),
(212, 67, 1, 'C R'),
(213, 67, 2, 'C R U D'),
(214, 67, 3, 'R'),
(215, 68, 1, 'C R'),
(216, 68, 2, 'C R U D'),
(217, 68, 3, 'R'),
(218, 69, 1, 'C R'),
(219, 69, 2, 'C R U D'),
(220, 69, 3, 'R'),
(221, 70, 1, 'C R'),
(222, 70, 2, 'C R U D'),
(223, 70, 3, 'R'),
(224, 71, 1, 'C R'),
(225, 71, 2, 'C R U D'),
(226, 71, 3, 'R'),
(227, 72, 1, 'C R'),
(228, 72, 2, 'C R U D'),
(229, 72, 3, 'R'),
(230, 73, 1, 'C R'),
(231, 73, 2, 'C R U D'),
(232, 73, 3, 'R'),
(233, 74, 1, 'C R'),
(234, 74, 2, 'C R U D'),
(235, 74, 3, 'R'),
(236, 75, 1, 'C R'),
(237, 75, 2, 'C R U D'),
(238, 75, 3, 'R'),
(239, 76, 1, 'C R'),
(240, 76, 2, 'C R U D'),
(241, 76, 3, 'R'),
(242, 77, 1, 'C R'),
(243, 77, 2, 'C R U D'),
(244, 77, 3, 'R'),
(245, 78, 1, 'C R'),
(246, 78, 2, 'C R U D'),
(247, 78, 3, 'R'),
(248, 79, 1, 'C R'),
(249, 79, 2, 'C R U D'),
(250, 79, 3, 'R'),
(251, 80, 1, 'C R'),
(252, 80, 2, 'C R U D'),
(253, 80, 3, 'R'),
(254, 81, 1, 'C R'),
(255, 81, 2, 'C R U D'),
(256, 81, 3, 'R'),
(257, 82, 1, 'C R'),
(258, 82, 2, 'C R U D'),
(259, 82, 3, 'R'),
(260, 83, 1, 'C R'),
(261, 83, 2, 'C R U D'),
(262, 83, 3, 'R'),
(263, 84, 1, 'C R'),
(264, 84, 2, 'C R U D'),
(265, 84, 3, 'R'),
(266, 85, 1, 'C R'),
(267, 85, 2, 'C R U D'),
(268, 85, 3, 'R'),
(269, 86, 1, 'C R'),
(270, 86, 2, 'C R U D'),
(271, 86, 3, 'R'),
(272, 87, 1, 'C R'),
(273, 87, 2, 'C R U D'),
(274, 87, 3, 'R'),
(275, 88, 1, 'C R'),
(276, 88, 2, 'C R U D'),
(277, 88, 3, 'R'),
(278, 89, 1, 'C R'),
(279, 89, 2, 'C R U D'),
(280, 89, 3, 'R'),
(281, 90, 1, 'C R'),
(282, 90, 2, 'C R U D'),
(283, 90, 3, 'R'),
(284, 91, 1, 'C R'),
(285, 91, 2, 'C R U D'),
(286, 91, 3, 'R'),
(287, 92, 1, 'C R'),
(288, 92, 2, 'C R U D'),
(289, 92, 3, 'R'),
(290, 93, 1, 'C R'),
(291, 93, 2, 'C R U D'),
(292, 93, 3, 'R'),
(293, 94, 1, 'C R'),
(294, 94, 2, 'C R U D'),
(295, 94, 3, 'R'),
(296, 95, 1, 'C R'),
(297, 95, 2, 'C R U D'),
(298, 95, 3, 'R'),
(299, 96, 1, 'C R'),
(300, 96, 2, 'C R U D'),
(301, 96, 3, 'R'),
(302, 97, 1, 'C R'),
(303, 97, 2, 'C R U D'),
(304, 97, 3, 'R'),
(305, 98, 1, 'C R'),
(306, 98, 2, 'C R U D'),
(307, 98, 3, 'R'),
(308, 99, 1, 'C R'),
(309, 99, 2, 'C R U D'),
(310, 99, 3, 'R'),
(311, 100, 1, 'C R'),
(312, 100, 2, 'C R U D'),
(313, 100, 3, 'R'),
(314, 101, 1, 'C R'),
(315, 101, 2, 'C R U D'),
(316, 101, 3, 'R'),
(317, 102, 1, 'C R'),
(318, 102, 2, 'C R U D'),
(319, 102, 3, 'R'),
(320, 103, 1, 'C R'),
(321, 103, 2, 'C R U D'),
(322, 103, 3, 'R'),
(323, 104, 1, 'C R'),
(324, 104, 2, 'C R U D'),
(325, 104, 3, 'R'),
(326, 105, 1, 'C R'),
(327, 105, 2, 'C R U D'),
(328, 105, 3, 'R');

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
(7, 'Coach Asset Register  Management'),
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
(339, 4, 'Updating Re-profiling Data', 2, 1, '2018-08-21', '23:25:52'),
(340, 5, 'Manually adding Asset to Database', 1, 1, '2018-08-21', '23:26:01'),
(341, 5, 'Manually adding Asset to Database', 1, 1, '2018-08-21', '23:26:01'),
(342, 5, 'Manually adding Asset to Database', 1, 1, '2018-08-21', '23:26:01'),
(343, 5, 'Manually adding Asset to Database', 1, 1, '2018-08-21', '23:26:01'),
(344, 5, 'Manually adding Asset to Database', 1, 1, '2018-08-21', '23:26:01'),
(345, 5, 'Manually adding Asset to Database', 1, 1, '2018-08-21', '23:26:01'),
(346, 5, 'Manually adding Asset to Database', 1, 1, '2018-08-21', '23:26:01'),
(347, 5, 'Updating Asset in Database', 2, 1, '2018-08-21', '23:26:02'),
(348, 1, 'Adding System License Information to Database', 1, 1, '2018-08-21', '23:26:02'),
(349, 1, 'Updating System License Information in Database', 2, 1, '2018-08-21', '23:26:03'),
(350, 6, 'Updating User Password for Staff Number:305941', 2, 1, '2018-08-21', '23:26:04'),
(351, 1, 'Adding System Terms and Conditions to Database', 1, 1, '2018-08-21', '23:26:05'),
(352, 1, 'Updating System Terms and Conditions in Database', 2, 1, '2018-08-21', '23:26:06'),
(353, 6, 'Adding User Account to Database', 1, 1, '2018-08-21', '23:26:07'),
(354, 6, 'Adding User Account to Database', 1, 1, '2018-08-21', '23:26:08'),
(355, 6, 'Adding User Account to Database', 1, 1, '2018-08-21', '23:26:09'),
(356, 6, 'Adding User Account to Database', 1, 1, '2018-08-21', '23:26:10'),
(357, 6, 'Adding User Account to Database', 1, 1, '2018-08-21', '23:26:11'),
(358, 6, 'Adding User Account to Database', 1, 1, '2018-08-21', '23:26:12'),
(359, 7, 'Adding User Role information to Database', 1, 1, '2018-08-21', '23:26:14'),
(360, 7, 'Updating User Role information in Database', 2, 1, '2018-08-21', '23:26:14');

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
(8, 'MiniProf Wheel Measurements');

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

-- --------------------------------------------------------

--
-- Table structure for table `alarmsettings`
--

CREATE TABLE `alarmsettings` (
  `AlarmID` int(11) NOT NULL,
  `SettingsID` int(11) NOT NULL,
  `AlarmLevel` double NOT NULL,
  `NorminalLevel` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assetregister`
--

CREATE TABLE `assetregister` (
  `AssetID` int(11) NOT NULL,
  `CoachNumber` text NOT NULL,
  `CoachID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `axlecoachmapping`
--

CREATE TABLE `axlecoachmapping` (
  `MappingID` bigint(20) UNSIGNED NOT NULL,
  `AxleSerialNumber` text NOT NULL,
  `AxleNumber` int(11) NOT NULL,
  `SetNumber` text NOT NULL,
  `CoachNumber` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `distancetravelled`
--

CREATE TABLE `distancetravelled` (
  `DistanceID` int(11) NOT NULL,
  `Distance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `WS` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(24, 15, 1, 1),
(25, 15, 2, 0),
(84, 45, 1, 0),
(85, 45, 2, 1),
(86, 46, 1, 0),
(87, 46, 2, 1),
(88, 47, 1, 0),
(89, 47, 2, 1),
(90, 48, 1, 0),
(91, 48, 2, 1),
(92, 49, 1, 0),
(93, 49, 2, 1),
(94, 50, 1, 0),
(95, 50, 2, 1),
(96, 51, 1, 0),
(97, 51, 2, 1),
(98, 52, 1, 0),
(99, 52, 2, 1),
(100, 53, 1, 0),
(101, 53, 2, 1),
(102, 54, 1, 0),
(103, 54, 2, 1),
(104, 55, 1, 0),
(105, 55, 2, 1),
(106, 56, 1, 0),
(107, 56, 2, 1),
(108, 57, 1, 0),
(109, 57, 2, 1),
(110, 58, 1, 0),
(111, 58, 2, 1),
(112, 59, 1, 0),
(113, 59, 2, 1),
(114, 60, 1, 0),
(115, 60, 2, 1),
(116, 61, 1, 0),
(117, 61, 2, 1),
(118, 62, 1, 0),
(119, 62, 2, 1),
(120, 63, 1, 0),
(121, 63, 2, 1),
(122, 64, 1, 0),
(123, 64, 2, 1),
(124, 65, 1, 0),
(125, 65, 2, 1),
(126, 66, 1, 0),
(127, 66, 2, 1),
(128, 67, 1, 0),
(129, 67, 2, 1),
(130, 68, 1, 0),
(131, 68, 2, 1),
(132, 69, 1, 0),
(133, 69, 2, 1),
(134, 70, 1, 0),
(135, 70, 2, 1),
(136, 71, 1, 0),
(137, 71, 2, 1),
(138, 72, 1, 0),
(139, 72, 2, 1),
(140, 73, 1, 0),
(141, 73, 2, 1),
(142, 74, 1, 0),
(143, 74, 2, 1),
(144, 75, 1, 0),
(145, 75, 2, 1),
(146, 76, 1, 0),
(147, 76, 2, 1),
(148, 77, 1, 0),
(149, 77, 2, 1),
(150, 78, 1, 0),
(151, 78, 2, 1),
(152, 79, 1, 0),
(153, 79, 2, 1),
(154, 80, 1, 0),
(155, 80, 2, 1),
(156, 81, 1, 0),
(157, 81, 2, 1),
(158, 82, 1, 0),
(159, 82, 2, 1),
(160, 83, 1, 0),
(161, 83, 2, 1),
(162, 84, 1, 0),
(163, 84, 2, 1),
(164, 85, 1, 0),
(165, 85, 2, 1),
(166, 86, 1, 0),
(167, 86, 2, 1),
(168, 87, 1, 0),
(169, 87, 2, 1),
(170, 88, 1, 0),
(171, 88, 2, 1),
(172, 89, 1, 0),
(173, 89, 2, 1),
(174, 90, 1, 0),
(175, 90, 2, 1),
(176, 91, 1, 0),
(177, 91, 2, 1),
(178, 92, 1, 0),
(179, 92, 2, 1),
(180, 93, 1, 0),
(181, 93, 2, 1),
(182, 94, 1, 0),
(183, 94, 2, 1),
(184, 95, 1, 0),
(185, 95, 2, 1),
(186, 96, 1, 0),
(187, 96, 2, 1),
(188, 97, 1, 0),
(189, 97, 2, 1),
(190, 98, 1, 0),
(191, 98, 2, 1),
(192, 99, 1, 0),
(193, 99, 2, 1),
(194, 100, 1, 0),
(195, 100, 2, 1),
(196, 101, 1, 0),
(197, 101, 2, 1),
(198, 102, 1, 0),
(199, 102, 2, 1),
(200, 103, 1, 0),
(201, 103, 2, 1),
(202, 104, 1, 0),
(203, 104, 2, 1),
(204, 105, 1, 0),
(205, 105, 2, 1);

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
(258, 'CSIR', 1, 'C13 Windmills, Muller South Street', 'Buccleuch', 'Johannesburg', 'South Africa', '2066', 5);

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
(1, 1, 'Mzimkhulu', 'Mthethwa', '305941', 'bmthethwa@gqunsueng.co.za', '65f576a7ab0e93059028fbfec1126773', 0),
(766, 15, 'Bhekisizwe', 'Mthethwa', '305941', 'tshomie2020@yahoo.com', '39990999d8d35bd94934998043d1370d', 1),
(767, 15, 'Bhekisizwe', 'Mthethwa', '305941', 'tshomie2020@yahoo.com', '19802e93c27763c1a3a026c6475beebf', 1),
(768, 15, 'Bhekisizwe', 'Mthethwa', '305941', 'tshomie2020@yahoo.com', 'fd98173289f6279e1997c224d708dccb', 1),
(769, 15, 'Bhekisizwe', 'Mthethwa', '305941', 'tshomie2020@yahoo.com', '1c977940be566ced268e75fe005279c7', 1),
(770, 15, 'Bhekisizwe', 'Mthethwa', '305941', 'tshomie2020@yahoo.com', 'e44d7c1c78473c0affeb54a51ce70d7b', 1);

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
(45, 'Baby'),
(46, 'Baby'),
(47, 'Baby'),
(48, 'Baby'),
(49, 'Baby'),
(50, 'Baby'),
(51, 'Baby'),
(52, 'Baby'),
(53, 'Baby'),
(54, 'Baby'),
(55, 'Baby'),
(56, 'Baby'),
(57, 'Baby'),
(58, 'Baby'),
(59, 'Baby'),
(60, 'Baby'),
(61, 'Baby'),
(62, 'Baby'),
(63, 'Baby'),
(64, 'Baby'),
(65, 'Baby'),
(66, 'Baby'),
(67, 'Baby'),
(68, 'Baby'),
(69, 'Baby'),
(70, 'Baby'),
(71, 'Baby'),
(72, 'Baby'),
(73, 'Baby'),
(74, 'Baby'),
(75, 'Baby'),
(76, 'Baby'),
(77, 'Baby'),
(78, 'Baby'),
(79, 'Baby'),
(80, 'Baby'),
(81, 'Baby'),
(82, 'Baby'),
(83, 'Baby'),
(84, 'Baby'),
(85, 'Baby'),
(86, 'Baby'),
(87, 'Baby'),
(88, 'Baby'),
(89, 'Baby'),
(90, 'Baby'),
(91, 'Baby'),
(92, 'Baby'),
(93, 'Baby'),
(94, 'Baby'),
(95, 'Baby'),
(96, 'Baby'),
(97, 'Baby'),
(98, 'Baby'),
(99, 'Baby'),
(100, 'Baby'),
(101, 'Baby'),
(102, 'Baby'),
(103, 'Baby'),
(104, 'Baby'),
(105, 'Baby');

-- --------------------------------------------------------

--
-- Table structure for table `warningsettings`
--

CREATE TABLE `warningsettings` (
  `SettingsID` int(11) NOT NULL,
  `WarningLevel` double NOT NULL,
  `ParamID` int(11) NOT NULL,
  `CoachID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wearrates`
--

CREATE TABLE `wearrates` (
  `WearID` int(11) NOT NULL,
  `ParamID` int(11) NOT NULL,
  `WearRate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD KEY `SettingsID` (`SettingsID`);

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
  ADD KEY `CoachID` (`CoachID`),
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
  MODIFY `AccessID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `ActivityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `activitylog`
--
ALTER TABLE `activitylog`
  MODIFY `LogID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT for table `activitylogtasks`
--
ALTER TABLE `activitylogtasks`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `alarmeventlog`
--
ALTER TABLE `alarmeventlog`
  MODIFY `RefID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alarmsettings`
--
ALTER TABLE `alarmsettings`
  MODIFY `AlarmID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assetregister`
--
ALTER TABLE `assetregister`
  MODIFY `AssetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `axlecoachmapping`
--
ALTER TABLE `axlecoachmapping`
  MODIFY `MappingID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `axlespercoach`
--
ALTER TABLE `axlespercoach`
  MODIFY `AxlesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coachdetails`
--
ALTER TABLE `coachdetails`
  MODIFY `CoachID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `distancetravelled`
--
ALTER TABLE `distancetravelled`
  MODIFY `DistanceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manualmeasurements`
--
ALTER TABLE `manualmeasurements`
  MODIFY `ManualID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planningreportcolumns`
--
ALTER TABLE `planningreportcolumns`
  MODIFY `PlanningID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `reportcolumns`
--
ALTER TABLE `reportcolumns`
  MODIFY `ColumnID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `systemlicense`
--
ALTER TABLE `systemlicense`
  MODIFY `LicenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `termsconditions`
--
ALTER TABLE `termsconditions`
  MODIFY `TermsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=771;

--
-- AUTO_INCREMENT for table `userrole`
--
ALTER TABLE `userrole`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `warningsettings`
--
ALTER TABLE `warningsettings`
  MODIFY `SettingsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wearrates`
--
ALTER TABLE `wearrates`
  MODIFY `WearID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wheelmeasurements`
--
ALTER TABLE `wheelmeasurements`
  MODIFY `MeasurementID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wheelparameters`
--
ALTER TABLE `wheelparameters`
  MODIFY `ParamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wheelreprofilingdata`
--
ALTER TABLE `wheelreprofilingdata`
  MODIFY `ReprofilingID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `alarmsettings_ibfk_1` FOREIGN KEY (`SettingsID`) REFERENCES `warningsettings` (`SettingsID`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `warningsettings_ibfk_1` FOREIGN KEY (`ParamID`) REFERENCES `wheelparameters` (`ParamID`) ON DELETE CASCADE,
  ADD CONSTRAINT `warningsettings_ibfk_2` FOREIGN KEY (`CoachID`) REFERENCES `coachdetails` (`CoachID`) ON DELETE CASCADE;

--
-- Constraints for table `wearrates`
--
ALTER TABLE `wearrates`
  ADD CONSTRAINT `wearrates_ibfk_1` FOREIGN KEY (`ParamID`) REFERENCES `wheelparameters` (`ParamID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
