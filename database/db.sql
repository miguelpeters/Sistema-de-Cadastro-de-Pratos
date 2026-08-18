CREATE DATABASE cadastro_pratos;
USE cadastro_pratos;

CREATE TABLE pratos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    usuario VARCHAR(100)NOT NULL,
    preco DECIMAL(10, 2) NOT NULL
);