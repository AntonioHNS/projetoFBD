<?php
#maneiras de referenciar um pasta
/*Cada um desses muda a forma como um diretório é referenciado.

Suponhamos um arquivo teste.txt:

/teste.txt: significa que o arquivo teste.txt está na pasta raiz do sistema;

./teste.txt: significa que o arquivo teste.txt está na mesma pasta que o script está rodando;

../teste.txt: significa que o arquivo teste.txt está na pasta imediatamente acima da pasta em que o script PHP está rodando
*/
?>
<?// require_once 'php_action/db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="php_action/stylesheet.css"/>
	<title> Processo de Fabricação </title>

	<style type="text/css">
	body{
		background: #DCDCDC;
	}
			
	</style>
	
</head>
<body>
<h1> <center> Sistema "Processo de Fabricação" </center> </h1>
<fieldset>
	<legend>Selecione uma Opção</legend>
	<form action="./new%202.php" method="post">
		<table cellspacing="1" cellpadding="1">
			<tr>
				<th>Para as opções de Processos: </th>
				<td><br><a href="teste.php"><button class="MeuInput" type="button">Processo </button></a>
			</tr>
			<tr>
				<th>Para as opções de Produtos: </th>
				<td><br><a href="teste.php"><button class="MeuInput" type="button">Produto </button></a>
			</tr>
			<tr>
				<th>Para as opções de Produção: </th>
				<td><br><a href="teste.php"><button class="MeuInput" type="button">Produção </button></a>
			</tr>
			<tr>
				<th>Para as opções de Composição: </th>
				<td><br><a href="teste.php"><button class="MeuInput" type="button">Composição </button></a>
			</tr>
			<tr>
				<th>Para as opções de Fornecedor: </th>
				<td><br><a href="teste.php"><button class="MeuInput" type="button">Fornecedor </button></a>
			</tr>
			<tr>
				<th>Para as opções de Comprado no: </th>
				<td><br><a href="teste.php"><button class="MeuInput" type="button">Comprado no </button></a>
			</tr>
			<tr>
				<th>Para as opções de Tarefas: </th>
				<td><br><a href="teste.php"><button class="MeuInput" type="button">Tarefa </button></a>
			</tr>
			<tr>
				<th>Para as opções de Ordem de Execução: </th>
				<td><br><a href="teste.php"><button class="MeuInput" type="button">Ordem de Execução </button></a>
			</tr>
		</table>
	</form>
	
</fieldset>


</body>
</html>