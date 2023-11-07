create database livro_receita_dev;

use livro_receita_dev;

create table Categoria
(
idCategoria smallint not null auto_increment,
descricao char(25) not null,
primary key(idCategoria)
)
engine=InnoDB;

/*Criação da Tabela Cargo*/
create table Cargo (
idCargo smallint not null auto_increment,
descricao varchar(45) not null,
primary key(idCargo)
)
engine=InnoDB;

/*Criação da Tabela Funcionário*/
create table funcionario
(
	idFuncionario smallint not null auto_increment,
	rg char(15) not null,
	nome varchar(80) not null,
	data_ingresso date not null,
	salario decimal(9,2) not null comment "Este é o salario do meliante",
	nome_fantasia varchar(25),
	status ENUM('0', '1') NOT NULL, -- Valores possíveis: '0' (ativo) e '1' (inativo)
	idCargo smallint not null,
	primary key(idFuncionario),
	foreign key(idCargo) references Cargo (idCargo)
) 
engine=InnoDB;

create table restaurante
(
idRestaurante smallint not null auto_increment,
nome varchar(45) not null,
contato varchar(45) not null,
primary key(idRestaurante)
)
engine=InnoDB;

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