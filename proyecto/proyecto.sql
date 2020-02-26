-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2020 a las 10:59:11
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `idRestaurante` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `cocina` varchar(255) NOT NULL,
  `precio` int(255) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`idRestaurante`, `nombre`, `ubicacion`, `cocina`, `precio`, `puntuacion`, `imagen`) VALUES
(1, 'Aintzane', 'Pamplona - Mendebaldea', 'Hambirguesas, Bocatas', 10, 4, 'res1.png'),
(2, 'Common Good', 'Baranain', 'De todo ', 7, 4, 'res2.jpg'),
(3, 'Burguer King', 'Pamplona', 'Hamburgueseria', 5, 3, 'res3.jpg'),
(4, 'Garcia', 'Pamplona', 'Bocatas', 5, 5, 'res4.jpg'),
(5, 'k12', 'Pamplona', 'Kebab', 5, 4, 'res5.jpg'),
(6, 'Eat and Bucket', 'Arrosadia', 'Hamburgueseria', 8, 3, 'res6.jpg'),
(7, 'Trova', 'Baranain', 'Patatas Lokas', 6, 5, 'res7.jpg'),
(10, 'McDonalds', 'Pamplona', 'Hamburgueseria', 5, 3, 'res8.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`idRestaurante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `idRestaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
