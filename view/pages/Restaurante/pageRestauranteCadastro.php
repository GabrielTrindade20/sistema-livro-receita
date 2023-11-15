<?php
include_once('../../../controller/protect.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../../css/styleAll.css">
    <link rel="stylesheet" href="../../css/stylePesq.css">
    <link rel="stylesheet" href="../../css/stylePesquisar.css">
    <link rel="stylesheet" href="../../css/styleTable1.css">
    <!-- <link rel="stylesheet" href="../../css/styleEdica.css"> -->
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Restaurante</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders2.php'); ?>

    <section class="conteiner-conteudo">
        <!-- Botão para cancelar e voltar à página principal -->
        <a href="../pageRestaurante.php">Cancelar</a>

        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <div class="conteiner-abas">
                        <h1 class="titulo">Funcionário</h1>
                        <table class="table" border="1" align="right">
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                        <symbol id="check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </symbol>
                        <symbol id="info-fill" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </symbol>
                        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>
                    <!-- Notificação de erro ou não -->
                    <div class="mensagens">
                        <?php
                        if (isset($_SESSION["erros"])) {
                            $erro = $_SESSION["erros"];
                            echo '<div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div>
                                        ' . $erro . '
                                    </div>
                                </div>';

                            unset($_SESSION["erros"]);
                        } elseif (isset($_SESSION["sucesso"])) {
                            $sucesso = $_SESSION["sucesso"];
                            echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                    <div>
                                        ' . $sucesso . '
                                    </div>
                                </div>';

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
                                    <input type="text" class="form-control" name="nome" id="nome">
                                </div>
                                <div class="col-12">
                                    <label for="Restaurante" class="form-label">Restaurante</label>
                                    <input type="text" class="form-control" name="restaurante" id="restaurante">
                                </div>
                                <div class="col-12">
                                    <label for="data_inicio" class="form-label">Data Inicio</label>
                                    <input type="date" class="form-control" name="data_inicio" id="data_inicio">
                                </div>
                                <div class="col-12">
                                    <label for="data_fim" class="form-label">Data Fim</label>
                                    <input type="date" class="form-control" name="data_fim" id="data_fim">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" name="salvar_referencia" value="salvar_referencia" id="btn-salvar-referencia">Salvar referencia</button>
                        </form>
                        <div class="box-form-referencia">
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
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src="../../js/referencia2.js"></script>
</body>

</html>