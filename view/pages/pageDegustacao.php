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
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../css/styleConteudoPages.css">
    <link rel="stylesheet" href="../css/styleCabeçalhoPesquisa.css">
    <link rel="stylesheet" href="../css/stylePesquisar.css">
    <link rel="stylesheet" href="../css/styleTable1.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet" href="../css/styleResponsivo.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Página de Receitas</title>
=======
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../components/style.css">

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
>>>>>>> 4fb2ba83548940f58276ae656f8cf4388badf223
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php include '../components/testemenu.php'; ?>
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
            <a href="#" class="pagina-atual"> Degustação</a>
        </div>

<<<<<<< HEAD
    <section class="conteiner-conteudo2">
        <div class="paginação">
            <a href="homePage.php">Homepage > </a>
            <a href="pageDeustacao.php">Degustação</a>
        </div>

        <div class="containerPesquisa">
            <div class="row">
                <div class="col-md-6 col-sm-12 conteiner-info">
                    <div>
                        <h1>Lista de Degustação</h1>
                    </div>

                    <div class="info-qtd">
                        <a href="#">
                            <!-- <?php echo "(" . $countDegustacao . ") Degustação"; ?> -->
                        </a>
=======
        <div class="containerPesquisa">
            <div class="row">
                <div class="col-md-6 col-sm-12 conteiner-info">
                    <div>
                        <h1>Lista de Degustação</h1>
                    </div>

                    <div class="info-qtd">
                        <?php echo "( 0 ) Degustação"; ?>
>>>>>>> 4fb2ba83548940f58276ae656f8cf4388badf223
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 conteiner-func">
                    <!-- Search -->
                    <form class="form-p">
                        <button>
<<<<<<< HEAD
                            <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img"
                                aria-labelledby="search">
                                <path
                                    d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                                    stroke="currentColor" stroke-width="1.333" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
=======
                            <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                                <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
>>>>>>> 4fb2ba83548940f58276ae656f8cf4388badf223
                            </svg>
                        </button>
                        <input class="input-p" placeholder="Pesquisar" required="" type="search">
                    </form>
<<<<<<< HEAD
                    <a href="./Degustacao/degustacaoCadastro.php">
                        <button class="nova-button">Cadastrar</button>
                    </a>
                </div><!-- Search -->
            </div>
=======

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
>>>>>>> 4fb2ba83548940f58276ae656f8cf4388badf223
        </div>
    </section>
    <section>
        <div class="aviso">
            <p>( NÃO FINALIZADA - APENAS VISUALIZAÇÃO )</p>
        </div>
        <!--<button onclick="confirmarExclusaoCheckbox()">Excluir Selecionados</button> -->

<<<<<<< HEAD
    <section class="conteiner-conteudo2">
        <table class="table">
            <thead>
                <tr>
                    <th class="select-column">-</th>
                    <th>Degustador</th>
                    <th>Receita</th>
                    <th>Nota</th>
                    <th>Data de Degustação</th>
                    <th class="operacao">Operações</th>
=======
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
>>>>>>> 4fb2ba83548940f58276ae656f8cf4388badf223
                </tr>
            </thead>
            <tbody>
                <tr class="even-row">
                    <td class="select-column">
                        <a href=""><input type="checkbox"></a>
                    </td>
<<<<<<< HEAD
                    <td>Nome do Degustador</td>
                    <td>Nome da Receita</td>
                    <td>Nota</td>
                    <td>01/09/2023</td>
                    <td class="operacao">
                        <a class="operation-link" href="#"><img
                                src="https://raw.githubusercontent.com/GabrielTrindade20/Projeto-Livro-Receta/def45286c13478eb83fe1770d80c5ae2246514ca/view/css/iconsSVG/iconEditar.svg?token=AYIZEWW27IOOUCCUNAGFSVDFBOLJ6"
                                alt=""></a>
                        <a class="operation-link" href="#"><img
                                src="https://raw.githubusercontent.com/GabrielTrindade20/Projeto-Livro-Receta/def45286c13478eb83fe1770d80c5ae2246514ca/view/css/iconsSVG/iconEditar.svg?token=AYIZEWRHLDUUFHQS4ZSOKCLFBOLH6"
                                alt=""></a>
                        <a class="operation-link" href="#"><img
                                src="https://raw.githubusercontent.com/GabrielTrindade20/Projeto-Livro-Receta/def45286c13478eb83fe1770d80c5ae2246514ca/view/css/iconsSVG/iconExcluir.svg?token=AYIZEWSXHUGY3BQDV4HKILTFBOLFY"
                                alt=""></a>
                    </td>
                </tr>
                <!-- Adicione mais linhas de dados conforme necessário -->
=======
                    <td>Nome do Prato</td>
                    <td>Categoria A</td>
                    <td>Nome do Cozinheiro</td>
                    <td>01/09/2023</td>
                    <td>8.0</td>
                    <td class="operation">
                        <a href="#"><span class="material-symbols-outlined"> edit </span></a>
                        <a href="#"><span class="material-symbols-outlined"> delete </span></a>
                    </td>
>>>>>>> 4fb2ba83548940f58276ae656f8cf4388badf223
            </tbody>
        </table>
    </section>
        </div>
    

</body>

</html>