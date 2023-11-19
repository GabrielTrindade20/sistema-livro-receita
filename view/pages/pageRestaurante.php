<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once('../../controller/protect.php');
include_once('../../controller/restauranteController.php');
include_once('../../controller/referenciaController.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../css/styleCabecalhoPesquisa.css">
    <link rel="stylesheet" href="../css/styleNoti.css">
    <link rel="stylesheet" href="../css/stylePesquisar.css">
    <link rel="stylesheet" href="../css/styleTable1.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <title>Restaurantes</title>

</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../components/menu.php'); ?>


    <section class="conteiner-conteudo">
        <div class="paginação">
            <a href="homePage.php">Homepage </a> >
            <a href="pageRestaurante.php" class="pagina-atual"> Restaurantes</a>
        </div>

        <div class="containerPesquisa">
            <div class="row">
                <div class="col-md-6 col-sm-12 conteiner-info">
                    <div>
                        <h1>Lista de Restaurantes</h1>
                    </div>
                    <div class="info-qtd">
                        <a href="#">
                            <?php echo "(" . $count_referencias . ") Salvos"; ?>
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
                        <a href="./Restaurante/pageRestauranteCadastro.php">
                            <button class="nova-button">Cadastrar</button>
                        </a>
                    </div>
                </div>
            </div>
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

    </section>

    <section class="conteiner-conteudo2">
        <form id="excluirSelect" action="../../controller/referenciaController.php?acao=excluirSelecionados"
            method="post">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Funcionario</th>
                        <th>Restaurantes cadastrados</th>
                        <th class="operation">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tabela de referencia -->
                    <?php foreach ($referencias as $index => $referencia): ?>
                        <tr>
                            <td>
                                <?php echo $referencia['nomeFun']; ?>
                            </td>
                            <td>
                                <?php echo $referencia['countRes']; ?>
                            </td>
                            <td class="operation">
                                <a
                                    href="../pages/Restaurante/pageRestauranteAlteracao.php?idFuncionario=<?php echo $referencia['idFuncionario'] ?>">
                                    <span class="material-symbols-outlined"> edit </span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>