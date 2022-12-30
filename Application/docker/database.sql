DROP DATABASE IF EXISTS `details`;
CREATE DATABASE `details` DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
USE `details`;

CREATE TABLE `users` (
    `id` INT NOT NULL  AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `added_on` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci AUTO_INCREMENT = 4;

CREATE TABLE IF NOT EXISTS `cordinaten` (
  `idcordinaten` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `latitude` VARCHAR(255) NOT NULL UNIQUE,
  `longitude` VARCHAR(255) NOT NULL UNIQUE,
  `added_on` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`idcordinaten`, `users_id`),
  FOREIGN KEY (`users_id`) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci AUTO_INCREMENT = 4;

INSERT INTO `users` VALUES (1,'Ezekiel', '$2y$10$YrY3/m/ry/hGAhVEcfWPrOgQgv.nO/nxSXJLP4vQP..stPK/2uSzC','test@gmail.com', now());
INSERT INTO `users` VALUES (2,'Akindele', '$2y$10$YrY3/m/ry/hGAhVEcfWPrOgQgv.nO/nxSXJLP4vQP..stPK/2uSzC','testOne@gmail.com', now());

