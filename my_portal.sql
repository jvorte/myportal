-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 05 Μάη 2024 στις 14:33:24
-- Έκδοση διακομιστή: 10.4.32-MariaDB
-- Έκδοση PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `my_portal`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `meeting`
--

CREATE TABLE `meeting` (
  `id` int(11) NOT NULL,
  `id_user` int(100) NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `country` text NOT NULL,
  `zip` varchar(100) NOT NULL,
  `mobile` int(100) NOT NULL,
  `email` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `address`, `city`, `country`, `zip`, `mobile`, `email`, `created_at`) VALUES
(6, 'jvortelinas', '$2y$10$X0vBTSPd9o.0df5Tz56e/.VCSDBB7inlO3wnRB2eK9kSiVu011H66', 'Dimitrios', 'Vortelinas', 'Bonsaigasse 3/1/4', 'Wien, 22. Bezirk, Donaustadt', 'Austria', '1220', 2147483647, 'fenia.mavromati@gmail.com', '2024-04-28 11:22:41'),
(7, 'fenia', '$2y$10$lyz7BvulLfn6GInUGSBaYOaYQFwKIc/WhGKlk1N5n7VwuMMIEuPAq', 'FOTEINI', 'MAVROMMATI', 'Bonsaigasse 6', 'Wien, 22. Bezirk, Donaustadt', 'Austria', '1220', 2147483647, 'fenia.mavromati@gmail.com', '2024-05-05 12:35:47');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `vacations`
--

CREATE TABLE `vacations` (
  `id` int(11) NOT NULL,
  `id_user` int(100) NOT NULL,
  `from_date` text NOT NULL,
  `until_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
