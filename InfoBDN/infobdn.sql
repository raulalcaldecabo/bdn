-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2022 a las 09:20:19
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
(1, 11111111, 'paquito', 'chocolatero', 'paco@choco.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'imagen/1-charles-manson.jpeg'),
(6, 22222222, 'pedro', 'picapiedra', 'pedro@picapiedra', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'imagen/6-arropero.jpg'),
(7, 33333333, 'pablo', 'marmol', 'pablo@marmol.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'imagen/7-tedBundi.jpg'),
(8, 44444444, 'vampirella', 'vampira', 'vampirella@vamp.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'imagen/8-pogo.jpg'),
(9, 55555555, 'paty', 'notepases', 'paty@paty.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'imagen/9-5fa447867b5d3.png');

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
(1, 'web', 'Estudiant aquest cicle formatiu obtindràs la titulació de tècnic o tècnica superior en desenvolupame', 50, '2022-10-05', '2022-11-03', 2, '1', 'imagen/1-web.jpg'),
(2, 'desarrollo web', 'Estudiant aquest cicle formatiu obtindràs la titulació de tècnic o tècnica superior en desenvolupame', 80, '2022-09-01', '2022-09-30', 2, '1', 'imagen/2-World_wide_web.jpg'),
(3, 'ofimatica', 'Las herramientas de Word, Excel u Office o de correo como Outlook, son las principales herramientas ', 60, '2022-11-24', '2022-12-09', 5, '1', 'imagen/3-daisi-ofimatica-ofimatica.jpg'),
(4, 'ofimatica', 'Las herramientas de Word, Excel u Office o de correo como Outlook, son las principales herramientas ', 60, '2022-11-24', '2022-12-09', 5, '1', 'imagen/4-Curso_Ofimatica.jpg'),
(5, 'redes', 'Las redes son los mecanismos que se utilizan para transmitir información entre dos puntos a través d', 100, '2022-11-24', '2022-12-09', 8, '1', 'imagen/5-redes.jpg'),
(7, 'onanismo', 'el consuelo del solitario.\r\nAcción y efecto de masturbar o masturbarse.', 1, '2022-11-24', '2022-11-24', 8, '1', 'imagen/7-red.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `idMatricula` int(3) NOT NULL,
  `idCurso` int(3) NOT NULL,
  `IdAlumno` int(3) NOT NULL,
  `Nota` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`idMatricula`, `idCurso`, `IdAlumno`, `Nota`) VALUES
(1, 2, 1, 7),
(2, 3, 1, 0),
(4, 4, 6, 0),
(5, 4, 8, 0),
(6, 2, 6, 0),
(7, 3, 8, 0),
(8, 5, 7, 0),
(9, 4, 7, 0),
(10, 1, 9, 0),
(11, 7, 9, 0),
(13, 1, 6, 0),
(14, 7, 1, 0);

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
(1, 99999999, 'sinprofe', 'sinprofe', 'uno', '', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'imagen/1-unjonkie.jpg'),
(2, 11111111, 'pedro', 'maravilla', 'dos', 'pedro@pedro.es', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'imagen/2-jonkie2.jpg'),
(3, 22222222, 'armando', 'bronca', 'no titulo', 'uno@otro.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'imagen/3-jonkie3.jpg'),
(5, 33333333, 'notingan', 'prisas', 'muchos', 'paso', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'imagen/5-jonkie6.jpg'),
(8, 44444444, 'magic', 'andreu', 'dos titulos', 'uno@otro.es', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'imagen/8-jonki5.jpg');

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
  ADD PRIMARY KEY (`idMatricula`),
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
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `idMatricula` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
