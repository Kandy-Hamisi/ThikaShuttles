-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2022 at 06:20 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shuttle`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `email`, `passcode`) VALUES
(1, 'Uthman', 'uthman123@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL,
  `shuttle_id` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `customer_id`, `seat_id`, `shuttle_id`, `booking_date`) VALUES
(1, 1, 1, 1, '2022-01-28 16:11:39'),
(2, 1, 1, 1, '2022-01-28 16:19:19'),
(3, 1, 1, 1, '2022-01-28 16:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `national_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `passcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `fname`, `lname`, `gender`, `national_id`, `email`, `contact`, `passcode`) VALUES
(1, 'Halima', 'Ali', 'female', 89201230, 'halimali@gmail.com', '254787934782', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `fullname`, `contact`, `email`) VALUES
(1, 'Rashidi Abdhallah', '254791875270', 'rashid342@gmail.com'),
(2, 'Isaac Munuve', '254782038158', 'isaacmunuve@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `hirings`
--

CREATE TABLE `hirings` (
  `hiring_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shuttle_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `hiring_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hirings`
--

INSERT INTO `hirings` (`hiring_id`, `customer_id`, `shuttle_id`, `price`, `hiring_date`) VALUES
(2, 1, 2, 6300, '2022-01-29 16:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `shuttle_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `customer_id`, `booking_id`, `shuttle_id`, `price`, `payment_date`) VALUES
(1, 1, 1, 1, '50', '2022-01-28 16:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seat_id` int(11) NOT NULL,
  `seat_no` varchar(255) NOT NULL,
  `seat_price` int(11) NOT NULL,
  `seat_status` varchar(255) NOT NULL,
  `shuttle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `seat_no`, `seat_price`, `seat_status`, `shuttle_id`) VALUES
(1, 'KCF-1', 50, 'Booked', 1),
(2, 'KCF-2', 50, 'Available', 1),
(3, 'KCF-3', 50, 'Available', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shuttles`
--

CREATE TABLE `shuttles` (
  `shuttle_id` int(11) NOT NULL,
  `shuttle_no` varchar(255) NOT NULL,
  `shuttle_status` varchar(255) NOT NULL,
  `shuttle_seats` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shuttles`
--

INSERT INTO `shuttles` (`shuttle_id`, `shuttle_no`, `shuttle_status`, `shuttle_seats`, `driver_id`) VALUES
(1, 'KCF980V', 'Available', 14, 1),
(2, 'KDD289R', 'Hired', 14, 2),
(3, 'KBX923C', 'Available', 14, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `shuttle_id` (`shuttle_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `hirings`
--
ALTER TABLE `hirings`
  ADD PRIMARY KEY (`hiring_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `shuttle_id` (`shuttle_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `shuttle_id` (`shuttle_id`);

--
-- Indexes for table `shuttles`
--
ALTER TABLE `shuttles`
  ADD PRIMARY KEY (`shuttle_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hirings`
--
ALTER TABLE `hirings`
  MODIFY `hiring_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shuttles`
--
ALTER TABLE `shuttles`
  MODIFY `shuttle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`shuttle_id`) REFERENCES `shuttles` (`shuttle_id`) ON UPDATE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`shuttle_id`) REFERENCES `shuttles` (`shuttle_id`) ON UPDATE CASCADE;

--
-- Constraints for table `shuttles`
--
ALTER TABLE `shuttles`
  ADD CONSTRAINT `shuttles_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
