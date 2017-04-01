# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.17)
# Base de datos: layolanda
# Tiempo de Generación: 2017-04-01 16:11:51 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla address
# ------------------------------------------------------------

DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `type` enum('BILLING','DELIVERY','BILLING-DELIVERY') NOT NULL,
  `creation_date` datetime NOT NULL,
  `city` varchar(150) NOT NULL,
  `province` varchar(150) NOT NULL,
  `country_id` int(11) NOT NULL,
  `zip` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_address_country1_idx` (`country_id`),
  KEY `fk_address_user1_idx` (`user_id`),
  CONSTRAINT `fk_address_country1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_address_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;

INSERT INTO `address` (`id`, `address_line_1`, `address_line_2`, `type`, `creation_date`, `city`, `province`, `country_id`, `zip`, `phone`, `user_id`)
VALUES
	(1,'Rio Rumiyacu N71-144 y Juan Procel','Casa 3 pisos blanca bordes naranjas','BILLING','2017-02-01 00:01:21','Quito','Pichincha',1,'EC170305','022495310',3),
	(3,'Rio Rumiyacu N71-144 y Juan Procel','Casa 3 pisos blanca bordes naranjas','DELIVERY','2017-02-01 00:01:21','Quito','Pichincha',1,'EC170305','022495310',3);

/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla artist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `artist`;

CREATE TABLE `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` datetime NOT NULL,
  `name` varchar(150) NOT NULL,
  `birthday` date NOT NULL,
  `death_date` date DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_artist_country1_idx` (`country_id`),
  CONSTRAINT `fk_artist_country1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `artist` WRITE;
/*!40000 ALTER TABLE `artist` DISABLE KEYS */;

INSERT INTO `artist` (`id`, `creation_date`, `name`, `birthday`, `death_date`, `country_id`)
VALUES
	(1,'2017-01-20 00:00:00','Franklin Paula','1990-11-14',NULL,1);

