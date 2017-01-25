# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.9)
# Base de datos: layolanda
# Tiempo de Generación: 2017-01-25 04:55:30 +0000
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
  PRIMARY KEY (`id`),
  KEY `fk_bill_user1_idx` (`user_id`),
  CONSTRAINT `fk_bill_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
	(4,1,'2017-01-20 00:00:00','Pintura'),
	(5,4,'2017-01-20 00:00:00','Óleo'),
	(6,1,'2017-01-20 00:00:00','Escultura'),
	(7,4,'2017-01-20 00:00:00','Acuarela'),
	(8,4,'2017-01-20 00:00:00','Acrílico'),
	(9,4,'2017-01-20 00:00:00','Gouche'),
	(10,4,'2017-01-20 00:00:00','Rotulador'),
	(11,4,'2017-01-20 00:00:00','Vitral'),
	(12,1,'2017-01-20 00:00:00','Dibujo'),
	(13,1,'2017-01-20 00:00:00','Grabado'),
	(14,1,'2017-01-20 00:00:00','Fotografía'),
	(15,1,'2017-01-20 00:00:00','Collage'),
	(16,1,'2017-01-20 00:00:00','Arte Digital');

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla country
# ------------------------------------------------------------

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;

INSERT INTO `country` (`id`, `description`)
VALUES
	(1,'Ecuador');

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
  PRIMARY KEY (`id`),
  KEY `fk_detail_bill1_idx` (`bill_id`),
  KEY `fk_detail_product_has_mesure_type1_idx` (`product_has_mesure_type_id`),
  CONSTRAINT `fk_detail_bill1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_product_has_mesure_type1` FOREIGN KEY (`product_has_mesure_type_id`) REFERENCES `product_has_mesure_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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



# Volcado de tabla picture
# ------------------------------------------------------------

DROP TABLE IF EXISTS `picture`;

CREATE TABLE `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_picture_product1_idx` (`product_id`),
  CONSTRAINT `fk_picture_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `picture` WRITE;
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;

INSERT INTO `picture` (`id`, `product_id`, `creation_date`, `description`)
VALUES
	(5,4,'2017-01-21 00:00:00','foto4.jpg'),
	(6,5,'2017-01-21 00:00:00','foto2.jpg'),
	(7,6,'2017-01-21 00:00:00','foto3.jpg'),
	(8,7,'2017-01-21 00:00:00','foto4.jpg'),
	(9,8,'2017-01-21 00:00:00','foto5.jpg'),
	(10,9,'2017-01-21 00:00:00','foto6.jpg'),
	(11,10,'2017-01-21 00:00:00','foto7.jpg'),
	(12,11,'2017-01-21 00:00:00','foto1.jpg'),
	(13,12,'2017-01-21 00:00:00','foto2.jpg'),
	(14,13,'2017-01-21 00:00:00','foto3.jpg'),
	(15,14,'2017-01-21 00:00:00','foto4.jpg'),
	(16,15,'2017-01-21 00:00:00','foto5.jpg'),
	(17,16,'2017-01-21 00:00:00','foto6.jpg'),
	(18,17,'2017-01-21 00:00:00','foto7.jpg'),
	(19,18,'2017-01-21 00:00:00','foto1.jpg'),
	(20,19,'2017-01-21 00:00:00','foto2.jpg'),
	(21,20,'2017-01-21 00:00:00','foto2.jpg'),
	(22,4,'2017-01-21 00:00:00','foto4-d.jpg'),
	(23,4,'2017-01-21 00:00:00','foto4-d2.jpg'),
	(24,4,'2017-01-21 00:00:00','foto4-d3.jpg'),
	(25,4,'2017-01-21 00:00:00','foto4-d4.jpg');

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

INSERT INTO `product` (`id`, `artist_id`, `category_id`, `creation_date`, `description`, `product_date`, `technique_id`, `material_id`, `flowing_id`, `support`, `title`)
VALUES
	(4,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 1'),
	(5,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 2'),
	(6,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 3'),
	(7,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 4'),
	(8,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 5'),
	(9,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 6'),
	(10,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 7'),
	(11,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 8'),
	(12,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 9'),
	(13,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 10'),
	(14,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 11'),
	(15,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 12'),
	(16,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 13'),
	(17,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 14'),
	(18,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 15'),
	(19,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 16'),
	(20,1,5,'2017-01-20 00:00:00','Mujeres de Colores </br> Years of the moon (1993)','2017-01-20',1,1,1,NULL,'Anita Aarons 17');

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
  PRIMARY KEY (`id`),
  KEY `fk_product_has_mesure_mesure1_idx` (`mesure_id`),
  KEY `fk_product_has_mesure_product1_idx` (`product_id`),
  KEY `fk_product_has_mesure_type1_idx` (`type_id`),
  CONSTRAINT `fk_product_has_mesure_mesure1` FOREIGN KEY (`mesure_id`) REFERENCES `mesure` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_has_mesure_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_has_mesure_type1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
	(3,'2017-01-24 16:26:39','frankpaul142@gmail.com','Franklin','Paula','1990-11-14','MALE','CLIENT','$2y$13$oXDX8ZMCOU96nittcDX7Fu3VsWn/12ZQAYrVIebracHXv5nBAjDL2','-zfRhEytHG1bdG0wZpv7bu4tC-ARyH7_','GPIOuYUaoWryKLtGs6sQBf0h3zSuB9pB_1485295008','ACTIVE');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
