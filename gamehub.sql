-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 29, 2023 at 12:36 PM
-- Server version: 8.0.32
-- PHP Version: 8.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `gameinfo`
--

CREATE TABLE `gameinfo` (
  `IDGame` int NOT NULL,
  `IDUSer` int NOT NULL,
  `NameGame` varchar(255) NOT NULL,
  `NameStudio` varchar(255) NOT NULL,
  `Preview` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Genres` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gameinfo`
--

INSERT INTO `gameinfo` (`IDGame`, `IDUSer`, `NameGame`, `NameStudio`, `Preview`, `Description`, `Genres`) VALUES
(1, 15, 'Call of Duty: Warzone', 'Treyarch', '28d404e32.jpg', 'Free-to-play компьютерная игра в жанре многопользовательского шутера от первого лица и королевской битвы, разработанная компаниями Infinity Ward', 'Экшен, Стратегии, Шутеры, PvP, PvE, Кооперативные'),
(2, 15, 'Minecraft', 'Mojang Studios', 'ac738c72b.jpg', 'Компьютерная инди-игра в жанре песочницы, созданная шведским программистом Маркусом Перссоном и выпущенная его студией Mojang AB. В 2009 году Перссон опубликовал начальную версию игры', 'Приключения, Песочницы, PvP, PvE'),
(3, 15, 'Counter-Strike: Global Offensive', 'Counter-Strike: Global Offensive', 'a8444747f.jpg', 'Многопользовательская компьютерная игра, разработанная компаниями Valve и Hidden Path Entertainment', 'Шутеры, PvP, PvE, Кооперативные');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `ID` int NOT NULL,
  `SessionID` varchar(255) NOT NULL,
  `Last_Activity` datetime DEFAULT CURRENT_TIMESTAMP,
  `IDUser` int DEFAULT NULL,
  `Start_Time` datetime(6) DEFAULT NULL,
  `IPAddress` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `IDUser` int NOT NULL,
  `Login` varchar(18) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `DateReg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`IDUser`, `Login`, `Email`, `Password`, `DateReg`) VALUES
(15, 'Darvold', 'rueamvv@mail.ru', '$2y$10$fjOcNyC3nbERtGjVlMOmE.Mbxz9ONhpssqAKC3I/OMiBWOG1GYscq', '2023-08-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gameinfo`
--
ALTER TABLE `gameinfo`
  ADD PRIMARY KEY (`IDGame`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`IDUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gameinfo`
--
ALTER TABLE `gameinfo`
  MODIFY `IDGame` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `IDUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
