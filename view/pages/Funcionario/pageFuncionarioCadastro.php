<?php
include_once('../../../controller/protect.php');
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
    <title>Funcionário</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders.php'); ?>  

    <section class="conteiner-conteudo">
        <h1 class="titulo">Funcionário</h1>

        <div class="conteiner-abas">
            <!-- Formulário de Cadastro -->
            <form method="POST" action="../../../controller/funcionarioController.php">

                <div class="conteiner-dados">
                    <label for="rg">RG:</label>
                    <input type="text" id="rg" name="rg" required>
                </div>
                
                <div class="conteiner-dados">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <div class="conteiner-dados">
                    <label for="data_ingresso">Data Ingresso:</label>
                    <input type="date" id="data_ingresso" name="data_ingresso" required>
                </div>
                
                <div class="conteiner-dados">
                    <label for="salario">Salário:</label>
                    <input type="text" id="salario" name="salario" required>
                </div>
                
                <div class="conteiner-dados">
                    <label for="nome_fantasia">Nome Fantasia:</label>
                    <input type="text" id="nome_fantasia" name="nome_fantasia" required>
                </div>
                
                <div class="conteiner-dados">
                    <label for="cargo">Cargo:</label>
                    <?php 
                        include_once('../../../configuration/connect.php');
                        include '../../../model/funcoes.php';

                        monta_select_cargo();
                    ?>
                </div>
                

                <div class="conteiner-operacoes">
                    <!-- Botão para salvar o cargo -->
                    <button type="submit" name="salvar" class="button">Salvar</button>

                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../../pages/pageCategoria.php">Cancelar</a>
                </div>
            </form>
        </div>

    </section>

</body>
</html>