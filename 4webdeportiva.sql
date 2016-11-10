-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2016 a las 14:42:47
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `4webdeportiva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornadas`
--

CREATE TABLE `jornadas` (
  `id` int(11) NOT NULL,
  `idliga` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jornadas`
--

INSERT INTO `jornadas` (`id`, `idliga`, `fecha`) VALUES
(1, 1, '2016-11-06'),
(2, 1, '2016-11-13'),
(3, 1, '2016-11-20'),
(4, 1, '2016-11-27'),
(5, 1, '2016-12-04'),
(6, 1, '2016-12-11'),
(7, 1, '2016-12-18'),
(8, 1, '2016-12-25'),
(9, 1, '2017-01-01'),
(10, 1, '2017-01-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liga`
--

CREATE TABLE `liga` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `liga`
--

INSERT INTO `liga` (`id`, `nombre`) VALUES
(1, 'BBVA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `id` int(11) NOT NULL,
  `idjornada` int(11) NOT NULL,
  `equipoLocal` varchar(50) NOT NULL,
  `golesLocal` int(2) NOT NULL,
  `equipoVisitante` varchar(50) NOT NULL,
  `golesVisitante` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`id`, `idjornada`, `equipoLocal`, `golesLocal`, `equipoVisitante`, `golesVisitante`) VALUES
(1, 1, 'Barcelona', 0, 'MÃ¡laga', 0),
(2, 1, 'Valencia', 0, 'Sevilla', 0),
(3, 2, 'Real Madrid', 1, 'MÃ¡laga', 0),
(4, 2, 'Barcelona', 2, 'Valencia', 0),
(5, 3, 'Real Madrid', 3, 'Sevilla', 2),
(6, 3, 'MÃ¡laga', 2, 'Valencia', 0),
(7, 4, 'Real Madrid', 0, 'Valencia', 0),
(8, 4, 'Sevilla', 0, 'Barcelona', 0),
(9, 5, 'Real Madrid', 0, 'Barcelona', 0),
(10, 5, 'Sevilla', 0, 'MÃ¡laga', 0),
(11, 6, 'MÃ¡laga', 0, 'Barcelona', 0),
(12, 6, 'Sevilla', 1, 'Valencia', 0),
(13, 7, 'MÃ¡laga', 0, 'Real Madrid', 2),
(14, 7, 'Valencia', 0, 'Barcelona', 0),
(15, 8, 'Sevilla', 0, 'Real Madrid', 0),
(16, 8, 'Valencia', 0, 'MÃ¡laga', 0),
(17, 9, 'Valencia', 0, 'Real Madrid', 0),
(18, 9, 'Barcelona', 0, 'Sevilla', 0),
(19, 10, 'Barcelona', 0, 'Real Madrid', 0),
(20, 10, 'MÃ¡laga', 0, 'Sevilla', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `pass`) VALUES
(1, 'admin', 'admin'),
(2, 'jescolar', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `liga`
--
ALTER TABLE `liga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
