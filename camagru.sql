-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2018 at 02:26 AM
-- Server version: 5.7.23
-- PHP Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `comments_id` int(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `joined` datetime NOT NULL,
  `groups` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_code` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `salt`, `name`, `joined`, `groups`, `email`, `email_code`) VALUES
(13, 'Maureen', 'c7fe3e1926d3e6fb7f64a2cc84accf23333aa53b9cf33110a42faa611716c6ff', 'salt', 'Maureen Nqisha', '2018-10-25 06:17:15', 1, 'nnqisha@gmail.com', ''),
(14, 'lunga', 'bf2ce2254e503c4fcdd8f03be84a5b4ce3a58bd587e5f7f960345337d05fdd3a', 'salt', 'Lunga Makwakwa', '2018-10-26 02:00:49', 1, 'luu@awesome.net', ''),
(15, 'blue', '16477688c0e00699c6cfa4497a3612d7e83c532062b64b250fed8908128ed548', 'salt', 'The Original blue', '2018-10-26 03:26:11', 1, 'blue@gmail.com', ''),
(18, 'hhh', '24d166cd6c8b826c779040b49d5b6708d649b236558e8744339dfee6afe11999', 'salt', 'hhh', '2018-10-31 05:19:17', 1, 'fujafon@hiltonvr.com', '8d4ab4a9575b768082926ec95dce9401');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
