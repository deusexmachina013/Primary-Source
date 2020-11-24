-- phpMyAdmin SQL Dump
-- version 4.9.7deb1bionic1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2020 at 05:35 AM
-- Server version: 10.1.47-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `user_id` int(11) NOT NULL,
  `auth_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rcs`
--

CREATE TABLE `auth_rcs` (
  `user_id` int(11) NOT NULL,
  `rcsid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_courses`
--

CREATE TABLE `catalog_courses` (
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_groups`
--

CREATE TABLE `course_groups` (
  `course_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_single`
--

CREATE TABLE `course_single` (
  `course_id` int(11) NOT NULL,
  `prefix` varchar(4) NOT NULL,
  `number` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `favorited` tinyint(1) NOT NULL,
  `advisor_validated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plan_courses`
--

CREATE TABLE `plan_courses` (
  `semester_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plan_semesters`
--

CREATE TABLE `plan_semesters` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `import_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `completed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `identity` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `class_year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `course_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_course_groups`
--

CREATE TABLE `user_course_groups` (
  `course_group_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_course_group_items`
--

CREATE TABLE `user_course_group_items` (
  `course_group_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_course_rep`
--

CREATE TABLE `user_course_rep` (
  `course_id` int(11) NOT NULL,
  `prefix` varchar(4) NOT NULL,
  `number` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD KEY `fk_auth_user_id` (`user_id`);

--
-- Indexes for table `auth_rcs`
--
ALTER TABLE `auth_rcs`
  ADD KEY `fk_auth_rcs_user_id` (`user_id`);

--
-- Indexes for table `catalog_courses`
--
ALTER TABLE `catalog_courses`
  ADD KEY `fk_catalog_courses_course_id` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_groups`
--
ALTER TABLE `course_groups`
  ADD KEY `fk_course_group_id` (`course_group_id`);

--
-- Indexes for table `course_single`
--
ALTER TABLE `course_single`
  ADD KEY `fk_course_single_course_id` (`course_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_plans_user_id` (`user_id`);

--
-- Indexes for table `plan_courses`
--
ALTER TABLE `plan_courses`
  ADD KEY `fk_plan_courses_course_id` (`course_id`),
  ADD KEY `fk_plan_courses_semester_id` (`semester_id`);

--
-- Indexes for table `plan_semesters`
--
ALTER TABLE `plan_semesters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_plan_semesters_plan_id` (`plan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD KEY `fk_user_courses_course_id` (`course_id`),
  ADD KEY `fk_user_courses_plan_id` (`plan_id`);

--
-- Indexes for table `user_course_groups`
--
ALTER TABLE `user_course_groups`
  ADD KEY `user_course_groups_course_group_id` (`course_group_id`),
  ADD KEY `user_course_groups_plan_id` (`plan_id`);

--
-- Indexes for table `user_course_group_items`
--
ALTER TABLE `user_course_group_items`
  ADD KEY `user_course_group_items_course_group_id` (`course_group_id`),
  ADD KEY `user_course_group_items_course_id` (`course_id`);

--
-- Indexes for table `user_course_rep`
--
ALTER TABLE `user_course_rep`
  ADD KEY `user_course_rep_course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plan_semesters`
--
ALTER TABLE `plan_semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_rcs`
--
ALTER TABLE `auth_rcs`
  ADD CONSTRAINT `fk_auth_rcs_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `catalog_courses`
--
ALTER TABLE `catalog_courses`
  ADD CONSTRAINT `fk_catalog_courses_course_id` FOREIGN KEY (`course_id`) REFERENCES `course_single` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_groups`
--
ALTER TABLE `course_groups`
  ADD CONSTRAINT `fk_course_group_id` FOREIGN KEY (`course_group_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_single`
--
ALTER TABLE `course_single`
  ADD CONSTRAINT `fk_course_single_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `fk_plans_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plan_courses`
--
ALTER TABLE `plan_courses`
  ADD CONSTRAINT `fk_plan_courses_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_plan_courses_semester_id` FOREIGN KEY (`semester_id`) REFERENCES `plan_semesters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plan_semesters`
--
ALTER TABLE `plan_semesters`
  ADD CONSTRAINT `fk_plan_semesters_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD CONSTRAINT `fk_user_courses_course_id` FOREIGN KEY (`course_id`) REFERENCES `course_single` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_courses_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_course_groups`
--
ALTER TABLE `user_course_groups`
  ADD CONSTRAINT `user_course_groups_course_group_id` FOREIGN KEY (`course_group_id`) REFERENCES `course_groups` (`course_group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_course_groups_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_course_group_items`
--
ALTER TABLE `user_course_group_items`
  ADD CONSTRAINT `user_course_group_items_course_group_id` FOREIGN KEY (`course_group_id`) REFERENCES `user_course_groups` (`course_group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_course_group_items_course_id` FOREIGN KEY (`course_id`) REFERENCES `course_single` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_course_rep`
--
ALTER TABLE `user_course_rep`
  ADD CONSTRAINT `user_course_rep_course_id` FOREIGN KEY (`course_id`) REFERENCES `user_courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
