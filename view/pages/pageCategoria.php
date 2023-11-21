<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once('../../controller/protect.php');
include_once('../../controller/categoriaController.php');

if (isset($_SESSION['resultados_pesquisa'])) {
    $resultados = $_SESSION['resultados_pesquisa'];
    // Limpe os resultados da variável de sessão após exibi-los
    unset($_SESSION['resultados_pesquisa']);
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../css/styleAllConteinerPages.css">
    <link rel="stylesheet" href="../css/styleCabecalhoPesquisa.css">
    <link rel="stylesheet" href="../css/styleNoti.css">
    <link rel="stylesheet" href="../css/stylePesquisar.css">
    <link rel="stylesheet" href="../css/styleTable3.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <title>Categorias</title>

    <script>
        function confirmarExclusao(idCategoria) {
            var confirmacao = confirm("Tem certeza de que deseja excluir esta categoria?");

            if (confirmacao) {
                // Se o usuário confirmar a exclusão, redirecione para o script de exclusão com o ID
                window.location.href = "../../controller/categoriaController.php?acao=excluir&idCategoria=" + idCategoria;
            } else {
                // Se o usuário cancelar, não faça nada
            }
        }

        function confirmarExclusaoCheckbox() {
            if (confirm("Tem certeza de que deseja excluir as categorias selecionadas?")) {
                document.forms["excluirSelect"].submit();
            }
        }
    </script>

</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../components/menu.php'); ?>

    <section class="conteiner-conteudo">
        <div class="paginação">
            <a href="homePage.php">Homepage </a> >
            <a href="#" class="pagina-atual">Categoria</a>
        </div>
        <div class="containerPesquisa">
            <div class="row">
                <div class="col-md-6 col-sm-12 conteiner-info">
                    <div>
                        <h1>Lista de Categorias</h1>
                    </div>

                    <div class="info-qtd">
                        <a href="#">
                            <?php echo "(" . $countCategorias . ") Categorias"; ?>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 conteiner-func">
                    <form method="post" action="../../controller/categoriaController.php" class="form-p">
                        <button>
                            <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <input class="input-p" placeholder="Pesquisar" required="" type="search" name="descricao">
                    </form>

                    <!-- Criar -->
                    <div class="button-nova">
                        <a href="./Categoria/pageCategoriaCadastro.php">
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

    <section class="conteiner-conteudo2">
        <div class="conteiner-button-select">
            <button onclick="confirmarExclusaoCheckbox()">Excluir Selecionados</button>
        </div>

        <form id="excluirSelect" action="../../controller/categoriaController.php?acao=excluirSelecionados" method="post">
            <table class="table table-sm table-striped table-hover">
                <thead>
                    <tr>
                        <th class="select-column">-</th>
                        <th>Categorias</th>
                        <th class="operation">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Verifica se houve pesquisa e exibe resultados ou mostra todas as categorias -->
                    <?php if (isset($resultados) && !empty($resultados)) : ?>
                        <?php foreach ($resultados as $categoria) : ?>
                            <tr>
                                <td class="select-column">
                                    <input type="checkbox" name="checkbox[]" value="<?php echo $categoria['idCategoria']; ?>">
                                </td>
                                <td>
                                    <?php echo $categoria['descricao']; ?>
                                </td>
                                <!-- Operações -->
                                <td class="operation">
                                    <a href="../pages/Categoria/pageCategoriaAlteracao.php?idCategoria=<?php echo $categoria['idCategoria']; ?>">
                                        <span class="material-symbols-outlined"> edit </span>
                                    </a>
                                    <a href="#" onclick="confirmarExclusao(<?php echo $categoria['idCategoria']; ?>);" class="button">
                                        <span class="material-symbols-outlined"> delete </span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <?php foreach ($categorias as $index => $categoria) : ?>
                            <tr>
                                <td class="select-column">
                                    <input type="checkbox" name="checkbox[]" value="<?php echo $categoria['idCategoria']; ?>">
                                </td>
                                <td>
                                    <?php echo $categoria['descricao']; ?>
                                </td>
                                <td class="operation">
                                    <a href="../pages/Categoria/pageCategoriaAlteracao.php?idCategoria=<?php echo $categoria['idCategoria']; ?>">
                                        <span class="material-symbols-outlined"> edit </span>
                                    </a>
                                    <a href="#" onclick="confirmarExclusao(<?php echo $categoria['idCategoria']; ?>);" class="button">
                                        <span class="material-symbols-outlined"> delete </span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </form>
    </section>


</body>

</html>