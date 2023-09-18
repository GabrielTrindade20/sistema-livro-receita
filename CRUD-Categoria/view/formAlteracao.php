<?php
include_once "../configuration/connect.php";
include_once "../controller/categoriaController.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Categoria</title>
    <meta charset="utf-8">
</head>
<body>
	<h1>Atualizar Categoria</h1>

    <?php
    if (isset($mensagem)) {
        echo '<div class="mensagem">' . $mensagem . '</div>';
    }
    ?>
	
    <form action="../controller/categoriaController.php" method="POST">
        <input type="hidden" name="action" value="atualizar">
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