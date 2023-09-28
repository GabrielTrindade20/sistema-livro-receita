<?php
include_once "../configuration/connect.php";
include_once "../controller/cargoController.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cargo</title>
    <meta charset="utf-8">
</head>
<body>
	<h1>Atualizar Cargo</h1>

    <?php
        if (isset($mensagem)) {
            echo '<div class="mensagem">' . $mensagem . '</div>';
        }

        if (!empty($al)) {
    ?>
        <form action="../controller/cargoController.php" method="POST">
            <input type="hidden" name="action" value="atualizar">
            <input type="hidden" name="idCargo" value="<?php echo $al["idCargo"];?>">
            <label for="idCargo">
                Nome:
            </label>
            <input type="text" name="descricao" id="idCargo" value="<?php echo $al["descricao"];?>">
            <br>
            <input type="submit" value="Ok">
        </form>
    <?php
        }
    ?>
    <a href="../view/pageCargo.php">Voltar para a lista de cargos</a>
</body>
</html>