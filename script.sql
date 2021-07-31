DROP DATABASE IF EXISTS api;

CREATE DATABASE api;

USE api;

CREATE TABLE user(
    id INT AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    sexo ENUM('M','F') NOT NULL,
    data_cadastro DATETIME DEFAULT (NOW()),
    PRIMARY KEY (id)
);