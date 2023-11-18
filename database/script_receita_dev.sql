use livro_receita_dev;
SELECT f.idFuncionario, f.nome, c.descricao AS cargo
FROM funcionario f
JOIN Cargo c ON f.idCargo = c.idCargo
WHERE c.descricao = 'Desgustador';

create table ingrediente
(
idIngrediente int not null auto_increment,
nome varchar(45) not null,
descricao varchar(200),
primary key(idIngrediente)
)
engine=InnoDB;

create table medida
(
idMedida int not null auto_increment,
descricao varchar(15) not null,
primary key(idMedida)
)
engine=InnoDB;

create table foto_receita
(
id_foto_receita varchar(25) not null,
nome_foto varchar(50) not null,
path varchar(100) not null,
id_usuario int,
primary key(id_foto_receita),
UNIQUE KEY (path)
)
engine=InnoDB;
drop table foto_receita;
create table receita
(
	nome_receita varchar(45) not null,
	data_criacao date not null,
	modo_preparo varchar(4000) not null,
	qtd_porcao int unsigned zerofill,
    degustador smallint,
    data_degustacao date,
    nota_degustacao decimal(3,1),
	ind_inedita ENUM('S', 'N') NOT NULL, -- Valores possíveis: 'S' (sim) e 'N' (nao)
	id_cozinheiro smallint not null,
    id_categoria smallint not null,
    id_foto_receita varchar(25) not null,
    path_foto_receita varchar(100) not null,
	primary key(nome_receita),
	foreign key(id_cozinheiro) references funcionario (idFuncionario),
    foreign key(degustador) references funcionario (idFuncionario),
    foreign key(id_categoria) references Categoria (idCategoria),
    foreign key(id_foto_receita) references foto_receita (id_foto_receita),
    foreign key(path_foto_receita) references foto_receita (path)
) 
engine=InnoDB;

select * from foto_receita;

SELECT *
FROM foto_receita
WHERE id_foto_receita=(select max(id_foto_receita) from foto_receita);


SELECT funcionario.idFuncionario, funcionario.nome as nomeFun, restaurante.idRestaurante, restaurante.nome as nomeRes,  restaurante.contato, referencia.data_inicio, referencia.data_fim
FROM funcionario
INNER JOIN referencia ON funcionario.idFuncionario = referencia.idFuncionario
INNER JOIN restaurante ON referencia.idRestaurante = restaurante.idRestaurante
WHERE funcionario.idFuncionario = 7;

SELECT funcionario.idFuncionario, funcionario.nome as nomeFun, COUNT(restaurante.idRestaurante) as countRes
FROM funcionario
INNER JOIN referencia ON funcionario.idFuncionario = referencia.idFuncionario
INNER JOIN restaurante ON referencia.idRestaurante = restaurante.idRestaurante
Where funcionario.idFuncionario
GROUP BY funcionario.idFuncionario, funcionario.nome;

SELECT idIngrediente, nome
FROM ingrediente
WHERE nome LIKE '%o%' ;