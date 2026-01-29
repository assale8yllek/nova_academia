CREATE DATABASE IF NOT EXISTS academia_pro;
USE academia_pro;

CREATE TABLE IF NOT EXISTS planos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    beneficios TEXT NOT NULL
);

INSERT INTO planos (nome, preco, beneficios) VALUES 
('Plano Start', 89.90, 'Acesso musculação + Horário Livre'),
('Plano Gold', 129.90, 'Tudo do Start + Aulas Coletivas + Sem taxa de matrícula'),
('Plano Black', 199.90, 'Acesso Total + Acompanhamento Nutricional + Camiseta Grátis');