-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2017 a las 03:44:47
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `postgrados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit`
--

CREATE TABLE IF NOT EXISTS `audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  `data` text,
  `result` varchar(45) NOT NULL,
  `moment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(45) NOT NULL,
  `browser` varchar(45) NOT NULL,
  `version` varchar(45) NOT NULL,
  `os` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Contiene datos de auditoria de sistema. Desarrollador Jose Rodriguez <josearodrigueze@gmail.com> @josearodrigueze' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `audit`
--

INSERT INTO `audit` (`id`, `user_id`, `url`, `data`, `result`, `moment`, `ip`, `browser`, `version`, `os`) VALUES
(1, 2, 'http://localhost/ndubraska/ndubraska/Welcome', NULL, 'ACCESS', '2016-11-16 04:30:00', '::1', 'Firefox', '49.0', 'Windows 7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=465 ;

--
-- Volcado de datos para la tabla `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(464, 1485743918, '127.0.0.1', 's94kHK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cohorte`
--

CREATE TABLE IF NOT EXISTS `cohorte` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `cohorte` char(3) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cohorte`
--

INSERT INTO `cohorte` (`id`, `cohorte`, `fecha_inicio`, `fecha_final`) VALUES
(1, 'VI', '2016-01-04', '2016-06-03'),
(2, 'VII', '2016-06-13', '2016-12-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativos`
--

CREATE TABLE IF NOT EXISTS `correlativos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `tipo` char(2) NOT NULL,
  `ano` varchar(15) NOT NULL,
  `usuarios_id` int(100) NOT NULL,
  `coorte` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `correlativos`
--

INSERT INTO `correlativos` (`id`, `cantidad`, `tipo`, `ano`, `usuarios_id`, `coorte`) VALUES
(1, 1, 'P5', '2017', 52, ''),
(2, 1, 'P6', '2017', 52, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encriptar_db`
--

CREATE TABLE IF NOT EXISTS `encriptar_db` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` blob NOT NULL,
  `password` blob,
  `register_date` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=230 ;

--
-- Volcado de datos para la tabla `encriptar_db`
--

INSERT INTO `encriptar_db` (`id`, `username`, `password`, `register_date`) VALUES
(1, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(2, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(3, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(4, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(5, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(6, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(7, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(8, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(9, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(10, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(11, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(12, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(13, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(14, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(15, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(16, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(17, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(18, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(19, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(20, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(21, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(22, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(23, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(24, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(25, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(26, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(27, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(28, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(29, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(30, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(31, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(32, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(33, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(34, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(35, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(36, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(37, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(38, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(39, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(40, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(41, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(42, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(43, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(44, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(45, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(46, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(47, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(48, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(49, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(50, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(51, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(52, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(53, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(54, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(55, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(56, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(57, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(58, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(59, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(60, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(61, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(62, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(63, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(64, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(65, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(66, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(67, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(68, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(69, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(70, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(71, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(72, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(73, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(74, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(75, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(76, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(77, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x37835f3e8394707727f8077a3f03b596),
(78, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x7521eb2f0867b6b134badd2415b04d82),
(79, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x7521eb2f0867b6b134badd2415b04d82),
(80, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(81, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(82, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(83, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(84, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(85, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(86, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(87, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(88, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(89, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(90, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(91, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(92, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(93, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(94, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(95, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(96, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(97, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(98, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(99, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(100, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(101, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(102, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(103, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(104, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(105, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(106, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(107, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(108, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(109, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(110, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(111, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(112, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(113, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(114, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(115, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x9c7975c18e231c136cea42977179d1e0),
(116, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x238df111d36a0a6bb5a29007c3b8955a),
(117, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x238df111d36a0a6bb5a29007c3b8955a),
(118, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x238df111d36a0a6bb5a29007c3b8955a),
(119, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x238df111d36a0a6bb5a29007c3b8955a),
(120, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x238df111d36a0a6bb5a29007c3b8955a),
(121, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x238df111d36a0a6bb5a29007c3b8955a),
(122, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xacfa0a2a488e58313db4c16441c8a887),
(123, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xd22768009364af6a71d8b3bab7cf204b),
(124, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xd22768009364af6a71d8b3bab7cf204b),
(125, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x0ff8c512bf7f2fe11210692d56c08093),
(126, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(127, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(128, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(129, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(130, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(131, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(132, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(133, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(134, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(135, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(136, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(137, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(138, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(139, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(140, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(141, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(142, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(143, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(144, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(145, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(146, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(147, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(148, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(149, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(150, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(151, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(152, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(153, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(154, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(155, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(156, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(157, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(158, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(159, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(160, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(161, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(162, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(163, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x4b86728756f11c08cecef1129fc27699),
(164, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x6709ea030943221f0113213503a0887d),
(165, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x6709ea030943221f0113213503a0887d),
(166, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0x6709ea030943221f0113213503a0887d),
(167, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xc225e95e6b4ef79391e3259a47ea4209),
(168, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xc225e95e6b4ef79391e3259a47ea4209),
(169, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xc225e95e6b4ef79391e3259a47ea4209),
(170, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xc225e95e6b4ef79391e3259a47ea4209),
(171, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xc225e95e6b4ef79391e3259a47ea4209),
(172, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(173, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(174, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(175, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(176, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(177, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(178, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(179, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(180, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(181, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(182, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(183, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(184, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xb0f3f20042c05d99e937c09064ccda99),
(185, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(186, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(187, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(188, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(189, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(190, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(191, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(192, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(193, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(194, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(195, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(196, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(197, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(198, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(199, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(200, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(201, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(202, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(203, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(204, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(205, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(206, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(207, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(208, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(209, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(210, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(211, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(212, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(213, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(214, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(215, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(216, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(217, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(218, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(219, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(220, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(221, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(222, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(223, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(224, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(225, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(226, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(227, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(228, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b),
(229, 0xcce1477b09f278dbbd0493366fdcf4fc, 0x214cc07493fa4ac86430283e3eccd206, 0xe07e7e465e5b31d1badd96c04bce9c8b);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historicos_usuarios`
--

CREATE TABLE IF NOT EXISTS `historicos_usuarios` (
  `id` int(11) NOT NULL,
  `campo` varchar(60) DEFAULT NULL,
  `dato_viejo` varchar(60) DEFAULT NULL,
  `dato_nuevo` varchar(60) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `responsable` varchar(45) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historicos_usuarios_usuarios_idx` (`usuarios_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_aranceles`
--

CREATE TABLE IF NOT EXISTS `pagos_aranceles` (
  `numero_deposito` varchar(20) NOT NULL,
  `fecha_deposito` date NOT NULL,
  `monto` float NOT NULL,
  `usuarios_id` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pagos_aranceles`
--

INSERT INTO `pagos_aranceles` (`numero_deposito`, `fecha_deposito`, `monto`, `usuarios_id`) VALUES
('00050411222114780027', '2017-01-29', 1200, 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE IF NOT EXISTS `periodo` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `periodo` varchar(7) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prosecuciones`
--

CREATE TABLE IF NOT EXISTS `prosecuciones` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `cohorte` char(5) DEFAULT NULL,
  `responsable` char(60) DEFAULT NULL,
  `ano_ingreso` date DEFAULT NULL,
  `condicion_de_pago` char(9) DEFAULT NULL,
  `propuesta_de_investigacion` varchar(255) DEFAULT NULL,
  `tipo_estudio` varchar(15) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prosecuciones_usuarios1_idx` (`usuarios_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `prosecuciones`
--

INSERT INTO `prosecuciones` (`id`, `cohorte`, `responsable`, `ano_ingreso`, `condicion_de_pago`, `propuesta_de_investigacion`, `tipo_estudio`, `usuarios_id`) VALUES
(1, 'N/A', 'Daniel Jose Rodriguez Ordaz', '2017-01-30', 'N/A', 'Tecnologias libres', 'maestria', 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones_usuarios`
--

CREATE TABLE IF NOT EXISTS `sesiones_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` varchar(8) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sesiones_usuarios_usuarios1_idx` (`usuarios_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=122 ;

--
-- Volcado de datos para la tabla `sesiones_usuarios`
--

INSERT INTO `sesiones_usuarios` (`id`, `fecha`, `hora`, `usuarios_id`) VALUES
(1, '2016-04-01', '4:44 PM', 1),
(2, '2016-04-02', '08:48 AM', 1),
(5, '2016-04-02', '11:09 AM', 1),
(6, '2016-04-02', '12:09 PM', 1),
(7, '2016-04-02', '1:02 PM', 1),
(8, '2016-04-02', '6:58 PM', 1),
(9, '2016-04-03', '08:00 AM', 1),
(10, '2016-04-04', '10:03 AM', 1),
(11, '2016-04-04', '2:02 PM', 1),
(12, '2016-04-04', '8:40 PM', 1),
(13, '2016-04-04', '8:44 PM', 2),
(14, '2016-04-05', '07:03 AM', 1),
(15, '2016-04-05', '6:37 PM', 1),
(16, '2016-04-06', '06:52 AM', 1),
(17, '2016-04-06', '10:10 AM', 1),
(18, '2016-04-06', '10:36 AM', 1),
(19, '2016-04-06', '7:49 PM', 1),
(20, '2016-04-09', '07:46 AM', 1),
(21, '2016-04-10', '07:32 AM', 1),
(22, '2016-04-11', '06:50 AM', 1),
(23, '2016-04-11', '08:30 AM', 1),
(24, '2016-04-11', '09:09 AM', 1),
(25, '2016-04-12', '7:44 PM', 1),
(26, '2016-04-13', '7:58 PM', 1),
(27, '2016-04-18', '06:48 AM', 1),
(28, '2016-04-18', '10:53 AM', 1),
(29, '2016-04-18', '1:15 PM', 1),
(30, '2016-04-18', '4:25 PM', 1),
(31, '2016-04-19', '08:09 AM', 1),
(32, '2016-04-23', '12:50 PM', 1),
(33, '2016-05-03', '6:13 PM', 1),
(34, '2016-05-04', '09:54 AM', 1),
(35, '2016-05-04', '10:38 AM', 1),
(36, '2016-05-06', '07:18 AM', 1),
(37, '2016-05-06', '07:43 AM', 1),
(38, '2016-05-06', '6:41 PM', 1),
(39, '2016-05-07', '08:01 AM', 1),
(40, '2016-05-07', '1:46 PM', 1),
(41, '2016-05-13', '11:48 AM', 1),
(42, '2016-05-19', '09:36 AM', 1),
(43, '2016-05-19', '10:21 AM', 1),
(44, '2016-05-19', '12:24 PM', 1),
(45, '2016-05-19', '8:00 PM', 1),
(46, '2016-05-26', '2:38 PM', 1),
(47, '2016-05-26', '3:11 PM', 2),
(48, '2016-05-26', '6:57 PM', 1),
(49, '2016-05-26', '9:10 PM', 1),
(50, '2016-05-26', '11:03 PM', 1),
(51, '2016-05-27', '10:48 AM', 2),
(52, '2016-05-27', '10:50 AM', 2),
(53, '2016-05-27', '11:08 AM', 2),
(54, '2016-06-03', '10:18 AM', 1),
(55, '2016-10-25', '1:18 PM', 2),
(56, '2016-10-25', '1:23 PM', 2),
(57, '2016-11-08', '03:51 AM', 2),
(58, '2016-11-13', '8:12 PM', 2),
(59, '2016-11-13', '8:22 PM', 2),
(60, '2016-11-13', '8:39 PM', 2),
(61, '2016-11-13', '8:40 PM', 2),
(62, '2016-11-13', '8:44 PM', 3),
(63, '2016-11-13', '8:51 PM', 2),
(64, '2016-11-14', '03:56 AM', 2),
(65, '2016-11-14', '1:36 PM', 2),
(66, '2016-11-14', '1:39 PM', 2),
(67, '2016-11-14', '1:41 PM', 34),
(68, '2016-11-14', '1:42 PM', 2),
(69, '2016-11-14', '3:23 PM', 2),
(70, '2016-11-14', '10:31 PM', 2),
(71, '2016-11-15', '12:56 PM', 2),
(72, '2016-11-16', '00:09 AM', 2),
(73, '2016-11-16', '2:01 PM', 2),
(74, '2016-11-16', '2:56 PM', 2),
(75, '2016-11-16', '3:08 PM', 2),
(76, '2016-11-16', '3:10 PM', 2),
(77, '2016-11-16', '3:45 PM', 2),
(78, '2016-11-16', '3:49 PM', 2),
(79, '2016-11-16', '4:00 PM', 2),
(80, '2016-11-16', '4:13 PM', 2),
(81, '2016-11-16', '4:15 PM', 2),
(82, '2016-11-17', '04:02 AM', 2),
(83, '2016-11-21', '00:04 AM', 2),
(84, '2016-11-21', '01:39 AM', 2),
(85, '2016-11-21', '02:10 AM', 2),
(86, '2016-11-21', '03:21 AM', 2),
(87, '2016-11-22', '02:31 AM', 2),
(88, '2016-11-22', '04:16 AM', 2),
(89, '2016-11-22', '04:17 AM', 2),
(90, '2016-11-22', '04:18 AM', 2),
(91, '2016-11-22', '04:19 AM', 2),
(92, '2016-11-22', '04:22 AM', 2),
(93, '2016-11-23', '02:59 AM', 2),
(94, '2016-11-23', '1:40 PM', 2),
(95, '2016-11-23', '11:54 PM', 2),
(96, '2016-11-24', '00:00 AM', 2),
(97, '2016-11-25', '12:43 PM', 2),
(98, '2016-11-27', '7:29 PM', 2),
(99, '2016-11-28', '01:55 AM', 2),
(100, '2016-11-28', '01:59 AM', 2),
(101, '2016-11-28', '02:11 AM', 2),
(102, '2016-11-28', '02:31 AM', 2),
(103, '2016-11-28', '03:12 AM', 2),
(104, '2016-11-30', '7:07 PM', 2),
(105, '2016-12-01', '02:43 AM', 2),
(106, '2016-12-01', '5:53 PM', 2),
(107, '2016-12-02', '03:44 AM', 2),
(108, '2016-12-03', '3:43 PM', 2),
(109, '2016-12-05', '04:44 AM', 2),
(110, '2016-12-06', '11:45 PM', 2),
(111, '2016-12-07', '07:16 AM', 2),
(112, '2016-12-09', '04:41 AM', 2),
(113, '2017-01-18', '00:33 AM', 2),
(114, '2017-01-18', '02:30 AM', 2),
(115, '2017-01-29', '10:06 PM', 2),
(116, '2017-01-29', '10:23 PM', 2),
(117, '2017-01-29', '10:25 PM', 48),
(118, '2017-01-29', '10:27 PM', 2),
(119, '2017-01-30', '03:19 AM', 2),
(120, '2017-01-30', '03:28 AM', 1),
(121, '2017-01-30', '03:39 AM', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulos_usuarios`
--

CREATE TABLE IF NOT EXISTS `titulos_usuarios` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `fecha_de_titulo` date DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_titulos_usuarios_usuarios1_idx` (`usuarios_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_curriculares`
--

CREATE TABLE IF NOT EXISTS `unidades_curriculares` (
  `id_unidad` int(255) NOT NULL AUTO_INCREMENT,
  `nombre_unidad` varchar(255) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `ponderacion_cualitativa` varchar(9) DEFAULT NULL,
  `ponderacion_cuantitativa` int(2) DEFAULT NULL,
  `periodo` char(8) DEFAULT NULL,
  `seccion` varchar(45) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  `area_conocimiento` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_unidad`),
  KEY `fk_unidades_curriculares_usuarios1_idx` (`usuarios_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `unidades_curriculares`
--

INSERT INTO `unidades_curriculares` (`id_unidad`, `nombre_unidad`, `tipo`, `ponderacion_cualitativa`, `ponderacion_cuantitativa`, `periodo`, `seccion`, `usuarios_id`, `area_conocimiento`) VALUES
(1, 'Pensamiento Politico,Estado,Democracia y Politicas Sociales', 'N/A', 'N/A', 0, '48 horas', 'N/A', 52, 'Gestion de Politicas publicas'),
(2, 'Paradigmas y Fundamentos de la Investigacion', 'N/A', 'N/A', 0, '48 horas', 'N/A', 52, 'Gestion de Politicas publicas'),
(3, 'Politica y Gestion Publica', 'N/A', 'N/A', 0, '48 horas', 'N/A', 52, 'Gestion de Politicas publicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_curricular`
--

CREATE TABLE IF NOT EXISTS `unidad_curricular` (
  `id_uc` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_unidad` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_uc`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `unidad_curricular`
--

INSERT INTO `unidad_curricular` (`id_uc`, `nombre_unidad`) VALUES
(1, 'Pensamiento Politico'),
(9, 'Etica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `cedula` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `titulo` varchar(200) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `lugar_de_trabajo` varchar(255) DEFAULT NULL,
  `cargo_o_departamento` varchar(255) DEFAULT NULL,
  `exoneracion` varchar(3) NOT NULL,
  `tipo_usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `estado` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `cedula`, `telefono`, `correo`, `titulo`, `direccion`, `lugar_de_trabajo`, `cargo_o_departamento`, `exoneracion`, `tipo_usuario`, `clave`, `usuario`, `estado`) VALUES
(2, 'Dubraska', NULL, 'v18827167', NULL, NULL, '', NULL, NULL, NULL, '', 'administrador', 'a04ae323ba820fed688bc9a61305b98c', 'adm18827167', 'activo'),
(1, 'Daniel Jose', 'Rodriguez Ordaz', 'v14133263', NULL, NULL, '', NULL, NULL, NULL, '', 'administrador', '25d55ad283aa400af464c76d713c07ad', 'adm14133263', 'activo'),
(51, 'Jose', NULL, 'v20333444', NULL, NULL, '', NULL, NULL, NULL, '', 'operador', '76b79e00133cc532b8481436ade29e02', 'adm20333444', 'noactivo'),
(52, 'Maria Elena', 'Perez', 'v08999444', '04167778800', 'marieb22@gmail.com', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'estudiante', '43d6fc3a59d81815b255558f2e2ef010', 'est08999444', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tokens`
--

CREATE TABLE IF NOT EXISTS `usuarios_tokens` (
  `id` int(11) NOT NULL DEFAULT '0',
  `toke` varchar(255) DEFAULT NULL,
  `ip_usuario` varchar(16) DEFAULT NULL,
  `fecha_limite` date DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuarios_tokens_usuarios1_idx` (`usuarios_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
