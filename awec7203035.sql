-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2018 at 05:40 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `awec7203035`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
`book_id` int(11) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `ISBN` varchar(100) NOT NULL,
  `publication_date` date NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `book_image` varchar(100) NOT NULL,
  `book_genre` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `author`, `ISBN`, `publication_date`, `publisher`, `book_image`, `book_genre`) VALUES
(1, 'Pride and Prejudice', 'Austen, Jane', '978-0-571-33701', '2018-01-08', 'Faber & Faber', 'prideprejudice.jpg', 'Science Fiction'),
(2, 'Bridge of Clay', 'Zusak, Markus', '978-1-984830-15-9', '2018-01-08', 'Random House Children Books', 'bridgeofclay.jpg', 'Science Fiction'),
(3, 'The Sideman', 'Ramsay, Caro', '978-0-7278-8808', '2018-01-01', 'Severn House Publishers, Limited', 'sideman.jpg', 'Science Fiction'),
(4, 'The Strange Case', 'Stevenson, Robert Louis', '978-1-949982-94-7', '2018-01-01', 'Steven Evans', 'strangecase.jpg', 'Action Drama');

-- --------------------------------------------------------

--
-- Table structure for table `giveaway`
--

CREATE TABLE IF NOT EXISTS `giveaway` (
`giveaway_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `ISBN` varchar(15) NOT NULL,
  `publication_date` date NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `book_image` varchar(255) NOT NULL,
  `book_genre` varchar(50) NOT NULL,
  `carousel_index` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `giveaway`
--

INSERT INTO `giveaway` (`giveaway_id`, `book_name`, `author`, `ISBN`, `publication_date`, `publisher`, `book_image`, `book_genre`, `carousel_index`) VALUES
(3, 'Vanity Fair', 'Thackeray, William Makepeace', '978-1-72227-870', '2018-01-01', 'Little', 'vanityfair.jpg', 'Vanity Fair', 1),
(4, 'Dopesick', 'Macy, Beth', '978-0-316-52317', '2018-01-01', 'Little Brown & Company', 'dopestick.jpg', 'Dopesick', 2),
(5, 'House Rules', 'Picoult, Jodi', '978-1-72227-870', '2017-12-31', 'Pocket Books', 'houserules.jpg', 'Action Drama', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address_line_1` varchar(100) NOT NULL,
  `address_line_2` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `address_line_1`, `address_line_2`, `gender`, `date_of_birth`, `password`) VALUES
(1, 'Bipin Goshali', 'bipingoshali2527@gmail.com', 'Pokhara', 'Rambazar-15', 'Male', '1997-07-22', 'Bipin123$'),
(2, 'Suresh Rawal', 'sureshrawal@gmail.com', 'Kailali', 'Tikapur', 'Male', '2018-01-01', 'suresh'),
(6, 'Ashish Thapa', 'ashishthapa@gmail.com', 'Kathmandu', 'Dillibazar-33', 'Male', '2018-01-01', 'ashish'),
(7, 'Ashish Shrestha', 'ashishshrestha@gmail.com', 'Devkota', 'Gaighat', 'Male', '2007-01-01', 'ashish'),
(11, 'Suziet KC', 'suzietkc@gmail.com', 'Pokhara', 'Laxmi-Tole', 'Male', '2018-01-01', 'suziet'),
(12, 'Bypras Shrestha', 'byprasshrestha@gmail.com', 'Pokhara', 'Laxmi-Tole', 'Male', '2018-01-01', 'bypras'),
(15, 'Helmet', 'helmetgurung@gmail.com', 'Pokhara', 'Laxmi-Tole', 'Male', '2018-01-01', 'helmet'),
(16, 'Kiran Hamal', 'kiranhamal@gmail.com', 'Kathmandu', 'Dillibazar-33', 'Male', '2003-12-31', 'KiranH@m@l1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
 ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `giveaway`
--
ALTER TABLE `giveaway`
 ADD PRIMARY KEY (`giveaway_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `giveaway`
--
ALTER TABLE `giveaway`
MODIFY `giveaway_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
