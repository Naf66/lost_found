-- Create Database
CREATE DATABASE project;

USE project;

-- =========================
-- TABLE: student_data
-- =========================
CREATE TABLE student_data (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    roll VARCHAR(20) NOT NULL,
    reg_no VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    dept VARCHAR(50) NOT NULL,
    session VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    profile_pic VARCHAR(255) NOT NULL DEFAULT 'uploads/default.png',

    PRIMARY KEY (id)
);

-- =========================
-- TABLE: lost_found
-- =========================
CREATE TABLE lost_found (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    category VARCHAR(50),
    location VARCHAR(100),
    image VARCHAR(255),
    status VARCHAR(20),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    resolved TINYINT(1) DEFAULT 0,

    PRIMARY KEY (id)
);