CREATE DATABASE tech_power;
USE tech_power;


-- ********* Tabela Utilizadores ********* --
CREATE TABLE `user`(
 `id`                   int(11) NOT NULL PRIMARY KEY,
 `username`             varchar(255) NOT NULL ,
 `auth_key`             varchar(32) NOT NULL ,
 `password_hash`        varchar(255) NOT NULL ,
 `password_reset_token` varchar(255) NOT NULL ,
 `email`                varchar(255) NOT NULL ,
 `status`               int(6) NOT NULL ,
 `created_at`           int(11) NOT NULL ,
 `updated_at`           int(11) NOT NULL ,
 `verification_token`   varchar(255) NOT NULL
) ENGINE = InnoDb;


-- ********* Tabela Perfis ********* --
CREATE TABLE `profile`(
 `phone`       varchar(20) NULL ,
 `address`     varchar(255) NULL ,
 `nif`         int(9) NULL ,
 `postal_code` varchar(8) NULL ,
 `city`        varchar(50) NULL ,
 `country`     varchar(100) NULL ,
 `id`          int(11) NOT NULL,
FOREIGN KEY (`id`) REFERENCES `user` (`id`)
) ENGINE = InnoDb;


-- ********* Tabela Categorias ********* --
CREATE TABLE `category`(
 `id`          int NOT NULL PRIMARY KEY,
 `description` varchar(200) NOT NULL ,
 `parent_id`   int NOT NULL ,
FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`)
) ENGINE = InnoDb;


-- ********* Tabela Vendas ********* --
CREATE TABLE `sale`(
 `id`            int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `sale_date`     datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 `total_amount`  decimal(12,2) NOT NULL ,
 `sale_finished` bit NOT NULL
) ENGINE = InnoDb;


-- ********* Tabela Produtos ********* --
CREATE TABLE `product`(
 `id`              int NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `product_name`    varchar(50) NOT NULL ,
 `unit_price`      decimal(12,2) NULL ,
 `is_discontinued` bit NOT NULL DEFAULT 0 ,
 `description`     varchar(5000) NOT NULL ,
 `id_category`     int NOT NULL ,
FOREIGN KEY (`id_category`) REFERENCES `category` (`id`)
) ENGINE = InnoDB;


-- ********* Tabela Linha de Vendas ********* --
CREATE TABLE `sale_item`(
 `id`         int NOT NULL PRIMARY KEY,
 `unit_price` decimal(12,2) NOT NULL ,
 `quantity`   int NOT NULL ,
 `id_product` int NOT NULL ,
 `id_sale`    int NOT NULL ,
FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
FOREIGN KEY (`id_sale`) REFERENCES `sale` (`id`)
) ENGINE = InnoDB;






