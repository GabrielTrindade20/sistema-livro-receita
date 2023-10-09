<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once('../controller/protect.php');
include_once('../controller/categoriaController.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/stylePesq.css">
    <!-- <link rel="stylesheet" href="css/styleMenu.css"> -->
    <link rel="stylesheet" href="css/styleTable.css">
    <link rel="stylesheet" href="css/styleResponsivo.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <title>Categorias</title>
</head>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('./components/menu.php');?>

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
                    <?php echo "(" . $countCategorias . ") Categorias"; ?>
                </div>
            </div>

            <div class="search-container">
                <div class="search-box">
                    <form method="post" action="#">
                        <div class="search-box-input-container">
                            <input type="text" class="search-box-input" name="busca" placeholder="Faça sua Pesquisa">
                            <button class="search-box-button"><i class="search-box-icone icon icon-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="button-nova">
                    <a href="./Categoria/pageCategoriaCadastro.php">
                        <button class="nova-receita-button">Nova Receita</button>
                    </a>
                </div>
            </div><!-- Search -->
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
                        echo $sucesso. "<br>";
                    }
                    unset($_SESSION["sucesso"]);
                }
            ?>
        </div>
    </section>

    <section class="conteiner-conteudo">
        <table class="table">
            <thead>
                <tr>
                    <th class="select-column">-</th>
                    <th>Categorias</th>
                    <th class="operacao">Operações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tabela de categoria -->
                <?php foreach ($categorias as $index => $categoria): ?>
                    <tr class="<?php echo ($index % 2 == 0) ? 'even-row' : 'odd-row'; ?>">
                        <td class="select-column">
                            <a href=""><input type="checkbox"></a>
                        </td>
                        <td>
                            <?php echo $categoria['descricao']; ?>
                        </td>
                        <td>
                            <a href="./Categoria/pageCategoriaAlteracao.php?idCategoria=<?php echo $categoria['idCategoria']; ?>">
                                <span class="material-symbols-outlined"> edit </span>
                            </a>
                        </td>
                        <td>
                            <a href="../controller/categoriaController.php?acao=excluir&idCategoria=
                                        <?php echo $categoria['idCategoria']; ?>" class="button">
                                <span class="material-symbols-outlined"> delete </span>
                            </a> 
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>