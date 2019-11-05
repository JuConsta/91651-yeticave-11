CREATE DATABASE yeticave
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE categories (
    id INT unsigned AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    char_code VARCHAR(64) NOT NULL UNIQUE
);

CREATE TABLE lots (
    id INT unsigned AUTO_INCREMENT PRIMARY KEY,
    dt_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    name VARCHAR(128) NOT NULL,
    description VARCHAR(255) NOT NULL,
    image_url VARCHAR(128) NOT NULL,
    start_price INT NOT NULL,
    bid_step INT NOT NULL,
    dt_exp TIMESTAMP NOT NULL,
    category_id INT NOT NULL,
    user_id INT NOT NULL,
    winner_id INT
);

CREATE TABLE users (
    id INT unsigned AUTO_INCREMENT PRIMARY KEY,
    dt_reg TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(128) NOT NULL UNIQUE,
    name VARCHAR(128) NOT NULL,
    pwd VARCHAR(32) NOT NULL,
    contact VARCHAR(128) NOT NULL
);

CREATE TABLE bids (
    id INT unsigned AUTO_INCREMENT PRIMARY KEY,
    dt_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    bid_sum INT NOT NULL,    
    user_id INT NOT NULL,
    lot_id INT NOT NULL
);

CREATE INDEX name_description ON lots (name, description);
CREATE INDEX lot_c ON lots (category_id);