<?php
include_once('../../../controller/protect.php');
include_once('../../../configuration/connect.php');
include_once('../../../model/funcionarioModel.php');
include_once('../../../model/referenciaModel.php');

if (isset($_GET['idFuncionario'])) {
    $idFuncionario = $_GET['idFuncionario'];
    $funcionarioModel = new funcionarioModel($link);
    $recuperar = $funcionarioModel->recuperaFuncionario($idFuncionario);
    
    $referenciaModel = new referenciaModel($link);
    $recuperarReferencia = $referenciaModel->validar_campos($data_inicio, $data_fim);

    if ($recuperar && $recuperarReferencia) {
        $rg = $recuperar["rg"];
        $nome = $recuperar["nome"];
        $data_ingresso = $recuperar["data_ingresso"];
        $salario = $recuperar["salario"];
        $nome_fantasia = $recuperar["nome_fantasia"];
        $situacao = $recuperar["situacao"];
        $cargo = $recuperar["idCargo"];
        $data_inicio = $recuperarReferencia["data_inicio"];
        $data_fim = $recuperarReferencia["data_fim"];
    } else {
        header("Location: pageFuncionario.php?mensagem=" . urlencode("Funcionário não encontrado."));
        exit();
    }
}
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
    <!-- <?php require_once('../../components/menuSubFolders.php'); ?> -->

    <section class="conteiner-conteudo">
        <h1 class="titulo">Funcionário</h1>

        <div class="conteiner-abas">
            <!-- Formulário de Alteraçao -->
            <form method="POST" action="../../../controller/funcionarioController.php">
                <div class="conteiner-dados">
                    <!-- <input type="hidden" name="idFuncionario" value="<?php echo $recuperar["idFuncionario"]; ?>"> -->
                    <input type="hidden" name="idFuncionario" value="<?php echo $idFuncionario; ?>">

                    <label for="rg">RG:</label>
                    <input type="text" id="rg" name="rg" required value="<?php echo isset($rg) ? $rg : ''; ?>">

                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required value="<?php echo isset($nome) ? $nome : ''; ?>">

                    <label for="data_ingresso">Data Ingresso:</label>
                    <input type="date" id="data_ingresso" name="data_ingresso" required
                        value="<?php echo isset($data_ingresso) ? $data_ingresso : ''; ?>">

                    <label for="salario">Salário:</label>
                    <input type="text" id="salario" name="salario" required
                        value="<?php echo isset($salario) ? $salario : ''; ?>">

                    <label for="nome_fantasia">Nome Fantasia:</label>
                    <input type="text" id="nome_fantasia" name="nome_fantasia" required
                        value="<?php echo isset($nome_fantasia) ? $nome_fantasia : ''; ?>">

                    <p>situação:</p>
                    <input type="radio" id="ativo" name="situacao" value="0" <?php echo ($situacao === '0') ? 'checked' : ''; ?>>
                    <label for="ativo">Ativo</label>

                    <input type="radio" id="inativo" name="situacao" value="1" <?php echo ($situacao === '1') ? 'checked' : ''; ?>>
                    <label for="inativo">Inativo</label> <br>

                    <label for="cargo">Cargo:</label>
                    <?php
                    include_once('../../../configuration/connect.php');
                    include '../../../model/funcoes.php';

                    monta_select_cargo2($cargo);
                    ?>
                    <br>

                    <label for="restaurante">Restaurante:</label>
                    <?php 
                        monta_select_restaurante();
                    ?> <br>
                    
                    <label for="restaurante">Data de Início</label>
                    <input type="date" name="data_inicio" value="<?php echo isset($data_inicio) ? $data_inicio : ''; ?>"> <br>

                    <label for="restaurante">Data de Fim</label>
                    <input type="date" name="data_fim" value="<?php echo isset($data_fim) ? $data_fim : ''; ?>">

                </div>
                <br>
                <div class="conteiner-operacoes">
                    <!-- Botão para salvar o cargo -->
                    <button type="submit" name="alterar" class="button">Salvar</button>

                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../pageFuncionario.php">Cancelar</a>
                </div>
            </form>
        </div>
    </section>

</body>

</html>