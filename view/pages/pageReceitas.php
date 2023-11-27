<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once('../../controller/protect.php');
include_once('../../controller/receitaController.php');
unset(
    $_SESSION["nome_receita"],
    $_SESSION["data_criacao"],
    $_SESSION["modo_preparo"],
    $_SESSION["qtd_porcao"],
    $_SESSION["degustador"],
    $_SESSION["data_degustacao"],
    $_SESSION["nota_degustacao"],
    $_SESSION["ind_inedita"],
    $_SESSION["id_cozinheiro"],
    $_SESSION["id_categoria"],
    $_SESSION['controlar_abas'],
    $_SESSION["cadastro_sucesso"],
    $_SESSION["ultima_id_foto_receita"]
);
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

    <link rel="stylesheet" href="../components/style.css">
    <link rel="stylesheet" href="../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../css/styleCabecalhoPesquisa.css">
    <link rel="stylesheet" href="../css/stylePesquisar.css">
    <link rel="stylesheet" href="../css/styleTable3.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">

    <title>Receitas</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../components/testemenu.php'); ?>
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
                <div class="paginação">
                    <a href="homePage.php">Homepage </a> >
                    <a href="#" class="pagina-atual"> Receitas</a>
                </div>

                <div class="containerPesquisa">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 conteiner-info">
                            <div>
                                <h1>Lista de Receitas</h1>
                            </div>

                            <div class="info-qtd">
                                <?php echo "(" . $countReceitas . ") Receitas"; ?>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 conteiner-func">
                            <!-- Search -->
                            <form class="form-p">
                                <button>
                                    <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                        <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <input class="input-p" placeholder="Pesquisar" required="" type="search">
                            </form>

                            <!-- Criar -->
                            <div class="button-nova">
                                <a href="./Receitas/pageReceitaCadastro.php">
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
            </section>
        </div>
            <form id="excluirSelect" action="../../controller/receitaController.php?acao=excluirSelecionados" method="post">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-column">-</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Cozinheiro</th>
                            <th>Data de criação</th>
                            <th class="operacao">Operações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Tabela de categoria -->
                        <!-- <?php foreach ($categorias as $index => $categoria) : ?>
                        <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                            <td class="select-column">
                                <input type="checkbox" name="checkbox[]" value="<?php echo $categoria['idCategoria']; ?>">
                            </td>
                            <td>
                                <?php echo $categoria['descricao']; ?>
                            </td>
                            <td>
                                <a href="../pages/CategoriaReceitas/pageReceitaIngreMedida.php?idCategoria=<?php echo $categoria['idCategoria']; ?>">
                                    <span class="material-symbols-outlined"> edit </span>
                                </a>
                            </td>
                            <td>
                                <a href="#" onclick="confirmarExclusao(<?php echo $categoria['idCategoria']; ?>);" class="button">
                                    <span class="material-symbols-outlined"> delete </span>
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?> -->
                    </tbody>
                </table>
            </form>
        </section>

        <!-- BOOSTRAP JAVASCRIPT -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>