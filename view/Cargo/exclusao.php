<!DOCTYPE html>
<!-- cadastro.html -->
<html>
<head>
<title>Cargo - Exclusão</title>
<meta charset="utf-8">
</head>
<body>
    <?php 
        // exclusao.php
        // efetua a exclusão da cargo com o id informado.
        $id = $_GET["id"];
        
        include_once('../configuration/connect.php');

        $query = "DELETE FROM Cargo WHERE idCargo='$id';";
        
        if ($result = mysqli_query($link, $query)) {
            echo "Exclusão efetuada com sucesso";
        }
        
        // fecha a conexão
        mysqli_close($link);
    ?>  
    <br>
    <a href="../pageCargo.php">Ver Cargo</a>
 
</body>
</html>