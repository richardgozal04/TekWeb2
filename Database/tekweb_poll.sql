-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2017 at 12:24 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tekweb_poll`
--

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `question` text,
  `starts` date DEFAULT NULL,
  `ends` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `question`, `starts`, `ends`) VALUES
(1, 'What do you think of the new websites?', '2017-06-21', '2017-06-22'),
(2, 'Do you like polls?', '2017-06-21', '2017-06-22'),
(3, 'Apakah proyek ini susah ?', '2017-06-21', '2017-07-21');

-- --------------------------------------------------------

--
-- Table structure for table `polls_answers`
--

CREATE TABLE `polls_answers` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `poll` int(11) DEFAULT NULL,
  `choice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls_answers`
--

INSERT INTO `polls_answers` (`id`, `user`, `poll`, `choice`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 5),
(3, 2, 1, 1),
(4, 2, 2, 6),
(13, 3, 2, 6),
(14, 2, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `polls_choices`
--

CREATE TABLE `polls_choices` (
  `id` int(11) NOT NULL,
  `poll` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls_choices`
--

INSERT INTO `polls_choices` (`id`, `poll`, `name`) VALUES
(1, 1, 'I love it'),
(2, 1, 'It\'s alright'),
(3, 1, 'I hate it'),
(4, 2, 'I love polls'),
(5, 2, 'They\'re ok, when I\'m in the mood'),
(6, 2, 'I can\'t stand them'),
(7, 3, 'Susah banget'),
(8, 3, 'EAZYYYY'),
(9, 3, 'Tidak tahu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`) VALUES
(1, 'Amel'),
(2, 'daniel'),
(3, 'richard'),
(13, 'testing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls_answers`
--
ALTER TABLE `polls_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls_choices`
--
ALTER TABLE `polls_choices`
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
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `polls_answers`
--
ALTER TABLE `polls_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `polls_choices`
--
ALTER TABLE `polls_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
