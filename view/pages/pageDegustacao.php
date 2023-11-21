<?php
include_once('../../controller/protect.php');

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
    <link rel="stylesheet" href="../css/stylePesquisar.css">
    <link rel="stylesheet" href="../css/styleTable3.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">

    <title>Degustação</title>
    <style>
        .aviso p {
            color: red;
            font-size: 25px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../components/menu.php'); ?>

    <section class="conteiner-conteudo">
        <div class="paginação">
            <a href="homePage.php">Homepage </a> >
            <a href="#" class="pagina-atual"> Degustação</a>
        </div>

        <div class="containerPesquisa">
            <div class="row">
                <div class="col-md-6 col-sm-12 conteiner-info">
                    <div>
                        <h1>Lista de Degustação</h1>
                    </div>

                    <div class="info-qtd">
                        <?php echo "( 0 ) Degustação"; ?>
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
                        <a href="">
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
        <div class="aviso">
            <p>( NÃO FINALIZADA - APENAS VISUALIZAÇÃO )</p>
        </div>
        <!--<button onclick="confirmarExclusaoCheckbox()">Excluir Selecionados</button> -->

        <table class="table table-sm   table-striped table-hover">
            <thead>
                <tr>
                    <th class="select-column">-</th>
                    <th>Receita</th>
                    <th>Categoria</th>
                    <th>Degustador</th>
                    <th>Data da Degustação</th>
                    <th>Nota</th>
                    <th class="operation">Operações</th>
                </tr>
            </thead>
            <tbody>
                <tr class="even-row">
                    <td class="select-column">
                        <a href=""><input type="checkbox"></a>
                    </td>
                    <td>Nome do Prato</td>
                    <td>Categoria A</td>
                    <td>Nome do Cozinheiro</td>
                    <td>01/09/2023</td>
                    <td>8.0</td>
                    <td class="operation">
                        <a href="#"><span class="material-symbols-outlined"> edit </span></a>
                        <a href="#"><span class="material-symbols-outlined"> delete </span></a>
                    </td>
            </tbody>
        </table>
    </section>

</body>

</html>