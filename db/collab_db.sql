-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 16, 2019 at 09:51 PM
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
(1, 'Robert Mugonza', 'robert@gmail.com', '2278a8b7ec17ec76d1f7ce4887e6c0438d0f9f3a');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billing_id` int(11) NOT NULL,
  `billing_amount` varchar(45) DEFAULT NULL,
  `billing_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billing_id`, `billing_amount`, `billing_name`) VALUES
(1, '1500', 'Collab Plus'),
(2, '2200', 'Collab Max'),
(3, '5000', 'Collab Premium');

-- --------------------------------------------------------

--
-- Table structure for table `billing_rate`
--

CREATE TABLE `billing_rate` (
  `billing_rate_id` int(11) NOT NULL,
  `billing_particular` varchar(500) DEFAULT NULL,
  `billing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billing_rate`
--

INSERT INTO `billing_rate` (`billing_rate_id`, `billing_particular`, `billing_id`) VALUES
(1, 'Upto 4 Hosting Space', 1),
(2, 'Upto 2.0GB Server Space', 1),
(3, 'Manual Backup', 1),
(4, 'Access 24/7 ', 1),
(5, 'Upto 8 Hosting Space', 2),
(6, '4.5GB Server Space', 2),
(7, 'Automated Backups', 2),
(8, 'Access 24/7', 2),
(9, 'Unlimited Hosting Space', 3),
(10, 'Unlimited Server Space', 3),
(11, 'Automated Backup', 3),
(12, 'Access 24/7', 3),
(13, 'Free Email Notification', 1),
(14, 'Free Email Notification', 2),
(15, 'Free Email Notification', 3);

-- --------------------------------------------------------

--
-- Table structure for table `collab_invites`
--

CREATE TABLE `collab_invites` (
  `invites_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `contribution_id` int(11) NOT NULL,
  `invites_date_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `collab_invites`
--

INSERT INTO `collab_invites` (`invites_id`, `users_id`, `contribution_id`, `invites_date_time`) VALUES
(46, 12, 6, '2019-04-04 03:14:17'),
(49, 15, 6, '2019-04-15 16:53:27'),
(50, 12, 7, '2019-05-19 20:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `comment_tb`
--

CREATE TABLE `comment_tb` (
  `comment_id` int(11) NOT NULL,
  `comment_body` varchar(5000) DEFAULT NULL,
  `comment_date` varchar(45) DEFAULT NULL,
  `comment_time` varchar(45) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `contributers_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contributers`
--

CREATE TABLE `contributers` (
  `contributers_id` int(11) NOT NULL,
  `contribution_body` varchar(10000) DEFAULT NULL,
  `contribution_date` varchar(45) DEFAULT NULL,
  `contribution_time` varchar(45) DEFAULT NULL,
  `study_activity_id` int(11) NOT NULL,
  `contributer_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contributers`
--

INSERT INTO `contributers` (`contributers_id`, `contribution_body`, `contribution_date`, `contribution_time`, `study_activity_id`, `contributer_user`) VALUES
(2, '<p>I have uploaded <strong>two</strong> files. Please open and read so that you can be able to give comments!&nbsp;</p>\r\n\r\n<p>Thank you</p>\r\n', '2019-05-20', '23:07:47', 6, 13),
(5, '<p><strong>Dear all</strong></p>\r\n\r\n<p>File uploaded . please read and give your comments!</p>\r\n\r\n<p>Thank you</p>\r\n\r\n<p>Moses</p>\r\n', '2019-05-20', '23:16:31', 9, 13),
(6, '<p>R-Studio runs on&nbsp;<strong>Mac, Windows, and Linux *</strong>&nbsp;and can recover data from local disks, removable disks, heavily corrupted disks, unbootable disks, clients connected to a local area network or the Internet. As a highly scalable, flexible, and deployable data recovery solution, R-Studio is an invaluable tool for data recovery operations large and small.</p>\r\n\r\n<p>No matter the platform of the host or client or the physical location of the disk, R-Studio can quickly and effectively recover lost data from damaged, formatted, repartitioned, or deleted disks.</p>\r\n', '2019-05-21', '08:12:28', 6, 13),
(7, '<p>Microsoft Excel 2010 is designed to store numerical inputs and permit calculation on those numbers, making it an ideal program if you need to perform any numerical analysis such as computing the mean, median, mode and range for a set of numbers. Each of these four mathematical terms describes a slightly different way of looking at a set of numbers and Excel has a built-in function to determine each of them except for the range, which will require that you create a simple formula to find.</p>\r\n', '2019-05-22', '17:39:32', 8, 13),
(8, '<p><strong>The Osteoporosis Data Goal of the analysis</strong>: See how the various scales for anxiety, depression, and anger are related to one another as the seasons change.</p>\r\n\r\n<p>Which one&rsquo;s show the greatest seasonal variability? How much of variability is tied to that of other scales? How much variability is typical in a person?</p>\r\n\r\n<p>&bull; There are multiple measurements for each person, but these are stored as multiple variables rather than multiple cases.</p>\r\n\r\n<p>&bull; For some information (<em>sex, marital status, profession</em>) the natural case is an individual person. Organization of Software</p>\r\n\r\n<p>&bull; Some software packages (e.g., <em><strong>STATA</strong></em>) provide special operators for particular techniques. &bull; People often thi</p>\r\n', '2019-05-22', '18:32:43', 7, 13),
(9, '<p>However, if you&#39;d rather have native support, in most, if not all browsers, I&#39;d recommend resaving the&nbsp;<code>.doc</code>/<code>.docx</code>&nbsp;as a PDF file Those can also be independently rendered using&nbsp;<a href=\"https://mozilla.github.io/pdf.js/\">PDF.js</a>&nbsp;by Mozilla.</p>\r\n\r\n<p><strong>Edit:</strong></p>\r\n\r\n<p>Huge thanks to&nbsp;<a href=\"https://stackoverflow.com/users/2281835/fatbotdesigns\">fatbotdesigns</a>&nbsp;for posting the Microsoft Office 365 viewer in the comments.</p>\r\n\r\n<pre>\r\n<code>&lt;iframe src=&#39;https://view.officeapps.live.com/op/embed.aspx?src=http://remote.url.tld/path/to/document.doc&#39; width=&#39;1366px&#39; height=&#39;623px&#39; frameborder=&#39;0&#39;&gt;This is an embedded &lt;a target=&#39;_blank&#39; href=&#39;http://office.com&#39;&gt;Microsoft Office&lt;/a&gt; document, powered by &lt;a target=&#39;_blank&#39; href=&#39;http://office.com/webapps&#39;&gt;Office Online&lt;/a&gt;.&lt;/iframe&gt;</code></pre>\r\n\r\n<p>One more important caveat to keep in mind, as pointed out by&nbsp;<a href=\"https://stackoverflow.com/users/912563/lightswitch05\">lightswitch05</a>, is that this will upload your document to a third-party server. If this is unacceptable, then this method of display isn&#39;t the proper course of action.</p>\r\n', '2019-05-25', '19:38:34', 7, 13),
(10, '<p>hello i have uploaded the file</p>\r\n', '2019-05-29', '13:59:17', 7, 13);

-- --------------------------------------------------------

--
-- Table structure for table `contribution_tb`
--

CREATE TABLE `contribution_tb` (
  `contribution_id` int(11) NOT NULL,
  `contribution_date` varchar(45) DEFAULT NULL,
  `contribution_time` varchar(45) DEFAULT NULL,
  `contribution_details` varchar(1000) DEFAULT NULL,
  `contribution_title` varchar(45) DEFAULT NULL,
  `study_type_id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contribution_tb`
--

INSERT INTO `contribution_tb` (`contribution_id`, `contribution_date`, `contribution_time`, `contribution_details`, `contribution_title`, `study_type_id`, `user`) VALUES
(6, '2019-01-25', '07:43:52', 'To identified and analyzed families of apps (Comprising of the main projects and its forks) that are maintained together and that exist both on the official app store (Google Play) as well as on Github to explores clone-based reuse practices for open-source Android apps', 'Clone-based variability management in the and', 3, 13),
(7, '2019-05-14', '17:52:03', 'Studying the popularity of android app. Case study github and google play store.', 'Study of android app popularity', 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `event_tb`
--

CREATE TABLE `event_tb` (
  `event_id` int(11) NOT NULL,
  `event_time` varchar(45) DEFAULT NULL,
  `events_body` varchar(1000) DEFAULT NULL,
  `ipaddress` varchar(45) DEFAULT NULL,
  `login_stats_id` int(11) NOT NULL,
  `event_name` varchar(500) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `institution_tb`
--

CREATE TABLE `institution_tb` (
  `institution_id` int(11) NOT NULL,
  `institution_name` varchar(500) DEFAULT NULL,
  `institution_country` varchar(45) DEFAULT NULL,
  `institution_details` varchar(500) DEFAULT NULL,
  `institution_website` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `institution_tb`
--

INSERT INTO `institution_tb` (`institution_id`, `institution_name`, `institution_country`, `institution_details`, `institution_website`) VALUES
(1, 'Mbarara University of Science and Technology', 'Uganda', 'Science Best public University in Uganda', 'https://www.must.ac.ug/'),
(7, 'CAMTech Uganda', 'Uganda', 'Consortiam for Affordable Medical solution In Uganda, Mbarara University of Science and Technology.', 'http://camtechmgh.org/'),
(8, 'Makerere University', 'Uganda', 'Makerere University', 'https://www.mak.ac.ug/');

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
-- Table structure for table `objective_users`
--

CREATE TABLE `objective_users` (
  `study_users_id` int(11) NOT NULL,
  `study_objectives_id` int(11) NOT NULL,
  `objective_users_status` varchar(45) DEFAULT NULL,
  `invites_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `objective_users`
