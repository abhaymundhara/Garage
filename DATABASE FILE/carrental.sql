-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 04:49 PM
-- Server version: 5.6.21
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Garage`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE IF NOT EXISTS `cars` (
`car_id` int(20) NOT NULL,
  `car_name` varchar(50) NOT NULL,
  `car_nameplate` varchar(50) NOT NULL,
  `car_regno` varchar(50) NOT NULL,
  `car_regname` varchar(50) NOT NULL,
  `car_color` varchar(50) NOT NULL,
  `insurance_expiry` varchar(50) NOT NULL,
  `rc_expiry` varchar(50) NOT NULL,
  `next_service` varchar(50) NOT NULL,
  `last_service` varchar(50) NOT NULL,
  `car_img` varchar(50) DEFAULT 'NA',
  `car_availability` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `car_nameplate`, `car_regno`, `car_regname`,`car_color`,`insurance_expiry`,`rc_expiry`,`last_service`,`next_service`,`car_availability`) VALUES
(1, 'Audi A4', 'GA3KA6969', '12345', 'Abhay', 'white', '29/05/2029', '29/05/2029', '29/05/2029', '29/05/2029', 'assets/img/cars/audi-a4.jpg','yes'),
(2, 'Hyundai Creta', 'BA2CH2020', '54646', 'Abhay', 'white', '29/05/2029', '29/05/2029', '29/05/2029', '29/05/2029', 'assets/img/cars/creta.jpg', 'yes'),
(3, 'BMW 6-Series', 'BA10PA5555', '98767', 'Manoj', 'blue', '29/05/2029', '29/05/2029', '29/05/2029', '29/05/2029', 'assets/img/cars/bmw6.jpg', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `employeecars`
--

CREATE TABLE IF NOT EXISTS `employeecars` (
  `car_id` int(20) NOT NULL,
  `employee_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employeecars`
--

INSERT INTO `employeecars` (`car_id`, `employee_username`) VALUES
(1, 'harry'),
(3, 'jenny'),
(2, 'tom');

-- --------------------------------------------------------

-- Table structure for table `employees`
CREATE TABLE IF NOT EXISTS `employees` (
  `employee_username` varchar(50) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `employee_phone` varchar(15) NOT NULL,
  `employee_email` varchar(25) NOT NULL,
  `employee_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `employee_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_username`, `employee_name`, `employee_phone`, `employee_email`, `employee_address`, `employee_password`) VALUES
('harry', 'Harry Den', '9876543210', 'harryden@gmail.com', '2477  Harley Vincent Drive', 'password'),
('jenny', 'Jeniffer Washington', '7850000069', 'washjeni@gmail.com', '4139  Mesa Drive', 'jenny'),
('tom', 'Tommy Doee', '900696969', 'tom@gmail.com', '4645  Dawson Drive', 'password');


-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(20) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `dl_number` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_city` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_refby` varchar(50) NOT NULL
  

) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_username`, `customer_name`, `dl_number`, `customer_phone`, `customer_address`, `customer_city`, `customer_email`, `customer_refby`,`employee_username`) VALUES
(1, 'bruno123', 'Bruno Den', 'DL123456', '9547863157', '1782 Vineyard Drive', 'Dubai', 'bruno@example.com', 'reference123', 'harry'),
(2, 'will123', 'Will Williams', 'DL789012', '9147523684', '4354 Hillcrest Drive', 'Abu Dhabi', 'will@example.com', 'reference456', 'jenny'),
(3, 'steeve123', 'Steeve Rogers', 'DL345678', '9147523682', '1506 Skinner Hollow Road', 'Ajman', 'steeve@example.com', 'reference789', 'tom');

-- --------------------------------------------------------

--
-- Table structure for table `rentedcars`
--

CREATE TABLE IF NOT EXISTS `rentedcars` (
`id` int(100) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `car_id` int(20) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `booking_date` date NOT NULL,
  `rent_start_date` date NOT NULL,
  `rent_end_date` date NOT NULL,
  `car_return_date` date DEFAULT NULL,
  `fare` double NOT NULL,
  `no_of_days` int(50) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `return_status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=574681260 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rentedcars`
--

INSERT INTO `rentedcars` (`id`, `customer_username`, `car_id`, `customer_id`, `booking_date`, `rent_start_date`, `rent_end_date`, `car_return_date`, `fare`, `no_of_days`, `total_amount`, `return_status`) VALUES
(574681245, 'bruno123', 2, 1, '2018-07-18', '2018-07-01', '2018-07-02', '2018-07-18', 11, 1, 5884, 'R'),
(574681246, 'will123', 3, 2, '2018-07-18', '2018-06-01', '2018-06-28', '2018-07-18', 15, 27, 5035, 'R'),
(574681247, 'steeve123', 1, 3, '2018-07-18', '2018-07-19', '2018-07-22', '2018-07-20', 13, 3, 5473, 'R');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
 ADD PRIMARY KEY (`car_id`), ADD UNIQUE KEY `car_nameplate` (`car_nameplate`);

--
-- Indexes for table `employeecars`
--
ALTER TABLE `employeecars`
 ADD PRIMARY KEY (`car_id`), ADD KEY `employee_username` (`employee_username`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`employee_username`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`customer_id`), ADD UNIQUE KEY `dl_number` (`dl_number`), ADD KEY `employee_username` (`employee_username`);

--
-- Indexes for table `rentedcars`
--
ALTER TABLE `rentedcars`
 ADD PRIMARY KEY (`id`), ADD KEY `customer_username` (`customer_username`), ADD KEY `car_id` (`car_id`), ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
MODIFY `car_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `customer`
MODIFY `customer_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rentedcars`
--
ALTER TABLE `rentedcars`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=574681248;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customercars`
--
AALTER TABLE `employeecars`
ADD CONSTRAINT `employeecars_ibfk_1` FOREIGN KEY (`employee_username`) REFERENCES `employees` (`employee_username`),
ADD CONSTRAINT `employeecars_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`employee_username`) REFERENCES `employees` (`employee_username`);

--
-- Constraints for table `rentedcars`
--
ALTER TABLE `rentedcars`
ADD CONSTRAINT `rentedcars_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`),
ADD CONSTRAINT `rentedcars_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
