-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2022 a las 20:36:39
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
-- Base de datos: `eventofci`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `idCalificacion` char(3) NOT NULL,
  `idEquipo` char(3) NOT NULL,
  `idParametro` char(3) NOT NULL,
  `idJuez` char(6) NOT NULL,
  `idEvento` char(20) NOT NULL,
  `calificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`idCalificacion`, `idEquipo`, `idParametro`, `idJuez`, `idEvento`, `calificacion`) VALUES
('C01', 'E01', 'P01', '190038', '1', 8),
('C02', 'E01', 'P01', '190038', '1', 9);

--
-- Disparadores `calificaciones`
--
DELIMITER $$
CREATE TRIGGER `autoCodigoCalificaciones` BEFORE INSERT ON `calificaciones` FOR EACH ROW BEGIN
	DECLARE siguienteCodigo INT;
    SET siguienteCodigo = (SELECT IFNULL(MAX(CONVERT(SUBSTRING(idCalificacion, 2), SIGNED INTEGER)), 0) FROM calificaciones) + 1;
    SET NEW.idCalificacion = CONCAT('C', LPAD(siguienteCodigo, 2, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idJefeCreador` int(10) NOT NULL,
  `idEquipo` char(3) NOT NULL,
  `idEvento` char(20) NOT NULL,
  `nombreEquipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idJefeCreador`, `idEquipo`, `idEvento`, `nombreEquipo`) VALUES
(0, '0', '1', 'ubu'),
(789456, 'E01', '1', 'ROCKET'),
(951753, 'E02', '1', 'TNT');

