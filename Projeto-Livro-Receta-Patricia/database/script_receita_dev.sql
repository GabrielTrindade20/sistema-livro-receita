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
id_foto_receita int unsigned zerofill not null auto_increment,
nome_foto varchar(50) not null,
primary key(id_foto_receita)
)
engine=InnoDB;

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
    id_foto_receita int unsigned zerofill,
	primary key(nome_receita),
	foreign key(id_cozinheiro) references funcionario (idFuncionario),
    foreign key(degustador) references funcionario (idFuncionario),
    foreign key(id_categoria) references Categoria (idCategoria),
    foreign key(id_foto_receita) references foto_receita (id_foto_receita)
) 
engine=InnoDB;
select * from receita;
drop table receita;
