CREATE DATABASE IF NOT EXISTS bank;
USE bank;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    password VARCHAR(100)
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    amount INT,
    status VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
