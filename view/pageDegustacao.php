<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylePesq.css">
    <link rel="stylesheet" href="css/styleMenu.css">
    <link rel="stylesheet" href="css/styleTable.css">
    <link rel="icon" href="css/iconsSVG/iconReceita.svg">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Degustação</title>
</head>

<body>
    <header class="header">
        <div class="usuario">
            <div id="usuario">
                <a href="">
                    <span class="material-symbols-outlined"> person </span>
                    Gabriel Rocha
                </a>
            </div>
        </div>
    </header>

    <nav class="menu-lateral">
        <div class="logo">
            <a href="homePage.php"><img src="../view/css/img/logoIcon.png" alt="logo site livro de receitas"> </a>
        </div>

        <div class="links-menu">
            <div class="icone-menu">
                <a href="homePage.php">
                    <span class="material-symbols-outlined"> Home </span>
                    <span>Home</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="pageReceitas.php">
                    <span class="material-symbols-outlined"> restaurant </span>
                    <span>Receitas</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="pageLivroReceitas.php">
                    <span class="material-symbols-outlined"> menu_book </span>
                    <span>Livro de Receitas</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="pageCategoria.php">
                    <span class="material-symbols-outlined"> category </span>
                    <span>Categoria</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="pageDegustacao.php">
                    <span><img src="../view/css/iconsSVG/iconDegustação.svg" alt=""></span>
                    <span>Degustação</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="pageCargo.php">
                    <span class="material-symbols-outlined"> patient_list </span>
                    <span>Cargo</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="pageFuncionario.php">
                    <span class="material-symbols-outlined"> group </span>
                    <span>Funcionários</span>
                </a>
            </div>
            <div class="icone-menu">
                <a href="pageRestaurante.php">
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
                <a href="../controller/logoutController.php">
                    <span class="material-symbols-outlined"> logout </span>
                </a>
            </div>
        </div>
    </nav>

    <section class="conteiner-pesquisa">

        <div class="titulos" id="titulo">
            <div class="conteiner-titulo">
                <div>
                    <h1>Lista de Receitas</h1>
                </div>

                <div class="info-receitas">
                    <a href="">(10) Receitas</a>
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

                <div id="button">
                    <button class="nova-receita-button">Nova Receita</button>
                </div>
            </div><!-- Search -->


        </div>
    </section>

    <section class="conteiner-conteudo">
        <table class="table">
            <thead>
                <tr>
                    <th class="select-column">-</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Cozinheiro</th>
                    <th>Data de Criação</th>
                    <th class="operacao">Operações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemplo de uma linha de dados -->
                <tr>
                    <td class="select-column">
                        <a href=""><input type="checkbox"></a>
                    </td>
                    <td>Nome do Prato</td>
                    <td>Categoria A</td>
                    <td>Nome do Cozinheiro</td>
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
            </tbody>
        </table>
    </section>
</body>

</html>