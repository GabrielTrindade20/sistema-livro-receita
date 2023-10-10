<?php
include_once('../../controller/protect.php');
include_once('../../configuration/connect.php');
include_once('../../model/modelCargo/cargoModel.php');

if (isset($_GET['idCargo'])) {
    $idCargo = $_GET['idCargo'];
    $cargoModel = new cargoModel($link);
    $recuperar = $cargoModel->recuperaCargo($idCargo);

    if ($recuperar) {
        $descricao = $recuperar['descricao'];
    } else {
        header("Location: pageCargo.php?mensagem=" . urlencode("Cargo não encontrado."));
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../view/css/styleMenu.css">
    <link rel="stylesheet" href="../../view/css/cssEdicao/styleEdicaoCarg.css">
    <link rel="icon" href="../../view/css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Página Principal</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../view/components/menuSubFolders.php') ?>

    <!-- Estrutura do formulário de edição -->
    <section class="container-conteudo">
        <div>
            <h1>Editar Cargo</h1>
        </div>

        <div class="conteiner-abas">
            <h2>Nome do Cargo</h2>
            <form method="POST" action="../../controller/controllerCargo/cargoController.php">

                <div class="conteiner-dados">
                    <label for="nome">Nome do Cargo:</label>
                    <input type="text" id="descricao" name="descricao"
                        value="<?php echo isset($descricao) ? $descricao : ''; ?>" required>

                </div>
                <br>

                <div class="conteiner-operacoes">
                    <input type="hidden" name="idCargo" value="<?php echo $idCargo; ?>">
                    <button type="submit" name="editar">Editar</button>

                    <a href="../../view/pages/pageCargo.php">Cancelar</a>
                </div>
            </form>
        </div>
    </section>


</body>

</html>