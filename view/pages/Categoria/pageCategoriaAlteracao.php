<?php
include_once('../../../controller/protect.php');
include_once('../../../configuration/connect.php');
include_once('../../../model/categoriaModel.php');

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
    <!-- BOOSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../../components/style.css">

    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleEdicao.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>Categoria Edição</title>
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
            <!-- Estrutura do formulário de edição -->
            <section>
                <div class="paginação-sub">
                    <a href="homePage.php">Homepage </a> >
                    <a href="../pageCategoria.php"> Categorias </a> >
                    <a href="#" class="pagina-atual"> Categoria Edição</a>
                </div>
                <div class="conteiner-abas">
                    <div class="title-container">
                        <h1>Editar Categoria</h1>
                    </div>
                    <!-- Formulário de Alteraçao -->
                    <form method="POST" action="../../../controller/categoriaController.php">
                        <div class="conteiner-dados-funcionario">
                            <input type="hidden" name="idCategoria" value="<?php echo $recuperar["idCategoria"]; ?>">
                            <label for="nome">Nome da Categoria</label>
                            <input type="text" id="nome" name="descricao" value="<?php echo isset($descricao) ? $descricao : ''; ?>" required>
                        </div>

                        <div class="conteiner-operacoes">
                            <!-- Botão para salvar o cargo -->
                            <button type="submit" name="alterar" class="button">Salvar</button>

                            <!-- Botão para cancelar e voltar à página principal -->
                            <a href="../pageCategoria.php">Cancelar</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>


</body>

</html>