--
-- Disparadores `equipo`
--
DELIMITER $$
CREATE TRIGGER `autoCodigoEquipo` BEFORE INSERT ON `equipo` FOR EACH ROW BEGIN
	DECLARE siguienteCodigo INT;
    SET siguienteCodigo = (SELECT IFNULL(MAX(CONVERT(SUBSTRING(idEquipo, 2), SIGNED INTEGER)), 0) FROM equipo) + 1;
    SET NEW.idEquipo = CONCAT('E', LPAD(siguienteCodigo, 2, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_usuario`
--

CREATE TABLE `equipo_usuario` (
  `idEquipo` char(3) NOT NULL,
  `matriculaUsuario` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipo_usuario`
--

INSERT INTO `equipo_usuario` (`idEquipo`, `matriculaUsuario`) VALUES
('0', '789456'),
('E02', '951753');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `idEvento` char(20) NOT NULL,
  `matriculaUsuario` char(6) NOT NULL,
  `nombreEvento` varchar(45) DEFAULT NULL,
  `descripcionEvento` varchar(100) DEFAULT NULL,
  `statusEvento` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`idEvento`, `matriculaUsuario`, `nombreEvento`, `descripcionEvento`, `statusEvento`) VALUES
('1', '160612', 'CATRINAS', 'ALTAR CATRINAS', 'ACTIVO'),
('2', '190038', 'NAVIDAD', 'ARBOL DE NAVIDAD', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventoparametro`
--

CREATE TABLE `eventoparametro` (
  `idEvento` int(10) DEFAULT NULL,
  `idParametro` varchar(50) DEFAULT NULL,
  `idEventoParametro` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventoparametro`
--

INSERT INTO `eventoparametro` (`idEvento`, `idParametro`, `idEventoParametro`) VALUES
(1, 'P01', 41),
(1, 'P02', 42),
(2, 'P01', 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juez`
--

CREATE TABLE `juez` (
  `idJuez` char(6) NOT NULL,
  `nombreJuez` varchar(45) DEFAULT NULL,
  `apellidoJuez` varchar(45) NOT NULL,
  `facultadJuez` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `juez`
--

INSERT INTO `juez` (`idJuez`, `nombreJuez`, `apellidoJuez`, `facultadJuez`) VALUES
('190038', 'GUSTAVO', 'GRANIEL', 'FCI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juez_evento`
--

CREATE TABLE `juez_evento` (
  `idEvento` char(20) NOT NULL,
  `idJuez` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `juez_evento`
--

INSERT INTO `juez_evento` (`idEvento`, `idJuez`) VALUES
('1', '190038');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametro`
--

CREATE TABLE `parametro` (
  `idParametro` char(3) NOT NULL,
  `nombreParametro` varchar(45) DEFAULT NULL,
  `caracteristicaParametro` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parametro`
--

INSERT INTO `parametro` (`idParametro`, `nombreParametro`, `caracteristicaParametro`) VALUES
('P01', 'PRENSETACION', 'PRESENTACION IMPECABLE'),
('P02', 'CHARLA', 'HISTORIA IMPECABLE');

--
-- Disparadores `parametro`
--
DELIMITER $$
CREATE TRIGGER `autoCodigoParametro` BEFORE INSERT ON `parametro` FOR EACH ROW BEGIN
	DECLARE siguienteCodigo INT;
    SET siguienteCodigo = (SELECT IFNULL(MAX(CONVERT(SUBSTRING(idParametro, 2), SIGNED INTEGER)), 0) FROM parametro) + 1;
    SET NEW.idParametro = CONCAT('P', LPAD(siguienteCodigo, 2, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` char(3) NOT NULL,
  `nombreRol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`) VALUES
('R01', 'ADMIN'),
('R02', 'JEFE DE EQUIPO'),
('R03', 'JUEZ'),
('R04', 'INTEGRANTE');

--
-- Disparadores `rol`
--
DELIMITER $$
CREATE TRIGGER `autoCodigoRol` BEFORE INSERT ON `rol` FOR EACH ROW BEGIN
	DECLARE siguienteCodigo INT;
    SET siguienteCodigo = (SELECT IFNULL(MAX(CONVERT(SUBSTRING(idRol, 2), SIGNED INTEGER)), 0) FROM rol) + 1;
    SET NEW.idRol = CONCAT('R', LPAD(siguienteCodigo, 2, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `matriculaUsuario` char(6) NOT NULL,
  `idRol` char(3) NOT NULL,
  `nombreUsuario` varchar(45) DEFAULT NULL,
  `apellidoUsuario` varchar(45) DEFAULT NULL,
  `facultadUsuario` varchar(45) DEFAULT NULL,
  `emailUsuario` varchar(45) DEFAULT NULL,
  `Pass` varchar(60) NOT NULL,
  `telefonoUsuario` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`matriculaUsuario`, `idRol`, `nombreUsuario`, `apellidoUsuario`, `facultadUsuario`, `emailUsuario`, `Pass`, `telefonoUsuario`) VALUES
('160612', 'R01', 'ITACHI', 'UCHIHA', 'KONOHA', 'UCHITA@MAIL.COM', '123', '1234567891'),
('190038', 'R03', 'GUSTAVO', 'GRANIEL', 'FCI', 'GUS@MAIL.COM', '123', '7894561235'),
('789456', 'R02', 'RAMON', 'PUCH', 'FCI', 'PUCHAMON@MAIL.COM', '123', '1234567891'),
('951753', 'R02', 'NENE', 'CONSENTIDO', 'FCI', 'NCON@MAIL.COM', '123', '7894561235');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`idCalificacion`),
  ADD KEY `fk_calificaciones_equipo1_idx` (`idEquipo`),
  ADD KEY `fk_calificaciones_parametro1_idx` (`idParametro`),
  ADD KEY `fk_calificaciones_juez1_idx` (`idJuez`),
  ADD KEY `fk_calificaciones_evento1_idx` (`idEvento`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idEquipo`),
  ADD KEY `fk_equipo_evento1_idx` (`idEvento`);

--
-- Indices de la tabla `equipo_usuario`
--
ALTER TABLE `equipo_usuario`
  ADD PRIMARY KEY (`idEquipo`,`matriculaUsuario`),
  ADD KEY `fk_equipo_has_usuario_usuario1_idx` (`matriculaUsuario`),
  ADD KEY `fk_equipo_has_usuario_equipo1_idx` (`idEquipo`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `fk_evento_usuario1_idx` (`matriculaUsuario`);

--
-- Indices de la tabla `eventoparametro`
--
ALTER TABLE `eventoparametro`
  ADD PRIMARY KEY (`idEventoParametro`);

--
-- Indices de la tabla `juez`
--
ALTER TABLE `juez`
  ADD PRIMARY KEY (`idJuez`),
  ADD UNIQUE KEY `idjuez_UNIQUE` (`idJuez`);

--
-- Indices de la tabla `juez_evento`
--
ALTER TABLE `juez_evento`
  ADD PRIMARY KEY (`idEvento`,`idJuez`),
  ADD KEY `fk_evento_has_juez_juez1_idx` (`idJuez`),
  ADD KEY `fk_evento_has_juez_evento1_idx` (`idEvento`);

--
-- Indices de la tabla `parametro`
--
ALTER TABLE `parametro`
  ADD PRIMARY KEY (`idParametro`),
  ADD UNIQUE KEY `idParametro_UNIQUE` (`idParametro`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`),
  ADD UNIQUE KEY `idRol_UNIQUE` (`idRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`matriculaUsuario`),
  ADD KEY `fk_usuario_rol1_idx` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventoparametro`
--
ALTER TABLE `eventoparametro`
  MODIFY `idEventoParametro` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `fk_calificaciones_equipo1` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_calificaciones_evento1` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_calificaciones_juez1` FOREIGN KEY (`idJuez`) REFERENCES `juez` (`idJuez`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_calificaciones_parametro1` FOREIGN KEY (`idParametro`) REFERENCES `parametro` (`idParametro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `fk_equipo_evento1` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `equipo_usuario`
--
ALTER TABLE `equipo_usuario`
  ADD CONSTRAINT `fk_equipo_has_usuario_equipo1` FOREIGN KEY (`idEquipo`) REFERENCES `equipo` (`idEquipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_equipo_has_usuario_usuario1` FOREIGN KEY (`matriculaUsuario`) REFERENCES `usuario` (`matriculaUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_evento_usuario1` FOREIGN KEY (`matriculaUsuario`) REFERENCES `usuario` (`matriculaUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `juez_evento`
--
ALTER TABLE `juez_evento`
  ADD CONSTRAINT `fk_evento_has_juez_evento1` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evento_has_juez_juez1` FOREIGN KEY (`idJuez`) REFERENCES `juez` (`idJuez`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
