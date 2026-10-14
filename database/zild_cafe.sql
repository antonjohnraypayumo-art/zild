-- =====================================================================
--  Zild Cafe  -  MySQL / MariaDB schema + starter data (XAMPP / phpMyAdmin)
--
--  OPTION B (standalone): import this file in phpMyAdmin (Import tab).
--  OPTION A (recommended with Laravel): do NOT import this file; run
--      php artisan migrate --seed
--  Use one option or the other, never both on the same database.
--
--  Development starter data only. Do not use the demo customer on a live site.
--  Production admin accounts should be provisioned through the Laravel seeder
--  with ZILD_ADMIN_EMAIL and a unique ZILD_ADMIN_PASSWORD (12+ characters).
-- =====================================================================

CREATE DATABASE IF NOT EXISTS `zild_cafe` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `zild_cafe`;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------ Laravel base tables ------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `delivery_latitude` decimal(10,7) DEFAULT NULL,
  `delivery_longitude` decimal(10,7) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `credits` decimal(10,2) NOT NULL DEFAULT 0.00,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------ Menu ------------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_is_available_index` (`category_id`,`is_available`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `product_sizes`;
CREATE TABLE `product_sizes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `name` varchar(60) NOT NULL,
  `code` varchar(40) NOT NULL,
  `price_modifier` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` smallint unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_sizes_product_id_code_unique` (`product_id`,`code`),
  CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------ Cart ------------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `token` char(36) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `carts_token_unique` (`token`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `product_size_id` bigint unsigned DEFAULT NULL,
  `quantity` smallint unsigned NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cart_items_cart_id_product_id_product_size_id_unique` (`cart_id`,`product_id`,`product_size_id`),
  KEY `cart_items_product_id_foreign` (`product_id`),
  KEY `cart_items_product_size_id_foreign` (`product_size_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_items_product_size_id_foreign` FOREIGN KEY (`product_size_id`) REFERENCES `product_sizes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------ Orders ------------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(30) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(30) NOT NULL,
  `payment_method` enum('cod','paymaya','gcash','credits') NOT NULL,
  `payment_status` enum('unpaid','paid','refunded') NOT NULL DEFAULT 'unpaid',
  `status` enum('pending','preparing','out_for_delivery','completed','cancelled') NOT NULL DEFAULT 'pending',
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_status_index` (`status`),
  KEY `orders_created_at_index` (`created_at`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `product_size_id` bigint unsigned DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `size_name` varchar(60) DEFAULT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `quantity` smallint unsigned NOT NULL,
  `line_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  KEY `order_items_product_size_id_foreign` (`product_size_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  CONSTRAINT `order_items_product_size_id_foreign` FOREIGN KEY (`product_size_id`) REFERENCES `product_sizes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------ Website content ------------------------------
DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text,
  `content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_posts_slug_unique` (`slug`),
  KEY `blog_posts_is_published_published_at_index` (`is_published`,`published_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `rating` tinyint unsigned NOT NULL,
  `comment` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `team_members`;
CREATE TABLE `team_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `bio` text,
  `photo` varchar(255) DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================================
--  Starter data
-- =====================================================================

INSERT INTO `users` (`id`,`name`,`email`,`phone`,`password`,`role`,`credits`,`created_at`,`updated_at`) VALUES
(2,'Demo Customer','customer@example.com','09171234567','$2y$10$qQYVMoIPdcV8pGJkGCPT/.9v8vtFeEB5uqaOqugJ2w2Ymrfha.WJy','customer',500.00,'2026-10-14 00:00:00','2026-10-14 00:00:00');

INSERT INTO `categories` (`id`,`name`,`slug`,`description`,`image`,`sort_order`,`created_at`,`updated_at`) VALUES
(1,'Drinks','drinks','Frappes, matcha, espresso and refreshers.','images/SHAKE.jpg',1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(2,'Snacks','snacks','Burgers, fries, nachos, pasta and more.','images/SNACKS.jpg',2,'2026-10-14 00:00:00','2026-10-14 00:00:00');

INSERT INTO `products` (`id`,`category_id`,`name`,`slug`,`description`,`price`,`image`,`is_available`,`is_featured`,`created_at`,`updated_at`) VALUES
(1,1,'Chocolate Frappee','chocolate-frappee','Rich, chocolatey indulgence blended to perfection.',169.00,'images/chocolate frappee.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(2,1,'Strawberry Matcha','strawberry-matcha','Creamy matcha green tea layered with sweet strawberry.',139.00,'images/matcha latte.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(3,1,'Refresh Drink','refresh-drink','Cool, fruity, and revitalizing — the perfect thirst quencher.',110.00,'images/refresh drink.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(4,1,'Caramel Frappee','caramel-frappee','Sweet strawberry blended with a buttery cookie twist.',189.00,'images/stawberry biscoff.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(5,1,'Strawberry Jam','strawberry-jam','Sweet, tangy strawberry goodness in every sip.',179.00,'images/strawberry jam.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(6,1,'Iced Espresso','iced-espresso','Chilled espresso served over ice — bold and refreshing.',119.00,'images/espresso.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(7,1,'Caramel Macchiato','caramel-macchiato','Espresso, steamed milk, vanilla, and caramel drizzle.',129.00,'images/machiatto.jpg',1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(8,1,'Blueberry Frappee','blueberry-frappee','Creamy, blended drink with blueberries, ice, and milk.',189.00,'images/blueberry.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(9,1,'Matcha Latte','matcha-latte','Smooth, earthy matcha blended with steamed milk.',129.00,'images/matcha.jpg',1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(10,1,'Java Chip with Coffee Jelly','java-chip-with-coffee-jelly','Blended coffee, chocolate chips, and coffee jelly for a rich, chewy treat.',189.00,'images/coffeejelly.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(11,2,'Burger','burger','Juicy patty, fresh veggies, and sauces in a soft bun.',110.00,'images/burger.jpg',1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(12,2,'Hotdog Sandwich','hotdog-sandwich','Grilled sausage in a bun with toppings like ketchup, mustard, and onions.',89.00,'images/footlong.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(13,2,'Fries','fries','Crispy, golden potato sticks — salty and delicious.',75.00,'images/fries.avif',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(14,2,'Nachos','nachos','Crispy tortilla chips topped with cheese, salsa, and other tasty toppings.',119.00,'images/nachos.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(15,2,'Tuna Pie','tuna-pie','Crispy crust filled with creamy, savory tuna filling.',49.00,'images/tuna pie.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(16,2,'Chicken Pop','chicken-pop','Bite-sized, crispy, and juicy fried chicken snacks.',99.00,'images/chicken.jpg',1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(17,2,'Pasta (Carbonara)','pasta-carbonara','Creamy Italian pasta dish made with eggs, cheese, pancetta, and pepper — rich, savory, and comforting.',120.00,'images/pasta.webp',1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00');

INSERT INTO `product_sizes` (`id`,`product_id`,`name`,`code`,`price_modifier`,`is_default`,`sort_order`,`created_at`,`updated_at`) VALUES
(1,1,'Tall','tall',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(2,1,'Grande','grande',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(3,1,'Venti','venti',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(4,2,'Tall','tall',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(5,2,'Grande','grande',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(6,2,'Venti','venti',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(7,3,'Tall','tall',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(8,3,'Grande','grande',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(9,3,'Venti','venti',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(10,4,'Tall','tall',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(11,4,'Grande','grande',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(12,4,'Venti','venti',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(13,5,'Tall','tall',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(14,5,'Grande','grande',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(15,5,'Venti','venti',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(16,6,'Tall','tall',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(17,6,'Grande','grande',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(18,6,'Venti','venti',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(19,7,'Tall','tall',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(20,7,'Grande','grande',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(21,7,'Venti','venti',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(22,8,'Tall','tall',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(23,8,'Grande','grande',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(24,8,'Venti','venti',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(25,9,'Tall','tall',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(26,9,'Grande','grande',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(27,9,'Venti','venti',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(28,10,'Tall','tall',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(29,10,'Grande','grande',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(30,10,'Venti','venti',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(31,11,'Regular','regular',0.00,1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(32,11,'with Cheese','double',0.00,0,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(33,11,'with Egg and Cheese','triple',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(34,12,'Regular','regular',0.00,1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(35,12,'Footlong','footlong',0.00,0,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(36,13,'Small','small',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(37,13,'Medium','medium',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(38,13,'Large','large',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(39,14,'Solo','solo',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(40,14,'Regular','regular',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(41,14,'Party','party',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(42,15,'Regular','regular',0.00,1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(43,15,'Jumbo','jumbo',0.00,0,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(44,16,'Small','small',0.00,0,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(45,16,'Medium','medium',0.00,1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(46,16,'Large','large',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(47,17,'Regular','regular',0.00,1,0,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(48,17,'Large','large',0.00,0,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(49,17,'Family Size','family',0.00,0,2,'2026-10-14 00:00:00','2026-10-14 00:00:00');

INSERT INTO `blog_posts` (`id`,`title`,`slug`,`excerpt`,`content`,`image`,`is_published`,`published_at`,`created_at`,`updated_at`) VALUES
(1,'The Art of Brewing Coffee','the-art-of-brewing-coffee','Discover the techniques and secrets behind brewing the perfect cup of coffee at home.','<p>Coffee Jelly is a unique dessert that combines the bold flavors of coffee with a fun, chewy texture. In this post, we''ll take a closer look at the origins of coffee jelly, the process of making it, and why it’s a favorite treat for coffee lovers.</p><h2>The Making of Coffee</h2><p>Coffee Jelly is made by brewing strong coffee and combining it with agar-agar or gelatin to create a firm, jelly-like texture.</p><h2>Flavored Profile</h2><p>The flavor of coffee jelly is a perfect balance between the bitterness of coffee and the smoothness of cream.</p><h2>Conclusion</h2><p>Coffee Jelly is more than just a fun dessert; it’s an exciting way to enjoy coffee in a new form.</p>','images/coffeejelly.jpg',1,'2025-04-14 00:00:00','2026-10-14 00:00:00','2026-10-14 00:00:00'),
(2,'Coffee and Health','coffee-and-health','Learn about the health benefits of coffee and how it boosts your well-being.','<p>Our signature burger is a hearty and juicy delight stacked high with a perfectly grilled beef patty, fresh lettuce, ripe tomatoes, crispy pickles, and creamy cheese. All tucked between warm, toasted buns and drizzled with our special house sauce, it’s the ultimate comfort food for any craving.</p><h2>Premium Ingredients</h2><p>We use 100% pure beef, farm-fresh veggies, and a secret blend of spices to deliver a rich, satisfying flavor in every bite. No shortcuts, just real goodness.</p><h2>Flavor Explosion</h2><p>Every layer is crafted to balance texture and taste—from the soft bun to the crisp toppings and savory patty. It''s a burst of flavor you won’t forget.</p><h2>Why You’ll Love It</h2><p>Whether you’re dining in or grabbing on the go, our burger is guaranteed to hit the spot. It’s not just a meal—it’s an experience.</p>','images/burger.jpg',1,'2025-04-14 00:00:00','2026-10-14 00:00:00','2026-10-14 00:00:00'),
(3,'Sustainable Coffee Practices','sustainable-coffee-practices','Explore how we source coffee sustainably and support local farmers.','<p>Our homemade strawberry jam is a delightful blend of sun-ripened strawberries, gently simmered to bring out their natural sweetness and vibrant flavor. It''s a classic spread that turns any snack or breakfast into a treat.</p><h2>Fresh and Fruity</h2><p>Made with real strawberries and just the right amount of sugar, this jam captures the juicy, tangy-sweet essence of the fruit in every spoonful.</p><h2>Perfect Pairings</h2><p>Spread it over warm toast, pancakes, waffles, or swirl it into your yogurt and oatmeal. It also makes a fantastic filling for pastries and cakes.</p><h2>Why You''ll Love It</h2><p>With no artificial flavors or preservatives, our strawberry jam is made with love and care—just like grandma used to make. Sweet, simple, and irresistibly delicious.</p>','images/strawberry jam.jpg',1,'2025-04-14 00:00:00','2026-10-14 00:00:00','2026-10-14 00:00:00');

INSERT INTO `reviews` (`id`,`customer_name`,`rating`,`comment`,`image`,`is_approved`,`created_at`,`updated_at`) VALUES
(1,'John Doe',4,'The coffee is fantastic! I love the rich flavors and the aroma. Highly recommend!','images/review1.jpg',1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(2,'Jane Smith',5,'Best coffee I''ve ever had! The quality is unmatched, and the service is excellent.','images/review2.jpg',1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(3,'Emily Johnson',3,'Good coffee, but I expected a bit more flavor. Still a solid choice!','images/review3.jpg',1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(4,'Michael Brown',4,'Great atmosphere and even better coffee! A must-visit for coffee lovers.','images/review4.jpg',1,'2026-10-14 00:00:00','2026-10-14 00:00:00');

INSERT INTO `team_members` (`id`,`name`,`position`,`bio`,`photo`,`sort_order`,`is_active`,`created_at`,`updated_at`) VALUES
(1,'Christian Ver','Owner & CEO','Christian is the visionary behind Zild Coffee. With a deep passion for coffee and community, he founded the shop to bring people together through high-quality brews and a cozy atmosphere.','images/chris2.jpg',1,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(2,'Jenifer','Wife of CEO','Jenifer supports the heart of Zild Coffee, helping with daily operations and ensuring a warm, welcoming atmosphere for everyone.','images/jen2.jpg',2,1,'2026-10-14 00:00:00','2026-10-14 00:00:00'),
(3,'Maila Bacani','Helper','Maila is the reliable helping hand at Zild Coffee, assisting in daily tasks and making sure everything stays neat and organized.','images/maila.jpg',3,1,'2026-10-14 00:00:00','2026-10-14 00:00:00');

INSERT INTO `settings` (`key`,`value`,`created_at`,`updated_at`) VALUES
('cafe_name','Zild Cafe','2026-10-14 00:00:00','2026-10-14 00:00:00'),
('tagline','Coffee that hits the right notes.','2026-10-14 00:00:00','2026-10-14 00:00:00'),
('about_short','Where every cup tells a story — Zild Coffee, your cozy corner for brews, bites, and beautiful moments.','2026-10-14 00:00:00','2026-10-14 00:00:00'),
('phone','0930 558 4612','2026-10-14 00:00:00','2026-10-14 00:00:00'),
('email','contact@ZildCafe.com','2026-10-14 00:00:00','2026-10-14 00:00:00'),
('address','Steady Ready, Sta. Rosa, Concepcion, Tarlac','2026-10-14 00:00:00','2026-10-14 00:00:00'),
('hours_weekdays','Mon-Fri: 2:00 P.M - 10:00 P.M','2026-10-14 00:00:00','2026-10-14 00:00:00'),
('hours_weekends','Sat-Sun: 12:00 P.M - 11:00 P.M','2026-10-14 00:00:00','2026-10-14 00:00:00');
