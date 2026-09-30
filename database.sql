CREATE DATABASE IF NOT EXISTS db_delinshop;
USE db_delinshop;

-- Tabel Admin
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admins (username, password) VALUES ('admin', MD5('admin123')) 
ON DUPLICATE KEY UPDATE username=username;

-- Tabel Produk
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price INT NOT NULL,
    disc INT DEFAULT 0,
    stock INT NOT NULL,
    img VARCHAR(255) DEFAULT '👕',
    description TEXT
);

INSERT INTO products (name, category, price, disc, stock, img, description) VALUES
('Setelan Casual Little Bear', 'Setelan', 89000, 26000, 25, '🧸', 'Setelan kaos dan celana pendek bahan cotton combed 30s.'),
('Newborn Jumper Organic Soft', 'Newborn', 65000, 10000, 40, '👶', 'Jumper bayi baru lahir sangat lembut dan anti iritasi.'),
('Dress Anak Little Daisy Pastel', 'Dress', 110000, 15000, 15, '👗', 'Dress anak motif bunga dengan kain katun jepang adem.'),
('Setelan Kaos Dino Adventure', 'Setelan', 95000, 0, 30, '🦕', 'Setelan kaos anak laki-laki karakter dinosaurus.');

-- Tabel Pesanan Masuk (Checkout)
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    total_amount INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);