<?php
include_once('../../../controller/protect.php');
include_once('../../../configuration/connect.php');
include_once('../../../model/modelCargo/cargoModel.php');
$path = '../../../components/menuSubFolders2.php';

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
    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleEdicao.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Cargo Edição</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders2.php') ?>
<div class="paginação-sub">
            <a href="homePage.php">Homepage </a> >
            <a href="../pageCargo.php"> Cargo </a> >
            <a href="#" class="pagina-atual"> Cargo Edição</a>
        </div>
    <!-- Estrutura do formulário de edição -->
    <section class="conteiner-conteudo-cadastro">
        
        <div class="conteiner-abas">
            <div class="title-container">
                <h1>Edição Cargo</h1>
            </div>

            <!-- Formulário de Alteraçao -->
            <form method="POST" action="../../controller/controllerCargo/cargoController.php">
                <div class="conteiner-dados-funcionario">
                    <input type="hidden" name="idCargo" value="<?php echo $idCargo; ?>">
                    <label for="nome">Nome do Cargo</label>
                    <input type="text" id="descricao" name="descricao" value="<?php echo isset($descricao) ? $descricao : ''; ?>" required>
                </div>

                <div class="conteiner-operacoes">
                    <button type="submit" name="editar" class="button">Salvar</button>

                    <a href="../pageCargo.php">Cancelar</a>
                </div>
            </form>
        </div>
    </section>

</body>

</html>