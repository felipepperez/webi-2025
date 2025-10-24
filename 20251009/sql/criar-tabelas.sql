-- Script SQL para criar o banco de dados e tabelas
-- Execute este script no MySQL para criar a estrutura necessária

-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS aula_php_pdo;
USE aula_php_pdo;

-- Criar tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(30) NOT NULL,
    idade INT NOT NULL,
    cidade VARCHAR(50) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE
);

-- Criar tabela de produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    estoque INT DEFAULT 0,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criar tabela de pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pendente', 'processando', 'enviado', 'entregue', 'cancelado') DEFAULT 'pendente',
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- Inserir dados de exemplo na tabela usuários
INSERT INTO usuarios (nome, email, senha, idade, cidade) VALUES
('João Silva', 'joao@email.com', '1f3870be274f6c49b3e31a0c6728957f', 25, 'São Paulo'),
('Maria Santos', 'maria@email.com','1f3870be274f6c49b3e31a0c6728957f', 30, 'Rio de Janeiro'),
('Pedro Costa', 'pedro@email.com','1f3870be274f6c49b3e31a0c6728957f', 28, 'Belo Horizonte'),
('Ana Oliveira', 'ana@email.com','1f3870be274f6c49b3e31a0c6728957f', 35, 'Salvador'),
('Carlos Ferreira', 'carlos@email.com','1f3870be274f6c49b3e31a0c6728957f', 22, 'São Paulo'),
('Lucia Mendes', 'lucia@email.com','1f3870be274f6c49b3e31a0c6728957f', 40, 'Brasília'),
('Roberto Lima', 'roberto@email.com','1f3870be274f6c49b3e31a0c6728957f', 33, 'Fortaleza'),
('Fernanda Souza', 'fernanda@email.com','1f3870be274f6c49b3e31a0c6728957f', 27, 'Recife');

-- Inserir dados de exemplo na tabela produtos
INSERT INTO produtos (nome, descricao, preco, categoria, estoque) VALUES
('Notebook Dell', 'Notebook Dell Inspiron 15 3000', 2500.00, 'Informática', 10),
('Smartphone Samsung', 'Galaxy A54 5G 128GB', 1200.00, 'Celulares', 25),
('TV LED 55"', 'Smart TV LED 55 polegadas', 1800.00, 'Eletrônicos', 5),
('Mesa de Escritório', 'Mesa de escritório em madeira', 350.00, 'Móveis', 15),
('Cadeira Gamer', 'Cadeira gamer ergonômica', 450.00, 'Móveis', 8),
('Fone de Ouvido', 'Fone Bluetooth com cancelamento de ruído', 200.00, 'Acessórios', 30),
('Tablet iPad', 'iPad 10.9" 64GB Wi-Fi', 2800.00, 'Tablets', 12),
('Monitor 24"', 'Monitor LED 24 polegadas Full HD', 600.00, 'Informática', 20);

-- Inserir dados de exemplo na tabela pedidos
INSERT INTO pedidos (usuario_id, produto_id, quantidade, valor_total, status) VALUES
(1, 1, 1, 2500.00, 'entregue'),
(2, 2, 1, 1200.00, 'enviado'),
(3, 3, 1, 1800.00, 'processando'),
(1, 4, 2, 700.00, 'pendente'),
(4, 5, 1, 450.00, 'entregue'),
(5, 6, 3, 600.00, 'enviado'),
(6, 7, 1, 2800.00, 'processando'),
(7, 8, 1, 600.00, 'pendente');

-- Criar índices para melhorar performance
CREATE INDEX idx_usuarios_email ON usuarios(email);
CREATE INDEX idx_usuarios_cidade ON usuarios(cidade);
CREATE INDEX idx_produtos_categoria ON produtos(categoria);
CREATE INDEX idx_pedidos_usuario ON pedidos(usuario_id);
CREATE INDEX idx_pedidos_status ON pedidos(status);
CREATE INDEX idx_pedidos_data ON pedidos(data_pedido);

-- Criar view para relatórios
CREATE VIEW vw_pedidos_completos AS
SELECT 
    p.id as pedido_id,
    u.nome as cliente,
    u.email,
    pr.nome as produto,
    p.quantidade,
    p.valor_total,
    p.data_pedido,
    p.status
FROM pedidos p
JOIN usuarios u ON p.usuario_id = u.id
JOIN produtos pr ON p.produto_id = pr.id;

-- Criar procedure para buscar usuários por cidade
DELIMITER //
CREATE PROCEDURE sp_buscar_usuarios_por_cidade(IN cidade_param VARCHAR(50))
BEGIN
    SELECT * FROM usuarios WHERE cidade = cidade_param ORDER BY nome;
END //
DELIMITER ;

-- Criar procedure para calcular total de vendas
DELIMITER //
CREATE PROCEDURE sp_total_vendas()
BEGIN
    SELECT 
        COUNT(*) as total_pedidos,
        SUM(valor_total) as valor_total_vendas,
        AVG(valor_total) as ticket_medio
    FROM pedidos 
    WHERE status != 'cancelado';
END //
DELIMITER ;

-- Mostrar informações sobre as tabelas criadas
SELECT 'Banco de dados e tabelas criados com sucesso!' as status;
SELECT COUNT(*) as total_usuarios FROM usuarios;
SELECT COUNT(*) as total_produtos FROM produtos;
SELECT COUNT(*) as total_pedidos FROM pedidos;

