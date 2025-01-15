-- Create a database
CREATE DATABASE PhotoGallery;

-- Use the database
USE PhotoGallery;

-- Create a table to store photos
CREATE TABLE Photos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    photo_name VARCHAR(255) NOT NULL,
    photo_path VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
