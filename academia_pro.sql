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

USE academia_pro;

CREATE TABLE fichas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    nome_treino VARCHAR(50) NOT NULL,
    objetivo VARCHAR(50),
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (aluno_id) REFERENCES alunos(id) ON DELETE CASCADE
);

CREATE TABLE itens_treino (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ficha_id INT NOT NULL,
    exercicio VARCHAR(100) NOT NULL,
    series VARCHAR(20),
    repeticoes VARCHAR(20),
    carga VARCHAR(20),
    descanso VARCHAR(20),
    FOREIGN KEY (ficha_id) REFERENCES fichas(id) ON DELETE CASCADE
);

INSERT INTO fichas (aluno_id, nome_treino, objetivo) VALUES (1, 'Série A - Peito e Tríceps', 'Hipertrofia');

INSERT INTO itens_treino (ficha_id, exercicio, series, repeticoes, carga, descanso) VALUES 
(1, 'Supino Reto', '4x', '10-12', '20kg', '60s'),
(1, 'Supino Inclinado Halteres', '3x', '12', '16kg', '60s'),
(1, 'Crucifixo Máquina', '3x', '15', '10kg', '45s'),
(1, 'Tríceps Corda', '4x', '12', '25kg', '45s'),
(1, 'Tríceps Testa', '3x', '10', 'Halteres', '45s');

CREATE TABLE professores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especialidade VARCHAR(50), -- Ex: Musculação, CrossFit
    foto VARCHAR(255) DEFAULT 'default_trainer.jpg',
    horario_inicio TIME,
    horario_fim TIME,
    status ENUM('disponivel', 'ocupado', 'ausente') DEFAULT 'ausente'
);
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    preco DECIMAL(10,2),
    imagem VARCHAR(255),
    descricao TEXT
);

ALTER TABLE alunos ADD COLUMN nivel ENUM('aluno', 'admin') DEFAULT 'aluno';

INSERT INTO professores (nome, especialidade, horario_inicio, horario_fim, status) VALUES 
('Carlos "Arrocha"', 'Musculação', '06:00', '14:00', 'disponivel'),
('Ana "Passando"', 'Cross Training', '14:00', '22:00', 'ocupado');

INSERT INTO produtos (nome, preco, imagem, descricao) VALUES 
('Camiseta Dry-Fit Pro', 59.90, 'https://source.unsplash.com/600x600/?tshirt,black', 'Tecido tecnológico que absorve o suor. Estilo e performance.');

UPDATE alunos SET nivel = 'admin' WHERE id = 1;