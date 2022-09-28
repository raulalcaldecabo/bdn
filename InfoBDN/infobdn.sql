-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-09-2022 a las 10:47:41
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infobdn`
--
CREATE DATABASE IF NOT EXISTS `infobdn` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `infobdn`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `1` int(3) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `contrasena` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`1`, `nombre`, `contrasena`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `ID` int(3) NOT NULL,
  `dni` int(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `contrasena` varchar(35) NOT NULL,
  `activo` int(1) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`ID`, `dni`, `nombre`, `apellido`, `mail`, `contrasena`, `activo`, `foto`) VALUES
(1, 0, 'paquito', 'chocolatero', 'paco@choco.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `ID` int(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `duracion` int(11) NOT NULL,
  `inicio` date NOT NULL,
  `final` date NOT NULL,
  `profesor` int(3) NOT NULL,
  `activo` varchar(1) NOT NULL,
  `cfoto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`ID`, `nombre`, `descripcion`, `duracion`, `inicio`, `final`, `profesor`, `activo`, `cfoto`) VALUES
(1, 'web', 'otr curso', 50, '2022-10-05', '2022-11-03', 2, '1', ''),
(2, 'desarrollo web', 'un curso', 80, '2022-11-24', '2022-12-09', 1, '1', ''),
(3, 'ofimatica', 'mas curso', 60, '2022-11-24', '2022-12-09', 2, '', ''),
(4, 'ofimatica', 'otro curso', 60, '2022-11-24', '2022-12-09', 2, '0', ''),
(5, 'redes', 'otro curso sin mas', 100, '2022-11-24', '2022-12-09', 3, '', ''),
(7, 'onanismo', 'el consuelo del solitario', 1, '2022-11-24', '2022-11-24', 2, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `idCurso` int(3) NOT NULL,
  `IdAlumno` int(3) NOT NULL,
  `Nota` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`idCurso`, `IdAlumno`, `Nota`) VALUES
(2, 1, 0),
(2, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `ID` int(3) NOT NULL,
  `dni` int(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `contrasena` varchar(35) NOT NULL,
  `activo` int(1) NOT NULL,
  `pfoto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`ID`, `dni`, `nombre`, `apellido`, `titulo`, `mail`, `contrasena`, `activo`, `pfoto`) VALUES
(1, 99999999, 'sinprofe', 'sinprofe', 'uno', '', '827ccb0eea8a706c4c34a16891f84e7b', 1, ''),
(2, 46543456, 'pedro', 'maravilla', 'dos', 'pedro@pedro.es', '827ccb0eea8a706c4c34a16891f84e7b', 1, ''),
(3, 44667788, 'armando', 'bronca', 'no titulo', 'uno@otro.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, ''),
(5, 66774499, 'notingan', 'prisas', 'muchos', 'paso', '827ccb0eea8a706c4c34a16891f84e7b', 0, ''),
(8, 99887766, 'magic', 'andreu', 'dos titulos', 'uno@otro.es', '827ccb0eea8a706c4c34a16891f84e7b', 1, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`1`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `profesor` (`profesor`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD KEY `IdAlumno` (`IdAlumno`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `1` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`profesor`) REFERENCES `profesores` (`ID`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`IdAlumno`) REFERENCES `alumnos` (`ID`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
