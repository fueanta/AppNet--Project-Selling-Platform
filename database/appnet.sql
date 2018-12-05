-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2018 at 04:45 AM
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
-- Database: `appnet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_name` varchar(15) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(30) NOT NULL,
  `bank_country` varchar(15) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `swift_code` varchar(11) DEFAULT NULL,
  `rec_name` varchar(25) NOT NULL,
  `rec_type` varchar(16) NOT NULL,
  `rec_country` varchar(15) NOT NULL,
  `rec_city` varchar(15) NOT NULL,
  `rec_address` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_name`, `bank_country`, `account_no`, `swift_code`, `rec_name`, `rec_type`, `rec_country`, `rec_city`, `rec_address`, `user_id`) VALUES
(3, 'Dutch Bangla Bank', 'Bangladesh', '108.151.151184', 'DBBLBDDH101', 'Mutasim Billah', 'Individual', 'Bangladesh', 'Dhaka', '52, KPB School Road', 1),
(4, 'AB Bank LTD', 'Bangladesh', '4034-096437-308', 'ABBLBDDH020', 'Mutasim Billah', 'Individual', 'Bangladesh', 'Dhaka', '52, Mirbari, East Basaboo', 2);

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_num` varchar(20) NOT NULL,
  `card_holder` varchar(19) NOT NULL,
  `exp_date` varchar(5) NOT NULL,
  `security_num` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_num`, `card_holder`, `exp_date`, `security_num`, `user_id`) VALUES
('5576670108028377', 'AHMAD MUTASIM', '05/22', 486, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` varchar(20) NOT NULL,
  `title` varchar(30) NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `features` text NOT NULL,
  `tools` text NOT NULL,
  `icon` text NOT NULL,
  `size` text,
  `link` varchar(100) NOT NULL,
  `up_vote` int(11) NOT NULL DEFAULT '0',
  `down_vote` int(11) NOT NULL DEFAULT '0',
  `change_log` text,
  `discount` double NOT NULL DEFAULT '0',
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `platform` varchar(15) NOT NULL,
  `category` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `title`, `price`, `description`, `features`, `tools`, `icon`, `size`, `link`, `up_vote`, `down_vote`, `change_log`, `discount`, `time_added`, `platform`, `category`, `user_id`) VALUES
('5b8bd6b7df9af', 'Point of Sale - Food Shop', 45, 'The restaurant point of sale is often referred to as the restaurant point of service, given that restaurant POS is no longer just about processing sales. Modern restaurant POS systems provide a platform that sits at the heart of any food and beverage operation, large or small, helping to enhance the customer experience and streamline business operations.', '[+] Food Items<br />\r\n[+] Ingredients<br />\r\n[+] Suppliers<br />\r\n[+] Customers<br />\r\n[+] Order<br />\r\n[+] Purchase<br />\r\nand many more!!', 'C#, Oracle DB', '5b8bd6b7df9af.png', '35 MB', 'http://localhost/sites/appnet/src/user/uploadProject.php', 0, 0, NULL, 10, '2018-09-02 12:25:27', 'Windows', 'Small Business', 2),
('5b8bd9660af58', 'Restaurant POS', 30, 'The restaurant point of sale is often referred to as the restaurant point of service, given that restaurant POS is no longer just about processing sales. Modern restaurant POS systems provide a platform that sits at the heart of any food and beverage operation, large or small, helping to enhance the customer experience and streamline business operations.', '[+] Food Items<br />\r\n[+] Ingredients<br />\r\n[+] Suppliers<br />\r\n[+] Customers<br />\r\n[+] Order<br />\r\n[+] Purchase<br />\r\nand many more!!', 'JavaFx, Oracle', '5b8bd9660af58.png', '30 MB', 'http://localhost/sites/appnet/src/user/uploadProject.php', 0, 0, NULL, 0, '2018-09-02 12:36:54', 'Linux', 'Small Business', 1),
('5b8c3ae1c82d6', 'Air Strike', 49, 'Love shooting alien monsters? Like to blow them up and defend our galaxy? If absolutely YES, Air Strike - Galaxy Shooteris the best shoot em up game for you.<br />\r\n<br />\r\nOur beautiful galaxy is under attack by evil alien monsters, and all are calling you, the Space Defender! As the guardian of the galaxy, you are the LAST HOPE of all civilians. <br />\r\n<br />\r\nMore than 300,000 Space Defenders have taken on their duty, so don&rsquo;t hesitate anymore!<br />\r\n<br />\r\nTake control of your aerocraft and fight against those space intruders. Make sure each battle you enter will be an epic one and shoot down every single monster that dares to swarm our galaxy.<br />\r\n<br />\r\nFail to strike the evil down? Never surrender, you brave shooter! Try again and take your revenge on the alien invaders.<br />\r\n<br />\r\nHOW TO PLAY:<br />\r\n* Tap screen and hold to move and hunt down all invaders.<br />\r\n* Collect items to upgrade or change your weapons.', 'UNIQUE FEATURES:<br />\r\nAir Strike - Galaxy Shooter is an arcade shooting game, with attracting features:<br />\r\n- FREE TO PLAY: No doubt Air Strike - Galaxy Shooter is a free game for the brave!<br />\r\n- SIMPLE BASIC top down shooting gameplay: No tutorial required.<br />\r\n- STUNNING GRAPHICS with marvelous lighting and special effects<br />\r\n- A BROAD RANGE OF DEADLY DANGEROUS ENEMIES and ENRAGED BOSSES: Hunt down every single monster to defend the galaxy.<br />\r\n- MULTIPLE choices of Aerocrafts and Drones: Your squad will definitely ace the fights!<br />\r\n- REWARDED MISSIONS AND ACHIEVEMENTS: Finish them all to gain huge!<br />\r\n- NEW MODE ADDED: Endless battle with breathtaking actions!<br />\r\n<br />\r\nFeel the strengths of space force and enjoy simple but challenging space battles!with one of the games on the go!', 'Java, OpenGL', '5b8c3ae1c82d6.png', '105 MB', 'https://play.google.com/store/apps/details?id=com.airstrikesquadron.galaxyshooteralien&hl=en_US', 0, 0, NULL, 5, '2018-09-02 19:32:49', 'Android', 'Personal', 2);

