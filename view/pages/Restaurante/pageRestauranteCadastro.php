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
    <!-- <link rel="stylesheet" href="../../css/styleEdica.css"> -->
    <link rel="icon" href="../../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Restaurante</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../../components/menuSubFolders2.php'); ?>
    
    <section class="conteiner" align="right">
        <!-- Botão para cancelar e voltar à página principal -->
        <a href="../pageRestaurante.php">Cancelar</a>
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
    </section>

    <section class="conteiner" align="right">
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
                                <button class="adicionar-restaurante" data-nome="<?php echo $restaurante['nome']; ?>" data-id="<?php echo $restaurante['idRestaurante']; ?>"> Adicionar + </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <a href="cadastrarRestaurante.php">Cadastrar Restaurante</a>
        </div>

        <!-- Notificação de erro ou não -->
        <div class="mensagens">
            <?php
            if (isset($_SESSION["erros"])) {
                $erro = $_SESSION["erros"];
                echo $erro . "<br>";

                unset($_SESSION["erros"]);
            } elseif (isset($_SESSION["sucesso"])) {
                $sucesso = $_SESSION["sucesso"];
                echo $sucesso . "<br>";

                unset($_SESSION["sucesso"]);
            }
            ?>
        </div>

        <div class="box-form-referencia">
            <form id="form2" method="POST" action="../../../controller/referenciaController.php">
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
                    <label for="restaurante">Data de Início</label>
                    <input type="date" name="data_inicio" id="data_inicio">
                    <br>
                    <label for="restaurante">Data de Fim</label>
                    <input type="date" name="data_fim" id="data_fim">
                </div>

                <div class="box-button">
                    <button type="submit" name="salvar_referencia" value="salvar_referencia" id="btn-salvar-referencia">Salvar referencia</button>
                </div>
            </form>
        </div>
    </section>

    <script src="../../js/referencia.js"></script>
</body>

</html>
