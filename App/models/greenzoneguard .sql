-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2025 a las 15:45:24
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `greenzoneguard`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion`
--

drop database greenzoneguard;

create database greenzoneguard;

use greenzoneguard;

DROP TABLE IF EXISTS `administracion`;

CREATE TABLE `administracion` (
  `Documento_Administrador` varchar(50) NOT NULL,
  `Nombre_Administrador` varchar(50) NOT NULL,
  `Apellido_Administrador` varchar(50) NOT NULL,
  `Contraseña` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administracion`
--

INSERT INTO `administracion` (`Documento_Administrador`, `Nombre_Administrador`, `Apellido_Administrador`, `Contraseña`, `Email`, `Fecha_Registro`) VALUES
('1', 'Luis', 'Contreras', '$2y$10$4QHVlhQj5CwrmLMq9IjS8.QyGPfhkUUm5/4I09q4i7vxGglqLMLiG', 'luis@gmail.com', '2024-11-28 13:23:24'),
('2', 'Raul', 'Gascar', '$2y$10$Vnur0HdBueH5CPelmi5Bg.tHtJSm3JHng2t/uqsnVXHpkLka2teom', 'Raul@gmail.com', '2024-11-28 13:26:44'),
('3', 'Albeiro', 'Duran', '$2y$10$7sLwxd.c4EiWoOyXR.ZJJ.nMEddadsEMxkhYsjzuEMGgTZpwDo/Vm', 'Albeiro@gmail.com', '2024-11-28 13:27:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

DROP TABLE IF EXISTS `contactos`;

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `respuesta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `documento`, `nombre`, `apellido`, `email`, `mensaje`, `fecha`, `respuesta`) VALUES
(7, '1001880159', 'Carlos', 'aguilar', 'carlos@gamail.com', '123 se daño la vaina', '2025-03-27 17:08:30', 'lola'),
(8, '1001880159', 'Carlos', 'aguilar', 'carlos@gamail.com', 'se daño otra vaina\r\n', '2025-03-27 17:14:39', 'gata'),
(9, '1001880159', 'Carlos', 'aguilar', 'carlos@gamail.com', 'se daño todo', '2025-03-27 17:15:40', 'gemelo'),
(10, '1001880159', 'Carlos', 'aguilar', 'carlos@gamail.com', '123', '2025-03-27 17:15:54', 'loca'),
(11, '1001880159', 'Carlos', 'aguilar', 'carlos@gamail.com', '159', '2025-03-27 17:18:36', 'patricia'),
(12, '1001880159', 'Carlos', 'aguilar', 'carlos@gamail.com', 'lo dañaste', '2025-03-27 17:23:50', 'Lo dañaste tu'),
(13, '1001880159', 'Carlos', 'aguilar', 'carlos@gamail.com', '123', '2025-03-27 17:32:46', '321'),
(14, '1001880159', 'Carlos', 'aguilar', 'carlos@gamail.com', 'lo dañe yo\r\n', '2025-03-28 13:44:05', 'Si ya sabiamos que lo dañaste tu mismo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

DROP TABLE IF EXISTS `eventos`;

CREATE TABLE `eventos` (
  `Codigo_Evento` varchar(50) NOT NULL,
  `Nombre_Evento` varchar(255) NOT NULL,
  `Descripcion_Evento` text NOT NULL,
  `Fecha_Evento` date NOT NULL,
  `Ubicacion_Evento` varchar(255) NOT NULL,
  `Puntos` varchar(255) DEFAULT NULL,
  `Hora_Evento` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`Codigo_Evento`, `Nombre_Evento`, `Descripcion_Evento`, `Fecha_Evento`, `Ubicacion_Evento`, `Puntos`, `Hora_Evento`) VALUES
('1', 'Limpieza', 'Se realizara una limpieza al parque', '2024-11-19', 'carrera 18', '200', '14:40:00'),
('2', 'Pintar', 'Limpiar el parque', '2024-11-22', 'carrera 18', '300', '21:00:00'),
('3', 'Sembrar arboles', 'Se realizara una siembra de arboles', '2024-11-27', 'Cra 20 No. 32', '300', '17:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_participacion`
--

DROP TABLE IF EXISTS `historial_participacion`;

CREATE TABLE `historial_participacion` (
  `Id` int(20) NOT NULL,
  `Documento` varchar(255) NOT NULL,
  `Nombre_Usuario` varchar(255) NOT NULL,
  `Nombre_Evento` varchar(255) NOT NULL,
  `puntos` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--
DROP TABLE IF EXISTS `informacion`;

CREATE TABLE `informacion` (
  `Id` int(20) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Mensaje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `informacion`
--

INSERT INTO `informacion` (`Id`, `Titulo`, `Mensaje`) VALUES
(1, '¡Un Futuro Verde Depende de Ti!', 'Cada pequeña acción cuenta. Juntos podemos proteger nuestro planeta, preservar sus recursos y asegurar un futuro saludable para las próximas generaciones. ¡El cambio comienza contigo!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participacion`
--

DROP TABLE IF EXISTS `participacion`;

CREATE TABLE `participacion` (
  `Id_Participacion` int(10) NOT NULL,
  `Documento` varchar(255) NOT NULL,
  `Nombre_usuario` varchar(30) DEFAULT NULL,
  `Fecha_registro` datetime DEFAULT current_timestamp(),
  `Codigo_Evento` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recompensas`
--
DROP TABLE IF EXISTS `recompensas`;

CREATE TABLE `recompensas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `puntos` varchar(100) DEFAULT NULL,
  `cantidad` varchar(100) DEFAULT NULL,
  `entregadas` int(11) DEFAULT 0,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recompensas`
--

INSERT INTO `recompensas` (`id`, `codigo`, `descripcion`, `puntos`, `cantidad`, `entregadas`, `foto`) VALUES
(14, '4040', '123', '100', '10', 10, '6748945f01985-imagen de diseño.webp'),
(15, '4040', '20', '20', '100', 50, '6748948ccfd0c-imagen de diseño.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recompensasprueba`
--

DROP TABLE IF EXISTS `recompensasprueba`;

CREATE TABLE `recompensasprueba` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `foto` longblob NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `Documento` varchar(255) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellidos` varchar(40) NOT NULL,
  `Edad` int(11) NOT NULL CHECK (`Edad` >= 0),
  `Nombre_usuario` varchar(30) DEFAULT NULL,
  `Contraseña` varchar(300) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Fecha_registro` datetime DEFAULT current_timestamp(),
  `token` varchar(32) DEFAULT NULL,
  `Puntos` int(20) DEFAULT 0,
  `Foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Documento`, `Nombre`, `Apellidos`, `Edad`, `Nombre_usuario`, `Contraseña`, `Email`, `Fecha_registro`, `token`, `Puntos`, `Foto_perfil`) VALUES
('1001880159', 'Carlos', 'aguilar', 22, 'Carlos', '$2y$10$FvolPMlgNFAHLEOd/7MpweBWC3NGzZKkQUXpq3yvs57YXZYS0VNzq', 'carlos@gamail.com', '2025-03-26 08:14:23', NULL, 0, NULL),
('1043142763', 'Soranys', 'Paez De las salas', 20, 'sora', '$2y$10$8wdlKrBR4kotwIvt.1PmKOyc3X/6Y9MyqOfTZi2CrLLMjpmxvBAZC', 'sora@gmail.com', '2024-11-22 22:13:52', NULL, 600, NULL),
('1043695621', 'Luis', 'Contreras', 20, 'ContrerasG4', '$2y$10$tCmbzpAMICPDZ0Ybh.829O2ngCDK8qaydqOkwmbfVLOTTHu6fITte', 'Luisrodolfocontreraspaez123@gmail.com', '2024-11-22 20:17:14', '674bb5c9d43b1', 3300, 'fotos_perfil/perfil_674d12e464fc85.54620555.png'),
('123', 'anyer', 'Contreras', 20, 'Luis201', '$2y$10$K2kurCJRrrJTkt0ROUoQiuyOCxJlwqxNAmTRAej2gz53eD3CQPzde', 'll@gmail.com', '2024-11-27 00:00:00', NULL, 0, NULL),
('235', 'Luis', 'Contreras', 20, 'ContrerasG4M', '$2y$10$kfa0caMY8rLmWj7/Lam8s.iZn3QCOoPL9AwBc7d0moaatbvhN6x8y', 'Luisrodo@gmail.com', '2024-12-01 20:58:09', NULL, 0, NULL),
('456', 'Isaias', 'Pinzon', 100, 'Isaias', '$2y$10$mDwiAFUBztPFQX.S5XNqiuovDmtryATB43Lzc5TbHBJuL37ouj3n.', 'Isaias@gmail.com', '2025-04-01 08:41:17', NULL, 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD PRIMARY KEY (`Documento_Administrador`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contactos_usuario` (`documento`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`Codigo_Evento`);

--
-- Indices de la tabla `historial_participacion`
--
ALTER TABLE `historial_participacion`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `informacion`
--
ALTER TABLE `informacion`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `participacion`
--
ALTER TABLE `participacion`
  ADD PRIMARY KEY (`Id_Participacion`),
  ADD UNIQUE KEY `Nombre_usuario` (`Nombre_usuario`),
  ADD KEY `FK_CodigoEvento` (`Codigo_Evento`),
  ADD KEY `fk_documento` (`Documento`);

--
-- Indices de la tabla `recompensas`
--
ALTER TABLE `recompensas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recompensasprueba`
--
ALTER TABLE `recompensasprueba`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Documento`),
  ADD UNIQUE KEY `Nombre_usuario` (`Nombre_usuario`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `historial_participacion`
--
ALTER TABLE `historial_participacion`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `informacion`
--
ALTER TABLE `informacion`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `participacion`
--
ALTER TABLE `participacion`
  MODIFY `Id_Participacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `recompensas`
--
ALTER TABLE `recompensas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `recompensasprueba`
--
ALTER TABLE `recompensasprueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `fk_contactos_usuario` FOREIGN KEY (`documento`) REFERENCES `usuario` (`Documento`);

--
-- Filtros para la tabla `participacion`
--
ALTER TABLE `participacion`
  ADD CONSTRAINT `FK_CodigoEvento` FOREIGN KEY (`Codigo_Evento`) REFERENCES `eventos` (`Codigo_Evento`),
  ADD CONSTRAINT `fk_documento` FOREIGN KEY (`Documento`) REFERENCES `usuario` (`Documento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
