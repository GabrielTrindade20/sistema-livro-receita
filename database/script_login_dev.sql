use livro_receita_dev;

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

select nome,senha from login;
SELECT * FROM login WHERE nome = nome AND senha = senha;