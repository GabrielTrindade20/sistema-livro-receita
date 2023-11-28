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

    <script>
        function confirmarExclusao(nome_receita) {
            console.log("delete")
            var confirmacao = confirm("Tem certeza de que deseja excluir esta receita?");

            if (confirmacao) {
                window.location.href = "../../controller/receitaController.php?acao=delete&nome_receita=" + nome_receita;
            } else {
                // Se o usuário cancelar, não faça nada
            }
        }
    </script>

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
            <section>
                <section>
                    <!--<button onclick="confirmarExclusaoCheckbox()">Excluir Selecionados</button> -->

                    <form id="excluirSelect" action="../../controller/receitaController.php?acao=excluirSelecionados" method="post">
                        <table class="table table-sm table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="select-column">-</th>
                                    <th>Receita</th>
                                    <th>Categorias</th>
                                    <th class="operation" colspan="2">Operações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Tabela de categoria -->
                                <?php foreach ($dados_receitas as $index => $receita) : ?>
                                    <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                                        <td class="select-column">
                                            <input type="checkbox" name="checkbox[]" value="<?php echo $receita['nome_receita']; ?>">
                                        </td>
                                        <td> <?php echo $receita['nome_receita']; ?> </td>
                                        <td> <?php echo $receita['categoria_nome']; ?> </td>
                                        <td class="operation">
                                            <a href="../pages/Receitas/pageReceitaView.php?nome_receita=<?php echo $receita['nome_receita']; ?>" class="button">
                                                <span class="material-symbols-outlined"> visibility </span>
                                            </a>
                                            <a href="../pages/Receitas/pageReceitaAlteracao.php?nome_receita=<?php echo $receita['nome_receita']; ?>">
                                                <span class="material-symbols-outlined"> edit </span>
                                            </a>
                                            <a href="#"  onclick="confirmarExclusao('<?php echo $receita['nome_receita']; ?>')" class="button">
                                                <span class="material-symbols-outlined"> delete </span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </form>
                </section>
            </section>
        </div>



        <!-- BOOSTRAP JAVASCRIPT -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>