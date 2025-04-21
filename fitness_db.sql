-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-04-2025 a las 23:31:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fitness_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `exercise_name` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL,
  `calories_burned` int(11) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `exercises`
--

INSERT INTO `exercises` (`id`, `user_id`, `exercise_name`, `duration`, `calories_burned`, `date`) VALUES
(1, 2, 'flexiones', 5, 30, '2025-04-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nutrition`
--

CREATE TABLE `nutrition` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `food_name` varchar(100) NOT NULL,
  `calories` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nutrition`
--

INSERT INTO `nutrition` (`id`, `user_id`, `food_name`, `calories`, `date`) VALUES
(1, 2, 'brocoli', 34, '2025-04-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routines`
--

CREATE TABLE `routines` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `routine_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `exercises` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `routines`
--

INSERT INTO `routines` (`id`, `user_id`, `routine_name`, `description`, `exercises`) VALUES
(1, 2, 'pierna y gluteos', 'Es una rutina para fortalecer ya hacer que crezcan la masa muscular de las piernas y gluteos', 'Jumping jacks, sentadillas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tips`
--

CREATE TABLE `tips` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tips`
--

INSERT INTO `tips` (`id`, `title`, `content`, `created_by`) VALUES
(1, 'Hidratación', 'Bebe 2 litros de agua diarios para mantenerte hidratado.', 1),
(2, 'Ejercicio', 'Realiza 30 minutos de actividad física diaria.', 1),
(3, 'Dieta Balanceada', 'Incluye frutas, verduras y proteínas en cada comida.', 1),
(4, 'Descanso', 'Duerme 7-8 horas para una recuperación óptima.', 1),
(5, 'Planificación', 'Planifica tus comidas semanales para evitar decisiones impulsivas.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `weight` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `activity_level` enum('sedentary','lightly_active','moderately_active','very_active','extra_active') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `weight`, `height`, `age`, `gender`, `activity_level`) VALUES
(1, 'admin3', '$2y$10$Q2KbWZCR3La50xTh3uZpJupKxW7i6rKx7ZtxiNbnWzZx0bz/3ChA2', 'admin@fitness.com', 'admin', 70, 175, 30, 'male', 'moderately_active'),
(2, 'admin', '$2y$10$QOrRc/fjF0kCTle0nY.1ceFy77iD5gDMHvj0s6lXVJt4HqBAm/yWe', 'admin2@fitness.com', 'admin', 60, 170, 30, 'male', 'lightly_active'),
(7, 'Steven Alpizar', '$2y$10$8mE875Ircun3I54YYyn1AOw8z6R7h.71rkcJ1Kwtp0PNtaQlBAjgW', 'admin@fitness.com', 'user', NULL, NULL, NULL, NULL, NULL),
(9, 'Maria', '$2y$10$6VLZiQ3IoA/xoIP2BBWOa.uLSlYV/g0WgTML5VzPbMyj2EjCclS7i', 'stevenalpizar6@gmail.com', 'user', NULL, NULL, NULL, NULL, NULL),
(10, 'beto', '$2y$10$C9elWfRZKQeMLUiSQDga2eYp3S.zbUMJzq5xPsshwQt0QVkZDWIBS', 'betox@gmail.com', 'user', 69, 1.7, 25, 'male', 'moderately_active'),
(11, 'Laura', '$2y$10$TgNak3cxw1S8PjnloYBjnujE0d0OupwQ68gPABQZ8Aj9GA/Xhr/di', 'laurasolanoa@gmail.com', 'user', 50, 155, 19, 'female', 'moderately_active'),
(12, 'Carlos', '$2y$10$EnvlXGo7iUI/4XcK6u4RjOvfMp83njDkAr6uBmpox0gqoe2zypHry', 'laura@gmail.com', 'user', 50, 155, 30, 'male', 'lightly_active'),
(13, 'pepe', '$2y$10$tTLcXsUyq9F4ThqcdCsW/.GVygIuf9bcFET5wb7wGARxXti5OM5ti', 'pepe@gmail.com', 'user', 60, 170, 17, 'male', 'sedentary');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `nutrition`
--
ALTER TABLE `nutrition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `routines`
--
ALTER TABLE `routines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nutrition`
--
ALTER TABLE `nutrition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `routines`
--
ALTER TABLE `routines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tips`
--
ALTER TABLE `tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `nutrition`
--
ALTER TABLE `nutrition`
  ADD CONSTRAINT `nutrition_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `routines`
--
ALTER TABLE `routines`
  ADD CONSTRAINT `routines_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tips`
--
ALTER TABLE `tips`
  ADD CONSTRAINT `tips_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