/*!40000 ALTER TABLE `artist` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla bill
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bill`;

CREATE TABLE `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `billing_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `status` enum('PAYED','FAILED','PENDING') NOT NULL DEFAULT 'PENDING',
  `observation` text,
  `subtotal` double(10,2) DEFAULT NULL,
  `pay_method` enum('PAYPAL') DEFAULT 'PAYPAL',
  PRIMARY KEY (`id`),
  KEY `fk_bill_user1_idx` (`user_id`),
  KEY `fk_bill_baddress` (`billing_id`),
  KEY `fk_bill_daddress` (`delivery_id`),
  CONSTRAINT `fk_bill_baddress` FOREIGN KEY (`billing_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bill_daddress` FOREIGN KEY (`delivery_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bill_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;

INSERT INTO `bill` (`id`, `user_id`, `creation_date`, `billing_id`, `delivery_id`, `status`, `observation`, `subtotal`, `pay_method`)
VALUES
	(5,3,'2017-02-01 23:02:50',1,3,'PENDING','',150.00,'PAYPAL'),
	(6,3,'2017-02-01 23:04:39',1,3,'PENDING','',150.00,'PAYPAL'),
	(7,3,'2017-02-01 23:05:34',1,3,'PAYED','',150.00,'PAYPAL'),
	(8,3,'2017-02-01 23:08:01',1,3,'PENDING','',150.00,'PAYPAL'),
	(9,3,'2017-02-01 23:15:02',1,3,'PENDING','',273.00,'PAYPAL'),
	(10,3,'2017-02-01 23:26:10',1,3,'PENDING','',273.00,'PAYPAL'),
	(11,3,'2017-02-02 23:43:30',1,3,'PENDING','',273.00,'PAYPAL'),
	(12,3,'2017-02-02 23:43:57',1,3,'PENDING','',273.00,'PAYPAL'),
	(13,3,'2017-02-02 23:54:39',1,3,'PENDING','',423.00,'PAYPAL');

/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_category_idx` (`category_id`),
  CONSTRAINT `fk_category_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`id`, `category_id`, `creation_date`, `description`)
VALUES
	(1,NULL,'2017-01-20 00:00:00','ARTE'),
	(2,NULL,'2017-01-20 00:00:00','ARTESANIA FINA'),
	(3,NULL,'2017-01-20 00:00:00','NUEVA COLECCIÓN'),
	(4,1,'2017-01-20 00:00:00','Arte'),
	(5,4,'2017-01-20 00:00:00','Figurativa'),
	(6,1,'2017-01-20 00:00:00','Pintura'),
	(7,4,'2017-01-20 00:00:00','Abstracta'),
	(8,4,'2017-01-20 00:00:00','Conceptual'),
	(12,1,'2017-01-20 00:00:00','Abstracta');

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;

INSERT INTO `content` (`id`, `title`, `description`)
VALUES
	(1,'Envío','<p>lkasdljads</p>'),
	(2,'Contáctenos','<p>adasdasd</p>'),
	(3,'¿Cómo Llegar?','<p>asdasdasd</p>'),
	(4,'Políticas de Privacidad','<p>adsklasdads</p>'),
	(5,'Términos y Condiciones de Compra','<p>hkjaskjhdas</p>');

/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla country
# ------------------------------------------------------------

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) DEFAULT NULL,
  `country_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;

INSERT INTO `country` (`id`, `country_code`, `country_name`)
VALUES
	(1,'EC','Ecuador'),
	(2,'AF','Afghanistan'),
	(3,'AL','Albania'),
	(4,'DZ','Algeria'),
	(5,'DS','American Samoa'),
	(6,'AD','Andorra'),
	(7,'AO','Angola'),
	(8,'AI','Anguilla'),
	(9,'AQ','Antarctica'),
	(10,'AG','Antigua and Barbuda'),
	(11,'AR','Argentina'),
	(12,'AM','Armenia'),
	(13,'AW','Aruba'),
	(14,'AU','Australia'),
	(15,'AT','Austria'),
	(16,'AZ','Azerbaijan'),
	(17,'BS','Bahamas'),
	(18,'BH','Bahrain'),
	(19,'BD','Bangladesh'),
	(20,'BB','Barbados'),
	(21,'BY','Belarus'),
	(22,'BE','Belgium'),
	(23,'BZ','Belize'),
	(24,'BJ','Benin'),
	(25,'BM','Bermuda'),
	(26,'BT','Bhutan'),
	(27,'BO','Bolivia'),
	(28,'BA','Bosnia and Herzegovina'),
	(29,'BW','Botswana'),
	(30,'BV','Bouvet Island'),
	(31,'BR','Brazil'),
	(32,'IO','British Indian Ocean Territory'),
	(33,'BN','Brunei Darussalam'),
	(34,'BG','Bulgaria'),
	(35,'BF','Burkina Faso'),
	(36,'BI','Burundi'),
	(37,'KH','Cambodia'),
	(38,'CM','Cameroon'),
	(39,'CA','Canada'),
	(40,'CV','Cape Verde'),
	(41,'KY','Cayman Islands'),
	(42,'CF','Central African Republic'),
	(43,'TD','Chad'),
	(44,'CL','Chile'),
	(45,'CN','China'),
	(46,'CX','Christmas Island'),
	(47,'CC','Cocos (Keeling) Islands'),
	(48,'CO','Colombia'),
	(49,'KM','Comoros'),
	(50,'CG','Congo'),
	(51,'CK','Cook Islands'),
	(52,'CR','Costa Rica'),
	(53,'HR','Croatia (Hrvatska)'),
	(54,'CU','Cuba'),
	(55,'CY','Cyprus'),
	(56,'CZ','Czech Republic'),
	(57,'DK','Denmark'),
	(58,'DJ','Djibouti'),
	(59,'DM','Dominica'),
	(60,'DO','Dominican Republic'),
	(61,'TP','East Timor'),
	(63,'EG','Egypt'),
	(64,'SV','El Salvador'),
	(65,'GQ','Equatorial Guinea'),
	(66,'ER','Eritrea'),
	(67,'EE','Estonia'),
	(68,'ET','Ethiopia'),
	(69,'FK','Falkland Islands (Malvinas)'),
	(70,'FO','Faroe Islands'),
	(71,'FJ','Fiji'),
	(72,'FI','Finland'),
	(73,'FR','France'),
	(74,'FX','France, Metropolitan'),
	(75,'GF','French Guiana'),
	(76,'PF','French Polynesia'),
	(77,'TF','French Southern Territories'),
	(78,'GA','Gabon'),
	(79,'GM','Gambia'),
	(80,'GE','Georgia'),
	(81,'DE','Germany'),
	(82,'GH','Ghana'),
	(83,'GI','Gibraltar'),
	(84,'GK','Guernsey'),
	(85,'GR','Greece'),
	(86,'GL','Greenland'),
	(87,'GD','Grenada'),
	(88,'GP','Guadeloupe'),
	(89,'GU','Guam'),
	(90,'GT','Guatemala'),
	(91,'GN','Guinea'),
	(92,'GW','Guinea-Bissau'),
	(93,'GY','Guyana'),
	(94,'HT','Haiti'),
	(95,'HM','Heard and Mc Donald Islands'),
	(96,'HN','Honduras'),
	(97,'HK','Hong Kong'),
	(98,'HU','Hungary'),
	(99,'IS','Iceland'),
	(100,'IN','India'),
	(101,'IM','Isle of Man'),
	(102,'ID','Indonesia'),
	(103,'IR','Iran (Islamic Republic of)'),
	(104,'IQ','Iraq'),
	(105,'IE','Ireland'),
	(106,'IL','Israel'),
	(107,'IT','Italy'),
	(108,'CI','Ivory Coast'),
	(109,'JE','Jersey'),
	(110,'JM','Jamaica'),
	(111,'JP','Japan'),
	(112,'JO','Jordan'),
	(113,'KZ','Kazakhstan'),
	(114,'KE','Kenya'),
	(115,'KI','Kiribati'),
	(116,'KP','Korea, Democratic People\'s Republic of'),
	(117,'KR','Korea, Republic of'),
	(118,'XK','Kosovo'),
	(119,'KW','Kuwait'),
	(120,'KG','Kyrgyzstan'),
	(121,'LA','Lao People\'s Democratic Republic'),
	(122,'LV','Latvia'),
	(123,'LB','Lebanon'),
	(124,'LS','Lesotho'),
	(125,'LR','Liberia'),
	(126,'LY','Libyan Arab Jamahiriya'),
	(127,'LI','Liechtenstein'),
	(128,'LT','Lithuania'),
	(129,'LU','Luxembourg'),
	(130,'MO','Macau'),
	(131,'MK','Macedonia'),
	(132,'MG','Madagascar'),
	(133,'MW','Malawi'),
	(134,'MY','Malaysia'),
	(135,'MV','Maldives'),
	(136,'ML','Mali'),
	(137,'MT','Malta'),
	(138,'MH','Marshall Islands'),
	(139,'MQ','Martinique'),
	(140,'MR','Mauritania'),
	(141,'MU','Mauritius'),
	(142,'TY','Mayotte'),
	(143,'MX','Mexico'),
	(144,'FM','Micronesia, Federated States of'),
	(145,'MD','Moldova, Republic of'),
	(146,'MC','Monaco'),
	(147,'MN','Mongolia'),
	(148,'ME','Montenegro'),
	(149,'MS','Montserrat'),
	(150,'MA','Morocco'),
	(151,'MZ','Mozambique'),
	(152,'MM','Myanmar'),
	(153,'NA','Namibia'),
	(154,'NR','Nauru'),
	(155,'NP','Nepal'),
	(156,'NL','Netherlands'),
	(157,'AN','Netherlands Antilles'),
	(158,'NC','New Caledonia'),
	(159,'NZ','New Zealand'),
	(160,'NI','Nicaragua'),
	(161,'NE','Niger'),
	(162,'NG','Nigeria'),
	(163,'NU','Niue'),
	(164,'NF','Norfolk Island'),
	(165,'MP','Northern Mariana Islands'),
	(166,'NO','Norway'),
	(167,'OM','Oman'),
	(168,'PK','Pakistan'),
	(169,'PW','Palau'),
	(170,'PS','Palestine'),
	(171,'PA','Panama'),
	(172,'PG','Papua New Guinea'),
	(173,'PY','Paraguay'),
	(174,'PE','Peru'),
	(175,'PH','Philippines'),
	(176,'PN','Pitcairn'),
	(177,'PL','Poland'),
	(178,'PT','Portugal'),
	(179,'PR','Puerto Rico'),
	(180,'QA','Qatar'),
	(181,'RE','Reunion'),
	(182,'RO','Romania'),
	(183,'RU','Russian Federation'),
	(184,'RW','Rwanda'),
	(185,'KN','Saint Kitts and Nevis'),
	(186,'LC','Saint Lucia'),
	(187,'VC','Saint Vincent and the Grenadines'),
	(188,'WS','Samoa'),
	(189,'SM','San Marino'),
	(190,'ST','Sao Tome and Principe'),
	(191,'SA','Saudi Arabia'),
	(192,'SN','Senegal'),
	(193,'RS','Serbia'),
	(194,'SC','Seychelles'),
	(195,'SL','Sierra Leone'),
	(196,'SG','Singapore'),
	(197,'SK','Slovakia'),
	(198,'SI','Slovenia'),
	(199,'SB','Solomon Islands'),
	(200,'SO','Somalia'),
	(201,'ZA','South Africa'),
	(202,'GS','South Georgia South Sandwich Islands'),
	(203,'ES','Spain'),
	(204,'LK','Sri Lanka'),
	(205,'SH','St. Helena'),
	(206,'PM','St. Pierre and Miquelon'),
	(207,'SD','Sudan'),
	(208,'SR','Suriname'),
	(209,'SJ','Svalbard and Jan Mayen Islands'),
	(210,'SZ','Swaziland'),
	(211,'SE','Sweden'),
	(212,'CH','Switzerland'),
	(213,'SY','Syrian Arab Republic'),
	(214,'TW','Taiwan'),
	(215,'TJ','Tajikistan'),
	(216,'TZ','Tanzania, United Republic of'),
	(217,'TH','Thailand'),
	(218,'TG','Togo'),
	(219,'TK','Tokelau'),
	(220,'TO','Tonga'),
	(221,'TT','Trinidad and Tobago'),
	(222,'TN','Tunisia'),
	(223,'TR','Turkey'),
	(224,'TM','Turkmenistan'),
	(225,'TC','Turks and Caicos Islands'),
	(226,'TV','Tuvalu'),
	(227,'UG','Uganda'),
	(228,'UA','Ukraine'),
	(229,'AE','United Arab Emirates'),
	(230,'GB','United Kingdom'),
	(231,'US','United States'),
	(232,'UM','United States minor outlying islands'),
	(233,'UY','Uruguay'),
	(234,'UZ','Uzbekistan'),
	(235,'VU','Vanuatu'),
	(236,'VA','Vatican City State'),
	(237,'VE','Venezuela'),
	(238,'VN','Vietnam'),
	(239,'VG','Virgin Islands (British)'),
	(240,'VI','Virgin Islands (U.S.)'),
	(241,'WF','Wallis and Futuna Islands'),
	(242,'EH','Western Sahara'),
	(243,'YE','Yemen'),
	(244,'ZR','Zaire'),
	(245,'ZM','Zambia'),
	(246,'ZW','Zimbabwe');

/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `detail`;

CREATE TABLE `detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `product_has_mesure_type_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `price` double(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detail_bill1_idx` (`bill_id`),
  KEY `fk_detail_product_has_mesure_type1_idx` (`product_has_mesure_type_id`),
  CONSTRAINT `fk_detail_bill1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_product_has_mesure_type1` FOREIGN KEY (`product_has_mesure_type_id`) REFERENCES `product_has_mesure_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `detail` WRITE;
/*!40000 ALTER TABLE `detail` DISABLE KEYS */;

