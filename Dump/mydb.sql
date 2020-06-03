-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2020 a las 04:16:25
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camas`
--

CREATE TABLE `camas` (
  `Id` int(11) NOT NULL,
  `Estado` varchar(25) DEFAULT NULL,
  `Habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `camas`
--

INSERT INTO `camas` (`Id`, `Estado`, `Habitacion`) VALUES
(1, 'Ocupado', 1),
(2, 'Ocupado', 1),
(3, 'Ocupado', 2),
(4, 'Ocupado', 2),
(5, 'Ocupado', 1),
(6, 'Disponible', 2),
(7, 'Disponible', 3),
(8, 'Disponible', 4),
(9, 'Disponible', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `Id` int(11) NOT NULL,
  `Numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`Id`, `Numero`) VALUES
(1, 901),
(2, 902),
(3, 1000),
(4, 1001),
(5, 1002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `Id` int(11) NOT NULL,
  `Nombre` char(60) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL,
  `Tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`Id`, `Nombre`, `Cantidad`, `Tipo`) VALUES
(1, 'Mascarillas', 9, 'Enseres'),
(2, 'Suero', 4, 'Enseres'),
(3, 'Anestesia', 3, 'Enseres'),
(4, 'Ventiladores', 14, 'Equipo'),
(5, 'Máquinas de Resonancia', 5, 'Equipo'),
(6, 'Máquinas de Ecografía', 8, 'Equipo'),
(7, 'Perico', 14, 'Enseres'),
(8, 'Maquina REQ', 14, 'Equipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `Idp` int(11) NOT NULL,
  `Nombre` char(25) DEFAULT NULL,
  `Apellido` char(25) DEFAULT NULL,
  `Cedula` int(11) NOT NULL,
  `Duracion` int(11) NOT NULL,
  `Diagnostico` varchar(255) DEFAULT NULL,
  `FechaIngreso` date NOT NULL,
  `Prioridad` int(11) DEFAULT NULL,
  `Medico` int(11) NOT NULL,
  `Cama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`Idp`, `Nombre`, `Apellido`, `Cedula`, `Duracion`, `Diagnostico`, `FechaIngreso`, `Prioridad`, `Medico`, `Cama`) VALUES
(1, 'Juanito', 'Camachutra', 12345, 3, 'Se va a morir', '2020-06-01', 3, 2, 1),
(2, 'JuCami', 'Deschaflo', 13579, 5, 'Tiene Sida', '2020-06-02', 2, 2, 2),
(3, 'Juliancho', 'Stop', 24680, 7, 'Tiene cancer', '2020-06-03', 1, 2, 3),
(4, 'Rien', 'Sptm', 67890, 9, 'Coronaviros is real', '2020-06-04', 2, 3, 4),
(5, 'Pablo', 'Pablis', 10203920, 10, 'Accidente de carro', '2020-06-01', 2, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientesxinventario`
--

CREATE TABLE `pacientesxinventario` (
  `Id` int(11) NOT NULL,
  `Paciente` int(11) NOT NULL,
  `Item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientesxinventario`
--

INSERT INTO `pacientesxinventario` (`Id`, `Paciente`, `Item`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(5, 1, 5),
(6, 1, 6),
(7, 2, 1),
(8, 2, 4),
(9, 1, 2),
(10, 5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `Cedula` int(11) NOT NULL,
  `Nombre` char(25) DEFAULT NULL,
  `Apellido` char(25) DEFAULT NULL,
  `Email` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`Cedula`, `Nombre`, `Apellido`, `Email`) VALUES
(12345, 'Juan D', 'Vera P', 'juanm@gmail.com'),
(67890, 'Daniela A', 'Vera P', 'danielam@gmail.com'),
(102928392, 'Camilo', 'Rodriguez', 'camilo@hotmail.com'),
(1010105825, 'Pepito', 'Perez', 'prowe202010@gmail.com'),
(1020828518, 'Camilo', 'Chafloque', 'chaflo@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `IdSolicitud` int(11) NOT NULL,
  `Paciente` int(11) NOT NULL,
  `Medico` int(11) NOT NULL,
  `FechaSolicitud` datetime DEFAULT NULL,
  `Suministro` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Estado` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`IdSolicitud`, `Paciente`, `Medico`, `FechaSolicitud`, `Suministro`, `Cantidad`, `Estado`) VALUES
(10, 1, 2, '2020-06-04 22:34:00', 1, 3, 'No aprovado'),
(11, 4, 3, '2020-06-05 06:32:00', 2, 1, 'No aprovado'),
(12345, 1, 2, '2020-06-03 03:57:11', 1, 2, 'No aprobado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `NombreUsuario` varchar(255) NOT NULL,
  `Rol` varchar(255) NOT NULL,
  `Contrasena` varchar(255) NOT NULL,
  `Cedula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `NombreUsuario`, `Rol`, `Contrasena`, `Cedula`) VALUES
(1, 'admin', 'administrador', 'sawPVcEzGyQ7k', 1010105825),
(2, 'juanm', 'medico', 'saHxwhaj9nWUI', 12345),
(3, 'danielam', 'medico', 'sanqXjeXcL3SQ', 67890),
(4, 'Chaflo', 'administrador', 'saN6ElUfeQ8Qs', 1020828518),
(5, 'DoctorChafo', 'medico', 'sahQGAQiWubQ.', 102928392);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camas`
--
ALTER TABLE `camas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Habitacion` (`Habitacion`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`Idp`),
  ADD KEY `Medico` (`Medico`),
  ADD KEY `Cama` (`Cama`);

--
-- Indices de la tabla `pacientesxinventario`
--
ALTER TABLE `pacientesxinventario`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Paciente` (`Paciente`),
  ADD KEY `Item` (`Item`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`Cedula`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD KEY `Paciente` (`Paciente`),
  ADD KEY `Medico` (`Medico`),
  ADD KEY `Suministro` (`Suministro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Cedula` (`Cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `camas`
--
ALTER TABLE `camas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `Idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pacientesxinventario`
--
ALTER TABLE `pacientesxinventario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `camas`
--
ALTER TABLE `camas`
  ADD CONSTRAINT `camas_ibfk_1` FOREIGN KEY (`Habitacion`) REFERENCES `habitaciones` (`Id`);

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`Medico`) REFERENCES `usuarios` (`Id`),
  ADD CONSTRAINT `pacientes_ibfk_2` FOREIGN KEY (`Cama`) REFERENCES `camas` (`Id`);

--
-- Filtros para la tabla `pacientesxinventario`
--
ALTER TABLE `pacientesxinventario`
  ADD CONSTRAINT `pacientesxinventario_ibfk_1` FOREIGN KEY (`Paciente`) REFERENCES `pacientes` (`Idp`),
  ADD CONSTRAINT `pacientesxinventario_ibfk_2` FOREIGN KEY (`Item`) REFERENCES `inventario` (`Id`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`Paciente`) REFERENCES `pacientes` (`Idp`),
  ADD CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`Medico`) REFERENCES `usuarios` (`Id`),
  ADD CONSTRAINT `solicitudes_ibfk_3` FOREIGN KEY (`Suministro`) REFERENCES `inventario` (`Id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Cedula`) REFERENCES `personas` (`Cedula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
