<?php
include_once('../../../controller/protect.php');

include_once('../../../configuration/connect.php');
include '../../../model/funcoes.php';
include_once('../../../controller/receitaController.php');
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
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
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
                    <input type="file" accept="image/*" />
                </div>
                <div class="conteiner-dados">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                    <br>
                    <label for="categoria">Categoria</label>
                    <?php monta_select_categoria(); ?>
                    <br>
                    <label for="data_criacao">Data de Criação</label>
                    <input type="date" id="data_criacao" name="data_criacao" required>
                    <br>
                    <label for="cozinheiro">Cozinheiro</label>
                    <?php monta_select_cozinheiro(); ?>
                    <br>
                    <label for="quantidade">Quantidade de Porções</label>
                    <input type="number" id="quantidade" name="quantidade" required>
                    <br>
                    <label for="degustador">Degustador</label>
                    <?php monta_select_degustador(); ?>
                    <br>
                    <label for="nota">Nota</label>
                    <input type="number" id="nota" name="nota">
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
                    <div class="conteiner-operacoes">
                        <button type="submit" name="salvar" class="button">Salvar</button>
                    </div>
            </form>
        </div>
    </section>

    <!-- Cadastro medida ingrediente -->
    <section align="right">

        <div>
            <h1 class="titulo">Medida</h1>
            <!-- Formulário de Cadastro -->
            <form method="POST" action="../../../controller/medidaController.php">
                <div class="conteiner-dados">
                    <label for="medida">Medida:</label>
                    <input type="text" id="medida" name="medida" required>
                </div>
                <br>

                <div>
                    <button type="submit" name="salvar_medida">Salvar</button>
                </div>
            </form>
        </div>

        <div>
            <h3>Ingrediente</h3>
            <!-- Formulário de Cadastro ingrediente-->
            <form method="POST" action="../../../controller/ingredienteController.php">

                <div class="conteiner-dados">
                    <label for="nome">ingrediente:</label>
                    <input type="text" id="nome" name="descricao" required>
                </div>
                <br>

                <div class="conteiner-operacoes">
                    <button type="submit" name="salvar_ingredientes" class="button">Salvar</button>
                </div>
            </form>
        </div>

        <div>
            <!-- Medidas Cadastra -->
            <h3>Ingrediente Medidas Cadastradas</h3>

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
    </section>

    <section align="right">
        <h1 class="titulo">Modo de Preparo</h1>

        <div class="box-text-area">
            <textarea name="" id="" rows="15" cols="50" maxlength="4000"></textarea>
        </div>
    </section>

</body>

</html>