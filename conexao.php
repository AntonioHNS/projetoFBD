<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
        $descricao = (isset($_POST["descricao"]) && $_POST["descricao"] != null) ? $_POST["descricao"] : "";
        $tipo = (isset($_POST["tipo"]) && $_POST["tipo"] != null) ? $_POST["tipo"] : "";
        
    } else if (!isset($id)) {
        // Se não se não foi setado nenhum valor para variável $id
        $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
        $descricao = NULL;
        $tipo = NULL;
    }

    try{
        $conexao = new PDO("mysql:host=localhost; dbname=fabricacao", "aluno", "alunodeinfo");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->exec("set names utf8");
    } catch (PDOException $erro) {
        echo "Erro na conexão:" . $erro->getMessage();
 
    }

    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "criaProduto" && $descricao != "") {
        try {
            $stmt = $conexao->prepare("INSERT INTO produto (descricao, tipo) VALUES (?, 'P')");
            $stmt->bindParam(1, $descricao);
         //$stmt->bindParam(2, 'P');
             
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo "Dados cadastrados com sucesso!";
                    $id = null;
                    $descricao = null;
                } else {
                    echo "Erro ao tentar efetivar cadastro";
                }
            } else {
                   throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            if ($erro->getCode() == 23000){
                echo "Erro: esse produto já está cadastrado";
            }
            
        }
    }

    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "alteraProduto" && $id != "") {
        try {
            $stmt = $conexao->prepare("SELECT * FROM produto WHERE cod_produto = ?");
            $stmt->bindParam(1, $cod_produto, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $rs = $stmt->fetch(PDO::FETCH_OBJ);
                $cod_produto = $rs->Cod_produto;
                $descricao = $rs->descricao;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }


?>