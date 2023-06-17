CREATE TABLE IF NOT EXISTS users_credentials (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS admin_credentials (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `card_name` varchar(255) DEFAULT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `card_expiration` varchar(7) DEFAULT NULL,
  `card_cvv` varchar(4) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE items (
    item_id INT PRIMARY KEY  AUTO_INCREMENT,
    item_name VARCHAR(255),
    item_variant VARCHAR(255),
    item_quantity INT,
    item_price DECIMAL(10, 2),
    item_net_price DECIMAL(10, 2),
    item_picture VARCHAR(255)
);

CREATE TABLE users_cart (
    username VARCHAR(255),
    item_id INT,
    item_variant VARCHAR(255),
    item_name VARCHAR(255),
    item_quantity INT,
    item_price DECIMAL(10,2),
    item_total DECIMAL(10,2)
);

