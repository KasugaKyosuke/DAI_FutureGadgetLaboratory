-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2018 a las 03:54:36
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `masvida`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centromedico`
--

CREATE TABLE IF NOT EXISTS `centromedico` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `direccion` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `centromedico`
--

INSERT INTO `centromedico` (`id`, `nombre`, `direccion`) VALUES
(100, 'Paseo Huérfanos, Santiago', 'Huérfanos 123. Piso -1. Santiago'),
(200, 'Barros Arana, Concepción', 'Barros Arana 666, Piso 30. Concepción'),
(300, 'Alonso Ovalle, Santiago', 'Alonso de Ovalle 555. Piso -3. Santiago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE IF NOT EXISTS `especialidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id`, `nombre`) VALUES
(3000, 'Cardiología'),
(4000, 'Cirugía Plástica'),
(1000, 'Medicina General'),
(2000, 'Traumatología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad_centromedico`
--

CREATE TABLE IF NOT EXISTS `especialidad_centromedico` (
  `id_centromedico` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  PRIMARY KEY (`id_centromedico`,`id_especialidad`),
  KEY `id_especialidad` (`id_especialidad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `especialidad_centromedico`
--

INSERT INTO `especialidad_centromedico` (`id_centromedico`, `id_especialidad`) VALUES
(100, 1000),
(200, 1000),
(300, 1000),
(100, 2000),
(100, 3000),
(300, 3000),
(100, 4000),
(200, 4000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `id` int(11) NOT NULL,
  `hora` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hora` (`hora`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `hora`) VALUES
(1, '08:00'),
(2, '08:30'),
(3, '09:00'),
(4, '09:30'),
(5, '10:00'),
(6, '10:30'),
(7, '11:00'),
(8, '11:30'),
(9, '12:00'),
(10, '12:30'),
(11, '13:00'),
(12, '13:30'),
(13, '14:00'),
(14, '14:30'),
(15, '15:00'),
(16, '15:30'),
(17, '16:00'),
(18, '16:30'),
(19, '17:00'),
(20, '17:30'),
(21, '18:00'),
(22, '18:30'),
(23, '19:00'),
(24, '19:30'),
(25, '20:00'),
(26, '20:30'),
(27, '21:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE IF NOT EXISTS `profesional` (
  `id` int(11) NOT NULL,
  `nombres` varchar(64) NOT NULL,
  `apellidos` varchar(64) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `id_centromedico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_especialidad` (`id_especialidad`,`id_centromedico`),
  KEY `id_especialidad_2` (`id_especialidad`),
  KEY `id_centromedico` (`id_centromedico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`id`, `nombres`, `apellidos`, `id_especialidad`, `id_centromedico`) VALUES
(9876345, 'Patricia Pamela', 'Vásquez Vidal', 3000, 100),
(10987123, 'Alfredo Alonso', 'Ramírez Riquelme', 2000, 100),
(11111111, 'Juan José', 'Pérez Pereira', 1000, 100),
(11321123, 'Javiera Jacinta', 'Monato Muñoz', 3000, 300),
(12123123, 'Pedro Pablo', 'Cárdenas Contreras', 4000, 200),
(22222222, 'Amanda Antonia', 'Burgos Barros', 1000, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
  `id_paciente` int(11) NOT NULL,
  `id_profesional` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` int(11) NOT NULL,
  PRIMARY KEY (`id_paciente`,`id_profesional`,`fecha`),
  KEY `hora` (`hora`),
  KEY `id_profesional` (`id_profesional`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id_paciente`, `id_profesional`, `fecha`, `hora`) VALUES
(10000000, 11321123, '2015-06-02', 8),
(1, 11321123, '2018-05-03', 13),
(15312822, 9876345, '2018-05-12', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `email` varchar(64) NOT NULL,
  `clave` varchar(256) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--
INSERT INTO `usuario` (`email`, `clave`, `nombre`) VALUES
('dba@vivamas.com', PASSWORD('asdf'), 'Administrador');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `especialidad_centromedico`
--
ALTER TABLE `especialidad_centromedico`
  ADD CONSTRAINT `especialidad_centromedico_ibfk_2` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id`),
  ADD CONSTRAINT `especialidad_centromedico_ibfk_1` FOREIGN KEY (`id_centromedico`) REFERENCES `centromedico` (`id`);

--
-- Filtros para la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD CONSTRAINT `profesional_ibfk_2` FOREIGN KEY (`id_centromedico`) REFERENCES `centromedico` (`id`),
  ADD CONSTRAINT `profesional_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`hora`) REFERENCES `horario` (`id`),
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_profesional`) REFERENCES `profesional` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
