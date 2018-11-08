-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2018 at 08:32 AM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `img_id` int(64) NOT NULL,
  `user_id` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `img_id`, `user_id`) VALUES
(17, 'blue', 12, 19),
(18, 'blue', 12, 19),
(19, 'lunga', 12, 19),
(20, 'ainchhh', 11, 19),
(21, 'ereteryery', 12, 19),
(22, 'twetw', 11, 19),
(23, 'heeel', 12, 13),
(24, 'yes', 11, 13),
(25, 'haaa', 11, 13),
(26, 'good ', 12, 19),
(27, 'yoh dude', 13, 19);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `comments_id` int(255) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`img_id`, `img_name`, `user_id`, `comments_id`, `time_stamp`) VALUES
(1, 'img/gallery/user_13_image_1.png', 13, NULL, '2018-11-06 13:24:08'),
(2, 'img/gallery/user_13_image_2.png', 13, NULL, '2018-11-06 13:24:44'),
(3, 'img/gallery/user_13_image_3.png', 13, NULL, '2018-11-06 13:24:57'),
(4, 'img/gallery/user_13_image_4.png', 13, NULL, '2018-11-06 13:30:29'),
(5, 'img/gallery/user_13_image_5.png', 13, NULL, '2018-11-06 13:31:16'),
(6, 'img/gallery/user_13_image_6.png', 13, NULL, '2018-11-06 13:45:24'),
(7, 'img/gallery/user_13_image_7.png', 13, NULL, '2018-11-06 13:45:43'),
(8, 'img/gallery/user_13_image_8.png', 13, NULL, '2018-11-06 16:07:28'),
(9, 'img/gallery/user_19_image_1.png', 19, NULL, '2018-11-07 07:57:49'),
(10, 'img/gallery/user_19_image_2.png', 19, NULL, '2018-11-07 07:58:01'),
(11, 'img/gallery/user_19_image_3.png', 19, NULL, '2018-11-07 07:58:06'),
(12, 'img/gallery/user_19_image_4.png', 19, NULL, '2018-11-07 07:58:13'),
(13, 'img/gallery/user_19_image_5.png', 19, NULL, '2018-11-07 13:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `img_id` int(64) NOT NULL,
  `user_id` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `img_id`, `user_id`) VALUES
(1, 13, 19);

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
  `email_code` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `salt`, `name`, `joined`, `groups`, `email`, `email_code`) VALUES
(13, 'Maureen', 'c7fe3e1926d3e6fb7f64a2cc84accf23333aa53b9cf33110a42faa611716c6ff', 'salt', 'Maureen Nqisha', '2018-10-25 06:17:15', 1, 'nnqisha@gmail.com', ''),
(15, 'blue', '16477688c0e00699c6cfa4497a3612d7e83c532062b64b250fed8908128ed548', 'salt', 'The Original blue', '2018-10-26 03:26:11', 1, 'blue@gmail.com', ''),
(18, 'hhh', '24d166cd6c8b826c779040b49d5b6708d649b236558e8744339dfee6afe11999', 'salt', 'hhh', '2018-10-31 05:19:17', 1, 'fujafon@hiltonvr.com', '8d4ab4a9575b768082926ec95dce9401'),
(19, 'Lunga', 'bf2ce2254e503c4fcdd8f03be84a5b4ce3a58bd587e5f7f960345337d05fdd3a', 'salt', 'Lunga Makwakwa', '2018-11-06 23:57:28', 1, 'luu@awesome.net', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
