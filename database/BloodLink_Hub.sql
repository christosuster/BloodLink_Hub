-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 10:28 PM
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
  `Pulse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bloodinformation`
--

INSERT INTO `bloodinformation` (`BloodInfoID`, `Username`, `RhFactor`, `Haemoglobin`, `BP`, `Pulse`) VALUES
(1, 'chris@gmail.com', 'Positive', 15, '90', 120);

-- --------------------------------------------------------

--
-- Table structure for table `diseasehistory`
--

CREATE TABLE `diseasehistory` (
  `Username` varchar(32) DEFAULT NULL,
  `DiseaseHistoryID` int(11) NOT NULL,
  `AIDS` tinyint(1) DEFAULT NULL,
  `TB` tinyint(1) DEFAULT NULL,
  `Others` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(3, 'chris@gmail.com', '2023-12-14', 'O-', 'Red Cells', 1000, 68, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donationrequest`
--

CREATE TABLE `donationrequest` (
  `CreatedBy` varchar(32) DEFAULT NULL,
  `BloodType` varchar(3) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `CreatedOn` date DEFAULT NULL,
  `HospitalName` varchar(100) DEFAULT NULL,
  `HospitalAddress` varchar(200) DEFAULT NULL,
  `DonationRequestID` int(11) NOT NULL,
  `NeededOn` date DEFAULT NULL,
  `PatientName` varchar(32) DEFAULT NULL,
  `PatientAge` int(11) DEFAULT NULL,
  `DonationType` varchar(32) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `RequestActive` tinyint(1) DEFAULT 1,
  `ExpiryDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `donationrequest`
--

INSERT INTO `donationrequest` (`CreatedBy`, `BloodType`, `Quantity`, `CreatedOn`, `HospitalName`, `HospitalAddress`, `DonationRequestID`, `NeededOn`, `PatientName`, `PatientAge`, `DonationType`, `Description`, `RequestActive`, `ExpiryDate`) VALUES
('chris2@gmail.com', 'A+', 300, '2023-12-05', 'Square', 'Shaymoli', 64, '2023-12-18', 'Chris', 12, 'Blood', 'Gimme blood rawr', 1, '2023-12-16'),
('chris2@gmail.com', 'AB+', 100, '2023-12-09', 'Apollo', 'Dhaka', 65, '2023-12-12', 'Patema', 13, 'Platelets', 'Help need blood', 1, '2023-12-16'),
('Christos Uster', 'B+', 200, '2023-12-10', 'Square Hospital', 'Kajipara, Mirpurpur, Dhaka', 66, '2023-12-13', 'Junayed Hossain', 15, 'Plasma', 'Help help please', 1, '2023-12-16'),
('test1', 'A+', 400, '2023-12-10', 'Al Razhi', 'Farmgate, Dhaka, 1215', 67, '2023-12-12', 'Md Sheikh Russel', 45, 'Blood', 'Need plasma quick', 1, '2023-12-16'),
('promy@gmail.com', 'O-', 1000, '2023-12-10', 'Holy Family', 'Kakrail, Dhaka', 68, '2023-12-14', 'Mathew Roy', 56, 'Red Cells', 'Red cells needed for accident victim', 1, '2023-12-10'),
('promy@gmail.com', 'A+', 500, '2023-12-10', 'TEST HOSPITAL', 'TEST ADDRESS', 69, '2023-12-12', 'TEST PATIENT', 43, 'Blood', 'THIS IS A TEST', 1, '2023-12-16'),
('promy@gmail.com', 'AB+', 1000, '2023-12-11', 'Ali Baba Hospital', 'China', 70, '2023-12-14', 'Aladin', 24, 'Platelets', 'Plz help!!!', 1, '2023-12-16'),
('promy@gmail.com', 'A+', 500, '2023-12-11', 'TEST 2', 'TEST 2', 71, '2023-12-13', 'TEST 2', 55, 'Blood', 'TEST 2', 1, '2023-12-16');

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
  `AdditionalNotes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `donorapplication`
--

INSERT INTO `donorapplication` (`DonorApplicationID`, `IsActive`, `DonorUsername`, `DonationRequestID`, `ApplicationDate`, `AdditionalNotes`) VALUES
(16, 1, 'chris@gmail.com', 69, NULL, NULL),
(19, 1, 'chris@gmail.com', 68, NULL, NULL),
(22, 1, 'promy@gmail.com', 67, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `HospitalID` varchar(20) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Location` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `VerifiedOn` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Pass`, `PhoneNo`, `Role`, `BloodType`, `DOB`, `NumberOfDonations`, `isDonor`, `HospitalID`, `Name`, `Address`, `Gender`, `VerifiedOn`) VALUES
('chris2@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01725463259', 'user', NULL, '2021-01-06', 0, 0, NULL, 'Chris2', 'Dhaka', NULL, NULL),
('chris5@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'user', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
('chris@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01847524569', 'user', 'B+', '2013-12-18', 0, 0, NULL, 'Chris', 'Mohammadpur, Tejgaon, Dhaka, 1217', NULL, NULL),
('Christos Uster', '827ccb0eea8a706c4c34a16891f84e7b', '01754289654', 'user', NULL, '1990-12-14', 0, 0, NULL, 'Christos Uster Biswas', 'Monipuripara, Dhaka, Bangladesh, 1215', NULL, NULL),
('fatema@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'user', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
('promy@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '01658974236', 'user', NULL, '2000-12-07', 0, 0, NULL, 'Fatema Promy', 'Shikdar, Mohammadpur, Dhaka', NULL, NULL),
('test1', '827ccb0eea8a706c4c34a16891f84e7b', '01542865749', 'user', NULL, '2001-12-08', 0, 0, NULL, 'Test User 1', 'Dhaka, Bangladesh', NULL, NULL);

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
  MODIFY `BloodInfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diseasehistory`
--
ALTER TABLE `diseasehistory`
  MODIFY `DiseaseHistoryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donationhistory`
--
ALTER TABLE `donationhistory`
  MODIFY `DonationHistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donationrequest`
--
ALTER TABLE `donationrequest`
  MODIFY `DonationRequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `donorapplication`
--
ALTER TABLE `donorapplication`
  MODIFY `DonorApplicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
