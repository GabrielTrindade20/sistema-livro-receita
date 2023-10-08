<?php
include_once('../../controller/protectSubFolders.php');
include_once('../../configuration/connect.php');
include_once('../../model/categoriaModel.php');

if (isset($_GET['idCategoria'])) {
    $idCategoria = $_GET['idCategoria'];
    $categoriaModel = new categoriaModel($link);
    $recuperar = $categoriaModel->recuperaCategoria($idCategoria);

    if ($recuperar) {
        $descricao = $recuperar['descricao'];
    } else {
        header("Location: pageCategoria.php?mensagem=" . urlencode("Categoria não encontrado."));
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
    <link rel="stylesheet" href="../css/styleHomePage.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Categoria</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../view/components/menu2.php'); ?> 

    <section class="conteiner-conteudo">
        <h1 class="titulo">Categoria</h1>

        <div class="conteiner-abas">
            <!-- Formulário de Alteraçao -->
            <form method="POST" action="../../controller/categoriaController.php">
                <div class="conteiner-dados">
                    <input type="hidden" name="idCategoria" value="<?php echo $recuperar["idCategoria"];?>">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="descricao" value="<?php echo isset($descricao) ? $descricao : ''; ?>" required>
                </div>
                <br>
                <div class="conteiner-operacoes">
                    <!-- Botão para salvar o cargo -->
                    <button type="submit" name="alterar" class="button">Salvar</button>

                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../pageCategoria.php">Cancelar</a>
                </div>
            </form>
        </div>   
    </section>

</body>
</html>