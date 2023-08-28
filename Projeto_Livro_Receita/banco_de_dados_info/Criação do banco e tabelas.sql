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
idCargo smallint not null,
primary key(idFuncionario),
foreign key(idCargo) references Cargo (idCargo)
) 
engine=InnoDB;