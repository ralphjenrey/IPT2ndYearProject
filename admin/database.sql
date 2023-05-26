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

CREATE TABLE orders (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    order_status VARCHAR(50) NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    order_id INT(11) NOT NULL,
    profit DECIMAL(10, 2) NOT NULL,
    total DECIMAL(10, 2) NOT NULL
);

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
    item_name VARCHAR(255),
    item_quantity INT,
    item_total DECIMAL(10,2)
);