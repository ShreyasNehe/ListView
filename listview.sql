-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 11:21 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `listview`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_view`
--

CREATE TABLE `list_view` (
  `checks` tinyint(4) NOT NULL,
  `Invoice Id` int(11) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `Company` varchar(15) NOT NULL,
  `Location` varchar(15) NOT NULL,
  `Due Date` date NOT NULL,
  `Last Connected` datetime NOT NULL,
  `Currency` varchar(15) NOT NULL,
  `Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_view`
--

INSERT INTO `list_view` (`checks`, `Invoice Id`, `Status`, `Company`, `Location`, `Due Date`, `Last Connected`, `Currency`, `Amount`) VALUES
(0, 337, 'zbdsb', 'egsg', 'zbsbd', '2023-11-30', '2023-12-14 23:47:00', 'dsbsb', 47473),
(0, 1001, 'paid', 'log', 'mumbai', '2018-10-03', '2023-12-11 05:19:47', 'USD', 78954),
(0, 1111, 'unpaid', 'microsoft', 'yuww', '2023-12-08', '2023-12-22 11:34:00', 'EURO', 8162),
(0, 1235, 'eher', 'paypal', 'PUNE', '2023-12-14', '2023-12-16 11:32:00', 'usd', 890),
(0, 5747, 'eye', 'sdds', 'sywh', '2023-12-30', '2023-12-09 11:45:00', 'srh', 4711),
(0, 7563, 'paid', 'citi', 'nashik', '2023-12-08', '2023-12-22 11:04:00', 'EURO', 7652),
(0, 7896, 'unpaid', 'SSS', 'vellore', '2023-10-05', '2023-12-10 19:22:42', 'XYZ', 26432),
(0, 9015, 'paid', 'bmc', 'banglore', '2018-10-03', '2023-12-11 05:20:52', 'INR', 3456);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_view`
--
ALTER TABLE `list_view`
  ADD PRIMARY KEY (`Invoice Id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_view`
--
ALTER TABLE `list_view`
  MODIFY `Invoice Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45673;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
