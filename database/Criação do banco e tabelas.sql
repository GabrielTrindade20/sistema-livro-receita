create database livro_receita_dev;
use livro_receita_dev;

CREATE USER 'adm_LivroReceitas'@'localhost' IDENTIFIED WITH mysql_native_password BY 'livro123'; 
grant select, insert, update, delete on livro_receita_dev.* to 'adm_LivroReceitas'@'localhost';

create table login
(
idLogin int not null auto_increment,
nome varchar(45) not null,
senha varchar(45) not null,
primary key(idLogin)
)
engine=InnoDB;

insert into login
(nome, senha)
value
("senac","senac");

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
	situacao ENUM('0', '1') NOT NULL, -- Valores possíveis: '0' (ativo) e '1' (inativo)
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

/* RECEITAS */
create table ingrediente
(
idIngrediente int not null auto_increment,
nome varchar(45) not null,
descricao varchar(200) not null,
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

create table composicao
(
nome_receita varchar(50) not null,
idIngrediente int not null,
idMedida int not null,
qtd_medida smallint,
foreign key(nome_receita)references receita(nome_receita),
foreign key(idIngrediente) references ingrediente (idIngrediente),
foreign key(idMedida) references medida (idMedida)
)
engine=InnoDB;