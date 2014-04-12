-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 12-04-2014 a las 09:11:40
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `curso_web`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `alumnos`
-- 

CREATE TABLE `alumnos` (
  `id_alumno` int(10) unsigned NOT NULL auto_increment,
  `nombre` varchar(100) default NULL,
  `ap_paterno` varchar(100) NOT NULL,
  `ap_materno` varchar(100) NOT NULL,
  `unidad_academica` int(11) NOT NULL,
  `matricula` varchar(15) default NULL,
  `sexo_id` int(11) default NULL,
  `archivo` text NOT NULL,
  PRIMARY KEY  (`id_alumno`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `alumnos`
-- 

INSERT INTO `alumnos` VALUES (1, 'ERICK BRITO Arroyo', '', '', 0, '105652', 1, 'c4ca4238a0b923820dcc509a6f75849b.pdf');
INSERT INTO `alumnos` VALUES (5, 'Daniel', '', '', 0, '430303', 1, '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `computadoras`
-- 

CREATE TABLE `computadoras` (
  `id_computadora` int(11) NOT NULL auto_increment,
  `nombre` varchar(128) NOT NULL,
  `descripcion` text NOT NULL,
  `estatus` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id_computadora`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `computadoras`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `estados`
-- 

CREATE TABLE `estados` (
  `id` int(11) NOT NULL auto_increment,
  `clave` varchar(2) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `abrev` varchar(16) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Tabla de Estados de la República Mexicana' AUTO_INCREMENT=33 ;

-- 
-- Volcar la base de datos para la tabla `estados`
-- 

INSERT INTO `estados` VALUES (1, '01', 'Aguascalientes', 'Ags.');
INSERT INTO `estados` VALUES (2, '02', 'Baja California', 'BC');
INSERT INTO `estados` VALUES (3, '03', 'Baja California Sur', 'BCS');
INSERT INTO `estados` VALUES (4, '04', 'Campeche', 'Camp.');
INSERT INTO `estados` VALUES (5, '05', 'Coahuila de Zaragoza', 'Coah.');
INSERT INTO `estados` VALUES (6, '06', 'Colima', 'Col.');
INSERT INTO `estados` VALUES (7, '07', 'Chiapas', 'Chis.');
INSERT INTO `estados` VALUES (8, '08', 'Chihuahua', 'Chih.');
INSERT INTO `estados` VALUES (9, '09', 'Distrito Federal', 'DF');
INSERT INTO `estados` VALUES (10, '10', 'Durango', 'Dgo.');
INSERT INTO `estados` VALUES (11, '11', 'Guanajuato', 'Gto.');
INSERT INTO `estados` VALUES (12, '12', 'Guerrero', 'Gro.');
INSERT INTO `estados` VALUES (13, '13', 'Hidalgo', 'Hgo.');
INSERT INTO `estados` VALUES (14, '14', 'Jalisco', 'Jal.');
INSERT INTO `estados` VALUES (15, '15', 'México', 'Mex.');
INSERT INTO `estados` VALUES (16, '16', 'Michoacán de Ocampo', 'Mich.');
INSERT INTO `estados` VALUES (17, '17', 'Morelos', 'Mor.');
INSERT INTO `estados` VALUES (18, '18', 'Nayarit', 'Nay.');
INSERT INTO `estados` VALUES (19, '19', 'Nuevo León', 'NL');
INSERT INTO `estados` VALUES (20, '20', 'Oaxaca', 'Oax.');
INSERT INTO `estados` VALUES (21, '21', 'Puebla', 'Pue.');
INSERT INTO `estados` VALUES (22, '22', 'Querétaro', 'Qro.');
INSERT INTO `estados` VALUES (23, '23', 'Quintana Roo', 'Q. Roo');
INSERT INTO `estados` VALUES (24, '24', 'San Luis Potosí', 'SLP');
INSERT INTO `estados` VALUES (25, '25', 'Sinaloa', 'Sin.');
INSERT INTO `estados` VALUES (26, '26', 'Sonora', 'Son.');
INSERT INTO `estados` VALUES (27, '27', 'Tabasco', 'Tab.');
INSERT INTO `estados` VALUES (28, '28', 'Tamaulipas', 'Tamps.');
INSERT INTO `estados` VALUES (29, '29', 'Tlaxcala', 'Tlax.');
INSERT INTO `estados` VALUES (30, '30', 'Veracruz de Ignacio de la Llave', 'Ver.');
INSERT INTO `estados` VALUES (31, '31', 'Yucatán', 'Yuc.');
INSERT INTO `estados` VALUES (32, '32', 'Zacatecas', 'Zac.');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `localidades`
-- 

CREATE TABLE `localidades` (
  `id` int(11) NOT NULL auto_increment,
  `municipio_id` int(11) NOT NULL COMMENT 'Relación con municipios',
  `clave` varchar(4) NOT NULL,
  `nombre` varchar(110) NOT NULL,
  `latitud` varchar(6) NOT NULL,
  `longitud` varchar(7) NOT NULL,
  `altitud` varchar(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `municipio_id` (`municipio_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Tabla de Localidades de la Republica Mexicana' AUTO_INCREMENT=299639 ;

-- 
-- Volcar la base de datos para la tabla `localidades`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `registro_laboratorio`
-- 

CREATE TABLE `registro_laboratorio` (
  `id` int(11) NOT NULL auto_increment,
  `id_alumno` int(11) NOT NULL,
  `id_computadora` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_termino` smallint(6) NOT NULL,
  `app_office` smallint(6) NOT NULL,
  `app_internet` smallint(6) NOT NULL,
  `app_linux` smallint(6) NOT NULL,
  `app_otra` smallint(6) NOT NULL,
  `estatus_maquina` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `registro_laboratorio`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sexo`
-- 

CREATE TABLE `sexo` (
  `id_sexo` int(10) unsigned NOT NULL auto_increment,
  `nombre_sexo` varchar(15) default NULL,
  PRIMARY KEY  (`id_sexo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `sexo`
-- 

INSERT INTO `sexo` VALUES (1, 'Masculino');
INSERT INTO `sexo` VALUES (2, 'Femenino');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `unidades_academicas`
-- 

CREATE TABLE `unidades_academicas` (
  `id_unidad_academica` int(11) NOT NULL auto_increment,
  `nombre_unidad_academica` varchar(200) NOT NULL,
  PRIMARY KEY  (`id_unidad_academica`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `unidades_academicas`
-- 

INSERT INTO `unidades_academicas` VALUES (1, 'FCAeI');
INSERT INTO `unidades_academicas` VALUES (2, 'Técnicos Laboratoristas');
