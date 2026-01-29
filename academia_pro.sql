DROP DATABASE IF EXISTS academia_pro;
CREATE DATABASE academia_pro;
USE academia_pro;

CREATE TABLE planos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    beneficios TEXT NOT NULL,
    duracao_meses INT DEFAULT 1
);

CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    plano_id INT,
    status ENUM('ativo', 'inativo', 'pendente') DEFAULT 'ativo',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (plano_id) REFERENCES planos(id)
);

INSERT INTO planos (nome, preco, beneficios) VALUES 
('Start', 89.90, 'Musculação + Sem restrição de horário'),
('Gold', 129.90, 'Musculação + Aulas Coletivas + Cadeira de Massagem'),
('Black', 199.90, 'Acesso Total + Nutricionista + Levar convidado');