-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-08-2016 a las 01:19:53
-- Versión del servidor: 5.5.49-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cleantech`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directorio`
--

CREATE TABLE IF NOT EXISTS `directorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(50) NOT NULL,
  `descripcion` varchar(130) NOT NULL,
  `telefono` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `directorio`
--

INSERT INTO `directorio` (`id`, `empresa`, `descripcion`, `telefono`, `estado`) VALUES
(7, 'Banamex', 'Grupo Financiero Banamex, patrocinador de CTCM, es el grupo financiero líder en México. Siguiendo una estrategia de banca universa', 93482, 'Querétaro'),
(8, 'GreenMomentum', 'GreenMomentum es una firma de inteligencia de mercado especializada en emprendimiento e innovación en cleantech para Latinoamérica', 2345432, 'Guanajuato'),
(9, 'Aeroméxico', 'Aeroméxico, patrocinador de CTCM, es la aerolínea bandera de México y empresa líder en la industria de transporte aéreo. ', 234532, 'Estado de México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `document`
--

INSERT INTO `document` (`id`, `name`, `path`) VALUES
(1, '1', NULL),
(2, 'ejemplo', 'margaritas.jpg'),
(3, 'pepsi', '2.png'),
(4, 'bootstrap', '3.png'),
(5, 'naturaleza', '507727-black-and-white-depressing-fog-gothic-landscapes-mountains-trees.jpg'),
(6, 'pack 1', 'B8z.jpg'),
(7, 'pack 2', 'Ged.jpg'),
(8, 'pack 3', '2016-02-08 (1).png'),
(9, 'pack 4', 'Robin Schulz.jpg'),
(10, 'pack 4', 'IMG_0384.JPG'),
(11, 'pack 5', 'TVG (459).jpg'),
(12, 'lol', '1463279298664.jpg'),
(13, 'finn', 'finn.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `drop_user`
--

CREATE TABLE IF NOT EXISTS `drop_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `drop_user`
--

INSERT INTO `drop_user` (`id`, `email`, `created_at`) VALUES
(1, 'kj@jj.com', '2016-07-28 18:53:53'),
(2, 'jakes@hotmail.com.mx', '2016-08-23 17:37:38'),
(3, 'jake@hotmail.com.mx', '2016-08-23 17:40:12'),
(4, 'marce@gmail.com', '2016-08-23 17:42:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` bigint(100) NOT NULL,
  `rama_tecnologica` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `industria` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `servicio` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `razon_social` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `calle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `colonia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rfc` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cp` int(11) DEFAULT NULL,
  `municipio` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `web` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B8D75A50A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `estado`, `telefono`, `rama_tecnologica`, `industria`, `servicio`, `user_id`, `created_at`, `updated_at`, `descripcion`, `path`, `razon_social`, `calle`, `colonia`, `rfc`, `cp`, `municipio`, `facebook`, `linkedin`, `twitter`, `web`) VALUES
