CREATE DATABASE IF NOT EXISTS vitrine_db;
USE vitrine_db;


DROP TABLE IF EXISTS produtos; 
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL UNIQUE,
senha VARCHAR(255) NOT NULL,
whatsapp VARCHAR(20) NOT NULL,
foto_perfil VARCHAR(255) DEFAULT 'https://ui-avatars.com/api/?background=random'
);


CREATE TABLE produtos (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
descricao TEXT NOT NULL,
preco DECIMAL(10, 2) NOT NULL,
contato VARCHAR(20) NOT NULL,
imagem_url VARCHAR(500) NOT NULL, 
usuario_id INT NOT NULL,
FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);


INSERT INTO usuarios (nome, email, senha, whatsapp, foto_perfil) 
VALUES 
('Fazenda Doce Mel', 'teste@teste.com', '$2y$10$e.wW8G/..W/..W/..W/..W/..W/..W/..W/..W/..W/..W/..W/.', '11999999999', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80');


INSERT INTO produtos (nome, descricao, preco, contato, categoria, imagem_url, usuario_id) VALUES 
('Queijo Minas Artesanal', 'Queijo meia cura produzido na Serra da Canastra. Sabor suave e textura macia.', 58.90, '11999999999', 'Laticínios', 'https://images.unsplash.com/photo-1452195100486-9cc805987862?auto=format&fit=crop&q=80', 1),
('Mel Silvestre Puro', 'Pote de 500g de mel puro de florada silvestre. Sem conservantes.', 25.00, '11999999999', 'Doces', 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?auto=format&fit=crop&q=80', 1),
('Cesta de Orgânicos', 'Cesta semanal com alface, tomate, cenoura e brócolis. Tudo sem agrotóxicos.', 89.90, '11999999999', 'Hortifruti', 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80', 1);