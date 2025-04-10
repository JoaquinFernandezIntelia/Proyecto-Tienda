-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2025 a las 13:30:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda-prueba1`
--
CREATE DATABASE IF NOT EXISTS `tienda-prueba1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tienda-prueba1`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `codigo_usuario` int(11) NOT NULL,
  `codigo_producto` varchar(12) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_agregado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo` varchar(12) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio` double NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `descripcion` text NOT NULL,
  `vendedor` varchar(100) NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `rebajado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo`, `nombre_producto`, `precio`, `imagen`, `descripcion`, `vendedor`, `fecha_subida`, `rebajado`) VALUES
('0119293049-E', 'prueba2', 90.45, 'asasasas', 'sasasasa', '192923492934221234-B', '2025-04-08 11:15:54', 0),
('0919293049-E', 'palslalsalsa', 299.99, 'imagen2', 'sasaasasa', '192923492934221234-B', '2025-04-08 11:11:11', 0),
('1928212912-W', 'prueba', 299.99, 'imagen5', 'sasasas', '192923492934221234-B', '2025-04-08 11:14:28', 0),
('1928293912-W', 'qwqwqwqwwqwq', 12.99, 'imagen3', 'sasasasa', '192923492934221234-B', '2025-04-08 11:11:57', 0),
('9211220293-S', 'prueba3', 90.45, 'asasasa', 'sasasasas', '192923492934221234-B', '2025-04-08 11:19:12', 0),
('9291020293-S', 'Portatil', 199.99, 'imagen1', 'Mu bonito', '192923492934221234-B', '2025-04-08 10:38:59', 1),
('9291220293-S', 'sasasasa', 90.45, 'imagen4', 'asasas', '192923492934221234-B', '2025-04-08 11:12:34', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codigo_usuario`, `nombre_usuario`, `password`) VALUES
(1, 'Pepito', '1234'),
(2, 'Admin', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `codigo_vendedor` varchar(20) NOT NULL,
  `nombre_vendedor` varchar(100) NOT NULL,
  `NIF` varchar(9) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`codigo_vendedor`, `nombre_vendedor`, `NIF`, `password`) VALUES
('192923492934221234-B', 'Joaquin', 'X8282727S', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrito_usuario` (`codigo_usuario`),
  ADD KEY `fk_carrito_producto` (`codigo_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_vendedor` (`vendedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codigo_usuario`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`codigo_vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_carrito_producto` FOREIGN KEY (`codigo_producto`) REFERENCES `productos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_carrito_usuario` FOREIGN KEY (`codigo_usuario`) REFERENCES `usuarios` (`codigo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
