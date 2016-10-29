-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2016 a las 21:30:47
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `buscame_ya`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auto`
--

CREATE TABLE `auto` (
  `id_auto` bigint(20) NOT NULL,
  `id_e` bigint(20) NOT NULL,
  `patente_auto` varchar(10) NOT NULL,
  `num_remis_auto` int(11) NOT NULL,
  `marca_auto` varchar(20) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `tamaño` varchar(20) NOT NULL,
  `id_c` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductor`
--

CREATE TABLE `conductor` (
  `id_c` bigint(20) NOT NULL,
  `user_id_c` varchar(20) NOT NULL,
  `descripcion_c` varchar(200) NOT NULL,
  `id_e` bigint(20) NOT NULL,
  `estado` enum('LIBRE','OCUPADO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_e` bigint(20) NOT NULL,
  `user_e` varchar(20) NOT NULL,
  `nom_e` varchar(50) NOT NULL,
  `telefono_e` varchar(20) NOT NULL,
  `calle_e` varchar(50) NOT NULL,
  `num_calle_e` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `id_forma_pago` bigint(20) NOT NULL,
  `nom_forma_pago` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares_favoritos`
--

CREATE TABLE `lugares_favoritos` (
  `user_p` varchar(20) NOT NULL,
  `nom_lugar` varchar(50) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `id_lugar` bigint(20) UNSIGNED NOT NULL,
  `longitud` bigint(20) NOT NULL,
  `latitud` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubi_empresa`
--

CREATE TABLE `ubi_empresa` (
  `id_ubi` bigint(20) UNSIGNED NOT NULL,
  `latitud` bigint(20) NOT NULL,
  `longitud` bigint(20) NOT NULL,
  `id_e` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `user_id` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `nom_us` varchar(30) NOT NULL,
  `ape_us` varchar(30) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `permisos` enum('ADMIN','PASAJERO','EMPRESA','CONDUCTOR') NOT NULL,
  `foto_perfil` longblob NOT NULL,
  `bandera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `user_id_p` varchar(20) NOT NULL,
  `id_c` bigint(20) NOT NULL,
  `origen` varchar(50) NOT NULL,
  `destino` varchar(50) NOT NULL,
  `tiempo_origen` int(11) NOT NULL,
  `tiempo_destino` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `id_forma_pago` bigint(20) NOT NULL,
  `id_viaje` bigint(20) UNSIGNED NOT NULL,
  `num_auto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id_auto`),
  ADD UNIQUE KEY `patente_auto` (`patente_auto`),
  ADD UNIQUE KEY `id_e_2` (`id_e`,`num_remis_auto`),
  ADD KEY `id_e` (`id_e`),
  ADD KEY `id_c` (`id_c`);

--
-- Indices de la tabla `conductor`
--
ALTER TABLE `conductor`
  ADD PRIMARY KEY (`id_c`),
  ADD KEY `user_id_c` (`user_id_c`),
  ADD KEY `id_e` (`id_e`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_e`),
  ADD KEY `user_e` (`user_e`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`id_forma_pago`);

--
-- Indices de la tabla `lugares_favoritos`
--
ALTER TABLE `lugares_favoritos`
  ADD PRIMARY KEY (`id_lugar`),
  ADD UNIQUE KEY `id_lugar` (`id_lugar`),
  ADD KEY `user_p` (`user_p`);

--
-- Indices de la tabla `ubi_empresa`
--
ALTER TABLE `ubi_empresa`
  ADD PRIMARY KEY (`id_ubi`),
  ADD UNIQUE KEY `id_ubi` (`id_ubi`),
  ADD KEY `id_e` (`id_e`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id_viaje`),
  ADD UNIQUE KEY `id_viaje` (`id_viaje`),
  ADD KEY `user_id_c` (`id_c`),
  ADD KEY `user_id_p` (`user_id_p`),
  ADD KEY `id_forma_pago` (`id_forma_pago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auto`
--
ALTER TABLE `auto`
  MODIFY `id_auto` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `conductor`
--
ALTER TABLE `conductor`
  MODIFY `id_c` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_e` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id_forma_pago` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `lugares_favoritos`
--
ALTER TABLE `lugares_favoritos`
  MODIFY `id_lugar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ubi_empresa`
--
ALTER TABLE `ubi_empresa`
  MODIFY `id_ubi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id_viaje` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `auto_ibfk_1` FOREIGN KEY (`id_e`) REFERENCES `empresa` (`id_e`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auto_ibfk_2` FOREIGN KEY (`id_c`) REFERENCES `conductor` (`id_c`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `conductor`
--
ALTER TABLE `conductor`
  ADD CONSTRAINT `conductor_ibfk_1` FOREIGN KEY (`id_e`) REFERENCES `empresa` (`id_e`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conductor_ibfk_2` FOREIGN KEY (`user_id_c`) REFERENCES `usuario` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`user_e`) REFERENCES `usuario` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lugares_favoritos`
--
ALTER TABLE `lugares_favoritos`
  ADD CONSTRAINT `lugares_favoritos_ibfk_1` FOREIGN KEY (`user_p`) REFERENCES `usuario` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ubi_empresa`
--
ALTER TABLE `ubi_empresa`
  ADD CONSTRAINT `ubi_empresa_ibfk_1` FOREIGN KEY (`id_e`) REFERENCES `empresa` (`id_e`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD CONSTRAINT `viajes_ibfk_1` FOREIGN KEY (`user_id_p`) REFERENCES `usuario` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viajes_ibfk_3` FOREIGN KEY (`id_forma_pago`) REFERENCES `forma_pago` (`id_forma_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viajes_ibfk_4` FOREIGN KEY (`id_c`) REFERENCES `conductor` (`id_c`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
