<?php
include_once('../../../controller/protect.php');
include_once('../../../configuration/connect.php');
include_once('../../../model/restauranteModel.php');

if (isset($_GET['idRestaurante'])) {
    $idRestaurante = $_GET['idRestaurante'];
    $restauranteModel = new restauranteModel($link);
    $recuperar = $restauranteModel->recuperaRestaurante($idRestaurante);

    if ($recuperar) {
        $nome = $recuperar['nome'];
        $contato = $recuperar['contato'];
    } else {
        header("Location: pageRestaurante.php?mensagem=" . urlencode("Restaurante não encontrado."));
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
    <link rel="stylesheet" href="../../css/styleEdica.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Restaurante</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders.php'); ?>  

    <section class="conteiner-conteudo">
        <h1 class="titulo">Restaurante</h1>

        <div class="conteiner-abas">
            <!-- Formulário de Alteraçao -->
            <form method="POST" action="../../../controller/restauranteController.php">
                <div class="conteiner-dados">
                    <input type="hidden" name="idRestaurante" value="<?php echo $recuperar["idRestaurante"];?>">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo isset($nome) ? $nome : ''; ?>" required>
                    <label for="contato">Contato:</label>
                    <input type="text" id="contato" name="contato" value="<?php echo isset($contato) ? $contato : ''; ?>" required>
                </div>
                <br>
                <div class="conteiner-operacoes">
                    <!-- Botão para salvar o cargo -->
                    <button type="submit" name="alterar" class="button">Salvar</button>

                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../pageRestaurante.php">Cancelar</a>
                </div>
            </form>
        </div>   
    </section>

</body>
</html>