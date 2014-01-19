-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-06-2013 a las 13:04:42
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gineobs`
--
CREATE DATABASE `gineobs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gineobs`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE IF NOT EXISTS `cita` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paciente_id` varchar(20) NOT NULL,
  `calendario_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `calendario_id` (`calendario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

CREATE TABLE IF NOT EXISTS `enfermedad` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `enfermedad`
--

INSERT INTO `enfermedad` (`id`, `nombre`, `descripcion`, `fecha_creacion`) VALUES
(1, 'hongo fuctus', 'hongo que se aloja en la zona vaginal.\r\n\r\ntratamiento largo', '2013-05-16 02:41:23'),
(2, 'esterococo', 'producido por infeccion de herida', '2013-05-16 02:43:28'),
(3, 'monovirus', 'produce un efecto al tomar pastillas anticonceptivas', '2013-05-16 02:45:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `fecha` (`fechaInicio`,`fechaFin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `fechaInicio`, `fechaFin`, `descripcion`) VALUES
(1, '2013-05-15 10:30:00', '2013-05-15 13:30:00', 'asd'),
(2, '2013-07-31 10:00:00', '2013-07-31 13:00:00', 'asd'),
(3, '2013-08-01 11:00:00', '2013-08-01 14:00:00', 'asd'),
(6, '2013-05-23 13:30:00', '2013-05-23 16:30:00', 'asdasdcxc'),
(8, '2013-05-09 00:00:00', '2013-05-09 06:00:00', 'asdc'),
(9, '2013-05-16 00:00:00', '2013-05-16 00:00:00', 'zxcasd'),
(10, '2013-06-06 00:00:00', '2013-06-06 00:00:00', '1231eqwa'),
(11, '2013-05-28 00:00:00', '2013-05-28 00:00:00', 'wed1dsad'),
(14, '2013-05-21 14:00:00', '2013-05-21 17:00:00', 'adasdasdasdasd'),
(16, '2013-05-22 09:00:00', '2013-05-22 12:30:00', 'evento loco\n\nmañana vamos'),
(18, '2013-04-30 00:00:00', '2013-05-02 00:00:00', 'evento loco\n\nmañana vamos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ginecologia_enfermedad`
--

CREATE TABLE IF NOT EXISTS `ginecologia_enfermedad` (
  `ginecologia_id` bigint(20) unsigned NOT NULL,
  `enfermedad_id` bigint(20) unsigned NOT NULL,
  KEY `ginecologia_id` (`ginecologia_id`),
  KEY `enfermedad_id` (`enfermedad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ginecologia_enfermedad`
--

INSERT INTO `ginecologia_enfermedad` (`ginecologia_id`, `enfermedad_id`) VALUES
(5, 2),
(6, 3),
(6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_ginecologia`
--

CREATE TABLE IF NOT EXISTS `historia_ginecologia` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paciente_id` varchar(8) NOT NULL,
  `fecha` date NOT NULL,
  `motivo_consulta` text NOT NULL,
  `dir_examen1` varchar(40) NOT NULL,
  `dir_examen2` varchar(40) NOT NULL,
  `examen_fisico` text NOT NULL,
  `diagnostico` text NOT NULL,
  `tratamiento` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `paciente_id` (`paciente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `historia_ginecologia`
--

INSERT INTO `historia_ginecologia` (`id`, `paciente_id`, `fecha`, `motivo_consulta`, `dir_examen1`, `dir_examen2`, `examen_fisico`, `diagnostico`, `tratamiento`) VALUES
(5, '44444444', '0000-00-00', 'asdasdasd', 'asdasdasdasd', 'asdasdasdasd', 'asdasdasdasdasdasd', 'asdasdasd', 'asdasdasdasdasd'),
(6, '44444444', '0000-00-00', 'zxczxczxc', 'czxzxczxc', 'zxczxczxczxc', 'zxczxczxc', 'zxczxczxczxc', 'zxczxcxczzxc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_obstetricia`
--

CREATE TABLE IF NOT EXISTS `historia_obstetricia` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paciente_id` varchar(8) NOT NULL,
  `fecha` date NOT NULL,
  `peso` float NOT NULL,
  `tension_arterial_mm` int(11) unsigned NOT NULL,
  `tension_arterial_hg` int(11) unsigned NOT NULL,
  `altura_uterina` float NOT NULL,
  `foco_fetal` tinyint(1) NOT NULL,
  `edad_embarazo` int(2) NOT NULL,
  `edemas` tinyint(1) NOT NULL,
  `otros` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ginecologia_id` (`id`),
  KEY `paciente_id` (`paciente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `historia_obstetricia`
--

INSERT INTO `historia_obstetricia` (`id`, `paciente_id`, `fecha`, `peso`, `tension_arterial_mm`, `tension_arterial_hg`, `altura_uterina`, `foco_fetal`, `edad_embarazo`, `edemas`, `otros`) VALUES
(1, '18126354', '0000-00-00', 0.5, 8, 17, 50.1, 0, 11, 1, ''),
(2, '18126354', '0000-00-00', 123, 123, 123, 123, 1, 15, 1, 'asdasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicina`
--

CREATE TABLE IF NOT EXISTS `medicina` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `presentacion` varchar(20) NOT NULL,
  `unidad` int(4) unsigned NOT NULL,
  `unidadPatron` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `medicina`
--

INSERT INTO `medicina` (`id`, `nombre`, `presentacion`, `unidad`, `unidadPatron`) VALUES
(1, 'parsel', 'Comprimido', 500, 'cc'),
(2, 'vaginox', 'Parche transdermico', 300, 'ml'),
(3, 'ezomeprazol', 'Comprimido', 500, 'mg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `cod_nota` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`cod_nota`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `id` varchar(8) NOT NULL,
  `nombre1` varchar(20) NOT NULL,
  `nombre2` varchar(20) DEFAULT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `telefono1` varchar(13) DEFAULT NULL,
  `telefono2` varchar(13) DEFAULT NULL,
  `correo` varchar(40) DEFAULT NULL,
  `edo_civil` tinyint(1) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `ante_familiares` text NOT NULL,
  `ante_personales` text NOT NULL,
  `menarquia` int(2) NOT NULL,
  `tipo_regla` varchar(15) NOT NULL,
  `gesta` int(1) NOT NULL,
  `para` int(2) NOT NULL,
  `aborto` int(2) NOT NULL,
  `cesarea` int(2) NOT NULL,
  `cesarea_descrip` text,
  `fue` date NOT NULL,
  `pmf` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `direccion`, `telefono1`, `telefono2`, `correo`, `edo_civil`, `fecha_ingreso`, `fecha_nacimiento`, `ante_familiares`, `ante_personales`, `menarquia`, `tipo_regla`, `gesta`, `para`, `aborto`, `cesarea`, `cesarea_descrip`, `fue`, `pmf`) VALUES
('18126354', 'lucrecia', 'maria de las rosas', 'cardona', 'hernandez', 'calle san carlos nro 1-4', '0414-323-1111', '0281-233-4451', 'edgar@midomin.com', 0, '0000-00-00', '0000-00-00', 'diabetes', 'locuras espontaneas', 4, 'sangrado fuerte', 0, 6, 13, 15, 'perfecta', '0000-00-00', 5000.2),
('44444444', 'asdd', 'asdasd', 'asdasdasd', 'asdasdasd', 'asdasd', '1111-111-1111', '1111-111-1122', 'a@a.com', 1, '0000-00-00', '0000-00-00', 'asdasd', 'asdasdasd', 11, 'asdasaasdas asd', 3, 4, 5, 17, 'asdasdasdasd', '0000-00-00', 900.101);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paga` float NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `paciente_id` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `paciente_id` (`paciente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id`, `paga`, `fecha`, `paciente_id`) VALUES
(1, 500.5, '2013-05-27 06:03:37', '18126354'),
(2, 500.5, '2013-05-27 06:03:37', '18126354'),
(3, 500.5, '2013-05-28 06:03:37', '18126354'),
(4, 500.5, '2013-05-27 06:03:37', '18126354'),
(5, 500.5, '2013-05-27 06:03:37', '18126354'),
(6, 100, '2013-10-28 05:35:03', '18126354'),
(7, 50.3, '2013-05-27 06:03:37', '18126354'),
(8, 700, '2013-11-28 05:35:03', '18126354'),
(9, 800, '2013-01-28 05:59:12', '18126354'),
(10, 400, '2013-02-27 06:03:37', '44444444'),
(11, 1000, '2013-06-19 12:19:17', '18126354'),
(12, 1000, '2013-06-19 12:19:28', '18126354'),
(13, 1000, '2013-06-19 12:19:33', '18126354'),
(14, 2000, '2013-06-19 12:19:38', '18126354');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recipe`
--

CREATE TABLE IF NOT EXISTS `recipe` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `indicaciones` text NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `paciente_id` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `medicina_id` (`paciente_id`),
  KEY `paciente_id` (`paciente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `recipe`
--

INSERT INTO `recipe` (`id`, `indicaciones`, `fecha`, `paciente_id`) VALUES
(3, 'dasdassdasdaasd', '0000-00-00 00:00:00', '18126354'),
(4, 'dasasd\r\nqw\r\nd\r\nq\r\ndad\r\nasasdasdasd', '2013-05-27 03:16:47', '44444444');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recipe_medicina`
--

CREATE TABLE IF NOT EXISTS `recipe_medicina` (
  `recipe_id` bigint(20) unsigned NOT NULL,
  `medicina_id` bigint(20) unsigned NOT NULL,
  KEY `recipe_id` (`recipe_id`),
  KEY `medicina_id` (`medicina_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recipe_medicina`
--

INSERT INTO `recipe_medicina` (`recipe_id`, `medicina_id`) VALUES
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `clave` varchar(40) NOT NULL,
  `nivel` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `clave`, `nivel`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 3),
(4, 'secretaria', '81dc9bdb52d04dc20036dbd8313ed055', 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`calendario_id`) REFERENCES `evento` (`id`);

--
-- Filtros para la tabla `historia_ginecologia`
--
ALTER TABLE `historia_ginecologia`
  ADD CONSTRAINT `historia_ginecologia_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`);

--
-- Filtros para la tabla `historia_obstetricia`
--
ALTER TABLE `historia_obstetricia`
  ADD CONSTRAINT `historia_obstetricia_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`);

--
-- Filtros para la tabla `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`);

--
-- Filtros para la tabla `recipe_medicina`
--
ALTER TABLE `recipe_medicina`
  ADD CONSTRAINT `recipe_medicina_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
  ADD CONSTRAINT `recipe_medicina_ibfk_2` FOREIGN KEY (`medicina_id`) REFERENCES `medicina` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
