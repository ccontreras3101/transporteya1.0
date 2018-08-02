/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region` (
  `id` int(11) NOT NULL COMMENT 'ID unico',
  `nombre` varchar(60) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre extenso',
  `romano` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Número de región',
  `num_provincias` int(11) NOT NULL COMMENT 'total provincias',
  `num_comunas` int(11) NOT NULL COMMENT 'Total de comunas',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Lista de regiones de Chile';

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES 	(1,'ARICA Y PARINACOTA','XV',2,4),
				(2,'TARAPACÁ','I',2,7),
				(3,'ANTOFAGASTA','II',3,9),
				(4,'ATACAMA ','III',3,9),
				(5,'COQUIMBO ','IV',3,15),
				(6,'VALPARAÍSO ','V',8,38),
				(7,'DEL LIBERTADOR GRAL. BERNARDO O\'HIGGINS ','VI',3,33),
				(8,'DEL MAULE','VII',4,30),
				(9,'DEL BIOBÍO ','VIII',4,54),
				(10,'DE LA ARAUCANÍA','IX',2,32),
				(11,'DE LOS RÍOS','XIV',2,12),
				(12,'DE LOS LAGOS','X',4,30),
				(13,'AISÉN DEL GRAL. CARLOS IBAÑEZ DEL CAMPO ','XI',4,10),
				(14,'MAGALLANES Y DE LA ANTÁRTICA CHILENA','XII',4,11),
				(15,'METROPOLITANA DE SANTIAGO','RM',6,52);