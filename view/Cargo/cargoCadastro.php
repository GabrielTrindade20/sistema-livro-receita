<?php
include_once('../../configuration/connect.php');
include_once('../../model/modelCargo/cargoModel.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleEdicao.css">
    <link rel="stylesheet" href="../css/styleMenu.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Página Principal</title>
</head>

<body>
    <header class="header">
        <div class="usuario">
            <a href="">
                <span class="usuario-name">Gabriel Rocha</span>
                <span class="material-symbols-outlined"> person </span>
            </a>
        </div>
    </header>

    <nav class="menu-lateral">
        <div class="logo">
            <a href="homePage.php"><img src="../../view/css/img/logoIcon.png" alt="logo site livro de receitas"> </a>
        </div>

        <div class="links-menu">
            <div class="icone-menu">
                <a href="../homePage.php">
                    <span class="material-symbols-outlined"> Home </span>
                    <span>Home</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../pageReceitas.php">
                    <span class="material-symbols-outlined"> restaurant </span>
                    <span>Receitas</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../pageLivroReceitas.php">
                    <span class="material-symbols-outlined"> menu_book </span>
                    <span>Livro de Receitas</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../pageCargo.php">
                    <span class="material-symbols-outlined"> category </span>
                    <span>Categoria</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../pageDegustacao.php">
                    <span><img src="../../view/css/iconsSVG/iconDegustação.svg" alt=""></span>
                    <span>Degustação</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../pageCargo.php">
                    <span class="material-symbols-outlined"> patient_list </span>
                    <span>Cargo</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../pageFuncionario.php">
                    <span class="material-symbols-outlined"> group </span>
                    <span>Funcionários</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="../pageRestaurante.php">
                    <span class="material-symbols-outlined"> restaurant_menu </span>
                    <span>Restaurantes</span>
                </a>
            </div>
        </div>

        <div class="perfil">
            <div class="icon-usuario">
                <a href="pagePerfil.php">
                    <span class="material-symbols-outlined"> person </span>
                    <span class="name">Gabriel Rocha</span>
                </a>
                <a href="./../../controller/logoutController.php">
                    <span class="material-symbols-outlined"> logout </span>
                </a>
            </div>
        </div>
    </nav>

    <section class="conteiner-pesquisa">

        <div class="titulos" id="titulo">
            <div class="conteiner-titulo">
                <div>
                    <h1>Informações</h1>
                </div>

                <div class="info-receitas">
                    <a href="">(3) Cargos</a>
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
                    <a href="../Cargo/cargoCadastro.php">
                        <button class="nova-receita-button">Cadastrar</button>
                    </a>
                </div>
            </div><!-- Search -->
        </div>
    </section>



    <section class="conteiner-conteudo">
        <h1>Cadastro de Cargo</h1>

        <!-- Formulário de Cadastro -->
        <form method="POST" action="../../controller/controllerCadastro/cargoController.php">
            <label for="nome">Nome do Cargo:</label>
            <input type="text" id="nome" name="nome" required>
            <br>

            <!-- Botão para salvar o cargo -->
            <button type="submit" name="salvar">Salvar</button>

            <!-- Botão para cancelar e voltar à página principal -->
            <a href="pageCargos.php">Cancelar</a>
        </form>


    </section>

</body>

</html>