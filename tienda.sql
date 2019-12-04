-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-11-2019 a las 18:54:20
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

DROP TABLE IF EXISTS `articulos`;
CREATE TABLE IF NOT EXISTS `articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `precio` double UNSIGNED NOT NULL,
  `foto` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `disponible` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `nombre`, `descripcion`, `precio`, `foto`, `disponible`, `created`) VALUES
(1, 'iPhone', '11', 809, 'inegro11.jpg', 'S', '2019-03-10 19:07:16'),
(2, 'iPhone', '11', 809, 'iblanco11.jpg', 'S', '2019-03-10 19:07:16'),
(3, 'iPhone', 'X', 1029, 'inegrox.jpg', 'N', '2019-03-10 19:07:16'),
(4, 'iPhone', 'X', 1029, 'iblancox.jpg', 'S', '2019-03-10 19:07:16'),
(5, 'Samsung Galaxy', 'A70', 339, 'samnegroa70.jpg', 'S', '2019-03-10 19:07:17'),
(6, 'Samsung Galaxy', 'A70', 339, 'samazula70.jpg', 'S', '2019-03-10 19:07:17'),
(7, 'Samsung Galaxy', 'A10', 169, 'samazula10.jpg', 'S', '2019-03-10 19:07:17'),
(8, 'Samsung Galaxy', 'A10', 169, 'samplataa10.jpg', 'S', '2019-03-10 19:07:17'),
(9, 'Xiaomi', 'Mi A3', 249, 'xiablancoa3.jpg', 'S', '2019-03-10 19:07:17'),
(10, 'Xiaomi', 'Mi A3', 249, 'xiaazula3.jpg', 'S', '2019-03-10 19:07:17'),
(11, 'Xiaomi', 'Mi A3', 249, 'xianegroa3.jpg', 'S', '2019-11-04 22:32:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `hashpass` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`, `hashpass`, `created`) VALUES
(1, 'JUAN ORTIZ', 'juan@dominio.es', '$2y$10$c7gKrdI3JDeB/ZDy.7Hc.eZV1NLsFeSv0xyfnLt8pRdAChdI74kIO', '2019-03-10 19:07:16'),
(2, 'ANA MERINO', 'ana@hotmail.com', '$2y$10$uS6ZcjmuoT0fp/lxypAhA.MeQtHBzJTQeSCYpOGsAe4/egayUEYEm', '2019-03-10 19:07:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `id_cliente` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `fecha_venta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cliente`,`id_articulo`),
  KEY `compras_ida_FK` (`id_articulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_cliente`, `id_articulo`, `fecha_venta`) VALUES
(1, 3, '2019-11-08 10:45:43'),
(2, 4, '2019-03-10 19:07:17'),
(2, 8, '2019-03-10 19:07:17');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ida_FK` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`),
  ADD CONSTRAINT `compras_idc_FK` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
