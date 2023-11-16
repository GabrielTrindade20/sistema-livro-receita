<?php
include_once('../../../controller/protect.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/styleCabeçalhoEdicao.css">
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Categoria</title>

    <style>
        .conteiner-conteudo {
            position: relative;
            margin-top: 150px;
            right: -350px;
            width: 50%;
        }

        .conteiner-conteudo form {
            width: 100%;
            padding: 30px 60px 100px 0;
            border: 1px solid white;
            border-radius: 0px 0px 10px 10px;
            box-shadow: 0px 5px 10px -5px black;
        }

        .conteiner-dados {
            width: 40%;
            display: block;
            align-items: center;
            text-align: left;
            margin-left: 30%;
            margin-top: 10%;
        }

        .conteiner-dados input {
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders2.php'); ?>

    <div class="conteiner-conteudo">
        <div class="titulo">
            <h2>Categoria</label>
        </div>
        <!-- Formulário de Cadastro -->
        <form method="POST" action="../../../controller/categoriaController.php">

            <div class="conteiner-dados">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="descricao" required>
            </div>
            <br>

            <!-- Botão para salvar o cargo -->

            <!-- Botão para cancelar e voltar à página principal -->
            <div class="cancelar">
                <button type="submit" name="salvar" class="button">Salvar</button>
                <a href="../../pages/pageCategoria.php">Cancelar</a>
            </div>
        </form>
    </div>

</body>

</html>