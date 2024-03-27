-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2024 a las 02:03:44
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
-- Base de datos: `shanoa_store`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategorias` int(11) NOT NULL,
  `nombreCat` varchar(45) DEFAULT NULL,
  `descripcionCat` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategorias`, `nombreCat`, `descripcionCat`) VALUES
(6, 'PRUEBACRUD', 'asdfghjkl'),
(7, 'Tecnologia', 'aparatos tecnologicos'),
(8, 'Promociones', 'Combos y mas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenesproductos`
--

CREATE TABLE `imagenesproductos` (
  `idimagenes` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `rutaImagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idUsuarios` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Direccion` varchar(45) DEFAULT NULL,
  `Telefono` varchar(45) DEFAULT NULL,
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(45) NOT NULL,
  `Rol_idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idUsuarios`, `Nombre`, `Apellido`, `Direccion`, `Telefono`, `Correo`, `Contraseña`, `Rol_idRol`) VALUES
(1, 'Vago', 'Pp', 'Calle 45 Sur', '3132222222', 'admin@gmail.com', '1234', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProductos` int(11) NOT NULL,
  `nombreP` varchar(45) NOT NULL,
  `detallesP` varchar(45) NOT NULL,
  `cantidadP` int(11) NOT NULL,
  `precioP` int(64) NOT NULL,
  `Persona_idUsuarios` int(11) NOT NULL,
  `Persona_Rol_idRol` int(11) NOT NULL,
  `Subcategorias_idSubcategorias` int(11) NOT NULL,
  `Subcategorias_Categorias_idCategorias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProductos`, `nombreP`, `detallesP`, `cantidadP`, `precioP`, `Persona_idUsuarios`, `Persona_Rol_idRol`, `Subcategorias_idSubcategorias`, `Subcategorias_Categorias_idCategorias`) VALUES
(12, 'accesorios', 'aaaaa', 200, 200000, 1, 1, 9, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `idSubcategorias` int(11) NOT NULL,
  `nombreSub` varchar(45) DEFAULT NULL,
  `descripcionSub` varchar(45) DEFAULT NULL,
  `Categorias_idCategorias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`idSubcategorias`, `nombreSub`, `descripcionSub`, `Categorias_idCategorias`) VALUES
(9, 'Cases', 'Fundas y mas', 6),
(10, 'Combos', 'Combos de diferentes tipos', 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategorias`);

--
-- Indices de la tabla `imagenesproductos`
--
ALTER TABLE `imagenesproductos`
  ADD PRIMARY KEY (`idimagenes`),
  ADD KEY `idIMAGENEs_idPRODUCTOS` (`id_producto`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD KEY `FK_IDROL_IDPERSONA` (`Rol_idRol`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProductos`),
  ADD KEY `FK_IDPESONA_IDPRODUCTOS` (`Persona_idUsuarios`),
  ADD KEY `FK_IDPESONA_IDROL_PRODUCTOS` (`Persona_Rol_idRol`),
  ADD KEY `FK_IDSUBCAT_IDPRODUCTOS` (`Subcategorias_idSubcategorias`),
  ADD KEY `FK_IDSUBCAT_IDCATE_IDPRODUCTOS` (`Subcategorias_Categorias_idCategorias`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`idSubcategorias`),
  ADD KEY `FK_IDCATEGORIAS_IDSUBCATEGORIAS` (`Categorias_idCategorias`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `imagenesproductos`
--
ALTER TABLE `imagenesproductos`
  MODIFY `idimagenes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `idSubcategorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenesproductos`
--
ALTER TABLE `imagenesproductos`
  ADD CONSTRAINT `idIMAGENEs_idPRODUCTOS` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`idProductos`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `FK_IDROL_IDPERSONA` FOREIGN KEY (`Rol_idRol`) REFERENCES `rol` (`idRol`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_IDPESONA_IDPRODUCTOS` FOREIGN KEY (`Persona_idUsuarios`) REFERENCES `persona` (`idUsuarios`),
  ADD CONSTRAINT `FK_IDPESONA_IDROL_PRODUCTOS` FOREIGN KEY (`Persona_Rol_idRol`) REFERENCES `rol` (`idRol`),
  ADD CONSTRAINT `FK_IDSUBCAT_IDCATE_IDPRODUCTOS` FOREIGN KEY (`Subcategorias_Categorias_idCategorias`) REFERENCES `categorias` (`idCategorias`),
  ADD CONSTRAINT `FK_IDSUBCAT_IDPRODUCTOS` FOREIGN KEY (`Subcategorias_idSubcategorias`) REFERENCES `subcategorias` (`idSubcategorias`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `FK_IDCATEGORIAS_IDSUBCATEGORIAS` FOREIGN KEY (`Categorias_idCategorias`) REFERENCES `categorias` (`idCategorias`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
