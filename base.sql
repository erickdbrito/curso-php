-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 22-03-2014 a las 14:55:14
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
  `nombre` varchar(64) default NULL,
  `matricula` varchar(15) default NULL,
  `sexo_id` int(11) default NULL,
  `estado` tinytext,
  `foto` text NOT NULL,
  PRIMARY KEY  (`id_alumno`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `alumnos`
-- 

INSERT INTO `alumnos` VALUES (1, 'ERICK BRITO', '10565', 1, '0', '');
INSERT INTO `alumnos` VALUES (5, 'Daniel', '430303', 1, 'morelos', '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `estados`
-- 

CREATE TABLE `estados` (
  `id_esatdo` int(10) unsigned NOT NULL auto_increment,
  `nombre_estado` varchar(50) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id_esatdo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `estados`
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
