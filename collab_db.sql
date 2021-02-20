-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 25, 2019 at 07:59 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collab_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tb`
--

CREATE TABLE `admin_tb` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(45) DEFAULT NULL,
  `admin_email` varchar(45) DEFAULT NULL,
  `admin_password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_tb`
--

INSERT INTO `admin_tb` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Openja Moses', 'openjamosesopm@gmail.com', '2278a8b7ec17ec76d1f7ce4887e6c0438d0f9f3a');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `configurations_id` int(11) NOT NULL,
  `configurations_storage` varchar(45) DEFAULT NULL,
  `configurations_bill` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contributers`
--

CREATE TABLE `contributers` (
  `contributers_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `contribution_id` int(11) NOT NULL,
  `user_type` varchar(45) DEFAULT NULL,
  `contribution_header` varchar(500) DEFAULT NULL,
  `contribution_body` varchar(100) DEFAULT NULL,
  `contribution_date` varchar(45) DEFAULT NULL,
  `contribution_time` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contribution_tb`
--

CREATE TABLE `contribution_tb` (
  `contribution_id` int(11) NOT NULL,
  `contribution_date` varchar(45) DEFAULT NULL,
  `contribution_time` varchar(45) DEFAULT NULL,
  `contribution_details` varchar(1000) DEFAULT NULL,
  `contribution_title` varchar(500) DEFAULT NULL,
  `study_type_id` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contribution_tb`
--

INSERT INTO `contribution_tb` (`contribution_id`, `contribution_date`, `contribution_time`, `contribution_details`, `contribution_title`, `study_type_id`, `user`) VALUES
(6, '2019-01-25', '07:43:52', 'To identified and analyzed families of apps (Comprising of the main projects and its forks) that are maintained together and that exist both on the official app store (Google Play) as well as on Github to explores clone-based reuse practices for open-source Android apps', 'Clone-based variability management in the android ecosystem', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_tb`
--

CREATE TABLE `event_tb` (
  `event_id` int(11) NOT NULL,
  `event_time` varchar(45) DEFAULT NULL,
  `events` varchar(45) DEFAULT NULL,
  `ipaddress` varchar(45) DEFAULT NULL,
  `login_stats_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `institution_tb`
--

CREATE TABLE `institution_tb` (
  `institution_id` int(11) NOT NULL,
  `institution_name` varchar(500) DEFAULT NULL,
  `institution_country` varchar(45) DEFAULT NULL,
  `institution_logo` varchar(500) DEFAULT NULL,
  `institution_details` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `institution_tb`
--

INSERT INTO `institution_tb` (`institution_id`, `institution_name`, `institution_country`, `institution_logo`, `institution_details`) VALUES
(1, 'Mbarara University of Science and Technology', 'Uganda', 'Mbarara University of Science and Technology_2019012503.', 'Second best public University in Uganda..'),
(2, 'CAMTech Uganda', 'Uganda', 'CAMTech Uganda_2019012503.', 'Innovation center at Mbarara University of Science and Technology');

-- --------------------------------------------------------

--
-- Table structure for table `login_stats`
--

CREATE TABLE `login_stats` (
  `login_stats_id` int(11) NOT NULL,
  `login_date` varchar(45) DEFAULT NULL,
  `login_time` varchar(45) DEFAULT NULL,
  `logout_time` varchar(45) DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `server_instance`
--

CREATE TABLE `server_instance` (
  `instance_id` int(11) NOT NULL,
  `instance_goal` varchar(45) DEFAULT NULL,
  `instance_bill` varchar(45) DEFAULT NULL,
  `server_instancecol` varchar(45) DEFAULT NULL,
  `configurations_id` int(11) NOT NULL,
  `institution_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `study_type`
--

CREATE TABLE `study_type` (
  `study_type_id` int(11) NOT NULL,
  `study_typ` varchar(100) DEFAULT NULL,
  `study_type_desc` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `study_type`
--

INSERT INTO `study_type` (`study_type_id`, `study_typ`, `study_type_desc`) VALUES
(1, 'Health', 'This includes health relation researches.'),
(2, 'Environment', 'Any research related to the environment'),
(3, 'Software Engineering', 'Studies in software maintenance, Evolution , software ecosystem, etc ');

-- --------------------------------------------------------

--
-- Table structure for table `upload_tb`
--

CREATE TABLE `upload_tb` (
  `upload_id` int(11) NOT NULL,
  `upload_type` varchar(45) DEFAULT NULL,
  `upload_name` varchar(500) DEFAULT NULL,
  `upload_path` varchar(500) DEFAULT NULL,
  `contributers_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `users_id` int(11) NOT NULL,
  `users_name` varchar(45) DEFAULT NULL,
  `users_email` varchar(500) DEFAULT NULL,
  `users_password` varchar(500) DEFAULT NULL,
  `user_role_id` int(11) NOT NULL,
  `institution_id` int(11) NOT NULL,
  `users_email2` varchar(500) DEFAULT NULL,
  `users_contact` varchar(100) NOT NULL,
  `users_expertise` varchar(500) NOT NULL,
  `users_address` varchar(400) NOT NULL,
  `users_designation` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`users_id`, `users_name`, `users_email`, `users_password`, `user_role_id`, `institution_id`,`users_email2`,`users_contact`,`users_expertise`,`users_address`,`users_designation`) VALUES
(1, 'Openja Moses', 'openjamosesopm@gmail.com', '2278a8b7ec17ec76d1f7ce4887e6c0438d0f9f3a', 1, 2,'mabvicent94@gmail.com','0759833943','Software developer','Mbarara-Uganda','Mr');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(11) NOT NULL,
  `user_role_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `user_role_name`) VALUES
(1, 'Collaborator'),
(2, 'Lead Team');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tb`
--
ALTER TABLE `admin_tb`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`configurations_id`);

--
-- Indexes for table `contributers`
--
ALTER TABLE `contributers`
  ADD PRIMARY KEY (`contributers_id`),
  ADD KEY `fk_contributers_users_tb1_idx` (`users_id`),
  ADD KEY `fk_contributers_contribution_tb1_idx` (`contribution_id`);

--
-- Indexes for table `contribution_tb`
--
ALTER TABLE `contribution_tb`
  ADD PRIMARY KEY (`contribution_id`),
  ADD KEY `fk_contribution_tb_study_type1_idx` (`study_type_id`);

--
-- Indexes for table `event_tb`
--
ALTER TABLE `event_tb`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `fk_event_tb_login_stats1_idx` (`login_stats_id`);

--
-- Indexes for table `institution_tb`
--
ALTER TABLE `institution_tb`
  ADD PRIMARY KEY (`institution_id`);

--
-- Indexes for table `login_stats`
--
ALTER TABLE `login_stats`
  ADD PRIMARY KEY (`login_stats_id`,`users_id`),
  ADD KEY `fk_login_stats_users_tb1_idx` (`users_id`);

--
-- Indexes for table `server_instance`
--
ALTER TABLE `server_instance`
  ADD PRIMARY KEY (`instance_id`),
  ADD KEY `fk_server_instance_configurations_idx` (`configurations_id`),
  ADD KEY `fk_server_instance_institution_tb1_idx` (`institution_id`);

--
-- Indexes for table `study_type`
--
ALTER TABLE `study_type`
  ADD PRIMARY KEY (`study_type_id`);

--
-- Indexes for table `upload_tb`
--
ALTER TABLE `upload_tb`
  ADD PRIMARY KEY (`upload_id`),
  ADD KEY `fk_upload_tb_contributers1_idx` (`contributers_id`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `fk_users_tb_user_role1_idx` (`user_role_id`),
  ADD KEY `fk_users_tb_institution_tb1_idx` (`institution_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tb`
--
ALTER TABLE `admin_tb`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `configurations_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contributers`
--
ALTER TABLE `contributers`
  MODIFY `contributers_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contribution_tb`
--
ALTER TABLE `contribution_tb`
  MODIFY `contribution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `institution_tb`
--
ALTER TABLE `institution_tb`
  MODIFY `institution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_stats`
--
ALTER TABLE `login_stats`
  MODIFY `login_stats_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `server_instance`
--
ALTER TABLE `server_instance`
  MODIFY `instance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_type`
--
ALTER TABLE `study_type`
  MODIFY `study_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `upload_tb`
--
ALTER TABLE `upload_tb`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contributers`
--
ALTER TABLE `contributers`
  ADD CONSTRAINT `fk_contributers_contribution_tb1` FOREIGN KEY (`contribution_id`) REFERENCES `contribution_tb` (`contribution_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contributers_users_tb1` FOREIGN KEY (`users_id`) REFERENCES `users_tb` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contribution_tb`
--
ALTER TABLE `contribution_tb`
  ADD CONSTRAINT `fk_contribution_tb_study_type1` FOREIGN KEY (`study_type_id`) REFERENCES `study_type` (`study_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `event_tb`
--
ALTER TABLE `event_tb`
  ADD CONSTRAINT `fk_event_tb_login_stats1` FOREIGN KEY (`login_stats_id`) REFERENCES `login_stats` (`login_stats_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `login_stats`
--
ALTER TABLE `login_stats`
  ADD CONSTRAINT `fk_login_stats_users_tb1` FOREIGN KEY (`users_id`) REFERENCES `users_tb` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `server_instance`
--
ALTER TABLE `server_instance`
  ADD CONSTRAINT `fk_server_instance_configurations` FOREIGN KEY (`configurations_id`) REFERENCES `configurations` (`configurations_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_server_instance_institution_tb1` FOREIGN KEY (`institution_id`) REFERENCES `institution_tb` (`institution_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `upload_tb`
--
ALTER TABLE `upload_tb`
  ADD CONSTRAINT `fk_upload_tb_contributers1` FOREIGN KEY (`contributers_id`) REFERENCES `contributers` (`contributers_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD CONSTRAINT `fk_users_tb_institution_tb1` FOREIGN KEY (`institution_id`) REFERENCES `institution_tb` (`institution_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_tb_user_role1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`user_role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
