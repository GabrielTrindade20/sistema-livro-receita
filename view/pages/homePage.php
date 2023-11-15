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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <link rel="stylesheet" href="../css/styleAll.css">
    <link rel="stylesheet" href="../css/styleHomePage1.css">
    <link rel="icon" href="../css/iconsSVG/iconReceita.svg">

    <title>Página Principal</title>
</head>

<body>
    <!-- Menu lateral - vem de outra página -->
    <?php require_once('../components/menu.php'); ?>

    <section class="conteiner-conteudo">
        <div id="titulo">
            <h1>Bem Vindo</h1>
        </div>
        <div class="container text-center">
            <h3>Parâmetro do Sistema</h3>
            <div class="row">
                <div class="col">
                    Mês Produção
                    <p>100</p>
                </div>
                <div class="col">
                    Ano Produção
                    <p>100</p>
                </div>
                <div class="col">
                    Total Receitas
                    <p>100</p>
                </div>
            </div>
        </div>

        <div id="sub-titulo">
            <span>
                <hr>
            </span>
            <h2>Acesso Rápido</h2>
            <span>
                <hr>
            </span>
        </div>

        <div class="container text-center">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                    <div class="card">
                        <a href="pageReceitas.php">
                            <span class="material-symbols-outlined"> restaurant </span>
                            <span>Receitas</span>
                        </a>
                    </div>
                </div>
                <div class="col col-lg-2">
                    <div class="card">
                        <a href="pageLivroReceitas.php">
                            <span class="material-symbols-outlined"> menu_book </span>
                            <span>Livros de Receitas</span>
                        </a>
                    </div>
                </div>
                <div class="col col-lg-2">
                    <div class="card">
                        <a href="pageCategoria.php">
                            <span class="material-symbols-outlined"> category </span>
                            <span>Categorias</span>
                        </a>
                    </div>
                </div>
                <div class="col col-lg-2">
                    <div class="card">
                        <a href="pageDegustacao.php">
                            <img src="../css/iconsSVG/iconDegustação.svg" alt="" width="" height="25px">
                            <span>Degustação</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                    <div class="card">
                        <a href="pageCargo.php">
                            <span class="material-symbols-outlined"> patient_list </span>
                            <span>Cargo</span>
                        </a>
                    </div>
                </div>
                <div class="col col-lg-2">
                    <div class="card">
                        <a href="pageFuncionario.php">
                            <span class="material-symbols-outlined"> group </span>
                            <span>Funcionários</span>
                        </a>
                    </div>
                </div>
                <div class="col col-lg-2">
                    <div class="card">
                        <a href="pageRestaurante.php">
                            <span class="material-symbols-outlined"> restaurant_menu </span>
                            <span>Restaurantes</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="cards-conteiner">
            <div id="cards-conteiner-1">
                <div>
                    <a href="pageReceitas.php">
                        <div class="card">
                            <a href="pageReceitas.php">
                                <span class="material-symbols-outlined"> restaurant </span>
                                <span>Receitas</span>
                            </a>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="pageLivroReceitas.php">
                        <div class="card">
                            <a href="pageLivroReceitas.php">
                                <span class="material-symbols-outlined"> menu_book </span>
                                <span>Livros de Receitas</span>
                            </a>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="pageCategoria.php">
                        <div class="card">
                            <a href="pageCategoria.php">
                                <span class="material-symbols-outlined"> category </span>
                                <span>Categorias</span>
                            </a>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="pageDegustacao.php">
                        <div class="card">
                            <a href="pageDegustacao.php">
                                <img src="../css/iconsSVG/iconDegustação.svg" alt="" width="" height="25px">
                                <span>Degustação</span>
                            </a>
                        </div>
                    </a>
                </div>
            </div>

            <div id="cards-conteiner-2">
                <div>
                    <a href="pageCargo.php">
                        <div class="card">
                            <a href="pageCargo.php">
                                <span class="material-symbols-outlined"> patient_list </span>
                                <span>Cargo</span>
                            </a>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="pageFuncionario.php">
                        <div class="card">
                            <a href="pageFuncionario.php">
                                <span class="material-symbols-outlined"> group </span>
                                <span>Funcionários</span>
                            </a>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="ageRestaurante.php">
                        <div class="card">
                            <a href="pageRestaurante.php">
                                <span class="material-symbols-outlined"> restaurant_menu </span>
                                <span>Restaurantes</span>
                            </a>
                        </div>
                    </a>
                </div>
            </div>

        </div> -->
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>