<?php
include_once('../../../configuration/connect.php');
include_once('../../../model/modelCargo/cargoModel.php');

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
    <title>Página Principal</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../../view/components/menuSubFolders2.php') ?>


    <section class="conteiner-conteudo">
        <div>
            <h1>Cadastrar Cargo</h1>
        </div>

        <div class="conteiner-abas">
            
            <div class="title-container">
                <h2>Nome do Cargo</h2>
            </div>
            <!-- Formulário de Cadastro -->
            <form action="../../../controller/cargoController.php" method="POST">

                <div class="conteiner-dados">
                    <label for="descricao">Nome:</label> <!-- Altere o "for" e o "id" para "descricao" -->
                    <input type="text" id="descricao" name="descricao" required> <!-- Altere "name" para "descricao" -->
                </div>
                <br>

                <div class="conteiner-operacoes">
                    <!-- Botão para salvar o cargo -->
                    <button type="submit" name="salvar" class="button">Salvar</button>

                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../../pages/pageCargo.php">Cancelar</a>
                </div>
            </form>

        </div>

    </section>
</body>

</html>