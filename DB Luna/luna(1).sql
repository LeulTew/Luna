-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 12:12 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luna`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddFavorite` (IN `p_user_id` INT, IN `p_movie_id` INT)   BEGIN
  INSERT INTO Favorites (user_id, movie_id)
  VALUES (p_user_id, p_movie_id);
  
  UPDATE Users SET updated_at = CURRENT_TIMESTAMP WHERE user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddRating` (IN `p_user_id` INT, IN `p_movie_id` INT, IN `p_rating` DECIMAL(2,1))   BEGIN
  INSERT INTO Ratings (user_id, movie_id, rating)
  VALUES (p_user_id, p_movie_id, p_rating);
  
  UPDATE Users SET updated_at = CURRENT_TIMESTAMP WHERE user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CancelSubscription` (IN `p_user_id` INT)   BEGIN
  DELETE FROM Subscriptions
  WHERE user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DowngradeSubscription` (IN `p_user_id` INT)   BEGIN
  UPDATE Subscriptions
  SET plan_id = 1
  WHERE user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMovieRating` (IN `p_movie_id` INT)   BEGIN
  SELECT AVG(rating) AS average_rating
  FROM Ratings
  WHERE movie_id = p_movie_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMovies` ()   SELECT * FROM movies$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProfile` (IN `p_user_id` INT)   BEGIN
    SELECT *
    FROM Users
    WHERE user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetSubscriptionDetails` (IN `p_user_id` INT)   BEGIN
  SELECT SubscriptionPlans.name AS current_plan, Subscriptions.renewal_date, Subscriptions.billing_information
  FROM Subscriptions
  INNER JOIN SubscriptionPlans ON Subscriptions.plan_id = SubscriptionPlans.plan_id
  WHERE Subscriptions.user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserFavorites` (IN `p_user_id` INT)   BEGIN
  SELECT Movies.*
  FROM Movies
  INNER JOIN Favorites ON Movies.movie_id = Favorites.movie_id
  WHERE Favorites.user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_movie` (IN `movie_id` INT)   BEGIN

SELECT *
FROM `movies`
WHERE `movie_id` = movie_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RemoveFavorite` (IN `p_user_id` INT, IN `p_movie_id` INT)   BEGIN
  DELETE FROM Favorites
  WHERE user_id = p_user_id AND movie_id = p_movie_id;
  
  UPDATE Users SET updated_at = CURRENT_TIMESTAMP WHERE user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TopRated` ()   SELECT *
    FROM movies
    ORDER BY rating DESC
    LIMIT 8$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProfile` (IN `p_user_id` INT, IN `p_username` VARCHAR(255), IN `p_bio` TEXT, IN `p_email` VARCHAR(255), IN `p_country` VARCHAR(255), IN `p_dob` DATE)   BEGIN
    UPDATE Users
    SET
        username = p_username,
        bio = p_bio,
        email = p_email,
        country = p_country,
        dob = p_dob,
        updated_at = NOW()
    WHERE
        user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSecurity` (IN `user_id` INT, IN `new_password` VARCHAR(255))   UPDATE Users SET password = new_password WHERE user_id = user_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateVisibility` (IN `user_id` INT, IN `new_visibility` VARCHAR(255))   UPDATE Users SET profile_visibility = new_visibility WHERE user_id = user_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpgradeSubscription` (IN `p_user_id` INT)   BEGIN
  UPDATE Subscriptions
  SET plan_id = 2
  WHERE user_id = p_user_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `cast` varchar(255) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `mov_img` varchar(255) DEFAULT NULL,
  `Trialer` varchar(255) DEFAULT NULL,
  `Video` varchar(255) DEFAULT NULL,
  `Cover` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `genre`, `description`, `release_date`, `duration`, `director`, `cast`, `rating`, `mov_img`, `Trialer`, `Video`, `Cover`) VALUES
(1, 'Loki', 'Sci-fi', '\"Loki\" is a Marvel Studios TV series on Disney+ that follows the God of Mischief as he is taken to the Time Variance Authority and helps them catch a dangerous variant who is disrupting the timeline, while exploring themes of identity and free will.', '2021-06-09', 150, 'Kate Herron', 'Tom Hiddleston,\r\nJonathan Majors,\r\nSophia Di Martino', 9.8, 'images\\img1.jpg', 'https://youtu.be/nW948Va-l10', NULL, 'images\\loki cover.jpg'),
(2, 'The Batman', 'Action/Crime', 'Batman is called to intervene when the mayor of Gotham City is murdered. Soon, his investigation leads him to uncover a web of corruption, linked to his own dark past.', '2022-03-04', 176, 'Matt Reeves', 'Robert Pattinson\r\nZoë Kravitz\r\nPaul Dano', 7.8, 'images\\The Batman.jpg', 'https://www.youtube.com/watch?v=mqqft2x_Aa4', 'movies\\TheBatman1080p.mp4', 'images/The Batman Cover.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionplans`
--

CREATE TABLE `subscriptionplans` (
  `plan_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptionplans`
--

INSERT INTO `subscriptionplans` (`plan_id`, `name`, `price`, `description`) VALUES
(1, 'Standard', 14.99, 'Access to a wide range of movies and TV shows in HD quality.'),
(2, 'Premium', 19.99, 'Unlimited access to all movies and TV shows in 4K quality.');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `renewal_date` date DEFAULT NULL,
  `billing_information` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`subscription_id`, `user_id`, `plan_id`, `renewal_date`, `billing_information`) VALUES
(1, 1, 1, '2024-05-02', '****-****-****-1234'),
(2, 2, 2, '2024-05-01', '****-****-****-5678');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `profile_visibility` enum('public','private','friends') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `bio`, `country`, `dob`, `profile_visibility`, `created_at`, `updated_at`) VALUES
(1, 'Nathnael Solomon', 'nathnael@example.com', 'Abcd1234', 'I watching movies and TV shows.', 'United States', '2001-05-15', 'public', '2023-05-21 08:46:09', '2023-05-22 19:40:53'),
(2, 'Leul Yared', 'leul@example.com', 'Abcd1234', 'Enjoying the world of streaming.', 'Canada', '1988-09-23', 'public', '2023-05-21 08:46:09', '2023-05-22 19:40:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `subscriptionplans`
--
ALTER TABLE `subscriptionplans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscription_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`);

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `subscriptionplans` (`plan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
