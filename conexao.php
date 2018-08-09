<?php

    //QUERIES 
    $inserirProduto = "insert into produto (descricao, cod_processo) 
                        values (?, (select cod_processo from processo where nome = ?))";

    $todosOsProdutos = "select * from produto where cod_processo is not null";
    
    $todosOsProcessos = "select nome from processo";

    $getProcesso = "select cod_processo from processo where nome = ?";



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
        $descricao = (isset($_POST["descricao"]) && $_POST["descricao"] != null) ? $_POST["descricao"] : "";
        $processo = (isset($_POST["processo"]) && $_POST["processo"] != null) ? $_POST["processo"] : "";
        
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

    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "criaProduto" && $descricao != "" && $processo !="") {
        try {
            $verificacao = $conexao->prepare($getProcesso);
            $verificacao->bindParam(1,$processo);
            if($verificacao->execute()){
                if ($verificacao->fetch(PDO::FETCH_OBJ) != null){
                    
                    $stmt = $conexao->prepare($inserirProduto);
                    $stmt->bindParam(1, $descricao);
                    $stmt->bindParam(2, $processo);
                    if ($stmt->execute()) {
                        if ($stmt->rowCount() > 0) {
                            echo "Dados cadastrados com sucesso!";
                            $cod_produto = null;
                            $descricao = null;
                    } else {
                        echo "Erro ao tentar efetivar cadastro";
                    } 
                } else {
                    echo "Esse processo não existe";
                }
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