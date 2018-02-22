-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2018 at 08:55 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `task-manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
`id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `task` text COLLATE utf8_unicode_520_ci NOT NULL,
  `checkbox` tinyint(1) NOT NULL,
  `validity` text COLLATE utf8_unicode_520_ci NOT NULL,
  `date-time` text COLLATE utf8_unicode_520_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user`, `task`, `checkbox`, `validity`, `date-time`) VALUES
(1, 2, 'Example task 1.', 1, 'validity-1', '2018-02-01'),
(2, 1, 'Example task 2.', 1, 'validity-3', '2018-02-15'),
(4, 1, 'My personalised task!', 1, 'validity-1', '2018-02-27'),
(5, 2, 'asdf', 0, 'validity-1', '2018-02-12'),
(12, 2, 'efweas', 0, 'validity-2', 'Added 18:52:56 | 04/01/2018'),
(13, 2, 'sfergse', 0, 'validity-3', 'Added 18:54:01 | 04/01/2018'),
(14, 2, 'waesrf', 0, 'validity-2', 'Added 18:55:51 | 04/01/2018');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `user` text COLLATE utf8_unicode_520_ci NOT NULL,
  `pass` text COLLATE utf8_unicode_520_ci NOT NULL,
  `email` text COLLATE utf8_unicode_520_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`) VALUES
(1, 'ppp', '$2y$10$IFqvwupKWmvk00Dv2ucBzuZmWKLnDfLZaCtXzuERJYLpCtn3Bz3A2', 'ppp@pp.pp'),
(2, 'aaa', '$2y$10$RrXhciSAIJlpoa7iud55aefnuMyUi.nWzW4kAkH0TWsmrMDY9DPvC', 'aaa@aa.aa'),
(3, 'www', '$2y$10$zFXZ//jfNXuAjjUIuOjiYO9EIyv94bBg9UMEC5GG2v53fkA/AC5GC', 'www@ww.ww'),
(4, 'sss', '$2y$10$mRZXLKJf0.efbSPhsnFbhumLjdm3uJJndnsT.YXpiwhWYJNQLSkHa', 'sss@ss.ss');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`), ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
