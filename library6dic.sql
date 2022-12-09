-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para library
CREATE DATABASE IF NOT EXISTS `library` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `library`;

-- Volcando estructura para procedimiento library.actualizar_autor
DELIMITER //
CREATE PROCEDURE `actualizar_autor`(
in id SMALLINT,
in pn varchar(50),
in sn varchar(50),
in pa varchar(50),
in sa varchar(50),
in seu varchar(50),
in dir varchar(50),
in pais SMALLINT,
in est smallint
)
BEGIN
update autores set primer_nombre = pn, segundo_nombre = sn ,primer_apellido = pa , segundo_apellido = sa ,seudonimo = seu ,direccion = dir ,id_pais = pais, estado = est
WHERE id_autor = id and estado != 0;
END//
DELIMITER ;

-- Volcando estructura para procedimiento library.actualizar_editorial
DELIMITER //
CREATE PROCEDURE `actualizar_editorial`(
IN id SMALLINT,
in nom varchar(50),
in pais SMALLINT,
IN est smallint
)
BEGIN
update editoriales SET Nombre = nom, id_pais = pais, estado = est
WHERE id_editorial = id and estado != 0;
END//
DELIMITER ;

-- Volcando estructura para procedimiento library.actualizar_estudiante
DELIMITER //
CREATE PROCEDURE `actualizar_estudiante`(
IN id SMALLINT,
in pn varchar(50),
in sn varchar(50),
in pa varchar(50),
in sa varchar(50),
IN td SMALLINT,
in doc VARCHAR(15),
IN sx SMALLINT,
IN ec SMALLINT,
in dir VARCHAR(150),
in cor VARCHAR(100),
IN pro SMALLINT,
in tel varchar(50),
IN act SMALLINT
)
BEGIN
update estudiantes 
set primer_nombre = pn ,segundo_nombre = sn, primer_apellido = pa, segundo_apellido = sa, tipo_documento = td, documento = doc, sexo = sx, estado_civil = ec, direccion = dir, correo = cor, id_programa = pro, telefono = tel, activo = act
 WHERE id_estudiante = id and activo != 0;
END//
DELIMITER ;

