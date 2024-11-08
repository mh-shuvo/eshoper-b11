CREATE TABLE IF NOT EXISTS `products`(
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `category_id` int(10) NOT NULL,
    `product_name` varchar(100) NOT NULL,
    `description` text NOT NULL,
    `price` double(8,2) NOT NULL DEFAULT 0,
    `image` varchar(100) NOT NULL,
    `is_featured` boolean DEFAULT FALSE,
    `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),
    CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
);
