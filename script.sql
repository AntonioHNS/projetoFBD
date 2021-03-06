CREATE DATABASE FABRICACAO;
USE FABRICACAO;

CREATE TABLE PROCESSO (
	COD_PROCESSO INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NOME VARCHAR(30) NOT NULL UNIQUE
);

CREATE TABLE PRODUTO (
	COD_PRODUTO INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    DESCRICAO VARCHAR(30) NOT NULL UNIQUE,
    COD_PROCESSO INTEGER,
    
    FOREIGN KEY (COD_PROCESSO) REFERENCES PROCESSO(COD_PROCESSO) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE COMPOSICAO (
	COD_PRODUTO INTEGER NOT NULL,
    COD_COMPONENTE INTEGER NOT NULL,
    QUANTIDADE DOUBLE NOT NULL,
    
    FOREIGN KEY (COD_PRODUTO) REFERENCES PRODUTO (COD_PRODUTO) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (COD_COMPONENTE) REFERENCES PRODUTO (COD_PRODUTO) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE FORNECEDOR (
	COD_FORNECEDOR INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NOME VARCHAR(30) UNIQUE NOT NULL
);

CREATE TABLE COMPRADO_NO (
	COD_PRODUTO INTEGER NOT NULL,
    COD_FORNECEDOR INTEGER NOT NULL,
    PRAZO_ENTREGA VARCHAR(20) NOT NULL,
    
    FOREIGN KEY (COD_PRODUTO) REFERENCES PRODUTO (COD_PRODUTO) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (COD_FORNECEDOR) REFERENCES FORNECEDOR (COD_FORNECEDOR) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE TAREFA (
	COD_TAREFA INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    TEMPO DOUBLE NOT NULL,
    NOME VARCHAR(30) NOT NULL 
);

CREATE TABLE ORDEM_EXECUCAO (
	COD_PROCESSO INTEGER NOT NULL,
    COD_TAREFA INTEGER NOT NULL,
    ORDEM INTEGER NOT NULL,
    
    FOREIGN KEY(COD_PROCESSO) REFERENCES PROCESSO(COD_PROCESSO) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(COD_TAREFA) REFERENCES TAREFA(COD_TAREFA) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO PROCESSO (NOME) VALUES 
('Salgadinhos assados'), 
('Salgadinhos fritos'), 
('Batatas fritas'), 
('Salgadinhos extrusados');

INSERT INTO TAREFA (TEMPO, NOME) VALUES 
(240, 'Cozinhar o milho'),
(60, 'Misturar trigo e água'),  
(15,'Esticar a massa'), 		
(30,'Moer grãos de milho'),		
(10, 'Cortar a massa'),			
(5,'Receber coloração'), 		
(10,'Assar a massa'),			
(5, 'Fritar em oléo vegetal'),	
(2,'Empacotar'),				
(10, 'Aromatizar'),				
(45,'Secar massa'),				
(10, 'Lavar batatas'),			
(5, 'Descascar batatas'),		
(5, 'Cortar batatas'),			
(10, 'Cozinhar batatas'),		
(5 , 'Prensar massa'),			
(5 , 'Esfriar massa');			

INSERT INTO ORDEM_EXECUCAO (COD_PROCESSO,COD_TAREFA,ORDEM) VALUES 
(1,1,1),(1,4,2),(1,5,3),(1,7,4),(1,8,5),(1,10,6),(1,9,7), 
(2,2,1),(2,3,2),(2,6,3),(2,11,4),(2,5,5),(2,8,6),(2,10,7),(2,9,8), 
(3,12,1),(3,13,2),(3,14,3),(3,15,4),(3,8,5),(3,10,6),(3,9,7), 
(4,2,1),(4,16,2),(4,17,3),(4,10,4),(4,9,5);

INSERT INTO FORNECEDOR (NOME) VALUES
('Zé Fornecedor de Grãos LTDA'),
('UFRPE aromatizantes e corantes'),
('CEASA');

INSERT INTO PRODUTO (DESCRICAO, TIPO) VALUES 
('Milho',null),
('Trigo',null),
('Aromatizante queijo',null),
('Aromatizante bacon',null),
('Aromatizante presunto',null),
('Aromatizante churrasco',null),
('Aromatizante requeijão',null),
('Corante Marrom',null),
('Batata',null),
('Fandangos Queijo',1),
('Fandangos Presunto',1),
('Doritos',2),
('Baconzitos',2),
('Ruffles Churrasco',3),
('Ruffles Tradicional',3),
('Cheetos Requeijão',4),
('Sensações',3),
('Pingo de ouro bacon',1);

INSERT INTO PRODUCAO(COD_PRODUTO,COD_PROCESSO) VALUES 
(10,1),(11,1),(18,1),
(12,2),(13,2),
(14,3),(15,3),(17,3),
(16,4);

INSERT INTO COMPOSICAO (COD_PRODUTO,COD_COMPONENTE,QUANTIDADE) VALUES
(10,1,2),(10,3,1),
(11,1,2),(11,5,1),
(12,2,2),(12,3,1),
(13,2,2),(13,4,1),(13,8,1),
(14,9,2),(14,6,1),(14,8,1),
(15,9,2),
(16,1,1),(16,2,1),(16,7,1),
(17,9,2),(17,8,1),
(18,1,1),(18,2,1),(18,4,1),(18,8,1);

INSERT INTO COMPRADO_NO (COD_PRODUTO,COD_FORNECEDOR,PRAZO_ENTREGA) VALUES
(1,1,'13/09/2019'),
(2,1,'13/09/2019'),
(3,2,'01/12/2018'),
(4,2,'01/12/2018'),
(5,2,'01/12/2018'),
(6,2,'01/12/2018'),
(7,2,'01/12/2018'),
(8,2,'01/12/2018'),
(9,3,'30/08/2018');

#Consulta que retorna em ordem as tarefas do processo "Batatas fritas"
select tarefa.nome, ordem_execucao.ordem
from processo, tarefa, ordem_execucao
where processo.nome = 'Batatas fritas' 
and processo.cod_processo = ordem_execucao.cod_processo
and tarefa.cod_tarefa = ordem_execucao.cod_tarefa
order by ordem_execucao.ordem;

#Consulta que retorna o tempo de cada processo em minutos
select processo.nome, sum(tarefa.tempo)
from processo, tarefa, ordem_execucao
where processo.cod_processo = ordem_execucao.cod_processo 
and tarefa.cod_tarefa = ordem_execucao.cod_tarefa
group by processo.nome;

#Consulta que retorna em ordem as tarefas de acordo com o produto
select tarefa.nome, ordem_execucao.ordem
from tarefa, ordem_execucao, produto, producao
where produto.descricao = 'Pingo de ouro bacon' 
and producao.cod_produto = produto.cod_produto
and producao.cod_processo = ordem_execucao.cod_processo
and tarefa.cod_tarefa = ordem_execucao.cod_tarefa;

#consulta que retorna em ordem os componentes de um produto
select p.descricao, pr.descricao
from composicao as c
natural join produto as p
inner join produto as pr 
on pr.cod_produto = c.cod_componente and p.descricao = "Fandangos Queijo";

#consulta que retorna produtos e seus respectivos processos
select produto.descricao, processo.nome
from producao
natural join produto
natural join processo;

#consulta que retorna produtos e seus fornecedores
select produto.descricao, fornecedor.nome, comprado_no.prazo_entrega
from comprado_no
inner join produto
on produto.cod_produto = comprado_no.cod_produto
natural join fornecedor;

#consulta que retorna os insumos
select descricao
from produto 
where produto.tipo = "I";

select tarefa.nome
from  ordem_execucao
natural join tarefa
where ordem_execucao.cod_processo in (select cod_processo 
from processo
where nome = 'Salgadinhos assados');