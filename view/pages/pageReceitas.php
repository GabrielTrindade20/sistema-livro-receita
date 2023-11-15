<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once('../../controller/protect.php');
include_once('../../controller/receitaController.php');
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

    <link rel="stylesheet" href="../css/styleAll.css">
    <link rel="stylesheet" href="../css/stylePesq.css">
    <link rel="stylesheet" href="../css/stylePesquisar.css">
    <!-- <link rel="stylesheet" href="../css/styleTable.css"> -->
    <link rel="stylesheet" href="../css/styleResponsivo.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>Receitas</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../components/menu.php'); ?>

    <section class="conteiner-conteudo">
        <div class="paginação">
            <a href="homePage.php">Homepage > </a>
            <a href="pageCategoria.php">Receitas</a>
        </div>

        <section class="conteiner-top">
            <div class="titulos" id="titulo">
                <div class="conteiner-titulo">
                    <div class="">
                        <h1>Lista de Receitas</h1>
                        <div class="info-receitas col">
                            <?php echo "( ) Receitas"; ?>
                        </div>
                    </div>
                </div>

                <div class="search-container d-grid gap-2 d-md-flex justify-content-md-end">
                    <!-- Search -->
                    <form class="form-p">
                        <button>
                            <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <input class="input-p" placeholder="Pesquisar" required="" type="text">
                        <button class="reset" type="reset">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </form>
                    <!-- Criar -->
                    <div class="button-nova">
                        <a href="./Receitas/pageReceitaCadastro.php">
                            <button class="nova-receita-button">Nova Receita</button>
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

        <section>
            <button onclick="confirmarExclusaoCheckbox()">Excluir Selecionados</button>

            <form id="excluirSelect" action="../../controller/receitaController.php?acao=excluirSelecionados" method="post">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-column">-</th>
                            <th>Receita</th>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    </section>

</body>

</html>