INSERT INTO `detail` (`id`, `bill_id`, `product_has_mesure_type_id`, `creation_date`, `price`)
VALUES
	(1,5,1,'2017-02-01 23:02:50',150.00),
	(3,7,1,'2017-02-01 23:05:34',150.00),
	(4,8,1,'2017-02-01 23:08:01',150.00),
	(5,9,1,'2017-02-01 23:15:02',150.00),
	(6,5,6,'2017-02-01 23:15:02',123.00),
	(7,10,1,'2017-02-01 23:26:10',150.00),
	(8,10,6,'2017-02-01 23:26:10',123.00),
	(9,11,1,'2017-02-02 23:43:30',150.00),
	(10,11,6,'2017-02-02 23:43:30',123.00),
	(11,12,1,'2017-02-02 23:43:57',150.00),
	(12,12,6,'2017-02-02 23:43:57',123.00),
	(13,13,1,'2017-02-02 23:54:39',150.00),
	(14,13,6,'2017-02-02 23:54:39',123.00);

/*!40000 ALTER TABLE `detail` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla flowing
# ------------------------------------------------------------

DROP TABLE IF EXISTS `flowing`;

CREATE TABLE `flowing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` datetime NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `flowing` WRITE;
/*!40000 ALTER TABLE `flowing` DISABLE KEYS */;

