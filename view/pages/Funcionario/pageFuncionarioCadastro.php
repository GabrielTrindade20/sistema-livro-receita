<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once('../../../controller/protectSubFolders.php');
include_once('../../../configuration/connect.php');
include_once('../../../model/funcoes.php');
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

    <title>Funcionário</title>
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
                <a href="../homePage.php">Homepage </a> >
                <a href="../pageFuncionario.php"> Funcionários </a> >
                <a href="#" class="pagina-atual"> Funcionário Cadastro</a>
            </div>
            <!-- Cadastro do funcionario -->
            <section>

                <div>
                    <h1>Informações</h1>
                </div>

                <div class="conteiner-abas">
        
                    <?php
                    if (isset($_SESSION["erro_funcionario_existe"])) {
                        $erro_funcionario_existe = $_SESSION["erro_funcionario_existe"];
                        echo $erro_funcionario_existe . "<br>";

                        unset($_SESSION["erro_funcionario_existe"]);
                    }
                    ?>
                    <!-- Formulário de Cadastro Funcionario -->
                    <form class="form_funcionario" method="POST" action="../../../controller/funcionarioController.php">
                        <div class="conteiner-dados-funcionario">
                            <label for="rg">RG</label>
                            <input type="text" id="rg" name="rg" required>

                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" required>

                            <label for="data_ingresso">Data Ingresso</label>
                            <input type="date" id="data_ingresso" name="data_ingresso" required>

                            <label for="salario">Salário</label>
                            <input type="text" id="salario" name="salario" required>

                            <label for="nome_fantasia">Nome Fantasia</label>
                            <input type="text" id="nome_fantasia" name="nome_fantasia" required>

                            <label for="cargo">Cargo</label>
                            <div class="conteiner-dados-funcionario-select">
                                <?php monta_select_cargo(); ?>
                            </div>
                        </div>

                        <div class="conteiner-operacoes">
                            <!-- Botão para salvar o funcionário -->
                            <button type="submit" name="salvar" class="button">Salvar</button>
                            <!-- Botão para cancelar e voltar à página principal -->
                            <a href="../pageFuncionario.php">Cancelar</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</body>

</html>