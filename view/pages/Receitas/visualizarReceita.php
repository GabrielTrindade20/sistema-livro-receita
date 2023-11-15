<?php
include_once('../../../controller/protect.php');
include_once('../../../configuration/connect.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    
    <link rel="stylesheet" href="../../css/styleAll.css">
    <!-- <link rel="stylesheet" href="../../css/styleEdica.css"> -->
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Receita Cadastro</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders2.php'); ?>

    <section class="conteiner-conteudo">
        <div class="conteiner-abas">
            <img src="" alt="">
            <h1 class="titulo">Nome Receita</h1>
            <b>Categoria:</b><br>
            <b>Data de criação:</b><br>
            <b>Cozinheiro:</b><br>
            <b>Quantidade de Porções:</b><br>
            <b>Degustador:</b><br>
            <b>Nota:</b><br>
            <b>Inédita:</b><br>
            <b>Ingredientes:</b><br>
            <b>Modo de Preparo:</b><br>

        </div>
    </section>

</body>

</html>