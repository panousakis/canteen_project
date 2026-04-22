CREATE DATABASE IF NOT EXISTS canteen_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE canteen_system;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    category VARCHAR(80) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(120) NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_orders_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

INSERT INTO products (name, category, price, stock) VALUES
('Τοστ', 'Σνακ', 2.50, 40),
('Καφές', 'Ροφήματα', 1.80, 60),
('Χυμός Πορτοκάλι', 'Ροφήματα', 2.20, 25),
('Κουλούρι', 'Αρτοποιήματα', 1.20, 35),
('Νερό 500ml', 'Ροφήματα', 0.50, 100);
