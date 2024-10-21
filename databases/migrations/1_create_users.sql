CREATE TABLE IF NOT EXISTS `users`(

    `id` int(10) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(50) NOT NULL,
    `password` varchar(50) NOT NULL,
    `status` enum('active','inactive') NOT NULL DEFAULT 'active',
    `type` enum('admin','customer') NOT NULL DEFAULT 'customer',
    `is_superadmin` boolean DEFAULT FALSE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY(`id`),
    UNIQUE KEY (`email`)
);