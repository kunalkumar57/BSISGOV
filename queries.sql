-- SQL Script to create database and tables
-- Run this in your MySQL server

CREATE DATABASE cms_db;

USE cms_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert a default admin user (username: admin, password: admin123 - change this!)
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$1t3yK8c6w3b2F0z5j7Gf..q1z7p0k9L8m5n4p3r2s1t0u9v8w7x6y'); -- Hashed password for 'admin123'

CREATE TABLE news_articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    headline VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_path VARCHAR(255),
    alt_text VARCHAR(255),
    publication_date DATETIME,
    source_credit VARCHAR(255),
    status ENUM('draft', 'published') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);