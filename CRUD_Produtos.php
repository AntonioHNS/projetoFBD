<?php 
    require_once('conexao.php'); 
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Produtos</title>
    </head>

    <body>
        <form action="?act=criaProduto" method="POST" name="form1" >
            <h1>Produtos</h1>
            <hr>
                <input type="hidden" name="cod_produto" />
                Descrição do produto:
                <input type="text" name="descricao" 
                    <?php
                        if (isset($descricao) && $descricao != null || $descricao != ""){
                            echo "value=\"{$descricao}\"";
                        }
                    ?>
                />
            <br>
            <br>
                Processo de produção:
                <input type="text" name="processo" />
            <br>
            <br>
            <?php
    // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
                try {
                    //pega os produtos e os insumos
                    echo "Processos disponíveis:<br>";
                    $stmt = $conexao->prepare($todosOsProcessos);
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){                           
                                echo "- ".$rs->nome."<br>";
                            }
                        } else {
                            echo "Erro: Não foi possível recuperar os dados do banco de dados";
                        }
                } catch (PDOException $erro) {
                    echo "Erro: ".$erro->getMessage();
                }
            ?>

            
        <br>
        <input type="submit" value="Salvar" />
        <a href="Inicio.php"><button class="MeuInput" type="button">Cancelar </button></a>
        <hr>
        <br><br>
        <table border="1" width="100%">
            <tr>
                <th>Produto</th>
                <th>Ação</th>
            </tr>
        <?php
    // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
            try {
                //pega os produtos e os insumos
                $stmt = $conexao->prepare($todosOsProdutos);
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                            /*print_r($rs);*/                            
                            echo "<tr>";
                            echo "<td>".$rs->DESCRICAO."</td><td>"
                               ."<center><a href=\"?act=alteraProduto&cod_produto=".$rs->COD_PRODUTO."\">[Alterar]</a>"
                               ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                               ."<a href=\"\">[Excluir]</a></center></td>";
                            echo "</tr>";
                            
                        }
                    } else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
            } catch (PDOException $erro) {
                echo "Erro: ".$erro->getMessage();
            }
            ?>
        </table>
        </form>

        <br>
        <br>
        <br>   
        <?php
            echo "INSTRUÇÕES: 
            <br>Para criar um produto preencha o formulário com nome e o processo referente a produção desse 
            <br>produto, caso o produto já esteja cadastrado ou o processo de produção não esteja disponível é 
            <br>retornada uma mensagem de erro.";
        ?>
    </body>
</html>