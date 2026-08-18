/*
SQLyog Community v13.1.5  (32 bit)
MySQL - 10.4.32-MariaDB : Database - greenzoneguard
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`greenzoneguard` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `greenzoneguard`;

/*Table structure for table `administracion` */

DROP TABLE IF EXISTS `administracion`;

CREATE TABLE `administracion` (
  `Documento_Administrador` varchar(50) NOT NULL,
  `Nombre_Administrador` varchar(50) NOT NULL,
  `Apellido_Administrador` varchar(50) NOT NULL,
  `Contraseña` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Documento_Administrador`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `administracion` */

insert  into `administracion`(`Documento_Administrador`,`Nombre_Administrador`,`Apellido_Administrador`,`Contraseña`,`Email`,`Fecha_Registro`) values 
('1','Luis','Contreras','$2y$10$4QHVlhQj5CwrmLMq9IjS8.QyGPfhkUUm5/4I09q4i7vxGglqLMLiG','luis@gmail.com','2024-11-28 08:23:24'),
('2','Raul','Gascar','$2y$10$Vnur0HdBueH5CPelmi5Bg.tHtJSm3JHng2t/uqsnVXHpkLka2teom','Raul@gmail.com','2024-11-28 08:26:44'),
('3','Albeiro','Duran','$2y$10$7sLwxd.c4EiWoOyXR.ZJJ.nMEddadsEMxkhYsjzuEMGgTZpwDo/Vm','Albeiro@gmail.com','2024-11-28 08:27:15');

/*Table structure for table `contactos` */

DROP TABLE IF EXISTS `contactos`;

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documento` varchar(255) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `respuesta` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contactos_usuario` (`documento`),
  CONSTRAINT `fk_contactos_usuario` FOREIGN KEY (`documento`) REFERENCES `usuario` (`Documento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `contactos` */

insert  into `contactos`(`id`,`documento`,`nombre`,`apellido`,`email`,`mensaje`,`fecha`,`respuesta`) values 
(7,'235','Luis','Contreras','Luisrodolfo@gmail.com','Hola','2025-04-22 08:08:57',NULL);

/*Table structure for table `eventos` */

DROP TABLE IF EXISTS `eventos`;

CREATE TABLE `eventos` (
  `Codigo_Evento` varchar(50) NOT NULL,
  `Nombre_Evento` varchar(255) NOT NULL,
  `Descripcion_Evento` text NOT NULL,
  `Fecha_Evento` date NOT NULL,
  `Ubicacion_Evento` varchar(255) NOT NULL,
  `Puntos` varchar(255) DEFAULT NULL,
  `Hora_Evento` time NOT NULL,
  PRIMARY KEY (`Codigo_Evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `eventos` */

insert  into `eventos`(`Codigo_Evento`,`Nombre_Evento`,`Descripcion_Evento`,`Fecha_Evento`,`Ubicacion_Evento`,`Puntos`,`Hora_Evento`) values 
('1','Limpieza','Se realizara una limpieza al parque','2024-11-19','carrera 18','200','14:40:00'),
('2','Pintar','Limpiar el parque','2024-11-22','carrera 18','300','21:00:00'),
('3','Sembrar arboles','Se realizara una siembra de arboles','2024-11-27','Cra 20 No. 32','300','17:00:00');

/*Table structure for table `historial_participacion` */

DROP TABLE IF EXISTS `historial_participacion`;

CREATE TABLE `historial_participacion` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `Documento` varchar(255) NOT NULL,
  `Nombre_Usuario` varchar(255) NOT NULL,
  `Nombre_Evento` varchar(255) NOT NULL,
  `puntos` int(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `historial_participacion` */

/*Table structure for table `informacion` */

DROP TABLE IF EXISTS `informacion`;

CREATE TABLE `informacion` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(255) NOT NULL,
  `Mensaje` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `informacion` */

insert  into `informacion`(`Id`,`Titulo`,`Mensaje`) values 
(1,' Protege Hoy, Disfruta Mañana: Cuidemos Nuestro Entorno','Cuidar el medio ambiente no es una tarea de unos pocos, es una responsabilidad compartida. Desde acciones simples como reciclar, ahorrar agua y energía, hasta participar en actividades de reforestación o limpieza de espacios naturales, cada pequeño gesto ');

/*Table structure for table `participacion` */

DROP TABLE IF EXISTS `participacion`;

CREATE TABLE `participacion` (
  `Id_Participacion` int(10) NOT NULL AUTO_INCREMENT,
  `Documento` varchar(255) NOT NULL,
  `Nombre_usuario` varchar(30) DEFAULT NULL,
  `Fecha_registro` datetime DEFAULT current_timestamp(),
  `Codigo_Evento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Participacion`),
  UNIQUE KEY `Nombre_usuario` (`Nombre_usuario`),
  KEY `FK_CodigoEvento` (`Codigo_Evento`),
  KEY `fk_documento` (`Documento`),
  CONSTRAINT `FK_CodigoEvento` FOREIGN KEY (`Codigo_Evento`) REFERENCES `eventos` (`Codigo_Evento`),
  CONSTRAINT `fk_documento` FOREIGN KEY (`Documento`) REFERENCES `usuario` (`Documento`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `participacion` */

/*Table structure for table `recompensas` */

DROP TABLE IF EXISTS `recompensas`;

CREATE TABLE `recompensas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `puntos` varchar(100) DEFAULT NULL,
  `cantidad` varchar(100) DEFAULT NULL,
  `entregadas` int(11) DEFAULT 0,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `recompensas` */

insert  into `recompensas`(`id`,`codigo`,`descripcion`,`puntos`,`cantidad`,`entregadas`,`foto`) values 
(14,'4040','123','100','10',10,'680666c72a680-fondo.jpg'),
(15,'4040','20','20','100',100,'6748948ccfd0c-imagen de diseño.webp'),
(16,'3542','Gorras','100','50',0,'67dd8bc774cc8-Dolce-Gabbana-Logo.png');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `Documento` varchar(255) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Apellidos` varchar(40) NOT NULL,
  `Edad` int(11) NOT NULL CHECK (`Edad` >= 0),
  `Nombre_usuario` varchar(30) DEFAULT NULL,
  `Contraseña` varchar(300) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Fecha_registro` datetime DEFAULT current_timestamp(),
  `Puntos` int(20) DEFAULT 0,
  `Foto_perfil` varchar(255) DEFAULT NULL,
  `codigo_recuperacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Documento`),
  UNIQUE KEY `Nombre_usuario` (`Nombre_usuario`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`Documento`,`Nombre`,`Apellidos`,`Edad`,`Nombre_usuario`,`Contraseña`,`Email`,`Fecha_registro`,`Puntos`,`Foto_perfil`,`codigo_recuperacion`) values 
('1043695621','Luis','Contreras',20,'','$2y$10$2CmLFYCPMLNSIiF.QPlV3.MHtPb236rGIQLpxjxkidkI/mcmiXpHu','','2024-11-22 20:17:14',3300,'fotos_perfil/perfil_67dd5db1944a07.73392716.png',NULL),
('123','anyer','Contreras',20,'Luis201','$2y$10$K2kurCJRrrJTkt0ROUoQiuyOCxJlwqxNAmTRAej2gz53eD3CQPzde','ll@gmail.com','2024-11-27 00:00:00',0,NULL,NULL),
('1233','anyer','Contreras',20,'ggg','$2y$10$FMTR6ugnB0M06Bi0hzYojuDCa.1krS7Wud/hfRcLtltyTpKcl9oPO','albeiro1@gmail.com','2025-03-21 09:54:13',0,NULL,NULL),
('145','anyer','Contreras',20,'Albeiro duran','$2y$10$EbT8XGkLMbfQcfhNDFJcmeEFHMOmHw8XPtylM/m0RsuP4d1njo3da','albaly2017@gmail.com','2025-03-20 07:42:22',500,'fotos_perfil/perfil_67dd889a539fa5.24720320.png',NULL),
('235','Luis','Contreras',20,'ContrerasG45','$2y$10$kfa0caMY8rLmWj7/Lam8s.iZn3QCOoPL9AwBc7d0moaatbvhN6x8y','Luisrodolfo@gmail.com','2024-12-01 20:58:09',900,'../../Perfil_GZG/fotos_perfil/perfil_680a38fb4a7396.85299460.jpg',NULL),
('32761927','Luis','Contreras',20,'Deisy','$2y$10$zffhJ0kSGwECdJPiZeCPj.1qdJWtXIr5XwoJ4DYdobkJZ8f2y7bo.','luisrodolfocontreraspaez123@gmail.com','2025-05-30 11:31:08',0,NULL,'264647'),
('458','Luis','Contreras',20,'Luis','$2y$10$.KBKaQa6y0OfNh7ftxhOTua9M5rCBHKKRRTXr0B9iVdxhwbAapIkS','l@gmail.com','2025-03-21 09:45:36',0,NULL,NULL),
('498','anyer','duran',20,'anyercito','$2y$10$IHMXKsMh3jDrAVQBZcSuquvf3F5TxdZR39XpQRlOHG/Yv1tPXEMD6','manyerdavid@gmail.com','2025-05-30 15:34:53',0,NULL,NULL),
('5656','anyer','Contreras',20,'Carlosg4','$2y$10$uHM0HOgqOstWqAViOXKd4.8QekWWWbWpP5KNyNNxO9.pFadcXHAOy','Adso88@gmail.com','2025-04-21 07:42:54',0,NULL,NULL),
('9999','anyer','duran',20,'Adso8','$2y$10$G8kLdRjuLymhMXSwUFCs.un3RV2/B3kgID0riUkRzygqS/C/p28hu','Adso8@gmail.com','2025-04-11 10:56:01',0,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
