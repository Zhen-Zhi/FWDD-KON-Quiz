-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2023 at 12:15 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kon_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `Tel` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Email`, `Password`, `DOB`, `Tel`) VALUES
(1, 'zz', 'asd@mail.com', '123', '2023-04-06', '123'),
(2, 'user1', 'user@mail.com', '123123', '2020-12-12', '123123'),
(3, 'zz', 'zz@mail.aca', '1123', '2020-12-12', '123131'),
(4, 'Dr. Vazee', 'vaze@mail.apu', '123', '2020-12-12', '1212123'),
(6, 'user1test123', 'user12@mail.apu', 'aaaaaaaaaa1', '2002-02-11', '123123'),
(7, 'zz', '', 'qwe@123123', '0000-00-00', ''),
(8, '', '', 'aaasdasdasd123', '0000-00-00', ''),
(9, '', '', 'qweqwe123123', '0000-00-00', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
