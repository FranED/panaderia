-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-06-2020 a las 11:23:44
-- Versión del servidor: 10.1.44-MariaDB-0+deb9u1
-- Versión de PHP: 7.1.33-16+0~20200514.38+debian9~1.gbp1e5820

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sandbox3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(30) NOT NULL,
  `idPedido` int(30) DEFAULT NULL,
  `Nombre` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telefono` int(9) DEFAULT NULL,
  `Direccion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `idPedido`, `Nombre`, `Telefono`, `Direccion`) VALUES
(0, 26261477, 'Pepito Grillo', 950121210, 'C/ Cualquiera'),
(566, 118464755, 'Pinocho', 667230531, 'C / Barrio San Luis, nº 10'),
(22747028, 1314095483, 'Daisy', 951718361, 'C/ Almendra'),
(132355757, 178586507, 'Paulino', 917111222, 'C/ Almeria'),
(759303660, NULL, 'Robin Hood', 623123123, 'C/ disney');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

CREATE TABLE `contiene` (
  `idProducto` int(12) NOT NULL,
  `idPedido` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_transporte`
--

CREATE TABLE `empresa_transporte` (
  `idEmpTransporte` int(30) NOT NULL,
  `Nombre` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Teléfono` int(9) DEFAULT NULL,
  `Comision` float(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresa_transporte`
--

INSERT INTO `empresa_transporte` (`idEmpTransporte`, `Nombre`, `Teléfono`, `Comision`) VALUES
(936, 'Uber', 950212121, 1.95),
(56245909, 'Just Eat', 912123123, 0.85),
(1148317257, 'Arturo Food', 622222222, 3.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestiona_transporta`
--

CREATE TABLE `gestiona_transporta` (
  `idPedido` int(30) NOT NULL,
  `idTrabajador` int(30) DEFAULT NULL,
  `idEmpTransporte` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `gestiona_transporta`
--

INSERT INTO `gestiona_transporta` (`idPedido`, `idTrabajador`, `idEmpTransporte`) VALUES
(178586507, NULL, NULL),
(838058598, 0, 1148317257),
(1420344517, 0, 56245909);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(30) NOT NULL,
  `Direccion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `Direccion`) VALUES
(0, 'C / Barrio San Luis'),
(848, 'C/ Falsa'),
(852, ''),
(883, 'C/ Falsa'),
(899, 'C/ Almendra'),
(900, ''),
(901, 'C/ Falsa'),
(903, 'C/ Falsa'),
(904, 'C / Barrio San Luis'),
(907, 'C/ Falsa'),
(909, 'C / Barrio San Luis'),
(912, 'C/ Pistacho 2'),
(914, 'C/ Almendra'),
(915, 'C/ Pistacho'),
(918, 'C / Barrio San Luis'),
(920, 'C/ Pistacho 2'),
(921, 'C / Barrio San Luis'),
(924, 'C/ Pistacho 2'),
(925, 'C/ Falsa'),
(926, ''),
(927, 'C/ Almendra'),
(933, ''),
(935, 'C/ Almendra'),
(938, 'C/ Almendra'),
(943, 'C / Barrio San Luis'),
(944, 'C/ Almendra'),
(946, 'C/ Falsa'),
(948, 'C/ Almendra'),
(950, 'C/ Pistacho 2'),
(951, ''),
(954, 'C/ Pistacho 2'),
(956, ''),
(957, 'C / Barrio San Luis'),
(966, 'C/ Almendra'),
(967, 'C / Barrio San Luis'),
(969, 'C / Barrio San Luis'),
(970, 'C / Barrio San Luis'),
(972, 'C/ Pistacho 2'),
(973, 'C/ Almendra'),
(974, 'C/ Almendra'),
(976, 'C/ Almendra'),
(978, 'C/ Almendra'),
(980, 'C/ Almendra'),
(983, 'C/ Pistacho 2'),
(987, 'C/ Pistacho 2'),
(988, 'C/ Falsa'),
(989, 'C/ Falsa'),
(990, 'C/ Almendra'),
(998, 'C / Barrio San Luis'),
(14887029, 'C / Barrio San Luis'),
(26261477, 'C/ Cualquiera'),
(49307638, 'C / Barrio San Luis, nº 15'),
(56091937, 'C / Barrio San Luis, nº 10'),
(57828327, 'C / Barrio San Luis, nº 10'),
(84463864, 'C/ Cualquiera'),
(118464755, 'C / Barrio San Luis, nº 10'),
(119269136, 'C / Barrio San Luis, nº 10'),
(133885655, 'C / Barrio San Luis, nº 10'),
(144325962, 'a'),
(178586507, 'C/ Almeria'),
(361591245, 'C/ Cualquiera'),
(475349398, 'C / Barrio San Luis, nº 10'),
(477119413, 'C / Barrio San Luis, nº 10'),
(569681669, 'C / Barrio San Luis'),
(613802345, 'C / Barrio San Luis, nº 10'),
(793027229, 'C/ Cualquiera'),
(838058598, 'C/ Almeria'),
(866235746, 'C/ disney n14'),
(877375600, 'C/ Cualquiera'),
(917671924, 'C/ Cualquiera nº 32'),
(1033078084, 'C / Barrio San Luis, nº 10'),
(1098137913, 'C / Barrio San Luis, nº 10'),
(1314095483, 'C/ Almendra'),
(1420344517, 'C/ Granada'),
(1458714797, 'C / Barrio San Luis, nº 10'),
(1527703894, 'C / Barrio San Luis'),
(1697584058, 'C/ Cualquiera'),
(1963671556, 'C/ Cualquiera'),
(1991734677, 'C / Barrio San Luis, nº 10'),
(1996146914, 'a'),
(2022798357, 'C / Barrio San Luis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(12) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cantidad` int(3) DEFAULT NULL,
  `Precio` float(4,2) DEFAULT NULL,
  `Precio_Venta` float(4,2) DEFAULT NULL,
  `Visible` enum('Si','No') COLLATE utf8_unicode_ci NOT NULL,
  `idProveedor` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `Nombre`, `Cantidad`, `Precio`, `Precio_Venta`, `Visible`, `idProveedor`) VALUES
(1, 'Barra Pan', 98, 0.25, 0.60, 'Si', NULL),
(2, 'Palmera', 95, 0.60, 1.10, 'Si', NULL),
(3, 'Caracola', 100, 0.80, 1.50, 'Si', NULL),
(4, 'Croissants', 92, 0.40, 1.10, 'Si', NULL),
(5, 'Pan Integral', 99, 0.55, 0.90, 'Si', NULL),
(6, 'Pan Arturo', 25, 0.50, 2.00, 'Si', 74344387),
(9, 'Jesus', 26, 1.00, 2.00, 'No', 74344387);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idProveedor` int(30) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telefono` int(9) DEFAULT NULL,
  `Direccion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `Nombre`, `Telefono`, `Direccion`) VALUES
(235, 'DulceSol', 950000000, 'C/ Poligono Industrial la Juaida'),
(258, 'Matutano', 950112233, 'ejemplo n12'),
(74344387, 'Arturo SA', 611111111, 'C/ IES AGUADULCE'),
(87192997, 'Grefusa', 900900900, 'C/ Plata'),
(431291549, 'Tosfrit', 900900902, 'C/ Sevilla S/N'),
(1394062297, 'Bimbo', 950121212, 'C/ Sevilla S/N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `idTrabajador` int(30) NOT NULL,
  `idJefe` int(30) DEFAULT NULL,
  `Nombre` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Contraseña` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Tipo` enum('Jefe','Trabajador') COLLATE utf8_unicode_ci DEFAULT NULL,
  `Alias` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`idTrabajador`, `idJefe`, `Nombre`, `Contraseña`, `Tipo`, `Alias`) VALUES
(0, NULL, 'Administrador', 'admin', 'Jefe', 'admin'),
(19755729, NULL, 'Paulino', '123', 'Trabajador', 'Artu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vende`
--

CREATE TABLE `vende` (
  `codTicket` int(5) NOT NULL,
  `idTrabajador` int(30) DEFAULT NULL,
  `idProducto` int(30) DEFAULT NULL,
  `total_Compra` float(4,2) DEFAULT NULL,
  `cantidad` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `idPedido` (`idPedido`);

--
-- Indices de la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `idPedido` (`idPedido`);

--
-- Indices de la tabla `empresa_transporte`
--
ALTER TABLE `empresa_transporte`
  ADD PRIMARY KEY (`idEmpTransporte`);

--
-- Indices de la tabla `gestiona_transporta`
--
ALTER TABLE `gestiona_transporta`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idTrabajador` (`idTrabajador`),
  ADD KEY `idEmpTransporte` (`idEmpTransporte`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`idTrabajador`);

--
-- Indices de la tabla `vende`
--
ALTER TABLE `vende`
  ADD PRIMARY KEY (`codTicket`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD CONSTRAINT `contiene_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contiene_ibfk_2` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gestiona_transporta`
--
ALTER TABLE `gestiona_transporta`
  ADD CONSTRAINT `gestiona_transporta_ibfk_1` FOREIGN KEY (`idTrabajador`) REFERENCES `trabajador` (`idTrabajador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gestiona_transporta_ibfk_2` FOREIGN KEY (`idEmpTransporte`) REFERENCES `empresa_transporte` (`idEmpTransporte`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gestiona_transporta_ibfk_3` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