INSERT INTO `flowing` (`id`, `creation_date`, `description`)
VALUES
	(1,'2017-01-20 00:00:00','Corriente');

/*!40000 ALTER TABLE `flowing` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla material
# ------------------------------------------------------------

DROP TABLE IF EXISTS `material`;

CREATE TABLE `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` datetime NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;

INSERT INTO `material` (`id`, `creation_date`, `description`)
VALUES
	(1,'2917-01-20 00:00:00','Barro, Cerámica');

/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla mesure
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mesure`;

CREATE TABLE `mesure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` datetime NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `mesure` WRITE;
/*!40000 ALTER TABLE `mesure` DISABLE KEYS */;

INSERT INTO `mesure` (`id`, `creation_date`, `description`)
VALUES
	(1,'2017-01-26 00:00:00','42.92 x 30.00 cm');

/*!40000 ALTER TABLE `mesure` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla picture
# ------------------------------------------------------------

DROP TABLE IF EXISTS `picture`;

CREATE TABLE `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `description` varchar(150) NOT NULL,
  `sort` varchar(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_picture_product1_idx` (`product_id`),
  CONSTRAINT `fk_picture_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `picture` WRITE;
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;

INSERT INTO `picture` (`id`, `product_id`, `creation_date`, `description`, `sort`)
VALUES
	(5,4,'2017-01-21 00:00:00','foto4.jpg','7'),
	(6,5,'2017-01-21 00:00:00','foto2.jpg','0'),
	(7,6,'2017-01-21 00:00:00','foto3.jpg','0'),
	(8,7,'2017-01-21 00:00:00','foto4.jpg','0'),
	(9,8,'2017-01-21 00:00:00','foto5.jpg','0'),
	(10,9,'2017-01-21 00:00:00','foto6.jpg','0'),
	(11,10,'2017-01-21 00:00:00','foto7.jpg','0'),
	(12,11,'2017-01-21 00:00:00','foto1.jpg','0'),
	(13,12,'2017-01-21 00:00:00','foto2.jpg','0'),
	(14,13,'2017-01-21 00:00:00','foto3.jpg','0'),
	(15,14,'2017-01-21 00:00:00','foto4.jpg','0'),
	(16,15,'2017-01-21 00:00:00','foto5.jpg','0'),
	(17,16,'2017-01-21 00:00:00','foto6.jpg','0'),
	(18,17,'2017-01-21 00:00:00','foto7.jpg','0'),
	(19,18,'2017-01-21 00:00:00','foto1.jpg','0'),
	(20,19,'2017-01-21 00:00:00','foto2.jpg','0'),
	(21,20,'2017-01-21 00:00:00','foto2.jpg','0'),
	(22,4,'2017-01-21 00:00:00','foto4-d.jpg','1'),
	(23,4,'2017-01-21 00:00:00','foto4-d2.jpg','2'),
	(24,4,'2017-01-21 00:00:00','foto4-d3.jpg','3'),
	(25,4,'2017-01-21 00:00:00','foto4-d4.jpg','4');

/*!40000 ALTER TABLE `picture` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `product_date` date DEFAULT NULL,
  `technique_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `flowing_id` int(11) NOT NULL,
  `support` varchar(45) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `important` enum('YES','NO') DEFAULT 'NO',
  `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`),
  KEY `fk_product_artist1_idx` (`artist_id`),
  KEY `fk_product_category1_idx` (`category_id`),
  KEY `fk_product_technique1_idx` (`technique_id`),
  KEY `fk_product_material1_idx` (`material_id`),
  KEY `fk_product_flowing1_idx` (`flowing_id`),
  CONSTRAINT `fk_product_artist1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_flowing1` FOREIGN KEY (`flowing_id`) REFERENCES `flowing` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_material1` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_technique1` FOREIGN KEY (`technique_id`) REFERENCES `technique` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;

INSERT INTO `product` (`id`, `artist_id`, `category_id`, `creation_date`, `description`, `product_date`, `technique_id`, `material_id`, `flowing_id`, `support`, `title`, `important`, `status`)
VALUES
	(4,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 1','YES','ACTIVE'),
	(5,1,7,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 2','YES','ACTIVE'),
	(6,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 3','YES','ACTIVE'),
	(7,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 4','NO','ACTIVE'),
	(8,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 5','NO','ACTIVE'),
	(9,1,7,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 6','NO','ACTIVE'),
	(10,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 7','NO','ACTIVE'),
	(11,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 8','NO','ACTIVE'),
	(12,1,7,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 9','NO','ACTIVE'),
	(13,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 10','NO','ACTIVE'),
	(14,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 11','NO','ACTIVE'),
	(15,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 12','NO','ACTIVE'),
	(16,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 13','NO','ACTIVE'),
	(17,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 14','NO','ACTIVE'),
	(18,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 15','NO','ACTIVE'),
	(19,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 16','NO','ACTIVE'),
	(20,1,5,'2017-01-20 00:00:00','            <li>\n            Papel estandar sin enmarcar\n            </li>\n            <li>\n              Papel fotográfico RC de alta resolución,\n              mínimo de 240 gr / m2 acabado brillo.\n          </li>\n            <li>\n              Margen si','2017-01-20',1,1,1,NULL,'Anita Aarons 17','NO','ACTIVE');

/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla product_has_mesure_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_has_mesure_type`;

CREATE TABLE `product_has_mesure_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `mesure_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `type_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `size` enum('S','M','L') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_has_mesure_mesure1_idx` (`mesure_id`),
  KEY `fk_product_has_mesure_product1_idx` (`product_id`),
  KEY `fk_product_has_mesure_type1_idx` (`type_id`),
  CONSTRAINT `fk_product_has_mesure_mesure1` FOREIGN KEY (`mesure_id`) REFERENCES `mesure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_has_mesure_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_has_mesure_type1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_has_mesure_type` WRITE;
/*!40000 ALTER TABLE `product_has_mesure_type` DISABLE KEYS */;

