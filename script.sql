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

CREATE TABLE livro(
    id INT AUTO_INCREMENT,
    titulo VARCHAR(30) NOT NULL,
    autor VARCHAR(40) NOT NULL,
    num_pag INT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE emprestimo(
    cod_user INT,
    cod_livro INT,
    data_emprestimo DATETIME NOT NULL DEFAULT (NOW()),
    data_entrega DATETIME NOT NULL,
    total_dias_emprestados INT GENERATED ALWAYS AS (TIMESTAMPDIFF(DAY , data_emprestimo, data_entrega)) VIRTUAL,
    PRIMARY KEY (cod_user,cod_livro),
    FOREIGN KEY (cod_user)
    REFERENCES user(id),
    FOREIGN KEY (cod_livro)
    REFERENCES livro(id)
);


