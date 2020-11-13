-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 08, 2017 at 10:40 AM
-- Server version: 5.7.19-log
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `date_chng`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `date_chng` (IN `date1` DATE, IN `donor` INT)  NO SQL
    DETERMINISTIC
update Donor set last_donated=date1
where d_id=donor$$

DROP PROCEDURE IF EXISTS `get_new_date`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_new_date` (IN `d_id` INT, OUT `date1` DATE)  NO SQL
BEGIN
select dateofdonation into date1 from blood_donated WHERE did=d_id;
END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `donation_stats`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `donation_stats` (`month` VARCHAR(20), `year` INT(20), `blood` VARCHAR(5)) RETURNS INT(11) begin
declare rbc int;
declare platelets int;
declare plasma int;
declare whole int;
declare total_amt int default 0;
select sum(rbc_amt),sum(platelets_amt),sum(plasma_amt),sum(whole_amt) into rbc,platelets,plasma,whole from blood_donated where monthname(dateofdonation)=month and year(dateofdonation)=year and blood_grp=blood;
set total_amt=(rbc+platelets+plasma+whole)*500;
if total_amt=NULL then
 set total_amt=0;
 end if;
return total_amt;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blood_donated`
--

DROP TABLE IF EXISTS `blood_donated`;
CREATE TABLE IF NOT EXISTS `blood_donated` (
  `bld_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `blood_grp` varchar(3) DEFAULT NULL,
  `rbc_amt` int(11) NOT NULL DEFAULT '0',
  `platelets_amt` int(11) NOT NULL DEFAULT '0',
  `plasma_amt` int(11) NOT NULL DEFAULT '0',
  `whole_amt` int(11) NOT NULL,
  `d_id` bigint(20) DEFAULT NULL,
  `dateofdonation` date DEFAULT NULL,
  `validity` tinyint(1) DEFAULT NULL,
  `b_id` bigint(20) NOT NULL,
  PRIMARY KEY (`bld_id`),
  KEY `donor` (`d_id`),
  KEY `branch` (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_donated`
--

INSERT INTO `blood_donated` (`bld_id`, `blood_grp`, `rbc_amt`, `platelets_amt`, `plasma_amt`, `whole_amt`, `d_id`, `dateofdonation`, `validity`, `b_id`) VALUES
(1, 'A+', 10, 10, 10, 0, 1, '2017-09-14', 1, 1),
(2, 'B+', 50, 50, 50, 100, 2, '2017-10-04', 1, 2),
(5, 'AB+', 20, 20, 20, 100, 5, '2017-10-06', 1, 1),
(6, 'A+', 10, 10, 10, 100, 6, '2017-10-09', 1, 2),
(7, 'A+', 30, 30, 30, 140, 7, '2017-10-09', 1, 2),
(8, 'AB+', 1, 1, 1, 0, 6, '2017-10-19', 1, 1),
(9, 'A+', 2, 2, 2, 2, 1, NULL, 1, 1),
(10, 'A+', 2, 2, 2, 1, 1, NULL, 1, 1),
(11, 'B+', 3, 3, 3, 3, 5, '2017-10-03', 1, 2);

--
-- Triggers `blood_donated`
--
DROP TRIGGER IF EXISTS `stock_inc`;
DELIMITER $$
CREATE TRIGGER `stock_inc` AFTER INSERT ON `blood_donated` FOR EACH ROW begin set @bld_grp=new.blood_grp; set @branch=new.b_id; set @rbc_amount=new.rbc_amt; set @platelets_amount=new.platelets_amt; set @plasma_amount=new.plasma_amt; update Stock set platelets_amt=platelets_amt+@platelets_amount,rbc_amt=rbc_amt+@rbc_amount,plasma_amt=plasma_amt+@plasma_amount where b_id=@branch and blood_grp=@bld_grp;
call date_chng(new.dateofdonation,new.d_id);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blood_request`
--

DROP TABLE IF EXISTS `blood_request`;
CREATE TABLE IF NOT EXISTS `blood_request` (
  `req_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `hp_id` bigint(20) DEFAULT NULL,
  `platelets_amt` int(11) DEFAULT NULL,
  `plasma_amt` int(11) DEFAULT NULL,
  `rbc_amt` int(11) DEFAULT NULL,
  `whole_amt` int(11) NOT NULL DEFAULT '0',
  `blood_grp` varchar(3) NOT NULL,
  `type` varchar(50) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `issuing_date` date DEFAULT NULL,
  `issuing_branch_id` int(11) NOT NULL,
  PRIMARY KEY (`req_no`),
  KEY `req_hosp` (`hp_id`),
  KEY `req_pat` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_request`
--

INSERT INTO `blood_request` (`req_no`, `hp_id`, `platelets_amt`, `plasma_amt`, `rbc_amt`, `whole_amt`, `blood_grp`, `type`, `patient_id`, `total_price`, `issuing_date`, `issuing_branch_id`) VALUES
(1, NULL, 10, 10, 10, 0, 'A+', 'Patient', 1, '170', NULL, 1),
(2, NULL, 10, 10, 10, 0, 'A+', 'Patient', 9, '170', '2012-08-06', 1),
(3, NULL, 10, 10, 10, 0, 'A+', 'Patient', 10, '170', '2017-09-22', 1),
(5, NULL, 2, 2, 2, 0, 'A+', 'Patient', 11, '34', '2017-09-23', 1),
(6, NULL, 2, 2, 2, 0, 'A+', 'Patient', 12, '34', '2017-09-23', 1),
(7, NULL, 2, 2, 2, 0, 'A+', 'Patient', 13, '34', '2017-09-23', 1),
(8, NULL, 2, 2, 2, 0, 'A+', 'Patient', 14, '34', '2017-09-23', 1),
(9, NULL, 2, 2, 2, 0, 'A+', 'Patient', 15, '34', '2017-09-23', 1),
(10, NULL, 2, 2, 2, 0, 'A+', 'Patient', 16, '34', '2017-09-23', 1),
(11, NULL, 2, 2, 2, 0, 'A+', 'Patient', 17, '34', '2017-09-23', 1),
(12, NULL, 2, 2, 2, 0, 'A+', 'Patient', 18, '34', '2017-09-23', 1),
(13, NULL, 2, 2, 2, 0, 'A+', 'Patient', 19, '34', '2017-09-23', 1),
(14, 2, 10, 10, 10, 0, 'A+', 'Hospital', NULL, '170', '2017-09-25', 1),
(15, 2, 10, 10, 10, 0, 'B+', 'Hospital', NULL, '0', '2017-09-25', 1),
(16, 2, 10, 10, 10, 0, 'B+', 'Hospital', NULL, '0', '2017-09-25', 1),
(17, 2, 10, 10, 10, 0, 'B+', 'Hospital', NULL, '300', '2017-09-25', 1),
(18, NULL, 10, 10, 10, 10, 'A+', 'Patient', 20, '170', '2017-10-04', 1),
(19, NULL, 10, 10, 10, 10, 'A+', 'Patient', 21, '270', '2017-10-04', 1),
(20, NULL, 10, 10, 10, 10, 'A+', 'Patient', 22, '270', '2017-10-04', 1),
(21, 2, 10, 10, 10, 10, 'A+', 'Hospital', NULL, '270', '2017-10-04', 1),
(22, 2, 10, 10, 10, 10, 'A+', 'Hospital', NULL, '270', '2017-10-04', 1),
(23, 2, 1, 1, 1, 1, 'A+', 'Hospital', NULL, '27', '2017-10-04', 1),
(24, 2, 1, 1, 1, 1, 'A+', 'Hospital', NULL, '27', '2017-10-04', 1),
(25, 2, 2, 2, 2, 2, 'A+', 'Hospital', NULL, '54', '2017-10-04', 1),
(26, 2, 2, 2, 2, 2, 'A+', 'Hospital', NULL, '54', '2017-10-04', 1),
(27, 2, 3, 3, 3, 3, 'A+', 'Hospital', NULL, '81', '2017-10-04', 1),
(28, 2, 3, 3, 3, 3, 'A+', 'Hospital', NULL, '81', '2017-10-04', 1),
(29, 2, 10, 10, 10, 10, 'B+', 'Hospital', NULL, '300', '2017-10-04', 1),
(30, 2, 10, 10, 10, 10, 'B+', 'Hospital', NULL, '300', '2017-10-04', 1),
(31, NULL, 2, 1, 23, 23, 'A+', 'Patient', 23, '359', '2017-10-05', 1),
(32, NULL, 21, 12, 12, 12, 'A+', 'Patient', 24, '342', '2017-10-05', 1),
(33, NULL, 1, 1, 1, 1, 'A+', 'Patient', 25, '27', '2017-10-05', 1),
(34, NULL, 1, 1, 1, 1, 'A+', 'Patient', 26, '27', '2017-10-05', 1);

--
-- Triggers `blood_request`
--
DROP TRIGGER IF EXISTS `stock_dec`;
DELIMITER $$
CREATE TRIGGER `stock_dec` BEFORE INSERT ON `blood_request` FOR EACH ROW begin
DECLARE bg varchar(3);
declare amt_of_platelets int;
declare amt_of_plasma int;
declare amt_of_whole int;
declare amt_of_rbc int;declare branch int;
set bg=new.blood_grp;
set amt_of_platelets=new.platelets_amt;
set amt_of_plasma=new.plasma_amt;
set amt_of_rbc=new.rbc_amt;
set amt_of_whole=new.whole_amt;
set branch=new.issuing_branch_id;
update Stock set platelets_amt=platelets_amt-amt_of_platelets,plasma_amt=plasma_amt-amt_of_plasma,rbc_amt=rbc_amt-amt_of_rbc,whole_amt=whole_amt-amt_of_whole where b_id=branch and blood_grp=bg;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blood_test`
--

DROP TABLE IF EXISTS `blood_test`;
CREATE TABLE IF NOT EXISTS `blood_test` (
  `bag_no` int(11) NOT NULL,
  `blood_grp` varchar(20) NOT NULL,
  `hiv` varchar(4) NOT NULL,
  `hepb` varchar(4) NOT NULL,
  `hepc` varchar(4) NOT NULL,
  `mp` varchar(4) NOT NULL,
  `vdrl` varchar(4) NOT NULL,
  `donate_id` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`bag_no`),
  KEY `test` (`donate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blood_test`
--

INSERT INTO `blood_test` (`bag_no`, `blood_grp`, `hiv`, `hepb`, `hepc`, `mp`, `vdrl`, `donate_id`) VALUES
(1, 'A+', 'ned', 'neg', 'neg', 'neg', 'neg', NULL),
(3, 'A+', 'neg', 'neg', 'neg', 'neg', 'neg', NULL),
(4, 'AB+', 'neg', 'neg', 'neg', 'neg', 'neg', NULL),
(6, 'AB+', 'neg', 'neg', 'neg', 'neg', 'neg', NULL),
(7, 'AB+', 'neg', 'neg', 'neg', 'neg', 'neg', NULL),
(8, 'AB+', 'neg', 'neg', 'neg', 'neg', 'neg', NULL),
(9, 'AB+', 'neg', 'neg', 'neg', 'neg', 'neg', NULL),
(10, 'AB+', 'neg', 'neg', 'neg', 'neg', 'neg', 8),
(11, 'A+', 'neg', 'neg', 'neg', 'neg', 'neg', 9),
(12, 'A+', 'neg', 'neg', 'neg', 'neg', 'neg', 10),
(13, 'B+', 'neg', 'neg', 'neg', 'neg', 'neg', 11);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `b_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `b_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `area` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`b_id`, `b_name`, `address`, `area`, `phone`, `email`) VALUES
(1, 'Kothrud', 'sfsffaa', 'North', 34324234, 'rrrertydf'),
(2, 'South', 'qwerty', 'South', 1235, 'cxbxxb');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

DROP TABLE IF EXISTS `donor`;
CREATE TABLE IF NOT EXISTS `donor` (
  `d_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `blood_group` varchar(3) NOT NULL,
  `last_donated` date DEFAULT NULL,
  `aadhar_no` bigint(20) NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`d_id`, `blood_group`, `last_donated`, `aadhar_no`) VALUES
(1, 'A+', NULL, 1),
(2, 'A+', '2017-10-04', 14),
(5, 'B+', '2017-10-03', 12),
(6, 'AB+', '2017-10-19', 13),
(7, 'A+', '2017-10-09', 15);

-- --------------------------------------------------------

--
-- Table structure for table `donor_details`
--

DROP TABLE IF EXISTS `donor_details`;
CREATE TABLE IF NOT EXISTS `donor_details` (
  `aadhar_no` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(10) DEFAULT NULL,
  `mobile_no` bigint(20) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `street` varchar(500) NOT NULL,
  `zip` int(11) NOT NULL,
  PRIMARY KEY (`aadhar_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor_details`
--

INSERT INTO `donor_details` (`aadhar_no`, `name`, `dob`, `gender`, `mobile_no`, `email`, `area`, `street`, `zip`) VALUES
(1, 'a', '2017-09-23', 'Male', 1234567890, 'a@gmail.co', 'bb', 'v', 444444),
(12, 'Suraj', '1997-08-19', 'male', 2222222222, 'asd@gmail.com', 'qwer', 'zxcx', 123456),
(13, 'Khan', '1998-02-19', 'female', 99999999999, 'aw@gmail.com', 'zxcv', 'nhu', 878787),
(14, 'a', '2017-09-23', 'Male', 1234567890, 'a@gmail.co', 'bb', 'v', 444444),
(15, 'Siraj', '1988-01-01', 'male', 888888888888, 'zx@gmail.com', 'kothrud', 'mg', 767676);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comments` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `first_name`, `last_name`, `email`, `comments`) VALUES
(1, '', '', '', ''),
(2, '', '', '', ''),
(3, '', '', '', ''),
(4, 'as', 'bvnb', 'yhh', 'hnvn'),
(5, 'as', 'bvnb', 'yhh', 'hnvn'),
(6, 'as', 'xc', 'wewe', 'cvxx');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

DROP TABLE IF EXISTS `hospital`;
CREATE TABLE IF NOT EXISTS `hospital` (
  `hp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `h_name` varchar(500) NOT NULL,
  `phone_no` bigint(20) NOT NULL,
  `email` varchar(300) DEFAULT NULL,
  `street` varchar(500) NOT NULL,
  `area` varchar(100) NOT NULL,
  `zip` int(11) NOT NULL,
  PRIMARY KEY (`hp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hp_id`, `h_name`, `phone_no`, `email`, `street`, `area`, `zip`) VALUES
(1, 'a', 7777777777, 'a@gmail.com', 'h', 'h', 777777),
(2, 'b', 9999999999, 'as@gmail.com', 'a', 'North', 111111);

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

DROP TABLE IF EXISTS `patient_details`;
CREATE TABLE IF NOT EXISTS `patient_details` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(300) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `hosp_id` int(11) NOT NULL,
  `isdonor` varchar(10) DEFAULT NULL,
  `mobile` bigint(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`patient_id`),
  KEY `pat_hosp` (`hosp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`patient_id`, `patient_name`, `age`, `hosp_id`, `isdonor`, `mobile`, `gender`) VALUES
(1, 'abhishek', 18, 1, 'No', 9090909090, 'Male'),
(2, 'abhishek', 18, 1, 'No', 9090909090, 'Male'),
(3, 'abhishek', 18, 1, 'No', 9090909090, 'Male'),
(4, 'abhishek', 18, 1, 'No', 9090909090, 'Male'),
(5, 'abhishek', 18, 1, 'No', 9090909090, 'Male'),
(6, 'abhishek', 18, 1, 'No', 9090909090, 'Male'),
(7, 'abhishek', 18, 1, 'No', 9090909090, 'Male'),
(8, 'abhishek', 18, 1, 'No', 9090909090, 'Male'),
(9, 'abhishek', 18, 1, 'No', 9090909090, 'Male'),
(10, 'abhishek', 18, 1, 'No', 9090909090, 'Male'),
(11, 'apurv', 20, 11, 'No', 9885656665, 'Male'),
(12, 'apurv', 20, 11, 'No', 9885656665, 'Male'),
(13, 'apurv', 20, 11, 'No', 9885656665, 'Male'),
(14, 'apurv', 20, 11, 'No', 9885656665, 'Male'),
(15, 'apurv', 20, 11, 'No', 9885656665, 'Male'),
(16, 'apurv', 20, 11, 'No', 9885656665, 'Male'),
(17, 'apurv', 20, 11, 'No', 9885656665, 'Male'),
(18, 'apurva', 20, 11, 'No', 9885656665, 'Male'),
(19, 'apurva', 20, 11, 'No', 9885656665, 'Male'),
(20, 'bvnm', 6, 21, 'YES', 7877777777, 'Male'),
(21, 'bvnm', 6, 21, 'YES', 7877777777, 'Male'),
(22, 'bvnm', 6, 21, 'YES', 7877777777, 'Male'),
(23, 'abhi', 77, 24, '', 9999999999, 'Male'),
(24, 'a', 1, 1, '', 1, 'Male'),
(25, 'a', 12, 1, '', 12, 'Male'),
(26, 'a', 12, 27, '', 12, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `patient_hospital`
--

DROP TABLE IF EXISTS `patient_hospital`;
CREATE TABLE IF NOT EXISTS `patient_hospital` (
  `s_no` int(11) NOT NULL AUTO_INCREMENT,
  `hosp_name` varchar(300) NOT NULL,
  `street` varchar(300) NOT NULL,
  `area` varchar(300) NOT NULL,
  `zip` int(11) NOT NULL,
  PRIMARY KEY (`s_no`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_hospital`
--

INSERT INTO `patient_hospital` (`s_no`, `hosp_name`, `street`, `area`, `zip`) VALUES
(1, 'a', 'a', 'a', 4),
(2, 'a', 'a', 'a', 4),
(3, 'a', 'a', 'a', 4),
(4, 'a', 'a', 'a', 4),
(5, 'a', 'a', 'a', 4),
(6, 'a', 'a', 'a', 4),
(7, 'a', 'a', 'a', 4),
(8, 'a', 'a', 'a', 4),
(9, 'a', 'a', 'a', 4),
(10, 'a', 'a', 'a', 4),
(11, 'ba', 'ba', 'ba', 31),
(12, 'ba', 'ba', 'ba', 31),
(13, 'ba', 'ba', 'ba', 31),
(14, 'ba', 'ba', 'ba', 31),
(15, 'ba', 'ba', 'ba', 31),
(16, 'ba', 'ba', 'ba', 31),
(17, 'ba', 'ba', 'ba', 31),
(18, 'ba', 'ba', 'ba', 31),
(19, 'ba', 'ba', 'ba', 31),
(20, 'ba', 'ba', 'ba', 31),
(21, 'mmb', 'jkh', 'mj', 999999),
(22, 'mmb', 'jkh', 'mj', 999999),
(23, 'mmb', 'jkh', 'mj', 999999),
(24, 'nm', 'uigb', 'io', 99),
(25, 'a', 'a', 'a', 89),
(26, 'a', 'a', 'a', 12),
(27, 'q', 'q', 'q', 12);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `blood_grp` varchar(3) NOT NULL,
  `rbc_amt` bigint(20) DEFAULT NULL,
  `plasma_amt` bigint(20) DEFAULT NULL,
  `platelets_amt` bigint(20) DEFAULT NULL,
  `whole_amt` int(11) NOT NULL,
  `b_id` bigint(20) NOT NULL,
  PRIMARY KEY (`blood_grp`,`b_id`),
  KEY `b_id` (`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`blood_grp`, `rbc_amt`, `plasma_amt`, `platelets_amt`, `whole_amt`, `b_id`) VALUES
('A+', 15, 29, 19, 23, 1),
('B+', 950, 950, 950, 80, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_price`
--

DROP TABLE IF EXISTS `stock_price`;
CREATE TABLE IF NOT EXISTS `stock_price` (
  `blood_grp` varchar(3) NOT NULL,
  `platelets_price` decimal(8,2) DEFAULT NULL,
  `rbc_price` decimal(8,2) DEFAULT NULL,
  `plasma_price` decimal(8,2) DEFAULT NULL,
  `whole_price` decimal(10,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blood_grp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_price`
--

INSERT INTO `stock_price` (`blood_grp`, `platelets_price`, `rbc_price`, `plasma_price`, `whole_price`) VALUES
('A+', '2.00', '5.00', '10.00', '10'),
('B+', '10.00', '10.00', '10.00', '0');

--
-- Triggers `stock_price`
--
DROP TRIGGER IF EXISTS `check_values`;
DELIMITER $$
CREATE TRIGGER `check_values` BEFORE UPDATE ON `stock_price` FOR EACH ROW BEGIN
if (new.rbc_price<0 or new.rbc_price=NULL) THEN
  SET NEW.rbc_price=old.rbc_price;
end if ;
if (new.plasma_price<0 or new.plasma_price=NULL) then
  SET NEW.plasma_price=old.plasma_price;  
end if;
if (new.platelets_price<0 or new.platelets_price=NULL) THEN
  SET NEW.platelets_price=old.platelets_price;
end if;
  End
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `s_no` bigint(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `type`, `s_no`) VALUES
('abhi', 'abhi', 'donor', 1),
('abhi12', 'abhi12', 'donor', 2),
('admin', 'admin', 'admin', 1000),
('bb', 'bb', 'hospital', 2),
('h', 'h', 'hospital', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_donated`
--
ALTER TABLE `blood_donated`
  ADD CONSTRAINT `branch` FOREIGN KEY (`b_id`) REFERENCES `branch` (`b_id`),
  ADD CONSTRAINT `donor` FOREIGN KEY (`d_id`) REFERENCES `donor` (`d_id`);

--
-- Constraints for table `blood_request`
--
ALTER TABLE `blood_request`
  ADD CONSTRAINT `h_id` FOREIGN KEY (`hp_id`) REFERENCES `hospital` (`hp_id`),
  ADD CONSTRAINT `req_pat` FOREIGN KEY (`patient_id`) REFERENCES `patient_details` (`patient_id`);

--
-- Constraints for table `blood_test`
--
ALTER TABLE `blood_test`
  ADD CONSTRAINT `test` FOREIGN KEY (`donate_id`) REFERENCES `blood_donated` (`bld_id`);

--
-- Constraints for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD CONSTRAINT `pat_hosp` FOREIGN KEY (`hosp_id`) REFERENCES `patient_hospital` (`s_no`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `b_idc` FOREIGN KEY (`b_id`) REFERENCES `branch` (`b_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