INSERT INTO `product_has_mesure_type` (`id`, `product_id`, `mesure_id`, `price`, `type_id`, `creation_date`, `size`)
VALUES
	(1,4,1,150,1,'2017-01-26 00:00:00','S'),
	(2,4,1,300,2,'2017-01-26 00:00:00','S'),
	(3,6,1,123,1,'2017-01-26 00:00:00','S'),
	(4,7,1,4141,1,'2017-01-26 00:00:00','S'),
	(5,8,1,1231,1,'2017-01-26 00:00:00','S'),
	(6,9,1,123,1,'2017-01-26 00:00:00','S'),
	(7,10,1,1255,1,'2017-01-26 00:00:00','S'),
	(8,6,1,300,2,'2017-01-26 00:00:00','S'),
	(9,6,1,150,1,'2017-01-26 00:00:00','S');

/*!40000 ALTER TABLE `product_has_mesure_type` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla technique
# ------------------------------------------------------------

DROP TABLE IF EXISTS `technique`;

CREATE TABLE `technique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` datetime NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `technique` WRITE;
/*!40000 ALTER TABLE `technique` DISABLE KEYS */;

INSERT INTO `technique` (`id`, `creation_date`, `description`)
VALUES
	(1,'2017-01-20 00:00:00','Técnica');

