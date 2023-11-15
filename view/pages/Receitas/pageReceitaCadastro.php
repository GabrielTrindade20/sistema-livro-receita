<?php
include_once('../../../controller/protect.php');
include_once('../../../configuration/connect.php');
include '../../../model/funcoes.php';
include_once('../../../controller/receitaController.php');
include_once('../../../controller/fotoController.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleHomePage.css">
    <link rel="stylesheet" href="../css/styleMenu.css">
    <!-- <link rel="stylesheet" href="../../css/styleEdica.css"> -->
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Receita Cadastro</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders2.php'); ?>

    <section class="conteiner-conteudo" align="right">
        <!-- Cancelar e voltar à página principal -->
        <a href="../../pages/pageReceitas.php">Cancelar</a>

        <h1>Cadastrar Receita</h1>

        <!-- Notificação de erro ou não -->
        <div class="mensagens">
            <?php
            if (isset($_SESSION["erros"])) {
                $erros = $_SESSION["erros"];
                // Exibir as mensagens de erro
                foreach ($erros as $erro) {
                    echo $erro . "<br>";
                }
                // Limpar as mensagens de erro da sessão
                unset($_SESSION["erros"]);
            } elseif (isset($_SESSION["sucesso"])) {
                $sucessos = $_SESSION["sucesso"];
                foreach ($sucessos as $sucesso) {
                    echo $sucesso . "<br>";
                }
                unset($_SESSION["sucesso"]);
            }
            ?>
        </div>

        <!-- Formulário de Cadastro -->
        <div class="conteiner-abas">
            <form method="POST" action="../../../controller/receitaController.php">
                <div class="box-foto">
                    <label for="foto_receita">Foto da Receita</label>
                    <input type="file" accept="image/*" name="foto_receita">
                    <input type="submit" name="Enviar">
                </div>
                <div class="conteiner-dados">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                    <br>
                    <label for="data_criacao">Data de Criação</label>
                    <input type="date" id="data_criacao" name="data_criacao" required>
                    <br>
                    <label for="qtd_porcao">Quantidade de Porções</label>
                    <input type="number" id="qtd_porcao" name="qtd_porcao" required>
                    <br>
                    <label for="degustador">Degustador</label>
                        <?php monta_select_degustador(); ?>
                    <br>
                    <label for="nota_degustacao">Nota</label>
                    <input type="number" id="nota_degustacao" name="nota_degustacao">
                    <br>
                    <label for="data_degustacao">Data de Degustação</label>
                    <input type="date" id="data_degustacao" name="data_degustacao">
                    <br>
                    <label for="ind_inedita">Inédita</label>
                    <input type="radio" id="sim" name="ind_inedita" value="S">
                    <label for="sim">Sim</label>
                    <input type="radio" id="nao" name="ind_inedita" value="N">
                    <label for="nao">Não</label><br>
                    <br>
                    <label for="cozinheiro">Cozinheiro</label>
                    <?php monta_select_cozinheiro(); ?>
                    <br>
                    <label for="categoria">Categoria</label>
                        <?php monta_select_categoria(); ?>
                    <br>
                    <div class="box-text-area">
                        <h3 class="titulo">Modo de Preparo</h3>
                        <textarea name="modo_preparo" id="" rows="15" cols="50" maxlength="4000"></textarea>
                    </div>
                    <div class="conteiner-operacoes">
                        <button type="submit" name="salvar" class="button">Salvar</button>
                    </div>
            </form>
        </div>
    </section>

    <!-- Cadastro medida ingrediente -->
    <section align="right">
        <div>
            <!-- Medidas Cadastra -->
            <h3>Ingrediente Medidas Cadastradas</h3>

            <form action="" method="post">
                <label for="cadas_ingrediente">Ingrediente</label>
                <input type="text">
                <label for="cadas_ingrediente">Medidas</label>
                <input type="text">
                <label for="cadas_ingrediente">Quantidade</label>
                <input type="number">

                <button type="submit">Salvar</button>
            </form>

            <div class="box-link-i-m"> <a href="pageReceitaIngreMedida.php">Lista de Ingredientes e Medidas salvas</a></div>

            <div class="table-lista">
                <h3>Lista de Ingredientes</h3>
                <table class="table" id="table" border="1" align="right">
                    <thead>
                        <tr>
                            <th class="select-column">-</th>
                            <th>Medida</th>
                            <th>Ingrediente</th>
                            <th class="operacao" colspan="2">OPERAÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Gerando de acordo com o que foi cadastrado -->
                    </tbody>
                </table>

                <button id="salvar-todos" name="salvar_medidas" onclick="passarReferenciaParaPHP()">Salvar Todos</button>
                <br>
            </div>

        </div>
    </section>

    <section align="right">
        

        
    </section>

</body>

</html>