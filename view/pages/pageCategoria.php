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

    <link rel="stylesheet" href="../css/stylePesq.css">
    <link rel="stylesheet" href="../css/styleTable.css">
    <link rel="stylesheet" href="../css/styleResponsivo.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

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
<!-- Menu lateral - vem de outra página -->
<?php require_once('../components/menu.php'); ?>

<div class="paginação">
    <a href="homePage.php">Homepage > </a>
    <a href="pageCategoria.php">Categoria</a>
</div>

<section class="conteiner-pesquisa">
    <div class="titulos" id="titulo">
        <div class="conteiner-titulo">
            <div>
                <h1>Lista de Categorias</h1>
            </div>

            <div class="info-receitas">
                <a href="#">
                    <?php echo "(" . $countCategorias . ") Categorias"; ?>
                </a>
            </div>
        </div>

        <div class="search-container">
            <div class="search-box">
                <form method="post" action="../../controller/categoriaController.php">
                    <div class="search-box-input-container">
                        <input type="text" name="descricao" class="search-box-input" placeholder="Pesquisar...">
                        <button type="submit" class="search-box-button"><i
                                class="search-box-icone icon icon-search"></i></button>
                    </div>
                </form>
            </div>
            <!-- Criar -->
            <div class="button-nova">
                <a href="./Categoria/pageCategoriaCadastro.php">
                    <button class="nova-receita-button">Cadastrar</button>
                </a>
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

<section class="conteiner-conteudo">
    <button onclick="confirmarExclusaoCheckbox()">Excluir Selecionados</button>

    <form id="excluirSelect" action="../../controller/categoriaController.php?acao=excluirSelecionados" method="post">
        <table class="table">
            <thead>
                <tr>
                    <th class="select-column">-</th>
                    <th>Categorias</th>
                    <th class="operacao">Operações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Verifica se houve pesquisa e exibe resultados ou mostra todas as categorias -->
                <?php if (isset($resultados) && !empty($resultados)): ?>
                    <?php foreach ($resultados as $categoria): ?>
                        <tr>
                            <td class="select-column">
                                <input type="checkbox" name="checkbox[]" value="<?php echo $categoria['idCategoria']; ?>">
                            </td>
                            <td>
                                <?php echo $categoria['descricao']; ?>
                            </td>
                            <!-- Operações -->
                            <td>
                                <a
                                    href="../pages/Categoria/pageCategoriaAlteracao.php?idCategoria=<?php echo $categoria['idCategoria']; ?>">
                                    <span class="material-symbols-outlined"> edit </span>
                                </a>
                                <a href="#" onclick="confirmarExclusao(<?php echo $categoria['idCategoria']; ?>);"
                                    class="button">
                                    <span class="material-symbols-outlined"> delete </span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach ($categorias as $index => $categoria): ?>
                        <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                            <td class="select-column">
                                <input type="checkbox" name="checkbox[]" value="<?php echo $categoria['idCategoria']; ?>">
                            </td>
                            <td>
                                <?php echo $categoria['descricao']; ?>
                            </td>
                            <td>
                                <a
                                    href="../pages/Categoria/pageCategoriaAlteracao.php?idCategoria=<?php echo $categoria['idCategoria']; ?>">
                                    <span class="material-symbols-outlined"> edit </span>
                                </a>
                                <a href="#" onclick="confirmarExclusao(<?php echo $categoria['idCategoria']; ?>);"
                                    class="button">
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