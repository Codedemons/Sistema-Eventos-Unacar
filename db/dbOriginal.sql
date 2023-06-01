-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2022 a las 20:04:38
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `parametro`
--
ALTER TABLE `parametro`
  ADD PRIMARY KEY (`idParametro`),
  ADD UNIQUE KEY `idParametro_UNIQUE` (`idParametro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