--

INSERT INTO `objective_users` (`study_users_id`, `study_objectives_id`, `objective_users_status`, `invites_id`) VALUES
(1, 1, '0', 49),
(3, 1, '0', 46),
(4, 3, '0', 46);

-- --------------------------------------------------------

--
-- Table structure for table `server_instance`
--

CREATE TABLE `server_instance` (
  `instance_id` int(11) NOT NULL,
  `instance_goal` varchar(45) DEFAULT NULL,
  `instance_bill` varchar(45) DEFAULT NULL,
  `server_instancecol` varchar(45) DEFAULT NULL,
  `institution_id` int(11) NOT NULL,
  `server_instance_status` int(11) DEFAULT '1',
  `billing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `study_activity`
--

CREATE TABLE `study_activity` (
  `study_activity_id` int(11) NOT NULL,
  `study_activity_name` varchar(500) DEFAULT NULL,
  `study_objectives_id` int(11) NOT NULL,
  `study_start` date NOT NULL,
  `study_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `study_activity`
--

INSERT INTO `study_activity` (`study_activity_id`, `study_activity_name`, `study_objectives_id`, `study_start`, `study_end`) VALUES
(1, 'Identify the repository', 1, '2019-05-23', '2019-05-24'),
(2, 'Clean up the repository with less than 6 commits', 1, '2019-05-26', '2019-05-27'),
(3, 'Collecting the forks for every repository', 1, '2019-05-20', '2019-05-21'),
(4, 'Identify the repository with atleast 10 forks and are found both on Github and Google play store', 1, '2019-05-01', '2019-05-06'),
(5, 'Generate the pie chart graph from the data', 4, '2019-05-13', '2019-05-21'),
(6, 'Find out the standard deviation and the mean.', 4, '2019-05-06', '0000-00-00'),
(7, 'Reorganize the data sets from the excel file', 4, '2019-05-30', '2019-08-31'),
(8, 'Find out the mean, median, the mode for the dataset', 4, '2019-05-13', '2019-05-27'),
(9, 'share the data with the team', 4, '2019-05-28', '2019-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `study_objectives`
--

CREATE TABLE `study_objectives` (
  `study_objectives_id` int(11) NOT NULL,
  `objectives_name` varchar(1000) DEFAULT NULL,
  `objective_lead` int(11) NOT NULL,
  `contribution_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `study_objectives`
--

INSERT INTO `study_objectives` (`study_objectives_id`, `objectives_name`, `objective_lead`, `contribution_id`) VALUES
(1, 'Data collection & Data Mining', 15, 6),
(2, 'Creating Github Repository and Uploading the latest code!', 12, 6),
(3, 'Mining Github web platform to Identify at least 5000 mainline repository with atleast 4 forks each, using Github API', 12, 6),
(4, 'Analyzing the data using R Studio and Microsoft package', 13, 6),
(5, 'Project reporting', 13, 6);

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
  `contributers_id` int(11) NOT NULL,
  `upload_size` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upload_tb`
--

INSERT INTO `upload_tb` (`upload_id`, `upload_type`, `upload_name`, `contributers_id`, `upload_size`) VALUES
(4, 'application/pdf', '0CITT Work Plan  April - August 2019.PDF', 5, '318139'),
(5, 'application/pdf', '1DemandeService.pdf', 5, '4005'),
(6, 'application/vnd.openxmlformats-officedocument', '2documentations.docx', 5, '115020'),
(7, 'application/pdf', '15585359720CAMTech Internship advert-2019.pdf', 7, '243878'),
(8, 'application/vnd.openxmlformats-officedocument', '15585359721documentations.docx', 7, '115020'),
(9, 'application/pdf', '15588023140Android_SANER2019.pdf', 9, '286848'),
(10, 'application/vnd.openxmlformats-officedocument', '15591275580CITT board meeting minutes_ November 28th LST.docx', 10, '96077'),
(11, 'application/vnd.openxmlformats-officedocument', '15591275581documentations.docx', 10, '115020'),
(12, 'application/pdf', '15591275582motivation-letter-ku-leuven.pdf', 10, '57459'),
(13, 'application/pdf', '15591275583Openja-Moses-cv-latest.pdf', 10, '538354');

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
  `users_contact` varchar(45) DEFAULT NULL,
  `users_expertise` varchar(500) DEFAULT NULL,
  `users_address` varchar(45) DEFAULT NULL,
  `users_designation` varchar(45) DEFAULT NULL,
  `is_activated` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`users_id`, `users_name`, `users_email`, `users_password`, `user_role_id`, `institution_id`, `users_email2`, `users_contact`, `users_expertise`, `users_address`, `users_designation`, `is_activated`) VALUES
(12, 'Openja Moses', 'openjamosesopm@gmail.com', '2278a8b7ec17ec76d1f7ce4887e6c0438d0f9f3a', 2, 7, 'opm@gmail.com', '+256753955636', 'Software Engineering', 'Mbarara', 'Mr', 0),
(13, 'John Businge', 'johnxu21@gmail.com', '1f0160076c9f42a157f0a8f0dcc68e02ff69045b', 1, 7, 'johnxu21@gmail.com', '5305741169', 'Software Engineering', '2512 Lafayette Dr.', 'Dr', 0),
(15, 'Onen Hudson', 'huddy@gmail.com', '24fa7ad40019546f266a78dc964c36d82af2839d', 1, 7, 'huddy12@gmail.com', '5305741169', 'Medical Doctor', '2512 Lafayette Dr.', 'Mr', 0);

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
(2, 'Lead Collaborator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tb`
--
ALTER TABLE `admin_tb`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billing_id`);

--
-- Indexes for table `billing_rate`
--
ALTER TABLE `billing_rate`
  ADD PRIMARY KEY (`billing_rate_id`),
  ADD KEY `fk_billing_rate_billing1_idx` (`billing_id`);

--
-- Indexes for table `collab_invites`
--
ALTER TABLE `collab_invites`
  ADD PRIMARY KEY (`invites_id`);

--
-- Indexes for table `comment_tb`
--
ALTER TABLE `comment_tb`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_comment_tb_users_tb1_idx` (`users_id`),
  ADD KEY `fk_comment_tb_contributers1_idx` (`contributers_id`);

--
-- Indexes for table `contributers`
--
ALTER TABLE `contributers`
  ADD PRIMARY KEY (`contributers_id`),
  ADD KEY `fk_contributers_study_activity1_idx` (`study_activity_id`);

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
-- Indexes for table `objective_users`
--
ALTER TABLE `objective_users`
  ADD PRIMARY KEY (`study_users_id`),
  ADD KEY `fk_objective_users_study_objectives1_idx` (`study_objectives_id`),
  ADD KEY `fk_objective_users_collab_invites1_idx` (`invites_id`);

--
-- Indexes for table `server_instance`
--
ALTER TABLE `server_instance`
  ADD PRIMARY KEY (`instance_id`),
  ADD KEY `fk_server_instance_institution_tb1_idx` (`institution_id`),
  ADD KEY `fk_server_instance_billing1_idx` (`billing_id`);

--
-- Indexes for table `study_activity`
--
ALTER TABLE `study_activity`
  ADD PRIMARY KEY (`study_activity_id`),
  ADD KEY `fk_study_activity_study_objectives1_idx` (`study_objectives_id`);

--
-- Indexes for table `study_objectives`
--
ALTER TABLE `study_objectives`
  ADD PRIMARY KEY (`study_objectives_id`);

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
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `billing_rate`
--
ALTER TABLE `billing_rate`
  MODIFY `billing_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `collab_invites`
--
ALTER TABLE `collab_invites`
  MODIFY `invites_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `comment_tb`
--
ALTER TABLE `comment_tb`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contributers`
--
ALTER TABLE `contributers`
  MODIFY `contributers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contribution_tb`
--
ALTER TABLE `contribution_tb`
  MODIFY `contribution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `institution_tb`
--
ALTER TABLE `institution_tb`
  MODIFY `institution_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_stats`
--
ALTER TABLE `login_stats`
  MODIFY `login_stats_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objective_users`
--
ALTER TABLE `objective_users`
  MODIFY `study_users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `server_instance`
--
ALTER TABLE `server_instance`
  MODIFY `instance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_activity`
--
ALTER TABLE `study_activity`
  MODIFY `study_activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `study_objectives`
--
ALTER TABLE `study_objectives`
  MODIFY `study_objectives_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `study_type`
--
ALTER TABLE `study_type`
  MODIFY `study_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `upload_tb`
--
ALTER TABLE `upload_tb`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing_rate`
--
ALTER TABLE `billing_rate`
  ADD CONSTRAINT `fk_billing_rate_billing1` FOREIGN KEY (`billing_id`) REFERENCES `billing` (`billing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comment_tb`
--
ALTER TABLE `comment_tb`
  ADD CONSTRAINT `fk_comment_tb_contributers1` FOREIGN KEY (`contributers_id`) REFERENCES `contributers` (`contributers_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comment_tb_users_tb1` FOREIGN KEY (`users_id`) REFERENCES `users_tb` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contributers`
--
ALTER TABLE `contributers`
  ADD CONSTRAINT `fk_contributers_study_activity1` FOREIGN KEY (`study_activity_id`) REFERENCES `study_activity` (`study_activity_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Constraints for table `objective_users`
--
ALTER TABLE `objective_users`
  ADD CONSTRAINT `fk_objective_users_collab_invites1` FOREIGN KEY (`invites_id`) REFERENCES `collab_invites` (`invites_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_objective_users_study_objectives1` FOREIGN KEY (`study_objectives_id`) REFERENCES `study_objectives` (`study_objectives_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `server_instance`
--
ALTER TABLE `server_instance`
  ADD CONSTRAINT `fk_server_instance_billing1` FOREIGN KEY (`billing_id`) REFERENCES `billing` (`billing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_server_instance_institution_tb1` FOREIGN KEY (`institution_id`) REFERENCES `institution_tb` (`institution_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `study_activity`
--
ALTER TABLE `study_activity`
  ADD CONSTRAINT `fk_study_activity_study_objectives1` FOREIGN KEY (`study_objectives_id`) REFERENCES `study_objectives` (`study_objectives_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
