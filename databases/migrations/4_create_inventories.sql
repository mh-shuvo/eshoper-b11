CREATE TABLE IF NOT EXISTS `inventories`(
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `stock_input_date` DATE NOT NULL,
    `product_id` int(10) NOT NULL,
    `quantity` int(5) NOT NULL,
    `action` enum('IN','OUT') DEFAULT 'IN',
    `price` double(8,2) NOT NULL DEFAULT 0,
    `total` double(8,2) NOT NULL DEFAULT 0,
    `note` text DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),
    CONSTRAINT `fk_inventories_product_id` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`)
);
