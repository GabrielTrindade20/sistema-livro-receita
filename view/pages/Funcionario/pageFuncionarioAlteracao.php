<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once('../../../controller/protectSubFolders.php');
include_once('../../../configuration/connect.php');
include_once('../../../model/funcionarioModel.php');
include_once('../../../model/funcoes.php');

if (isset($_GET['idFuncionario'])) {
    $idFuncionario = $_GET['idFuncionario'];
    $funcionarioModel = new funcionarioModel($link);
    $recuperar = $funcionarioModel->recuperaFuncionario($idFuncionario);


    if ($recuperar) {
        $rg = $recuperar["rg"];
        $nome = $recuperar["nome"];
        $data_ingresso = $recuperar["data_ingresso"];
        $salario = $recuperar["salario"];
        $nome_fantasia = $recuperar["nome_fantasia"];
        $situacao = $recuperar["situacao"];
        $cargo = $recuperar["idCargo"];
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
    <!-- BOOSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../../components/style.css">
    
    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleEdicao.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>Funcionário Alteração</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php include '../../components/menuSub1.php'; ?>
    <!-- Page Content -->
    <div id="content">
        <div class="container-fluid">
            <header>
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
            </header>
        </div>
        <div class="conteudo">
            <section>
                <div class="paginação-sub">
                    <a href="../homePage.php">Homepage </a> >
                    <a href="../pageFuncionario.php"> Funcionários </a> >
                    <a href="#" class="pagina-atual"> Funcionário Cadastro</a>
                </div>
                <div>
                    <h1>Informações</h1>
                </div>

                <div class="conteiner-abas">
                    <?php
                    if (isset($_SESSION["erro_funcionario_existe"])) {
                        $erro_funcionario_existe = $_SESSION["erro_funcionario_existe"];
                        echo $erro_funcionario_existe . "<br>";

                        unset($_SESSION["erro_funcionario_existe"]);
                    }
                    ?>

                    <!-- Formulário de Alteraçao -->
                    <form method="POST" action="../../../controller/funcionarioController.php">
                        <div class="conteiner-dados-funcionario">
                            <input type="hidden" name="idFuncionario" value="<?php echo $idFuncionario; ?>">

                            <label for="rg">RG</label>
                            <input type="text" id="rg" name="rg" required value="<?php echo isset($rg) ? $rg : ''; ?>">

                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" required value="<?php echo isset($nome) ? $nome : ''; ?>">

                            <label for="nome">Nome Fantasia</label>
                            <input type="text" id="nome_fantasia" name="nome_fantasia" required value="<?php echo isset($nome_fantasia) ? $nome_fantasia : ''; ?>">

                            <label for="nome">Data Ingresso</label>
                            <input type="date" id="data_ingresso" name="data_ingresso" required value="<?php echo isset($data_ingresso) ? $data_ingresso : ''; ?>">

                            <label for="nome">Salário</label>
                            <input type="text" id="salario" name="salario" required value="<?php echo isset($salario) ? $salario : ''; ?>">

                            <label for="nome">Situação</label>
                            <div class="conteiner-dados-funcionario-status">
                                <input type="radio" id="ativo" name="situacao" value="0" <?php echo ($situacao === '0') ? 'checked' : ''; ?>>
                                <label for="ativo">Ativo</label>

                                <input type="radio" id="inativo" name="situacao" value="1" <?php echo ($situacao === '1') ? 'checked' : ''; ?>>
                                <label for="inativo">Inativo</label>
                            </div>

                            <label for="nome">Cargo</label>
                            <div class="conteiner-dados-funcionario-select">
                                <?php monta_select_cargo2($cargo); ?>
                            </div>

                        </div>

                        <div class="conteiner-operacoes">
                            <!-- Botão para salvar o cargo -->
                            <button type="submit" name="alterar" class="button">Salvar</button>

                            <!-- Botão para cancelar e voltar à página principal -->
                            <a href="../pageFuncionario.php">Cancelar</a>
                        </div>
                    </form>
                </div>
            </section>

        </div>

</body>

</html>