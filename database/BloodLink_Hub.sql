-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 10:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodlink_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloodinformation`
--

CREATE TABLE `bloodinformation` (
  `BloodInfoID` int(11) NOT NULL,
  `Username` varchar(32) DEFAULT NULL,
  `RhFactor` varchar(10) DEFAULT NULL,
  `Haemoglobin` float DEFAULT NULL,
  `BP` varchar(10) DEFAULT NULL,
  `Pulse` int(11) DEFAULT NULL,
  `BloodType` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bloodinformation`
--

INSERT INTO `bloodinformation` (`BloodInfoID`, `Username`, `RhFactor`, `Haemoglobin`, `BP`, `Pulse`, `BloodType`) VALUES
(14, 'fatema@gmail.com', 'Positive', 34, '120/80', 90, 'A+');

-- --------------------------------------------------------

--
-- Table structure for table `diseasehistory`
--

CREATE TABLE `diseasehistory` (
  `Username` varchar(32) DEFAULT NULL,
  `DiseaseHistoryID` int(11) NOT NULL,
  `TB` tinyint(1) DEFAULT NULL,
  `HBV` tinyint(1) DEFAULT NULL,
  `HCV` tinyint(1) DEFAULT NULL,
  `HEV` tinyint(1) DEFAULT NULL,
  `HIV` tinyint(1) DEFAULT NULL,
  `HTV` tinyint(1) DEFAULT NULL,
  `Malaria` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `diseasehistory`
--

INSERT INTO `diseasehistory` (`Username`, `DiseaseHistoryID`, `TB`, `HBV`, `HCV`, `HEV`, `HIV`, `HTV`, `Malaria`) VALUES
('fatema@gmail.com', 2, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `donationhistory`
--

CREATE TABLE `donationhistory` (
  `DonationHistoryID` int(11) NOT NULL,
  `Username` varchar(32) DEFAULT NULL,
  `DonationDate` date DEFAULT NULL,
  `BloodType` varchar(5) DEFAULT NULL,
  `DonationType` varchar(20) DEFAULT NULL,
  `DonationAmount` int(11) DEFAULT NULL,
  `DonationRequestID` int(11) DEFAULT NULL,
  `HospitalName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `donationhistory`
--

INSERT INTO `donationhistory` (`DonationHistoryID`, `Username`, `DonationDate`, `BloodType`, `DonationType`, `DonationAmount`, `DonationRequestID`, `HospitalName`) VALUES
(10, 'fatema@gmail.com', '2023-12-18', 'A+', 'Blood', 200, 79, 'Evercare Hospital'),
(11, 'chris@gmail.com', '2023-12-18', 'A+', 'Blood', 200, 79, 'Evercare Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `donationrequest`
--

CREATE TABLE `donationrequest` (
  `CreatedBy` varchar(32) DEFAULT NULL,
  `BloodType` varchar(3) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT NULL,
  `HospitalName` varchar(100) DEFAULT NULL,
  `HospitalAddress` varchar(200) DEFAULT NULL,
  `DonationRequestID` int(11) NOT NULL,
  `NeededOn` date DEFAULT NULL,
  `PatientName` varchar(32) DEFAULT NULL,
  `PatientAge` int(11) DEFAULT NULL,
  `DonationType` varchar(32) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `RequestActive` tinyint(1) DEFAULT 1,
  `ExpiryDate` date DEFAULT NULL,
  `DeactivateOn` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `donationrequest`
--

INSERT INTO `donationrequest` (`CreatedBy`, `BloodType`, `Quantity`, `CreatedOn`, `HospitalName`, `HospitalAddress`, `DonationRequestID`, `NeededOn`, `PatientName`, `PatientAge`, `DonationType`, `Description`, `RequestActive`, `ExpiryDate`, `DeactivateOn`) VALUES
('junayed@gmail.com', 'A+', 200, '2023-12-17 14:47:21', 'Evercare Hospital', 'Plot 81, Block-E, Bashundhara Rd, Dhaka 1229', 79, '2023-12-18', 'Jahangir', 58, 'Blood', 'Patient needs blood due to stroke', 0, '2023-12-21', '2023-12-20 14:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `donorapplication`
--

CREATE TABLE `donorapplication` (
  `DonorApplicationID` int(11) NOT NULL,
  `IsActive` tinyint(1) DEFAULT 1,
  `DonorUsername` varchar(32) DEFAULT NULL,
  `DonationRequestID` int(11) DEFAULT NULL,
  `ApplicationDate` date DEFAULT NULL,
  `AdditionalNotes` varchar(500) DEFAULT NULL,
  `HasDonated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `donorapplication`
--

INSERT INTO `donorapplication` (`DonorApplicationID`, `IsActive`, `DonorUsername`, `DonationRequestID`, `ApplicationDate`, `AdditionalNotes`, `HasDonated`) VALUES
(34, 1, 'fatema@gmail.com', 79, '2023-12-17', NULL, 1),
(36, 1, 'chris@gmail.com', 79, '2023-12-17', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `HospitalID` varchar(20) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Location` varchar(200) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `Division` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`HospitalID`, `Name`, `Location`, `City`, `Division`) VALUES
('labaid', 'LABAID Diagnostic', 'House # 01 & 03, Road-04, Dhanmondi', 'Dhaka', 'Dhaka'),
('SHL', 'Square Hospitals Ltd', '18 Bir Uttam Qazi Nuruzzaman Sarak', 'Panthapath', 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(32) NOT NULL,
  `Pass` varchar(32) DEFAULT NULL,
  `PhoneNo` char(11) DEFAULT NULL,
  `Role` varchar(10) DEFAULT 'user',
  `BloodType` varchar(3) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `NumberOfDonations` int(11) DEFAULT 0,
  `isDonor` tinyint(1) DEFAULT 0,
  `HospitalID` varchar(20) DEFAULT NULL,
  `Name` varchar(32) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Gender` varchar(7) DEFAULT NULL,
  `VerifiedOn` date DEFAULT NULL,
  `VerifiedFrom` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Pass`, `PhoneNo`, `Role`, `BloodType`, `DOB`, `NumberOfDonations`, `isDonor`, `HospitalID`, `Name`, `Address`, `Gender`, `VerifiedOn`, `VerifiedFrom`) VALUES
('admin1@labaid', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'admin', NULL, NULL, 0, 0, 'labaid', 'LABAID Admin 1', NULL, NULL, NULL, NULL),
('admin1@SHL', '827ccb0eea8a706c4c34a16891f84e7b', '01546589457', 'admin', NULL, NULL, 0, 0, 'SHL', 'SHL Administrator 1', NULL, NULL, NULL, NULL),
('admin2@SHL', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'admin', NULL, NULL, 0, 0, 'SHL', 'SHL Administrator 2', NULL, NULL, NULL, NULL),
('chris@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01459874216', 'user', 'O-', '1995-08-26', 0, 0, NULL, 'Chris', 'Mohakhali, Dhaka', 'Male', NULL, NULL),
('fatema@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01752418965', 'user', 'A+', '1990-03-25', 0, 0, NULL, 'Fatema', 'Mohammadpur, Dhaka', 'Female', '2023-12-17', 'SHL'),
('junayed@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01245876549', 'user', 'B-', '1990-08-06', 0, 0, NULL, 'Junayed Hossain', 'Mirpur, Dhaka', 'Male', NULL, NULL),
('thecreator', '827ccb0eea8a706c4c34a16891f84e7b', '01754268549', 'superuser', NULL, NULL, 0, 0, NULL, 'The Creator', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloodinformation`
--
ALTER TABLE `bloodinformation`
  ADD PRIMARY KEY (`BloodInfoID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `diseasehistory`
--
ALTER TABLE `diseasehistory`
  ADD PRIMARY KEY (`DiseaseHistoryID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `donationhistory`
--
ALTER TABLE `donationhistory`
  ADD PRIMARY KEY (`DonationHistoryID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `donationrequest`
--
ALTER TABLE `donationrequest`
  ADD PRIMARY KEY (`DonationRequestID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `donorapplication`
--
ALTER TABLE `donorapplication`
  ADD PRIMARY KEY (`DonorApplicationID`),
  ADD KEY `DonorUsername` (`DonorUsername`),
  ADD KEY `DonationRequestID` (`DonationRequestID`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`HospitalID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`),
  ADD KEY `HospitalID` (`HospitalID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bloodinformation`
--
ALTER TABLE `bloodinformation`
  MODIFY `BloodInfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `diseasehistory`
--
ALTER TABLE `diseasehistory`
  MODIFY `DiseaseHistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donationhistory`
--
ALTER TABLE `donationhistory`
  MODIFY `DonationHistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `donationrequest`
--
ALTER TABLE `donationrequest`
  MODIFY `DonationRequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `donorapplication`
--
ALTER TABLE `donorapplication`
  MODIFY `DonorApplicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bloodinformation`
--
ALTER TABLE `bloodinformation`
  ADD CONSTRAINT `bloodinformation_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

--
-- Constraints for table `diseasehistory`
--
ALTER TABLE `diseasehistory`
  ADD CONSTRAINT `diseasehistory_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

--
-- Constraints for table `donationhistory`
--
ALTER TABLE `donationhistory`
  ADD CONSTRAINT `donationhistory_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

--
-- Constraints for table `donationrequest`
--
ALTER TABLE `donationrequest`
  ADD CONSTRAINT `donationrequest_ibfk_1` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`Username`);

--
-- Constraints for table `donorapplication`
--
ALTER TABLE `donorapplication`
  ADD CONSTRAINT `donorapplication_ibfk_1` FOREIGN KEY (`DonorUsername`) REFERENCES `users` (`Username`),
  ADD CONSTRAINT `donorapplication_ibfk_2` FOREIGN KEY (`DonationRequestID`) REFERENCES `donationrequest` (`DonationRequestID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`HospitalID`) REFERENCES `hospital` (`HospitalID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
