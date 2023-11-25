<?php
include_once('../../../controller/protectSubFolders.php');
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
    <!-- BOOSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../../components/style.css">

    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleEdicao.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Cargo Edição</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php include '../../components/menuSub1.php'; ?>
    <!-- Page Content -->
    <div id="content">
        <div class="container-fluid">
            <header>
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
            </header>
        </div>
        <div class="conteudo">
            <div class="paginação-sub">
                <a href="homePage.php">Homepage </a> >
                <a href="../pageCargo.php"> Cargo </a> >
                <a href="#" class="pagina-atual"> Cargo Edição</a>
            </div>
            <!-- Estrutura do formulário de edição -->
            <section>

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
        </div>


</body>

</html>