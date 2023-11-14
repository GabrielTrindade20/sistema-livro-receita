create table funcionario
(
	idFuncionario smallint not null auto_increment,
	rg char(15) not null,
	nome varchar(80) not null,
	data_ingresso date not null,
	salario decimal(9,2) not null comment "Este é o salario do meliante",
	nome_fantasia varchar(25),
	situacao ENUM('0', '1') NOT NULL, -- Valores possíveis: '0' (ativo) e '1' (inativo)
	idCargo smallint not null,
	primary key(idFuncionario),
	foreign key(idCargo) references Cargo (idCargo)
) 
engine=InnoDB;

select * from funcionario;

SELECT f.idFuncionario, f.rg, f.nome, f.data_ingresso, f.salario, f.nome_fantasia, f.situacao, c.descricao AS cargo
FROM funcionario f
JOIN Cargo c ON f.idCargo = c.idCargo;

UPDATE funcionario 
SET situacao = '0'
WHERE idFuncionario in  (7, 8, 9)  ;

CREATE TABLE referencia
(
    idFuncionario SMALLINT NOT NULL,
    idRestaurante SMALLINT NOT NULL,
    data_inicio DATE NOT NULL,
    data_fim DATE,
    PRIMARY KEY(idFuncionario, idRestaurante),
    FOREIGN KEY(idFuncionario) REFERENCES funcionario(idFuncionario),
    FOREIGN KEY(idRestaurante) REFERENCES restaurante(idRestaurante)
)engine=InnoDB;


-- Inserir funcionários fictícios
INSERT INTO funcionario (rg, nome, data_ingresso, salario, nome_fantasia, situacao, idCargo)
VALUES
('123456789', 'João Silva', '2023-01-15', 3000.00, 'Jão', '0', 1),
('987654321', 'Maria Souza', '2023-02-20', 2800.00, 'Souza', '0', 2),
('555555555', 'Pedro Santos', '2023-03-10', 3200.00, 'Santos', '1', 3);

-- Inserir restaurantes fictícios
INSERT INTO restaurante (nome, contato)
VALUES
('Restaurante d', '123-456-7890'),
('Restaurante f', '987-654-3210'),
('Restaurante g', '555-555-5555');

-- Inserir associações funcionário-restaurante fictícias
INSERT INTO referencia (idFuncionario, idRestaurante, data_inicio, data_fim)
VALUES
(5, 1, '2023-01-15', '2023-04-30'),
(5, 2, '2023-02-20', '2023-04-30');

DELETE 
FROM referencia 
WHERE idFuncionario = 8 AND
idRestaurante = 3;

UPDATE referencia 
SET idRestaurante = 3, data_inicio = '2023-05-20', data_fim = '2023-12-30'
WHERE idFuncionario = 8 AND idRestaurante = 2;

select * from referencia;

SELECT * FROM restaurante WHERE nome LIKE '%a';

SELECT idFuncionario, idRestaurante, data_inicio, data_fim 
FROM referencia
WHERE idFuncionario = 7;

SELECT r.idFuncionario, r.data_inicio, r.data_fim, rr.nome AS restaurante
FROM referencia r
JOIN Restaurante rr ON r.idRestaurante = rr.idRestaurante
WHERE idFuncionario = 7;

SHOW TABLE STATUS LIKE 'referencia';

SELECT AUTO_INCREMENT
FROM information_schema.tables
WHERE table_name = 'funcionario' AND table_schema = DATABASE();

SELECT idCargo, descricao FROM cargo;

SELECT * FROM funcionario  
WHERE idFuncionario = (select max(idFuncionario) from funcionario);

SELECT funcionario.idFuncionario, restaurante.idRestaurante, restaurante.nome, referencia.data_inicio, referencia.data_fim
FROM funcionario
INNER JOIN referencia ON funcionario.idFuncionario = referencia.idFuncionario
INNER JOIN restaurante ON referencia.idRestaurante = restaurante.idRestaurante;

SELECT COUNT(*) FROM referencia WHERE idRestaurante = 4 AND idFuncionario = 5;

delete from referencia where idFuncionario = 8 and idRestaurante = 6;
select * from referencia;
