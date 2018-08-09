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
            
            <a href="Inserir_produto.php"><button class="MeuInput" type="button">Cadastrar produto </button></a>
            <a href="Inicio.php"><button class="MeuInput" type="button">Retornar ao menu </button></a>
      <!--<input type="submit" value="Cadastrar produto" />-->
         <hr>
         <table border="1" width="100%">
            <tr>
                <th>Produto</th>
                <th>Ação</th>
            </tr>
            <?php
    // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
            try {
                //pega os produtos e os insumos
                $stmt = $conexao->prepare("select * from produto where tipo = 'P'");
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                            /*print_r($rs);*/                            
                            echo "<tr>";
                            echo "<td>".$rs->DESCRICAO."</td><td>"
                               ."<center><a href=\"?act=alteraProduto&cod_produto=".$rs->COD_PRODUTO."\"><button class='MeuInput' type='button'>Alterar</button></a>"
                               ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                               ."<a href=\"\"><button class='MeuInput' type='button'>Excluir</button></a></center></td>";
                            echo "</tr>";

                            //<a href="Lista_produtos.php"><button class="MeuInput" type="button">Cancelar </button></a>
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
    </body>
</html>
