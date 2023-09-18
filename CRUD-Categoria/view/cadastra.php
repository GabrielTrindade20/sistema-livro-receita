<!DOCTYPE html>
<!-- insercao_aluno.php -->
<html>
	<head>
	  <title>Cadastro</title>
	  <meta charset="utf-8">
	</head>
	<body>
<?php 

$descricao = $_GET["descricao"];
    
include_once('../configuration/connect.php');
    $query =   "INSERT INTO Categoria 
                (descricao) 
                VALUE
                ('$descricao');";
    if ($result = mysqli_query($link, $query)) {
        echo "Inclusão efetuada com sucesso";
    }
    
    // fecha a conexão
    mysqli_close($link);
?>  
 <br>
 <a href="pageCategoria.php">Ver categoria cadastrados</a>
 
 </body>
</html>
