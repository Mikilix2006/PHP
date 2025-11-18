-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-11-2025 a las 13:32:45
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
-- Base de datos: `BBDD1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`) VALUES
(2, 'Moto2'),
(3, 'Moto3'),
(4, 'Moto4'),
(1, 'MotoGP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuderia`
--

CREATE TABLE `escuderia` (
  `id_escuderia` int(11) NOT NULL,
  `nombre_escuderia` varchar(200) NOT NULL,
  `fk_id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escuderia`
--

INSERT INTO `escuderia` (`id_escuderia`, `nombre_escuderia`, `fk_id_categoria`) VALUES
(8, 'Ángel Nieto Team', 3),
(1, 'Ducati Lenovo', 1),
(6, 'Fantic Racing', 2),
(3, 'Honda', 1),
(7, 'Honda', 3),
(4, 'MT Helmets', 2),
(9, 'MT Helmets', 3),
(5, 'Pramac Racing', 2),
(10, 'Track House', 4),
(11, 'VR46', 4),
(2, 'Yamaha', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piloto`
--

CREATE TABLE `piloto` (
  `id_piloto` int(11) NOT NULL,
  `nombre_piloto` varchar(200) NOT NULL,
  `fk_id_escuderia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `piloto`
--

INSERT INTO `piloto` (`id_piloto`, `nombre_piloto`, `fk_id_escuderia`) VALUES
(1, 'Francesco Bagnaia, Italia', 1),
(2, 'Marc Marquez, España', 1),
(3, 'Fabio Quartararo, Francia', 2),
(4, 'Álex Rins, España', 2),
(5, 'Luca Marini, Italia', 3),
(6, 'Joan Mir, España', 3),
(7, 'Iván Ortolá, España', 4),
(8, 'Sergio García Dols, España', 4),
(9, 'Tony Arbolino, Italia', 5),
(10, 'Izan Guevara, España', 5),
(11, 'Aron Canet, España', 6),
(12, 'Barry Baults, Bélgica', 6),
(13, 'Tatchakorn Buasri, Tailandia', 7),
(14, 'Taiyo Furusato, Japón', 7),
(15, 'Máximo Quiles, España', 8),
(16, 'Dennis Foggia, Italia', 8),
(17, 'Ryusei Yamanaka, Japón', 9),
(18, 'Ángel Piqueras, España', 9),
(19, 'Valentino Rossi, Italia', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebita`
--

CREATE TABLE `pruebita` (
  `id` int(11) DEFAULT NULL,
  `label` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pruebita`
--

INSERT INTO `pruebita` (`id`, `label`) VALUES
(1, 'PHP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `rol` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user`, `password`, `rol`) VALUES
('fermin', '$2y$10$PkfDMEltEU9TKnE3sGZlMegdvNgwW6pVJMy8Vv8q8DonLG8COPMNy', 0),
('manolin', '$2y$10$MTjeCZx2NzBqjNoyEVlH4.C2E9B7T8zjl/JW6dYBoQhjj.ux9n5Yi', 0),
('Miguel', '$2y$10$9vBolgveBBE0D8yYIfS4ieyG9idv/KDTIT3.y5hpgeHxgWeJt50jO', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre_categoria` (`nombre_categoria`);

--
-- Indices de la tabla `escuderia`
--
ALTER TABLE `escuderia`
  ADD PRIMARY KEY (`id_escuderia`),
  ADD UNIQUE KEY `nombre_escuderia` (`nombre_escuderia`,`fk_id_categoria`),
  ADD KEY `id_categoria` (`fk_id_categoria`);

--
-- Indices de la tabla `piloto`
--
ALTER TABLE `piloto`
  ADD PRIMARY KEY (`id_piloto`),
  ADD KEY `id_escuderia` (`fk_id_escuderia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `escuderia`
--
ALTER TABLE `escuderia`
  MODIFY `id_escuderia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `piloto`
--
ALTER TABLE `piloto`
  MODIFY `id_piloto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `escuderia`
--
ALTER TABLE `escuderia`
  ADD CONSTRAINT `escuderia_ibfk_1` FOREIGN KEY (`fk_id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `piloto`
--
ALTER TABLE `piloto`
  ADD CONSTRAINT `piloto_ibfk_1` FOREIGN KEY (`fk_id_escuderia`) REFERENCES `escuderia` (`id_escuderia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
