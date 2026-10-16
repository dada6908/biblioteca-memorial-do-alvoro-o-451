ALTER TABLE usuarios ADD COLUMN senha VARCHAR(255) NOT NULL;

UPDATE usuarios SET senha = '123456' WHERE id_usuario > 0;