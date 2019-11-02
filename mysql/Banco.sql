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
foto varchar(1000),
tipo varchar(10),
emailVerificacao tinyint
);

create table enderecos (
id int primary key auto_increment,
CEP varchar(9),
rua varchar(200),
numero int,
bairro varchar(100),
complemento varchar(50),
cidade varchar(100),
referencia varchar(1000),
idUsuario int,
foreign key (idUsuario) references usuario(id) on delete cascade
);

create table produto (
id int primary key auto_increment,
nome varchar(50) not null,
descricao varchar(500) not null, 
localizacao int,
fotos varchar(1000) not null,
idUsuario int not null,
verificacao tinyint,
tipo varchar(25),
foreign key (idUsuario) references usuario(id) on delete cascade,
foreign key (localizacao) references enderecos(id) on delete set null
);

create table requisicao(
    idUsuario int,
    idProduto int,
    dataIni date not null,
    dataFim date, 
    verificacao tinyint,
    primary key(idUsuario, idProduto),
    foreign key (idUsuario) references usuario(id) on delete cascade,
    foreign key (idProduto) references produto(id) on delete cascade
);

INSERT INTO `usuario` (`id`, `nome`, `sobrenome`, `CPF`, `senha`, `dataNasc`, `email`, `telefone`, `sexo`, `nProtocolo`, `foto`, `tipo`, `emailVerificacao`) VALUES (NULL, 'Admin', NULL, '000.000.000-00', 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL);