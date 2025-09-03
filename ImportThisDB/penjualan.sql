-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for penjualan
CREATE DATABASE IF NOT EXISTS `penjualan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `penjualan`;

-- Dumping structure for table penjualan.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.cache: ~0 rows (approximately)

-- Dumping structure for table penjualan.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.cache_locks: ~0 rows (approximately)

-- Dumping structure for table penjualan.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.categories: ~0 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Makanan Ringan', 'Berbagai macam makanan ringan dan cemilan.', '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(2, 'Minuman Dingin', 'Minuman kemasan yang disajikan dingin.', '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(3, 'Alat Tulis Kantor', 'Perlengkapan untuk kebutuhan kantor dan sekolah.', '2025-09-03 10:11:42', '2025-09-03 10:11:42');

-- Dumping structure for table penjualan.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.customers: ~0 rows (approximately)
INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'Budi Santoso', '081234567890', 'budi.s@example.com', 'Jl. Merdeka No. 10, Jakarta', '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(2, 'Ani Lestari', '087712345678', 'ani.lestari@example.com', 'Jl. Pahlawan No. 5, Bandung', '2025-09-03 10:11:42', '2025-09-03 10:11:42');

-- Dumping structure for table penjualan.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table penjualan.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.jobs: ~0 rows (approximately)

-- Dumping structure for table penjualan.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.job_batches: ~0 rows (approximately)

-- Dumping structure for table penjualan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.migrations: ~1 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_01_01_000002_create_customers_table', 1),
	(5, '2024_01_01_000003_create_categories_table', 1),
	(6, '2024_01_01_000004_create_products_table', 1),
	(7, '2024_01_01_000005_create_sales_table', 1),
	(8, '2024_01_01_000006_create_sale_details_table', 1),
	(9, '2024_01_01_000007_create_payments_table', 1);

-- Dumping structure for table penjualan.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` bigint unsigned NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_method` enum('cash','transfer','qris') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_sale_id_foreign` (`sale_id`),
  CONSTRAINT `payments_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.payments: ~0 rows (approximately)

-- Dumping structure for table penjualan.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `stock` int NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_code_unique` (`code`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.products: ~0 rows (approximately)
INSERT INTO `products` (`id`, `code`, `name`, `category_id`, `price`, `stock`, `unit`, `created_at`, `updated_at`) VALUES
	(1, 'P001', 'Keripik Kentang Original', 1, 12500.00, 150, 'pcs', '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(2, 'P002', 'Biskuit Coklat', 1, 7000.00, 200, 'pcs', '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(3, 'P003', 'Teh Botol Kotak', 2, 3500.00, 300, 'btl', '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(4, 'P004', 'Air Mineral 600ml', 2, 3000.00, 400, 'btl', '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(5, 'P005', 'Pulpen Pilot G2', 3, 15000.00, 99, 'pcs', '2025-09-03 10:11:42', '2025-09-03 11:03:54'),
	(6, 'P006', 'Wipol', 2, 25000.00, 30, 'Pcs', '2025-09-03 10:54:45', '2025-09-03 10:59:58');

-- Dumping structure for table penjualan.sales
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(15,2) NOT NULL,
  `payment_method` enum('cash','transfer','qris') COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_amount` decimal(15,2) NOT NULL,
  `change_amount` decimal(15,2) NOT NULL,
  `sale_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sales_invoice_number_unique` (`invoice_number`),
  KEY `sales_customer_id_foreign` (`customer_id`),
  KEY `sales_user_id_foreign` (`user_id`),
  CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.sales: ~0 rows (approximately)
INSERT INTO `sales` (`id`, `invoice_number`, `customer_id`, `user_id`, `total_amount`, `discount`, `grand_total`, `payment_method`, `paid_amount`, `change_amount`, `sale_date`, `created_at`, `updated_at`) VALUES
	(1, 'INV-20250901-0001', 1, 3, 28500.00, 0.00, 28500.00, 'cash', 30000.00, 1500.00, '2025-09-01 17:11:42', '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(2, 'INV-20250902-0001', 2, 3, 38500.00, 3500.00, 35000.00, 'qris', 35000.00, 0.00, '2025-09-02 17:11:42', '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(3, 'INV-1756922398-Ixby', NULL, NULL, 25000.00, 500.00, 24500.00, 'qris', 25000.00, 500.00, '2025-09-03 17:59:58', '2025-09-03 10:59:58', '2025-09-03 10:59:58'),
	(4, 'INV-1756922634-9cZL', NULL, NULL, 15000.00, 3450.00, 11550.00, 'transfer', 32000.00, 20450.00, '2025-09-03 18:03:54', '2025-09-03 11:03:54', '2025-09-03 11:03:54');

-- Dumping structure for table penjualan.sale_details
CREATE TABLE IF NOT EXISTS `sale_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_details_sale_id_foreign` (`sale_id`),
  KEY `sale_details_product_id_foreign` (`product_id`),
  CONSTRAINT `sale_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.sale_details: ~0 rows (approximately)
INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 2, 12500.00, 25000.00, '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(2, 1, 4, 1, 3000.00, 3000.00, '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(3, 2, 5, 1, 15000.00, 15000.00, '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(4, 2, 2, 2, 7000.00, 14000.00, '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(5, 2, 3, 2, 3500.00, 7000.00, '2025-09-03 10:11:42', '2025-09-03 10:11:42'),
	(6, 3, 6, 1, 25000.00, 25000.00, '2025-09-03 10:59:58', '2025-09-03 10:59:58'),
	(7, 4, 5, 1, 15000.00, 15000.00, '2025-09-03 11:03:54', '2025-09-03 11:03:54');

-- Dumping structure for table penjualan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','kasir','manajer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table penjualan.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Utama', 'admin@example.com', '$2y$12$P1XAtSv8Faq0O9QowNuHResqhCQiZknrwqiFrO5x4DUIRmwpzl36K', 'admin', '2025-09-03 10:11:41', '2025-09-03 10:11:41'),
	(2, 'Manajer Penjualan', 'manajer@example.com', '$2y$12$Z8fWrrRfqW.gJ2Hsbo1mf./WXVr2zbaAY93LFdocNhRIelhHPmnaa', 'manajer', '2025-09-03 10:11:41', '2025-09-03 10:11:41'),
	(3, 'Kasir Satu', 'kasir1@example.com', '$2y$12$zHQAGiLcd3BCyMaVd0dqA.qEPIad/FOHhsyW2LG7gd/r6uEXF67VC', 'kasir', '2025-09-03 10:11:42', '2025-09-03 10:11:42');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
