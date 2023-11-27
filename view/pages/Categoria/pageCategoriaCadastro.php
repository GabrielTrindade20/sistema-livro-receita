<?php
include_once('../../../controller/protectSubFolders.php');
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
    <title>Categoria Cadastro</title>
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
            <section>
                <div class="paginação-sub">
                    <a href="homePage.php">Homepage </a> >
                    <a href="../pageCategoria.php"> Categorias </a> >
                    <a href="#" class="pagina-atual"> Categoria Cadastro</a>
                </div>
                <div class="conteiner-abas">
                    <div class="title-container">
                        <h1>Categoria</h1>
                    </div>
                    <!-- Formulário de Cadastro -->
                    <form method="POST" action="../../../controller/categoriaController.php">

                        <div class="conteiner-dados-funcionario">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="descricao" required>
                        </div>

                        <div class="conteiner-operacoes">
                            <!-- Botão para salvar o cargo -->
                            <button type="submit" name="salvar" class="button">Salvar</button>

                            <!-- Botão para cancelar e voltar à página principal -->
                            <a href="../pageCategoria.php">Cancelar</a>
                        </div>
                    </form>
                </div>

            </section>
        </div>
   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
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

        </div>
