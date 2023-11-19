<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once('../../controller/protect.php');
include_once('../../controller/funcionarioController.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOSTRAP  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


    <link rel="stylesheet" href="../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../css/styleCabecalhoPesquisa.css">
    <link rel="stylesheet" href="../css/styleNoti.css">
    <link rel="stylesheet" href="../css/stylePesquisar.css">
    <link rel="stylesheet" href="../css/styleTable1.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">

    <style>
        /* Estilo para células ativas (verde) */
        .ativo {
            background-color: #6eaa5e;
            color: black;
            padding: 3px 6px;
            border-radius: 8px;
        }

        /* Estilo para células inativas (vermelho) */
        .inativo {
            background-color: #ff5232;
            color: black;
            padding: 3px 6px;
            border-radius: 8px;
        }

        /* Ajustes para o botão de pesquisa */
        .search-box-button {
            margin-top: -3px;
            margin-right: 5px;
        }
    </style>

    <title>Funcionário</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../components/menu.php'); ?>

    <section class="conteiner-conteudo">

        <div class="paginação">
            <a href="homePage.php">Homepage > </a>
            <a href="pagefuncionario.php" class="pagina-atual">Funcionário</a>
        </div>

        <div class="containerPesquisa">
            <div class="row">
                <div class="col-md-6 col-sm-12 conteiner-info">
                    <div>
                        <h1>Lista de Funcionários</h1>
                    </div>

                    <div class="info-qtd">
                        <a href="#">
                            <?php echo "(" . $countFuncionarios . ") Funcionários"; ?>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 conteiner-func">
                    <!-- Search -->
                    <form class="form-p">
                        <button>
                            <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img"
                                aria-labelledby="search">
                                <path
                                    d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                                    stroke="currentColor" stroke-width="1.333" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <input class="input-p" placeholder="Pesquisar" required="" type="search">
                    </form>

                    <!-- Criar -->
                    <div class="button-nova">
                        <a href="./Funcionario/pageFuncionarioCadastro.php?acao=cadastro">
                            <button class="nova-button">Cadastrar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div> 
    </section>

    <section class="conteiner-conteudo-func">
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
        
        <div class="conteiner-button-inativar">
            <button class="inativar-button" onclick="confirmarExclusaoCheckbox()">Inativar Selecionados</button>
        </div>

        <form id="inativarSelecionados" action="../../controller/funcionarioController.php?acao=inativosSelecionados"
            method="post">
            <table class="table table-striped table-hover" >
                <thead>
                    <tr>
                        <th>-</th>
                        <th>RG</th>
                        <th>Nome</th>
                        <th>Data Ingresso</th>
                        <th>Salário</th>
                        <th>Nome Fantasia</th>
                        <th>Cargo</th>
                        <th>Status</th>
                        <th class="operation">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tabela de funcionario -->
                    <?php foreach ($funcionarios as $index => $funcionario): ?>
                        <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?> funcionario-row"
                            data-id="<?php echo $funcionario['idFuncionario']; ?>">
                            <td>
                                <input type="checkbox" name="checkbox[]"
                                    value="<?php echo $funcionario['idFuncionario']; ?>">
                            </td>
                            <td>
                                <?php echo $funcionario['rg']; ?>
                            </td>
                            <td>
                                <?php echo $funcionario['nome']; ?>
                            </td>
                            <td>
                                <?php echo $funcionario['data_ingresso'] = implode("/", array_reverse(explode("-", $funcionario['data_ingresso']))); ?>
                            </td>
                            <td>
                                <?php echo 'R$' . $funcionario['salario']; ?>
                            </td>
                            <td>
                                <?php echo $funcionario['nome_fantasia']; ?>
                            </td>
                            <td>
                                <?php echo $funcionario['cargo']; ?>
                            </td>
                            <td>
                                <span class="status <?php echo ($funcionario['situacao'] == '0') ? 'ativo' : 'inativo'; ?>">
                                    <?php
                                    if ($funcionario['situacao'] == '0') {
                                        echo 'Ativo';
                                    } elseif ($funcionario['situacao'] == '1') {
                                        echo 'Inativo';
                                    } else {
                                        echo 'Desconhecido';
                                    }
                                    ?>
                                </span>
                            </td>
                            <td class="operation">
                                <a
                                    href="../pages/Funcionario/pageFuncionarioAlteracao.php?idFuncionario=<?php echo $funcionario['idFuncionario']; ?>&acao=alteracao">
                                    <span class="material-symbols-outlined"> edit </span>
                                </a>

                                <a href="#" onclick="confirmarInativo(<?php echo $funcionario['idFuncionario']; ?>);"
                                    class="button">
                                    <span class="material-symbols-outlined"> do_not_disturb_on </span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/funcionarioInativo.js"></script>

</body>
</html>