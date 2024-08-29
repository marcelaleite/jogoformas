-- criar o banco e tabela
create database formas;
use formas;
create table quadrado (
    id int primary key auto_increment,
    lado varchar(250),
    cor varchar(250),
    id_un int,
    foreign key (id_un) references unidademedida(id));


create table unidademedida(
    id int primary key auto_increment,
    un varchar(3)
);




commit;