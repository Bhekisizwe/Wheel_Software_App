-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2018 at 09:59 PM
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
(58, 15, 3, 'C');

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
  `CoachNumber` text NOT NULL,
  `DateCreated` date NOT NULL
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
  `WS` double NOT NULL,
  `GibsonDescription` text NOT NULL
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
(132, 2, 1, 1),
(133, 2, 2, 1),
(134, 2, 3, 1),
(135, 2, 4, 1),
(136, 2, 5, 1),
(137, 2, 6, 1),
(138, 2, 7, 1),
(139, 2, 8, 1);

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
(552, 'CSIR', 1, 'C13 Windmills, Muller South Street', 'Buccleuch', 'Johannesburg', 'South Africa', '2066', 5);

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
(1, 1, 'Mzimkhulu', 'Mthethwa', '305941', 'bmthethwa@gqunsueng.co.za', '65f576a7ab0e93059028fbfec1126773', 1);

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
(15, 'Baby');

-- --------------------------------------------------------

--
-- Table structure for table `warningsettings`
--

CREATE TABLE `warningsettings` (
  `SettingsID` int(11) NOT NULL,
  `WarningLevel` double NOT NULL,
  `ParamID` int(11) NOT NULL
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
  MODIFY `LogID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4941;

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
  MODIFY `AssetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `axlecoachmapping`
--
ALTER TABLE `axlecoachmapping`
  MODIFY `MappingID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `axlespercoach`
--
ALTER TABLE `axlespercoach`
  MODIFY `AxlesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coachdetails`
--
ALTER TABLE `coachdetails`
  MODIFY `CoachID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `distancetravelled`
--
ALTER TABLE `distancetravelled`
  MODIFY `DistanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manualmeasurements`
--
ALTER TABLE `manualmeasurements`
  MODIFY `ManualID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `LicenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=553;

--
-- AUTO_INCREMENT for table `termsconditions`
--
ALTER TABLE `termsconditions`
  MODIFY `TermsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

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
  MODIFY `ReprofilingID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
