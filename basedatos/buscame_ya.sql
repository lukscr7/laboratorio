-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2016 a las 22:06:34
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
-- Estructura de tabla para la tabla `combi`
--

CREATE TABLE `combi` (
  `id_combi` bigint(20) NOT NULL,
  `patente` varchar(10) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `cant_asientos` enum('20','40','60') NOT NULL,
  `estado` enum('LIBRE','OCUPADO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `combi`
--

INSERT INTO `combi` (`id_combi`, `patente`, `marca`, `modelo`, `color`, `cant_asientos`, `estado`) VALUES
(1, 'ICJ 628', 'Ferrari', 'V1.7', 'Rojo', '40', 'LIBRE'),
(2, 'KJK 123', 'Ford', 'Focus', 'Verde', '20', 'LIBRE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductores`
--

CREATE TABLE `conductores` (
  `id_c` bigint(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `foto_perfil` varchar(300) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `estado` enum('LIBRE','OCUPADO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `conductores`
--

INSERT INTO `conductores` (`id_c`, `nombre`, `apellido`, `foto_perfil`, `telefono`, `correo`, `estado`) VALUES
(1, 'Fulanito', 'Fulano', '../recursos/imagen/ImagenPorDefecto.png', '3834578983', 'dario_flores321@hotmail.com', 'LIBRE'),
(2, 'Mauricio', 'Flores', '../recursos/imagen/ImagenPorDefecto.png', '3834589866', 'asd@gmail.com', 'LIBRE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `user_id` varchar(20) NOT NULL,
  `id_c` bigint(20) NOT NULL,
  `id_viaje` bigint(20) NOT NULL,
  `id_combi` bigint(20) NOT NULL,
  `costo` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_reserva` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `nom_us` varchar(30) NOT NULL,
  `ape_us` varchar(30) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `permisos` enum('ADMIN','CLIENTE') NOT NULL,
  `foto_perfil` varchar(500) NOT NULL DEFAULT '../recursos/imagen/ImagenPorDefecto.png',
  `bandera` enum('ACTIVO','INACTIVO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `pass`, `nom_us`, `ape_us`, `correo`, `permisos`, `foto_perfil`, `bandera`) VALUES
('dario', '123456', 'Dario', 'Flores', 'dario_flores321@hotmail.com', 'ADMIN', '../recursos/imagen/perfil/cliente/dario.jpg', 'ACTIVO'),
('dasa', 'dsa', 'asddsa', 'adsads', 'darioexequiel22@gmail.com', 'CLIENTE', '../recursos/imagen/ImagenPorDefecto.png', 'ACTIVO'),
('dsada', '123', 'dsa', 'das', 'darioexequiel22@gmail.com', 'CLIENTE', '../recursos/imagen/ImagenPorDefecto.png', 'ACTIVO'),
('felipe2', '123', 'agustin', 'feliciano', 'ju@gmail.com', 'CLIENTE', '../recursos/imagen/ImagenPorDefecto.png', 'ACTIVO'),
('lucas', '123456', 'Lucas', 'Diaz', 'cr7@gmail.com', 'CLIENTE', '../recursos/imagen/perfil/cliente/lucas.jpg', 'ACTIVO'),
('www', 'www', 'wwww', 'wwwww', 'www@gmail.com', 'CLIENTE', '../recursos/imagen/ImagenPorDefecto.png', 'ACTIVO'),
('wwww', 'www', 'www', 'wwwww', 'www@gmail.com', 'CLIENTE', '../recursos/imagen/ImagenPorDefecto.png', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id_viaje` bigint(20) NOT NULL,
  `origen` varchar(100) NOT NULL,
  `destino` varchar(100) NOT NULL,
  `monto_basico` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`id_viaje`, `origen`, `destino`, `monto_basico`) VALUES
(1, 'Capital', 'Belen', '400'),
(2, 'Tinogasta', 'Andalgala', '200');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `combi`
--
ALTER TABLE `combi`
  ADD PRIMARY KEY (`id_combi`),
  ADD UNIQUE KEY `patente_auto` (`patente`);

--
-- Indices de la tabla `conductores`
--
ALTER TABLE `conductores`
  ADD PRIMARY KEY (`id_c`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD UNIQUE KEY `id_viaje` (`id_reserva`),
  ADD KEY `user_id_c` (`id_c`),
  ADD KEY `user_id_p` (`user_id`),
  ADD KEY `id_viaje_2` (`id_viaje`),
  ADD KEY `id_combi` (`id_combi`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id_viaje`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `combi`
--
ALTER TABLE `combi`
  MODIFY `id_combi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `conductores`
--
ALTER TABLE `conductores`
  MODIFY `id_c` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id_viaje` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_c`) REFERENCES `conductores` (`id_c`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`id_viaje`) REFERENCES `viajes` (`id_viaje`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_4` FOREIGN KEY (`id_combi`) REFERENCES `combi` (`id_combi`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
