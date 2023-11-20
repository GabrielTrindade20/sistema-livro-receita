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
    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleEdicao.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>Funcionário</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders2.php'); ?>

    <!-- Cadastro do funcionario -->
    <section class="conteiner-conteudo-cadastro">
        <div>
            <h1>Informações</h1>
        </div>

        <?php
        if (isset($_SESSION["erro_funcionario_existe"])) {
            $erro_funcionario_existe = $_SESSION["erro_funcionario_existe"];
            echo $erro_funcionario_existe . "<br>";

            unset($_SESSION["erro_funcionario_existe"]);
        }
        ?>

        <div class="conteiner-abas">
            <div class="title-container">
                <h2>Funcionário</h2>
            </div>

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

</body>

</html>