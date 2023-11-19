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
    <link rel="stylesheet" href="../css/styleTable1.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">

    <title>Livro de Receitas</title>
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
            <a href="#" class="pagina-atual"> Livros de Receitas</a>
        </div>

        <div class="containerPesquisa">
            <div class="row">
                <div class="col-md-6 col-sm-12 conteiner-info">
                    <div>
                        <h1>Lista de Livros</h1>
                    </div>

                    <div class="info-qtd">
                        (0) Livros
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
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="select-column">-</th>
                    <th>Nome do livro</th>
                    <th>Categoria</th>
                    <th>Editor</th>
                    <th>Data de Criação</th>
                    <th class="operation">Operações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemplo de uma linha de dados -->
                <tr>
                    <td class="select-column">
                        <input type="checkbox" name="checkbox[]">
                    </td>
                    <td>Nome do Prato</td>
                    <td>Categoria</td>
                    <td>Editor</td>
                    <td>01/09/2023</td>
                    <td class="operation">
                        <a href="#"><span class="material-symbols-outlined"> visibility </span></a>
                        <a href="#"><span class="material-symbols-outlined"> edit </span></a>
                        <a href="#"><span class="material-symbols-outlined"> delete </span></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

</body>

</html>