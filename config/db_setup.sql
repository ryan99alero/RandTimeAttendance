CREATE DATABASE IF NOT EXISTS TimeAttendance;

USE TimeAttendance;

CREATE TABLE IF NOT EXISTS Users (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     username VARCHAR(50) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    is_locked BOOLEAN DEFAULT FALSE,
    user_type ENUM('user', 'manager') NOT NULL
    ) ENGINE=InnoDB;

INSERT INTO Users (username, first_name, last_name, email, password_hash, is_active, is_locked, user_type)
VALUES ('admin', 'AdminFirstName', 'AdminLastName', 'admin@example.com', 'hashed_password_here', TRUE, FALSE, 'manager');