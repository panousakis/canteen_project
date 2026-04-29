DROP DATABASE IF EXISTS canteen_system;
CREATE DATABASE canteen_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE canteen_system;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(6,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, category, price, stock, created_at) VALUES
('Καφές Espresso', 'Ροφήματα', 1.50, 100, '2026-04-01 08:10:00'),
('Καφές Freddo Espresso', 'Ροφήματα', 2.00, 80, '2026-04-01 08:15:00'),
('Καφές Cappuccino', 'Ροφήματα', 2.20, 70, '2026-04-01 08:20:00'),
('Freddo Cappuccino', 'Ροφήματα', 2.50, 60, '2026-04-01 08:30:00'),
('Ελληνικός Καφές', 'Ροφήματα', 1.40, 55, '2026-04-01 08:40:00'),
('Χυμός Πορτοκάλι', 'Ροφήματα', 1.80, 50, '2026-04-01 09:00:00'),
('Αναψυκτικό Cola', 'Ροφήματα', 1.50, 120, '2026-04-01 09:20:00'),
('Νερό 500ml', 'Ροφήματα', 0.50, 200, '2026-04-01 09:30:00'),
('Τοστ Ζαμπόν-Τυρί', 'Σνακ', 2.50, 40, '2026-04-02 10:00:00'),
('Τοστ Γαλοπούλα-Τυρί', 'Σνακ', 2.70, 38, '2026-04-02 10:10:00'),
('Σάντουιτς Club', 'Σνακ', 3.50, 25, '2026-04-02 10:30:00'),
('Κουλούρι Θεσσαλονίκης', 'Σνακ', 1.20, 60, '2026-04-02 10:40:00'),
('Τυρόπιτα', 'Σνακ', 2.00, 35, '2026-04-02 10:50:00'),
('Σπανακόπιτα', 'Σνακ', 2.20, 30, '2026-04-02 11:00:00'),
('Πίτσα κομμάτι', 'Σνακ', 2.80, 20, '2026-04-02 11:10:00'),
('Σοκολάτα Γάλακτος', 'Γλυκά', 1.50, 80, '2026-04-03 12:00:00'),
('Σοκολάτα Υγείας', 'Γλυκά', 1.60, 60, '2026-04-03 12:10:00'),
('Μπισκότα', 'Γλυκά', 1.20, 100, '2026-04-03 12:20:00'),
('Croissant Σοκολάτα', 'Γλυκά', 1.80, 50, '2026-04-03 12:30:00'),
('Donut', 'Γλυκά', 1.50, 45, '2026-04-03 12:40:00');

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    total DECIMAL(8,2) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO orders (customer_name, total, created_at) VALUES
('Γιώργος Παπαδόπουλος', 4.50, '2026-04-10 09:10:00'),
('Μαρία Κωνσταντίνου', 6.00, '2026-04-10 09:25:00'),
('Νίκος Αντωνίου', 3.20, '2026-04-10 10:05:00'),
('Ελένη Δημητρίου', 5.80, '2026-04-10 10:20:00'),
('Κώστας Σταθόπουλος', 7.50, '2026-04-10 11:00:00'),
('Άννα Μιχαήλ', 2.50, '2026-04-10 11:30:00'),
('Πέτρος Ιωάννου', 9.00, '2026-04-10 12:00:00'),
('Χρήστος Λαμπράκης', 4.00, '2026-04-10 12:15:00'),
('Δημήτρης Νικολάου', 6.70, '2026-04-10 12:40:00'),
('Σοφία Γεωργίου', 3.90, '2026-04-10 13:00:00'),
('Αλέξανδρος Μαλούκος', 5.20, '2026-04-11 09:10:00'),
('Σωτήρης Πανουσάκης', 6.40, '2026-04-11 09:35:00');

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

INSERT INTO order_items (order_id, product_id, quantity) VALUES
(1, 1, 2),
(1, 9, 1),
(2, 3, 2),
(2, 11, 1),
(3, 8, 2),
(3, 12, 1),
(4, 4, 1),
(4, 13, 2),
(5, 2, 2),
(5, 10, 1),
(6, 6, 1),
(6, 16, 1),
(7, 1, 3),
(7, 15, 2),
(8, 7, 2),
(8, 14, 1),
(9, 3, 1),
(9, 18, 2),
(10, 8, 1),
(10, 17, 2),
(11, 5, 1),
(11, 12, 1),
(12, 2, 1),
(12, 19, 1);
