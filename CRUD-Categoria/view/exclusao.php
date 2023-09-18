<!DOCTYPE html>
<!-- cadastro.html -->
<html>
<head>
<title>Categoria - Exclusão</title>
<meta charset="utf-8">
</head>
<body>
    <?php 
        // exclusao.php
        // efetua a exclusão da categoria com o id informado.
        $id = $_GET["id"];
        
        include_once('../configuration/connect.php');

        $query = "DELETE FROM Categoria WHERE idCategoria='$id';";
        
        if ($result = mysqli_query($link, $query)) {
            echo "Exclusão efetuada com sucesso";
        }
        
        // fecha a conexão
        mysqli_close($link);
    ?>  
    <br>
    <a href="../view/pageCategoria.php">Ver Categoria</a>
 
</body>
</html>