-- Volcando estructura para tabla library.auditoria
CREATE TABLE IF NOT EXISTS `auditoria` (
  `fecha_cambio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre_disparador` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipo_disparador` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nivel_disparador` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `comando` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `tabla` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `old_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `new_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla library.auditoria: ~91 rows (aproximadamente)
INSERT INTO `auditoria` (`fecha_cambio`, `nombre_disparador`, `tipo_disparador`, `nivel_disparador`, `comando`, `tabla`, `old_info`, `new_info`) VALUES
	('2022-11-13 23:45:14', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '19|magdalena sa|1|2', '19|magdalena sa|1|1'),
	('2022-11-13 23:45:50', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '1|Campestre S.A|1|1', '1|Campestre S.A|2|1'),
	('2022-11-13 23:46:10', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '1|Campestre S.A|2|1', '1|Campestre S.A|2|2'),
	('2022-11-13 23:46:32', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '9|cañaveral sa|1|1', '9|cañaveral sa|1|2'),
	('2022-11-13 23:46:58', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '1|Campestre S.A|2|2', '1|Campestre S.A|2|1'),
	('2022-11-13 23:47:27', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '9|cañaveral sa|1|2', '9|cañaveral sa|2|2'),
	('2022-11-13 23:47:47', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '9|cañaveral sa|2|2', '9|cañaveral sa|2|1'),
	('2022-11-13 23:49:06', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '17|magdalena|1|0', '17|magdalena|1|1'),
	('2022-11-13 23:49:08', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '16|house|1|0', '16|house|1|1'),
	('2022-11-13 23:49:11', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '11|master books|1|0', '11|master books|1|1'),
	('2022-11-13 23:49:12', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '10|luna del mar|2|0', '10|luna del mar|2|1'),
	('2022-11-13 23:49:15', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '4|magdalena|1|0', '4|magdalena|1|1'),
	('2022-11-13 23:49:17', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '3|Catedra|2|0', '3|Catedra|2|1'),
	('2022-11-13 23:51:45', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '18|editorial del sur|1|1', '18|editorial del sur|1|0'),
	('2022-11-13 23:52:20', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '18|editorial del sur|1|0', '18|editorial del sur|1|0'),
	('2022-11-13 23:53:29', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '3|Catedra|2|1', '3|Catedra|2|0'),
	('2022-11-13 23:54:33', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '16|house|1|1', '16|house|1|2'),
	('2022-11-13 23:54:39', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '16|house|1|2', '16|house|1|0'),
	('2022-11-14 00:00:54', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '22|union svg|1|1'),
	('2022-11-14 00:01:44', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '23|union svg|1|1'),
	('2022-11-14 00:02:11', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '24|union svg|1|1'),
	('2022-11-14 00:02:29', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '25|union svg|1|1'),
	('2022-11-14 00:02:42', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '26|union svg|1|1'),
	('2022-11-14 00:02:53', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '27|aaa|1|1'),
	('2022-11-14 00:04:00', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '28|bbb|2|1'),
	('2022-11-14 00:04:49', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '27|aaa|1|1', '27|aaa|2|1'),
	('2022-11-14 00:05:10', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '27|aaa|2|1', '27|aaa|2|2'),
	('2022-11-14 00:05:49', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '28|bbb|2|1', '28|bbb|2|0'),
	('2022-11-14 00:14:25', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '20|norma|2|1', '20|norma|1|2'),
	('2022-11-14 00:16:46', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '29|new books|1|1'),
	('2022-11-14 00:35:15', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '1|Campestre S.A|2|1', '1|Campestre S.A|1|1'),
	('2022-11-14 00:46:51', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '13|Carvajal|2|1', '13|Carvajal|1|1'),
	('2022-11-14 10:33:48', 'tg_insert_libros', 'AFTER', 'ROW', 'INSERT', 'libros', NULL, '5|Aprende a programar|1|1|200|1'),
	('2022-11-14 13:32:07', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '3|asdf|asdf|asdf|asdf|asdf|asdf|1|1', '3|ANDRES|asdf|GUZMAN|asdf||soledad|1|1'),
	('2022-11-14 13:34:26', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '3|ANDRES|asdf|GUZMAN|asdf||soledad|1|1', '3|ANDRES||GUZMAN|||soledad|1|1'),
	('2022-11-14 13:34:44', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '3|ANDRES||GUZMAN|||soledad|1|1', '3|ANDRES||GUZMAN||andreg|soledad|1|1'),
	('2022-11-14 13:36:33', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '3|ANDRES||GUZMAN||andreg|soledad|1|1', '3|ANDRES||GUZMAN||andreg|soledad|1|0'),
	('2022-11-14 13:38:48', 'tg_insert_autores', 'AFTER', 'ROW', 'INSERT', 'autores', NULL, '10|maria juana||perea|dominguez|mari|bogota|1|1'),
	('2022-11-14 13:39:35', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '10|maria juana||perea|dominguez|mari|bogota|1|1', '10|maria juana||perea|dominguez|mari|bogota placeholder=|1|1'),
	('2022-11-14 13:40:29', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '10|maria juana||perea|dominguez|mari|bogota placeholder=|1|1', '10|maria juana||perea|dominguez|mari|bogota|1|1'),
	('2022-11-14 13:56:09', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', NULL, '2|maria||alvarez|||barranquilla|2|1'),
	('2022-11-14 13:56:32', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '2|maria||alvarez|||barranquilla|2|1', '2|maria||alvarez||alva|barranquilla|2|1'),
	('2022-11-14 13:57:31', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '9|primer||primer apellidof|segundo|seudonimo|df|2|1', '9|primer||primer apellidof|segundo|seudonimo|df|2|0'),
	('2022-11-14 13:57:35', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '8|primer||primer apellidof|segundo|seudonimo|direccion|2|1', '8|primer||primer apellidof|segundo|seudonimo|direccion|2|0'),
	('2022-11-14 13:57:38', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '7|primer||primer apellidof|segundo|seudonimo|direccion|2|1', '7|primer||primer apellidof|segundo|seudonimo|direccion|2|0'),
	('2022-11-14 13:57:40', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '6|primer||primer apellido|segundo|seudonimo|direccion|2|1', '6|primer||primer apellido|segundo|seudonimo|direccion|2|0'),
	('2022-11-14 13:57:43', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '5|primer||primer apellidof|segundo|seudonimo|direccion|2|1', '5|primer||primer apellidof|segundo|seudonimo|direccion|2|0'),
	('2022-11-14 13:57:46', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '4|primer||primer apellidof|segundo|seudonimo|direccion|1|1', '4|primer||primer apellidof|segundo|seudonimo|direccion|1|0'),
	('2022-11-14 14:01:21', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '2|maria||alvarez||alva|barranquilla|2|1', '2|maria||alvarez||alva|barranquilla|2|2'),
	('2022-11-14 14:18:26', 'tg_update_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '10|maria juana||perea|dominguez|mari|bogota|1|1', '10|maria juana||perea|dominguez|mari|bogota|1|0'),
	('2022-11-14 14:22:17', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', NULL, '1|dav|david|vergara||j3su|zooledad|1|1'),
	('2022-11-14 14:24:45', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '1|dav|david|vergara||j3su|zooledad|1|1', '1|dav|david|vergara||j3su|zooledad|2|1'),
	('2022-11-14 14:25:47', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '1|dav|david|vergara||j3su|zooledad|2|1', '1|dav|david|vergara||j3su|zoo|2|1'),
	('2022-11-14 14:26:13', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '1|dav|david|vergara||j3su|zoo|2|1', '1|dav|david|vergara||j3su|zoo|2|0'),
	('2022-11-14 14:27:15', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '2|maria||alvarez||alva|barranquilla|2|2', '2|maria||alvarez||alva|barranquilla|2|1'),
	('2022-11-14 14:28:34', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '2|maria||alvarez||alva|barranquilla|2|1', '2|maria||alvarez||alva|barranquilla|2|0'),
	('2022-11-14 14:33:09', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '2|maria||alvarez||alva|barranquilla|2|0', '2|maria||alvarez||alva|barranquilla|2|1'),
	('2022-11-14 14:33:12', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '3|ANDRES||GUZMAN||andreg|soledad|1|0', '3|ANDRES||GUZMAN||andreg|soledad|1|1'),
	('2022-11-14 14:33:13', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '4|primer||primer apellidof|segundo|seudonimo|direccion|1|0', '4|primer||primer apellidof|segundo|seudonimo|direccion|1|1'),
	('2022-11-14 14:33:21', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '10|maria juana||perea|dominguez|mari|bogota|1|0', '10|maria juana||perea|dominguez|mari|bogota|1|1'),
	('2022-11-14 14:33:35', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '4|primer||primer apellidof|segundo|seudonimo|direccion|1|1', '4|primer||primer apellidof|segundo|seudonimo|direccion|1|0'),
	('2022-11-14 15:24:18', 'tg_insert_libros', 'AFTER', 'ROW', 'INSERT', 'libros', NULL, '6|magdalena|1|34|344|1'),
	('2022-11-14 15:25:53', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '9|cañaveral sa|2|1', '9|cañaveral sa|1|1'),
	('2022-11-14 16:03:18', 'tg_update_libros', 'AFTER', 'ROW', 'UPDATE', 'libros', '4|Harry|13|1|1000|1', '4|Harry|21|1|1000|1'),
	('2022-11-14 16:06:28', 'tg_update_libros', 'AFTER', 'ROW', 'UPDATE', 'libros', '6|magdalena|1|34|344|1', '6|magdalena|11|34|344|1'),
	('2022-11-14 16:06:51', 'tg_update_libros', 'AFTER', 'ROW', 'UPDATE', 'libros', '6|magdalena|11|34|344|1', '6|magdalena|19|34|344|1'),
	('2022-11-14 16:08:06', 'tg_update_libros', 'AFTER', 'ROW', 'UPDATE', 'libros', '6|magdalena|19|34|344|1', '6|magdalena|12|34|344|1'),
	('2022-11-14 16:08:33', 'tg_update_libros', 'AFTER', 'ROW', 'UPDATE', 'libros', '6|magdalena|12|34|344|1', '6|magdalena|19|34|344|1'),
	('2022-11-14 16:09:33', 'tg_update_libros', 'AFTER', 'ROW', 'UPDATE', 'libros', '6|magdalena|19|34|344|1', '6|magdalena|13|34|344|1'),
	('2022-11-14 16:09:58', 'tg_update_libros', 'AFTER', 'ROW', 'UPDATE', 'libros', '6|magdalena|13|34|344|1', '6|magdalena|13|34|344|2'),
	('2022-11-14 16:16:14', 'tg_update_libros', 'AFTER', 'ROW', 'UPDATE', 'libros', '4|Harry|21|1|1000|1', '4|Harry|21|1|1000|0'),
	('2022-11-14 16:21:02', 'tg_update_libros', 'AFTER', 'ROW', 'UPDATE', 'libros', '6|magdalena|13|34|344|2', '6|magdalena|13|34|344|1'),
	('2022-11-14 16:22:08', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '2|maria||alvarez||alva|barranquilla|2|1', '2|maria||alvarez||alva|barranquilla|2|2'),
	('2022-11-14 16:23:38', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '10|maria juana||perea|dominguez|mari|bogota|1|1', '10|Rick ||Riordan |dominguez|mari|bogota|1|1'),
	('2022-11-14 16:23:39', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '10|Rick ||Riordan |dominguez|mari|bogota|1|1', '10|Rick ||Riordan ||mari|bogota|1|1'),
	('2022-11-14 16:24:07', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '10|Rick ||Riordan ||mari|bogota|1|1', '10|Rick ||Riordan |||bogota|1|1'),
	('2022-11-14 16:24:48', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '3|ANDRES||GUZMAN||andreg|soledad|1|1', '3|Dan ||GUZMAN||andreg|soledad|1|1'),
	('2022-11-14 16:25:12', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '3|Dan ||GUZMAN||andreg|soledad|1|1', '3|Dan ||Brown |||usa|1|1'),
	('2022-11-14 16:25:15', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '10|Rick ||Riordan |||bogota|1|1', '10|Rick ||Riordan |||usa|1|1'),
	('2022-11-14 16:25:39', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '5|primer||primer apellidof|segundo|seudonimo|direccion|2|0', '5|primer||primer apellidof|segundo|seudonimo|usa|2|0'),
	('2022-11-14 16:25:47', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '4|primer||primer apellidof|segundo|seudonimo|direccion|1|0', '4|primer||primer apellidof|segundo|seudonimo|medellin|1|0'),
	('2022-11-14 16:25:53', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '4|primer||primer apellidof|segundo|seudonimo|medellin|1|0', '4|primer||primer |segundo|seudonimo|medellin|1|0'),
	('2022-11-14 16:25:55', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '5|primer||primer apellidof|segundo|seudonimo|usa|2|0', '5|primer||primer|segundo|seudonimo|usa|2|0'),
	('2022-11-14 16:26:00', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '5|primer||primer|segundo|seudonimo|usa|2|0', '5|primer||primer|segundo||usa|2|0'),
	('2022-11-14 16:26:01', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '4|primer||primer |segundo|seudonimo|medellin|1|0', '4|primer||primer |segundo||medellin|1|0'),
	('2022-11-14 16:26:37', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '1|dav|david|vergara||j3su|zoo|2|0', '1|George |RR|Martin|||usa|2|1'),
	('2022-11-14 16:27:38', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '5|primer||primer|segundo||usa|2|0', '5|Paula ||Hawkins |||usa|2|0'),
	('2022-11-14 16:27:49', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '5|Paula ||Hawkins |||usa|2|0', '5|Paula ||Hawkins |||usa|2|1'),
	('2022-11-14 16:31:45', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '11|master books|1|1', '11|master books|1|2'),
	('2022-11-14 16:32:46', 'tg_insert_libros', 'AFTER', 'ROW', 'INSERT', 'libros', NULL, '7|Percy Jackson y los dioses del Olimpo|2|4|1200|1'),
	('2022-11-14 16:33:25', 'tg_insert_libros', 'AFTER', 'ROW', 'INSERT', 'libros', NULL, '8|A Song of Ice and Fire|2|1|500|1'),
	('2022-12-03 23:13:55', 'tg_insert_libros', 'AFTER', 'ROW', 'INSERT', 'libros', NULL, '9|jesus|1|34|344|1'),
	('2022-12-04 13:38:56', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '22|asdfasfasfasfasfsafdasfasfdasdasfasfdasfdasfdasfasfdsfdasfdsfdasfdsfasfdaasdfasfdsfdasfdsfdasfdsfdsfsfdasfdasfdasfdsfdasfdasfdasfdasfdasfdsafdasfdasfdasfdasfds|1|1'),
	('2022-12-04 14:50:54', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '23|asdf|2|1'),
	('2022-12-07 16:54:17', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '23|asdf|2|1', '23|asdf|2|0'),
	('2022-12-07 16:54:20', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '22|asdfasfasfasfasfsafdasfasfdasdasfasfdasfdasfdasfasfdsfdasfdsfdasfdsfasfdaasdfasfdsfdasfdsfdasfdsfdsfsfdasfdasfdasfdsfdasfdasfdasfdasfdasfdsafdasfdasfdasfdasfds|1|1', '22|asdfasfasfasfasfsafdasfasfdasdasfasfdasfdasfdasfasfdsfdasfdsfdasfdsfasfdaasdfasfdsfdasfdsfdasfdsfdsfsfdasfdasfdasfdsfdasfdasfdasfdasfdasfdsafdasfdasfdasfdasfds|1|0'),
	('2022-12-07 16:54:49', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '1|Campestre S.A|1|1', '1|Campestre S.A|1|0'),
	('2022-12-08 15:14:33', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '24|editorial sa|2|1'),
	('2022-12-08 15:19:28', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '25|editorial sa|2|1'),
	('2022-12-08 15:21:17', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '26|catedral del pacifico sur|2|1'),
	('2022-12-08 15:22:52', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '9|cañaveral sa|1|1', '9|cañaveral sa|1|0'),
	('2022-12-08 16:25:08', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '25|editorial sa|2|1', '25|actualizada|2|1'),
	('2022-12-08 16:27:34', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '25|actualizada|2|1', '25|actualizada|2|1'),
	('2022-12-08 16:30:43', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '25|actualizada|2|1', '25|actualizada|1|1'),
	('2022-12-08 16:30:50', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '25|actualizada|1|1', '25|actualizada|2|1'),
	('2022-12-08 16:32:22', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '27|camara de papel|1|1'),
	('2022-12-08 16:47:01', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '22|asdfasfasfasfasfsafdasfasfdasdasfasfdasfdasfdasfasfdsfdasfdsfdasfdsfasfdaasdfasfdsfdasfdsfdasfdsfdsfsfdasfdasfdasfdsfdasfdasfdasfdasfdasfdsafdasfdasfdasfdasfds|1|0', '22|asdf|1|0'),
	('2022-12-08 16:56:15', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '27|camara de papel|1|1', '27|cama|1|1'),
	('2022-12-08 16:57:11', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '27|cama|1|1', '27|cama|2|1'),
	('2022-12-08 16:59:31', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '27|cama|2|1', '27|cama|2|0'),
	('2022-12-08 19:04:00', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '28|marianela|1|1'),
	('2022-12-08 19:17:42', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '29|del norte|1|1'),
	('2022-12-08 19:22:11', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '29|del norte|1|1', '29|del norte|1|1'),
	('2022-12-08 19:22:27', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '29|del norte|1|1', '29|del norte|1|1'),
	('2022-12-08 20:49:47', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '29|del norte|1|1', '29|del norte|1|0'),
	('2022-12-08 20:49:56', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '26|catedral del pacifico sur|2|1', '26|catedral del pacifico sur|2|0'),
	('2022-12-08 20:50:03', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '25|actualizada|2|1', '25|actualizada|2|0'),
	('2022-12-08 20:53:21', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '24|editorial sa|2|1', '24|editorial sa|2|0'),
	('2022-12-08 20:53:27', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '8|Educar Editores|1|1', '8|Educar Editores|1|0'),
	('2022-12-08 20:55:39', 'tg_delete_editoriales', 'AFTER', 'ROW', 'DELETE', 'editoriales', '12|Editorial Planeta|2|1', '12|Editorial Planeta|2|0'),
	('2022-12-08 20:55:57', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '30|jaia|2|1'),
	('2022-12-08 20:56:11', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '30|jaia|2|1', '30|jaia|1|1'),
	('2022-12-08 20:56:18', 'tg_update_editoriales', 'AFTER', 'ROW', 'UPDATE', 'editoriales', '30|jaia|1|1', '30|jaia|2|1'),
	('2022-12-08 21:19:39', 'tg_insert_editoriales', 'AFTER', 'ROW', 'INSERT', 'editoriales', NULL, '31|de la sabana|1|1'),
	('2022-12-08 22:12:06', 'tg_insert_autores', 'AFTER', 'ROW', 'INSERT', 'autores', NULL, '11|jesus||david||je|calle 54|1|1'),
	('2022-12-08 22:18:59', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '11|jesus||david||je|calle 54|1|1', '11|jesus|manuel|david|deivid|jes|calle 54 %|1|1'),
	('2022-12-08 23:12:49', 'tg_insert_autores', 'AFTER', 'ROW', 'INSERT', 'autores', NULL, '12|asdf||asdf||asdf|asdfasdf|1|1'),
	('2022-12-08 23:26:21', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '12|asdf||asdf||asdf|asdfasdf|1|1', '12|asdf||asdf||asdf|asdfasdf|1|0'),
	('2022-12-08 23:28:17', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '11|jesus|manuel|david|deivid|jes|calle 54 %|1|1', '11|jesus|manuel|david|deivid|jes|calle 54 %|1|0'),
	('2022-12-08 23:29:25', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '10|Rick ||Riordan |||usa|1|1', '10|Rick ||Riordan |||usa|1|0'),
	('2022-12-08 23:29:43', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '5|Paula ||Hawkins |||usa|2|1', '5|Paula ||Hawkins |||usa|2|0'),
	('2022-12-08 23:32:21', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '3|Dan ||Brown |||usa|1|1', '3|Dan ||Brown |||usa|1|0'),
	('2022-12-08 23:33:33', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '1|George |RR|Martin|||usa|2|1', '1|George |RR|Martin|||usa|2|0'),
	('2022-12-08 23:35:55', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '12|asdf||asdf||asdf|asdfasdf|1|0', '12|asdf||asdf||asdf|asdfasdf|1|1'),
	('2022-12-08 23:35:56', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '11|jesus|manuel|david|deivid|jes|calle 54 %|1|0', '11|jesus|manuel|david|deivid|jes|calle 54 %|1|1'),
	('2022-12-08 23:35:56', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '10|Rick ||Riordan |||usa|1|0', '10|Rick ||Riordan |||usa|1|1'),
	('2022-12-08 23:35:57', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '5|Paula ||Hawkins |||usa|2|0', '5|Paula ||Hawkins |||usa|2|1'),
	('2022-12-08 23:35:58', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '3|Dan ||Brown |||usa|1|0', '3|Dan ||Brown |||usa|1|1'),
	('2022-12-08 23:35:59', 'tg_update_autores', 'AFTER', 'ROW', 'UPDATE', 'autores', '1|George |RR|Martin|||usa|2|0', '1|George |RR|Martin|||usa|2|1'),
	('2022-12-08 23:36:06', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '12|asdf||asdf||asdf|asdfasdf|1|1', '12|asdf||asdf||asdf|asdfasdf|1|0'),
	('2022-12-08 23:36:16', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '3|Dan ||Brown |||usa|1|1', '3|Dan ||Brown |||usa|1|0'),
	('2022-12-08 23:37:25', 'tg_delete_autores', 'AFTER', 'ROW', 'DELETE', 'autores', '10|Rick ||Riordan |||usa|1|1', '10|Rick ||Riordan |||usa|1|0');

-- Volcando estructura para tabla library.auditoria_tipo2
CREATE TABLE IF NOT EXISTS `auditoria_tipo2` (
  `id_auditoria` int NOT NULL AUTO_INCREMENT,
  `fecha_cambio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `tabla` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_user` int NOT NULL,
  `old_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `new_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_auditoria`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla library.auditoria_tipo2: ~32 rows (aproximadamente)
INSERT INTO `auditoria_tipo2` (`id_auditoria`, `fecha_cambio`, `tipo`, `tabla`, `id_user`, `old_info`, `new_info`) VALUES
	(39, '2022-11-14 13:34:26', 'UPDATE', 'editoriales', 235, '3|ANDRES|asdf|GUZMAN|asdf||soledad|1|1', '3|ANDRES||GUZMAN|||soledad|1|1'),
	(40, '2022-11-14 13:34:44', 'UPDATE', 'editoriales', 235, '3|ANDRES||GUZMAN|||soledad|1|1', '3|ANDRES||GUZMAN||andreg|soledad|1|1'),
	(41, '2022-11-14 13:36:33', 'DELETE', 'autores', 235, '3|ANDRES||GUZMAN||andreg|soledad|1|1', '3|ANDRES||GUZMAN||andreg|soledad|1|0'),
	(42, '2022-11-14 13:38:48', 'INSERT', 'autores', 235, NULL, '10|maria juana||perea|dominguez|mari|bogota|1|1'),
	(43, '2022-11-14 13:39:35', 'UPDATE', 'editoriales', 235, '10|maria juana||perea|dominguez|mari|bogota|1|1', '10|maria juana||perea|dominguez|mari|bogota placeholder=|1|1'),
	(44, '2022-11-14 13:40:29', 'UPDATE', 'editoriales', 235, '10|maria juana||perea|dominguez|mari|bogota placeholder=|1|1', '10|maria juana||perea|dominguez|mari|bogota|1|1'),
	(45, '2022-11-14 13:56:09', 'UPDATE', 'editoriales', 235, '2|maria||alvarez|||barranquilla|2|2', '2|maria||alvarez|||barranquilla|2|1'),
	(46, '2022-11-14 13:56:32', 'UPDATE', 'editoriales', 235, '2|maria||alvarez|||barranquilla|2|1', '2|maria||alvarez||alva|barranquilla|2|1'),
	(47, '2022-11-14 13:57:31', 'DELETE', 'autores', 235, '9|primer||primer apellidof|segundo|seudonimo|df|2|1', '9|primer||primer apellidof|segundo|seudonimo|df|2|0'),
	(48, '2022-11-14 13:57:35', 'DELETE', 'autores', 235, '8|primer||primer apellidof|segundo|seudonimo|direccion|2|1', '8|primer||primer apellidof|segundo|seudonimo|direccion|2|0'),
	(49, '2022-11-14 13:57:38', 'DELETE', 'autores', 235, '7|primer||primer apellidof|segundo|seudonimo|direccion|2|1', '7|primer||primer apellidof|segundo|seudonimo|direccion|2|0'),
	(50, '2022-11-14 13:57:40', 'DELETE', 'autores', 235, '6|primer||primer apellido|segundo|seudonimo|direccion|2|1', '6|primer||primer apellido|segundo|seudonimo|direccion|2|0'),
	(51, '2022-11-14 13:57:43', 'DELETE', 'autores', 235, '5|primer||primer apellidof|segundo|seudonimo|direccion|2|1', '5|primer||primer apellidof|segundo|seudonimo|direccion|2|0'),
	(52, '2022-11-14 13:57:46', 'DELETE', 'autores', 235, '4|primer||primer apellidof|segundo|seudonimo|direccion|1|1', '4|primer||primer apellidof|segundo|seudonimo|direccion|1|0'),
	(53, '2022-11-14 14:01:21', 'UPDATE', 'editoriales', 235, '2|maria||alvarez||alva|barranquilla|2|1', '2|maria||alvarez||alva|barranquilla|2|2'),
	(54, '2022-11-14 14:18:26', 'DELETE', 'autores', 235, '10|maria juana||perea|dominguez|mari|bogota|1|1', '10|maria juana||perea|dominguez|mari|bogota|1|0'),
	(55, '2022-11-14 14:22:17', 'UPDATE', 'editoriales', 235, '1|jesus|david|vergara||j3su|zooledad|1|1', '1|dav|david|vergara||j3su|zooledad|1|1'),
	(56, '2022-11-14 14:24:45', 'UPDATE', 'editoriales', 235, '1|dav|david|vergara||j3su|zooledad|1|1', '1|dav|david|vergara||j3su|zooledad|2|1'),
	(57, '2022-11-14 14:25:47', 'UPDATE', 'editoriales', 235, '1|dav|david|vergara||j3su|zooledad|2|1', '1|dav|david|vergara||j3su|zoo|2|1'),
	(58, '2022-11-14 14:26:13', 'DELETE', 'autores', 235, '1|dav|david|vergara||j3su|zoo|2|1', '1|dav|david|vergara||j3su|zoo|2|0'),
	(59, '2022-11-14 14:27:15', 'UPDATE', 'editoriales', 235, '2|maria||alvarez||alva|barranquilla|2|2', '2|maria||alvarez||alva|barranquilla|2|1'),
	(60, '2022-11-14 14:28:34', 'DELETE', 'autores', 235, '2|maria||alvarez||alva|barranquilla|2|1', '2|maria||alvarez||alva|barranquilla|2|0'),
	(61, '2022-11-14 14:33:35', 'DELETE', 'autores', 235, '4|primer||primer apellidof|segundo|seudonimo|direccion|1|1', '4|primer||primer apellidof|segundo|seudonimo|direccion|1|0'),
	(62, '2022-11-14 15:24:18', 'INSERT', 'libros', 235, NULL, '6|magdalena|1|34|344|1'),
	(63, '2022-11-14 15:25:53', 'UPDATE', 'editoriales', 235, '9|cañaveral sa|2|1', '9|cañaveral sa|1|1'),
	(64, '2022-11-14 16:09:33', 'UPDATE', 'libros', 235, '6|magdalena|19|34|344|1', '6|magdalena|13|34|344|1'),
	(65, '2022-11-14 16:09:58', 'UPDATE', 'libros', 235, '6|magdalena|13|34|344|1', '6|magdalena|13|34|344|2'),
	(66, '2022-11-14 16:16:14', 'DELETE', 'libros', 235, '4|Harry|21|1|1000|1', '4|Harry|21|1|1000|0'),
	(67, '2022-11-14 16:21:03', 'UPDATE', 'libros', 235, '6|magdalena|13|34|344|2', '6|magdalena|13|34|344|1'),
	(68, '2022-11-14 16:22:08', 'UPDATE', 'editoriales', 235, '2|maria||alvarez||alva|barranquilla|2|1', '2|maria||alvarez||alva|barranquilla|2|2'),
	(69, '2022-11-14 16:32:46', 'INSERT', 'libros', 235, NULL, '7|Percy Jackson y los dioses del Olimpo|2|4|1200|1'),
	(70, '2022-11-14 16:33:25', 'INSERT', 'libros', 235, NULL, '8|A Song of Ice and Fire|2|1|500|1'),
	(71, '2022-12-03 23:13:55', 'INSERT', 'libros', 235, NULL, '9|jesus|1|34|344|1'),
	(72, '2022-12-04 13:38:56', 'INSERT', 'editoriales', 235, NULL, '22|asdfasfasfasfasfsafdasfasfdasdasfasfdasfdasfdasfasfdsfdasfdsfdasfdsfasfdaasdfasfdsfdasfdsfdasfdsfdsfsfdasfdasfdasfdsfdasfdasfdasfdasfdasfdsafdasfdasfdasfdasfds|1|1'),
	(73, '2022-12-04 14:50:54', 'INSERT', 'editoriales', 235, NULL, '23|asdf|2|1'),
	(74, '2022-12-07 16:54:17', 'DELETE', 'editoriales', 235, '23|asdf|2|1', '23|asdf|2|0'),
	(75, '2022-12-07 16:54:20', 'DELETE', 'editoriales', 235, '22|asdfasfasfasfasfsafdasfasfdasdasfasfdasfdasfdasfasfdsfdasfdsfdasfdsfasfdaasdfasfdsfdasfdsfdasfdsfdsfsfdasfdasfdasfdsfdasfdasfdasfdasfdasfdsafdasfdasfdasfdasfds|1|1', '22|asdfasfasfasfasfsafdasfasfdasdasfasfdasfdasfdasfasfdsfdasfdsfdasfdsfasfdaasdfasfdsfdasfdsfdasfdsfdsfsfdasfdasfdasfdsfdasfdasfdasfdasfdasfdsafdasfdasfdasfdasfds|1|0'),
	(76, '2022-12-07 16:54:49', 'DELETE', 'editoriales', 235, '1|Campestre S.A|1|1', '1|Campestre S.A|1|0'),
	(77, '2022-12-08 15:22:52', 'DELETE', 'editoriales', 235, '9|cañaveral sa|1|1', '9|cañaveral sa|1|0'),
	(78, '2022-12-08 16:59:31', 'DELETE', 'editoriales', 235, '27|cama|2|1', '27|cama|2|0'),
	(79, '2022-12-08 23:12:49', 'INSERT', 'autores', 235, NULL, '12|asdf||asdf||asdf|asdfasdf|1|1');

-- Volcando estructura para tabla library.autores
CREATE TABLE IF NOT EXISTS `autores` (
  `id_autor` smallint NOT NULL AUTO_INCREMENT,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) NOT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `seudonimo` varchar(200) DEFAULT NULL,
  `direccion` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `id_pais` smallint NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla library.autores: ~5 rows (aproximadamente)
INSERT INTO `autores` (`id_autor`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `seudonimo`, `direccion`, `id_pais`, `estado`) VALUES
	(1, 'George ', 'RR', 'Martin', '', '', 'usa', 2, 1),
	(2, 'maria', '', 'alvarez', '', 'alva', 'barranquilla', 2, 2),
	(3, 'Dan ', '', 'Brown ', '', '', 'usa', 1, 0),
	(5, 'Paula ', '', 'Hawkins ', '', '', 'usa', 2, 1),
	(10, 'Rick ', '', 'Riordan ', '', '', 'usa', 1, 0),
	(11, 'jesus', 'manuel', 'david', 'deivid', 'jes', 'calle 54 %', 1, 1),
	(12, 'asdf', '', 'asdf', '', 'asdf', 'asdfasdf', 1, 0);

-- Volcando estructura para tabla library.autores_libros
CREATE TABLE IF NOT EXISTS `autores_libros` (
  `id_autorlibro` smallint NOT NULL AUTO_INCREMENT,
  `id_libro` smallint NOT NULL,
  `id_autor` smallint NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_autorlibro`),
  KEY `autor_libro_libro` (`id_libro`),
  KEY `autor_libro_autor` (`id_autor`),
  CONSTRAINT `autor_libro_autor` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`),
  CONSTRAINT `autor_libro_libro` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libros`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla library.autores_libros: ~0 rows (aproximadamente)

-- Volcando estructura para tabla library.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id_cargo` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `activo` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla library.cargos: ~11 rows (aproximadamente)
INSERT INTO `cargos` (`id_cargo`, `nombre`, `activo`) VALUES
	(1, 'Jefe de Sistemas', 1),
	(2, 'Secretaria de Gerencia', 1),
	(3, 'Operador de Maquinaria Pesada', 1),
	(4, 'Gerente General', 1),
	(5, 'Docente', 1),
	(6, 'Estudiante Ciclo Profesional', 1),
	(7, 'Desarrollador Junior', 1),
	(8, 'Cargos Nuevos', 1),
	(9, 'Desarrollador Master', 1),
	(10, 'Rector', 1),
	(11, 'djhgsdlh', 0);

-- Volcando estructura para función library.contar_autores_activos
DELIMITER //
CREATE FUNCTION `contar_autores_activos`(estado SMALLINT) RETURNS int unsigned
    READS SQL DATA
BEGIN
DECLARE total INT UNSIGNED;
SET total = (
	SELECT COUNT(*) 
  FROM autores 
  WHERE autores.estado = estado);
  RETURN total;
END//
DELIMITER ;

-- Volcando estructura para función library.contar_editoriales_activos
DELIMITER //
CREATE FUNCTION `contar_editoriales_activos`(
	`estado` SMALLINT
) RETURNS int unsigned
    READS SQL DATA
BEGIN
DECLARE total INT UNSIGNED;
SET total = (
	SELECT COUNT(*) 
  FROM editoriales 
  WHERE editoriales.estado = estado);
  RETURN total;
END//
DELIMITER ;

-- Volcando estructura para función library.contar_estudiantes_activos
DELIMITER //
CREATE FUNCTION `contar_estudiantes_activos`(
	`estado` SMALLINT
) RETURNS int unsigned
    READS SQL DATA
BEGIN
DECLARE total INT UNSIGNED;
SET total = (
	SELECT COUNT(*) 
  FROM estudiantes 
  WHERE estudiantes.activo = estado);
  RETURN total;
END//
DELIMITER ;

-- Volcando estructura para función library.contar_libros_activos
DELIMITER //
CREATE FUNCTION `contar_libros_activos`(
	`activo` SMALLINT
) RETURNS int unsigned
    READS SQL DATA
BEGIN
DECLARE total INT UNSIGNED;
SET total = (
	SELECT COUNT(*) 
  FROM libros 
  WHERE libros.activo = activo);
  RETURN total;
END//
DELIMITER ;

-- Volcando estructura para tabla library.editoriales
CREATE TABLE IF NOT EXISTS `editoriales` (
  `id_editorial` smallint NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_pais` smallint NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_editorial`),
  KEY `editoriales_paises` (`id_pais`),
  CONSTRAINT `editoriales_paises` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla library.editoriales: ~12 rows (aproximadamente)
INSERT INTO `editoriales` (`id_editorial`, `Nombre`, `id_pais`, `estado`) VALUES
	(1, 'Campestre S.A', 1, 0),
	(2, 'Panamericana Editorial', 1, 1),
	(4, 'magdalena', 1, 1),
	(6, 'litoral', 2, 1),
	(7, 'Editorial Gato Malo', 2, 1),
	(8, 'Educar Editores', 1, 0),
	(9, 'cañaveral sa', 1, 0),
	(11, 'master books', 1, 2),
	(12, 'Editorial Planeta', 2, 0),
	(13, 'Carvajal', 1, 1),
	(18, 'editorial del sur', 1, 0),
	(21, 'primavera', 2, 1),
	(22, 'asdf', 1, 0),
	(23, 'asdf', 2, 0),
	(24, 'editorial sa', 2, 0),
	(25, 'actualizada', 2, 0),
	(26, 'catedral del pacifico sur', 2, 0),
	(27, 'cama', 2, 0),
	(28, 'marianela', 1, 1),
	(29, 'del norte', 1, 0),
	(30, 'jaia', 2, 1),
	(31, 'de la sabana', 1, 1);

-- Volcando estructura para tabla library.estudiantes
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `id_estudiante` smallint NOT NULL AUTO_INCREMENT,
  `tipo_documento` smallint NOT NULL,
  `documento` varchar(15) NOT NULL,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `sexo` smallint NOT NULL,
  `estado_civil` smallint NOT NULL,
  `direccion` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `correo` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_programa` smallint NOT NULL DEFAULT '0',
  `telefono` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_estudiante`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `documento` (`documento`),
  KEY `estudiantes_programas` (`id_programa`),
  KEY `estudiantes_parametrosdet` (`tipo_documento`),
  KEY `sexo` (`sexo`) USING BTREE,
  KEY `estado_civil` (`estado_civil`) USING BTREE,
  CONSTRAINT `estadocivil_parametrosdet` FOREIGN KEY (`estado_civil`) REFERENCES `parametros_det` (`id_dparam`),
  CONSTRAINT `estudiantes_parametrosdet` FOREIGN KEY (`tipo_documento`) REFERENCES `parametros_det` (`id_dparam`),
  CONSTRAINT `estudiantes_programas` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id_programa`),
  CONSTRAINT `sexo_parametrosdet` FOREIGN KEY (`sexo`) REFERENCES `parametros_det` (`id_dparam`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla library.estudiantes: ~5 rows (aproximadamente)
INSERT INTO `estudiantes` (`id_estudiante`, `tipo_documento`, `documento`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `sexo`, `estado_civil`, `direccion`, `correo`, `id_programa`, `telefono`, `activo`) VALUES
	(3, 1, '1140882431', 'yisu', '', 'Messi', 'Ronaldo', 6, 10, 'Calle 45 # 45 - 79', 'jesus@gmail.com', 1, '3016782082', 0),
	(4, 1, '555555', 'Alejandra', 'maria', 'Becerra', 'gomez', 7, 10, 'calle 34', 'maria@gmail.com', 1, '53423443', 1),
	(19, 1, '888888888', 'maria', '', 'camila', '', 7, 10, 'calle 34', 'madria@gmail.com', 1, '53423443', 1),
	(20, 2, '1402', 'juan f', 'david', 'perez', 'hernandez', 6, 9, 'calle 34', 'juan@gmail.com', 1, '31025687445', 0),
	(21, 1, '14525878525', 'adriana', '', 'gutierrez', 'marquez', 7, 9, 'calle 56 # 45 - 67', 'adriana@gmail.com', 1, '3536898', 1),
	(23, 2, '2535487', 'manuel ddd', '', 'guerrero', '', 6, 10, 'call 34 # 6a - 54', 'manuel@gmail.com', 1, '3524587', 0),
	(24, 2, '1140882431d', 'juanito', '', 'carvajal', '', 7, 9, 'dsaf', 'juanito@gmail.com', 1, 'asdfsdf', 2),
	(25, 2, 'asdfff', 'mirian', '', 'guxman', '', 6, 10, 'asdfdf', 'mirian@gmail.com', 1, 'asdfsadf', 0),
	(26, 1, 'asdfasdfasdfd', 'asdf', 'asdf', 'asdf', 'asdf', 6, 9, 'asdf', 'asd@gmail.com', 1, 'asdfasdf', 1);

-- Volcando estructura para procedimiento library.insertar_autor
DELIMITER //
CREATE PROCEDURE `insertar_autor`(
in pn varchar(50),
in sn varchar(50),
in pa varchar(50),
in sa varchar(50),
in seu varchar(50),
in dir varchar(50),
in pais smallint
)
BEGIN
insert into autores(primer_nombre, segundo_nombre,primer_apellido, segundo_apellido,seudonimo,direccion,id_pais)
 values(pn,sn,pa,sa,seu,dir,pais);
END//
DELIMITER ;

-- Volcando estructura para procedimiento library.insertar_editorial
DELIMITER //
CREATE PROCEDURE `insertar_editorial`(
in nom varchar(50),
in pais smallint
)
BEGIN
insert into editoriales(Nombre, id_pais)
 values(nom,pais);
END//
DELIMITER ;

-- Volcando estructura para procedimiento library.insertar_estudiante
DELIMITER //
CREATE PROCEDURE `insertar_estudiante`(
in pn varchar(50),
in sn varchar(50),
in pa varchar(50),
in sa varchar(50),
IN td SMALLINT,
in doc VARCHAR(15),
IN sx SMALLINT,
IN ec SMALLINT,
in dir VARCHAR(150),
in cor VARCHAR(100),
IN pro SMALLINT,
in tel varchar(50)
)
BEGIN
insert into estudiantes(primer_nombre,segundo_nombre, primer_apellido, segundo_apellido, tipo_documento, documento, sexo, estado_civil, direccion, correo, id_programa, telefono)
 values(pn,sn,pa,sa,td,doc,sx,ec,dir,cor, pro, tel);
END//
DELIMITER ;

-- Volcando estructura para tabla library.libros
CREATE TABLE IF NOT EXISTS `libros` (
  `id_libros` smallint NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `id_editorial` smallint NOT NULL,
  `edicion` tinyint(1) NOT NULL DEFAULT '1',
  `paginas` smallint NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_libros`),
  KEY `libros_editoriales` (`id_editorial`),
  CONSTRAINT `libros_editoriales` FOREIGN KEY (`id_editorial`) REFERENCES `editoriales` (`id_editorial`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla library.libros: ~5 rows (aproximadamente)
INSERT INTO `libros` (`id_libros`, `nombre`, `id_editorial`, `edicion`, `paginas`, `activo`) VALUES
	(4, 'Harry', 21, 1, 1000, 0),
	(5, 'Aprende a programar', 1, 1, 200, 1),
	(6, 'magdalena', 13, 34, 344, 1),
	(7, 'Percy Jackson y los dioses del Olimpo', 2, 4, 1200, 1),
	(8, 'A Song of Ice and Fire', 2, 1, 500, 1),
	(9, 'jesus', 1, 34, 344, 1);

-- Volcando estructura para procedimiento library.obtener_estudiantes_estado
DELIMITER //
CREATE PROCEDURE `obtener_estudiantes_estado`(IN estado SMALLINT)
BEGIN
   SELECT id_estudiante, documento, pd.abreviado AS tipo_documento,p.nombre AS programa
FROM estudiantes AS e 
INNER JOIN parametros_det AS pd ON pd.id_dparam = e.tipo_documento
INNER JOIN programas AS p ON p.id_programa = e.id_programa
WHERE activo = estado;
END//
DELIMITER ;

-- Volcando estructura para procedimiento library.obtener_nombre_campos
DELIMITER //
CREATE PROCEDURE `obtener_nombre_campos`(in name varchar(50))
BEGIN
SELECT COLUMN_NAME
FROM INFORMATION_SCHEMA.Columns
WHERE TABLE_SCHEMA = database()
AND TABLE_NAME = NAME
ORDER BY COLUMN_NAME;
END//
DELIMITER ;

-- Volcando estructura para tabla library.paises
CREATE TABLE IF NOT EXISTS `paises` (
  `id_pais` smallint NOT NULL AUTO_INCREMENT,
  `cod_pais` smallint NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla library.paises: ~2 rows (aproximadamente)
INSERT INTO `paises` (`id_pais`, `cod_pais`, `nombre`, `estado`) VALUES
	(1, 57, 'Colombia', 1),
	(2, 58, 'ecuador', 1);

-- Volcando estructura para tabla library.parametros_det
CREATE TABLE IF NOT EXISTS `parametros_det` (
  `id_dparam` smallint NOT NULL AUTO_INCREMENT,
  `id_param` smallint NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `abreviado` varchar(15) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_dparam`),
  KEY `paramEnc_paramDet` (`id_param`),
  CONSTRAINT `paramEnc_paramDet` FOREIGN KEY (`id_param`) REFERENCES `parametros_enc` (`id_parametro`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla library.parametros_det: ~11 rows (aproximadamente)
INSERT INTO `parametros_det` (`id_dparam`, `id_param`, `nombre`, `abreviado`, `estado`) VALUES
	(1, 1, 'Cédula de Ciudadanía', 'CC', 1),
	(2, 1, 'Cédula de Extranjería', 'CE', 1),
	(3, 1, 'Pasaporte', 'PA', 1),
	(4, 1, 'Registro Civil', 'RC', 1),
	(5, 1, 'Tarjeta de Identidad', 'TI', 1),
	(6, 2, 'Masculino', 'M', 1),
	(7, 2, 'Femenino', 'F', 1),
	(8, 2, 'No Binario', 'NB', 1),
	(9, 3, 'Casado', 'C', 1),
	(10, 3, 'Soltero', 'S', 1),
	(11, 3, 'Unión Libre', 'UL', 1);

-- Volcando estructura para tabla library.parametros_enc
CREATE TABLE IF NOT EXISTS `parametros_enc` (
  `id_parametro` smallint NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `abreviado` varchar(15) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_parametro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla library.parametros_enc: ~2 rows (aproximadamente)
INSERT INTO `parametros_enc` (`id_parametro`, `Nombre`, `abreviado`, `estado`) VALUES
	(1, 'Tipo de documento', 'TD', 1),
	(2, 'Sexo', 'SX', 1),
	(3, 'Estado civil', 'EC', 1);

-- Volcando estructura para tabla library.programas
CREATE TABLE IF NOT EXISTS `programas` (
  `id_programa` smallint NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `resumen` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_programa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla library.programas: ~1 rows (aproximadamente)
INSERT INTO `programas` (`id_programa`, `nombre`, `resumen`, `estado`) VALUES
	(1, 'Gestión de Sistemas Informáticos', 'Gestión de Sistemas Informáticos', 1);

-- Volcando estructura para procedimiento library.sp_auditoria_log
DELIMITER //
CREATE PROCEDURE `sp_auditoria_log`(
                                   IN disparador VARCHAR(30), 
                                   IN tipo VARCHAR(15), 
                                   IN nivel VARCHAR(15), 
                                   IN comando VARCHAR(45),
                                   IN tabla VARCHAR(45),
                                   IN oldInfo LONGTEXT, 
                                   IN newInfo LONGTEXT)
BEGIN
      INSERT INTO auditoria (nombre_disparador,tipo_disparador,
                                    nivel_disparador,comando,tabla,old_info,new_info) 
      VALUES (disparador, tipo, nivel, comando, tabla, oldInfo, newInfo);
END//
DELIMITER ;

-- Volcando estructura para vista library.v_autores
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `v_autores` (
	`id_autor` SMALLINT(5) NOT NULL,
	`primer_nombre` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`segundo_nombre` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`primer_apellido` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`segundo_apellido` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`seudonimo` VARCHAR(200) NULL COLLATE 'latin1_swedish_ci',
	`direccion` VARCHAR(200) NULL COLLATE 'latin1_swedish_ci',
	`pais` VARCHAR(200) NOT NULL COLLATE 'latin1_swedish_ci',
	`estado` TINYINT(1) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista library.v_editoriales
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `v_editoriales` (
	`id_editorial` SMALLINT(5) NOT NULL,
	`Nombre` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`pais` VARCHAR(200) NOT NULL COLLATE 'latin1_swedish_ci',
	`estado` TINYINT(1) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista library.v_estado_civil
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `v_estado_civil` (
	`id_dparam` SMALLINT(5) NOT NULL,
	`id_param` SMALLINT(5) NOT NULL,
	`nombre` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`abreviado` VARCHAR(15) NOT NULL COLLATE 'latin1_swedish_ci',
	`estado` TINYINT(1) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista library.v_estudiantes
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `v_estudiantes` (
	`id_estudiante` SMALLINT(5) NOT NULL,
	`tipo_documento_abv` VARCHAR(15) NOT NULL COLLATE 'latin1_swedish_ci',
	`tipo_documento` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`documento` VARCHAR(15) NOT NULL COLLATE 'latin1_swedish_ci',
	`primer_nombre` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`segundo_nombre` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`primer_apellido` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`segundo_apellido` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`sexo_abv` VARCHAR(15) NOT NULL COLLATE 'latin1_swedish_ci',
	`sexo` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`estado_civil_abv` VARCHAR(15) NOT NULL COLLATE 'latin1_swedish_ci',
	`estado_civil` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`direccion` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci',
	`correo` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`programa` VARCHAR(200) NOT NULL COLLATE 'latin1_swedish_ci',
	`activo` TINYINT(1) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista library.v_genero
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `v_genero` (
	`id_dparam` SMALLINT(5) NOT NULL,
	`id_param` SMALLINT(5) NOT NULL,
	`nombre` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`abreviado` VARCHAR(15) NOT NULL COLLATE 'latin1_swedish_ci',
	`estado` TINYINT(1) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista library.v_tipo_documento
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `v_tipo_documento` (
	`id_dparam` SMALLINT(5) NOT NULL,
	`id_param` SMALLINT(5) NOT NULL,
	`nombre` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`abreviado` VARCHAR(15) NOT NULL COLLATE 'latin1_swedish_ci',
	`estado` TINYINT(1) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para disparador library.tg_insert_autores
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tg_insert_autores` AFTER INSERT ON `autores` FOR EACH ROW BEGIN
         CALL sp_auditoria_log('tg_insert_autores',
                               'AFTER', 'ROW', 'INSERT', 
                               'autores', 
                               NULL,
                               CONCAT(NEW.id_autor, '|', NEW.primer_nombre, '|', NEW.segundo_nombre, '|', NEW.primer_apellido, '|', NEW.segundo_apellido, '|', NEW.seudonimo, '|', NEW.direccion, '|', NEW.id_pais, '|', NEW.estado));
    END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador library.tg_insert_editoriales
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tg_insert_editoriales` AFTER INSERT ON `editoriales` FOR EACH ROW BEGIN
         CALL sp_auditoria_log('tg_insert_editoriales',
                               'AFTER', 'ROW', 'INSERT', 
                               'editoriales', 
                               NULL,
                               CONCAT(NEW.id_editorial, '|', NEW.nombre, '|', NEW.id_pais, '|', NEW.estado));
    END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador library.tg_insert_libros
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tg_insert_libros` AFTER INSERT ON `libros` FOR EACH ROW BEGIN
         CALL sp_auditoria_log('tg_insert_libros',
                               'AFTER', 'ROW', 'INSERT', 
                               'libros', 
                               NULL,
                               CONCAT(NEW.id_libros, '|', NEW.nombre, '|', NEW.id_editorial, '|', NEW.edicion, '|', NEW.paginas, '|', NEW.activo));
    END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador library.tg_update_autores
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tg_update_autores` AFTER UPDATE ON `autores` FOR EACH ROW BEGIN
        IF NEW.estado = 0 THEN 
        	 CALL sp_auditoria_log('tg_delete_autores',
                               'AFTER', 'ROW', 'DELETE', 
                               'autores', 
                               CONCAT(OLD.id_autor, '|', OLD.primer_nombre, '|', OLD.segundo_nombre, '|', OLD.primer_apellido, '|', OLD.segundo_apellido, '|', OLD.seudonimo, '|', OLD.direccion, '|', OLD.id_pais, '|', OLD.estado),
                              CONCAT(NEW.id_autor, '|', NEW.primer_nombre, '|', NEW.segundo_nombre, '|', NEW.primer_apellido, '|', NEW.segundo_apellido, '|', NEW.seudonimo, '|', NEW.direccion, '|', NEW.id_pais, '|', NEW.estado));
   		ELSE
   			 CALL sp_auditoria_log('tg_update_autores',
                               'AFTER', 'ROW', 'UPDATE', 
                               'autores', 
                               CONCAT(OLD.id_autor, '|', OLD.primer_nombre, '|', OLD.segundo_nombre, '|', OLD.primer_apellido, '|', OLD.segundo_apellido, '|', OLD.seudonimo, '|', OLD.direccion, '|', OLD.id_pais, '|', OLD.estado),
                              CONCAT(NEW.id_autor, '|', NEW.primer_nombre, '|', NEW.segundo_nombre, '|', NEW.primer_apellido, '|', NEW.segundo_apellido, '|', NEW.seudonimo, '|', NEW.direccion, '|', NEW.id_pais, '|', NEW.estado));
			END IF;
	
	 END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador library.tg_update_editoriales
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tg_update_editoriales` AFTER UPDATE ON `editoriales` FOR EACH ROW BEGIN
         IF NEW.estado = 0 THEN
         	CALL sp_auditoria_log('tg_delete_editoriales',
                               'AFTER', 'ROW', 'DELETE', 
                               'editoriales', 
                               CONCAT(OLD.id_editorial, '|', OLD.nombre, '|', OLD.id_pais, '|', OLD.estado),
                              CONCAT(NEW.id_editorial, '|', NEW.nombre, '|', NEW.id_pais, '|', NEW.estado));
         ELSE 
         	CALL sp_auditoria_log('tg_update_editoriales',
                               'AFTER', 'ROW', 'UPDATE', 
                               'editoriales', 
                               CONCAT(OLD.id_editorial, '|', OLD.nombre, '|', OLD.id_pais, '|', OLD.estado),
                              CONCAT(NEW.id_editorial, '|', NEW.nombre, '|', NEW.id_pais, '|', NEW.estado));
    		END IF;
	 END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador library.tg_update_libros
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tg_update_libros` AFTER UPDATE ON `libros` FOR EACH ROW BEGIN
         CALL sp_auditoria_log('tg_update_libros',
                               'AFTER', 'ROW', 'UPDATE', 
                               'libros', 
                               CONCAT(OLD.id_libros, '|', OLD.nombre, '|', OLD.id_editorial, '|', OLD.edicion, '|', OLD.paginas, '|', OLD.activo),
                              CONCAT(NEW.id_libros, '|', NEW.nombre, '|', NEW.id_editorial, '|', NEW.edicion, '|', NEW.paginas, '|', NEW.activo));
    END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para vista library.v_autores
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `v_autores`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_autores` AS select `a`.`id_autor` AS `id_autor`,`a`.`primer_nombre` AS `primer_nombre`,`a`.`segundo_nombre` AS `segundo_nombre`,`a`.`primer_apellido` AS `primer_apellido`,`a`.`segundo_apellido` AS `segundo_apellido`,`a`.`seudonimo` AS `seudonimo`,`a`.`direccion` AS `direccion`,`p`.`nombre` AS `pais`,`a`.`estado` AS `estado` from (`autores` `a` join `paises` `p` on((`p`.`id_pais` = `a`.`id_pais`)));

-- Volcando estructura para vista library.v_editoriales
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `v_editoriales`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_editoriales` AS select `e`.`id_editorial` AS `id_editorial`,`e`.`Nombre` AS `Nombre`,`p`.`nombre` AS `pais`,`e`.`estado` AS `estado` from (`editoriales` `e` join `paises` `p` on((`p`.`id_pais` = `e`.`id_pais`)));

-- Volcando estructura para vista library.v_estado_civil
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `v_estado_civil`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_estado_civil` AS select `parametros_det`.`id_dparam` AS `id_dparam`,`parametros_det`.`id_param` AS `id_param`,`parametros_det`.`nombre` AS `nombre`,`parametros_det`.`abreviado` AS `abreviado`,`parametros_det`.`estado` AS `estado` from `parametros_det` where (`parametros_det`.`id_param` = 3);

-- Volcando estructura para vista library.v_estudiantes
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `v_estudiantes`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_estudiantes` AS select `e`.`id_estudiante` AS `id_estudiante`,`pd`.`abreviado` AS `tipo_documento_abv`,`pd`.`nombre` AS `tipo_documento`,`e`.`documento` AS `documento`,`e`.`primer_nombre` AS `primer_nombre`,`e`.`segundo_nombre` AS `segundo_nombre`,`e`.`primer_apellido` AS `primer_apellido`,`e`.`segundo_apellido` AS `segundo_apellido`,`pd2`.`abreviado` AS `sexo_abv`,`pd2`.`nombre` AS `sexo`,`pd3`.`abreviado` AS `estado_civil_abv`,`pd3`.`nombre` AS `estado_civil`,`e`.`direccion` AS `direccion`,`e`.`correo` AS `correo`,`p`.`nombre` AS `programa`,`e`.`activo` AS `activo` from ((((`estudiantes` `e` join `parametros_det` `pd` on((`pd`.`id_dparam` = `e`.`tipo_documento`))) join `parametros_det` `pd2` on((`pd2`.`id_dparam` = `e`.`sexo`))) join `parametros_det` `pd3` on((`pd3`.`id_dparam` = `e`.`estado_civil`))) join `programas` `p` on((`p`.`id_programa` = `e`.`id_programa`))) WITH LOCAL CHECK OPTION;

-- Volcando estructura para vista library.v_genero
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `v_genero`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_genero` AS select `parametros_det`.`id_dparam` AS `id_dparam`,`parametros_det`.`id_param` AS `id_param`,`parametros_det`.`nombre` AS `nombre`,`parametros_det`.`abreviado` AS `abreviado`,`parametros_det`.`estado` AS `estado` from `parametros_det` where (`parametros_det`.`id_param` = 2);

-- Volcando estructura para vista library.v_tipo_documento
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `v_tipo_documento`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_tipo_documento` AS select `parametros_det`.`id_dparam` AS `id_dparam`,`parametros_det`.`id_param` AS `id_param`,`parametros_det`.`nombre` AS `nombre`,`parametros_det`.`abreviado` AS `abreviado`,`parametros_det`.`estado` AS `estado` from `parametros_det` where (`parametros_det`.`id_param` = 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
