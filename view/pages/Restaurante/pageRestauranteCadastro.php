<?php
include_once('../../../controller/protectSubFolders.php');
include_once('../../../controller/funcionarioController.php');
include_once('../../../controller/restauranteController.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOSTRAP  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../../css/styleEdicao.css">
    <link rel="stylesheet" href="../css/styleTable1.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Restaurante</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders2.php'); ?>

    <section class="conteiner-conteudo-cadastro">
        <div class="paginação-sub">
            <a href="homePage.php">Homepage </a> >
            <a href="../pageRestaurante.php"> Restaurante </a> >
            <a href="#" class="pagina-atual"> Restaurante Cadastro</a>
        </div>

        <!-- Botão para cancelar e voltar à página principal -->
        <a href="../pageRestaurante.php">Cancelar</a>

        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <div class="conteiner-abas">
                    <div class="conteiner-operacoes">
                    <!-- Botão para cancelar e voltar à página principal -->
                    <a href="../pageFuncionario.php">Cancelar</a>
                </div>
                        <h1 class="titulo">Funcionário</h1>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="select-column">-</th>
                                    <th>Funcionário</th>
                                    <th class="operacao" colspan="2">OPERAÇÔES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Tabela de funcionario -->
                                <?php foreach ($funcionarios as $index => $funcionario) : ?>
                                    <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?> funcionario-row" data-id="<?php echo $funcionario['idFuncionario']; ?>">
                                        <td class="select-column">
                                            <input type="checkbox" name="checkbox[]" value="<?php echo $funcionario['idFuncionario']; ?>">
                                        </td>
                                        <td> <?php echo $funcionario['nome']; ?> </td>
                                        <td>
                                            <button class="adicionar-funcionario" data-nome="<?php echo $funcionario['nome']; ?>" data-id="<?php echo $funcionario['idFuncionario']; ?>"> Adicionar + </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col">
                    <div class="">
                        <div class="conteiner-table" align="right">
                            <h3>Restaurantes</h3>

                            <table class="table" id="table1" border="1">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Contato</th>
                                        <th>Operações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Tabela de restaurantes -->
                                    <?php foreach ($restaurantes as $index => $restaurante) : ?>
                                        <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                                            <td>
                                                <?php echo $restaurante['nome']; ?>
                                            </td>
                                            <td>
                                                <?php echo $restaurante['contato']; ?>
                                            </td>
                                            <td>
                                                <button class="adicionar-restaurante" data-nome="<?php echo $restaurante['nome']; ?>" data-idR="<?php echo $restaurante['idRestaurante']; ?>"> Adicionar + </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <a href="cadastrarRestaurante.php">Cadastrar Restaurante</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- Notificação de erro ou não -->
                    <div class="mensagens">
                        <?php
                        if (isset($_SESSION["erros"])) {
                            $erro = $_SESSION["erros"];
                            echo  $erro;

                            unset($_SESSION["erros"]);
                        } elseif (isset($_SESSION["sucesso"])) {
                            $sucesso = $_SESSION["sucesso"];
                            echo $sucesso;

                            unset($_SESSION["sucesso"]);
                        }
                        ?>
                        <form id="form" method="POST" action="../../../controller/referenciaController.php">

                            <input type="hidden" name="acao" id="acao" value="salvar">
                            <input type="hidden" name="idFuncionario" id="idFuncionario" value="">
                            <input type="hidden" name="idRestaurante" id="idRestaurante">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="nome" class="form-label">Funcionário</label>
                                    <input type="text" class="form-control" name="nome" id="nome" require>
                                </div>
                                <div class="col-12">
                                    <label for="Restaurante" class="form-label">Restaurante</label>
                                    <input type="text" class="form-control" name="restaurante" id="restaurante" require>
                                </div>
                                <div class="col-12">
                                    <label for="data_inicio" class="form-label">Data Inicio</label>
                                    <input type="date" class="form-control" name="data_inicio" id="data_inicio" require>
                                </div>
                                <div class="col-12">
                                    <label for="data_fim" class="form-label">Data Fim</label>
                                    <input type="date" class="form-control" name="data_fim" id="data_fim" require>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" name="salvar_referencia" value="salvar_referencia" id="btn-salvar-referencia">Salvar referencia</button>
                        </form>
                        <!-- <div class="box-form-referencia">
                            <form id="form" method="POST" action="../../../controller/referenciaController.php">
                                <div class="form-input">
                                    <input type="hidden" name="acao" id="acao" value="salvar">
                                    <input type="hidden" name="idFuncionario" id="idFuncionario" value="">
                                    <input type="hidden" name="idRestaurante" id="idRestaurante">
                                    <label for="nome">Funcionário</label>
                                    <input type="text" name="nome" id="nome">
                                    <br>
                                    <label for="restaurante">Restaurante</label>
                                    <input type="text" name="restaurante" id="restaurante">
                                    <br>
                                    <label for="data_inicio">Data de Início</label>
                                    <input type="date" name="data_inicio" id="data_inicio">
                                    <br>
                                    <label for="data_fim">Data de Fim</label>
                                    <input type="date" name="data_fim" id="data_fim">
                                </div>

                                <div class="box-button">
                                    <button type="submit" name="salvar_referencia" value="salvar_referencia" id="btn-salvar-referencia">Salvar referencia</button>
                                </div>
                            </form>
                        </div> -->
                    </div>
                </div>
            </div>
    </section>

    <script src="../../js/referencia2.js"></script>
    <!-- BOOSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>