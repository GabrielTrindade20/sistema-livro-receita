<!DOCTYPE html>
<!-- alteracao.php -->
<html>
<head>
    <title>Categoria - Alteração</title>
    <meta charset="utf-8">
</head>
<body>
    <?php 
        // efetua alteração da categoria informado em formAlteracao.php
        $id = $_GET["id"];
        $descricao = $_GET["descricao"];
        
        include_once "../configuration/connect.php";

        $query =   "UPDATE Categoria 
                    SET descricao = '$descricao', idCategoria = '$id'
                    WHERE idCategoria = '$id';";
        // echo $query.'<br>';
        if ($result = mysqli_query($link, $query)) {
            echo "Alteração efetuada com sucesso";
        } else {
            echo mysqli_error($link);
        }
        
        // fecha a conexão
        mysqli_close($link);
    ?>  
    <br>
    <a href="../view/pageCategoria.php">Ver Categoria cadastradas</a>
 
 </body>
</html>