(2, 'Banamex', 'Aguascalientes', 45893891, 'Agua', 'Consumo masivo', 'Industrial', 21, '2016-06-29 14:44:08', '2016-08-25 00:47:54', 'Grupo Financiero Banamex, patrocinador de CTCM, es el grupo financiero líder en México. Siguiendo una estrategia de banca universal, el Grupo ofrece una variedad de servicios financieros a personas morales y físicas, que incluyen banca comercial y de inversión, seguros y manejo de inversiones.', 'descarga.jpg', '4958iridj905k4rdj9', 'Los positos', 'La cañada', 'SDL90I9KSOJDJ3OM', 76240, 'Queretaro', 'https://twitter.com/OrtografiaReal', 'https://twitter.com/NianticLabs', 'https://twitter.com/PokemonGoNews', 'https://twitter.com/Pokemon'),
(8, 'Caballero Solutions Power', 'Querétaro', 4425864189, 'Eficiencia Energética', 'Energía', 'Industrial', 2, '2016-08-23 21:43:10', '2016-08-25 00:50:31', 'Servicios de Ingeniería y Mantenimiento para solucionar cualquier requerimiento en el funcionamiento óptimo de los sistemas eléctricos de potencia en baja, media y alta tensión.', 'f3c19496d767098653981ac97ee980af676590a9.jpeg', 'S.A. de C.V.', 'Calle de la Tristeza No. 95B', 'Zona Industrial Querétaro', 'CSP111010GJ1', 76120, 'Querétaro', 'https://www.facebook.com/caballeroSP/', '', 'https://twitter.com/CSOLUTIONSPOWER', 'http://www.caballerosolutionspower.com/'),
(9, 'Energía Eólica', '', 0, '', '', '', 23, '2016-08-25 01:06:57', '2016-08-25 01:10:39', '', NULL, '', '', '', 'ENEO111212HK1', 0, '', '', '', '', ''),
(10, 'Adeksys S.A. de C.V.', 'Querétaro', 0, 'Tecnologías de la Información', 'Energía', 'Industrial', 26, '2016-08-25 21:34:22', '2016-08-25 21:47:35', 'Ejemplo Descripción', 'acda4ecdbba06bb68e7fbe73ece688948e036f08.png', 'S.A: de C.V.', 'Av. de la Luz 220', 'Satélite', 'ADE', 76110, 'Queretaro', '', '', '', 'www.adeksys.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_eliminada`
--

CREATE TABLE IF NOT EXISTS `empresa_eliminada` (
  `id_eliminado` bigint(100) NOT NULL AUTO_INCREMENT,
  `rfc_empresa` varchar(100) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id_eliminado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9B631D01A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id`, `user_id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 16, 'TEST 26AGO', 'Esta es una prueba de mensajes', '2016-08-25 21:37:39', '2016-08-25 21:37:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('ROLE_ADMIN','ROLE_USER','ROLE_SUPER_ADMIN') COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `is_active`, `created_at`, `updated_at`, `path`, `username`) VALUES
(1, 'Victor Hugo', 'Arredondo González', 'vcrr03@gmail.com', '$2y$12$zICFuujezIy4eIfhQ37wye3WNTlcIlNxRVSUXh2Hh2rqHrvVMa8ge', 'ROLE_ADMIN', 1, '2016-06-22 09:10:00', '2016-08-24 23:47:07', '42f853541097460e247c2900b2db86e6069bb14f.jpeg', 'NULL'),
(2, 'Susana', 'Campos Cano', 'susana@gmail.com', '$2y$12$AirDBXS2XtlP91tbio3fF.mhfpkhqbOqKyN09dAcysNcNLwSbGEji', 'ROLE_USER', 1, '2016-06-22 09:11:00', '2016-08-25 00:00:14', 'f16c2200d85c3b86e207fac0e8590e39b6d4ee0a.jpeg', 'NULL'),
(4, 'Ing. Federico', 'Bravo', 'f_798@hotmail.com', '$2y$12$iviSCNkgi4Qzhk3KwD86iu0oVUcDFVvDiNpbSoXpsepP2tQo.eM6W', 'ROLE_ADMIN', 1, '2016-06-22 18:44:32', '2016-08-25 02:08:10', '1094bd0425a2e543d0e0145137dca15e65695d44.jpeg', 'NULL'),
(16, 'Admin', 'Super Admin', 'dmorales@adeksys.com', '$2y$12$u0Pz7v1Y4bS4M3tmd55P6e54L2Cdvj5vQi2kyNw/.7EO4VKNtzyg.', 'ROLE_SUPER_ADMIN', 1, '2016-07-15 18:53:05', '2016-07-15 20:31:31', NULL, ''),
(21, 'Carlos', 'Bravo', 'cbravo@gmail.com', '$2y$12$acgficvZn/sQX9Fspp3MvOwOAJQS4884YFJ8Vt4iFjBl89eCUQvli', 'ROLE_USER', 0, '2016-08-22 18:35:09', '2016-08-24 16:06:58', NULL, NULL),
(22, 'Prueba Sesion', 'Sesion de Prueba', 'sesion@gmail.com', '$2y$12$CcrXq7lF50T.dlRUcBYsN.rz14BuiTSUgG61EuVT.5YreCeLhY8V.', 'ROLE_ADMIN', 1, '2016-08-24 17:41:49', '2016-08-24 18:31:33', '8c02ca7b6d7fdf845963c317d20ca7b059c328cd.jpeg', 'NULL'),
(23, 'Roberto', 'Pérez', 'rperez@gmail.com', '$2y$12$ggd3yJnBu7gBxHnzK6XamuuIWOIKIgRGKZpVg0KOVwMOm.oJaw31i', 'ROLE_USER', 1, '2016-08-25 00:25:41', '2016-08-25 00:25:41', NULL, NULL),
(24, 'Luisa', 'Bravo', 'lbravo@gmail.com', '$2y$12$hY93cNJapD4AmqKCRcrtaeHvQ8xxiFt7VEO722xEIdbSS96vyTVnS', 'ROLE_ADMIN', 1, '2016-08-25 05:16:34', '2016-08-25 05:17:59', '79d3072634f793d10437c3c6ceb87980567f2821.png', NULL),
(25, 'Elba', 'Sánchez Ruiz', 'e_ruiz@gmail.com', '$2y$12$zI2cyIjrKkxNUGhmTZp16un03r8AuN8P7rpjOaZAj85EjeHugYSRi', 'ROLE_USER', 1, '2016-08-25 05:23:19', '2016-08-25 05:23:19', NULL, NULL),
(26, 'Edith', 'Morales', 'edulce.morales@gmail.com', '$2y$12$ciO3WXr6M8j1LlQTekd.FeEdagfxX2e0aQhhAHfoRHWDR/gIXgOSi', 'ROLE_USER', 1, '2016-08-25 21:33:20', '2016-08-25 21:41:10', 'd886f3af2b1a25fb697b697ea9f8c47117baa411.jpeg', NULL);

--
-- Disparadores `users`
--
DROP TRIGGER IF EXISTS `usuarios_eliminados`;
DELIMITER //
CREATE TRIGGER `usuarios_eliminados` AFTER DELETE ON `users`
 FOR EACH ROW begin
insert into drop_user(email,created_at)
VALUES
(old.email,now());
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_eliminado`
--

CREATE TABLE IF NOT EXISTS `usuario_eliminado` (
  `id_eliminado` bigint(20) NOT NULL,
  `correo_usuario` varchar(100) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_eliminado`
--

INSERT INTO `usuario_eliminado` (`id_eliminado`, `correo_usuario`, `fecha`) VALUES
(1, 'lol@hotmail.com', '2016-07-27 18:22:51'),
(2, 'fin@gmail.com', '2016-07-27 19:12:06'),
(3, 'lol@hotmail.com', '2016-07-27 23:39:50'),
(4, 'lal@hotmail.com', '2016-07-27 23:43:40');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `FK_B8D75A50A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `FK_9B631D01A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
