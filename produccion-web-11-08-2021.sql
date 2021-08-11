-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.21 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para produccion_web
CREATE DATABASE IF NOT EXISTS `produccion_web` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `produccion_web`;

-- Volcando estructura para tabla produccion_web.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `is_available` enum('N','S') NOT NULL DEFAULT 'N',
  `name` varchar(200) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla produccion_web.brands: 7 rows
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` (`brand_id`, `is_available`, `name`, `deleted_at`) VALUES
	(2, 'S', 'Rolex', NULL),
	(3, 'S', 'Bulgari', NULL),
	(4, 'S', 'Omega', NULL),
	(6, 'N', 'prueba', '2021-05-02 22:47:54'),
	(7, 'N', 'prueba', '2021-05-02 22:48:28'),
	(8, 'N', 'Pulseras', '2021-05-02 23:30:24'),
	(9, 'N', 'Pulseras doradas', '2021-05-02 23:30:44');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;

-- Volcando estructura para tabla produccion_web.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `is_available` enum('N','S') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(200) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla produccion_web.categories: 7 rows
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`category_id`, `is_available`, `name`, `deleted_at`) VALUES
	(1, 'S', 'Relojes dorados', NULL),
	(2, 'N', 'Relojes plateados', '2021-05-05 22:21:26'),
	(6, 'N', 'Pulseras', '2021-05-02 22:43:36'),
	(7, 'N', 'Pulseras', '2021-05-02 22:02:21'),
	(8, 'N', 'qwerqwer', '2021-05-02 22:31:19'),
	(9, 'N', 'Pulseras', '2021-05-02 22:45:28'),
	(10, 'S', 'Relojes Plateados', NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Volcando estructura para tabla produccion_web.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `description` text,
  `stars` int DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla produccion_web.comments: 12 rows
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`comment_id`, `product_id`, `user`, `description`, `stars`, `is_visible`, `created_at`) VALUES
	(6, 5, 'Francisco', 'Está buenísimo!!', 3, 1, '2021-05-03 20:43:48'),
	(7, 5, 'Francisco', 'Buenardo', 1, 1, '2021-05-03 20:44:03'),
	(9, 5, 'Marcos', 'otro comentario', 4, 1, '2021-05-05 22:18:16'),
	(11, 7, 'Marcossssss customer', 'asdasdasd', 5, NULL, '2021-06-30 21:33:33'),
	(12, 6, 'Facu Cliente', 'comentario facu cliente', 1, NULL, '2021-06-30 21:35:12'),
	(14, 7, 'Marcos ventas', 'asdasdasdasd', 5, NULL, '2021-08-10 23:10:35'),
	(21, 6, 'Marcos admin', 'Muy buen reloj', 4, NULL, '2021-08-11 00:14:48'),
	(15, 6, 'Marcos admin', 'prueba', 5, NULL, '2021-08-10 23:46:29'),
	(16, 8, 'Marcos admin', 'comentario', 5, NULL, '2021-08-10 23:46:49'),
	(18, 5, 'Marcos admin', 'Muy bueno che', 4, NULL, '2021-08-11 00:04:15'),
	(19, 5, 'Marcos admin', 'Muy buen reloj', 4, NULL, '2021-08-11 00:07:05'),
	(20, 2, 'Nico customer', 'comentario', 5, NULL, '2021-08-11 00:07:41');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Volcando estructura para tabla produccion_web.products
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL DEFAULT '0',
  `brand_id` int NOT NULL DEFAULT '0',
  `is_available` enum('N','S') NOT NULL DEFAULT 'N',
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  `image` varchar(200) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla produccion_web.products: 7 rows
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`product_id`, `category_id`, `brand_id`, `is_available`, `name`, `description`, `price`, `stock`, `image`, `deleted_at`, `updated_at`) VALUES
	(1, 1, 2, 'N', 'Reloj con malla de cuero', 'Lorem ipsum dolor sit amet', 123456, 12, 'rolex_dorado_2.jpg', NULL, NULL),
	(2, 1, 2, 'S', 'Reloj nuevo', 'Lorem ipsum dolor sit amet', 100000, 5, 'omega_dorado_1.jpg', NULL, NULL),
	(5, 1, 3, 'S', 'Reloj Bulgari Dorado', 'Lorem ipsum dolor sit amet', 100000, 5, 'bulgari_dorado_1.jpg', NULL, NULL),
	(6, 10, 2, 'S', 'Reloj Bulgari Plateado 2', 'Lorem ipsum dolor sit amet', 150000, 5555555, 'bulgari_plateado_1.jpg', NULL, '2021-06-27 21:50:11'),
	(7, 1, 2, 'S', 'Reloj Omega Dorado', 'Lorem ipsum dolor sit amet', 100000, 3, 'omega_dorado_1.jpg', NULL, NULL),
	(8, 10, 2, 'S', 'Reloj Omega Plateado', 'Lorem ipsum dolor sit amet', 100000, 3, 'omega_plateado_1.jpg', NULL, NULL),
	(18, 10, 4, 'S', 'asdasd', 'asdasd', 12312300, 312123, 'rolex_acero_2.jpg', NULL, NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Volcando estructura para tabla produccion_web.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla produccion_web.roles: 3 rows
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'CLIENTE'),
	(2, 'VENTAS'),
	(3, 'ADMIN');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla produccion_web.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `rol_id` int NOT NULL DEFAULT '0',
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla produccion_web.users: 4 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `rol_id`, `first_name`, `last_name`, `email`, `password`, `deleted_at`) VALUES
	(1, 2, 'Marcos', 'ventas', 'marcos.andres.romero@gmail.com', '530b350d414da3378a15b3149b322908', NULL),
	(3, 1, 'Nico', 'customer', 'marcos.andres.romero@gmail.com', '4983a0ab83ed86e0e7213c8783940193', NULL),
	(2, 3, 'Marcos', 'admin', 'marcos.andres.romero@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL),
	(9, 1, 'Facu', 'Cliente', 'facu@gmail.com', '4983a0ab83ed86e0e7213c8783940193', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
