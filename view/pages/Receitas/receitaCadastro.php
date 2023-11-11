<?php
include_once('../../../controller/protect.php');

include_once('../../../configuration/connect.php');
include '../../../model/funcoes.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleHomePage.css">
    <link rel="stylesheet" href="../css/styleMenu.css">
    <link rel="stylesheet" href="../../css/styleEdica.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Página Principal</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders.php'); ?>

    <section class="conteiner-conteudo">
        <div>
            <h1>Cadastrar Receita</h1>
        </div>
        <div class="conteiner-abas">
            <!-- Formulário de Cadastro -->
            <form method="POST" action="../../../controller/receitaController.php">
                    
                <div class="conteiner-dados">
                <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                    
                    <label for="categoria">Categoria</label><br>
                    <?php 
                        monta_select_categoria();
                    ?><br>

                    <label for="data_criacao">Data de Criação</label>
                    <input type="date" id="data_criacao" name="data_criacao" required>

                    <label for="cozinheiro">Cozinheiro</label><br>
                    <input type="text" id="cozinheiro" name="cozinheiro" required>

                    <label for="quantidade">Quantidade de Porções</label>
                    <input type="text" id="quantidade" name="quantidade" required>

                    <label for="degustador">Degustador</label>
                    <input type="text" id="degustador" name="degustador" required>

                    <label for="nota">Nota</label>
                    <input type="text" id="nota" name="nota" required>

                    <label for="data_degustacao">Data de Degustação</label>
                    <input type="date" id="data_degustacao" name="data_degustacao" required>

                    <label for="ind_inedita">Inédita</label>
                    <input type="radio" id="sim" name="fav_language" value="sim">
                    <label for="sim">Sim</label>
                    <input type="radio" id="nao" name="fav_language" value="nao">
                    <label for="nao">Não</label><br>  
                    
                    <label for="medida">Ingrediente</label>
                    <?php 
                        monta_select_ingrediente();
                    ?>
                    <a href="../../pages/Receitas/ingredienteCadastro.php">+</a><br> 

                    <label for="medida">Medida</label>
                    <?php 
                        monta_select_medida();
                    ?>
                    <a href="../../pages/Receitas/medidaCadastro.php">+</a>
                </div>
                <br>

                <div class="conteiner-operacoes">
                    <!-- Botão para salvar o cargo -->
                    <button type="submit" name="salvar" class="button">Salvar</button>

                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../../pages/pageReceitas.php">Cancelar</a>
                </div>
            </form>
        </div>
        
    </section>

</body>

</html>