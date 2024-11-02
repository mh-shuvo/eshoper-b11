CREATE TABLE IF NOT EXISTS `categories`(
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `image` varchar(100) NOT NULL,
    `is_featured` boolean DEFAULT FALSE,
    `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`)
);
