CREATE DATABASE atm_db;
USE atm_db;

CREATE TABLE accounts (
    acc_no VARCHAR(20) PRIMARY KEY,
    name VARCHAR(100),
    pin INT,
    balance INT
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    acc_no VARCHAR(20),
    type VARCHAR(20),
    amount INT,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
