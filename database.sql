-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 11:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shortly`
--

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
                          `id` int(11) NOT NULL,
                          `username` text NOT NULL,
                          `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `username`, `token`) VALUES
                                                     (3, 'Crystiano1210', '03f2f0c4717f02f86edb1dd0da6ec310'),
                                                     (4, 'Admin1', '96e2882f9fd9428b096bb69672bcb6ba'),
                                                     (5, 'Admin1', '620a8fd01856a5070db5a279f8efde7e'),
                                                     (6, 'Admin1', '3050980fab3beb6c8bc21bb0a85b3b38'),
                                                     (7, 'Admin1', 'c05d0208f7bf302483154c97cb9d9f9d');

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
                        `id` int(11) NOT NULL,
                        `username` text DEFAULT NULL,
                        `longURL` text NOT NULL,
                        `shortURL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `username`, `longURL`, `shortURL`) VALUES
                                                                 (8, NULL, 'http://localhost:8080/phpmyadmin/index.php?route=/sql&db=shortly&table=urls&pos=0', 'NjMzO'),
                                                                 (9, NULL, 'http://localhost:8080/phpmyadmin/index.php?route=/sql&db=shortly&table=urls&pos=0', 'N2I3Z'),
                                                                 (10, NULL, 'http://localhost:8080/phpmyadmin/index.php?route=/sql&db=shortly&table=urls&pos=0', 'YjQ3Z'),

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `username` text NOT NULL,
                         `email` text NOT NULL,
                         `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
                                                                (1, 'admin', 'admin@admin.pl', 'haslo'),
                                                                (2, 'Crystiano1210', 'crystiano123@wp.com', '$2y$10$yAT/jDRNiJbJVMEPLVBrielFu.4rsJ/SglSIsXz.7QXiKI9Psjnd2'),
                                                                (3, 'Admin1', 'admin1@admin.pl', '$2y$10$ZXq.e/sOWIbWQnQlEo7lQu62RBsjiWfNgRHKYX3rn7LWmmQVWkpfK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
