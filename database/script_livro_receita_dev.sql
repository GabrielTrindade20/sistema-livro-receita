create database livro_receita_dev;

use livro_receita_dev;

create table Categoria
(
idCategoria smallint not null auto_increment,
descricao char(25) not null,
primary key(idCategoria)
)
engine=InnoDB;

select *
from categoria;

insert into categoria
(descricao)
value
("Drinks");

insert into categoria
(descricao)
value
("Bolos");

insert into categoria
(descricao)
value
("Aves");

insert into categoria
(descricao)
value
("Carnes");


UPDATE categoria
SET
descricao = "Natalina"
WHERE idCategoria = 5;

/*Criação da Tabela Cargo*/

create table Cargo (
idCargo smallint not null auto_increment,
descricao varchar(45) not null,
primary key(idCargo)
)
engine=InnoDB;

insert into Cargo 
(descricao)
value ("Cozinheiro"),
("Desgustador"),
("Editor"),
("Ajudante de cozinha");

select *
from cargo;

