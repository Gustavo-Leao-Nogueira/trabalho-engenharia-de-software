create database trabalho; 

use trabalho;

create table pessoa(
    id int not null auto_increment primary key,
    nome varchar(100) not null,
    telefone varchar(25) not null,
    email varchar(150),
    senha varchar(200),
    usuario varchar(100)
);

create table placa(
    id int not null auto_increment primary key,
    altura double not null,
    largura double not null,
    frase varchar(400) not null,
    cor_da_placa set('branca', 'cinza') not null,
    cor_da_frase set('azul', 'vermelho', 'amarelo', 'preto', 'verde') not null
);

create table servico(
    id int not null auto_increment primary key,
    id_usuario int,
    id_placa int, 
    
);