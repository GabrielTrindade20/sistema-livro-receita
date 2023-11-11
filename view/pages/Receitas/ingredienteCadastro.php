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
    <title>Ingrediente</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders.php'); ?>  

    <section class="conteiner-conteudo">
        <h1 class="titulo">Ingrediente</h1>

        <div class="conteiner-abas">
            <!-- Formulário de Cadastro -->
            <form method="POST" action="../../../controller/ingredienteController.php">

                <div class="conteiner-dados">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="descricao" required>
                </div>
                <br>

                <div class="conteiner-operacoes">
                    <!-- Botão para salvar o cargo -->
                    <button type="submit" name="salvar" class="button">Salvar</button>

                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../../pages/Receitas/receitaCadastro.php">Cancelar</a>
                </div>
            </form>
        </div>

    </section>

</body>
</html>