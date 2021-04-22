-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 29, 2020 at 02:23 PM
-- Server version: 10.3.23-MariaDB-1
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `AppGestionNote`
--

-- --------------------------------------------------------

--
-- Table structure for table `matters`
--

CREATE TABLE `matters` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `wording` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `matter_spinnerets`
--

CREATE TABLE `matter_spinnerets` (
  `id_matter` int(10) UNSIGNED NOT NULL,
  `id_spinneret` int(10) UNSIGNED NOT NULL,
  `coefficient` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `cc1` float NOT NULL DEFAULT 0,
  `cc2` float NOT NULL DEFAULT 0,
  `exam` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `note_students`
--

CREATE TABLE `note_students` (
  `id_student` int(10) UNSIGNED NOT NULL,
  `id_matter` int(10) UNSIGNED NOT NULL,
  `id_note` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registereds`
--

CREATE TABLE `registereds` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_student` int(10) UNSIGNED NOT NULL,
  `id_spinneret` int(10) UNSIGNED NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `spinnerets`
--

CREATE TABLE `spinnerets` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `wording` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `matricule` bigint(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `matters`
--
ALTER TABLE `matters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `matter_spinnerets`
--
ALTER TABLE `matter_spinnerets`
  ADD KEY `fk_id_matter` (`id_matter`),
  ADD KEY `fk_id_spinneret` (`id_spinneret`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note_students`
--
ALTER TABLE `note_students`
  ADD KEY `fk_students_note` (`id_student`),
  ADD KEY `fk_matters_note` (`id_matter`),
  ADD KEY `fk_notes_note` (`id_note`);

--
-- Indexes for table `registereds`
--
ALTER TABLE `registereds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_spinnerets` (`id_spinneret`),
  ADD KEY `fk_students` (`id_student`);

--
-- Indexes for table `spinnerets`
--
ALTER TABLE `spinnerets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricule` (`matricule`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matters`
--
ALTER TABLE `matters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registereds`
--
ALTER TABLE `registereds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spinnerets`
--
ALTER TABLE `spinnerets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matter_spinnerets`
--
ALTER TABLE `matter_spinnerets`
  ADD CONSTRAINT `fk_id_matter` FOREIGN KEY (`id_matter`) REFERENCES `matters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_spinneret` FOREIGN KEY (`id_spinneret`) REFERENCES `spinnerets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `note_students`
--
ALTER TABLE `note_students`
  ADD CONSTRAINT `fk_matters_note` FOREIGN KEY (`id_matter`) REFERENCES `matters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_notes_note` FOREIGN KEY (`id_note`) REFERENCES `notes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_students_note` FOREIGN KEY (`id_student`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registereds`
--
ALTER TABLE `registereds`
  ADD CONSTRAINT `fk_spinnerets` FOREIGN KEY (`id_spinneret`) REFERENCES `spinnerets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_students` FOREIGN KEY (`id_student`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
