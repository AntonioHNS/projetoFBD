create schema fabricacao;
use fabricacao;

create table Processo (
	Cod_Processo int primary key auto_increment,
    Nome text
);

create table Produto (
	Cod_Produto int primary key auto_increment,
    Descricao text,
    Cod_Processo int,
    foreign key (Cod_Processo) references Processo(Cod_Processo)
);

create table Composicao (
	Cod_Produtobase int,
    Cod_Produtosecundario int,
    Quantidade int,
    foreign key (Cod_Produtobase) references Produto(Cod_Produto),
    foreign key (Cod_Produtosecundario) references Produto(Cod_Produto)
);

create table Fornecedor (
	Cod_Fornecedor int primary key auto_increment,
    Nome text
);

create table Insumo (
	Cod_Insumo int primary key auto_increment,
    Cod_Produto int,
    Cod_Fornecedor int,
    Prazo_Entrega text,
    foreign key (Cod_Produto) references Produto(Cod_Produto),
    foreign key (Cod_Fornecedor) references Fornecedor(Cod_Fornecedor)
);


create table Tarefa (
	Cod_Tarefa int primary key auto_increment,
	Tempo text,
    Nome text
);

create table Ordem_Execução (
	Cod_Processo int,
    Cod_Tarefa int,
    Ordem int,
    foreign key (Cod_Processo) references Processo(Cod_Processo),
    foreign key (Cod_Tarefa) references Tarefa(Cod_Tarefa)
);

