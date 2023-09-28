<!DOCTYPE html>
<!-- alteracao.php -->
<html>
<head>
    <title>Cargo - Alteração</title>
    <meta charset="utf-8">
</head>
<body>
    <?php 
        // efetua alteração da cargo informado em formAlteracao.php
        $id = $_GET["idCargo"];
        $descricao = $_GET["descricao"];
        
        include_once "../configuration/connect.php";

        $query =   "UPDATE Cargo 
                    SET descricao = '$descricao', idCargo = '$id'
                    WHERE idCargo = '$id';";
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
    <a href="../view/pageCargo.php">Ver Cargo cadastradas</a>
 
 </body>
</html>
