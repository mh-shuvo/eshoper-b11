<?php
// use Atova\Eshoper\Foundation\Database;

// $db = new Database();

// $db->query("INSERT INTO `users` (`name`,'email',`password`,`user_type`,`is_superadmin`) VALUES (:name,:email,:password,:type,:is_sa)");

echo password_hash(123456, PASSWORD_DEFAULT);

