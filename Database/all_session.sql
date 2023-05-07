-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 07, 2023 at 11:09 AM
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
-- Table structure for table `all_session`
--

DROP TABLE IF EXISTS `all_session`;
CREATE TABLE IF NOT EXISTS `all_session` (
  `User_ID` int NOT NULL,
  `qz_ID` int NOT NULL,
  `Total_question` int NOT NULL,
  `Correct_question` int NOT NULL,
  `Time_used` varchar(50) NOT NULL,
  `All_session_ID` int NOT NULL AUTO_INCREMENT,
  `Date` varchar(50) NOT NULL,
  PRIMARY KEY (`All_session_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `all_session`
--

INSERT INTO `all_session` (`User_ID`, `qz_ID`, `Total_question`, `Correct_question`, `Time_used`, `All_session_ID`, `Date`) VALUES
(1, 5, 5, 2, '0:01', 32, '07-05-2023'),
(16, 5, 5, 3, '0:03', 31, '07-05-2023'),
(0, 5, 5, 2, '0:01', 33, '07-05-2023'),
(1, 5, 5, 2, '0:01', 28, '01-05-2023');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
