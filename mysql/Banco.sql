create database doall;

use doall;

create table usuario (
id int primary key auto_increment,
nome varchar(25),
sobrenome varchar(400),
CPF varchar(15) unique,
senha varchar(40),
dataNasc date,
email varchar(200) unique,
telefone varchar(14),
sexo char,
nProtocolo int unique,
foto varchar(1000)
);

create table endereco (
id int primary key auto_increment,
CEP varchar(9),
rua varchar(200),
numero int,
bairro varchar(100),
complemento varchar(50),
cidade varchar(100),
referencia varchar(1000),
id_usuario int,
foreign key (id_usuario) references usuario(id)
);

create table produto (
id int primary key auto_increment,
nome varchar(50) not null,
descricao varchar(500) not null, 
localizacao varchar(300) not null,
fotos varchar(1000) not null,
idUsuario int not null,
foreign key (idUsuario) references usuario(id)
);

