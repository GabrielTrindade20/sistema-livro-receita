use livro_receita_dev;
create table restaurante
(
idRestaurante smallint not null auto_increment,
nome varchar(45) not null,
contato varchar(45) not null,
primary key(idRestaurante)
)
engine=InnoDB;

insert into restaurante
(nome, contato)
value
("BeeHouse","Miro");

insert into restaurante
(nome, contato)
value
("BeeHouse","Miro");

insert into restaurante
(nome, contato)
value
('Restaurante D', '6665555555');


truncate restaurante;

UPDATE restaurante 
SET nome = 'BeeHouse',
contato = 'Miro' 
WHERE idRestaurante = 1;


