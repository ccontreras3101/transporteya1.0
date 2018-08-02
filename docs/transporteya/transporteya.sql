-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2017 a las 01:30:49
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(12) NOT NULL,
  `rut` int(12) NOT NULL,
  `rut_add` int(4) NOT NULL,
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
  `tipo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Clientes contratantes';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `id` int(11) NOT NULL COMMENT 'ID unico de la comuna',
  `nombre` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Nombre descriptivo de la comuna',
  `provincia_id` int(11) NOT NULL COMMENT 'ID de la provincia asociada'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Lista de comunas por provincias';

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
(280, 'O''HIGGINS', 43),
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(12) NOT NULL,
  `origen` varchar(150) NOT NULL,
  `destino` varchar(150) NOT NULL,
  `tiempo` date NOT NULL,
  `fecha` date NOT NULL,
  `comentarios` text,
  `status` tinyint(4) DEFAULT NULL,
  `coords_origen` varchar(150) DEFAULT NULL,
  `coords_destino` varchar(150) DEFAULT NULL,
  `cliente_id` int(12) NOT NULL,
  `comuna_origen_id` int(12) NOT NULL,
  `comuna_destino_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pedidos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id` int(11) NOT NULL COMMENT 'ID provincia',
  `region_id` int(11) NOT NULL COMMENT 'ID region asociada',
  `nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre descriptivo',
  `num_comunas` int(11) NOT NULL COMMENT 'Numero de comunas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Lista de comunas por regiones';

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `region_id`, `nombre`, `num_comunas`) VALUES
(1, 1, 'ARICA', 2),
(2, 1, 'PARINACOTA', 2),
(3, 2, 'IQUIQUE', 2),
(4, 2, 'TAMARUGAL', 5),
(5, 3, 'ANTOFAGASTA', 4),
(6, 3, 'EL LOA', 3),
(7, 3, 'TOCOPILLA', 2),
(8, 4, 'COPIAPÓ', 3),
(9, 4, 'CHAÑARAL', 2),
(10, 4, 'HUASCO', 4),
(11, 5, 'ELQUI', 6),
(12, 5, 'CHOAPA', 4),
(13, 5, 'LIMARÍ', 5),
(14, 6, 'VALPARAÍSO', 7),
(15, 6, 'ISLA DE PASCUA', 1),
(16, 6, 'LOS ANDES', 4),
(17, 6, 'PETORCA', 5),
(18, 6, 'QUILLOTA', 5),
(19, 6, 'SAN ANTONIO', 6),
(20, 6, 'SAN FELIPE DE ACONCAGUA', 6),
(21, 6, 'MARGA MARGA', 4),
(22, 7, 'CACHAPOAL', 17),
(23, 7, 'CARDENAL CARO', 6),
(24, 7, 'COLCHAGUA', 10),
(25, 8, 'TALCA', 10),
(26, 8, 'CAUQUENES', 3),
(27, 8, 'CURICÓ', 9),
(28, 8, 'LINARES', 8),
(29, 9, 'CONCEPCIÓN', 12),
(30, 9, 'ARAUCO', 7),
(31, 9, 'BIOBÍO', 14),
(32, 9, 'ÑUBLE', 21),
(33, 10, 'CAUTÍN', 21),
(34, 10, 'MALLECO', 11),
(35, 11, 'VALDIVIA', 8),
(36, 11, 'RANCO', 4),
(37, 12, 'LLANQUIHUE', 9),
(38, 12, 'CHILOÉ', 10),
(39, 12, 'OSORNO', 7),
(40, 12, 'PALENA', 4),
(41, 13, 'COIHAIQUE', 2),
(42, 13, 'AISÉN', 3),
(43, 13, 'CAPITÁN PRAT', 3),
(44, 13, 'GENERAL CARRERA', 2),
(45, 14, 'MAGALLANES', 4),
(46, 14, 'ANTÁRTICA CHILENA', 2),
(47, 14, 'TIERRA DEL FUEGO', 3),
(48, 14, 'ULTIMA ESPERANZA', 2),
(49, 15, 'SANTIAGO', 32),
(50, 15, 'CORDILLERA', 3),
(51, 15, 'CHACABUCO', 3),
(52, 15, 'MAIPO', 4),
(53, 15, 'MELIPILLA', 5),
(54, 15, 'TALAGANTE', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL COMMENT 'ID unico',
  `nombre` varchar(60) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre extenso',
  `romano` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Número de región',
  `num_provincias` int(11) NOT NULL COMMENT 'total provincias',
  `num_comunas` int(11) NOT NULL COMMENT 'Total de comunas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Lista de regiones de Chile';

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
(7, 'DEL LIBERTADOR GRAL. BERNARDO O''HIGGINS ', 'VI', 3, 33),
(8, 'DEL MAULE', 'VII', 4, 30),
(9, 'DEL BIOBÍO ', 'VIII', 4, 54),
(10, 'DE LA ARAUCANÍA', 'IX', 2, 32),
(11, 'DE LOS RÍOS', 'XIV', 2, 12),
(12, 'DE LOS LAGOS', 'X', 4, 30),
(13, 'AISÉN DEL GRAL. CARLOS IBAÑEZ DEL CAMPO ', 'XI', 4, 10),
(14, 'MAGALLANES Y DE LA ANTÁRTICA CHILENA', 'XII', 4, 11),
(15, 'METROPOLITANA DE SANTIAGO', 'RM', 6, 52);

--
-- Índices para tablas volcadas
--

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
  ADD KEY `provincia_id` (`provincia_id`);

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
  ADD KEY `region_id` (`region_id`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID unico de la comuna', AUTO_INCREMENT=347;
--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`comuna_id`) REFERENCES `comuna` (`id`);

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `comuna_ibfk_1` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`);

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
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`comuna_origen_id`) REFERENCES `comuna` (`id`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`comuna_destino_id`) REFERENCES `comuna` (`id`);

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
