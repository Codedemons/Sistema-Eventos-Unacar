-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2023 a las 17:52:17
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BUSCAR_EVENTO_PERTENECE` (IN `Equipo` VARCHAR(100))   BEGIN
SELECT  evento.descripcionEvento

FROM (equipo join evento on equipo.idEvento=evento.idEvento)

where Equipo=equipo.nombreEquipo;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_OBTENER_DATOS_USUARIO` (IN `SpEmail` VARCHAR(80))   BEGIN
SELECT matriculaUsuario, nombreUsuario, apellidoUsuario, facultadUsuario, emailUsuario, telefonoUsuario, nombreRol 
from usuario inner join rol on usuario.idRol = rol.idRol
where SpEmail= usuario.emailUsuario ;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_OBTENER_DATOS_USUARIO_MATRICULA` (IN `Matricula` VARCHAR(10))   BEGIN
SELECT matricula, nombreRol, nombreUsuario, apellidoUsuario, facultadUsuario, emailUsuario, Pass, telefonoUsuario
from usuario inner join rol on usuario.idRol = rol.idRol
where Matricula= usuario.matriculaUsuario ;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_OBTENER_EVENTO` (IN `IDEvento` VARCHAR(10))   BEGIN
SELECT *
FROM evento
where IDEvento= evento.idEvento;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_OBTENER_EVENTOS_ACTIVOS` (IN `ACTIVOS` VARCHAR(80))   BEGIN
SELECT * 
FROM evento 
where ACTIVOS= statusEvento;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_OBTENER_JEFE` (IN `JEFE` VARCHAR(80))   BEGIN
SELECT idJefeCreador,idEquipo,nombreEquipo, nombreEvento, descripcionEvento, statusEvento 
FROM evento JOIN equipo ON equipo.idEvento = evento.idEvento 
WHERE JEFE=idJefeCreador;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_OBTENER_PARAMETRO` (IN `IDParametro` VARCHAR(10))   BEGIN
SELECT * 
FROM parametro
WHERE IDParametro = parametro.idParametro;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_OBTENER_REPRESENTANTE` (IN `REPRESENTANTE` VARCHAR(80))   BEGIN
SELECT idEquipo, nombreEquipo, nombreEvento,descripcionEvento
FROM equipo JOIN evento ON evento.idEvento = equipo.idEvento 
WHERE REPRESENTANTE=idJefeCreador;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_OBTENER_ROL` (IN `ROL` VARCHAR(20))   BEGIN
SELECT * 
FROM usuario NATURAL JOIN rol 
WHERE ROL = rol.nombreRol;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_OBTENER_USUARIO` (IN `ROL` VARCHAR(20))   BEGIN
SELECT * 
FROM usuario join rol on usuario.idRol = rol.idRol
where ROL= rol.nombreRol ;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_OBTENER_USUARIOS` (IN `INTEGRANTES` VARCHAR(20))   BEGIN

SELECT * FROM 
`usuario` JOIN equipo_usuario ON equipo_usuario.matriculaUsuario = usuario.matriculaUsuario 
WHERE INTEGRANTES =idEquipo;

end$$

DELIMITER ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `equipo_usuario`
--

INSERT INTO `equipo_usuario` (`idEquipo`, `matriculaUsuario`) VALUES
('0', '789456'),
('E01', '160032'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventoparametro`
--

INSERT INTO `eventoparametro` (`idEvento`, `idParametro`, `idEventoParametro`) VALUES
(1, 'P01', 41),
(1, 'P02', 42),
(2, 'P01', 43),
(0, 'P01', 45),
(2, 'P02', 46);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `eventos_ordenados`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `eventos_ordenados` (
`idEvento` char(20)
,`facultadUsuario` varchar(45)
,`nombreEvento` varchar(45)
,`descripcionEvento` varchar(100)
,`nombreUsuario` varchar(45)
,`statusEvento` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juez`
--

CREATE TABLE `juez` (
  `idJuez` char(6) NOT NULL,
  `nombreJuez` varchar(45) DEFAULT NULL,
  `apellidoJuez` varchar(45) NOT NULL,
  `facultadJuez` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
-- Estructura Stand-in para la vista `parametros_evento`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `parametros_evento` (
`idEventoParametro` int(25)
,`nombreParametro` varchar(45)
,`caracteristicaParametro` varchar(100)
,`nombreEvento` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` char(3) NOT NULL,
  `nombreRol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`matriculaUsuario`, `idRol`, `nombreUsuario`, `apellidoUsuario`, `facultadUsuario`, `emailUsuario`, `Pass`, `telefonoUsuario`) VALUES
('160032', 'R03', 'carmen', 'rg', 'fci', 'xd@mail.com', '0', '9381236756'),
('160612', 'R01', 'ITACHI', 'UCHIHA', 'KONOHA', 'UCHITA@MAIL.COM', '123', '1234567891'),
('190038', 'R03', 'GUSTAVO', 'GRANIEL', 'FCI', 'GUS@MAIL.COM', '123', '7894561235'),
('789456', 'R02', 'RAMON', 'PUCH', 'FCI', 'PUCHAMON@MAIL.COM', '123', '1234567891'),
('951753', 'R02', 'NENE', 'CONSENTIDO', 'FCI', 'NCON@MAIL.COM', '123', '7894561235');

-- --------------------------------------------------------

--
-- Estructura para la vista `eventos_ordenados`
--
DROP TABLE IF EXISTS `eventos_ordenados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eventos_ordenados`  AS SELECT `evento`.`idEvento` AS `idEvento`, `usuario`.`facultadUsuario` AS `facultadUsuario`, `evento`.`nombreEvento` AS `nombreEvento`, `evento`.`descripcionEvento` AS `descripcionEvento`, `usuario`.`nombreUsuario` AS `nombreUsuario`, `evento`.`statusEvento` AS `statusEvento` FROM (`evento` join `usuario` on(`evento`.`matriculaUsuario` = `usuario`.`matriculaUsuario`)) ORDER BY `evento`.`statusEvento` ASC  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `parametros_evento`
--
DROP TABLE IF EXISTS `parametros_evento`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `parametros_evento`  AS SELECT `eventoparametro`.`idEventoParametro` AS `idEventoParametro`, `parametro`.`nombreParametro` AS `nombreParametro`, `parametro`.`caracteristicaParametro` AS `caracteristicaParametro`, `evento`.`nombreEvento` AS `nombreEvento` FROM ((`parametro` join `eventoparametro` on(`parametro`.`idParametro` = `eventoparametro`.`idParametro`)) join `evento` on(`evento`.`idEvento` = `eventoparametro`.`idEvento`))  ;

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
  MODIFY `idEventoParametro` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
