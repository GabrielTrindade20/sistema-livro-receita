<!DOCTYPE html>
<!-- formAlteracao.php -->
<?php
include_once "../configuration/connect.php";
include_once "funcaoRecupera.php";
 
$id = $_GET["id"];
$al = recuperaCategoria($id);
?>

<html>
<head>
    <title>Categoria</title>
    <meta charset="utf-8">
</head>
<body>
	<h1>Atualizar Categoria</h1>
	
    <form action="alteracao.php" method="GET">
        <input type="hidden" name="idCategoria" value="<?php echo $al["idCategoria"];?>">
        <label for="idCategoria">
            Nome:
        </label>
        <input type="text" name="descricao" id="idCategoria" value="<?php echo $al["descricao"];?>">
        <br>
        <input type="submit" value="Ok">
	</form>
</body>
</html>