/*!40000 ALTER TABLE `technique` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `type`;

CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` datetime NOT NULL,
  `description` varchar(250) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;

INSERT INTO `type` (`id`, `creation_date`, `description`, `title`)
VALUES
	(1,'2017-01-26 00:00:00','ORIGINAL','ORIGINAL'),
	(2,'2017-01-26 00:00:00','LAMINA','LAMINA'),
	(3,'2017-01-26 00:00:00','EDICIÓN LIMITADA','EDICIÓN LIMITADA');

/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` datetime NOT NULL,
  `username` varchar(150) NOT NULL DEFAULT '',
  `names` varchar(150) NOT NULL,
  `lastnames` varchar(150) NOT NULL,
  `birthday` date NOT NULL,
  `sex` enum('MALE','FEMALE') NOT NULL,
  `type` enum('CLIENT','ADMIN') NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') DEFAULT 'INACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `creation_date`, `username`, `names`, `lastnames`, `birthday`, `sex`, `type`, `password`, `auth_key`, `password_reset_token`, `status`)
VALUES
	(3,'2017-01-24 16:26:39','frankpaul142@gmail.com','Franklin','Paula','1990-11-14','MALE','ADMIN','$2y$13$oXDX8ZMCOU96nittcDX7Fu3VsWn/12ZQAYrVIebracHXv5nBAjDL2','-zfRhEytHG1bdG0wZpv7bu4tC-ARyH7_','GPIOuYUaoWryKLtGs6sQBf0h3zSuB9pB_1485295008','ACTIVE');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
