-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2021 a las 22:23:00
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cakephp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `published` tinyint(1) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `title`, `slug`, `body`, `published`, `created`, `modified`) VALUES
(1, 1, 'Mi primer post.', 'mi-primer-post', 'Mi primer post.', 1, '2021-09-14 19:34:48', '2021-09-15 14:01:02'),
(2, 1, 'Mi segundo post.', 'mi-segundo-post', 'Mi segundo post.', 1, '2021-09-14 19:53:23', '2021-09-16 19:09:21'),
(3, 1, 'Mi tercer post.', 'mi-tercer-post', 'Mi tercer post.', 1, '2021-09-16 19:03:47', '2021-09-16 19:07:11'),
(4, 1, 'Mi cuarto post.', 'mi-cuarto-post', 'Mi cuarto post.', 1, '2021-09-16 19:07:58', '2021-09-16 19:07:58'),
(5, 1, 'Mi quinto post.', 'mi-quinto-post', 'Mi quinto post.', 1, '2021-09-16 19:33:59', '2021-09-16 19:34:16'),
(6, 1, 'Mi sexto post.', 'mi-sexto-post', 'Mi sexto post.', 1, '2021-09-16 20:18:14', '2021-09-16 20:18:14'),
(7, 1, 'Mi septimo post.', 'mi-septimo-post', 'Mi septimo post.', 1, '2021-09-16 20:19:16', '2021-09-16 20:19:16'),
(8, 1, 'Mi octavo post.', 'mi-octavo-post', 'Mi octavo post.', 1, '2021-09-16 20:20:20', '2021-09-16 20:20:20'),
(9, 1, 'Mi noveno post.', 'mi-noveno-post', 'Mi noveno post.', 1, '2021-09-16 20:20:52', '2021-09-16 20:20:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles_tags`
--

CREATE TABLE `articles_tags` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articles_tags`
--

INSERT INTO `articles_tags` (`id`, `article_id`, `tag_id`, `created`, `modified`) VALUES
(6, 1, 1, '2021-09-15 13:59:50', '2021-09-15 13:59:50'),
(7, 2, 3, '2021-09-15 14:00:14', '2021-09-15 14:00:14'),
(8, 2, 5, '2021-09-15 14:00:14', '2021-09-15 14:00:14'),
(9, 1, 2, '2021-09-15 14:01:03', '2021-09-15 14:01:03'),
(10, 3, 3, '2021-09-16 19:03:47', '2021-09-16 19:03:47'),
(11, 3, 5, '2021-09-16 19:03:47', '2021-09-16 19:03:47'),
(12, 4, 4, '2021-09-16 19:07:58', '2021-09-16 19:07:58'),
(13, 5, 5, '2021-09-16 19:33:59', '2021-09-16 19:33:59'),
(14, 6, 1, '2021-09-16 20:18:14', '2021-09-16 20:18:14'),
(15, 7, 2, '2021-09-16 20:19:16', '2021-09-16 20:19:16'),
(16, 8, 5, '2021-09-16 20:20:20', '2021-09-16 20:20:20'),
(17, 9, 3, '2021-09-16 20:20:52', '2021-09-16 20:20:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Super', '2021-09-13 21:38:13', '2021-09-15 20:34:45'),
(2, 'User', '2021-09-13 21:38:22', '2021-09-13 21:38:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `title`, `created`, `modified`) VALUES
(1, 'PHP', '2021-09-13 21:09:31', '2021-09-13 21:09:31'),
(2, 'CakePHP', '2021-09-13 21:09:45', '2021-09-13 21:09:45'),
(3, 'HTML', '2021-09-13 21:09:59', '2021-09-13 21:09:59'),
(4, 'Javascript', '2021-09-13 21:10:13', '2021-09-13 21:10:13'),
(5, 'CSS', '2021-09-13 21:10:23', '2021-09-13 21:10:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `lastname`, `email`, `password`, `created`, `modified`) VALUES
(1, 1, 'Super', 'One', 'superone@domain.com', '$2y$10$GtehKQDalOHtrBFsTc9uNuXWvdkLCHB/DLz4g1Ct.kw4JTBmD2qhm', '2021-09-13 21:39:31', '2021-09-14 20:23:36'),
(2, 1, 'Super', 'Two', 'supertwo@domain.com', '$2y$10$pGovDj.l3gd775g69yp0iOZ/n0aqagJU6NZwoOdEPdrieW2BN0AOK', '2021-09-13 21:44:08', '2021-09-15 02:26:35'),
(3, 2, 'User', 'One', 'userone@domain.com', '$2y$10$8O.YcxtShG2htXpibPleneGpgtyucmsZ7fdpVBsudM4cFwO/B1jZO', '2021-09-14 20:22:09', '2021-09-14 20:22:59'),
(4, 2, 'User', 'Two', 'usertwo@domain.com', '$2y$10$/6akcLSOSkKsg35HBZOcyOtqdKANSx6cDy2Pw137c7/rePl0xjJM2', '2021-09-15 02:27:48', '2021-09-15 02:27:48');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_key` (`user_id`);

--
-- Indices de la tabla `articles_tags`
--
ALTER TABLE `articles_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `articles_tags`
--
ALTER TABLE `articles_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `user_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
