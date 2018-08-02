-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2018 a las 13:46:51
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `transporteya`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrador', '1', 1508179644),
('cliente', '1', 1512322995);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/admin/*', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1508179072, 1508179072),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1508179072, 1508179072),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1508179072, 1508179072),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1508179072, 1508179072),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1508179072, 1508179072),
('/admin/default/*', 2, NULL, NULL, NULL, 1508179072, 1508179072),
('/admin/default/index', 2, NULL, NULL, NULL, 1508179072, 1508179072),
('/admin/menu/*', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/menu/create', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/menu/index', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/menu/update', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/menu/view', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/permission/*', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/permission/create', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/permission/index', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/permission/update', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/permission/view', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/role/*', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/role/assign', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/role/create', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/role/delete', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/role/index', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/role/remove', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/role/update', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/role/view', 2, NULL, NULL, NULL, 1508179073, 1508179073),
('/admin/route/*', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/route/assign', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/route/create', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/route/index', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/route/remove', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/rule/*', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/rule/create', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/rule/index', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/rule/update', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/rule/view', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/user/*', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/admin/user/activate', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/admin/user/delete', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/admin/user/index', 2, NULL, NULL, NULL, 1508179074, 1508179074),
('/admin/user/login', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/admin/user/logout', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/admin/user/signup', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/admin/user/view', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/calificacion/*', 2, NULL, NULL, NULL, 1508537736, 1508537736),
('/calificacion/create', 2, NULL, NULL, NULL, 1508537736, 1508537736),
('/calificacion/delete', 2, NULL, NULL, NULL, 1508537736, 1508537736),
('/calificacion/index', 2, NULL, NULL, NULL, 1508537736, 1508537736),
('/calificacion/update', 2, NULL, NULL, NULL, 1508537736, 1508537736),
('/calificacion/view', 2, NULL, NULL, NULL, 1508537736, 1508537736),
('/cliente/*', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/cliente/create', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/cliente/delete', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/cliente/index', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/cliente/update', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/cliente/view', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/cliente/viewempresa', 2, NULL, NULL, NULL, 1508537736, 1508537736),
('/comuna/*', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/comuna/create', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/comuna/delete', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/comuna/index', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/comuna/update', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/comuna/view', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/debug/*', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/debug/default/*', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/debug/default/index', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/debug/default/view', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/debug/user/*', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/debug/user/set-identity', 2, NULL, NULL, NULL, 1508179075, 1508179075),
('/gii/*', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/gii/default/*', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/gii/default/action', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/gii/default/diff', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/gii/default/index', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/gii/default/preview', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/gii/default/view', 2, NULL, NULL, NULL, 1508179076, 1508179076),
('/oferta/*', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/oferta/aprobada', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/oferta/create', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/oferta/delete', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/oferta/index', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/oferta/index_mis_cargas', 2, NULL, NULL, NULL, 1509286534, 1509286534),
('/oferta/indexfree', 2, NULL, NULL, NULL, 1510771873, 1510771873),
('/oferta/indexmiscargas', 2, NULL, NULL, NULL, 1509993730, 1509993730),
('/oferta/update', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/oferta/vencida', 2, NULL, NULL, NULL, 1508537736, 1508537736),
('/oferta/view', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/pedido/*', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/pedido/comuna', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/pedido/comunadestino', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/pedido/coords', 2, NULL, NULL, NULL, 1509993731, 1509993731),
('/pedido/create', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/pedido/delete', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/pedido/detalleentrega', 2, NULL, NULL, NULL, 1510771873, 1510771873),
('/pedido/entrega', 2, NULL, NULL, NULL, 1509286534, 1509286534),
('/pedido/index', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/pedido/indexcargasentregadas', 2, NULL, NULL, NULL, 1509993730, 1509993730),
('/pedido/indexmispedidos', 2, NULL, NULL, NULL, 1513378725, 1513378725),
('/pedido/pdf', 2, NULL, NULL, NULL, 1509993731, 1509993731),
('/pedido/provincia', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/pedido/provinciadestino', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/pedido/update', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/pedido/verubicacion', 2, NULL, NULL, NULL, 1509993731, 1509993731),
('/pedido/view', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/pedido/viewnew', 2, NULL, NULL, NULL, 1509760662, 1509760662),
('/pedido/viewofertado', 2, NULL, NULL, NULL, 1509027577, 1509027577),
('/provincia/*', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/provincia/create', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/provincia/delete', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/provincia/index', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/provincia/update', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/provincia/view', 2, NULL, NULL, NULL, 1508179077, 1508179077),
('/region/*', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/region/create', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/region/delete', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/region/index', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/region/update', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/region/view', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/site/*', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/site/about', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/site/captcha', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/site/contact', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/site/error', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/site/index', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/site/login', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('/site/logout', 2, NULL, NULL, NULL, 1508179078, 1508179078),
('administrador', 1, NULL, NULL, NULL, 1508179289, 1508179432),
('cliente', 1, NULL, NULL, NULL, 1508179467, 1508180708),
('empresa', 1, NULL, NULL, NULL, 1508179520, 1508179520),
('permiso empresa', 2, NULL, NULL, NULL, 1508184257, 1508184257),
('permisos clientes', 2, NULL, NULL, NULL, 1508184406, 1508184406),
('sesion', 2, NULL, NULL, NULL, 1508179344, 1508179344);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('administrador', '/*'),
('administrador', '/admin/*'),
('administrador', '/admin/assignment/*'),
('administrador', '/admin/assignment/assign'),
('administrador', '/admin/assignment/index'),
('administrador', '/admin/assignment/revoke'),
('administrador', '/admin/assignment/view'),
('administrador', '/admin/default/*'),
('administrador', '/admin/default/index'),
('administrador', '/admin/menu/*'),
('administrador', '/admin/menu/create'),
('administrador', '/admin/menu/delete'),
('administrador', '/admin/menu/index'),
('administrador', '/admin/menu/update'),
('administrador', '/admin/menu/view'),
('administrador', '/admin/permission/*'),
('administrador', '/admin/permission/assign'),
('administrador', '/admin/permission/create'),
('administrador', '/admin/permission/delete'),
('administrador', '/admin/permission/index'),
('administrador', '/admin/permission/remove'),
('administrador', '/admin/permission/update'),
('administrador', '/admin/permission/view'),
('administrador', '/admin/role/*'),
('administrador', '/admin/role/assign'),
('administrador', '/admin/role/create'),
('administrador', '/admin/role/delete'),
('administrador', '/admin/role/index'),
('administrador', '/admin/role/remove'),
('administrador', '/admin/role/update'),
('administrador', '/admin/role/view'),
('administrador', '/admin/route/*'),
('administrador', '/admin/route/assign'),
('administrador', '/admin/route/create'),
('administrador', '/admin/route/index'),
('administrador', '/admin/route/refresh'),
('administrador', '/admin/route/remove'),
('administrador', '/admin/rule/*'),
('administrador', '/admin/rule/create'),
('administrador', '/admin/rule/delete'),
('administrador', '/admin/rule/index'),
('administrador', '/admin/rule/update'),
('administrador', '/admin/rule/view'),
('administrador', '/admin/user/*'),
('administrador', '/admin/user/activate'),
('administrador', '/admin/user/change-password'),
('administrador', '/admin/user/delete'),
('administrador', '/admin/user/index'),
('administrador', '/admin/user/login'),
('administrador', '/admin/user/logout'),
('administrador', '/admin/user/request-password-reset'),
('administrador', '/admin/user/reset-password'),
('administrador', '/admin/user/signup'),
('administrador', '/admin/user/view'),
('administrador', '/cliente/*'),
('administrador', '/cliente/create'),
('administrador', '/cliente/delete'),
('administrador', '/cliente/index'),
('administrador', '/cliente/update'),
('administrador', '/cliente/view'),
('administrador', '/comuna/*'),
('administrador', '/comuna/create'),
('administrador', '/comuna/delete'),
('administrador', '/comuna/index'),
('administrador', '/comuna/update'),
('administrador', '/comuna/view'),
('administrador', '/debug/*'),
('administrador', '/debug/default/*'),
('administrador', '/debug/default/db-explain'),
('administrador', '/debug/default/download-mail'),
('administrador', '/debug/default/index'),
('administrador', '/debug/default/toolbar'),
('administrador', '/debug/default/view'),
('administrador', '/debug/user/*'),
('administrador', '/debug/user/reset-identity'),
('administrador', '/debug/user/set-identity'),
('administrador', '/gii/*'),
('administrador', '/gii/default/*'),
('administrador', '/gii/default/action'),
('administrador', '/gii/default/diff'),
('administrador', '/gii/default/index'),
('administrador', '/gii/default/preview'),
('administrador', '/gii/default/view'),
('administrador', '/oferta/*'),
('administrador', '/oferta/aprobada'),
('administrador', '/oferta/create'),
('administrador', '/oferta/delete'),
('administrador', '/oferta/index'),
('administrador', '/oferta/update'),
('administrador', '/oferta/view'),
('administrador', '/pedido/*'),
('administrador', '/pedido/comuna'),
('administrador', '/pedido/comunadestino'),
('administrador', '/pedido/create'),
('administrador', '/pedido/delete'),
('administrador', '/pedido/index'),
('administrador', '/pedido/provincia'),
('administrador', '/pedido/provinciadestino'),
('administrador', '/pedido/update'),
('administrador', '/pedido/view'),
('administrador', '/provincia/*'),
('administrador', '/provincia/create'),
('administrador', '/provincia/delete'),
('administrador', '/provincia/index'),
('administrador', '/provincia/update'),
('administrador', '/provincia/view'),
('administrador', '/region/*'),
('administrador', '/region/create'),
('administrador', '/region/delete'),
('administrador', '/region/index'),
('administrador', '/region/update'),
('administrador', '/region/view'),
('administrador', '/site/*'),
('administrador', '/site/about'),
('administrador', '/site/captcha'),
('administrador', '/site/contact'),
('administrador', '/site/error'),
('administrador', '/site/index'),
('administrador', '/site/login'),
('administrador', '/site/logout'),
('administrador', 'sesion'),
('cliente', 'permisos clientes'),
('cliente', 'sesion'),
('empresa', '/cliente/view'),
('empresa', '/cliente/viewempresa'),
('empresa', 'permiso empresa'),
('empresa', 'sesion'),
('permiso empresa', '/cliente/create'),
('permiso empresa', '/cliente/index'),
('permiso empresa', '/cliente/update'),
('permiso empresa', '/cliente/view'),
('permiso empresa', '/cliente/viewempresa'),
('permiso empresa', '/oferta/*'),
('permiso empresa', '/oferta/aprobada'),
('permiso empresa', '/oferta/create'),
('permiso empresa', '/oferta/index'),
('permiso empresa', '/oferta/index_mis_cargas'),
('permiso empresa', '/oferta/update'),
('permiso empresa', '/oferta/view'),
('permiso empresa', '/pedido/comuna'),
('permiso empresa', '/pedido/comunadestino'),
('permiso empresa', '/pedido/coords'),
('permiso empresa', '/pedido/create'),
('permiso empresa', '/pedido/detalleentrega'),
('permiso empresa', '/pedido/entrega'),
('permiso empresa', '/pedido/index'),
('permiso empresa', '/pedido/indexcargasentregadas'),
('permiso empresa', '/pedido/indexmispedidos'),
('permiso empresa', '/pedido/pdf'),
('permiso empresa', '/pedido/provincia'),
('permiso empresa', '/pedido/provinciadestino'),
('permiso empresa', '/pedido/update'),
('permiso empresa', '/pedido/verubicacion'),
('permiso empresa', '/pedido/view'),
('permiso empresa', '/pedido/viewnew'),
('permiso empresa', '/pedido/viewofertado'),
('permiso empresa', '/site/*'),
('permiso empresa', '/site/about'),
('permiso empresa', '/site/captcha'),
('permiso empresa', '/site/contact'),
('permiso empresa', '/site/error'),
('permiso empresa', '/site/index'),
('permiso empresa', '/site/login'),
('permiso empresa', '/site/logout'),
('permisos clientes', '/calificacion/*'),
('permisos clientes', '/calificacion/create'),
('permisos clientes', '/calificacion/delete'),
('permisos clientes', '/calificacion/index'),
('permisos clientes', '/calificacion/update'),
('permisos clientes', '/calificacion/view'),
('permisos clientes', '/cliente/*'),
('permisos clientes', '/cliente/create'),
('permisos clientes', '/cliente/update'),
('permisos clientes', '/cliente/view'),
('permisos clientes', '/oferta/*'),
('permisos clientes', '/oferta/aprobada'),
('permisos clientes', '/oferta/index'),
('permisos clientes', '/oferta/view'),
('permisos clientes', '/pedido/*'),
('permisos clientes', '/pedido/comuna'),
('permisos clientes', '/pedido/comunadestino'),
('permisos clientes', '/pedido/create'),
('permisos clientes', '/pedido/index'),
('permisos clientes', '/pedido/pdf'),
('permisos clientes', '/pedido/provincia'),
('permisos clientes', '/pedido/provinciadestino'),
('permisos clientes', '/pedido/update'),
('permisos clientes', '/pedido/view'),
('sesion', '/cliente/create'),
('sesion', '/cliente/index'),
('sesion', '/cliente/update'),
('sesion', '/cliente/view'),
('sesion', '/site/about'),
('sesion', '/site/captcha'),
('sesion', '/site/contact'),
('sesion', '/site/error'),
('sesion', '/site/index'),
('sesion', '/site/login'),
('sesion', '/site/logout');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id` int(12) NOT NULL,
  `calificacion` tinyint(4) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `oferta_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(12) NOT NULL,
  `rut` int(12) NOT NULL,
  `rut_add` varchar(1) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `apellidop` varchar(50) NOT NULL,
  `apellidom` varchar(50) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `fono` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `reglas_condiciones` tinyint(4) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `comuna_id` int(12) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `tipo` varchar(1) NOT NULL,
  `imagen_perfil` varchar(255) DEFAULT NULL,
  `roll_sii` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Clientes contratantes';

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `rut`, `rut_add`, `nombre`, `apellidop`, `apellidom`, `direccion`, `fono`, `email`, `reglas_condiciones`, `username`, `password`, `comuna_id`, `activo`, `tipo`, `imagen_perfil`, `roll_sii`) VALUES
(2, 17559118, '4', 'ensayo', 'final ', 'finalisismo', 'la Casa del Cliente ', '111111111111', 'email@email.com', 1, 'ensayo', '7c4a8d09ca3762af61e59520943dc26494f8941b', 180, 1, '0', '/web/imagenes_perfil/perfil_malo.png', NULL),
(3, 3139315, '9', 'Empresa revicion', '', '', 'La casa de la empresa 2', '22222222222', 'email_empresa@email.com', 1, 'empresa', '7c4a8d09ca3762af61e59520943dc26494f8941b', 254, 1, '1', '/web/imagenes_perfil/perfil_actualiza_tus_datos.png', '/web/imagenes_roll/roll_actualiza_tus_datos.jpg'),
(8, 16870648, 'o', 'Camilo', 'Contreras S.', 'Ernesto', 'carr 22, cale 16 # 22-85, Barrio Obrero', '04141266763', 'contreras.camilo@gmail.com111', 1, 'camilo123', '7c4a8d09ca3762af61e59520943dc26494f8941b', 276, 1, '0', '/web/imagenes_perfil/perfil_w-brand.png', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `id` int(12) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `provincia_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`id`, `nombre`, `provincia_id`) VALUES
(1, 'ARICA', 1),
(2, 'CAMARONES', 1),
(3, 'PUTRE', 2),
(4, 'GENERAL LAGOS', 2),
(5, 'IQUIQUE', 3),
(6, 'ALTO HOSPICIO', 3),
(7, 'POZO ALMONTE', 4),
(8, 'CAMIÑA', 4),
(9, 'COLCHANE', 4),
(10, 'HUARA', 4),
(11, 'PICA', 4),
(12, 'ANTOFAGASTA', 5),
(13, 'MEJILLONES', 5),
(14, 'SIERRA GORDA', 5),
(15, 'TALTAL', 5),
(16, 'CALAMA', 6),
(17, 'OLLAGÜE', 6),
(18, 'SAN PEDRO DE ATACAMA', 6),
(19, 'TOCOPILLA', 7),
(20, 'MARÍA ELENA', 7),
(21, 'COPIAPÓ', 8),
(22, 'CALDERA', 8),
(23, 'TIERRA AMARILLA', 8),
(24, 'CHAÑARAL', 9),
(25, 'DIEGO DE ALMAGRO', 9),
(26, 'VALLENAR', 10),
(27, 'ALTO DEL CARMEN', 10),
(28, 'FREIRINA', 10),
(29, 'HUASCO', 10),
(30, 'LA SERENA', 11),
(31, 'COQUIMBO', 11),
(32, 'ANDACOLLO', 11),
(33, 'LA HIGUERA', 11),
(34, 'PAIGUANO', 11),
(35, 'VICUÑA', 11),
(36, 'ILLAPEL', 12),
(37, 'CANELA', 12),
(38, 'LOS VILOS', 12),
(39, 'SALAMANCA', 12),
(40, 'OVALLE', 13),
(41, 'COMBARBALÁ', 13),
(42, 'MONTE PATRIA', 13),
(43, 'PUNITAQUI', 13),
(44, 'RÍO HURTADO', 13),
(45, 'VALPARAÍSO', 14),
(46, 'CASABLANCA', 14),
(47, 'CONCÓN', 14),
(48, 'JUAN FERNÁNDEZ', 14),
(49, 'PUCHUNCAVÍ', 14),
(50, 'QUINTERO', 14),
(51, 'VIÑA DEL MAR', 14),
(52, 'ISLA DE PASCUA', 15),
(53, 'LOS ANDES', 16),
(54, 'CALLE LARGA', 16),
(55, 'RINCONADA', 16),
(56, 'SAN ESTEBAN', 16),
(57, 'LA LIGUA', 17),
(58, 'CABILDO', 17),
(59, 'PAPUDO', 17),
(60, 'PETORCA', 17),
(61, 'ZAPALLAR', 17),
(62, 'QUILLOTA', 18),
(63, 'CALERA', 18),
(64, 'HIJUELAS', 18),
(65, 'LA CRUZ', 18),
(66, 'NOGALES', 18),
(67, 'SAN ANTONIO', 19),
(68, 'ALGARROBO', 19),
(69, 'CARTAGENA', 19),
(70, 'EL QUISCO', 19),
(71, 'EL TABO', 19),
(72, 'SANTO DOMINGO', 19),
(73, 'SAN FELIPE', 20),
(74, 'CATEMU', 20),
(75, 'LLAILLAY', 20),
(76, 'PANQUEHUE', 20),
(77, 'PUTAENDO', 20),
(78, 'SANTA MARÍA', 20),
(79, 'LIMACHE', 21),
(80, 'QUILPUÉ', 21),
(81, 'VILLA ALEMANA', 21),
(82, 'OLMUÉ', 21),
(83, 'RANCAGUA', 22),
(84, 'CODEGUA', 22),
(85, 'COINCO', 22),
(86, 'COLTAUCO', 22),
(87, 'DOÑIHUE', 22),
(88, 'GRANEROS', 22),
(89, 'LAS CABRAS', 22),
(90, 'MACHALÍ', 22),
(91, 'MALLOA', 22),
(92, 'MOSTAZAL', 22),
(93, 'OLIVAR', 22),
(94, 'PEUMO', 22),
(95, 'PICHIDEGUA', 22),
(96, 'QUINTA DE TILCOCO', 22),
(97, 'RENGO', 22),
(98, 'REQUÍNOA', 22),
(99, 'SAN VICENTE', 22),
(100, 'PICHILEMU', 23),
(101, 'LA ESTRELLA', 23),
(102, 'LITUECHE', 23),
(103, 'MARCHIHUE', 23),
(104, 'NAVIDAD', 23),
(105, 'PAREDONES', 23),
(106, 'SAN FERNANDO', 24),
(107, 'CHÉPICA', 24),
(108, 'CHIMBARONGO', 24),
(109, 'LOLOL', 24),
(110, 'NANCAGUA', 24),
(111, 'PALMILLA', 24),
(112, 'PERALILLO', 24),
(113, 'PLACILLA', 24),
(114, 'PUMANQUE', 24),
(115, 'SANTA CRUZ', 24),
(116, 'TALCA', 25),
(117, 'CONSTITUCIÓN', 25),
(118, 'CUREPTO', 25),
(119, 'EMPEDRADO', 25),
(120, 'MAULE', 25),
(121, 'PELARCO', 25),
(122, 'PENCAHUE', 25),
(123, 'RÍO CLARO', 25),
(124, 'SAN CLEMENTE', 25),
(125, 'SAN RAFAEL', 25),
(126, 'CAUQUENES', 26),
(127, 'CHANCO', 26),
(128, 'PELLUHUE', 26),
(129, 'CURICÓ', 27),
(130, 'HUALAÑÉ', 27),
(131, 'LICANTÉN', 27),
(132, 'MOLINA', 27),
(133, 'RAUCO', 27),
(134, 'ROMERAL', 27),
(135, 'SAGRADA FAMILIA', 27),
(136, 'TENO', 27),
(137, 'VICHUQUÉN', 27),
(138, 'LINARES', 28),
(139, 'COLBÚN', 28),
(140, 'LONGAVÍ', 28),
(141, 'PARRAL', 28),
(142, 'RETIRO', 28),
(143, 'SAN JAVIER', 28),
(144, 'VILLA ALEGRE', 28),
(145, 'YERBAS BUENAS', 28),
(146, 'CONCEPCIÓN', 29),
(147, 'CORONEL', 29),
(148, 'CHIGUAYANTE', 29),
(149, 'FLORIDA', 29),
(150, 'HUALQUI', 29),
(151, 'LOTA', 29),
(152, 'PENCO', 29),
(153, 'SAN PEDRO DE LA PAZ', 29),
(154, 'SANTA JUANA', 29),
(155, 'TALCAHUANO', 29),
(156, 'TOMÉ', 29),
(157, 'HUALPÉN', 29),
(158, 'LEBU', 30),
(159, 'ARAUCO', 30),
(160, 'CAÑETE', 30),
(161, 'CONTULMO', 30),
(162, 'CURANILAHUE', 30),
(163, 'LOS ALAMOS', 30),
(164, 'TIRÚA', 30),
(165, 'LOS ANGELES', 31),
(166, 'ANTUCO', 31),
(167, 'CABRERO', 31),
(168, 'LAJA', 31),
(169, 'MULCHÉN', 31),
(170, 'NACIMIENTO', 31),
(171, 'NEGRETE', 31),
(172, 'QUILACO', 31),
(173, 'QUILLECO', 31),
(174, 'SAN ROSENDO', 31),
(175, 'SANTA BÁRBARA', 31),
(176, 'TUCAPEL', 31),
(177, 'YUMBEL', 31),
(178, 'ALTO BIOBÍO', 31),
(179, 'CHILLÁN', 32),
(180, 'BULNES', 32),
(181, 'COBQUECURA', 32),
(182, 'COELEMU', 32),
(183, 'COIHUECO', 32),
(184, 'CHILLÁN VIEJO', 32),
(185, 'EL CARMEN', 32),
(186, 'NINHUE', 32),
(187, 'ÑIQUÉN', 32),
(188, 'PEMUCO', 32),
(189, 'PINTO', 32),
(190, 'PORTEZUELO', 32),
(191, 'QUILLÓN', 32),
(192, 'QUIRIHUE', 32),
(193, 'RÁNQUIL', 32),
(194, 'SAN CARLOS', 32),
(195, 'SAN FABIÁN', 32),
(196, 'SAN IGNACIO', 32),
(197, 'SAN NICOLÁS', 32),
(198, 'TREGUACO', 32),
(199, 'YUNGAY', 32),
(200, 'TEMUCO', 33),
(201, 'CARAHUE', 33),
(202, 'CUNCO', 33),
(203, 'CURARREHUE', 33),
(204, 'FREIRE', 33),
(205, 'GALVARINO', 33),
(206, 'GORBEA', 33),
(207, 'LAUTARO', 33),
(208, 'LONCOCHE', 33),
(209, 'MELIPEUCO', 33),
(210, 'NUEVA IMPERIAL', 33),
(211, 'PADRE LAS CASAS', 33),
(212, 'PERQUENCO', 33),
(213, 'PITRUFQUÉN', 33),
(214, 'PUCÓN', 33),
(215, 'SAAVEDRA', 33),
(216, 'TEODORO SCHMIDT', 33),
(217, 'TOLTÉN', 33),
(218, 'VILCÚN', 33),
(219, 'VILLARRICA', 33),
(220, 'CHOLCHOL', 33),
(221, 'ANGOL', 34),
(222, 'COLLIPULLI', 34),
(223, 'CURACAUTÍN', 34),
(224, 'ERCILLA', 34),
(225, 'LONQUIMAY', 34),
(226, 'LOS SAUCES', 34),
(227, 'LUMACO', 34),
(228, 'PURÉN', 34),
(229, 'RENAICO', 34),
(230, 'TRAIGUÉN', 34),
(231, 'VICTORIA', 34),
(232, 'VALDIVIA', 35),
(233, 'CORRAL', 35),
(234, 'LANCO', 35),
(235, 'LOS LAGOS', 35),
(236, 'MÁFIL', 35),
(237, 'MARIQUINA', 35),
(238, 'PAILLACO', 35),
(239, 'PANGUIPULLI', 35),
(240, 'LA UNIÓN', 36),
(241, 'FUTRONO', 36),
(242, 'LAGO RANCO', 36),
(243, 'RÍO BUENO', 36),
(244, 'PUERTO MONTT', 37),
(245, 'CALBUCO', 37),
(246, 'COCHAMÓ', 37),
(247, 'FRESIA', 37),
(248, 'FRUTILLAR', 37),
(249, 'LOS MUERMOS', 37),
(250, 'LLANQUIHUE', 37),
(251, 'MAULLÍN', 37),
(252, 'PUERTO VARAS', 37),
(253, 'CASTRO', 38),
(254, 'ANCUD', 38),
(255, 'CHONCHI', 38),
(256, 'CURACO DE VÉLEZ', 38),
(257, 'DALCAHUE', 38),
(258, 'PUQUELDÓN', 38),
(259, 'QUEILÉN', 38),
(260, 'QUELLÓN', 38),
(261, 'QUEMCHI', 38),
(262, 'QUINCHAO', 38),
(263, 'OSORNO', 39),
(264, 'PUERTO OCTAY', 39),
(265, 'PURRANQUE', 39),
(266, 'PUYEHUE', 39),
(267, 'RÍO NEGRO', 39),
(268, 'SAN JUAN DE LA COSTA', 39),
(269, 'SAN PABLO', 39),
(270, 'CHAITÉN', 40),
(271, 'FUTALEUFÚ', 40),
(272, 'HUALAIHUÉ', 40),
(273, 'PALENA', 40),
(274, 'COIHAIQUE', 41),
(275, 'LAGO VERDE', 41),
(276, 'AISÉN', 42),
(277, 'CISNES', 42),
(278, 'GUAITECAS', 42),
(279, 'COCHRANE', 43),
(280, 'O\'HIGGINS', 43),
(281, 'TORTEL', 43),
(282, 'CHILE CHICO', 44),
(283, 'RÍO IBÁÑEZ', 44),
(284, 'PUNTA ARENAS', 45),
(285, 'LAGUNA BLANCA', 45),
(286, 'RÍO VERDE', 45),
(287, 'SAN GREGORIO', 45),
(288, 'CABO DE HORNOS', 46),
(289, 'ANTÁRTICA', 46),
(290, 'PORVENIR', 47),
(291, 'PRIMAVERA', 47),
(292, 'TIMAUKEL', 47),
(293, 'NATALES', 48),
(294, 'TORRES DEL PAINE', 48),
(295, 'SANTIAGO', 49),
(296, 'CERRILLOS', 49),
(297, 'CERRO NAVIA', 49),
(298, 'CONCHALÍ', 49),
(299, 'EL BOSQUE', 49),
(300, 'ESTACIÓN CENTRAL', 49),
(301, 'HUECHURABA', 49),
(302, 'INDEPENDENCIA', 49),
(303, 'LA CISTERNA', 49),
(304, 'LA FLORIDA', 49),
(305, 'LA GRANJA', 49),
(306, 'LA PINTANA', 49),
(307, 'LA REINA', 49),
(308, 'LAS CONDES', 49),
(309, 'LO BARNECHEA', 49),
(310, 'LO ESPEJO', 49),
(311, 'LO PRADO', 49),
(312, 'MACUL', 49),
(313, 'MAIPÚ', 49),
(314, 'ÑUÑOA', 49),
(315, 'PEDRO AGUIRRE CERDA', 49),
(316, 'PEÑALOLÉN', 49),
(317, 'PROVIDENCIA', 49),
(318, 'PUDAHUEL', 49),
(319, 'QUILICURA', 49),
(320, 'QUINTA NORMAL', 49),
(321, 'RECOLETA', 49),
(322, 'RENCA', 49),
(323, 'SAN JOAQUÍN', 49),
(324, 'SAN MIGUEL', 49),
(325, 'SAN RAMÓN', 49),
(326, 'VITACURA', 49),
(327, 'PUENTE ALTO', 50),
(328, 'PIRQUE', 50),
(329, 'SAN JOSÉ DE MAIPO', 50),
(330, 'COLINA', 51),
(331, 'LAMPA', 51),
(332, 'TILTIL', 51),
(333, 'SAN BERNARDO', 52),
(334, 'BUIN', 52),
(335, 'CALERA DE TANGO', 52),
(336, 'PAINE', 52),
(337, 'MELIPILLA', 53),
(338, 'ALHUÉ', 53),
(339, 'CURACAVÍ', 53),
(340, 'MARÍA PINTO', 53),
(341, 'SAN PEDRO', 53),
(342, 'TALAGANTE', 54),
(343, 'EL MONTE', 54),
(344, 'ISLA DE MAIPO', 54),
(345, 'PADRE HURTADO', 54),
(346, 'PEÑAFLOR', 54);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` int(12) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `tamano` float(20,2) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `firma` blob,
  `cliente_id` int(12) NOT NULL,
  `pedido_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1507578126),
('m140506_102106_rbac_init', 1508007052),
('m140602_111327_create_menu_table', 1507578139),
('m160312_050000_create_user', 1507578140);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
  `id` int(12) NOT NULL,
  `oferta_serv` float(20,2) NOT NULL,
  `comentarios` varchar(250) NOT NULL,
  `aprobada` tinyint(4) DEFAULT NULL,
  `empresas_id` int(12) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `cliente_id` int(12) NOT NULL,
  `coordenadas_actuales` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`id`, `oferta_serv`, `comentarios`, `aprobada`, `empresas_id`, `pedido_id`, `cliente_id`, `coordenadas_actuales`) VALUES
(1, 11111.00, '111', 1, 3, 1, 2, NULL),
(2, 333.00, '333', 0, 1, 2, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(12) NOT NULL,
  `origen` varchar(150) NOT NULL,
  `destino` varchar(150) NOT NULL,
  `tiempo` datetime DEFAULT NULL,
  `fecha` date NOT NULL,
  `comentarios` text,
  `status` tinyint(4) DEFAULT NULL,
  `coords_origen` varchar(150) DEFAULT NULL,
  `coords_destino` varchar(150) DEFAULT NULL,
  `fecha_entrega` timestamp NULL DEFAULT NULL,
  `imagen_carga_entregada` varchar(255) DEFAULT NULL,
  `firma_cliente` varchar(255) DEFAULT NULL,
  `cliente_id` int(12) NOT NULL,
  `comuna_origen_id` int(12) NOT NULL,
  `comuna_destino_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pedidos';

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `origen`, `destino`, `tiempo`, `fecha`, `comentarios`, `status`, `coords_origen`, `coords_destino`, `fecha_entrega`, `imagen_carga_entregada`, `firma_cliente`, `cliente_id`, `comuna_origen_id`, `comuna_destino_id`) VALUES
(1, 'origen revicion 11-12-17 edicion', 'destino revicion 11-12-17  edicion', '2017-12-17 18:27:00', '2017-12-15', 'revicion 11-12-17  edicion', 4, NULL, NULL, '2017-12-16 04:25:45', '/imagenes_cargas/nuevo_pedido.jpg', '/firmas/Firma_1.png', 2, 334, 99),
(2, 'pedido de empresa', 'destino de pedido de empresa', '2017-12-16 19:06:00', '2017-12-15', 'pedido de empresa', 3, NULL, NULL, NULL, NULL, NULL, 3, 38, 223);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id` int(12) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `num_comunas` int(11) NOT NULL,
  `region_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `nombre`, `num_comunas`, `region_id`) VALUES
(1, 'ARICA', 2, 1),
(2, 'PARINACOTA', 2, 1),
(3, 'IQUIQUE', 2, 2),
(4, 'TAMARUGAL', 5, 2),
(5, 'ANTOFAGASTA', 4, 3),
(6, 'EL LOA', 3, 3),
(7, 'TOCOPILLA', 2, 3),
(8, 'COPIAPÓ', 3, 4),
(9, 'CHAÑARAL', 2, 4),
(10, 'HUASCO', 4, 4),
(11, 'ELQUI', 6, 5),
(12, 'CHOAPA', 4, 5),
(13, 'LIMARÍ', 5, 5),
(14, 'VALPARAÍSO', 7, 6),
(15, 'ISLA DE PASCUA', 1, 6),
(16, 'LOS ANDES', 4, 6),
(17, 'PETORCA', 5, 6),
(18, 'QUILLOTA', 5, 6),
(19, 'SAN ANTONIO', 6, 6),
(20, 'SAN FELIPE DE ACONCAGUA', 6, 6),
(21, 'MARGA MARGA', 4, 6),
(22, 'CACHAPOAL', 17, 7),
(23, 'CARDENAL CARO', 6, 7),
(24, 'COLCHAGUA', 10, 7),
(25, 'TALCA', 10, 8),
(26, 'CAUQUENES', 3, 8),
(27, 'CURICÓ', 9, 8),
(28, 'LINARES', 8, 8),
(29, 'CONCEPCIÓN', 12, 9),
(30, 'ARAUCO', 7, 9),
(31, 'BIOBÍO', 14, 9),
(32, 'ÑUBLE', 21, 9),
(33, 'CAUTÍN', 21, 10),
(34, 'MALLECO', 11, 10),
(35, 'VALDIVIA', 8, 11),
(36, 'RANCO', 4, 11),
(37, 'LLANQUIHUE', 9, 12),
(38, 'CHILOÉ', 10, 12),
(39, 'OSORNO', 7, 12),
(40, 'PALENA', 4, 12),
(41, 'COIHAIQUE', 2, 13),
(42, 'AISÉN', 3, 13),
(43, 'CAPITÁN PRAT', 3, 13),
(44, 'GENERAL CARRERA', 2, 13),
(45, 'MAGALLANES', 4, 14),
(46, 'ANTÁRTICA CHILENA', 2, 14),
(47, 'TIERRA DEL FUEGO', 3, 14),
(48, 'ULTIMA ESPERANZA', 2, 14),
(49, 'SANTIAGO', 32, 15),
(50, 'CORDILLERA', 3, 15),
(51, 'CHACABUCO', 3, 15),
(52, 'MAIPO', 4, 15),
(53, 'MELIPILLA', 5, 15),
(54, 'TALAGANTE', 5, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id` int(12) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `romano` varchar(5) NOT NULL,
  `num_provincias` int(11) NOT NULL,
  `num_comunas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id`, `nombre`, `romano`, `num_provincias`, `num_comunas`) VALUES
(1, 'ARICA Y PARINACOTA', 'XV', 2, 4),
(2, 'TARAPACÁ', 'I', 2, 7),
(3, 'ANTOFAGASTA', 'II', 3, 9),
(4, 'ATACAMA ', 'III', 3, 9),
(5, 'COQUIMBO ', 'IV', 3, 15),
(6, 'VALPARAÍSO ', 'V', 8, 38),
(7, 'DEL LIBERTADOR GRAL. BERNARDO O\'HIGGINS ', 'VI', 3, 33),
(8, 'DEL MAULE', 'VII', 4, 30),
(9, 'DEL BIOBÍO ', 'VIII', 4, 54),
(10, 'DE LA ARAUCANÍA', 'IX', 2, 32),
(11, 'DE LOS RÍOS', 'XIV', 2, 12),
(12, 'DE LOS LAGOS', 'X', 4, 30),
(13, 'AISÉN DEL GRAL. CARLOS IBAÑEZ DEL CAMPO ', 'XI', 4, 10),
(14, 'MAGALLANES Y DE LA ANTÁRTICA CHILENA', 'XII', 4, 11),
(15, 'METROPOLITANA DE SANTIAGO', 'RM', 6, 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `id` int(11) NOT NULL,
  `lat` varchar(45) NOT NULL,
  `lng` varchar(45) NOT NULL,
  `oferta_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`id`, `lat`, `lng`, `oferta_id`) VALUES
(1, '7.771357200000001', '-72.22614659999999', 27),
(2, '7.781357200000001', '-72.22614659999999', 27),
(3, '7.791357200000001', '-72.22614659999999', 27),
(4, '7.771367200000001', '-72.22614659999999', 27),
(5, '7.771357200000001', '-72.22614659999999', 27),
(6, '7.771357200000001', '-72.22614659999999', 25),
(7, '7.771357200000001', '-72.22614659999999', 16),
(8, '7.814383800000001', '-72.4406087', 16),
(9, '7.814383800000001', '-72.4406087', 16),
(10, '7.831796000000001', '-72.442585', 19),
(11, '7.790297577198187', '-72.2277045249939', 16),
(12, '7.814383800000001', '-72.4406087', 31),
(13, '7.790297577198187', '-72.2277045249939', 28),
(14, '7.8184266', '-72.446214', 34),
(15, '7.818416699999998', '-72.44598289999999', 1),
(16, '7.818416699999998', '-72.44598289999999', 1),
(17, '7.814383800000001', '-72.4406087', 1),
(18, '7.814383800000001', '-72.4406087', 1),
(19, '7.8271497', '-72.4469999', 1),
(20, '7.814383800000001', '-72.4406087', 2),
(21, '7.814383800000001', '-72.4406087', 2),
(22, '7.814383800000001', '-72.4406087', 2),
(23, '7.814383800000001', '-72.4406087', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_calificacion_oferta1_idx` (`oferta_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_cliente_comuna1_idx` (`comuna_id`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comuna_provincia_idx` (`provincia_id`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_imagen_cliente1_idx` (`cliente_id`),
  ADD KEY `fk_imagen_pedido1_idx` (`pedido_id`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ofertas_pedido1_idx` (`pedido_id`),
  ADD KEY `fk_ofertas_cliente1_idx` (`cliente_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_cliente1_idx` (`cliente_id`),
  ADD KEY `fk_pedido_comuna1_idx` (`comuna_origen_id`),
  ADD KEY `fk_pedido_comuna2_idx` (`comuna_destino_id`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_provincia_region_idx` (`region_id`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ruta_oferta_idx` (`oferta_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `fk_calificacion_oferta1` FOREIGN KEY (`oferta_id`) REFERENCES `oferta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_comuna1` FOREIGN KEY (`comuna_id`) REFERENCES `comuna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `fk_comuna_provincia` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `fk_imagen_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_imagen_pedido1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `fk_ofertas_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ofertas_pedido1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_comuna1` FOREIGN KEY (`comuna_origen_id`) REFERENCES `comuna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_comuna2` FOREIGN KEY (`comuna_destino_id`) REFERENCES `comuna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `fk_provincia_region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD CONSTRAINT `fk_ruta_oferta` FOREIGN KEY (`oferta_id`) REFERENCES `oferta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