-- --------------------------------------------------------

--
-- Table structure for table `snapshot`
--

CREATE TABLE `snapshot` (
  `snap_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `project_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `snapshot`
--

INSERT INTO `snapshot` (`snap_id`, `file_name`, `project_id`) VALUES
(46, '5b8bd6b7dfe35.png', '5b8bd6b7df9af'),
(47, '5b8bd6b7e0585.png', '5b8bd6b7df9af'),
(48, '5b8bd6b7e0c52.png', '5b8bd6b7df9af'),
(49, '5b8bd6b7e12ae.png', '5b8bd6b7df9af'),
(50, '5b8bd6b7e175f.png', '5b8bd6b7df9af'),
(56, '5b8bd9660b3f6.png', '5b8bd9660af58'),
(57, '5b8bd9660bd1c.png', '5b8bd9660af58'),
(58, '5b8bd9660c244.png', '5b8bd9660af58'),
(59, '5b8bd9660c77c.png', '5b8bd9660af58'),
(60, '5b8bd9660cd4c.png', '5b8bd9660af58'),
(73, '5b8c3ae1c8de6.png', '5b8c3ae1c82d6'),
(74, '5b8c3ae1c9f26.png', '5b8c3ae1c82d6'),
(75, '5b8c3ae1ca4c4.png', '5b8c3ae1c82d6'),
(76, '5b8c3ae1cb0c4.png', '5b8c3ae1c82d6'),
(77, '5b8c3ae1cb823.png', '5b8c3ae1c82d6');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `project_id` varchar(20) NOT NULL,
  `transaction_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `selling_price` double NOT NULL DEFAULT '0',
  `buying_method` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`buyer_id`, `seller_id`, `project_id`, `transaction_time`, `selling_price`, `buying_method`) VALUES
(2, 1, '5b8bd9660af58', '2018-09-01 20:16:39', 30, 'Account'),
(1, 2, '5b8c3ae1c82d6', '2018-09-02 19:49:40', 46.55, 'Card: 5576670108028377');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `transfer_id` int(11) NOT NULL,
  `transferred_to` varchar(12) NOT NULL,
  `acc_card_num` varchar(20) NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `transfer_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `short_note` text,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`transfer_id`, `transferred_to`, `acc_card_num`, `amount`, `transfer_time`, `short_note`, `user_id`) VALUES
(6, 'Card', '5576670108028377', 50, '2018-08-27 09:32:37', 'no comment', 1),
(8, 'Bank Account', '108.151.151184', 30, '2018-08-27 13:31:31', 'Card Issuance Fee', 1),
(9, 'Card', '5576670108028377', 40, '2018-08-27 13:39:47', 'Shopping Purpose', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `f_name` varchar(15) DEFAULT NULL,
  `l_name` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `country` varchar(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `state` varchar(15) DEFAULT NULL,
  `p_code` int(11) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `balance` double NOT NULL DEFAULT '0',
  `added_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `f_name`, `l_name`, `dob`, `phone`, `email`, `country`, `city`, `state`, `p_code`, `address`, `balance`, `added_time`, `password`) VALUES
(1, 'Taqui', 'Ahmad', '1994-12-18', '+8801796391677', 'fueanta@gmail.com', 'Bangladesh', 'Dhaka', 'Sabujbag', 1214, '52, Mirbari, KPB School Road, East Basaboo, Sabujb', 700, '2018-08-25 16:10:30', '1234@1234'),
(2, 'Mutasim Billah ', 'Ahmad', '1998-12-18', '+8801521334465', 'fueanta@outlook.com', 'Bangladesh', 'Dhaka', 'Sabujbag', 1214, '52, Mirbari, KPB School Road, East Basaboo, Sabujb', 46.55, '2018-09-01 19:36:59', '4321@4321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_name`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`),
  ADD UNIQUE KEY `BANK_account_no_uindex` (`account_no`),
  ADD KEY `BANK_fk` (`user_id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_num`),
  ADD KEY `CARD_fk` (`user_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `project_platform_fk` (`platform`),
  ADD KEY `project_category_fk` (`category`),
  ADD KEY `project_user_user_id_fk` (`user_id`);

--
-- Indexes for table `snapshot`
--
ALTER TABLE `snapshot`
  ADD PRIMARY KEY (`snap_id`),
  ADD KEY `snapshot_project_project_id_fk` (`project_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`project_id`,`buyer_id`,`seller_id`),
  ADD KEY `TRANSACTION_user_fk` (`buyer_id`),
  ADD KEY `transaction_user_user_id_fk` (`seller_id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`transfer_id`),
  ADD KEY `TRANSFER_user_user_id_fk` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `USER_phone_uindex` (`phone`),
  ADD UNIQUE KEY `USER_email_uindex` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `snapshot`
--
ALTER TABLE `snapshot`
  MODIFY `snap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `snapshot`
--
ALTER TABLE `snapshot`
  ADD CONSTRAINT `snapshot_project_project_id_fk` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
