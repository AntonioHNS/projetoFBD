<?php
    require_once('conexao.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar produto</title>
    </head>
    <body>
        <form action="?act=criaProduto" method="POST" name="form1" >
            <h1>Cadastrar produto</h1>
            <hr>
            <input type="hidden" name="cod_produto" />
            
            Descrição:
            <input type="text" name="descricao" 
                <?php
                     
                    if (isset($descricao) && $descricao != null || $descricao != ""){
                        echo "value=\"{$descricao}\"";
                    }
                ?>
            />
            
            <br>
            <br>
            
        
    
          
         <input type="submit" value="Cadastrar produto" />
         <a href="Lista_produtos.php"><button class="MeuInput" type="button">Cancelar </button></a>
         <hr>
         
        </form>
    </body>
</html>
