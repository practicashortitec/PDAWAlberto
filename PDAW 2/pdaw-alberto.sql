-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2024 a las 11:01:40
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pdaw-alberto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `id_habito` int(11) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `id_habito`, `categoria`) VALUES
(1, 399, 'fisico'),
(2, 400, 'intelectual'),
(3, 401, 'costumbrista'),
(4, 402, 'intelectual'),
(5, 403, 'recreativo'),
(6, 404, 'fisico'),
(7, 405, 'saludable'),
(8, 406, 'recreativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL,
  `nota` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dia_in` date NOT NULL,
  `dia_out` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`id_nota`, `nota`, `email`, `dia_in`, `dia_out`) VALUES
(1, '', 'prueba@prueba.com', '2024-05-13', '2024-05-19'),
(2, '', 'alberto@alberto.com', '2024-05-13', '2024-05-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`, `email`) VALUES
(1, 'user', 'prueba@prueba.com'),
(2, 'user', 'alberto@alberto.com'),
(3, 'admin', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tracker`
--

CREATE TABLE `tracker` (
  `email` varchar(255) NOT NULL,
  `dia_in` date NOT NULL,
  `dia_out` date NOT NULL,
  `habit` varchar(255) NOT NULL,
  `dia1` tinyint(1) NOT NULL,
  `dia2` tinyint(1) NOT NULL,
  `dia3` tinyint(1) NOT NULL,
  `dia4` tinyint(1) NOT NULL,
  `dia5` tinyint(1) NOT NULL,
  `dia6` tinyint(1) NOT NULL,
  `dia7` tinyint(1) NOT NULL,
  `id_habito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tracker`
--

INSERT INTO `tracker` (`email`, `dia_in`, `dia_out`, `habit`, `dia1`, `dia2`, `dia3`, `dia4`, `dia5`, `dia6`, `dia7`, `id_habito`) VALUES
('prueba@prueba.com', '2024-05-13', '2024-05-19', 'gym', 1, 0, 1, 0, 1, 0, 0, 399),
('prueba@prueba.com', '2024-05-13', '2024-05-19', 'estudiar', 0, 1, 0, 1, 0, 0, 0, 400),
('prueba@prueba.com', '2024-05-13', '2024-05-19', 'trabajar', 1, 1, 1, 1, 1, 0, 0, 401),
('prueba@prueba.com', '2024-05-13', '2024-05-19', 'inglÃ©s', 0, 1, 0, 1, 0, 0, 0, 402),
('prueba@prueba.com', '2024-05-13', '2024-05-19', 'cerveza', 0, 0, 0, 0, 0, 1, 1, 403),
('alberto@alberto.com', '2024-05-13', '2024-05-19', 'gym', 1, 0, 1, 1, 1, 0, 0, 404),
('alberto@alberto.com', '2024-05-13', '2024-05-19', 'dieta', 1, 1, 1, 1, 1, 1, 1, 405),
('alberto@alberto.com', '2024-05-13', '2024-05-19', 'fiesta', 0, 0, 0, 0, 0, 1, 0, 406);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellidos`, `usuario`, `email`, `password`) VALUES
('admin', 'admin', 'admin', 'admin@admin.com', '$2y$10$pDN3cswyNLY7IRoC/LwlZOgdETuNAILCtXya6Zb6lw3aCoVd0p.Qe'),
('Alberto', 'Saporta Albelda', 'alberto', 'alberto@alberto.com', '$2y$10$99tlrMguQZ8a4ickk1IvUOfv5/fC9UeSnSpWeISUTNspZdXcZz3la'),
('Prueba', 'Pruebas Pruebas', 'prueba', 'prueba@prueba.com', '$2y$10$le1bjZqUKPzoAg/QqeJhyuXKNPLaNYe0nIs70yHjjP9yD71Q4LAma');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_habito` (`id_habito`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `email` (`email`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD KEY `email` (`email`);

--
-- Indices de la tabla `tracker`
--
ALTER TABLE `tracker`
  ADD PRIMARY KEY (`id_habito`),
  ADD KEY `email` (`email`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tracker`
--
ALTER TABLE `tracker`
  MODIFY `id_habito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=407;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`id_habito`) REFERENCES `tracker` (`id_habito`);

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rol`
--
ALTER TABLE `rol`
  ADD CONSTRAINT `rol_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`);

--
-- Filtros para la tabla `tracker`
--
ALTER TABLE `tracker`
  ADD CONSTRAINT `tracker_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
